<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Perbaikan aman untuk instalasi yang migration publikasi sudah tercatat
     * tetapi tabel publikasi belum ada atau kolom penting belum lengkap.
     */
    public function up(): void
    {
        if (!Schema::hasTable('publikasi')) {
            Schema::create('publikasi', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('desa_id')->default(1)->index();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category')->nullable();
                $table->enum('status', ['published', 'draft'])->default('draft');
                $table->string('image')->nullable();
                $table->text('excerpt')->nullable();
                $table->longText('content');
                $table->string('file')->nullable();
                $table->string('file_path')->nullable();
                $table->string('file_name')->nullable();
                $table->string('file_type')->nullable();
                $table->unsignedBigInteger('file_size')->nullable();
                $table->timestamp('published_at')->nullable();
                $table->timestamps();
            });

            return;
        }

        $columns = [
            'desa_id' => function (Blueprint $table) {
                $table->unsignedBigInteger('desa_id')->default(1)->after('id');
                $table->index('desa_id');
            },
            'file' => fn (Blueprint $table) => $table->string('file')->nullable(),
            'file_path' => fn (Blueprint $table) => $table->string('file_path')->nullable(),
            'file_name' => fn (Blueprint $table) => $table->string('file_name')->nullable(),
            'file_type' => fn (Blueprint $table) => $table->string('file_type')->nullable(),
            'file_size' => fn (Blueprint $table) => $table->unsignedBigInteger('file_size')->nullable(),
            'published_at' => fn (Blueprint $table) => $table->timestamp('published_at')->nullable(),
        ];

        foreach ($columns as $column => $definition) {
            if (!Schema::hasColumn('publikasi', $column)) {
                Schema::table('publikasi', $definition);
            }
        }
    }

    public function down(): void
    {
        // Tidak menghapus data publikasi yang sudah ada.
    }
};
