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

    <nav>
        <div class="nav nav-tabs justify-content-center bg-light" id="nav-tab" role="tablist">
            <button class="nav-link active d-inline-flex align-items-center gap-2" id="nav-signin-tab" data-bs-toggle="tab" data-bs-target="#nav-signin" type="button" role="tab" aria-controls="nav-signin" aria-selected="true">
                <i>Sign In</i>
                <input type="time" name="jamSignIn" id="jamSignIn" value="<?= !empty($data->rm11b1Checklist['jamSignIn']) ? substr($data->rm11b1Checklist['jamSignIn'], 0, 5) : '' ?>" class="form-control form-control-sm border-info" style="width: auto;" onclick="event.stopPropagation();">
            </button>

            <button class="nav-link d-inline-flex align-items-center gap-2" id="nav-timeout-tab" data-bs-toggle="tab" data-bs-target="#nav-timeout" type="button" role="tab" aria-controls="nav-timeout" aria-selected="false">
                <i>Time Out</i>
                <input type="time" name="jamTimeOut" id="jamTimeOut" value="<?= !empty($data->rm11b1Checklist['jamTimeOut']) ? substr($data->rm11b1Checklist['jamTimeOut'], 0, 5) : '' ?>" class="form-control form-control-sm border-info" style="width: auto;" onclick="event.stopPropagation();">
            </button>

            <button class="nav-link d-inline-flex align-items-center gap-2" id="nav-signout-tab" data-bs-toggle="tab" data-bs-target="#nav-signout" type="button" role="tab" aria-controls="nav-signout" aria-selected="false">
                <i>Sign Out</i>
                <input type="time" name="jamSignOut" id="jamSignOut" value="<?= !empty($data->rm11b1Checklist['jamSignOut']) ? substr($data->rm11b1Checklist['jamSignOut'], 0, 5) : '' ?>" class="form-control form-control-sm border-info" style="width: auto;" onclick="event.stopPropagation();">
            </button>


            <div class="ms-5 m-1 p-1 alert alert-info">
                <input type="text" class="form-control form-control-sm" name="ruang" id="ruang" placeholder="Ruang Rawat" value="<?= $data->rm11b1Checklist['ruang'] ?? '' ?>">
            </div>

            <div class="m-1 p-1 alert alert-info">
                <input type="date" class="form-control form-control-sm" name="tgl" id="tgl" value="<?= $data->rm11b1Checklist['tgl'] ?? '' ?>">
            </div>

        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-signin" role="tabpanel" aria-labelledby="nav-signin-tab">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="alert alert-info">
                        <div class="row">
                            <!-- PROSES DECODE JSON VERIFIKASI -->
                            <?php
                            $verifikasi = [];
                            if (!empty($data->rm11b1Checklist['verifikasi'])) {
                                $decodedAlasan = json_decode($data->rm11b1Checklist['verifikasi'], true);
                                $verifikasi = is_array($decodedAlasan) ? $decodedAlasan : [];
                            }
                            ?>
                            <div class="col-sm-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-0">Verifikasi</p>
                                    <div class="d-flex flex-column">

                                        <!-- 1. Identitas dan gelang pasien -->
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="verifikasi[]" value="Identitas dan gelang pasien" id="identitasGelang" <?= in_array('Identitas dan gelang pasien', $verifikasi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="identitasGelang">Identitas dan gelang pasien</label>
                                        </div>

                                        <!-- 2. Informed consent -->
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="verifikasi[]" value="Informed consent" id="informedConsent" <?= in_array('Informed consent', $verifikasi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="informedConsent">Informed consent</label>
                                        </div>

                                        <!-- Submenu Informed Consent (Menjorok ke dalam) -->
                                        <div class="ms-4 d-flex flex-column gap-1">
                                            <div class="form-check hover-check d-flex align-items-center gap-2 mb-0">
                                                <input class="form-check-input mt-0" type="checkbox" name="verifikasi[]" value="Dokter Bedah" id="dokterBedahCheck" <?= in_array('Dokter Bedah', $verifikasi) ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="dokterBedahCheck">
                                                    Dokter Bedah :
                                                </label>
                                                <select name="dokterBedah" id="dokterBedah" class="form-select form-select-sm" style="max-width: 150px;">
                                                    <option value="" <?= (empty($data->rm11b1Checklist['dokterBedah'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                        $selected = (($data->rm11b1Checklist['dokterBedah'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                        echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-check hover-check d-flex align-items-center gap-2 mb-0">
                                                <input class="form-check-input" type="checkbox" name="verifikasi[]" value="Dokter anestesi" id="dokterAnestesiCheck" <?= in_array('Dokter anestesi', $verifikasi) ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="dokterAnestesiCheck">Dokter anestesi :</label>

                                                <select name="dokterAnestesi" id="dokterAnestesi" class="form-select form-select-sm" style="max-width: 150px;">
                                                    <option value="" <?= (empty($data->rm11b1Checklist['dokterAnestesi'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                        $selected = (($data->rm11b1Checklist['dokterAnestesi'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                        echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                                    } ?>
                                                </select>
                                            </div>
                                            <div class="form-check hover-check d-flex align-items-center gap-2 mb-0">
                                                <input class="form-check-input" type="checkbox" name="verifikasi[]" value="Nama Tindakan" id="namaTindakanVerifCheck" <?= in_array('Nama Tindakan', $verifikasi) ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="namaTindakanVerifCheck">Nama Tindakan :</label>
                                                <input type="text" name="namaTindakan" id="namaTindakan" class="form-control form-control-sm" style="max-width: 200px;" value="<?= $data->rm11b1Checklist['namaTindakan'] ?? '' ?>">
                                            </div>
                                        </div>

                                        <!-- 3. Pemberian tanda dilokasi operasi -->
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="verifikasi[]" value="Pemberian tanda dilokasi operasi" id="pemberianTanda" <?= in_array('Pemberian tanda dilokasi operasi', $verifikasi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="pemberianTanda">Pemberian tanda dilokasi operasi</label>
                                        </div>

                                        <!-- Submenu Radio Ya / Tidak (Menjorok ke dalam & Menyamping) -->
                                        <div class="ms-4 d-flex align-items-center gap-3">
                                            <div class="form-check form-check-inline hover-check mb-0">
                                                <input class="form-check-input" type="radio" name="pemberian_tanda_pilihan" value="Ya" id="tandaYa" <?= (($data->rm11b1Checklist['pemberian_tanda_pilihan'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="tandaYa">Ya</label>
                                            </div>
                                            <div class="form-check form-check-inline hover-check mb-0">
                                                <input class="form-check-input" type="radio" name="pemberian_tanda_pilihan" value="Tidak" id="tandaTidak" <?= (($data->rm11b1Checklist['pemberian_tanda_pilihan'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="tandaTidak">Tidak</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <p class="form-label fw-bold small text-secondary mb-0">Diagnosa Pasien</p>
                                <input type="text" name="diagnosa" id="diagnosa" class="form-control" value="<?= $data->rm11b1Checklist['diagnosa'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- PROSES DECODE JSON KELENGKAPAN -->
                            <?php
                            $kelengkapan = [];
                            if (!empty($data->rm11b1Checklist['kelengkapan'])) {
                                $decodedAlasan = json_decode($data->rm11b1Checklist['kelengkapan'], true);
                                $kelengkapan = is_array($decodedAlasan) ? $decodedAlasan : [];
                            }
                            ?>
                            <div class="col-sm-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Pemeriksaan Kelengkapan Pasien</p>
                                    <div class="d-flex flex-wrap align-items-center">

                                        <!-- 1. Mesin anestesi -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="kelengkapan[]" value="Mesin anestesi" id="mesinAnestesi" <?= in_array('Mesin anestesi', $kelengkapan) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="mesinAnestesi">Mesin anestesi</label>
                                        </div>

                                        <!-- 2. IV Line -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="kelengkapan[]" value="IV Line" id="ivLine" <?= in_array('IV Line', $kelengkapan) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="ivLine">IV Line</label>
                                        </div>

                                        <!-- 3. Obat – obatan -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="kelengkapan[]" value="Obat – obatan" id="obatObatan" <?= in_array('Obat – obatan', $kelengkapan) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="obatObatan">Obat – obatan</label>
                                        </div>

                                        <!-- 4. Laboratorium -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="kelengkapan[]" value="Laboratorium" id="laboratorium" <?= in_array('Laboratorium', $kelengkapan) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="laboratorium">Laboratorium</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <p class="form-label fw-bold small text-secondary mb-0">Perawat Anestesi :</p>
                                <select name="perawatAnestesi" id="perawatAnestesi" class="form-select form-select-sm" style="max-width: 250px;">
                                    <option value="" <?= ($data->rm11b1Checklist["perawatAnestesi"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm11b1Checklist["perawatAnestesi"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="alert alert-info" role="alert">

                        <div class="row border border-info rounded p-1">
                            <label class="form-label fw-bold small text-secondary mb-0">Pemeriksaan Tanda Vital :</label>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Kesadaran</label>
                                <input type="text" id="kesadaran" name="kesadaran" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['kesadaran'] ?? '' ?>">

                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Tekanan Darah</label>
                                <input type="text" id="tekananDarah" name="tekananDarah" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['tekananDarah'] ?? '' ?>">

                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Nadi</label>
                                <input type="text" id="nadi" name="nadi" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['nadi'] ?? '' ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Saturasi Oksigin</label>
                                <input type="text" id="saturasiOksigen" name="saturasiOksigen" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['saturasiOksigen'] ?? '' ?>">

                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Suhu</label>
                                <input type="text" id="suhu" name="suhu" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['suhu'] ?? '' ?>">

                                <label class="form-label fw-bold text-secondary mb-0" style="font-size: x-small;">Skala Nyeri</label>
                                <input type="text" id="skalaNyeri" name="skalaNyeri" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['skalaNyeri'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Riwayat Alergi :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="alergi" id="alergiTdk" value="Tidak Ada" <?= (($data->rm11b1Checklist["alergi"] ?? '') === "Tidak Ada") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="alergiTdk">Tidak Ada</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="alergi" id="alergiYa" value="Ada" <?= (($data->rm11b1Checklist["alergi"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="alergiYa">Ada.</label>
                                    </div>
                                    <label class="form-label fw-bold text-secondary mb-0 text-nowrap" style="font-size: x-small;">Sebutkan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="text" class="form-control form-control-sm border-info py-0" name="isiAlergi" id="isiAlergi" style="max-width: 120px;" value="<?= $data->rm11b1Checklist['isiAlergi'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Risiko Aspirasi dan Gangguan Pernafasan :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="aspirasi" id="aspirasiTdk" value="Tidak" <?= (($data->rm11b1Checklist["aspirasi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="aspirasiTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="aspirasi" id="aspirasiYa" value="Ya" <?= (($data->rm11b1Checklist["aspirasi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="aspirasiYa">Ya</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Risiko Pendarahan :</label>
                                    <sub>(Kehilangan Darah &gt; 500 ml)</sub>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pendrahan" id="pendrahanYa" value="Ya" <?= (($data->rm11b1Checklist["pendrahan"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pendrahanYa">Ya, (Satu IV line/CVP)</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pendrahan" id="pendrahanTdk" value="Tidak" <?= (($data->rm11b1Checklist["pendrahan"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pendrahanTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <!-- PROSES DECODE JSON RENCANA ANESTESI -->
                            <?php
                            $rencanaAnestesi = [];
                            if (!empty($data->rm11b1Checklist['rencanaAnestesi'])) {
                                $decodedRencana = json_decode($data->rm11b1Checklist['rencanaAnestesi'], true);
                                $rencanaAnestesi = is_array($decodedRencana) ? $decodedRencana : [];
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-0">Rencana Anestesi :</p>
                                    <div class="d-flex flex-wrap align-items-center">

                                        <!-- 1. Umum -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Umum" id="anestesiUmum" <?= in_array('Umum', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiUmum">Umum</label>
                                        </div>

                                        <!-- 2. Lokal -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Lokal" id="anestesiLokal" <?= in_array('Lokal', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiLokal">Lokal</label>
                                        </div>

                                        <!-- 3. Topikal -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Topikal" id="anestesiTopikal" <?= in_array('Topikal', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiTopikal">Topikal</label>
                                        </div>

                                        <!-- 4. Spinal -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Spinal" id="anestesiSpinal" <?= in_array('Spinal', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiSpinal">Spinal</label>
                                        </div>

                                        <!-- 5. Epidural -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Epidural" id="anestesiEpidural" <?= in_array('Epidural', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiEpidural">Epidural</label>
                                        </div>

                                        <!-- 6. Blok -->
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="rencanaAnestesi[]" value="Blok" id="anestesiBlok" <?= in_array('Blok', $rencanaAnestesi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="anestesiBlok">Blok</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-timeout" role="tabpanel" aria-labelledby="nav-timeout-tab">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="alert alert-info">
                        <div class="row">
                            <!-- PROSES DECODE JSON VERBAL1 -->
                            <?php
                            $verbal1 = [];
                            if (!empty($data->rm11b1Checklist['verbal1'])) {
                                $decodedVerbal1 = json_decode($data->rm11b1Checklist['verbal1'], true);
                                $verbal1 = is_array($decodedVerbal1) ? $decodedVerbal1 : [];
                            }
                            ?>
                            <div class="col-sm-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Baca Secara Verbal :</p>
                                    <div class="d-flex flex-wrap align-items-center gap-1">

                                        <!-- 1. Tanggal tindakan -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Tanggal tindakan" id="tanggalTindakan" <?= in_array('Tanggal tindakan', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tanggalTindakan">Tanggal tindakan</label>
                                        </div>

                                        <!-- 2. Nama tindakan -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Nama tindakan" id="namaTindakanCheck" <?= in_array('Nama tindakan', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="namaTindakanCheck">Nama tindakan</label>
                                        </div>

                                        <!-- 3. Lokasi tindakan -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Lokasi tindakan" id="lokasiTindakan" <?= in_array('Lokasi tindakan', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="lokasiTindakan">Lokasi tindakan</label>
                                        </div>

                                        <!-- 4. Identitas pasien -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Identitas pasien" id="identitasPasien" <?= in_array('Identitas pasien', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="identitasPasien">Identitas pasien</label>
                                        </div>

                                        <!-- 5. Prosedur tindakan -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Prosedur tindakan" id="prosedurTindakan" <?= in_array('Prosedur tindakan', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="prosedurTindakan">Prosedur tindakan</label>
                                        </div>

                                        <!-- 6. Informed consent -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Informed consent" id="informedConsentVerbal" <?= in_array('Informed consent', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="informedConsentVerbal">Informed consent</label>
                                        </div>

                                        <!-- 7. Konfirmasi seluruh anggota tim -->
                                        <div class="form-check hover-check pe-0">
                                            <input class="form-check-input" type="checkbox" name="verbal1[]" value="Konfirmasi seluruh anggota tim" id="konfirmasiAnggotaTim" <?= in_array('Konfirmasi seluruh anggota tim', $verbal1) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="konfirmasiAnggotaTim">Konfirmasi seluruh anggota tim</label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kelengkapan Tim dan Fasilitas Operasi :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="fasilitasOperasi" id="fasilitasOperasiLengkap" value="Lengkap" <?= (($data->rm11b1Checklist["fasilitasOperasi"] ?? '') === "Lengkap") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="fasilitasOperasiLengkap">Lengkap</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="fasilitasOperasi" id="fasilitasOperasiTdkLengkap" value="Tidak Lengkap" <?= (($data->rm11b1Checklist["fasilitasOperasi"] ?? '') === "Tidak Lengkap") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="fasilitasOperasiTdkLengkap">Tidak Lengkap</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-column border border-info rounded p-2 gap-2">
                                    <label class="form-label fw-bold small text-secondary mb-0">Antibiotik <i>Prophylaxys</i> :</label>

                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="profilaksis" id="profilaksisTidak" value="Tidak" <?= (($data->rm11b1Checklist["profilaksis"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="profilaksisTidak">Tidak</label>
                                    </div>

                                    <div class="bg-light rounded p-2 d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <div class="form-check mb-0 me-2">
                                                <input class="form-check-input" type="radio" name="profilaksis" id="profilaksisYa" value="Ya" <?= (($data->rm11b1Checklist["profilaksis"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="profilaksisYa">Ya, Nama Obat : </label>
                                            </div>
                                            <input type="text" name="profilaksisObat" id="profilaksisObat" class="form-control form-control-sm border-info me-2" style="max-width: 120px;" value="<?= $data->rm11b1Checklist['profilaksisObat'] ?? '' ?>">

                                            <div class="d-flex align-items-center small text-nowrap me-2">
                                                <span class="me-1">Jam:</span>
                                                <input type="time" name="profilaksisJam" id="profilaksisJam" class="form-control form-control-sm border-info" style="max-width: 90px;" value="<?= !empty($data->rm11b1Checklist['profilaksisJam']) ? substr($data->rm11b1Checklist['profilaksisJam'], 0, 5) : '' ?>">
                                            </div>

                                            <div class="d-flex align-items-center small text-nowrap">
                                                <span class="me-1">Dosis:</span>
                                                <input type="text" name="profilaksisDosis" id="profilaksisDosis" class="form-control form-control-sm border-info" style="max-width: 80px;" value="<?= $data->rm11b1Checklist['profilaksisDosis'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <p class="form-label fw-bold small text-secondary mb-0">Sirkuler :</p>
                                <select name="sirkuler" id="sirkuler" class="form-select form-select-sm" style="max-width: 250px;">
                                    <option value="" <?= ($data->rm11b1Checklist["sirkuler"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm11b1Checklist["sirkuler"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <p class="form-label fw-bold small text-secondary mb-0">Instrumen :</p>
                                <select name="instrumen" id="instrumen" class="form-select form-select-sm" style="max-width: 250px;">
                                    <option value="" <?= ($data->rm11b1Checklist["instrumen"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm11b1Checklist["instrumen"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="alert alert-info">
                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class="border border-info rounded p-1 pb-2">
                                    <label class="form-label fw-bold small text-secondary mb-0">Antisipasi kejadian kritis :</label>
                                    <ol type="a" class="small">
                                        <li>
                                            Bagian Bedah : Langkah apa yang
                                            dilakukan bila kondisi kritis atau
                                            kejadian yang tidak diharapkan
                                            pemanjangan lamanya operasi dan
                                            antisipasi kehilangan darah ?
                                            <input type="text" class="form-control form-control-sm" id="antisipasi1" name="antisipasi1" value="<?= $data->rm11b1Checklist["antisipasi1"] ?? '' ?>">
                                        </li>
                                        <li>
                                            Bagian Anestesi : Apakah ada hal
                                            khusus yang perlu diperhatikan pada
                                            pasien ?
                                            <input type="text" class="form-control form-control-sm" id="antisipasi2" name="antisipasi2" value="<?= $data->rm11b1Checklist["antisipasi2"] ?? '' ?>">
                                        </li>
                                        <li>
                                            Bagian Perawat : <br>
                                            <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                                Indikator steril :
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi31" id="antisipasi31Ada" value="Ada" <?= (($data->rm11b1Checklist["antisipasi31"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi31Ada">Ada</label>
                                                </div>
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi31" id="antisipasi31Tidak" value="Tidak" <?= (($data->rm11b1Checklist["antisipasi31"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi31Tidak">Tidak</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center mt-1">
                                                Masalah Pada Instrument :
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi32" id="antisipasi32Ada" value="Ada" <?= (($data->rm11b1Checklist["antisipasi32"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi32Ada">Ada</label>
                                                </div>
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi32" id="antisipasi32Tidak" value="Tidak" <?= (($data->rm11b1Checklist["antisipasi32"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi32Tidak">Tidak</label>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center mt-1">
                                                Adakah Alat Khusus :
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi33" id="antisipasi33Ada" value="Ada" <?= (($data->rm11b1Checklist["antisipasi33"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi33Ada">Ada</label>
                                                </div>
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="antisipasi33" id="antisipasi33Tidak" value="Tidak" <?= (($data->rm11b1Checklist["antisipasi33"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="antisipasi33Tidak">Tidak</label>
                                                </div>
                                            </div>

                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-signout" role="tabpanel" aria-labelledby="nav-signout-tab">
            <div class="row mt-3">
                <div class="col-sm-6">
                    <div class="alert alert-info" role="alert">
                        <div class="row">
                            <div class="col-sm-12 border border-info rounded p-1">
                                <label class="form-label fw-bold small text-secondary mb-2">Baca Secara Verbal :</label>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="small mb-0 text-nowrap">
                                        Nama Tindakan :
                                    </small>
                                    <input type="text" name="verbal2" id="verbal2" class="form-control form-control-sm" value="<?= $data->rm11b1Checklist['verbal2'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 border border-info rounded p-1">
                            <!-- PROSES DECODE JSON KELENGKAPAN OPERASI -->
                            <?php
                            $kelengkapanOperasi = [];
                            if (!empty($data->rm11b1Checklist['kelengkapanOperasi'])) {
                                $decodedKelengkapan = json_decode($data->rm11b1Checklist['kelengkapanOperasi'], true);
                                $kelengkapanOperasi = is_array($decodedKelengkapan) ? $decodedKelengkapan : [];
                            }
                            ?>
                            <div class="col-md-12">
                                <p class="form-label fw-bold small text-secondary mb-0">Kelengkapan Operasi :</p>
                                <div class="d-flex flex-wrap align-items-center gap-2 mt-2">

                                    <!-- 1. Instrumen -->
                                    <div class="form-check hover-check pe-2">
                                        <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Instrumen" id="kelengkapanInstrumen" <?= in_array('Instrumen', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kelengkapanInstrumen">Instrumen</label>
                                    </div>

                                    <!-- 2. Kassa -->
                                    <div class="form-check hover-check pe-2">
                                        <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Kassa" id="kelengkapanKassa" <?= in_array('Kassa', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kelengkapanKassa">Kassa</label>
                                    </div>

                                    <!-- 3. Jarum -->
                                    <div class="form-check hover-check pe-2">
                                        <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Jarum" id="kelengkapanJarum" <?= in_array('Jarum', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kelengkapanJarum">Jarum</label>
                                    </div>

                                    <!-- 4. Spon -->
                                    <div class="form-check hover-check pe-2">
                                        <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Spon" id="kelengkapanSpon" <?= in_array('Spon', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kelengkapanSpon">Spon</label>
                                    </div>

                                    <!-- 5. Depper -->
                                    <div class="form-check hover-check pe-2">
                                        <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Depper" id="kelengkapanDepper" <?= in_array('Depper', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kelengkapanDepper">Depper</label>
                                    </div>

                                    <!-- 6. Lainnya -->
                                    <div class="form-check hover-check pe-2 d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="kelengkapanOperasi[]" value="Lainnya" id="kelengkapanLainnya" <?= in_array('Lainnya', $kelengkapanOperasi) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="kelengkapanLainnya">Lainnya :</label>
                                        </div>
                                        <input type="text" name="isiKelengkapanLainnya" id="isiKelengkapanLainnya" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11b1Checklist['isiKelengkapanLainnya'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 border border-info rounded">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary mb-2">Periksa Kelengkapan Bahan Pemeriksaan :</label>
                                <ol class="small" type="a">
                                    <li>
                                        <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                            Preparat :
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="preparat" id="preparatYa" value="Ya" <?= (($data->rm11b1Checklist["preparat"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="preparatYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="preparat" id="preparatTidak" value="Tidak" <?= (($data->rm11b1Checklist["preparat"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="preparatTidak">Tidak</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        Jenis :
                                        <div class="row">
                                            <!-- PROSES DECODE JSON jenis / SPECIMEN -->
                                            <?php
                                            $jenis = [];
                                            if (!empty($data->rm11b1Checklist['jenis'])) {
                                                $decodedjenis = json_decode($data->rm11b1Checklist['jenis'], true);
                                                $jenis = is_array($decodedjenis) ? $decodedjenis : [];
                                            }
                                            ?>
                                            <div class="col-md-12">
                                                <div class="border border-info rounded p-2 h-100">
                                                    <div class="d-flex flex-wrap align-items-center mt-2">

                                                        <!-- 1. P.A -->
                                                        <div class="form-check hover-check pe-0">
                                                            <input class="form-check-input" type="checkbox" name="jenis[]" value="P.A" id="jenisPa" <?= in_array('P.A', $jenis) ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="jenisPa">P.A</label>
                                                        </div>

                                                        <!-- 2. Kultur -->
                                                        <div class="form-check hover-check pe-0">
                                                            <input class="form-check-input" type="checkbox" name="jenis[]" value="Kultur" id="jenisKultur" <?= in_array('Kultur', $jenis) ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="jenisKultur">Kultur</label>
                                                        </div>

                                                        <!-- 3. Sitologi -->
                                                        <div class="form-check hover-check pe-0">
                                                            <input class="form-check-input" type="checkbox" name="jenis[]" value="Sitologi" id="jenisSitologi" <?= in_array('Sitologi', $jenis) ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="jenisSitologi">Sitologi</label>
                                                        </div>

                                                        <!-- 4. Lainnya -->
                                                        <div class="form-check hover-check pe-0 d-flex align-items-center gap-1">
                                                            <div>
                                                                <input class="form-check-input" type="checkbox" name="jenis[]" value="Lainnya" id="jenisLainnya" <?= in_array('Lainnya', $jenis) ? 'checked' : '' ?>>
                                                                <label class="form-check-label small text-nowrap" for="jenisLainnya">Lainnya :</label>
                                                            </div>
                                                            <input type="text" name="isijenisLainnya" id="isijenisLainnya" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11b1Checklist['isijenisLainnya'] ?? '' ?>">
                                                        </div>

                                                        <!-- 5. Tidak ada -->
                                                        <div class="form-check hover-check pe-0">
                                                            <input class="form-check-input" type="checkbox" name="jenis[]" value="Tidak ada" id="jenisTidakAda" <?= in_array('Tidak ada', $jenis) ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="jenisTidakAda">Tidak ada</label>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center mt-2">
                                            Formulir :
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="formulir" id="formulirAda" value="Ada" <?= (($data->rm11b1Checklist["formulir"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="formulirAda">Ada</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="formulir" id="formulirTidak" value="Tidak" <?= (($data->rm11b1Checklist["formulir"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="formulirTidak">Tidak</label>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center mt-2">
                                            Telah dilengkapi identitas Pasien :
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="lengkapiIdentitas" id="lengkapiIdentitasYa" value="Ya" <?= (($data->rm11b1Checklist["lengkapiIdentitas"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="lengkapiIdentitasYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="lengkapiIdentitas" id="lengkapiIdentitasTidak" value="Tidak" <?= (($data->rm11b1Checklist["lengkapiIdentitas"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="lengkapiIdentitasTidak">Tidak</label>
                                            </div>
                                        </div>
                                    </li>
                                </ol>

                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <p class="form-label fw-bold small text-secondary mb-0">Asisten :</p>
                                <select name="asisten" id="asisten" class="form-select form-select-sm" style="max-width: 250px;">
                                    <option value="" <?= ($data->rm11b1Checklist["asisten"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->rm11b1Checklist["asisten"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="alert alert-info" role="alert">
                        <div class="row border border-info rounded">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary mb-2">Perhatian Khusus Untuk Pasien :</label>
                                <ol type="a" class="small">
                                    <li>
                                        Dari Operator :
                                        <input type="text" class="form-control form-control-sm" id="perhatianOperator" name="perhatianOperator" value="<?= $data->rm11b1Checklist["perhatianOperator"] ?? '' ?>">
                                    </li>
                                    <li>
                                        Dari Dokter Spesialis :
                                        <input type="text" class="form-control form-control-sm" id="perhatianDokter" name="perhatianDokter" value="<?= $data->rm11b1Checklist["perhatianDokter"] ?? '' ?>">
                                    </li>
                                    <li>
                                        Dari Dokter Perawat Bedah :
                                        <input type="text" class="form-control form-control-sm" id="perhatianPerawat" name="perhatianPerawat" value="<?= $data->rm11b1Checklist["perhatianPerawat"] ?? '' ?>">
                                    </li>
                                </ol>
                            </div>
                        </div>

                        <div class="row mt-2 border border-info rounded p-1">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary">Apakah Pasien Sudah Bisa Pindah ke Ruang Pemulihan :</label>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangPemulihan" id="ruangPemulihanYa" value="Ya" <?= (($data->rm11b1Checklist["ruangPemulihan"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruangPemulihanYa">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangPemulihan" id="ruangPemulihanTidak" value="Tidak" <?= (($data->rm11b1Checklist["ruangPemulihan"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruangPemulihanTidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 border border-info rounded p-1">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary">Perikasa Kembali Luka Operasi :</label>
                                <div class="d-flex flex-wrap gap-2 align-items-center mt-2">
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="periksaKembali" id="periksaKembaliYa" value="Ada Rembesan" <?= (($data->rm11b1Checklist["periksaKembali"] ?? '') === "Ada Rembesan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="periksaKembaliYa">Ada Rembesan</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="periksaKembali" id="periksaKembaliTidak" value="Tidak Ada Rembesan" <?= (($data->rm11b1Checklist["periksaKembali"] ?? '') === "Tidak Ada Rembesan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="periksaKembaliTidak">Tidak Ada Rembesan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2 border border-info rounded p-1 pt-0">
                            <div class="col-12">
                                <label class="form-label fw-bold small text-secondary m-0">Instruksi Khusus:</label>
                                <textarea name="instruksiKhusus" id="instruksiKhusus" class="form-control"><?= $data->rm11b1Checklist["instruksiKhusus"] ?? '' ?></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <p class="form-label fw-bold small text-secondary mb-0">dr. Operator :</p>
                                <select name="operator" id="operator" class="form-select form-select-sm">
                                    <option value="" <?= (empty($data->rm11b1Checklist['operator'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                        $selected = (($data->rm11b1Checklist['operator'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                        echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <p class="form-label fw-bold small text-secondary mb-0">dr. Anestesi :</p>
                                <select name="drAnestesi" id="drAnestesi" class="form-select form-select-sm">
                                    <option value="" <?= (empty($data->rm11b1Checklist['drAnestesi'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                        $selected = (($data->rm11b1Checklist['drAnestesi'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                        echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>