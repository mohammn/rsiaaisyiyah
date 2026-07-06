<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h3 class="mt-4">Rekam Medis Pasien</h3>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <span class="me-2">
                <a class="btn btn-estetik btn-simpan" href="<?= base_url(session()->get('kembali')) ?>">Kembali</a>
                <button type="button" class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalTambahForm">
                    Daftar Form
                </button>
                Menampilkan data Rekam Medis pasien : <span class="bg-vibrant-blue text-white p-1"> <?= $data->pasien["nm_pasien"] ?> . (<?= $data->pasien["no_rawat"] ?>)</span></span>
        </div>
        <div class="card-body" style="overflow-y: auto;">
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
                    <?php if ($data->skorPoudji): ?>
                        <?php for ($i = 0; $i < count($data->skorPoudji); $i++) :
                            $tglinput = new \DateTime($data->skorPoudji[$i]["tglinput"]);
                        ?>
                            <tr>
                                <td>Skor Poudji Rochjati (<?= $tglinput->format('d-m-Y'); ?>) </td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["skorPoudji"][$i] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["skorPoudji"][$i] ?></span>
                                </td>
                                <td>
                                    <span class="badge-estetik bg-vibrant-teal">&nbsp; - &nbsp;</span>
                                </td>
                                <td>
                                    <a href="<?= base_url(" rm/skorPoudji/" . str_replace('/', '-', $data->pasien["no_rawat"])) . "/" . $data->skorPoudji[$i]["id"]  ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                    <a href="<?= base_url('/rm/skorPoudji/printskor/' .  $data->skorPoudji[$i]["id"]) ?>" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>
                                    <a href="<?= base_url('/rm/skorPoudji/' . str_replace('/', '-', $data->pasien["no_rawat"]) . "/" .  $data->skorPoudji[$i]["id"])  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($data->persRajal) : ?>
                        <tr>
                            <td>Persetujuan Rawat Jalan</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["persRajal"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["persRajal"] ?></span>
                            </td>
                            <td><?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/persetujuanRajal/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->dpjp) : ?>
                        <tr>
                            <td>Formulir Pemilihan DPJP</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["dpjp"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["dpjp"] ?></span>
                            </td>
                            <td><?= !empty($data->dpjp['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->dpjp['ttdWali']) ? '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/dpjp/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rekonsiliasiObat) : ?>
                        <tr>
                            <td>Rekonsiliasi Obat</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rekonsiliasiObat"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rekonsiliasiObat"] ?></span>
                            </td>
                            <td><?= $data->status['rekonsiliasiObat'] === 'Lengkap' ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rekonsiliasiObat/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <a href=" <?= base_url('/rm/rekonsiliasiObat/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>
                                <a href="<?= base_url('/rm/rekonsiliasiObat/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->icGeneral): ?>
                        <?php for ($i = 0; $i < count($data->icGeneral); $i++) : ?>
                            <tr>
                                <td>
                                    <i>Informed Consent</i> <?= ucwords(strtolower($data->icGeneral[$i]["judul"])) ?>
                                </td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["icGeneral"][$i] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["icGeneral"][$i] ?></span>
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
                    <?php if ($data->icDarah) : ?>
                        <tr>
                            <td><i>Informed Consent</i> Darah</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["icDarah"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["icDarah"] ?></span>
                            </td>
                            <td><?= !empty($data->icDarah['ttdWali']) && !empty($data->icDarah['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/icDarah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icDarah['ttdWali'] && $data->icDarah['ttdSaksi']) ? '<a href="' . base_url('/rm/icDarah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icDarah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icDarah/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->icSesar) : ?>
                        <tr>
                            <td><i>Informed Consent</i> Sesar</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["icSesar"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["icSesar"] ?></span>
                            </td>
                            <td><?= !empty($data->icSesar['ttdWali']) && !empty($data->icSesar['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/icSesar/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icSesar['ttdWali'] && $data->icSesar['ttdSaksi']) ? '<a href="' . base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icSesar/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->icPembiusan) : ?>
                        <tr>
                            <td><i>Informed Consent</i> Pembiusan Umum/Sedasi</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["icPembiusan"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["icPembiusan"] ?></span>
                            </td>
                            <td><?= !empty($data->icPembiusan['ttdWali']) && !empty($data->icPembiusan['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/icPembiusan/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icPembiusan['ttdWali'] && $data->icPembiusan['ttdSaksi']) ? '<a href="' . base_url('/rm/icPembiusan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icPembiusan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icPembiusan/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->icPembiusanLokal) : ?>
                        <tr>
                            <td><i>Informed Consent</i> Pembiusan Lokal</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["icPembiusanLokal"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["icPembiusanLokal"] ?></span>
                            </td>
                            <td><?= !empty($data->icPembiusanLokal['ttdWali']) && !empty($data->icPembiusanLokal['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/icPembiusanLokal/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->icPembiusanLokal['ttdWali'] && $data->icPembiusanLokal['ttdSaksi']) ? '<a href="' . base_url('/rm/icPembiusanLokal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/icPembiusanLokal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/icPembiusanLokal/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->lembarEdukasi) : ?>
                        <tr>
                            <td>Lembar Edukasi Terintegrasi</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["lembarEdukasi"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["lembarEdukasi"] ?></span>
                            </td>
                            <td><?= (!empty($data->lembarEdukasi['ttdWali']) && !empty($data->lembarEdukasi['ttd_1']) && !empty($data->lembarEdukasi['ttd_2']) && !empty($data->lembarEdukasi['ttd_3']) && !empty($data->lembarEdukasi['ttd_4']) && !empty($data->lembarEdukasi['ttd_5']) && !empty($data->lembarEdukasi['ttd_6']) && !empty($data->lembarEdukasi['ttd_7'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/lembarEdukasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->lembarEdukasi['ttdWali']) && !empty($data->lembarEdukasi['ttd_1']) && !empty($data->lembarEdukasi['ttd_2']) && !empty($data->lembarEdukasi['ttd_3']) && !empty($data->lembarEdukasi['ttd_4']) && !empty($data->lembarEdukasi['ttd_5']) && !empty($data->lembarEdukasi['ttd_6']) && !empty($data->lembarEdukasi['ttd_7'])) ? '<a href="' . base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/lembarEdukasi/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->persetujuanRanap) : ?>
                        <tr>
                            <td>Persetujuan Rawat Inap</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["persetujuanRanap"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["persetujuanRanap"] ?></span>
                            </td>
                            <td><?= !empty($data->persetujuanRanap['ttdWali']) && !empty($data->persetujuanRanap['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/persetujuanRanap/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->persetujuanRanap['ttdWali'] && $data->persetujuanRanap['ttdSaksi']) ? '<a href="' . base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/persetujuanRanap/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->lukaOperasi) : ?>
                        <?php for ($i = 0; $i < count($data->lukaOperasi); $i++) :
                            $tglinput = new \DateTime($data->lukaOperasi[$i]["created_at"]) ?>
                            <tr>
                                <td>Surveilans Infeksi Luka Operasi (<?= $tglinput->format('d-m-Y'); ?>)</td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["lukaOperasi"][$i] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["lukaOperasi"][$i] ?></span>
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
                    <?php if ($data->rm27cPlebitis) : ?>
                        <tr>
                            <td>Bundle Infeksi Luka Infus</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm27cPlebitis"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm27cPlebitis"] ?></span>
                            </td>
                            <td><?= (!empty($data->rm27cPlebitis['petugas1']) || !empty($data->rm27cPlebitis['petugas2']) || !empty($data->rm27cPlebitis['petugas3']) || !empty($data->rm27cPlebitis['petugas4']) || !empty($data->rm27cPlebitis['petugas5']) || !empty($data->rm27cPlebitis['petugas6']) || !empty($data->rm27cPlebitis['petugas7']) || !empty($data->rm27cPlebitis['petugas8']) || !empty($data->rm27cPlebitis['petugas9']) || !empty($data->rm27cPlebitis['petugas10'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm27cPlebitis/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm27cPlebitis['petugas1']) || !empty($data->rm27cPlebitis['petugas2']) || !empty($data->rm27cPlebitis['petugas3']) || !empty($data->rm27cPlebitis['petugas4']) || !empty($data->rm27cPlebitis['petugas5']) || !empty($data->rm27cPlebitis['petugas6']) || !empty($data->rm27cPlebitis['petugas7']) || !empty($data->rm27cPlebitis['petugas8']) || !empty($data->rm27cPlebitis['petugas9']) || !empty($data->rm27cPlebitis['petugas10'])) ? '<a href="' . base_url('/rm/rm27cPlebitis/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm27cPlebitis/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm27cPlebitis/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm27bKateter) : ?>
                        <tr>
                            <td>Surveilans Pemakaian Kateter Urin</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm27bKateter"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm27bKateter"] ?></span>
                            </td>
                            <td><?= (!empty($data->rm27bKateter['petugas1']) || !empty($data->rm27bKateter['petugas2']) || !empty($data->rm27bKateter['petugas3']) || !empty($data->rm27bKateter['petugas4']) || !empty($data->rm27bKateter['petugas5']) || !empty($data->rm27bKateter['petugas6']) || !empty($data->rm27bKateter['petugas7']) || !empty($data->rm27bKateter['petugas8']) || !empty($data->rm27bKateter['petugas9']) || !empty($data->rm27bKateter['petugas10'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm27bKateter/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm27bKateter['petugas1']) || !empty($data->rm27bKateter['petugas2']) || !empty($data->rm27bKateter['petugas3']) || !empty($data->rm27bKateter['petugas4']) || !empty($data->rm27bKateter['petugas5']) || !empty($data->rm27bKateter['petugas6']) || !empty($data->rm27bKateter['petugas7']) || !empty($data->rm27bKateter['petugas8']) || !empty($data->rm27bKateter['petugas9']) || !empty($data->rm27bKateter['petugas10'])) ? '<a href="' . base_url('/rm/rm27bKateter/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm27bKateter/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm27bKateter/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm0Sbar): ?>
                        <?php for ($i = 0; $i < count($data->rm0Sbar); $i++) : ?>
                            <tr>
                                <td>Catatan Komunikasi SBAR ( <?= $data->rm0Sbar[$i]["judul"] ?>) </td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["rm0Sbar"][0][$i] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm0Sbar"][0][$i] ?></span>
                                </td>
                                <td><?= $data->status["rm0Sbar"][1][$i] === 'Sudah' ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                                <td>
                                    <a href="<?= base_url(" rm/rm0Sbar/" . str_replace('/', '-', $data->pasien["no_rawat"])) . "/" . $data->rm0Sbar[$i]["id"]  ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                    <a href="<?= base_url('/rm/rm0Sbar/cetak/'  . str_replace('/', '-', $data->pasien['no_rawat']) . '/' .   $data->rm0Sbar[$i]["id"]) ?>" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>
                                    <a href="<?= base_url('/rm/rm0Sbar/' . str_replace('/', '-', $data->pasien["no_rawat"]) . "/" .  $data->rm0Sbar[$i]["id"])  ?>#modalHapusJudul" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($data->rm20bUdds) : ?>
                        <tr>
                            <td>Serah Terima Pemberian Unit UDDS</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm20bUdds"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm20bUdds"] ?></span>
                            </td>
                            <td><?= (!empty($data->rm20bUdds['dokter']) || !empty($data->rm20bUdds['pemberiObat']) || !empty($data->rm20bUdds['pemberiObatOral']) || !empty($data->rm20bUdds['apoteker'])) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm20bUdds/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= (!empty($data->rm20bUdds['dokter']) || !empty($data->rm20bUdds['pemberiObat']) || !empty($data->rm20bUdds['pemberiObatOral']) || !empty($data->rm20bUdds['apoteker'])) ? '<a href="' . base_url('/rm/rm20bUdds/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm20bUdds/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm20bUdds/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm3TataTertib) : ?>
                        <tr>
                            <td>Tata Tertib Rawat Inap</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm3TataTertib"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm3TataTertib"] ?></span>
                            </td>
                            <td><?= !empty($data->rm3TataTertib['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm3TataTertib/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm3TataTertib['ttdWali']) ? '<a href="' . base_url('/rm/rm3TataTertib/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm3TataTertib/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm3TataTertib/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm26ePendapatLain) : ?>
                        <tr>
                            <td>Permohonan Pendapat Lain</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm26ePendapatLain"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm26ePendapatLain"] ?></span>
                            </td>
                            <td><?= !empty($data->rm26ePendapatLain['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm26ePendapatLain/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26ePendapatLain['ttdWali']) ? '<a href="' . base_url('/rm/rm26ePendapatLain/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26ePendapatLain/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26ePendapatLain/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm26nIzinKeluar) : ?>
                        <tr>
                            <td>Izin Keluar Rumah Sakit Sementara</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm26nIzinKeluar"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm26nIzinKeluar"] ?></span>
                            </td>
                            <td><?= !empty($data->rm26nIzinKeluar['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm26nIzinKeluar/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26nIzinKeluar['ttdWali']) ? '<a href="' . base_url('/rm/rm26nIzinKeluar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26nIzinKeluar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26nIzinKeluar/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm26fKerohanian) : ?>
                        <tr>
                            <td>Permintaan Pelayanan Kerohanian</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm26fKerohanian"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm26fKerohanian"] ?></span>
                            </td>
                            <td><?= !empty($data->rm26fKerohanian['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm26fKerohanian/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26fKerohanian['ttdWali']) ? '<a href="' . base_url('/rm/rm26fKerohanian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26fKerohanian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26fKerohanian/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm26hKepercayaan) : ?>
                        <tr>
                            <td>Identifikasi Nilai-nilai dan Kepercayaan Pasien</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm26hKepercayaan"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm26hKepercayaan"] ?></span>
                            </td>
                            <td><?= !empty($data->rm26hKepercayaan['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm26hKepercayaan/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26hKepercayaan['ttdWali']) ? '<a href="' . base_url('/rm/rm26hKepercayaan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26hKepercayaan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26hKepercayaan/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rm26iPenyimpananBarang) : ?>
                        <tr>
                            <td>Daftar Penyimpanan Barang Pasien</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rm26iPenyimpananBarang"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rm26iPenyimpananBarang"] ?></span>
                            </td>
                            <td><?= !empty($data->rm26iPenyimpananBarang['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rm26iPenyimpananBarang/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->rm26iPenyimpananBarang['ttdWali']) ? '<a href="' . base_url('/rm/rm26iPenyimpananBarang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/rm26iPenyimpananBarang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/rm26iPenyimpananBarang/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah Form -->
<div class="modal modal-lg fade" id="modalTambahForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-responsive-lg" id="tabelForm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Form</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Skor Poudji Rochjati</td>
                            <td>
                                <a href="<?= base_url("rm/skorPoudji/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>/0" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Persetujuan Rawat Jalan</td>
                            <td>
                                <?= $data->persRajal ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>3.</td>
                            <td>Formulir Pemilihan DPJP</td>
                            <td>
                                <?= $data->dpjp ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>4.</td>
                            <td>Rekonsiliasi Obat</td>
                            <td>
                                <?= $data->rekonsiliasiObat ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rekonsiliasiObat/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>5.</td>
                            <td><i>Informed Consent</i> General</td>
                            <td>
                                <a href="<?= base_url("rm/icGeneral/" . str_replace('/', '-', $data->pasien["no_rawat"]) . "/0") ?>" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            </td>
                        </tr>
                        <tr>
                            <td>6.</td>
                            <td><i>Informed Consent</i> Darah</td>
                            <td>
                                <?= $data->icDarah ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/icDarah/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>7.</td>
                            <td><i>Informed Consent</i> Sesar</td>
                            <td>
                                <?= $data->icSesar ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/icSesar/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>8.</td>
                            <td><i>Informed Consent</i> Pembiusan Umum/Sedasi</td>
                            <td>
                                <?= $data->icPembiusan ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/icPembiusan/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>9.</td>
                            <td><i>Informed Consent</i> Pembiusan Lokal</td>
                            <td>
                                <?= $data->icPembiusanLokal ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/icPembiusanLokal/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>10.</td>
                            <td>Lembar Edukasi Terintegrasi</td>
                            <td>
                                <?= $data->lembarEdukasi ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/lembarEdukasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>11.</td>
                            <td>Persetujuan Rawat Inap</td>
                            <td>
                                <?= $data->persetujuanRanap ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/persetujuanRanap/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>12.</td>
                            <td>Surveilans Infeksi Luka Operasi</td>
                            <td>
                                <a href="<?= base_url("rm/lukaOperasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>/0" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            </td>
                        </tr>
                        <tr>
                            <td>13.</td>
                            <td>Bundle Infeksi Luka Infus</td>
                            <td>
                                <?= $data->rm27cPlebitis ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm27cPlebitis/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>14.</td>
                            <td>Surveilans Pemakaian Kateter Urin</td>
                            <td>
                                <?= $data->rm27bKateter ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm27bKateter/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>15.</td>
                            <td>Catatan Komunikasi SBAR</td>
                            <td>
                                <a href="<?= base_url("rm/rm0Sbar/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>/0" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            </td>
                        </tr>
                        <tr>
                            <td>16.</td>
                            <td>Serah Terima Pemberian Unit UDDS</td>
                            <td>
                                <?= $data->rm20bUdds ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm20bUdds/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>17.</td>
                            <td>Tata Tertib Rawat Inap</td>
                            <td>
                                <?= $data->rm3TataTertib ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm3TataTertib/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>18.</td>
                            <td>Permohonan Pendapat Lain</td>
                            <td>
                                <?= $data->rm26ePendapatLain ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm26ePendapatLain/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>19.</td>
                            <td>Izin Keluar Rumah Sakit Sementara</td>
                            <td>
                                <?= $data->rm26nIzinKeluar ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm26nIzinKeluar/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>20.</td>
                            <td>Permintaan Pelayanan Kerohanian</td>
                            <td>
                                <?= $data->rm26fKerohanian ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm26fKerohanian/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>20.</td>
                            <td>Identifikasi Nilai-nilai dan Kepercayaan Pasien</td>
                            <td>
                                <?= $data->rm26hKepercayaan ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm26hKepercayaan/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>21.</td>
                            <td>Daftar Penyimpanan Barang Pasien</td>
                            <td>
                                <?= $data->rm26iPenyimpananBarang ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rm26iPenyimpananBarang/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tabelRm').DataTable({
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
            "paginate": { // <-- Di sini diubah dari oPaginate menjadi paginate
                "sFirst": "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya",
                "sLast": "Terakhir"
            }
        },
        "responsive": true,
        "retrieve": true
    });

    $('#tabelForm').DataTable({
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
            "paginate": { // <-- Di sini diubah dari oPaginate menjadi paginate
                "sFirst": "Pertama",
                "sPrevious": "Sebelumnya",
                "sNext": "Selanjutnya",
                "sLast": "Terakhir"
            }
        },
        "responsive": true,
        "retrieve": true
    });

    $(document).ready(function() {
        if (window.location.hash === '#modalTambahForm') {
            var myModal = new bootstrap.Modal(document.getElementById('modalTambahForm'));
            myModal.show();
        }
    });
</script>

<?php $this->endSection() ?>