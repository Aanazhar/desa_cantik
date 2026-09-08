<?php

namespace Database\Seeders;

use App\Models\DesaProfile;
use App\Models\DesaProfileSection;
use Illuminate\Database\Seeder;

class DesaProfileSectionSeeder extends Seeder
{
    public function run(): void
    {
        // Initialize sections for all existing desa profiles
        $desaProfiles = DesaProfile::all();
        
        foreach ($desaProfiles as $desa) {
            $sections = [
                'tentang_desa' => 'Informasi umum tentang desa, sejarah singkat, dan deskripsi desa.',
                'profil_kepala_desa' => 'Profil kepala desa, latar belakang, dan informasi pemerintahan.',
                'profil_wilayah' => 'Informasi wilayah, luas desa, batas administratif, dan karakteristik geografis.',
                'visi_misi' => $desa->vision ? "Visi: " . $desa->vision . "\n\nMisi:\n" . $desa->mission : 'Visi dan misi pembangunan desa untuk masa depan.',
                'struktur_organisasi' => 'Struktur organisasi pemerintah desa dan susunan perangkat desa.',
                'peta_desa' => 'Peta wilayah desa atau embed peta interaktif.',
                'perangkat_desa' => 'Daftar lengkap perangkat desa dan jabatan mereka.',
            ];

            $order = 0;
            foreach ($sections as $type => $defaultContent) {
                DesaProfileSection::firstOrCreate(
                    [
                        'desa_profile_id' => $desa->id,
                        'section_type' => $type,
                    ],
                    [
                        'content' => $defaultContent,
                        'is_active' => true,
                        'order' => $order,
                    ]
                );
                $order++;
            }
        }
    }
}
