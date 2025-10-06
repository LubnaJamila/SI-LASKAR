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
    <style>
        /* Fonts */
        :root {
            --default-font: "Open Sans", sans-serif;
            --heading-font: "Jost", sans-serif;
            --nav-font: "Poppins", sans-serif;

            /* Colors (Color Hunt Palette) */
            --background-color: #ffffff;
            /* putih untuk main background */
            --default-color: #444444;
            /* teks abu */
            --heading-color: #7d0a0a;
            /* sidebar merah tua */
            --accent-color: #bf3131;
            /* garis accent merah terang */
            --surface-color: #ead196;
            /* menu aktif = krem */
            --contrast-color: #ffffff;
            /* teks putih */

            --sidebar-width: 240px;
            --sidebar-collapsed: 70px;
        }

        /* Reset */
        body {
            margin: 0;
            font-family: var(--default-font);
            background: var(--background-color);
            color: var(--default-color);
            overflow-x: hidden;
        }

        /* Dashboard Layout */
        .dashboard-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar dengan lengkungan */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: linear-gradient(180deg, var(--heading-color) 0%, #5a0606 100%);
            transition: all 0.3s ease;
            position: relative;
            z-index: 1000;
            border-radius: 0 20px 0px 0;
        }

        /* Lengkungan di sisi kanan sidebar */
        /* #sidebar::after {
      content: '';
      position: absolute;
      top: 0;
      right: -15px;
      width: 30px;
      height: 100%;
      background: var(--heading-color);
      border-radius: 0 20px 20px 0;
      z-index: -1;
    } */

        #sidebar.collapsed {
            width: var(--sidebar-collapsed);
        }

        #sidebar.collapsed::after {
            right: -10px;
            width: 20px;
            border-radius: 0 15px 15px 0;
        }

        .sidebar-header {
            display: flex;
            align-items: center;
            padding: 20px 15px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 12px;
            transition: all 0.3s ease;

            background-color: var(--contrast-color);
            /* warna krem */
            padding: 5px;
            /* kasih jarak biar background kelihatan */
            box-sizing: content-box;
            /* supaya padding nambah ke luar gambar */
        }

        #sidebar.collapsed .sidebar-header img {
            margin-right: 0;
        }

        .sidebar-header h5 {
            font-family: var(--heading-font);
            font-size: 20px;
            font-weight: 700;
            color: var(--contrast-color);
            margin: 0;
            transition: all 0.3s ease;
            white-space: nowrap;
            overflow: hidden;
        }

        #sidebar.collapsed .sidebar-header h5 {
            opacity: 0;
            width: 0;
        }

        .nav {
            padding: 15px 0;
        }

        .nav-link {
            font-family: var(--nav-font);
            font-size: 15px;
            color: var(--contrast-color);
            padding: 14px 15px;
            margin: 5px 15px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link i {
            font-size: 18px;
            margin-right: 12px;
            min-width: 24px;
            text-align: center;
            transition: all 0.3s ease;
        }

        #sidebar.collapsed .nav-link span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: var(--surface-color);
            color: var(--heading-color);
            font-weight: 600;
            transform: translateX(5px);
        }

        .nav-link.active {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        /* Main Content Area */
        #main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            transition: all 0.3s ease;
            background: var(--background-color);
        }

        /* Header */
        .navbar {
            font-family: var(--nav-font);
            background: var(--background-color);
            border-bottom: 2px solid var(--accent-color);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
        }

        .hamburger-btn {
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--heading-color);
            cursor: pointer;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .hamburger-btn:hover {
            background-color: rgba(125, 10, 10, 0.1);
        }

        .navbar .nav-link {
            color: var(--default-color);
            padding: 8px 15px;
        }

        .navbar .nav-link:hover {
            color: var(--accent-color);
        }

        .user-dropdown .dropdown-toggle {
            color: var(--default-color);
            font-weight: 600;
        }

        .user-dropdown .dropdown-toggle::after {
            margin-left: 8px;
        }

        /* Content Area */
        .content-area {
            flex: 1;
            padding: 30px;
            background: #f8f9fa;
        }

        .welcome-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
            border-left: 5px solid var(--accent-color);
        }

        .welcome-card h1 {
            color: var(--heading-color);
            font-family: var(--heading-font);
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .welcome-card p {
            color: var(--default-color);
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 3rem;
            font-weight: 700;
            color: var(--heading-color);
            margin-bottom: 10px;
            font-family: var(--heading-font);
        }

        .stat-label {
            color: var(--default-color);
            font-size: 1rem;
            font-weight: 600;
        }

        .main-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .main-card h3 {
            color: var(--heading-color);
            font-family: var(--heading-font);
            margin-bottom: 20px;
            font-size: 1.5rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            #sidebar {
                position: fixed;
                left: -240px;
                z-index: 1050;
            }

            #sidebar.mobile-open {
                left: 0;
            }

            .mobile-overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }

            #sidebar.mobile-open~.mobile-overlay {
                display: block;
            }

            .content-area {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-wrapper">

        <!-- Sidebar -->
        <div id="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('assets/img/logo-si_laskar.png') }}" alt="Logo">
                <h5>SI-LASKAR</h5>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="#" class="nav-link active">
                        <i class="bi bi-grid"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-people"></i> <span>Pengguna</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-file-text"></i> <span>Laporan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="bi bi-gear"></i> <span>Pengaturan</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div id="main-content">

            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg">
                <div class="container-fluid">
                    <button class="hamburger-btn" id="menu-toggle">
                        <i class="bi bi-list-nested"></i>
                    </button>

                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link fw-semibold" href="#">Dashboard</a>
                            </li>
                        </ul>
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown user-dropdown">
                                <a class="nav-link dropdown-toggle fw-semibold" href="#" role="button"
                                    data-bs-toggle="dropdown">
                                    Selamat Datang Admin
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-person me-2"></i>Profil</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#"><i
                                                class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content Area -->
            <div class="content-area">
                <div class="welcome-card">
                    <h1>Selamat Datang Admin</h1>
                    <p>Selamat datang di dashboard SI-LASKAR.</p>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-number">88</div>
                        <div class="stat-label">Total Pengguna</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">42</div>
                        <div class="stat-label">Aktif Hari Ini</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">15</div>
                        <div class="stat-label">Menunggu Verifikasi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number">7</div>
                        <div class="stat-label">Laporan Baru</div>
                    </div>
                </div>

                <div class="main-card">
                    <h3>Dashboard</h3>
                    <p>Konten dashboard akan ditampilkan di sini. Anda dapat menambahkan grafik, tabel, atau informasi
                        penting lainnya.</p>
                </div>
            </div>
        </div>

        <!-- Mobile Overlay -->
        <div class="mobile-overlay"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const menuToggle = document.getElementById("menu-toggle");
            const sidebar = document.getElementById("sidebar");
            const mobileOverlay = document.querySelector(".mobile-overlay");

            // Toggle sidebar pada semua ukuran layar
            menuToggle.addEventListener("click", function() {
                if (window.innerWidth >= 768) {
                    // Desktop: toggle collapsed state
                    sidebar.classList.toggle("collapsed");
                } else {
                    // Mobile: toggle sidebar visibility
                    sidebar.classList.toggle("mobile-open");
                }
            });

            // Tutup sidebar mobile saat overlay diklik
            mobileOverlay.addEventListener("click", function() {
                sidebar.classList.remove("mobile-open");
            });

            // Responsif saat resize window
            window.addEventListener("resize", function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove("mobile-open");
                } else {
                    sidebar.classList.remove("collapsed");
                }
            });
        });
    </script>
</body>

</html>
