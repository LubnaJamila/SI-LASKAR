<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\Periode;
use App\Models\RencanaKunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardPetugasController extends Controller
{
    public function index()
    {
        return view('petugas.dashboard-petugas.dashboard-petugas');
    }
    
    public function belum_join_team()
    {
        return view('petugas.belum-join-team.belum-join-team');
    }

    public function rencana_kunjungan()
    {
        $user = Auth::user();

        // ======================
        // PERIODE AKTIF
        // ======================
        $periode = Periode::where('status', 'open')->firstOrFail();


        // ======================
        // HOTSPOT (GLOBAL)
        // ======================
        $hotspots = Hotspot::where('status', 'aktif')
            ->whereDoesntHave('rencana', function ($q) use ($periode) {
                $q->where('periode_id', $periode->id);
            })
            ->get();


        // ======================
        // TEAM LOGIN
        // ======================
        $team = $user->teams()->first() ?? $user->ketuaTeams()->first();


        // ======================
        // FILTER TABEL
        // ======================
        $query = RencanaKunjungan::with('hotspot')
            ->where('periode_id', $periode->id);

        // 👑 KETUA → semua team
        if ($user->ketuaTeams()->exists()) {
            $query->where('team_id', $team->id);
        }
        // 👤 ANGGOTA → hanya yang dia buat
        else {
            $query->where('assigned_by', $user->id);
        }

        $rencana = $query->get();
        return view('petugas.kunjungan.rencana-kunjungan', compact(
            'periode',
            'hotspots',
            'rencana'
        ));
    }

    public function realisasi_kunjungan()
    {
        return view('petugas.kunjungan.realisasi-kunjungan');
    }
}