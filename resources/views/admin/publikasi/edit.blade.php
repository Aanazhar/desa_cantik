@extends('layouts.admin')

@section('title', 'Edit Publikasi')

@section('content')

@php
    // JIKA VARIABLE BERUBAH TERJADI KARENA STRING ID, AMBIL DARI DATABASE
    if (! $publication instanceof \App\Models\Publication) {
        $idTarget = is_array($publication) ? ($publication['id'] ?? request()->route('publication')) : $publication;
        $publication = \App\Models\Publication::where('id', $idTarget)->orWhere('slug', $idTarget)->first() ?? new \App\Models\Publication();
    }

    $pubId       = $publication->id;
    $pubTitle    = $publication->title ?? '';
    $pubCategory = $publication->category ?? 'Publikasi';
    $pubStatus   = $publication->status ?? 'published';
    $pubImage    = $publication->image ?? null;
    $pubFile     = $publication->file ?? ($publication->file_path ?? null);
    $pubExcerpt  = $publication->excerpt ?? '';
    $pubContent  = $publication->content ?? '';
@endphp

<div class="admin-page-header">
    <div>
        <span class="admin-eyebrow">PUBLIKASI DESA</span>
        <h2>Edit Publikasi</h2>
        <p>Perbarui informasi publikasi Desa.</p>
    </div>
</div>

<div class="admin-card publication-form-card">
    <form enctype="multipart/form-data" method="POST" action="{{ route('admin.publikasi.update', ['publication' => $pubId]) }}">
        @csrf
        @method('PUT')

        @if($errors->any())
            <div class="admin-alert admin-alert-error">
                <ul class="publication-error-list">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- JUDUL PUBLIKASI --}}
        <div class="admin-form-group">
            <label for="title">Judul Publikasi *</label>
            <input
                id="title"
                type="text"
                name="title"
                value="{{ old('title', $pubTitle) }}"
                required
            >
        </div>

        <div class="admin-grid">
            {{-- KATEGORI --}}
            <div class="admin-form-group">
                <label for="category">Kategori *</label>
                <select id="category" name="category" required>
                    @foreach(['Publikasi', 'Infografis', 'Monografis', 'Berita'] as $cat)
                        <option value="{{ $cat }}" {{ old('category', $pubCategory) === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- STATUS --}}
            <div class="admin-form-group">
                <label for="status">Status *</label>
                <select id="status" name="status">
                    <option value="published" {{ old('status', $pubStatus) === 'published' ? 'selected' : '' }}>
                        Published (Tampil di Website)
                    </option>
                    <option value="draft" {{ old('status', $pubStatus) === 'draft' ? 'selected' : '' }}>
                        Draft (Disimpan Sementara)
                    </option>
                </select>
            </div>
        </div>

        {{-- PRATINJAU GAMBAR SAAT INI --}}
        @if($pubImage)
            <div class="publication-current-image" style="margin-bottom: 15px; padding: 12px; background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px;">
                <span style="display: block; font-weight: 700; margin-bottom: 6px; color: #475569;">📷 Gambar Cover saat ini:</span>
                <img src="{{ asset(ltrim($pubImage, '/')) }}" alt="{{ $pubTitle }}" style="max-height: 120px; border-radius: 10px; object-fit: cover;">
            </div>
        @endif

        <div class="admin-form-group">
            <label for="image">Ganti Gambar Utama</label>
            <input id="image" type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
            <small class="publication-form-help">Kosongkan jika tidak ingin mengganti gambar.</small>
        </div>

        {{-- PRATINJAU FILE DOKUMEN SAAT INI --}}
        @if($pubFile)
            <div class="publication-current-file" style="margin-bottom: 15px; padding: 12px; background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 12px;">
                <span style="display: block; font-weight: 700; color: #166534;">📄 File Dokumen saat ini:</span>
                <small style="color: #15803d; word-break: break-all;">{{ basename($pubFile) }}</small>
            </div>
        @endif

        <div class="admin-form-group">
            <label for="file">Upload / Ganti File Pendukung (PDF/Excel)</label>
            <input id="file" type="file" name="file" accept=".pdf,.csv,.xls,.xlsx">
            <small class="publication-form-help">Penting: Pilih file PDF jika ini publikasi dokumen resmi. Kosongkan jika tidak ingin mengganti file.</small>
        </div>

        {{-- RINGKASAN --}}
        <div class="admin-form-group">
            <label for="excerpt">Ringkasan Singkat</label>
            <textarea id="excerpt" name="excerpt" rows="3" placeholder="Tulis ringkasan singkat publikasi...">{{ old('excerpt', $pubExcerpt) }}</textarea>
        </div>

        {{-- ISI PUBLIKASI --}}
        <div class="admin-form-group">
            <label for="content">Isi Lengkap Publikasi *</label>
            <textarea id="content" name="content" rows="10" required>{{ old('content', $pubContent) }}</textarea>
        </div>

        <div class="publication-form-actions">
            <button type="submit" class="admin-btn admin-btn-green">
                💾 Update Publikasi
            </button>
            <a href="{{ route('admin.publikasi.index') }}" class="admin-btn">
                Batal
            </a>
        </div>
    </form>
</div>

@endsection