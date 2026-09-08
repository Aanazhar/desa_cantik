<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_kepala_desa', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Desa
            |--------------------------------------------------------------------------
            */
            $table->unsignedBigInteger('desa_id');

            /*
            |--------------------------------------------------------------------------
            | Data Kepala Desa
            |--------------------------------------------------------------------------
            */
            $table->string('nama');

            $table->unsignedSmallInteger('tahun_mulai');

            $table->unsignedSmallInteger('tahun_selesai')->nullable();

            $table->string('foto')->nullable();

            $table->string('pendidikan')->nullable();

            $table->string('tempat_lahir')->nullable();

            $table->date('tanggal_lahir')->nullable();

            $table->text('biografi')->nullable();

            $table->text('visi')->nullable();

            $table->text('misi')->nullable();

            $table->text('keterangan')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->boolean('aktif')->default(true);

            $table->unsignedInteger('urutan')->default(0);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Relasi ke profil_desa
            |--------------------------------------------------------------------------
            */
            $table->foreign('desa_id')
                ->references('id')
                ->on('profil_desa')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Index
            |--------------------------------------------------------------------------
            */
            $table->index([
                'desa_id',
                'tahun_mulai',
                'tahun_selesai'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_kepala_desa');
    }
};