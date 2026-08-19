<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h4 class="mt-2 text-center">Rekam Medis Pasien</h4>

    <!-- Container Utama Toolbar Tengah -->
    <div class="d-flex justify-content-center mb-4">
        <!-- Floating Pill Bar -->
        <div class="d-inline-flex align-items-center bg-light p-1 rounded-pill border shadow-sm">
            <a class="btn btn-sm btn-light text-dark rounded-pill px-3 py-1 border-0 fw-medium me-1 shadow-none"
                href="<?= base_url(session()->get('kembali')) ?>">
                <i class="fas fa-arrow-left me-1"></i> Kembali
            </a>
            <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

            <!-- Daftar Form (Primary Accent) -->
            <a class="btn btn-sm btn-light text-dark rounded-pill px-3 py-1 border-0 fw-medium me-1 ms-1 shadow-none"
                href="<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>">
                <i class="fas fa-file-medical me-1"></i> Daftar Form
            </a>
            <!-- Garis Pemisah 2 -->
            <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

            <!-- CPPT (Catatan Perkembangan Pasien Terintegrasi) -->
            <a class="btn btn-sm btn-light text-dark rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none"
                href="<?= base_url('rm/cppt/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>">
                <i class="fas fa-notes-medical me-1"></i> CPPT
            </a>

            <!-- Garis Pemisah 3 -->
            <div class="vr bg-secondary opacity-25 align-self-center" style="height: 16px;"></div>

            <!-- Operasi / Bedah -->

            <button type="button" class="btn btn-sm btn-primary rounded-pill px-3 py-1 border-0 fw-medium mx-1 shadow-none">
                <i class="fas fa-bed-pulse me-1"></i> Operasi
            </button>

        </div>
    </div>


    <div class="card mb-4">
        <!-- Card Header: Navigasi Kiri & Toolbar Aksi Kanan -->
        <div class="card-header bg-white border-0 pt-2 pb-2 position-relative d-flex align-items-center justify-content-center">
            <!-- Banner Info Pasien (Presisi di Tengah) -->
            <div class="alert alert-primary d-inline-flex align-items-center mb-0 py-2 px-3 border-0 bg-primary-subtle text-primary-emphasis rounded-pill shadow-xs">
                <i class="fas fa-id-badge me-2 fs-6"></i>
                <span class="small">
                    Menampilkan Rekam medis operasi pasien:
                    <strong class="bg-vibrant-blue text-white px-2 py-1 rounded-pill ms-1">
                        <?= $data->pasien["nm_pasien"] ?> . (<?= $data->pasien["no_rawat"] ?>)
                    </strong>
                </span>
            </div>

        </div>

        <!-- Card Body: Highlight Pasien & Data Tabel -->
        <div class="card-body" style="overflow-y: auto; max-height: calc(100vh - 300px);">

            <!-- Tabel Data Anda Berada di Bawah Ini -->

            <table class="table table-striped table-responsive-lg" id="tabelRm">
                <thead>
                    <tr>
                        <th>Nama Form</th>
                        <th>Status</th>
                        <th>TTD</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="tabelDataRm">

                    <tr>
                        <td>Checklist Keselamatan di Kamar Bedah</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm11b1Checklist"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm11b1Checklist"] ?></span>
                        </td>
                        <td><?= (!empty($data->rm11b1Checklist['ttdPerawatAnestesi']) && !empty($data->rm11b1Checklist['ttdDokterAnestesi1']) && !empty($data->rm11b1Checklist['ttdSirkuler']) && !empty($data->rm11b1Checklist['ttdInstrumen']) && !empty($data->rm11b1Checklist['ttdAsisten']) && !empty($data->rm11b1Checklist['ttdOperator']) && !empty($data->rm11b1Checklist['ttdDokterAnestesi2'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm11b1Checklist) : ?>
                                <a href="<?= base_url(" rm/rm11b1Checklist/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a><?= (!empty($data->rm11b1Checklist['ttdPerawatAnestesi']) && !empty($data->rm11b1Checklist['ttdDokterAnestesi1']) && !empty($data->rm11b1Checklist['ttdSirkuler']) && !empty($data->rm11b1Checklist['ttdInstrumen']) && !empty($data->rm11b1Checklist['ttdAsisten']) && !empty($data->rm11b1Checklist['ttdOperator']) && !empty($data->rm11b1Checklist['ttdDokterAnestesi2'])) ? ' <a href="' . base_url('/rm/rm11b1Checklist/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : ' <a href="' . base_url('/rm/rm11b1Checklist/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm11b1Checklist/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm11b1Checklist/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>'
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Penandaan Lokasi Operasi</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm11a1Bedah"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm11a1Bedah"] ?></span>
                        </td>
                        <td><?= !empty($data->rm11a1Bedah['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm11a1Bedah) : ?>
                                <a href="<?= base_url(" rm/rm11a1Bedah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm11a1Bedah['ttdWali']) ? '<a href="' . base_url('/rm/rm11a1Bedah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm11a1Bedah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm11a1Bedah/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm11a1Bedah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>'
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Timbang Terima Untuk Keselamatan Pembedahan</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm11a2Timbang"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm11a2Timbang"] ?></span>
                        </td>
                        <td><?= !empty($data->rm11a2Timbang['ttdPengantar']) && !empty($data->rm11a2Timbang['ttdPenerima']) && !empty($data->rm11a2Timbang['ttdPengantar2']) && !empty($data->rm11a2Timbang['ttdPenerima2']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm11a2Timbang) : ?>
                                <a href="<?= base_url(" rm/rm11a2Timbang/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm11a2Timbang['ttdPengantar']) && !empty($data->rm11a2Timbang['ttdPenerima']) && !empty($data->rm11a2Timbang['ttdPengantar2']) && !empty($data->rm11a2Timbang['ttdPenerima2']) ? '<a href="' . base_url('/rm/rm11a2Timbang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm11a2Timbang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm11a2Timbang/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm11a2Timbang/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>'
                            <?php endif; ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $('#tabelRm').DataTable({
        "pageLength": 25, // <-- Menyetel tampilan awal menjadi 25 entri
        "language": {
            "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
            "sProcessing": "Sedang memproses...",
            "sLengthMenu": "Tampilkan _MENU_ entri",
            "sZeroRecords": "Tidak ditemukan data yang sesuai",
            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
            "sInfoPostFix": "",
            "sSearch": "Cari:",
            "sUrl": "",
            "paginate": {
                "sFirst": "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya",
                "sLast": "Terakhir"
            }
        },
        "responsive": true,
        "retrieve": true
    });
</script>

<?php $this->endSection() ?>