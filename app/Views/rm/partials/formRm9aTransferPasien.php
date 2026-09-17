<?php

/** @var object $data */
?>
<style>
    /* Efek hover pada pembungkus form-check */
    .hover-check {
        padding: 0px 30px;
        border-radius: 6px;
        transition: all 0.2s ease-in-out;
        cursor: pointer;
    }

    .hover-check:hover {
        background-color: #f0f7ff;
        /* Warna biru muda transparan */
        color: #70a9ff;
        /* Mengubah warna teks menjadi biru Bootstrap */
    }

    /* Membuat kursor pointer saat mengarah ke checkbox dan labelnya */
    .hover-check .form-check-input,
    .hover-check .form-check-label {
        cursor: pointer;
    }
</style>
<form>
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <div class="row mt-2">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Penanggung jawab :</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->rm9aTransferPasien['nama'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 bg-light border border-info p-2 rounded">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">JUDUL :</label>
                        <input type="text" class="form-control" id="judul" name="judul" value="<?= $data->rm9aTransferPasien['judul'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bertindak sbg :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->rm9aTransferPasien['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-check mt-4">
                            <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                            <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">dari unit :</label>
                        <input type="text" class="form-control" id="dariUnit" value="<?= $data->rm9aTransferPasien['dariUnit'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">ke unit :</label>
                        <input type="text" class="form-control" id="keUnit" value="<?= $data->rm9aTransferPasien['keUnit'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">DPJP :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->rm9aTransferPasien['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->rm9aTransferPasien['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Waktu :</label>
                        <input type="datetime-local" class="form-control" id="waktu" value="<?= $data->rm9aTransferPasien['waktu'] ?? '' ?>">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <p class="form-label fw-bold small text-secondary mb-0">Metode Pemindahan :</p>
                            <div class="d-flex flex-wrap align-items-center mt-2 gap-1">
                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="metodePindah" value="Kursi Roda" id="pindahKursiRoda" <?= ($data->rm9aTransferPasien['metodePindah'] ?? '') === 'Kursi Roda' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="pindahKursiRoda">Kursi Roda</label>
                                </div>

                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="metodePindah" value="Brankar" id="pindahBrankar" <?= ($data->rm9aTransferPasien['metodePindah'] ?? '') === 'Brankar' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="pindahBrankar">Brankar</label>
                                </div>

                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="metodePindah" value="Tempat Tidur" id="pindahTempatTidur" <?= ($data->rm9aTransferPasien['metodePindah'] ?? '') === 'Tempat Tidur' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="pindahTempatTidur">Tempat Tidur</label>
                                </div>

                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="metodePindah" value="Jalan Sendiri" id="pindahJalanSendiri" <?= ($data->rm9aTransferPasien['metodePindah'] ?? '') === 'Jalan Sendiri' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="pindahJalanSendiri">Jalan Sendiri</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <!-- PROSES DECODE JSON INDIKASI PINDAH -->
                    <?php
                    $indikasiPindah = [];
                    if (!empty($data->rm9aTransferPasien['indikasiPindah'])) {
                        $decodeIndikasi = json_decode($data->rm9aTransferPasien['indikasiPindah'], true);
                        $indikasiPindah = is_array($decodeIndikasi) ? $decodeIndikasi : [];
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <p class="form-label fw-bold small text-secondary mb-0">Indikasi Pindah :</p>
                            <div class="d-flex flex-wrap align-items-center mt-1 gap-1">

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Kondisi Pasien Stabil" id="indStabil" <?= in_array('Kondisi Pasien Stabil', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indStabil">Kondisi Pasien Stabil</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Kondisi Pasien Tidak Ada Perubahan" id="indTidakAdaPerubahan" <?= in_array('Kondisi Pasien Tidak Ada Perubahan', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indTidakAdaPerubahan">Kondisi Pasien Tidak Ada Perubahan</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Kondisi Pasien Memburuk" id="indMemburuk" <?= in_array('Kondisi Pasien Memburuk', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indMemburuk">Kondisi Pasien Memburuk</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Fasilitas Kurang Baik" id="indFasitasKurangMembaik" <?= in_array('Fasilitas Kurang Baik', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indFasitasKurangMembaik">Fasilitas Kurang Baik</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Fasilitas Butuh Lebih Baik" id="indFasilitasButuhLebihBaik" <?= in_array('Fasilitas Butuh Lebih Baik', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indFasilitasButuhLebihBaik">Fasilitas Butuh Lebih Baik</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Tenaga Kurang" id="indTenagaKurang" <?= in_array('Tenaga Kurang', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indTenagaKurang">Tenaga Kurang</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Tenaga Membutuhkan Yang Lebih Ahli" id="indTenagaLebihAhli" <?= in_array('Tenaga Membutuhkan Yang Lebih Ahli', $indikasiPindah) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="indTenagaLebihAhli">Tenaga Membutuhkan Yang Lebih Ahli</label>
                                </div>

                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="indikasiPindah[]" value="Lain-Lain" id="indLainLain" <?= in_array('Lain-Lain', $indikasiPindah) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="indLainLain">Lain-Lain :</label>
                                    </div>
                                    <input type="text" name="isiIndikasiLainnya" id="isiIndikasiLainnya" class="form-control form-control-sm border-info" style="max-width: 200px;" value="<?= $data->rm9aTransferPasien['isiIndikasiLainnya'] ?? '' ?>">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosa :</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3"><?= $data->rm9aTransferPasien['diagnosa'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tindakan yang sudah dilakukan :</label>
                        <textarea name="tindakan" id="tindakan" class="form-control"><?= $data->rm9aTransferPasien['tindakan'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Obat-obatan yang diberikan :</label>
                        <textarea name="obat" id="obat" class="form-control"><?= $data->rm9aTransferPasien['obat'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pemeriksaan penunjang yang sudah dilakukan :</label>
                        <textarea name="pemeriksaan" id="pemeriksaan" class="form-control"><?= $data->rm9aTransferPasien['pemeriksaan'] ?? '' ?></textarea>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-12 text-center">Keadaaan Pasien :</div>
                    <hr>
                </div>
                <div class="row mt-2">
                    <!-- PROSES DECODE JSON PENGGUNAAN ALAT MEDIS -->
                    <?php
                    $alatMedis = [];
                    if (!empty($data->rm9aTransferPasien['alatMedis'])) {
                        $decodeAlatMedis = json_decode($data->rm9aTransferPasien['alatMedis'], true);
                        $alatMedis = is_array($decodeAlatMedis) ? $decodeAlatMedis : [];
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <p class="form-label fw-bold small text-secondary mb-0">Penggunaan Alat Medis :</p>
                            <div class="d-flex flex-wrap align-items-center mt-2 gap-1">

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Oksigen Portable" id="alatOksigen" <?= in_array('Oksigen Portable', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatOksigen">Oksigen Portable</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Infus" id="alatInfus" <?= in_array('Infus', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatInfus">Infus</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="NGT" id="alatNGT" <?= in_array('NGT', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatNGT">NGT</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Syringe Pump" id="alatSyringePump" <?= in_array('Syringe Pump', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatSyringePump">Syringe Pump</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Suction" id="alatSuction" <?= in_array('Suction', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatSuction">Suction</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Kateter Urin" id="alatKateterUrin" <?= in_array('Kateter Urin', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatKateterUrin">Kateter Urin</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="alatMedis[]" value="Tidak Ada" id="alatTidakAda" <?= in_array('Tidak Ada', $alatMedis) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="alatTidakAda">Tidak Ada</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <p class="form-label fw-bold small text-secondary mb-0">Pasien/Keluarga Mengetahui & Menyetujui Alasan Pemindahan :</p>
                            <div class="d-flex flex-wrap align-items-center mt-2 gap-3">

                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="setuju" value="Ya" id="setujuYa" <?= ($data->rm9aTransferPasien['setuju'] ?? '') === 'Ya' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="setujuYa">Ya</label>
                                </div>

                                <div class="form-check hover-check">
                                    <input class="form-check-input" type="radio" name="setuju" value="Tidak" id="setujuTidak" <?= ($data->rm9aTransferPasien['setuju'] ?? '') === 'Tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="setujuTidak">Tidak</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-2">
                            <p class="form-label fw-bold small text-secondary mb-2">Keadaan Pasien Saat Pindah Sebelum Transfer :</p>

                            <div class="row g-2">
                                <!-- Baris 1: K/U, TD, N -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanKU">K/U :</label>
                                        <input type="text" name="keadaanKU" id="keadaanKU" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanKU'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanTD">TD :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanTD" id="keadaanTD" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanTD'] ?? '' ?>">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanN">N :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanN" id="keadaanN" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanN'] ?? '' ?>">
                                            <span class="input-group-text">x/mnt</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2: S, CRT, RR -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanS">S :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanS" id="keadaanS" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanS'] ?? '' ?>">
                                            <span class="input-group-text">&deg;C</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanCRT">CRT :</label>
                                        <input type="text" name="keadaanCRT" id="keadaanCRT" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanCRT'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanRR">RR :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanRR" id="keadaanRR" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanRR'] ?? '' ?>">
                                            <span class="input-group-text">x/mnt</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3: Lain - Lain -->
                                <div class="col-md-12 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanLainLain">Lain – Lain :</label>
                                        <input type="text" name="keadaanLainLain" id="keadaanLainLain" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanLainLain'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Keluhan Utama :</label>
                                    <textarea name="keluhanUtama" id="keluhanUtama" class="form-control"><?= $data->rm9aTransferPasien['keluhanUtama'] ?? '' ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-2">
                            <p class="form-label fw-bold small text-secondary mb-2">Keadaan Pasien Saat Pindah Setelah Transfer :</p>

                            <div class="row g-2">
                                <!-- Baris 1: K/U, TD, N -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanKU2">K/U :</label>
                                        <input type="text" name="keadaanKU2" id="keadaanKU2" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanKU2'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanTD2">TD :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanTD2" id="keadaanTD2" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanTD2'] ?? '' ?>">
                                            <span class="input-group-text">mmHg</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanN2">N :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanN2" id="keadaanN2" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanN2'] ?? '' ?>">
                                            <span class="input-group-text">x/mnt</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2: S, CRT, RR -->
                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanS2">S :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanS2" id="keadaanS2" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanS2'] ?? '' ?>">
                                            <span class="input-group-text">&deg;C</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanCRT2">CRT :</label>
                                        <input type="text" name="keadaanCRT2" id="keadaanCRT2" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanCRT2'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanRR2">RR :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="keadaanRR2" id="keadaanRR2" class="form-control border-info" value="<?= $data->rm9aTransferPasien['keadaanRR2'] ?? '' ?>">
                                            <span class="input-group-text">x/mnt</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3: Lain - Lain -->
                                <div class="col-md-12 mt-2">
                                    <div class="d-flex align-items-center gap-1">
                                        <label class="form-label small mb-0 text-nowrap fw-bold" for="keadaanLainLain2">Lain – Lain :</label>
                                        <input type="text" name="keadaanLainLain2" id="keadaanLainLain2" class="form-control form-control-sm border-info" value="<?= $data->rm9aTransferPasien['keadaanLainLain2'] ?? '' ?>">
                                    </div>
                                </div>

                                <div class="col-md-12 mt-2">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap" for="keluhanUtama2">Keluhan Utama :</label>
                                    <textarea name="keluhanUtama2" id="keluhanUtama2" class="form-control"><?= $data->rm9aTransferPasien['keluhanUtama2'] ?? '' ?></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas Menyerahkan :</label>
                        <select name="petugasMenyerahkan" id="petugasMenyerahkan" class="form-select">
                            <option value="" <?= ($data->rm9aTransferPasien['petugasMenyerahkan'] ?? '') == '' ? ' selected' : '' ?>>-- Pilih Petugas --</option>
                            <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                echo '<option value="' . $data->petugas[$i]["nama"] . '"';
                                if ($data->petugas[$i]["nama"] === ($data->rm9aTransferPasien['petugasMenyerahkan'] ?? '')) {
                                    echo ' selected';
                                }
                                echo '>' . $data->petugas[$i]["nama"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas Menerima :</label>
                        <select name="petugasMenerima" id="petugasMenerima" class="form-select">
                            <option value="" <?= ($data->rm9aTransferPasien['petugasMenerima'] ?? '') == '' ? ' selected' : '' ?>>-- Pilih Petugas --</option>
                            <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                echo '<option value="' . $data->petugas[$i]["nama"] . '"';
                                if ($data->petugas[$i]["nama"] === ($data->rm9aTransferPasien['petugasMenerima'] ?? '')) {
                                    echo ' selected';
                                }
                                echo '>' . $data->petugas[$i]["nama"] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas input :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->rm9aTransferPasien['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>