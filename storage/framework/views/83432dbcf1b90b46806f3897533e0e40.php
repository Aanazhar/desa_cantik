<?php $__env->startSection('title', 'Kelola Kontak & Media Sosial Desa - ' . ($activeDesa->name ?? 'Desa Waha')); ?>


<?php
    if (!function_exists('renderContactBrandIcon')) {
        function renderContactBrandIcon($type, $fallbackIcon = null) {
            switch($type) {
                case 'whatsapp':
                    return '<div class="brand-icon-box bg-whatsapp" title="WhatsApp"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.031 2c-5.456 0-9.88 4.424-9.88 9.88 0 1.98.583 3.824 1.587 5.378l-1.688 6.166 6.323-1.658a9.842 9.842 0 0 0 4.658 1.194c5.456 0 9.88-4.424 9.88-9.88 0-5.456-4.424-9.88-9.88-9.88zm5.82 14.154c-.244.686-1.42 1.31-1.957 1.393-.538.082-1.228.118-3.486-.807-2.892-1.184-4.733-4.14-4.877-4.331-.144-.191-1.171-1.56-1.171-2.977 0-1.417.742-2.114 1.005-2.4.263-.286.574-.358.765-.358.191 0 .383.004.549.01.177.007.416-.067.65.495.244.586.837 2.046.91 2.193.072.147.12.318.024.51-.096.191-.144.31-.287.478-.143.167-.302.373-.43.501-.143.143-.293.3-.126.586.167.286.745 1.228 1.6 1.988 1.1.977 2.029 1.28 2.315 1.423.287.143.454.12.622-.072.167-.191.717-.836.908-1.123.191-.286.383-.238.646-.143.263.095 1.674.788 1.961.931.287.143.478.215.549.334.072.119.072.693-.172 1.379z"/></svg></div>';
                case 'instagram':
                    return '<div class="brand-icon-box bg-instagram" title="Instagram"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></div>';
                case 'facebook':
                    return '<div class="brand-icon-box bg-facebook" title="Facebook"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></div>';
                case 'youtube':
                    return '<div class="brand-icon-box bg-youtube" title="YouTube"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></div>';
                case 'tiktok':
                    return '<div class="brand-icon-box bg-tiktok" title="TikTok"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.98-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.82.57-1.31 1.54-1.33 2.54-.01 1.08.57 2.11 1.48 2.64.91.54 2.08.57 3.01.07.82-.43 1.38-1.28 1.47-2.2.06-3.86.03-7.72.04-11.58z"/></svg></div>';
                case 'website':
                    return '<div class="brand-icon-box bg-website" title="Website"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10z"></path></svg></div>';
                case 'email':
                    return '<div class="brand-icon-box bg-email" title="Email"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>';
                case 'phone':
                    return '<div class="brand-icon-box bg-phone" title="Telepon"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>';
                case 'address':
                    return '<div class="brand-icon-box bg-address" title="Alamat"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>';
                default:
                    return '<div class="brand-icon-box bg-other" title="Lainnya"><span>' . ($fallbackIcon ?: '🔗') . '</span></div>';
            }
        }
    }
?>

<?php $__env->startPush('styles'); ?>
<style>
    .contact-admin { padding-bottom: 50px; }

    .contact-admin-hero {
        padding: 30px;
        background: linear-gradient(135deg, #0f766e 0%, #146267 50%, #155e75 100%);
        color: #ffffff;
        border-radius: 22px;
        margin-bottom: 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .contact-admin-hero h1 { margin: 4px 0 6px; font-size: 1.8rem; font-weight: 800; }
    .contact-admin-hero p { margin: 0; font-size: 0.92rem; color: #e0f2fe; }

    .contact-admin-grid {
        display: grid;
        grid-template-columns: 1fr 1.3fr;
        gap: 24px;
        align-items: start;
    }

    .contact-card-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        padding: 26px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
    }

    .contact-card-box-head {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 22px;
        padding-bottom: 16px;
        border-bottom: 1px solid #f1f5f9;
    }

    .contact-card-box-icon {
        width: 48px;
        height: 48px;
        border-radius: 14px;
        background: #e6f4f1;
        color: #0f766e;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        font-weight: 800;
    }

    .contact-card-box-head h2 { margin: 0 0 4px; font-size: 1.2rem; font-weight: 800; }
    .contact-card-box-head p { margin: 0; color: #64748b; font-size: 0.85rem; }

    /* IKON APPS RESMI MODERN & FLAT */
    .brand-icon-box {
        width: 48px;
        height: 48px;
        min-width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
        transition: transform 0.25s ease;
    }

    .brand-icon-box.bg-whatsapp { background: #25D366; border-radius: 50%; }
    .brand-icon-box.bg-facebook { background: #1877F2; border-radius: 12px; }
    .brand-icon-box.bg-youtube { background: #FF0000; border-radius: 14px; }
    .brand-icon-box.bg-instagram { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); border-radius: 14px; }
    .brand-icon-box.bg-tiktok { background: #000000; border-radius: 14px; }
    .brand-icon-box.bg-website { background: #0284c7; border-radius: 14px; }
    .brand-icon-box.bg-email { background: #ea580c; border-radius: 14px; }
    .brand-icon-box.bg-phone { background: #059669; border-radius: 50%; }
    .brand-icon-box.bg-address { background: #dc2626; border-radius: 14px; }
    .brand-icon-box.bg-other { background: #64748b; border-radius: 14px; }

    /* KOTAK PREVIEW IKON OTOMATIS */
    .icon-preview-wrapper {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 12px 16px;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        margin-top: 8px;
    }

    .icon-preview-wrapper span {
        font-size: 0.83rem;
        font-weight: 700;
        color: #475569;
    }

    .contact-field-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px; }
    .contact-field-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .contact-field-group.full { grid-column: 1 / -1; }
    .contact-field-group label { font-size: 0.85rem; font-weight: 700; color: #334155; }

    .contact-field-group input,
    .contact-field-group select,
    .contact-field-group textarea {
        width: 100%;
        padding: 11px 14px;
        border: 1px solid #cbd5e1;
        border-radius: 12px;
        font-size: 0.9rem;
        outline: none;
        background: #f8fafc;
    }

    .contact-btn-submit {
        background: #0f766e;
        color: #ffffff;
        border: 0;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.92rem;
        cursor: pointer;
        width: 100%;
    }

    /* ITEM KONTAK TERSIMPAN */
    .saved-contact-item {
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        margin-bottom: 14px;
        background: #ffffff;
        overflow: hidden;
    }

    .saved-contact-summary {
        padding: 16px;
        display: flex;
        align-items: center;
        gap: 14px;
        cursor: pointer;
        list-style: none;
    }

    .saved-contact-summary::-webkit-details-marker { display: none; }
    .saved-contact-info { flex: 1; min-width: 0; }
    .saved-contact-info strong { display: block; font-size: 0.95rem; color: #0f172a; margin-bottom: 3px; }
    .saved-contact-info small { color: #64748b; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; font-size: 0.82rem; }

    .saved-contact-badge {
        display: inline-block;
        margin-top: 4px;
        padding: 3px 10px;
        background: #e0f2fe;
        color: #0369a1;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    .saved-contact-body { padding: 20px; border-top: 1px solid #f1f5f9; background: #f8fafc; }
    .contact-action-bar { display: flex; gap: 10px; align-items: center; flex-wrap: wrap; margin-top: 10px; }
    .btn-save-edit { background: #0f766e; color: #ffffff; border: 0; padding: 9px 18px; border-radius: 10px; font-weight: 700; cursor: pointer; }
    .btn-open-link { background: #e0f2fe; color: #0369a1; text-decoration: none; padding: 9px 16px; border-radius: 10px; font-weight: 700; }
    .btn-delete-contact { background: #fee2e2; color: #991b1b; border: 0; padding: 9px 16px; border-radius: 10px; font-weight: 700; cursor: pointer; }

    @media (max-width: 960px) { .contact-admin-grid { grid-template-columns: 1fr; } }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<div class="contact-admin">

    
    <div class="contact-admin-hero">
        <div>
            <span class="admin-eyebrow" style="color: #a7f3d0;">PENGELOLAAN KONTAK</span>
            <h1>🌐 Kelola Kontak & Media Sosial Desa</h1>
            <p>Atur nomor WhatsApp, akun media sosial, lokasi Google Maps, email, dan kanal komunikasi resmi desa.</p>
        </div>
        <div style="font-size: 48px;">📞</div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="admin-alert admin-alert-success" style="background: #dcfce7; color: #166534; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
            ✅ <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="contact-admin-grid">

        
        <div class="contact-card-box">
            <div class="contact-card-box-head">
                <div class="contact-card-box-icon">＋</div>
                <div>
                    <h2>Tambah Kontak Baru</h2>
                    <p>Konten langsung dipublikasikan ke halaman kontak user.</p>
                </div>
            </div>

            <form method="POST" action="<?php echo e(route('admin.kontak.store')); ?>">
                <?php echo csrf_field(); ?>

                <div class="contact-field-group">
                    <label>Jenis Kontak *</label>
                    <select name="type" id="contactType" required>
                        <option value="">-- Pilih Jenis Kontak --</option>
                        <?php $__currentLoopData = [
                            'whatsapp'=>'WhatsApp Resmi',
                            'instagram'=>'Instagram',
                            'facebook'=>'Facebook',
                            'youtube'=>'YouTube',
                            'tiktok'=>'TikTok',
                            'website'=>'Website Resmi',
                            'email'=>'Email Desa',
                            'phone'=>'Telepon Desa',
                            'address'=>'Alamat / Google Maps',
                            'other'=>'Kanal Lainnya'
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($v); ?>" <?php if(old('type') === $v): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>

                    
                    <div class="icon-preview-wrapper">
                        <span>Preview Ikon:</span>
                        <div id="liveIconPreviewBox">
                            <div class="brand-icon-box bg-other"><span>🔗</span></div>
                        </div>
                    </div>
                </div>

                <div class="contact-field-group">
                    <label>Nama Kontak / Judul *</label>
                    <input name="title" value="<?php echo e(old('title')); ?>" placeholder="Contoh: WhatsApp Layanan Desa" required>
                </div>

                <div class="contact-field-group full">
                    <label id="urlLabel">URL / Nilai Kontak *</label>
                    <input name="url" id="contactUrl" value="<?php echo e(old('url')); ?>" placeholder="Pilih jenis kontak terlebih dahulu" required>
                    <small class="contact-help" id="urlHelp" style="font-size: 0.78rem; color: #64748b; margin-top: 4px;">
                        WhatsApp/Telepon diisi nomor (misal: 081234567890).
                    </small>
                </div>

                <div class="contact-field-grid">
                    <!-- <div class="contact-field-group">
                        <label>Ikon Tambahan (Optional)</label>
                        <input name="icon" id="contactIcon" value="<?php echo e(old('icon')); ?>" placeholder="Otomatis terisi ikon brand">
                    </div> -->

                    <div class="contact-field-group">
                        <label>Urutan Tampil</label>
                        <input type="number" name="sort_order" value="<?php echo e(old('sort_order', 0)); ?>" min="0">
                    </div>
                </div>

                <div class="contact-field-group full">
                    <label>Keterangan Tambahan</label>
                    <textarea name="description" rows="3" placeholder="Contoh: Layanan setiap hari kerja jam 08:00 - 15:00 WITA."><?php echo e(old('description')); ?></textarea>
                </div>

                <button class="contact-btn-submit" type="submit">
                    💾 Simpan Kontak Baru
                </button>
            </form>
        </div>

        
        <div class="contact-card-box">
            <div class="contact-card-box-head">
                <div class="contact-card-box-icon">📇</div>
                <div>
                    <h2>Daftar Kontak Tersimpan</h2>
                    <p>Klik kontak untuk melihat detail, mengedit, atau menghapus.</p>
                </div>
            </div>

            <?php $__empty_1 = true; $__currentLoopData = $kontak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <details class="saved-contact-item" <?php echo e($loop->first ? 'open' : ''); ?>>
                    <summary class="saved-contact-summary">
                        <?php echo renderContactBrandIcon($contact->type ?? 'other', $contact->icon); ?>

                        <div class="saved-contact-info">
                            <strong><?php echo e($contact->title); ?></strong>
                            <small><?php echo e($contact->url ?: 'Belum ada isi link/nilai'); ?></small>
                            <span class="saved-contact-badge"><?php echo e(ucfirst($contact->type ?? 'other')); ?></span>
                        </div>
                        <span style="font-weight: 800; color: #64748b;">▼</span>
                    </summary>

                    <div class="saved-contact-body">
                        <form method="POST" action="<?php echo e(route('admin.kontak.update', $contact->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <div class="contact-field-grid">
                                <div class="contact-field-group">
                                    <label>Jenis Kontak *</label>
                                    <select name="type" required>
                                        <?php $__currentLoopData = [
                                            'whatsapp'=>'WhatsApp Resmi',
                                            'instagram'=>'Instagram',
                                            'facebook'=>'Facebook',
                                            'youtube'=>'YouTube',
                                            'tiktok'=>'TikTok',
                                            'website'=>'Website Resmi',
                                            'email'=>'Email',
                                            'phone'=>'Telepon',
                                            'address'=>'Alamat',
                                            'other'=>'Lainnya'
                                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($v); ?>" <?php if(($contact->type ?? 'other') === $v): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="contact-field-group">
                                    <label>Nama Kontak *</label>
                                    <input name="title" value="<?php echo e($contact->title); ?>" required>
                                </div>
                            </div>

                            <div class="contact-field-group full">
                                <label>URL / Nilai Kontak</label>
                                <input name="url" value="<?php echo e($contact->url); ?>">
                            </div>

                            <div class="contact-field-grid">
                                <!-- <div class="contact-field-group">
                                    <label>Ikon Tambahan</label>
                                    <input name="icon" value="<?php echo e($contact->icon); ?>">
                                </div> -->

                                <div class="contact-field-group">
                                    <label>Urutan</label>
                                    <input type="number" name="sort_order" value="<?php echo e($contact->sort_order); ?>" min="0">
                                </div>
                            </div>

                            <div class="contact-field-group full">
                                <label>Keterangan</label>
                                <textarea name="description" rows="3"><?php echo e($contact->description); ?></textarea>
                            </div>

                            <div class="contact-action-bar">
                                <button class="btn-save-edit" type="submit">💾 Simpan Perubahan</button>
                                <?php if($contact->url): ?>
                                    <a class="btn-open-link" href="<?php echo e($contact->url); ?>" target="_blank" rel="noopener noreferrer">🔗 Tes Buka Link</a>
                                <?php endif; ?>
                            </div>
                        </form>

                        <form method="POST" action="<?php echo e(route('admin.kontak.destroy', $contact->id)); ?>" onsubmit="return confirm('Yakin ingin menghapus kontak ini?')" style="margin-top: 10px;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn-delete-contact" type="submit">🗑️ Hapus Kontak</button>
                        </form>
                    </div>
                </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="padding: 40px; text-align: center; color: #64748b; background: #f8fafc; border-radius: 16px;">
                    <div style="font-size: 40px; margin-bottom: 8px;">📭</div>
                    <strong>Belum ada kontak tersimpan.</strong>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<?php $__env->startPush('scripts'); ?>
<script>
const iconSVGs = {
    whatsapp: '<div class="brand-icon-box bg-whatsapp"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.031 2c-5.456 0-9.88 4.424-9.88 9.88 0 1.98.583 3.824 1.587 5.378l-1.688 6.166 6.323-1.658a9.842 9.842 0 0 0 4.658 1.194c5.456 0 9.88-4.424 9.88-9.88 0-5.456-4.424-9.88-9.88-9.88zm5.82 14.154c-.244.686-1.42 1.31-1.957 1.393-.538.082-1.228.118-3.486-.807-2.892-1.184-4.733-4.14-4.877-4.331-.144-.191-1.171-1.56-1.171-2.977 0-1.417.742-2.114 1.005-2.4.263-.286.574-.358.765-.358.191 0 .383.004.549.01.177.007.416-.067.65.495.244.586.837 2.046.91 2.193.072.147.12.318.024.51-.096.191-.144.31-.287.478-.143.167-.302.373-.43.501-.143.143-.293.3-.126.586.167.286.745 1.228 1.6 1.988 1.1.977 2.029 1.28 2.315 1.423.287.143.454.12.622-.072.167-.191.717-.836.908-1.123.191-.286.383-.238.646-.143.263.095 1.674.788 1.961.931.287.143.478.215.549.334.072.119.072.693-.172 1.379z"/></svg></div>',
    instagram: '<div class="brand-icon-box bg-instagram"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg></div>',
    facebook: '<div class="brand-icon-box bg-facebook"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></div>',
    youtube: '<div class="brand-icon-box bg-youtube"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg></div>',
    tiktok: '<div class="brand-icon-box bg-tiktok"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.98-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.82.57-1.31 1.54-1.33 2.54-.01 1.08.57 2.11 1.48 2.64.91.54 2.08.57 3.01.07.82-.43 1.38-1.28 1.47-2.2.06-3.86.03-7.72.04-11.58z"/></svg></div>',
    website: '<div class="brand-icon-box bg-website"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="2" y1="12" x2="22" y2="12"></line><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"></path></svg></div>',
    email: '<div class="brand-icon-box bg-email"><svg viewBox="0 0 24 24" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg></div>',
    phone: '<div class="brand-icon-box bg-phone"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg></div>',
    address: '<div class="brand-icon-box bg-address"><svg viewBox="0 0 24 24" width="24" height="24" fill="currentColor"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg></div>',
    other: '<div class="brand-icon-box bg-other"><span>🔗</span></div>'
};

const typeSelect = document.getElementById('contactType');
const livePreviewBox = document.getElementById('liveIconPreviewBox');

function updateLiveIconPreview() {
    const selectedVal = typeSelect.value || 'other';
    livePreviewBox.innerHTML = iconSVGs[selectedVal] || iconSVGs['other'];
}

typeSelect?.addEventListener('change', updateLiveIconPreview);
if (typeSelect?.value) updateLiveIconPreview();
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/admin/kontak.blade.php ENDPATH**/ ?>