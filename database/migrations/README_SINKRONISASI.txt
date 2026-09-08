# Desa Cantik - Final Migration Set

Arsitektur:
- 1 project Laravel = 1 desa
- 1 database = 1 desa
- Tidak menggunakan desa_id untuk menggabungkan beberapa desa.
- Desa kedua/ketiga dibuat dari salinan project + database terpisah.

Migration yang sengaja TIDAK disertakan:
- 2026_08_11_063525_create_services_table.php
  Alasan: layanan memakai bagian_situs.
- 2026_08_15_000001_add_multi_desa_and_dynamic_forms.php
  Alasan: bagian multi-desa satu database bertentangan dengan arsitektur final. Dynamic form sudah dimasukkan ke create_bagian_situs.
- 2026_08_15_000003_fix_multidesa_content_unique.php
  Alasan: bergantung pada desa_id.
- 2026_08_15_000002_seed_dynamic_letter_fields.php
  Alasan: seeding dynamic form akan dilakukan setelah baseline database lama diverifikasi, agar tidak menimpa konfigurasi form yang sudah ada.

PENTING UNTUK DATABASE LAMA:
Jangan jalankan `php artisan migrate:fresh`.
Jangan langsung jalankan `php artisan migrate` pada database lama sebelum migration history/baseline disinkronkan.
Backup database terlebih dahulu.

Migration set ini ditujukan untuk instalasi DATABASE BARU/template dan sebagai dasar merapikan migration project.
