<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\VillageHeadHistory;

class DesaProfile extends Model
{
    protected $table = 'profil_desa';

    protected $fillable = [
        'name','code','address','district','regency','province',
        'description','history','boundaries','vision','mission',
        'head_name','head_photo','map_image','structure_image','hero_image', // ✅ 'map_image' SUDAH DITAMBAHKAN
        'theme','is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function villageHeads(): HasMany
    {
        return $this->hasMany(VillageHeadHistory::class, 'desa_id');
    }

    public function profileSections(): HasMany
    {
        return $this->hasMany(DesaProfileSection::class, 'desa_profile_id');
    }

    public function structures(): HasMany
    {
        return $this->hasMany(DesaStructure::class, 'desa_id');
    }
}