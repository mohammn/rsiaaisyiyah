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
                    <?php if ($data->lukaOperasi) : ?>
                        <?php for ($i = 0; $i < count($data->lukaOperasi); $i++) :
                            $tglinput = new \DateTime($data->lukaOperasi[$i]["created_at"]) ?>
                            <tr>
                                <td>Surveilans Infeksi Luka Operasi (<?= $tglinput->format('d-m-Y'); ?>)</td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["lukaOperasi"][$i][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                        title="<?= htmlspecialchars(implode(', ', $data->status["lukaOperasi"][$i][1])) ?>">
                                        <?= $data->status["lukaOperasi"][$i][0] ?>
                                    </span>
                                </td>
                                <td><?= !empty($data->lukaOperasi[$i]['petugasPreOperasi']) && !empty($data->lukaOperasi[$i]['petugasRuangOperasi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                                <td>
                                    <a href="<?= base_url(" rm/lukaOperasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) . "/" . $data->lukaOperasi[$i]["id"] ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                    <?= !empty($data->lukaOperasi[$i]['petugasPreOperasi'] && $data->lukaOperasi[$i]['petugasRuangOperasi']) ? '<a href="' . base_url('/rm/lukaOperasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . "/" . $data->lukaOperasi[$i]["id"] . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/lukaOperasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . "/" . $data->lukaOperasi[$i]["id"] . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                    <a href="<?= base_url('/rm/lukaOperasi/' . str_replace('/', '-', $data->pasien['no_rawat'])) . "/" . $data->lukaOperasi[$i]["id"]  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <tr>
                        <td>Surveilans Infeksi Luka Operasi</td>
                        <td>
                            <span class="badge-estetik bg-vibrant-red" title="Bisa ditambah berulang.">
                                Belum
                            </span>
                        </td>
                        <td><span class="badge-estetik bg-vibrant-red">Belum</span></td>
                        <td>
                            <a href="<?= base_url("rm/lukaOperasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>/0" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Surveilans Pemakaian Kateter Urin</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm27bKateter"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm27bKateter"][1])) ?>">
                                <?= $data->status["rm27bKateter"][0] ?>
                            </span>
                        </td>
                        <td><?= (!empty($data->rm27bKateter['petugas1']) || !empty($data->rm27bKateter['petugas2']) || !empty($data->rm27bKateter['petugas3']) || !empty($data->rm27bKateter['petugas4']) || !empty($data->rm27bKateter['petugas5']) || !empty($data->rm27bKateter['petugas6']) || !empty($data->rm27bKateter['petugas7']) || !empty($data->rm27bKateter['petugas8']) || !empty($data->rm27bKateter['petugas9']) || !empty($data->rm27bKateter['petugas10'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm27bKateter) : ?>
                                <a href="<?= base_url(" rm/rm27bKateter/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm27bKateter['petugas1']) || !empty($data->rm27bKateter['petugas2']) || !empty($data->rm27bKateter['petugas3']) || !empty($data->rm27bKateter['petugas4']) || !empty($data->rm27bKateter['petugas5']) || !empty($data->rm27bKateter['petugas6']) || !empty($data->rm27bKateter['petugas7']) || !empty($data->rm27bKateter['petugas8']) || !empty($data->rm27bKateter['petugas9']) || !empty($data->rm27bKateter['petugas10'])) ? '<a href="' . base_url('/rm/rm27bKateter/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm27bKateter/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm27bKateter/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url("rm/rm27bKateter/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Bundle Infeksi Luka Infus</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm27cPlebitis"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm27cPlebitis"][1])) ?>">
                                <?= $data->status["rm27cPlebitis"][0] ?>
                            </span>
                        </td>
                        <td><?= (!empty($data->rm27cPlebitis['petugas1']) || !empty($data->rm27cPlebitis['petugas2']) || !empty($data->rm27cPlebitis['petugas3']) || !empty($data->rm27cPlebitis['petugas4']) || !empty($data->rm27cPlebitis['petugas5']) || !empty($data->rm27cPlebitis['petugas6']) || !empty($data->rm27cPlebitis['petugas7']) || !empty($data->rm27cPlebitis['petugas8']) || !empty($data->rm27cPlebitis['petugas9']) || !empty($data->rm27cPlebitis['petugas10'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm27cPlebitis) : ?>
                                <a href="<?= base_url(" rm/rm27cPlebitis/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm27cPlebitis['petugas1']) || !empty($data->rm27cPlebitis['petugas2']) || !empty($data->rm27cPlebitis['petugas3']) || !empty($data->rm27cPlebitis['petugas4']) || !empty($data->rm27cPlebitis['petugas5']) || !empty($data->rm27cPlebitis['petugas6']) || !empty($data->rm27cPlebitis['petugas7']) || !empty($data->rm27cPlebitis['petugas8']) || !empty($data->rm27cPlebitis['petugas9']) || !empty($data->rm27cPlebitis['petugas10'])) ? '<a href="' . base_url('/rm/rm27cPlebitis/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm27cPlebitis/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm27cPlebitis/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url("rm/rm27cPlebitis/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
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