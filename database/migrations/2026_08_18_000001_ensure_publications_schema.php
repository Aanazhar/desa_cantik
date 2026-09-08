<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('publikasi') && !Schema::hasColumn('publikasi', 'file')) {
            Schema::table('publikasi', function (Blueprint $table) {
                $table->string('file')->nullable()->after('content');
            });
        }

        if (Schema::hasTable('publikasi') && !Schema::hasColumn('publikasi', 'desa_id')) {
            Schema::table('publikasi', function (Blueprint $table) {
                $table->unsignedBigInteger('desa_id')->default(1)->after('id');
                $table->index('desa_id');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('publikasi')) {
            Schema::table('publikasi', function (Blueprint $table) {
                if (Schema::hasColumn('publikasi', 'file')) {
                    $table->dropColumn('file');
                }
                if (Schema::hasColumn('publikasi', 'desa_id')) {
                    $table->dropIndex(['desa_id']);
                    $table->dropColumn('desa_id');
                }
            });
        }
    }
};
