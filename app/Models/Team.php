<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_team',
        'ketua_id',
        'status'
        ];

    public function ketua()
    {
        return $this->belongsTo(User::class,'ketua_id');
    }
    public function members()
    {
        return $this->belongsToMany(User::class,'team_members');
    }
    public function hotspots()
    {
        return $this->hasMany(Hotspot::class);
    }
    public function rencana()
    {
        return $this->hasMany(RencanaKunjungan::class);
    }
    public function kunjungan()
    {
        return $this->hasMany(Kunjungan::class);
    }

}