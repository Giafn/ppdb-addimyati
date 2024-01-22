<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalonSiswa extends Model
{
    use HasFactory;

    protected $table = 'calon_siswa';
    protected $guarded = [];

    public function siswaPembayaran()
    {
        return $this->hasOne(SiswaPembayaran::class, 'siswa_id');
    }
}
