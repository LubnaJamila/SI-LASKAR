<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\HotspotDeleteRequest;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class HotspotController extends Controller
{
    public function index()
    {
        $kecamatan = Kecamatan::orderBy('nama_kecamatan')->get();

        $hotspots = Hotspot::with(['kecamatan','team','creator'])
            ->latest()
            ->get();

        return view('admin.master.hotspot.hotspot', compact('kecamatan','hotspots'));
    }

    public function update(Request $request, Hotspot $hotspot)
    {
        $validated = $request->validate([
            'kecamatan_id'           => 'required|exists:kecamatan,id',
            'nama_hotspot'           => 'required|max:150',
            'jenis_hotspot'          => 'required|max:100',
            'penanggungjawab'        => 'required|max:150',
            'kontak_penanggungjawab' => 'required',
            'status'                 => 'required|in:Aktif,Non-Aktif',
        ]);
 
        $hotspot->update([
            'kecamatan_id'           => $validated['kecamatan_id'],
            'nama_hotspot'           => $validated['nama_hotspot'],
            'jenis_hotspot'          => $validated['jenis_hotspot'],
            'penanggungjawab'        => $validated['penanggungjawab'],
            'kontak_penanggungjawab' => $validated['kontak_penanggungjawab'],
            'status'                 => strtolower($validated['status']),
        ]);
 
        return back()->with('success', 'Hotspot berhasil diperbarui.');
    }
 
    public function approveDelete(Request $request, HotspotDeleteRequest $deleteRequest)
    {
        $request->validate([
            'catatan_admin' => 'nullable|max:500',
        ]);
 
        // Hapus hotspot-nya
        $deleteRequest->hotspot->delete();
 
        // Update status pengajuan
        $deleteRequest->update([
            'status'        => 'approved',
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
            'catatan_admin' => $request->catatan_admin,
        ]);
 
        return back()->with('success', 'Pengajuan hapus disetujui. Hotspot berhasil dihapus.');
    }
 
    public function rejectDelete(Request $request, HotspotDeleteRequest $deleteRequest)
    {
        $request->validate([
            'catatan_admin' => 'required|max:500',
        ]);
 
        $deleteRequest->update([
            'status'        => 'rejected',
            'reviewed_by'   => auth()->id(),
            'reviewed_at'   => now(),
            'catatan_admin' => $request->catatan_admin,
        ]);
 
        return back()->with('success', 'Pengajuan hapus ditolak.');
    }
}