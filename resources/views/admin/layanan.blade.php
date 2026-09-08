@extends('layouts.admin')

@section('title', 'Layanan Desa')

@section('content')
<div class="admin-page-header">
    <div>
        <span class="section-label">PELAYANAN</span>
        <h1>Kelola Layanan Desa</h1>
        <p>Buat layanan, atur nomor WhatsApp petugas, atur persyaratan, formulir, urutan menu, dan status tampilannya.</p>
    </div>
    <a class="admin-btn admin-btn-primary" href="{{ route('admin.pengajuan.index') }}">📥 Lihat Pengajuan</a>
</div>

@if(session('success'))
    <div class="admin-alert admin-alert-success">{{ session('success') }}</div>
@endif
@if($errors->any())
    <div class="admin-alert admin-alert-error">{{ $errors->first() }}</div>
@endif

{{-- =========================================================
     📱 CARD PENGATURAN NOMOR WHATSAPP PETUGAS PELAYANAN
     ========================================================= --}}
@php
    $currentWa = \Illuminate\Support\Facades\DB::table('isi_situs')->where('desa_id', session('desa_id', 1))->where('key', 'no_whatsapp')->value('value') ?? '081234567890';
@endphp

<div class="admin-card" style="border-top: 4px solid #25d366; margin-bottom: 25px;">
    <div class="admin-card-header">
        <div>
            <h2 style="color: #166534;">📱 Nomor WhatsApp Petugas Pelayanan</h2>
            <p class="admin-card-description">Nomor WhatsApp ini digunakan warga untuk konfirmasi & menanyakan status surat di website.</p>
        </div>
        <div class="admin-card-icon" style="font-size: 28px;">💬</div>
    </div>

    <form method="POST" action="{{ route('admin.layanan.whatsapp.update') }}">
        @csrf
        <div class="admin-grid" style="grid-template-columns: 1fr auto; align-items: end; gap: 15px;">
            <div class="admin-form-group" style="margin: 0;">
                <label>Nomor WhatsApp Layanan Desa *</label>
                <input name="no_whatsapp" value="{{ old('no_whatsapp', $currentWa) }}" required placeholder="Contoh: 081234567890 atau 6281234567890" style="font-weight: 800; font-size: 1rem; color: #166534;">
                <small class="admin-form-help">Format: 08... atau 628... (Otomatis terhubung ke tombol WhatsApp warga di website).</small>
            </div>
            <div class="admin-form-group" style="margin: 0;">
                <button class="admin-btn admin-btn-primary" type="submit" style="background: #25d366; border-color: #25d366; padding: 11px 24px; font-weight: 800; cursor: pointer;">
                    💾 Simpan Nomor WA
                </button>
            </div>
        </div>
    </form>
</div>

{{-- FORM TAMBAH LAYANAN BARU --}}
<div class="admin-card service-admin-create" id="tambah-layanan">
    <div class="admin-card-header">
        <div>
            <h2>Tambah Layanan</h2>
            <p class="admin-card-description">Layanan dapat berupa informasi biasa atau layanan yang menerima pengajuan online.</p>
        </div>
        <div class="admin-card-icon">➕</div>
    </div>

    <form method="POST" action="{{ route('admin.layanan.store') }}">
        @csrf
        <div class="admin-grid">
            <div class="admin-form-group">
                <label>Nama layanan *</label>
                <input name="title" required placeholder="Contoh: Surat Keterangan Domisili">
            </div>
            <div class="admin-form-group">
                <label>Ikon</label>
                <input name="icon" value="📄" maxlength="100">
            </div>
            <div class="admin-form-group">
                <label>Urutan menu</label>
                <input type="number" name="sort_order" value="0" min="0">
            </div>
            <div class="admin-form-group admin-check-card">
                <label><input type="checkbox" name="is_letter" value="1"> Layanan menerima pengajuan online</label>
            </div>
        </div>
        <div class="admin-form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Jelaskan fungsi layanan."></textarea>
        </div>
        <div class="admin-grid">
            <div class="admin-form-group">
                <label>Persyaratan dokumen</label>
                <textarea name="requirements" rows="7" placeholder="Satu dokumen per baris"></textarea>
                <small class="admin-form-help">Contoh: KTP pemohon, KK, surat pengantar RT/RW.</small>
            </div>
            <div class="admin-form-group">
                <label>Field formulir tambahan (JSON)</label>
                <textarea name="form_fields" rows="7" placeholder='[{"name":"alamat","label":"Alamat","type":"textarea","required":true}]'></textarea>
                <small class="admin-form-help">Kosongkan untuk memakai formulir standar otomatis.</small>
            </div>
        </div>
        <button class="admin-btn admin-btn-primary" type="submit">💾 Simpan Layanan</button>
    </form>
</div>

{{-- DAFTAR LAYANAN TERSIMPAN --}}
<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h2>Daftar Layanan</h2>
            <p class="admin-card-description">Klik kartu layanan untuk membuka editor lengkapnya.</p>
        </div>
        <div class="admin-card-icon">🧾</div>
    </div>

    <div class="service-admin-list">
        @forelse($services as $service)
            <details class="service-admin-item" {{ $loop->first ? 'open' : '' }}>
                <summary>
                    <span class="service-admin-summary-icon">{{ $service->icon ?: '📄' }}</span>
                    <span class="service-admin-summary-text">
                        <strong>{{ $service->title }}</strong>
                        <small>{{ $service->is_letter ? 'Pengajuan online' : 'Informasi' }} · Urutan {{ $service->sort_order }}</small>
                    </span>
                    <span class="service-status {{ $service->active ? 'on' : 'off' }}">{{ $service->active ? 'Aktif' : 'Nonaktif' }}</span>
                    <span class="service-chevron">⌄</span>
                </summary>

                <div class="service-admin-editor">
                    <form method="POST" action="{{ route('admin.layanan.update', $service->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="admin-grid">
                            <div class="admin-form-group">
                                <label>Nama layanan *</label>
                                <input name="title" value="{{ $service->title }}" required>
                            </div>
                            <div class="admin-form-group">
                                <label>Ikon</label>
                                <input name="icon" value="{{ $service->icon ?: '📄' }}">
                            </div>
                            <div class="admin-form-group">
                                <label>Urutan</label>
                                <input type="number" name="sort_order" value="{{ $service->sort_order }}" min="0">
                            </div>
                            <div class="admin-form-group admin-check-card">
                                <label>
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" value="1" {{ $service->active ? 'checked' : '' }}>
                                    Tampilkan di website
                                </label>
                            </div>
                        </div>

                        <div class="admin-form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="3">{{ $service->description }}</textarea>
                        </div>

                        @if($service->is_letter)
                            @php
                                $reqText = is_array($service->requirements) ? implode("\n", $service->requirements) : ($service->requirements ?? '');
                                $formJson = is_array($service->form_fields) ? json_encode($service->form_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : ($service->form_fields ?? '[]');
                            @endphp
                            <div class="admin-grid">
                                <div class="admin-form-group">
                                    <label>Persyaratan dokumen</label>
                                    <textarea name="requirements" rows="8">{{ $reqText }}</textarea>
                                </div>
                                <div class="admin-form-group">
                                    <label>Field formulir JSON</label>
                                    <textarea name="form_fields" rows="8">{{ $formJson }}</textarea>
                                </div>
                            </div>
                        @else
                            <input type="hidden" name="requirements" value="">
                            <input type="hidden" name="form_fields" value="">
                            <div class="admin-info-note">Layanan informasi tidak membutuhkan formulir pengajuan.</div>
                        @endif

                        <div class="service-admin-actions">
                            <button class="admin-btn admin-btn-primary" type="submit">💾 Simpan Perubahan</button>
                            <a class="admin-btn admin-btn-light" href="{{ route('layanan.show', $service->id) }}" target="_blank">↗ Lihat User</a>
                        </div>
                    </form>

                    <div class="service-admin-actions service-admin-secondary-actions" style="margin-top: 15px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <form method="POST" action="{{ route('admin.layanan.toggle', $service->id) }}" style="margin: 0;">
                            @csrf @method('PATCH')
                            <button class="admin-btn admin-btn-secondary" type="submit">
                                {{ $service->active ? '⏸ Nonaktifkan Layanan' : '▶ Aktifkan Layanan' }}
                            </button>
                        </form>

                        <form method="POST" action="{{ route('admin.layanan.destroy', $service->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan &quot;{{ $service->title }}&quot;?')" style="margin: 0;">
                            @csrf @method('DELETE')
                            <button class="admin-btn admin-btn-danger" type="submit" style="background:#fee2e2; color:#991b1b; border:none; padding:8px 14px; border-radius:8px; font-weight:700; cursor:pointer;">
                                🗑 Hapus Layanan
                            </button>
                        </form>
                    </div>
                </div>
            </details>
        @empty
            <div class="admin-empty-state">Belum ada layanan. Tambahkan layanan menggunakan formulir di atas.</div>
        @endforelse
    </div>
</div>
@endsection