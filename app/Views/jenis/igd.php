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
                    Menampilkan Rekam Medis IGD pasien:
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
                        <td>Formulir Pemilihan DPJP</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["dpjp"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["dpjp"][1])) ?>">
                                <?= $data->status["dpjp"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->dpjp['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->dpjp) : ?>
                                <a href="<?= base_url(" rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->dpjp['ttdWali']) ? '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/dpjp/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Hasil Tes dan Konseling HIV</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["hiv"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["hiv"][1])) ?>">
                                <?= $data->status["hiv"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->hiv['petugas']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->hiv) : ?>
                                <a href="<?= base_url(" rm/hiv/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->hiv['petugas']) ? '<a href="' . base_url('/rm/hiv/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/hiv/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/hiv/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/hiv/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Formulir Skrining TBC Untuk Usia &lt; 15 Tahun</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["tbAnak"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["tbAnak"][1])) ?>">
                                <?= $data->status["tbAnak"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->tbAnak['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->tbAnak) : ?>
                                <a href="<?= base_url(" rm/tbAnak/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->tbAnak['ttdWali']) ? '<a href="' . base_url('/rm/tbAnak/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/tbAnak/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/tbAnak/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/tbAnak/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Formulir Skrining TBC Untuk Usia &ge; 15 Tahun</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["tbIbu"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["tbIbu"][1])) ?>">
                                <?= $data->status["tbIbu"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->tbIbu['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->tbIbu) : ?>
                                <a href="<?= base_url(" rm/tbIbu/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->tbIbu['ttdWali']) ? '<a href="' . base_url('/rm/tbIbu/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/tbIbu/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/tbIbu/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/tbIbu/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Formulir Skrining dari Luar Rumah Sakit</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm26jRujukanLuar"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm26jRujukanLuar"][1])) ?>">
                                <?= $data->status["rm26jRujukanLuar"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->rm26jRujukanLuar['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm26jRujukanLuar) : ?>
                                <a href="<?= base_url(" rm/rm26jRujukanLuar/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26jRujukanLuar['ttdWali']) ? '<a href="' . base_url('/rm/rm26jRujukanLuar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26jRujukanLuar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26jRujukanLuar/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm26jRujukanLuar/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Pengkajian Awal Kebidanan</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm7bPengkajian"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm7bPengkajian"][1])) ?>">
                                <?= $data->status["rm7bPengkajian"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->rm7bPengkajian['ttdPetugas']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm7bPengkajian) : ?>
                                <a href="<?= base_url(" rm/rm7bPengkajian/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm7bPengkajian['ttdPetugas']) ? '<a href="' . base_url('/rm/rm7bPengkajian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm7bPengkajian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm7bPengkajian/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm7bPengkajian/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
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