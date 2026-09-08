<?php $__env->startSection('title', 'Profil - ' . ($desa->name ?? ($activeDesa->name ?? 'Desa Waha'))); ?>

<?php $__env->startPush('styles'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================================
       PROFIL DESA - PUBLIK / USER (DESAIN MEWAH & EFEK BOUNCE)
       ========================================================= */

    html {
        scroll-behavior: smooth;
    }

    .public-profil-page {
        --green: #0f766e;
        --green-dark: #134e4a;
        --green-soft: #edf6f0;
        --green-border: #dcebe1;

        --text: #0f172a;
        --muted: #64748b;
        --border: #e2e8f0;
        --bg-light: #f8fafc;

        color: var(--text);
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
        padding-bottom: 70px;
        background: #f8fafc;
    }

    .public-profil-page *,
    .public-profil-page *::before,
    .public-profil-page *::after {
        box-sizing: border-box;
    }

    .public-container {
        max-width: 1140px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* PUB HERO HEADER DENGAN ANIMASI MELAYANG */
    .pub-hero {
        background: linear-gradient(135deg, #0f766e 0%, #155d61 50%, #155e75 100%);
        color: #ffffff;
        padding: 45px 0;
        margin-bottom: 30px;
        box-shadow: 0 10px 30px rgba(15, 118, 110, 0.15);
    }

    .pub-hero-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
    }

    .pub-hero h1 {
        margin: 6px 0 8px;
        font-size: clamp(1.8rem, 3.5vw, 2.5rem);
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .pub-hero p {
        margin: 0;
        color: #e0f2fe;
        font-size: 0.96rem;
        line-height: 1.6;
        max-width: 650px;
    }

    .pub-hero-icon {
        font-size: 64px;
        line-height: 1;
        opacity: 0.95;
        animation: floatAnim 5s ease-in-out infinite;
    }

    @keyframes floatAnim {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    /* =========================================================
       NAV ANCHORS PILLS DENGAN IKON & EFEK MELAYANG HOVER
       ========================================================= */

    .profil-nav-bar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 32px;
        position: sticky;
        top: 80px;
        z-index: 10;
        padding: 10px 0;
        background: rgba(248, 250, 252, 0.85);
        backdrop-filter: blur(8px);
    }

    .profil-nav-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #334155;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        padding: 10px 20px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.05);
    }

    .profil-nav-link span {
        font-size: 16px;
        transition: transform 0.25s ease;
    }

    .profil-nav-link:hover {
        background: #0f766e;
        color: #ffffff !important;
        border-color: #0f766e;
        transform: translateY(-4px) scale(1.05);
        box-shadow: 0 10px 25px rgba(15, 118, 110, 0.25);
    }

    .profil-nav-link:hover span {
        transform: scale(1.3);
    }

    /* CARD SECTION (EFEK MENGEMBANG BOUNCE) */

    .user-section-card {
        background: #ffffff;
        border: 1px solid var(--border);
        border-radius: 22px;
        padding: 32px;
        margin-bottom: 30px;
        box-shadow: 0 6px 25px rgba(15, 23, 42, 0.04);
        scroll-margin-top: 130px;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s ease, border-color 0.3s ease;
    }

    .user-section-card:hover {
        transform: translateY(-6px) scale(1.01);
        box-shadow: 0 20px 45px rgba(15, 118, 110, 0.12);
        border-color: #0f766e;
    }

    .user-section-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid var(--green-soft);
    }

    .user-section-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: var(--green-soft);
        color: var(--green);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        flex-shrink: 0;
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.1);
    }

    .user-section-header h2 {
        margin: 0;
        font-size: 22px;
        font-weight: 800;
        color: var(--text);
    }

    .user-section-content {
        font-size: 15px;
        line-height: 1.8;
        color: #475569;
        white-space: pre-line;
    }

    /* KEPALA DESA CARD MEWAH */

    .kades-card {
        display: grid;
        grid-template-columns: 220px 1fr;
        gap: 30px;
        align-items: center;
        background: linear-gradient(135deg, #f0fdf4 0%, #ecfeff 100%);
        border-radius: 20px;
        padding: 28px;
        border: 1.5px solid #a7f3d0;
        box-shadow: 0 10px 30px rgba(15, 118, 110, 0.08);
    }

    .kades-photo {
        width: 100%;
        height: 250px;
        border-radius: 16px;
        overflow: hidden;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 65px;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.1);
        border: 2px solid #ffffff;
    }

    .kades-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .kades-info h3 {
        margin: 0 0 8px;
        font-size: 26px;
        font-weight: 900;
        color: #0f172a;
    }

    .kades-info .kades-title {
        display: inline-block;
        font-size: 12px;
        font-weight: 800;
        color: #0f766e;
        background: #ccfbf1;
        padding: 6px 14px;
        border-radius: 999px;
        margin-bottom: 14px;
        letter-spacing: 0.5px;
    }

    /* VISI MISI GRID WARNA-WARNI HARMONIS */

    .visi-misi-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 22px;
    }

    .visi-box, .misi-box {
        padding: 28px;
        border-radius: 20px;
        transition: transform 0.3s ease;
    }

    .visi-box {
        background: linear-gradient(145deg, #f0fdf4 0%, #dcfce7 100%);
        border-left: 6px solid #10b981;
        border-top: 1px solid #bbf7d0;
        border-right: 1px solid #bbf7d0;
        border-bottom: 1px solid #bbf7d0;
    }

    .misi-box {
        background: linear-gradient(145deg, #ecfeff 0%, #cffafe 100%);
        border-left: 6px solid #0891b2;
        border-top: 1px solid #a5f3fc;
        border-right: 1px solid #a5f3fc;
        border-bottom: 1px solid #a5f3fc;
    }

    .visi-box h3 { margin: 0 0 12px; font-size: 19px; font-weight: 800; color: #047857; }
    .misi-box h3 { margin: 0 0 12px; font-size: 19px; font-weight: 800; color: #0e7490; }

    .image-preview-container {
        text-align: center;
        background: #ffffff;
        padding: 18px;
        border-radius: 18px;
        border: 1px solid var(--border);
        margin-top: 18px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
    }

    .image-preview-container img {
        max-width: 100%;
        height: auto;
        border-radius: 14px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    }

    /* =========================================================
       BAGAN STRUKTUR ORGANISASI PERANGKAT DESA (TREE DIAGRAM)
       ========================================================= */

    .org-chart-wrapper {
        width: 100%;
        overflow-x: auto;
        padding: 20px 5px 30px;
    }

    .org-chart-tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        min-width: 750px;
        margin: 0 auto;
    }

    .org-level-row {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        width: 100%;
    }

    .org-level-connector {
        width: 3px;
        height: 32px;
        background: var(--green);
        margin: 0 auto;
    }

    .org-nodes-wrapper {
        display: flex;
        justify-content: center;
        gap: 24px;
        position: relative;
        padding-top: 16px;
        width: 100%;
        flex-wrap: nowrap;
    }

    .org-nodes-wrapper.has-multiple::before {
        content: "";
        position: absolute;
        top: 0;
        left: 10%;
        right: 10%;
        height: 3px;
        background: var(--green);
    }

    .org-column-group {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    .org-nodes-wrapper.has-multiple .org-column-group::before {
        content: "";
        position: absolute;
        top: -16px;
        width: 3px;
        height: 16px;
        background: var(--green);
    }

    /* KOTAK ATASAN UTAMA */
    .org-box {
        display: flex;
        align-items: center;
        gap: 14px;
        background: #ffffff;
        border: 2px solid var(--green);
        border-radius: 16px;
        padding: 12px 16px;
        min-width: 230px;
        max-width: 280px;
        box-shadow: 0 6px 20px rgba(15, 118, 110, 0.08);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .org-box:hover {
        transform: translateY(-4px) scale(1.03);
        box-shadow: 0 12px 30px rgba(15, 118, 110, 0.18);
        background: var(--green-soft);
    }

    .org-level-row[data-level="1"] .org-box {
        border-width: 3px;
        background: var(--green-soft);
        min-width: 260px;
    }

    .org-photo {
        width: 52px;
        height: 64px;
        border-radius: 10px;
        overflow: hidden;
        background: #fff;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1.5px solid var(--green-border);
        color: var(--green);
        font-weight: 800;
        font-size: 20px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.06);
    }

    .org-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .org-details {
        display: flex;
        flex-direction: column;
        text-align: left;
        min-width: 0;
    }

    .org-position {
        font-size: 11px;
        font-weight: 900;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        color: var(--green-dark);
        line-height: 1.3;
        margin-bottom: 2px;
    }

    .org-name {
        font-size: 13px;
        font-weight: 800;
        color: var(--text);
        line-height: 1.3;
        word-break: break-word;
    }

    /* KOTAK SUB-BAWAHAN (3.1, 3.2, 4.1, DLL) */
    .org-sub-connector {
        width: 2px;
        height: 20px;
        background: var(--green);
        margin: 0 auto;
    }

    .org-sub-nodes {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }

    .org-sub-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #ffffff;
        border: 1px dashed var(--green);
        border-radius: 14px;
        padding: 10px 14px;
        min-width: 210px;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.03);
        transition: transform 0.3s ease;
    }

    .org-sub-box:hover {
        transform: translateY(-2px);
        background: var(--green-soft);
    }

    .org-sub-box .org-photo {
        width: 42px;
        height: 50px;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .pub-hero-inner {
            flex-direction: column;
            align-items: flex-start;
        }
        .pub-hero-icon {
            display: none;
        }
        .kades-card {
            grid-template-columns: 1fr;
            text-align: center;
        }

        .kades-photo {
            height: 250px;
            max-width: 220px;
            margin: 0 auto;
        }

        .visi-misi-grid {
            grid-template-columns: 1fr;
        }

        .profil-nav-bar {
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 12px;
            -webkit-overflow-scrolling: touch;
        }

        .profil-nav-link {
            flex-shrink: 0;
        }
    }
</style>

<div class="public-profil-page">

    
    <section class="pub-hero">
        <div class="public-container pub-hero-inner">
            <div>
                <span class="section-label" style="color: #fff; font-weight: 800;">INFORMASI RESMI DESA</span>
                <h1><?php echo e($pageTitle ?? ('Profil ' . ($desa->name ?? ($activeDesa->name ?? 'Desa Waha')))); ?></h1>
                <p>Mengenal lebih dekat identitas, sejarah, peta wilayah, visi misi, dan bagan perangkat desa.</p>
            </div>

            <div class="pub-hero-icon">🏛️</div>
        </div>
    </section>

    <div class="public-container">

        <!-- 
        <nav class="profil-nav-bar">
            <a href="#tentang" class="profil-nav-link"><span>🏡</span> Tentang Desa</a>
            <a href="#kepala-desa" class="profil-nav-link"><span>👤</span> Kepala Desa</a>
            <a href="#sejarah" class="profil-nav-link"><span>📜</span> Sejarah</a>
            <a href="#visi-misi" class="profil-nav-link"><span>🎯</span> Visi & Misi</a>
            <a href="#peta" class="profil-nav-link"><span>🗺️</span> Peta Wilayah</a>
            <a href="#struktur" class="profil-nav-link"><span>🏢</span> Struktur Bagan</a>
            <a href="#perangkat" class="profil-nav-link"><span>👥</span> Perangkat Desa</a>
        </nav> -->

        
        <section id="tentang" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">🏡</div>
                <h2>Tentang Desa</h2>
            </div>
            <div class="user-section-content">
                <?php echo e($desa->description ?? ($activeDesa->description ?? 'Informasi tentang desa belum diisi.')); ?>

            </div>
        </section>

        
        <section id="kepala-desa" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">👤</div>
                <h2>Profil Kepala Desa</h2>
            </div>
            <div class="kades-card">
                <div class="kades-photo">
                    <?php if(!empty($desa->head_photo)): ?>
                        <img src="<?php echo e(asset(ltrim($desa->head_photo, '/'))); ?>" alt="<?php echo e($desa->head_name ?? 'Kepala Desa'); ?>">
                    <?php elseif(!empty($activeDesa->head_photo)): ?>
                        <img src="<?php echo e(asset(ltrim($activeDesa->head_photo, '/'))); ?>" alt="<?php echo e($activeDesa->head_name ?? 'Kepala Desa'); ?>">
                    <?php else: ?> 
                        👤 
                    <?php endif; ?>
                </div>
                <div class="kades-info">
                    <span class="kades-title">Kepala Desa <?php echo e($desa->name ?? ($activeDesa->name ?? 'Desa Waha')); ?></span>
                    <h3><?php echo e($desa->head_name ?? ($activeDesa->head_name ?? 'Belum diatur')); ?></h3>
                    <p class="user-section-content" style="margin:0;">
                        Selamat datang di portal informasi resmi Desa <?php echo e($desa->name ?? ($activeDesa->name ?? 'Desa Waha')); ?>. Kami siap melayani masyarakat secara maksimal.
                    </p>
                </div>
            </div>
        </section>

        
        <section id="sejarah" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">📜</div>
                <h2>Sejarah Desa</h2>
            </div>
            <div class="user-section-content">
                <?php echo e($desa->history ?? ($activeDesa->history ?? 'Informasi sejarah desa belum diisi.')); ?>

            </div>
        </section>

        
        <section id="visi-misi" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">🎯</div>
                <h2>Visi & Misi Desa</h2>
            </div>
            <div class="visi-misi-grid">
                <div class="visi-box">
                    <h3>🎯 Visi Desa</h3>
                    <div class="user-section-content"><?php echo e($desa->vision ?? ($activeDesa->vision ?? 'Visi desa belum diisi.')); ?></div>
                </div>
                <div class="misi-box">
                    <h3>🚀 Misi Desa</h3>
                    <div class="user-section-content"><?php echo e($desa->mission ?? ($activeDesa->mission ?? 'Misi desa belum diisi.')); ?></div>
                </div>
            </div>
        </section>

        
        <section id="peta" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">🗺️</div>
                <h2>Peta & Batas Wilayah</h2>
            </div>
            <div class="user-section-content"><?php echo e($desa->boundaries ?? ($activeDesa->boundaries ?? 'Informasi batas wilayah belum diisi.')); ?></div>
            
            <?php
                $mapImg = !empty($desa->map_image) ? $desa->map_image : (!empty($activeDesa->map_image) ? $activeDesa->map_image : null);
            ?>

            <?php if($mapImg): ?>
                <div class="image-preview-container">
                    <img src="<?php echo e(asset(ltrim($mapImg, '/'))); ?>" alt="Peta Desa <?php echo e($desa->name ?? ($activeDesa->name ?? 'Desa')); ?>">
                </div>
            <?php endif; ?>
        </section>

        
        <section id="struktur" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">🏢</div>
                <h2>Struktur Organisasi Desa</h2>
            </div>
            
            <?php
                $structImg = !empty($desa->structure_image) ? $desa->structure_image : (!empty($activeDesa->structure_image) ? $activeDesa->structure_image : null);
            ?>

            <?php if($structImg): ?>
                <div class="image-preview-container">
                    <img src="<?php echo e(asset(ltrim($structImg, '/'))); ?>" alt="Struktur Organisasi <?php echo e($desa->name ?? ($activeDesa->name ?? 'Desa')); ?>">
                </div>
            <?php else: ?>
                <div class="user-section-content" style="text-align: center; color: var(--muted);">
                    Gambar bagan struktur organisasi belum diunggah.
                </div>
            <?php endif; ?>
        </section>

        
        <section id="perangkat" class="user-section-card">
            <div class="user-section-header">
                <div class="user-section-icon">👥</div>
                <h2>Bagan Struktur Perangkat Desa</h2>
            </div>

            <?php
                $activeStructures = isset($structures) ? $structures->where('active', true) : collect();

                $majorLevels = $activeStructures->groupBy(function($item) {
                    $parts = explode('.', (string)$item->sort_order);
                    return (int)$parts[0];
                })->sortKeys();
            ?>

            <?php if($majorLevels->count()): ?>

                <div class="org-chart-wrapper">
                    <div class="org-chart-tree">

                        <?php $__currentLoopData = $majorLevels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $majorNum => $levelItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="org-level-row" data-level="<?php echo e($majorNum); ?>">

                                <?php if(!$loop->first): ?>
                                    <div class="org-level-connector"></div>
                                <?php endif; ?>

                                <?php
                                    $mainItems = $levelItems->filter(function($i) use ($majorNum) {
                                        return (string)$i->sort_order === (string)$majorNum;
                                    })->values();

                                    if ($mainItems->isEmpty()) {
                                        $mainItems = $levelItems->values();
                                    }
                                ?>

                                <div class="org-nodes-wrapper <?php echo e($mainItems->count() > 1 ? 'has-multiple' : ''); ?>">

                                    <?php $__currentLoopData = $mainItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemIndex => $mainItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php
                                            $subCode = $majorNum . '.' . ($itemIndex + 1);

                                            $subItems = $levelItems->filter(function($i) use ($subCode) {
                                                return (string)$i->sort_order === $subCode;
                                            });
                                        ?>

                                        <div class="org-column-group">

                                            <div class="org-node-item">
                                                <div class="org-box">
                                                    <div class="org-photo">
                                                        <?php if(!empty($mainItem->photo)): ?>
                                                            <img src="<?php echo e(asset(ltrim($mainItem->photo, '/'))); ?>" alt="<?php echo e($mainItem->name); ?>">
                                                        <?php else: ?>
                                                            <?php echo e(\Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($mainItem->name, 0, 1))); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="org-details">
                                                        <span class="org-position"><?php echo e($mainItem->position); ?></span>
                                                        <span class="org-name"><?php echo e($mainItem->name); ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <?php if($subItems->count()): ?>
                                                <div class="org-sub-connector"></div>
                                                <div class="org-sub-nodes">
                                                    <?php $__currentLoopData = $subItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="org-sub-box">
                                                            <div class="org-photo">
                                                                <?php if(!empty($subItem->photo)): ?>
                                                                    <img src="<?php echo e(asset(ltrim($subItem->photo, '/'))); ?>" alt="<?php echo e($subItem->name); ?>">
                                                                <?php else: ?>
                                                                    <?php echo e(\Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($subItem->name, 0, 1))); ?>

                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="org-details">
                                                                <span class="org-position"><?php echo e($subItem->position); ?></span>
                                                                <span class="org-name"><?php echo e($subItem->name); ?></span>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            <?php endif; ?>

                                        </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                </div>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>
                </div>

            <?php else: ?>

                <div class="user-section-content" style="text-align: center; color: var(--muted); padding: 30px 0;">
                    Belum ada data perangkat desa yang diinput.
                </div>

            <?php endif; ?>

        </section>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/profil-desa-tabbed.blade.php ENDPATH**/ ?>