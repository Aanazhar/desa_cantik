# Desa Cantik — Versi Siap Hosting

Versi ini sudah disiapkan untuk deployment Laravel + MySQL/MariaDB.

## Fitur yang diperbarui

### Data Desa
- Grafik berjalan tanpa CDN eksternal.
- Ringkasan data, kategori penduduk, pendidikan, pekerjaan, sosial, fasilitas, umur, dan agama.
- Arsip data per tahun.
- Pilih tahun di halaman user dan admin.
- Download data tahun terpilih dalam CSV dan PDF.
- Admin dapat membuat/mengedit snapshot tahun tertentu.
- Grafik admin otomatis mengikuti data yang sedang dipilih.
- Grafik perkembangan penduduk dan keluarga per tahun.

### Layanan
- Setiap layanan pengajuan dapat mempunyai formulir sendiri.
- Persyaratan dokumen ditampilkan kepada user sebelum formulir diisi.
- Admin dapat mengatur persyaratan satu-per-baris.
- Admin dapat mengatur field formulir tambahan dalam JSON.
- Pengajuan masyarakat masuk ke database dan dapat diproses admin.

### Berita & Publikasi
- Admin dapat membuat berita/publikasi dengan gambar utama dan file pendukung.
- Status draft/published.
- Halaman berita publik memakai layout khusus berita.
- Halaman publikasi memiliki konten unggulan dan grid berita.
- Detail berita dan download dokumen berfungsi.
- Filter kategori dan export publikasi tetap tersedia.

## Instalasi lokal

1. Salin `.env.example` menjadi `.env` jika `.env` belum tersedia.
2. Atur database MySQL/MariaDB pada `.env`.
3. Jalankan:

```bash
composer install --no-dev --optimize-autoloader
php artisan key:generate
php artisan migrate --force
php artisan storage:link
php artisan optimize:clear
```

4. Jika menggunakan database dump yang sudah ada, import:

`database/desa_cantik_hosting.sql`

Lalu jalankan:

```bash
php artisan migrate --force
php artisan optimize:clear
```

## Hosting shared hosting

- Arahkan document root/domain ke folder `public/`.
- PHP minimal 8.2.
- Aktifkan extension umum Laravel: `mbstring`, `fileinfo`, `openssl`, `pdo_mysql`, `tokenizer`, `xml`, `ctype`, `json`.
- Pastikan folder `storage/` dan `bootstrap/cache/` dapat ditulis web server.
- Atur `.env` production:

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domain-anda.tld
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desa_cantik
DB_USERNAME=...
DB_PASSWORD=...
```

Setelah database siap:

```bash
php artisan migrate --force
php artisan optimize
```

## Catatan database

Migration baru:

`database/migrations/2026_08_18_000002_add_requirements_to_services.php`

menambahkan kolom JSON `requirements` pada layanan dan mengisi persyaratan default untuk layanan yang sudah ada.

## Catatan grafik

Grafik Data Desa tidak menggunakan Chart.js CDN. File:

`public/js/data-charts.js`

berisi renderer SVG/HTML sehingga grafik tetap tampil saat website dihosting tanpa akses ke CDN.
