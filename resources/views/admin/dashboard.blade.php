@extends('layouts.admin')

@section('title', 'Dashboard Admin - ' . ($activeDesa->name ?? 'Desa Waha'))

@push('styles')
<style>
    /* =========================================================
       ADMIN DASHBOARD - MODERN PREMIUM STYLE
       ========================================================= */
    .admin-dashboard-page {
        padding-bottom: 50px;
        font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    }

    /* HERO WELCOME BANNER */
    .admin-welcome-hero {
        padding: 32px 35px;
        background: linear-gradient(135deg, #0f766e 0%, #094e51 50%, #155e75 100%);
        color: #ffffff;
        border-radius: 24px;
        margin-bottom: 28px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 12px 35px rgba(15, 118, 110, 0.18);
        position: relative;
        overflow: hidden;
    }

    .admin-welcome-hero::after {
        content: '';
        position: absolute;
        right: -60px;
        bottom: -60px;
        width: 220px;
        height: 220px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
        pointer-events: none;
    }

    .admin-welcome-hero h2 {
        margin: 4px 0 6px;
        font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .admin-welcome-hero p {
        margin: 0;
        opacity: 0.92;
        font-size: 0.95rem;
        color: #e0f2fe;
    }

    .btn-hero-website {
        background: #ffffff;
        color: #0f766e;
        padding: 12px 24px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.92rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        transition: all 0.25s ease;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .btn-hero-website:hover {
        background: #f0fdf4;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* GRID KARTU STATISTIK */
    .admin-stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
        margin-bottom: 28px;
    }

    .modern-stat-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 22px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        transition: all 0.25s ease;
        position: relative;
        overflow: hidden;
    }

    .modern-stat-card:hover {
        transform: translateY(-4px);
        border-color: #0f766e;
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.1);
    }

    .modern-stat-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .modern-stat-icon {
        width: 50px;
        height: 50px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .modern-stat-icon.green { background: #e6f4f1; color: #0f766e; }
    .modern-stat-icon.blue { background: #e0f2fe; color: #0284c7; }
    .modern-stat-icon.orange { background: #ffedd5; color: #ea580c; }
    .modern-stat-icon.purple { background: #f3e8ff; color: #9333ea; }

    .modern-stat-arrow {
        color: #94a3b8;
        font-size: 1.2rem;
        font-weight: 800;
        transition: color 0.2s ease;
    }

    .modern-stat-card:hover .modern-stat-arrow {
        color: #0f766e;
    }

    .modern-stat-value {
        font-size: 1.85rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
        margin-bottom: 4px;
    }

    .modern-stat-label {
        font-size: 0.85rem;
        font-weight: 700;
        color: #64748b;
    }

    /* LAYOUT 2 KOLOM UTAMA */
    .admin-dashboard-columns {
        display: grid;
        grid-template-columns: 1.1fr 0.9fr;
        gap: 24px;
        margin-bottom: 28px;
    }

    .admin-panel {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 26px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .admin-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        padding-bottom: 14px;
        border-bottom: 1px solid #f1f5f9;
    }

    .admin-panel-header h3 {
        margin: 4px 0 0;
        font-size: 1.2rem;
        font-weight: 800;
        color: #0f172a;
    }

    .admin-panel-link {
        color: #0f766e;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.88rem;
        transition: all 0.2s ease;
    }

    .admin-panel-link:hover {
        color: #115e56;
        text-decoration: underline;
    }

    /* DEMOGRAFI PENDUDUK BAR */
    .population-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .population-item {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 16px 20px;
    }

    .population-heading {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .population-heading span {
        font-size: 0.9rem;
        font-weight: 700;
        color: #334155;
    }

    .population-heading strong {
        font-size: 1.1rem;
        font-weight: 800;
        color: #0f172a;
    }

    .population-bar {
        width: 100%;
        height: 10px;
        background: #e2e8f0;
        border-radius: 999px;
        overflow: hidden;
        margin-bottom: 8px;
    }

    .population-fill {
        height: 100%;
        border-radius: 999px;
        transition: width 0.6s ease;
    }

    .population-fill.male { background: linear-gradient(90deg, #0284c7, #38bdf8); }
    .population-fill.female { background: linear-gradient(90deg, #ec4899, #f472b6); }

    .population-item small {
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* MENU AKSES CEPAT */
    .quick-menu {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .quick-menu-item {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 16px 20px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none;
        color: inherit;
        transition: all 0.25s ease;
    }

    .quick-menu-item:hover {
        background: #ffffff;
        border-color: #0f766e;
        transform: translateX(4px);
        box-shadow: 0 6px 20px rgba(15, 118, 110, 0.08);
    }

    .quick-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .quick-menu-item div {
        flex: 1;
        min-width: 0;
    }

    .quick-menu-item strong {
        display: block;
        font-size: 0.95rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 2px;
    }

    .quick-menu-item span {
        display: block;
        font-size: 0.82rem;
        color: #64748b;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .quick-menu-item b {
        color: #94a3b8;
        font-size: 1.1rem;
        transition: transform 0.2s ease, color 0.2s ease;
    }

    .quick-menu-item:hover b {
        color: #0f766e;
        transform: translateX(3px);
    }

    /* FOOTER STATUS WEBSITE */
    .admin-website-status {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 20px 26px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .status-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .status-icon {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #dcfce7;
        color: #166534;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        font-weight: 900;
    }

    .status-left strong {
        display: block;
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
    }

    .status-left span {
        font-size: 0.86rem;
        color: #64748b;
    }

    .btn-open-site {
        background: #f0fdf4;
        color: #0f766e;
        border: 1px solid #bbf7d0;
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-open-site:hover {
        background: #0f766e;
        color: #ffffff;
        border-color: #0f766e;
    }

    @media (max-width: 1024px) {
        .admin-stat-grid { grid-template-columns: repeat(2, 1fr); }
        .admin-dashboard-columns { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .admin-stat-grid { grid-template-columns: 1fr; }
        .admin-welcome-hero { flex-direction: column; align-items: flex-start; }
        .admin-website-status { flex-direction: column; align-items: flex-start; }
    }
</style>
@endpush

@section('content')

<div class="admin-dashboard-page">

    {{-- HERO WELCOME HEADER --}}
    <div class="admin-welcome-hero">
        <div>
            <span class="admin-eyebrow" style="color: #a7f3d0; background: rgba(255, 255, 255, 0.15); padding: 4px 12px; border-radius: 20px;">
                PANEL UTAMA ADMINISTRATOR
            </span>
            <h2>Selamat Datang, {{ session('admin_name', 'Administrator') }} 👋</h2>
            <p>Kelola data kependudukan, fasilitas, layanan publik, berita, dan transparansi {{ $activeDesa->name ?? 'Desa Waha' }}.</p>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="btn-hero-website">
            Lihat Website ↗
        </a>
    </div>

    {{-- KARTU STATISTIK KUNCI --}}
    <div class="admin-stat-grid">

        {{-- TOTAL PENDUDUK --}}
        <div class="modern-stat-card">
            <div class="modern-stat-top">
                <div class="modern-stat-icon green">👥</div>
                <span class="modern-stat-arrow">↗</span>
            </div>
            <div class="modern-stat-value">
                {{ number_format($statistics?->total_penduduk ?? 0, 0, ',', '.') }}
            </div>
            <div class="modern-stat-label">Total Penduduk</div>
        </div>

        {{-- KEPALA KELUARGA --}}
        <div class="modern-stat-card">
            <div class="modern-stat-top">
                <div class="modern-stat-icon blue">🏠</div>
                <span class="modern-stat-arrow">↗</span>
            </div>
            <div class="modern-stat-value">
                {{ number_format($statistics?->kepala_keluarga ?? 0, 0, ',', '.') }}
            </div>
            <div class="modern-stat-label">Kepala Keluarga</div>
        </div>

        {{-- DUSUN / WILAYAH --}}
        <div class="modern-stat-card">
            <div class="modern-stat-top">
                <div class="modern-stat-icon orange">📍</div>
                <span class="modern-stat-arrow">↗</span>
            </div>
            <div class="modern-stat-value">
                {{ number_format($villages ?? 0, 0, ',', '.') }}
            </div>
            <div class="modern-stat-label">Dusun / Wilayah</div>
        </div>

        {{-- LAYANAN DESA --}}
        <div class="modern-stat-card">
            <div class="modern-stat-top">
                <div class="modern-stat-icon purple">📄</div>
                <span class="modern-stat-arrow">↗</span>
            </div>
            <div class="modern-stat-value">
                {{ number_format($services ?? 0, 0, ',', '.') }}
            </div>
            <div class="modern-stat-label">Layanan Publik</div>
        </div>

    </div>

    {{-- LAYANAN KONTEN UTAMA --}}
    <div class="admin-dashboard-columns">

        {{-- STATISTIK DEMOGRAFI PENDUDUK --}}
        <div class="admin-panel">
            <div class="admin-panel-header">
                <div>
                    <span class="admin-eyebrow" style="color: #0f766e;">DEMOGRAFI</span>
                    <h3>Statistik Kependudukan</h3>
                </div>
                <a href="{{ route('admin.data-desa') }}" class="admin-panel-link">
                    Kelola Data →
                </a>
            </div>

            <div class="population-list">

                @php
                    $total = $statistics?->total_penduduk ?? 0;
                    $male = $statistics?->laki_laki ?? 0;
                    $female = $statistics?->perempuan ?? 0;
                    $malePercent = $total > 0 ? round(($male / $total) * 100) : 0;
                    $femalePercent = $total > 0 ? round(($female / $total) * 100) : 0;
                @endphp

                {{-- LAKI-LAKI --}}
                <div class="population-item">
                    <div class="population-heading">
                        <span>👨 Penduduk Laki-laki</span>
                        <strong>{{ number_format($male, 0, ',', '.') }} Jiwa</strong>
                    </div>
                    <div class="population-bar">
                        <div class="population-fill male" style="width: {{ $malePercent }}%;"></div>
                    </div>
                    <small>{{ $malePercent }}% dari total populasi desa</small>
                </div>

                {{-- PEREMPUAN --}}
                <div class="population-item">
                    <div class="population-heading">
                        <span>👩 Penduduk Perempuan</span>
                        <strong>{{ number_format($female, 0, ',', '.') }} Jiwa</strong>
                    </div>
                    <div class="population-bar">
                        <div class="population-fill female" style="width: {{ $femalePercent }}%;"></div>
                    </div>
                    <small>{{ $femalePercent }}% dari total populasi desa</small>
                </div>

                {{-- KEPALA KELUARGA --}}
                <div class="population-item">
                    <div class="population-heading">
                        <span>🏠 Kepala Keluarga (KK)</span>
                        <strong>{{ number_format($statistics?->kepala_keluarga ?? 0, 0, ',', '.') }} KK</strong>
                    </div>
                </div>

            </div>
        </div>

        {{-- MENU NAVIGASI AKSES CEPAT --}}
        <div class="admin-panel">
            <div class="admin-panel-header">
                <div>
                    <span class="admin-eyebrow" style="color: #0f766e;">NAVIGASI</span>
                    <h3>Akses Cepat Pengelolaan</h3>
                </div>
            </div>

            <div class="quick-menu">

                <a href="{{ route('admin.site-data') }}" class="quick-menu-item">
                    <div class="quick-icon">⚙️</div>
                    <div>
                        <strong>Pengaturan Website</strong>
                        <span>Hero banner, profil singkat & identitas situs</span>
                    </div>
                    <b>→</b>
                </a>

                <a href="{{ route('admin.data-desa') }}" class="quick-menu-item">
                    <div class="quick-icon">📊</div>
                    <div>
                        <strong>Kelola Data & Statistik Desa</strong>
                        <span>Input data penduduk, perumahan & upload berkas</span>
                    </div>
                    <b>→</b>
                </a>

                <a href="{{ route('admin.layanan') }}" class="quick-menu-item">
                    <div class="quick-icon">📄</div>
                    <div>
                        <strong>Layanan Administrasi</strong>
                        <span>Kelola daftar persyaratan & layanan surat</span>
                    </div>
                    <b>→</b>
                </a>

                <a href="{{ route('admin.publikasi.index') }}" class="quick-menu-item">
                    <div class="quick-icon">📚</div>
                    <div>
                        <strong>Publikasi & Dokumen</strong>
                        <span>Kelola berkas publikasi, infografis & monografis</span>
                    </div>
                    <b>→</b>
                </a>

                <a href="{{ route('admin.kontak.index') }}" class="quick-menu-item">
                    <div class="quick-icon">📞</div>
                    <div>
                        <strong>Kontak & Media Sosial</strong>
                        <span>Kelola WhatsApp, Instagram, Maps & alamat kantor</span>
                    </div>
                    <b>→</b>
                </a>

            </div>
        </div>

    </div>

    {{-- STATUS KONEKSI & WEBSITE --}}
    <div class="admin-website-status">
        <div class="status-left">
            <div class="status-icon">✓</div>
            <div>
                <strong>Sistem Website {{ $activeDesa->name ?? 'Desa Waha' }} Aktif</strong>
                <span>Informasi yang Anda simpan akan langsung diperbarui secara realtime di halaman publik.</span>
            </div>
        </div>

        <a href="{{ route('home') }}" target="_blank" class="btn-open-site">
            Buka Portal Website ↗
        </a>
    </div>

</div>

@endsection