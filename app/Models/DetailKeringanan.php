<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeringanan extends Model
{
    use HasFactory;
    protected $table = 'detail_item_keringanan';
    
    protected $fillable = [
        'keringanan_id',
        'item_id',
        'nominal',
    ];

    public $timestamps = false;

    public function keringanan()
    {
        return $this->belongsTo(Keringanan::class, 'keringanan_id', 'id');
    }

    public function item()
    {
        return $this->belongsTo(NominalPendaftaran::class, 'item_id', 'id');
    }
}
