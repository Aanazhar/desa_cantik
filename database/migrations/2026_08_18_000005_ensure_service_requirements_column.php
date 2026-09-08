<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // This migration intentionally exists separately from the original
        // requirements migration. It repairs installations where the older
        // migration was marked as run but the column is missing.
        if (!Schema::hasTable('bagian_situs')) {
            return;
        }

        if (!Schema::hasColumn('bagian_situs', 'requirements')) {
            Schema::table('bagian_situs', function (Blueprint $table) {
                $table->json('requirements')->nullable()->after('form_fields');
            });
        }
    }

    public function down(): void
    {
        // Do not remove the column here. The original requirements migration
        // owns its lifecycle and this migration is only a repair safeguard.
    }
};
