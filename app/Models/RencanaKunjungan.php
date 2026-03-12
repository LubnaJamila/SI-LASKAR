<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RencanaKunjungan extends Model
{
    use HasFactory;
    protected $table = 'rencana_kunjungan';

    protected $fillable = [
        'hotspot_id','team_id','assigned_to','assigned_by','periode_id',
        'parent_id','jenis','tanggal_rencana','status'
    ];

    // Relasi
    public function hotspot() { return $this->belongsTo(Hotspot::class); }
    public function team() { return $this->belongsTo(Team::class); }
    public function assignedTo() { return $this->belongsTo(User::class,'assigned_to'); }
    public function assignedBy() { return $this->belongsTo(User::class,'assigned_by'); }
    public function periode() { return $this->belongsTo(Periode::class); }
    public function parent() { return $this->belongsTo(self::class,'parent_id'); }
    public function children() { return $this->hasMany(self::class,'parent_id'); }
    public function kunjungan() { return $this->hasOne(Kunjungan::class,'rencana_id'); }
}