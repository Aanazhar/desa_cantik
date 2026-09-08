DESA CANTIK - VERSI FIX SIAP JALAN
====================================

Perbaikan utama:
1. Model Publication sekarang memakai tabel Bahasa Indonesia: publikasi.
2. Ditambahkan migration perbaikan aman untuk membuat/melengkapi tabel publikasi.
3. Migration riwayat kepala desa yang duplikat dibuat no-op agar migrate:fresh tidak gagal.
4. Profil Desa tetap satu halaman.
5. Perangkat Desa tetap berada di bagian paling bawah halaman Profil Desa.
6. Menu Perangkat Desa terpisah tidak diperlukan.
7. Struktur model menggunakan tabel Bahasa Indonesia yang sudah ada.
8. Tidak menggunakan migrate:fresh pada database yang berisi data.

CARA MENJALANKAN:
- Extract ZIP ini ke D:\xampp\htdocs\desa_cantik
- Pastikan MySQL/XAMPP aktif.
- Pastikan database desa_cantik sudah ada.
- Klik dua kali JALANKAN_DESA_CANTIK.bat
  atau jalankan:
    composer install
    php artisan optimize:clear
    php artisan migrate
    php artisan serve

PENTING:
- Jangan menjalankan "php artisan migrate:fresh" jika database sudah berisi data.
- File .env tetap gunakan konfigurasi database milik kamu.
- Folder vendor tidak disertakan agar ZIP tetap ringan; script akan memasangnya otomatis.
