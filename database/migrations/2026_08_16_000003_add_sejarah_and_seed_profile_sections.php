<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bagian_profil_desa')) {
            // Add Sejarah Desa to the existing MySQL enum without changing existing data.
            DB::statement("ALTER TABLE bagian_profil_desa MODIFY section_type ENUM(
                'tentang_desa',
                'sejarah_desa',
                'profil_kepala_desa',
                'profil_wilayah',
                'visi_misi',
                'struktur_organisasi',
                'peta_desa',
                'perangkat_desa'
            ) NOT NULL");

            if (Schema::hasTable('profil_desa')) {
                $desas = DB::table('profil_desa')->pluck('id');

                $sections = [
                    'tentang_desa',
                    'sejarah_desa',
                    'profil_kepala_desa',
                    'profil_wilayah',
                    'visi_misi',
                    'struktur_organisasi',
                    'peta_desa',
                    'perangkat_desa',
                ];

                foreach ($desas as $desaId) {
                    foreach ($sections as $order => $type) {
                        $exists = DB::table('bagian_profil_desa')
                            ->where('desa_profile_id', $desaId)
                            ->where('section_type', $type)
                            ->exists();

                        if (!$exists) {
                            DB::table('bagian_profil_desa')->insert([
                                'desa_profile_id' => $desaId,
                                'section_type' => $type,
                                'content' => '',
                                'image' => null,
                                'is_active' => true,
                                'order' => $order,
                                'created_at' => now(),
                                'updated_at' => now(),
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('bagian_profil_desa')) {
            DB::table('bagian_profil_desa')
                ->where('section_type', 'sejarah_desa')
                ->delete();

            DB::statement("ALTER TABLE bagian_profil_desa MODIFY section_type ENUM(
                'tentang_desa',
                'profil_kepala_desa',
                'profil_wilayah',
                'visi_misi',
                'struktur_organisasi',
                'peta_desa',
                'perangkat_desa'
            ) NOT NULL");
        }
    }
};
