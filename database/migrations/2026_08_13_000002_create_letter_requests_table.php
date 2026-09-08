<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengajuan_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')
                ->constrained('bagian_situs')
                ->cascadeOnDelete();
            $table->string('nama');
            $table->string('nik', 50);
            $table->string('no_hp', 30);
            $table->text('keperluan');
            $table->json('form_data')->nullable();
            $table->string('status')->default('Menunggu');
            $table->text('catatan_admin')->nullable();
            $table->timestamps();

            $table->index(['service_id', 'status']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengajuan_surat');
    }
};
