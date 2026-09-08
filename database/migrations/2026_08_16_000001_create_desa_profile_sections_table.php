<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bagian_profil_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('desa_profile_id');
            $table->enum('section_type', [
                'tentang_desa',
                'profil_kepala_desa',
                'profil_wilayah',
                'visi_misi',
                'struktur_organisasi',
                'peta_desa',
                'perangkat_desa'
            ]);
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->integer('order')->default(0);
            $table->timestamps();
            
            $table->foreign('desa_profile_id')
                ->references('id')
                ->on('profil_desa')
                ->onDelete('cascade');
            
            $table->unique(['desa_profile_id', 'section_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bagian_profil_desa');
    }
};
