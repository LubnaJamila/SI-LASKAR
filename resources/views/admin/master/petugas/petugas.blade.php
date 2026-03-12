@extends('templates.app')

@section('title', 'Data Petugas')

@section('content')

    <div class="container">

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

        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Tombol Tambah Hotspot --}}
            <a href="#" class="btn-tambah-hotspot text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#modalTambahHotspot">
                Tambah Petugas
                <i class="bi bi-plus-circle"></i>
            </a>
        </div>

        @php use Illuminate\Support\Str; @endphp

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
                                <th>Nama Lengkap</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Email</th>
                                <th>No Telepon</th>
                                <th>Status Petugas</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($petugas as $item)
                                <tr>
                                    <td class="px-4 py-3 text-start">{{ $loop->iteration }}</td>

                                    <td class="align-middle text-dark text-center">
                                        {{ Str::title($item->nama_lengkap) }}
                                    </td>

                                    <td class="align-middle text-dark text-center">
                                        {{ $item->nik }}
                                    </td>

                                    <td class="align-middle text-dark text-center">
                                        {{ Str::title($item->jenis_kelamin) }}
                                    </td>

                                    <td class="align-middle text-dark text-center">
                                        {{ strtolower($item->email) }}
                                    </td>

                                    <td class="align-middle text-dark text-center">
                                        {{ $item->no_telp }}
                                    </td>

                                    <td>
                                        <span class="badge bg-{{ $item->status == 'aktif' ? 'success' : 'secondary' }}">
                                            {{ Str::title($item->status) }}
                                        </span>
                                    </td>

                                    <td class="align-middle text-dark text-center">
                                        {{ Str::title($item->alamat) }}
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-warning me-1 btn-edit"
                                            data-id="{{ $item->id }}" data-nama="{{ $item->nama_lengkap }}"
                                            data-nik="{{ $item->nik }}" data-jk="{{ $item->jenis_kelamin }}"
                                            data-telp="{{ $item->no_telp }}" data-email="{{ $item->email }}"
                                            data-status="{{ $item->status }}" data-alamat="{{ $item->alamat }}"
                                            data-bs-toggle="modal" data-bs-target="#modalEditPetugas">
                                            <i class="bi bi-pencil"></i>
                                        </a>
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
    <div class="modal fade" id="modalTambahHotspot" tabindex="-1" aria-labelledby="modalTambahHotspotLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="modalTambahHotspotLabel">Tambah Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('petugas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="number" name="nik" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No Telepon</label>
                                <input type="number" name="no_telp" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Password</label>
                                <input type="text" name="password" class="form-control" value="12345678" disabled>
                                <small class="text-muted">Password default: 12345678</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status Petugas</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>

                            <div class="col-6">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required></textarea>
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

    <!-- Modal Edit Petugas -->
    <div class="modal fade" id="modalEditPetugas" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Petugas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditPetugas" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label">Nama Lengkap</label>
                                <input type="text" name="nama_lengkap" id="edit_nama" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">NIK</label>
                                <input type="number" name="nik" id="edit_nik" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Kelamin</label>
                                <select name="jenis_kelamin" id="edit_jk" class="form-select">
                                    <option value="perempuan">Perempuan</option>
                                    <option value="laki-laki">Laki-Laki</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">No Telepon</label>
                                <input type="number" name="no_telp" id="edit_telp" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" class="form-control">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>
                                <select name="status" id="edit_status" class="form-select">
                                    <option value="aktif">Aktif</option>
                                    <option value="non-aktif">Non-Aktif</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label class="form-label">Alamat</label>
                                <textarea name="alamat" id="edit_alamat" class="form-control" rows="3"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        document.querySelectorAll('.btn-edit').forEach(button => {

            button.addEventListener('click', function() {

                let id = this.dataset.id;

                document.getElementById('edit_nama').value = this.dataset.nama;
                document.getElementById('edit_nik').value = this.dataset.nik;
                document.getElementById('edit_jk').value = this.dataset.jk;
                document.getElementById('edit_telp').value = this.dataset.telp;
                document.getElementById('edit_email').value = this.dataset.email;
                document.getElementById('edit_status').value = this.dataset.status;
                document.getElementById('edit_alamat').value = this.dataset.alamat;

                // set action form
                document.getElementById('formEditPetugas').action = '/petugas/' + id;
            });

        });
    </script>


@endsection
