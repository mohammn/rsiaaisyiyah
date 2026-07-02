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
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Pasien :</div>
                    <hr>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ruang :</label>
                        <input type="text" class="form-control form-control-sm border-info" name="ruang" id="ruang" value="<?= $data->rm20bUdds['ruang'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kamar :</label>
                        <input type="text" class="form-control form-control-sm border-info" name="kamar" id="kamar" value="<?= $data->rm20bUdds['kamar'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Riwayat alergi :</label>
                        <textarea name="alergi" id="alergi" class="form-control" rows="4"><?= $data->rm20bUdds['alergi'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Petugas :</div>
                    <hr>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dokter DPJP :</label>
                        <select name="dokter" id="dokter" class="form-select form-select-sm">
                            <option value="" disabled <?= empty($data->rm20bUdds['dokter']) ? 'selected' : '' ?>>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (isset($data->rm20bUdds['dokter']) && $data->rm20bUdds['dokter'] == $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosa :</label>
                        <textarea name="diagnosa" id="diagnosa" class="form-control" rows="4"><?= $data->rm20bUdds['diagnosa'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>