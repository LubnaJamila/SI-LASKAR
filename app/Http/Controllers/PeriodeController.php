<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\KlasteringAgregatWPS;
use App\Models\Kunjungan;
use App\Models\Periode;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    public function index(Request $request)
    {
        // ===== FILTER TAHUN =====
        $tahunFilter = $request->tahun;
        $filterPeriode = $request->periode;

        $query = Periode::query();

        /*
        =========================
        FILTER PERIODE (nama + tahun)
        =========================
        */
        if ($filterPeriode) {
            [$nama, $tahun] = explode('|', $filterPeriode);

            $query->where('nama_periode', $nama)
                ->where('tahun', $tahun);
        }

        if ($tahunFilter) {
            $query->where('tahun', $tahunFilter);
        }

        $periodes = $query
            ->orderBy('tahun', 'desc')
            ->orderBy('nama_periode')
            ->get();


        // ===== UNTUK DROPDOWN STORE =====
        $tahunSekarang = now()->year;

        $allNama = [
            'Kunjungan 1',
            'Kunjungan 2',
            'Kunjungan 3',
            'Kunjungan 4',
        ];

        $usedNama = Periode::where('tahun', $tahunSekarang)
            ->pluck('nama_periode')
            ->toArray();

        $availableNama = array_diff($allNama, $usedNama);

        /*
        =========================
        LIST UNTUK DROPDOWN FILTER
        =========================
        */
        $listPeriode = Periode::orderByDesc('tahun')
            ->orderBy('nama_periode')
            ->get();


        // daftar tahun untuk filter dropdown
        $listTahun = Periode::select('tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        $hasOpenPeriode = Periode::where('status', 'open')->exists();

        $openPeriodeId = Periode::where('status', 'open')->value('id');

        // ===== BATAS TAMBAH PERIODE =====
        $today = Carbon::today();

        $lastPeriode = Periode::orderByDesc('tanggal_selesai')->first();

        $minTambah = $today->format('Y-m-d');

        if ($lastPeriode) {
            $afterLast = Carbon::parse($lastPeriode->tanggal_selesai)->addDay();

            if ($afterLast->gt($today)) {
                $minTambah = $afterLast->format('Y-m-d');
            }
        }

        $maxTambah = null;

        $periodes = $query
        ->orderBy('tahun', 'desc')
        ->orderBy('nama_periode')
        ->get()
        ->map(function ($p) {

            $sebelum = Periode::where('tanggal_selesai','<',$p->tanggal_mulai)
                ->orderByDesc('tanggal_selesai')
                ->first();

            $sesudah = Periode::where('tanggal_mulai','>',$p->tanggal_selesai)
                ->orderBy('tanggal_mulai')
                ->first();

            $p->batas_bawah = $sebelum
                ? \Carbon\Carbon::parse($sebelum->tanggal_selesai)->addDay()->format('Y-m-d')
                : null;

            $p->batas_atas = $sesudah
                ? \Carbon\Carbon::parse($sesudah->tanggal_mulai)->subDay()->format('Y-m-d')
                : null;

            return $p;
        });

        return view('admin.periode-kunjungan.periode-kunjungan', compact(
            'periodes',
            'availableNama',
            'tahunSekarang',
            'listTahun',
            'listPeriode',
            'filterPeriode',
            'hasOpenPeriode',
            'openPeriodeId',
            'minTambah',
            'maxTambah'
        ));
    }
    public function store(Request $request)
    {
        // validasi
        $request->validate([
            'nama_periode'     => 'required|string|max:100',
            'tahun'            => 'required|digits:4',
            'tanggal_mulai'    => 'required|date',
            'tanggal_selesai'  => 'required|date|after_or_equal:tanggal_mulai',
        ]);

        if (Periode::where('status', 'open')->exists()) {
            return back()->with('error', 'Tutup periode yang sedang open terlebih dahulu');
        }

        // simpan data
        $periode = Periode::create([
            'nama_periode'    => $request->nama_periode,
            'tahun'           => $request->tahun,
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => 'open',
            'status_cluster'  => 'belum',
        ]);
        
        $this->recalculateAgregatWPS($periode->id);

        return back()->with('success', 'Periode berhasil ditambahkan');
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'tanggal_mulai' => 'required|date',
        'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
    ]);

    // hanya periode open boleh edit
    $openPeriodeId = Periode::where('status','open')->value('id');

    if ($openPeriodeId != $id) {
        return back()->with('error','Hanya periode OPEN yang bisa diedit');
    }

    Periode::where('id',$id)->update([
        'tanggal_mulai'=>$request->tanggal_mulai,
        'tanggal_selesai'=>$request->tanggal_selesai,
    ]);

    $this->recalculateAgregatWPS((int) $id);

    return back()->with('success','Tanggal berhasil diupdate');
}

public function open($id)
{
    if (Periode::where('status','open')->exists()) {
        return back()->with('error','Masih ada periode open');
    }

    Periode::where('id',$id)->update(['status'=>'open']);

    return back()->with('success','Periode dibuka');
}

public function close($id)
{
    Periode::where('id',$id)->update(['status'=>'closed']);

    return back()->with('success','Periode ditutup');
}

// =========================================================
    // HELPER: hitung ulang agregat WPS untuk satu periode
    // =========================================================
    private function recalculateAgregatWPS(int $periodeId): void
    {
        // Ambil semua kecamatan
        $kecamatans = Kecamatan::all();

        $hotspotTable = (new \App\Models\Hotspot)->getTable();

        foreach ($kecamatans as $kecamatan) {
            // Agregasi dari tabel kunjungan, join ke hotspot untuk dapat kecamatan_id
            $agregat = Kunjungan::where('kunjungan.periode_id', $periodeId)
                ->join($hotspotTable, 'kunjungan.hotspot_id', '=', "{$hotspotTable}.id")
                ->where("{$hotspotTable}.kecamatan_id", $kecamatan->id)
                ->selectRaw("
                    COUNT(DISTINCT kunjungan.hotspot_id)  AS total_hotspot_dikunjungi,
                    SUM(kunjungan.jumlah_dijangkau)       AS total_wps,
                    SUM(kunjungan.jumlah_tes)             AS total_tes_wps,
                    SUM(kunjungan.jumlah_positif)         AS total_positif_wps
                ")
                ->first();

            KlasteringAgregatWPS::updateOrCreate(
                [
                    'periode_id'    => $periodeId,
                    'kecamatan_id'  => $kecamatan->id,
                ],
                [
                    'total_wps'                  => $agregat->total_wps                  ?? 0,
                    'total_hotspot_dikunjungi'   => $agregat->total_hotspot_dikunjungi   ?? 0,
                    'total_tes_wps'              => $agregat->total_tes_wps              ?? 0,
                    'total_positif_wps'          => $agregat->total_positif_wps          ?? 0,
                ]
            );
        }
    }

}