<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('statistik_desa', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('total_penduduk')->default(0);
            $table->unsignedInteger('laki_laki')->default(0);
            $table->unsignedInteger('perempuan')->default(0);
            $table->unsignedInteger('kepala_keluarga')->default(0);
            $table->unsignedInteger('keluarga_miskin')->default(0);
            $table->unsignedInteger('balita')->default(0);
            $table->unsignedInteger('anak')->default(0);
            $table->unsignedInteger('remaja')->default(0);
            $table->unsignedInteger('dewasa')->default(0);
            $table->unsignedInteger('lansia')->default(0);
            $table->unsignedInteger('disabilitas')->default(0);
            $table->unsignedInteger('belum_sekolah')->default(0);
            $table->unsignedInteger('sd')->default(0);
            $table->unsignedInteger('smp')->default(0);
            $table->unsignedInteger('sma')->default(0);
            $table->unsignedInteger('diploma')->default(0);
            $table->unsignedInteger('sarjana')->default(0);
            $table->unsignedInteger('petani')->default(0);
            $table->unsignedInteger('nelayan')->default(0);
            $table->unsignedInteger('pedagang')->default(0);
            $table->unsignedInteger('wiraswasta')->default(0);
            $table->unsignedInteger('pns')->default(0);
            $table->unsignedInteger('karyawan')->default(0);
            $table->unsignedInteger('pelajar')->default(0);
            $table->unsignedInteger('belum_bekerja')->default(0);
            $table->unsignedInteger('sekolah')->default(0);
            $table->unsignedInteger('posyandu')->default(0);
            $table->unsignedInteger('puskesmas')->default(0);
            $table->unsignedInteger('tempat_ibadah')->default(0);
            $table->decimal('luas_wilayah', 12, 2)->default(0);
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('statistik_desa');
    }
};
