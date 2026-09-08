<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaStatisticHistory extends Model
{
    protected $table = 'riwayat_statistik_desa';

    protected $fillable = [
        'desa_id',
        'tahun',
        'data',
        'catatan',
    ];

    protected $casts = [
        'desa_id' => 'integer',
        'tahun' => 'integer',
        'data' => 'array',
    ];
}