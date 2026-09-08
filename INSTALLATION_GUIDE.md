# STEP-BY-STEP INSTALLATION GUIDE

## 🎯 Objective
Menambahkan fitur Profil Desa dengan 7 section yang dapat dikelola di admin panel dan ditampilkan dalam bentuk tab di halaman publik.

## ⏱️ Estimated Time
- Setup: 5 menit
- Testing: 10 menit
- Total: 15 menit

---

## BAGIAN 1: PRE-INSTALLATION CHECK
**Durasi: 2 menit**

### 1.1 Verifikasi PHP Version
```bash
php --version
# Output harus: PHP 8.0 atau lebih tinggi
```

### 1.2 Verifikasi Laravel
```bash
php artisan --version
# Output harus: Laravel 11 atau lebih tinggi
```

### 1.3 Verifikasi Database Connection
```bash
php artisan tinker
# Ketik: exit
# Jika berhasil, database sudah terkoneksi
```

### 1.4 Check Writable Directories
```bash
# Linux/Mac
chmod -R 755 storage bootstrap/cache public/uploads

# Windows - Gunakan Properties → Security → Edit permissions
# Atau run di PowerShell (Admin):
icacls "public/uploads" /grant "%USERNAME%:F" /T
```

---

## BAGIAN 2: INSTALLATION STEPS
**Durasi: 3 menit**

### STEP 1: Run Database Migration
**Apa yang dilakukan:** Membuat tabel `desa_profile_sections` di database

```bash
cd c:\xampp\htdocs\desa_cantik
php artisan migrate
```

**Expected Output:**
```
Migrating: 2026_08_16_000001_create_desa_profile_sections_table
Migrated:  2026_08_16_000001_create_desa_profile_sections_table (xxms)
```

**Jika Error:**
- Error: "Table doesn't exist" → Run `php artisan migrate:fresh`
- Error: "ENUM not supported" → Update MySQL ke 5.7.5+
- Error: "Connection refused" → Check database credentials di .env

---

### STEP 2: Initialize Data dengan Seeder
**Apa yang dilakukan:** Membuat default section untuk setiap desa yang sudah ada

```bash
php artisan db:seed --class=DesaProfileSectionSeeder
```

**Expected Output:**
```
Seeding: Database\Seeders\DesaProfileSectionSeeder
Seeded:  Database\Seeders\DesaProfileSectionSeeder
```

**Alternative: Seeding semua data**
```bash
php artisan db:seed
```

**Jika Error:**
- "Class DesaProfileSectionSeeder not found" → Migration sudah dijalankan?
- Check file ada di: `database/seeders/DesaProfileSectionSeeder.php`

---

### STEP 3: Clear Application Cache
**Apa yang dilakukan:** Clear cache untuk memastikan routing & config terbaru dimuat

```bash
php artisan cache:clear
php artisan config:cache
php artisan route:cache
```

**Alternative: Clear semua cache**
```bash
php artisan optimize:clear
```

---

### STEP 4: Verify Installation
**Apa yang dilakukan:** Memverifikasi semua file sudah ada dan sistem siap

**Option A: Automated Verification**
```bash
bash verify_installation.sh
```

**Option B: Manual Verification**
Cek apakah file-file ini ada:
- ✓ app/Models/DesaProfileSection.php
- ✓ app/Http/Controllers/Admin/DesaProfileSectionController.php
- ✓ resources/views/profil-desa-tabbed.blade.php
- ✓ resources/views/admin/desa-profile-sections.blade.php
- ✓ database/migrations/2026_08_16_000001_create_desa_profile_sections_table.php

---

## BAGIAN 3: TESTING
**Durasi: 10 menit**

### TEST 1: Database Verification
```bash
php artisan tinker

# Ketik di tinker:
>>> App\Models\DesaProfileSection::all()
# Harus return Collection dengan 7 section per desa

>>> App\Models\DesaProfileSection::where('is_active', true)->count()
# Harus return > 0
```

---

### TEST 2: Admin Panel Access
1. **Login ke Admin**
   - Buka: http://localhost/desa_cantik/admin/login
   - Username: admin@desacantik.id
   - Password: admin123

2. **Check Menu**
   - Lihat sidebar kiri
   - Cari menu "Kelola Profil Desa" (📋)
   - Menu harus muncul setelah "Profil Desa" (🏡)

3. **Click Menu**
   - Click menu "Kelola Profil Desa"
   - URL: http://localhost/desa_cantik/admin/desa-profile-sections
   - Harus tampil halaman dengan 7 section cards

---

### TEST 3: Edit Content
1. **Scroll down ke section "Tentang Desa"**
2. **Edit Konten:**
   - Clear textarea
   - Ketik: "Ini adalah desa cantik yang indah"
   - Click tombol "Simpan Section"
   - Harus muncul pesan sukses: "Section Tentang Desa berhasil disimpan."

3. **Toggle Active/Inactive:**
   - Click tombol "✓ Aktif" pada section "Profil Kepala Desa"
   - Button berubah menjadi "✗ Nonaktif"
   - Harus muncul pesan: "Status section berhasil diubah."

---

### TEST 4: Upload Image
1. **Pada section "Profil Kepala Desa":**
   - Click "Choose File" di section image
   - Pilih file JPG/PNG dari komputer (max 5MB)
   - Ketik konten: "Profil kepala desa kami..."
   - Click "Simpan Section"
   - Harus muncul preview gambar

2. **Verifikasi File Upload:**
   - Check folder: `public/uploads/`
   - Harus ada file gambar baru
   - Nama format: `timestamp_random_slug.jpg`

---

### TEST 5: Public Page Display
1. **Buka halaman profil publik:**
   - URL: http://localhost/desa_cantik/profil-desa
   - Scroll ke bawah

2. **Check Tab Navigation:**
   - Harus muncul 7 tab section
   - Tab "Tentang Desa" harus aktif (selected)
   - Content "Ini adalah desa cantik yang indah" harus tampil

3. **Test Tab Switching:**
   - Click tab "Profil Kepala Desa"
   - Tab harus berubah warna (aktif)
   - Konten dan gambar harus tampil
   - Click "Profil Wilayah"
   - Konten berubah dengan smooth animation

4. **Verify Active/Inactive:**
   - Jika section "Struktur Organisasi" dimatikan di admin
   - Tab "Struktur Organisasi" TIDAK boleh tampil di publik
   - Hanya 6 tab yang muncul (bukan 7)

---

### TEST 6: Mobile Responsiveness
1. **Di Chrome DevTools:**
   - Press F12
   - Click device toggle (Ctrl+Shift+M)
   - View pada mobile size (375px)

2. **Check:**
   - Tabs harus wrappable
   - Text readable
   - Gambar scaled properly
   - Touch friendly

---

## BAGIAN 4: COMMON ISSUES & SOLUTIONS
**Troubleshooting Guide**

### Issue 1: Menu "Kelola Profil Desa" tidak muncul
**Solution:**
```bash
php artisan cache:clear
# Refresh browser: Ctrl+Shift+R
# Logout dan login kembali
```

### Issue 2: Error "Table 'desa_profile_sections' doesn't exist"
**Solution:**
```bash
php artisan migrate
# Pastikan tidak ada error di output
# Check database lewat phpmyadmin
```

### Issue 3: File upload gagal / Error 500
**Solution:**
```bash
# Windows PowerShell (Run as Admin):
icacls "C:\xampp\htdocs\desa_cantik\public\uploads" /grant "%USERNAME%:F" /T

# Linux/Mac:
chmod -R 755 storage bootstrap/cache public/uploads
sudo chown -R www-data:www-data public/uploads
```

### Issue 4: Tab tidak switch saat di-click
**Solution:**
- Open Chrome DevTools (F12)
- Check Console untuk JavaScript error
- Clear browser cache: Ctrl+Shift+Delete
- Refresh page

### Issue 5: Seeder error "Class not found"
**Solution:**
```bash
# Pastikan file ada:
ls database/seeders/DesaProfileSectionSeeder.php

# Regenerate composer autoload:
composer dump-autoload

# Try seeder lagi:
php artisan db:seed --class=DesaProfileSectionSeeder
```

### Issue 6: Image size too large
**Solution:**
- Max file size: 5MB
- Resize image sebelum upload
- Format yang didukung: JPG, JPEG, PNG, WebP, GIF
- Gunakan tool seperti Photoshop, Paint, atau online converter

---

## BAGIAN 5: POST-INSTALLATION
**Setup Produksi**

### 5.1 Environment Configuration (.env)
```bash
# Development (sudah oke)
APP_ENV=local
APP_DEBUG=true

# Untuk Production (ubah ke):
APP_ENV=production
APP_DEBUG=false
```

### 5.2 Database Backup
```bash
# Backup database sebelum deploy
mysqldump -u root -p desa_cantik > desa_cantik_backup.sql
```

### 5.3 File Permissions
```bash
# Linux Production:
chmod -R 755 storage bootstrap/cache public/uploads
sudo chown -R www-data:www-data .

# Windows IIS:
# Set folder permissions via GUI: Everyone, Full Control
```

### 5.4 Deployment Checklist
```
□ Run migrate di server
□ Run seeder di server
□ Clear cache di server
□ Set .env APP_ENV=production
□ Set .env APP_DEBUG=false
□ Verify public/uploads writable
□ Test admin panel
□ Test public page
□ Check error logs
□ Verify backups
```

---

## BAGIAN 6: VERIFICATION COMMANDS

### Quick Health Check
```bash
php artisan tinker
>>> App\Models\DesaProfileSection::count()
>>> exit
```

### Routes Check
```bash
php artisan route:list | grep desa-profile-sections
```

### Database Check
```bash
# Login to MySQL
mysql -u root -p

# Di MySQL:
USE desa_cantik;
SELECT * FROM desa_profile_sections;
DESCRIBE desa_profile_sections;
```

### File Permissions Check
```bash
# Linux/Mac:
ls -la public/uploads/

# Windows PowerShell:
Get-Acl public\uploads | Format-List
```

---

## BAGIAN 7: ROLLBACK (Jika diperlukan)

### Undo Migration
```bash
# Rollback last migration:
php artisan migrate:rollback

# Rollback specific migration:
php artisan migrate:rollback --target=2026_08_16_000001_create_desa_profile_sections_table

# Reset all migrations:
php artisan migrate:reset
```

### Restore Database
```bash
# Restore dari backup:
mysql -u root -p desa_cantik < desa_cantik_backup.sql
```

---

## 📞 SUPPORT RESOURCES

### Documentation Files
- FITUR_PROFIL_DESA_SECTIONS.md → Full documentation
- IMPLEMENTASI_SUMMARY.md → Technical details
- ARCHITECTURE.md → System architecture
- QUICK_START.txt → Quick reference

### Helpful Commands
```bash
# Check app status:
php artisan tinker

# View logs:
tail -f storage/logs/laravel.log

# Clear all caches:
php artisan optimize:clear

# Run specific test:
php artisan test tests/Feature/DesaProfileSectionTest.php
```

---

## ✅ SUCCESS CRITERIA

Installation is successful when:
- ✓ Migration runs without errors
- ✓ Seeder initializes data
- ✓ Admin menu "Kelola Profil Desa" visible
- ✓ Can access /admin/desa-profile-sections
- ✓ Can edit content and upload images
- ✓ Public page /profil-desa shows tabs
- ✓ Tab switching works smoothly
- ✓ Only active sections visible in public

---

## 📅 INSTALLATION TIMELINE

```
Time    Task                           Status
──────────────────────────────────────────────
0:00    Pre-install check              ⏳
0:02    Run migration                  ⏳
0:03    Run seeder                     ⏳
0:04    Clear cache                    ⏳
0:05    Test admin panel               ⏳
0:07    Edit content & upload image    ⏳
0:09    Test public page               ⏳
0:12    Test mobile responsiveness     ⏳
0:15    COMPLETE ✅                     ✅
```

---

**Installation Guide v1.0**
**Last Updated: August 16, 2026**
**Status: Ready to Use**
