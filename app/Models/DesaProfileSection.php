<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaProfileSection extends Model
{
    protected $table = 'bagian_profil_desa';

    protected $fillable = [
        'desa_profile_id','section_type','content','image','is_active','order'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function desaProfile()
    {
        return $this->belongsTo(DesaProfile::class, 'desa_profile_id');
    }

    public static function getSectionLabel($type)
    {
        return [
            'tentang_desa'=>'Tentang Desa','sejarah_desa'=>'Sejarah Desa',
            'profil_kepala_desa'=>'Profil Kepala Desa','profil_wilayah'=>'Profil Wilayah',
            'visi_misi'=>'Visi & Misi','struktur_organisasi'=>'Struktur Organisasi',
            'peta_desa'=>'Peta Desa','perangkat_desa'=>'Perangkat Desa'
        ][$type] ?? $type;
    }

    public static function getAllSections()
    {
        return ['tentang_desa','sejarah_desa','profil_kepala_desa','profil_wilayah','visi_misi','struktur_organisasi','peta_desa'];
    }
}
