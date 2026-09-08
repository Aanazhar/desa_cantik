<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        $tables=['isi_situs','bagian_situs','statistik_desa','wilayah_desa','riwayat_kepala_desa','perangkat_desa','galeri_desa','riwayat_statistik_desa','pengajuan_surat','publikasi'];
        foreach($tables as $table){
            if(Schema::hasTable($table) && !Schema::hasColumn($table,'desa_id')){
                Schema::table($table,function(Blueprint $t){ $t->unsignedBigInteger('desa_id')->nullable()->after('id'); $t->index('desa_id'); });
            }
        }
    }
    public function down(): void
    {
        $tables=['isi_situs','bagian_situs','statistik_desa','wilayah_desa','riwayat_kepala_desa','perangkat_desa','galeri_desa','riwayat_statistik_desa','pengajuan_surat','publikasi'];
        foreach($tables as $table){ if(Schema::hasTable($table) && Schema::hasColumn($table,'desa_id')) Schema::table($table,function(Blueprint $t){$t->dropIndex(['desa_id']);$t->dropColumn('desa_id');}); }
    }
};
