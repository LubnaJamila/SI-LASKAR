@extends('templates.app')

@section('title', 'Data Periode Kunjungan')

@section('content')

    <div class="container">
        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Dropdown Filter --}}
            <form method="GET">

                <div class="filter-container">
                    <select name="periode_id" class="form-select-custom" onchange="this.form.submit()">
                        <option value="">Semua Periode</option>
                        @foreach ($periodes as $periode)
                            <option value="{{ $periode->id }}"
                                {{ request('periode_id') == $periode->id ? 'selected' : '' }}>
                                {{ $periode->nama_periode }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-container">
                    <select name="status" class="form-select-custom" onchange="this.form.submit()">
                        <option value="">Semua Status</option>
                        <option value="direncanakan" {{ request('status') == 'direncanakan' ? 'selected' : '' }}>Direncanakan</option>
                        <option value="reschedule" {{ request('status') == 'reschedule' ? 'selected' : '' }}>Reschedule
                        </option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>

            </form>

            {{-- <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Semua Jenis Populasi</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div> --}}
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
                                <th>Tanggal Rencana</th>
                                <th>Petugas</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rencana as $i => $item)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $item->hotspot->nama_hotspot }}</td>
                                    <td>{{ $item->hotspot->jenis_hotspot }}</td>
                                    <td>{{ strtoupper($item->hotspot->jenis_populasi) }}</td>
                                    <td>{{ $item->tanggal_rencana }}</td>
                                    <td>{{ $item->assignedBy->nama_lengkap ?? '-' }}</td>
                                    <td>
                                        @if ($item->status === 'direncanakan')
                                            {{-- Reschedule --}}
                                            <a href="#" class="btn btn-sm btn-warning me-1" title="Reschedule">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>

                                            {{-- Realisasikan --}}
                                            <a href="{{ route('realisasi_kunjungan.create', $item->id) }}"
                                                class="btn btn-sm btn-success" title="Realisasikan Kunjungan">
                                                <i class="bi bi-check-circle"></i>
                                            </a>
                                        @elseif($item->status === 'selesai')
                                            -
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
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
