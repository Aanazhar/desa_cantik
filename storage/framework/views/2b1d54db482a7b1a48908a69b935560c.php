<?php $__env->startSection('title', 'Hubungi Kami - ' . ($activeDesa->name ?? 'Desa Waha')); ?>


<?php
    if (!function_exists('renderContactBrandIcon')) {
        function renderContactBrandIcon($type, $fallbackIcon = null, $title = '') {
            $t = strtolower(trim((string)$type));
            $titleLower = strtolower(trim((string)$title));
            $iconStr = (string)$fallbackIcon;

            // DETEKSI OTOMATIS BERDASARKAN TIPE, EMOJI LAMA, ATAU JUDUL (MISAL: "Whatsap desa", "instagram desa")
            if ($t === 'other' || empty($t) || $t === 'lainnya') {
                if (str_contains($iconStr, '💬') || str_contains($titleLower, 'whatsapp') || str_contains($titleLower, 'whatsap') || str_contains($titleLower, 'wasap') || str_contains($titleLower, 'wa')) {
                    $t = 'whatsapp';
                } elseif (str_contains($iconStr, '📷') || str_contains($titleLower, 'instagram') || str_contains($titleLower, 'insta') || str_contains($titleLower, 'ig')) {
                    $t = 'instagram';
                } elseif (str_contains($iconStr, '📘') || str_contains($titleLower, 'facebook') || str_contains($titleLower, 'fb')) {
                    $t = 'facebook';
                } elseif (str_contains($iconStr, '▶') || str_contains($titleLower, 'youtube') || str_contains($titleLower, 'yt')) {
                    $t = 'youtube';
                } elseif (str_contains($iconStr, '🎵') || str_contains($titleLower, 'tiktok')) {
                    $t = 'tiktok';
                } elseif (str_contains($iconStr, '🌐') || str_contains($titleLower, 'website') || str_contains($titleLower, 'web')) {
                    $t = 'website';
                } elseif (str_contains($iconStr, '✉') || str_contains($titleLower, 'email') || str_contains($titleLower, 'mail')) {
                    $t = 'email';
                } elseif (str_contains($iconStr, '📞') || str_contains($titleLower, 'telepon') || str_contains($titleLower, 'phone') || str_contains($titleLower, 'hp')) {
                    $t = 'phone';
                } elseif (str_contains($iconStr, '📍') || str_contains($titleLower, 'alamat') || str_contains($titleLower, 'maps')) {
                    $t = 'address';
                }
            }

            switch($t) {
                case 'whatsapp':
                case 'wa':
                    return '<div class="contact-icon-box brand-icon-box bg-whatsapp" title="WhatsApp"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.031 2c-5.456 0-9.88 4.424-9.88 9.88 0 1.98.583 3.824 1.587 5.378l-1.688 6.166 6.323-1.658a9.842 9.842 0 0 0 4.658 1.194c5.456 0 9.88-4.424 9.88-9.88 0-5.456-4.424-9.88-9.88-9.88zm5.82 14.154c-.244.686-1.42 1.31-1.957 1.393-.538.082-1.228.118-3.486-.807-2.892-1.184-4.733-4.14-4.877-4.331-.144-.191-1.171-1.56-1.171-2.977 0-1.417.742-2.114 1.005-2.4.263-.286.574-.358.765-.358.191 0 .383.004.549.01.177.007.416-.067.65.495.244.586.837 2.046.91 2.193.072.147.12.318.024.51-.096.191-.144.31-.287.478-.143.167-.302.373-.43.501-.143.143-.293.3-.126.586.167.286.745 1.228 1.6 1.988 1.1.977 2.029 1.28 2.315 1.423.287.143.454.12.622-.072.167-.191.717-.836.908-1.123.191-.286.383-.238.646-.143.263.095 1.674.788 1.961.931.287.143.478.215.549.334.072.119.072.693-.172 1.379z"/></svg></div>';
                case 'instagram':
                case 'ig':
                    return '<div class="contact-icon-box brand-icon-box bg-instagram" title="Instagram"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></div>';
                case 'facebook':
                case 'fb':
                    return '<div class="contact-icon-box brand-icon-box bg-facebook" title="Facebook"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></div>';
                case 'youtube':
                case 'yt':
                    return '<div class="contact-icon-box brand-icon-box bg-youtube" title="YouTube"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></div>';
                case 'tiktok':
                    return '<div class="contact-icon-box brand-icon-box bg-tiktok" title="TikTok"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.98-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.82.57-1.31 1.54-1.33 2.54-.01 1.08.57 2.11 1.48 2.64.91.54 2.08.57 3.01.07.82-.43 1.38-1.28 1.47-2.2.06-3.86.03-7.72.04-11.58z"/></svg></div>';
                case 'website':
                case 'web':
                    return '<div class="contact-icon-box brand-icon-box bg-website" title="Website"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10z"></path></svg></div>';
                case 'email':
                case 'mail':
                    return '<div class="contact-icon-box brand-icon-box bg-email" title="Email"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>';
                case 'phone':
                case 'telepon':
                case 'hp':
                    return '<div class="contact-icon-box brand-icon-box bg-phone" title="Telepon"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>';
                case 'address':
                case 'alamat':
                case 'maps':
                    return '<div class="contact-icon-box brand-icon-box bg-address" title="Alamat"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>';
                default:
                    return '<div class="contact-icon-box brand-icon-box bg-other" title="Lainnya"><span>' . ($fallbackIcon ?: '🔗') . '</span></div>';
            }
        }
    }
?>

<?php $__env->startPush('styles'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* GLOBAL FONT INTER */
    body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    .contact-page {
        background: #f8fafc;
        padding-bottom: 80px;
    }

    /* HERO BANNER */
    .contact-hero {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0f766e 0%, #155d61 50%, #155e75 100%);
        color: #ffffff;
        padding: 70px 20px 105px;
        text-align: center;
        box-shadow: 0 10px 30px rgba(15, 118, 110, 0.15);
    }

    .contact-hero-content {
        position: relative;
        z-index: 1;
        max-width: 760px;
        margin: auto;
    }

    .contact-badge {
        display: inline-flex;
        padding: 6px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.18);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.8px;
        text-transform: uppercase;
        color: #ffffff;
        margin-bottom: 12px;
    }

    .contact-hero h1 {
        font-size: clamp(2rem, 4.5vw, 3.5rem);
        margin: 8px 0 12px;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .contact-hero p {
        color: #e0f2fe;
        line-height: 1.7;
        font-size: 1.02rem;
        margin: 0;
    }

    /* CONTAINER Utama */
    .contact-container {
        width: min(1120px, calc(100% - 30px));
        margin: -55px auto 0;
        position: relative;
        z-index: 2;
    }

    .contact-box {
        background: #ffffff;
        border-radius: 26px;
        padding: 36px;
        box-shadow: 0 20px 60px rgba(15, 23, 42, 0.08);
        border: 1px solid #e2e8f0;
    }

    .contact-heading {
        text-align: center;
        margin-bottom: 32px;
    }

    .contact-heading span {
        color: #0f766e;
        font-size: 12px;
        font-weight: 800;
        letter-spacing: 1.6px;
        text-transform: uppercase;
    }

    .contact-heading h2 {
        margin: 6px 0;
        font-size: 1.75rem;
        color: #0f172a;
        font-weight: 800;
    }

    .contact-heading p {
        color: #64748b;
        line-height: 1.7;
        max-width: 680px;
        margin: auto;
        font-size: 0.94rem;
    }

    /* =========================================================
       IKON APPS RESMI MODERN (!IMPORTANT SPESIFISITAS TINGGI)
       ========================================================= */
    .contact-page .contact-card .contact-icon-box,
    .contact-page .contact-icon-box,
    .contact-icon-box,
    .brand-icon-box {
        width: 50px !important;
        height: 50px !important;
        min-width: 50px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08) !important;
        transition: transform 0.25s ease, box-shadow 0.25s ease !important;
    }

    .contact-card:hover .contact-icon-box,
    .contact-card:hover .brand-icon-box,
    .social-card:hover .brand-icon-box {
        transform: translateY(-3px) scale(1.06) !important;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.16) !important;
    }

    /* OVERRIDE WARNA BACKGROUND UNTUK SETIAP LOGO APPS */
    .contact-page .contact-icon-box.bg-whatsapp, .bg-whatsapp { background: #25D366 !important; border-radius: 50% !important; }
    .contact-page .contact-icon-box.bg-instagram, .bg-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888) !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-facebook, .bg-facebook { background: #1877F2 !important; border-radius: 12px !important; }
    .contact-page .contact-icon-box.bg-youtube, .bg-youtube { background: #FF0000 !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-tiktok, .bg-tiktok { background: #000000 !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-website, .bg-website { background: #0284c7 !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-email, .bg-email { background: #ea580c !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-phone, .bg-phone { background: #059669 !important; border-radius: 50% !important; }
    .contact-page .contact-icon-box.bg-address, .bg-address { background: #dc2626 !important; border-radius: 14px !important; }
    .contact-page .contact-icon-box.bg-other, .bg-other { background: #64748b !important; border-radius: 14px !important; }

    /* GRID KONTAK UTAMA */
    .contact-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .contact-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 20px;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        text-decoration: none;
        color: inherit;
        background: #ffffff;
        transition: all 0.25s ease;
    }

    .contact-card:hover {
        transform: translateY(-4px);
        border-color: #0f766e;
        box-shadow: 0 14px 35px rgba(15, 118, 110, 0.12);
    }

    .contact-info {
        flex: 1;
        min-width: 0;
    }

    .contact-info strong {
        display: block;
        margin-bottom: 3px;
        color: #0f172a;
        font-size: 1rem;
        font-weight: 800;
    }

    .contact-info p {
        margin: 0;
        color: #64748b;
        font-size: 0.86rem;
        line-height: 1.5;
    }

    .contact-arrow {
        color: #0f766e;
        font-size: 20px;
        font-weight: 900;
        transition: transform 0.2s ease;
    }

    .contact-card:hover .contact-arrow {
        transform: translateX(4px);
    }

    /* SECTION MEDIA SOSIAL */
    .contact-bottom {
        margin-top: 36px;
        padding-top: 30px;
        border-top: 1px solid #f1f5f9;
        text-align: center;
    }

    .contact-bottom h3 {
        margin: 0 0 6px;
        color: #0f172a;
        font-size: 1.3rem;
        font-weight: 800;
    }

    .contact-bottom p {
        color: #64748b;
        line-height: 1.6;
        font-size: 0.9rem;
    }

    .social-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-top: 20px;
    }

    .social-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        text-decoration: none;
        color: #0f172a;
        background: #ffffff;
        transition: all 0.2s ease;
    }

    .social-card:hover {
        border-color: #0f766e;
        background: #f0fdf4;
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(15, 118, 110, 0.1);
    }

    .social-name {
        font-size: 0.88rem;
        font-weight: 800;
        color: #334155;
    }

    .empty-contact {
        text-align: center;
        padding: 60px 20px;
        color: #64748b;
    }

    /* RESPONSIVE MEDIA QUERIES (OPTIMAL UNTUK HP / ANDROID) */
    @media (max-width: 800px) {
        .contact-hero { padding: 45px 15px 75px; }
        .contact-hero h1 { font-size: clamp(1.6rem, 5.5vw, 2.3rem); }
        .contact-hero p { font-size: 0.9rem; }

        .contact-container { margin-top: -40px; }
        .contact-box { padding: 22px 16px; border-radius: 20px; }
        .contact-heading h2 { font-size: 1.35rem; }
        .contact-heading p { font-size: 0.88rem; }

        .contact-grid { grid-template-columns: 1fr; gap: 12px; }
        .contact-card { padding: 16px 14px; gap: 14px; border-radius: 16px; }

        .social-grid { grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .social-card { padding: 10px 14px; border-radius: 14px; }
    }

    @media (max-width: 480px) {
        .social-grid { grid-template-columns: repeat(2, 1fr); }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="contact-page">

    
    <section class="contact-hero">
        <div class="contact-hero-content">
            <span class="contact-badge">KANAL RESMI DESA</span>
            <h1>Hubungi Kami</h1>
            <p>Butuh informasi atau pelayanan publik desa? Pilih kanal komunikasi resmi di bawah ini. Kami siap melayani masyarakat dengan cepat dan transparan.</p>
        </div>
    </section>

    
    <div class="contact-container">
        <div class="contact-box">

            <?php
                $socialKeywords = ['whatsapp','whatsap','wasap','wa','instagram','insta','ig','facebook','fb','youtube','yt','tiktok','website','web'];
                
                // LOGIKA CERDAS: PISAHKAN KONTAK UTAMA (Telepon, Email, Alamat) VS MEDSOS (WhatsApp, IG, FB, YT, TikTok, Web)
                $primaryContacts = $kontak->filter(function($c) use ($socialKeywords) {
                    $t = strtolower(trim($c->type ?? 'other'));
                    $title = strtolower(trim($c->title ?? ''));
                    foreach ($socialKeywords as $kw) {
                        if ($t === $kw || str_contains($title, $kw)) return false;
                    }
                    return true;
                });

                $socialContacts = $kontak->filter(function($c) use ($socialKeywords) {
                    $t = strtolower(trim($c->type ?? 'other'));
                    $title = strtolower(trim($c->title ?? ''));
                    foreach ($socialKeywords as $kw) {
                        if ($t === $kw || str_contains($title, $kw)) return true;
                    }
                    return false;
                });

                // JIKA HANYA ADA KONTAK MEDSOS, TAMPILKAN DI SATU SECTION SAJA (CEGAH GANDA / DOUBLE)!
                $displayGridContacts = $primaryContacts->count() > 0 ? $primaryContacts : $kontak;
                $showSeparateSocialSection = $primaryContacts->count() > 0 && $socialContacts->count() > 0;
            ?>

            <div class="contact-heading">
                <span>LAYANAN INFORMASI & ADUAN</span>
                <h2>Temukan Kontak Resmi Desa</h2>
                <p>Semua informasi kontak dan layanan dikelola langsung oleh aparatur desa untuk mempermudah komunikasi masyarakat.</p>
            </div>

            <?php if($displayGridContacts->count()): ?>
                <div class="contact-grid">
                    <?php $__currentLoopData = $displayGridContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $type = $contact->type ?? 'other';
                            $rawUrl = trim((string)($contact->url ?? ''));
                            $href = null;
                            $external = true;

                            if ($rawUrl) {
                                if (in_array(strtolower($type), ['whatsapp', 'wa', 'whatsap'])) {
                                    $cleanNum = preg_replace('/[^0-9]/', '', $rawUrl);
                                    if (str_starts_with($cleanNum, '0')) {
                                        $cleanNum = '62' . substr($cleanNum, 1);
                                    }
                                    $href = 'https://wa.me/' . $cleanNum;
                                } elseif (in_array(strtolower($type), ['email', 'mail'])) {
                                    $href = str_starts_with($rawUrl, 'mailto:') ? $rawUrl : 'mailto:'.$rawUrl;
                                    $external = false;
                                } elseif (in_array(strtolower($type), ['phone', 'telepon', 'hp'])) {
                                    $href = 'tel:'.preg_replace('/[^0-9+]/', '', $rawUrl);
                                    $external = false;
                                } elseif (in_array(strtolower($type), ['address', 'alamat', 'maps'])) {
                                    $href = (str_starts_with($rawUrl, 'http://') || str_starts_with($rawUrl, 'https://'))
                                        ? $rawUrl
                                        : 'https://www.google.com/maps/search/?api=1&query='.urlencode($rawUrl);
                                } elseif (preg_match('/^https?:\/\//i', $rawUrl)) {
                                    $href = $rawUrl;
                                } else {
                                    $href = 'https://'.$rawUrl;
                                }
                            }
                        ?>

                        <?php if($href): ?>
                            <a class="contact-card" href="<?php echo e($href); ?>" <?php if($external): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?>>
                        <?php else: ?>
                            <div class="contact-card">
                        <?php endif; ?>

                            
                            <?php echo renderContactBrandIcon($contact->type ?? 'other', $contact->icon, $contact->title); ?>


                            <div class="contact-info">
                                <strong><?php echo e($contact->title); ?></strong>
                                <p><?php echo e($contact->description ?: 'Hubungi kami melalui kanal resmi ini.'); ?></p>
                            </div>
                            <?php if($href): ?><div class="contact-arrow">→</div><?php endif; ?>
                        <?php if($href): ?></a><?php else: ?></div><?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                
                <?php if($showSeparateSocialSection): ?>
                    <div class="contact-bottom">
                        <h3>🌐 Ikuti Media Sosial Desa</h3>
                        <p>Dapatkan update informasi kegiatan, pengumuman, dan transparansi pelayanan desa.</p>
                        <div class="social-grid">
                            <?php $__currentLoopData = $socialContacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $stype = strtolower($contact->type ?? 'other');
                                    $sraw = trim((string)$contact->url);
                                    if (in_array($stype, ['whatsapp', 'wa', 'whatsap'])) {
                                        $num = preg_replace('/[^0-9]/', '', $sraw);
                                        if (str_starts_with($num, '0')) $num = '62' . substr($num, 1);
                                        $surl = 'https://wa.me/' . $num;
                                    } else {
                                        $surl = preg_match('/^https?:\/\//i', $sraw) ? $sraw : 'https://'.$sraw;
                                    }
                                ?>
                                <a class="social-card" href="<?php echo e($surl); ?>" target="_blank" rel="noopener noreferrer">
                                    <?php echo renderContactBrandIcon($contact->type ?? 'other', $contact->icon, $contact->title); ?>

                                    <span class="social-name"><?php echo e($contact->title); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php else: ?>
                <div class="empty-contact">
                    <div style="font-size: 56px; margin-bottom: 12px;">📭</div>
                    <h3 style="font-size: 1.3rem; color: #0f172a;">Kontak Belum Tersedia</h3>
                    <p>Informasi kontak resmi desa belum ditambahkan oleh admin.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/kontak.blade.php ENDPATH**/ ?>