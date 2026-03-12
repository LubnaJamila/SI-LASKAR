<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KlasteringAgregatWPS;
use App\Models\KlasteringHasilWPS;
use App\Models\Periode;
use App\Services\KMeansService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KlasteringController extends Controller
{
    public function __construct(protected KMeansService $kmeans) {}

    // ──────────────────────────────────────────────────────────────
    // INDEX
    // ──────────────────────────────────────────────────────────────
    public function index(Request $request)
{
    // Semua periode untuk dropdown
    $semuaPeriode = Periode::orderByDesc('tanggal_mulai')->get();

    // Gunakan periode dari query string, fallback ke yang open
    $periodeId = $request->query('periode_id');
    $periode   = $periodeId
        ? Periode::find($periodeId)
        : Periode::where('status', 'open')->first();

    if (! $periode) {
        return view('admin.clustering.wps.wps', [
            'semuaPeriode' => $semuaPeriode,
            'periode'      => null,
            'agregat'      => collect(),
            'sudahRun'     => false,
            'hasilMap'     => collect(),
            'hasilGeoData' => [],
        ]);
    }

    $agregat = KlasteringAgregatWPS::with('kecamatan')
        ->where('periode_id', $periode->id)
        ->get();

    $sudahRun = KlasteringHasilWPS::where('periode_id', $periode->id)->exists();

    $hasilMap     = collect();
    $hasilGeoData = [];

    if ($sudahRun) {
        $hasil = KlasteringHasilWPS::with('kecamatan')
            ->where('periode_id', $periode->id)
            ->get();

        $hasilMap = $hasil->keyBy('kecamatan_id');

        $hasilGeoData = $hasil->map(fn($h) => [
            'nama_kecamatan' => $h->kecamatan->nama_kecamatan ?? '',
            'cluster'        => $h->cluster,
            'label'          => $h->label,
            'total_wps'      => $h->total_wps,
            'total_hotspot'  => $h->total_hotspot_dikunjungi,
            'total_tes'      => $h->total_tes_wps,
            'total_positif'  => $h->total_positif_wps,
        ])->values()->toArray();
    }

    return view('admin.clustering.wps.wps', compact(
        'semuaPeriode',
        'periode',
        'agregat',
        'sudahRun',
        'hasilMap',
        'hasilGeoData',
    ));
}

    // ──────────────────────────────────────────────────────────────
    // RUN — Jalankan K-Means dan simpan hasil
    // ──────────────────────────────────────────────────────────────
    public function run(Request $request)
    {
        $periode = Periode::where('status', 'open')->firstOrFail();

        $agregat = KlasteringAgregatWPS::with('kecamatan')
            ->where('periode_id', $periode->id)
            ->get();

        if ($agregat->count() < 4) {
            return back()->withErrors('Data kecamatan kurang dari 4, tidak bisa clustering.');
        }

        // ── Bangun array fitur (sama persis Python) ───────────────
        $data = [];
        foreach ($agregat as $row) {
            $penduduk     = max($row->kecamatan->jumlah_penduduk ?? 1, 1);
            $pendudukRibu = $penduduk;

            $totalWPS     = $row->total_wps                ?? 0;
            $totalHotspot = $row->total_hotspot_dikunjungi ?? 0;
            $totalTes     = $row->total_tes_wps            ?? 0;
            $totalPositif = $row->total_positif_wps        ?? 0;

            $wpsPer1000     = ($totalWPS / $pendudukRibu) * 1000;
            $hotspotPer1000 = ($totalHotspot / $pendudukRibu) * 1000;
            $tesRate        = $totalWPS > 0 ? $totalTes     / $totalWPS : 0;
            $positifRate    = $totalTes > 0 ? $totalPositif / $totalTes : 0;

            $data[] = [
                'id'       => $row->kecamatan_id,
                'features' => [$wpsPer1000, $hotspotPer1000, $tesRate, $positifRate],
                '_raw'     => compact(
                    'totalWPS', 'totalHotspot', 'totalTes', 'totalPositif',
                    'wpsPer1000', 'hotspotPer1000', 'tesRate', 'positifRate'
                ),
            ];
        }

        \Log::info('KMEANS_DEBUG', [
            'count' => count($data),
            'features_sample' => array_slice(array_map(fn($d) => [
                'id'       => $d['id'],
                'features' => $d['features'],
            ], $data), 0, 5),
        ]);

        // ── Jalankan K-Means K=4 ──────────────────────────────────
        $output = $this->kmeans->run($data);

        // ── Simpan ke DB ──────────────────────────────────────────
        DB::transaction(function () use ($output, $data, $periode) {
            KlasteringHasilWPS::where('periode_id', $periode->id)->delete();

            $rawMap = collect($data)->keyBy('id');

            foreach ($output['results'] as $result) {
                $raw = $rawMap[$result['id']]['_raw'];

                KlasteringHasilWPS::create([
                    'periode_id'                => $periode->id,
                    'kecamatan_id'              => $result['id'],
                    'cluster'                   => $result['cluster'],
                    'label'                     => $result['label'],
                    'total_wps'                 => $raw['totalWPS'],
                    'total_hotspot_dikunjungi'  => $raw['totalHotspot'],
                    'total_tes_wps'             => $raw['totalTes'],
                    'total_positif_wps'         => $raw['totalPositif'],
                    'wps_per_1000_penduduk'     => $raw['wpsPer1000'],
                    'hotspot_per_1000_penduduk' => $raw['hotspotPer1000'],
                    'tes_rate'                  => $raw['tesRate'],
                    'positif_rate'              => $raw['positifRate'],
                ]);
            }

            // ✅ 'sudah' sesuai nilai di periodes.status_cluster
            $periode->update(['status_cluster' => 'sudah']);
        });

        // ✅ redirect ke route 'wps' sesuai definisi route-mu
        return redirect()
            ->route('wps')
            ->with('success', "K-Means (K=4) selesai dalam {$output['iterations']} iterasi.");
    }

    // ──────────────────────────────────────────────────────────────
    // GEOJSON — endpoint peta Leaflet
    // ──────────────────────────────────────────────────────────────
    public function geojson()
    {
        $kecamatans = Kecamatan::whereNotNull('geojson')->get();

        $features = $kecamatans->map(function ($kec) {
            $geo = is_string($kec->geojson)
                ? json_decode($kec->geojson, true)
                : $kec->geojson;

            return [
                'type'       => 'Feature',
                'properties' => [
                    'nama_kecamatan' => $kec->nama_kecamatan,
                    'id'             => $kec->id,
                ],
                'geometry' => $geo,
            ];
        })
        ->filter(fn($f) => ! empty($f['geometry']))
        ->values();

        return response()->json([
            'type'     => 'FeatureCollection',
            'features' => $features,
        ]);
    }
}