@extends('templates.app')

@section('title', 'Dashboard')

@section('content')
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
        <p>Konten dashboard akan ditampilkan di sini. Anda dapat menambahkan grafik, tabel, atau informasi penting lainnya.</p>
    </div>
@endsection
