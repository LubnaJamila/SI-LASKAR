<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\HotspotDeleteRequest;
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
    
    public function update(Request $request, Hotspot $hotspot)
    {
        // Pastikan hanya petugas yang berhak (tim yang sama atau pembuatnya)
        $this->authorizeHotspot($hotspot);
 
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
 
        return back()->with('success', 'Hotspot berhasil diperbarui');
    }
 
    public function requestDelete(Request $request, Hotspot $hotspot)
    {
        // Pastikan hanya petugas yang berhak
        $this->authorizeHotspot($hotspot);
 
        $request->validate([
            'alasan_hapus' => 'required|max:500',
        ]);
 
        // Cek apakah sudah ada pengajuan hapus yang pending untuk hotspot ini
        $sudahAda = HotspotDeleteRequest::where('hotspot_id', $hotspot->id)
            ->where('status', 'pending')
            ->exists();
 
        if ($sudahAda) {
            return back()->with('error', 'Pengajuan hapus untuk hotspot ini sudah ada dan sedang menunggu persetujuan admin.');
        }
 
        HotspotDeleteRequest::create([
            'hotspot_id'   => $hotspot->id,
            'requested_by' => auth()->id(),
            'alasan_hapus' => $request->alasan_hapus,
            'status'       => 'pending',
        ]);
 
        return back()->with('success', 'Pengajuan hapus hotspot berhasil dikirim. Menunggu persetujuan admin.');
    }
 
    // -------------------------------------------------------
    // Helper: pastikan user punya akses ke hotspot ini
    // -------------------------------------------------------
    private function authorizeHotspot(Hotspot $hotspot): void
    {
        $user   = auth()->user();
        $teamId = DB::table('team_members')
                ->where('user_id', $user->id)
                ->value('team_id')
            ??
            DB::table('teams')
                ->where('ketua_id', $user->id)
                ->value('id');
 
        // Boleh edit/ajukan hapus jika: pembuat hotspot ATAU tim yang sama
        if ($hotspot->created_by !== $user->id && $hotspot->team_id !== $teamId) {
            abort(403, 'Anda tidak memiliki akses ke hotspot ini.');
        }
    }
}