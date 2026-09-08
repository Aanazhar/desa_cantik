@php
    // TARIK DATA DARI DATABASE DENGAN AMAN
    if (! $publication instanceof \App\Models\Publication) {
        $idTarget = is_array($publication) ? ($publication['id'] ?? request()->route('publication')) : $publication;
        $publication = \App\Models\Publication::where('id', $idTarget)->orWhere('slug', $idTarget)->first() ?? new \App\Models\Publication();
    }

    // KATEGORI & JUDUL DINAMIS SESUAI ISI DATABASE
    $pubCategory = $publication->category ?? 'Publikasi';
    
    $defaultTitle = match(strtolower($pubCategory)) {
        'infografis' => 'Infografis & Data Statistik Desa',
        'monografis' => 'Monografi & Profil Wilayah Desa',
        'berita'      => 'Kabar & Berita Desa',
        default      => 'Dokumen Publikasi Resmi Desa',
    };

    $pubTitle    = !empty($publication->title) ? $publication->title : $defaultTitle;
    $pubExcerpt  = $publication->excerpt ?? '';
    $pubContent  = $publication->content ?? '';
    $pubDateObj  = $publication->published_at ?? ($publication->created_at ?? null);

    // RESOLUSI GAMBAR COVER
    $pubImg = $publication->image ?? null;
    $imgUrl = null;
    if ($pubImg) {
        $cleanImg = ltrim($pubImg, '/');
        $imgUrl = (str_starts_with($cleanImg, 'storage/') || str_starts_with($cleanImg, 'uploads/'))
            ? asset($cleanImg)
            : asset('uploads/' . $cleanImg);
    }

    // RESOLUSI FILE DOKUMEN (PDF/EXCEL)
    $pubFile = $publication->file ?? ($publication->file_path ?? null);
    $fileUrl = null;
    if ($pubFile) {
        $cleanFile = ltrim($pubFile, '/');
        $fileUrl = (str_starts_with($cleanFile, 'storage/') || str_starts_with($cleanFile, 'uploads/'))
            ? asset($cleanFile)
            : asset('uploads/' . $cleanFile);
    }
    $fileExt = $fileUrl ? strtolower(pathinfo($fileUrl, PATHINFO_EXTENSION)) : '';
@endphp

@extends('layouts.app')

@section('title', $pubTitle . ' - Desa Waha')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span { 
        font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif !important; 
    }
    
    .pub-detail-container { 
        max-width: 860px; 
        margin: 30px auto 70px; 
        padding: 0 20px; 
    }

    /* TOMBOL KEMBALI */
    .pub-back { 
        display: inline-flex; 
        align-items: center; 
        gap: 8px; 
        margin-bottom: 20px; 
        text-decoration: none; 
        color: #0f766e; 
        font-weight: 700; 
        font-size: 14px; 
        background: #f0fdfa; 
        border: 1px solid #ccfbf1;
        padding: 9px 20px; 
        border-radius: 999px; 
        transition: all 0.2s ease;
    }
    .pub-back:hover { 
        background: #0f766e; 
        color: #ffffff; 
        border-color: #0f766e;
    }

    /* KARTU UTAMA DOKUMEN */
    .pub-detail-card { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 24px; 
        overflow: hidden; 
        box-shadow: 0 15px 35px rgba(15, 23, 42, 0.05); 
    }

    /* HEADER */
    .pub-detail-header { 
        padding: 36px 36px 20px; 
    }

    .pub-detail-meta { 
        display: flex; 
        align-items: center; 
        gap: 10px; 
        color: #64748b; 
        font-size: 13px; 
        font-weight: 700; 
        margin-bottom: 12px; 
    }

    .pub-detail-badge { 
        background: #0f766e; 
        color: #ffffff; 
        padding: 4px 12px; 
        border-radius: 999px; 
        text-transform: uppercase; 
        font-size: 11px; 
        font-weight: 800; 
        letter-spacing: 0.5px;
    }

    .pub-detail-header h1 { 
        font-size: clamp(1.6rem, 3.2vw, 2.2rem); 
        color: #0f172a; 
        font-weight: 800; 
        margin: 6px 0 16px; 
        line-height: 1.35; 
    }

    .pub-detail-excerpt { 
        font-size: 1rem; 
        color: #475569; 
        line-height: 1.7; 
        margin: 0; 
        background: #f8fafc;
        border-left: 4px solid #0f766e;
        padding: 14px 18px;
        border-radius: 0 12px 12px 0;
        font-weight: 500;
    }

    /* KOTAK GAMBAR SAMPUL COVER (PAS, TIDAK KEBESARAN, DAN RAPI) */
    .pub-cover-box {
        padding: 0 36px 20px;
        text-align: center;
    }

    .pub-cover-img { 
        max-width: 100%;
        max-height: 260px; 
        object-fit: contain; 
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        padding: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
    }

    /* TEKS KONTEN */
    .pub-content-text { 
        font-size: 1.02rem; 
        line-height: 1.85; 
        color: #334155; 
        padding: 0 36px 28px; 
        white-space: pre-line; 
    }

    /* KARTU DOWNLOAD DOKUMEN */
    .pub-download-card { 
        display: flex; 
        align-items: center; 
        justify-content: space-between; 
        gap: 16px; 
        background: #f0fdf4; 
        border: 1px solid #bbf7d0; 
        border-radius: 18px; 
        padding: 20px 24px; 
        margin: 0 36px 28px; 
        flex-wrap: wrap; 
    }

    .pub-download-info {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .pub-download-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #059669;
        color: #fff;
        display: grid;
        place-items: center;
        font-size: 22px;
        flex-shrink: 0;
    }

    .pub-download-title { 
        font-weight: 800; 
        color: #065f46; 
        font-size: 15px; 
        display: block; 
    }

    .pub-download-sub { 
        color: #047857; 
        font-size: 13px; 
    }

    .btn-download-now { 
        background: #0f766e; 
        color: #ffffff; 
        padding: 11px 22px; 
        border-radius: 12px; 
        font-weight: 800; 
        font-size: 13.5px; 
        text-decoration: none; 
        transition: all 0.2s ease; 
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }
    .btn-download-now:hover { 
        background: #115e59; 
        color: #ffffff; 
        transform: translateY(-1px); 
    }

    /* WEB DOCUMENT VIEWER */
    .pub-viewer-section { 
        padding: 0 36px 36px; 
    }

    .pub-viewer-title { 
        font-size: 16px; 
        font-weight: 800; 
        color: #0f172a; 
        margin-bottom: 14px; 
        display: flex; 
        align-items: center; 
        gap: 8px; 
    }

    .pub-iframe-wrapper { 
        width: 100%; 
        height: 600px; 
        border-radius: 16px; 
        overflow: hidden; 
        border: 1px solid #cbd5e1; 
        background: #f8fafc; 
    }

    .pub-iframe-wrapper iframe { 
        width: 100%; 
        height: 100%; 
        border: none; 
    }

    @media (max-width: 768px) {
        .pub-detail-header, .pub-cover-box, .pub-viewer-section, .pub-content-text { 
            padding-left: 20px; 
            padding-right: 20px; 
        }
        .pub-download-card { 
            margin: 0 20px 24px; 
            padding: 16px;
            flex-direction: column; 
            align-items: flex-start; 
        }
        .pub-iframe-wrapper { 
            height: 420px; 
        }
        .pub-cover-img {
            max-height: 200px;
        }
    }
</style>
@endpush

@section('content')

<div class="pub-detail-container">
    {{-- TOMBOL KEMBALI --}}
    <a class="pub-back" href="{{ url()->previous() !== url()->current() ? url()->previous() : route('publikasi') }}">
        ← Kembali ke Publikasi
    </a>

    <article class="pub-detail-card">
        {{-- HEADER DOKUMEN --}}
        <header class="pub-detail-header">
            <div class="pub-detail-meta">
                <span class="pub-detail-badge">{{ $pubCategory }}</span>
                <span>•</span>
                <span>{{ $pubDateObj ? (is_string($pubDateObj) ? date('d F Y', strtotime($pubDateObj)) : $pubDateObj->format('d F Y')) : date('d F Y') }}</span>
            </div>

            <h1>{{ $pubTitle }}</h1>

            @if($pubExcerpt)
                <p class="pub-detail-excerpt">{{ $pubExcerpt }}</p>
            @endif
        </header>

        {{-- GAMBAR SAMPUL (TAMPIL RAPI, CENTERED, TIDAK KEBESARAN) --}}
        @if($imgUrl)
            <div class="pub-cover-box">
                <img class="pub-cover-img" src="{{ $imgUrl }}" alt="{{ $pubTitle }}">
            </div>
        @endif

        {{-- ISI TEKS ARTIKEL --}}
        @if($pubContent)
            <div class="pub-content-text">
                {!! nl2br(e($pubContent)) !!}
            </div>
        @endif

        {{-- KARTU DOKUMEN PDF & WEB READER --}}
        @if($fileUrl)
            <div class="pub-download-card">
                <div class="pub-download-info">
                    <div class="pub-download-icon">
                        @if($fileExt === 'pdf') 📄 @elseif(in_array($fileExt, ['jpg','jpeg','png','webp'])) 📊 @else 📎 @endif
                    </div>
                    <div>
                        <strong class="pub-download-title">Dokumen Lampiran Resmi Tersedia</strong>
                        <span class="pub-download-sub">Dapat dibaca langsung di bawah ini atau diunduh ke perangkat Anda.</span>
                    </div>
                </div>

                <a href="{{ route('publikasi.download', $publication->id ?? 1) }}" class="btn-download-now">
                    📥 Download File {{ strtoupper($fileExt ?: 'DOKUMEN') }}
                </a>
            </div>

            <section class="pub-viewer-section">
                <h3 class="pub-viewer-title">
                    🔍 Pratinjau Dokumen Web
                </h3>

                @if($fileExt === 'pdf')
                    <div class="pub-iframe-wrapper">
                        <iframe src="{{ $fileUrl }}" title="Pratinjau Dokumen PDF"></iframe>
                    </div>
                @elseif(in_array($fileExt, ['jpg', 'jpeg', 'png', 'webp']))
                    <div style="text-align: center;">
                        <img src="{{ $fileUrl }}" alt="Pratinjau Infografis" style="max-width:100%; border-radius:16px; border:1px solid #cbd5e1;">
                    </div>
                @else
                    <div class="pub-iframe-wrapper">
                        <iframe src="https://docs.google.com/viewer?url={{ urlencode($fileUrl) }}&embedded=true" title="Pratinjau Dokumen"></iframe>
                    </div>
                @endif
            </section>
        @endif

    </article>
</div>

@endsection