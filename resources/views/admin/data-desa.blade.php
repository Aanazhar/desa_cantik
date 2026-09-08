@extends('layouts.admin')

@section('title', 'Kelola Data & Statistik Desa - Admin')

@section('content')
{{-- IMPOR FONT INTER --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* COMPACT & SLEEK ADMIN DATA DESA */
    html {
        scroll-behavior: smooth;
    }
    body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    .data-page-admin {
        background: #f8fafc !important;
        padding-bottom: 50px !important;
    }

    /* HERO BANNER RINGKAS */
    .admin-hero-card {
        background: linear-gradient(135deg, #1e6660 0%, #2a5b67 50%, #0a4c60 100%) !important;
        border-radius: 14px !important;
        color: #ffffff !important;
        padding: 18px 24px !important;
        box-shadow: 0 6px 20px rgba(10, 76, 96, 0.12) !important;
        margin-bottom: 18px !important;
    }

    .hero-eyebrow {
        background: rgba(255, 255, 255, 0.18) !important;
        backdrop-filter: blur(6px) !important;
        color: #ffffff !important;
        font-weight: 800 !important;
        font-size: 0.72rem !important;
        letter-spacing: 0.5px !important;
        padding: 3px 12px !important;
        border-radius: 50px !important;
        display: inline-block !important;
        margin-bottom: 6px !important;
    }

    /* KARTU SEKSI UTAMA FORM */
    .card-section-admin {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 16px !important;
        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.02) !important;
        margin-bottom: 18px !important;
        padding: 18px 20px !important;
    }

    .card-section-header {
        font-size: 0.98rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        border-left: 4px solid #1e6660 !important;
        padding-left: 10px !important;
        margin-bottom: 14px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
    }

    /* FLEXBOX BERSAMPINGAN (SIDE-BY-SIDE CONTAINER 50%-50%) */
    .flex-side-by-side {
        display: flex !important;
        gap: 14px !important;
        flex-wrap: wrap !important;
    }

    .flex-side-item {
        flex: 1 1 calc(50% - 7px) !important;
        min-width: 300px !important;
    }

    /* SUB-KARTU CONTAINER INPUT */
    .form-subcard {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 14px 16px !important;
        margin-bottom: 0 !important;
    }

    .sub-title-teal {
        font-size: 0.85rem !important;
        font-weight: 800 !important;
        color: #1e6660 !important;
        margin-bottom: 10px !important;
        display: flex !important;
        align-items: center !important;
        gap: 5px !important;
        border-bottom: 1px dashed #cbd5e1 !important;
        padding-bottom: 4px !important;
    }

    /* FORM INPUT CONTROL COMPACT */
    .form-group-admin label {
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        color: #475569 !important;
        margin-bottom: 4px !important;
        display: block !important;
    }

    .input-group-custom {
        display: flex !important;
        align-items: center !important;
        border: 1.5px solid #cbd5e1 !important;
        border-radius: 8px !important;
        background: #ffffff !important;
        overflow: hidden !important;
        transition: all 0.2s ease !important;
        height: 35px !important;
    }

    .input-group-custom:focus-within {
        border-color: #1e6660 !important;
        box-shadow: 0 0 0 3px rgba(30, 102, 96, 0.12) !important;
    }

    .input-group-icon {
        background: #f1f5f9 !important;
        color: #64748b !important;
        font-size: 0.85rem !important;
        padding: 0 10px !important;
        font-weight: 700 !important;
        border-right: 1px solid #e2e8f0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        height: 100% !important;
    }

    .input-group-unit {
        background: #f8fafc !important;
        color: #64748b !important;
        font-size: 0.72rem !important;
        font-weight: 800 !important;
        padding: 0 10px !important;
        border-left: 1px solid #e2e8f0 !important;
        text-transform: uppercase !important;
        display: flex !important;
        align-items: center !important;
        height: 100% !important;
    }

    .form-control-styled {
        width: 100% !important;
        border: none !important;
        padding: 0 10px !important;
        font-size: 0.86rem !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        background: transparent !important;
        height: 100% !important;
    }

    .form-control-styled:focus {
        outline: none !important;
    }

    /* GRID KOLOM INSIDE SUB-CARD */
    .grid-2-cols {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 10px !important;
    }

    .grid-3-cols {
        display: grid !important;
        grid-template-columns: repeat(3, 1fr) !important;
        gap: 10px !important;
    }

    .grid-4-cols {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        gap: 10px !important;
    }

    /* GRID 4 CARD RINGKASAN PERSISI 1 BARIS */
    .metric-grid-4 {
        display: grid !important;
        grid-template-columns: repeat(4, 1fr) !important;
        gap: 12px !important;
    }

    .metric-card-styled {
        background: #ffffff !important;
        border: 1px solid #e2e8f0 !important;
        border-top: 3px solid #1e6660 !important;
        border-radius: 12px !important;
        padding: 12px 14px !important;
        box-shadow: 0 2px 6px rgba(0,0,0,0.015) !important;
    }

    .metric-card-title {
        font-size: 0.74rem !important;
        font-weight: 800 !important;
        color: #64748b !important;
        text-transform: uppercase !important;
        margin-bottom: 2px !important;
    }

    .metric-card-value {
        font-size: 1.05rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin-bottom: 8px !important;
    }

    /* AREA UPLOAD FILE BOX */
    .file-upload-box {
        border: 1.5px dashed #cbd5e1 !important;
        background: #f8fafc !important;
        border-radius: 10px !important;
        padding: 12px 14px !important;
    }

    .btn-action-edit {
        background: #eff6ff !important;
        color: #2563eb !important;
        border: 1px solid #bfdbfe !important;
        padding: 4px 10px !important;
        border-radius: 6px !important;
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 3px !important;
        transition: all 0.2s ease !important;
    }

    .btn-action-edit:hover {
        background: #2563eb !important;
        color: #ffffff !important;
    }

    .btn-action-delete {
        background: #fef2f2 !important;
        color: #dc2626 !important;
        border: 1px solid #fecaca !important;
        padding: 4px 10px !important;
        border-radius: 6px !important;
        font-size: 0.78rem !important;
        font-weight: 700 !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 3px !important;
        transition: all 0.2s ease !important;
    }

    .btn-action-delete:hover {
        background: #dc2626 !important;
        color: #ffffff !important;
    }

    .custom-table {
        width: 100% !important;
        border-collapse: collapse !important;
    }
    .custom-table th {
        background: #f8fafc !important;
        color: #475569 !important;
        font-size: 0.78rem !important;
        font-weight: 800 !important;
        text-transform: uppercase !important;
        padding: 10px 12px !important;
        border-bottom: 2px solid #e2e8f0 !important;
    }
    .custom-table td {
        padding: 10px 12px !important;
        border-bottom: 1px solid #f1f5f9 !important;
        font-size: 0.85rem !important;
    }

    @media (max-width: 992px) {
        .metric-grid-4 { grid-template-columns: repeat(2, 1fr) !important; }
        .flex-side-item { flex: 1 1 100% !important; }
        .grid-3-cols, .grid-4-cols { grid-template-columns: repeat(2, 1fr) !important; }
    }
</style>

<div class="data-page-admin">
    <div class="container-fluid px-4 py-3">

        {{-- HERO BANNER DESA WAHA --}}
        <div class="card admin-hero-card border-0">
            <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                <div>
                    <span class="hero-eyebrow">⚙️ PANEL ADMIN DESA WAHA</span>
                    <h2 class="h4 font-weight-bold mb-1 text-white">Kelola Data & Statistik Desa</h2>
                    <p class="mb-0 text-white-50" style="font-size: 0.88rem;">Kelola indikator kependudukan, perumahan, fasilitas, dan berkas laporan desa secara real-time.</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <form method="GET" action="{{ Route::has('admin.data-desa') ? route('admin.data-desa') : url('/admin/data-desa') }}" class="d-flex align-items-center gap-2 m-0">
                        <label class="text-white font-weight-bold mb-0 text-nowrap" style="font-size: 0.82rem;">Tahun Data:</label>
                        <select name="year" onchange="this.form.submit()" class="form-control form-control-sm font-weight-bold" style="width: auto; border-radius: 6px; padding: 3px 8px; background: #ffffff; font-size: 0.82rem;">
                            @foreach($years as $yr)
                                <option value="{{ $yr }}" {{ (int)$selectedYear === (int)$yr ? 'selected' : '' }}>
                                    Tahun {{ $yr }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                    <a href="{{ Route::has('data-desa') ? route('data-desa') : url('/data-desa') }}" target="_blank" class="btn btn-light font-weight-bold text-dark btn-sm ml-2" style="border-radius: 6px; font-size: 0.8rem; padding: 4px 10px;">
                        Lihat Portal Warga ↗
                    </a>
                </div>
            </div>
        </div>

        {{-- ALERT SUKSES / ERROR --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 mb-3" role="alert" style="border-radius: 10px; font-weight: 700; background: #d1fae5; color: #065f46; font-size: 0.88rem; padding: 10px 16px;">
                ✨ {{ session('success') }}
                <button type="button" class="close btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show border-0 mb-3" role="alert" style="border-radius: 10px; font-weight: 700; background: #fee2e2; color: #991b1b; font-size: 0.88rem; padding: 10px 16px;">
                ⚠️ {{ session('error') }}
                <button type="button" class="close btn-close" data-dismiss="alert" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        {{-- 1. FORM RINGKASAN UTAMA --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">
            
            <div id="ringkasan" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>📊 4 Ringkasan Utama (Tahun {{ $selectedYear }})</span>
                </div>
                <div class="metric-grid-4">
                    <div class="metric-card-styled">
                        <div class="metric-card-title">Total Penduduk</div>
                        <div class="metric-card-value">{{ number_format($displayStats['total_penduduk'] ?? 0, 0, ',', '.') }} Jiwa</div>
                        <div class="input-group-custom">
                            <span class="input-group-icon">👥</span>
                            <input type="number" name="total_penduduk" value="{{ old('total_penduduk', $displayStats['total_penduduk'] ?? 0) }}" class="form-control-styled" required>
                            <span class="input-group-unit">Jiwa</span>
                        </div>
                    </div>

                    <div class="metric-card-styled">
                        <div class="metric-card-title">Kepala Keluarga (KK)</div>
                        <div class="metric-card-value">{{ number_format($displayStats['kepala_keluarga'] ?? 0, 0, ',', '.') }} KK</div>
                        <div class="input-group-custom">
                            <span class="input-group-icon">👨👩👧👦</span>
                            <input type="number" name="kepala_keluarga" value="{{ old('kepala_keluarga', $displayStats['kepala_keluarga'] ?? 0) }}" class="form-control-styled" required>
                            <span class="input-group-unit">KK</span>
                        </div>
                    </div>

                    <div class="metric-card-styled">
                        <div class="metric-card-title">Laki-laki</div>
                        <div class="metric-card-value">{{ number_format($displayStats['laki_laki'] ?? 0, 0, ',', '.') }} Jiwa</div>
                        <div class="input-group-custom">
                            <span class="input-group-icon">👨</span>
                            <input type="number" name="laki_laki" value="{{ old('laki_laki', $displayStats['laki_laki'] ?? 0) }}" class="form-control-styled" required>
                            <span class="input-group-unit">Jiwa</span>
                        </div>
                    </div>

                    <div class="metric-card-styled">
                        <div class="metric-card-title">Perempuan</div>
                        <div class="metric-card-value">{{ number_format($displayStats['perempuan'] ?? 0, 0, ',', '.') }} Jiwa</div>
                        <div class="input-group-custom">
                            <span class="input-group-icon">👩</span>
                            <input type="number" name="perempuan" value="{{ old('perempuan', $displayStats['perempuan'] ?? 0) }}" class="form-control-styled" required>
                            <span class="input-group-unit">Jiwa</span>
                        </div>
                    </div>
                </div>
                <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Ringkasan
                    </button></p>
            </div>
        </form>

        {{-- 2. FORM DEMOGRAFI & KELOMPOK UMUR --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">

            <div id="demografi" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>👶 Kelompok Umur & Demografi (ageChart)</span>
                </div>
                
                <div class="flex-side-by-side">
                    {{-- WADAH KIRI: KOMPOSISI UMUR --}}
                    <div class="flex-side-item" style="flex: 1.3 1 calc(60% - 7px);">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">🍼 Komposisi Umur Masyarakat</div>
                            <div class="grid-3-cols mb-2">
                                <div class="form-group-admin">
                                    <label>Balita (0-4 Thn)</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="balita" value="{{ old('balita', $displayStats['balita'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Anak (5-14 Thn)</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="anak" value="{{ old('anak', $displayStats['anak'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Remaja (15-24 Thn)</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="remaja" value="{{ old('remaja', $displayStats['remaja'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                            </div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Dewasa (25-59 Thn)</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="dewasa" value="{{ old('dewasa', $displayStats['dewasa'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Lansia (60+ Thn)</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="lansia" value="{{ old('lansia', $displayStats['lansia'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <p></p>
                                            <button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Demografi
                    </button>
                    </div>

                    {{-- WADAH KANAN: INDIKATOR KESEJAHTERAAN & LUAS WILAYAH --}}
                    <div class="flex-side-item" style="flex: 1 1 calc(40% - 7px);">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">📊 Indikator Kesejahteraan & Wilayah</div>
                            <div class="form-group-admin mb-2">
                                <label>Keluarga Miskin</label>
                                <div class="input-group-custom">
                                    <input type="number" name="keluarga_miskin" value="{{ old('keluarga_miskin', $displayStats['keluarga_miskin'] ?? 0) }}" class="form-control-styled">
                                    <span class="input-group-unit">KK</span>
                                </div>
                            </div>
                            <div class="form-group-admin mb-2">
                                <label>Warga Disabilitas</label>
                                <div class="input-group-custom">
                                    <input type="number" name="disabilitas" value="{{ old('disabilitas', $displayStats['disabilitas'] ?? 0) }}" class="form-control-styled">
                                    <span class="input-group-unit">Jiwa</span>
                                </div>
                            </div>
                            <div class="form-group-admin">
                                <label>Luas Wilayah Desa</label>
                                <div class="input-group-custom">
                                    <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $displayStats['luas_wilayah'] ?? '') }}" class="form-control-styled" placeholder="Contoh: 14.5">
                                    <span class="input-group-unit">Km²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        {{-- 3. FORM PERUMAHAN & HUNIAN --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">

            <div id="perumahan" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>🏠 Jenis Bangunan & Status Tempat Tinggal</span>
                </div>
                
                <div class="flex-side-by-side">
                    {{-- FORM A: JENIS BANGUNAN --}}
                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">🏢 A. Jenis Bangunan (buildingChart)</div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Rumah Tinggal</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="rumah_tinggal" value="{{ old('rumah_tinggal', $displayStats['rumah_tinggal'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Unit</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Toko / Ruko</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="toko" value="{{ old('toko', $displayStats['toko'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Unit</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Fasilitas Umum</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="fasilitas" value="{{ old('fasilitas', $displayStats['fasilitas'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Unit</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Bangunan Lain</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="bangunan_lain" value="{{ old('bangunan_lain', $displayStats['bangunan_lain'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Unit</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- FORM B: STATUS HUNIAN --}}
                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">🔑 B. Status Hunian (housingStatusChart)</div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Milik Sendiri</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="rumah_sendiri" value="{{ old('rumah_sendiri', $displayStats['rumah_sendiri'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">KK</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Sewa / Kontrak</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="rumah_sewa" value="{{ old('rumah_sewa', $displayStats['rumah_sewa'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">KK</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Bebas Sewa</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="bebas_sewa" value="{{ old('bebas_sewa', $displayStats['bebas_sewa'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">KK</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Menumpang</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="menumpang" value="{{ old('menumpang', $displayStats['menumpang'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">KK</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Perumahan
                    </button></p>
            </div>
        </form>

        {{-- 4. FORM FASILITAS UTAMA --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">

            <div id="fasilitas" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>🏥 Fasilitas Utama Desa (facilityChart)</span>
                </div>
                <div class="form-subcard mb-0">
                    <div class="grid-4-cols">
                        <div class="form-group-admin">
                            <label>🎓 Gedung Sekolah</label>
                            <div class="input-group-custom">
                                <input type="number" name="sekolah" value="{{ old('sekolah', $displayStats['sekolah'] ?? 0) }}" class="form-control-styled">
                                <span class="input-group-unit">Unit</span>
                            </div>
                        </div>
                        <div class="form-group-admin">
                            <label>🏥 Posyandu</label>
                            <div class="input-group-custom">
                                <input type="number" name="posyandu" value="{{ old('posyandu', $displayStats['posyandu'] ?? 0) }}" class="form-control-styled">
                                <span class="input-group-unit">Unit</span>
                            </div>
                        </div>
                        <div class="form-group-admin">
                            <label>🩺 Puskesmas / Klinik</label>
                            <div class="input-group-custom">
                                <input type="number" name="puskesmas" value="{{ old('puskesmas', $displayStats['puskesmas'] ?? 0) }}" class="form-control-styled">
                                <span class="input-group-unit">Unit</span>
                            </div>
                        </div>
                        <div class="form-group-admin">
                            <label>🕌 Tempat Ibadah</label>
                            <div class="input-group-custom">
                                <input type="number" name="tempat_ibadah" value="{{ old('tempat_ibadah', $displayStats['tempat_ibadah'] ?? 0) }}" class="form-control-styled">
                                <span class="input-group-unit">Unit</span>
                            </div>
                        </div>
                    </div>
                </div>
                <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Fasilitas
                    </button></p>
            </div>
        </form>

        {{-- 5. FORM PERKAWINAN & AGAMA --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">

            <div id="sosial" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>💍 Status Perkawinan & Agama</span>
                </div>
                <div class="flex-side-by-side">
                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">💍 Status Perkawinan (maritalChart)</div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Belum Kawin</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="belum_kawin" value="{{ old('belum_kawin', $displayStats['belum_kawin'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Sudah Kawin</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="kawin" value="{{ old('kawin', $displayStats['kawin'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Cerai Hidup</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="cerai_hidup" value="{{ old('cerai_hidup', $displayStats['cerai_hidup'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Cerai Mati</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="cerai_mati" value="{{ old('cerai_mati', $displayStats['cerai_mati'] ?? 0) }}" class="form-control-styled">
                                        <span class="input-group-unit">Jiwa</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">🕌 Agama & Kepercayaan (religionChart)</div>
                            <div class="grid-3-cols">
                                <div class="form-group-admin">
                                    <label>Islam</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="islam" value="{{ old('islam', $displayStats['islam'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Kristen</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="kristen" value="{{ old('kristen', $displayStats['kristen'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Katolik</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="katolik" value="{{ old('katolik', $displayStats['katolik'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Hindu</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="hindu" value="{{ old('hindu', $displayStats['hindu'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Buddha</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="buddha" value="{{ old('buddha', $displayStats['buddha'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Khonghucu</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="konghucu" value="{{ old('konghucu', $displayStats['konghucu'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Perkawinan & Agama
                    </button></p>
            </div>
        </form>

        {{-- 6. FORM PENDIDIKAN & PEKERJAAN --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST">
            @csrf
            <input type="hidden" name="tahun_data" value="{{ $selectedYear }}">

            <div id="pendidikan" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>🎓 Pendidikan & Mata Pencaharian</span>
                </div>
                <div class="flex-side-by-side">
                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">🎓 Tingkat Pendidikan (educationChart)</div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Belum Sekolah</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="belum_sekolah" value="{{ old('belum_sekolah', $displayStats['belum_sekolah'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>SD / Sederajat</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="sd" value="{{ old('sd', $displayStats['sd'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>SMP / Sederajat</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="smp" value="{{ old('smp', $displayStats['smp'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>SMA / SMK</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="sma" value="{{ old('sma', $displayStats['sma'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Diploma</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="diploma" value="{{ old('diploma', $displayStats['diploma'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Sarjana</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="sarjana" value="{{ old('sarjana', $displayStats['sarjana'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex-side-item">
                        <div class="form-subcard h-100">
                            <div class="sub-title-teal">💼 Mata Pencaharian (jobChart)</div>
                            <div class="grid-2-cols">
                                <div class="form-group-admin">
                                    <label>Petani / Pekebun</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="petani" value="{{ old('petani', $displayStats['petani'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Nelayan</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="nelayan" value="{{ old('nelayan', $displayStats['nelayan'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Pedagang</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="pedagang" value="{{ old('pedagang', $displayStats['pedagang'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Wiraswasta</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="wiraswasta" value="{{ old('wiraswasta', $displayStats['wiraswasta'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>PNS / TNI / Polri</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="pns" value="{{ old('pns', $displayStats['pns'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                                <div class="form-group-admin">
                                    <label>Karyawan Swasta</label>
                                    <div class="input-group-custom">
                                        <input type="number" name="karyawan" value="{{ old('karyawan', $displayStats['karyawan'] ?? 0) }}" class="form-control-styled">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Pendidikan & Pekerjaan
                    </button></p>
            </div>
        </form>

        {{-- 7. FORM CATATAN, TAHUN DATA & UNGGAH BERKAS LAPORAN --}}
        <form action="{{ Route::has('admin.data-desa.update') ? route('admin.data-desa.update') : url('/admin/data-desa/update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div id="berkas" class="card-section-admin">
                <div class="card-section-header d-flex justify-content-between align-items-center">
                    <span>📁 Catatan, Tahun & Unggah Berkas Laporan</span>
                </div>
                
                <div class="row g-2 mb-3">
                    {{-- FORM INPUT TAHUN DATA --}}
                    <div class="col-md-4">
                        <div class="form-group-admin">
                            <label class="font-weight-bold text-dark">📅 Tahun Data Statistik</label>
                            <div class="input-group-custom">
                                <span class="input-group-icon">📅</span>
                                <input type="number" name="tahun_data" value="{{ old('tahun_data', $selectedYear ?? date('Y')) }}" class="form-control-styled" placeholder="2026" min="2000" max="2100" required>
                                <span class="input-group-unit">TAHUN</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group-admin mb-3">
                    <label class="font-weight-bold text-dark">Catatan Ringkasan Statistik (Muncul di Halaman User)</label>
                    <textarea name="catatan" rows="2" class="form-control-styled border p-2 w-100" style="border-radius: 8px; background: #ffffff; font-size: 0.85rem;" placeholder="Tuliskan gambaran umum data statistik tahun ini...">{{ old('catatan', $displayStats['catatan'] ?? '') }}</textarea>
                </div>

                {{-- UPLOAD FILE BERSAMPINGAN (50% - 50%) --}}
                <div class="flex-side-by-side">
                    <div class="flex-side-item">
                        <div class="file-upload-box h-100">
                            <label class="form-label-custom font-weight-bold" style="color: #0f172a; font-size: 0.84rem;">📊 Upload File CSV / Excel (Tahun {{ $selectedYear }})</label>
                            <input type="file" name="file_csv" accept=".csv,.xlsx,.xls" class="form-control-styled border p-1 bg-white w-100 mb-1" style="border-radius: 6px; font-size: 0.82rem;">
                            @if(!empty($displayStats['file_csv']))
                                <small class="text-success mt-1 d-block font-weight-bold" style="font-size: 0.78rem;">
                                    ✓ Tersimpan: <a href="{{ asset($displayStats['file_csv']) }}" target="_blank" class="text-decoration-underline">Unduh CSV</a>
                                </small>
                            @endif
                        </div>
                    </div>
                    <div class="flex-side-item">
                        <div class="file-upload-box h-100">
                            <label class="form-label-custom font-weight-bold" style="color: #0f172a; font-size: 0.84rem;">📕 Upload File PDF Laporan Resmi (Tahun {{ $selectedYear }})</label>
                            <input type="file" name="file_pdf" accept=".pdf" class="form-control-styled border p-1 bg-white w-100 mb-1" style="border-radius: 6px; font-size: 0.82rem;">
                            @if(!empty($displayStats['file_pdf']))
                                <small class="text-success mt-1 d-block font-weight-bold" style="font-size: 0.78rem;">
                                    ✓ Tersimpan: <a href="{{ asset($displayStats['file_pdf']) }}" target="_blank" class="text-decoration-underline">Unduh PDF</a>
                                </small>
                            @endif
                        </div>
                    </div>
                </div>
                <p><button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm" style="background: #1e6660; border-radius: 8px; font-size: 0.8rem; padding: 6px 14px;">
                        💾 Simpan Berkas & Laporan
                    </button></p>
            </div>
        </form>

        {{-- 8. TABEL ARSIP LAPORAN DENGAN TOMBOL EDIT --}}
        <div class="card-section-admin">
            <div class="card-section-header">📚 Daftar Berkas Laporan & Arsip Data</div>

            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Tahun Data</th>
                            <th>File CSV</th>
                            <th>File PDF</th>
                            <th>Terakhir Diperbarui</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($histories as $history)
                            @php
                                $hData = is_array($history->data) ? $history->data : (is_string($history->data) ? json_decode($history->data, true) : []);
                                $hYear = $history->tahun ?? $history->tahun_data ?? date('Y');
                                $targetUrl = Route::has('admin.data-desa') 
                                    ? route('admin.data-desa', ['year' => $hYear, 'tahun' => $hYear, 'tahun_data' => $hYear])
                                    : url('/admin/data-desa?year=' . $hYear . '&tahun=' . $hYear . '&tahun_data=' . $hYear);
                            @endphp
                            <tr>
                                <td><strong style="color: #1e6660;">Tahun {{ $hYear }}</strong></td>
                                <td>
                                    @if(!empty($hData['file_csv']))
                                        <a href="{{ asset($hData['file_csv']) }}" target="_blank" class="badge badge-success p-1 px-2" style="background: #10b981; font-size: 0.75rem;">
                                            📊 CSV
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!empty($hData['file_pdf']))
                                        <a href="{{ asset($hData['file_pdf']) }}" target="_blank" class="badge badge-danger p-1 px-2" style="background: #ef4444; font-size: 0.75rem;">
                                            📕 PDF
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $history->updated_at ? \Carbon\Carbon::parse($history->updated_at)->format('d M Y, H:i') : '-' }}</td>
                                <td style="text-align: center;">
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        {{-- ✏️ TOMBOL EDIT --}}
                                        <a href="{{ $targetUrl }}#berkas" class="btn-action-edit" onclick="window.location.href='{{ $targetUrl }}#berkas'; window.location.reload();">
                                            ✏️ Edit
                                        </a>

                                        {{-- 🔴 TOMBOL HAPUS --}}
                                        <form action="{{ Route::has('admin.data-desa.riwayat.destroy') ? route('admin.data-desa.riwayat.destroy', $history->id) : url('/admin/data-desa/riwayat/' . $history->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus seluruh data statistik tahun {{ $hYear }}?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-action-delete">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">Belum ada berkas data statistik yang tersimpan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- 9. PENGELOLAAN DATA DUSUN / RT --}}
        <div id="dusun" class="card-section-admin">
            <div class="card-section-header">🏘️ Kelola Data Dusun & RT (villageChart)</div>
            
            {{-- FORM TAMBAH DUSUN --}}
            <form action="{{ Route::has('admin.data-desa.wilayah.store') ? route('admin.data-desa.wilayah.store') : url('/admin/data-desa/wilayah') }}" method="POST" class="mb-3">
                @csrf
                <div class="row align-items-end g-2">
                    <div class="col-md-4">
                        <label class="form-label-custom">Nama Dusun</label>
                        <div class="input-group-custom">
                            <span class="input-group-icon">🏘️</span>
                            <input type="text" name="nama_dusun" class="form-control-styled" placeholder="Contoh: Dusun I Waha" required>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Jumlah RT</label>
                        <div class="input-group-custom">
                            <input type="number" name="jumlah_rt" class="form-control-styled" placeholder="Contoh: 4" required>
                            <span class="input-group-unit">RT</span>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">Jumlah Penduduk Dusun</label>
                        <div class="input-group-custom">
                            <input type="number" name="jumlah_penduduk" class="form-control-styled" placeholder="Contoh: 450" required>
                            <span class="input-group-unit">Jiwa</span>
                        </div>
                    </div>
                    <p></p>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-sm text-white font-weight-bold shadow-sm w-100 justify-content-center" style="background: #1e6660; border-radius: 8px; padding: 8px 10px; font-size: 0.82rem;">
                            ➕ Tambah
                        </button>
                    </div>
                </div>
            </form>

            {{-- DAFTAR DUSUN TERDAFTAR --}}
            <div class="table-responsive">
                <table class="custom-table">
                    <thead>
                        <tr>
                            <th>Nama Dusun</th>
                            <th>Jumlah RT</th>
                            <th>Jumlah Penduduk Dusun</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($villages as $village)
                            <tr>
                                <td><strong>{{ $village->nama_dusun ?? $village->name }}</strong></td>
                                <td>{{ $village->jumlah_rt ?? $village->rt_count ?? 0 }} RT</td>
                                <td>{{ number_format($village->jumlah_penduduk ?? $village->population ?? 0, 0, ',', '.') }} Jiwa</td>
                                <td style="text-align: center;">
                                    <form action="{{ Route::has('admin.data-desa.wilayah.destroy') ? route('admin.data-desa.wilayah.destroy', $village->id) : url('/admin/data-desa/wilayah/' . $village->id) }}" method="POST" onsubmit="return confirm('Hapus data dusun ini?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action-delete">🗑️ Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-3">Belum ada data dusun ditambahkan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Auto scroll ke seksi tujuan jika terdapat anchor hash di URL
        if (window.location.hash) {
            setTimeout(function() {
                const targetEl = document.querySelector(window.location.hash);
                if (targetEl) {
                    targetEl.scrollIntoView({ behavior: 'smooth' });
                }
            }, 150);
        }

        const navLinks = document.querySelectorAll('.admin-nav-pills a');
        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                navLinks.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
    });
</script>
@endpush