<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'lubnajamila024@gmail.com'],
            [
                'nama_lengkap' => 'Administrator',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
            ]
        );
    }
}