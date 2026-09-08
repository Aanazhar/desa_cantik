<?php $__env->startSection('title', 'Profil Desa'); ?>

<?php $__env->startSection('content'); ?>

<style>
    /* =========================================================
       PROFIL DESA - ADMIN (DENGAN INPUT NAMA DESA WAJIB)
       ========================================================= */

    .profil-page {
        --green: #2f6f4e;
        --green-dark: #24583e;
        --green-soft: #edf6f0;
        --green-border: #dcebe1;

        --text: #24352b;
        --muted: #748078;
        --border: #e5ebe7;
        --danger: #a64d4d;

        max-width: 1220px;
        margin: 0 auto;
        padding: 10px 0 60px;
    }

    .profil-page *,
    .profil-page *::before,
    .profil-page *::after {
        box-sizing: border-box;
    }

    /* HEADER */

    .profil-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 24px;
        margin-bottom: 28px;
    }

    .profil-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 8px;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 1.5px;
        text-transform: uppercase;
        color: var(--green);
    }

    .profil-eyebrow::before {
        content: "";
        width: 24px;
        height: 2px;
        border-radius: 10px;
        background: var(--green);
    }

    .profil-header h1 {
        margin: 0;
        color: var(--text);
        font-size: 32px;
        line-height: 1.2;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .profil-header p {
        max-width: 680px;
        margin: 9px 0 0;
        color: var(--muted);
        line-height: 1.7;
        font-size: 14px;
    }

    .profil-header-actions {
        display: flex;
        gap: 10px;
        flex-shrink: 0;
    }

    /* BUTTON */

    .profil-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 42px;
        padding: 0 18px;
        border-radius: 10px;
        border: 1px solid transparent;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none;
        cursor: pointer;
        transition: .2s ease;
    }

    .profil-btn-primary {
        color: #fff;
        background: var(--green);
        border-color: var(--green);
    }

    .profil-btn-primary:hover {
        color: #fff;
        background: var(--green-dark);
        border-color: var(--green-dark);
        transform: translateY(-1px);
    }

    .profil-btn-outline {
        color: var(--green-dark);
        background: #fff;
        border-color: var(--green-border);
    }

    .profil-btn-outline:hover {
        color: var(--green-dark);
        background: var(--green-soft);
    }

    .profil-btn-danger {
        color: var(--danger);
        background: #fff;
        border-color: #edd4d4;
    }

    .profil-btn-danger:hover {
        background: #fff5f5;
    }

    .profil-btn-small {
        min-height: 34px;
        padding: 0 11px;
        font-size: 12px;
        border-radius: 8px;
    }

    /* ALERT */

    .profil-alert {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 14px 18px;
        margin-bottom: 22px;
        border-radius: 12px;
        font-size: 13px;
        line-height: 1.5;
    }

    .profil-alert-success {
        color: #27613d;
        background: #edf8f1;
        border: 1px solid #d0e8d7;
        font-weight: 700;
    }

    .profil-alert-error {
        color: #8d4141;
        background: #fff2f2;
        border: 1px solid #efd4d4;
    }

    .profil-alert-error ul {
        margin: 0;
        padding-left: 18px;
    }

    /* CARD */

    .profil-card {
        overflow: hidden;
        margin-bottom: 20px;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 18px;
        box-shadow: 0 5px 18px rgba(35, 67, 48, .035);
    }

    .profil-card-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        padding: 22px 24px 0;
    }

    .profil-card-title {
        display: flex;
        align-items: flex-start;
        gap: 13px;
    }

    .profil-card-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        flex-shrink: 0;
        border-radius: 11px;
        color: var(--green);
        background: var(--green-soft);
        font-size: 17px;
        font-weight: 800;
    }

    .profil-card-header h2 {
        margin: 1px 0 4px;
        color: var(--text);
        font-size: 18px;
        line-height: 1.3;
        font-weight: 800;
    }

    .profil-card-header p {
        margin: 0;
        color: var(--muted);
        font-size: 12px;
        line-height: 1.6;
    }

    .profil-card-body {
        padding: 22px 24px 24px;
    }

    /* FORM ELEMENTS */

    .profil-grid {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 17px;
    }

    .profil-grid-3 {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .profil-field {
        min-width: 0;
    }

    .profil-field-full {
        grid-column: 1 / -1;
    }

    .profil-field label {
        display: block;
        margin-bottom: 7px;
        color: #3d4d44;
        font-size: 12px;
        font-weight: 750;
    }

    .profil-field input,
    .profil-field textarea,
    .profil-field select {
        display: block;
        width: 100%;
        padding: 11px 12px;
        color: var(--text);
        background: #fff;
        border: 1px solid #dce5df;
        border-radius: 10px;
        outline: none;
        font-family: inherit;
        font-size: 13px;
        transition: .2s ease;
    }

    .profil-field textarea {
        resize: vertical;
        min-height: 100px;
        line-height: 1.65;
    }

    .profil-field input:focus,
    .profil-field textarea:focus,
    .profil-field select:focus {
        border-color: #78a78c;
        box-shadow: 0 0 0 3px rgba(47, 111, 78, .08);
    }

    .profil-field input[type="file"] {
        padding: 8px;
        cursor: pointer;
    }

    .profil-form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 20px;
        margin-top: 20px;
        border-top: 1px solid #edf1ee;
    }

    /* PREVIEW UPLOAD */

    .profil-upload {
        display: grid;
        grid-template-columns: 120px 1fr;
        gap: 15px;
        align-items: center;
    }

    .profil-preview {
        width: 120px;
        height: 85px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        background: var(--green-soft);
        border: 1px solid var(--green-border);
        color: var(--green);
        font-size: 26px;
        font-weight: 800;
    }

    .profil-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* KELOLA PERANGKAT DESA */

    .perangkat-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-bottom: 18px;
    }

    .perangkat-toolbar-text h3 {
        margin: 0 0 4px;
        color: var(--text);
        font-size: 15px;
        font-weight: 800;
    }

    .perangkat-toolbar-text p {
        margin: 0;
        color: var(--muted);
        font-size: 12px;
    }

    .perangkat-add {
        display: none;
        padding: 18px;
        margin-bottom: 22px;
        border: 1px solid var(--green-border);
        border-radius: 14px;
        background: var(--green-soft);
    }

    .perangkat-add.is-open {
        display: block;
    }

    .perangkat-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 16px;
    }

    .perangkat-card {
        overflow: hidden;
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 15px;
        transition: .2s ease;
    }

    .perangkat-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(35, 67, 48, .07);
    }

    .perangkat-photo {
        position: relative;
        height: 175px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--green-soft);
    }

    .perangkat-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .perangkat-initial {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        border-radius: 50%;
        color: #fff;
        background: var(--green);
        font-size: 25px;
        font-weight: 800;
    }

    .perangkat-status {
        position: absolute;
        top: 10px;
        right: 10px;
        padding: 4px 8px;
        border-radius: 20px;
        color: #27613d;
        background: rgba(255, 255, 255, .92);
        font-size: 10px;
        font-weight: 800;
        border: 1px solid #d0e8d7;
    }

    .perangkat-body {
        padding: 15px;
    }

    .perangkat-order {
        margin-bottom: 5px;
        color: var(--green);
        font-size: 11px;
        font-weight: 800;
        letter-spacing: .6px;
        text-transform: uppercase;
    }

    .perangkat-body h3 {
        margin: 0 0 4px;
        color: var(--text);
        font-size: 15px;
        font-weight: 800;
    }

    .perangkat-body p {
        margin: 0;
        color: var(--muted);
        font-size: 12px;
    }

    .perangkat-actions {
        display: flex;
        gap: 6px;
        flex-wrap: wrap;
        margin-top: 13px;
    }

    .perangkat-actions form {
        margin: 0;
    }

    .perangkat-empty {
        padding: 35px 20px;
        text-align: center;
        color: var(--muted);
        border: 1px dashed #cbdcd1;
        border-radius: 14px;
        background: #fbfefc;
    }

    /* EDIT DETAILS */

    .perangkat-edit {
        margin-top: 12px;
        padding-top: 12px;
        border-top: 1px solid #e8eeea;
    }

    .perangkat-edit-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 9px;
    }

    .perangkat-edit-grid .full {
        grid-column: 1 / -1;
    }

    .perangkat-edit label {
        display: block;
        margin-bottom: 4px;
        color: #58665e;
        font-size: 10px;
        font-weight: 700;
    }

    .perangkat-edit input {
        width: 100%;
        padding: 8px 9px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        font-size: 11px;
        outline: none;
    }

    .perangkat-edit-save {
        margin-top: 9px;
    }

    .profil-details summary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 0 11px;
        border: 1px solid #dce5df;
        border-radius: 8px;
        color: #3f5749;
        background: #fff;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        list-style: none;
    }

    @media (max-width: 1000px) {
        .perangkat-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 760px) {
        .profil-header {
            flex-direction: column;
        }

        .profil-header-actions {
            width: 100%;
        }

        .profil-header-actions .profil-btn {
            flex: 1;
        }

        .profil-grid,
        .profil-grid-3 {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="profil-page">

    
    <header class="profil-header">
        <div class="profil-header-left">
            <span class="profil-eyebrow">Pengelolaan Website</span>
            <h1>Profil Desa</h1>
            <p>Kelola profil utama desa serta atur nomor urut desimal hirarki perangkat desa.</p>
        </div>

        <div class="profil-header-actions">
            <a href="<?php echo e(route('profil')); ?>" target="_blank" rel="noopener noreferrer" class="profil-btn profil-btn-outline">
                Lihat Website ↗
            </a>
        </div>
    </header>

    
    <?php if(session('success')): ?>
        <div class="profil-alert profil-alert-success">✓ <?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="profil-alert profil-alert-error">
            <ul>
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>⚠️ <?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>


    
    <form method="POST" action="<?php echo e(Route::has('admin.desa-profiles.save') ? route('admin.desa-profiles.save') : (Route::has('admin.desa-profile.store') ? route('admin.desa-profile.store') : url('/admin/desa-profiles'))); ?>" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="id" value="<?php echo e($desa->id ?? ''); ?>">

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">01</div>
                    <div>
                        <h2>Tentang Desa</h2>
                        <p>Nama resmi dan gambaran umum profil desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-grid" style="margin-bottom:18px;">
                    <div class="profil-field profil-field-full">
                        <label>Nama Resmi Desa *</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $desa->name ?? ($activeDesa->name ?? 'Desa Waha'))); ?>" required placeholder="Contoh: Desa Waha">
                    </div>
                </div>

                <div class="profil-field">
                    <label>Deskripsi Tentang Desa</label>
                    <textarea name="description" rows="7"><?php echo e(old('description', $desa->description ?? '')); ?></textarea>
                </div>
            </div>
        </section>

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">02</div>
                    <div>
                        <h2>Profil Kepala Desa</h2>
                        <p>Nama dan foto resmi Kepala Desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-grid">
                    <div class="profil-field">
                        <label>Nama Kepala Desa</label>
                        <input type="text" name="head_name" value="<?php echo e(old('head_name', $desa->head_name ?? '')); ?>">
                    </div>
                    <div class="profil-field">
                        <label>Foto Kepala Desa</label>
                        <div class="profil-upload">
                            <div class="profil-preview">
                                <?php if(!empty($desa->head_photo)): ?>
                                    <img src="<?php echo e(asset(ltrim($desa->head_photo, '/'))); ?>" alt="Foto Kepala Desa">
                                <?php else: ?> 👤 <?php endif; ?>
                            </div>
                            <input type="file" name="head_photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">03</div>
                    <div>
                        <h2>Sejarah Desa</h2>
                        <p>Asal usul berdirinya desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-field">
                    <label>Sejarah Desa</label>
                    <textarea name="history" rows="7"><?php echo e(old('history', $desa->history ?? '')); ?></textarea>
                </div>
            </div>
        </section>

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">04</div>
                    <div>
                        <h2>Visi & Misi</h2>
                        <p>Visi dan misi pembangunan desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-grid">
                    <div class="profil-field">
                        <label>Visi Desa</label>
                        <textarea name="vision" rows="6"><?php echo e(old('vision', $desa->vision ?? '')); ?></textarea>
                    </div>
                    <div class="profil-field">
                        <label>Misi Desa</label>
                        <textarea name="mission" rows="6"><?php echo e(old('mission', $desa->mission ?? '')); ?></textarea>
                    </div>
                </div>
            </div>
        </section>

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">05</div>
                    <div>
                        <h2>Peta Desa & Wilayah</h2>
                        <p>Batas wilayah dan peta desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-field">
                    <label>Batas & Informasi Wilayah</label>
                    <textarea name="boundaries" rows="6"><?php echo e(old('boundaries', $desa->boundaries ?? '')); ?></textarea>
                </div>
                
                <div class="profil-field profil-field-full" style="margin-top:18px;">
                    <label>Upload Gambar Peta Desa</label>
                    <div class="profil-upload">
                        <div class="profil-preview">
                            <?php if(!empty($desa->map_image)): ?>
                                <img src="<?php echo e(asset(ltrim($desa->map_image, '/'))); ?>" alt="Peta Desa">
                            <?php else: ?> 🗺️ <?php endif; ?>
                        </div>
                        <input type="file" name="map_image" accept="image/*">
                    </div>
                </div>
            </div>
        </section>

        
        <section class="profil-card">
            <div class="profil-card-header">
                <div class="profil-card-title">
                    <div class="profil-card-icon">06</div>
                    <div>
                        <h2>Struktur Organisasi Desa</h2>
                        <p>Bagan struktur organisasi desa.</p>
                    </div>
                </div>
            </div>
            <div class="profil-card-body">
                <div class="profil-field profil-field-full">
                    <label>Gambar Bagan Struktur</label>
                    <div class="profil-upload">
                        <div class="profil-preview">
                            <?php if(!empty($desa->structure_image)): ?>
                                <img src="<?php echo e(asset(ltrim($desa->structure_image, '/'))); ?>" alt="Struktur">
                            <?php else: ?> 🏢 <?php endif; ?>
                        </div>
                        <input type="file" name="structure_image" accept="image/*">
                    </div>
                </div>
            </div>
        </section>

        <div class="profil-form-actions">
            <button type="submit" class="profil-btn profil-btn-primary" style="padding: 0 32px; font-size: 14px; min-height: 46px;">
                💾 Simpan Profil Desa
            </button>
        </div>
    </form>


    

    <section class="profil-card" style="margin-top: 35px;">

        <div class="profil-card-header">
            <div class="profil-card-title">
                <div class="profil-card-icon">07</div>
                <div>
                    <h2>Input Perangkat Desa & Kode Hirarki</h2>
                    <p>
                        Gunakan sistem penomoran desimal: <b>1</b> (Puncak), <b>2</b> (Bawah 1), <b>3</b> (Bawah 2), <b>3.1</b> (Bawahan No.3 Pertama), <b>3.2</b> (Bawahan No.3 Kedua), <b>4</b> (Bawah 3), <b>4.1</b> (Bawahan No.4 Pertama).
                    </p>
                </div>
            </div>
        </div>

        <div class="profil-card-body">

            <div class="perangkat-toolbar">
                <div class="perangkat-toolbar-text">
                    <h3>Daftar Input Perangkat Desa</h3>
                    <p>Penomoran kode desimal akan otomatis menyusun bagan hirarki cabang di halaman user.</p>
                </div>
                <button type="button" class="profil-btn profil-btn-primary profil-btn-small" onclick="toggleTambahPerangkat()">
                    + Tambah Perangkat
                </button>
            </div>

            
            <div id="formTambahPerangkat" class="perangkat-add <?php echo e(($errors->has('sort_order') || $errors->has('name') || $errors->has('position')) ? 'is-open' : ''); ?>">
                <form method="POST" action="<?php echo e(Route::has('admin.perangkat-desa.store') ? route('admin.perangkat-desa.store') : url('/admin/perangkat-desa')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="profil-grid profil-grid-3">

                        <div class="profil-field">
                            <label>Kode Hirarki / No. Urut</label>
                            <input type="text" name="sort_order" value="<?php echo e(old('sort_order')); ?>" required placeholder="Contoh: 1, 2, 3, 3.1, 3.2, 4">
                            <small style="color:#627267; font-size:11px; display:block; margin-top:4px;">
                                *Gunakan format desimal seperti <b>3.1</b> (bawahan No.3 Ke-1) atau <b>3.2</b> (bawahan No.3 Ke-2).
                            </small>
                        </div>

                        <div class="profil-field">
                            <label>Nama Perangkat</label>
                            <input type="text" name="name" value="<?php echo e(old('name')); ?>" required placeholder="Nama lengkap & gelar">
                        </div>

                        <div class="profil-field">
                            <label>Jabatan</label>
                            <input type="text" name="position" value="<?php echo e(old('position')); ?>" required placeholder="Contoh: Kaur Keuangan / Staf">
                        </div>

                        <div class="profil-field profil-field-full">
                            <label>Foto Perangkat</label>
                            <input type="file" name="photo" accept="image/*">
                        </div>

                    </div>

                    <div style="display:flex; justify-content:flex-end; gap:8px; margin-top:15px;">
                        <button type="button" class="profil-btn profil-btn-outline profil-btn-small" onclick="toggleTambahPerangkat()">Batal</button>
                        <button type="submit" class="profil-btn profil-btn-primary profil-btn-small">Simpan Perangkat</button>
                    </div>
                </form>
            </div>

            
            <?php if(isset($structures) && $structures->count()): ?>
                <div class="perangkat-grid">
                    <?php $__currentLoopData = $structures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="perangkat-card">

                            <div class="perangkat-photo">
                                <?php if(!empty($item->photo)): ?>
                                    <img src="<?php echo e(asset(ltrim($item->photo, '/'))); ?>" alt="<?php echo e($item->name); ?>">
                                <?php else: ?>
                                    <div class="perangkat-initial">
                                        <?php echo e(\Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($item->name, 0, 1))); ?>

                                    </div>
                                <?php endif; ?>
                                <span class="perangkat-status"><?php echo e($item->active ? 'Aktif' : 'Nonaktif'); ?></span>
                            </div>

                            <div class="perangkat-body">
                                <div class="perangkat-order">Kode No. <?php echo e($item->sort_order); ?></div>
                                <h3><?php echo e($item->name); ?></h3>
                                <p><?php echo e($item->position); ?></p>

                                <div class="perangkat-actions">

                                    
                                    <details class="profil-details">
                                        <summary>Edit</summary>
                                        <div class="perangkat-edit">
                                            <form method="POST" action="<?php echo e(Route::has('admin.perangkat-desa.update') ? route('admin.perangkat-desa.update', $item) : url('/admin/perangkat-desa/'.$item->id)); ?>" enctype="multipart/form-data">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="perangkat-edit-grid">
                                                    <div>
                                                        <label>Kode Hirarki</label>
                                                        <input type="text" name="sort_order" value="<?php echo e(old('sort_order', $item->sort_order)); ?>" required placeholder="Contoh: 3.1">
                                                    </div>
                                                    <div>
                                                        <label>Nama</label>
                                                        <input type="text" name="name" value="<?php echo e(old('name', $item->name)); ?>" required>
                                                    </div>
                                                    <div class="full">
                                                        <label>Jabatan</label>
                                                        <input type="text" name="position" value="<?php echo e(old('position', $item->position)); ?>" required>
                                                    </div>
                                                    <div class="full">
                                                        <label>Foto Baru</label>
                                                        <input type="file" name="photo" accept="image/*">
                                                    </div>
                                                </div>
                                                <div class="perangkat-edit-save">
                                                    <button type="submit" class="profil-btn profil-btn-primary profil-btn-small">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </details>

                                    
                                    <form method="POST" action="<?php echo e(Route::has('admin.perangkat-desa.toggle') ? route('admin.perangkat-desa.toggle', $item) : url('/admin/perangkat-desa/'.$item->id.'/toggle')); ?>">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="profil-btn profil-btn-outline profil-btn-small">
                                            <?php echo e($item->active ? 'Nonaktifkan' : 'Aktifkan'); ?>

                                        </button>
                                    </form>

                                    
                                    <form method="POST" action="<?php echo e(Route::has('admin.perangkat-desa.destroy') ? route('admin.perangkat-desa.destroy', $item) : url('/admin/perangkat-desa/'.$item->id)); ?>" onsubmit="return confirm('Hapus perangkat ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="profil-btn profil-btn-danger profil-btn-small">Hapus</button>
                                    </form>

                                </div>
                            </div>

                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="perangkat-empty">
                    <strong>Belum ada Perangkat Desa</strong>
                    Tambahkan menggunakan tombol <b>+ Tambah Perangkat</b>.
                </div>
            <?php endif; ?>

        </div>

    </section>

</div>

<script>
    function toggleTambahPerangkat() {
        const form = document.getElementById('formTambahPerangkat');
        if (!form) return;
        form.classList.toggle('is-open');

        if (form.classList.contains('is-open')) {
            form.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/desa-profiles.blade.php ENDPATH**/ ?>