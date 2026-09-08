<?php $__env->startSection('title', 'Perangkat Desa'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .structure-admin-wrap{display:grid;grid-template-columns:minmax(300px,.75fr) minmax(0,1.25fr);gap:24px;align-items:start}
    .structure-admin-card{background:#fff;border:1px solid #e4e9e5;border-radius:22px;padding:24px;box-shadow:0 14px 40px rgba(15,23,42,.06)}
    .structure-admin-card h2{margin:0 0 7px;font-size:21px;color:#17251d}
    .structure-admin-card p{margin:0;color:#64748b;font-size:13px;line-height:1.65}
    .structure-form{margin-top:22px;display:grid;gap:15px}
    .structure-field{display:grid;gap:7px}
    .structure-field label{font-size:13px;font-weight:800;color:#334155}
    .structure-field input{width:100%;box-sizing:border-box;border:1px solid #d9e2dc;border-radius:12px;padding:12px 13px;background:#fbfdfb;font:inherit}
    .structure-field input:focus{outline:none;border-color:#3f7f58;box-shadow:0 0 0 4px rgba(63,127,88,.10)}
    .structure-help{font-size:12px;color:#64748b}
    .structure-submit{border:0;border-radius:13px;background:#166534;color:#fff;padding:13px 16px;font-weight:800;cursor:pointer}
    .structure-table-wrap{overflow:auto;margin-top:20px}
    .structure-table{width:100%;border-collapse:collapse;min-width:760px}
    .structure-table th{background:#f5f8f6;color:#475569;text-align:left;font-size:12px;padding:12px;border-bottom:1px solid #e5ebe7}
    .structure-table td{padding:13px 12px;border-bottom:1px solid #edf1ee;vertical-align:middle}
    .structure-thumb{width:54px;height:62px;object-fit:cover;border-radius:9px;border:1px solid #e1e7e3;background:#f1f5f2}
    .structure-empty{text-align:center;padding:35px!important;color:#64748b}
    .structure-actions{display:flex;gap:7px;flex-wrap:wrap}
    .structure-action{border:0;border-radius:9px;padding:8px 10px;font-size:12px;font-weight:800;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;gap:5px}
    .structure-edit{background:#eef6ff;color:#1d4ed8}.structure-toggle{background:#fff7ed;color:#c2410c}.structure-delete{background:#fef2f2;color:#b91c1c}
    .structure-status{display:inline-flex;border-radius:999px;padding:5px 9px;font-size:11px;font-weight:800}.structure-status.on{background:#dcfce7;color:#166534}.structure-status.off{background:#f1f5f9;color:#64748b}
    .structure-preview{margin-top:24px;background:linear-gradient(135deg,#f7fbf8,#eef7f0);border:1px solid #dce9df;border-radius:18px;padding:17px}
    .structure-preview h3{margin:0 0 5px;font-size:15px}.structure-preview p{margin:0 0 12px}.structure-preview a{color:#166534;font-weight:800;text-decoration:none}
    .structure-edit-row{display:none;background:#fafcfb}.structure-edit-row.open{display:table-row}
    .structure-edit-form{display:grid;grid-template-columns:90px 1fr 1fr 1fr auto;gap:9px;align-items:end;padding:12px 0}
    .structure-edit-form input{width:100%;box-sizing:border-box;padding:9px;border:1px solid #dbe4de;border-radius:9px}
    .structure-edit-form label{font-size:10px;font-weight:800;color:#64748b;display:block;margin-bottom:4px}
    .structure-file{font-size:11px}
    @media(max-width:1050px){.structure-admin-wrap{grid-template-columns:1fr}.structure-edit-form{grid-template-columns:1fr 1fr}}
    @media(max-width:650px){.structure-edit-form{grid-template-columns:1fr}.structure-admin-card{padding:18px}}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-page">
    <div class="admin-page-header">
        <div>
            <span class="section-label">PROFIL DESA</span>
            <h1>Perangkat Desa</h1>
            <p>Kelola nomor urut, nama, jabatan, dan foto perangkat desa. Nomor urut menentukan tingkat struktur; nomor yang sama akan tampil sejajar pada tingkat yang sama.</p>
        </div>
        <a href="<?php echo e(route('perangkat-desa')); ?>" target="_blank" class="admin-primary-button">Lihat Bagan ↗</a>
    </div>

    <?php if(session('success')): ?>
        <div class="admin-alert admin-alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="admin-alert admin-alert-error"><strong>Terdapat kesalahan:</strong><ul><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
    <?php endif; ?>

    <div class="structure-admin-wrap">
        <section class="structure-admin-card">
            <h2>Tambah Perangkat Desa</h2>
            <p>Form ini mengikuti dokumen input yang Anda berikan: No urut, Nama, Jabatan, dan Upload foto. fileciteturn1file0L2-L8</p>

            <form class="structure-form" action="<?php echo e(route('admin.perangkat-desa.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="structure-field"><label for="sort_order">No urut / Tingkat *</label><input id="sort_order" type="number" name="sort_order" min="1" required value="<?php echo e(old('sort_order')); ?>" placeholder="1"><span class="structure-help">Contoh: 1 = tingkat pertama, 2 = di bawah 1, 3 = di bawah 2. Jika dua data sama-sama bernomor 3, keduanya sejajar.</span></div>
                <div class="structure-field"><label for="name">Nama *</label><input id="name" type="text" name="name" maxlength="255" required value="<?php echo e(old('name')); ?>" placeholder="Contoh: Nama Lengkap"></div>
                <div class="structure-field"><label for="position">Jabatan *</label><input id="position" type="text" name="position" maxlength="255" required value="<?php echo e(old('position')); ?>" placeholder="Contoh: Kepala Desa"></div>
                <div class="structure-field"><label for="photo">Upload foto</label><input id="photo" type="file" name="photo" accept="image/jpeg,image/png,image/webp"><span class="structure-help">JPG, JPEG, PNG atau WEBP. Maksimal 3 MB.</span></div>
                <button class="structure-submit" type="submit">＋ SIMPAN PERANGKAT DESA</button>
            </form>

            <div class="structure-preview">
                <h3>Bagan akan diperbarui otomatis</h3>
                <p>Foto, nama, jabatan, dan urutan akan langsung dipakai pada halaman publik.</p>
                <a href="<?php echo e(route('perangkat-desa')); ?>" target="_blank">Buka halaman Perangkat Desa →</a>
            </div>
        </section>

        <section class="structure-admin-card">
            <h2>Data Perangkat Desa</h2>
            <p>Urutan tabel mengikuti nomor urut yang Anda masukkan.</p>
            <div class="structure-table-wrap">
                <table class="structure-table">
                    <thead><tr><th>No urut</th><th>Nama</th><th>Jabatan</th><th>Foto</th><th>Waktu submit</th><th>Status</th><th>Aksi</th></tr></thead>
                    <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $structures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><strong><?php echo e($item->sort_order); ?></strong></td>
                            <td><strong><?php echo e($item->name); ?></strong></td>
                            <td><?php echo e($item->position); ?></td>
                            <td><?php if($item->photo): ?><img class="structure-thumb" src="<?php echo e(asset($item->photo)); ?>" alt="Foto <?php echo e($item->name); ?>"><?php else: ?><span class="structure-help">Belum ada foto</span><?php endif; ?></td>
                            <td><?php echo e($item->created_at?->format('d/m/Y H:i')); ?></td>
                            <td><span class="structure-status <?php echo e($item->active ? 'on' : 'off'); ?>"><?php echo e($item->active ? 'Aktif' : 'Nonaktif'); ?></span></td>
                            <td><div class="structure-actions"><button type="button" class="structure-action structure-edit" onclick="toggleStructureEdit(<?php echo e($item->id); ?>)">✏️ Edit</button><form method="POST" action="<?php echo e(route('admin.perangkat-desa.toggle',$item)); ?>"><?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?><button class="structure-action structure-toggle" type="submit"><?php echo e($item->active ? 'Sembunyikan' : 'Aktifkan'); ?></button></form><form method="POST" action="<?php echo e(route('admin.perangkat-desa.destroy',$item)); ?>" onsubmit="return confirm('Hapus data perangkat desa ini?')"><?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?><button class="structure-action structure-delete" type="submit">🗑️ Hapus</button></form></div></td>
                        </tr>
                        <tr id="edit-<?php echo e($item->id); ?>" class="structure-edit-row">
                            <td colspan="7">
                                <form class="structure-edit-form" action="<?php echo e(route('admin.perangkat-desa.update',$item)); ?>" method="POST" enctype="multipart/form-data">
                                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                    <div><label>No urut</label><input type="number" name="sort_order" min="1" value="<?php echo e($item->sort_order); ?>" required></div>
                                    <div><label>Nama</label><input type="text" name="name" value="<?php echo e($item->name); ?>" required></div>
                                    <div><label>Jabatan</label><input type="text" name="position" value="<?php echo e($item->position); ?>" required></div>
                                    <div><label>Ganti foto</label><input class="structure-file" type="file" name="photo" accept="image/jpeg,image/png,image/webp"></div>
                                    <button class="structure-submit" type="submit">Simpan</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr><td class="structure-empty" colspan="7">Belum ada data perangkat desa. Silakan masukkan data pertama melalui form di sebelah kiri.</td></tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function toggleStructureEdit(id){
    const row=document.getElementById('edit-'+id);
    if(row) row.classList.toggle('open');
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/perangkat-desa/index.blade.php ENDPATH**/ ?>