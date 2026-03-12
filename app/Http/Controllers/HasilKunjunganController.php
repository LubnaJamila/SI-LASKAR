<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan;
use App\Models\Periode;
use Illuminate\Http\Request;

class HasilKunjunganController extends Controller
{
    public function index(Request $request)
    {
        $periodes = Periode::orderBy('tahun', 'desc')->get();

        $query = Kunjungan::with([
            'hotspot.kecamatan',
            'team',
            'periode',
            'creator'
        ]);

        $kunjungans = $query->latest()->get();

        return view('admin.hasil-kunjungan.hasil-kunjungan', [
            'kunjungans' => $kunjungans,
            'periodes' => $periodes,
            'periodeId' => $request->periode_id
        ]);
    }
}