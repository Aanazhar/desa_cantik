<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    // Menghubungkan ke tabel 'kontak' di MySQL Anda
    protected $table = 'kontak';

    protected $fillable = [
        'desa_id',
        'type',
        'title',
        'icon',
        'url',
        'sort_order',
        'description',
    ];
}