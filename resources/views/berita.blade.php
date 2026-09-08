@extends('layouts.app')

@section('title', 'Berita & Kabar Desa - ' . ($activeDesa->name ?? 'Desa Waha'))

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

    /* HERO BANNER BERITA */
    .pub-hero {
        padding: 50px 0;
        background: linear-gradient(135deg, #0f766e, #155e75);
        color: #fff;
    }

    .pub-hero-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 30px;
    }

    .pub-hero h1 {
        font-size: clamp(2rem, 4.5vw, 3.5rem);
        margin: 6px 0 10px;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .pub-hero p {
        max-width: 780px;
        margin: 0;
        opacity: .9;
        font-size: 1rem;
        line-height: 1.6;
    }

    .pub-hero-icon {
        font-size: 70px;
    }

    /* KARTU BERITA */
    .pub-feature {
        display: grid;
        grid-template-columns: 1.25fr .75fr;
        gap: 20px;
        margin-bottom: 24px;
    }

    .pub-feature-side {
        display: grid;
        gap: 20px;
    }

    .pub-card {
        background: #fff;
        border: 1px solid #e3eeee;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 12px 35px rgba(22, 78, 99, 0.07);
        transition: .25s ease;
        display: flex;
        flex-direction: column;
    }

    .pub-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 16px 40px rgba(22, 78, 99, 0.12);
    }

    .pub-card img {
        width: 100%;
        height: 230px;
        object-fit: cover;
    }

    .pub-placeholder {
        height: 230px;
        display: grid;
        place-items: center;
        background: linear-gradient(135deg, #dff5f1, #e7f1f5);
        font-size: 65px;
        text-decoration: none;
    }

    .pub-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .pub-meta {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        color: #758585;
        font-size: .83rem;
        margin-bottom: 6px;
    }

    .pub-meta strong {
        color: #0f766e;
        font-weight: 800;
    }

    .pub-card h2 {
        margin: 8px 0;
        font-size: 1.2rem;
        line-height: 1.4;
        font-weight: 800;
    }

    .pub-card h2 a {
        text-decoration: none;
        color: #163c3c;
        transition: .2s ease;
    }

    .pub-card h2 a:hover {
        color: #0f766e;
    }

    .pub-card p {
        color: #64748b;
        line-height: 1.65;
        font-size: 0.9rem;
        margin-bottom: 14px;
    }

    .pub-read {
        color: #0f766e;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.9rem;
        margin-top: auto;
    }

    .pub-badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 999px;
        background: #e9f4f3;
        color: #0f766e;
        font-size: .75rem;
        font-weight: 800;
        margin-bottom: 8px;
    }

    /* GRID LIST SISA BERITA */
    .pub-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .pub-grid .pub-card img,
    .pub-grid .pub-placeholder {
        height: 190px;
    }

    /* EMPTY STATE */
    .pub-empty {
        text-align: center;
        padding: 60px 20px;
        border: 1px dashed #cbdada;
        border-radius: 22px;
        background: #fff;
    }

    @media (max-width: 900px) {
        .pub-hero { padding: 30px 0; }
        .pub-hero-inner { flex-direction: column; align-items: flex-start; gap: 10px; }
        .pub-feature { grid-template-columns: 1fr; gap: 16px; }
        .pub-grid { grid-template-columns: repeat(2, 1fr); gap: 16px; }
    }

    @media (max-width: 600px) {
        .pub-grid { grid-template-columns: 1fr; gap: 14px; }
    }
</style>
@endpush

@section('content')

    {{-- HERO SECTION BERITA --}}
    <section class="pub-hero">
        <div class="container pub-hero-inner">
            <div>
                <span class="section-label" style="color: #fff; font-weight: 800;">KABAR DESA TERKINI</span>
                <h1>Berita Desa</h1>
                <p>Kumpulan berita resmi, liputan kegiatan masyarakat, dan kabar terbaru seputar {{ $activeDesa->name ?? 'Desa Waha' }}.</p>
            </div>

            <div class="pub-hero-icon">
                📰
            </div>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="section">
        <div class="container">

            @if(isset($publikasi) && $publikasi->count())

                @php
                    $featured = $publikasi->first();
                @endphp

                {{-- FEATURED SECTION (BERITA UTAMA) --}}
                <div class="pub-feature">

                    <article class="pub-card">
                        @php
                            $targetParam = $featured->slug ?: $featured->id;
                        @endphp

                        @if($featured->image)
                            <a href="{{ route('publikasi.show', $targetParam) }}">
                                <img src="{{ asset(ltrim($featured->image, '/')) }}" alt="{{ $featured->title }}">
                            </a>
                        @else
                            <a class="pub-placeholder" href="{{ route('publikasi.show', $targetParam) }}">
                                📰
                            </a>
                        @endif

                        <div class="pub-card-body">
                            <div class="pub-meta">
                                <strong>{{ $featured->category ?: 'Berita Utama' }}</strong>
                                <span>{{ $featured->published_at?->format('d M Y') ?: $featured->created_at->format('d M Y') }}</span>
                            </div>

                            <h2>
                                <a href="{{ route('publikasi.show', $targetParam) }}">
                                    {{ $featured->title }}
                                </a>
                            </h2>

                            <p>
                                {{ \Illuminate\Support\Str::limit($featured->excerpt ?: strip_tags($featured->content), 220) }}
                            </p>

                            <a class="pub-read" href="{{ route('publikasi.show', $targetParam) }}">
                                Baca selengkapnya →
                            </a>
                        </div>
                    </article>

                    {{-- KARTU BERITA SAMPING --}}
                    <div class="pub-feature-side">
                        @foreach($publikasi->slice(1, 2) as $publication)
                            @php
                                $sideParam = $publication->slug ?: $publication->id;
                            @endphp
                            <article class="pub-card">
                                <div class="pub-card-body">
                                    <span class="pub-badge">
                                        {{ $publication->category ?: 'Berita' }}
                                    </span>

                                    <h2>
                                        <a href="{{ route('publikasi.show', $sideParam) }}">
                                            {{ $publication->title }}
                                        </a>
                                    </h2>

                                    <div class="pub-meta">
                                        <span>{{ $publication->published_at?->format('d M Y') ?: $publication->created_at->format('d M Y') }}</span>
                                    </div>

                                    <p>
                                        {{ \Illuminate\Support\Str::limit($publication->excerpt ?: strip_tags($publication->content), 110) }}
                                    </p>

                                    <a class="pub-read" href="{{ route('publikasi.show', $sideParam) }}">
                                        Baca →
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                </div>

                {{-- GRID LIST SISA BERITA --}}
                <div class="pub-grid">
                    @foreach($publikasi->slice(3) as $publication)
                        @php
                            $gridParam = $publication->slug ?: $publication->id;
                        @endphp
                        <article class="pub-card">
                            @if($publication->image)
                                <a href="{{ route('publikasi.show', $gridParam) }}">
                                    <img src="{{ asset(ltrim($publication->image, '/')) }}" alt="{{ $publication->title }}">
                                </a>
                            @else
                                <a class="pub-placeholder" href="{{ route('publikasi.show', $gridParam) }}">
                                    📰
                                </a>
                            @endif

                            <div class="pub-card-body">
                                <div class="pub-meta">
                                    <strong>{{ $publication->category ?: 'Berita' }}</strong>
                                    <span>{{ $publication->published_at?->format('d M Y') ?: $publication->created_at->format('d M Y') }}</span>
                                </div>

                                <h2>
                                    <a href="{{ route('publikasi.show', $gridParam) }}">
                                        {{ $publication->title }}
                                    </a>
                                </h2>

                                <p>
                                    {{ \Illuminate\Support\Str::limit($publication->excerpt ?: strip_tags($publication->content), 150) }}
                                </p>

                                <a class="pub-read" href="{{ route('publikasi.show', $gridParam) }}">
                                    Baca selengkapnya →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                @if(method_exists($publikasi, 'links'))
                    <div class="publication-pagination public-pagination" style="margin-top: 28px;">
                        {{ $publikasi->links() }}
                    </div>
                @endif

            @else

                <div class="pub-empty">
                    <div style="font-size: 56px;">📰</div>
                    <h2>Belum Ada Berita Terbaru</h2>
                    <p>Berita dan kabar terkini desa yang diterbitkan admin akan otomatis tampil di sini.</p>
                </div>

            @endif

        </div>
    </section>

@endsection