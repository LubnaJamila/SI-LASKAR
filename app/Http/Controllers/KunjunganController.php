<?php

namespace App\Http\Controllers;

use App\Models\KlasteringAgregatWPS;
use App\Models\Kunjungan;
use App\Models\RencanaKunjungan;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KunjunganController extends Controller
{

    public function index()
    {
        $user = Auth::user();

        // cek apakah user ketua team
        $teamKetua = Team::where('ketua_id', $user->id)->first();

        $query = Kunjungan::with([
            'hotspot.kecamatan',
            'team',
            'periode',
            'creator'
        ]);

        if ($teamKetua) {
            // =============================
            // KETUA → lihat semua tim
            // =============================
            $query->where('team_id', $teamKetua->id);
        } else {
            // =============================
            // ANGGOTA → hanya milik sendiri
            // =============================
            $query->where('created_by', $user->id);
        }

        $kunjungans = $query
            ->latest()
            ->get();

        return view('petugas.kunjungan.kunjungan-saya', compact('kunjungans'));
    }
    /**
     * Tampilkan form realisasi kunjungan.
     * Dipanggil dari tombol "Realisasikan" di tabel rencana kunjungan.
     *
     * Route: GET /kunjungan/{rencana}/realisasi
     */
    public function create(RencanaKunjungan $rencana)
    {
        // Eager load relasi yang dibutuhkan
        $rencana->load(['hotspot.team', 'team', 'periode']);

        $hotspot = $rencana->hotspot;

        return view('petugas.kunjungan.realisasi-kunjungan', compact('rencana', 'hotspot'));
    }

    /**
     * Simpan data realisasi kunjungan.
     *
     * Route: POST /kunjungan/{rencana}/realisasi
     */
    public function store(Request $request, RencanaKunjungan $rencana)
    {
        $request->validate([
            'waktu_mulai'           => 'nullable',
            'waktu_selesai'         => 'nullable',
            'waktu_ramai'           => 'nullable|in:0,1',
            'jumlah_dijangkau'      => 'required|integer|min:0',
            'jumlah_tes'            => 'required|integer|min:0',
            'jumlah_positif'        => 'required|integer|min:0',
            'gatekeeper'            => 'nullable|string|max:255',
            'foto_selfie'           => 'required|string',   // base64 dari canvas
            'latitude'              => 'required|numeric',
            'longitude'             => 'required|numeric',
            'lokasi_pindah'         => 'nullable|in:1',
        ]);

        $hotspot         = $rencana->hotspot;
        $lokasiPindah    = $request->boolean('lokasi_pindah');   // centang = true
        $hotspotKosong   = empty($hotspot->latitude) || empty($hotspot->longitude);

        // -------------------------------------------------------
        // SIMPAN FOTO (base64 → file)
        // -------------------------------------------------------
        $fotoPath = $this->simpanFotoBase64($request->foto_selfie);

        // -------------------------------------------------------
        // LOGIKA KOORDINAT
        //
        // 1. Hotspot BELUM punya koordinat
        //    → wajib isi koordinat, simpan ke hotspot (status valid) + kunjungan
        //
        // 2. Hotspot SUDAH punya koordinat, TIDAK centang "pindah"
        //    → koordinat kunjungan = koordinat yang dikirim (ambil lokasi sekarang)
        //      tapi TIDAK update hotspot
        //
        // 3. Hotspot SUDAH punya koordinat, CENTANG "pindah"
        //    → update koordinat hotspot + set status hotspot = valid
        //      + simpan koordinat baru ke kunjungan
        // -------------------------------------------------------
        if ($hotspotKosong || $lokasiPindah) {
            // Update koordinat & validasi hotspot
            $hotspot->update([
                'latitude'  => $request->latitude,
                'longitude' => $request->longitude,
            ]);
        }

        // -------------------------------------------------------
        // SIMPAN KUNJUNGAN
        // -------------------------------------------------------
        Kunjungan::create([
            'rencana_id'       => $rencana->id,
            'hotspot_id'       => $hotspot->id,
            'team_id'          => $rencana->team_id,
            'periode_id'       => $rencana->periode_id,
            'created_by'       => Auth::id(),
            'waktu_mulai'      => $request->waktu_mulai,
            'waktu_selesai'    => $request->waktu_selesai,
            'waktu_ramai'      => $request->waktu_ramai,
            'jumlah_dijangkau' => $request->jumlah_dijangkau,
            'jumlah_tes'       => $request->jumlah_tes,
            'jumlah_positif'   => $request->jumlah_positif,
            'gatekeeper'       => $request->gatekeeper,
            'foto'             => $fotoPath,
            'latitude'         => $request->latitude,
            'longitude'        => $request->longitude,
            'status_validasi'  => $lokasiPindah || $hotspotKosong ? 'valid' : 'menunggu',
        ]);

        // -------------------------------------------------------
        // UPDATE STATUS RENCANA → selesai
        // -------------------------------------------------------
        $rencana->update(['status' => 'selesai']);

        // -------------------------------------------------------
        // AKUMULASI KLASTERING AGREGAT WPS
        // Berdasarkan periode + kecamatan dari hotspot
        // -------------------------------------------------------
        $this->akumulasiKlasteringWPS($rencana, $hotspot, $request);

        return redirect()
            ->route('rencana_kunjungan')
            ->with('success', 'Realisasi kunjungan berhasil disimpan.');
    }

    // -----------------------------------------------------------
    // HELPER: akumulasi klastering agregat WPS
    // -----------------------------------------------------------
    private function akumulasiKlasteringWPS(RencanaKunjungan $rencana, $hotspot, Request $request): void
    {
        $periodeId    = $rencana->periode_id;
        $kecamatanId  = $hotspot->kecamatan_id;

        if (!$kecamatanId) return; // hotspot tidak punya kecamatan, skip

        // Hitung ulang dari seluruh kunjungan pada periode + kecamatan ini
        $kunjunganQuery = Kunjungan::query()
            ->whereHas('hotspot', fn($q) => $q->where('kecamatan_id', $kecamatanId))
            ->where('periode_id', $periodeId);

        $totalWPS              = $kunjunganQuery->sum('jumlah_dijangkau');
        $totalTes              = $kunjunganQuery->sum('jumlah_tes');
        $totalPositif          = $kunjunganQuery->sum('jumlah_positif');
        $totalHotspotDikunjungi = $kunjunganQuery->distinct('hotspot_id')->count('hotspot_id');

        KlasteringAgregatWPS::updateOrCreate(
            [
                'periode_id'   => $periodeId,
                'kecamatan_id' => $kecamatanId,
            ],
            [
                'total_wps'                 => $totalWPS,
                'total_hotspot_dikunjungi'  => $totalHotspotDikunjungi,
                'total_tes_wps'             => $totalTes,
                'total_positif_wps'         => $totalPositif,
            ]
        );
    }

    // -----------------------------------------------------------
    // HELPER: simpan foto base64 ke storage
    // -----------------------------------------------------------
    private function simpanFotoBase64(string $base64): string
    {
        // Format: "data:image/png;base64,xxxx"
        [$meta, $data] = explode(',', $base64, 2);
        $ext           = str_contains($meta, 'jpeg') ? 'jpg' : 'png';
        $filename      = 'kunjungan/' . Str::uuid() . '.' . $ext;

        Storage::disk('public')->put($filename, base64_decode($data));

        return $filename;
    }
}