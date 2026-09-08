<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * The project now stores contact data in the bagian_situs table.
     * Older versions used a kontak table, so this migration is kept
     * backward-compatible for databases that still have that table.
     */
    public function up(): void
    {
        if (!Schema::hasTable('kontak')) {
            return;
        }

        if (!Schema::hasColumn('kontak', 'type')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->string('type')
                    ->default('other')
                    ->after('id');
            });
        }
    }

    public function down(): void
    {
        if (!Schema::hasTable('kontak')) {
            return;
        }

        if (Schema::hasColumn('kontak', 'type')) {
            Schema::table('kontak', function (Blueprint $table) {
                $table->dropColumn('type');
            });
        }
    }
};
