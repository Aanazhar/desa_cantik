<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title>
        <?php echo $__env->yieldContent('title', 'Dashboard'); ?> - <?php echo e($activeDesa->name ?? 'Desa Waha'); ?>

    </title>

    
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <?php echo $__env->yieldPushContent('styles'); ?>
</head>

<body class="admin-body">

<div class="admin-layout">

    
    <aside class="admin-sidebar" id="adminSidebar">

        
                
        <a href="<?php echo e(route('home')); ?>" class="logo">
            <img 
                src="<?php echo e(asset('images/logo Kabupaten Wakatobi (2).png')); ?>" 
                alt="Logo Kabupaten Wakatobi" 
                style="height: 44px; width: auto; object-fit: contain;"
            >

            <div class="logo-text">
                <strong><?php echo e(strtoupper($activeDesa->name ?? 'DESA WAHA')); ?></strong>
                <span>Pemerintah Desa</span>
            </div>
        </a>

        
        <nav class="admin-nav">

            <div class="admin-nav-label">
                MENU UTAMA
            </div>

            
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 11.5 12 4l9 7.5"/>
                        <path d="M5 10v10h14V10"/>
                        <path d="M9 20v-6h6v6"/>
                    </svg>
                </span>
                <span>Dashboard</span>
            </a>

            
            <a href="<?php echo e(route('admin.desa-profiles')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.desa-profiles*') || request()->routeIs('admin.desa-profile-sections*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">🏡</span>
                <span>Profil Desa</span>
            </a>
<!-- 
            
            <a href="<?php echo e(route('admin.site-data')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.site-data*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="3"/>
                        <path d="M19.4 15a1.7 1.7 0 0 0 .3 1.9l.1.1-1.8 1.8-.1-.1a1.7 1.7 0 0 0-1.9-.3 1.7 1.7 0 0 0-1 1.6v.2h-2.6V20a1.7 1.7 0 0 0-1-1.6 1.7 1.7 0 0 0-1.9.3l-.1.1-1.8-1.8.1-.1A1.7 1.7 0 0 0 8 15a1.7 1.7 0 0 0-1.6-1H6v-2.6h.4A1.7 1.7 0 0 0 8 10a1.7 1.7 0 0 0-.3-1.9l-.1-.1 1.8-1.8.1.1a1.7 1.7 0 0 0 1.9.3 1.7 1.7 0 0 0 1-1.6v-.2H15V5a1.7 1.7 0 0 0 1 1.6 1.7 1.7 0 0 0 1.9-.3l.1-.1 1.8 1.8-.1.1a1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0-.3 1.9 1.7 1.7 0 0 0 1.6 1h.2V14H21a1.7 1.7 0 0 0-1.6 1z"/>
                    </svg>
                </span>
                <span>Data Website</span>
            </a> -->

            
            <a href="<?php echo e(route('admin.data-desa')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.data-desa*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 19V5"/>
                        <path d="M4 19h17"/>
                        <path d="m7 15 4-4 3 2 5-6"/>
                    </svg>
                </span>
                <span>Data Desa</span>
            </a>

            
            <div class="admin-nav-dropdown <?php echo e((request()->routeIs('admin.layanan*') || request()->routeIs('admin.pengajuan*')) ? 'open' : ''); ?>">
                <button type="button" class="admin-nav-link admin-dropdown-toggle" aria-expanded="<?php echo e((request()->routeIs('admin.layanan*') || request()->routeIs('admin.pengajuan*')) ? 'true' : 'false'); ?>">
                    <span class="admin-nav-icon">
                        <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 3h12v18H6z"/>
                            <path d="M9 7h6"/>
                            <path d="M9 11h6"/>
                            <path d="M9 15h4"/>
                        </svg>
                    </span>
                    <span class="admin-dropdown-title">Layanan</span>
                    <span class="admin-dropdown-arrow">▾</span>
                </button>

                <div class="admin-dropdown-menu">
                    <a href="<?php echo e(route('admin.layanan')); ?>" class="<?php echo e(request()->routeIs('admin.layanan') ? 'active' : ''); ?>">
                        <span>📋</span> <span>Kelola Layanan</span>
                    </a>
                    <a href="<?php echo e(route('admin.pengajuan.index')); ?>" class="<?php echo e(request()->routeIs('admin.pengajuan*') ? 'active' : ''); ?>">
                        <span>📥</span> <span>Pengajuan Masyarakat</span>
                    </a>
                    <a href="<?php echo e(route('admin.layanan')); ?>#tambah-layanan">
                        <span>➕</span> <span>Tambah Layanan</span>
                    </a>
                </div>
            </div>

            
            <a href="<?php echo e(route('admin.publikasi.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.publikasi*') && !request()->routeIs('admin.berita*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="4" y="4" width="16" height="16" rx="2"/>
                        <path d="M8 9h8"/>
                        <path d="M8 13h6"/>
                        <path d="M8 17h4"/>
                    </svg>
                </span>
                <span>Publikasi</span>
            </a>

            
            <a href="<?php echo e(route('admin.berita.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.berita*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">📰</span>
                <span>Berita Desa</span>
            </a>

            
            <a href="<?php echo e(route('admin.kontak.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.kontak*') ? 'active' : ''); ?>">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 11.5a8.4 8.4 0 0 1-9 8.5 9.5 9.5 0 0 1-4-.9L3 21l1.9-4A8.4 8.4 0 0 1 3 11.5 8.5 8.5 0 0 1 12 3a8.5 8.5 0 0 1 9 8.5z" />
                    </svg>
                </span>
                <span>Kontak Desa</span>
            </a>

            
            <div class="admin-nav-divider"></div>
            <div class="admin-nav-label">WEBSITE</div>

            
            <a href="<?php echo e(route('home')); ?>" target="_blank" class="admin-nav-link">
                <span class="admin-nav-icon">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="9"/>
                        <path d="M3 12h18"/>
                        <path d="M12 3c3 3 3 15 0 18"/>
                    </svg>
                </span>
                <span>Lihat Website</span>
                <span class="admin-external">↗</span>
            </a>
        </nav>

        
        <div class="admin-sidebar-bottom">
            <div class="admin-profile-mini">
                <div class="admin-avatar">
                    <?php echo e(strtoupper(substr(session('admin_name', 'A'), 0, 1))); ?>

                </div>
                <div>
                    <strong><?php echo e(session('admin_name', 'Administrator')); ?></strong>
                    <span>Administrator</span>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="admin-logout">
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 17l5-5-5-5"/>
                        <path d="M15 12H3"/>
                        <path d="M21 19V5a2 2 0 0 0-2-2h-6"/>
                    </svg>
                    Keluar
                </button>
            </form>
        </div>
    </aside>

    
    <main class="admin-main">

        
        <header class="admin-topbar">
            <button type="button" class="admin-mobile-toggle" id="adminMobileToggle">☰</button>
            
            <div class="admin-topbar-title">
                <span>PANEL ADMINISTRASI</span>
                <h1><?php echo $__env->yieldContent('title', 'Dashboard'); ?></h1>
            </div>

            <div class="admin-topbar-right">
                <a href="<?php echo e(route('home')); ?>" target="_blank" class="admin-view-site">Lihat Website</a>

                <div class="admin-top-user">
                    <div class="admin-avatar">
                        <?php echo e(strtoupper(substr(session('admin_name', 'A'), 0, 1))); ?>

                    </div>
                    <div>
                        <strong><?php echo e(session('admin_name', 'Administrator')); ?></strong>
                        <span>Administrator</span>
                    </div>
                </div>
            </div>
        </header>

        
        <div class="admin-content">

            <?php if(session('success')): ?>
                <div class="admin-alert admin-alert-success">
                    <span>✓</span>
                    <div>
                        <strong>Berhasil</strong>
                        <p><?php echo e(session('success')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session('error')): ?>
                <div class="admin-alert admin-alert-error">
                    <span>!</span>
                    <div>
                        <strong>Terjadi kesalahan</strong>
                        <p><?php echo e(session('error')); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($errors->any()): ?>
                <div class="admin-alert admin-alert-error">
                    <span>!</span>
                    <div>
                        <strong>Periksa kembali data</strong>
                        <p><?php echo e($errors->first()); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
        </div>
    </main>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const dropdownButtons = document.querySelectorAll('.admin-dropdown-toggle');
    dropdownButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();
            const parent = this.closest('.admin-nav-dropdown');
            if (!parent) return;

            document.querySelectorAll('.admin-nav-dropdown.open').forEach(function (dropdown) {
                if (dropdown !== parent) {
                    dropdown.classList.remove('open');
                    const otherButton = dropdown.querySelector('.admin-dropdown-toggle');
                    if (otherButton) otherButton.setAttribute('aria-expanded', 'false');
                }
            });

            const isOpen = parent.classList.contains('open');
            parent.classList.toggle('open', !isOpen);
            this.setAttribute('aria-expanded', !isOpen ? 'true' : 'false');
        });
    });

    const mobileToggle = document.getElementById('adminMobileToggle');
    const sidebar = document.getElementById('adminSidebar');
    if (mobileToggle && sidebar) {
        mobileToggle.addEventListener('click', function (event) {
            event.stopPropagation();
            sidebar.classList.toggle('show');
        });
    }
});
</script>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/layouts/admin.blade.php ENDPATH**/ ?>