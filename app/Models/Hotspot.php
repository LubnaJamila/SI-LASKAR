<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotspot extends Model
{
    use HasFactory;
    protected $fillable = [
        'kecamatan_id',
        'team_id',
        'created_by',
        'nama_hotspot',
        'jenis_hotspot',
        'jenis_populasi',
        'penanggungjawab',
        'kontak_penanggungjawab',
        'longitude',
        'latitude',
        'status'
    ];

    // Relasi
    public function kecamatan()
    {
        return $this->belongsTo(Kecamatan::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
    public function creator()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function rencana()
    {
        return $this->hasMany(RencanaKunjungan::class);
    }
    public function scopeByUserAccess($query, $user)
    {
        // cek apakah user ketua team
        $teamKetua = Team::where('ketua_id', $user->id)->first();

        if ($teamKetua) {
            // =========================
            // KETUA → lihat semua hotspot tim
            // =========================
            return $query->where('team_id', $teamKetua->id);
        }

        // =========================
        // ANGGOTA → hanya miliknya sendiri
        // =========================
        return $query->where('created_by', $user->id);
    }
}