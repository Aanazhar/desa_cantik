@extends('layouts.app')

@section('title', 'Layanan Desa - ' . ($activeDesa->name ?? 'Desa Waha'))

@push('styles')
{{-- IMPOR FONT INTER DAFTAR GOOGLE FONTS --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* GLOBAL FONT INTER */
    body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    /* =========================================================
       HALAMAN LAYANAN DESA - HERO & BUTTON CEK STATUS
       ========================================================= */

    .page-hero {
        padding: 40px 0;
        background: linear-gradient(135deg, #0f766e 0%, #155e75 100%);
        color: #ffffff;
        margin-bottom: 28px;
    }

    .page-hero-flex {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 24px;
    }

    .page-hero h1 {
        font-size: clamp(1.8rem, 3.5vw, 2.5rem);
        margin: 4px 0 8px;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: #ffffff;
    }

    .page-hero p {
        max-width: 650px;
        margin: 0;
        opacity: 0.95;
        font-size: 0.95rem;
        line-height: 1.5;
        color: #ffffff;
    }

    /* TOMBOL CEK STATUS PENGAJUAN (ATAS KANAN) */
    .btn-check-status-hero {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 24px;
        border-radius: 14px;
        background: #ffffff;
        color: #0f766e !important;
        font-weight: 800;
        font-size: 0.92rem;
        text-decoration: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        white-space: nowrap;
    }

    .btn-check-status-hero:hover {
        background: #f0fdf4;
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.22);
        color: #0b5f59 !important;
    }

    .service-section-title {
        margin-bottom: 18px;
    }

    .service-section-title h2 {
        margin: 3px 0 5px;
        font-size: 1.4rem;
        font-weight: 800;
        color: #153f3f;
    }

    .service-section-title p {
        margin: 0;
        color: #64748b;
        font-size: 0.88rem;
    }

    /* GRID LAYANAN INFORMASI */
    .service-grid-modern {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 35px;
    }

    /* GRID PENGAJUAN SURAT */
    .service-picker-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 16px;
        margin-bottom: 35px;
    }

    .service-card-modern {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px;
        display: flex;
        flex-direction: column;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.03);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.3s ease, border-color 0.3s ease;
    }

    .service-card-modern:hover {
        transform: translateY(-5px) scale(1.015);
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.12);
        border-color: #0f766e;
    }

    .service-icon {
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #ecfdf5;
        color: #0f766e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-bottom: 12px;
        flex-shrink: 0;
    }

    .service-card-modern h3 {
        margin: 0 0 6px;
        font-size: 1.08rem;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.3;
    }

    .service-card-modern p {
        margin: 0 0 14px;
        color: #475569;
        font-size: 0.85rem;
        line-height: 1.5;
        flex: 1;
    }

    .service-card-requirements {
        background: #f8fafc;
        border: 1px solid #f1f5f9;
        border-radius: 10px;
        padding: 10px 12px;
        margin-bottom: 14px;
    }

    .service-card-requirements strong {
        display: block;
        font-size: 0.8rem;
        color: #0f766e;
        margin-bottom: 5px;
    }

    .service-card-requirements ul {
        margin: 0;
        padding-left: 16px;
        color: #334155;
        font-size: 0.82rem;
        line-height: 1.5;
    }

    /* PANEL FORMULIR PENGAJUAN DINAMIS */
    .letter-request-panel {
        background: #ffffff;
        border: 2px solid #0f766e;
        border-radius: 18px;
        padding: 24px;
        margin-top: 35px;
        box-shadow: 0 8px 30px rgba(15, 118, 110, 0.1);
        scroll-margin-top: 80px;
    }

    .letter-request-panel h2 {
        margin: 3px 0 16px;
        font-size: 1.4rem;
        font-weight: 800;
        color: #0f766e;
    }

    .service-requirements {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 12px;
        padding: 14px;
        margin-bottom: 20px;
        color: #143129;
    }

    .service-requirements h3 {
        margin: 0 0 8px;
        font-size: 0.92rem;
        font-weight: 800;
        color: #065f46;
    }

    .service-requirements ul {
        margin: 0;
        padding-left: 18px;
        font-size: 0.88rem;
        line-height: 1.6;
        color: #047857;
    }

    /* FORM GRID */
    .dynamic-form-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 14px;
    }

    .admin-form-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .admin-form-group label {
        font-size: 0.85rem;
        font-weight: 750;
        color: #1e293b;
    }

    .admin-form-group input,
    .admin-form-group textarea,
    .admin-form-group select {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        font-family: inherit;
        font-size: 0.88rem;
        color: #0f172a;
        background-color: #ffffff;
        outline: none;
        transition: border-color 0.2s ease;
    }

    .admin-form-group input:focus,
    .admin-form-group textarea:focus,
    .admin-form-group select:focus {
        border-color: #0f766e;
        box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.15);
    }

    /* BUTTON STYLING */
    .btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 11px 18px;
        background: #0f766e;
        color: #ffffff;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.88rem;
        border: none;
        cursor: pointer;
        transition: background 0.2s ease, transform 0.2s ease;
        width: 100%;
    }

    .btn-primary:hover {
        background: #0b5f59;
        transform: translateY(-1px);
    }

    /* NOTIFIKASI PUBLIC */
    .public-success {
        padding: 12px 16px;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #065f46;
        border-radius: 10px;
        font-size: 0.88rem;
        margin-bottom: 20px;
    }

    .public-error {
        padding: 12px 16px;
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
        border-radius: 10px;
        font-size: 0.88rem;
        margin-bottom: 20px;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 30px;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        color: #64748b;
        font-size: 0.88rem;
    }

    /* RESPONSIVE MEDIA QUERIES (OPTIMAL UNTUK HP / ANDROID) */
    @media (max-width: 768px) {
        .page-hero { padding: 25px 0 28px; }
        .page-hero-flex {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }

        .btn-check-status-hero {
            width: 100%;
            justify-content: center;
        }

        .page-hero h1 { font-size: clamp(1.5rem, 5.5vw, 2rem); }
        .page-hero p { font-size: 0.88rem; }

        .service-grid-modern,
        .service-picker-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .dynamic-form-grid {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .letter-request-panel {
            padding: 18px 16px;
            border-radius: 14px;
            margin-top: 25px;
        }

        .letter-request-panel h2 {
            font-size: 1.2rem;
        }

        .service-card-modern {
            padding: 16px;
        }
    }
</style>
@endpush

@section('content')

    {{-- HERO SECTION DENGAN BUTTON CEK STATUS PENGAJUAN (ATAS KANAN) --}}
    <section class="page-hero">
        <div class="container page-hero-flex">
            <div>
                <span class="section-label" style="color: #99f6e4; font-size: 11px; font-weight: 800; letter-spacing: 0.5px;">PELAYANAN DIGITAL</span>
                <h1>Layanan Desa</h1>
                <p>Temukan layanan administrasi, persyaratan dokumen, dan formulir pengajuan masyarakat dalam satu halaman.</p>
            </div>

            <div class="page-hero-action">
                <a href="{{ route('layanan.status') }}" class="btn-check-status-hero">
                    <span>🔍 Cek Status Pengajuan</span>
                    <span>→</span>
                </a>
            </div>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="section">
        <div class="container">

            {{-- NOTIFIKASI SUCCESS & ERROR --}}
            @if(session('success'))
                <div class="public-success">
                    ✓ {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="public-error">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            {{-- SECTION 2: PENGAJUAN SURAT & ADMINISTRASI --}}
            <div class="service-section-title" style="margin-top:1px;">
                <span class="section-label">PENGAJUAN ONLINE</span>
                <h2>Surat & Administrasi Online</h2>
                <p>Pilih jenis surat di bawah ini untuk melihat persyaratan dan mengisi formulir pengajuan.</p>
            </div>

            <div class="service-picker-grid">
                @forelse($letters as $service)
                    <article class="service-card-modern service-picker">
                        <div class="service-icon">
                            {{ $service->icon ?: '📄' }}
                        </div>
                        <h3>{{ $service->title }}</h3>
                        <p>{{ $service->description }}</p>

                        <div class="service-card-requirements">
                            <strong>📋 Dokumen yang perlu disiapkan:</strong>
                            <ul>
                                @forelse(array_slice($service->requirements ?? [], 0, 4) as $req)
                                    <li>{{ $req }}</li>
                                @empty
                                    <li>Persyaratan akan diinformasikan lebih lanjut oleh petugas desa.</li>
                                @endforelse
                            </ul>
                        </div>

                        <button
                            type="button"
                            class="btn-primary letter-select"
                            data-id="{{ $service->id }}"
                        >
                            Ajukan Sekarang →
                        </button>
                    </article>
                @empty
                    <div class="empty-state">
                        Belum ada layanan pengajuan surat online.
                    </div>
                @endforelse
            </div>

            {{-- FORMULIR PENGAJUAN DINAMIS (TANPA NIK) --}}
            <div id="form-pengajuan" class="letter-request-panel" style="display: none;">
                <span class="section-label">FORMULIR ONLINE</span>
                <h2 id="form-title">Pengajuan Layanan</h2>

                <div id="requirements-box" class="service-requirements"></div>

                <form method="POST" action="{{ route('layanan.pengajuan-surat') }}">
                    @csrf
                    <input type="hidden" name="service_id" id="service_id">

                    <div class="dynamic-form-grid">
                        <div class="admin-form-group">
                            <label>Nama Lengkap *</label>
                            <input name="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap sesuai KTP">
                        </div>

                        <div class="admin-form-group">
                            <label>No. HP / WhatsApp *</label>
                            <input name="no_hp" required value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                        </div>

                        {{-- FIELD DINAMIS LAINNYA --}}
                        <div id="dynamic-fields" class="dynamic-form-grid" style="grid-column: 1 / -1;"></div>
                    </div>

                    <div style="margin-top: 20px;">
                        <button class="btn-primary" type="submit" style="width: 100%; min-height: 46px;">
                            📩 Kirim Pengajuan Surat
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </section>

@endsection

@php
    $servicesData = $letters->map(function($s) {
        return [
            'id'           => $s->id,
            'title'        => $s->title,
            'fields'       => $s->form_fields ?? [],
            'requirements' => $s->requirements ?? []
        ];
    })->values();
@endphp

@push('scripts')
<script>
    const services = @json($servicesData);

    document.querySelectorAll('.letter-select').forEach(btn => {
        btn.addEventListener('click', () => {
            const service = services.find(x => String(x.id) === String(btn.dataset.id));
            if (!service) return;

            document.getElementById('service_id').value = service.id;
            document.getElementById('form-title').textContent = 'Pengajuan ' + service.title;

            const reqBox = document.getElementById('requirements-box');
            reqBox.innerHTML = '<h3>📋 Dokumen yang perlu disiapkan:</h3><ul>' +
                (service.requirements || []).map(x => '<li>' + String(x).replace(/[<>]/g, '') + '</li>').join('') +
                '</ul>';

            const box = document.getElementById('dynamic-fields');
            box.innerHTML = '';

            (service.fields || []).filter(f => !['nama', 'no_hp', 'nik'].includes(f.name) && f.type !== 'document').forEach(f => {
                const wrap = document.createElement('div');
                wrap.className = 'admin-form-group';

                const label = document.createElement('label');
                label.textContent = (f.label || f.name) + (f.required ? ' *' : '');
                wrap.appendChild(label);

                let el = document.createElement(f.type === 'textarea' ? 'textarea' : 'input');
                if (f.type !== 'textarea') {
                    el.type = f.type || 'text';
                }

                el.name = 'form[' + f.name + ']';
                el.required = !!f.required;

                if (f.type === 'textarea') {
                    el.rows = 4;
                }

                if (f.placeholder) {
                    el.placeholder = f.placeholder;
                }

                wrap.appendChild(el);
                box.appendChild(wrap);
            });

            const panel = document.getElementById('form-pengajuan');
            panel.style.display = 'block';
            panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
</script>
@endpush