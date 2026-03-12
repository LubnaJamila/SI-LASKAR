<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    use HasFactory;
    protected $table = 'kecamatan';

    protected $fillable = [
        'nama_kecamatan',
        'jumlah_penduduk',
        'geojson'
        ];

    // Relasi
    public function hotspots()
    {
        return $this->hasMany(Hotspot::class);
    }
    public function klasteringAgregatWPS()
    {
        return $this->hasMany(KlasteringAgregatWPS::class);
    }
    public function klasteringHasilWPS()
    {
        return $this->hasMany(KlasteringHasilWPS::class);
    }
    public function klasteringAgregatLSL()
    {
        return $this->hasMany(KlasteringAgregatLSL::class);
    }
    public function klasteringHasilLSL()
    {
        return $this->hasMany(KlasteringHasilLSL::class);
    }
}