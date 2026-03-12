<?php

namespace Database\Seeders;

use App\Models\RencanaKunjungan;
use Illuminate\Database\Seeder;

class RencanaKunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Mapping referensi:
     * -------------------------------------------------------
     * User:  2=Fandi, 3=Shohibul Imron, 4=Imron
     *        5=Ida, 6=Ida Ratnawati, 7=Wiwik
     *        8=Lutfi, 9=Wiwik Maimunah, 10=Lutfiah, 11=Suharyadi
     *
     * Team:  1=Team Fandi     (ketua=2, anggota: 3,4)
     *        2=Team Ida       (ketua=6, anggota: 5,7)
     *        3=Team Lutfiah   (ketua=10, anggota: 8)
     *        4=Team Suharyadi (ketua=11, anggota: 9)
     *
     * Periode: 1 = Kunjungan 1 (status: open)
     * -------------------------------------------------------
     */
    public function run(): void
    {
        $periodeId   = 1;
        $tanggal     = '2026-01-05'; // tanggal_mulai periode

        // [hotspot_id, team_id, assigned_by (ketua team)]
        $data = [

            // =============================================
            // TEAM 1 - Team Fandi (ketua: user_id=2)
            // Hotspot milik: Fandi(2), Shohibul Imron(3), Imron(4)
            // =============================================

            // Fandi
            [1,  1, 2],   // Pontang
            [2,  1, 2],   // Watu Ulo
            [3,  1, 2],   // Lojejer
            [4,  1, 2],   // Tanjungrejo
            [5,  1, 2],   // Glundengan
            [6,  1, 2],   // X-Stasiun
            [7,  1, 2],   // Besini
            [8,  1, 2],   // Jerukan/Kasiyan
            [9,  1, 2],   // Jambearum
            [10, 1, 2],   // JLS/Surai
            [11, 1, 2],   // Kaliurang
            [12, 1, 2],   // Rumah Bu Yah
            [13, 1, 2],   // Selogiri
            [14, 1, 2],   // Kos Jubung

            // Shohibul Imron
            [15, 1, 2],   // Ex-lokalisasi Sukoreno
            [16, 1, 2],   // Karaoke GGM
            [17, 1, 2],   // Lesehan Pertigaan Gumukmas
            [18, 1, 2],   // Lesehan Pasar Baru Kencong
            [19, 1, 2],   // Warung Bu Is

            // Imron
            [20, 1, 2],   // Pulo Gantol
            [21, 1, 2],   // Pusri
            [22, 1, 2],   // Pom Bensin
            [23, 1, 2],   // Lesehan Gambirono
            [24, 1, 2],   // Pasar Sapi
            [25, 1, 2],   // Jatian/Karangsono
            [26, 1, 2],   // Lesehan Happy
            [27, 1, 2],   // Lesehan Pak Seno
            [28, 1, 2],   // Lesehan Lojejer
            [29, 1, 2],   // Lesehan Kesilir
            [30, 1, 2],   // Lesehan Glundengan
            [31, 1, 2],   // Lesehan Lapindo
            [32, 1, 2],   // Lesehan Banyuwangi
            [33, 1, 2],   // Lesehan Hotel Ambulu

            // =============================================
            // TEAM 2 - Team Ida (ketua: user_id=6)
            // Hotspot milik: Ida(5), Ida Ratnawati(6), Wiwik(7)
            // =============================================

            // Ida
            [34, 2, 6],   // Lesehan Dira
            [35, 2, 6],   // Lesehan Pasar Balung
            [36, 2, 6],   // Lesehan kaliputih
            [37, 2, 6],   // H2O
            [38, 2, 6],   // Warung Bu Sujud
            [39, 2, 6],   // Warung Stasiun Kota
            [40, 2, 6],   // Warung Kopi Opel
            [41, 2, 6],   // Happy Pappy
            [42, 2, 6],   // Oasis Karauke
            [43, 2, 6],   // Lesehan Kecik
            [44, 2, 6],   // Lesehan Wonorejo
            [45, 2, 6],   // Lesehan Pasar Baru
            [46, 2, 6],   // Lesehan Pertigaan
            [47, 2, 6],   // Lesehan Pasar
            [48, 2, 6],   // karaokean oke
            [49, 2, 6],   // Lesehan Bambu
            [50, 2, 6],   // Café BU Llilik

            // Ida Ratnawati
            [51, 2, 6],   // LESEHAN BULOG KASIAN
            [52, 2, 6],   // KARAOKE TEBUAN TUTUL
            [53, 2, 6],   // LESEHAN PASAR BANGSAL

            // Wiwik
            [54, 2, 6],   // Lesehan alun-alun
            [55, 2, 6],   // Lesehan jatian
            [56, 2, 6],   // Jember Indah Hotel
            [57, 2, 6],   // Beringin Indah Hotel
            [58, 2, 6],   // Hotel kebonagung
            [59, 2, 6],   // kos gang kelinci
            [60, 2, 6],   // warung pecoro

            // Wiwik Maimunah (anggota team 4, tapi datanya masuk team 2 di excel)
            // → karena di DB team_members wiwik.maimunah(user_id=9) masuk team 4
            // Sesuaikan jika memang beda:
            [61, 2, 6],   // WARKOP PECORO

            // =============================================
            // TEAM 3 - Team Lutfiah (ketua: user_id=10)
            // Hotspot milik: Lutfi(8), Lutfiah(10)
            // =============================================

            // Lutfi
            [62, 3, 10],  // Kost Selatan Unmuh
            [63, 3, 10],  // Kos kalimantan
            [64, 3, 10],  // Kost Semeru
            [65, 3, 10],  // Hotel Merdeka  (Kaliwates → id=19)
            [66, 3, 10],  // Hotel Tomiharini
            [67, 3, 10],  // Warung Cak Rudi
            [68, 3, 10],  // kos eksekutif sumatra

            // Lutfiah
            [69, 3, 10],  // KOST PUTRI GANG TERATAI
            [70, 3, 10],  // KOST BELAKANG INDOMARCO
            [71, 3, 10],  // KOST PAK YOYOK
            [72, 3, 10],  // KOSAN EXECUTIVE SUMATRA
            [73, 3, 10],  // LESEHAN KARAOKE PAK RUDI REMBANGAN
            [74, 3, 10],  // LESEHAN TAMANSARI
            [75, 3, 10],  // SAWAHAN BALUNG
            [76, 3, 10],  // KOSAN CILIWUNG
            [77, 3, 10],  // KOSAN PUTRI (JL. MAJAPAHIT)
            [78, 3, 10],  // BU BINA
            [79, 3, 10],  // KOSAN SAMPING UNMUH
            [80, 3, 10],  // KOS TULIP
            [81, 3, 10],  // KOS H. SLAMET
            [82, 3, 10],  // KOST MASTRIP

            // =============================================
            // TEAM 4 - Team Suharyadi (ketua: user_id=11)
            // Hotspot milik: Suharyadi(11), Wiwik Maimunah(9)
            // =============================================

            // Suharyadi
            [83, 4, 11],  // Kost Mastrib
            [84, 4, 11],  // Hotel Aston
            [85, 4, 11],  // Hotel Melati
            [86, 4, 11],  // Kost Belakang Happy Papy
            [87, 4, 11],  // Kost Lumintu
            [88, 4, 11],  // Lesehan Jombang
            [89, 4, 11],  // Star Karauke
            [90, 4, 11],  // Pijat Plus
            [91, 4, 11],  // Hotel Pecoro
            [92, 4, 11],  // Hotel Bintang Utama
            [93, 4, 11],  // Lesehan Klatakan
            [94, 4, 11],  // Azika Karauke
            [95, 4, 11],  // E-Club
            [96, 4, 11],  // Bening Karauke
            [97, 4, 11],  // Lojejer Karauke
            [98, 4, 11],  // GV Karauke
            [99, 4, 11],  // Kosan Biru
            [100, 4, 11], // Hotel Edelwis
            [101, 4, 11], // Karaoke Jenggawah
            [102, 4, 11], // KI CAFE
            [103, 4, 11], // CAFE SINTYA JUBUNG
            [104, 4, 11], // KOS EKSEKUTIF SEMERU
            [105, 4, 11], // CAFE JOGO
            [106, 4, 11], // CAFE KPK
            [107, 4, 11], // TULIP HOME STAY
            [108, 4, 11], // KOS RISKI

            // Hotel Jember Kota (skip di HotspotSeeder tapi sudah masuk via fix manual)
            [109, 2, 6],  // Hotel Anda      → Kaliwates, masuk team Ida/Wiwik
            [110, 2, 6],  // Hotel Nusantara → Kaliwates
            [111, 2, 6],  // Hotel Putra     → Kaliwates
            [112, 3, 10], // Hotel Kemayoran → Sumbersari, masuk team Lutfiah
        ];

        foreach ($data as [$hotspotId, $teamId, $assignedBy]) {
            RencanaKunjungan::firstOrCreate(
                [
                    'hotspot_id' => $hotspotId,
                    'periode_id' => $periodeId,
                ],
                [
                    'team_id'         => $teamId,
                    'assigned_by'     => $assignedBy,
                    'tanggal_rencana' => $tanggal,
                    'status'          => 'direncanakan',
                    'jenis'           => 'normal',
                ]
            );
        }

        $this->command->info('RencanaKunjunganSeeder selesai: ' . count($data) . ' rencana diproses.');
    }
}