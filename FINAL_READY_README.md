# Desa Cantik - Paket Final Siap Dijalankan

Paket ini merupakan perbaikan dari versi proyek sebelumnya. Fokus perbaikan pada layanan, pengajuan masyarakat, kontak/media sosial, routing, dan kestabilan Blade.

## Perbaikan utama

1. **Admin > Layanan** sekarang berbentuk dropdown/accordion per layanan.
   - Setiap layanan bisa diedit sendiri.
   - Nama, ikon, deskripsi, urutan, status aktif/nonaktif dapat diubah.
   - Layanan pengajuan dapat memiliki persyaratan dokumen.
   - Field formulir tambahan dapat diatur dengan JSON.
2. **Admin > Pengajuan Masyarakat** dibuat sebagai halaman khusus.
   - Menampilkan kode pengajuan, waktu, pemohon, layanan, data formulir.
   - Admin dapat mengubah status: Menunggu, Diproses, Selesai, Ditolak.
   - Admin dapat menambahkan catatan.
3. **User > Layanan** menampilkan persyaratan sebelum formulir pengajuan.
4. **User > Cek Status Pengajuan** tersedia di `/layanan/status`.
   - Pemohon memasukkan kode pengajuan + NIK.
   - Status dan catatan petugas ditampilkan.
5. Setiap pengajuan otomatis mendapat **kode tracking `DC-XXXXXXXX`**.
6. **Admin > Kontak** dapat menambah dan mengedit:
   - Telepon
   - WhatsApp
   - Email
   - Instagram
   - Facebook
   - YouTube
   - Website
   - Tautan lain
7. Kontak/media sosial tampil sebagai tautan yang dapat diklik di halaman user.
8. Route lama untuk pengajuan tetap dipertahankan sebagai alias agar kompatibel dengan halaman lama.
9. Ditambahkan migration untuk kolom `url` pada `site_sections` dan `tracking_code` pada `letter_requests`.
10. SQL hosting diperbarui agar kolom baru ikut tersedia saat import database.

## Menjalankan di XAMPP

1. Extract folder `desa_cantik` ke `C:\xampp\htdocs\`.
2. Buat database MySQL bernama `desa_cantik`.
3. Import `database/desa_cantik_hosting.sql` melalui phpMyAdmin.
4. Periksa `.env`:

```env
APP_URL=http://127.0.0.1:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_cantik
DB_USERNAME=root
DB_PASSWORD=
```

5. Jalankan:

```bash
php artisan optimize:clear
php artisan serve
```

6. Buka:

```text
http://127.0.0.1:8000
```

7. Admin:

```text
http://127.0.0.1:8000/admin/login
```

## Hosting

- Arahkan document root/domain ke folder `public` Laravel.
- Pastikan PHP dan extension database sesuai dengan kebutuhan Laravel 12.
- Jalankan `composer install --no-dev --optimize-autoloader` bila vendor tidak ikut dipakai.
- Atur `.env` sesuai database hosting.
- Jalankan `php artisan optimize:clear` lalu `php artisan config:cache` dan `php artisan route:cache` setelah konfigurasi benar.

## Pemeriksaan yang dilakukan

- PHP syntax controller/model/migration/route: OK.
- Semua 36 template Blade berhasil dikompilasi menggunakan BladeCompiler tanpa syntax error.
- Nama route yang digunakan oleh halaman layanan/kontak/pengajuan sudah disediakan.
- Pengujian database langsung tidak dapat dilakukan di lingkungan build ini karena PHP CLI tidak memiliki driver PDO database. Database target proyek tetap MySQL.

## PERBAIKAN DATABASE YANG SUDAH ADA

Jika database `desa_cantik` Anda dibuat/import dari versi sebelumnya dan saat menyimpan layanan muncul:

`SQLSTATE[42S22]: Unknown column 'requirements' in 'field list'`

jalankan:

```bash
php artisan migrate
php artisan optimize:clear
```

Versi ini memiliki migration `2026_08_18_000005_ensure_service_requirements_column` yang sengaja dibuat untuk memperbaiki instalasi lama walaupun migration requirements sebelumnya sudah tercatat sebagai `Ran`.

Alternatif phpMyAdmin: import/execute file `database/REPAIR_EXISTING_DATABASE.sql`.
