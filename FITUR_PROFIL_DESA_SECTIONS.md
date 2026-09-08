# Dokumentasi Fitur Profil Desa - Section Manager

## Deskripsi Fitur

Fitur ini menambahkan kemampuan untuk mengelola 7 section berbeda pada halaman profil desa:

1. **Tentang Desa** - Informasi umum tentang desa
2. **Profil Kepala Desa** - Profil dan informasi kepala desa
3. **Profil Wilayah** - Karakteristik wilayah dan batas administratif
4. **Visi & Misi** - Visi dan misi pembangunan desa
5. **Struktur Organisasi** - Struktur organisasi pemerintah desa
6. **Peta Desa** - Peta wilayah desa
7. **Perangkat Desa** - Daftar perangkat desa

## Fitur Utama

### Frontend
- Tampilan halaman profil desa dengan **tab/option navigation**
- Setiap section dapat ditampilkan atau disembunyikan (toggle aktif/nonaktif)
- Konten dapat berupa teks panjang
- Beberapa section dapat menampilkan gambar (profil kepala desa, struktur organisasi, peta desa, perangkat desa)
- Responsive design yang mobile-friendly

### Admin Panel
- Dashboard untuk mengelola semua section profil desa
- Editor konten untuk setiap section
- Upload gambar untuk section yang mendukung
- Toggle aktif/nonaktif untuk setiap section
- Pengurutan section (order)
- Terintegrasi dengan sistem multi-desa

## Struktur Database

### Tabel: `desa_profile_sections`

```
Kolom                 | Tipe          | Keterangan
----------------------|---------------|------------------------------------------
id                    | id            | Primary Key
desa_profile_id       | unsignedBigInt| Foreign Key ke desa_profiles
section_type          | enum          | Tipe section (7 pilihan di atas)
content               | text          | Konten/deskripsi section
image                 | string        | Path gambar untuk section tertentu
is_active             | boolean       | Status aktif/nonaktif section
order                 | integer       | Urutan tampilan section
created_at            | timestamp     | Waktu pembuatan
updated_at            | timestamp     | Waktu update terakhir

Unique Constraint: (desa_profile_id, section_type)
```

## File-File yang Dibuat

### Backend

1. **Migration**
   - `database/migrations/2026_08_16_000001_create_desa_profile_sections_table.php`

2. **Model**
   - `app/Models/DesaProfileSection.php`

3. **Controller Admin**
   - `app/Http/Controllers/Admin/DesaProfileSectionController.php`
   - Methods:
     - `index()` - Tampilkan halaman kelola section
     - `update()` - Update konten dan gambar section
     - `toggleActive()` - Toggle status aktif/nonaktif
     - `reorder()` - Mengubah urutan section

4. **Seeder**
   - `database/seeders/DesaProfileSectionSeeder.php`

### Frontend

1. **View**
   - `resources/views/profil-desa-tabbed.blade.php` - Halaman profil desa dengan tab

### Admin UI

1. **View**
   - `resources/views/admin/desa-profile-sections.blade.php` - Dashboard pengelola section

## Routes yang Ditambahkan

### Public Routes
- Tidak ada route baru, menggunakan route yang sudah ada: `/profil-desa`

### Admin Routes
```
GET    /admin/desa-profile-sections                    → admin.desa-profile-sections.index
PUT    /admin/desa-profile-sections/{id}               → admin.desa-profile-sections.update
PATCH  /admin/desa-profile-sections/{id}/toggle        → admin.desa-profile-sections.toggle-active
POST   /admin/desa-profile-sections/reorder             → admin.desa-profile-sections.reorder
```

## Cara Menggunakan

### Setup Awal (Development)

1. **Jalankan Migration**
   ```bash
   php artisan migrate
   ```

2. **Jalankan Seeder (Optional)**
   ```bash
   php artisan db:seed --class=DesaProfileSectionSeeder
   ```
   
   Atau jalankan semua seeder:
   ```bash
   php artisan db:seed
   ```

### Di Admin Panel

1. Login ke admin panel
2. Klik menu "Kelola Profil Desa" di sidebar
3. Atur konten untuk setiap section:
   - Ketik atau paste konten
   - Upload gambar (untuk section yang mendukung)
   - Toggle aktif/nonaktif untuk menampilkan atau menyembunyikan section
4. Klik "Simpan Section" untuk menyimpan perubahan

### Di Halaman Publik

1. Kunjungi `/profil-desa`
2. Scroll ke bagian "Section Profil Desa"
3. Klik pada tab section yang ingin dilihat
4. Konten akan ditampilkan dengan animasi fade-in

## Fitur Lanjutan

### Menambah Section Baru

Jika ingin menambah section baru, lakukan:

1. Update `DesaProfileSection::getAllSections()` di model:
   ```php
   public static function getAllSections()
   {
       return [
           'tentang_desa',
           'profil_kepala_desa',
           // ... section lainnya
           'section_baru' // Tambah di sini
       ];
   }
   ```

2. Update `getSectionLabel()` untuk label:
   ```php
   public static function getSectionLabel($type)
   {
       $labels = [
           // ... label lainnya
           'section_baru' => 'Label Section Baru',
       ];
       return $labels[$type] ?? $type;
   }
   ```

3. Jalankan migration untuk update enum di database

### Customization CSS

Styling dapat diubah di `resources/views/profil-desa-tabbed.blade.php` pada bagian `<style>`. Default menggunakan:
- Tab dengan border bottom
- Animasi fade-in saat mengubah tab
- Responsive untuk mobile

## Testing

### Manual Testing Checklist

- [ ] Migration berhasil dibuat
- [ ] Seeder berhasil menginisialisasi data
- [ ] Admin dapat mengakses halaman kelola section
- [ ] Admin dapat edit konten setiap section
- [ ] Admin dapat upload gambar
- [ ] Admin dapat toggle aktif/nonaktif
- [ ] Halaman publik menampilkan tab section
- [ ] Tab section berfungsi dan responsive
- [ ] Gambar ditampilkan dengan benar
- [ ] Hanya section aktif yang ditampilkan di publik

## Troubleshooting

### Halaman admin tidak muncul
- Pastikan migration sudah dijalankan: `php artisan migrate`
- Clear cache: `php artisan cache:clear`

### Gambar tidak terupload
- Pastikan folder `public/uploads` writable
- Check ukuran file max 5MB
- Format yang didukung: JPG, PNG, WebP, GIF

### Tab tidak berfungsi
- Buka browser console untuk cek error JS
- Pastikan tidak ada conflict dengan CSS/JS lain

### Migration Error
- Pastikan enum sudah support di database Anda
- MySQL 5.7.5+, PostgreSQL, SQLite sudah support enum

## Integrasi Dengan Model Existing

Model `DesaProfile` sudah memiliki relasi:
```php
public function sections()
{
    return $this->hasMany(DesaProfileSection::class, 'desa_profile_id');
}
```

Tambahkan ini jika belum ada.

## Performance

- Queries di-optimize dengan `where('is_active', true)` di controller
- Gunakan eager loading jika perlu: `with('sections')`
- Cache bisa ditambahkan di controller untuk performance lebih baik

## Keamanan

- Semua route admin dilindungi middleware `admin`
- CSRF protection sudah terintegrasi
- File upload di-validate (format, ukuran)
- Path file relative, tidak absolute

---

**Last Updated:** August 16, 2026
