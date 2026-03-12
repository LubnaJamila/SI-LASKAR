<?php

namespace App\Http\Controllers;

use App\Models\KlasteringAgregatWPS;
use App\Models\KlasteringHasilWPS;
use App\Models\Periode;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index(Request $request)
    {
        // ── Ambil semua periode untuk dropdown filter ──
        $periodes = Periode::orderByDesc('tahun')->orderBy('nama_periode')->get();

        // ── Periode yang dipilih (default: paling baru) ──
        $periodeId = $request->input('periode_id', $periodes->first()?->id);

        // ── Data peta: hasil cluster per kecamatan ──
        // Sumber: klastering_hasil_wps JOIN kecamatans
        $hasilCluster = KlasteringHasilWPS::with('kecamatan')
            ->where('periode_id', $periodeId)
            ->get();

        // Bentuk lookup: nama_kecamatan → { label, cluster, warna, data }
        $clusterColors = [
            'Tinggi'          => '#ef4444',
            'Sedang'          => '#f59e0b',
            'Rendah'          => '#22c55e',
            'Sangat Rendah'   => '#3b82f6',
        ];

        $kecClusterMap = $hasilCluster->mapWithKeys(function ($row) use ($clusterColors) {
            return [
                $row->kecamatan->nama_kecamatan => [
                    'label'          => $row->label,
                    'cluster'        => $row->cluster,
                    'color'          => $clusterColors[$row->label] ?? '#9E9E9E',
                    'total_wps'      => (int) $row->total_wps,
                    'total_hotspot'  => (int) $row->total_hotspot_dikunjungi,
                    'total_tes'      => (int) $row->total_tes_wps,
                    'total_positif'  => (int) $row->total_positif_wps,
                ],
            ];
        });

        // ── Data diagram: agregat per kecamatan ──
        // Sumber: klastering_agregat_wps JOIN kecamatans
        $agregat = KlasteringAgregatWPS::with('kecamatan')
            ->where('periode_id', $periodeId)
            ->get()
            ->sortBy('kecamatan.nama_kecamatan')
            ->values();

        $chartData = $agregat->map(fn ($row) => [
            'nama'          => $row->kecamatan->nama_kecamatan,
            'total_wps'     => (int) $row->total_wps,
            'total_hotspot' => (int) $row->total_hotspot_dikunjungi,
            'total_tes'     => (int) $row->total_tes_wps,
            'total_positif' => (int) $row->total_positif_wps,
        ])->values();

        // ── Ringkasan kartu ──
        $summary = [
            'total_wps'      => $agregat->sum('total_wps'),
            'total_hotspot'  => $agregat->sum('total_hotspot_dikunjungi'),
            'total_tes'      => $agregat->sum('total_tes_wps'),
            'total_positif'  => $agregat->sum('total_positif_wps'),
        ];

        return view('admin.dashboard-admin.dashboard-admin', compact(
            'periodes',
            'periodeId',
            'kecClusterMap',
            'chartData',
            'summary'
        ));
    }
    
    public function hotspot()
    {
        return view('admin.master.hotspot.hotspot');
    }

    public function petugas()
    {
        return view('admin.master.petugas.petugas');
    }

    public function team()
    {
        $teams = Team::with(['ketua', 'members'])->latest()->get();
        return view('admin.master.team.team', compact('teams'));
    }

    public function tambah_team()
    {
        /*
        ===================================
        Ambil user yg:
        - petugas
        - aktif
        - belum jadi ketua
        - belum jadi member
        ===================================
        */

        $users = User::where('role', 'petugas')
            ->where('status', 'aktif')
            ->whereDoesntHave('ketuaTeams')
            ->whereDoesntHave('teams')
            ->get();
        return view('admin.master.team.tambah-team', compact('users'));
    }

    public function lsl()
    {
        
        return view('admin.clustering.lsl.lsl');
    }

    public function wps()
    {
        return view('admin.clustering.wps.wps');
    }

    public function hasil_kunjungan()
    {
        return view('admin.hasil-kunjungan.hasil-kunjungan');
    }

    public function detail_hasil_kunjungan()
    {
        return view('admin.hasil-kunjungan.detail-hasil-kunjungan');
    }
    
    public function periode_kunjungan()
    {
        return view('admin.periode-kunjungan.periode-kunjungan');
    }

    public function rencana_tim()
    {
        return view('admin.rencana-tim.rencana-tim');
    }
}