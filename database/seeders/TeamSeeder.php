<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [

            [
                'nama_team' => 'Team Fandi',
                'ketua' => 'Fandi',
                'members' => ['Imron', 'Shohibul Imron'],
            ],

            [
                'nama_team' => 'Team Ida',
                'ketua' => 'Ida Ratnawati',
                'members' => ['Ida', 'Wiwik'],
            ],

            [
                'nama_team' => 'Team Lutfiah',
                'ketua' => 'Lutfiah',
                'members' => ['Wiwik Maimunah'],
            ],

            [
                'nama_team' => 'Team Suharyadi',
                'ketua' => 'Suharyadi',
                'members' => ['Lutfi'],
            ],
        ];

        foreach ($teams as $data) {

            $ketua = User::where('nama_lengkap', $data['ketua'])->first();

            if (!$ketua) continue;

            $team = Team::create([
                'nama_team' => $data['nama_team'],
                'ketua_id' => $ketua->id,
                'status' => 'aktif'
            ]);

            // attach members
            $memberIds = User::whereIn('nama_lengkap', $data['members'])
                            ->pluck('id');

            $team->members()->attach($memberIds);
        }
    }
}