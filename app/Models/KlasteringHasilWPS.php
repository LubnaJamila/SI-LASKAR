<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasteringHasilWPS extends Model
{
    use HasFactory;
    protected $table = 'klastering_hasil_wps';
    protected $fillable = [
        'periode_id',
        'kecamatan_id',
        'cluster',
        'label',

        // data mentah
        'total_wps',
        'total_hotspot_dikunjungi',
        'total_tes_wps',
        'total_positif_wps',

        // fitur clustering
        'wps_per_1000_penduduk',
        'hotspot_per_1000_penduduk',
        'tes_rate',
        'positif_rate',
    ];

    public function periode() { return $this->belongsTo(Periode::class); }
    public function kecamatan() { return $this->belongsTo(Kecamatan::class); }
}