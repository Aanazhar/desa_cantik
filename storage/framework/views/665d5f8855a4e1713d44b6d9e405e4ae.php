<?php $__env->startSection('title', 'Publikasi Desa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
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

    .pub-admin-hero h1 { margin: 5px 0; font-size: 1.8rem; font-weight: 800; }
    .pub-admin-hero p { margin: 0; opacity: .9; font-size: 0.95rem; }

    .pub-admin-add {
        background: #fff;
        color: #0f766e;
        padding: 11px 16px;
        border-radius: 12px;
        text-decoration: none;
        font-weight: 800;
        white-space: nowrap;
        transition: .2s ease;
    }

    .pub-admin-add:hover { background: #e6f4f1; }

    .pub-admin-toolbar {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        align-items: center;
        margin-bottom: 20px;
    }

    .pub-admin-toolbar select,
    .pub-admin-toolbar input {
        border: 1px solid #d7dfdf;
        border-radius: 12px;
        padding: 10px 12px;
        background: #fff;
        font-size: 0.9rem;
        outline: none;
    }

    .pub-admin-toolbar button {
        border: 0;
        border-radius: 12px;
        padding: 10px 15px;
        background: #0f766e;
        color: #fff;
        font-weight: 700;
        font-size: 0.9rem;
        cursor: pointer;
    }

    .pub-admin-table {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 20px;
        overflow: hidden;
    }

    .pub-admin-row {
        display: grid;
        grid-template-columns: 70px 1.5fr .8fr .7fr .8fr 170px;
        gap: 14px;
        align-items: center;
        padding: 15px 18px;
        border-bottom: 1px solid #edf1f1;
    }

    .pub-admin-row:last-child { border-bottom: 0; }
    .pub-admin-head { font-weight: 800; background: #f6f9f9; color: #153f3f; }
    .pub-thumb { width: 60px; height: 48px; border-radius: 10px; object-fit: cover; }
    .pub-thumb-empty { width: 60px; height: 48px; border-radius: 10px; background: #e8f3f2; display: grid; place-items: center; font-size: 20px; }

    .pub-title strong { display: block; color: #153f3f; font-size: 0.95rem; }
    .pub-title small { display: block; color: #7a8585; margin-top: 4px; font-size: 0.82rem; line-height: 1.4; }

    .pub-badge { display: inline-block; padding: 6px 9px; border-radius: 999px; font-size: .75rem; font-weight: 800; background: #eef2f2; color: #64748b; }
    .pub-badge.published { background: #dcfce7; color: #166534; }

    .pub-actions { display: flex; gap: 6px; flex-wrap: wrap; }
    .pub-actions a, .pub-actions button { border: 0; border-radius: 9px; padding: 8px 10px; text-decoration: none; font-size: .8rem; font-weight: 700; cursor: pointer; }
    .pub-edit { background: #e7f1f5; color: #155e75; }
    .pub-delete { background: #fee2e2; color: #991b1b; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <div class="pub-admin-hero">
        <div>
            <span class="admin-eyebrow" style="color: #fff; opacity: .8">PUSAT KONTEN DESA</span>
            <h1>Kelola Publikasi Desa</h1>
            <p>Kelola berkas publikasi, infografis, dan monografis resmi desa.</p>
        </div>
        <a class="pub-admin-add" href="<?php echo e(route('admin.publikasi.create')); ?>">
            ＋ Tambah Konten
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="admin-alert admin-alert-success">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form class="pub-admin-toolbar" method="GET">
        <select name="category" onchange="this.form.submit()">
            <option value="">Semua Kategori</option>
            <?php $__currentLoopData = ['Publikasi', 'Infografis', 'Monografis']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat); ?>" <?php if(request('category') === $cat): echo 'selected'; endif; ?>>
                    <?php echo e($cat); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>

        <button type="submit">Filter</button>

        <?php if(request('category')): ?>
            <a href="<?php echo e(route('admin.publikasi.index')); ?>" class="admin-btn">Reset</a>
        <?php endif; ?>

        <a href="<?php echo e(route('publikasi')); ?>" target="_blank" class="admin-btn">Lihat Publikasi User ↗</a>
    </form>

    <div class="pub-admin-table">
        <div class="pub-admin-row pub-admin-head">
            <span>Gambar</span>
            <span>Judul</span>
            <span>Kategori</span>
            <span>Status</span>
            <span>Tanggal</span>
            <span>Aksi</span>
        </div>

        <?php $__empty_1 = true; $__currentLoopData = $publikasi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $publication): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="pub-admin-row">
                <span>
                    <?php if($publication->image): ?>
                        <img class="pub-thumb" src="<?php echo e(asset(ltrim($publication->image, '/'))); ?>" alt="<?php echo e($publication->title); ?>">
                    <?php else: ?>
                        <div class="pub-thumb-empty">📄</div>
                    <?php endif; ?>
                </span>

                <div class="pub-title">
                    <strong><?php echo e($publication->title); ?></strong>
                    <small><?php echo e(\Illuminate\Support\Str::limit($publication->excerpt ?: strip_tags($publication->content), 80)); ?></small>
                </div>

                <span><strong style="color: #0f766e;"><?php echo e($publication->category ?: 'Publikasi'); ?></strong></span>

                <span>
                    <b class="pub-badge <?php echo e($publication->status); ?>">
                        <?php echo e(ucfirst($publication->status)); ?>

                    </b>
                </span>

                <span><?php echo e($publication->published_at?->format('d/m/Y') ?: 'Belum terbit'); ?></span>

                <div class="pub-actions">
                    <a class="pub-edit" href="<?php echo e(route('admin.publikasi.edit', $publication->id)); ?>">
                        Edit
                    </a>
                    <a class="pub-edit" href="<?php echo e(route('publikasi.show', $publication->id)); ?>" target="_blank">
                        Lihat
                    </a>

                    <form method="POST" action="<?php echo e(route('admin.publikasi.destroy', $publication->id)); ?>" onsubmit="return confirm('Hapus konten ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="pub-delete" type="submit">Hapus</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="padding: 60px; text-align: center;">
                <div style="font-size: 48px; margin-bottom: 10px;">📄</div>
                <h3>Belum ada publikasi</h3>
                <p style="color: #7a8585;">Tambahkan konten publikasi, infografis, atau monografis pertama Anda.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php if($publikasi->hasPages()): ?>
        <div class="publication-pagination" style="margin-top: 20px;">
            <?php echo e($publikasi->links()); ?>

        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/publikasi/index.blade.php ENDPATH**/ ?>