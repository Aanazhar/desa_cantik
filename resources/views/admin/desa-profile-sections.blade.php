
@extends('layouts.admin')

@section('title', 'Kelola Section Profil Desa')

@section('content')

<style>
    /* =========================================================
       KELOLA SECTION PROFIL DESA - ADMIN
       ========================================================= */

    .profil-page {
        --green: #2f6f4e;
        --green-dark: #24583e;
        --green-soft: #edf6f0;
        --green-border: #dcebe1;

        --text: #24352b;
        --muted: #748078;
        --border: #e5ebe7;
        --danger: #a64d4d;

        max-width: 1220px;
        margin: 0 auto;
        padding: 10px 0 60px;
    }

    .profil-page *,
    .profil-page *::before,
    .profil-page *::after {
        box-sizing: border-box;
    }

    /* HEADER */

    .profil-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .profil-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;

        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;

        color: var(--green);
    }

    .profil-eyebrow::before {
        content: "";
        width: 24px;
        height: 2px;
        border-radius: 10px;
        background: var(--green);
    }

    .profil-header h1 {
        margin: 0;
        color: var(--text);
        font-size: 32px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .profil-header p {
        max-width: 680px;
        margin: 9px 0 0;
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }

    .profil-header-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    /* BUTTONS */

    .profil-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        min-height: 40px;
        padding: 0 16px;

        border-radius: 10px;
        border: 1px solid transparent;

        font-size: 13px;
        font-weight: 700;
        text-decoration: none;

        cursor: pointer;
        transition: .2s ease;
    }

    .profil-btn-primary {
        color: #fff;
        background: var(--green);
        border-color: var(--green);
    }

    .profil-btn-primary:hover {
        color: #fff;
        background: var(--green-dark);
        border-color: var(--green-dark);
        transform: translateY(-1px);
    }

    .profil-btn-outline {
        color: var(--green-dark);
        background: #fff;
        border-color: var(--green-border);
    }

    .profil-btn-outline:hover {
        color: var(--green-dark);
        background: var(--green-soft);
    }

    .profil-btn-success {
        color: #27613d;
        background: #edf8f1;
        border-color: #d0e8d7;
    }

    .profil-btn-success:hover {
        background: #dcf3e5;
    }

    .profil-btn-danger {
        color: var(--danger);
        background: #fff;
        border-color: #edd4d4;
    }

    .profil-btn-danger:hover {
        background: #fff5f5;
    }

    .profil-btn-small {
        min-height: 34px;
        padding: 0 12px;
        font-size: 12px;
        border-radius: 8px;
    }

    /* ALERT */

    .profil-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 16px;
        margin-bottom: 20px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.5;
    }

    .profil-alert-success {
        color: #27613d;
        background: #edf8f1;
        border: 1px solid #d0e8d7;
    }

    /* CARD CONTAINER */

    .profil-card {
        overflow: hidden;
        margin-bottom: 20px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: 0 5px 18px rgba(35, 67, 48, .035);
    }

    .profil-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        padding: 22px 24px;
        border-bottom: 1px solid #f0f4f1;
    }

    .profil-card-title {
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .profil-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 11px;
        color: var(--green);
        background: var(--green-soft);
        font-size: 17px;
        font-weight: 800;
    }

    .profil-card-header h2 {
        margin: 1px 0 4px;
        color: var(--text);
        font-size: 18px;
        line-height: 1.3;
        font-weight: 800;
    }

    .profil-card-header p {
        margin: 0;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .profil-card-body {
        padding: 24px;
    }

    /* SECTION MANAGEMENT LIST */

    .section-management-container {
        display: grid;
        gap: 18px;
    }

    .profil-section-item {
        padding: 20px;
        border: 1px solid var(--border);
        border-radius: 16px;
        background: #fbfdfc;
        transition: .2s ease;
    }

    .profil-section-item:hover {
        border-color: #cde0d5;
        box-shadow: 0 4px 16px rgba(35, 67, 48, .05);
    }

    .profil-section-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 16px;
        padding-bottom: 14px;
        border-bottom: 1px dashed #e2ebe5;
    }

    .profil-section-name {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .profil-section-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 9px;
        color: var(--green);
        background: var(--green-soft);
        font-size: 13px;
        font-weight: 800;
    }

    .profil-section-name h3 {
        margin: 0;
        color: var(--text);
        font-size: 16px;
        font-weight: 800;
    }

    .profil-section-type {
        display: inline-block;
        margin-top: 3px;
        padding: 2px 8px;
        border-radius: 6px;
        background: #edf1ee;
        color: #55665c;
        font-size: 11px;
        font-weight: 700;
    }

    .profil-section-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    /* FORM ELEMENTS */

    .profil-field {
        margin-bottom: 15px;
    }

    .profil-field label {
        display: block;
        margin-bottom: 7px;
        color: #3d4d44;
        font-size: 12px;
        font-weight: 750;
    }

    .profil-field textarea,
    .profil-field input[type="file"] {
        display: block;
        width: 100%;
        padding: 11px 12px;
        color: var(--text);
        background: #fff;
        border: 1px solid #dce5df;
        border-radius: 10px;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        transition: .2s ease;
    }

    .profil-field textarea {
        resize: vertical;
        line-height: 1.65;
    }

    .profil-field textarea:focus {
        border-color: #78a78c;
        box-shadow: 0 0 0 3px rgba(47, 111, 78, .08);
    }

    .profil-field input[type="file"] {
        padding: 8px;
        cursor: pointer;
    }

    .profil-image-preview {
        margin-bottom: 10px;
    }

    .profil-image-preview img {
        display: block;
        max-width: 280px;
        max-height: 180px;
        object-fit: cover;
        border-radius: 12px;
        border: 1px solid var(--green-border);
    }

    /* RESPONSIVE */

    @media (max-width: 760px) {
        .profil-header {
            flex-direction: column;
        }

        .profil-header-actions {
            width: 100%;
        }

        .profil-header-actions .profil-btn {
            flex: 1;
        }

        .profil-section-top {
            flex-direction: column;
            align-items: flex-start;
        }

        .profil-section-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>


<div class="profil-page">

    {{-- HEADER --}}
    <header class="profil-header">
        <div>
            <span class="profil-eyebrow">
                Pengelolaan Website
            </span>

            <h1>Kelola Section Profil Desa</h1>

            <p>
                Atur konten setiap submenu Profil Desa {{ $desa->name }}. Setelah disimpan dan diaktifkan,
                konten akan otomatis tampil pada halaman pengguna (*user*).
            </p>
        </div>

        <div class="profil-header-actions">
            <a
                href="{{ route('profil') }}"
                target="_blank"
                rel="noopener noreferrer"
                class="profil-btn profil-btn-outline"
            >
                Lihat Website ↗
            </a>
        </div>
    </header>


    {{-- ALERT SUCCESS --}}
    @if(session('success'))
        <div class="profil-alert profil-alert-success">
            ✓ {{ session('success') }}
        </div>
    @endif


    {{-- CARD DAFTAR SECTION --}}
    <section class="profil-card">

        <div class="profil-card-header">
            <div class="profil-card-title">
                <div class="profil-card-icon">
                    ⚙️
                </div>
                <div>
                    <h2>Daftar Section Profil Desa</h2>
                    <p>
                        Menu pada navigasi utama user mengambil data langsung dari section aktif di bawah ini.
                    </p>
                </div>
            </div>
        </div>

        <div class="profil-card-body">

            <div class="section-management-container">

                @foreach($sections as $index => $section)

                    <div class="profil-section-item">

                        {{-- TOP INFO & ACTIONS --}}
                        <div class="profil-section-top">

                            <div class="profil-section-name">
                                <div class="profil-section-number">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h3>{{ $section->label }}</h3>
                                    <span class="profil-section-type">
                                        Tipe: {{ $section->section_type }}
                                    </span>
                                </div>
                            </div>

                            <div class="profil-section-actions">

                                {{-- TOMBOL PREVIEW --}}
                                <a
                                    href="{{ route('profil.page', str_replace('_', '-', $section->section_type)) }}"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="profil-btn profil-btn-outline profil-btn-small"
                                >
                                    Lihat ↗
                                </a>

                                {{-- TOGGLE STATUS AKTIF --}}
                                <form
                                    method="POST"
                                    action="{{ route('admin.desa-profile-sections.toggle-active', $section->id) }}"
                                    style="margin: 0;"
                                >
                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="profil-btn profil-btn-small {{ $section->is_active ? 'profil-btn-success' : 'profil-btn-danger' }}"
                                    >
                                        {{ $section->is_active ? '✓ Aktif' : '✗ Nonaktif' }}
                                    </button>
                                </form>

                            </div>

                        </div>

                        {{-- FORM UPDATE CONTENT --}}
                        <form
                            method="POST"
                            action="{{ route('admin.desa-profile-sections.update', $section->id) }}"
                            enctype="multipart/form-data"
                        >
                            @csrf
                            @method('PUT')

                            <div class="profil-field">
                                <label>Isi Konten Section</label>
                                <textarea
                                    name="content"
                                    rows="6"
                                    placeholder="Masukkan konten deskripsi untuk section ini..."
                                >{{ $section->content }}</textarea>
                            </div>

                            {{-- GAMBAR KHUSUS SECTION TERTENTU --}}
                            @if(in_array($section->section_type, ['profil_kepala_desa', 'struktur_organisasi', 'peta_desa', 'perangkat_desa', 'tentang_desa', 'sejarah_desa']))
                                <div class="profil-field">
                                    <label>Upload Gambar (Opsional)</label>

                                    @if($section->image)
                                        <div class="profil-image-preview">
                                            <img
                                                src="{{ asset(ltrim($section->image, '/')) }}"
                                                alt="{{ $section->label }}"
                                            >
                                        </div>
                                    @endif

                                    <input
                                        type="file"
                                        name="image"
                                        accept="image/*"
                                    >
                                    <small style="display:block; margin-top:5px; color:#748078; font-size:11px;">
                                        Maksimal 5MB. Format yang didukung: JPG, PNG, WebP, GIF.
                                    </small>
                                </div>
                            @endif

                            <div style="display: flex; justify-content: flex-end; margin-top: 15px;">
                                <button
                                    type="submit"
                                    class="profil-btn profil-btn-primary profil-btn-small"
                                >
                                    Simpan Section
                                </button>
                            </div>

                        </form>

                    </div>

                @endforeach

            </div>

        </div>

    </section>

</div>

@endsection
```
