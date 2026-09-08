@extends('layouts.admin')

@section('title', 'Tambah Berita Desa')

@push('styles')
<style>
    /* =========================================================
       TAMBAH BERITA DESA - ADMIN MANAGEMENT
       ========================================================= */

    .news-create-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 24px;
        border-radius: 20px;
        background: linear-gradient(135deg, #0f766e 0%, #155e75 100%);
        color: #fff;
        margin-bottom: 25px;
    }

    .news-create-hero h1 {
        margin: 4px 0;
        font-size: 1.6rem;
        font-weight: 800;
    }

    .news-create-hero p {
        margin: 0;
        opacity: .9;
        font-size: 0.88rem;
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 9px 16px;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        font-weight: 700;
        text-decoration: none;
        border: 1px solid rgba(255, 255, 255, 0.3);
        transition: .2s ease;
    }

    .btn-back:hover {
        background: #fff;
        color: #0f766e;
    }

    /* CARD FORM */
    .news-form-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 28px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .form-grid-main {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 24px;
    }

    .form-group-admin {
        display: flex;
        flex-direction: column;
        gap: 6px;
        margin-bottom: 20px;
    }

    .form-group-admin label {
        font-weight: 800;
        font-size: 0.88rem;
        color: #1e293b;
    }

    .form-group-admin input[type="text"],
    .form-group-admin select,
    .form-group-admin textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.95rem;
        outline: none;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
        font-family: inherit;
    }

    .form-group-admin input:focus,
    .form-group-admin select:focus,
    .form-group-admin textarea:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
    }

    /* UPLOAD BOX WITH PREVIEW */
    .image-upload-box {
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 20px;
        text-align: center;
        background: #f8fafc;
        cursor: pointer;
        transition: border-color 0.2s ease;
        position: relative;
    }

    .image-upload-box:hover {
        border-color: #0f766e;
    }

    .preview-container {
        width: 100%;
        height: 180px;
        border-radius: 12px;
        overflow: hidden;
        margin-bottom: 12px;
        display: none;
        background: #e2e8f0;
    }

    .preview-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .upload-icon {
        font-size: 38px;
        margin-bottom: 8px;
    }

    /* SUBMIT BUTTONS */
    .form-actions-bar {
        display: flex;
        gap: 12px;
        margin-top: 10px;
    }

    .btn-publish {
        background: #0f766e;
        color: #fff;
        border: 0;
        padding: 12px 26px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        transition: .2s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-publish:hover {
        background: #115e56;
        transform: translateY(-1px);
    }

    .btn-draft {
        background: #e2e8f0;
        color: #475569;
        border: 0;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        cursor: pointer;
        transition: .2s ease;
    }

    .btn-draft:hover {
        background: #cbd5e1;
    }

    @media (max-width: 900px) {
        .form-grid-main {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')

{{-- HERO HEADER --}}
<div class="news-create-hero">
    <div>
        <span class="admin-eyebrow" style="color: #a7f3d0;">KONTEN BERITA DESA</span>
        <h1>📰 Tulis Berita Baru</h1>
        <p>Buat dan publikasikan berita terbaru seputar kegiatan, pengumuman, atau kabar Desa Cantik.</p>
    </div>

    <div>
        <a href="{{ route('admin.berita.index') }}" class="btn-back">
            ← Kembali ke Berita
        </a>
    </div>
</div>

{{-- ALERT VALIDASI --}}
@if($errors->any())
    <div class="alert alert-danger" style="background: #fef2f2; color: #991b1b; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
        ⚠️ {{ $errors->first() }}
    </div>
@endif

{{-- FORM UTAMA --}}
<form method="POST" action="{{ route('admin.publikasi.store') }}" enctype="multipart/form-data">
    @csrf

    {{-- Kategori Otomatis Terisi 'Berita' --}}
    <input type="hidden" name="category" value="Berita">

    <div class="news-form-card">
        <div class="form-grid-main">

            {{-- KOLOM KIRI: KONTEN UTAMA --}}
            <div>
                <div class="form-group-admin">
                    <label for="title">Judul Berita <span style="color: #ef4444;">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" placeholder="Contoh: Pelaksanaan Musyawarah Pembangunan Desa Tahun 2026" required>
                </div>

                <div class="form-group-admin">
                    <label for="excerpt">Ringkasan Singkat (Excerpt)</label>
                    <textarea id="excerpt" name="excerpt" rows="3" placeholder="Tuliskan rangkuman singkat 1-2 kalimat dari isi berita ini...">{{ old('excerpt') }}</textarea>
                </div>

                <div class="form-group-admin">
                    <label for="content">Isi Lengkap Berita <span style="color: #ef4444;">*</span></label>
                    <textarea id="content" name="content" rows="12" placeholder="Tuliskan seluruh narasi isi berita di sini secara detail..." required>{{ old('content') }}</textarea>
                </div>
            </div>

            {{-- KOLOM KANAN: PENGATURAN & UPLOAD IMAGE --}}
            <div>
                {{-- STATUS TERBIT --}}
                <div class="form-group-admin">
                    <label for="status">Status Publikasi</label>
                    <select id="status" name="status" required>
                        <option value="published" @selected(old('status') === 'published')>🚀 Langsung Terbitkan (Published)</option>
                        <option value="draft" @selected(old('status') === 'draft')>💾 Simpan Draft (Draft)</option>
                    </select>
                </div>

                {{-- UPLOAD SAMPUL GAMBAR --}}
                <div class="form-group-admin">
                    <label>Sampul Gambar Berita</label>
                    <div class="image-upload-box" onclick="document.getElementById('imageInput').click()">
                        <div class="preview-container" id="previewContainer">
                            <img id="imagePreview" src="#" alt="Preview Sampul">
                        </div>

                        <div id="uploadPlaceholder">
                            <div class="upload-icon">📷</div>
                            <strong style="color: #0f766e; display: block; font-size: 0.9rem;">Klik untuk Unggah Gambar</strong>
                            <small style="color: #64748b; font-size: 0.8rem;">Format: JPG, PNG, WEBP (Maks 3MB)</small>
                        </div>

                        <input type="file" id="imageInput" name="image" accept="image/*" style="display: none;" onchange="previewFile(this)">
                    </div>
                </div>

                {{-- UPLOAD LAMPIRAN FILE (OPTIONAL) --}}
                <div class="form-group-admin">
                    <label for="file">Lampiran Berkas (PDF / Dokumen)</label>
                    <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <small style="color: #64748b; font-size: 0.78rem; margin-top: 4px;">Opsional jika ada file pendukung berita.</small>
                </div>

                {{-- TOMBOL AKSI --}}
                <div class="form-actions-bar">
                    <button type="submit" class="btn-publish">
                        🚀 Terbitkan Berita
                    </button>
                </div>
            </div>

        </div>
    </div>
</form>

@endsection

@push('scripts')
<script>
    // PREVIEW GAMBAR SEBELUM DIUNGGAH
    function previewFile(input) {
        const file = input.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('imagePreview').setAttribute('src', e.target.result);
                document.getElementById('previewContainer').style.display = 'block';
                document.getElementById('uploadPlaceholder').style.display = 'none';
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush