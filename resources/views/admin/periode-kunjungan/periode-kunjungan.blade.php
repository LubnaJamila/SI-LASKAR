@extends('templates.app')

@section('title', 'Data Periode Kunjungan')

@section('content')

    <div class="container">
        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Tombol Tambah Hotspot --}}
            <a href="#"
                class="btn-tambah-hotspot text-decoration-none {{ $hasOpenPeriode ? 'disabled opacity-50' : '' }}"
                @if (!$hasOpenPeriode) data-bs-toggle="modal"
        data-bs-target="#modalTambahHotspot" @endif>
                Tambah Periode
                <i class="bi bi-plus-circle"></i>
            </a>

            {{-- Dropdown Filter --}}
            {{-- <div class="filter-container" id="filterContainer">
                <select onchange="filterPeriode(this.value)" class="form-select-custom">

                    <option value="">Semua Periode</option>

                    @foreach ($listPeriode as $p)
                        <option value="{{ $p->nama_periode }}|{{ $p->tahun }}"
                            {{ $filterPeriode == $p->nama_periode . '|' . $p->tahun ? 'selected' : '' }}>
                            {{ $p->nama_periode }} ({{ $p->tahun }})
                        </option>
                    @endforeach

                </select>
            </div> --}}
        </div>

        {{-- Alert Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Alert Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- Validation Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (!$openPeriodeId)
            <div class="alert alert-warning">
                Silakan buka (Open) satu periode terlebih dahulu untuk dapat mengedit data.
            </div>
        @endif

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
                                <th>Nama Periode</th>
                                <th>Tahun</th>
                                <th>Tahun Mulai</th>
                                <th>Tahun Selesai</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($periodes as $periode)
                                <tr class="{{ $openPeriodeId == $periode->id ? 'table-success fw-bold' : '' }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $periode->nama_periode }}</td>
                                    <td>{{ $periode->tahun }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_mulai)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($periode->tanggal_selesai)->format('d-m-Y') }}</td>
                                    <td>{{ $periode->status }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-2 justify-content-center flex-nowrap">

                                            {{-- <a href="#"
                                                class="btn btn-sm btn-warning btnEdit
                                                {{ $openPeriodeId != $periode->id ? 'disabled opacity-50' : '' }}"
                                                @if ($openPeriodeId == $periode->id) data-url="{{ route('periode.update', $periode->id) }}"
                                                    data-id="{{ $periode->id }}"
                                                    data-nama="{{ $periode->nama_periode }}"
                                                    data-tahun="{{ $periode->tahun }}"
                                                    data-mulai="{{ $periode->tanggal_mulai }}"
                                                    data-selesai="{{ $periode->tanggal_selesai }}"
                                                    data-status="{{ $periode->status }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPeriode" @endif>
                                                <i class="bi bi-pencil"></i>
                                            </a> --}}
                                            {{-- EDIT tanggal --}}
                                            <a href="#"
                                                class="btn btn-sm btn-warning btnEdit {{ $openPeriodeId != $periode->id ? 'disabled opacity-50' : '' }}"
                                                @if ($openPeriodeId == $periode->id) data-url="{{ route('periode.update', $periode->id) }}"
                                                    data-id="{{ $periode->id }}"
                                                    data-nama="{{ $periode->nama_periode }}"
                                                    data-tahun="{{ $periode->tahun }}"
                                                    data-mulai="{{ $periode->tanggal_mulai }}"
                                                    data-selesai="{{ $periode->tanggal_selesai }}"
                                                    data-min="{{ $periode->batas_bawah }}"
                                                    data-max="{{ $periode->batas_atas }}"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#modalEditPeriode" @endif>
                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- OPEN --}}
                                            @if (!$openPeriodeId && $periode->status == 'closed')
                                                <form action="{{ route('periode.open', $periode->id) }}" method="POST"
                                                    class="formStatus">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-success btn-confirm">
                                                        <i class="bi bi-unlock"></i>
                                                    </button>
                                                </form>
                                            @endif

                                            {{-- CLOSE --}}
                                            @if ($periode->status == 'open')
                                                <form action="{{ route('periode.close', $periode->id) }}" method="POST"
                                                    class="formStatus">
                                                    @csrf
                                                    @method('PUT')
                                                    <button class="btn btn-sm btn-danger btn-confirm">
                                                        <i class="bi bi-lock"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
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
                    <h5 class="modal-title fw-bold">Tambah Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ route('periode.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Periode</label>
                                <select name="nama_periode" class="form-select" required>
                                    <option value="">-- Pilih --</option>

                                    @foreach ($availableNama as $nama)
                                        <option value="{{ $nama }}">{{ $nama }}</option>
                                    @endforeach

                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tahun</label>
                                <!-- tampil di UI (disabled) -->
                                <input type="text" class="form-control" value="{{ date('Y') }}" disabled>

                                <!-- dikirim ke server -->
                                <input type="hidden" name="tahun" value="{{ date('Y') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" class="form-control" min="{{ $minTambah }}"
                                    max="{{ $maxTambah }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="tambah_selesai" class="form-control"
                                    min="{{ $minTambah }}" max="{{ $maxTambah }}" required>
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

    <!-- Modal Edit Periode -->
    <div class="modal" id="modalEditPeriode" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Periode</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEdit" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label>Nama Periode</label>
                                <input type="text" id="edit_nama" class="form-control" disabled>
                            </div>

                            <div class="col-md-6">
                                <label>Tahun</label>
                                <input type="text" id="edit_tahun" class="form-control" disabled>
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Mulai</label>
                                <input type="date" name="tanggal_mulai" id="edit_mulai" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label>Tanggal Selesai</label>
                                <input type="date" name="tanggal_selesai" id="edit_selesai" class="form-control"
                                    required>
                            </div>

                            {{-- <div class="col-md-6">
                                <label>Status</label>
                                <select name="status" id="edit_status" class="form-select" required>
                                    <option value="open" {{ $hasOpenPeriode ? 'disabled' : '' }}>Open</option>
                                    <option value="closed">Closed</option>
                                </select>
                            </div> --}}
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
        document.addEventListener('DOMContentLoaded', function() {

            const mulaiTambah = document.querySelector('[name="tanggal_mulai"]');
            const selesaiTambah = document.getElementById('tambah_selesai');

            mulaiTambah.addEventListener('change', function() {
                selesaiTambah.min = this.value;
            });

            function filterPeriode(val) {
                if (val) {
                    window.location = "?periode=" + val;
                } else {
                    window.location = window.location.pathname;
                }
            }

            window.filterPeriode = filterPeriode;

            document.querySelectorAll('.btnEdit').forEach(btn => {
                btn.addEventListener('click', function() {

                    const form = document.getElementById('formEdit');

                    form.action = this.dataset.url;

                    const mulai = document.getElementById('edit_mulai');
                    const selesai = document.getElementById('edit_selesai');

                    document.getElementById('edit_nama').value = this.dataset.nama;
                    document.getElementById('edit_tahun').value = this.dataset.tahun;

                    mulai.value = this.dataset.mulai;
                    selesai.value = this.dataset.selesai;

                    // 🔥 UX VALIDATION
                    mulai.min = this.dataset.min ?? '';
                    mulai.max = this.dataset.max ?? '';

                    selesai.min = this.dataset.min ?? '';
                    selesai.max = this.dataset.max ?? '';
                });
            });

        });

        document.querySelectorAll('.btn-confirm').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Apakah Anda yakin ingin mengubah status periode ini?')) {
                    e.preventDefault();
                }
            });
        });
    </script>
@endpush
