<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesaStatistic extends Model
{
    protected $table = 'statistik_desa';

    protected $fillable = [
        'desa_id',

        // Penduduk
        'total_penduduk',
        'laki_laki',
        'perempuan',
        'kepala_keluarga',
        'keluarga_miskin',

        // Kategori umur & sosial
        'balita',
        'anak',
        'remaja',
        'dewasa',
        'lansia',
        'disabilitas',

        // Pendidikan
        'belum_sekolah',
        'sd',
        'smp',
        'sma',
        'diploma',
        'sarjana',

        // Pekerjaan
        'petani',
        'nelayan',
        'pedagang',
        'wiraswasta',
        'pns',
        'karyawan',
        'pelajar',
        'belum_bekerja',

        // Perumahan & Tempat Tinggal
        'rumah_sendiri',
        'rumah_sewa',
        'bebas_sewa',
        'menumpang',
        'rumah_tinggal',
        'toko',
        'fasilitas',
        'bangunan_lain',

        // Status Perkawinan
        'belum_kawin',
        'kawin',
        'cerai_hidup',
        'cerai_mati',

        // Agama
        'islam',
        'kristen',
        'katolik',
        'hindu',
        'buddha',
        'konghucu',
        'kepercayaan_lainnya',

        // Fasilitas
        'sekolah',
        'posyandu',
        'puskesmas',
        'tempat_ibadah',

        // File Berkas & Catatan
        'file_csv',
        'file_pdf',
        'luas_wilayah',
        'catatan',
    ];

    protected $casts = [
        'desa_id' => 'integer',

        'total_penduduk' => 'integer',
        'laki_laki' => 'integer',
        'perempuan' => 'integer',
        'kepala_keluarga' => 'integer',
        'keluarga_miskin' => 'integer',

        'balita' => 'integer',
        'anak' => 'integer',
        'remaja' => 'integer',
        'dewasa' => 'integer',
        'lansia' => 'integer',
        'disabilitas' => 'integer',

        'belum_sekolah' => 'integer',
        'sd' => 'integer',
        'smp' => 'integer',
        'sma' => 'integer',
        'diploma' => 'integer',
        'sarjana' => 'integer',

        'petani' => 'integer',
        'nelayan' => 'integer',
        'pedagang' => 'integer',
        'wiraswasta' => 'integer',
        'pns' => 'integer',
        'karyawan' => 'integer',
        'pelajar' => 'integer',
        'belum_bekerja' => 'integer',

        'rumah_sendiri' => 'integer',
        'rumah_sewa' => 'integer',
        'bebas_sewa' => 'integer',
        'menumpang' => 'integer',
        'rumah_tinggal' => 'integer',
        'toko' => 'integer',
        'fasilitas' => 'integer',
        'bangunan_lain' => 'integer',

        'belum_kawin' => 'integer',
        'kawin' => 'integer',
        'cerai_hidup' => 'integer',
        'cerai_mati' => 'integer',

        'sekolah' => 'integer',
        'posyandu' => 'integer',
        'puskesmas' => 'integer',
        'tempat_ibadah' => 'integer',

        'islam' => 'integer',
        'kristen' => 'integer',
        'katolik' => 'integer',
        'hindu' => 'integer',
        'buddha' => 'integer',
        'konghucu' => 'integer',
        'kepercayaan_lainnya' => 'integer',

        'luas_wilayah' => 'decimal:2',
    ];
}