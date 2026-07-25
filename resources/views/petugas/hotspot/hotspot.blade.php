@extends('templates.app')

@section('title', 'Data Hotspot WPS')

@section('content')

    <div class="container">
        {{-- Tombol Tambah Hotspot dan Filter --}}
        <div class="d-flex justify-content-start align-items-center mb-3 gap-3 flex-wrap">

            {{-- Tombol Tambah Hotspot --}}
            <a href="#" class="btn-tambah-hotspot text-decoration-none" data-bs-toggle="modal"
                data-bs-target="#modalTambahHotspot">
                Tambah Hotspot
                <i class="bi bi-plus-circle"></i>
            </a>

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
                                <th>Kecamatan</th>
                                <th>Nama Hotspot</th>
                                <th>Jenis</th>
                                <th>PJ</th>
                                <th>Kontak</th>
                                <th>Status</th>
                                <th>Tim</th>
                                <th>Dibuat Oleh</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hotspots as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $item->kecamatan->nama_kecamatan ?? '-' }}</td>

                                    <td>{{ $item->nama_hotspot }}</td>

                                    <td>{{ $item->jenis_hotspot }}</td>

                                    <td>{{ $item->penanggungjawab }}</td>

                                    <td>{{ $item->kontak_penanggungjawab }}</td>

                                    <td>
                                        @if ($item->status == 'aktif')
                                            <span class="badge bg-success">Aktif</span>
                                        @else
                                            <span class="badge bg-danger">Non-Aktif</span>
                                        @endif
                                    </td>

                                    <td>{{ $item->team->nama_team ?? '-' }}</td>

                                    <td>{{ $item->creator->nama_lengkap ?? '-' }}</td>

                                    <td>
                                        {{-- Tombol Edit --}}
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#modalEditHotspot" data-id="{{ $item->id }}"
                                            data-kecamatan="{{ $item->kecamatan_id }}"
                                            data-nama="{{ $item->nama_hotspot }}" data-jenis="{{ $item->jenis_hotspot }}"
                                            data-pj="{{ $item->penanggungjawab }}"
                                            data-kontak="{{ $item->kontak_penanggungjawab }}"
                                            data-status="{{ ucfirst($item->status) }}">
                                            Edit
                                        </button>

                                        {{-- Tombol Hapus / Menunggu --}}
                                        @if ($item->deleteRequests->where('status', 'pending')->count())
                                            <button class="btn btn-sm btn-secondary" disabled
                                                title="Pengajuan hapus sedang menunggu persetujuan admin">
                                                Menunggu...
                                            </button>
                                        @else
                                            <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modalAjukanHapus" data-id="{{ $item->id }}"
                                                data-nama="{{ $item->nama_hotspot }}">
                                                Hapus
                                            </button>
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

                <form action="{{ route('hotspot.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Pilih Kecamatan</label>
                                <select name="kecamatan_id" id="kecamatanSelect" class="form-select select2-single">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $kec)
                                        <option value="{{ $kec->id }}">
                                            {{ $kec->nama_kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Hotspot</label>
                                <input type="text" name="nama_hotspot" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Hotspot</label>
                                <select name="jenis_hotspot" class="form-select" required>
                                    <option value="">-- Pilih Jenis Lokasi --</option>

                                    <optgroup label="Transportasi">
                                        <option value="Jalan">Jalan</option>
                                        <option value="Terminal">Terminal</option>
                                        <option value="Stasiun">Stasiun</option>
                                        <option value="Pelabuhan">Pelabuhan</option>
                                        <option value="Bandara">Bandara</option>
                                        <option value="Flyover">Flyover</option>
                                        <option value="Underpass">Underpass</option>
                                        <option value="Kolong Jembatan">Kolong Jembatan</option>
                                    </optgroup>

                                    <optgroup label="Fasilitas Umum">
                                        <option value="Lapangan">Lapangan</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Pasar">Pasar</option>
                                        <option value="Taman">Taman</option>
                                        <option value="Pantai">Pantai</option>
                                        <option value="Tepi Sungai">Tepi Sungai</option>
                                        <option value="Kuburan">Kuburan</option>
                                        <option value="Kampus">Kampus</option>
                                    </optgroup>

                                    <optgroup label="Hiburan & Usaha">
                                        <option value="Cafe">Cafe</option>
                                        <option value="Bar">Bar</option>
                                        <option value="SPA">SPA</option>
                                        <option value="Panti Pijat">Panti Pijat</option>
                                        <option value="Salon">Salon</option>
                                        <option value="Karaoke">Karaoke</option>
                                        <option value="Hotel">Hotel</option>
                                        <option value="Warung">Warung</option>
                                        <option value="Lesehan">Lesehan</option>
                                    </optgroup>

                                    <optgroup label="Hunian">
                                        <option value="Kost">Kost</option>
                                        <option value="Rumah">Rumah</option>
                                        <option value="Apartemen">Apartemen</option>
                                        <option value="Wisma">Wisma</option>
                                    </optgroup>

                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status Hotspot</label>
                                <select name="status" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Penanggungjawab</label>
                                <input type="text" name="penanggungjawab" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kontak PJ</label>
                                <input type="number" name="kontak_penanggungjawab" class="form-control" required>
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

    <!-- Modal Edit Hotspot -->
    <div class="modal" id="modalEditHotspot" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Hotspot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formEditHotspot" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="row g-3">

                            <div class="col-md-12">
                                <label class="form-label">Pilih Kecamatan</label>
                                <select name="kecamatan_id" id="editKecamatan" class="form-select select2-single">
                                    <option value="">Pilih Kecamatan</option>
                                    @foreach ($kecamatan as $kec)
                                        <option value="{{ $kec->id }}">
                                            {{ $kec->nama_kecamatan }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Nama Hotspot</label>
                                <input type="text" id="editNama" name="nama_hotspot" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Jenis Hotspot</label>
                                <select name="jenis_hotspot" id="editJenis" class="form-select" required>
                                    <option value="">-- Pilih Jenis Lokasi --</option>

                                    <optgroup label="Transportasi">
                                        <option value="Jalan">Jalan</option>
                                        <option value="Terminal">Terminal</option>
                                        <option value="Stasiun">Stasiun</option>
                                        <option value="Pelabuhan">Pelabuhan</option>
                                        <option value="Bandara">Bandara</option>
                                        <option value="Flyover">Flyover</option>
                                        <option value="Underpass">Underpass</option>
                                        <option value="Kolong Jembatan">Kolong Jembatan</option>
                                    </optgroup>

                                    <optgroup label="Fasilitas Umum">
                                        <option value="Lapangan">Lapangan</option>
                                        <option value="Mall">Mall</option>
                                        <option value="Pasar">Pasar</option>
                                        <option value="Taman">Taman</option>
                                        <option value="Pantai">Pantai</option>
                                        <option value="Tepi Sungai">Tepi Sungai</option>
                                        <option value="Kuburan">Kuburan</option>
                                        <option value="Kampus">Kampus</option>
                                    </optgroup>

                                    <optgroup label="Hiburan & Usaha">
                                        <option value="Cafe">Cafe</option>
                                        <option value="Bar">Bar</option>
                                        <option value="SPA">SPA</option>
                                        <option value="Panti Pijat">Panti Pijat</option>
                                        <option value="Salon">Salon</option>
                                        <option value="Karaoke">Karaoke</option>
                                        <option value="Hotel">Hotel</option>
                                        <option value="Warung">Warung</option>
                                        <option value="Lesehan">Lesehan</option>
                                    </optgroup>

                                    <optgroup label="Hunian">
                                        <option value="Kost">Kost</option>
                                        <option value="Rumah">Rumah</option>
                                        <option value="Apartemen">Apartemen</option>
                                        <option value="Wisma">Wisma</option>
                                    </optgroup>

                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status Hotspot</label>
                                <select name="status" id="editStatus" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non-Aktif">Non-Aktif</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Penanggungjawab</label>
                                <input type="text" id="editPJ" name="penanggungjawab" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Kontak PJ</label>
                                <input type="number" id="editKontak" name="kontak_penanggungjawab" class="form-control"
                                    required>
                            </div>

                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <!-- Modal Ajukan Hapus Hotspot -->
    <div class="modal" id="modalAjukanHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 rounded-3">

                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Ajukan Hapus Hotspot</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form id="formAjukanHapus" action="" method="POST">
                    @csrf
                    <div class="modal-body">

                        <p class="mb-3">
                            Ajukan penghapusan hotspot: <strong id="hapusNamaHotspot"></strong>
                        </p>

                        <div class="alert alert-warning py-2">
                            <small>
                                <i class="bi bi-info-circle me-1"></i>
                                Penghapusan akan diproses setelah mendapat persetujuan dari admin.
                            </small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Alasan Penghapusan</label>
                            <textarea name="alasan_hapus" class="form-control" rows="4"
                                placeholder="Tuliskan alasan mengapa hotspot ini perlu dihapus..." maxlength="500" required></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Batal
                        </button>
                        <button type="submit" class="btn btn-danger">
                            Kirim Pengajuan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>

    <script>
        // ── Modal Edit: isi field dengan data dari tombol ─────────────
        document.getElementById('modalEditHotspot').addEventListener('show.bs.modal', function(e) {
            const btn = e.relatedTarget;

            document.getElementById('formEditHotspot').action = `/hotspot/${btn.dataset.id}`;
            document.getElementById('editNama').value = btn.dataset.nama;
            document.getElementById('editPJ').value = btn.dataset.pj;
            document.getElementById('editKontak').value = btn.dataset.kontak;
            document.getElementById('editKecamatan').value = btn.dataset.kecamatan;
            document.getElementById('editJenis').value = btn.dataset.jenis;
            document.getElementById('editStatus').value = btn.dataset.status;
        });

        // ── Modal Ajukan Hapus: isi nama & set action ─────────────────
        document.getElementById('modalAjukanHapus').addEventListener('show.bs.modal', function(e) {
            const btn = e.relatedTarget;

            document.getElementById('hapusNamaHotspot').textContent = btn.dataset.nama;
            document.getElementById('formAjukanHapus').action = `/hotspot/${btn.dataset.id}/request-delete`;

            // Reset textarea tiap buka modal
            document.querySelector('#formAjukanHapus textarea').value = '';
        });
    </script>

@endsection
