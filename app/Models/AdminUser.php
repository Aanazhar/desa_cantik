<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUser extends Authenticatable
{
    /**
     * Nama tabel di database MySQL
     */
    protected $table = 'users'; // 👈 Mengarahkan ke tabel 'users' di MySQL

    /**
     * Kolom yang dapat diisi
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyikan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];
}