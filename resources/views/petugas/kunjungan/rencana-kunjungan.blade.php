@extends('templates.app')

@section('title', 'Rencana Kunjungan')

@section('content')

    <div class="container">
        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Tombol Tambah Hotspot --}}
            <a href="#" class="btn-tambah-hotspot text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#modalTambahHotspot">
                Tambah Rencana
                <i class="bi bi-plus-circle"></i>
            </a>

            <div class="filter-container" id="filterContainer">
                <select id="filterJenis" class="form-select-custom">
                    <option value="">Semua Periode</option>
                    <option value="WPS">WPS</option>
                    <option value="LSL">LSL</option>
                </select>
            </div>

            {{-- Dropdown Filter --}}
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

    <!-- Modal Tambah Rencana -->
    <div class="modal" id="modalTambahHotspot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambah Rencana Kunjungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('rencana.store') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row g-3">

                            {{-- =========================
                             PERIODE (AUTO + DISABLED)
                        ========================== --}}
                            <div class="col-md-6">
                                <label class="form-label">Periode Aktif</label>

                                <input type="text" class="form-control bg-light"
                                    value="{{ $periode->nama_periode }} - {{ $periode->tahun }}" disabled>

                                {{-- hidden supaya terkirim --}}
                                <input type="hidden" name="periode_id" value="{{ $periode->id }}">
                            </div>


                            {{-- =========================
                             HOTSPOT DROPDOWN (GLOBAL)
                        ========================== --}}
                            <div class="col-md-6">
                                <label class="form-label">Hotspot</label>

                                <select name="hotspot_id" class="form-select" required>
                                    <option value="">-- Pilih Hotspot --</option>

                                    @forelse($hotspots as $h)
                                        <option value="{{ $h->id }}">
                                            {{ $h->nama_hotspot }}
                                            ({{ strtoupper($h->jenis_populasi) }})
                                        </option>
                                    @empty
                                        <option disabled>
                                            Semua hotspot sudah direncanakan
                                        </option>
                                    @endforelse
                                </select>
                            </div>


                            {{-- =========================
                             TANGGAL (RANGE PERIODE)
                        ========================== --}}
                            <div class="col-md-6">
                                <label class="form-label">Tanggal Rencana</label>

                                <input type="date" name="tanggal_rencana" class="form-control"
                                    min="{{ $periode->tanggal_mulai }}" max="{{ $periode->tanggal_selesai }}" required>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Rencana
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection
