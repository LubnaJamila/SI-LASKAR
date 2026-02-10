<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard-admin.dashboard-admin');
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
        return view('admin.master.team.team');
    }

    public function tambah_team()
    {
        return view('admin.master.team.tambah-team');
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