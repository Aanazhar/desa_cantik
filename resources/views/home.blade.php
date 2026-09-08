@extends('layouts.app')

@section('title', 'Beranda - ' . ($activeDesa->name ?? 'Desa Waha'))

@section('content')

{{-- =========================================================
    HERO SECTION PREMIUM
========================================================= --}}
@php
    $heroBgImage = !empty($contents['hero_bg']) 
        ? asset($contents['hero_bg']) 
        : asset('images/bg_desa.png');
@endphp

<section class="home-hero" 
    style="background: linear-gradient(135deg, rgba(15, 118, 109, 0.9), rgba(138, 144, 158, 0.2)), url('{{ $heroBgImage }}') center/cover no-repeat;">
    
    <div class="container home-hero-inner">

        <div class="home-hero-content">

            </!-- <span class="hero-badge float-badge"> 
                <!-- ✨ Website Resmi Pemerintah {{ $activeDesa->name ?? 'Desa Waha' }} -->
            </span>

            <h1>
                {{ $contents['hero_title'] ?? 'Selamat Datang di ' . ($activeDesa->name ?? 'Desa Waha') }}
            </h1>

            <p>
                {{ $contents['hero_description'] ?? 'Portal resmi desa untuk memperoleh informasi, data desa, pelayanan administrasi, berita, dan komunikasi masyarakat.' }}
            </p>

            <div class="hero-highlights">
                <!-- <span>⚡ Informasi Cepat</span>
                <span>🛡 Transparan</span>
                <span>🤝 Melayani Masyarakat</span> -->
            </div>

            <div class="hero-buttons">
                <a href="{{ route('layanan') }}" class="btn btn-primary hero-btn-main">
                    📄 Layanan Online <span> </span>
                </a>
                <a href="{{ route('data-desa') }}" class="btn btn-outline hero-btn-sub">
                    📊 Data Desa
                </a>
            </div>
            <p></p>
            <br></br>

        </div>

    </div>
</section>


{{-- =========================================================
    STATISTIK DESA
========================================================= --}}
<section class="home-statistics">

    <div class="container">

        <div class="home-section-header">

            <div class="home-section-title">
                <span class="section-label">DATA TERKINI</span>
                <h2>Gambaran Desa</h2>
            </div>

            <a href="{{ route('data-desa') }}" class="home-section-link">
                Lihat Data Selengkapnya
                <span>→</span>
            </a>

        </div>

        <div class="statistics-grid">

            {{-- WILAYAH --}}
            <div class="stat-card bounce-card">
                <div class="stat-icon stat-icon-location">📍</div>
                <div class="stat-content">
                    <strong>{{ number_format((int)($villages?->count() ?? 0), 0, ',', '.') }}</strong>
                    <span>Luas Wilayah</span>
                </div>
            </div>

            {{-- PENDUDUK --}}
            <div class="stat-card bounce-card">
                <div class="stat-icon stat-icon-population">👥</div>
                <div class="stat-content">
                    <strong>{{ number_format((int)($statistics?->total_penduduk ?? 0), 0, ',', '.') }}</strong>
                    <span>Jumlah Penduduk</span>
                </div>
            </div>

            {{-- KELUARGA --}}
            <div class="stat-card bounce-card">
                <div class="stat-icon stat-icon-family">🏠</div>
                <div class="stat-content">
                    <strong>{{ number_format((int)($statistics?->kepala_keluarga ?? 0), 0, ',', '.') }}</strong>
                    <span>Jumlah Keluarga</span>
                </div>
            </div>

            {{-- LAKI-LAKI --}}
            <div class="stat-card bounce-card">
                <div class="stat-icon stat-icon-male">👨</div>
                <div class="stat-content">
                    <strong>{{ number_format((int)($statistics?->laki_laki ?? 0), 0, ',', '.') }}</strong>
                    <span>Penduduk Laki-laki</span>
                </div>
            </div>

            {{-- PEREMPUAN --}}
            <div class="stat-card bounce-card">
                <div class="stat-icon stat-icon-female">👩</div>
                <div class="stat-content">
                    <strong>{{ number_format((int)($statistics?->perempuan ?? 0), 0, ',', '.') }}</strong>
                    <span>Penduduk Perempuan</span>
                </div>
            </div>

        </div>

    </div>

</section>


{{-- =========================================================
    ✨ TENTANG DESA
========================================================= --}}
<section class="section home-about">

    <div class="container">

        <div class="about-grid">

            <div class="about-visual">

                <div class="about-card float-card">

                    <div class="about-card-header">
                        <span>PEMERINTAH DESA</span>
                        <span>OFFICIAL PORTAL</span>
                    </div>

                    <div class="about-card-body">

                        <div class="about-emblem-glow">🏛️</div>

                        <h3>
                            {{ strtoupper($activeDesa->name ?? 'DESA WAHA') }}
                        </h3>

                        <p class="about-tagline">
                            Maju • Transparan • Melayani
                        </p>

                    </div>

                    <div class="about-card-footer">
                        Website Resmi Pemerintah Desa
                    </div>

                </div>

            </div>


            <div class="about-content">

                <span class="section-label">TENTANG DESA</span>

                <h2>
                    {{ $contents['about_title'] ?? 'Desa yang terbuka, informatif, dan melayani masyarakat' }}
                </h2>

                <p class="about-main-desc">
                    {{ $contents['about_description'] ?? 'Gunakan website ini untuk memperoleh informasi resmi desa, melihat statistik, mengajukan layanan, membaca berita, dan menemukan kontak Pemerintah Desa.' }}
                </p>

                <div class="about-features-list">

                    <div class="about-feature-item bounce-card">
                        <div class="feature-check-icon">✓</div>
                        <div>
                            <strong>Informasi Resmi</strong>
                            <p>Informasi desa tersedia secara terbuka dan transparan.</p>
                        </div>
                    </div>

                    <div class="about-feature-item bounce-card">
                        <div class="feature-check-icon">✓</div>
                        <div>
                            <strong>Data Transparan</strong>
                            <p>Statistik dan data publik desa dapat dilihat masyarakat.</p>
                        </div>
                    </div>

                    <div class="about-feature-item bounce-card">
                        <div class="feature-check-icon">✓</div>
                        <div>
                            <strong>Pelayanan Online</strong>
                            <p>Pengajuan surat dan administrasi dapat dilakukan secara online.</p>
                        </div>
                    </div>

                </div>

                <a href="{{ route('profil') }}" class="btn-about-link">
                    <span>Lihat Profil Desa</span>
                    <span class="arrow-icon"></span>
                </a>

            </div>

        </div>

    </div>

</section>

{{-- =========================================================
    LAYANAN DESA
========================================================= --}}
<section class="section home-services">

    <div class="container">

        <div class="home-section-header">

            <div class="home-section-title">
                <span class="section-label">PELAYANAN MASYARAKAT</span>
                <h2>Layanan Desa</h2>
                <p>Akses berbagai informasi dan pelayanan administrasi desa dengan mudah, cepat, dan transparan.</p>
            </div>

            <a href="{{ route('layanan') }}" class="home-section-link">
                Lihat Semua Layanan
                <span>→</span>
            </a>

        </div>

        <div class="service-home-grid">

            @forelse($services as $index => $service)

                <article class="home-service-card bounce-card">

                    <div class="home-service-top">
                        <div class="home-service-icon">
                            {{ $service->icon ?: '📄' }}
                        </div>
                        <span class="home-service-number">
                            LAYANAN {{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                    </div>

                    <div class="home-service-body">
                        <h3>{{ $service->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($service->description), 120) }}</p>
                    </div>

                    <div class="home-service-footer">
                        <a href="{{ route('layanan.show', $service->id) }}" class="home-service-button">
                            <span>Lihat Detail</span>
                            <span class="button-arrow">→</span>
                        </a>
                    </div>

                </article>

            @empty

                <div class="home-empty-state">
                    <div class="home-empty-icon">📄</div>
                    <h3>Belum Ada Layanan</h3>
                    <p>Belum ada layanan yang dipublikasikan oleh Pemerintah Desa.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>


{{-- =========================================================
    BERITA & PUBLIKASI
========================================================= --}}
<section class="section home-news">

    <div class="container">

        <div class="home-section-header">

            <div class="home-section-title">
                <span class="section-label">INFORMASI TERBARU</span>
                <h2>Berita & Publikasi Desa</h2>
                <p>Ikuti informasi, kegiatan, pengumuman, dan berbagai informasi terbaru dari Pemerintah Desa.</p>
            </div>

            <a href="{{ route('berita') }}" class="home-section-link">
                Semua Berita
                <span>→</span>
            </a>

        </div>

        <div class="news-home-grid">

            @forelse($latestPublications ?? [] as $publication)

                @php
                    $rawImg = $publication->image 
                        ?? $publication->gambar 
                        ?? $publication->thumbnail 
                        ?? $publication->cover 
                        ?? $publication->foto 
                        ?? $publication->file_path 
                        ?? null;

                    $newsImg = null;
                    if (!empty($rawImg)) {
                        $cleanPath = ltrim(trim($rawImg), '/');
                        if (str_starts_with($cleanPath, 'http://') || str_starts_with($cleanPath, 'https://')) {
                            $newsImg = $cleanPath;
                        } elseif (str_starts_with($cleanPath, 'storage/') || str_starts_with($cleanPath, 'uploads/') || str_starts_with($cleanPath, 'images/')) {
                            $newsImg = asset($cleanPath);
                        } else {
                            $newsImg = asset('uploads/' . $cleanPath);
                        }
                    }
                @endphp

                <article class="home-news-card bounce-card">

                    <div class="home-news-image">
                        @if($newsImg)
                            <img src="{{ $newsImg }}" 
                                 alt="{{ $publication->title }}" 
                                 loading="lazy" 
                                 class="news-cover-img" 
                                 onerror="
                                    if (!this.dataset.retry && this.src.includes('/uploads/')) {
                                        this.dataset.retry = '1';
                                        this.src = this.src.replace('/uploads/', '/storage/uploads/');
                                    } else if (this.dataset.retry === '1' && this.src.includes('/storage/uploads/')) {
                                        this.dataset.retry = '2';
                                        this.src = this.src.replace('/storage/uploads/', '/storage/');
                                    } else {
                                        this.style.display = 'none';
                                    }
                                 ">
                        @endif

                        <div class="home-news-placeholder-box">
                            <span style="font-size: 2.2rem; margin-bottom: 4px;">📰</span>
                            <span style="font-size: 0.75rem; font-weight: 800; text-transform: uppercase;">{{ $publication->category ?: 'Berita' }}</span>
                        </div>

                        <div class="home-news-category">
                            {{ $publication->category ?: 'Informasi' }}
                        </div>
                    </div>

                    <div class="home-news-body">
                        <div class="home-news-date">
                            <span class="date-icon">📅</span>
                            {{ $publication->created_at ? $publication->created_at->format('d M Y') : 'Informasi Desa' }}
                        </div>

                        <h3>{{ \Illuminate\Support\Str::limit($publication->title, 70) }}</h3>
                        <p>{{ $publication->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($publication->content), 130) }}</p>

                        <a href="{{ route('publikasi.show', $publication->id) }}" class="home-news-link">
                            Baca Selengkapnya
                            <span>→</span>
                        </a>
                    </div>

                </article>

            @empty

                <div class="home-empty-state">
                    <div class="home-empty-icon">📰</div>
                    <h3>Belum Ada Berita</h3>
                    <p>Belum ada berita atau publikasi yang diterbitkan oleh Pemerintah Desa.</p>
                </div>

            @endforelse

        </div>

    </div>

</section>

{{-- =========================================================
    ✨ MENGENAL DTSEN (SUPER MEWAH FANCY BOUNCE CARDS)
========================================================= --}}
<section class="section home-dtsen-custom">
    <div class="container">
        
        <div class="home-section-header">
            <div class="home-section-title">
                <span class="section-label">DESA CINTA STATISTIK</span>
                <h2>Edukasi Data Terpadu (DTSEN)</h2>
                <p>Panduan lengkap Data Terpadu Sosial Ekonomi Nasional dari BPS untuk masyarakat {{ $activeDesa->name ?? 'Desa Waha' }}.</p>
            </div>
        </div>

        {{-- 1. APA ITU DTSEN --}}
        <div class="dtsen-split-grid">
            <div class="dtsen-hero-card float-card">
                <div class="dtsen-badge-tag">📊 BPS x DESA CANTIK</div>
                <h3>Apa itu DTSEN?</h3>
                <p>
                    <strong>DTSEN (Data Terpadu Sosial Ekonomi Nasional)</strong> adalah sistem basis data tunggal yang dikelola oleh Badan Pusat Statistik (BPS) untuk mengintegrasikan seluruh data kondisi sosial dan ekonomi masyarakat secara terpadu.
                </p>

                <div class="dtsen-key-stats">
                    <div>
                        <strong>100%</strong>
                        <span>Terintegrasi BPS</span>
                    </div>
                    <div>
                        <strong>Tepat</strong>
                        <span>Sasaran Bansos</span>
                    </div>
                </div>
            </div>

            <div class="dtsen-info-stack">
                <div class="dtsen-info-card bounce-card">
                    <div class="dtsen-icon-box">🎯</div>
                    <div>
                        <h4>Tujuan Utama DTSEN</h4>
                        <p>Menjadi basis data tunggal perlindungan sosial serta memastikan seluruh bantuan pemerintah disalurkan secara adil dan tepat sasaran.</p>
                    </div>
                </div>

                <div class="dtsen-info-card bounce-card">
                    <div class="dtsen-icon-box">💡</div>
                    <div>
                        <h4>Manfaat Bagi Warga Desa</h4>
                        <p>Memudahkan verifikasi data bansos, mempercepat pengusulan bantuan baru, dan menjamin transparansi pembangunan desa.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- 2. CARA CEK DATA --}}
        <div style="margin-top: 55px;">
            <h3 class="dtsen-sub-heading">🔍 3 Cara Cek Status Data DTSEN Anda</h3>

            <div class="dtsen-check-grid">
                <div class="dtsen-card-fancy bounce-card">
                    <div class="fancy-header header-emerald">
                        <span class="fancy-num">01</span>
                        <span class="fancy-tag">Portal Web</span>
                    </div>
                    <div class="fancy-body">
                        <h4>Portal Cek Bansos Kemensos</h4>
                        <p>Cek status kepesertaan permohonan melalui situs resmi Kementerian Sosial RI.</p>
                        <a href="https://cekbansos.kemensos.go.id" target="_blank" class="btn-fancy btn-emerald">
                            Buka Situs ↗
                        </a>
                    </div>
                </div>

                <div class="dtsen-card-fancy bounce-card">
                    <div class="fancy-header header-cyan">
                        <span class="fancy-num">02</span>
                        <span class="fancy-tag">Aplikasi Mobile</span>
                    </div>
                    <div class="fancy-body">
                        <h4>Aplikasi Cek Bansos HP</h4>
                        <p>Unduh aplikasi resmi Kemensos di Play Store untuk cek data via Smartphone.</p>
                        <a href="https://play.google.com/store/apps/details?id=id.go.kemensos.cekbansos" target="_blank" class="btn-fancy btn-cyan">
                            Unduh App ↗
                        </a>
                    </div>
                </div>

                <div class="dtsen-card-fancy bounce-card">
                    <div class="fancy-header header-indigo">
                        <span class="fancy-num">03</span>
                        <span class="fancy-tag">Portal BPS</span>
                    </div>
                    <div class="fancy-body">
                        <h4>Formulir DTSEN BPS</h4>
                        <p>Verifikasi & validasi data sosial ekonomi masyarakat melalui portal BPS RI.</p>
                        <a href="https://dtsen-form.web.bps.go.id" target="_blank" class="btn-fancy btn-indigo">
                            Form BPS ↗
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- 3. ALUR PERBAIKAN DATA (DENGAN JUDUL & DESKRIPSI SESUAI REFERENSI) --}}
        <div style="margin-top: 55px;">
            <h3 class="dtsen-sub-heading">✏️ Prosedur Pengusulan & Perbaikan Data</h3>

            <div class="dtsen-proc-grid">
                <div class="dtsen-proc-card border-waha-teal bounce-card">
                    <div class="proc-icon icon-waha-teal">🏛️</div>
                    <div>
                        <h4 style="color: #0f766e;">1. Lapor di Kantor Desa Waha</h4>
                        <p>Laporkan dengan membawa KTP, Kartu Keluarga (KK), dan surat keterangan pendukung ke petugas desa.</p>
                    </div>
                </div>

                <div class="dtsen-proc-card border-waha-cyan bounce-card">
                    <div class="proc-icon icon-waha-cyan">📱</div>
                    <div>
                        <h4 style="color: #0891b2;">2. Aplikasi Cek Bansos</h4>
                        <p>Gunakan fitur <strong>"Usul/Sanggah"</strong> pada aplikasi Cek Bansos, upload dokumen pendukung.</p>
                    </div>
                </div>

                <div class="dtsen-proc-card border-waha-emerald bounce-card">
                    <div class="proc-icon icon-waha-emerald">🌐</div>
                    <div>
                        <h4 style="color: #10b981;">3. DTSEN Form BPS</h4>
                        <p>Buka <a href="https://dtsen-form.web.bps.go.id" target="_blank" style="color: #10b981; font-weight: 700;">dtsen-form.web.bps.go.id ↗</a>, siapkan KTP dan KK untuk pembaharuan mandiri.</p>
                    </div>
                </div>

                <div class="dtsen-proc-card border-waha-navy bounce-card">
                    <div class="proc-icon icon-waha-navy">🏢</div>
                    <div>
                        <h4 style="color: #1e293b;">4. Dinas Sosial Kab. Wakatobi</h4>
                        <p>Siapkan KTP, KK, dan Surat Keterangan Pendukung (Foto) untuk konsultasi di Dinas Sosial Wakatobi.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

{{-- =========================================================
    LOKASI DESA
========================================================= --}}
@php
    $latitude = $activeDesa->latitude ?? null;
    $longitude = $activeDesa->longitude ?? null;
    $desaName = $activeDesa->name ?? 'Desa Waha';
    $desaAddress = $activeDesa->address ?? $activeDesa->alamat ?? $activeDesa->location ?? '';
    $mapQuery = trim($desaName . ' ' . $desaAddress);
    $googleMapsUrl = 'https://www.google.com/maps/search/?api=1&query=' . urlencode($mapQuery);
@endphp

<section class="section home-location">

    <div class="container">

        <div class="location-header">
            <span class="section-label">LOKASI DESA</span>
            <h2>Temukan Lokasi {{ $desaName }}</h2>
            <p>Lihat lokasi kantor Pemerintah Desa dan dapatkan petunjuk arah menuju desa.</p>
        </div>

        <div class="location-card bounce-card">

            <div class="location-information">

                <div class="location-icon">📍</div>
                <span class="section-label">ALAMAT</span>
                <h3>{{ $desaName }}</h3>

                <p>{{ $desaAddress ?: 'Lokasi dan alamat desa dapat dilihat melalui peta.' }}</p>

                <div class="location-status">
                    <span class="location-status-dot"></span>
                    <span>Lokasi Pemerintah Desa</span>
                </div>

                <a href="{{ $googleMapsUrl }}" target="_blank" rel="noopener noreferrer" class="btn btn-primary btn-direction">
                    🧭 Petunjuk Arah
                </a>

            </div>

            <div class="location-map">
                @if($latitude && $longitude)
                    <div id="desa-map" data-lat="{{ $latitude }}" data-lng="{{ $longitude }}"></div>
                @else
                    <iframe
                        src="https://www.google.com/maps?q={{ urlencode($mapQuery) }}&output=embed"
                        width="100%"
                        height="100%"
                        style="border:0;"
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi {{ $desaName }}"
                    ></iframe>
                @endif
            </div>

        </div>

    </div>

</section>

{{-- =========================================================
    CTA
========================================================= --}}
<section class="home-cta">

    <div class="container">

        <div class="cta-card bounce-card">

            <div>
                <span class="section-label">PEMERINTAH DESA</span>
                <h2>Butuh informasi atau pelayanan desa?</h2>
                <p>Gunakan layanan online atau hubungi Pemerintah Desa untuk mendapatkan informasi lebih lanjut.</p>
            </div>

            <div class="cta-buttons">
                <a href="{{ route('layanan') }}" class="btn btn-primary">📄 Layanan Desa</a>
                <a href="{{ route('kontak') }}" class="btn btn-outline">📞 Hubungi Kami</a>
            </div>

        </div>

    </div>

</section>

@endsection


{{-- =========================================================
    CSS STYLING
========================================================= --}}
@push('styles')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    @keyframes subtleFloat {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-7px); }
    }

    .float-badge, .float-card {
        animation: subtleFloat 5s ease-in-out infinite;
    }

    .bounce-card {
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease, border-color 0.3s ease !important;
    }

    .bounce-card:hover {
        transform: translateY(-8px) scale(1.02) !important;
        box-shadow: 0 20px 45px rgba(15, 118, 110, 0.14) !important;
        border-color: #0f766e !important;
    }

    .home-about { padding: 90px 0; background: #ffffff; }
    .about-grid { display: grid; grid-template-columns: 0.9fr 1.1fr; gap: 60px; align-items: center; }

    .about-card {
        width: 100%;
        border-radius: 28px;
        background: linear-gradient(145deg, #0f766e 0%, #0f172a 100%);
        box-shadow: 0 20px 50px rgba(15, 118, 110, 0.2);
        overflow: hidden;
    }

    .about-card-header, .about-card-footer {
        padding: 18px 24px;
        color: rgba(255,255,255,0.75);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1px;
        display: flex;
        justify-content: space-between;
        background: rgba(0, 0, 0, 0.15);
    }

    .about-card-body {
        min-height: 280px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 30px;
        text-align: center;
        color: #ffffff;
    }

    .about-emblem-glow {
        width: 90px;
        height: 90px;
        display: grid;
        place-items: center;
        margin-bottom: 20px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        font-size: 44px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .about-card-body h3 { font-size: 1.8rem; font-weight: 900; margin: 0 0 8px; color: #ffffff; letter-spacing: -0.5px; }
    .about-tagline { color: #99f6e4; font-size: 0.95rem; font-weight: 700; margin: 0; }

    .about-main-desc { color: #475569 !important; font-size: 1.02rem !important; line-height: 1.7 !important; margin: 14px 0 28px !important; }

    .about-features-list { display: flex; flex-direction: column; gap: 16px; margin-bottom: 32px; }

    .about-feature-item {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 18px 22px;
        border-radius: 18px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
    }

    .feature-check-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: #ccfbf1;
        color: #0f766e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .about-feature-item strong { display: block; color: #0f172a; font-weight: 800; font-size: 1.02rem; margin-bottom: 3px; }
    .about-feature-item p { margin: 0; color: #64748b; font-size: 0.88rem; line-height: 1.45; }

    .btn-about-link {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 13px 26px;
        border-radius: 14px;
        background: #0f766e;
        color: #ffffff;
        text-decoration: none;
        font-weight: 800;
        font-size: 0.92rem;
        box-shadow: 0 6px 20px rgba(15, 118, 110, 0.25);
        transition: all 0.25s ease;
    }

    .btn-about-link:hover {
        background: #0b5f59;
        transform: translateY(-2px);
        color: #ffffff;
    }

    .home-hero { position: relative; overflow: hidden; padding: 75px 0 90px; color: #ffffff; }
    .home-hero-inner { display: grid; grid-template-columns: 1fr; gap: 40px; align-items: center; }
    .home-hero-content { max-width: 760px; }

    .hero-badge { display: inline-flex; align-items: center; gap: 8px; padding: 7px 16px; border-radius: 999px; background: rgba(255, 255, 255, 0.18); backdrop-filter: blur(8px); border: 1px solid rgba(255, 255, 255, 0.25); color: #ffffff; font-size: 0.85rem; font-weight: 800; margin-bottom: 20px; }
    .home-hero h1 { margin: 0 0 18px; font-size: clamp(2.2rem, 4.2vw, 3.6rem); line-height: 1.15; letter-spacing: -1px; font-weight: 800; color: #ffffff; }
    .home-hero-content > p { margin: 0 0 24px; color: #e0f2fe; font-size: 1.05rem; line-height: 1.7; }
    .hero-highlights { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 28px; }
    .hero-highlights span { padding: 6px 14px; border-radius: 20px; background: rgba(255, 255, 255, 0.12); backdrop-filter: blur(6px); border: 1px solid rgba(255, 255, 255, 0.2); color: #ffffff; font-size: 0.82rem; font-weight: 700; }
    .hero-buttons { display: flex; flex-wrap: wrap; gap: 14px; }
    .hero-btn-main { background: #ffffff !important; color: #0f766e !important; padding: 13px 26px !important; border-radius: 14px !important; font-weight: 800 !important; font-size: 0.95rem !important; text-decoration: none; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15); transition: all 0.25s ease; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }
    .hero-btn-main:hover { background: #f0fdf4 !important; transform: translateY(-3px) scale(1.03); }
    .hero-btn-sub { background: rgba(255, 255, 255, 0.15) !important; color: #ffffff !important; border: 1px solid rgba(255, 255, 255, 0.3) !important; padding: 13px 24px !important; border-radius: 14px !important; font-weight: 800 !important; font-size: 0.95rem !important; text-decoration: none; backdrop-filter: blur(6px); transition: all 0.25s ease; display: inline-flex; align-items: center; justify-content: center; gap: 8px; }

    .home-statistics { position: relative; margin-top: 0 !important; padding: 50px 0 25px; background: #ffffff; z-index: 5; }
    .statistics-grid { display: grid; grid-template-columns: repeat(5, 1fr); gap: 16px; }
    .stat-card { min-width: 0; display: flex; align-items: center; gap: 14px; padding: 20px; border: 1px solid #e2e8f0; border-radius: 18px; background: #ffffff; box-shadow: 0 6px 25px rgba(15, 23, 42, 0.05); }
    .stat-icon { width: 48px; height: 48px; flex: 0 0 48px; display: grid; place-items: center; border-radius: 14px; background: #eff6ff; font-size: 24px; }
    .stat-content strong { display: block; color: #0f172a; font-size: 22px; line-height: 1.2; font-weight: 800; }
    .stat-content span { display: block; margin-top: 4px; color: #64748b; font-size: 12px; font-weight: 700; }

    .home-services, .home-news { position: relative; overflow: hidden; }
    .home-services { background: #ffffff; }
    .home-news { background: #f8fafc; }
    .home-section-header { display: flex; align-items: flex-end; justify-content: space-between; gap: 40px; margin-bottom: 36px; }
    .home-section-title .section-label { display: inline-block; margin-bottom: 10px; color: #0f766e; font-weight: 800; letter-spacing: 1px; }
    .home-section-title h2 { margin: 0 0 10px; font-size: 36px; line-height: 1.15; font-weight: 800; color: #0f172a; }

    .service-home-grid, .news-home-grid { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 24px; }
    .home-service-card, .home-news-card { background: #ffffff; border: 1px solid #e2e8f0; border-radius: 22px; padding: 0; overflow: hidden; box-shadow: 0 6px 25px rgba(15, 23, 42, 0.04); }
    .home-service-card { padding: 28px; }
    
    .home-news-image {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        background: linear-gradient(135deg, #0f766e 0%, #0891b2 100%);
    }

    .news-cover-img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 2;
        transition: transform 0.5s ease !important;
    }

    .home-news-card:hover .news-cover-img {
        transform: scale(1.08) !important;
    }

    .home-news-placeholder-box {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f766e 0%, #0891b2 100%);
        color: #ffffff;
        font-weight: 800;
        padding: 20px;
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .home-news-category {
        position: absolute;
        left: 16px;
        bottom: 16px;
        padding: 6px 12px;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.85);
        color: #ffffff;
        font-size: 11px;
        font-weight: 800;
        backdrop-filter: blur(8px);
        z-index: 3;
    }

    .home-service-icon { width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; border-radius: 18px; background: #ecfdf5; font-size: 28px; }
    .home-service-button { display: flex; align-items: center; justify-content: space-between; padding: 12px 16px; border-radius: 13px; background: #0f766e; color: #ffffff; text-decoration: none; font-weight: 800; transition: background 0.2s ease; }
    .home-service-button:hover { background: #0b5f59; }

    /* DTSEN STYLING */
    .home-dtsen-custom { background: #ffffff; padding: 80px 0; border-top: 1px solid #f1f5f9; }
    .dtsen-split-grid { display: grid; grid-template-columns: 1fr 1.1fr; gap: 30px; align-items: stretch; }
    .dtsen-hero-card { background: linear-gradient(145deg, #0f766e 0%, #0d5c56 100%); border-radius: 24px; padding: 40px; color: #ffffff; display: flex; flex-direction: column; justify-content: space-between; box-shadow: 0 15px 40px rgba(15, 118, 110, 0.15); }
    .dtsen-badge-tag { display: inline-block; padding: 5px 14px; border-radius: 20px; background: rgba(255, 255, 255, 0.18); color: #ffffff; font-size: 0.78rem; font-weight: 800; width: fit-content; margin-bottom: 20px; letter-spacing: 0.5px; }
    .dtsen-hero-card h3 { font-size: 2rem; font-weight: 800; margin: 0 0 14px; color: #ffffff; }
    .dtsen-hero-card p { color: #ccfbf1; font-size: 0.98rem; line-height: 1.7; margin: 0 0 25px; }
    .dtsen-key-stats { display: flex; gap: 30px; padding-top: 20px; border-top: 1px solid rgba(255, 255, 255, 0.2); }
    .dtsen-key-stats strong { display: block; font-size: 1.4rem; font-weight: 900; color: #ffffff; }
    .dtsen-key-stats span { font-size: 0.8rem; color: #99f6e4; font-weight: 600; }

    .dtsen-info-stack { display: flex; flex-direction: column; gap: 20px; }
    .dtsen-info-card { background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 26px; display: flex; align-items: flex-start; gap: 18px; box-shadow: 0 6px 20px rgba(15, 23, 42, 0.03); }
    .dtsen-icon-box { width: 52px; height: 52px; border-radius: 16px; background: #f0fdf4; color: #0f766e; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
    .dtsen-info-card h4 { margin: 0 0 6px; font-size: 1.1rem; font-weight: 800; color: #0f172a; }
    .dtsen-info-card p { margin: 0; font-size: 0.9rem; color: #64748b; line-height: 1.6; }

    .dtsen-sub-heading { font-size: 1.35rem; font-weight: 800; color: #0f172a; margin-bottom: 22px; display: flex; align-items: center; gap: 10px; }

    .dtsen-check-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; }
    
    .dtsen-card-fancy {
        background: #ffffff;
        border-radius: 22px;
        overflow: hidden;
        border: 1px solid #e2e8f0;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
        display: flex;
        flex-direction: column;
    }

    .fancy-header {
        padding: 22px 26px;
        color: #ffffff;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-emerald { background: linear-gradient(135deg, #0f766e 0%, #059669 100%); }
    .header-cyan    { background: linear-gradient(135deg, #0284c7 0%, #0891b2 100%); }
    .header-indigo  { background: linear-gradient(135deg, #4f46e5 0%, #6366f1 100%); }

    .fancy-num { font-size: 1.8rem; font-weight: 900; opacity: 0.95; font-family: monospace; }
    .fancy-tag { background: rgba(255,255,255,0.22); padding: 4px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: 800; letter-spacing: 0.5px; }

    .fancy-body { padding: 26px; display: flex; flex-direction: column; flex: 1; justify-content: space-between; }
    .fancy-body h4 { font-size: 1.15rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; }
    .fancy-body p { font-size: 0.9rem; color: #64748b; margin: 0 0 22px; line-height: 1.6; }

    .btn-fancy { padding: 12px 20px; border-radius: 12px; font-weight: 800; text-decoration: none; text-align: center; color: #ffffff; transition: all 0.25s ease; }
    .btn-emerald { background: #0f766e; box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3); }
    .btn-emerald:hover { background: #0b5f59; transform: translateY(-2px); color: #ffffff; }

    .btn-cyan { background: #0284c7; box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3); }
    .btn-cyan:hover { background: #0369a1; transform: translateY(-2px); color: #ffffff; }

    .btn-indigo { background: #4f46e5; box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3); }
    .btn-indigo:hover { background: #4338ca; transform: translateY(-2px); color: #ffffff; }

    .dtsen-proc-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; }
    .dtsen-proc-card { border-radius: 20px; padding: 24px; display: flex; gap: 18px; align-items: flex-start; box-shadow: 0 6px 20px rgba(0, 0, 0, 0.04); }

    .border-waha-teal { border-left: 6px solid #0f766e !important; background: #ffffff !important; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }
    .border-waha-cyan { border-left: 6px solid #0891b2 !important; background: #ffffff !important; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }
    .border-waha-emerald { border-left: 6px solid #10b981 !important; background: #ffffff !important; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }
    .border-waha-navy { border-left: 6px solid #1e293b !important; background: #ffffff !important; border-top: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; border-bottom: 1px solid #e2e8f0; }

    .proc-icon { width: 50px; height: 50px; border-radius: 16px; display: flex; align-items: center; justify-content: center; font-size: 1.4rem; flex-shrink: 0; }
    .icon-waha-teal { background: #e6fffa !important; color: #0f766e !important; }
    .icon-waha-cyan { background: #ecfeff !important; color: #0891b2 !important; }
    .icon-waha-emerald { background: #dcfce7 !important; color: #10b981 !important; }
    .icon-waha-navy { background: #f1f5f9 !important; color: #1e293b !important; }

    .dtsen-proc-card h4 { margin: 0 0 6px; font-size: 1.05rem; font-weight: 800; }
    .dtsen-proc-card p { margin: 0; font-size: 0.88rem; color: #64748b; line-height: 1.55; }

    .home-location { background: #f8fafc; }
    .location-header { max-width: 700px; margin-bottom: 30px; }
    .location-card { display: grid; grid-template-columns: .75fr 1.25fr; min-height: 460px; border: 1px solid #e2e8f0; border-radius: 24px; background: #fff; }
    .location-information { padding: 40px; }
    .location-icon { width: 54px; height: 54px; display: grid; place-items: center; margin-bottom: 20px; border-radius: 16px; background: #eff6ff; font-size: 26px; }
    .location-map { min-height: 460px; background: #e2e8f0; }

    .home-cta { padding: 70px 0; }
    
    .cta-card {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 35px;
        padding: 45px;
        border-radius: 24px;
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%) !important;
        box-shadow: 0 25px 60px rgba(15, 23, 42, 0.25);
    }

    .cta-card .section-label {
        color: #34d399 !important;
        font-weight: 800 !important;
        letter-spacing: 1px !important;
        display: block !important;
        margin-bottom: 8px !important;
    }

    .cta-card h2 {
        margin: 8px 0 10px !important;
        color: #ffffff !important;
        font-size: clamp(24px, 3.8vw, 34px) !important;
        font-weight: 800 !important;
    }

    .cta-card p {
        max-width: 650px !important;
        margin: 0 !important;
        color: #cbd5e1 !important;
        line-height: 1.7 !important;
        font-size: 1rem !important;
    }

    .cta-buttons { display: flex; flex-shrink: 0; gap: 10px; }

    @media (max-width: 1024px) {
        .about-grid, .location-card, .dtsen-split-grid, .dtsen-proc-grid { grid-template-columns: 1fr; }
        .statistics-grid { grid-template-columns: repeat(3, 1fr); }
        .service-home-grid, .news-home-grid, .dtsen-check-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .statistics-grid, .service-home-grid, .news-home-grid, .dtsen-check-grid { grid-template-columns: 1fr; }
        .cta-card { flex-direction: column; align-items: flex-start; padding: 26px 20px; gap: 20px; }
        .cta-buttons { width: 100%; flex-direction: column; }
    }
</style>

@endpush

@if($latitude && $longitude)
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const mapElement = document.getElementById('desa-map');
            if (!mapElement) return;

            const latitude = parseFloat(mapElement.dataset.lat);
            const longitude = parseFloat(mapElement.dataset.lng);
            if (Number.isNaN(latitude) || Number.isNaN(longitude)) return;

            const map = L.map('desa-map').setView([latitude, longitude], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; OpenStreetMap contributors'
            }).addTo(map);

            const marker = L.marker([latitude, longitude]).addTo(map);
            marker.bindPopup('<strong>{{ addslashes($desaName) }}</strong><br>Lokasi Pemerintah Desa').openPopup();
        });
    </script>
    @endpush
@endif