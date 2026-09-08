<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaVillage extends Model
{
    protected $table = 'wilayah_desa';

    protected $fillable = [
        'desa_id',
        'nama_dusun',
        'jumlah_rt',
        'jumlah_penduduk',
    ];

    protected $casts = [
        'desa_id' => 'integer',
        'jumlah_rt' => 'integer',
        'jumlah_penduduk' => 'integer',
    ];
}