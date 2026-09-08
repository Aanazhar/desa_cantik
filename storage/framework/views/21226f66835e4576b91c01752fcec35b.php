

<?php $__env->startSection('title', 'Kelola Berita Desa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* =========================================================
       BERITA DESA - ADMIN MANAGEMENT
       ========================================================= */

    /* HERO BANNER ADMIN */
    .pub-admin-hero {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        padding: 26px;
        border-radius: 22px;
        background: linear-gradient(135deg, #0f766e, #155e75);
        color: #fff;
        margin-bottom: 20px;
    }

    .pub-admin-hero h1 {
        margin: 5px 0;
        font-size: 1.8rem;
        font-weight: 800;
    }

    .pub-admin-hero p {
        margin: 0;
        opacity: .9;
        font-size: 0.95rem;
    }

    .pub-admin-add {
        background: #fff;
        color: #0f766e;
        padding: 11px 18px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        white-space: nowrap;
        transition: .2s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    .pub-admin-add:hover {
        background: #e6f4f1;
        transform: translateY(-1px);
    }

    /* TAB FILTER ADMIN */
    .admin-news-tabs {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        align-items: center;
    }

    .admin-news-tabs a {
        padding: 9px 16px;
        border-radius: 999px;
        background: #fff;
        border: 1px solid #cbd5e1;
        text-decoration: none;
        color: #475569;
        font-weight: 700;
        font-size: 0.88rem;
        transition: .2s ease;
    }

    .admin-news-tabs a.active {
        background: #0f766e;
        color: #fff;
        border-color: #0f766e;
    }

    /* TABEL KONTEN BERITA */
    .pub-admin-table {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.03);
    }

    .pub-admin-row {
        display: grid;
        grid-template-columns: 70px 1.5fr .8fr .7fr .8fr 170px;
        gap: 14px;
        align-items: center;
        padding: 15px 18px;
        border-bottom: 1px solid #edf1f1;
    }

    .pub-admin-row:last-child {
        border-bottom: 0;
    }

    .pub-admin-head {
        font-weight: 800;
        background: #f6f9f9;
        color: #153f3f;
    }

    .pub-thumb {
        width: 60px;
        height: 48px;
        border-radius: 10px;
        object-fit: cover;
    }

    .pub-thumb-empty {
        width: 60px;
        height: 48px;
        border-radius: 10px;
        background: #e8f3f2;
        display: grid;
        place-items: center;
        font-size: 20px;
    }

    .pub-title strong {
        display: block;
        color: #153f3f;
        font-size: 0.95rem;
    }

    .pub-title small {
        display: block;
        color: #7a8585;
        margin-top: 4px;
        font-size: 0.82rem;
        line-height: 1.4;
    }

    .pub-badge {
        display: inline-block;
        padding: 6px 10px;
        border-radius: 999px;
        font-size: .75rem;
        font-weight: 800;
        background: #eef2f2;
        color: #64748b;
    }

    .pub-badge.published {
        background: #dcfce7;
        color: #166534;
    }

    /* TOMBOL AKSI */
    .pub-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
    }

    .pub-actions a,
    .pub-actions button {
        border: 0;
        border-radius: 99px;
        padding: 8px 12px;
        text-decoration: none;
        font-size: .8rem;
        font-weight: 700;
        cursor: pointer;
    }

    .pub-edit {
        background: #e7f1f5;
        color: #155e75;
    }

    .pub-delete {
        background: #fee2e2;
        color: #991b1b;
    }

    @media (max-width: 900px) {
        .pub-admin-head { display: none; }
        .pub-admin-row { grid-template-columns: 60px 1fr; }
        .pub-admin-row > *:nth-child(3),
        .pub-admin-row > *:nth-child(4),
        .pub-admin-row > *:nth-child(5) { display: none; }
        .pub-actions { grid-column: 2; }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    
    <div class="pub-admin-hero">
        <div>
            <span class="admin-eyebrow" style="color: #fff; opacity: .8">KONTEN BERITA DESA</span>
            <h1>Kelola Berita Desa</h1>
            <p>Kelola berita resmi, liputan kegiatan masyarakat, dan kabar terbaru desa.</p>
        </div>
        <a class="pub-admin-add" href="<?php echo e(route('admin.berita.create')); ?>">
            ＋ Tambah Berita Baru
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="admin-alert admin-alert-success" style="background: #dcfce7; color: #166534; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="admin-news-tabs">
        <a href="<?php echo e(route('admin.berita.index')); ?>" class="active">
            📰 Khusus Berita Desa
        </a>
        <!-- <a href="<?php echo e(route('admin.publikasi.index')); ?>">
            📚 Semua Publikasi & Dokumen
        </a> -->
        <a href="<?php echo e(route('berita')); ?>" target="_blank" style="margin-left: auto; background: #edf6f5; color: #0f766e; border-color: #0f766e;">
            👁️ Lihat Halaman Publik Berita ↗
        </a>
    </div>

    
    <div class="pub-admin-table">
        
        <div class="pub-admin-row pub-admin-head">
            <span>Gambar</span>
            <span>Judul Berita</span>
            <span>Kategori</span>
            <span>Status</span>
            <span>Tanggal Terbit</span>
            <span>Aksi</span>
        </div>

        
        <?php $__empty_1 = true; $__currentLoopData = $publikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="pub-admin-row">
                <span>
                    <?php if($publication->image): ?>
                        <img class="pub-thumb" src="<?php echo e(asset(ltrim($publication->image, '/'))); ?>" alt="<?php echo e($publication->title); ?>">
                    <?php else: ?>
                        <div class="pub-thumb-empty">📰</div>
                    <?php endif; ?>
                </span>

                <div class="pub-title">
                    <strong><?php echo e($publication->title); ?></strong>
                    <small><?php echo e(\Illuminate\Support\Str::limit($publication->excerpt ?: strip_tags($publication->content), 80)); ?></small>
                </div>

                <span><?php echo e($publication->category ?: 'Berita'); ?></span>

                <span>
                    <b class="pub-badge <?php echo e($publication->status); ?>">
                        <?php echo e(ucfirst($publication->status)); ?>

                    </b>
                </span>

                <span><?php echo e($publication->published_at?->format('d/m/Y') ?: $publication->created_at->format('d/m/Y')); ?></span>

                <div class="pub-actions">
                    <a class="pub-edit" href="<?php echo e(route('admin.publikasi.edit', $publication->id)); ?>">
                        Edit
                    </a>
                    <a class="pub-edit" href="<?php echo e(route('publikasi.show', $publication->id)); ?>" target="_blank">
                        Lihat
                    </a>

                    <form method="POST" action="<?php echo e(route('admin.publikasi.destroy', $publication->id)); ?>" onsubmit="return confirm('Hapus berita ini?')" style="display: inline;">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="pub-delete" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="padding: 60px; text-align: center;">
                <div style="font-size: 48px; margin-bottom: 10px;">📰</div>
                <h3>Belum ada berita yang dibuat</h3>
                <p style="color: #64748b; margin-bottom: 15px;">Mulai buat berita pertama Anda untuk ditampilkan di website.</p>
                <a class="pub-admin-add" href="<?php echo e(route('admin.berita.create')); ?>">
                    ＋ Tambah Berita Baru
                </a>
            </div>
        <?php endif; ?>
    </div>

    
    <?php if(method_exists($publikasi, 'hasPages') && $publikasi->hasPages()): ?>
        <div class="publication-pagination" style="margin-top: 20px;">
            <?php echo e($publikasi->links()); ?>

        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/berita/berita.blade.php ENDPATH**/ ?>