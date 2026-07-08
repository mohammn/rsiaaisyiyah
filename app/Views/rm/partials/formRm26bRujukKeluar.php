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
                    <div class="col-12 text-center">Data Rujukan :</div>
                    <hr>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dari Unit :</label>
                        <input type="text" class="form-control" id="unit" value="<?= $data->rm26bRujukKeluar['unit'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ke Rumah Sakit :</label>
                        <input type="text" class="form-control" id="rs" value="<?= $data->rm26bRujukKeluar['rs'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Petugas yg menghubungi :</label>
                        <select name="petugas" id="petugas" class="form-select">
                            <option value="" <?= ($data->rm26bRujukKeluar['petugas'] ?? '') == '' ? ' selected' : '' ?>>-- Pilih Petugas --</option>
                            <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                echo '<option value="' . $data->petugas[$i]["nama"] . '"';
                                if ($data->petugas[$i]["nama"] === ($data->rm26bRujukKeluar['petugas'] ?? '')) {
                                    echo ' selected';
                                }
                                echo '>' . $data->petugas[$i]["nama"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 ">Tanggal dan jam :</label>
                        <input type="datetime-local" class="form-control" id="waktuMenghubungi" value="<?= $data->rm26bRujukKeluar['waktuMenghubungi'] ?? "" ?>">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Petugas yg dihubungi :</label>
                        <input type="text" class="form-control" id="petugasDihubungi" value="<?= $data->rm26bRujukKeluar['petugasDihubungi'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 ">No. Petugas yg dihubungi :</label>
                        <input type="text" class="form-control" id="noPetugasDihubungi" value="<?= $data->rm26bRujukKeluar['noPetugasDihubungi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-1">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Ambulance berangkat :</label>
                        <input type="datetime-local" class="form-control" id="jamBerangkat" value="<?= $data->rm26bRujukKeluar['jamBerangkat'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Ambulance tiba di RS tujuan :</label>
                        <input type="datetime-local" class="form-control" id="jamTiba" value="<?= $data->rm26bRujukKeluar['jamTiba'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Alasan Merujuk :</label>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mt-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="alasanRujuk" id="klinikal" value="Klinikal" <?= (($data->rm26bRujukKeluar["alasanRujuk"] ?? '') === "Klinikal") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="klinikal">Klinikal : </label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiKlinikal" id="isiKlinikal" value="<?= $data->rm26bRujukKeluar['isiKlinikal'] ?? '' ?>">
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mt-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="alasanRujuk" id="nonKlinikal" value="Non Klinikal" <?= (($data->rm26bRujukKeluar["alasanRujuk"] ?? '') === "Non Klinikal") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="nonKlinikal">Non Klinikal :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiNonKlinikal" id="isiNonKlinikal" value="<?= $data->rm26bRujukKeluar['isiNonKlinikal'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosa Medis :</label>
                        <input type="text" class="form-control" id="diagnosa" value="<?= $data->rm26bRujukKeluar['diagnosa'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dokter Perujuk :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= ($data->rm26bRujukKeluar['dokter'] ?? '') == '' ? ' selected' : '' ?>>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '"';
                                if ($data->dokter[$i]["nm_dokter"] === ($data->rm26bRujukKeluar['dokter'] ?? '')) {
                                    echo ' selected';
                                }
                                echo '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                </div>
                <br>

                <hr>


                <div class="row mb-2">
                    <div class="col-12">
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Alergi :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="alergi" id="alergiTdk" value="Tidak" <?= (($data->rm26bRujukKeluar["alergi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="alergiTdk">Tidak</label>
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="alergi" id="AlergiYa" value="Ya" <?= (($data->rm26bRujukKeluar["alergi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="AlergiYa">Ya, :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiAlergi" id="isiAlergi" value="<?= $data->rm26bRujukKeluar['isiAlergi'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Riwayat Penyakit Sekarang :</label>
                        <input type="text" class="form-control" id="riwayatPenyakit" value="<?= $data->rm26bRujukKeluar['riwayatPenyakit'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 ">Riwayat Penggunaan Obat :</label>
                        <input type="text" class="form-control" id="riwayatObat" value="<?= $data->rm26bRujukKeluar['riwayatObat'] ?? '' ?>">
                    </div>
                </div>


                <div class="row mb-2">
                    <div class="col-12">
                        <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Riwayat Penyakit Dahulu :</label>
                            <div class="form-check me-3 mb-1 mb-sm-0">
                                <input class="form-check-input" type="radio" name="penyakit" id="penyakitTdk" value="Tidak Ada" <?= (($data->rm26bRujukKeluar["penyakit"] ?? '') === "Tidak Ada") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="penyakitTdk">Tidak Ada</label>
                            </div>
                            <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                <div class="d-flex align-items-center me-1">
                                    <input class="form-check-input me-1" type="radio" name="penyakit" id="penyakitAda" value="Ada" <?= (($data->rm26bRujukKeluar["penyakit"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                    <label class="form-check-label small text-nowrap" for="penyakitAda">Ada, :</label>
                                </div>
                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiPenyakit" id="isiPenyakit" value="<?= $data->rm26bRujukKeluar['isiPenyakit'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="col-sm-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-12 text-center">Catatan Klinis :</div>
                    <hr>
                </div>


                <div class="row mb-2">
                    <div class="col-sm-12  border border-info rounded p-1">
                        <label class="form-label fw-bold small text-secondary mb-0">Kondisi Pasien Saat ini :</label>
                        <div class="row g-2">
                            <!-- Baris 1: Kesadaran & GCS -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Kesadaran</label>
                                <input type="text" class="form-control form-control-sm" name="kesadaran"
                                    value="<?= htmlspecialchars($data->rm26bRujukKeluar['kesadaran'] ?? '') ?>" placeholder="e.g. Compos Mentis">
                            </div>
                            <div class="col-md-8">
                                <label class="form-label small text-muted mb-1">GCS (Glasgow Coma Scale)</label>
                                <div class="input-group input-group-sm">
                                    <span class="input-group-text">E</span>
                                    <input type="number" class="form-control" name="gcs_e"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['gcs_e'] ?? '') ?>" placeholder="-">
                                    <span class="input-group-text">V</span>
                                    <input type="number" class="form-control" name="gcs_v"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['gcs_v'] ?? '') ?>" placeholder="-">
                                    <span class="input-group-text">M</span>
                                    <input type="number" class="form-control" name="gcs_m"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['gcs_m'] ?? '') ?>" placeholder="-">
                                </div>
                            </div>

                            <!-- Baris 2: Pupil & Reflek Cahaya -->
                            <div class="col-md-6">
                                <label class="form-label small text-muted mb-1">Pupil (Kanan / Kiri)</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="pupil_kanan"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['pupil_kanan'] ?? '') ?>" placeholder="Kanan">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="pupil_kiri"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['pupil_kiri'] ?? '') ?>" placeholder="Kiri">
                                    <span class="input-group-text">mm</span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label small text-muted mb-1">Reflek Cahaya (Kanan / Kiri)</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" class="form-control" name="reflek_cahaya_kanan"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['reflek_cahaya_kanan'] ?? '') ?>" placeholder="Kanan">
                                    <span class="input-group-text">/</span>
                                    <input type="text" class="form-control" name="reflek_cahaya_kiri"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['reflek_cahaya_kiri'] ?? '') ?>" placeholder="Kiri">
                                </div>
                            </div>

                            <!-- Baris 3: Tanda Vital (TD, Nadi, SpO2) -->
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Tekanan Darah (TD)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="td_sistole"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['td_sistole'] ?? '') ?>" placeholder="Sistole">
                                    <span class="input-group-text">/</span>
                                    <input type="number" class="form-control" name="td_diastole"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['td_diastole'] ?? '') ?>" placeholder="Diastole">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">Nadi</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="nadi"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['nadi'] ?? '') ?>" placeholder="Nadi">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label small text-muted mb-1">SpO2</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="spo2"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['spo2'] ?? '') ?>" placeholder="SpO2">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>

                            <!-- Baris 4: Respirasi, Suhu, Antropometri -->
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">Rr (Respiratory Rate)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="rr"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['rr'] ?? '') ?>" placeholder="Rr">
                                    <span class="input-group-text">x/mnt</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">t (Suhu Tubuh)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step="0.1" class="form-control" name="suhu"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['suhu'] ?? '') ?>" placeholder="Suhu">
                                    <span class="input-group-text">°C</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">BB Saat Ini</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" step="0.1" class="form-control" name="bb"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['bb'] ?? '') ?>" placeholder="Berat Badan">
                                    <span class="input-group-text">Kg</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label small text-muted mb-1">TB (Tinggi Badan)</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" class="form-control" name="tb"
                                        value="<?= htmlspecialchars($data->rm26bRujukKeluar['tb'] ?? '') ?>" placeholder="Tinggi Badan">
                                    <span class="input-group-text">Cm</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Kapan intake oral terakhir :</label>
                        <input type="datetime-local" class="form-control" id="waktuIntake" value="<?= $data->rm26bRujukKeluar['waktuIntake'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 ">pemeriksaan penunjang :</label>
                        <input type="text" class="form-control" id="pemeriksaanPenunjang" value="<?= $data->rm26bRujukKeluar['pemeriksaanPenunjang'] ?? '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="d-flex flex-column border border-info rounded p-2 gap-2">
                            <label class="form-label fw-bold small text-secondary mb-0">Pasien Memakai Peralatan Medis :</label>

                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="peralatan" id="peralatanTidak" value="Tidak" <?= (($data->rm26bRujukKeluar["peralatan"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="peralatanTidak">Tidak</label>
                            </div>

                            <div class="bg-light rounded p-2 d-flex flex-column gap-2">
                                <div class="d-flex align-items-center gap-2 flex-wrap">
                                    <div class="form-check mb-0 me-2">
                                        <input class="form-check-input" type="radio" name="peralatan" id="profilaksisYa" value="Ya" <?= (($data->rm26bRujukKeluar["peralatan"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="profilaksisYa">Ya, : </label>
                                    </div>
                                </div>
                                <?php
                                // Mengubah string JSON dari database menjadi array PHP agar in_array() berfungsi saat edit
                                $alat_list = [];
                                if (!empty($data->rm26bRujukKeluar['alat'])) {
                                    $decoded = json_decode($data->rm26bRujukKeluar['alat'], true);
                                    $alat_list = is_array($decoded) ? $decoded : [];
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-12 mb-3 mb-md-0">
                                        <div class="border border-info rounded p-2 h-100">
                                            <p class="form-label fw-bold small text-secondary mb-2">Alat dipakai :</p>

                                            <div class="d-flex flex-wrap gap-1 align-items-center">

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="Infus" id="Infus" <?= in_array('Infus', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="Infus">Infus</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="ETT" id="ETT" <?= in_array('ETT', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ETT">ETT</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="Oksigen" id="Oksigen" <?= in_array('Oksigen', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="Oksigen">Oksigen</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="NGT" id="NGT" <?= in_array('NGT', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="NGT">NGT</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="Kateter" id="Kateter" <?= in_array('Kateter', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="Kateter">Kateter</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <input class="form-check-input" type="checkbox" name="alat[]" value="Bidai" id="Bidai" <?= in_array('Bidai', $alat_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="Bidai">Bidai</label>
                                                </div>

                                                <div class="form-check hover-check">
                                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                                        <div class="d-flex align-items-center">
                                                            <input class="form-check-input me-1" type="checkbox" name="alat[]" value="Lainnya" id="alatLainnya" <?= in_array('Lainnya', $alat_list) ? 'checked' : '' ?>>
                                                            <label class="form-check-label small me-1" for="alatLainnya">Lainnya:</label>
                                                        </div>
                                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 120px;" name="isiAlatLainnya" id="isiAlatLainnya" placeholder="sebutkan..." value="<?= $data->rm26bRujukKeluar['isiAlatLainnya'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <label class="form-label fw-bold small text-secondary mb-0">Perawatan Pasien Lanjutan yg dibutuhkan :</label>
                                <input type="text" class="form-control" id="perawatanLanjutan" value="<?= $data->rm26bRujukKeluar['perawatanLanjutan'] ?? '' ?>">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
</form>