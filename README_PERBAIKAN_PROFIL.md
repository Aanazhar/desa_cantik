# Desa Cantik - Perbaikan Profil Desa

Perubahan utama:

1. Menu publik **Profil Desa** sekarang langsung menuju satu halaman.
2. Dropdown Profil Desa dihapus.
3. **Perangkat Desa** tidak lagi tampil sebagai menu publik terpisah.
4. Perangkat Desa ditampilkan sebagai bagian **paling bawah** halaman Profil Desa.
5. Admin memiliki satu menu **Profil Desa** untuk mengelola identitas, bagian profil, dan Perangkat Desa.
6. Menu admin Perangkat Desa tetap tersedia melalui route lama agar kompatibilitas controller tetap terjaga, tetapi tidak ditampilkan di sidebar.
7. Warna biru pada area navigasi/profil/perangkat diganti ke palet hijau yang konsisten.
8. Nama tabel basis data aplikasi diseragamkan ke Bahasa Indonesia, misalnya:
   - `profil_desa`
   - `bagian_profil_desa`
   - `isi_situs`
   - `bagian_situs`
   - `statistik_desa`
   - `wilayah_desa`
   - `perangkat_desa`
   - `publikasi`
   - `pengajuan_surat`
   - `galeri_desa`
   - `riwayat_kepala_desa`
9. Model `DesaProfile` sudah diarahkan ke tabel `profil_desa` dan mendukung `history` serta `boundaries`.
10. Perbaikan syntax Blade dilakukan dengan struktur directive yang rapi.

## Instalasi

Jalankan di folder proyek:

```powershell
composer install
php artisan optimize:clear
php artisan migrate
php artisan serve
```

Jika database lama sudah berisi data, **backup database terlebih dahulu** dan jangan menggunakan `migrate:fresh` kecuali memang ingin menghapus seluruh data.
