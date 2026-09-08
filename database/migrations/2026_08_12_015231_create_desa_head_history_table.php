<?php

use Illuminate\Database\Migrations\Migration;

/*
 * Migration lama dipertahankan hanya untuk kompatibilitas riwayat.
 * Struktur aktif riwayat kepala desa dibuat oleh migration
 * 2026_08_18_055630_create_village_head_histories_table.php.
 */

return new class extends Migration
{
    public function up(): void
    {
        // Tidak membuat tabel agar tidak terjadi duplikasi.
    }

    public function down(): void
    {
        // Tidak ada yang dibatalkan.
    }
};
