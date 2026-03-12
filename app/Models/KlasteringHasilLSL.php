<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KlasteringHasilLSL extends Model
{
    use HasFactory;
    protected $table = 'klastering_hasil_lsl';
    protected $fillable = [
        'periode_id','kecamatan_id','lsl_per_1000','hotspot_lsl_per_1000',
        'cluster_label','cluster_name'
    ];

    public function periode() { return $this->belongsTo(Periode::class); }
    public function kecamatan() { return $this->belongsTo(Kecamatan::class); }
}