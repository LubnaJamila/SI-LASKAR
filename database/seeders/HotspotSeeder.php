<?php

namespace Database\Seeders;

use App\Models\Hotspot;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HotspotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data hotspot: [nama_pl, kecamatan, nama_hotspot, jenis_hotspot, penanggungjawab]
        $data = [
            ['Fandi', 'Ambulu', 'Pontang', 'Wisma', 'Bu Sum'],
            ['Fandi', 'Ambulu', 'Watu Ulo', 'Wisma', 'Bu Yeni'],
            ['Fandi', 'Wuluhan', 'Lojejer', 'Wisma', 'Bu Selo'],
            ['Fandi', 'Wuluhan', 'Tanjungrejo', 'Wisma', 'Bu Gatot'],
            ['Fandi', 'Wuluhan', 'Glundengan', 'Wisma', 'Bu Tris'],
            ['Fandi', 'Balung', 'X-Stasiun', 'Jalan', 'Bu Sutaji'],
            ['Fandi', 'Puger', 'Besini', 'Wisma', 'Bu Johan'],
            ['Fandi', 'Puger', 'Jerukan/Kasiyan', 'Jalanan', 'Bu Eni'],
            ['Fandi', 'Puger', 'Jambearum', 'Wisma', 'Bu Rohim'],
            ['Fandi', 'Puger', 'JLS/Surai', 'Wisma', 'Bu Lipah'],
            ['Fandi', 'Sumbersari', 'Kaliurang', 'Wisma', 'Bu Is'],
            ['Fandi', 'Patrang', 'Rumah Bu yah', 'Wisma', 'Bu Yah'],
            ['Fandi', 'Umbulsari', 'Selogiri', 'Wisma', 'Bu Jumirah'],
            ['Fandi', 'Rambipuji', 'kos jubung', 'Kos', 'P.Jamal'],
            ['Shohibul Imron', 'Umbulsari', 'Ex-lokalisasi Sukoreno', 'Wisma', 'Bu Boiran'],
            ['Shohibul Imron', 'Gumukmas', 'KARAOKE GGM', 'Karaoke', ''],
            ['Shohibul Imron', 'Sumbersari', 'LESEHAN PERTIGAAN GUMUKMAS', 'Lesehan', ''],
            ['Shohibul Imron', 'Kencong', 'LESEHAN PASAR BARU KENCONG', 'Lesehan', ''],
            ['Shohibul Imron', 'Sumbersari', 'WARUNG BU IS', 'Warung', 'BU IS'],
            ['Imron', 'Kencong', 'Pulo Gantol', 'Wisma', 'Bu Bawon'],
            ['Imron', 'Rambipuji', 'Pusri', 'Jalan', 'Bu Rokib'],
            ['Imron', 'Pakusari', 'Pom Bensin', 'Jalan', 'Maklampir'],
            ['Imron', 'Bangsalsari', 'Lesehan Gambirono', 'Jalan', 'Mbah Surip'],
            ['Imron', 'Ambulu', 'Pasar sapi', 'Jalan', 'Bu Suin'],
            ['Imron', 'Puger', 'Jatian/Karangsono', 'Wisma', 'Bu Endang'],
            ['Imron', 'Tanggul', 'Lesehan Happy', 'Jalan', 'Bu sundari'],
            ['Imron', 'Ambulu', 'Lesehan Pak seno', 'Warung', 'Pak Seno'],
            ['Imron', 'Wuluhan', 'Lesehan Lojejer', 'Warung', 'Bu Pipin'],
            ['Imron', 'Wuluhan', 'Lesehan Kesilir', 'Warung', 'Bu Andra'],
            ['Imron', 'Wuluhan', 'Lesehan Glundengan', 'Warung', 'Buyani'],
            ['Imron', 'Wuluhan', 'Lesehan Lapindo', 'Warung', 'Gatot'],
            ['Imron', 'Wuluhan', 'Lesehan Banyuwangi', 'Warung', 'Endang'],
            ['Imron', 'Ambulu', 'Lesehan Hotel Ambulu', 'Warung', 'Bu yeni'],
            ['Ida', 'Ambulu', 'Lesehan Dira', 'Warung', 'Cetim'],
            ['Ida', 'Balung', 'Lesehan Pasar Balung', 'Warung', 'Sumirah'],
            ['Ida', 'Rambipuji', 'Lesehan kaliputih', 'Warung', 'Katib'],
            ['Ida', 'Kaliwates', 'H2O', 'Karaoke', 'Pak Kasdi'],
            ['Ida', 'Kaliwates', 'Warung Bu Sujud', 'Warung', 'Bu Sujud'],
            ['Ida', 'Patrang', 'Warung Stasiun Kota', 'Warung', 'Pak No'],
            ['Ida', 'Patrang', 'Warung Kopi Opel', 'Warung', 'Opel'],
            ['Ida', 'Kaliwates', 'Happy Pappy', 'Karaoke', 'Pak Kasdi'],
            ['Ida', 'Kaliwates', 'Oasis Karauke', 'Warung', 'Pak Kasdi'],
            ['Ida', 'Jombang', 'Lesehan Kecik', 'Warung', 'Bu Eni'],
            ['Ida', 'Kencong', 'Lesehan Wonorejo', 'Warung', 'Katijah'],
            ['Ida', 'Kencong', 'Lesehan Pasar Baru', 'Warung', 'Rukimah'],
            ['Ida', 'Gumukmas', 'Lesehan Pertigaan', 'Warung', 'Susan'],
            ['Ida', 'Bangsalsari', 'Lesehan Pasar', 'Warung', 'Laili'],
            ['Ida', 'Wuluhan', 'karaokean oke', 'Karaoke', 'B.Gatot'],
            ['Ida', 'Puger', 'Lesehan Bambu', 'Warung', 'B.erna'],
            ['Ida', 'Puger', 'Café BU Llilik', 'Kos', 'B.Liik'],
            ['Ida Ratnawati', 'Puger', 'LESEHAN BULOG KASIAN', 'Lesehan', ''],
            ['Ida Ratnawati', 'Balung', 'KARAOKE TEBUAN TUTUL', 'Karaoke', ''],
            ['Ida Ratnawati', 'Bangsalsari', 'LESEHAN PASAR BANGSAL', 'Lesehan', ''],
            ['Wiwik', 'Tanggul', 'Lesehan alun-alun', 'Warung', 'Erwin'],
            ['Wiwik', 'Sukorambi', 'Lesehan jatian', 'Warung', 'Subur'],
            ['Wiwik', 'Sukorambi', 'Jember Indah Hotel', 'Warung', 'Pak Teguh'],
            ['Wiwik', 'Ajung', 'Beringin Indah Hotel', 'Hotel', 'Pak Teguh'],
            ['Wiwik', 'Kaliwates', 'Hotel Anda', 'Hotel', 'Pak Teguh'],
            ['Wiwik', 'Kaliwates', 'Hotel Nusantara', 'Hotel', 'Pak Teguh'],
            ['Wiwik', 'Kaliwates', 'Hotel Putra', 'Hotel', 'Pak Teguh'],
            ['Wiwik', 'Patrang', 'Hotel kebonagung', 'Hotel', 'Pak Teguh'],
            ['Wiwik', 'Sumbersari', 'kos gang kelinci', 'Kost', 'angel'],
            ['Wiwik', 'Rambipuji', 'warung pecoro', 'Warung', 'pak mahdi'],
            ['Wiwik Maimunah', 'Rambipuji', 'WARKOP PECORO', 'Warung', ''],
            ['Lutfi', 'Sumbersari', 'Kost Selatan Unmuh', 'Kost', 'Lilik'],
            ['Lutfi', 'Sumbersari', 'Kos kalimantan', 'Kost', 'Edi'],
            ['Lutfi', 'Sumbersari', 'Kost Semeru', 'Kost', 'Gopong'],
            ['Lutfi', 'Kaliwates', 'Hotel Merdeka', 'Hotel', 'Pak Teguh'],
            ['Lutfi', 'Sukorambi', 'Hotel Tomiharini', 'Hotel', 'Pak Teguh'],
            ['Lutfi', 'Sumbersari', 'Hotel Kemayoran', 'Hotel', 'Pak Teguh'],
            ['Lutfi', 'Patrang', 'Warung Cak Rudi', 'Warung', 'P. Rudi'],
            ['Lutfi', 'Sumbersari', 'kos eksekutif sumatra', 'Kost', 'andi'],
            ['Lutfiah', 'Sumbersari', 'KOST PUTRI GANG TERATAI', 'Kos', ''],
            ['Lutfiah', 'Sumbersari', 'KOST BELAKANG INDOMARCO', 'Kos', ''],
            ['Lutfiah', 'Sumbersari', 'KOST PAK YOYOK', 'Kos', 'P. YOYOK'],
            ['Lutfiah', 'Sumbersari', 'KOSAN EXECUTIVE SUMATRA', 'Kos', ''],
            ['Lutfiah', 'Patrang', 'LESEHAN KARAOKE PAK RUDI REMBANGAN', 'Lesehan', 'P. RUDI'],
            ['Lutfiah', 'Balung', 'LESEHAN TAMANSARI', 'Lesehan', ''],
            ['Lutfiah', 'Balung', 'SAWAHAN BALUNG', 'Sawah', ''],
            ['Lutfiah', 'Patrang', 'KOSAN CILIWUNG', 'Kos', ''],
            ['Lutfiah', 'Kaliwates', 'KOSAN PUTRI (JL. MAJAPAHIT)', 'Kos', ''],
            ['Lutfiah', 'Sumbersari', 'BU BINA', 'Warung', 'BU BINA'],
            ['Lutfiah', 'Kaliwates', 'KOSAN SAMPING UNMUH', 'Kos', ''],
            ['Lutfiah', 'Kaliwates', 'KOS TULIP', 'Kos', ''],
            ['Lutfiah', 'Kaliwates', 'KOS H. SLAMET', 'Kos', 'P. SLAMET'],
            ['Lutfiah', 'Sumbersari', 'KOST MASTRIP', 'Kos', ''],
            ['Suharyadi', 'Sumbersari', 'Kost Mastrib', 'Kost', 'Sandi'],
            ['Suharyadi', 'Kaliwates', 'Hotel Aston', 'Kost', 'Bu Mery'],
            ['Suharyadi', 'Rambipuji', 'Hotel Melati', 'Hotel', 'pak Teguh'],
            ['Suharyadi', 'Kaliwates', 'Kost Belakang Happy Papy', 'Kost', 'Bu Rita'],
            ['Suharyadi', 'Kaliwates', 'Kost Lumintu', 'Kost', 'Bu Dadang'],
            ['Suharyadi', 'Jombang', 'Lesehan Jombang', 'Warung', 'Anik'],
            ['Suharyadi', 'Kaliwates', 'Star Karauke', 'Karaoke', 'Pak Kasdi'],
            ['Suharyadi', 'Sukorambi', 'Pijat Plus', 'Panti Pijat', 'Pak Kasdi'],
            ['Suharyadi', 'Sukorambi', 'Hotel Pecoro', 'Hotel', 'Pak Teguh'],
            ['Suharyadi', 'Bangsalsari', 'Hotel Bintang Utama', 'Hotel', 'Pak Teguh'],
            ['Suharyadi', 'Bangsalsari', 'Lesehan Klatakan', 'Warung', 'Joni'],
            ['Suharyadi', 'Gumukmas', 'Azika Karauke', 'Hotel', 'Lahim'],
            ['Suharyadi', 'Panti', 'E-Club', 'Diskotik', ''],
            ['Suharyadi', 'Ambulu', 'Bening Karauke', 'Karaoke', 'Edi Mistari'],
            ['Suharyadi', 'Wuluhan', 'Lojejer Karauke', 'Karaoke', ''],
            ['Suharyadi', 'Kaliwates', 'GV Karauke', 'Karaoke', 'Dewi Jos'],
            ['Suharyadi', 'Kaliwates', 'Kosan Biru', 'Kos-kosan', ''],
            ['Suharyadi', 'Ambulu', 'Hotel Edelwis', 'Hotel', ''],
            ['Suharyadi', 'Jenggawah', 'Karaoke Jenggawah', 'Karaoke', 'P. Eko'],
            ['Suharyadi', 'Kaliwates', 'KI CAFE', 'Café', ''],
            ['Suharyadi', 'Sukorambi', 'CAFE SINTYA JUBUNG', 'Café', 'SINTYA'],
            ['Suharyadi', 'Sumbersari', 'KOS EKSEKUTIF SEMERU', 'Kos', ''],
            ['Suharyadi', 'Kaliwates', 'CAFE JOGO', 'Café', 'herda'],
            ['Suharyadi', 'Sumbersari', 'CAFE KPK', 'Café', 'herda'],
            ['Suharyadi', 'Kaliwates', 'TULIP HOME STAY', 'Homestay', ''],
            ['Suharyadi', 'Kaliwates', 'KOS RISKI', 'Kos', 'RISKI'],
        ];

        foreach ($data as [$namaPl, $namaKecamatan, $namaHotspot, $jenisHotspot, $penanggungjawab]) {
            // Cari user berdasarkan nama
            $email = Str::slug($namaPl, '.') . '@laskar.test';
            $user = User::where('email', $email)->first();

            if (! $user) {
                $this->command->warn("User tidak ditemukan: {$namaPl} ({$email}), skip hotspot: {$namaHotspot}");
                continue;
            }

            // Cari kecamatan_id berdasarkan nama
            $kecamatan = DB::table('kecamatan')
                ->whereRaw('LOWER(nama_kecamatan) = ?', [strtolower($namaKecamatan)])
                ->first();

            if (! $kecamatan) {
                $this->command->warn("Kecamatan tidak ditemukan: {$namaKecamatan}, skip hotspot: {$namaHotspot}");
                continue;
            }

            // Cari team_id milik user
            $teamId = DB::table('team_members')
                ->where('user_id', $user->id)
                ->value('team_id')
                ?? DB::table('teams')
                    ->where('ketua_id', $user->id)
                    ->value('id');

            // Ambil kontak dari user jika penanggungjawab kosong
            $penanggungjawabFinal = $penanggungjawab ?: '-';

            Hotspot::firstOrCreate(
                [
                    'nama_hotspot'  => $namaHotspot,
                    'kecamatan_id'  => $kecamatan->id,
                ],
                [
                    'jenis_hotspot'           => $jenisHotspot,
                    'jenis_populasi'          => 'wps',
                    'penanggungjawab'         => $penanggungjawabFinal,
                    'kontak_penanggungjawab'  => 0,
                    'status'                  => 'aktif',
                    'team_id'                 => $teamId,
                    'created_by'              => $user->id,
                ]
            );
        }

        $this->command->info('HotspotSeeder selesai: ' . count($data) . ' hotspot diproses.');
    }
}