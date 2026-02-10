@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">42</div>
            <div class="stat-label">Hotspot Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">15</div>
            <div class="stat-label">Hotspot Tidak Aktif</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">7</div>
            <div class="stat-label">Rencana Kunjungan</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">7</div>
            <div class="stat-label">Kunjungan Selesai</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">7</div>
            <div class="stat-label">Kunjungan Silang</div>
        </div>
    </div>

    <div class="d-flex align-items-center mb-3">
        <h6 class="fw-semibold me-3 mb-0" style="color:#7d0a0a;">
            Data Rencana Kunjungan Hari Ini
        </h6>

        <div class="flex-grow-1" style="height:2px; background-color:#7d0a0a;"></div>
    </div>

    <div class="card shadow-sm border-0 rounded-2">
        <div class="card-body px-3 py-4">

            {{-- Bungkus tabel agar scrollable di layar kecil --}}
            <div class="table-responsive" style="border-radius: 12px;">
                <table id="example" class="table table-hover align-middle"
                    style="min-width: 700px; width: 100%; border-collapse: collapse; white-space: nowrap;">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Hotspot</th>
                            <th>Jenis Hotspot</th>
                            <th>Jenis Populasi</th>
                            <th>Koordinat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Hotspot Mawar</td>
                            <td>Tempat Rekreasi</td>
                            <td>WPS</td>
                            <td>-6.175392, 106.827153</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Hotspot Melati</td>
                            <td>Rumah Bordir</td>
                            <td>LSL</td>
                            <td>-6.175392, 106.827153</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Hotspot Kenanga</td>
                            <td>WPS</td>
                            <td>Jl. Kenanga No. 3</td>
                            <td>-6.175392, 106.827153</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil"></i></a>
                                <a href="#" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
@endsection
