<?php $__env->startSection('title', 'Layanan Desa'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-page-header">
    <div>
        <span class="section-label">PELAYANAN</span>
        <h1>Kelola Layanan Desa</h1>
        <p>Buat layanan, atur nomor WhatsApp petugas, atur persyaratan, formulir, urutan menu, dan status tampilannya.</p>
    </div>
    <a class="admin-btn admin-btn-primary" href="<?php echo e(route('admin.pengajuan.index')); ?>">📥 Lihat Pengajuan</a>
</div>

<?php if(session('success')): ?>
    <div class="admin-alert admin-alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>
<?php if($errors->any()): ?>
    <div class="admin-alert admin-alert-error"><?php echo e($errors->first()); ?></div>
<?php endif; ?>


<?php
    $currentWa = \Illuminate\Support\Facades\DB::table('isi_situs')->where('desa_id', session('desa_id', 1))->where('key', 'no_whatsapp')->value('value') ?? '081234567890';
?>

<div class="admin-card" style="border-top: 4px solid #25d366; margin-bottom: 25px;">
    <div class="admin-card-header">
        <div>
            <h2 style="color: #166534;">📱 Nomor WhatsApp Petugas Pelayanan</h2>
            <p class="admin-card-description">Nomor WhatsApp ini digunakan warga untuk konfirmasi & menanyakan status surat di website.</p>
        </div>
        <div class="admin-card-icon" style="font-size: 28px;">💬</div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.layanan.whatsapp.update')); ?>">
        <?php echo csrf_field(); ?>
        <div class="admin-grid" style="grid-template-columns: 1fr auto; align-items: end; gap: 15px;">
            <div class="admin-form-group" style="margin: 0;">
                <label>Nomor WhatsApp Layanan Desa *</label>
                <input name="no_whatsapp" value="<?php echo e(old('no_whatsapp', $currentWa)); ?>" required placeholder="Contoh: 081234567890 atau 6281234567890" style="font-weight: 800; font-size: 1rem; color: #166534;">
                <small class="admin-form-help">Format: 08... atau 628... (Otomatis terhubung ke tombol WhatsApp warga di website).</small>
            </div>
            <div class="admin-form-group" style="margin: 0;">
                <button class="admin-btn admin-btn-primary" type="submit" style="background: #25d366; border-color: #25d366; padding: 11px 24px; font-weight: 800; cursor: pointer;">
                    💾 Simpan Nomor WA
                </button>
            </div>
        </div>
    </form>
</div>


<div class="admin-card service-admin-create" id="tambah-layanan">
    <div class="admin-card-header">
        <div>
            <h2>Tambah Layanan</h2>
            <p class="admin-card-description">Layanan dapat berupa informasi biasa atau layanan yang menerima pengajuan online.</p>
        </div>
        <div class="admin-card-icon">➕</div>
    </div>

    <form method="POST" action="<?php echo e(route('admin.layanan.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="admin-grid">
            <div class="admin-form-group">
                <label>Nama layanan *</label>
                <input name="title" required placeholder="Contoh: Surat Keterangan Domisili">
            </div>
            <div class="admin-form-group">
                <label>Ikon</label>
                <input name="icon" value="📄" maxlength="100">
            </div>
            <div class="admin-form-group">
                <label>Urutan menu</label>
                <input type="number" name="sort_order" value="0" min="0">
            </div>
            <div class="admin-form-group admin-check-card">
                <label><input type="checkbox" name="is_letter" value="1"> Layanan menerima pengajuan online</label>
            </div>
        </div>
        <div class="admin-form-group">
            <label>Deskripsi</label>
            <textarea name="description" rows="3" placeholder="Jelaskan fungsi layanan."></textarea>
        </div>
        <div class="admin-grid">
            <div class="admin-form-group">
                <label>Persyaratan dokumen</label>
                <textarea name="requirements" rows="7" placeholder="Satu dokumen per baris"></textarea>
                <small class="admin-form-help">Contoh: KTP pemohon, KK, surat pengantar RT/RW.</small>
            </div>
            <div class="admin-form-group">
                <label>Field formulir tambahan (JSON)</label>
                <textarea name="form_fields" rows="7" placeholder='[{"name":"alamat","label":"Alamat","type":"textarea","required":true}]'></textarea>
                <small class="admin-form-help">Kosongkan untuk memakai formulir standar otomatis.</small>
            </div>
        </div>
        <button class="admin-btn admin-btn-primary" type="submit">💾 Simpan Layanan</button>
    </form>
</div>


<div class="admin-card">
    <div class="admin-card-header">
        <div>
            <h2>Daftar Layanan</h2>
            <p class="admin-card-description">Klik kartu layanan untuk membuka editor lengkapnya.</p>
        </div>
        <div class="admin-card-icon">🧾</div>
    </div>

    <div class="service-admin-list">
        <?php $__empty_1 = true; $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <details class="service-admin-item" <?php echo e($loop->first ? 'open' : ''); ?>>
                <summary>
                    <span class="service-admin-summary-icon"><?php echo e($service->icon ?: '📄'); ?></span>
                    <span class="service-admin-summary-text">
                        <strong><?php echo e($service->title); ?></strong>
                        <small><?php echo e($service->is_letter ? 'Pengajuan online' : 'Informasi'); ?> · Urutan <?php echo e($service->sort_order); ?></small>
                    </span>
                    <span class="service-status <?php echo e($service->active ? 'on' : 'off'); ?>"><?php echo e($service->active ? 'Aktif' : 'Nonaktif'); ?></span>
                    <span class="service-chevron">⌄</span>
                </summary>

                <div class="service-admin-editor">
                    <form method="POST" action="<?php echo e(route('admin.layanan.update', $service->id)); ?>">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        <div class="admin-grid">
                            <div class="admin-form-group">
                                <label>Nama layanan *</label>
                                <input name="title" value="<?php echo e($service->title); ?>" required>
                            </div>
                            <div class="admin-form-group">
                                <label>Ikon</label>
                                <input name="icon" value="<?php echo e($service->icon ?: '📄'); ?>">
                            </div>
                            <div class="admin-form-group">
                                <label>Urutan</label>
                                <input type="number" name="sort_order" value="<?php echo e($service->sort_order); ?>" min="0">
                            </div>
                            <div class="admin-form-group admin-check-card">
                                <label>
                                    <input type="hidden" name="active" value="0">
                                    <input type="checkbox" name="active" value="1" <?php echo e($service->active ? 'checked' : ''); ?>>
                                    Tampilkan di website
                                </label>
                            </div>
                        </div>

                        <div class="admin-form-group">
                            <label>Deskripsi</label>
                            <textarea name="description" rows="3"><?php echo e($service->description); ?></textarea>
                        </div>

                        <?php if($service->is_letter): ?>
                            <?php
                                $reqText = is_array($service->requirements) ? implode("\n", $service->requirements) : ($service->requirements ?? '');
                                $formJson = is_array($service->form_fields) ? json_encode($service->form_fields, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : ($service->form_fields ?? '[]');
                            ?>
                            <div class="admin-grid">
                                <div class="admin-form-group">
                                    <label>Persyaratan dokumen</label>
                                    <textarea name="requirements" rows="8"><?php echo e($reqText); ?></textarea>
                                </div>
                                <div class="admin-form-group">
                                    <label>Field formulir JSON</label>
                                    <textarea name="form_fields" rows="8"><?php echo e($formJson); ?></textarea>
                                </div>
                            </div>
                        <?php else: ?>
                            <input type="hidden" name="requirements" value="">
                            <input type="hidden" name="form_fields" value="">
                            <div class="admin-info-note">Layanan informasi tidak membutuhkan formulir pengajuan.</div>
                        <?php endif; ?>

                        <div class="service-admin-actions">
                            <button class="admin-btn admin-btn-primary" type="submit">💾 Simpan Perubahan</button>
                            <a class="admin-btn admin-btn-light" href="<?php echo e(route('layanan.show', $service->id)); ?>" target="_blank">↗ Lihat User</a>
                        </div>
                    </form>

                    <div class="service-admin-actions service-admin-secondary-actions" style="margin-top: 15px; display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <form method="POST" action="<?php echo e(route('admin.layanan.toggle', $service->id)); ?>" style="margin: 0;">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button class="admin-btn admin-btn-secondary" type="submit">
                                <?php echo e($service->active ? '⏸ Nonaktifkan Layanan' : '▶ Aktifkan Layanan'); ?>

                            </button>
                        </form>

                        <form method="POST" action="<?php echo e(route('admin.layanan.destroy', $service->id)); ?>" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan &quot;<?php echo e($service->title); ?>&quot;?')" style="margin: 0;">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button class="admin-btn admin-btn-danger" type="submit" style="background:#fee2e2; color:#991b1b; border:none; padding:8px 14px; border-radius:8px; font-weight:700; cursor:pointer;">
                                🗑 Hapus Layanan
                            </button>
                        </form>
                    </div>
                </div>
            </details>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="admin-empty-state">Belum ada layanan. Tambahkan layanan menggunakan formulir di atas.</div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/layanan.blade.php ENDPATH**/ ?>