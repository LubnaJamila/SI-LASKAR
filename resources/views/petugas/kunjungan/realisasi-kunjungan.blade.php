@extends('templates.app')

@section('title', 'Form Realisasi Kunjungan')

@push('styles')
<style>
    .container {
        max-width: 1200px;
        margin-bottom: 20px;
        background-color: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .section-title {
        font-size: 1rem;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 15px;
    }

    .section-title::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #868585;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        margin: 0 -10px;
    }

    .col-md-4 { flex: 0 0 33.333%; max-width: 33.333%; padding: 0 10px; }
    .col-md-6 { flex: 0 0 50%;     max-width: 50%;     padding: 0 10px; }

    .mb-3 { margin-bottom: 20px; }
    .mt-2 { margin-top: 8px; }
    .mb-2 { margin-bottom: 8px; }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 0.9rem;
    }

    .form-control {
        width: 100%;
        padding: 10px 15px;
        font-size: 0.95rem;
        border: 1px solid #d0d0d0;
        border-radius: 6px;
        background-color: white;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        font-family: inherit;
        box-sizing: border-box;
    }

    .form-control:focus {
        outline: none;
        border-color: #007bff;
        box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
    }

    .form-control::placeholder { color: #999; }

    .form-control[readonly],
    .form-control[disabled] {
        background-color: #f5f5f5;
        cursor: not-allowed;
    }

    .d-flex { display: flex; }
    .gap-2  { gap: 8px; }

    .form-check-inline {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-right: 15px;
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 8px;
    }

    .alert-info {
        background-color: #e8f4fd;
        border: 1px solid #bee5eb;
        border-radius: 6px;
        padding: 10px 15px;
        font-size: 0.875rem;
        color: #0c5460;
        margin-bottom: 10px;
    }

    .badge-koordinat {
        display: inline-block;
        background: #28a745;
        color: white;
        font-size: 0.75rem;
        padding: 3px 8px;
        border-radius: 10px;
        margin-left: 8px;
    }

    .badge-koordinat.kosong {
        background: #dc3545;
    }

    .btn {
        padding: 10px 24px;
        font-size: 0.95rem;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
        font-weight: 500;
    }

    .btn-dark    { background-color: #343a40; color: white; }
    .btn-danger  { background-color: #dc3545; color: white; }
    .btn-success { background-color: #28a745; color: white; }
    .btn-warning { background-color: #ffc107; color: #212529; }

    .btn-dark:hover    { background-color: #23272b; }
    .btn-danger:hover  { background-color: #c82333; }
    .btn-success:hover { background-color: #218838; box-shadow: 0 4px 8px rgba(40,167,69,0.3); }
    .btn-warning:hover { background-color: #e0a800; }

    .text-end {
        text-align: right;
        margin-top: 30px;
    }

    @media (max-width: 768px) {
        .container { padding: 20px; }
        .col-md-4, .col-md-6 { flex: 0 0 100%; max-width: 100%; }
        .btn { width: 100%; }
        .text-end { text-align: center; }
    }

    @media (max-width: 480px) {
        .container { padding: 15px; }
        .form-control { font-size: 0.9rem; padding: 9px 12px; }
    }
</style>
@endpush

@section('content')
<form action="{{ route('realisasi_kunjungan.store', $rencana->id) }}" method="POST" id="formRealisasi">
    @csrf

    {{-- ===== SEKSI 1: INFORMASI UMUM & HOTSPOT ===== --}}
    <h6 class="section-title">Informasi Umum &amp; Hotspot</h6>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">ID Hotspot</label>
                <input type="text" class="form-control" value="{{ $hotspot->id }}" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Nama Hotspot</label>
                <input type="text" class="form-control" value="{{ $hotspot->nama_hotspot }}" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Jenis Populasi</label>
                <input type="text" class="form-control" value="{{ strtoupper($hotspot->jenis_populasi) }}" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">ID Team</label>
                <input type="text" class="form-control" value="{{ $hotspot->team->id ?? '-' }}" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Rencana Kunjungan</label>
                <input type="text" class="form-control"
                       value="{{ \Carbon\Carbon::parse($rencana->tanggal_rencana)->format('d M Y') }}" disabled>
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Periode</label>
                <input type="text" class="form-control"
                       value="{{ $rencana->periode->nama_periode ?? '-' }} {{ $rencana->periode->tahun ?? '' }}" disabled>
            </div>
        </div>
    </div>

    {{-- ===== SEKSI 2: PELAKSANAAN & HASIL ===== --}}
    <h6 class="section-title">Pelaksanaan &amp; Hasil Kunjungan</h6>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-3">
                <label class="form-label">Waktu Mulai <span style="color:red">*</span></label>
                <input type="time" name="waktu_mulai" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Waktu Selesai <span style="color:red">*</span></label>
                <input type="time" name="waktu_selesai" class="form-control">
            </div>

            <div class="col-md-4 mb-3">
                <label class="form-label">Waktu Ramai <span style="color:red">*</span></label>
                <div class="mt-2">
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="waktu_ramai" value="1"> Ya
                    </label>
                    <label class="form-check-inline">
                        <input class="form-check-input" type="radio" name="waktu_ramai" value="0"> Tidak
                    </label>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah WPS yang Dijangkau <span style="color:red">*</span></label>
                <input type="number" name="jumlah_dijangkau" class="form-control" placeholder="0" min="0" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah Populasi yang Sudah Dites <span style="color:red">*</span></label>
                <input type="number" name="jumlah_tes" class="form-control" placeholder="0" min="0" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Jumlah Populasi yang Positif <span style="color:red">*</span></label>
                <input type="number" name="jumlah_positif" class="form-control" placeholder="0" min="0" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Gatekeeper / Informan Kunci</label>
                <input type="text" name="gatekeeper" class="form-control" placeholder="Nama gatekeeper / informan kunci">
            </div>
        </div>
    </div>

    {{-- ===== SEKSI 3: DOKUMENTASI & LOKASI ===== --}}
    <h6 class="section-title">Dokumentasi &amp; Lokasi Kunjungan</h6>
    <div class="container">
        <div class="row">

            {{-- KAMERA SELFIE --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Dokumentasi Selfie Petugas <span style="color:red">*</span></label>

                <div class="mb-2">
                    <button type="button" id="btnBukaKamera" class="btn btn-dark mb-2">
                        <i class="bi bi-camera"></i> Buka Kamera
                    </button>
                    <button type="button" id="btnTutupKamera" class="btn btn-danger mb-2" style="display:none;">
                        <i class="bi bi-x-circle"></i> Tutup Kamera
                    </button>
                </div>

                <video id="cameraPreview" autoplay playsinline
                       style="display:none; width:100%; border-radius:8px;"></video>

                <div id="cameraAction" class="mt-2" style="display:none;">
                    <button type="button" id="btnAmbilFoto" class="btn btn-success">
                        <i class="bi bi-camera-fill"></i> Ambil Foto
                    </button>
                </div>

                <img id="previewFoto" alt="Preview Selfie"
                     style="display:none; width:100%; border-radius:8px; margin-top:10px;">

                <button type="button" id="btnRetake" class="btn btn-warning mt-2" style="display:none;">
                    <i class="bi bi-arrow-repeat"></i> Retake
                </button>

                <canvas id="canvas" style="display:none;"></canvas>
                <input type="hidden" name="foto_selfie" id="fotoSelfieData">
            </div>

            {{-- GPS --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">
                    Lokasi (GPS) <span style="color:red">*</span>

                    {{-- Indikator apakah hotspot sudah punya koordinat --}}
                    @if (!empty($hotspot->latitude) && !empty($hotspot->longitude))
                        <span class="badge-koordinat">✓ Koordinat tersimpan</span>
                    @else
                        <span class="badge-koordinat kosong">⚠ Belum ada koordinat</span>
                    @endif
                </label>

                {{-- Info koordinat existing dari hotspot --}}
                @if (!empty($hotspot->latitude) && !empty($hotspot->longitude))
                    <div class="alert-info mb-2">
                        Koordinat hotspot saat ini:
                        <strong>{{ $hotspot->latitude }}, {{ $hotspot->longitude }}</strong>
                    </div>
                @else
                    <div class="alert-info mb-2" style="border-color:#f5c6cb; background:#fdf0f0; color:#721c24;">
                        Hotspot ini belum memiliki koordinat. Wajib ambil lokasi untuk menyimpannya.
                    </div>
                @endif

                <div class="d-flex gap-2 mb-2">
                    <input type="text" id="latitude"  name="latitude"
                           class="form-control"
                           value="{{ $hotspot->latitude ?? '' }}"
                           placeholder="Latitude" readonly required>
                    <input type="text" id="longitude" name="longitude"
                           class="form-control"
                           value="{{ $hotspot->longitude ?? '' }}"
                           placeholder="Longitude" readonly required>
                </div>

                <button type="button" id="btnLokasi" class="btn btn-dark mb-2">
                    <i class="bi bi-geo-alt-fill"></i> Ambil Lokasi Sekarang
                </button>

                {{-- Checkbox pindah lokasi: hanya tampil kalau hotspot sudah punya koordinat --}}
                @if (!empty($hotspot->latitude) && !empty($hotspot->longitude))
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"
                               id="lokasiPindah" name="lokasi_pindah" value="1">
                        <label class="form-check-label" for="lokasiPindah">
                            Lokasi pindah dari titik awal
                            <small style="color:#6c757d;">(akan update koordinat hotspot)</small>
                        </label>
                    </div>
                @else
                    {{-- Kalau belum ada koordinat, tersembunyi tapi selalu terkirim value 1 --}}
                    <input type="hidden" name="lokasi_pindah" value="1">
                @endif
            </div>

        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('rencana_kunjungan') }}" class="btn btn-dark me-2" style="margin-right:10px;">
            Batal
        </a>
        <button type="submit" class="btn btn-success" id="btnSimpan">
            <i class="bi bi-save"></i> Simpan Realisasi
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function () {

    // =============================================
    // KAMERA
    // =============================================
    let stream = null;
    const video    = document.getElementById('cameraPreview');
    const canvas   = document.getElementById('canvas');
    const $preview = $('#previewFoto');

    async function startCamera() {
        try {
            stream = await navigator.mediaDevices.getUserMedia({ video: { facingMode: 'user' } });
            video.srcObject = stream;
            $('#cameraPreview').show();
            $('#cameraAction').show();
            $('#btnBukaKamera').hide();
            $('#btnTutupKamera').show();
            $preview.hide();
            $('#btnRetake').hide();
        } catch (err) {
            alert('Gagal membuka kamera: ' + err.message);
        }
    }

    function stopCamera() {
        if (stream) {
            stream.getTracks().forEach(t => t.stop());
            stream = null;
        }
        $('#cameraPreview').hide();
        $('#cameraAction').hide();
        $('#btnTutupKamera').hide();
        $('#btnBukaKamera').show();
    }

    $('#btnBukaKamera').on('click', startCamera);
    $('#btnTutupKamera').on('click', stopCamera);

    $('#btnAmbilFoto').on('click', function () {
        const ctx    = canvas.getContext('2d');
        canvas.width  = video.videoWidth;
        canvas.height = video.videoHeight;
        ctx.drawImage(video, 0, 0);

        const imageData = canvas.toDataURL('image/png');
        $preview.attr('src', imageData).show();
        $('#fotoSelfieData').val(imageData);
        stopCamera();
        $('#btnRetake').show();
    });

    $('#btnRetake').on('click', function () {
        $preview.hide();
        $('#fotoSelfieData').val('');
        startCamera();
    });

    // =============================================
    // GPS
    // =============================================
    $('#btnLokasi').on('click', function () {
        if (!navigator.geolocation) {
            alert('Browser tidak mendukung GPS.');
            return;
        }

        const $btn = $(this);
        $btn.text('Mengambil lokasi...').prop('disabled', true);

        navigator.geolocation.getCurrentPosition(
            function (pos) {
                $('#latitude').val(pos.coords.latitude);
                $('#longitude').val(pos.coords.longitude);
                $btn.html('<i class="bi bi-geo-alt-fill"></i> Ambil Lokasi Sekarang').prop('disabled', false);
                alert('Lokasi berhasil diambil.');
            },
            function () {
                $btn.html('<i class="bi bi-geo-alt-fill"></i> Ambil Lokasi Sekarang').prop('disabled', false);
                alert('Gagal mengambil lokasi. Pastikan GPS aktif dan izin lokasi diberikan.');
            },
            { enableHighAccuracy: true, timeout: 10000 }
        );
    });

    // =============================================
    // CHECKBOX LOKASI PINDAH
    // =============================================
    $('#lokasiPindah').on('change', function () {
        if ($(this).is(':checked')) {
            if (!confirm('Lokasi hotspot ini akan diperbarui dengan koordinat baru. Lanjutkan?')) {
                $(this).prop('checked', false);
            }
        }
    });

    // =============================================
    // VALIDASI SEBELUM SUBMIT
    // =============================================
    $('#formRealisasi').on('submit', function (e) {
        // Cek foto
        if (!$('#fotoSelfieData').val()) {
            e.preventDefault();
            alert('Harap ambil foto selfie terlebih dahulu.');
            return false;
        }

        // Cek koordinat (wajib diambil)
        if (!$('#latitude').val() || !$('#longitude').val()) {
            e.preventDefault();
            alert('Harap ambil lokasi GPS terlebih dahulu.');
            return false;
        }
    });

});
</script>
@endpush