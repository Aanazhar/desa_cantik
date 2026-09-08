<?php $__env->startSection('title', 'Cek Status Pengajuan'); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* =========================================================
       TIMELINE PROGRESS & FORM STYLING
       ========================================================= */
    .status-timeline {
        display: flex;
        justify-content: space-between;
        margin: 24px 0 30px;
        position: relative;
    }

    .status-timeline::before {
        content: '';
        position: absolute;
        top: 18px;
        left: 30px;
        right: 30px;
        height: 4px;
        background: #e2e8f0;
        z-index: 1;
    }

    .timeline-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #cbd5e1;
        color: #94a3b8;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.9rem;
        margin: 0 auto 8px;
    }

    .timeline-step.completed .step-icon {
        background: #10b981;
        border-color: #10b981;
        color: #ffffff;
    }

    .timeline-step.active .step-icon {
        background: #0f766e;
        border-color: #0f766e;
        color: #ffffff;
        box-shadow: 0 4px 12px rgba(15, 118, 110, 0.3);
    }

    .step-label {
        font-size: 0.8rem;
        font-weight: 700;
        color: #64748b;
    }

    .timeline-step.active .step-label {
        color: #0f766e;
        font-weight: 800;
    }

    .btn-wa-confirm {
        background: #25d366;
        color: #ffffff;
        padding: 12px 22px;
        border-radius: 14px;
        font-weight: 800;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 6px 20px rgba(37, 211, 102, 0.3);
        transition: all 0.25s ease;
    }

    .btn-wa-confirm:hover {
        background: #1eb956;
        transform: translateY(-2px);
        color: #ffffff;
        box-shadow: 0 10px 25px rgba(37, 211, 102, 0.4);
    }

    /* MODAL FIXED INSET */
    .modal-overlay-fixed {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        background: rgba(15, 23, 42, 0.75) !important;
        backdrop-filter: blur(10px) !important;
        -webkit-backdrop-filter: blur(10px) !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        z-index: 9999999 !important;
        padding: 20px !important;
        box-sizing: border-box !important;
        pointer-events: auto !important;
    }

    .modal-card-bounce {
        background: #ffffff !important;
        width: 100% !important;
        max-width: 480px !important;
        border-radius: 28px !important;
        padding: 35px 28px !important;
        text-align: center !important;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.4) !important;
        border: 1px solid #bbf7d0 !important;
        position: relative !important;
        animation: modalBounceIn 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
        pointer-events: auto !important;
    }

    .modal-card-bounce::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 6px;
        background: linear-gradient(90deg, #10b981, #0f766e);
        border-radius: 28px 28px 0 0;
    }

    .modal-success-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 18px;
    }

    .checkmark-svg {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        display: block;
        stroke-width: 3;
        stroke: #10b981;
        stroke-miterlimit: 10;
        box-shadow: inset 0px 0px 0px #10b981;
        animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 3;
        stroke-miterlimit: 10;
        stroke: #10b981;
        fill: #dcfce7;
        animation: stroke 0.6s cubic-bezier(0.65, 0, 0.45, 1) forwards;
    }

    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        animation: stroke 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.8s forwards;
    }

    @keyframes stroke { 100% { stroke-dashoffset: 0; } }

    .modal-card-bounce h2 {
        font-size: 1.45rem !important;
        font-weight: 800 !important;
        color: #0f172a !important;
        margin: 0 0 8px !important;
    }

    .modal-subtitle {
        font-size: 0.9rem !important;
        color: #475569 !important;
        line-height: 1.55 !important;
        margin: 0 0 20px !important;
    }

    .tracking-code-box {
        background: #f0fdf4 !important;
        border: 2px dashed #86efac !important;
        border-radius: 18px !important;
        padding: 16px !important;
        margin-bottom: 22px !important;
    }

    .tracking-label {
        font-size: 0.72rem !important;
        font-weight: 800 !important;
        color: #166534 !important;
        letter-spacing: 1px !important;
        text-transform: uppercase !important;
        display: block !important;
        margin-bottom: 6px !important;
    }

    .tracking-code-display {
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 10px !important;
        flex-wrap: wrap !important;
    }

    .tracking-code-display strong {
        font-size: 1.45rem !important;
        font-weight: 900 !important;
        color: #0f766e !important;
        letter-spacing: 1px !important;
        font-family: monospace !important;
    }

    .btn-copy-code {
        background: #ffffff !important;
        color: #0f766e !important;
        border: 1px solid #a7f3d0 !important;
        padding: 6px 12px !important;
        border-radius: 10px !important;
        font-weight: 800 !important;
        font-size: 0.78rem !important;
        cursor: pointer !important;
        transition: all 0.2s ease !important;
    }

    .btn-copy-code:hover {
        background: #0f766e !important;
        color: #ffffff !important;
    }

    .btn-modal-primary {
        background: #0f766e !important;
        color: #ffffff !important;
        border: 0 !important;
        padding: 13px 20px !important;
        border-radius: 14px !important;
        font-weight: 800 !important;
        font-size: 0.92rem !important;
        cursor: pointer !important;
        width: 100% !important;
        box-shadow: 0 4px 15px rgba(15, 118, 110, 0.3) !important;
    }

    @keyframes modalBounceIn {
        0% { opacity: 0; transform: scale(0.7); }
        80% { transform: scale(1.03); }
        100% { opacity: 1; transform: scale(1); }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

    <?php
        $trackingCode = session('tracking_code') ?? request('kode');
    ?>

    
    <section class="page-hero">
        <div class="container">
            <span class="section-label">PELAYANAN DIGITAL</span>
            <h1>Cek Status Pengajuan</h1>
            <p>Gunakan kode pengajuan untuk melihat perkembangan permohonan surat Anda secara realtime.</p>
        </div>
    </section>

    
    <section class="section">
        <div class="container status-page-grid">

            
            <div class="content-card status-check-card">
                <span class="section-label">PELACAKAN</span>
                <h2>Masukkan Data Pengajuan</h2>
                <p>Kode pengajuan diberikan saat formulir permohonan berhasil dikirim.</p>

                <?php if($errors->any()): ?>
                    <div class="public-error" style="background: #fef2f2; color: #991b1b; padding: 14px; border-radius: 12px; margin-bottom: 20px; font-weight: 700;">
                        ⚠️ <?php echo e($errors->first()); ?>

                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('layanan.status.check')); ?>" class="status-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label>Kode Pengajuan</label>
                        <input
                            name="kode"
                            id="inputKodeStatus"
                            value="<?php echo e(old('kode', $trackingCode)); ?>"
                            placeholder="Contoh: DC-A1B2C3D4"
                            required
                            style="text-transform: uppercase; font-weight: 800; letter-spacing: 1px;"
                        >
                    </div>

                    <div style="margin-top: 18px;">
                        <button class="btn btn-primary" type="submit" style="width: 100%; padding: 12px 20px; border-radius: 12px; font-weight: 800; cursor: pointer;">
                            🔎 Cek Status Pengajuan
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="content-card status-result-card">
                <?php if(isset($requestData) && $requestData): ?>

                    <span class="section-label">HASIL PELACAKAN</span>
                    <h2 style="margin-bottom: 8px;"><?php echo e($requestData->service->title ?? 'Pengajuan Layanan Surat'); ?></h2>

                    <?php
                        $st = strtolower($requestData->status ?? 'pending');
                    ?>

                    
                    <div class="status-timeline">
                        <div class="timeline-step <?php echo e(in_array($st, ['pending', 'diproses', 'selesai']) ? 'completed' : ''); ?>">
                            <div class="step-icon">1</div>
                            <div class="step-label">Diterima</div>
                        </div>
                        <div class="timeline-step <?php echo e(in_array($st, ['diproses', 'selesai']) ? 'active' : ''); ?>">
                            <div class="step-icon">2</div>
                            <div class="step-label">Diproses</div>
                        </div>
                        <div class="timeline-step <?php echo e($st === 'selesai' ? 'completed' : ''); ?>">
                            <div class="step-icon">3</div>
                            <div class="step-label">Selesai</div>
                        </div>
                    </div>

                    <div class="status-badge status-<?php echo e($st); ?>" style="margin-bottom: 20px; font-weight: 800; font-size: 0.95rem;">
                        📌 Status Surat: <?php echo e(strtoupper($requestData->status ?? 'DITERIMA')); ?>

                    </div>

                    <dl class="status-details">
                        <div>
                            <dt>Kode Pengajuan</dt>
                            <dd><strong style="color: #0f766e; font-size: 1.15rem;"><?php echo e($requestData->tracking_code); ?></strong></dd>
                        </div>

                        <div>
                            <dt>Nama Pemohon</dt>
                            <dd><?php echo e($requestData->nama); ?></dd>
                        </div>

                        <div>
                            <dt>No. WhatsApp</dt>
                            <dd><?php echo e($requestData->no_hp ?: '-'); ?></dd>
                        </div>

                        <div>
                            <dt>Tanggal Pengajuan</dt>
                            <dd><?php echo e($requestData->created_at?->format('d M Y H:i')); ?> WIB</dd>
                        </div>

                       <?php if($requestData->catatan_admin): ?>
    <div class="status-admin-note" style="grid-column: 1 / -1; background: #ffffff; border: 1px solid #cbd5e1; padding: 18px; border-radius: 16px; margin-top: 18px; box-shadow: 0 6px 20px rgba(0,0,0,0.03);">
        <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
            <div style="width: 28px; height: 28px; background: #e0f2fe; color: #0369a1; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 14px; font-weight: 800;">💬</div>
            <strong style="color: #0f172a; font-size: 0.9rem; font-weight: 800;">Catatan dari Petugas Pelayanan:</strong>
        </div>
        <div style="background: #f8fafc; border: 1px solid #e2e8f0; padding: 12px 16px; border-radius: 12px; color: #334155; font-weight: 600; font-size: 0.9rem; line-height: 1.5;">
            <?php echo e($requestData->catatan_admin); ?>

        </div>
    </div>
<?php endif; ?>
                    </dl>

                    
                    <?php
                        $waRaw = \Illuminate\Support\Facades\DB::table('isi_situs')->where('desa_id', session('desa_id', 1))->where('key', 'no_whatsapp')->value('value') ?? '081234567890';
                        $waPhone = preg_replace('/[^0-9]/', '', $waRaw);
                        if (str_starts_with($waPhone, '0')) {
                            $waPhone = '62' . substr($waPhone, 1);
                        }
                        $waMessage = "Halo Petugas Pelayanan Desa Waha, saya ingin menanyakan perkembangan pengajuan surat dengan Kode Pengajuan (" . $requestData->tracking_code . ") atas nama " . $requestData->nama . ". Terima kasih.";
                    ?>

                    <div style="margin-top: 25px; pt: 15px; border-top: 1px solid #f1f5f9; display: flex; justify-content: flex-end;">
                        <a href="https://api.whatsapp.com/send?phone=<?php echo e($waPhone); ?>&text=<?php echo e(rawurlencode($waMessage)); ?>" target="_blank" class="btn-wa-confirm">
                            💬 Konfirmasi ke WhatsApp Petugas
                        </a>
                    </div>

                <?php else: ?>

                    <div class="status-not-found">
                        <div class="status-not-found-icon">📋</div>
                        <h2>Belum ada pencarian</h2>
                        <p>Masukkan kode pengajuan pada formulir di sebelah kiri untuk melacak perkembangan surat Anda.</p>
                    </div>

                <?php endif; ?>
            </div>

        </div>
    </section>

    
    <?php if(session('success') || session('tracking_code')): ?>
        <div id="successModal" class="modal-overlay-fixed">
            <div class="modal-card-bounce">
                <div class="modal-success-icon">
                    <svg class="checkmark-svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>

                <h2>🎉 Pengajuan Berhasil Dikirim!</h2>
                <p class="modal-subtitle">Permohonan dokumen Anda telah terdaftar dan sedang dalam proses penanganan oleh Petugas Desa Waha.</p>

                <?php if($trackingCode): ?>
                    <div class="tracking-code-box">
                        <span class="tracking-label">KODE PENGAJUAN RESMI ANDA</span>
                        <div class="tracking-code-display">
                            <strong id="trackingCodeText"><?php echo e($trackingCode); ?></strong>
                            <button type="button" class="btn-copy-code" onclick="copyTrackingCode()">
                                📋 Salin Kode
                            </button>
                        </div>
                        <small class="tracking-hint">💡 Simpan kode ini untuk melacak status dokumen Anda.</small>
                    </div>
                <?php endif; ?>

                <div class="modal-action-buttons">
                    <button type="button" onclick="closeSuccessModal()" class="btn-modal-primary">
                        🔎 Lihat Status Surat Saya
                    </button>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    <?php if(session('success') || session('tracking_code')): ?>
        document.addEventListener("DOMContentLoaded", function() {
            window.scrollTo({ top: 0, behavior: 'instant' });
            document.body.style.overflow = 'hidden';
        });
    <?php endif; ?>

    function copyTrackingCode() {
        var codeElement = document.getElementById('trackingCodeText');
        if (codeElement) {
            var codeText = codeElement.innerText;
            navigator.clipboard.writeText(codeText).then(function() {
                alert('✅ Kode Pengajuan (' + codeText + ') berhasil disalin!');
            }).catch(function() {
                alert('Kode Pengajuan: ' + codeText);
            });
        }
    }

    function closeSuccessModal() {
        var modal = document.getElementById('successModal');
        if (modal) {
            modal.remove();
        }
        document.body.style.overflow = 'auto';
        document.body.style.pointerEvents = 'auto';
    }
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\xampp\htdocs\desa_cantik\resources\views/layanan-status.blade.php ENDPATH**/ ?>