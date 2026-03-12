<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('kecamatan')->truncate();
        Schema::enableForeignKeyConstraints();

        /*
        |--------------------------------------------------------------------------
        | 1. Ambil GeoJSON
        |--------------------------------------------------------------------------
        */
        $geojson = json_decode(
            Storage::get('data/kecamatan.geojson'),
            true
        );

        /*
        |--------------------------------------------------------------------------
        | 2. Ambil Excel → array
        |--------------------------------------------------------------------------
        */
        $rows = Excel::toArray([], storage_path('app/data/data jumlah penduduk.xlsx'))[0];

        // skip header → buat mapping
        $pendudukMap = [];

        foreach (array_slice($rows, 1) as $row) {
            $nama = trim($row[0]);
            $jumlah = (int) $row[1];

            $pendudukMap[strtolower($nama)] = $jumlah;
        }

        /*
        |--------------------------------------------------------------------------
        | 3. Loop setiap feature GeoJSON
        |--------------------------------------------------------------------------
        */
        foreach ($geojson['features'] as $feature) {

            $nama = $feature['properties']['nm_kecamatan'];

            $jumlahPenduduk = $pendudukMap[strtolower($nama)] ?? 0;

            DB::table('kecamatan')->insert([
                'nama_kecamatan'   => $nama,
                'jumlah_penduduk'  => $jumlahPenduduk,
                'geojson'          => json_encode($feature['geometry']),
                'created_at'       => now(),
                'updated_at'       => now(),
            ]);
        }
    }
}