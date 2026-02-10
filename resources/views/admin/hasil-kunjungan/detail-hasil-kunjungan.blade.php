@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-end mb-3">
            <span class="badge bg-success status-badge">
                Valid
            </span>
        </div>

        <div class="row">
            <!-- Kolom Kiri -->
            <div class="col-lg-6">
                <!-- Card Informasi Umum -->
                <div class="info-card mb-3">
                    <h6 class="card-title">Informasi Umum Hotspot & Tm</h6>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">ID - Hotspot</span>
                            <span class="value">001</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Nama Hotspot</span>
                            <span class="value">Haji ARCD</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Jenis Populasi</span>
                            <span class="value">WPS</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Penanggungjawab</span>
                            <span class="value">Ningsh</span>
                        </div>
                        <div class="info-item">
                            <span class="label">No Telp TJ</span>
                            <span class="value">08255245578</span>
                        </div>
                        <div class="info-item">
                            <span class="label">ID - Team</span>
                            <span class="value">Udara - 001</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Rencana Kunjungan</span>
                            <span class="value">01 - 01 - 2026</span>
                        </div>
                    </div>
                </div>

                <!-- Card Pelaksanaan & Hasil -->
                <div class="info-card">
                    <h6 class="card-title">Pelaksanaan & Hasil Kunjungan</h6>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Pelaksanaan Kunjungan</span>
                            <span class="value">01 - 01 - 2026</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Waktu Mulai</span>
                            <span class="value">07:00</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Waktu Selesai</span>
                            <span class="value">09:00</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Waktu Respon</span>
                            <span class="value">Tidak</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Jumlah Populasi Yang Terinfasi</span>
                            <span class="value">10</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Jumlah Populasi Yang Sudah Dites</span>
                            <span class="value">15</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Jumlah Populasi Yang Positife</span>
                            <span class="value">5</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Petugas Awat Jumlah Populasi</span>
                            <span class="value">-</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Gendkeeper / Informan Kunci</span>
                            <span class="value">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan -->
            <div class="col-lg-6">
                <!-- Card Editorial Populasi -->
                <div class="info-card mb-3">
                    <h6 class="card-title">Editorial Populasi & Informasi Informan</h6>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="label">Perkiraan jumlah populasi kunci (bushs ramai)</span>
                            <span class="value">35</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Jumlah hotspot yang dikunjungi 1 hari/malam</span>
                            <span class="value">2</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Perkiraan jumlah hotspot kunci di hari selain</span>
                            <span class="value">15</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Perkiraan jumlah populasi kunci atau waktu ramai sebalam COVID - 19</span>
                            <span class="value">20</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Perkiraan jumlah populasi kunci yang tidak jarang ke tempat sisi</span>
                            <span class="value">5</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Informan siswa medsos untuk mencari pasangan seks & bolan lainnya</span>
                            <span class="value">Yo</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Hubungan informan ke hotspot</span>
                            <span class="value">-</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Kebutuhan informan</span>
                            <span class="value">Tidak</span>
                        </div>
                        <div class="info-item">
                            <span class="label">Catatan (optional)</span>
                            <span class="value">-</span>
                        </div>
                    </div>
                </div>

                <!-- Card Dokumentasi -->
                <div class="info-card">
                    <h6 class="card-title">Dokumentasi</h6>
                    <div class="info-grid">
                        <div class="info-item full-width">
                            <span class="label mb-2 d-block">Dokumentasi Hasil Kunjungan</span>
                        </div>
                    </div>
                    <div class="documentation-wrapper">
                        <img src="{{ asset('assets/img/gambar-dummy.png') }}" alt="Dokumentasi Kunjungan" class="doc-image">
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-3">
            <div class="col-12">
                <div class="action-buttons">
                    <button type="button" class="btn btn-danger" onclick="openKunjunganSilangModal()">
                        Kunjungan Silang
                    </button>
                    <button type="button" class="btn btn-success" onclick="openValidasiModal()">
                        Valid
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Kunjungan Silang -->
    <div class="modal fade" id="kunjunganSilangModal" tabindex="-1" aria-labelledby="kunjunganSilangModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="kunjunganSilangModalLabel">
                        <i class="bi bi-arrow-left-right me-2"></i>Form Kunjungan Silang
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formKunjunganSilang">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hotspot Tujuan <span class="text-danger">*</span></label>
                                <select class="form-select" name="hotspot_tujuan" required>
                                    <option value="">Pilih Hotspot</option>
                                    <option value="001">Hotspot 001 - Haji ARCD</option>
                                    <option value="002">Hotspot 002 - Lokasi A</option>
                                    <option value="003">Hotspot 003 - Lokasi B</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Kunjungan Silang <span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control" name="tanggal_kunjungan" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Mulai <span class="text-danger">*</span></label>
                                <input type="time" class="form-control" name="waktu_mulai" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Waktu Selesai</label>
                                <input type="time" class="form-control" name="waktu_selesai">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah Populasi Yang Ditemui</label>
                                <input type="number" class="form-control" name="jumlah_populasi" min="0">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Petugas Pendamping</label>
                                <input type="text" class="form-control" name="petugas_pendamping"
                                    placeholder="Nama petugas">
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Tujuan Kunjungan Silang <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control" name="tujuan_kunjungan" rows="3" required
                                    placeholder="Jelaskan tujuan kunjungan silang..."></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" name="catatan" rows="3" placeholder="Catatan atau informasi tambahan..."></textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="form-label">Upload Dokumen Pendukung</label>
                                <input type="file" class="form-control" name="dokumen"
                                    accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                                <small class="text-muted">Format: PDF, DOC, DOCX, JPG, PNG (Max 5MB)</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-danger" onclick="submitKunjunganSilang()">
                        <i class="bi bi-send me-1"></i>Submit Kunjungan Silang
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Validasi -->
    <div class="modal fade" id="validasiModal" tabindex="-1" aria-labelledby="validasiModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title" id="validasiModalLabel">
                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Validasi
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <div class="mb-3">
                        <i class="bi bi-exclamation-circle text-warning" style="font-size: 4rem;"></i>
                    </div>
                    <h5 class="mb-3">Apakah Anda yakin ingin memvalidasi data ini?</h5>
                    <p class="text-muted mb-0">Data yang sudah divalidasi tidak dapat diubah kembali.</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle me-1"></i>Batal
                    </button>
                    <button type="button" class="btn btn-success px-4" onclick="confirmValidasi()">
                        <i class="bi bi-check-circle me-1"></i>Ya, Validasi
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Success -->
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center py-5">
                    <div class="mb-3">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                    </div>
                    <h4 class="mb-3">Berhasil!</h4>
                    <p class="text-muted mb-0" id="successMessage">Operasi berhasil dilakukan.</p>
                </div>
                <div class="modal-footer justify-content-center border-0">
                    <button type="button" class="btn btn-primary px-4" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .status-badge {
            font-size: 14px;
            padding: 8px 18px;
            border-radius: 10px;
            font-weight: 600;
        }

        /* Info Card Styles */
        .info-card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 1.25rem;
        }

        .card-title {
            font-size: 18px;
            font-weight: 600;
            color: #000000;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 1px solid #6d6d6d;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Info Grid */
        .info-grid {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 1rem;
        }

        .info-item .label {
            font-size: 0.8125rem;
            color: #333;
            flex: 1;
            line-height: 1.5;
            font-family: Georgia, 'Times New Roman', Times, serif
        }

        .info-item .value {
            font-size: 0.8125rem;
            color: #666;
            text-align: right;
            min-width: 80px;
            line-height: 1.5;
            font-family: Georgia, 'Times New Roman', Times, serif
        }

        .info-item.full-width {
            flex-direction: column;
        }

        /* Documentation */
        .documentation-wrapper {
            margin-top: 0.75rem;
            border-radius: 6px;
            overflow: hidden;
            background-color: #fff;
            border: 1px solid #e0e0e0;
        }

        .doc-image {
            width: 100%;
            height: auto;
            display: block;
            max-height: 350px;
            object-fit: cover;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn {
            border-radius: 6px;
            padding: 0.5rem 1.75rem;
            font-weight: 500;
            font-size: 16px;
            font-family: Georgia, 'Times New Roman', Times, serif;
            border: none;
            transition: all 0.3s ease;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        .btn-danger:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(220, 53, 69, 0.3);
        }

        .btn-success {
            background-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        /* Modal Styles */
        .modal-content {
            border-radius: 8px;
            border: none;
        }

        .modal-header {
            border-radius: 8px 8px 0 0;
            border-bottom: none;
            padding: 1rem 1.25rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .info-item .label {
            font-size: 12px;
            font-weight: 600;
            color: #111827;
        }

        .info-item .value {
            font-size: 12px;
            color: #333;
        }

        .form-label {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 0.4rem;
        }

        .form-control,
        .form-select {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 0.5rem 0.75rem;
            font-size: 0.8125rem;
            transition: all 0.2s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #80bdff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .text-danger {
            color: #dc3545 !important;
        }


        /* Responsive Design */
        @media (max-width: 991px) {
            .info-card {
                margin-bottom: 1rem;
            }
        }

        @media (max-width: 768px) {
            .info-card {
                padding: 1rem;
            }

            .card-title {
                font-size: 0.8125rem;
            }

            .info-item {
                flex-direction: column;
                gap: 0.25rem;
                padding-bottom: 0.5rem;
                border-bottom: 1px solid #e9ecef;
            }

            .info-item .label {
                font-size: 0.75rem;
            }

            .info-item .value {
                font-size: 0.8125rem;
                text-align: left;
                min-width: auto;
                color: #333;
                font-weight: 500;
            }

            .action-buttons {
                justify-content: center;
            }

            .btn {
                flex: 1;
                min-width: 150px;
            }

            .doc-image {
                max-height: 250px;
            }
        }

        @media (max-width: 576px) {
            .container-fluid {
                padding: 0.75rem;
            }

            .py-4 {
                padding-top: 0.75rem !important;
                padding-bottom: 0.75rem !important;
            }

            .info-card {
                padding: 0.875rem;
            }

            .card-title {
                font-size: 0.75rem;
                margin-bottom: 0.75rem;
            }

            .info-item .label,
            .info-item .value {
                font-size: 0.7rem;
            }

            .btn {
                width: 100%;
                min-width: auto;
            }

            .action-buttons {
                gap: 0.5rem;
            }
        }

        /* Print Styles */
        @media print {

            .action-buttons,
            .btn {
                display: none !important;
            }

            .info-card {
                background-color: #fff !important;
                box-shadow: none !important;
                page-break-inside: avoid;
            }
        }

        /* Loading Animation */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: 0.15em;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        .spinner-border {
            display: inline-block;
            width: 1rem;
            height: 1rem;
            vertical-align: text-bottom;
            border: 0.15em solid currentColor;
            border-right-color: transparent;
            border-radius: 50%;
            animation: spin 0.75s linear infinite;
        }
    </style>

    <script>
        // Bootstrap Modal instances
        let kunjunganSilangModal;
        let validasiModal;
        let successModal;

        // Initialize modals when document is ready
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap modals
            kunjunganSilangModal = new bootstrap.Modal(document.getElementById('kunjunganSilangModal'));
            validasiModal = new bootstrap.Modal(document.getElementById('validasiModal'));
            successModal = new bootstrap.Modal(document.getElementById('successModal'));

            // Form validation
            const form = document.getElementById('formKunjunganSilang');
            if (form) {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();
                });
            }
        });

        // Open Kunjungan Silang Modal
        function openKunjunganSilangModal() {
            // Reset form
            document.getElementById('formKunjunganSilang').reset();
            // Show modal
            kunjunganSilangModal.show();
        }

        // Submit Kunjungan Silang Form
        function submitKunjunganSilang() {
            const form = document.getElementById('formKunjunganSilang');

            // Validate form
            if (!form.checkValidity()) {
                form.classList.add('was-validated');
                showAlert('Mohon lengkapi semua field yang wajib diisi!', 'warning');
                return;
            }

            // Get form data
            const formData = new FormData(form);

            // Show loading state
            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Menyimpan...';

            // Simulate API call
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;

                // Close kunjungan silang modal
                kunjunganSilangModal.hide();

                // Show success message
                document.getElementById('successMessage').textContent = 'Data kunjungan silang berhasil disimpan!';
                successModal.show();

                // Reset form
                form.reset();
                form.classList.remove('was-validated');

                // Log data (untuk development)
                console.log('Form Data:', Object.fromEntries(formData));
            }, 1500);
        }

        // Open Validasi Modal
        function openValidasiModal() {
            validasiModal.show();
        }

        // Confirm Validasi
        function confirmValidasi() {
            const submitBtn = event.target;
            const originalText = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Memvalidasi...';

            // Simulate API call
            setTimeout(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalText;

                // Close validasi modal
                validasiModal.hide();

                // Show success message
                document.getElementById('successMessage').textContent = 'Data berhasil divalidasi!';
                successModal.show();

                // Redirect atau update UI jika diperlukan
                setTimeout(() => {
                    console.log('Data validated successfully');
                }, 1500);
            }, 1500);
        }

        // Show Alert Helper
        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className =
                `alert alert-${type} alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3`;
            alertDiv.style.zIndex = '9999';
            alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    `;
            document.body.appendChild(alertDiv);

            // Auto remove after 3 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 3000);
        }
    </script>

@endsection
