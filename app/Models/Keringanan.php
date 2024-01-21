<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keringanan extends Model
{
    use HasFactory;

    protected $table = 'keringanan';
    protected $fillable = [
        'nama',
        'total',
    ];

    public function detailKeringanan()
    {
        return $this->hasMany(DetailKeringanan::class, 'keringanan_id', 'id');
    }
}
