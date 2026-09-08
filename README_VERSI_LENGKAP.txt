DESA CANTIK - VERSI LENGKAP
============================

Versi ini disesuaikan berdasarkan dokumen "struktur website.docx" yang diberikan.
Dokumen meminta menu/opsi:
- Profil Desa: Tentang Desa, Profil Kepala Desa, Profil Wilayah, Visi dan Misi,
  Struktur Organisasi, Peta Desa, Perangkat Desa.
- Data Desa: Kependudukan, Pendidikan, Kesehatan, Pekerjaan Utama Penduduk,
  Fasilitas Desa, Data Sosial.
- Layanan Desa: Akta Kelahiran, Kartu Keluarga, Surat Keterangan Tidak Mampu,
  Pengantar Kematian, Pengantar Nikah, Pengantar SKCK.
- Publikasi: dokumen/data yang dapat diunduh CSV/PDF.
- Berita: artikel/berita desa.
- Kontak: halaman kontak dan pelayanan.

Struktur visual terinspirasi secara umum dari website referensi Panincong yang disebut di dokumen,
terutama pola navigasi, halaman informasi desa, data desa, publikasi, berita dan peta.
Konten Panincong tidak disalin; data desa tetap menggunakan data Desa Cantik.

DATABASE
--------
Database: desa_cantik
Host: 127.0.0.1
Port: 3306
User: root
Password: kosong (default XAMPP)

INSTALASI BARU
--------------
1. Ekstrak folder ke C:\xampp\htdocs\desa_cantik
2. Start Apache dan MySQL dari XAMPP.
3. Jalankan INSTALL_DESA_CANTIK.bat.
4. Jalankan MULAI_DESA_CANTIK.bat.
5. Buka http://127.0.0.1:8000

ADMIN
-----
URL: http://127.0.0.1:8000/admin/login
Email: admin@desacantik.id
Password: admin123

MENU ADMIN TAMBAHAN
-------------------
- Konten Halaman: mengatur submenu Profil Desa dan Data Desa.
- Publikasi/Berita: mengelola artikel, publikasi dan file unduhan.
- Data Desa: mengatur data statistik yang dipakai halaman publik.
- Layanan: mengatur layanan dan menerima pengajuan surat.
- Kontak: mengatur informasi kontak.

CATATAN
-------
File migration 2026_08_16_000001_sync_desa_columns.php menyelaraskan kolom desa_id
pada tabel lama agar sesuai dengan model/controller yang digunakan aplikasi.
Migration village_pages membuat tabel konten halaman baru.

Jika database lama berisi data penting, lakukan backup sebelum menjalankan INSTALL_DESA_CANTIK.bat
karena installer menggunakan migrate:fresh --seed.
