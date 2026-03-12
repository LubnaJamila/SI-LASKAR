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
                    @foreach ($periodes as $p)
                    <option value="{{ $p->id }}" {{ $p->id == $periodeId ? 'selected' : '' }}>
                        {{ $p->nama_periode }} — {{ $p->tahun }}
                    </option>
                @endforeach
                </select>
            </div>

            {{-- <div class="filter-container" id="filterContainer">
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
                                <th>Nama Team</th>
                                <th>Periode</th>
                                <th>Petugas</th>
                                <th>Jumlah Dijangkau</th>
                                <th>Jumlah Dites</th>
                                <th>Jumlah Positif</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kunjungans as $i => $k)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $k->hotspot->kecamatan->nama_kecamatan ?? '-' }}</td>
                                    <td>{{ $k->hotspot->nama_hotspot }}</td>
                                    <td>{{ $k->team->nama_team }}</td>
                                    <td>{{ $k->periode->nama_periode }}</td>
                                    <td>{{ $k->creator->nama_lengkap }}</td>
                                    <td>{{ $k->jumlah_dijangkau }}</td>
                                    <td>{{ $k->jumlah_tes }}</td>
                                    <td>{{ $k->jumlah_positif }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>

@endsection
