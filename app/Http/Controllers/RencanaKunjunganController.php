<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\Periode;
use App\Models\RencanaKunjungan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RencanaKunjunganController extends Controller
{
    public function index(Request $request)
{
    $user = Auth::user();

    // ambil semua periode (untuk dropdown)
    $periodes = Periode::orderBy('tahun', 'desc')->get();

    // ======================
    // PERIODE AKTIF (DEFAULT)
    // ======================
    $periodeAktif = Periode::where('status', 'open')->firstOrFail();

    // kalau ada filter → pakai itu
    $periodeId = $request->periode_id ?? $periodeAktif->id;

    $periode = Periode::findOrFail($periodeId);

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
    $query = RencanaKunjungan::with('hotspot', 'assignedBy')
        ->where('periode_id', $periode->id);

    if ($user->ketuaTeams()->exists()) {
        $query->where('team_id', $team->id);
    } else {
        $query->where('assigned_by', $user->id);
    }

    $rencana = $query->get();

    return view('petugas.kunjungan.rencana-kunjungan', compact(
        'periode',
        'periodes',
        'hotspots',
        'rencana'
    ));
}


    // ======================
    // STORE
    // ======================
    public function store(Request $request)
    {
        $user = Auth::user();

        $periode = Periode::where('status', 'open')->firstOrFail();

        $request->validate([
            'hotspot_id' => 'required|exists:hotspots,id',
            'tanggal_rencana' => 'required|date'
        ]);

        // 🚫 cegah double booking global
        $exists = RencanaKunjungan::where('hotspot_id', $request->hotspot_id)
            ->where('periode_id', $periode->id)
            ->exists();

        if ($exists) {
            return back()->withErrors('Hotspot sudah direncanakan user lain');
        }

        $team = $user->teams()->first() ?? $user->ketuaTeams()->first();

        RencanaKunjungan::create([
            'hotspot_id' => $request->hotspot_id,
            'periode_id' => $periode->id,
            'team_id' => $team->id,
            'assigned_by' => $user->id, // ✅ pakai ini saja
            'tanggal_rencana' => $request->tanggal_rencana,
            'status' => 'direncanakan',
            'jenis' => 'normal'
        ]);

        return back()->with('success', 'Rencana berhasil ditambahkan');
    }

    // ======================
    // EDIT
    // ======================
    public function edit($id)
    {
        $rencana = RencanaKunjungan::with('hotspot')->findOrFail($id);

        $periode = Periode::where('status', 'open')->firstOrFail();

        return response()->json([
            'id' => $rencana->id,
            'hotspot' => $rencana->hotspot->nama_hotspot,
            'tanggal_rencana' => $rencana->tanggal_rencana,
            'min_date' => $periode->tanggal_mulai,
            'max_date' => $periode->tanggal_selesai,
        ]);
    }


    // ======================
    // UPDATE (RESCHEDULE)
    // ======================
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal_rencana' => 'required|date'
        ]);

        $rencana = RencanaKunjungan::findOrFail($id);

        $rencana->update([
            'tanggal_rencana' => $request->tanggal_rencana
        ]);

        return back()->with('success', 'Rencana berhasil diupdate');
    }
}