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
                    Menampilkan Rekam Medis pasien:
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
                        <td>Persetujuan Rawat Jalan</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["persRajal"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["persRajal"][1])) ?>">
                                <?= $data->status["persRajal"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->persRajal) : ?>
                                <a href="<?= base_url(" rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/persetujuanRajal/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Persetujuan Rawat Inap</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["persetujuanRanap"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["persetujuanRanap"][1])) ?>">
                                <?= $data->status["persetujuanRanap"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->persetujuanRanap['ttdWali']) && !empty($data->persetujuanRanap['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->persetujuanRanap) : ?>
                                <a href="<?= base_url(" rm/persetujuanRanap/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->persetujuanRanap['ttdWali'] && $data->persetujuanRanap['ttdSaksi']) ? '<a href="' . base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/persetujuanRanap/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/persetujuanRanap/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <i>Informed Consent General</i>
                        </td>
                        <td>
                            <span class="badge-estetik bg-vibrant-red" title="Bisa ditambah berulang.">
                                Belum
                            </span>
                        </td>
                        <td><span class="badge-estetik bg-vibrant-red">Belum</span></td>
                        <td>
                            <a href="<?= base_url("rm/icGeneral/" . str_replace('/', '-', $data->pasien["no_rawat"]) . "/0") ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                        </td>
                    </tr>

                    <?php if ($data->icGeneral): ?>
                        <?php for ($i = 0; $i < count($data->icGeneral); $i++) : ?>
                            <tr>
                                <td>
                                    <i>Informed Consent</i> <?= ucwords(strtolower($data->icGeneral[$i]["judul"])) ?>
                                </td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["icGeneral"][$i][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                        title="<?= htmlspecialchars(implode(', ', $data->status["icGeneral"][$i][1])) ?>">
                                        <?= $data->status["icGeneral"][$i][0] ?>
                                    </span>
                                </td>
                                <td><?= !empty($data->icGeneral[$i]['ttdWali'] && $data->icGeneral[$i]['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                                <td>
                                    <a href="<?= base_url(" rm/icGeneral/" . str_replace('/', '-', $data->pasien["no_rawat"])) . "/" . $data->icGeneral[$i]["id"]  ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                    <?= !empty($data->icGeneral[$i]['ttdWali'] && $data->icGeneral[$i]['ttdSaksi']) ? '<a href="' . base_url('/rm/icGeneral/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . "/" . $data->icGeneral[$i]["id"]) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icGeneral/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . "/" . $data->icGeneral[$i]["id"]) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                    <a href="<?= base_url('/rm/icGeneral/' . str_replace('/', '-', $data->pasien["no_rawat"]) . "/" .  $data->icGeneral[$i]["id"])  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>

                    <tr>
                        <td><i>Informed Consent</i> Darah</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["icDarah"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["icDarah"][1])) ?>">
                                <?= $data->status["icDarah"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->icDarah['ttdWali']) && !empty($data->icDarah['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->icDarah) : ?>
                                <a href="<?= base_url(" rm/icDarah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icDarah['ttdWali'] && $data->icDarah['ttdSaksi']) ? '<a href="' . base_url('/rm/icDarah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icDarah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icDarah/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/icDarah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td><i>Informed Consent</i> Sesar</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["icSesar"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["icSesar"][1])) ?>">
                                <?= $data->status["icSesar"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->icSesar['ttdWali']) && !empty($data->icSesar['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->icSesar) : ?>
                                <a href="<?= base_url(" rm/icSesar/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icSesar['ttdWali'] && $data->icSesar['ttdSaksi']) ? '<a href="' . base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icSesar/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/icSesar/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td><i>Informed Consent</i> Pembiusan Umum/Sedasi</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["icPembiusan"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["icPembiusan"][1])) ?>">
                                <?= $data->status["icPembiusan"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->icPembiusan['ttdWali']) && !empty($data->icPembiusan['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->icPembiusan) : ?>
                                <a href="<?= base_url(" rm/icPembiusan/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icPembiusan['ttdWali'] && $data->icPembiusan['ttdSaksi']) ? '<a href="' . base_url('/rm/icPembiusan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icPembiusan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icPembiusan/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/icPembiusan/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>

                    <tr>
                        <td><i>Informed Consent</i> Pembiusan Lokal</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["icPembiusanLokal"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["icPembiusanLokal"][1])) ?>">
                                <?= $data->status["icPembiusanLokal"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->icPembiusanLokal['ttdWali']) && !empty($data->icPembiusanLokal['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->icPembiusanLokal) : ?>
                                <a href="<?= base_url(" rm/icPembiusanLokal/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icPembiusanLokal['ttdWali'] && $data->icPembiusanLokal['ttdSaksi']) ? '<a href="' . base_url('/rm/icPembiusanLokal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icPembiusanLokal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icPembiusanLokal/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/icPembiusanLokal/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Lembar Edukasi Terintegrasi</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["lembarEdukasi"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["lembarEdukasi"][1])) ?>">
                                <?= $data->status["lembarEdukasi"][0] ?>
                            </span>
                        </td>
                        <td><?= (!empty($data->lembarEdukasi['ttdWali']) && !empty($data->lembarEdukasi['ttd_1']) && !empty($data->lembarEdukasi['ttd_2']) && !empty($data->lembarEdukasi['ttd_3']) && !empty($data->lembarEdukasi['ttd_4']) && !empty($data->lembarEdukasi['ttd_5']) && !empty($data->lembarEdukasi['ttd_6']) && !empty($data->lembarEdukasi['ttd_7'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->lembarEdukasi) : ?>
                                <a href="<?= base_url(" rm/lembarEdukasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->lembarEdukasi['ttdWali']) && !empty($data->lembarEdukasi['ttd_1']) && !empty($data->lembarEdukasi['ttd_2']) && !empty($data->lembarEdukasi['ttd_3']) && !empty($data->lembarEdukasi['ttd_4']) && !empty($data->lembarEdukasi['ttd_5']) && !empty($data->lembarEdukasi['ttd_6']) && !empty($data->lembarEdukasi['ttd_7'])) ? '<a href="' . base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/lembarEdukasi/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/lembarEdukasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Tata Tertib Rawat Inap</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm3TataTertib"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm3TataTertib"][1])) ?>">
                                <?= $data->status["rm3TataTertib"][0] ?>
                            </span>
                        </td>
                        <td><?= !empty($data->rm3TataTertib['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm3TataTertib) : ?>
                                <a href="<?= base_url(" rm/rm3TataTertib/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm3TataTertib['ttdWali']) ? '<a href="' . base_url('/rm/rm3TataTertib/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm3TataTertib/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm3TataTertib/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm3TataTertib/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Surat Permintaan Masuk Rumah Sakit</td>
                        <td>
                            <span class="badge-estetik <?= $data->status["rm4PermintaanMasuk"][0] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?>"
                                title="<?= htmlspecialchars(implode(', ', $data->status["rm4PermintaanMasuk"][1])) ?>">
                                <?= $data->status["rm4PermintaanMasuk"][0] ?>
                            </span>
                        </td>
                        <td><?= (!empty($data->rm4PermintaanMasuk['ttdWali']) and !empty($data->rm4PermintaanMasuk['ttdDokter']) and !empty($data->rm4PermintaanMasuk['ttdPetugas'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                        <td>
                            <?php if ($data->rm4PermintaanMasuk) : ?>
                                <a href="<?= base_url(" rm/rm4PermintaanMasuk/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm4PermintaanMasuk['ttdWali']) and !empty($data->rm4PermintaanMasuk['ttdDokter']) and !empty($data->rm4PermintaanMasuk['ttdPetugas'])) ? '<a href="' . base_url('/rm/rm4PermintaanMasuk/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm4PermintaanMasuk/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm4PermintaanMasuk/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            <?php else: ?>
                                <a href="<?= base_url(" rm/rm4PermintaanMasuk/" . str_replace('/', '-', $data->pasien["no_rawat"]))  ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
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