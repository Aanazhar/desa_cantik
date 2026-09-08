<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publikasi';

    protected $fillable = [
        'desa_id',
        'title',
        'slug',
        'category',
        'status',
        'image',
        'excerpt',
        'content',
        'file',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}