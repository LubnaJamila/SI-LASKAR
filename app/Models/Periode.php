<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periodes';

    protected $fillable = ['nama_periode','tahun','tanggal_mulai','tanggal_selesai','status','status_cluster'];

    // Relasi
    public function rencana() { return $this->hasMany(RencanaKunjungan::class); }
    public function klasteringAgregatWPS() { return $this->hasMany(KlasteringAgregatWPS::class); }
    public function klasteringHasilWPS() { return $this->hasMany(KlasteringHasilWPS::class); }
    public function klasteringAgregatLSL() { return $this->hasMany(KlasteringAgregatLSL::class); }
    public function klasteringHasilLSL() { return $this->hasMany(KlasteringHasilLSL::class); }
}