<?php
namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\DesaProfile;
use App\Models\DesaStatistic;
use App\Models\DesaVillage;
use App\Models\SiteContent;
use App\Models\SiteSection;
use App\Models\VillagePage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            DesaProfileSectionSeeder::class,
        ]);
        $desa=DesaProfile::updateOrCreate(['id'=>1],[
            'name'=>'Desa Cantik','code'=>'DC-001','address'=>'Kantor Desa Cantik','district'=>'Kecamatan','regency'=>'Kabupaten','province'=>'Sulawesi Selatan',
            'phone'=>'','email'=>'desa@desacantik.id','description'=>'Website resmi Pemerintah Desa Cantik sebagai pusat informasi, data dan pelayanan masyarakat.','vision'=>'Terwujudnya Desa Cantik yang maju, transparan, sejahtera dan melayani.','mission'=>'Meningkatkan pelayanan publik, keterbukaan informasi, pemberdayaan masyarakat dan pembangunan desa.','is_active'=>true
        ]);
        session(['desa_id'=>1]);

        AdminUser::updateOrCreate(['email'=>'admin@desacantik.id'],['name'=>'Administrator Desa Cantik','password'=>Hash::make('admin123')]);

        DesaStatistic::updateOrCreate(['desa_id'=>1],['total_penduduk'=>0,'laki_laki'=>0,'perempuan'=>0,'kepala_keluarga'=>0]);

        foreach(['Dusun Utama','Dusun Sejahtera'] as $i=>$name){ DesaVillage::updateOrCreate(['desa_id'=>1,'nama_dusun'=>$name],['jumlah_rt'=>0,'jumlah_penduduk'=>0]); }

        $contents=[
            'hero_badge'=>'WEBSITE RESMI PEMERINTAH DESA','hero_title'=>'Selamat Datang di Website Desa Cantik','hero_description'=>'Pusat informasi, data, berita, publikasi dan pelayanan masyarakat Desa Cantik.','about_title'=>'Mengenal Desa Cantik','about_description'=>'Kelola profil, potensi, data dan pelayanan desa secara terbuka melalui satu website.','publication_badge'=>'PUBLIKASI DESA','publication_title'=>'Informasi & Dokumen Desa','publication_description'=>'Unduh publikasi desa dalam bentuk dokumen dan data yang tersedia.','publication_button'=>'Lihat Publikasi','publication_link'=>'/publikasi'
        ];
        foreach($contents as $key=>$value) SiteContent::updateOrCreate(['desa_id'=>1,'key'=>$key],['value'=>$value]);

        SiteSection::whereNull('desa_id')->where('type','service')->delete();

        $services=[
            ['Pembuatan Akta Kelahiran','Pengajuan dan informasi persyaratan akta kelahiran','👶'],['Pembuatan Kartu Keluarga','Informasi dan pengajuan kebutuhan administrasi kartu keluarga','👨‍👩‍👧‍👦'],['Surat Keterangan Tidak Mampu','Pengajuan surat keterangan tidak mampu','🤝'],['Pengantar Surat Kematian','Pengantar administrasi kematian','🕊️'],['Pengantar Nikah','Informasi persyaratan pengantar nikah','💍'],['Surat Pengantar SKCK','Pengantar untuk kebutuhan SKCK','🛡️']
        ];
        foreach($services as $s) SiteSection::updateOrCreate(['desa_id'=>1,'title'=>$s[0], 'type'=>'service'],['description'=>$s[1],'icon'=>$s[2],'is_letter'=>true,'form_fields'=>[['name'=>'nama','label'=>'Nama Lengkap','type'=>'text','required'=>true],['name'=>'nik','label'=>'NIK','type'=>'text','required'=>true],['name'=>'no_hp','label'=>'No. HP / WhatsApp','type'=>'text','required'=>true],['name'=>'keperluan','label'=>'Keperluan','type'=>'textarea','required'=>true]]]);

        $pages=[
            ['profil','tentang-desa','Tentang Desa','Profil singkat dan informasi umum desa','<p>Halaman ini berisi informasi umum Desa Cantik, pelayanan pemerintahan, potensi dan karakteristik desa.</p>'],
            ['profil','sejarah-desa','Sejarah Desa','Sejarah dan perkembangan desa','<p>Masukkan sejarah Desa Cantik di halaman administrasi agar masyarakat dapat mengenal perjalanan desa dari masa ke masa.</p>'],
            ['profil','kepala-desa','Profil Kepala Desa','Profil kepala desa','<p>Informasi kepala desa, masa jabatan, foto dan sambutan dapat dikelola oleh administrator.</p>'],
            ['profil','profil-wilayah','Profil Wilayah','Wilayah dan batas desa','<p>Informasi wilayah, luas desa, batas utara, timur, selatan dan barat dapat ditampilkan di halaman ini.</p>'],
            ['profil','visi-dan-misi','Visi dan Misi','Visi dan misi pembangunan desa','<p><strong>Visi</strong><br>Terwujudnya Desa Cantik yang maju, transparan, sejahtera dan melayani.</p><p><strong>Misi</strong><br>Meningkatkan pelayanan publik, keterbukaan informasi, pemberdayaan masyarakat dan pembangunan desa.</p>'],
            ['profil','struktur-organisasi','Struktur Organisasi','Struktur organisasi pemerintah desa','<p>Struktur organisasi pemerintah desa dapat dilengkapi dengan jabatan, nama perangkat dan foto.</p>'],
            ['profil','peta-desa','Peta Desa','Peta wilayah desa','<p>Tambahkan embed Google Maps/OpenStreetMap atau gambar peta desa melalui editor halaman.</p>'],
            ['profil','perangkat-desa','Perangkat Desa','Daftar perangkat desa','<p>Daftar kepala desa, sekretaris desa, kepala urusan, kepala seksi dan kepala dusun dapat ditampilkan di sini.</p>'],
            ['data','kependudukan','Kependudukan','Data jumlah penduduk dan keluarga','<p>Data kependudukan ditampilkan dari menu Data Desa dan dapat diperbarui admin.</p>'],
            ['data','pendidikan','Pendidikan','Data pendidikan masyarakat','<p>Data pendidikan mulai dari belum sekolah, SD, SMP, SMA/SMK, diploma hingga sarjana.</p>'],
            ['data','kesehatan','Kesehatan','Data kesehatan desa','<p>Data kesehatan seperti balita, lansia, disabilitas, posyandu dan fasilitas kesehatan.</p>'],
            ['data','pekerjaan','Pekerjaan Utama','Data pekerjaan utama penduduk','<p>Data mata pencaharian seperti petani, nelayan, pedagang, wiraswasta, PNS, karyawan dan lainnya.</p>'],
            ['data','fasilitas-desa','Fasilitas Desa','Data fasilitas desa','<p>Data sekolah, posyandu, puskesmas/polindes dan tempat ibadah.</p>'],
            ['data','sosial','Data Sosial','Data sosial masyarakat','<p>Data keluarga miskin, kelompok masyarakat dan indikator sosial desa.</p>'],
        ];
        foreach($pages as $i=>$p) VillagePage::updateOrCreate(['desa_id'=>1,'slug'=>$p[1]],['category'=>$p[0],'title'=>$p[2],'excerpt'=>$p[3],'body'=>$p[4],'sort_order'=>$i,'active'=>true]);
    }
}
