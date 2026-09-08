@extends('layouts.admin')

@section('title', 'Tambah Publikasi')

@section('content')

    {{-- HEADER HALAMAN ADMIN --}}
    <div class="admin-page-header">
        <div>
            <span class="admin-eyebrow">PUBLIKASI DESA</span>
            <h1>Tambah Publikasi</h1>
            <p>Konten yang berstatus Published akan tampil otomatis di halaman masyarakat.</p>
        </div>
    </div>

    {{-- KARTU FORMULIR PUBLIKASI --}}
    <div class="admin-card publication-form-card">
        <form method="POST" action="{{ route('admin.publikasi.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- ERROR ALERTS --}}
            @if($errors->any())
                <div class="admin-alert admin-alert-error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- JUDUL --}}
            <div class="admin-form-group">
                <label>Judul</label>
                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    required
                    placeholder="Contoh: Dokumen Laporan Kinerja Desa Tahun 2026"
                >
            </div>

            {{-- KATEGORI & STATUS --}}
            <div class="admin-grid">
                <div class="admin-form-group">
                    <label>Kategori</label>
                    <select name="category" required>
                        <option value="Publikasi" @selected(old('category') === 'Publikasi')>Publikasi</option>
                        <option value="Infografis" @selected(old('category') === 'Infografis')>Infografis</option>
                        <option value="Monografis" @selected(old('category') === 'Monografis')>Monografis</option>
                    </select>
                </div>

                <div class="admin-form-group">
                    <label>Status</label>
                    <select name="status">
                        <option value="published" @selected(old('status', 'published') === 'published')>Published</option>
                        <option value="draft" @selected(old('status') === 'draft')>Draft</option>
                    </select>
                </div>
            </div>

            {{-- GAMBAR UTAMA & FILE PENDUKUNG --}}
            <div class="admin-grid">
                <div class="admin-form-group">
                    <label>Gambar Utama</label>
                    <input type="file" name="image" accept=".jpg,.jpeg,.png,.webp">
                    <small class="publication-form-help">JPG, JPEG, PNG, WEBP maksimal 3 MB.</small>
                </div>

                <div class="admin-form-group">
                    <label>File Pendukung</label>
                    <input type="file" name="file" accept=".pdf,.csv,.xls,.xlsx">
                    <small class="publication-form-help">Opsional, maksimal 10 MB.</small>
                </div>
            </div>

            {{-- RINGKASAN --}}
            <div class="admin-form-group">
                <label>Ringkasan</label>
                <textarea
                    name="excerpt"
                    rows="4"
                    placeholder="Ringkasan singkat untuk kartu publikasi..."
                >{{ old('excerpt') }}</textarea>
            </div>

            {{-- ISI PUBLIKASI --}}
            <div class="admin-form-group">
                <label>Isi Publikasi</label>
                <textarea
                    name="content"
                    rows="16"
                    required
                    placeholder="Tulis isi lengkap publikasi..."
                >{{ old('content') }}</textarea>
            </div>

            {{-- TOMBOL AKSI --}}
            <div class="publication-form-actions">
                <button type="submit" class="admin-btn admin-btn-green">
                    💾 Terbitkan / Simpan
                </button>
                <a href="{{ route('admin.publikasi.index') }}" class="admin-btn">
                    Batal
                </a>
            </div>

        </form>
    </div>

@endsection