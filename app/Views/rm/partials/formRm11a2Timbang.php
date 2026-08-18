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

    <div class="container-fluid mt-4">
        <div class="row">
            <!-- ================ KIRI ================== -->
            <div class="col-md-6">
                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">SBAR :</div>
                        <hr>
                    </div>

                    <div class="row mt-2">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-0">DPJP :</label>
                            <select name="dpjp" id="dpjp" class="form-select form-select-sm">
                                <option value="" <?= (empty($data->rm11a2Timbang['dpjp'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                    $selected = (($data->rm11a2Timbang['dpjp'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-0">Dari unit lain :</label>
                            <input type="text" name="unitLain" id="unitLain" class="form-control" value="<?= $data->rm11a2Timbang['unitLain'] ?? '' ?>">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-0">Diagnosa Medis :</label>
                            <input type="text" name="diagnosaMedis" id="diagnosaMedis" class="form-control" value="<?= $data->rm11a2Timbang['diagnosaMedis'] ?? '' ?>">
                        </div>
                    </div>

                </div>

            </div>

            <!-- =========== KANAN =============== -->
            <div class="col-md-6">

                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">Situation:</div>
                        <hr>
                    </div>
                    <div class="row mt-2">
                        <!-- PROSES DECODE JSON SITUASI -->
                        <?php
                        $situasi = [];
                        if (!empty($data->rm11a2Timbang['situasi'])) {
                            $decodeSituasi = json_decode($data->rm11a2Timbang['situasi'], true);
                            $situasi = is_array($decodeSituasi) ? $decodeSituasi : [];
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <div class="d-flex flex-wrap align-items-center mt-2">

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="situasi[]" value="Cito" id="sitCito" <?= in_array('Cito', $situasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sitCito">Cito</label>
                                    </div>

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="situasi[]" value="Elektif" id="sitElektif" <?= in_array('Elektif', $situasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sitElektif">Elektif</label>
                                    </div>

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="situasi[]" value="OK" id="sitOK" <?= in_array('OK', $situasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sitOK">OK</label>
                                    </div>

                                    <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                        <div>
                                            <label class="form-check-label small text-nowrap" for="isiKelas">KELAS :</label>
                                        </div>
                                        <input type="text" name="isiKelas" id="isiKelas" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiKelas'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <!-- KOLOM KIRI (UTAMA / POLOS) -->
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Penyerahan dari Ruangan (Kiri) :</div>
                    <hr>
                </div>

                <!-- Diagnosa & Rencana Operasi -->
                <div class="row">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Diagnosa Pra Operasi :</label>
                        <input type="text" name="diagnosaPra" id="diagnosaPra" class="form-control" value="<?= $data->rm11a2Timbang['diagnosaPra'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Rencana Operasi :</label>
                        <input type="text" name="rencanaOperasi" id="rencanaOperasi" class="form-control" value="<?= $data->rm11a2Timbang['rencanaOperasi'] ?? '' ?>">
                    </div>
                </div>

                <!-- RPD -->
                <?php
                $rpd = [];
                if (!empty($data->rm11a2Timbang['rpd'])) {
                    $decodeRpd = json_decode($data->rm11a2Timbang['rpd'], true);
                    $rpd = is_array($decodeRpd) ? $decodeRpd : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">RPD :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Asthma" id="rpdAsthma" <?= in_array('Asthma', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdAsthma">Asthma</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="HT" id="rpdHT" <?= in_array('HT', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdHT">HT</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Jantung" id="rpdJantung" <?= in_array('Jantung', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdJantung">Jantung</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Hepatitis" id="rpdHepatitis" <?= in_array('Hepatitis', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdHepatitis">Hepatitis</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Renal F" id="rpdRenalF" <?= in_array('Renal F', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdRenalF">Renal F</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Liver F" id="rpdLiverF" <?= in_array('Liver F', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdLiverF">Liver F</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd[]" value="Psyc" id="rpdPsyc" <?= in_array('Psyc', $rpd) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdPsyc">Psyc</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="rpd[]" value="Lain2" id="rpdLain2" <?= in_array('Lain2', $rpd) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="rpdLain2">Lainnya :</label>
                                    </div>
                                    <input type="text" name="isiRpdLainnya" id="isiRpdLainnya" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiRpdLainnya'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ISOLASI -->
                <?php
                $isolasi = [];
                if (!empty($data->rm11a2Timbang['isolasi'])) {
                    $decodeIsolasi = json_decode($data->rm11a2Timbang['isolasi'], true);
                    $isolasi = is_array($decodeIsolasi) ? $decodeIsolasi : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Isolasi :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi[]" value="MRSA/ESBL" id="isoMrsaEsbl" <?= in_array('MRSA/ESBL', $isolasi) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoMrsaEsbl">MRSA/ESBL</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi[]" value="HIV" id="isoHiv" <?= in_array('HIV', $isolasi) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoHiv">HIV</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi[]" value="TB" id="isoTb" <?= in_array('TB', $isolasi) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoTb">TB</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="isolasi[]" value="Lain2" id="isoLain2" <?= in_array('Lain2', $isolasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="isoLain2">Lainnya :</label>
                                    </div>
                                    <input type="text" name="isiIsolasiLainnya" id="isiIsolasiLainnya" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiIsolasiLainnya'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALERGI -->
                <?php $alergi = $data->rm11a2Timbang['alergi'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Alergi :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="alergi" value="Tidak" id="algTidak" <?= $alergi === 'Tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="algTidak">Tidak</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="alergi" value="Ya" id="algYa" <?= $alergi === 'Ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="algYa">Ya :</label>
                                    </div>
                                    <input type="text" name="isiAlergi" id="isiAlergi" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiAlergi'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DARAH -->
                <?php
                $darahStatus = $data->rm11a2Timbang['darahStatus'] ?? '';
                $darahDetail = [];
                if (!empty($data->rm11a2Timbang['darahDetail'])) {
                    $decodeDarah = json_decode($data->rm11a2Timbang['darahDetail'], true);
                    $darahDetail = is_array($decodeDarah) ? $decodeDarah : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Darah :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="darahStatus" value="Tidak ada" id="darahTidakAda" <?= $darahStatus === 'Tidak ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="darahTidakAda">Tidak ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="darahStatus" value="Ada" id="darahAda" <?= $darahStatus === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="darahAda">Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <label class="form-check-label small text-nowrap" for="jumlahDarah">Jumlah :</label>
                                    </div>
                                    <input type="text" name="jumlahDarah" id="jumlahDarah" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['jumlahDarah'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="darahDetail[]" value="Pack jenis" id="darahPackJenis" <?= in_array('Pack jenis', $darahDetail) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="darahPackJenis">Pack jenis :</label>
                                    </div>
                                    <input type="text" name="isiPackJenis" id="isiPackJenis" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiPackJenis'] ?? '' ?>">
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="darahDetail[]" value="Golongan" id="darahGolongan" <?= in_array('Golongan', $darahDetail) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="darahGolongan">Golongan :</label>
                                    </div>
                                    <input type="text" name="isiGolonganDarah" id="isiGolonganDarah" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiGolonganDarah'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Riwayat tranfusi -->
                <?php $tranfusiDarah = $data->rm11a2Timbang['riwayatTranfusi'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="border border-info rounded p-2">
                            <label class="form-label fw-bold small text-secondary mb-1">Riwayat Tranfusi :</label>

                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <!-- Pilihan Tidak -->
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="radio" name="riwayatTranfusi" value="Tidak" id="trnTidak" <?= $tranfusiDarah === 'Tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="trnTidak">Tidak</label>
                                </div>

                                <!-- Kelompok Input Transfusi (Opsi Ya) -->
                                <div class="d-flex align-items-center flex-wrap gap-2 p-2 rounded bg-secondary bg-opacity-10 border">
                                    <div class="form-check m-0 pe-1">
                                        <input class="form-check-input" type="radio" name="riwayatTranfusi" value="Ya" id="trnYa" <?= $tranfusiDarah === 'Ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label small fw-bold text-nowrap" for="trnYa">Ya :</label>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="tglTranfusi" class="small text-nowrap m-0">Tanggal :</label>
                                        <input type="date" name="tglTranfusi" id="tglTranfusi" class="form-control form-control-sm" value="<?= $data->rm11a2Timbang['tglTranfusi'] ?? '' ?>">
                                    </div>

                                    <!-- Jenis -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="jenisTranfusi" class="small text-nowrap m-0">Jenis :</label>
                                        <input type="text" name="jenisTranfusi" id="jenisTranfusi" class="form-control form-control-sm" style="width: 120px;" value="<?= $data->rm11a2Timbang['jenisTranfusi'] ?? '' ?>">
                                    </div>

                                    <!-- Golongan -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="golTranfusi" class="small text-nowrap m-0">Gol :</label>
                                        <input type="text" name="golTranfusi" id="golTranfusi" class="form-control form-control-sm" style="width: 60px;" value="<?= $data->rm11a2Timbang['golTranfusi'] ?? '' ?>">
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="jumlahTranfusi" class="small text-nowrap m-0">Jumlah :</label>
                                        <div class="input-group input-group-sm" style="width: 110px;">
                                            <input type="text" name="jumlahTranfusi" id="jumlahTranfusi" class="form-control" value="<?= $data->rm11a2Timbang['jumlahTranfusi'] ?? '' ?>">
                                            <span class="input-group-text">pack</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MARKING -->
                <?php
                $markingStatus = $data->rm11a2Timbang['markingStatus'] ?? '';
                $markingKondisi = $data->rm11a2Timbang['markingKondisi'] ?? '';
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Marking :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingStatus" value="Tidak Ada" id="mrkTidakAda" <?= $markingStatus === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkTidakAda">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingStatus" value="Ada" id="mrkAda" <?= $markingStatus === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkAda">Ada</label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingKondisi" value="Sudah" id="mrkSudah" <?= $markingKondisi === 'Sudah' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkSudah">Sudah</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingKondisi" value="Belum" id="mrkBelum" <?= $markingKondisi === 'Belum' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkBelum">Belum</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMED CONSENT -->
                <?php $informedConsent = $data->rm11a2Timbang['informedConsent'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Informed Consent :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="informedConsent" value="Tidak Ada" id="icTidakAda" <?= $informedConsent === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="icTidakAda">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="informedConsent" value="Ada" id="icAda" <?= $informedConsent === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="icAda">Ada</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LABORATORIUM & PERHATIAN KHUSUS -->
                <?php
                $labStatus = $data->rm11a2Timbang['labStatus'] ?? '';
                $perhatianKhusus = [];
                if (!empty($data->rm11a2Timbang['perhatianKhusus'])) {
                    $decodePerhatian = json_decode($data->rm11a2Timbang['perhatianKhusus'], true);
                    $perhatianKhusus = is_array($decodePerhatian) ? $decodePerhatian : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-2">
                            <label class="form-label fw-bold small text-secondary mb-0">Laboratorium :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-3">
                                    <input class="form-check-input" type="radio" name="labStatus" value="Tidak Ada" id="labTidakAda" <?= $labStatus === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="labTidakAda">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="labStatus" value="Ada" id="labAda" <?= $labStatus === 'Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="labAda">Ada, Jml :</label>
                                    </div>
                                    <input type="text" name="isiLabJml" id="isiLabJml" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiLabJml'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label fw-bold small text-secondary mb-0">Perhatian Khusus :</label>
                            </div>

                            <div class="row g-2 mt-1">
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus[]" value="Hb" id="pkHb" <?= in_array('Hb', $perhatianKhusus) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkHb" style="width: 75px;">Hb :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiHb" id="isiHb" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiHb'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">gr/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus[]" value="BUN" id="pkBun" <?= in_array('BUN', $perhatianKhusus) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkBun" style="width: 75px;">BUN :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiBun" id="isiBun" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiBun'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">mg/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus[]" value="Lain-lain" id="pkLainLain" <?= in_array('Lain-lain', $perhatianKhusus) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkLainLain" style="width: 75px;">Lain-lain :</label>
                                        <input type="text" name="isiPkLainLain" id="isiPkLainLain" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiPkLainLain'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus[]" value="Albumin" id="pkAlbumin" <?= in_array('Albumin', $perhatianKhusus) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkAlbumin" style="width: 75px;">Albumin :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiAlbumin" id="isiAlbumin" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiAlbumin'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">gr/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus[]" value="Kreatinin" id="pkKreatinin" <?= in_array('Kreatinin', $perhatianKhusus) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkKreatinin" style="width: 75px;">Kreatinin :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiKreatinin" id="isiKreatinin" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiKreatinin'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">mg/dl</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOTO -->
                <?php
                $fotoStatus = $data->rm11a2Timbang['fotoStatus'] ?? '';
                $fotoDetail = [];
                if (!empty($data->rm11a2Timbang['fotoDetail'])) {
                    $decodeFoto = json_decode($data->rm11a2Timbang['fotoDetail'], true);
                    $fotoDetail = is_array($decodeFoto) ? $decodeFoto : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Foto :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="fotoStatus" value="Tidak ada" id="fotoTidakAda" <?= $fotoStatus === 'Tidak ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="fotoTidakAda">Tidak ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="fotoStatus" value="Ada" id="fotoAda" <?= $fotoStatus === 'Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="fotoAda">Ada, Jml :</label>
                                    </div>
                                    <input type="text" name="isiFotoJml" id="isiFotoJml" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiFotoJml'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row g-2 mt-1 border-top">
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center gap-1 mb-2">
                                        <input class="form-check-input flex-shrink-0" type="checkbox" name="fotoDetail[]" value="Rontgen" id="ftRontgen" <?= in_array('Rontgen', $fotoDetail) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap ms-1" for="ftRontgen">Rontgen</label>
                                        <input type="text" name="isiRontgenKet" id="isiRontgenKet" class="form-control form-control-sm border-info" placeholder="Keterangan..." value="<?= $data->rm11a2Timbang['isiRontgenKet'] ?? '' ?>">
                                        <span class="small text-nowrap ms-1">jml :</span>
                                        <input type="text" name="isiRontgenJml" id="isiRontgenJml" class="form-control form-control-sm border-info" style="max-width: 70px;" value="<?= $data->rm11a2Timbang['isiRontgenJml'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-1 mb-2">
                                        <input class="form-check-input flex-shrink-0" type="checkbox" name="fotoDetail[]" value="USG" id="ftUsg" <?= in_array('USG', $fotoDetail) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap ms-1" for="ftUsg">USG</label>
                                        <input type="text" name="isiUsgKet" id="isiUsgKet" class="form-control form-control-sm border-info" placeholder="Keterangan..." value="<?= $data->rm11a2Timbang['isiUsgKet'] ?? '' ?>">
                                        <span class="small text-nowrap ms-1">jml :</span>
                                        <input type="text" name="isiUsgJml" id="isiUsgJml" class="form-control form-control-sm border-info" style="max-width: 70px;" value="<?= $data->rm11a2Timbang['isiUsgJml'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail[]" value="BOF" id="ftBof" <?= in_array('BOF', $fotoDetail) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftBof">BOF jml :</label>
                                        </div>
                                        <input type="text" name="isiBofJml" id="isiBofJml" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiBofJml'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail[]" value="NST" id="ftNst" <?= in_array('NST', $fotoDetail) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftNst">NST :</label>
                                        </div>
                                        <input type="text" name="isiNst" id="isiNst" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiNst'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail[]" value="Echocardiografi" id="ftEcho" <?= in_array('Echocardiografi', $fotoDetail) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftEcho">Echocardiografi jml :</label>
                                        </div>
                                        <input type="text" name="isiEchoJml" id="isiEchoJml" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiEchoJml'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail[]" value="IVP" id="ftIvp" <?= in_array('IVP', $fotoDetail) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftIvp">IVP jml :</label>
                                        </div>
                                        <input type="text" name="isiIvpJml" id="isiIvpJml" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiIvpJml'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail[]" value="EKG" id="ftEkg" <?= in_array('EKG', $fotoDetail) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftEkg">EKG jml :</label>
                                        </div>
                                        <input type="text" name="isiEkgJml" id="isiEkgJml" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiEkgJml'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2 mt-2 pt-1 border-top">
                                <label class="form-label small fw-bold text-nowrap mb-0" for="isiFotoLainnya">Lain-lain :</label>
                                <input type="text" name="isiFotoLainnya" id="isiFotoLainnya" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiFotoLainnya'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VITAL SIGN -->
                <div class="border border-info rounded p-2 mt-2">
                    <label class="form-label fw-bold small text-secondary mb-2">Vital Sign :</label>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiTdSistole" style="width: 40px;">TD :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiTdSistole" id="isiTdSistole" class="form-control text-center border-info" placeholder="Sistole" value="<?= $data->rm11a2Timbang['isiTdSistole'] ?? '' ?>">
                                    <span class="input-group-text border-info bg-white px-2 text-muted">/</span>
                                    <input type="text" name="isiTdDiastole" id="isiTdDiastole" class="form-control text-center border-info" placeholder="Diastole" value="<?= $data->rm11a2Timbang['isiTdDiastole'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">mmHg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiSuhu" style="width: 40px;">S :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiSuhu" id="isiSuhu" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiSuhu'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">°C</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiRr" style="width: 40px;">RR :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiRr" id="isiRr" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiRr'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">x/mnt</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiNadi" style="width: 40px;">N :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiNadi" id="isiNadi" class="form-control border-info" value="<?= $data->rm11a2Timbang['isiNadi'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">x/mnt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PUASA -->
                <?php $puasaStatus = $data->rm11a2Timbang['puasaStatus'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Puasa :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="puasaStatus" value="Tidak" id="puasaTidak" <?= $puasaStatus === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="puasaTidak">Tidak</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0">
                            <div>
                                <input class="form-check-input" type="radio" name="puasaStatus" value="Ya" id="puasaYa" <?= $puasaStatus === 'Ya' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="puasaYa">Ya, makan/ minum terakhir jam</label>
                            </div>
                            <input type="time" name="isiPuasaJam" id="isiPuasaJam" class="form-control form-control-sm border-info" style="max-width: 120px;" value="<?= $data->rm11a2Timbang['isiPuasaJam'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- LAVEMENT -->
                <?php $lavementStatus = $data->rm11a2Timbang['lavementStatus'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Lavement :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="lavementStatus" value="Tidak" id="lavementTidak" <?= $lavementStatus === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="lavementTidak">Tidak</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0">
                            <div>
                                <input class="form-check-input" type="radio" name="lavementStatus" value="Ya" id="lavementYa" <?= $lavementStatus === 'Ya' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="lavementYa">Ya :</label>
                            </div>
                            <input type="text" name="isiLavementKet" id="isiLavementKet" class="form-control form-control-sm border-info" placeholder="(BAB banyak / sedikit)" style="max-width: 200px;" value="<?= $data->rm11a2Timbang['isiLavementKet'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- TAMPON ANUS -->
                <?php $tamponAnus = $data->rm11a2Timbang['tamponAnus'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Tampon Anus :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="tamponAnus" value="Tidak" id="tamponTidak" <?= $tamponAnus === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="tamponTidak">Tidak</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="tamponAnus" value="Ya" id="tamponYa" <?= $tamponAnus === 'Ya' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="tamponYa">Ya</label>
                        </div>
                    </div>
                </div>

                <!-- SCEREN -->
                <?php $scerenStatus = $data->rm11a2Timbang['scerenStatus'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Sceren :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus" value="Tidak perlu" id="scerenTidakPerlu" <?= $scerenStatus === 'Tidak perlu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenTidakPerlu">Tidak perlu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus" value="Perlu" id="scerenPerlu" <?= $scerenStatus === 'Perlu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenPerlu">Perlu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus" value="Sudah" id="scerenSudah" <?= $scerenStatus === 'Sudah' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenSudah">Sudah</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus" value="Belum" id="scerenBelum" <?= $scerenStatus === 'Belum' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="scerenBelum">Belum</label>
                        </div>
                    </div>
                </div>

                <!-- GIGI PALSU -->
                <?php $gigiPalsu = $data->rm11a2Timbang['gigiPalsu'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Gigi palsu :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="gigiPalsu" value="Tidak" id="gigiTidak" <?= $gigiPalsu === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="gigiTidak">Tidak</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="gigiPalsu" value="Ada" id="gigiAda" <?= $gigiPalsu === 'Ada' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="gigiAda">Ada</label>
                        </div>
                        <div class="d-flex align-items-center gap-1 flex-grow-1">
                            <span class="small text-nowrap">dibawa oleh :</span>
                            <input type="text" name="isiGigiDibawaOleh" id="isiGigiDibawaOleh" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiGigiDibawaOleh'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- KESADARAN -->
                <?php $kesadaran = $data->rm11a2Timbang['kesadaran'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Kesadaran :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="kesadaran" value="Sadar" id="kesadaranSadar" <?= $kesadaran === 'Sadar' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="kesadaranSadar">Sadar</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="kesadaran" value="Tidak sadar" id="kesadaranTidakSadar" <?= $kesadaran === 'Tidak sadar' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="kesadaranTidakSadar">Tidak sadar</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0 flex-grow-1">
                            <div>
                                <input class="form-check-input" type="radio" name="kesadaran" value="Lain-lain" id="kesadaranLainLain" <?= $kesadaran === 'Lain-lain' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="kesadaranLainLain">Lain-lain :</label>
                            </div>
                            <input type="text" name="isiKesadaranLain" id="isiKesadaranLain" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiKesadaranLain'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- KELUARGA MENUNGGU DI -->
                <?php $keluargaTunggu = $data->rm11a2Timbang['keluargaTunggu'] ?? ''; ?>
                <div class="border border-info rounded p-1 mt-1">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 150px;">Keluarga menunggu di :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="keluargaTunggu" value="R. Tunggu" id="tungguRTunggu" <?= $keluargaTunggu === 'R. Tunggu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="tungguRTunggu">R. Tunggu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="keluargaTunggu" value="Ruangan" id="tungguRuangan" <?= $keluargaTunggu === 'Ruangan' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="tungguRuangan">Ruangan</label>
                        </div>
                    </div>
                </div>

                <!-- KONTAK PERSON & TELP -->
                <div class="border border-info rounded p-1 mt-1">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-1">
                                <label class="form-label small fw-bold text-secondary text-nowrap mb-0" for="isiKontakPerson" style="width: 110px;">Kontak Person :</label>
                                <input type="text" name="isiKontakPerson" id="isiKontakPerson" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiKontakPerson'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-1">
                                <label class="form-label small fw-bold text-secondary text-nowrap mb-0" for="isiTelpHubungi" style="width: 130px;">Telp yg dihubungi :</label>
                                <input type="text" name="isiTelpHubungi" id="isiTelpHubungi" class="form-control form-control-sm border-info" value="<?= $data->rm11a2Timbang['isiTelpHubungi'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- KOLOM KANAN (PENERIMAAN / SERBA 2) -->
        <div class="col-md-6">
            <div class="alert alert-success">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Penerimaan di OK (Kanan) :</div>
                    <hr>
                </div>

                <!-- Diagnosa & Rencana Operasi 2 -->
                <div class="row">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Diagnosa Pra Operasi :</label>
                        <input type="text" name="diagnosaPra2" id="diagnosaPra2" class="form-control" value="<?= $data->rm11a2Timbang['diagnosaPra2'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0">Rencana Operasi :</label>
                        <input type="text" name="rencanaOperasi2" id="rencanaOperasi2" class="form-control" value="<?= $data->rm11a2Timbang['rencanaOperasi2'] ?? '' ?>">
                    </div>
                </div>

                <!-- RPD 2 -->
                <?php
                $rpd2 = [];
                if (!empty($data->rm11a2Timbang['rpd2'])) {
                    $decodeRpd2 = json_decode($data->rm11a2Timbang['rpd2'], true);
                    $rpd2 = is_array($decodeRpd2) ? $decodeRpd2 : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">RPD :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Asthma" id="rpdAsthma2" <?= in_array('Asthma', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdAsthma2">Asthma</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="HT" id="rpdHT2" <?= in_array('HT', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdHT2">HT</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Jantung" id="rpdJantung2" <?= in_array('Jantung', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdJantung2">Jantung</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Hepatitis" id="rpdHepatitis2" <?= in_array('Hepatitis', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdHepatitis2">Hepatitis</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Renal F" id="rpdRenalF2" <?= in_array('Renal F', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdRenalF2">Renal F</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Liver F" id="rpdLiverF2" <?= in_array('Liver F', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdLiverF2">Liver F</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="rpd2[]" value="Psyc" id="rpdPsyc2" <?= in_array('Psyc', $rpd2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rpdPsyc2">Psyc</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="rpd2[]" value="Lain2" id="rpdLain22" <?= in_array('Lain2', $rpd2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="rpdLain22">Lainnya :</label>
                                    </div>
                                    <input type="text" name="isiRpdLainnya2" id="isiRpdLainnya2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiRpdLainnya2'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ISOLASI 2 -->
                <?php
                $isolasi2 = [];
                if (!empty($data->rm11a2Timbang['isolasi2'])) {
                    $decodeIsolasi2 = json_decode($data->rm11a2Timbang['isolasi2'], true);
                    $isolasi2 = is_array($decodeIsolasi2) ? $decodeIsolasi2 : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Isolasi :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi2[]" value="MRSA/ESBL" id="isoMrsaEsbl2" <?= in_array('MRSA/ESBL', $isolasi2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoMrsaEsbl2">MRSA/ESBL</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi2[]" value="HIV" id="isoHiv2" <?= in_array('HIV', $isolasi2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoHiv2">HIV</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="isolasi2[]" value="TB" id="isoTb2" <?= in_array('TB', $isolasi2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="isoTb2">TB</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="isolasi2[]" value="Lain2" id="isoLain22" <?= in_array('Lain2', $isolasi2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="isoLain22">Lainnya :</label>
                                    </div>
                                    <input type="text" name="isiIsolasiLainnya2" id="isiIsolasiLainnya2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiIsolasiLainnya2'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ALERGI 2 -->
                <?php $alergi2 = $data->rm11a2Timbang['alergi2'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Alergi :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="alergi2" value="Tidak" id="algTidak2" <?= $alergi2 === 'Tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="algTidak2">Tidak</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="alergi2" value="Ya" id="algYa2" <?= $alergi2 === 'Ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="algYa2">Ya :</label>
                                    </div>
                                    <input type="text" name="isiAlergi2" id="isiAlergi2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiAlergi2'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- DARAH 2 -->
                <?php
                $darahStatus2 = $data->rm11a2Timbang['darahStatus2'] ?? '';
                $darahDetail2 = [];
                if (!empty($data->rm11a2Timbang['darahDetail2'])) {
                    $decodeDarah2 = json_decode($data->rm11a2Timbang['darahDetail2'], true);
                    $darahDetail2 = is_array($decodeDarah2) ? $decodeDarah2 : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Darah :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="darahStatus2" value="Tidak ada" id="darahTidakAda2" <?= $darahStatus2 === 'Tidak ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="darahTidakAda2">Tidak ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="darahStatus2" value="Ada" id="darahAda2" <?= $darahStatus2 === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="darahAda2">Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <label class="form-check-label small text-nowrap" for="jumlahDarah2">Jumlah :</label>
                                    </div>
                                    <input type="text" name="jumlahDarah2" id="jumlahDarah2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['jumlahDarah2'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="darahDetail2[]" value="Pack jenis" id="darahPackJenis2" <?= in_array('Pack jenis', $darahDetail2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="darahPackJenis2">Pack jenis :</label>
                                    </div>
                                    <input type="text" name="isiPackJenis2" id="isiPackJenis2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiPackJenis2'] ?? '' ?>">
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="checkbox" name="darahDetail2[]" value="Golongan" id="darahGolongan2" <?= in_array('Golongan', $darahDetail2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="darahGolongan2">Golongan :</label>
                                    </div>
                                    <input type="text" name="isiGolonganDarah2" id="isiGolonganDarah2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiGolonganDarah2'] ?? '' ?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ================= RIWAYAT TRANSFUSI 2 ================= -->
                <?php
                $tranfusiDarah2 = $data->rm11a2Timbang['riwayatTranfusi2'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-12">
                        <div class="border border-success rounded p-2">
                            <label class="form-label fw-bold small text-secondary mb-1">Riwayat Tranfusi 2 :</label>

                            <div class="d-flex align-items-center flex-wrap gap-3">
                                <!-- Pilihan Tidak -->
                                <div class="form-check m-0">
                                    <input class="form-check-input" type="radio" name="riwayatTranfusi2" value="Tidak" id="trnTidak2" <?= $tranfusiDarah2 === 'Tidak' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="trnTidak2">Tidak</label>
                                </div>

                                <!-- Kelompok Input Transfusi (Opsi Ya) -->
                                <div class="d-flex align-items-center flex-wrap gap-2 p-2 rounded bg-secondary bg-opacity-10 border">
                                    <div class="form-check m-0 pe-1">
                                        <input class="form-check-input" type="radio" name="riwayatTranfusi2" value="Ya" id="trnYa2" <?= $tranfusiDarah2 === 'Ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label small fw-bold text-nowrap" for="trnYa2">Ya :</label>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="tglTranfusi2" class="small text-nowrap m-0">Tanggal :</label>
                                        <input type="date" name="tglTranfusi2" id="tglTranfusi2" class="form-control form-control-sm" value="<?= $data->rm11a2Timbang['tglTranfusi2'] ?? '' ?>">
                                    </div>

                                    <!-- Jenis -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="jenisTranfusi2" class="small text-nowrap m-0">Jenis :</label>
                                        <input type="text" name="jenisTranfusi2" id="jenisTranfusi2" class="form-control form-control-sm" style="width: 120px;" value="<?= $data->rm11a2Timbang['jenisTranfusi2'] ?? '' ?>">
                                    </div>

                                    <!-- Golongan -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="golTranfusi2" class="small text-nowrap m-0">Gol :</label>
                                        <input type="text" name="golTranfusi2" id="golTranfusi2" class="form-control form-control-sm" style="width: 60px;" value="<?= $data->rm11a2Timbang['golTranfusi2'] ?? '' ?>">
                                    </div>

                                    <!-- Jumlah -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="jumlahTranfusi2" class="small text-nowrap m-0">Jumlah :</label>
                                        <div class="input-group input-group-sm" style="width: 110px;">
                                            <input type="text" name="jumlahTranfusi2" id="jumlahTranfusi2" class="form-control" value="<?= $data->rm11a2Timbang['jumlahTranfusi2'] ?? '' ?>">
                                            <span class="input-group-text">pack</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- MARKING 2 -->
                <?php
                $markingStatus2 = $data->rm11a2Timbang['markingStatus2'] ?? '';
                $markingKondisi2 = $data->rm11a2Timbang['markingKondisi2'] ?? '';
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Marking :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingStatus2" value="Tidak Ada" id="mrkTidakAda2" <?= $markingStatus2 === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkTidakAda2">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingStatus2" value="Ada" id="mrkAda2" <?= $markingStatus2 === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkAda2">Ada</label>
                                </div>
                            </div>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingKondisi2" value="Sudah" id="mrkSudah2" <?= $markingKondisi2 === 'Sudah' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkSudah2">Sudah</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="markingKondisi2" value="Belum" id="mrkBelum2" <?= $markingKondisi2 === 'Belum' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="mrkBelum2">Belum</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- INFORMED CONSENT 2 -->
                <?php $informedConsent2 = $data->rm11a2Timbang['informedConsent2'] ?? ''; ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Informed Consent :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="informedConsent2" value="Tidak Ada" id="icTidakAda2" <?= $informedConsent2 === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="icTidakAda2">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="informedConsent2" value="Ada" id="icAda2" <?= $informedConsent2 === 'Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="icAda2">Ada</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- LABORATORIUM & PERHATIAN KHUSUS 2 -->
                <?php
                $labStatus2 = $data->rm11a2Timbang['labStatus2'] ?? '';
                $perhatianKhusus2 = [];
                if (!empty($data->rm11a2Timbang['perhatianKhusus2'])) {
                    $decodePerhatian2 = json_decode($data->rm11a2Timbang['perhatianKhusus2'], true);
                    $perhatianKhusus2 = is_array($decodePerhatian2) ? $decodePerhatian2 : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-2">
                            <label class="form-label fw-bold small text-secondary mb-0">Laboratorium :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-3">
                                    <input class="form-check-input" type="radio" name="labStatus2" value="Tidak Ada" id="labTidakAda2" <?= $labStatus2 === 'Tidak Ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="labTidakAda2">Tidak Ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="labStatus2" value="Ada" id="labAda2" <?= $labStatus2 === 'Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="labAda2">Ada, Jml :</label>
                                    </div>
                                    <input type="text" name="isiLabJml2" id="isiLabJml2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiLabJml2'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label fw-bold small text-secondary mb-0">Perhatian Khusus :</label>
                            </div>

                            <div class="row g-2 mt-1">
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus2[]" value="Hb" id="pkHb2" <?= in_array('Hb', $perhatianKhusus2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkHb2" style="width: 75px;">Hb :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiHb2" id="isiHb2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiHb2'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">gr/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus2[]" value="BUN" id="pkBun2" <?= in_array('BUN', $perhatianKhusus2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkBun2" style="width: 75px;">BUN :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiBun2" id="isiBun2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiBun2'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">mg/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus2[]" value="Lain-lain" id="pkLainLain2" <?= in_array('Lain-lain', $perhatianKhusus2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkLainLain2" style="width: 75px;">Lain-lain :</label>
                                        <input type="text" name="isiPkLainLain2" id="isiPkLainLain2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiPkLainLain2'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus2[]" value="Albumin" id="pkAlbumin2" <?= in_array('Albumin', $perhatianKhusus2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkAlbumin2" style="width: 75px;">Albumin :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiAlbumin2" id="isiAlbumin2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiAlbumin2'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">gr/dl</span>
                                        </div>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center mb-2">
                                        <input class="form-check-input flex-shrink-0 me-2" type="checkbox" name="perhatianKhusus2[]" value="Kreatinin" id="pkKreatinin2" <?= in_array('Kreatinin', $perhatianKhusus2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap me-2" for="pkKreatinin2" style="width: 75px;">Kreatinin :</label>
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="isiKreatinin2" id="isiKreatinin2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiKreatinin2'] ?? '' ?>">
                                            <span class="input-group-text bg-light text-muted border-secondary-subtle small">mg/dl</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FOTO 2 -->
                <?php
                $fotoStatus2 = $data->rm11a2Timbang['fotoStatus2'] ?? '';
                $fotoDetail2 = [];
                if (!empty($data->rm11a2Timbang['fotoDetail2'])) {
                    $decodeFoto2 = json_decode($data->rm11a2Timbang['fotoDetail2'], true);
                    $fotoDetail2 = is_array($decodeFoto2) ? $decodeFoto2 : [];
                }
                ?>
                <div class="row mt-2">
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Foto :</label>
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="radio" name="fotoStatus2" value="Tidak ada" id="fotoTidakAda2" <?= $fotoStatus2 === 'Tidak ada' ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="fotoTidakAda2">Tidak ada</label>
                                </div>
                                <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                    <div>
                                        <input class="form-check-input" type="radio" name="fotoStatus2" value="Ada" id="fotoAda2" <?= $fotoStatus2 === 'Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="fotoAda2">Ada, Jml :</label>
                                    </div>
                                    <input type="text" name="isiFotoJml2" id="isiFotoJml2" class="form-control form-control-sm border-success" style="max-width: 150px;" value="<?= $data->rm11a2Timbang['isiFotoJml2'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row g-2 mt-1 border-top">
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center gap-1 mb-2">
                                        <input class="form-check-input flex-shrink-0" type="checkbox" name="fotoDetail2[]" value="Rontgen" id="ftRontgen2" <?= in_array('Rontgen', $fotoDetail2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap ms-1" for="ftRontgen2">Rontgen</label>
                                        <input type="text" name="isiRontgenKet2" id="isiRontgenKet2" class="form-control form-control-sm border-success" placeholder="Keterangan..." value="<?= $data->rm11a2Timbang['isiRontgenKet2'] ?? '' ?>">
                                        <span class="small text-nowrap ms-1">jml :</span>
                                        <input type="text" name="isiRontgenJml2" id="isiRontgenJml2" class="form-control form-control-sm border-success" style="max-width: 70px;" value="<?= $data->rm11a2Timbang['isiRontgenJml2'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-1 mb-2">
                                        <input class="form-check-input flex-shrink-0" type="checkbox" name="fotoDetail2[]" value="USG" id="ftUsg2" <?= in_array('USG', $fotoDetail2) ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap ms-1" for="ftUsg2">USG</label>
                                        <input type="text" name="isiUsgKet2" id="isiUsgKet2" class="form-control form-control-sm border-success" placeholder="Keterangan..." value="<?= $data->rm11a2Timbang['isiUsgKet2'] ?? '' ?>">
                                        <span class="small text-nowrap ms-1">jml :</span>
                                        <input type="text" name="isiUsgJml2" id="isiUsgJml2" class="form-control form-control-sm border-success" style="max-width: 70px;" value="<?= $data->rm11a2Timbang['isiUsgJml2'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail2[]" value="BOF" id="ftBof2" <?= in_array('BOF', $fotoDetail2) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftBof2">BOF jml :</label>
                                        </div>
                                        <input type="text" name="isiBofJml2" id="isiBofJml2" class="form-control form-control-sm border-success" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiBofJml2'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail2[]" value="NST" id="ftNst2" <?= in_array('NST', $fotoDetail2) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftNst2">NST :</label>
                                        </div>
                                        <input type="text" name="isiNst2" id="isiNst2" class="form-control form-control-sm border-success" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiNst2'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail2[]" value="Echocardiografi" id="ftEcho2" <?= in_array('Echocardiografi', $fotoDetail2) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftEcho2">Echocardiografi jml :</label>
                                        </div>
                                        <input type="text" name="isiEchoJml2" id="isiEchoJml2" class="form-control form-control-sm border-success" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiEchoJml2'] ?? '' ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail2[]" value="IVP" id="ftIvp2" <?= in_array('IVP', $fotoDetail2) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftIvp2">IVP jml :</label>
                                        </div>
                                        <input type="text" name="isiIvpJml2" id="isiIvpJml2" class="form-control form-control-sm border-success" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiIvpJml2'] ?? '' ?>">
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-2 mb-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="fotoDetail2[]" value="EKG" id="ftEkg2" <?= in_array('EKG', $fotoDetail2) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="ftEkg2">EKG jml :</label>
                                        </div>
                                        <input type="text" name="isiEkgJml2" id="isiEkgJml2" class="form-control form-control-sm border-success" style="max-width: 100px;" value="<?= $data->rm11a2Timbang['isiEkgJml2'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex align-items-center gap-2 mt-2 pt-1 border-top">
                                <label class="form-label small fw-bold text-nowrap mb-0" for="isiFotoLainnya2">Lain-lain :</label>
                                <input type="text" name="isiFotoLainnya2" id="isiFotoLainnya2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiFotoLainnya2'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- VITAL SIGN 2 -->
                <div class="border border-success rounded p-2 mt-2">
                    <label class="form-label fw-bold small text-secondary mb-2">Vital Sign :</label>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiTdSistole2" style="width: 40px;">TD :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiTdSistole2" id="isiTdSistole2" class="form-control text-center border-success" placeholder="Sistole" value="<?= $data->rm11a2Timbang['isiTdSistole2'] ?? '' ?>">
                                    <span class="input-group-text border-success bg-white px-2 text-muted">/</span>
                                    <input type="text" name="isiTdDiastole2" id="isiTdDiastole2" class="form-control text-center border-success" placeholder="Diastole" value="<?= $data->rm11a2Timbang['isiTdDiastole2'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">mmHg</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiSuhu2" style="width: 40px;">S :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiSuhu2" id="isiSuhu2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiSuhu2'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">°C</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiRr2" style="width: 40px;">RR :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiRr2" id="isiRr2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiRr2'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">x/mnt</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center">
                                <label class="form-label small text-nowrap mb-0 me-2" for="isiNadi2" style="width: 40px;">N :</label>
                                <div class="input-group input-group-sm">
                                    <input type="text" name="isiNadi2" id="isiNadi2" class="form-control border-success" value="<?= $data->rm11a2Timbang['isiNadi2'] ?? '' ?>">
                                    <span class="input-group-text bg-light text-muted border-secondary-subtle small">x/mnt</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- PUASA 2 -->
                <?php $puasaStatus2 = $data->rm11a2Timbang['puasaStatus2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Puasa :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="puasaStatus2" value="Tidak" id="puasaTidak2" <?= $puasaStatus2 === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="puasaTidak2">Tidak</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0">
                            <div>
                                <input class="form-check-input" type="radio" name="puasaStatus2" value="Ya" id="puasaYa2" <?= $puasaStatus2 === 'Ya' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="puasaYa2">Ya, makan/ minum terakhir jam</label>
                            </div>
                            <input type="time" name="isiPuasaJam2" id="isiPuasaJam2" class="form-control form-control-sm border-success" style="max-width: 120px;" value="<?= $data->rm11a2Timbang['isiPuasaJam2'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- LAVEMENT 2 -->
                <?php $lavementStatus2 = $data->rm11a2Timbang['lavementStatus2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Lavement :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="lavementStatus2" value="Tidak" id="lavementTidak2" <?= $lavementStatus2 === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="lavementTidak2">Tidak</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0">
                            <div>
                                <input class="form-check-input" type="radio" name="lavementStatus2" value="Ya" id="lavementYa2" <?= $lavementStatus2 === 'Ya' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="lavementYa2">Ya :</label>
                            </div>
                            <input type="text" name="isiLavementKet2" id="isiLavementKet2" class="form-control form-control-sm border-success" placeholder="(BAB banyak / sedikit)" style="max-width: 200px;" value="<?= $data->rm11a2Timbang['isiLavementKet2'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- TAMPON ANUS 2 -->
                <?php $tamponAnus2 = $data->rm11a2Timbang['tamponAnus2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Tampon Anus :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="tamponAnus2" value="Tidak" id="tamponTidak2" <?= $tamponAnus2 === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="tamponTidak2">Tidak</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="tamponAnus2" value="Ya" id="tamponYa2" <?= $tamponAnus2 === 'Ya' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="tamponYa2">Ya</label>
                        </div>
                    </div>
                </div>

                <!-- SCEREN 2 -->
                <?php $scerenStatus2 = $data->rm11a2Timbang['scerenStatus2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Sceren :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus2" value="Tidak perlu" id="scerenTidakPerlu2" <?= $scerenStatus2 === 'Tidak perlu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenTidakPerlu2">Tidak perlu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus2" value="Perlu" id="scerenPerlu2" <?= $scerenStatus2 === 'Perlu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenPerlu2">Perlu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus2" value="Sudah" id="scerenSudah2" <?= $scerenStatus2 === 'Sudah' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="scerenSudah2">Sudah</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="scerenStatus2" value="Belum" id="scerenBelum2" <?= $scerenStatus2 === 'Belum' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="scerenBelum2">Belum</label>
                        </div>
                    </div>
                </div>

                <!-- GIGI PALSU 2 -->
                <?php $gigiPalsu2 = $data->rm11a2Timbang['gigiPalsu2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Gigi palsu :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="gigiPalsu2" value="Tidak" id="gigiTidak2" <?= $gigiPalsu2 === 'Tidak' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="gigiTidak2">Tidak</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="gigiPalsu2" value="Ada" id="gigiAda2" <?= $gigiPalsu2 === 'Ada' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="gigiAda2">Ada</label>
                        </div>
                        <div class="d-flex align-items-center gap-1 flex-grow-1">
                            <span class="small text-nowrap">dibawa oleh :</span>
                            <input type="text" name="isiGigiDibawaOleh2" id="isiGigiDibawaOleh2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiGigiDibawaOleh2'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- KESADARAN 2 -->
                <?php $kesadaran2 = $data->rm11a2Timbang['kesadaran2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex flex-wrap align-items-center gap-1">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 110px;">Kesadaran :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="kesadaran2" value="Sadar" id="kesadaranSadar2" <?= $kesadaran2 === 'Sadar' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="kesadaranSadar2">Sadar</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="kesadaran2" value="Tidak sadar" id="kesadaranTidakSadar2" <?= $kesadaran2 === 'Tidak sadar' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="kesadaranTidakSadar2">Tidak sadar</label>
                        </div>
                        <div class="form-check hover-check d-flex align-items-center gap-1 mb-0 me-0 flex-grow-1">
                            <div>
                                <input class="form-check-input" type="radio" name="kesadaran2" value="Lain-lain" id="kesadaranLainLain2" <?= $kesadaran2 === 'Lain-lain' ? 'checked' : '' ?>>
                                <label class="form-check-label small text-nowrap" for="kesadaranLainLain2">Lain-lain :</label>
                            </div>
                            <input type="text" name="isiKesadaranLain2" id="isiKesadaranLain2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiKesadaranLain2'] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <!-- KELUARGA MENUNGGU DI 2 -->
                <?php $keluargaTunggu2 = $data->rm11a2Timbang['keluargaTunggu2'] ?? ''; ?>
                <div class="border border-success rounded p-1 mt-1">
                    <div class="d-flex align-items-center gap-2">
                        <label class="form-label small fw-bold text-secondary mb-0" style="width: 150px;">Keluarga menunggu di :</label>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="keluargaTunggu2" value="R. Tunggu" id="tungguRTunggu2" <?= $keluargaTunggu2 === 'R. Tunggu' ? 'checked' : '' ?>>
                            <label class="form-check-label small me-2" for="tungguRTunggu2">R. Tunggu</label>
                        </div>
                        <div class="form-check hover-check mb-0 me-0">
                            <input class="form-check-input" type="radio" name="keluargaTunggu2" value="Ruangan" id="tungguRuangan2" <?= $keluargaTunggu2 === 'Ruangan' ? 'checked' : '' ?>>
                            <label class="form-check-label small" for="tungguRuangan2">Ruangan</label>
                        </div>
                    </div>
                </div>

                <!-- KONTAK PERSON & TELP 2 -->
                <div class="border border-success rounded p-1 mt-1">
                    <div class="row g-1">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-1">
                                <label class="form-label small fw-bold text-secondary text-nowrap mb-0" for="isiKontakPerson2" style="width: 110px;">Kontak Person :</label>
                                <input type="text" name="isiKontakPerson2" id="isiKontakPerson2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiKontakPerson2'] ?? '' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-1">
                                <label class="form-label small fw-bold text-secondary text-nowrap mb-0" for="isiTelpHubungi2" style="width: 130px;">Telp yg dihubungi :</label>
                                <input type="text" name="isiTelpHubungi2" id="isiTelpHubungi2" class="form-control form-control-sm border-success" value="<?= $data->rm11a2Timbang['isiTelpHubungi2'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <!-- ================= SISI KIRI ================= -->
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Assessment :</div>
                    <hr>
                </div>
                <div class="row mt-2">
                    <!-- PROSES ASSESMENT (RADIO) -->
                    <?php $assesment = $data->rm11a2Timbang['assesment'] ?? ''; ?>
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="assesment" value="Siap ditransport" id="assSiap" <?= ($assesment == 'Siap ditransport') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="assSiap">Siap ditransport</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="assesment" value="Ditransport dengan intervensi" id="assIntervensi" <?= ($assesment == 'Ditransport dengan intervensi') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="assIntervensi">Ditransport dengan intervensi</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= SISI KANAN (SUFFIX 2) ================= -->
        <div class="col-md-6">
            <div class="alert alert-success">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Assessment 2 :</div>
                    <hr>
                </div>
                <div class="row mt-2">
                    <!-- PROSES ASSESMENT 2 (RADIO) -->
                    <?php $assesment2 = $data->rm11a2Timbang['assesment2'] ?? ''; ?>
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="assesment2" value="Siap ditransport" id="assSiap2" <?= ($assesment2 == 'Siap ditransport') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="assSiap2">Siap ditransport</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="assesment2" value="Ditransport dengan intervensi" id="assIntervensi2" <?= ($assesment2 == 'Ditransport dengan intervensi') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="assIntervensi2">Ditransport dengan intervensi</label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ================= SISI KIRI ================= -->
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Recomendation :</div>
                    <hr>
                </div>

                <div class="row mt-2">
                    <!-- PROSES DECODE JSON DIDAMPINGI -->
                    <?php
                    $didampingi = [];
                    if (!empty($data->rm11a2Timbang['didampingi'])) {
                        $decodeDidampingi = json_decode($data->rm11a2Timbang['didampingi'], true);
                        $didampingi = is_array($decodeDidampingi) ? $decodeDidampingi : [];
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <label class="form-check-label small fw-bold">Didampingi :</label>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="didampingi[]" value="Perawat" id="dmpPerawat" <?= in_array('Perawat', $didampingi) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="dmpPerawat">Perawat</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="didampingi[]" value="Dokter" id="dmpDokter" <?= in_array('Dokter', $didampingi) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="dmpDokter">Dokter</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <!-- PROSES ALAT TRANSPORT (RADIO) -->
                    <?php $alatTransport = $data->rm11a2Timbang['alatTransport'] ?? ''; ?>
                    <div class="col-md-12">
                        <div class="border border-info rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <label class="form-check-label small fw-bold me-3">Alat Transport :</label>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport" value="Kursi Roda" id="altKursiRoda" <?= ($alatTransport == 'Kursi Roda') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altKursiRoda">Kursi Roda</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport" value="Brancard" id="altBrancard" <?= ($alatTransport == 'Brancard') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altBrancard">Brancard</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport" value="Bed" id="altBed" <?= ($alatTransport == 'Bed') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altBed">Bed</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0" for="medikasi">Medikasi Khusus :</label>
                        <input type="text" name="medikasi" id="medikasi" class="form-control" value="<?= htmlspecialchars($data->rm11a2Timbang['medikasi'] ?? '') ?>">
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= SISI KANAN (DITAMBAHI SUFFIX 2) ================= -->
        <div class="col-md-6">
            <div class="alert alert-success">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Recomendation 2 :</div>
                    <hr>
                </div>

                <div class="row mt-2">
                    <!-- PROSES DECODE JSON DIDAMPINGI 2 -->
                    <?php
                    $didampingi2 = [];
                    if (!empty($data->rm11a2Timbang['didampingi2'])) {
                        $decodeDidampingi2 = json_decode($data->rm11a2Timbang['didampingi2'], true);
                        $didampingi2 = is_array($decodeDidampingi2) ? $decodeDidampingi2 : [];
                    }
                    ?>
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <label class="form-check-label small fw-bold">Didampingi :</label>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="didampingi2[]" value="Perawat" id="dmpPerawat2" <?= in_array('Perawat', $didampingi2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="dmpPerawat2">Perawat</label>
                                </div>

                                <div class="form-check hover-check pe-1">
                                    <input class="form-check-input" type="checkbox" name="didampingi2[]" value="Dokter" id="dmpDokter2" <?= in_array('Dokter', $didampingi2) ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="dmpDokter2">Dokter</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <!-- PROSES ALAT TRANSPORT 2 (RADIO) -->
                    <?php $alatTransport2 = $data->rm11a2Timbang['alatTransport2'] ?? ''; ?>
                    <div class="col-md-12">
                        <div class="border border-success rounded p-1">
                            <div class="d-flex flex-wrap align-items-center mt-2">
                                <label class="form-check-label small fw-bold me-3">Alat Transport :</label>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport2" value="Kursi Roda" id="altKursiRoda2" <?= ($alatTransport2 == 'Kursi Roda') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altKursiRoda2">Kursi Roda</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport2" value="Brancard" id="altBrancard2" <?= ($alatTransport2 == 'Brancard') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altBrancard2">Brancard</label>
                                </div>

                                <div class="form-check hover-check pe-2">
                                    <input class="form-check-input" type="radio" name="alatTransport2" value="Bed" id="altBed2" <?= ($alatTransport2 == 'Bed') ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="altBed2">Bed</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0" for="medikasi2">Medikasi Khusus :</label>
                        <input type="text" name="medikasi2" id="medikasi2" class="form-control" value="<?= htmlspecialchars($data->rm11a2Timbang['medikasi2'] ?? '') ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- ================= SISI KIRI ================= -->
        <div class="col-md-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Petugas :</div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="waktu">Waktu :</label>
                        <?php
                        $valWaktu = $data->rm11a2Timbang['waktu'] ?? '';
                        // Konversi format database (YYYY-MM-DD HH:MM:SS) ke format HTML (YYYY-MM-DDTHH:MM)
                        if (!empty($valWaktu)) {
                            $valWaktu = date('Y-m-d\TH:i', strtotime($valWaktu));
                        }
                        ?>
                        <input type="datetime-local" class="form-control" name="waktu" id="waktu" value="<?= $valWaktu ?>">
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="pengantar">Pengantar :</label>
                        <select name="pengantar" id="pengantar" class="form-select">
                            <option value="">-- Pilih Petugas --</option>
                            <?php if (!empty($data->petugas)): ?>
                                <?php foreach ($data->petugas as $p): ?>
                                    <?php $selected = ($p['nama'] == ($data->rm11a2Timbang['pengantar'] ?? '')) ? 'selected' : ''; ?>
                                    <option value="<?= htmlspecialchars($p['nama']) ?>" <?= $selected ?>><?= htmlspecialchars($p['nama']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="penerima">Penerima :</label>
                        <select name="penerima" id="penerima" class="form-select">
                            <option value="">-- Pilih Petugas --</option>
                            <?php if (!empty($data->petugas)): ?>
                                <?php foreach ($data->petugas as $p): ?>
                                    <?php $selected = ($p['nama'] == ($data->rm11a2Timbang['penerima'] ?? '')) ? 'selected' : ''; ?>
                                    <option value="<?= htmlspecialchars($p['nama']) ?>" <?= $selected ?>><?= htmlspecialchars($p['nama']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= SISI KANAN (SUFFIX 2) ================= -->
        <div class="col-md-6">
            <div class="alert alert-success">
                <div class="row mb-1">
                    <div class="col-12 text-center fw-bold">Petugas 2 :</div>
                    <hr>
                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="waktu2">Waktu :</label>
                        <?php
                        $valWaktu2 = $data->rm11a2Timbang['waktu2'] ?? '';
                        if (!empty($valWaktu2)) {
                            $valWaktu2 = date('Y-m-d\TH:i', strtotime($valWaktu2));
                        }
                        ?>
                        <input type="datetime-local" class="form-control" name="waktu2" id="waktu2" value="<?= $valWaktu2 ?>">
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="pengantar2">Pengantar :</label>
                        <select name="pengantar2" id="pengantar2" class="form-select">
                            <option value="">-- Pilih Petugas --</option>
                            <?php if (!empty($data->petugas)): ?>
                                <?php foreach ($data->petugas as $p): ?>
                                    <?php $selected = ($p['nama'] == ($data->rm11a2Timbang['pengantar2'] ?? '')) ? 'selected' : ''; ?>
                                    <option value="<?= htmlspecialchars($p['nama']) ?>" <?= $selected ?>><?= htmlspecialchars($p['nama']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div class="col-sm-4">
                        <label class="form-label fw-bold small text-secondary mb-0" for="penerima2">Penerima :</label>
                        <select name="penerima2" id="penerima2" class="form-select">
                            <option value="">-- Pilih Petugas --</option>
                            <?php if (!empty($data->petugas)): ?>
                                <?php foreach ($data->petugas as $p): ?>
                                    <?php $selected = ($p['nama'] == ($data->rm11a2Timbang['penerima2'] ?? '')) ? 'selected' : ''; ?>
                                    <option value="<?= htmlspecialchars($p['nama']) ?>" <?= $selected ?>><?= htmlspecialchars($p['nama']) ?></option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </div>

</form>

<script>
    $(document.body).on('input change', '.col-md-6:first-child input', function() {
        let $inputKiri = $(this);
        let type = $inputKiri.attr('type');
        let idKiri = $inputKiri.attr('id');
        let nameKiri = $inputKiri.attr('name');

        // 1. INPUT TEXT, TIME, & DATE
        if (type === 'text' || type === 'time' || type === 'date') {
            let idKanan = idKiri + '2';
            $('#' + idKanan).val($inputKiri.val());
        }

        // 2. RADIO BUTTON
        else if (type === 'radio') {
            let valKiri = $inputKiri.val();
            let nameKanan = nameKiri + '2';
            $(`input[name="${nameKanan}"][value="${valKiri}"]`).prop('checked', true);
        }

        // 3. CHECKBOX
        else if (type === 'checkbox') {
            let valKiri = $inputKiri.val();
            let nameKanan = nameKiri.replace('[]', '2[]');
            let isChecked = $inputKiri.is(':checked');

            $(`input[name="${nameKanan}"][value="${valKiri}"]`).prop('checked', isChecked);
        }
    });
</script>