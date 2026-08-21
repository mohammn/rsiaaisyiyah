<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h4 class="mt-2 text-center">Rekam Medis Pasien</h4>

    <?= view('jenis/menu', ['data' => $data]) ?>

    <div class="card mb-4">
        <!-- Card Header: Navigasi Kiri & Toolbar Aksi Kanan -->
        <div class="card-header bg-white border-0 pt-2 pb-2 position-relative d-flex align-items-center justify-content-center">
            <!-- Banner Info Pasien (Presisi di Tengah) -->
            <div class="alert alert-primary d-inline-flex align-items-center mb-0 py-2 px-3 border-0 bg-primary-subtle text-primary-emphasis rounded-pill shadow-xs">
                <i class="fas fa-id-badge me-2 fs-6"></i>
                <span class="small">
                    Menampilkan data Farmasi pasien:
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
                        <td>Obat Pulang</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["obatPulang"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["obatPulang"] ?></span>
                        </td>
                        <td><?= !empty($data->obatPulang['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->obatPulang) : ?>
                                <a href="<?= base_url(" farmasi/obatPulang/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a><?= !empty($data->obatPulang['ttdWali'])  ? ' <a href="' . base_url('/farmasi/obatPulang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : ' <a href="' . base_url('/farmasi/obatPulang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/farmasi/obatPulang/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" farmasi/obatPulang/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>'
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