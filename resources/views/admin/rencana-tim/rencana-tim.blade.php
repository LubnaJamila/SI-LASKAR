@extends('templates.app')

@section('title', 'Data Periode Kunjungan')

@section('content')

    <div class="container">
        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Dropdown Filter --}}
            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Periode Kunjungan</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>

            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Semua Status</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>

            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Semua Jenis Populasi</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>
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
                                    <a href="#" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Hotspot Melati</td>
                                <td>Rumah Bordir</td>
                                <td>LSL</td>
                                <td>-6.175392, 106.827153</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Hotspot Kenanga</td>
                                <td>WPS</td>
                                <td>Jl. Kenanga No. 3</td>
                                <td>-6.175392, 106.827153</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

    <!-- Modal Tambah Hotspot -->
    <div class="modal" id="modalTambahHotspot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Hotspot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="#" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Hotspot</label>
                                <input type="text" name="nama_hotspot" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Hotspot</label>
                                <input type="text" name="jenis_hotspot" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Populasi</label>
                                <select name="jenis_populasi" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="WPS">WPS</option>
                                    <option value="LSL">LSL</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Koordinat</label>
                                <input type="text" name="koordinat" class="form-control"
                                    placeholder="-6.175392, 106.827153" required>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
