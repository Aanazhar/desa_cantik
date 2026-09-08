<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        foreach (['bagian_situs','pengajuan_surat'] as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'desa_id')) {
                DB::table($table)->whereNull('desa_id')->update(['desa_id' => 1]);
            }
        }
    }

    public function down(): void {}
};
