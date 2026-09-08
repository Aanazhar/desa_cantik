@extends('layouts.admin')

@section('title', 'Pengajuan Masyarakat')

@push('styles')
<style>
    /* =========================================================
       FILTER TOOLBAR SUPER PREMIUM & BADGES
       ========================================================= */
    .filter-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 22px;
        padding: 24px;
        margin-bottom: 25px;
        box-shadow: 0 8px 30px rgba(15, 118, 110, 0.06);
        position: relative;
        overflow: hidden;
    }

    .filter-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #0f766e, #0891b2, #10b981);
    }

    .filter-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 18px;
        flex-wrap: wrap;
        gap: 12px;
    }

    .filter-title {
        font-size: 1rem;
        font-weight: 800;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-grid {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr auto;
        gap: 14px;
        align-items: flex-end;
    }

    .filter-field-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .filter-field-group label {
        font-size: 0.78rem;
        font-weight: 800;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-input-wrap {
        position: relative;
    }

    .filter-input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        color: #94a3b8;
        font-size: 0.9rem;
        pointer-events: none;
    }

    .filter-input {
        width: 100%;
        padding: 11px 14px 11px 40px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.2s ease;
        background: #f8fafc;
        box-sizing: border-box;
        font-family: inherit;
    }

    .filter-select {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.9rem;
        outline: none;
        transition: all 0.2s ease;
        background: #ffffff;
        box-sizing: border-box;
        font-weight: 700;
        color: #1e293b;
        font-family: inherit;
    }

    .filter-input:focus, .filter-select:focus {
        background: #ffffff;
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
    }

    .btn-filter-submit {
        background: linear-gradient(135deg, #0f766e 0%, #0891b2 100%);
        color: #ffffff;
        border: 0;
        padding: 11px 22px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.9rem;
        cursor: pointer;
        transition: all 0.25s ease;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.25);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-filter-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(15, 118, 110, 0.35);
    }

    .btn-filter-reset {
        background: #f1f5f9;
        color: #475569;
        border: 1px solid #cbd5e1;
        padding: 11px 16px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.88rem;
        text-decoration: none;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        white-space: nowrap;
    }

    .btn-filter-reset:hover {
        background: #e2e8f0;
        color: #0f172a;
    }

    /* BADGE STATUS SUPER CANTIK */
    .status-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .badge-menunggu, .badge-pending { background: #fef3c7; color: #b45309; border: 1px solid #fde68a; }
    .badge-diproses { background: #e0f2fe; color: #0369a1; border: 1px solid #bae6fd; }
    .badge-selesai  { background: #dcfce7; color: #15803d; border: 1px solid #bbf7d0; }
    .badge-ditolak  { background: #fee2e2; color: #991b1b; border: 1px solid #fca5a5; }

    @media (max-width: 1024px) {
        .filter-grid { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

<div class="admin-page-header">
    <div>
        <span class="section-label">PELAYANAN</span>
        <h1>Pengajuan Masyarakat</h1>
        <p>Kelola, filter, dan perbarui status pengajuan surat online warga secara realtime.</p>
    </div>
    <a class="admin-btn admin-btn-secondary" href="{{ route('admin.layanan') }}">← Kelola Layanan</a>
</div>

@if(session('success'))
    <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="admin-alert admin-alert-error">{{ $errors->first() }}</div>
@endif

{{-- =========================================================
     🔍 FILTER TOOLBAR BEAUTIFIED SUPER PREMIUM
     ========================================================= --}}
<div class="filter-card">
    <div class="filter-header">
        <div class="filter-title">
            <span>🔎 Filter & Pencarian Pengajuan</span>
        </div>
    </div>

    <form method="GET" action="{{ route('admin.pengajuan.index') }}">
        <div class="filter-grid">
            {{-- INPUT PENCARIAN --}}
            <div class="filter-field-group">
                <label>Pancarian Kata Kunci</label>
                <div class="filter-input-wrap">
                    <span class="filter-input-icon">🔍</span>
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari Kode Pengajuan, Nama Pemohon, atau No HP..." class="filter-input">
                </div>
            </div>

            {{-- FILTER STATUS --}}
            <div class="filter-field-group">
                <label>Status Surat</label>
                <select name="status" onchange="this.form.submit()" class="filter-select">
                    <option value="semua">-- Semua Status --</option>
                    @foreach(['Menunggu','Diproses','Selesai','Ditolak'] as $st)
                        <option value="{{ $st }}" @selected(request('status') === $st)>{{ $st }}</option>
                    @endforeach
                </select>
            </div>

            {{-- FILTER JENIS LAYANAN --}}
            @if(isset($services) && count($services) > 0)
                <div class="filter-field-group">
                    <label>Jenis Layanan</label>
                    <select name="service_id" onchange="this.form.submit()" class="filter-select">
                        <option value="semua">-- Semua Layanan --</option>
                        @foreach($services as $srv)
                            <option value="{{ $srv->id }}" @selected((string)request('service_id') === (string)$srv->id)>{{ $srv->title }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

            {{-- TOMBOL CARI & RESET --}}
            <div style="display: flex; gap: 8px;">
                <button type="submit" class="btn-filter-submit">
                    Cari Pengajuan
                </button>

                @if(request('q') || (request('status') && request('status') !== 'semua') || (request('service_id') && request('service_id') !== 'semua'))
                    <a href="{{ route('admin.pengajuan.index') }}" class="btn-filter-reset">
                        🔄 Reset
                    </a>
                @endif
            </div>
        </div>
    </form>
</div>

{{-- DAFTAR TABLE PENGAJUAN --}}
<div class="admin-card">
    <div class="admin-table-wrapper">
        <table class="admin-table request-table">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Waktu</th>
                    <th>Pemohon</th>
                    <th>Layanan</th>
                    <th>Data Pengajuan</th>
                    <th>Status & Catatan Admin</th>
                </tr>
            </thead>
            <tbody>
            @forelse($requests as $item)
                @php
                    $stClass = strtolower($item->status ?? 'pending');
                @endphp
                <tr>
                    <td>
                        <strong style="color: #0f766e; font-family: monospace; font-size: 0.95rem;">
                            {{ $item->tracking_code ?: '-' }}
                        </strong>
                    </td>
                    <td>
                        <span style="font-size: 0.85rem; color: #475569;">
                            {{ $item->created_at?->format('d/m/Y H:i') }}
                        </span>
                    </td>
                    <td>
                        <strong>{{ $item->nama }}</strong><br>
                        <small style="color: #64748b; font-weight: 700;">📱 {{ $item->no_hp }}</small>
                    </td>
                    <td>
                        <strong style="color: #0f172a;">{{ $item->service->title ?? '-' }}</strong>
                    </td>
                    <td>
                        <details>
                            <summary style="cursor: pointer; font-weight: 800; color: #0f766e; font-size: 0.88rem;">
                                📄 lihat detail pengajuan
                            </summary>
                            <div class="request-detail-box" style="margin-top: 8px; background: #f8fafc; padding: 12px; border-radius: 12px; border: 1px solid #e2e8f0;">
                                @if(isset($item->keperluan) && $item->keperluan)
                                    <strong style="color: #334155;">Keperluan:</strong>
                                    <p style="margin: 2px 0 8px; color: #475569;">{{ $item->keperluan }}</p>
                                @endif
                                @if(isset($item->form_data) && is_array($item->form_data))
                                    @foreach($item->form_data as $key => $value)
                                        @if($key !== 'nik')
                                            <div style="margin-bottom: 4px; font-size: 0.84rem;">
                                                <b style="color: #334155;">{{ ucwords(str_replace('_',' ', $key)) }}:</b> 
                                                <span style="color: #475569;">{{ is_array($value) ? json_encode($value) : $value }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                        </details>
                    </td>
                    <td>
                        <form method="POST" action="{{ route('admin.pengajuan.update', $item->id) }}" class="request-status-form" style="display: flex; flex-direction: column; gap: 8px;">
                            @csrf @method('PUT')
                            <div style="display: flex; gap: 8px; align-items: center;">
                                <select name="status" class="filter-select" style="padding: 6px 10px; font-size: 0.82rem;">
                                    @foreach(['Menunggu','Diproses','Selesai','Ditolak'] as $status)
                                        <option value="{{ $status }}" {{ $item->status === $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                <span class="status-badge-pill badge-{{ $stClass }}">
                                    {{ $item->status ?? 'Menunggu' }}
                                </span>
                            </div>

                            <textarea name="catatan_admin" rows="2" placeholder="Catatan untuk pemohon..." style="width: 100%; padding: 8px; border-radius: 8px; border: 1px solid #cbd5e1; font-size: 0.82rem; font-family: inherit;">{{ $item->catatan_admin }}</textarea>
                            <button class="admin-btn admin-btn-primary admin-btn-small" type="submit" style="padding: 6px 12px; font-size: 0.8rem; font-weight: 800;">💾 Simpan Status</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">
                        <div class="admin-empty-state" style="padding: 40px 20px; text-align: center; color: #94a3b8;">
                            📋 Belum ada data pengajuan yang cocok dengan filter pencarian.
                        </div>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    @if(method_exists($requests, 'hasPages') && $requests->hasPages())
        <div class="admin-pagination" style="padding: 16px;">{{ $requests->links() }}</div>
    @endif
</div>
@endsection