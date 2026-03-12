<?php

namespace App\Http\Controllers;

use App\Models\Hotspot;
use App\Models\Periode;
use App\Models\RencanaKunjungan;
use Illuminate\Http\Request;

class RencanaTimController extends Controller
{
    public function index(Request $request)
{
    // ======================
    // DATA PERIODE UNTUK FILTER
    // ======================
    $periodes = Periode::orderBy('created_at','desc')->get();

    // ======================
    // QUERY RENCANA
    // ======================
    $query = RencanaKunjungan::with(['hotspot','assignedBy','team']);

    // ======================
    // FILTER PERIODE
    // ======================
    if ($request->periode_id) {
        $query->where('periode_id', $request->periode_id);
    }

    // ======================
    // FILTER STATUS
    // ======================
    if ($request->status) {
        $query->where('status', $request->status);
    }

    $rencana = $query->latest()->get();

    return view('admin.rencana-tim.rencana-tim', compact(
        'periodes',
        'rencana'
    ));
}
}