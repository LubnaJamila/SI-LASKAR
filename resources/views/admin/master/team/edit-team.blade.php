@extends('templates.app')

@section('title', 'Form Tambah Team')

@section('content')
    <style>
        .container {
            max-width: 1200px;
            margin-bottom: 20px;
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            margin-bottom: 25px;
            overflow: hidden;
        }

        .card.border-primary {
            border-color: #007bff;
            border-width: 2px;
        }

        /* .card-body {
                                                                                                                                        padding: 25px;
                                                                                                                                    } */

        .section-title {
            font-size: 1rem;
            font-weight: 600;
            color: #333;
            display: flex;
            align-items: center;
            gap: 12px;

        }

        .section-title::after {
            content: "";
            flex: 1;
            height: 1px;
            background: #868585;
        }



        .card-body h6 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #333;
            padding-bottom: 10px;
            border-bottom: 1px solid #868585;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
            padding: 0 10px;
        }

        .mb-3 {
            margin-bottom: 20px;
        }

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
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .form-control::placeholder {
            color: #999;
        }

        select.form-control {
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23333' d='M6 9L1 4h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 15px center;
            background-size: 12px;
            padding-right: 40px;
            cursor: pointer;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #d0d0d0;
            border-radius: 6px;
            min-height: 42px;
            padding: 5px 10px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 30px;
            padding-left: 5px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 40px;
        }

        .select2-container--default.select2-container--focus .select2-selection--single,
        .select2-container--default.select2-container--focus .select2-selection--multiple {
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #f0ad4e;
            border: none;
            border-radius: 4px;
            padding: 4px 10px 4px 25px;
            margin: 3px 5px 3px 0;
            color: #333;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #333;
            margin-right: 5px;
            font-weight: bold;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            color: #000;
        }

        .text-muted {
            color: #6c757d;
            font-size: 0.85rem;
            display: block;
            margin-top: 5px;
        }

        .text-end {
            text-align: right;
            margin-top: 30px;
        }

        .btn {
            padding: 12px 35px;
            font-size: 1rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: 500;
        }

        .btn-success {
            background-color: #28a745;
            color: white;
        }

        .btn-success:hover {
            background-color: #218838;
            box-shadow: 0 4px 8px rgba(40, 167, 69, 0.3);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
                margin-bottom: 15px;
            }

            .row .col-md-6:last-child {
                margin-bottom: 0;
            }

            .card-body {
                padding: 20px;
            }

            h5 {
                font-size: 1.1rem;
            }

            .btn {
                width: 100%;
                padding: 14px 20px;
            }

            .text-end {
                text-align: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
            }

            .card-body {
                padding: 15px;
            }

            .form-control {
                font-size: 0.9rem;
                padding: 9px 12px;
            }
        }
    </style>
    <form action="{{ route('team.update', $team->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- DATA TEAM -->
        <h6 class="section-title">Data Team</h6>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Team</label>
                    <input type="text" name="nama_team" class="form-control" value="{{ $team->nama_team }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Status Team</label>
                    <select name="status" class="form-control">
                        <option value="Aktif" {{ $team->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="Non Aktif" {{ $team->status == 'Non Aktif' ? 'selected' : '' }}>Non Aktif</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- DATA KETUA & ANGGOTA -->
        <h6 class="section-title">Data Ketua & Anggota Team</h6>
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Ketua Team</label>
                    <select name="ketua_id" id="ketuaSelect" class="form-control select2-single">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" {{ $team->ketua_id == $user->id ? 'selected' : '' }}>
                                {{ $user->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">NIK</label>
                    <input type="text" id="nikField" class="form-control" placeholder="NIK Ketua" disabled>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">No Telepon</label>
                    <input type="text" id="telpField" class="form-control" placeholder="No Telepon Ketua" disabled>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" id="emailField" class="form-control" placeholder="Email Ketua" disabled>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Pilih Anggota Team</label>
                <select name="members[]" id="memberSelect" class="form-control select2-multiple" multiple>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ $team->members->contains($user->id) ? 'selected' : '' }}>
                            {{ $user->nama_lengkap }}
                        </option>
                    @endforeach
                </select>
                <small class="text-muted">
                    Bisa pilih lebih dari satu anggota dan hapus dengan klik ❌
                </small>
            </div>

        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">
                Simpan Data Team
            </button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        const memberTeams = @json($teamUsers); // anggota
        const ketuaTeams = @json($ketuaTeams); // ketua
        const currentTeamId = {{ $team->id ?? 'null' }};

        $(document).ready(function() {

            $('.select2-single').select2();
            $('.select2-multiple').select2();

            const ketua = $('#ketuaSelect');
            const member = $('#memberSelect');


            /*
            =====================================
            LOAD DETAIL KETUA + DISABLE DI MEMBER
            =====================================
            */
            function loadDetail(id) {

                if (!id) return;

                $.get("{{ url('/users') }}/" + id + "/detail", function(res) {
                    $('#nikField').val(res.nik);
                    $('#telpField').val(res.no_telp);
                    $('#emailField').val(res.email);
                });

                // ketua tidak boleh jadi anggota
                member.find('option').prop('disabled', false);

                member.find('option[value="' + id + '"]')
                    .prop('selected', false)
                    .prop('disabled', true);

                member.trigger('change.select2');
            }

            // load pertama kali
            loadDetail(ketua.val());


            /*
            =====================================
            KETUA SELECT
            =====================================
            */
            ketua.on('change', function() {

                let id = $(this).val();
                if (!id) return;

                /*
                ---- kalau sudah ketua team lain
                */
                if (ketuaTeams[id] && ketuaTeams[id] != currentTeamId) {

                    Swal.fire({
                        icon: 'warning',
                        title: 'Sudah jadi Ketua',
                        text: 'User ini ketua team lain. Akan dilakukan switch ketua otomatis. Lanjut?',
                        showCancelButton: true
                    }).then(res => {

                        if (res.isConfirmed) loadDetail(id);
                        else ketua.val(null).trigger('change');
                    });

                    return;
                }

                /*
                ---- kalau anggota team lain
                */
                if (memberTeams[id] && memberTeams[id] != currentTeamId) {

                    Swal.fire({
                        icon: 'info',
                        title: 'Sudah jadi Anggota',
                        text: 'User ini anggota team lain. Akan dipindahkan & dijadikan ketua. Lanjut?',
                        showCancelButton: true
                    }).then(res => {

                        if (res.isConfirmed) loadDetail(id);
                        else ketua.val(null).trigger('change');
                    });

                    return;
                }

                loadDetail(id);
            });



            /*
            =====================================
            ANGGOTA SELECT (FIX UTAMA DI SINI)
            =====================================
            */
            member.on('change', function() {

                let selected = $(this).val() || [];

                selected.forEach(id => {

                    /*
                    =============================
                    CASE 1 → DIA KETUA TEAM LAIN
                    =============================
                    */
                    if (ketuaTeams[id] && ketuaTeams[id] != currentTeamId) {

                        Swal.fire({
                            icon: 'warning',
                            title: 'User adalah Ketua Team lain',
                            text: 'Jika dipilih, otomatis turun dari ketua & pindah ke team ini. Lanjutkan?',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal'
                        }).then(res => {

                            if (!res.isConfirmed) {
                                let val = member.val().filter(x => x != id);
                                member.val(val).trigger('change');
                            }
                        });

                        return;
                    }

                    /*
                    =============================
                    CASE 2 → DIA ANGGOTA TEAM LAIN
                    =============================
                    */
                    if (memberTeams[id] && memberTeams[id] != currentTeamId) {

                        Swal.fire({
                            icon: 'warning',
                            title: 'Sudah di Team lain',
                            text: 'User akan dipindahkan ke team ini. Lanjut?',
                            showCancelButton: true
                        }).then(res => {

                            if (!res.isConfirmed) {
                                let val = member.val().filter(x => x != id);
                                member.val(val).trigger('change');
                            }
                        });
                    }

                });

            });

        });
    </script>
@endpush
