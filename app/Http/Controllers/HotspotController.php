<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
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
}