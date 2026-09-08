<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        <?php echo $__env->yieldContent('title', ($activeDesa->name ?? 'Desa Waha')); ?> - Website Resmi Desa
    </title>

    <meta name="description" content="Website Resmi Pemerintah <?php echo e($activeDesa->name ?? 'Desa Waha'); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>

    <style>
        /* SMOOTH SCROLL PARALLAX */
        html {
            scroll-behavior: smooth;
        }

        /* =========================================================
           STICKY NAVBAR & HEADER (TETAP DI ATAS SAAT DI-SCROLL)
           ========================================================= */
        header.header {
            position: sticky !important;
            top: 0 !important;
            z-index: 99999 !important;
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.08);
            transition: all 0.3s ease;
        }

        .nav-menu { display: flex; align-items: center; gap: 5px; }
        .nav-dropdown { position: relative; }
        .nav-dropdown > button { border: none; background: transparent; font: inherit; color: inherit; cursor: pointer; padding: 10px 15px; display: flex; align-items: center; gap: 6px; }
        .nav-dropdown > button span { font-size: 12px; transition: transform 0.2s ease; }
        .nav-dropdown.open > button span { transform: rotate(180deg); }
        .nav-dropdown .dropdown-menu { display: none; position: absolute; top: calc(100% + 5px); left: 0; min-width: 230px; background: #ffffff; border-radius: 8px; padding: 8px 0; box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15); border: 1px solid #eeeeee; z-index: 9999; }
        .nav-dropdown.open .dropdown-menu { display: block; }
        .nav-dropdown .dropdown-menu a { display: block; padding: 11px 16px; color: #333333; text-decoration: none; font-size: 14px; white-space: nowrap; transition: background 0.2s ease, color 0.2s ease; }
        .nav-dropdown .dropdown-menu a:hover { background: #f1f5f9; color: #166534; }
        .nav-dropdown.active > button { color: #166534; }

        @media (max-width: 768px) {
            .nav-menu { display: none; flex-direction: column; align-items: stretch; width: 100%; }
            .nav-menu.show { display: flex; }
            .nav-dropdown { width: 100%; }
            .nav-dropdown > button { width: 100%; justify-content: space-between; text-align: left; }
            .nav-dropdown .dropdown-menu { position: static; width: 100%; min-width: 0; box-shadow: none; border: none; border-radius: 0; padding-left: 15px; }
            .nav-dropdown.open .dropdown-menu { display: block; }
        }

        /* =========================================================
           🌙 FOOTER DESA CANTIK DARK THEME (IDENTIK 100%)
           ========================================================= */
        .site-footer {
            background: #0b1329;
            color: #94a3b8;
            padding: 60px 0 0;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .footer-grid-container {
            display: grid;
            grid-template-columns: 1.4fr 1fr 1.1fr 1.3fr;
            gap: 40px;
            padding-bottom: 40px;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 16px;
        }

        .footer-brand img {
            height: 48px;
            width: auto;
            object-fit: contain;
        }

        .footer-brand-text strong {
            display: block;
            font-size: 1.15rem;
            color: #ffffff;
            font-weight: 800;
            letter-spacing: -0.3px;
        }

        .footer-brand-text span {
            font-size: 0.82rem;
            color: #10b981;
            font-weight: 700;
        }

        .footer-desc {
            color: #94a3b8;
            font-size: 0.88rem;
            margin-bottom: 20px;
            line-height: 1.65;
        }

        .footer-socials {
            display: flex;
            gap: 10px;
        }

        .social-circle-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            color: #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            font-size: 0.85rem;
            transition: all 0.25s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .social-circle-btn:hover {
            background: #10b981;
            color: #ffffff;
            border-color: #10b981;
            transform: translateY(-3px);
        }

        .footer-col-title {
            color: #ffffff;
            font-size: 1.05rem;
            font-weight: 800;
            margin: 0 0 18px;
            position: relative;
            padding-bottom: 8px;
        }

        .footer-col-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 35px;
            height: 2px;
            background: #10b981;
        }

        .footer-links-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-links-list li {
            margin-bottom: 10px;
        }

        .footer-links-list a {
            color: #94a3b8;
            text-decoration: none;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 0.88rem;
        }

        .footer-links-list a:hover {
            color: #10b981;
            transform: translateX(4px);
        }

        .footer-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            margin-bottom: 14px;
            color: #94a3b8;
            font-size: 0.88rem;
        }

        .contact-icon-green {
            color: #10b981;
            font-size: 1.1rem;
            flex-shrink: 0;
            margin-top: 2px;
        }

        /* BOTTOM BAR */
        .footer-bottom-bar {
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding: 22px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 14px;
            font-size: 0.84rem;
            color: #64748b;
        }

        .badge-cantik {
            background: #10b981;
            color: #ffffff;
            font-weight: 800;
            font-size: 0.72rem;
            padding: 3px 10px;
            border-radius: 6px;
            letter-spacing: 0.5px;
            margin: 0 4px;
            display: inline-block;
        }

        @media (max-width: 1024px) {
            .footer-grid-container {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }
        }

        @media (max-width: 640px) {
            .footer-grid-container {
                grid-template-columns: 1fr;
            }
            .footer-bottom-bar {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>

<body>


<header class="header">
    
    <div class="top-header">
        <div class="container top-header-content">
            <div>
                🌐 Website Resmi Pemerintah <?php echo e($activeDesa->name ?? 'Desa Waha'); ?>

            </div>
            <div>
                Senin - Jumat | 08.00 - 16.00 WITA
            </div>
        </div>
    </div>

    
    <nav class="navbar">
        <div class="container nav-container">
            
            
            <a href="<?php echo e(route('home')); ?>" class="logo">
                <img 
                    src="<?php echo e(asset('images/logo Kabupaten Wakatobi (2).png')); ?>" 
                    alt="Logo <?php echo e($activeDesa->name ?? 'Desa Waha'); ?>" 
                    style="height: 44px; width: auto; object-fit: contain;"
                >

                <div class="logo-text">
                    <strong><?php echo e(strtoupper($activeDesa->name ?? 'DESA WAHA')); ?></strong>
                    <span>Pemerintah Desa</span>
                </div>
            </a>

            
            <div class="nav-menu">
                <a href="<?php echo e(route('home')); ?>" class="<?php echo e(request()->routeIs('home') ? 'active' : ''); ?>">
                    Home
                </a>

                <a href="<?php echo e(route('profil')); ?>" class="<?php echo e(request()->routeIs('profil*') ? 'active' : ''); ?>">
                    Profil Desa
                </a>

                <a href="<?php echo e(route('data-desa')); ?>" class="nav-link <?php echo e(request()->routeIs('data-desa*', 'data.page') ? 'active' : ''); ?>">
                    Data Desa
                </a>

                <a href="<?php echo e(route('layanan')); ?>" class="nav-link <?php echo e(request()->routeIs('layanan*') ? 'active' : ''); ?>">
                    Layanan
                </a>

                <a href="<?php echo e(route('publikasi')); ?>" class="<?php echo e(request()->routeIs('publikasi*') ? 'active' : ''); ?>">
                    Publikasi
                </a>

                <a href="<?php echo e(route('berita')); ?>" class="<?php echo e(request()->routeIs('berita*') ? 'active' : ''); ?>">
                    Berita
                </a>

                <a href="<?php echo e(route('kontak')); ?>" class="<?php echo e(request()->routeIs('kontak*') ? 'active' : ''); ?>">
                    Kontak
                </a>
            </div>

            
            <button class="menu-button" type="button" aria-label="Buka menu">
                ☰
            </button>
        </div>
    </nav>
</header>


<main>
    <?php echo $__env->yieldContent('content'); ?>
</main>


<footer class="site-footer">
    <div class="container">
        <div class="footer-grid-container">
            
            
            <div>
                <div class="footer-brand">
                    <img src="<?php echo e(asset('images/logo Kabupaten Wakatobi (2).png')); ?>" alt="Logo Wakatobi">
                    <div class="footer-brand-text">
                        <strong>Desa Cantik</strong>
                        <span><?php echo e($activeDesa->name ?? 'Desa Waha'); ?></span>
                    </div>
                </div>

                <p class="footer-desc">
                    Program Desa Cinta Statistik (Desa Cantik) yang diselenggarakan oleh BPS Kabupaten Wakatobi untuk transparansi & tata kelola data desa modern.
                </p>

                <div class="footer-socials">
                    <a href="#" class="social-circle-btn" title="Facebook">f</a>
                    <a href="#" class="social-circle-btn" title="Twitter / X">𝕏</a>
                    <a href="#" class="social-circle-btn" title="Instagram">📷</a>
                    <a href="#" class="social-circle-btn" title="Youtube">▶</a>
                </div>
            </div>

            
            <div>
                <h4 class="footer-col-title">Tautan Cepat</h4>
                <ul class="footer-links-list">
                    <li><a href="<?php echo e(route('home')); ?>"><span style="color: #10b981;">•</span> Beranda</a></li>
                    <li><a href="<?php echo e(route('data-desa')); ?>"><span style="color: #10b981;">•</span> Data Statistik</a></li>
                    <li><a href="<?php echo e(route('layanan')); ?>"><span style="color: #10b981;">•</span> Layanan Online</a></li>
                    <li><a href="<?php echo e(route('publikasi')); ?>"><span style="color: #10b981;">•</span> Publikasi & Berkas</a></li>
                    <li><a href="<?php echo e(route('berita')); ?>"><span style="color: #10b981;">•</span> Berita Desa</a></li>
                    <li><a href="<?php echo e(route('profil')); ?>"><span style="color: #10b981;">•</span> Tentang Kami</a></li>
                </ul>
            </div>

            
            <div>
                <h4 class="footer-col-title">Website Pendukung</h4>
                <ul class="footer-links-list">
                    <li><a href="https://wakatobikab.go.id" target="_blank">↗ Pemkab Wakatobi</a></li>
                    <li><a href="https://wakatobikab.bps.go.id" target="_blank">↗ BPS Kab. Wakatobi</a></li>
                    <li><a href="https://bps.go.id" target="_blank">↗ BPS RI</a></li>
                </ul>
            </div>

            
            <div>
                <h4 class="footer-col-title">Kontak Kami</h4>
                <div class="footer-contact-item">
                    <span class="contact-icon-green">📍</span>
                    <span><?php echo e($activeDesa->address ?? 'Kecamatan Wangi-Wangi, Kabupaten Wakatobi, Sulawesi Tenggara'); ?></span>
                </div>
                <div class="footer-contact-item">
                    <span class="contact-icon-green">📞</span>
                    <span><?php echo e($activeDesa->phone ?? '081234567890'); ?></span>
                </div>
                <div class="footer-contact-item">
                    <span class="contact-icon-green">✉️</span>
                    <span><?php echo e($activeDesa->email ?? ('desawaha@wakatobikab.go.id')); ?></span>
                </div>
            </div>

        </div>

        
        <div class="footer-bottom-bar">
            <div>
                © <?php echo e(date('Y')); ?> <?php echo e($activeDesa->name ?? 'Desa Waha'); ?>. Hak Cipta Dilindungi.
            </div>
            <div>
                Program <span class="badge-cantik">DESA CINTA STATISTIK</span> — BPS Kabupaten Wakatobi
            </div>
        </div>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const menuButton = document.querySelector('.menu-button');
    const navMenu = document.querySelector('.nav-menu');

    if (menuButton && navMenu) {
        menuButton.addEventListener('click', function (event) {
            event.stopPropagation();
            navMenu.classList.toggle('show');
        });
    }

    if (typeof IntersectionObserver !== 'undefined') {
        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        document.querySelectorAll('.section, .statistics, .cta-section, .feature-panel, .hero').forEach(function (element) {
            element.classList.add('reveal');
            observer.observe(element);
        });
    }
});
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>

</body>
</html><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/layouts/app.blade.php ENDPATH**/ ?>