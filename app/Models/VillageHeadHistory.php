<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VillageHeadHistory extends Model
{
    protected $table = 'riwayat_kepala_desa';

    protected $fillable = [
        'desa_id',
        'nama',
        'tahun_mulai',
        'tahun_selesai',
        'foto',
        'pendidikan',
        'tempat_lahir',
        'tanggal_lahir',
        'biografi',
        'visi',
        'misi',
        'keterangan',
        'aktif',
        'urutan',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'aktif' => 'boolean',
        'tahun_mulai' => 'integer',
        'tahun_selesai' => 'integer',
        'urutan' => 'integer',
    ];

    public function desa(): BelongsTo
    {
        return $this->belongsTo(
            DesaProfile::class,
            'desa_id'
        );
    }

    /**
     * Apakah periode ini masih berjalan?
     */
    public function getPeriodeAttribute(): string
    {
        if (!$this->tahun_selesai) {
            return $this->tahun_mulai . ' - Sekarang';
        }

        return $this->tahun_mulai . ' - ' . $this->tahun_selesai;
    }

    /**
     * URL foto.
     */
    public function getFotoUrlAttribute(): ?string
    {
        if (!$this->foto) {
            return null;
        }

        return asset('storage/' . $this->foto);
    }
}