<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiswaPembayaran extends Model
{
    use HasFactory;

    protected $table = 'siswa_pembayaran';
    protected $guarded = [];

    public function keringanan()
    {
        return $this->belongsTo(Keringanan::class, 'keringanan_id');
    }

    public function pembayaranHistory()
    {
        return $this->hasMany(PembayaranHistory::class, 'pembayaran_id');
    }
}
