<?php

/** @var object $data */
$uri              = service('uri');
$segment1         = $uri->getSegment(1); // Mendapatkan 'rm' atau 'jenis'
$currentJenis     = $uri->getSegment(2); // Mendapatkan 'cppt', 'operasi', 'farmasi', atau no_rawat
$noRawatFormatted = str_replace('/', '-', $data->pasien['no_rawat']);

// Cek apakah halaman aktif adalah halaman utama 'rm'
$isHalamanRm = ($segment1 === 'rm' && $currentJenis !== 'cppt');
?>

<div class="d-flex justify-content-center mb-4">
    <!-- Floating Pill Bar -->
    <div class="d-inline-flex align-items-center bg-light p-1 rounded-pill border shadow-sm">

        <!-- Tombol Kembali -->
        <a class="btn btn-sm btn-light text-dark rounded-pill px-3 py-1 border-0 fw-medium me-1 shadow-none"
            href="<?= base_url(session()->get('kembali')) ?>">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>

        <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

        <!-- Daftar Form (Dinamis: Modal jika di RM, Link biasa jika di luar RM) -->
        <?php if ($isHalamanRm): ?>
            <button type="button"
                class="btn btn-sm btn-primary rounded-pill px-3 py-1 fw-semibold mx-1 shadow-sm"
                data-bs-toggle="modal"
                data-bs-target="#modalTambahForm">
                <i class="fas fa-file-medical me-1"></i> Daftar Form
            </button>
        <?php else: ?>
            <a class="btn btn-sm btn-light text-dark rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none"
                href="<?= base_url('rm/' . $noRawatFormatted) ?>">
                <i class="fas fa-file-medical me-1"></i> Daftar Form
            </a>
        <?php endif; ?>

        <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

        <!-- CPPT -->
        <a class="btn btn-sm <?= ($currentJenis == 'cppt') ? 'btn-primary' : 'btn-light text-dark' ?> rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none"
            href="<?= base_url('jenis/cppt/' . $noRawatFormatted) ?>">
            <i class="fas fa-notes-medical me-1"></i> CPPT
        </a>

        <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

        <!-- Operasi / Bedah -->
        <a class="btn btn-sm <?= ($currentJenis == 'operasi') ? 'btn-primary' : 'btn-light text-dark' ?> rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none"
            href="<?= base_url('jenis/operasi/' . $noRawatFormatted) ?>">
            <i class="fas fa-bed-pulse me-1"></i> Operasi
        </a>

        <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

        <!-- Menu Farmasi -->
        <a class="btn btn-sm <?= ($currentJenis == 'farmasi') ? 'btn-primary' : 'btn-light text-dark' ?> rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none"
            href="<?= base_url('jenis/farmasi/' . $noRawatFormatted) ?>">
            <i class="fas fa-pills me-1"></i> Farmasi
        </a>

    </div>
</div>