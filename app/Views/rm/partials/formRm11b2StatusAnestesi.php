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

    .table-info tr,
    .table-info th,
    .table-info td {
        border-color: #bbbbbb !important;
    }
</style>
<form>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs  justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="dokterperawat-tab" data-bs-toggle="tab" data-bs-target="#dokterperawat" type="button" role="tab" aria-controls="dokterperawat" aria-selected="true">Dokter/Perawat</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="iassesment-tab" data-bs-toggle="tab" data-bs-target="#iassesment" type="button" role="tab" aria-controls="iassesment" aria-selected="false">I. Assesment</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="iirencana-tab" data-bs-toggle="tab" data-bs-target="#iirencana" type="button" role="tab" aria-controls="iirencana" aria-selected="false">II. Rencana</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="iiiasessement-tab" data-bs-toggle="tab" data-bs-target="#iiiasessement" type="button" role="tab" aria-controls="iiiasessement" aria-selected="false">III. Assesment (Induksi)</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="ivDaftar-tab" data-bs-toggle="tab" data-bs-target="#ivDaftar" type="button" role="tab" aria-controls="ivDaftar" aria-selected="false">IV. Daftar Tilik</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="vTata-tab" data-bs-toggle="tab" data-bs-target="#vTata" type="button" role="tab" aria-controls="vTata" aria-selected="false">V. Tata Laksana</button>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="dokterperawat" role="tabpanel" aria-labelledby="dokterperawat-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Data Lokasi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ruangan/Poli :</label>
                                    <input type="text" class="form-control" id="ruang" name="ruang" value="<?= $data->rm11b2StatusAnestesi['ruang'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosis Pra-Anestesi :</label>
                                    <textarea class="form-control" id="diagnosisPraAnestesi" name="diagnosisPraAnestesi"><?= $data->rm11b2StatusAnestesi['diagnosisPraAnestesi'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Rencana Tindakan :</label>
                                    <textarea type="text" class="form-control" id="rencanaTindakan" name="rencanaTindakan"><?= $data->rm11b2StatusAnestesi['rencanaTindakan'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal :</label>
                                    <input type="date" class="form-control" id="tgl" name="tgl" value="<?= $data->rm11b2StatusAnestesi['tgl'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tempat :</label>
                                    <input type="text" class="form-control" id="tempat" name="tempat" value="<?= $data->rm11b2StatusAnestesi['tempat'] ?? '' ?>">
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-12 text-center">Data Petugas :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diisi Oleh (dokter/perawat) :</label>
                                    <input type="text" class="form-control" id="petugas" name="petugas" value="<?= $data->rm11b2StatusAnestesi['petugas'] ?? session()->get('nama') ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Spesialis Bedah :</label>
                                    <input type="text" class="form-control" id="spesialisBedah" name="spesialisBedah" value="<?= $data->rm11b2StatusAnestesi['spesialisBedah'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Asisten Bedah :</label>
                                    <input type="text" class="form-control" id="asistenBedah" name="asistenBedah" value="<?= $data->rm11b2StatusAnestesi['asistenBedah'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Spesialis Anestesiologi :</label>
                                    <input type="text" class="form-control" id="spesialisAnestesiologi" name="spesialisAnestesiologi" value="<?= $data->rm11b2StatusAnestesi['spesialisAnestesiologi'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Asisten/Perawat Anestesi :</label>
                                    <input type="text" class="form-control" id="asistenAnestesi" name="asistenAnestesi" value="<?= $data->rm11b2StatusAnestesi['asistenAnestesi'] ?? '' ?>">
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane" id="iassesment" role="tabpanel" aria-labelledby="iassesment-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Riwayat :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Anamnesa dari :</label>

                                            <?php
                                            // Parsing data anamnesaDari terlebih dahulu
                                            $rawAnamnesa = $data->rm11b2StatusAnestesi["anamnesaDari"] ?? [];
                                            $anamnesaArr = is_string($rawAnamnesa) ? json_decode($rawAnamnesa, true) : (array)$rawAnamnesa;
                                            $anamnesaArr = is_array($anamnesaArr) ? $anamnesaArr : [];
                                            ?>

                                            <!-- Pilihan Pasien -->
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="checkbox" name="anamnesaDari[]" id="anamnesaPasien" value="Pasien" <?= in_array("Pasien", $anamnesaArr) ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="anamnesaPasien">Pasien</label>
                                            </div>

                                            <!-- Pilihan Keluarga -->
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="checkbox" name="anamnesaDari[]" id="anamnesaKeluarga" value="Keluarga" <?= in_array("Keluarga", $anamnesaArr) ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="anamnesaKeluarga">Keluarga</label>
                                            </div>

                                            <!-- Pilihan Lainnya -->
                                            <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                <input class="form-check-input mt-0" type="checkbox" name="anamnesaDari[]" id="anamnesaLainnya" value="Lainnya" <?= in_array("Lainnya", $anamnesaArr) ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="anamnesaLainnya">
                                                    Lainnya :
                                                </label>
                                                <input type="text" id="anamnesaLainnyaText" name="anamnesaLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm11b2StatusAnestesi['anamnesaLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat Anestesi :</label>

                                            <!-- Pilihan Tidak Ada -->
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="riwayatAnestesi" id="anestesiTidak" value="Tidak ada" <?= (($data->rm11b2StatusAnestesi["riwayatAnestesi"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="anestesiTidak">Tidak ada</label>
                                            </div>

                                            <!-- Pilihan Ada -->
                                            <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                <input class="form-check-input mt-0" type="radio" name="riwayatAnestesi" id="anestesiAda" value="Ada" <?= (($data->rm11b2StatusAnestesi["riwayatAnestesi"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="anestesiAda">
                                                    Ada :
                                                </label>
                                                <input type="text" id="keteranganAnestesi" name="keteranganAnestesi" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm11b2StatusAnestesi['keteranganAnestesi'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Komplikasi :</label>

                                            <!-- Pilihan Tidak Ada -->
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="riwayatKomplikasi" id="riwayatKomplikasiTidak" value="Tidak ada" <?= (($data->rm11b2StatusAnestesi["riwayatKomplikasi"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="riwayatKomplikasiTidak">Tidak ada</label>
                                            </div>

                                            <!-- Pilihan Ada -->
                                            <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                <input class="form-check-input mt-0" type="radio" name="riwayatKomplikasi" id="riwayatKomplikasiAda" value="Ada" <?= (($data->rm11b2StatusAnestesi["riwayatKomplikasi"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="riwayatKomplikasiAda">
                                                    Ada :
                                                </label>
                                                <input type="text" id="keteranganKomplikasi" name="keteranganKomplikasi" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm11b2StatusAnestesi['keteranganKomplikasi'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Obat yang sedang dikonsumsi :</label>
                                    <input type="text" class="form-control" id="obatDikonsumsi" name="obatDikonsumsi" value="<?= $data->rm11b2StatusAnestesi['obatDikonsumsi'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1">
                                        <div class="d-flex flex-wrap gap-2 align-items-center">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat Alergi :</label>

                                            <!-- Pilihan Tidak Ada -->
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="riwayatAlergi" id="alergiTidak" value="Tidak ada" <?= (($data->rm11b2StatusAnestesi["riwayatAlergi"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="alergiTidak">Tidak ada</label>
                                            </div>

                                            <!-- Pilihan Ada -->
                                            <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                <input class="form-check-input mt-0" type="radio" name="riwayatAlergi" id="alergiAda" value="Ada" <?= (($data->rm11b2StatusAnestesi["riwayatAlergi"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="alergiAda">
                                                    Ada :
                                                </label>
                                                <input type="text" id="keteranganAlergi" name="keteranganAlergi" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm11b2StatusAnestesi['keteranganAlergi'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Keadaan :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-2">

                                        <!-- Baris 1: BB, TB, BMI -->
                                        <div class="row g-2 align-items-center mb-2">
                                            <div class="col-md-4">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">BB :</span>
                                                    <input type="text" name="beratBadan" class="form-control" value="<?= $data->rm11b2StatusAnestesi['beratBadan'] ?? '' ?>">
                                                    <span class="input-group-text">Kg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">TB :</span>
                                                    <input type="text" name="tinggiBadan" class="form-control" value="<?= $data->rm11b2StatusAnestesi['tinggiBadan'] ?? '' ?>">
                                                    <span class="input-group-text">cm</span>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">BMI :</span>
                                                    <input type="text" name="bmi" class="form-control" value="<?= $data->rm11b2StatusAnestesi['bmi'] ?? '' ?>">
                                                    <span class="input-group-text">(k/p)</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Baris 2: Sub-header Tanda Vital -->
                                        <div class="row mb-1">
                                            <div class="col-12">
                                                <label class="fw-bold small text-secondary">Tanda Vital :</label>
                                            </div>
                                        </div>

                                        <!-- Baris 3: TD & Nadi -->
                                        <div class="row g-2 align-items-center mb-2">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">TD :</span>
                                                    <input type="text" name="tensiDarah" class="form-control" value="<?= $data->rm11b2StatusAnestesi['tensiDarah'] ?? '' ?>">
                                                    <span class="input-group-text">mmHg</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Nadi :</span>
                                                    <input type="text" name="nadi" class="form-control" value="<?= $data->rm11b2StatusAnestesi['nadi'] ?? '' ?>">
                                                    <span class="input-group-text">x/mnt</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Baris 4: RR & Suhu -->
                                        <div class="row g-2 align-items-center mb-2">
                                            <div class="col-md-6">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">RR :</span>
                                                    <input type="text" name="rr" class="form-control" value="<?= $data->rm11b2StatusAnestesi['rr'] ?? '' ?>">
                                                    <span class="input-group-text">x/mnt</span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Suhu :</span>
                                                    <input type="text" name="suhu" class="form-control" value="<?= $data->rm11b2StatusAnestesi['suhu'] ?? '' ?>">
                                                    <span class="input-group-text">°C</span>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Baris 5: Skor Nyeri -->
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="input-group input-group-sm">
                                                    <span class="input-group-text">Skor Nyeri :</span>
                                                    <input type="text" name="skorNyeri" class="form-control" value="<?= $data->rm11b2StatusAnestesi['skorNyeri'] ?? '' ?>">
                                                    <span class="input-group-text">(k/p)</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>


                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Evaluasi jalan nafas :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-2">

                                        <!-- 1. Bebas : Ya / Tidak -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Bebas :</label>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="bebas" id="bebasYa" value="Ya" <?= (($data->rm11b2StatusAnestesi['bebas'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="bebasYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="bebas" id="bebasTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['bebas'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="bebasTidak">Tidak</label>
                                            </div>
                                        </div>

                                        <!-- 2. Alat bantu nafas (jika ada) -->
                                        <div class="d-flex flex-wrap gap-0 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="alatBantuNafas">Alat bantu nafas (jika ada) :</label>
                                            <input type="text" id="alatBantuNafas" name="alatBantuNafas" class="form-control form-control-sm flex-grow-1" value="<?= $data->rm11b2StatusAnestesi['alatBantuNafas'] ?? '' ?>">
                                        </div>

                                        <!-- 3. Buka Mulut : ... cm -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="bukaMulut">Buka Mulut :</label>
                                            <div class="input-group input-group-sm" style="width: auto;">
                                                <input type="text" id="bukaMulut" name="bukaMulut" class="form-control" value="<?= $data->rm11b2StatusAnestesi['bukaMulut'] ?? '' ?>">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>

                                        <!-- 4. Leher : Pendek / Tidak -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Leher :</label>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="leher" id="leherPendek" value="Pendek" <?= (($data->rm11b2StatusAnestesi['leher'] ?? '') === 'Pendek') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="leherPendek">Pendek</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="leher" id="leherTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['leher'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="leherTidak">Tidak</label>
                                            </div>
                                        </div>

                                        <!-- 5. Gerak Leher : Bebas / Terbatas -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Gerak Leher :</label>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="gerakLeher" id="gerakBebas" value="Bebas" <?= (($data->rm11b2StatusAnestesi['gerakLeher'] ?? '') === 'Bebas') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="gerakBebas">Bebas</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="gerakLeher" id="gerakTerbatas" value="Terbatas" <?= (($data->rm11b2StatusAnestesi['gerakLeher'] ?? '') === 'Terbatas') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="gerakTerbatas">Terbatas</label>
                                            </div>
                                        </div>

                                        <!-- 6. Mallampathy (k/p) -->
                                        <div class="d-flex flex-wrap gap-0 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="mallampathy">Mallampathy (k/p) :</label>
                                            <input type="text" id="mallampathy" name="mallampathy" class="form-control form-control-sm flex-grow-1" value="<?= $data->rm11b2StatusAnestesi['mallampathy'] ?? '' ?>">
                                        </div>

                                        <!-- 7. Obesitas : Ya / Tidak -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Obesitas :</label>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="obesitas" id="obesitasYa" value="Ya" <?= (($data->rm11b2StatusAnestesi['obesitas'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="obesitasYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="obesitas" id="obesitasTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['obesitas'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="obesitasTidak">Tidak</label>
                                            </div>
                                        </div>

                                        <!-- 8. Massa : Ya / Tidak -->
                                        <div class="d-flex flex-wrap gap-2 align-items-center mb-0">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Massa :</label>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="massa" id="massaYa" value="Ya" <?= (($data->rm11b2StatusAnestesi['massa'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="massaYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="massa" id="massaTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['massa'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="massaTidak">Tidak</label>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Pemeriksaan laboratorium :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <!-- 1. Hb/Het -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="hbHet">Hb/Het :</label>
                                        <textarea id="hbHet" name="hbHet" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['hbHet'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 2. Fungsi Ginjal -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="fungsiGinjal">Fungsi Ginjal :</label>
                                        <textarea id="fungsiGinjal" name="fungsiGinjal" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['fungsiGinjal'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 3. Fungsi Hati -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="fungsiHati">Fungsi Hati :</label>
                                        <textarea id="fungsiHati" name="fungsiHati" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['fungsiHati'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 4. Serum Elektrolit -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="serumElektrolit">Serum Elektrolit :</label>
                                        <textarea id="serumElektrolit" name="serumElektrolit" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['serumElektrolit'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 5. Faal Hematosis (BT / CT) -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-1 ms-1">Faal Hematosis :</label>
                                        <div class="ms-3 d-flex flex-column gap-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="form-label small text-secondary mb-0" style="min-width: 35px;" for="faalBT">BT :</label>
                                                <input type="text" id="faalBT" name="faalBT" class="form-control form-control-sm" value="<?= $data->rm11b2StatusAnestesi['faalBT'] ?? '' ?>">
                                            </div>
                                            <div class="d-flex align-items-center gap-2">
                                                <label class="form-label small text-secondary mb-0" style="min-width: 35px;" for="faalCT">CT :</label>
                                                <input type="text" id="faalCT" name="faalCT" class="form-control form-control-sm" value="<?= $data->rm11b2StatusAnestesi['faalCT'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 6. Lain-lain -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="lainLainLab">Lain-lain :</label>
                                        <textarea id="lainLainLab" name="lainLainLab" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['lainLainLab'] ?? '' ?></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Simpulan Asesmen Pra-anestesi :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-2">

                                        <!-- 1. PSA ASA -->
                                        <div class="mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="psaAsa">PSA ASA :</label>
                                            <textarea id="psaAsa" name="psaAsa" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['psaAsa'] ?? '' ?></textarea>
                                        </div>

                                        <!-- 2. Penyulit -->
                                        <div class="mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="penyulit">Penyulit :</label>
                                            <textarea id="penyulit" name="penyulit" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['penyulit'] ?? '' ?></textarea>
                                        </div>

                                        <!-- 3. Komplikasi -->
                                        <div class="mb-2">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="komplikasi">Komplikasi :</label>
                                            <textarea id="komplikasi" name="komplikasi" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['komplikasi'] ?? '' ?></textarea>
                                        </div>

                                        <!-- 4. Rencana Tindakan Anestesi -->
                                        <div class="mb-0">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="rencanaTindakanAnestesi">Rencana Tindakan Anestesi :</label>
                                            <textarea id="rencanaTindakanAnestesi" name="rencanaTindakanAnestesi" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['rencanaTindakanAnestesi'] ?? '' ?></textarea>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-12 text-center">Pemeriksaan penunjang :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">

                                    <!-- 1. Echocardiografi -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="echocardiografi">Echocardiografi :</label>
                                        <textarea id="echocardiografi" name="echocardiografi" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['echocardiografi'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 2. EKG -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="ekg">EKG :</label>
                                        <textarea id="ekg" name="ekg" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['ekg'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 3. Foto Radiologi -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="fotoRadiologi">Foto Radiologi :</label>
                                        <textarea id="fotoRadiologi" name="fotoRadiologi" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['fotoRadiologi'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 4. Evaluasi Faal Paru -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="evaluasiFaalParu">Evaluasi Faal Paru :</label>
                                        <textarea id="evaluasiFaalParu" name="evaluasiFaalParu" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['evaluasiFaalParu'] ?? '' ?></textarea>
                                    </div>

                                    <!-- 5. Lain-lain -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="lainLainPenunjang">Lain-lain :</label>
                                        <textarea id="lainLainPenunjang" name="lainLainPenunjang" class="form-control form-control-sm mt-1" rows="2"><?= $data->rm11b2StatusAnestesi['lainLainPenunjang'] ?? '' ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Pengecekan organ :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <table class="table table-bordered border-black table-info align-middle mb-0 text-secondary" style="--bs-table-border-color: #000000;">
                                        <thead class="text-center">
                                            <tr>
                                                <td style="width: 50%;">
                                                    <label class="form-label text-dark fw-bold small text-secondary mb-0">Fungsi Sistem Organ</label>
                                                </td>
                                                <td style="width: 10%;">
                                                    <label class="form-label text-dark fw-bold small text-secondary mb-0">DBN</label>
                                                </td>
                                                <td style="width: 40%;">
                                                    <label class="form-label text-dark fw-bold small text-secondary mb-0">CATATAN</label>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- 1. Pernafasan -->
                                            <tr>
                                                <td>
                                                    <?php
                                                    // Decode data JSON menjadi array PHP terlebih dahulu
                                                    $pernafasanRaw = $data->rm11b2StatusAnestesi["pernafasan"] ?? '[]';
                                                    if (is_string($pernafasanRaw)) {
                                                        $pernafasan = json_decode($pernafasanRaw, true) ?? [];
                                                    } else {
                                                        $pernafasan = (array)$pernafasanRaw;
                                                    }
                                                    ?>

                                                    <div class="fw-bold text-center small mb-2">Pernafasan</div>
                                                    <div class="row g-2">
                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="asthma" value="Asthma" <?= in_array("Asthma", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="asthma">Asthma</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="ppok" value="PPOK" <?= in_array("PPOK", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="ppok">PPOK</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="pneumonia" value="Pneumonia" <?= in_array("Pneumonia", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="pneumonia">Pneumonia</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="tuberkulosis" value="Tuberkulosis" <?= in_array("Tuberkulosis", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="tuberkulosis">Tuberkulosis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="dyspnea" value="Dyspnea" <?= in_array("Dyspnea", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="dyspnea">Dyspnea</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="pernafasan[]" id="efusiPleura" value="Efusi Pleura" <?= in_array("Efusi Pleura", $pernafasan) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="efusiPleura">Efusi Pleura</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="pernafasanLainnyaCheck" id="pernafasanLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['pernafasanLainnyaCheck']) && $data->rm11b2StatusAnestesi['pernafasanLainnyaCheck'] == 1) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="pernafasanLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="pernafasanLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['pernafasanLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="pernafasanDbn" id="pernafasanDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['pernafasanDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <label class="form-label fw-bold small text-secondary mb-1">Merokok :</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check small mb-0">
                                                            <input class="form-check-input" type="radio" name="merokok" id="merokokYa" value="Ya" <?= (($data->rm11b2StatusAnestesi['merokok'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="merokokYa">Ya</label>
                                                        </div>
                                                        <div class="form-check small mb-0">
                                                            <input class="form-check-input" type="radio" name="merokok" id="merokokTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['merokok'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="merokokTidak">Tidak</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- 2. Kardiovaskuler -->
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-center small mb-2">Kardiovaskuler</div>
                                                    <div class="row g-2">
                                                        <?php
                                                        // Pastikan kardiovaskuler diambil sebagai array yang valid
                                                        $kardiovaskulerSelected = $data->rm11b2StatusAnestesi['kardiovaskuler'] ?? [];
                                                        if (is_string($kardiovaskulerSelected)) {
                                                            $kardiovaskulerSelected = json_decode($kardiovaskulerSelected, true) ?? [];
                                                        }
                                                        ?>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="ekgAbnormal" value="EKG Abnormal" <?= in_array("EKG Abnormal", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="ekgAbnormal">EKG Abnormal</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="infarkMyokard" value="Infark myokard" <?= in_array("Infark myokard", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="infarkMyokard">Infark myokard</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="gagalJantungCongestif" value="Gagal jantung kongestif" <?= in_array("Gagal jantung kongestif", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="gagalJantungCongestif">Gagal jantung kongestif</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="limitasiAktifitas" value="Limitasi aktifitas" <?= in_array("Limitasi aktifitas", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="limitasiAktifitas">Limitasi aktifitas</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="penyakitKatup" value="Penyakit katup" <?= in_array("Penyakit katup", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="penyakitKatup">Penyakit katup</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="hipertensi" value="Hipertensi" <?= in_array("Hipertensi", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="hipertensi">Hipertensi</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="angina" value="Angina" <?= in_array("Angina", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="angina">Angina</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="murmur" value="Murmur" <?= in_array("Murmur", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="murmur">Murmur</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="kardiovaskuler[]" id="pacemaker" value="Pacemaker" <?= in_array("Pacemaker", $kardiovaskulerSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="pacemaker">Pacemaker</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="kardiovaskulerLainnyaCheck" id="kardiovaskulerLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['kardiovaskulerLainnyaCheck'])) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="kardiovaskulerLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="kardiovaskulerLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['kardiovaskulerLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="kardiovaskulerDbn" id="kardiovaskulerDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['kardiovaskulerDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <label class="form-label fw-bold small text-secondary mb-1">Alkohol :</label>
                                                    <div class="d-flex gap-3">
                                                        <div class="form-check small mb-0">
                                                            <input class="form-check-input" type="radio" name="alkohol" id="alkoholYa" value="Ya" <?= (($data->rm11b2StatusAnestesi['alkohol'] ?? '') === 'Ya') ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="alkoholYa">Ya</label>
                                                        </div>
                                                        <div class="form-check small mb-0">
                                                            <input class="form-check-input" type="radio" name="alkohol" id="alkoholTidak" value="Tidak" <?= (($data->rm11b2StatusAnestesi['alkohol'] ?? '') === 'Tidak') ? 'checked' : '' ?>>
                                                            <label class="form-check-label" for="alkoholTidak">Tidak</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- 3. Neuro/Muskuloskeletal -->
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-center small mb-2">Neuro/Muskuloskeletal</div>
                                                    <div class="row g-2">
                                                        <?php
                                                        // Ambil data neuroMuskuloskeletal dan pastikan berbentuk array valid
                                                        $neuroSelected = $data->rm11b2StatusAnestesi['neuroMuskuloskeletal'] ?? [];
                                                        if (is_string($neuroSelected)) {
                                                            $neuroSelected = json_decode($neuroSelected, true) ?? [];
                                                        }
                                                        ?>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="arthritis" value="Arthritis" <?= in_array("Arthritis", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="arthritis">Arthritis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="parestesis" value="Parestesis" <?= in_array("Parestesis", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="parestesis">Parestesis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="paralisis" value="Paralisis" <?= in_array("Paralisis", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="paralisis">Paralisis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="nyeriKepala" value="Nyeri kepala" <?= in_array("Nyeri kepala", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="nyeriKepala">Nyeri kepala</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="kejang" value="Kejang" <?= in_array("Kejang", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="kejang">Kejang</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="kelemahanOtot" value="Kelemahan otot" <?= in_array("Kelemahan otot", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="kelemahanOtot">Kelemahan otot</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="neuromuscularDis" value="Neuromuscular Dis" <?= in_array("Neuromuscular Dis", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="neuromuscularDis">Neuromuscular Dis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="cvaStrokeTia" value="CVA/stroke/TIA" <?= in_array("CVA/stroke/TIA", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="cvaStrokeTia">CVA/stroke/TIA</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="penurunanKesadaran" value="Penurunan kesadaran" <?= in_array("Penurunan kesadaran", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="penurunanKesadaran">Penurunan kesadaran</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletal[]" id="backProblema" value="Back problema" <?= in_array("Back problema", $neuroSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="backProblema">Back problema</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="neuroLainnyaCheck" id="neuroLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['neuroLainnyaCheck'])) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="neuroLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="neuroLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['neuroLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="neuroMuskuloskeletalDbn" id="neuroMuskuloskeletalDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['neuroMuskuloskeletalDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <textarea name="catatanNeuro" class="form-control form-control-sm" rows="3" placeholder="Catatan..."><?= $data->rm11b2StatusAnestesi['catatanNeuro'] ?? '' ?></textarea>
                                                </td>
                                            </tr>

                                            <!-- 4. Renal/Endokrin -->
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-center small mb-2">Renal/Endokrin</div>
                                                    <div class="row g-2">
                                                        <?php
                                                        // Ambil data renalEndokrin dan pastikan berbentuk array valid
                                                        $renalSelected = $data->rm11b2StatusAnestesi['renalEndokrin'] ?? [];
                                                        if (is_string($renalSelected)) {
                                                            $renalSelected = json_decode($renalSelected, true) ?? [];
                                                        }
                                                        ?>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="diabetesMelitus" value="Diabetes melitus" <?= in_array("Diabetes melitus", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="diabetesMelitus">Diabetes melitus</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="gagalGinjalDialisis" value="Gagal ginjal/Dialisis" <?= in_array("Gagal ginjal/Dialisis", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="gagalGinjalDialisis">Gagal ginjal/Dialisis</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="beratBadanTurun" value="Berat badan turun" <?= in_array("Berat badan turun", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="beratBadanTurun">Berat badan turun</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="penyakitThyroid" value="Penyakit thyroid" <?= in_array("Penyakit thyroid", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="penyakitThyroid">Penyakit thyroid</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="retensiUrine" value="Retensi urine" <?= in_array("Retensi urine", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="retensiUrine">Retensi urine</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="renalEndokrin[]" id="isk" value="ISK" <?= in_array("ISK", $renalSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="isk">ISK</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="renalLainnyaCheck" id="renalLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['renalLainnyaCheck'])) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="renalLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="renalLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['renalLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="renalEndokrinDbn" id="renalEndokrinDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['renalEndokrinDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <textarea name="catatanRenal" class="form-control form-control-sm" rows="3" placeholder="Catatan..."><?= $data->rm11b2StatusAnestesi['catatanRenal'] ?? '' ?></textarea>
                                                </td>
                                            </tr>

                                            <!-- 5. Hepato/Gastrointestinal -->
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-center small mb-2">Hepato/Gastrointestinal</div>
                                                    <div class="row g-2">
                                                        <?php
                                                        // Ambil data hepatoGastro dan pastikan berbentuk array valid
                                                        $hepatoSelected = $data->rm11b2StatusAnestesi['hepatoGastro'] ?? [];
                                                        if (is_string($hepatoSelected)) {
                                                            $hepatoSelected = json_decode($hepatoSelected, true) ?? [];
                                                        }
                                                        ?>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="hepatoGastro[]" id="obstruksiUsus" value="Obstruksi Usus" <?= in_array("Obstruksi Usus", $hepatoSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="obstruksiUsus">Obstruksi Usus</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="hepatoGastro[]" id="mualMuntah" value="Mual & muntah" <?= in_array("Mual & muntah", $hepatoSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="mualMuntah">Mual & muntah</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="hepatoGastro[]" id="sirosis" value="Sirosis" <?= in_array("Sirosis", $hepatoSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="sirosis">Sirosis</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="hepatoGastro[]" id="tukakPeptikUlkus" value="Tukak peptik/ulkus" <?= in_array("Tukak peptik/ulkus", $hepatoSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="tukakPeptikUlkus">Tukak peptik/ulkus</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="hepatoGastro[]" id="hepatitisIkhterus" value="Hepatitis/Ikhterus" <?= in_array("Hepatitis/Ikhterus", $hepatoSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="hepatitisIkhterus">Hepatitis/Ikhterus</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="hepatoLainnyaCheck" id="hepatoLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['hepatoLainnyaCheck'])) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="hepatoLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="hepatoLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['hepatoLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="hepatoGastroDbn" id="hepatoGastroDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['hepatoGastroDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <textarea name="catatanHepato" class="form-control form-control-sm" rows="3" placeholder="Catatan..."><?= $data->rm11b2StatusAnestesi['catatanHepato'] ?? '' ?></textarea>
                                                </td>
                                            </tr>

                                            <!-- 6. Lain-lain -->
                                            <tr>
                                                <td>
                                                    <div class="fw-bold text-center small mb-2">Lain-lain</div>
                                                    <div class="row g-2">
                                                        <?php
                                                        // Ambil data organLainLain dan pastikan berbentuk array valid
                                                        $organLainSelected = $data->rm11b2StatusAnestesi['organLainLain'] ?? [];
                                                        if (is_string($organLainSelected)) {
                                                            $organLainSelected = json_decode($organLainSelected, true) ?? [];
                                                        }
                                                        ?>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="anemia" value="Anemia" <?= in_array("Anemia", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="anemia">Anemia</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="kanker" value="Kanker" <?= in_array("Kanker", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="kanker">Kanker</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="dehidrasi" value="Dehidrasi" <?= in_array("Dehidrasi", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="dehidrasi">Dehidrasi</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="hemofilia" value="Hemofilia" <?= in_array("Hemofilia", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="hemofilia">Hemofilia</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="immunosupresan" value="Immunosupresan" <?= in_array("Immunosupresan", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="immunosupresan">Immunosupresan</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="kehamilan" value="Kehamilan" <?= in_array("Kehamilan", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="kehamilan">Kehamilan</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="riwayatTranfusi" value="Riwayat tranfusi" <?= in_array("Riwayat tranfusi", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="riwayatTranfusi">Riwayat tranfusi</label>
                                                            </div>
                                                            <div class="form-check small mb-1">
                                                                <input class="form-check-input" type="checkbox" name="organLainLain[]" id="antikoagulan" value="Antikoagulan" <?= in_array("Antikoagulan", $organLainSelected) ? 'checked' : '' ?>>
                                                                <label class="form-check-label" for="antikoagulan">Antikoagulan</label>
                                                            </div>
                                                        </div>
                                                        <!-- Input Lainnya -->
                                                        <div class="col-12 mt-1">
                                                            <div class="d-flex align-items-center gap-2">
                                                                <div class="form-check small mb-0">
                                                                    <input class="form-check-input" type="checkbox" name="organLainnyaCheck" id="organLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['organLainnyaCheck'])) ? 'checked' : '' ?>>
                                                                    <label class="form-check-label text-nowrap" for="organLainnyaCheck">Lainnya :</label>
                                                                </div>
                                                                <input type="text" name="organLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['organLainnyaText'] ?? '' ?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="text-center">
                                                    <input class="form-check-input" type="checkbox" name="organLainLainDbn" id="organLainLainDbn" value="1" <?= (!empty($data->rm11b2StatusAnestesi['organLainLainDbn'])) ? 'checked' : '' ?>>
                                                </td>
                                                <td>
                                                    <textarea name="catatanOrganLain" class="form-control form-control-sm" rows="3" placeholder="Catatan..."><?= $data->rm11b2StatusAnestesi['catatanOrganLain'] ?? '' ?></textarea>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">

                                    <!-- 1. Diperiksa Oleh -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="dokterI">Diperiksa Oleh :</label>
                                        <select name="dokterI" id="dokterI" class="form-select form-select-sm">
                                            <option value="" <?= (empty($data->rm11b2StatusAnestesi['dokterI'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                $selected = (($data->rm11b2StatusAnestesi['dokterI'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- 2. Tanggal / Jam -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="tanggalJamI">Tanggal / Jam :</label>
                                        <input type="datetime-local" id="tanggalJamI" name="tanggalJamI" class="form-control form-control-sm mt-1" value="<?= isset($data->rm11b2StatusAnestesi['tanggalJamI']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2StatusAnestesi['tanggalJamI'])) : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="iirencana" role="tabpanel" aria-labelledby="iirencana-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Obat awal :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1 mb-2">
                                        <?php
                                        // Decode JSON untuk obatAwal
                                        $obatAwalRaw = $data->rm11b2StatusAnestesi["obatAwal"] ?? '[]';
                                        $obatAwal = is_string($obatAwalRaw) ? (json_decode($obatAwalRaw, true) ?? []) : (array)$obatAwalRaw;

                                        // Decode JSON untuk permedikasiDetail
                                        $permedikasiDetailRaw = $data->rm11b2StatusAnestesi["permedikasiDetail"] ?? '[]';
                                        $permedikasiDetail = is_string($permedikasiDetailRaw) ? (json_decode($permedikasiDetailRaw, true) ?? []) : (array)$permedikasiDetailRaw;
                                        ?>

                                        <!-- 1. Permedikasi -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatAwal[]" id="permedikasi" value="Permedikasi" <?= in_array("Permedikasi", $obatAwal) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="permedikasi">Permedikasi</label>
                                        </div>

                                        <div class="ms-4 text-secondary small">
                                            <!-- Midazolam -->
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="permedikasiDetail[]" id="midazolam" value="Midazolam, Dosis 0,07-0,15 mg/KgBB, IM" <?= in_array("Midazolam, Dosis 0,07-0,15 mg/KgBB, IM", $permedikasiDetail) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="midazolam">1. Midazolam, Dosis 0,07-0,15 mg/KgBB, IM</label>
                                            </div>

                                            <!-- Morphine -->
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="permedikasiDetail[]" id="morphine" value="Morphine, Dosis 0,05-0,2 mg/KgBB, IM" <?= in_array("Morphine, Dosis 0,05-0,2 mg/KgBB, IM", $permedikasiDetail) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="morphine">2. Morphine, Dosis 0,05-0,2 mg/KgBB, IM</label>
                                            </div>

                                            <!-- Pethidine -->
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="permedikasiDetail[]" id="pethidine" value="Pethidine Dosis 0,5-1 mg/KgBB, IM" <?= in_array("Pethidine Dosis 0,5-1 mg/KgBB, IM", $permedikasiDetail) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="pethidine">3. Pethidine Dosis 0,5-1 mg/KgBB, IM</label>
                                            </div>

                                            <!-- Sulfas Atropin -->
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="permedikasiDetail[]" id="sulfasAtropin" value="Sulfas Atropin, Dosis 0,01-0,02 mg/KgBB, IM" <?= in_array("Sulfas Atropin, Dosis 0,01-0,02 mg/KgBB, IM", $permedikasiDetail) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="sulfasAtropin">4. Sulfas Atropin, Dosis 0,01-0,02 mg/KgBB, IM</label>
                                            </div>

                                            <!-- 5. Lainnya -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="permedikasiLainnyaCheck" id="permedikasiLainnyaCheck" value="1" <?= (($data->rm11b2StatusAnestesi['permedikasiLainnyaCheck'] ?? 0) == 1) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="permedikasiLainnyaCheck">5. Lainnya :</label>
                                                </div>
                                                <input type="text" name="permedikasiLainnya" class="form-control form-control-sm" placeholder="Keterangan tambahan..." value="<?= $data->rm11b2StatusAnestesi['permedikasiLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-1">
                                        <!-- 2. General Anestesi -->
                                        <div class="d-flex align-items-start gap-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="obatAwal[]" id="generalAnestesi" value="General Anestesi"
                                                    <?= in_array("General Anestesi", is_string($data->rm11b2StatusAnestesi["obatAwal"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatAwal"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatAwal"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="generalAnestesi">General Anestesi :</label>
                                            </div>

                                            <div class="row g-2 text-secondary small flex-grow-1">
                                                <div class="col-6">
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="generalAnestesiTipe[]" id="gaMasker" value="Masker"
                                                            <?= in_array("Masker", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="gaMasker">Masker</label>
                                                    </div>
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="generalAnestesiTipe[]" id="gaTiv" value="TIV"
                                                            <?= in_array("TIV", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="gaTiv">TIV</label>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="generalAnestesiTipe[]" id="gaIntubasi" value="Intubasi"
                                                            <?= in_array("Intubasi", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="gaIntubasi">Intubasi</label>
                                                    </div>
                                                    <div class="form-check mb-1">
                                                        <input class="form-check-input" type="checkbox" name="generalAnestesiTipe[]" id="gaLma" value="LMA"
                                                            <?= in_array("LMA", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label" for="gaLma">LMA</label>
                                                    </div>
                                                </div>
                                                <!-- Input Lainnya untuk General Anestesi -->
                                                <div class="col-12 mt-1">
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div class="form-check mb-0">
                                                            <input class="form-check-input" type="checkbox" name="gaLainnyaCheck" id="gaLainnyaCheck" value="1"
                                                                <?= (!empty($data->rm11b2StatusAnestesi['gaLainnyaCheck']) && $data->rm11b2StatusAnestesi['gaLainnyaCheck'] == 1) ? 'checked' : '' ?>>
                                                            <label class="form-check-label text-nowrap" for="gaLainnyaCheck">Lainnya :</label>
                                                        </div>
                                                        <input type="text" name="gaLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['gaLainnyaText'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Obat Induksi :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">

                                    <!-- 1. Insufilasi -->
                                    <div class="d-flex align-items-center gap-2 p-1">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="checkbox" name="obatInduksi[]" id="insufilasi" value="Insufilasi" <?= in_array("Insufilasi", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1 text-nowrap" for="insufilasi">Insufilasi dengan :</label>
                                        </div>
                                        <input type="text" name="insufilasiText" class="form-control form-control-sm" placeholder="Detail insufilasi..." value="<?= $data->rm11b2StatusAnestesi['insufilasiText'] ?? '' ?>">
                                    </div>

                                    <div class="border border-info rounded p-1 mb-2">
                                        <!-- 2. Sedatif -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatInduksi[]" id="sedatif" value="Sedatif" <?= in_array("Sedatif", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="sedatif">Sedatif</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="sedatifDetail[]" id="sedMidazolam" value="Midazolam, Dosis 0,1-0,4 mg/KgBB, IV" <?= in_array("Midazolam, Dosis 0,1-0,4 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="sedMidazolam">1. Midazolam, Dosis 0,1-0,4 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="sedatifDetail[]" id="sedPropofol" value="Propofol, Dosis 1-2,5 mg/KgBB, IV" <?= in_array("Propofol, Dosis 1-2,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="sedPropofol">2. Propofol, Dosis 1-2,5 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="sedatifDetail[]" id="sedKetamine" value="Ketamine, Dosis 1-2 mg/KgBB, IV" <?= in_array("Ketamine, Dosis 1-2 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="sedKetamine">3. Ketamine, Dosis 1-2 mg/KgBB, IV</label>
                                            </div>
                                            <!-- Lainnya Sedatif -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="sedatifLainnyaCheck" id="sedatifLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['sedatifLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="sedatifLainnyaCheck">4. Lainnya :</label>
                                                </div>
                                                <input type="text" name="sedatifLainnya" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['sedatifLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-1 mb-2">
                                        <!-- 3. Analgetik -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatInduksi[]" id="analgetik" value="Analgetik" <?= in_array("Analgetik", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="analgetik">Analgetik</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="analgetikDetail[]" id="anaMorphine" value="Morphine, Dosis 0,1-1 mg/KgBB, IV" <?= in_array("Morphine, Dosis 0,1-1 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="anaMorphine">1. Morphine, Dosis 0,1-1 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="analgetikDetail[]" id="anaPethidine" value="Pethidine, Dosis 2,5-5 mg/KgBB, IV" <?= in_array("Pethidine, Dosis 2,5-5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="anaPethidine">2. Pethidine, Dosis 2,5-5 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="analgetikDetail[]" id="anaFentanyl" value="Fentanyl, Dosis 2-150 mcg/KgBB, IV" <?= in_array("Fentanyl, Dosis 2-150 mcg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="anaFentanyl">3. Fentanyl, Dosis 2-150 mcg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="analgetikDetail[]" id="anaKetamine" value="Ketamine, Dosis 0,25-0,5 mg/KgBB, IV" <?= in_array("Ketamine, Dosis 0,25-0,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="anaKetamine">4. Ketamine, Dosis 0,25-0,5 mg/KgBB, IV</label>
                                            </div>
                                            <!-- Lainnya Analgetik -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="analgetikLainnyaCheck" id="analgetikLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['analgetikLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="analgetikLainnyaCheck">5. Lainnya :</label>
                                                </div>
                                                <input type="text" name="analgetikLainnya" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['analgetikLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-1 mb-2">
                                        <!-- 4. Pelumpuh Otot -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatInduksi[]" id="pelumpuhOtot" value="Pelumpuh otot" <?= in_array("Pelumpuh otot", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="pelumpuhOtot">Pelumpuh otot</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="pelumpuhDetail[]" id="pelAtracurium" value="Atracurium, Dosis 0,5 mg/KgBB, IV" <?= in_array("Atracurium, Dosis 0,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="pelAtracurium">1. Atracurium, Dosis 0,5 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="pelumpuhDetail[]" id="pelVericuronium" value="Vericuronium, Dosis 0,12 mg/KgBB, IV" <?= in_array("Vericuronium, Dosis 0,12 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="pelVericuronium">2. Vericuronium, Dosis 0,12 mg/KgBB, IV</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="pelumpuhDetail[]" id="pelRocuronium" value="Rocuronium, Dosis 0,6-1,2 mg/KgBB, IV" <?= in_array("Rocuronium, Dosis 0,6-1,2 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="pelRocuronium">3. Rocuronium, Dosis 0,6-1,2 mg/KgBB, IV</label>
                                            </div>
                                            <!-- Lainnya Pelumpuh Otot -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="pelumpuhLainnyaCheck" id="pelumpuhLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['pelumpuhLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="pelumpuhLainnyaCheck">4. Lainnya :</label>
                                                </div>
                                                <input type="text" name="pelumpuhLainnya" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['pelumpuhLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">


                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Obat Maintenance :</div>
                                <hr>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="border border-info rounded p-1 mb-2">

                                        <!-- 1. Inhalasi -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatMaintenance[]" id="inhalasi" value="Inhalasi" <?= (in_array("Inhalasi", (array)($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []))) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="inhalasi">Inhalasi :</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="inhalasiDetail[]" id="inhO2" value="O2" <?= (in_array("O2", (array)($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inhO2">1. O2</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="inhalasiDetail[]" id="inhIsofluran" value="Isofluran, 1 MAC = 1,2%" <?= (in_array("Isofluran, 1 MAC = 1,2%", (array)($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inhIsofluran">2. Isofluran, 1 MAC = 1,2%</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="inhalasiDetail[]" id="inhSevofluran" value="Sevofluran, 1 MAC = 2%" <?= (in_array("Sevofluran, 1 MAC = 2%", (array)($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inhSevofluran">3. Sevofluran, 1 MAC = 2%</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="inhalasiDetail[]" id="inhEnfluran" value="Enfluran, 1 MAC = 1,7%" <?= (in_array("Enfluran, 1 MAC = 1,7%", (array)($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inhEnfluran">4. Enfluran, 1 MAC = 1,7%</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="inhalasiDetail[]" id="inhDesflurane" value="Desflurane, 1 MAC = 6%" <?= (in_array("Desflurane, 1 MAC = 6%", (array)($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="inhDesflurane">5. Desflurane, 1 MAC = 6%</label>
                                            </div>
                                            <!-- Lainnya Inhalasi -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="inhalasiLainnyaCheck" id="inhalasiLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['inhalasiLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="inhalasiLainnyaCheck">6. Lainnya :</label>
                                                </div>
                                                <input type="text" name="inhalasiLainnya" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['inhalasiLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-1 mb-2">

                                        <!-- 2. Intravena -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatMaintenance[]" id="intravena" value="Intravena" <?= (in_array("Intravena", (array)($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []))) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="intravena">Intravena :</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivPropofol" value="Propofol, Dosis 1-2 mg/KgBB" <?= (in_array("Propofol, Dosis 1-2 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivPropofol">1. Propofol, Dosis 1-2 mg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivMorphine" value="Morphine, Dosis 0,1-2 mg/KgBB" <?= (in_array("Morphine, Dosis 0,1-2 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivMorphine">2. Morphine, Dosis 0,1-2 mg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivPethidine" value="Pethidine, Dosis 2,5-5 mg/KgBB" <?= (in_array("Pethidine, Dosis 2,5-5 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivPethidine">3. Pethidine, Dosis 2,5-5 mg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivFentanyl" value="Fentanyl, Dosis 2-150 mg/KgBB" <?= (in_array("Fentanyl, Dosis 2-150 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivFentanyl">4. Fentanyl, Dosis 2-150 mcg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivAtracurium" value="Atracurium, Dosis 0,1 mg/KgBB" <?= (in_array("Atracurium, Dosis 0,1 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivAtracurium">5. Atracurium, Dosis 0,1 mg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivVericuronium" value="Vericuronium, Dosis 0,01 mg/KgBB" <?= (in_array("Vericuronium, Dosis 0,01 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivVericuronium">6. Vericuronium, Dosis 0,01 mg/KgBB</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="intravenaDetail[]" id="ivRocuronium" value="Rocuronium, Dosis 0,15 mg/KgBB" <?= (in_array("Rocuronium, Dosis 0,15 mg/KgBB", (array)($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="ivRocuronium">7. Rocuronium, Dosis 0,15 mg/KgBB</label>
                                            </div>
                                            <!-- Lainnya Intravena -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="intravenaLainnyaCheck" id="intravenaLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['intravenaLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="intravenaLainnyaCheck">8.</label>
                                                </div>
                                                <input type="text" name="intravenaLainnyaNama" class="form-control form-control-sm" placeholder="Nama Obat..." value="<?= $data->rm11b2StatusAnestesi['intravenaLainnyaNama'] ?? '' ?>">
                                                <span class="text-nowrap">Dosis</span>
                                                <input type="text" name="intravenaLainnyaDosis" class="form-control form-control-sm" placeholder="Dosis..." value="<?= $data->rm11b2StatusAnestesi['intravenaLainnyaDosis'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 3. Regional Anestesi -->
                                    <div class="border border-info rounded p-1 mb-2">
                                        <div class="d-flex align-items-center gap-3 flex-wrap">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="obatMaintenance[]" id="regionalAnestesi" value="Regional Anestesi" <?= (in_array("Regional Anestesi", (array)($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1 text-nowrap" for="regionalAnestesi">Regional Anestesi :</label>
                                            </div>
                                            <div class="d-flex align-items-center gap-3 text-secondary small flex-grow-1 flex-wrap">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="regionalAnestesiTipe[]" id="raSab" value="SAB" <?= (in_array("SAB", (array)($data->rm11b2StatusAnestesi["regionalAnestesiTipe"] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="raSab">SAB</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="regionalAnestesiTipe[]" id="raEpidural" value="Epidural" <?= (in_array("Epidural", (array)($data->rm11b2StatusAnestesi["regionalAnestesiTipe"] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="raEpidural">Epidural</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="regionalAnestesiTipe[]" id="raPnb" value="PNB" <?= (in_array("PNB", (array)($data->rm11b2StatusAnestesi["regionalAnestesiTipe"] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label" for="raPnb">PNB</label>
                                                </div>
                                                <!-- Input Lainnya untuk Regional Anestesi -->
                                                <div class="d-flex align-items-center gap-2 flex-grow-1">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="checkbox" name="raLainnyaCheck" id="raLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['raLainnyaCheck'])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label text-nowrap" for="raLainnyaCheck">Lainnya :</label>
                                                    </div>
                                                    <input type="text" name="raLainnyaText" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['raLainnyaText'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 4. Anestesi Lokal -->
                                    <div class="border border-info rounded p-1 mb-2">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatMaintenance[]" id="anestesiLokal" value="Anestesi Lokal" <?= (in_array("Anestesi Lokal", (array)($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []))) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="anestesiLokal">Anestesi Lokal :</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="anestesiLokalDetail[]" id="alLidocaine" value="Lidocaine, Dosis maks. 4,5mg/KgBB (7mg/KgBB dgn epinephrine)" <?= (in_array("Lidocaine, Dosis maks. 4,5mg/KgBB (7mg/KgBB dgn epinephrine)", (array)($data->rm11b2StatusAnestesi["anestesiLokalDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="alLidocaine">1. Lidocaine, Dosis maks. 4,5mg/KgBB (7mg/KgBB dgn epinephrine)</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="anestesiLokalDetail[]" id="alBupivacaine" value="Bupivacaine, Dosis maks. 2,5mg/KgBB (3mg/KgBB dgn epinephrine)" <?= (in_array("Bupivacaine, Dosis maks. 2,5mg/KgBB (3mg/KgBB dgn epinephrine)", (array)($data->rm11b2StatusAnestesi["anestesiLokalDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="alBupivacaine">2. Bupivacaine, Dosis maks. 2,5mg/KgBB (3mg/KgBB dgn epinephrine)</label>
                                            </div>
                                            <div class="form-check mb-1">
                                                <input class="form-check-input" type="checkbox" name="anestesiLokalDetail[]" id="alRopivacaine" value="Ropivacaine, Dosis maks. 3mg/KgBB" <?= (in_array("Ropivacaine, Dosis maks. 3mg/KgBB", (array)($data->rm11b2StatusAnestesi["anestesiLokalDetail"] ?? []))) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="alRopivacaine">3. Ropivacaine, Dosis maks. 3mg/KgBB</label>
                                            </div>
                                            <!-- Lainnya Anestesi Lokal -->
                                            <div class="d-flex align-items-center gap-2 mt-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="anestesiLokalLainnyaCheck" id="anestesiLokalLainnyaCheck" value="1" <?= (!empty($data->rm11b2StatusAnestesi['anestesiLokalLainnyaCheck'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="anestesiLokalLainnyaCheck">4. Lainnya :</label>
                                                </div>
                                                <input type="text" name="anestesiLokalLainnya" class="form-control form-control-sm" placeholder="Keterangan..." value="<?= $data->rm11b2StatusAnestesi['anestesiLokalLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- 5. Additif -->
                                    <div class="border border-info rounded p-1 mb-2">
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="obatMaintenance[]" id="additif" value="Additif" <?= (in_array("Additif", (array)($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []))) ? 'checked' : '' ?>>
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1" for="additif">Additif :</label>
                                        </div>
                                        <div class="ms-4 text-secondary small">
                                            <!-- Additif 1 -->
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="additif1Check" id="additif1Check" value="1" <?= (!empty($data->rm11b2StatusAnestesi['additif1Check'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="additif1Check">1.</label>
                                                </div>
                                                <input type="text" name="additif1Nama" class="form-control form-control-sm" placeholder="Nama Additif..." value="<?= $data->rm11b2StatusAnestesi['additif1Nama'] ?? '' ?>">
                                                <span class="text-nowrap">Dosis</span>
                                                <input type="text" name="additif1Dosis" class="form-control form-control-sm" placeholder="Dosis..." value="<?= $data->rm11b2StatusAnestesi['additif1Dosis'] ?? '' ?>">
                                            </div>
                                            <!-- Additif 2 -->
                                            <div class="d-flex align-items-center gap-2 mb-1">
                                                <div class="form-check mb-0">
                                                    <input class="form-check-input" type="checkbox" name="additif2Check" id="additif2Check" value="1" <?= (!empty($data->rm11b2StatusAnestesi['additif2Check'])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label text-nowrap" for="additif2Check">2.</label>
                                                </div>
                                                <input type="text" name="additif2Nama" class="form-control form-control-sm" placeholder="Nama Additif..." value="<?= $data->rm11b2StatusAnestesi['additif2Nama'] ?? '' ?>">
                                                <span class="text-nowrap">Dosis</span>
                                                <input type="text" name="additif2Dosis" class="form-control form-control-sm" placeholder="Dosis..." value="<?= $data->rm11b2StatusAnestesi['additif2Dosis'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Catatan :</label>
                                    <textarea name="catatanII" class="form-control" rows="2" id="catatanII"><?= $data->rm11b2StatusAnestesi['catatanII'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <!-- 1. disusun Oleh -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Diperiksa Oleh :</label>
                                        <select name="dokterII" id="dokterII" class="form-select form-select-sm">
                                            <option value="" <?= (empty($data->rm11b2StatusAnestesi['dokterII'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                $selected = (($data->rm11b2StatusAnestesi['dokterII'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- 2. Tanggal / Jam -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tanggal / Jam :</label>
                                        <input type="datetime-local" id="tanggalJamII" name="tanggalJamII" class="form-control form-control-sm mt-1" value="<?= isset($data->rm11b2StatusAnestesi['tanggalJamII']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2StatusAnestesi['tanggalJamII'])) : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="iiiasessement" role="tabpanel" aria-labelledby="iiiasessement-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Kendala :</div>
                                <hr>
                            </div>
                            <div class="row g-3 text-secondary small">
                                <!-- 1. Masalah Saat Induksi -->
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3 flex-wrap">
                                        <label class="fw-bold text-nowrap mb-0">Masalah Saat Induksi :</label>

                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="masalahInduksiStatus" id="masalahInduksiTidakAda" value="Tidak ada" <?= (($data->rm11b2StatusAnestesi['masalahInduksiStatus'] ?? '') == 'Tidak ada') ? 'checked' : '' ?>>
                                            <label class="form-check-label text-nowrap" for="masalahInduksiTidakAda">Tidak ada</label>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="masalahInduksiStatus" id="masalahInduksiAda" value="Ada" <?= (($data->rm11b2StatusAnestesi['masalahInduksiStatus'] ?? '') == 'Ada') ? 'checked' : '' ?>>
                                                <label class="form-check-label text-nowrap" for="masalahInduksiAda">Ada :</label>
                                            </div>
                                            <input type="text" name="masalahInduksiText" id="masalahInduksiText" class="form-control form-control-sm" placeholder="Sebutkan masalah..." value="<?= $data->rm11b2StatusAnestesi['masalahInduksiText'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. Perubahan Rencana Anestesi -->
                                <div class="col-12">
                                    <div class="d-flex align-items-center gap-3 flex-wrap">
                                        <label class="fw-bold text-nowrap mb-0">Perubahan Rencana Anestesi :</label>

                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="perubahanRencanaStatus" id="perubahanRencanaTidakAda" value="Tidak ada" <?= (($data->rm11b2StatusAnestesi['perubahanRencanaStatus'] ?? '') == 'Tidak ada') ? 'checked' : '' ?>>
                                            <label class="form-check-label text-nowrap" for="perubahanRencanaTidakAda">Tidak ada</label>
                                        </div>

                                        <div class="d-flex align-items-center gap-2 flex-grow-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="perubahanRencanaStatus" id="perubahanRencanaAda" value="Ada" <?= (($data->rm11b2StatusAnestesi['perubahanRencanaStatus'] ?? '') == 'Ada') ? 'checked' : '' ?>>
                                                <label class="form-check-label text-nowrap" for="perubahanRencanaAda">Ada :</label>
                                            </div>
                                            <input type="text" name="perubahanRencanaText" id="perubahanRencanaText" class="form-control form-control-sm" placeholder="Sebutkan perubahan..." value="<?= $data->rm11b2StatusAnestesi['perubahanRencanaText'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Vital Sign :</div>
                                <hr>
                            </div>
                            <div class="row g-2 align-items-center">
                                <!-- TD (Tekanan Darah) -->
                                <div class="col-md-auto col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">TD</span>
                                        <input type="text" name="tdIII" id="tdIII" class="form-control" placeholder="..." value="<?= $data->rm11b2StatusAnestesi['tdIII'] ?? '' ?>">
                                        <span class="input-group-text">mmHg</span>
                                    </div>
                                </div>

                                <!-- HR (Heart Rate) -->
                                <div class="col-md-auto col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">HR</span>
                                        <input type="text" name="hrIII" id="hrIII" class="form-control" placeholder="..." value="<?= $data->rm11b2StatusAnestesi['hrIII'] ?? '' ?>">
                                        <span class="input-group-text">x/mnt</span>
                                    </div>
                                </div>

                                <!-- RR (Respiratory Rate) -->
                                <div class="col-md-auto col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">RR</span>
                                        <input type="text" name="rrIII" id="rrIII" class="form-control" placeholder="..." value="<?= $data->rm11b2StatusAnestesi['rrIII'] ?? '' ?>">
                                        <span class="input-group-text">x/mnt</span>
                                    </div>
                                </div>

                                <!-- T (Suhu) -->
                                <div class="col-md-auto col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text">T</span>
                                        <input type="text" name="tIII" id="tIII" class="form-control" placeholder="..." value="<?= $data->rm11b2StatusAnestesi['tIII'] ?? '' ?>">
                                        <span class="input-group-text">°C</span>
                                    </div>
                                </div>

                                <!-- SPO2 -->
                                <div class="col-md-auto col-6">
                                    <div class="input-group input-group-sm">
                                        <span class="input-group-text ">SPO<sub>2</sub></span>
                                        <input type="text" name="spo2III" id="spo2III" class="form-control" placeholder="..." value="<?= $data->rm11b2StatusAnestesi['spo2III'] ?? '' ?>">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Makan minum :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Makan terakhir :</label>
                                    <input type="datetime-local" class="form-control" id="makanTerakhir" name="makanTerakhir" value="<?= !empty($data->rm11b2StatusAnestesi['makanTerakhir']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2StatusAnestesi['makanTerakhir'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Minum terakhir :</label>
                                    <input type="datetime-local" class="form-control" id="minumTerakhir" name="minumTerakhir" value="<?= !empty($data->rm11b2StatusAnestesi['minumTerakhir']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2StatusAnestesi['minumTerakhir'])) : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Petugas dan premedikasi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- 1. disusun Oleh -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Diperiksa Oleh :</label>
                                        <select name="dokterIII" id="dokterIII" class="form-select form-select-sm">
                                            <option value="" <?= (empty($data->rm11b2StatusAnestesi['dokterIII'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                $selected = (($data->rm11b2StatusAnestesi['dokterIII'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Agen :</label>
                                    <textarea name="agen" class="form-control" rows="2" id="agen"><?= $data->rm11b2StatusAnestesi['agen'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <!-- 1. disusun Oleh -->
                                    <div class="mb-2">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Diberikan Oleh :</label>
                                        <select name="diberikanOleh" id="diberikanOleh" class="form-select form-select-sm">
                                            <option value="" <?= (empty($data->rm11b2StatusAnestesi['diberikanOleh'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                                $selected = (($data->rm11b2StatusAnestesi['diberikanOleh'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                            } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- 2. Tanggal / Jam -->
                                    <div class="mb-0">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tanggal / Jam :</label>
                                        <input type="datetime-local" id="tanggalJamIII" name="tanggalJamIII" class="form-control form-control-sm mt-1" value="<?= isset($data->rm11b2StatusAnestesi['tanggalJamIII']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2StatusAnestesi['tanggalJamIII'])) : '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="ivDaftar" role="tabpanel" aria-labelledby="ivDaftar-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Persiapan :</div>
                                <hr>
                            </div>

                            <?php
                            // Parse JSON persiapan jika berupa string, jika tidak jadikan array
                            $persiapanData = $data->rm11b2StatusAnestesi["persiapan"] ?? [];
                            if (is_string($persiapanData)) {
                                $persiapanData = json_decode($persiapanData, true) ?? [];
                            }
                            ?>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 text-secondary small">
                                <!-- Identifikasi pasien -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanIdentifikasiPasien" value="Identifikasi pasien" <?= (in_array("Identifikasi pasien", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanIdentifikasiPasien">Identifikasi pasien</label>
                                </div>

                                <!-- Ijin Operasi -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanIjinOperasi" value="Ijin Operasi" <?= (in_array("Ijin Operasi", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanIjinOperasi">Ijin Operasi</label>
                                </div>

                                <!-- Puasa dijalankan dengan baik -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanPuasa" value="Puasa dijalankan dengan baik" <?= (in_array("Puasa dijalankan dengan baik", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanPuasa">Puasa dijalankan dengan baik</label>
                                </div>

                                <!-- Mesin Anestesi -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanMesinAnestesi" value="Mesin Anestesi" <?= (in_array("Mesin Anestesi", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanMesinAnestesi">Mesin Anestesi</label>
                                </div>

                                <!-- Suction -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanSuction" value="Suction" <?= (in_array("Suction", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanSuction">Suction</label>
                                </div>

                                <!-- Obat-obatan -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanObatObatan" value="Obat-obatan" <?= (in_array("Obat-obatan", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanObatObatan">Obat-obatan</label>
                                </div>

                                <!-- Antibiotik profilaksis -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanAntibiotikProfilaksis" value="Antibiotik profilaksis" <?= (in_array("Antibiotik profilaksis", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanAntibiotikProfilaksis">Antibiotik profilaksis</label>
                                </div>

                                <!-- Pulse Oxymeter -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanPulseOxymeter" value="Pulse Oxymeter" <?= (in_array("Pulse Oxymeter", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanPulseOxymeter">Pulse Oxymeter</label>
                                </div>

                                <!-- EKG -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanEkg" value="EKG" <?= (in_array("EKG", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanEkg">EKG</label>
                                </div>

                                <!-- Sabuk Pengaman -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanSabukPengaman" value="Sabuk Pengaman" <?= (in_array("Sabuk Pengaman", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanSabukPengaman">Sabuk Pengaman</label>
                                </div>

                                <!-- NIBP -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanNibp" value="NIBP" <?= (in_array("NIBP", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanNibp">NIBP</label>
                                </div>

                                <!-- Urine Kateter -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanUrineKateter" value="Urine Kateter" <?= (in_array("Urine Kateter", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanUrineKateter">Urine Kateter</label>
                                </div>

                                <!-- End Tydal CO2 -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="persiapan[]" id="persiapanEndTydalCo2" value="End Tydal CO2" <?= (in_array("End Tydal CO2", (array)$persiapanData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="persiapanEndTydalCo2">End Tydal CO<sub>2</sub></label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Pasca induksi :</div>
                                <hr>
                            </div>

                            <?php
                            // Decode JSON jika tipe datanya berupa string JSON
                            $pascaInduksiData = $data->rm11b2StatusAnestesi["pascaInduksi"] ?? [];
                            if (is_string($pascaInduksiData)) {
                                $pascaInduksiData = json_decode($pascaInduksiData, true) ?? [];
                            }
                            ?>

                            <div class="d-flex flex-wrap justify-content-center align-items-center gap-3 text-secondary small">
                                <!-- Titik-titik tekanan diperiksa dan diberi bantalan -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pascaInduksi[]" id="pascaInduksiTitikTekanan" value="Titik-titik tekanan diperiksa dan diberi bantalan" <?= (in_array("Titik-titik tekanan diperiksa dan diberi bantalan", (array)$pascaInduksiData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="pascaInduksiTitikTekanan">Titik-titik tekanan diperiksa dan diberi bantalan</label>
                                </div>

                                <!-- Mata terlindungi -->
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="pascaInduksi[]" id="pascaInduksiMataTerlindungi" value="Mata terlindungi" <?= (in_array("Mata terlindungi", (array)$pascaInduksiData)) ? 'checked' : '' ?>>
                                    <label class="form-check-label text-nowrap" for="pascaInduksiMataTerlindungi">Mata terlindungi</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="vTata" role="tabpanel" aria-labelledby="vTata-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Teknik :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Teknik Intubasi :</label>
                                    <textarea class="form-control" id="teknikIntubasi" name="teknikIntubasi"><?= $data->rm11b2StatusAnestesi['teknikIntubasi'] ?? '' ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Teknik Induksi :</label>
                                    <textarea class="form-control" id="teknikInduksi" name="teknikInduksi"><?= $data->rm11b2StatusAnestesi['teknikInduksi'] ?? '' ?></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Lokasi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lokasi infus/tipe kanula :</label>
                                    <textarea class="form-control" id="lokasiInfus" name="lokasiInfus"><?= $data->rm11b2StatusAnestesi['lokasiInfus'] ?? '' ?></textarea>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tempat CVC :</label>
                                    <input type="text" class="form-control" id="tempatCvc" name="tempatCvc" value="<?= $data->rm11b2StatusAnestesi['tempatCvc'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tempat Arterial / tipe kanula :</label>
                                    <input type="text" class="form-control" id="tempatArterial" name="tempatArterial" value="<?= $data->rm11b2StatusAnestesi['tempatArterial'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kateter Arteri Pulmonal :</label>
                                    <input type="text" class="form-control" id="kateterArteri" name="kateterArteri" value="<?= $data->rm11b2StatusAnestesi['kateterArteri'] ?? '' ?>">
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="col-md-6">


                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-12 text-center">Anestesi :</div>
                                <hr>
                            </div>

                            <?php
                            // Parse JSON posisi jika berupa string, jika tidak jadikan array
                            $posisiData = $data->rm11b2StatusAnestesi["posisi"] ?? [];
                            if (is_string($posisiData)) {
                                $posisiData = json_decode($posisiData, true) ?? [];
                            }
                            ?>

                            <div class="border border-info rounded p-1 mb-2">
                                <div class="d-flex align-items-center gap-1 flex-wrap text-secondary small">

                                    <label class="fw-bold text-nowrap mb-0">Posisi :</label>

                                    <!-- Supine -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="posisi[]" id="posisiSupine" value="Supine" <?= (in_array("Supine", (array)$posisiData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap" for="posisiSupine">Supine</label>
                                    </div>

                                    <!-- Prone -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="posisi[]" id="posisiProne" value="Prone" <?= (in_array("Prone", (array)$posisiData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap" for="posisiProne">Prone</label>
                                    </div>

                                    <!-- Trendelenburg -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="posisi[]" id="posisiTrendelenburg" value="Trendelenburg" <?= (in_array("Trendelenburg", (array)$posisiData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap" for="posisiTrendelenburg">Trendelenburg</label>
                                    </div>

                                    <!-- Lithotomy -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="posisi[]" id="posisiLithotomy" value="Lithotomy" <?= (in_array("Lithotomy", (array)$posisiData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap" for="posisiLithotomy">Lithotomy</label>
                                    </div>

                                    <!-- Lateral -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="posisi[]" id="posisiLateral" value="Lateral" <?= (in_array("Lateral", (array)$posisiData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap" for="posisiLateral">Lateral</label>
                                    </div>

                                    <!-- Input Lainnya -->
                                    <div class="d-flex align-items-center gap-1">
                                        <label for="posisiLainnya" class="text-nowrap mb-0">Lainnya :</label>
                                        <input type="text" name="posisiLainnya" id="posisiLainnya" class="form-control form-control-sm" style="width: 150px;" placeholder="Sebutkan..." value="<?= htmlspecialchars($data->rm11b2StatusAnestesi['posisiLainnya'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Airway Laringoskopi derajat 1-4 :</label>
                            <input type="text" class="form-control" id="airway" name="airway" value="<?= $data->rm11b2StatusAnestesi['airway'] ?? '' ?>">


                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row">
                                <div class="col-12 text-center">Jalan nafas :</div>
                                <hr>
                            </div>

                            <div class="row g-2 text-secondary small">
                                <!-- Baris 1: LMA -->
                                <div class="col-12 d-flex align-items-center gap-2 flex-wrap">
                                    <label class="fw-bold text-nowrap mb-0" style="min-width: 70px;">LMA no</label>
                                    <input type="text" name="lmaNo" class="form-control form-control-sm" style="width: 100px;" value="<?= $data->rm11b2StatusAnestesi['lmaNo'] ?? '' ?>">

                                    <label class="fw-bold text-nowrap mb-0 ms-2">Cuff :</label>
                                    <div class="input-group input-group-sm" style="width: 130px;">
                                        <input type="text" name="lmaCuff" class="form-control" value="<?= $data->rm11b2StatusAnestesi['lmaCuff'] ?? '' ?>">
                                        <span class="input-group-text">ml</span>
                                    </div>
                                </div>

                                <!-- Baris 2: ETT & Oral / Nasal -->
                                <div class="col-12 d-flex align-items-center gap-2 flex-wrap">
                                    <label class="fw-bold text-nowrap mb-0" style="min-width: 70px;">ETT</label>
                                    <input type="text" name="ettText" class="form-control form-control-sm" style="width: 150px;" value="<?= $data->rm11b2StatusAnestesi['ettText'] ?? '' ?>">

                                    <div class="d-flex align-items-center gap-2 ms-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="ettJalur" id="ettOral" value="Oral" <?= (($data->rm11b2StatusAnestesi['ettJalur'] ?? '') == 'Oral') ? 'checked' : '' ?>>
                                            <label class="form-check-label text-nowrap" for="ettOral">Oral</label>
                                        </div>
                                        <span>/</span>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="ettJalur" id="ettNasal" value="Nasal" <?= (($data->rm11b2StatusAnestesi['ettJalur'] ?? '') == 'Nasal') ? 'checked' : '' ?>>
                                            <label class="form-check-label text-nowrap" for="ettNasal">Nasal</label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3: No. & Cuff -->
                                <div class="col-12 d-flex align-items-center gap-2 flex-wrap">
                                    <label class="fw-bold text-nowrap mb-0" style="min-width: 70px;">No.</label>
                                    <input type="text" name="ettNo" class="form-control form-control-sm" style="width: 100px;" value="<?= $data->rm11b2StatusAnestesi['ettNo'] ?? '' ?>">

                                    <label class="fw-bold text-nowrap mb-0 ms-2">Cuff :</label>
                                    <div class="input-group input-group-sm" style="width: 130px;">
                                        <input type="text" name="ettCuff" class="form-control" value="<?= $data->rm11b2StatusAnestesi['ettCuff'] ?? '' ?>">
                                        <span class="input-group-text">ml</span>
                                    </div>
                                </div>

                                <!-- Baris 4: Checkbox NGT & Tampon -->
                                <?php
                                // Parse JSON peralatanLain jika berupa string, jika tidak jadikan array
                                $peralatanLainData = $data->rm11b2StatusAnestesi['peralatanLain'] ?? [];
                                if (is_string($peralatanLainData)) {
                                    $peralatanLainData = json_decode($peralatanLainData, true) ?? [];
                                }
                                ?>

                                <div class="col-12 d-flex align-items-center gap-4 mt-2">
                                    <!-- NGT -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="peralatanLain[]" id="ngt" value="NGT" <?= (in_array("NGT", (array)$peralatanLainData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap fw-bold" for="ngt">NGT</label>
                                    </div>

                                    <!-- Tampon -->
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" name="peralatanLain[]" id="tampon" value="Tampon" <?= (in_array("Tampon", (array)$peralatanLainData)) ? 'checked' : '' ?>>
                                        <label class="form-check-label text-nowrap fw-bold" for="tampon">Tampon</label>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>