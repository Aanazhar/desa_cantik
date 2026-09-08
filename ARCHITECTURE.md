# ARCHITECTURE & DATABASE DESIGN

## 📐 System Architecture

```
┌─────────────────────────────────────────────────────────────────┐
│                        USER INTERFACE                           │
│                                                                 │
│  ┌──────────────────┐         ┌────────────────────────────┐   │
│  │ PUBLIC FRONTEND  │         │   ADMIN PANEL              │   │
│  │                  │         │                            │   │
│  │ /profil-desa     │◄───────►│ /admin/desa-profile-      │   │
│  │ (View with tabs) │         │  sections                  │   │
│  │                  │         │ (Manage content)           │   │
│  └──────────────────┘         └────────────────────────────┘   │
│           ▲                              ▲                      │
└───────────┼──────────────────────────────┼──────────────────────┘
            │                              │
            └──────────────┬───────────────┘
                           │
┌──────────────────────────▼───────────────────────────────────────┐
│                    CONTROLLER LAYER                              │
│                                                                 │
│  ┌────────────────────────────────────┐                        │
│  │  HomeController::profile()         │                        │
│  │  - Fetch active sections           │                        │
│  │  - Pass to view                    │                        │
│  └────────────────────────────────────┘                        │
│                                                                 │
│  ┌────────────────────────────────────┐                        │
│  │  DesaProfileSectionController      │                        │
│  │  - index()   - Show all sections   │                        │
│  │  - update()  - Save content/image  │                        │
│  │  - toggle()  - Active/inactive     │                        │
│  │  - reorder() - Change order        │                        │
│  └────────────────────────────────────┘                        │
└───────────────────────────┬───────────────────────────────────────┘
                            │
┌───────────────────────────▼───────────────────────────────────────┐
│                      MODEL LAYER                                 │
│                                                                 │
│  ┌────────────────────────────────────┐                        │
│  │ DesaProfileSection Model           │                        │
│  │ - Relationships                    │                        │
│  │ - Accessors                        │                        │
│  │ - Mutators                         │                        │
│  └────────────────────────────────────┘                        │
└───────────────────────────┬───────────────────────────────────────┘
                            │
┌───────────────────────────▼───────────────────────────────────────┐
│                   DATABASE LAYER                                 │
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  desa_profile_sections Table                              │  │
│  │  └─ Related to desa_profiles (FK)                         │  │
│  └──────────────────────────────────────────────────────────┘  │
│                                                                 │
│  ┌──────────────────────────────────────────────────────────┐  │
│  │  File Storage                                              │  │
│  │  └─ public/uploads/ (Images)                              │  │
│  └──────────────────────────────────────────────────────────┘  │
└──────────────────────────────────────────────────────────────────┘
```

## 🗄️ Database Schema Detailed

### Table: desa_profiles
```
Existing table - No changes needed
┌──────────────┬─────────────┬─────────────────────────────┐
│ id           │ BIGINT (PK) │ Primary Key                 │
│ name         │ VARCHAR     │ Nama desa                   │
│ code         │ VARCHAR     │ Kode desa                   │
│ ... fields   │             │ (existing fields)           │
└──────────────┴─────────────┴─────────────────────────────┘
```

### Table: desa_profile_sections (NEW)
```
┌─────────────────┬──────────────────────┬─────────────────────┐
│ Column          │ Type                 │ Constraints/Notes   │
├─────────────────┼──────────────────────┼─────────────────────┤
│ id              │ BIGINT (PK)          │ Auto increment      │
│ desa_profile_id │ BIGINT (FK)          │ References:         │
│                 │                      │ desa_profiles.id    │
│                 │                      │ ON DELETE CASCADE   │
├─────────────────┼──────────────────────┼─────────────────────┤
│ section_type    │ ENUM(7)              │ Values:             │
│                 │                      │ 1. tentang_desa     │
│                 │                      │ 2. profil_kepala... │
│                 │                      │ 3. profil_wilayah   │
│                 │                      │ 4. visi_misi        │
│                 │                      │ 5. struktur_org...  │
│                 │                      │ 6. peta_desa        │
│                 │                      │ 7. perangkat_desa   │
├─────────────────┼──────────────────────┼─────────────────────┤
│ content         │ TEXT                 │ Konten/deskripsi    │
│                 │                      │ Nullable            │
├─────────────────┼──────────────────────┼─────────────────────┤
│ image           │ VARCHAR              │ Path file gambar    │
│                 │                      │ Nullable            │
│                 │                      │ Format: /uploads/.. │
├─────────────────┼──────────────────────┼─────────────────────┤
│ is_active       │ BOOLEAN              │ Default: true       │
│                 │                      │ Toggle visible      │
├─────────────────┼──────────────────────┼─────────────────────┤
│ order           │ INT                  │ Default: 0          │
│                 │                      │ Urutan tampilan     │
├─────────────────┼──────────────────────┼─────────────────────┤
│ created_at      │ TIMESTAMP            │ Auto set            │
│ updated_at      │ TIMESTAMP            │ Auto update         │
├─────────────────┴──────────────────────┴─────────────────────┤
│ UNIQUE (desa_profile_id, section_type)                       │
│ Foreign Key (desa_profile_id) → desa_profiles(id)            │
└──────────────────────────────────────────────────────────────┘
```

### Relationship Diagram
```
    desa_profiles
    ┌─────────────┐
    │ id (PK)     │
    │ name        │
    │ ...         │
    └──────┬──────┘
           │ 1
           │
           │ M
           │
    ┌──────▼───────────────────────────┐
    │ desa_profile_sections             │
    ├───────────────────────────────────┤
    │ id (PK)                           │
    │ desa_profile_id (FK)              │◄─── CASCADE DELETE
    │ section_type (ENUM)               │
    │ content (TEXT)                    │
    │ image (VARCHAR)                   │
    │ is_active (BOOLEAN)               │
    │ order (INT)                       │
    └───────────────────────────────────┘
    
One desa_profile → Many sections
(1:M relationship)
```

## 🔄 Data Flow Diagram

### Create/Update Section Flow
```
Admin Panel Input
       │
       ▼
┌─────────────────────────────────────┐
│ Form Submission                     │
│ PUT /admin/desa-profile-sections/{id}
└──────────┬──────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│ DesaProfileSectionController        │
│ → Validate input                    │
│ → Handle file upload (if exists)    │
│ → Update database                   │
└──────────┬──────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│ File Upload (if image)              │
│ → Validate format & size            │
│ → Generate unique filename          │
│ → Move to public/uploads/           │
│ → Save path to database             │
└──────────┬──────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│ Database Update                     │
│ UPDATE desa_profile_sections        │
│ SET content = ?, image = ?          │
│ WHERE id = ?                        │
└──────────┬──────────────────────────┘
           │
           ▼
┌─────────────────────────────────────┐
│ Session Flash Message               │
│ Redirect back with success          │
└─────────────────────────────────────┘
```

### Display Section Flow (Public)
```
User visits /profil-desa
       │
       ▼
┌──────────────────────────────────────┐
│ HomeController::profile()            │
│ → Get desa from session              │
│ → Query DesaProfileSection           │
│   WHERE desa_profile_id = ?          │
│   AND is_active = true               │
│   ORDER BY order                     │
└──────────┬───────────────────────────┘
           │
           ▼
┌──────────────────────────────────────┐
│ Pass to Blade View                   │
│ profil-desa-tabbed.blade.php         │
│ → $sections collection               │
└──────────┬───────────────────────────┘
           │
           ▼
┌──────────────────────────────────────┐
│ View Rendering                       │
│ → Loop sections                      │
│ → Create tabs                        │
│ → Load content & images              │
└──────────┬───────────────────────────┘
           │
           ▼
┌──────────────────────────────────────┐
│ JavaScript Enhancement              │
│ → Tab switching (onclick)            │
│ → Fade in animation                  │
│ → Active tab highlight               │
└──────────┬───────────────────────────┘
           │
           ▼
┌──────────────────────────────────────┐
│ HTML Output to Browser               │
│ Complete page with sections          │
└──────────────────────────────────────┘
```

## 🔐 Security Architecture

```
┌──────────────────────────────────────────────────────────┐
│ PUBLIC ROUTES (No Auth Required)                         │
│ ├─ GET /profil-desa                                      │
│ │   └─ Visible to all users                              │
│ │   └─ Only active sections shown                        │
│ └─ Safe query (no private data exposed)                  │
└──────────────────────────────────────────────────────────┘
                          ▲
                          │
┌──────────────────────────────────────────────────────────┐
│ MIDDLEWARE: 'admin'                                      │
│ ├─ Check user is authenticated                           │
│ ├─ Check user is admin                                   │
│ └─ On failure: redirect to login                         │
└──────────────────────────────────────────────────────────┘
                          ▲
                          │
┌──────────────────────────────────────────────────────────┐
│ PROTECTED ADMIN ROUTES (Auth + Admin Required)           │
│ ├─ GET    /admin/desa-profile-sections                   │
│ ├─ PUT    /admin/desa-profile-sections/{id}              │
│ ├─ PATCH  /admin/desa-profile-sections/{id}/toggle       │
│ └─ POST   /admin/desa-profile-sections/reorder           │
└──────────────────────────────────────────────────────────┘

Validations:
├─ CSRF Token (required for POST/PUT/PATCH)
├─ Input Validation (content, file format, size)
├─ File Upload Security:
│  ├─ Whitelist extensions
│  ├─ Max file size 5MB
│  ├─ Unique filenames with timestamp
│  └─ Store outside webroot (optional)
└─ Database Query Protection (ORM, bound parameters)
```

## 📊 State Diagram

```
                    ┌──────────────────┐
                    │ SECTION CREATED  │
                    │ (is_active=true) │
                    └────────┬─────────┘
                             │
                ┌────────────┴────────────┐
                ▼                         ▼
        ┌──────────────┐          ┌──────────────┐
        │  ACTIVE      │ toggle   │  INACTIVE    │
        │ (visible)    │◄────────►│ (hidden)     │
        └──────────────┘          └──────────────┘
                │                         │
                │ edit content            │ edit content
                │ toggle off              │ toggle on
                │ delete section          │ delete section
                │                         │
                └────────────┬────────────┘
                             │
                    ┌────────▼──────────┐
                    │ SECTION DELETED   │
                    │ (CASCADE DELETE)  │
                    └──────────────────┘
```

## 🎯 Feature Matrix

```
┌──────────────────────┬────────────┬─────────────────────────┐
│ Section Type         │ Image      │ Admin Features          │
│                      │ Support    │                         │
├──────────────────────┼────────────┼─────────────────────────┤
│ Tentang Desa         │ ✗ No       │ Text only               │
│ Profil Kepala Desa   │ ✓ Yes      │ Text + Image upload     │
│ Profil Wilayah       │ ✓ Yes      │ Text + Image upload     │
│ Visi & Misi          │ ✗ No       │ Text only               │
│ Struktur Organisasi  │ ✓ Yes      │ Text + Image upload     │
│ Peta Desa            │ ✓ Yes      │ Text + Image upload     │
│ Perangkat Desa       │ ✓ Yes      │ Text + Image upload     │
└──────────────────────┴────────────┴─────────────────────────┘
```

## 📈 Performance Considerations

```
Query Optimization:
├─ Single query per page load (active sections)
├─ Indexed on (desa_profile_id, is_active, order)
├─ No N+1 queries
└─ Ready for eager loading with desa profile

Caching Strategy (Optional):
├─ Cache section data (key: desa_{id}_sections)
├─ TTL: 24 hours (or invalidate on update)
├─ Use Redis/Memcached for best performance
└─ Fallback to DB if cache miss

File Storage:
├─ Images stored in public/uploads/
├─ Max 5MB per file
├─ Recommend image optimization (optional)
├─ CDN ready for production
└─ Relative paths (portable)
```

## 🚀 Deployment Checklist

```
┌─────────────────────────────────────┐
│ PRE-DEPLOYMENT                      │
├─────────────────────────────────────┤
│ ✓ Run migrations                    │
│ ✓ Run seeders                       │
│ ✓ Set .env APP_ENV=production       │
│ ✓ Set .env APP_DEBUG=false          │
│ ✓ Ensure public/uploads/ writable   │
│ ✓ Test file uploads                 │
│ ✓ Clear all caches                  │
└─────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────┐
│ DEPLOYMENT                          │
├─────────────────────────────────────┤
│ ✓ Push code to server               │
│ ✓ Run composer install              │
│ ✓ Run php artisan migrate           │
│ ✓ Test functionality                │
│ ✓ Monitor error logs                │
└─────────────────────────────────────┘
        │
        ▼
┌─────────────────────────────────────┐
│ POST-DEPLOYMENT                     │
├─────────────────────────────────────┤
│ ✓ Verify all routes working         │
│ ✓ Test admin panel                  │
│ ✓ Check public page                 │
│ ✓ Monitor database performance      │
│ ✓ Check file upload functionality   │
│ ✓ Verify backups                    │
└─────────────────────────────────────┘
```

---

**Architecture Version**: 1.0
**Last Updated**: August 16, 2026
**Status**: Production Ready ✅
