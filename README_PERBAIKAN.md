# Desa Cantik — Paket Perbaikan

Paket ini adalah hasil pemeriksaan dan perbaikan dari ZIP proyek yang diberikan.

## Perbaikan utama

1. `app/Models/DesaProfile.php`
   - Memperbaiki method `villageHeads()` yang sebelumnya berada di luar class.
   - Ini merupakan salah satu penyebab autoload/controller dapat gagal dimuat.

2. `routes/web.php`
   - Memperbaiki route Profil Kepala Desa di admin yang sebelumnya membuat group `/admin` kedua di dalam group `/admin`.
   - Route sekarang benar:
     - `GET /admin/profil-kepala-desa`
     - `POST /admin/profil-kepala-desa`
     - `PUT /admin/profil-kepala-desa/{head}`
     - `DELETE /admin/profil-kepala-desa/{head}`
   - Nama route tetap `admin.profil-kepala-desa...`.
   - Menghapus route test duplikat.

3. `app/Http/Controllers/VillageHeadController.php`
   - Memperbaiki referensi view publik agar sesuai dengan file yang memang tersedia:
     `resources/views/publikasi/profil/profil-kepala-desa.blade.php`.

## Menjalankan di XAMPP

Di folder proyek:

```powershell
composer install
php artisan optimize:clear
php artisan migrate
php artisan storage:link
php artisan serve
```

Jika `storage:link` mengatakan link sudah ada, itu bukan error yang perlu diperbaiki. Lanjutkan ke langkah berikutnya.

Untuk frontend:

```powershell
npm install
npm run build
```

## Pemeriksaan yang sudah dilakukan pada paket

- Seluruh file PHP di `app`, `routes`, dan `database` diperiksa dengan `php -l`.
- Seluruh Blade view diperiksa dengan Blade compiler Laravel.
- Route Laravel dimuat langsung melalui router dan route utama berhasil terdaftar, termasuk:
  - `admin.dashboard`
  - `admin.data-desa.yearly`
  - `admin.data-desa.category`
  - `admin.layanan`
  - `admin.profil-kepala-desa`
  - `profil.kepala-desa`

## Catatan database

Migration untuk tabel `village_head_histories` sudah tersedia di:

`database/migrations/2026_08_18_055630_create_village_head_histories_table.php`

Jika database lama belum menjalankan migration tersebut, jalankan:

```powershell
php artisan migrate
```

Jangan menggunakan `migrate:fresh` pada database produksi karena perintah tersebut menghapus seluruh tabel.
