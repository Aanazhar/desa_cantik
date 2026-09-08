@extends('layouts.app')

@section('title', $service->title)

@push('styles')
<style>
    /* =========================================================
       FIXED FULLSCREEN MODAL (SEKETIKA MUNCUL TANPA SKROLL)
       ========================================================= */
    .modal-overlay-fixed {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.75) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 9999999 !important;
        padding: 20px !important;
        box-sizing: border-box !important;
    }

    .modal-card-bounce {
        background: #ffffff !important;
        width: 100% !important;
        max-width: 460px !important;
        border-radius: 28px !important;
        padding: 35px 25px !important;
        text-align: center !important;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4) !important;
        border: 1px solid #bbf7d0 !important;
        position: relative !important;
        animation: modalBounceIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
    }

    .modal-card-bounce::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #10b981, #0f766e);
        border-radius: 28px 28px 0 0;
    }

    /* ANIMASI CENTANG SVG SUKSES */
    .modal-success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 18px;
    }

    .checkmark-svg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #10b981;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #10b981;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 3;
        stroke-miterlimit: 10;
        stroke: #10b981;
        fill: #dcfce7;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke { 100% { stroke-dashoffset: 0; } }

    .modal-card-bounce h2 {
        font-size: 1.4rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 0 8px !important;
        letter-spacing: -0.3px !important;
    }

    .modal-subtitle {
        font-size: 0.88rem !important;
        color: #475569 !important;
        line-height: 1.55 !important;
        margin: 0 0 20px !important;
    }

    /* TRACKING CODE BOX */
    .tracking-code-box {
        background: #f0fdf4 !important;
        border: 2px dashed #86efac !important;
        border-radius: 18px !important;
        padding: 16px !important;
        margin-bottom: 22px !important;
    }

    .tracking-label {
        font-size: 0.72rem !important;
        font-weight: 800 !important;
        color: #166534 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        display: block !important;
        margin-bottom: 6px !important;
    }

    .tracking-code-display {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        flex-wrap: wrap !important;
    }

    .tracking-code-display strong {
        font-size: 1.4rem !important;
        font-weight: 900 !important;
        color: #0f766e !important;
        letter-spacing: 1px !important;
        font-family: monospace !important;
    }

    .btn-copy-code {
        background: #ffffff !important;
        color: #0f766e !important;
        border: 1px solid #a7f3d0 !important;
        padding: 6px 12px !important;
        border-radius: 10px !important;
        font-weight: 800 !important;
        font-size: 0.78rem !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    .btn-copy-code:hover {
        background: #0f766e !important;
        color: #ffffff !important;
    }

    .tracking-hint {
        display: block !important;
        margin-top: 6px !important;
        font-size: 0.75rem !important;
        color: #15803d !important;
    }

    /* BUTTONS GROUP */
    .modal-action-buttons {
        display: flex !important;
        flex-direction: column !important;
        gap: 10px !important;
    }

    .btn-modal-primary {
        background: #0f766e !important;
        color: #ffffff !important;
        border: 0 !important;
        padding: 12px 20px !important;
        border-radius: 14px !important;
        font-weight: 800 !important;
        font-size: 0.9rem !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        transition: all 0.2s ease !important;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3) !important;
    }

    .btn-modal-primary:hover {
        background: #115e56 !important;
        color: #ffffff !important;
    }

    .btn-modal-secondary {
        background: #f1f5f9 !important;
        color: #475569 !important;
        border: 0 !important;
        padding: 10px 20px !important;
        border-radius: 12px !important;
        font-weight: 700 !important;
        font-size: 0.84rem !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    @keyframes modalBounceIn {
        0% { opacity: 0; transform: scale(0.7); }
        80% { transform: scale(1.03); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>
@endpush

@section('content')

    {{-- HERO SECTION --}}
    <section class="page-hero">
        <div class="container">
            <span class="section-label">LAYANAN DESA</span>
            <h1>{{ $service->icon ?: '📄' }} {{ $service->title }}</h1>
            <p>{{ $service->description }}</p>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="section">
        <div class="container">
            <article class="content-card service-detail-card">
                <h2>Tentang Layanan</h2>
                <p>{{ $service->description }}</p>

                @if($service->is_letter)

                    {{-- PERSYARATAN DOKUMEN --}}
                    <div class="service-requirements">
                        <h3>📋 Dokumen yang perlu disiapkan</h3>
                        <ul>
                            @forelse($service->requirements ?? [] as $req)
                                <li>{{ $req }}</li>
                            @empty
                                <li>Persyaratan akan diinformasikan lebih lanjut oleh petugas desa.</li>
                            @endforelse
                        </ul>
                    </div>

                    <hr style="margin: 30px 0; border: none; border-top: 1px solid #e2e8f0;">

                    <h2>Formulir Pengajuan Surat</h2>

                    @if($errors->any())
                        <div class="public-error" style="background: #fef2f2; color: #991b1b; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
                            ⚠️ {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('layanan.pengajuan-surat') }}">
                        @csrf
                        <input type="hidden" name="service_id" value="{{ $service->id }}">

                        <div class="dynamic-form-grid">
                            <div class="admin-form-group">
                                <label>Nama Lengkap *</label>
                                <input name="nama" required value="{{ old('nama') }}" placeholder="Masukkan nama lengkap sesuai KTP">
                            </div>

                            <div class="admin-form-group">
                                <label>No. HP / WhatsApp *</label>
                                <input name="no_hp" required value="{{ old('no_hp') }}" placeholder="Contoh: 081234567890">
                            </div>

                            @foreach(($service->form_fields ?? []) as $field)
                                @php
                                    $fieldName = $field['name'] ?? '';
                                    $fieldType = $field['type'] ?? 'text';
                                    $isRequired = $field['required'] ?? false;
                                @endphp

                                @if($fieldName && !in_array($fieldName, ['nama', 'no_hp'], true) && $fieldType !== 'document')
                                    <div class="admin-form-group">
                                        <label>
                                            {{ $field['label'] ?? $fieldName }} @if($isRequired)*@endif
                                        </label>

                                        @if($fieldType === 'textarea')
                                            <textarea
                                                name="form[{{ $fieldName }}]"
                                                rows="4"
                                                @if($isRequired) required @endif
                                                placeholder="{{ $field['placeholder'] ?? '' }}"
                                            >{{ old('form.'.$fieldName) }}</textarea>
                                        @else
                                            <input
                                                type="{{ $fieldType }}"
                                                name="form[{{ $fieldName }}]"
                                                value="{{ old('form.'.$fieldName) }}"
                                                @if($isRequired) required @endif
                                                placeholder="{{ $field['placeholder'] ?? '' }}"
                                            >
                                        @endif
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        <div style="margin-top: 25px;">
                            <button class="btn btn-primary" type="submit" style="padding: 13px 28px; font-size: 1rem; border-radius: 14px; font-weight: 800;">
                                📩 Kirim Pengajuan Surat
                            </button>
                        </div>
                    </form>

                @else

                    <div class="profile-navigation-note" style="margin-top: 25px;">
                        <strong>Informasi Layanan Desa</strong>
                        <p>Layanan ini dikelola oleh Pemerintah Desa. Silakan hubungi kantor desa untuk informasi lebih lanjut.</p>
                    </div>

                @endif
            </article>
        </div>
    </section>

    {{-- MODAL POP-UP SUKSES PENGAJUAN (FIXED INSET TOP 0 - LANGSUNG DI TENGAH PANDANGAN) --}}
    @if(session('success') || session('tracking_code'))
        <div id="successModal" class="modal-overlay-fixed">
            <div class="modal-card-bounce">
                {{-- ANIMASI CENTANG --}}
                <div class="modal-success-icon">
                    <svg class="checkmark-svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>

                <h2>🎉 Pengajuan Berhasil Dikirim!</h2>
                <p class="modal-subtitle">Permohonan dokumen Anda telah terdaftar dan sedang dalam proses penanganan oleh Petugas Desa Waha.</p>

                @php
                    $code = session('tracking_code') ?? session('kode');
                @endphp

                @if($code)
                    <div class="tracking-code-box">
                        <span class="tracking-label">KODE PENGAJUAN RESMI ANDA</span>
                        <div class="tracking-code-display">
                            <strong id="trackingCodeText">{{ $code }}</strong>
                            <button type="button" class="btn-copy-code" onclick="copyTrackingCode()">
                                📋 Salin Kode
                            </button>
                        </div>
                        <small class="tracking-hint">💡 Simpan kode ini untuk melacak status dokumen Anda.</small>
                    </div>
                @endif

                <div class="modal-action-buttons">
                    @if($code)
                        <a href="{{ route('layanan.status', ['kode' => $code]) }}" class="btn-modal-primary">
                            🔎 Cek Status Pengajuan ↗
                        </a>
                    @endif

                    <button type="button" onclick="closeSuccessModal()" class="btn-modal-secondary">
                        Tutup & Kembali
                    </button>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
<script>
    // OTOMATIS LOCK SCROLL KE ATAS BEGTIU BERHASIL
    @if(session('success') || session('tracking_code'))
        document.addEventListener("DOMContentLoaded", function() {
            window.scrollTo({ top: 0, behavior: 'instant' });
            document.body.style.overflow = 'hidden';
        });
    @endif

    function copyTrackingCode() {
        var codeElement = document.getElementById('trackingCodeText');
        if (codeElement) {
            var codeText = codeElement.innerText;
            navigator.clipboard.writeText(codeText).then(function() {
                alert('✅ Kode Pengajuan (' + codeText + ') berhasil disalin!');
            }).catch(function() {
                alert('Kode Pengajuan: ' + codeText);
            });
        }
    }

    function closeSuccessModal() {
        var modal = document.getElementById('successModal');
        if (modal) {
            modal.style.opacity = '0';
            modal.style.transition = 'opacity 0.2s ease';
            setTimeout(function() {
                modal.style.display = 'none';
                document.body.style.overflow = 'auto';
            }, 200);
        }
    }
</script>
@endpush