<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotspotDeleteRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'hotspot_id',
        'requested_by',
        'alasan_hapus',
        'status',
        'reviewed_by',
        'reviewed_at',
        'catatan_admin',
    ];
 
    protected $casts = [
        'reviewed_at' => 'datetime',
    ];

     // ── Relasi ──────────────────────────────────────────────
 
    public function hotspot()
    {
        return $this->belongsTo(Hotspot::class);
    }
 
    public function requester()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
 
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
 
    // ── Scope ───────────────────────────────────────────────
 
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}