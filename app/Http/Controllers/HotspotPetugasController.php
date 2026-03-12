<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HotspotPetugasController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::orderBy('nama_kecamatan')->get();

        $hotspots = Hotspot::with(['kecamatan','team','creator'])
            ->byUserAccess(auth()->user())
            ->latest()
            ->get();
        
        return view('petugas.hotspot.hotspot', compact('kecamatan','hotspots'));
    }

    public function store(Request $request)
    {
        // VALIDASI
        $validated = $request->validate([
            'kecamatan_id' => 'required|exists:kecamatan,id',
            'nama_hotspot' => 'required|max:150',
            'jenis_hotspot' => 'required|max:100',
            'penanggungjawab' => 'required|max:150',
            'kontak_penanggungjawab' => 'required',
            'status' => 'required|in:Aktif,Non-Aktif',
        ]);

        $teamId =
            DB::table('team_members')
                ->where('user_id', auth()->id())
                ->value('team_id')
            ??
            DB::table('teams')
                ->where('ketua_id', auth()->id())
                ->value('id');

        // SIMPAN
        Hotspot::create([
            'kecamatan_id' => $validated['kecamatan_id'],
            'nama_hotspot' => $validated['nama_hotspot'],
            'jenis_hotspot' => $validated['jenis_hotspot'],
            'jenis_populasi' => 'wps',
            'penanggungjawab' => $validated['penanggungjawab'],
            'kontak_penanggungjawab' => $validated['kontak_penanggungjawab'],
            'status' => strtolower($validated['status']),

            // otomatis dari login
            'team_id' => $teamId,
            'created_by' => auth()->id(),
        ]);

        return back()->with('success', 'Hotspot berhasil ditambahkan');
    }
}