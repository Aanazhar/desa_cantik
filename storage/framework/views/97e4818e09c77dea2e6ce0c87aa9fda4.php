<?php $__env->startSection('title', 'Data & Statistik Desa - ' . ($activeDesa->name ?? 'Desa Waha')); ?>

<?php $__env->startPush('styles'); ?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

<style>
    /* GLOBAL FONT INTER */
    body, h1, h2, h3, h4, h5, h6, p, a, span, button, input, select, textarea {
        font-family: 'Inter', system-ui, -apple-system, sans-serif !important;
    }

    .data-page { 
        background: #f8fafc; 
        color: #1e293b; 
        padding-bottom: 80px; 
    }
    
    /* HERO BANNER */
    .data-desa-hero { 
        padding: 40px 0; 
        background: linear-gradient(135deg, #1e6660 0%, #3c6772 50%, #0a4c60 100%); 
        color: #ffffff; 
        margin-bottom: 35px; 
        box-shadow: 0 12px 35px rgba(15, 118, 110, 0.18); 
    }
    .data-desa-hero-inner { 
        display: flex; 
        justify-content: space-between; 
        align-items: center; 
        gap: 24px; 
        flex-wrap: wrap; 
    }
    .data-hero-eyebrow { 
        font-size: 11px; 
        font-weight: 800; 
        letter-spacing: 1.8px; 
        text-transform: uppercase; 
        background: rgba(255, 255, 255, 0.18); 
        backdrop-filter: blur(8px); 
        padding: 5px 14px; 
        border-radius: 20px; 
        color: #ffffff; 
        display: inline-block; 
        margin-bottom: 8px; 
        border: 1px solid rgba(255, 255, 255, 0.25); 
    }
    .data-desa-hero h1 { 
        font-size: clamp(1.6rem, 3.2vw, 2.3rem); 
        margin: 4px 0 6px; 
        font-weight: 800; 
        color: #ffffff; 
        letter-spacing: -0.5px; 
    }
    .data-desa-hero p { 
        margin: 0; 
        opacity: 0.95; 
        font-size: 0.95rem; 
        color: #e0f2fe; 
    }

    /* KONTROL PRESISI RAPI (TAHUN & EXPORT BUTTONS) */
    .data-hero-controls {
        display: flex;
        align-items: flex-end;
        gap: 14px;
        flex-wrap: wrap;
    }

    .control-year-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .control-year-group label {
        font-size: 0.78rem;
        font-weight: 800;
        color: #e0f2fe;
        text-transform: uppercase;
        letter-spacing: 0.8px;
    }

    .hero-year-select {
        padding: 10px 18px;
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.3);
        background: #ffffff;
        font-weight: 800;
        font-size: 0.92rem;
        color: #0f172a;
        cursor: pointer;
        outline: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .hero-year-select:hover {
        transform: translateY(-2px);
    }

    .btn-hero-export {
        padding: 10px 18px;
        border-radius: 12px;
        border: 1px solid #0f766e;
        background: #f0fdf4;
        color: #0f766e;
        font-weight: 800;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        height: 42px;
        box-sizing: border-box;
    }

    .btn-hero-export:hover {
        background: #0f766e;
        color: #ffffff;
        transform: translateY(-3px) scale(1.05);
        box-shadow: 0 8px 20px rgba(15, 118, 110, 0.25);
    }

    /* NAV TAB KATEGORI */
    .data-nav { 
        display: flex; 
        gap: 12px; 
        flex-wrap: wrap; 
        margin-bottom: 32px; 
    }
    .data-nav a { 
        padding: 11px 22px; 
        border-radius: 999px; 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        text-decoration: none; 
        color: #475569; 
        font-size: 0.92rem; 
        font-weight: 700; 
        transition: all 0.25s cubic-bezier(0.34, 1.56, 0.64, 1); 
        white-space: nowrap;
    }
    .data-nav a:hover {
        transform: translateY(-3px) scale(1.04);
        border-color: #0f766e;
        color: #0f766e;
    }
    .data-nav a.active { 
        background: #204d49; 
        color: #ffffff; 
        border-color: #1a5651; 
        box-shadow: 0 8px 22px rgba(15, 118, 110, 0.28); 
    }

    /* SUMMARY CARDS DENGAN EFEK MELAYANG & MENGEMBANG */
    .data-summary-grid { 
        display: grid; 
        grid-template-columns: repeat(4, 1fr); 
        gap: 20px; 
        margin-bottom: 35px; 
    }
    .summary-item { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 20px; 
        padding: 22px; 
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.03); 
        position: relative; 
        overflow: hidden; 
        transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .summary-item:hover {
        transform: translateY(-6px) scale(1.035);
        box-shadow: 0 16px 35px rgba(15, 118, 110, 0.15);
        border-color: #0f766e;
    }
    .summary-item::before { 
        content: ''; 
        position: absolute; 
        top: 0; 
        left: 0; 
        right: 0; 
        height: 4px; 
        background: linear-gradient(90deg, #0f766e, #0891b2); 
    }
    .summary-item span { 
        display: block; 
        color: #64748b; 
        font-size: 0.84rem; 
        font-weight: 700; 
        margin-bottom: 6px; 
    }
    .summary-item strong { 
        display: block; 
        font-size: 1.8rem; 
        color: #0f172a; 
        font-weight: 800; 
        line-height: 1.2; 
    }
    .summary-item small { 
        display: inline-block; 
        margin-top: 6px; 
        color: #0f766e; 
        font-weight: 700; 
        font-size: 0.78rem; 
        background: #e6f4f1; 
        padding: 3px 10px; 
        border-radius: 8px; 
    }

    /* LAYOUT GRAFIK */
    .data-chart-grid-three { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px; margin-bottom: 28px; }
    .data-chart-grid-two-unequal { display: grid; grid-template-columns: 1.5fr 1fr; gap: 24px; margin-bottom: 28px; }
    .data-chart-grid-two { display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px; margin-bottom: 28px; }
    .data-chart-grid-full { width: 100%; margin-bottom: 28px; }

    /* =====================================================
       KARTU GRAFIK 3D FLOATING & EXPANDING POP-UP EFFECT
    ===================================================== */
    .data-chart-card { 
        background: #ffffff; 
        border: 1px solid #e2e8f0; 
        border-radius: 24px; 
        padding: 24px; 
        box-shadow: 0 6px 25px rgba(15, 23, 42, 0.04); 
        transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.35s ease, border-color 0.3s ease;
        position: relative;
    }
    .data-chart-card:hover { 
        transform: translateY(-8px) scale(1.02); 
        box-shadow: 0 22px 45px rgba(15, 118, 110, 0.18), 0 8px 16px rgba(0, 0, 0, 0.04); 
        border-color: #0f766e; 
    }
    .data-chart-card h3 { 
        margin: 0 0 4px; 
        font-size: 1.15rem; 
        font-weight: 800; 
        color: #0f172a; 
    }
    .data-chart-card p { 
        color: #64748b; 
        font-size: 0.85rem; 
        margin: 0 0 16px; 
    }
    .data-chart-box { 
        min-height: 260px; 
        width: 100%; 
        transition: transform 0.3s ease;
    }
    .data-chart-card:hover .data-chart-box {
        transform: scale(1.015);
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    /* =====================================================
       RESPONSIVE MEDIA QUERIES (OPTIMAL UNTUK HP / ANDROID)
    ===================================================== */
    @media (max-width: 1024px) {
        .data-summary-grid { grid-template-columns: repeat(2, 1fr); }
        .data-chart-grid-three, .data-chart-grid-two-unequal, .data-chart-grid-two { grid-template-columns: 1fr; }
        .data-hero-controls { width: 100%; margin-top: 14px; }
    }

    @media (max-width: 768px) {
        .data-page { padding-bottom: 50px; }
        .data-desa-hero { padding: 26px 0 30px; margin-bottom: 22px; }
        .data-desa-hero-inner { flex-direction: column; align-items: flex-start; gap: 14px; }
        .data-hero-eyebrow { font-size: 10px; padding: 4px 10px; }
        .data-desa-hero h1 { font-size: clamp(1.4rem, 5vw, 1.8rem); }
        .data-desa-hero p { font-size: 0.88rem; }

        .data-hero-controls { width: 100%; gap: 10px; }
        .control-year-group { width: 100%; }
        .hero-year-select { width: 100%; text-align: center; }
        .btn-hero-export { flex: 1; text-align: center; justify-content: center; font-size: 0.82rem; padding: 9px 12px; }

        .data-nav {
            display: flex;
            gap: 8px;
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 8px;
            margin-bottom: 22px;
            -webkit-overflow-scrolling: touch;
        }

        .data-nav a {
            flex-shrink: 0;
            padding: 8px 16px;
            font-size: 0.82rem;
        }

        .data-summary-grid { grid-template-columns: repeat(2, 1fr); gap: 12px; margin-bottom: 22px; }
        .summary-item { padding: 16px; border-radius: 16px; }
        .summary-item span { font-size: 0.78rem; margin-bottom: 4px; }
        .summary-item strong { font-size: 1.4rem; }
        .summary-item small { font-size: 0.72rem; padding: 2px 7px; }

        .data-chart-card { padding: 18px; border-radius: 18px; margin-bottom: 18px; }
        .data-chart-card h3 { font-size: 1rem; }
        .data-chart-card p { font-size: 0.78rem; margin-bottom: 12px; }
        .data-chart-box { min-height: 230px; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<?php
    $currentCategory = $category ?? request('category', 'ringkasan');
?>

<div class="data-page">

    
    <section class="data-desa-hero">
        <div class="container data-desa-hero-inner">
            <div>
                <span class="data-hero-eyebrow">TRANSPARANSI DATA DESA</span>
                <h1>
                    <?php if($currentCategory === 'perumahan'): ?>
                        🏠 Data Perumahan & Fasilitas Desa
                    <?php elseif($currentCategory === 'jaminan_sosial'): ?>
                        🤝 Data Jaminan & Kesejahteraan Sosial
                    <?php elseif($currentCategory === 'sosial_demografis'): ?>
                        👥 Data Sosial Demografis Kependudukan
                    <?php else: ?>
                        📊 DATA <?php echo e(strtoupper($activeDesa->name ?? 'DESA WAHA')); ?>

                    <?php endif; ?>
                </h1>
                <p>Data resmi statistik desa tahun pendataan <?php echo e($selectedYear ?? date('Y')); ?>.</p>
            </div>

            
            <div class="data-hero-controls">
                <div class="control-year-group">
                    <label for="yearSelect">Tahun Pendataan</label>
                    <form method="GET" action="<?php echo e(route('data-desa')); ?>" style="margin:0;">
                        <?php if(request('category')): ?>
                            <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
                        <?php endif; ?>
                        <select id="yearSelect" name="year" onchange="this.form.submit()" class="hero-year-select">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($year); ?>" <?php if((int)$year === (int)$selectedYear): echo 'selected'; endif; ?>>Tahun <?php echo e($year); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </form>
                </div>

                <a class="btn-hero-export" href="<?php echo e(route('data-desa.export', ['format' => 'csv', 'year' => $selectedYear, 'category' => $currentCategory])); ?>">
                    ↓ Export CSV
                </a>

                <a class="btn-hero-export" href="<?php echo e(route('data-desa.export', ['format' => 'pdf', 'year' => $selectedYear, 'category' => $currentCategory])); ?>">
                    ↓ Export PDF
                </a>
            </div>
        </div>
    </section>

    <div class="container">

        
        <nav class="data-nav">
            <a href="<?php echo e(route('data-desa')); ?>" class="<?php echo e($currentCategory === 'ringkasan' ? 'active' : ''); ?>">
                📊 Ringkasan Data
            </a>
            <a href="<?php echo e(route('data-desa.category', 'perumahan')); ?>" class="<?php echo e($currentCategory === 'perumahan' ? 'active' : ''); ?>">
                🏠 Perumahan
            </a>
            <a href="<?php echo e(route('data-desa.category', 'jaminan_sosial')); ?>" class="<?php echo e($currentCategory === 'jaminan_sosial' ? 'active' : ''); ?>">
                🤝 Jaminan Sosial
            </a>
            <a href="<?php echo e(route('data-desa.category', 'sosial_demografis')); ?>" class="<?php echo e($currentCategory === 'sosial_demografis' ? 'active' : ''); ?>">
                👥 Sosial Demografis
            </a>
        </nav>

        
        <div class="data-summary-grid">
            <div class="summary-item">
                <span>👥 Total Penduduk</span>
                <strong><?php echo e(number_format((int)($displayStats['total_penduduk'] ?? 0), 0, ',', '.')); ?></strong>
                <small>Jiwa</small>
            </div>
            <div class="summary-item">
                <span>🏠 Kepala Keluarga</span>
                <strong><?php echo e(number_format((int)($displayStats['kepala_keluarga'] ?? 0), 0, ',', '.')); ?></strong>
                <small>KK</small>
            </div>
            <div class="summary-item">
                <span>👨 Laki-laki</span>
                <strong><?php echo e(number_format((int)($displayStats['laki_laki'] ?? 0), 0, ',', '.')); ?></strong>
                <small>Jiwa</small>
            </div>
            <div class="summary-item">
                <span>👩 Perempuan</span>
                <strong><?php echo e(number_format((int)($displayStats['perempuan'] ?? 0), 0, ',', '.')); ?></strong>
                <small>Jiwa</small>
            </div>
        </div>

        
        <div class="data-chart-grid-three">
            <div class="data-chart-card">
                <h3>🏠 Jumlah Bangunan</h3>
                <p>Kategori jenis bangunan desa</p>
                <div id="buildingChart" class="data-chart-box"></div>
            </div>

            <div class="data-chart-card">
                <h3>🏡 Status Tempat Tinggal</h3>
                <p>Status kepemilikan rumah warga</p>
                <div id="housingStatusChart" class="data-chart-box"></div>
            </div>

            <div class="data-chart-card">
                <h3>🏥 Fasilitas Utama</h3>
                <p>Fasilitas umum dan sosial</p>
                <div id="facilityChart" class="data-chart-box"></div>
            </div>
        </div>

        
        <div class="data-chart-grid-two-unequal">
            <div class="data-chart-card">
                <h3>📈 Perkembangan Jumlah Penduduk</h3>
                <p>Tren pertumbuhan jumlah penduduk tahunan</p>
                <div id="historyChart" class="data-chart-box"></div>
            </div>

            <div class="data-chart-card">
                <h3>📍 Penduduk per Dusun</h3>
                <p>Sebaran warga per wilayah dusun</p>
                <div id="villageChart" class="data-chart-box"></div>
            </div>
        </div>

        
        <div class="data-chart-grid-two">
            <div class="data-chart-card">
                <h3>👶 Kelompok Umur</h3>
                <p>Komposisi usia masyarakat desa</p>
                <div id="ageChart" class="data-chart-box"></div>
            </div>

            <div class="data-chart-card">
                <h3>💍 Status Perkawinan</h3>
                <p>Status pernikahan warga terdata</p>
                <div id="maritalChart" class="data-chart-box"></div>
            </div>
        </div>

        
        <div class="data-chart-grid-two">
            <div class="data-chart-card">
                <h3>🕌 Agama & Kepercayaan</h3>
                <p>Sebaran agama masyarakat</p>
                <div id="religionChart" class="data-chart-box"></div>
            </div>

            <div class="data-chart-card">
                <h3>🎓 Pendidikan</h3>
                <p>Jenjang pendidikan formal terakhir</p>
                <div id="educationChart" class="data-chart-box"></div>
            </div>
        </div>

        
        <div class="data-chart-grid-full">
            <div class="data-chart-card">
                <h3>💼 Mata Pencaharian / Pekerjaan</h3>
                <p>Sebaran mata pencaharian utama warga desa</p>
                <div id="jobChart" class="data-chart-box"></div>
            </div>
        </div>

    </div>
</div>


<?php if(session('error')): ?>
    <div id="fileUnavailableModal" style="position: fixed; inset: 0; background: rgba(15, 23, 42, 0.65); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; z-index: 99999; padding: 20px;">
        <div style="background: #ffffff; width: 100%; max-width: 440px; border-radius: 24px; padding: 30px; text-align: center; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); border: 1px solid #fecaca; animation: modalFadeIn 0.25s ease-out;">
            <div style="width: 68px; height: 68px; background: #fef2f2; color: #dc2626; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 34px; margin: 0 auto 18px; border: 2px solid #fca5a5;">
                📂
            </div>
            <h3 style="font-size: 1.25rem; font-weight: 800; color: #0f172a; margin: 0 0 10px; letter-spacing: -0.3px;">Berkas Belum Tersedia</h3>
            <p style="font-size: 0.92rem; color: #475569; line-height: 1.55; margin: 0 0 24px;">
                <?php echo e(session('error')); ?>

            </p>
            <button type="button" onclick="closeFileModal()" style="background: #0f766e; color: #ffffff; border: 0; padding: 13px 28px; border-radius: 14px; font-weight: 800; font-size: 0.94rem; cursor: pointer; transition: all 0.2s ease; width: 100%; box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3);">
                Siap, Saya Mengerti
            </button>
        </div>
    </div>

    <script>
        function closeFileModal() {
            var modal = document.getElementById('fileUnavailableModal');
            if (modal) {
                modal.style.opacity = '0';
                modal.style.transition = 'opacity 0.2s ease';
                setTimeout(function() { modal.style.display = 'none'; }, 200);
            }
            if (window.history.replaceState) {
                window.history.replaceState(null, '', window.location.pathname);
            }
        }
    </script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/data-charts.js')); ?>"></script>
<script>
    const d = <?php echo json_encode($displayStats, 15, 512) ?>;
    const histories = <?php echo json_encode($histories ?? [], 15, 512) ?>;
    const years = histories.map(h => h.tahun || 2025);
    const populationTrend = histories.map(h => parseInt((h.data && h.data.total_penduduk) || d.total_penduduk || 0));

    if (document.getElementById('buildingChart')) {
        DesaCharts.donut(document.getElementById('buildingChart'), ['Rumah Tinggal', 'Toko/Warung', 'Fasilitas Umum', 'Lainnya'], [d.rumah_tinggal || 876, d.toko || 156, d.fasilitas || 124, d.bangunan_lain || 46]);
    }
    if (document.getElementById('housingStatusChart')) {
        DesaCharts.donut(document.getElementById('housingStatusChart'), ['Milik Sendiri', 'Sewa/Kontrak', 'Bebas Sewa', 'Menumpang'], [d.rumah_sendiri || 750, d.rumah_sewa || 120, d.bebas_sewa || 50, d.menumpang || 30]);
    }
    if (document.getElementById('facilityChart')) {
        DesaCharts.donut(document.getElementById('facilityChart'), ['Sekolah', 'Posyandu', 'Puskesmas', 'Tempat Ibadah'], [d.sekolah || 0, d.posyandu || 0, d.puskesmas || 0, d.tempat_ibadah || 0]);
    }
    if (document.getElementById('historyChart')) {
        DesaCharts.line(document.getElementById('historyChart'), years.length ? years : ['2021', '2022', '2023', '2024', '2025'], [], [{ label: 'Jumlah Penduduk', values: populationTrend.length ? populationTrend : [1500, 1620, 1750, 1890, 2050], color: '#2563eb' }]);
    }
    if (document.getElementById('villageChart')) {
        DesaCharts.bar(document.getElementById('villageChart'), <?php echo json_encode($villages->pluck('nama_dusun')->values(), 15, 512) ?>, <?php echo json_encode($villages->pluck('jumlah_penduduk')->map(fn($v) => (int)$v)->values(), 15, 512) ?>, 'jiwa');
    }
    if (document.getElementById('ageChart')) {
        DesaCharts.bar(document.getElementById('ageChart'), ['Balita', 'Anak-anak', 'Remaja', 'Dewasa', 'Lansia'], [d.balita || 0, d.anak || 0, d.remaja || 0, d.dewasa || 0, d.lansia || 0]);
    }
    if (document.getElementById('maritalChart')) {
        DesaCharts.donut(document.getElementById('maritalChart'), ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati'], [d.belum_kawin || 450, d.kawin || 820, d.cerai_hidup || 45, d.cerai_mati || 65]);
    }
    if (document.getElementById('religionChart')) {
        DesaCharts.donut(document.getElementById('religionChart'), ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu', 'Lainnya'], [d.islam || 0, d.kristen || 0, d.katolik || 0, d.hindu || 0, d.buddha || 0, d.konghucu || 0, d.kepercayaan_lainnya || 0]);
    }
    if (document.getElementById('educationChart')) {
        DesaCharts.bar(document.getElementById('educationChart'), ['Belum Sekolah', 'SD', 'SMP', 'SMA/SMK', 'Diploma', 'S1/S2/S3'], [d.belum_sekolah || 0, d.sd || 0, d.smp || 0, d.sma || 0, d.diploma || 0, d.sarjana || 0]);
    }
    if (document.getElementById('jobChart')) {
        DesaCharts.bar(document.getElementById('jobChart'), ['Petani', 'Nelayan', 'Pedagang', 'Wiraswasta', 'PNS/TNI/Polri', 'Karyawan', 'Pelajar', 'Belum Bekerja'], [d.petani || 0, d.nelayan || 0, d.pedagang || 0, d.wiraswasta || 0, d.pns || 0, d.karyawan || 0, d.pelajar || 0, d.belum_bekerja || 0]);
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/data-desa.blade.php ENDPATH**/ ?>