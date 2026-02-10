@extends('templates.app')

@section('title', 'Hotspot')

@section('content')

    <div class="container">
        <h5 class="fw-bold mb-3">Data Hasil Kunjungan</h5>

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
                                <th>Kecamatan</th>
                                <th>Nama Hotspot</th>
                                <th>Lokasi</th>
                                <th>Jenis Hotspot</th>
                                <th>Jenis Populasi</th>
                                <th>ID - Team</th>
                                <th>Status Kunjungan</th>
                                <th>Rencana Kunjungan</th>
                                <th>Pelaksanaan Kunjungan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Kaliwates</td>
                                <td>Hotspot Mawar</td>
                                <td>Tempat Rekreasi</td>
                                <td>WPS</td>
                                <td>-6.175392, 106.827153</td>
                                <td>Team A</td>

                                <!-- Status Valid -->
                                <td>
                                    <span class="badge bg-success">Valid</span>
                                </td>

                                <td>05-02-2026</td>
                                <td>06-02-2026</td>

                                <td>
                                    <a href="{{ route ('detail_hasil_kunjungan') }}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Sumbersari</td>
                                <td>Hotspot Melati</td>
                                <td>Rumah Bordir</td>
                                <td>LSL</td>
                                <td>-6.175392, 106.827153</td>
                                <td>Team B</td>

                                <!-- Status Tidak Valid -->
                                <td>
                                    <span class="badge bg-danger">Tidak Valid</span>
                                </td>

                                <td>07-02-2026</td>
                                <td>-</td>

                                <td>
                                    <a href="#" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye"></i></a>
                                </td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>Patrang</td>
                                <td>Hotspot Kenanga</td>
                                <td>Jl. Kenanga No. 3</td>
                                <td>WPS</td>
                                <td>-6.175392, 106.827153</td>
                                <td>Team C</td>

                                <!-- Status Menunggu -->
                                <td>
                                    <span class="badge bg-warning text-dark">Menunggu Validasi</span>
                                </td>

                                <td>10-02-2026</td>
                                <td>-</td>

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
