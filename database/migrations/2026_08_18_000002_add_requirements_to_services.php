<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bagian_situs') && !Schema::hasColumn('bagian_situs', 'requirements')) {
            Schema::table('bagian_situs', function (Blueprint $table) {
                $table->json('requirements')->nullable()->after('form_fields');
            });
        }

        if (!Schema::hasTable('bagian_situs')) return;

        $requirements = [
            'Pembuatan Akta Kelahiran' => [
                'Kartu Keluarga (KK)',
                'KTP orang tua',
                'Surat keterangan lahir dari bidan/rumah sakit',
                'Buku nikah/akta perkawinan orang tua jika tersedia',
            ],
            'Pembuatan Kartu Keluarga' => [
                'KTP anggota keluarga',
                'KK lama jika perubahan data',
                'Dokumen pendukung perubahan data sesuai keperluan',
            ],
            'Surat Keterangan Tidak Mampu' => [
                'Kartu Keluarga (KK)',
                'KTP pemohon',
                'Surat pengantar RT/RW jika diberlakukan di desa',
                'Dokumen pendukung tujuan pengajuan',
            ],
            'Pengantar Surat Kematian' => [
                'Kartu Keluarga (KK)',
                'KTP almarhum/almarhumah jika tersedia',
                'Surat keterangan kematian dari fasilitas kesehatan atau pihak berwenang',
                'KTP pelapor/anggota keluarga',
            ],
            'Pengantar Nikah' => [
                'KTP calon pengantin',
                'Kartu Keluarga (KK)',
                'Akta kelahiran/ijazah sesuai kebutuhan',
                'Pas foto sesuai ketentuan KUA',
                'Surat pengantar RT/RW jika diberlakukan',
            ],
            'Surat Pengantar SKCK' => [
                'KTP',
                'Kartu Keluarga (KK)',
                'Pas foto sesuai ketentuan kepolisian',
                'Surat pengantar RT/RW jika diberlakukan',
            ],
        ];

        foreach ($requirements as $title => $items) {
            DB::table('bagian_situs')
                ->where('title', $title)
                ->where('type', 'service')
                ->update([
                    'desa_id' => 1,
                    'requirements' => json_encode($items, JSON_UNESCAPED_UNICODE),
                    'updated_at' => now(),
                ]);
        }

        $keywordRequirements = [
            'domisili' => ['KTP pemohon', 'Kartu Keluarga (KK)', 'Surat pengantar RT/RW jika diberlakukan'],
            'usaha' => ['KTP pemohon', 'Kartu Keluarga (KK)', 'Surat pengantar RT/RW jika diberlakukan', 'Dokumen pendukung usaha jika tersedia'],
            'belum menikah' => ['KTP pemohon', 'Kartu Keluarga (KK)', 'Surat pengantar RT/RW jika diberlakukan'],
            'penghasilan' => ['KTP pemohon', 'Kartu Keluarga (KK)', 'Dokumen pendukung sumber penghasilan jika diperlukan'],
            'pindah' => ['KTP dan KK', 'Dokumen tujuan pindah', 'Surat pengantar RT/RW jika diberlakukan'],
            'ahli waris' => ['KTP seluruh ahli waris', 'Kartu Keluarga (KK)', 'Akta/surat kematian pewaris', 'Dokumen pendukung hubungan keluarga'],
        ];
        foreach ($keywordRequirements as $keyword => $items) {
            DB::table('bagian_situs')->where('type','service')->whereRaw('LOWER(title) LIKE ?', ['%'.strtolower($keyword).'%'])->update([
                'desa_id' => 1,
                'requirements' => json_encode($items, JSON_UNESCAPED_UNICODE),
                'updated_at' => now(),
            ]);
        }

        // Ensure existing service/request/content records belong to this installation.
        foreach (['bagian_situs', 'pengajuan_surat', 'publikasi', 'statistik_desa', 'wilayah_desa', 'riwayat_statistik_desa'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'desa_id')) {
                DB::table($table)->whereNull('desa_id')->update(['desa_id' => 1]);
            }
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('bagian_situs') && Schema::hasColumn('bagian_situs', 'requirements')) {
            Schema::table('bagian_situs', function (Blueprint $table) {
                $table->dropColumn('requirements');
            });
        }
    }
};
