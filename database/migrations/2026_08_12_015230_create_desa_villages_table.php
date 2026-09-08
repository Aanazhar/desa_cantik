<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('wilayah_desa', function (Blueprint $table) {
            $table->id();

            $table->string('nama_dusun');
            $table->unsignedInteger('jumlah_rt')->default(0);
            $table->unsignedInteger('jumlah_penduduk')->default(0);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('wilayah_desa');
    }
};