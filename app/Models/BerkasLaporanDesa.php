<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BerkasLaporanDesa extends Model
{
    use HasFactory;

    protected $table = 'berkas_laporan_desa';

    protected $fillable = [
        'desa_id',
        'tahun',
        'file_csv',
        'file_pdf',
    ];
}