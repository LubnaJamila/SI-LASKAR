@extends('templates.app')

@section('title', 'Data Team')

@section('content')

    <div class="container">

        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Tombol Tambah Hotspot --}}
            <a href="{{ route ('tambah_team') }}" class="btn-tambah-hotspot text-decoration-none">
                Tambah Team
                <i class="bi bi-plus-circle"></i>
            </a>
        </div>

        {{-- Tabel Hotspot --}}
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

    </div>

@endsection
