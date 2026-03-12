<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class PetugasUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Fandi',
            'Shohibul Imron',
            'Imron',
            'Ida',
            'Ida Ratnawati',
            'Wiwik',
            'Wiwik Maimunah',
            'Lutfi',
            'Lutfiah',
            'Suharyadi',
        ];

        foreach ($names as $nama) {

            $email = Str::slug($nama, '.') . '@laskar.test';

            User::firstOrCreate(
                ['email' => $email], // biar ga dobel
                [
                    'nama_lengkap'  => $nama,
                    'nik'           => null,
                    'jenis_kelamin' => 'laki-laki', // ubah kalau perlu
                    'no_telp'       => null,
                    'alamat'        => null,
                    'password'      => Hash::make('password123'),
                    'role'          => 'petugas',
                    'status'        => 'aktif',
                ]
            );
        }
    }
}