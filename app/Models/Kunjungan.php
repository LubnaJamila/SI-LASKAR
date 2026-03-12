<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan extends Model
{
    use HasFactory;
    protected $table = 'kunjungan';

    protected $fillable = [
        'rencana_id','hotspot_id','team_id','periode_id','created_by',
        'waktu_mulai','waktu_selesai','waktu_ramai','jumlah_dijangkau','gatekeeper',
        'jumlah_tes','jumlah_positif','foto','longitude','latitude','status_validasi'
    ];

    // Relasi
    public function rencana() { return $this->belongsTo(RencanaKunjungan::class,'rencana_id'); }
    public function hotspot() { return $this->belongsTo(Hotspot::class); }
    public function team() { return $this->belongsTo(Team::class); }
    public function periode() { return $this->belongsTo(Periode::class); }
    public function creator() { return $this->belongsTo(User::class,'created_by'); }
}