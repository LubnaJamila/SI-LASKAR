<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasteringAgregatWPS extends Model
{
    use HasFactory;
    protected $table = 'klastering_agregat_wps';

    protected $fillable = ['periode_id','kecamatan_id','total_wps','total_hotspot_dikunjungi','total_tes_wps','total_positif_wps'];

    public function periode() { return $this->belongsTo(Periode::class); }
    public function kecamatan() { return $this->belongsTo(Kecamatan::class); }
}