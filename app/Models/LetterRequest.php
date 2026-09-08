<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LetterRequest extends Model
{
    /**
     * Nama tabel yang terhubung dengan model ini.
     *
     * @var string
     */
    protected $table = 'pengajuan_surat';

    /**
     * Atribut yang dapat diisi secara massal (mass assignable).
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'desa_id',
        'service_id',
        'nama',
        'no_hp',
        'keperluan',
        'form_data',
        'tracking_code',
        'status',
        'catatan_admin'
    ];

    /**
     * Tipe data casts atribut.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'form_data' => 'array',
    ];

    /**
     * Relasi ke model SiteSection (Layanan).
     */
    public function service(): BelongsTo
    {
        return $this->belongsTo(SiteSection::class, 'service_id');
    }
}