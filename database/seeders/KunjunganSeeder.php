<?php

namespace Database\Seeders;

use App\Models\KlasteringAgregatWPS;
use App\Models\Kunjungan;
use App\Models\RencanaKunjungan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KunjunganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Kolom array: [nama_hotspot, team_id, created_by, gatekeeper,
     *               jumlah_dijangkau, jumlah_tes, jumlah_positif]
     *
     * Mapping user:
     *   2=Fandi, 3=Shohibul Imron, 4=Imron
     *   5=Ida, 6=Ida Ratnawati, 7=Wiwik
     *   8=Lutfi, 9=Wiwik Maimunah, 10=Lutfiah, 11=Suharyadi
     *
     * Mapping team:
     *   1=Team Fandi, 2=Team Ida, 3=Team Lutfiah, 4=Team Suharyadi
     */
    public function run(): void
    {
        $periodeId = 1;

        // [nama_hotspot, team_id, created_by, gatekeeper, dijangkau, tes, positif]
        $data = [
            // ── TEAM 1 : Team Fandi ──────────────────────────────
            ['Pontang',                              1,  2,  'Bu Sum',     2,   2,  0],
            ['Watu Ulo',                             1,  2,  'Bu Yeni',    15,  11, 2],
            ['Lojejer',                              1,  2,  'Bu Selo',    40,  35, 4],
            ['Tanjungrejo',                          1,  2,  'Bu Gatot',   57,  50, 5],
            ['Glundengan',                           1,  2,  'Bu Tris',    12,  6,  1],
            ['X-Stasiun',                            1,  2,  'Bu Sutaji',  35,  33, 4],
            ['Besini',                               1,  2,  'Bu Johan',   89,  80, 12],
            ['Jerukan/Kasiyan',                      1,  2,  'Bu Eni',     50,  15, 2],
            ['Jambearum',                            1,  2,  'Bu Rohim',   17,  17, 1],
            ['JLS/Surai',                            1,  2,  'Bu Lipah',   7,   7,  0],
            ['Kaliurang',                            1,  2,  'Bu Is',      25,  15, 2],
            ['Rumah Bu yah',                         1,  2,  'Bu Yah',     10,  3,  1],
            ['Selogiri',                             1,  2,  'Bu Jumirah', 40,  25, 2],
            ['kos jubung',                           1,  2,  'P.Jamal',    8,   0,  0],
            ['Ex-lokalisasi Sukoreno',               1,  3,  'Bu Boiran',  35,  25, 2],
            ['KARAOKE GGM',                          1,  3,  '',           15,  15, 0],
            ['LESEHAN PERTIGAAN GUMUKMAS',           1,  3,  '',           10,  10, 0],
            ['LESEHAN PASAR BARU KENCONG',           1,  3,  '',           10,  10, 0],
            ['WARUNG BU IS',                         1,  3,  'BU IS',      10,  10, 0],
            ['Pulo Gantol',                          1,  4,  'Bu Bawon',   25,  20, 2],
            ['Pusri',                                1,  4,  'Bu Rokib',   67,  25, 3],
            ['Pom Bensin',                           1,  4,  'Maklampir',  35,  25, 1],
            ['Lesehan Gambirono',                    1,  4,  'Mbah Surip', 6,   2,  0],
            ['Pasar sapi',                           1,  4,  'Bu Suin',    10,  2,  0],
            ['Jatian/Karangsono',                    1,  4,  'Bu Endang',  30,  27, 3],
            ['Lesehan Happy',                        1,  4,  'Bu sundari', 5,   5,  0],
            ['Lesehan Pak seno',                     1,  4,  'Pak Seno',   15,  12, 2],
            ['Lesehan Lojejer',                      1,  4,  'Bu Pipin',   17,  12, 2],
            ['Lesehan Kesilir',                      1,  4,  'Bu Andra',   27,  25, 3],
            ['Lesehan Glundengan',                   1,  4,  'Buyani',     15,  10, 1],
            ['Lesehan Lapindo',                      1,  4,  'Gatot',      10,  3,  0],
            ['Lesehan Banyuwangi',                   1,  4,  'Endang',     8,   3,  0],
            ['Lesehan Hotel Ambulu',                 1,  4,  'Bu yeni',    17,  12, 1],

            // ── TEAM 2 : Team Ida ────────────────────────────────
            ['Lesehan Dira',                         2,  5,  'Cetim',      7,   2,  0],
            ['Lesehan Pasar Balung',                 2,  5,  'Sumirah',    7,   7,  1],
            ['Lesehan kaliputih',                    2,  5,  'Katib',      9,   5,  1],
            ['H2O',                                  2,  5,  'Pak Kasdi',  10,  1,  0],
            ['Warung Bu Sujud',                      2,  5,  'Bu Sujud',   8,   1,  0],
            ['Warung Stasiun Kota',                  2,  5,  'Pak No',     5,   3,  0],
            ['Warung Kopi Opel',                     2,  5,  'Opel',       7,   1,  0],
            ['Happy Pappy',                          2,  5,  'Pak Kasdi',  5,   2,  0],
            ['Oasis Karauke',                        2,  5,  'Pak Kasdi',  8,   3,  0],
            ['Lesehan Kecik',                        2,  5,  'Bu Eni',     35,  30, 4],
            ['Lesehan Wonorejo',                     2,  5,  'Katijah',    20,  15, 2],
            ['Lesehan Pasar Baru',                   2,  5,  'Rukimah',    21,  5,  1],
            ['Lesehan Pertigaan',                    2,  5,  'Susan',      30,  1,  0],
            ['Lesehan Pasar',                        2,  5,  'Laili',      9,   1,  0],
            ['karaokean oke',                        2,  5,  'B.Gatot',    5,   5,  0],
            ['Lesehan Bambu',                        2,  5,  'B.erna',     4,   4,  0],
            ['Café BU Llilik',                       2,  5,  'B.Liik',     5,   5,  0],
            ['LESEHAN BULOG KASIAN',                 2,  6,  '',           10,  9,  1],
            ['KARAOKE TEBUAN TUTUL',                 2,  6,  '',           10,  9,  1],
            ['LESEHAN PASAR BANGSAL',                2,  6,  '',           15,  15, 0],
            ['Lesehan alun-alun',                    2,  7,  'Erwin',      10,  2,  0],
            ['Lesehan jatian',                       2,  7,  'Subur',      6,   3,  0],
            ['Jember Indah Hotel',                   2,  7,  'Pak Teguh',  10,  1,  0],
            ['Beringin Indah Hotel',                 2,  7,  'Pak Teguh',  21,  2,  0],
            ['Hotel kebonagung',                     2,  7,  'Pak Teguh',  3,   2,  0],
            ['kos gang kelinci',                     2,  7,  'angel',      10,  5,  0],
            ['warung pecoro',                        2,  7,  'pak mahdi',  15,  8,  0],
            ['WARKOP PECORO',                        2,  9,  '',           20,  20, 0],
            ['Hotel Anda',                           2,  7,  'Pak Teguh',  7,   2,  0],
            ['Hotel Nusantara',                      2,  7,  'Pak Teguh',  15,  6,  1],
            ['Hotel Putra',                          2,  7,  'Pak Teguh',  16,  7,  1],

            // ── TEAM 3 : Team Lutfiah ────────────────────────────
            ['Kost Selatan Unmuh',                   3,  8,  'Lilik',      35,  8,  0],
            ['Kos kalimantan',                       3,  8,  'Edi',        32,  2,  0],
            ['Kost Semeru',                          3,  8,  'Gopong',     16,  9,  2],
            ['Hotel Merdeka',                        3,  8,  'Pak Teguh',  9,   2,  0],
            ['Hotel Tomiharini',                     3,  8,  'Pak Teguh',  7,   3,  0],
            ['Warung Cak Rudi',                      3,  8,  'P. Rudi',    15,  15, 0],
            ['kos eksekutif sumatra',                3,  8,  'andi',       10,  5,  0],
            ['KOST PUTRI GANG TERATAI',              3,  10, '',           13,  13, 0],
            ['KOST BELAKANG INDOMARCO',              3,  10, '',           15,  15, 0],
            ['KOST PAK YOYOK',                       3,  10, 'P. YOYOK',   15,  15, 0],
            ['KOSAN EXECUTIVE SUMATRA',              3,  10, '',           25,  25, 0],
            ['LESEHAN KARAOKE PAK RUDI REMBANGAN',   3,  10, 'P. RUDI',    10,  10, 0],
            ['LESEHAN TAMANSARI',                    3,  10, '',           10,  10, 0],
            ['SAWAHAN BALUNG',                       3,  10, '',           10,  10, 0],
            ['KOSAN CILIWUNG',                       3,  10, '',           20,  19, 1],
            ['KOSAN PUTRI (JL. MAJAPAHIT)',          3,  10, '',           20,  20, 0],
            ['BU BINA',                              3,  10, 'BU BINA',    10,  10, 0],
            ['KOSAN SAMPING UNMUH',                  3,  10, '',           10,  10, 0],
            ['KOS TULIP',                            3,  10, '',           10,  10, 0],
            ['KOS H. SLAMET',                        3,  10, 'P. SLAMET',  15,  15, 0],
            ['KOST MASTRIP',                         3,  10, '',           15,  15, 0],
            ['Hotel Kemayoran',                      3,  10, 'Pak Teguh',  9,   1,  0],

            // ── TEAM 4 : Team Suharyadi ──────────────────────────
            ['Kost Mastrib',                         4,  11, 'Sandi',      8,   3,  0],
            ['Hotel Aston',                          4,  11, 'Bu Mery',    8,   2,  0],
            ['Hotel Melati',                         4,  11, 'pak Teguh',  7,   3,  0],
            ['Kost Belakang Happy Papy',             4,  11, 'Bu Rita',    9,   1,  0],
            ['Kost Lumintu',                         4,  11, 'Bu Dadang',  9,   1,  0],
            ['Lesehan Jombang',                      4,  11, 'Anik',       16,  13, 2],
            ['Star Karauke',                         4,  11, 'Pak Kasdi',  10,  7,  3],
            ['Pijat Plus',                           4,  11, 'Pak Kasdi',  6,   5,  1],
            ['Hotel Pecoro',                         4,  11, 'Pak Teguh',  7,   5,  1],
            ['Hotel Bintang Utama',                  4,  11, 'Pak Teguh',  18,  2,  0],
            ['Lesehan Klatakan',                     4,  11, 'Joni',       25,  10, 2],
            ['Azika Karauke',                        4,  11, 'Lahim',      35,  5,  2],
            ['E-Club',                               4,  11, '',           75,  3,  1],
            ['Bening Karauke',                       4,  11, 'Edi Mistari',35,  23, 1],
            ['Lojejer Karauke',                      4,  11, '',           13,  10, 2],
            ['GV Karauke',                           4,  11, 'Dewi Jos',   157, 17, 3],
            ['Kosan Biru',                           4,  11, '',           10,  1,  0],
            ['Hotel Edelwis',                        4,  11, '',           25,  5,  0],
            ['Karaoke Jenggawah',                    4,  11, 'P. Eko',     20,  3,  0],
            ['KI CAFE',                              4,  11, '',           5,   5,  0],
            ['CAFE SINTYA JUBUNG',                   4,  11, 'SINTYA',     5,   5,  0],
            ['KOS EKSEKUTIF SEMERU',                 4,  11, '',           5,   5,  0],
            ['CAFE JOGO',                            4,  11, 'herda',      3,   3,  0],
            ['CAFE KPK',                             4,  11, 'herda',      5,   5,  0],
            ['TULIP HOME STAY',                      4,  11, '',           3,   3,  0],
            ['KOS RISKI',                            4,  11, 'RISKI',      12,  12, 0],
        ];

        foreach ($data as [$namaHotspot, $teamId, $createdBy, $gatekeeper, $dijangkau, $tes, $positif]) {
            // Lookup hotspot_id by nama (case-insensitive)
            $hotspotId = $this->getHotspotId($namaHotspot);
            if (! $hotspotId) {
                $this->command->warn("Hotspot tidak ditemukan: '{$namaHotspot}', skip.");
                continue;
            }

            // Lookup rencana by hotspot_id + periode_id
            $rencana = RencanaKunjungan::where('hotspot_id', $hotspotId)
                ->where('periode_id', $periodeId)
                ->first();

            if (! $rencana) {
                $this->command->warn("Rencana tidak ditemukan untuk hotspot: '{$namaHotspot}' (id={$hotspotId}), skip.");
                continue;
            }

            // Hindari duplikat
            $exists = Kunjungan::where('rencana_id', $rencana->id)->exists();
            if ($exists) {
                continue;
            }

            Kunjungan::create([
                'rencana_id'       => $rencana->id,
                'hotspot_id'       => $hotspotId,
                'team_id'          => $teamId,
                'periode_id'       => $periodeId,
                'created_by'       => $createdBy,
                'waktu_mulai'      => '08:00:00',
                'waktu_selesai'    => '10:00:00',
                'waktu_ramai'      => 1,
                'jumlah_dijangkau' => $dijangkau,
                'jumlah_tes'       => $tes,
                'jumlah_positif'   => $positif,
                'gatekeeper'       => $gatekeeper ?: null,
                'foto'             => null,
                'latitude'         => null,
                'longitude'        => null,
                'status_validasi'  => 'valid',
            ]);

            // Update status rencana → selesai
            $rencana->update(['status' => 'selesai']);
        }

        // ── Akumulasi KlasteringAgregatWPS ───────────────────────
        $this->akumulasiSemuaKecamatan($periodeId);

        $this->command->info('KunjunganSeeder selesai: ' . count($data) . ' kunjungan diproses.');
    }

    /**
     * Lookup hotspot_id berdasarkan nama (case-insensitive).
     */
    private function getHotspotId(string $namaHotspot): ?int
    {
        return DB::table('hotspots')
            ->whereRaw('LOWER(nama_hotspot) = ?', [strtolower(trim($namaHotspot))])
            ->value('id');
    }

    /**
     * Hitung ulang agregat WPS untuk semua kecamatan pada periode ini.
     */
    private function akumulasiSemuaKecamatan(int $periodeId): void
    {
        $kecamatanIds = Kunjungan::where('kunjungan.periode_id', $periodeId)
            ->join('hotspots', 'kunjungan.hotspot_id', '=', 'hotspots.id')
            ->distinct()
            ->pluck('hotspots.kecamatan_id');

        foreach ($kecamatanIds as $kecamatanId) {
            $agregat = Kunjungan::where('kunjungan.periode_id', $periodeId)
                ->join('hotspots', 'kunjungan.hotspot_id', '=', 'hotspots.id')
                ->where('hotspots.kecamatan_id', $kecamatanId)
                ->selectRaw('
                    SUM(kunjungan.jumlah_dijangkau)      AS total_wps,
                    SUM(kunjungan.jumlah_tes)            AS total_tes,
                    SUM(kunjungan.jumlah_positif)        AS total_positif,
                    COUNT(DISTINCT kunjungan.hotspot_id) AS total_hotspot
                ')
                ->first();

            KlasteringAgregatWPS::updateOrCreate(
                ['periode_id' => $periodeId, 'kecamatan_id' => $kecamatanId],
                [
                    'total_wps'                => $agregat->total_wps ?? 0,
                    'total_tes_wps'            => $agregat->total_tes ?? 0,
                    'total_positif_wps'        => $agregat->total_positif ?? 0,
                    'total_hotspot_dikunjungi' => $agregat->total_hotspot ?? 0,
                ]
            );
        }

        $this->command->info('Agregat WPS diperbarui untuk ' . $kecamatanIds->count() . ' kecamatan.');
    }
}