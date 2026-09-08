<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('statistik_desa', function (Blueprint $table) {
            $table->unsignedInteger('islam')->default(0)->after('belum_bekerja');
            $table->unsignedInteger('kristen')->default(0)->after('islam');
            $table->unsignedInteger('katolik')->default(0)->after('kristen');
            $table->unsignedInteger('hindu')->default(0)->after('katolik');
            $table->unsignedInteger('buddha')->default(0)->after('hindu');
            $table->unsignedInteger('konghucu')->default(0)->after('buddha');
            $table->unsignedInteger('kepercayaan_lainnya')->default(0)->after('konghucu');
        });
    }

    public function down(): void
    {
        Schema::table('statistik_desa', function (Blueprint $table) {
            $table->dropColumn([
                'islam',
                'kristen',
                'katolik',
                'hindu',
                'buddha',
                'konghucu',
                'kepercayaan_lainnya',
            ]);
        });
    }
};