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

            <div class="filter-container">
                <select id="filterPeriode" class="form-select-custom">
                    @foreach ($periodes as $p)
                        <option value="{{ $p->id }}" {{ $p->id == $periode->id ? 'selected' : '' }}>
                            {{ $p->nama_periode }} — {{ $p->tahun }}
                        </option>
                    @endforeach
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
                                            <a href="#" class="btn btn-sm btn-warning me-1 btn-edit"
                                                data-id="{{ $item->id }}" title="Reschedule">
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

    <!-- Modal Edit Rencana -->
    <div class="modal fade" id="modalEditRencana" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Reschedule Kunjungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditRencana" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="mb-3">
                            <label>Hotspot</label>
                            <input type="text" id="editHotspot" class="form-control" disabled>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Rencana</label>
                            <input type="date" name="tanggal_rencana" id="editTanggal" class="form-control" required>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const modal = new bootstrap.Modal(document.getElementById('modalEditRencana'));

            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', function() {

                    let id = this.getAttribute('data-id');

                    fetch(`/rencana_kunjungan/${id}/edit`)
                        .then(res => res.json())
                        .then(data => {

                            // isi data
                            document.getElementById('editHotspot').value = data.hotspot;
                            document.getElementById('editTanggal').value = data.tanggal_rencana;

                            // set min max tanggal
                            document.getElementById('editTanggal').min = data.min_date;
                            document.getElementById('editTanggal').max = data.max_date;

                            // set action form
                            document.getElementById('formEditRencana').action =
                                `/rencana_kunjungan/${id}`;

                            modal.show();
                        });
                });
            });

        });
        document.getElementById('filterPeriode').addEventListener('change', function() {
            let periodeId = this.value;
            let url = new URL(window.location.href);

            url.searchParams.set('periode_id', periodeId);

            window.location.href = url.toString();
        });
    </script>
@endpush
