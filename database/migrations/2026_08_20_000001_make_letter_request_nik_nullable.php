<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('pengajuan_surat') && Schema::hasColumn('pengajuan_surat', 'nik')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->string('nik', 50)->nullable()->change();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pengajuan_surat') && Schema::hasColumn('pengajuan_surat', 'nik')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->string('nik', 50)->nullable(false)->change();
            });
        }
    }
};
