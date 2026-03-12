<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama_lengkap',
        'nik',
        'jenis_kelamin',
        'no_telp',
        'alamat',
        'email',
        'password',
        'role',
        'status'
        ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    public function ketuaTeams()
    {
        return $this->hasMany(Team::class,'ketua_id');
    }
    public function teams()
    {
        return $this->belongsToMany(Team::class,'team_members');
    }
    public function assignedRencana()
    {
        return $this->hasMany(RencanaKunjungan::class,'assigned_to');
    }
    public function createdRencana()
    {
        return $this->hasMany(RencanaKunjungan::class,'assigned_by');
    }
    public function createdHotspots()
    {
        return $this->hasMany(Hotspot::class,'created_by');
    }
    public function createdKunjungan()
    {
        return $this->hasMany(Kunjungan::class,'created_by');
    }
    public function isPartOfAnyTeam()
    {
        return $this->ketuaTeams()->exists() || $this->teams()->exists();
    }
}