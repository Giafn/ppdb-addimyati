<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembayaranHistory extends Model
{
    use HasFactory;

    protected $table = 'pembayaran_history';
    protected $guarded = [];
}
