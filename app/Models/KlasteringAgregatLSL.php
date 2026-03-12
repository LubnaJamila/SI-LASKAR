<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasteringAgregatLSL extends Model
{
    use HasFactory;
    protected $table = 'klastering_agregat_lsl';

    protected $fillable = ['periode_id','kecamatan_id','total_lsl','total_hotspot_lsl','total_tes_lsl','total_positif_lsl'];

    public function periode() { return $this->belongsTo(Periode::class); }
    public function kecamatan() { return $this->belongsTo(Kecamatan::class); }
}