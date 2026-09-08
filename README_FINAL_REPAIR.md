# Desa Cantik — Final Repair

Versi ini merapikan UI publik/admin dan menyelaraskan alur data admin -> database -> user.

## Perbaikan utama

- UI publik dan admin menggunakan satu lapisan desain final yang konsisten dan responsif.
- Dashboard admin lebih rapi dan statistik diambil dari database.
- Data Desa:
  - input penuh per tahun;
  - input per kategori;
  - snapshot tahunan;
  - dropdown tahun;
  - grafik offline tanpa CDN;
  - CSV/PDF per tahun;
  - data dusun tersimpan ke database;
  - halaman user membaca snapshot tahun yang sama.
- Layanan:
  - daftar layanan;
  - persyaratan dokumen per layanan;
  - formulir pengajuan dinamis;
  - pengajuan masuk ke database;
  - admin dapat mengubah status pengajuan.
- Publikasi/Berita:
  - admin dapat membuat, mengedit, menghapus, draft/publish;
  - konten published otomatis muncul di user;
  - halaman berita dan publikasi menggunakan kartu responsif;
  - gambar/file pendukung.
- Kontak:
  - data kontak admin disimpan di `site_sections`;
  - halaman user membaca data kontak yang aktif.

## Menjalankan lokal

```bash
php artisan optimize:clear
php artisan migrate
php artisan serve
```

Jika database sudah berisi data, jangan gunakan `migrate:fresh`.

## Hosting

1. Arahkan document root/domain ke folder `public/`.
2. Atur `.env` production.
3. Import `database/desa_cantik_hosting.sql` bila membuat database dari dump.
4. Jalankan:

```bash
php artisan migrate --force
php artisan optimize
```

5. Pastikan `public/uploads` dapat ditulis oleh PHP/web server.

## Catatan

`php artisan view:cache` di lingkungan pengembangan tertentu dapat gagal jika ekstensi PHP `DOM` belum aktif. Itu berasal dari Termwind/CLI, bukan dari syntax Blade. Blade seluruh project pada paket ini sudah diuji dengan BladeCompiler secara langsung.
