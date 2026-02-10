<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>SI-LASKAR</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('assets/img/logo-si_laskar.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Jost:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- =======================================================
  * Template Name: Arsha
  * Template URL: https://bootstrapmade.com/arsha-free-bootstrap-html-template-corporate/
  * Updated: Feb 22 2025 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="index.html" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('assets/img/logo-si_laskar.png') }}" alt="">
                <h1 class="sitename">SI-LASKAR</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Beranda</a></li>
                    <li><a href="#about">Tentang</a></li>
                    <li><a href="#services">Layanan</a></li>
                    <li><a href="#portfolio">Galery</a></li>
                    <li><a href="#team">Team</a></li>
                    <li><a href="#contact">Peta</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="btn-getstarted" href="{{ route('login') }}">Masuk</a>

        </div>
    </header>

    <main class="main">

        <!-- Beranda Section -->
        <section id="hero" class="hero section dark-background">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center"
                        data-aos="zoom-out">
                        <h1>Pemetaan Potensi HIV di Kabupaten Jember</h1>
                        <p>Temukan informasi sebaran WPS dan LSL berbasis peta interaktif. Data ini membantu dalam
                            analisis potensi HIV untuk meningkatkan kesadaran dan pencegahan.</p>
                        <div class="d-flex">
                            <a href="#about" class="btn-get-started"><i class="bi bi-geo-alt-fill me-2"></i>Lihat Peta
                                Interaktif</a>
                        </div>
                    </div>
                    <div class="col-lg-6 order-1 order-lg-2 hero-img" data-aos="zoom-out" data-aos-delay="200">
                        <img src="{{ asset('assets/img/hero-home.png') }}" class="img-fluid animated" alt="">
                    </div>
                </div>
            </div>

        </section><!-- /Beranda Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Kami</h2>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
                        <p>
                            LASKAR JEMBER (Langkah Sehat dan Berkarya) merupakan Pusat Layanan Kesehatan Masyarakat
                            Kabupaten Jember yang berada di bawah naungan Yayasan LASKAR.

                            Yayasan LASKAR adalah lembaga yang memiliki kompetensi dan menjadi mitra terpercaya dalam
                            pelayanan kesehatan masyarakat. Wilayah kerja yayasan ini meliputi seluruh Karesidenan
                            Besuki, yaitu:
                        </p>
                        <div class="row">
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check2-circle"></i> Kabupaten Jember</li>
                                    <li><i class="bi bi-check2-circle"></i> Kabupaten Banyuwangi</li>
                                    <li><i class="bi bi-check2-circle"></i> Kabupaten Bondowoso</li>
                                </ul>
                            </div>
                            <div class="col-6">
                                <ul class="list-unstyled">
                                    <li><i class="bi bi-check2-circle"></i> Kabupaten Situbondo</li>
                                    <li><i class="bi bi-check2-circle"></i> Kabupaten Lumajang</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <p>Seiring perkembangan isu kesehatan, Yayasan LASKAR juga berperan aktif dalam upaya
                            pencegahan
                            dan pengendalian HIV/AIDS melalui pendekatan kesehatan masyarakat yang berbasis data dan
                            teknologi, termasuk dengan menghadirkan pemetaan potensi HIV untuk mendukung edukasi,
                            monitoring, dan pengambilan keputusan.</p>
                    </div>

                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Why Us Section -->
        <section id="why-us" class="section why-us light-background" data-builder="section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>VISI & MISI</h2>
                <p>Mengungkapkan tujuan dan arah strategis Yayasan LASKAR dalam meningkatkan kesehatan masyarakat.</p>
            </div><!-- End Section Title -->

            <div class="container-fluid">

                <div class="row gy-4">

                    <div class="col-lg-7 d-flex flex-column justify-content-center order-2 order-lg-1">

                        <div class="content px-xl-5" data-aos="fade-up" data-aos-delay="100">
                            <h3><strong>VISI</strong></h3>
                            <p>
                                Meningkatkan derajat kesehatan masyarakat dengan pendekatan ilmu kesehatan masyarakat
                                yang komprehensif dan berbasis data.
                        </div>

                        <div class="faq-container px-xl-5" data-aos="fade-up" data-aos-delay="200">

                            <h3><strong>MISI</strong></h3>

                            <div class="faq-item faq-active">

                                <h3><span>01</span> Program Kesehatan Masyarakat Komprehensif</h3>
                                <div class="faq-content">
                                    <p>Menyelenggarakan program kesehatan masyarakat secara komprehensif dengan
                                        pendekatan 7 bidang ilmu kesehatan masyarakat: Epidemiologi, Promosi Kesehatan &
                                        Ilmu Perilaku (PKIP), Administrasi & Kebijakan Kesehatan (AKK), Kesehatan
                                        Lingkungan & Keselamatan Kerja, Gizi Masyarakat, Biostatistik, dan Kependudukan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span>02</span> Penelitian dan Pengabdian Masyarakat
                                </h3>
                                <div class="faq-content">
                                    <p>Melaksanakan penelitian dan pengabdian kepada masyarakat, khususnya dalam bidang
                                        kesehatan masyarakat dan isu-isu prioritas seperti HIV/AIDS.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3><span>03</span> Jaringan Kerjasama Stakeholder</h3>
                                <div class="faq-content">
                                    <p>Membina serta mengembangkan jaringan kerjasama dengan stakeholder dan lembaga
                                        terkait untuk mendukung program kesehatan masyarakat.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>

                            <div class="faq-item">
                                <h3><span>04</span> Capacity Building Lembaga</h3>
                                <div class="faq-content">
                                    <p>Meningkatkan capacity building lembaga dalam rangka mengoptimalkan pelaksanaan
                                        program kesehatan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div>

                            <div class="faq-item">
                                <h3><span>05</span> Pemberdayaan Masyarakat</h3>
                                <div class="faq-content">
                                    <p>Memberdayakan masyarakat agar lebih aktif dalam pencegahan penyakit, peningkatan
                                        kesehatan, dan penanggulangan HIV/AIDS.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>

                    <div class="col-lg-5 order-1 order-lg-2 why-us-img">
                        <div id="visiMisiCarousel" class="carousel slide" data-bs-ride="carousel"
                            data-bs-interval="3000">
                            <!-- Indicators/dots -->
                            <div class="carousel-indicators">
                                <button type="button" data-bs-target="#visiMisiCarousel" data-bs-slide-to="0"
                                    class="active" aria-current="true" aria-label="Slide 1"></button>
                                <button type="button" data-bs-target="#visiMisiCarousel" data-bs-slide-to="1"
                                    aria-label="Slide 2"></button>
                                <button type="button" data-bs-target="#visiMisiCarousel" data-bs-slide-to="2"
                                    aria-label="Slide 3"></button>
                                <button type="button" data-bs-target="#visiMisiCarousel" data-bs-slide-to="3"
                                    aria-label="Slide 4"></button>
                                <button type="button" data-bs-target="#visiMisiCarousel" data-bs-slide-to="4"
                                    aria-label="Slide 5"></button>
                            </div>

                            <!-- Carousel Inner / Slides -->
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}"
                                        class="d-block w-100" alt="Gambar 1" data-aos="zoom-in"
                                        data-aos-delay="100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/portfolio/portfolio-3.webp') }}"
                                        class="d-block w-100" alt="Gambar 2" data-aos="zoom-in"
                                        data-aos-delay="100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}"
                                        class="d-block w-100" alt="Gambar 3" data-aos="zoom-in"
                                        data-aos-delay="100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}"
                                        class="d-block w-100" alt="Gambar 4" data-aos="zoom-in"
                                        data-aos-delay="100">
                                </div>
                                <div class="carousel-item">
                                    <img src="{{ asset('assets/img/portfolio/portfolio-8.webp') }}"
                                        class="d-block w-100" alt="Gambar 5" data-aos="zoom-in"
                                        data-aos-delay="100">
                                </div>
                            </div>

                            <!-- Optional Controls (bisa dihapus kalau mau otomatis tanpa klik) -->

                            <button class="carousel-control-prev" type="button" data-bs-target="#visiMisiCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#visiMisiCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>

                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /Why Us Section -->


        <!-- Services Section -->
        <section id="services" class="services section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>LAYANAN KAMI</h2>
                <p>Layanan kami mencakup berbagai program kesehatan yang komprehensif dan berbasis data.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fa-solid fa-map-location-dot"></i></i></i></div>
                            <h4><a href="" class="stretched-link">Peta Potensi Interaktif</a></h4>
                            <p>Menampilkan peta interaktif yang memperlihatkan distribusi potensi HIV berdasarkan
                                wilayah dengan kategori WPS (Wanita Pekerja Seks) dan LSL (Lelaki Seks Lelaki).</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fa-solid fa-chart-simple"></i></div>
                            <h4><a href="" class="stretched-link">Statistik dan Analisis Data</a></h4>
                            <p>Memberikan data berupa grafik, tabel, atau angka persentase terkait jumlah kasus, tren
                                pertumbuhan, serta faktor risiko di tiap wilayah.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fa-solid fa-book-open-reader"></i></i></div>
                            <h4><a href="" class="stretched-link">Edukasi dan Informasi</a></h4>
                            <p>Menyediakan artikel, infografis, dan informasi kesehatan seputar pencegahan HIV dan cara
                                hidup sehat.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="fa-solid fa-handshake-angle"></i></div>
                            <h4><a href="" class="stretched-link">Akses Sumber Daya & Bantuan</a></h4>
                            <p>Informasi kontak lembaga, puskesmas, LSM, atau komunitas yang bisa membantu masyarakat
                                dalam pemeriksaan dan konseling.</p>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

        <!-- Portfolio Section -->
        <section id="portfolio" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Portfolio</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->


            <div class="container">
                <div class="row gy-4" data-aos="fade-up" data-aos-delay="100">


                    <!-- Portfolio Items -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-1.webp') }}"
                                class="img-fluid" alt="App 1">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-1.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}" class="img-fluid"
                                alt="Product 1">
                            <div class="portfolio-info">
                                <h4>Product 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-3.webp') }}" class="img-fluid"
                                alt="Branding 1">
                            <div class="portfolio-info">
                                <h4>Branding 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-3.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}" class="img-fluid"
                                alt="App 2">
                            <div class="portfolio-info">
                                <h4>App 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-2.webp') }}"
                                class="img-fluid" alt="Product 2">
                            <div class="portfolio-info">
                                <h4>Product 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-2.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-3.webp') }}"
                                class="img-fluid" alt="Branding 2">
                            <div class="portfolio-info">
                                <h4>Branding 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-3.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 7 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}" class="img-fluid"
                                alt="App 3">
                            <div class="portfolio-info">
                                <h4>App 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 8 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-8.webp') }}" class="img-fluid"
                                alt="Product 3">
                            <div class="portfolio-info">
                                <h4>Product 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-8.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 9 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-9.webp') }}" class="img-fluid"
                                alt="Branding 3">
                            <div class="portfolio-info">
                                <h4>Branding 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-9.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Portfolio Items -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-1.webp') }}"
                                class="img-fluid" alt="App 1">
                            <div class="portfolio-info">
                                <h4>App 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-1.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}" class="img-fluid"
                                alt="Product 1">
                            <div class="portfolio-info">
                                <h4>Product 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-1.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-3.webp') }}" class="img-fluid"
                                alt="Branding 1">
                            <div class="portfolio-info">
                                <h4>Branding 1</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-3.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}" class="img-fluid"
                                alt="App 2">
                            <div class="portfolio-info">
                                <h4>App 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-4.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 5 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-2.webp') }}"
                                class="img-fluid" alt="Product 2">
                            <div class="portfolio-info">
                                <h4>Product 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-2.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 6 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-portrait-3.webp') }}"
                                class="img-fluid" alt="Branding 2">
                            <div class="portfolio-info">
                                <h4>Branding 2</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-portrait-3.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 7 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}" class="img-fluid"
                                alt="App 3">
                            <div class="portfolio-info">
                                <h4>App 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-7.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 8 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-8.webp') }}" class="img-fluid"
                                alt="Product 3">
                            <div class="portfolio-info">
                                <h4>Product 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-8.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Item 9 -->
                    <div class="col-lg-4 col-md-6">
                        <div class="portfolio-item">
                            <img src="{{ asset('assets/img/portfolio/portfolio-9.webp') }}" class="img-fluid"
                                alt="Branding 3">
                            <div class="portfolio-info">
                                <h4>Branding 3</h4>
                                <p>Lorem ipsum, dolor sit</p>
                                <a href="javascript:void(0);" class="preview-popup"
                                    data-src="{{ asset('assets/img/portfolio/portfolio-9.webp') }}">
                                    <i class="bi bi-zoom-in"></i>
                                </a>
                                <a href="portfolio-details.html" class="details-link">
                                    <i class="bi bi-link-45deg"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="pagination d-flex justify-content-center mt-4">
                        <button id="prevBtn" class="btn btn-outline-primary me-2">Prev</button>
                        <button id="nextBtn" class="btn btn-outline-primary">Next</button>
                    </div>

                </div>
            </div>
        </section>



        <!-- Modal Popup -->
        <div id="imageModal" class="popup-modal">
            <div class="popup-dialog">
                <div class="popup-header">
                    <h3>Preview Gambar</h3>
                    <span class="close-modal">&times;</span>
                </div>
                <div class="popup-body">
                    <img id="popupImage" alt="Preview" class="popup-content">
                </div>
            </div>
        </div>
        </div>



        <!-- Team Section -->
        <section id="team" class="team section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Team</h2>
                <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets/img/person/person-m-7.webp') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Walter White</h4>
                                <span>Chief Executive Officer</span>
                                <p>Explicabo voluptatem mollitia et repellat qui dolorum quasi</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""> <i class="bi bi-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets/img/person/person-f-8.webp') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Sarah Jhonson</h4>
                                <span>Product Manager</span>
                                <p>Aut maiores voluptates amet et quis praesentium qui senda para</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""> <i class="bi bi-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets/img/person/person-m-6.webp') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>William Anderson</h4>
                                <span>CTO</span>
                                <p>Quisquam facilis cum velit laborum corrupti fuga rerum quia</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""> <i class="bi bi-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="team-member d-flex align-items-start">
                            <div class="pic"><img src="{{ asset('assets/img/person/person-f-4.webp') }}"
                                    class="img-fluid" alt=""></div>
                            <div class="member-info">
                                <h4>Amanda Jepson</h4>
                                <span>Accountant</span>
                                <p>Dolorum tempora officiis odit laborum officiis et et accusamus</p>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""> <i class="bi bi-linkedin"></i> </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Team Section -->


        <!-- Faq 2 Section -->
        <section id="faq-2" class="faq-2 section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Frequently Asked Questions</h2>
                <p>FAQ ini berisi pertanyaan umum seputar WebGIS Pemetaan Potensi Penyebaran HIV,
                    mulai dari penjelasan apa itu sistem ini, manfaat pemetaan, sumber data,
                    hingga cara menggunakan peta interaktif serta akses layanan bantuan.</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10">

                        <div class="faq-container">

                            <div class="faq-item faq-active" data-aos="fade-up" data-aos-delay="200">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apa itu WebGIS Pemetaan Potensi HIV?</h3>
                                <div class="faq-content">
                                    <p>WebGIS Pemetaan Potensi HIV adalah sistem informasi geografis berbasis web yang
                                        digunakan untuk memetakan potensi penyebaran HIV berdasarkan persebaran WPS
                                        (Wanita Pekerja Seks) dan LSL (Lelaki Seks Lelaki). Sistem ini menyajikan
                                        informasi dalam bentuk peta polygon interaktif agar lebih mudah dipahami.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Mengapa pemetaan HIV penting?</h3>
                                <div class="faq-content">
                                    <p>Pemetaan HIV membantu pemerintah, lembaga kesehatan, dan masyarakat dalam
                                        memahami distribusi risiko, menentukan prioritas intervensi, serta memperkuat
                                        upaya pencegahan penyebaran HIV di Kabupaten Jember.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Data yang ditampilkan dalam peta berasal dari mana?</h3>
                                <div class="faq-content">
                                    <p>Data yang digunakan dalam WebGIS diperoleh dari hasil survei lapangan, laporan
                                        lembaga kesehatan, serta sumber resmi yang telah terverifikasi. Dengan demikian,
                                        data yang ditampilkan dapat dipertanggungjawabkan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="500">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apa yang dimaksud dengan kategori WPS dan LSL dalam peta?</h3>
                                <div class="faq-content">
                                    <ul>
                                        <li>
                                            WPS (Wanita Pekerja Seks): kelompok perempuan yang bekerja di sektor
                                            pekerjaan seks.
                                        </li>
                                        <li>LSL (Lelaki Seks Lelaki): kelompok laki-laki yang melakukan hubungan seksual
                                            dengan sesama laki-laki.
                                            Kategori ini ditampilkan sebagai bagian dari analisis epidemiologi untuk
                                            memahami kelompok risiko tanpa menyebut identitas individu.</li>
                                    </ul>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="600">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Bagaimana cara menggunakan peta interaktif?</h3>
                                <div class="faq-content">
                                    <ol>
                                        <li>
                                            Klik pada menu peta.
                                        </li>
                                        <li>
                                            Lihat pada peta polygon potensi penyebaran dapat dibedakan berdasarkan
                                            warna.
                                        </li>
                                        <li>Klik pada suatu daerah pada peta polygon maka akan menampilkan detail
                                            informasi persebaran dalam bentuk pop up</li>
                                    </ol>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>Apakah data di peta ini bersifat real-time?</h3>
                                <div class="faq-content">
                                    <p>Tidak secara real-time, namun data diperbarui secara berkala sesuai dengan hasil
                                        survei terbaru dan laporan lembaga terkait.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                                <i class="faq-icon bi bi-question-circle"></i>
                                <h3>
                                    Bagaimana menjaga kerahasiaan dan etika data pada peta ini?</h3>
                                <div class="faq-content">
                                    <p>Data yang ditampilkan bersifat agregat (bukan data individu), sehingga privasi
                                        dan kerahasiaan tetap terjaga. Informasi hanya digunakan untuk kepentingan
                                        penelitian, kesehatan, dan pencegahan.
                                    </p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div>

                </div>

            </div>

        </section><!-- /Faq 2 Section -->


        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Peta Administrasi</h2>
                <p>Visualisasi potensi penyebaran HIV berdasarkan persebarang WPS dan LSL berdasarkan data per kecamatan
                </p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-12">

                        <div class="info-wrap">
                            <div id="map"></div>
                        </div>
                    </div>

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">



        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SI-LASKAR</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Krajan, Petung, Kec. Bangsalsari, Kabupaten Jember</p>
                        <p>Jawa Timur 68154</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>0852-3439-9994</span></p>
                        <p><strong>Email:</strong> <span>laskarpelangipetung@gmail.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">SI-LASKAR</strong> <span>All Rights
                    Reserved</span></p>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/waypoints/noframework.waypoints.js') }}"></script>
    <script src="{{ asset('assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
