<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('bagian_situs') && !Schema::hasColumn('bagian_situs', 'url')) {
            Schema::table('bagian_situs', function (Blueprint $table) {
                $table->string('url', 1000)->nullable()->after('description');
            });
        }

        if (Schema::hasTable('pengajuan_surat') && !Schema::hasColumn('pengajuan_surat', 'tracking_code')) {
            Schema::table('pengajuan_surat', function (Blueprint $table) {
                $table->string('tracking_code', 30)->nullable()->unique()->after('no_hp');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('bagian_situs') && Schema::hasColumn('bagian_situs', 'url')) {
            Schema::table('bagian_situs', fn (Blueprint $table) => $table->dropColumn('url'));
        }

        if (Schema::hasTable('pengajuan_surat') && Schema::hasColumn('pengajuan_surat', 'tracking_code')) {
            Schema::table('pengajuan_surat', fn (Blueprint $table) => $table->dropColumn('tracking_code'));
        }
    }
};
