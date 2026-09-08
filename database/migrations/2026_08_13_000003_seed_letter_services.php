<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        $letters=[
            ['Pembuatan Akta Kelahiran','Pengajuan dan informasi persyaratan akta kelahiran','👶'],
            ['Pembuatan Kartu Keluarga','Informasi dan pengajuan kebutuhan administrasi kartu keluarga','👨‍👩‍👧‍👦'],
            ['Surat Keterangan Tidak Mampu','Pengajuan surat keterangan tidak mampu','🤝'],
            ['Pengantar Surat Kematian','Pengantar administrasi kematian','🕊️'],
            ['Pengantar Nikah','Informasi persyaratan pengantar nikah','💍'],
            ['Surat Pengantar SKCK','Pengantar untuk kebutuhan SKCK','🛡️'],
        ];
        foreach($letters as [$title,$description,$icon]) DB::table('bagian_situs')->updateOrInsert(['title'=>$title,'type'=>'service'],['description'=>$description,'icon'=>$icon,'is_letter'=>true,'form_fields'=>json_encode([['name'=>'nama','label'=>'Nama Lengkap','type'=>'text','required'=>true],['name'=>'nik','label'=>'NIK','type'=>'text','required'=>true],['name'=>'no_hp','label'=>'No. HP / WhatsApp','type'=>'text','required'=>true],['name'=>'keperluan','label'=>'Keperluan','type'=>'textarea','required'=>true]]),'created_at'=>now(),'updated_at'=>now()]);
    }
    public function down(): void { DB::table('bagian_situs')->where('desa_id',1)->where('type','service')->whereIn('title',['Pembuatan Akta Kelahiran','Pembuatan Kartu Keluarga','Surat Keterangan Tidak Mampu','Pengantar Surat Kematian','Pengantar Nikah','Surat Pengantar SKCK'])->delete(); }
};
