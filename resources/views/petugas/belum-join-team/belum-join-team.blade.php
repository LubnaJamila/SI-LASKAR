<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SI-LASKAR Dashboard</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



    <!-- Custom CSS -->
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="dashboard-wrapper">

        <!-- Main Content -->
        <div id="main-content">
            <nav class="navbar">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <!-- USER DROPDOWN (TIDAK AKAN HILANG DI HP) -->
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown user-dropdown">
                            <a class="nav-link dropdown-toggle fw-semibold" style="color: var(--heading-color)"
                                href="#" role="button" data-bs-toggle="dropdown">
                                Selamat Datang Admin
                            </a>

                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bi bi-person me-2"></i>Profil
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    </ul>

                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="content-area">
                <div class="welcome-card">
                    <h1>Selamat Datang Petugas</h1>
                    <p>Saat ini anda belum di daftarkan ke team maka dari itu anda belum bisa akses menu petugas</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
