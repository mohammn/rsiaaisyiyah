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
        <div class="col-sm-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-sm-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->rm4PermintaanMasuk['nama'] ?? '' ?>"></div>
                    <div class="col-sm-5">
                        <mark style="font-size: 7pt;" class="bg-info">Kosongi jika, pasien yang akan ttd.</mark>
                    </div>
                </div>
                <hr>
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">No. Kartu :</label>
                        <input type="text" class="form-control" id="noKartu" value="<?= $data->rm4PermintaanMasuk['noKartu'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">No. SEP :</label>
                        <input type="text" class="form-control" id="noSep" value="<?= $data->rm4PermintaanMasuk['noSep'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-0">Penjamin Biaya :</label>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="biaya" id="umum" value="Umum" <?= (($data->rm4PermintaanMasuk["biaya"] ?? '') === "Umum") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="umum">Umum</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="biaya" id="BPJS" value="BPJS" <?= (($data->rm4PermintaanMasuk["biaya"] ?? '') === "BPJS") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="BPJS">BPJS</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="biaya" id="BPJSPBI" value="BPJS PBI" <?= (($data->rm4PermintaanMasuk["biaya"] ?? '') === "BPJS PBI") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="BPJSPBI">BPJS PBI</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="biaya" id="Asuransi" value="Asuransi" <?= (($data->rm4PermintaanMasuk["biaya"] ?? '') === "Asuransi") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="Asuransi">Asuransi</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="biaya" id="Lainnya" value="Lainnya" <?= (($data->rm4PermintaanMasuk["biaya"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="Lainnya">Lainnya</label>
                            </div>
                            <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Biaya Lainnya :</label>
                            <div class="d-flex align-items-center gap-1">
                                <input type="text" class="form-control form-control-sm border-info py-0" name="isiBiayaLain" id="isiBiayaLain" style="max-width: 120px;" value="<?= $data->rm4PermintaanMasuk['isiBiayaLain'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>


                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal Masuk :</label>
                        <input type="date" class="form-control" id="tglMasuk" value="<?= $data->rm4PermintaanMasuk['tglMasuk'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ruang dituju :</label>
                        <input type="text" class="form-control" id="ruang" value="<?= $data->rm4PermintaanMasuk['ruang'] ?? '' ?>">
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->rm4PermintaanMasuk['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">DPJP :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->rm4PermintaanMasuk['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->rm4PermintaanMasuk['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosa :</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="3"><?= $data->rm4PermintaanMasuk['diagnosa'] ?? '' ?></textarea>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>