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

    .tabelKecil tr,
    .tabelKecil th,
    .tabelKecil td {
        padding: 0.2px !important;
    }

    .tabelKecil tbody tr:hover td {
        background-color: #e2e8f0 !important;
        /* Ganti dengan warna yang diinginkan */
    }

    #aldreteTable,
    #aldreteTable th,
    #aldreteTable td {
        border-color: #bdbdbd !important;
        border-width: 0.5px !important;
        /* Atur ketebalan sesuai selera (misal: 1px atau 2px) */
    }

    /* Menghilangkan semua garis vertikal, dan hanya menyisakan garis horizontal antar baris */
    #bromageTable,
    #bromageTable th,
    #bromageTable td {
        border-top: 1px solid #bdbdbd !important;
        /* Warna hitam dan ketebalan garis baris */
        border-bottom: 1px solid #bdbdbd !important;
        border-left: none !important;
        border-right: none !important;
    }
</style>
<form>

    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-intra-tab" data-bs-toggle="tab" data-bs-target="#nav-intra" type="button" role="tab" aria-controls="nav-intra" aria-selected="true">Intra Anestesi</button>
            <button class="nav-link" id="nav-pasca-tab" data-bs-toggle="tab" data-bs-target="#nav-pasca" type="button" role="tab" aria-controls="nav-pasca" aria-selected="false">Pasca Anestesi</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-intra" role="tabpanel" aria-labelledby="nav-intra-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Data Pra Anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Obat-obatan :</label>
                                    <textarea class="form-control" name="obatObatan" id="obatObatan"><?= $data->rm11b2MonitoringAnestesi['obatObatan'] ?? 'REGIVEL
RANITIDINE 
METOCLOPRAMID
TRANXA 
METAMIZOLE ' ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Vertilasi :</label>
                                    <div class="d-flex flex-wrap gap-3 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ventilasi" id="ventilasi_circuit" value="Circuit" <?= ($data->rm11b2MonitoringAnestesi['ventilasi'] ?? '') === 'Circuit' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="ventilasi_circuit">Circuit</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ventilasi" id="ventilasi_spontan" value="Spontan" <?= ($data->rm11b2MonitoringAnestesi['ventilasi'] ?? '') === 'Spontan' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="ventilasi_spontan">Spontan</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ventilasi" id="ventilasi_assisted" value="Assisted/SIMV" <?= ($data->rm11b2MonitoringAnestesi['ventilasi'] ?? '') === 'Assisted/SIMV' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="ventilasi_assisted">Assisted/SIMV</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ventilasi" id="ventilasi_cmv" value="CMV" <?= ($data->rm11b2MonitoringAnestesi['ventilasi'] ?? '') === 'CMV' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="ventilasi_cmv">CMV</label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="ventilasi" id="ventilasi_pcv" value="PCV" <?= ($data->rm11b2MonitoringAnestesi['ventilasi'] ?? '') === 'PCV' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="ventilasi_pcv">PCV</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">TV :</label>
                                    <input type="text" id="tv" name="tv" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['tv']) ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Rate :</label>
                                    <input type="text" id="rate" name="rate" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['rate']) ?? '' ?>">
                                </div>
                                <div class="col-md-12 mb-2">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">PEEP :</label>
                                    <input type="text" id="peep" name="peep" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['peep']) ?? '' ?>">
                                </div>
                                <?php
                                // Pastikan gasFlow di-decode dari JSON string menjadi array PHP dengan aman
                                $gasFlowChecked = $data->rm11b2MonitoringAnestesi['gasFlow'] ?? [];
                                if (is_string($gasFlowChecked)) {
                                    $gasFlowChecked = json_decode($gasFlowChecked, true) ?? [];
                                }
                                ?>

                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Gas Flow :</label>
                                    <div class="d-flex flex-column gap-1">

                                        <!-- N2O -->
                                        <div class="d-flex align-items-center justify-content-between gap-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" name="gasFlow[]" value="N2O" id="check_n2o" <?= in_array('N2O', $gasFlowChecked) ? 'checked' : '' ?>>
                                                <label class="form-check-label text-nowrap" for="check_n2o">N₂O : </label>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" name="n2o_value" value="<?= $data->rm11b2MonitoringAnestesi['n2o_value'] ?? '' ?>" placeholder="Nilai">
                                                <span class="input-group-text">Lpm</span>
                                            </div>
                                        </div>

                                        <!-- O2 -->
                                        <div class="d-flex align-items-center justify-content-between gap-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" name="gasFlow[]" value="O2" id="check_o2" <?= in_array('O2', $gasFlowChecked) ? 'checked' : '' ?>>
                                                <label class="form-check-label text-nowrap" for="check_o2">O₂ : </label>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" name="o2_value" value="<?= $data->rm11b2MonitoringAnestesi['o2_value'] ?? '' ?>" placeholder="Nilai">
                                                <span class="input-group-text">Lpm</span>
                                            </div>
                                        </div>

                                        <!-- Air (Tanpa Input Text) -->
                                        <div class="d-flex align-items-center justify-content-between gap-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" name="gasFlow[]" value="Air" id="check_air" <?= in_array('Air', $gasFlowChecked) ? 'checked' : '' ?>>
                                                <label class="form-check-label" for="check_air">Air</label>
                                            </div>
                                            <div class="w-50"></div>
                                        </div>

                                        <!-- Gas Inhalasi -->
                                        <div class="d-flex align-items-center justify-content-between gap-1">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="checkbox" name="gasFlow[]" value="Gas Inhalasi" id="check_inhalasi" <?= in_array('Gas Inhalasi', $gasFlowChecked) ? 'checked' : '' ?>>
                                                <label class="form-check-label text-nowrap" for="check_inhalasi">Gas Inhalasi : </label>
                                            </div>
                                            <div class="input-group input-group-sm">
                                                <input type="text" class="form-control form-control-sm" name="inhalasi_value" value="<?= $data->rm11b2MonitoringAnestesi['inhalasi_value'] ?? '' ?>" placeholder="Keterangan...">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Data Operasi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu masuk OK :</label>
                                    <input type="datetime-local" id="waktuMasukOk" name="waktuMasukOk" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuMasukOk']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuMasukOk'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu pembiusan :</label>
                                    <input type="datetime-local" id="waktuPembiusan" name="waktuPembiusan" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuPembiusan']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuPembiusan'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu Insisi :</label>
                                    <input type="datetime-local" id="waktuInsisi" name="waktuInsisi" class="form-control form-control-sm" style="border: 2px solid #dc3545 !important;" value="<?= isset($data->rm11b2MonitoringAnestesi['waktuInsisi']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuInsisi'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu selesai Operasi :</label>
                                    <input type="datetime-local" id="waktuSelesaiOp" name="waktuSelesaiOp" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuSelesaiOp']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuSelesaiOp'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu selesai Anestesi :</label>
                                    <input type="datetime-local" id="waktuSelesaiAnestesi" name="waktuSelesaiAnestesi" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuSelesaiAnestesi']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuSelesaiAnestesi'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu keluar OK :</label>
                                    <input type="datetime-local" id="waktuKeluarOk" name="waktuKeluarOk" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuKeluarOk']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuKeluarOk'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu bayi lahir :</label>
                                    <input type="datetime-local" id="waktuBayiLahir" name="waktuBayiLahir" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['waktuBayiLahir']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuBayiLahir'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Apgar Score :</label>
                                    <input type="text" id="apgarScore" name="apgarScore" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['apgarScore']) ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">BB :</label>
                                    <input type="text" id="bb" name="bb" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['bb']) ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">TB :</label>
                                    <input type="text" id="tb" name="tb" class="form-control form-control-sm " value="<?= isset($data->rm11b2MonitoringAnestesi['tb']) ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Anestesi Regional / Blok saraf perifer :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Teknik :</label>
                                    <textarea class="form-control" name="teknik" id="teknik"><?= $data->rm11b2MonitoringAnestesi['teknik'] ?? 'SAB' ?></textarea>
                                </div>

                                <!-- Anestesi Lokal Obat -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Anestesi Lokal Obat :</label>
                                    <input type="text" class="form-control form-control-sm" name="anestesi_lokal_obat" id="anestesi_lokal_obat" value="<?= $data->rm11b2MonitoringAnestesi['anestesi_lokal_obat'] ?? 'BUPIVACAINE + FENTANYL' ?>">
                                </div>

                                <!-- Tipe -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tipe :</label>
                                    <input type="text" class="form-control form-control-sm" name="tipe" id="tipe" value="<?= $data->rm11b2MonitoringAnestesi['tipe'] ?? 'HYPERBARIC' ?>">
                                </div>

                                <!-- Jumlah Volume -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Jumlah Volume :</label>
                                    <input type="text" class="form-control form-control-sm" name="jumlah_volume" id="jumlah_volume" value="<?= $data->rm11b2MonitoringAnestesi['jumlah_volume'] ?? '2.5ml' ?>">
                                </div>

                                <!-- Masalah/Keterangan (Menggunakan Textarea) -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Masalah/Keterangan :</label>
                                    <textarea class="form-control form-control-sm mt-1" name="masalah_keterangan" id="masalah_keterangan" rows="2"><?= $data->rm11b2MonitoringAnestesi['masalah_keterangan'] ?? 'DBN' ?></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">

                        <!-- Cairan masuk dan keluar Intra anestesi -->

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Cairan masuk pra-anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="border border-info p-1 rounded">
                                        <label class="form-label fw-bold small text-secondary mb-2 ms-1">Darah :</label>

                                        <!-- WB -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">WB :</span>
                                            <input type="text" class="form-control form-control-sm" name="wbPra" id="wbPra" value="<?= $data->rm11b2MonitoringAnestesi['wbPra'] ?? '' ?>">
                                        </div>

                                        <!-- FFP -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">FFP :</span>
                                            <input type="text" class="form-control form-control-sm" name="ffpPra" id="ffpPra" value="<?= $data->rm11b2MonitoringAnestesi['ffpPra'] ?? '' ?>">
                                        </div>

                                        <!-- PRC -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">PRC :</span>
                                            <input type="text" class="form-control form-control-sm" name="prcPra" id="prcPra" value="<?= $data->rm11b2MonitoringAnestesi['prcPra'] ?? '' ?>">
                                        </div>

                                        <!-- TC -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">TC :</span>
                                            <input type="text" class="form-control form-control-sm" name="tcPra" id="tcPra" value="<?= $data->rm11b2MonitoringAnestesi['tcPra'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kristaloid :</label>
                                            <textarea class="form-control" name="kristaloidPra" id="kristaloidPra"><?= $data->rm11b2MonitoringAnestesi['kristaloidPra'] ?? 'RL 500ML' ?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kolloid :</label>
                                            <textarea class="form-control" name="kolloidPra" id="kolloidPra"><?= $data->rm11b2MonitoringAnestesi['kolloidPra'] ?? '' ?></textarea>
                                        </div>


                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Lain-lain :</label>
                                            <textarea class="form-control" name="cairanLainPra" id="cairanLainPra"><?= $data->rm11b2MonitoringAnestesi['cairanLainPra'] ?? '' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Cairan keluar pra-anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Urin -->
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Urin :</label>
                                    <input type="text" class="form-control form-control-sm" name="urinPra" id="urinPra" value="<?= $data->rm11b2MonitoringAnestesi['urinPra'] ?? '100ML' ?>">
                                </div>
                                <div class="col-md-6">

                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">S & I:</label>
                                    <input type="text" class="form-control form-control-sm" name="s_iPra" id="s_iPra" value="<?= $data->rm11b2MonitoringAnestesi['s_iPra'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Darah :</label>
                                    <input type="text" class="form-control form-control-sm" name="darahPra" id="darahPra" value="<?= $data->rm11b2MonitoringAnestesi['darahPra'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">EBV :</label>
                                    <input type="text" class="form-control form-control-sm" name="ebvPra" id="ebvPra" value="<?= $data->rm11b2MonitoringAnestesi['ebvPra'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <!-- end of cairan  masuk dan keluar intra anestesi -->
                        <!-- Cairan masuk dan keluar Intra anestesi -->

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Cairan masuk intra anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="border border-info p-1 rounded">
                                        <label class="form-label fw-bold small text-secondary mb-2 ms-1">Darah :</label>

                                        <!-- WB -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">WB :</span>
                                            <input type="text" class="form-control form-control-sm" name="wbIntra" id="wbIntra" value="<?= $data->rm11b2MonitoringAnestesi['wbIntra'] ?? '' ?>">
                                        </div>

                                        <!-- FFP -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">FFP :</span>
                                            <input type="text" class="form-control form-control-sm" name="ffpIntra" id="ffpIntra" value="<?= $data->rm11b2MonitoringAnestesi['ffpIntra'] ?? '' ?>">
                                        </div>

                                        <!-- PRC -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">PRC :</span>
                                            <input type="text" class="form-control form-control-sm" name="prcIntra" id="prcIntra" value="<?= $data->rm11b2MonitoringAnestesi['prcIntra'] ?? '' ?>">
                                        </div>

                                        <!-- TC -->
                                        <div class="input-group input-group-sm mb-2">
                                            <span class="input-group-text bg-transparent border-0 pe-1" style="min-width: 50px;">TC :</span>
                                            <input type="text" class="form-control form-control-sm" name="tcIntra" id="tcIntra" value="<?= $data->rm11b2MonitoringAnestesi['tcIntra'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kristaloid :</label>
                                            <textarea class="form-control" name="kristaloidIntra" id="kristaloidIntra"><?= $data->rm11b2MonitoringAnestesi['kristaloidIntra'] ?? 'RL 500ML' ?></textarea>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kolloid :</label>
                                            <textarea class="form-control" name="kolloidIntra" id="kolloidIntra"><?= $data->rm11b2MonitoringAnestesi['kolloidIntra'] ?? '' ?></textarea>
                                        </div>


                                        <div class="col-md-12">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">Lain-lain :</label>
                                            <textarea class="form-control" name="cairanLainIntra" id="cairanLainIntra"><?= $data->rm11b2MonitoringAnestesi['cairanLainIntra'] ?? '' ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Cairan keluar intra anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Urin -->
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Urin :</label>
                                    <input type="text" class="form-control form-control-sm" name="urinIntra" id="urinIntra" value="<?= $data->rm11b2MonitoringAnestesi['urinIntra'] ?? '50ML' ?>">
                                </div>
                                <div class="col-md-6">

                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">S & I:</label>
                                    <input type="text" class="form-control form-control-sm" name="s_iIntra" id="s_iIntra" value="<?= $data->rm11b2MonitoringAnestesi['s_iIntra'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Darah :</label>
                                    <input type="text" class="form-control form-control-sm" name="darahIntra" id="darahIntra" value="<?= $data->rm11b2MonitoringAnestesi['darahIntra'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">EBV :</label>
                                    <input type="text" class="form-control form-control-sm" name="ebvIntra" id="ebvIntra" value="<?= $data->rm11b2MonitoringAnestesi['ebvIntra'] ?? '' ?>">
                                </div>
                            </div>


                        </div>

                        <!-- end of cairan  masuk dan keluar intra anestesi -->

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Catatan :</label>
                                    <textarea class="form-control" name="catatanIntra" id="catatanIntra"><?= $data->rm11b2MonitoringAnestesi['catatanIntra'] ?? '' ?></textarea>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu ttd :</label>
                                    <input type="datetime-local" id="waktuTtd1" name="waktuTtd1" class="form-control form-control-sm" value="<?= isset($data->rm11b2MonitoringAnestesi['waktuTtd1']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuTtd1'])) : '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Diperiksa Oleh :</label>

                                    <!-- Input biasa yang bisa diketik bebas -->
                                    <input type="text"
                                        name="dokter1"
                                        id="dokter1"
                                        class="form-control form-control-sm"
                                        list="listDokter"
                                        placeholder="Ketik atau pilih nama dokter..."
                                        value="<?= isset($data->rm11b2MonitoringAnestesi['dokter1']) ? $data->rm11b2MonitoringAnestesi['dokter1'] : 'dr. IRWAN WIBOWO, Sp.An' ?>">

                                    <!-- Datalist sebagai sumber saran otomatis -->
                                    <datalist id="listDokter">
                                        <?php for ($i = 0; $i < count($data->dokter); $i++) { ?>
                                            <option value="<?= $data->dokter[$i]["nm_dokter"] ?>">
                                            <?php } ?>
                                    </datalist>
                                </div>

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="nav-pasca" role="tabpanel" aria-labelledby="nav-pasca-tab">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Kendala :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <!-- Pendarahan -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Pendarahan :</label>
                                    <input type="text" class="form-control form-control-sm " name="pendarahan" id="pendarahan" value="<?= $data->rm11b2MonitoringAnestesi['pendarahan'] ?? '50ML' ?>">
                                </div>

                                <!-- Kontraksi Uterus -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kontraksi Uterus :</label>
                                    <input type="text" class="form-control form-control-sm " name="kontraksi_uterus" id="kontraksi_uterus" value="<?= $data->rm11b2MonitoringAnestesi['kontraksi_uterus'] ?? '+ / KERAS' ?>">
                                </div>

                                <!-- Kompartemen syndrom -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kompartemen syndrom :</label>
                                    <input type="text" class="form-control form-control-sm " name="kompartemen_syndrom" id="kompartemen_syndrom" value="<?= $data->rm11b2MonitoringAnestesi['kompartemen_syndrom'] ?? '' ?>">
                                </div>

                                <!-- Masalah / Komentar (Menggunakan Textarea sesuai permintaan) -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Masalah / Komentar :</label>
                                    <textarea class="form-control form-control-sm " name="masalah_komentar" id="masalah_komentar" rows="2"><?= $data->rm11b2MonitoringAnestesi['masalah_komentar'] ?? '' ?></textarea>
                                </div>

                            </div>

                        </div>


                        <div class="alert alert-info" role="alert">

                            <div class="row mb-2">
                                <div class="col-12 text-center">Ruang pulih sadar :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Pesanan/Tindakan :</label>
                                    <textarea class="form-control" name="perasanTindakan" id="perasanTindakan" rows="5"><?= $data->rm11b2MonitoringAnestesi['perasanTindakan'] ?? '- OBS TTV
- OBS NYERI
- BERI O2 NASAL 4 LPM' ?></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="alert alert-info p-1" role="alert">
                            <div class="row mb-2">
                                <div class="col-12 text-center">Skor Bromage Pasca Anestesi :</div>
                                <hr>
                            </div>
                            <?php
                            // 1. Ambil data bromage_t (waktu) dari database dan decode jika bentuknya string JSON
                            $rawBromageT = $data->rm11b2MonitoringAnestesi['bromage_t'] ?? [];
                            $bromageTData = is_string($rawBromageT) ? json_decode($rawBromageT, true) : $rawBromageT;
                            if (!is_array($bromageTData)) {
                                $bromageTData = [];
                            }

                            // 2. Ambil nilai bromage_keluar (kolom K) dari database
                            $bromageKeluar = $data->rm11b2MonitoringAnestesi['bromage_keluar'] ?? '';
                            ?>

                            <!-- Tabel Bromage Score -->
                            <div class="table-responsive">
                                <table class="table align-middle text-center table-sm table-striped-columns custom-row-border" id="bromageTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th style="width: 35%;">Bromage Score</th>
                                            <th style="width: 7%;">N</th>
                                            <th style="width: 4%;">0"</th>
                                            <th style="width: 4%;">5"</th>
                                            <th style="width: 4%;">15"</th>
                                            <th style="width: 4%;">30"</th>
                                            <th style="width: 4%;">45"</th>
                                            <th style="width: 4%;">1'</th>
                                            <th style="width: 4%;">2'</th>
                                            <th style="width: 4%;">3'</th>
                                            <th style="width: 4%;">4'</th>
                                            <th style="width: 8%;">k</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- BROMAGE 3 -->
                                        <tr>
                                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage3.png" width="100%" alt="">
                                                <div class="small fw-semibold mt-1">Bromage 3 (complete)</div>
                                            </td>
                                            <td class="fw-bold">3</td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[0]" value="3" <?= (!isset($bromageTData[0]) || $bromageTData[0] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[5]" value="3" <?= (!isset($bromageTData[5]) || $bromageTData[5] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[15]" value="3" <?= (isset($bromageTData[15]) && $bromageTData[15] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[30]" value="3" <?= (isset($bromageTData[30]) && $bromageTData[30] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[45]" value="3" <?= (isset($bromageTData[45]) && $bromageTData[45] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[60]" value="3" <?= (isset($bromageTData[60]) && $bromageTData[60] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[120]" value="3" <?= (isset($bromageTData[120]) && $bromageTData[120] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[180]" value="3" <?= (isset($bromageTData[180]) && $bromageTData[180] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[240]" value="3" <?= (isset($bromageTData[240]) && $bromageTData[240] == '3') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_keluar" value="3" <?= ($bromageKeluar == '3') ? 'checked' : '' ?>></td>
                                        </tr>

                                        <!-- BROMAGE 2 -->
                                        <tr>
                                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage2.png" width="100%" alt="">
                                                <div class="small fw-semibold mt-1">Bromage 2 (almost complete)</div>
                                            </td>
                                            <td class="fw-bold">2</td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[0]" value="2" <?= (isset($bromageTData[0]) && $bromageTData[0] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[5]" value="2" <?= (isset($bromageTData[5]) && $bromageTData[5] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[15]" value="2" <?= (!isset($bromageTData[15]) || $bromageTData[15] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[30]" value="2" <?= (isset($bromageTData[30]) && $bromageTData[30] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[45]" value="2" <?= (isset($bromageTData[45]) && $bromageTData[45] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[60]" value="2" <?= (isset($bromageTData[60]) && $bromageTData[60] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[120]" value="2" <?= (isset($bromageTData[120]) && $bromageTData[120] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[180]" value="2" <?= (isset($bromageTData[180]) && $bromageTData[180] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[240]" value="2" <?= (isset($bromageTData[240]) && $bromageTData[240] == '2') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_keluar" value="2" <?= ($bromageKeluar == '2') ? 'checked' : '' ?>></td>
                                        </tr>

                                        <!-- BROMAGE 1 -->
                                        <tr>
                                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage1.png" width="100%" alt="">
                                                <div class="small fw-semibold mt-1">Bromage 1 (partial)</div>
                                            </td>
                                            <td class="fw-bold">1</td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[0]" value="1" <?= (isset($bromageTData[0]) && $bromageTData[0] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[5]" value="1" <?= (isset($bromageTData[5]) && $bromageTData[5] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[15]" value="1" <?= (isset($bromageTData[15]) && $bromageTData[15] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[30]" value="1" <?= (!isset($bromageTData[30]) || $bromageTData[30] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[45]" value="1" <?= (!isset($bromageTData[45]) || $bromageTData[45] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[60]" value="1" <?= (isset($bromageTData[60]) && $bromageTData[60] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[120]" value="1" <?= (isset($bromageTData[120]) && $bromageTData[120] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[180]" value="1" <?= (isset($bromageTData[180]) && $bromageTData[180] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[240]" value="1" <?= (isset($bromageTData[240]) && $bromageTData[240] == '1') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_keluar" value="1" <?= ($bromageKeluar == '1') ? 'checked' : '' ?>></td>
                                        </tr>

                                        <!-- BROMAGE 0 -->
                                        <tr>
                                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage0.png" width="100%" alt="">
                                                <div class="small fw-semibold mt-1">Bromage 0 (none)</div>
                                            </td>
                                            <td class="fw-bold">0</td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[0]" value="0" <?= (isset($bromageTData[0]) && $bromageTData[0] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[5]" value="0" <?= (isset($bromageTData[5]) && $bromageTData[5] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[15]" value="0" <?= (isset($bromageTData[15]) && $bromageTData[15] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[30]" value="0" <?= (isset($bromageTData[30]) && $bromageTData[30] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[45]" value="0" <?= (isset($bromageTData[45]) && $bromageTData[45] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[60]" value="0" <?= (!isset($bromageTData[60]) || $bromageTData[60] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[120]" value="0" <?= (!isset($bromageTData[120]) || $bromageTData[120] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[180]" value="0" <?= (isset($bromageTData[180]) && $bromageTData[180] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_t[240]" value="0" <?= (isset($bromageTData[240]) && $bromageTData[240] == '0') ? 'checked' : '' ?>></td>
                                            <td><input class="form-check-input" type="radio" name="bromage_keluar" value="0" <?= (empty($bromageKeluar) || $bromageKeluar == '0') ? 'checked' : '' ?>></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="alert alert-info" role="alert">

                            <div class="row">
                                <div class="col-12 text-center">Pesanan Pasien Pindah Pasca Anestesi :</div>
                                <hr>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Pindah Ke :</label>
                                    <input type="text" class="form-control" name="pindahKe" id="pindahKe" value="<?= $data->rm11b2MonitoringAnestesi['pindahKe'] ?? '' ?>">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Waktu :</label>
                                    <input type="datetime-local" id="waktuPindah" name="waktuPindah" class="form-control form-control-sm" value="<?= isset($data->rm11b2MonitoringAnestesi['waktuPindah']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['waktuPindah'])) : '' ?>">
                                </div>
                                <!-- <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Disetujui Oleh :</label>
                                    <select name="disetujuiOleh" id="disetujuiOleh" class="form-select form-select-sm">
                                        <option value="" < (empty($data->rm11b2MonitoringAnestesi['disetujuiOleh'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                        < for ($i = 0; $i < count($data->dokter); $i++) {
                                            $selected = (($data->rm11b2MonitoringAnestesi['disetujuiOleh'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                            echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                        } ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">TT :</label>
                                    <input type="text" class="form-control" name="tt" id="tt" value="< $data->rm11b2MonitoringAnestesi['tt'] ?? '' ?>">
                                </div> -->
                            </div>

                            <hr>
                            <b class="text-secondary">Diagnosis Pasca Anestesi :</b>
                            <br>
                            <div class="row mb-1">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Infus :</label>
                                    <input type="text" class="form-control" name="infus" id="infus" value="<?= $data->rm11b2MonitoringAnestesi['infus'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="border border-info rounded p-1 mb-1">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Puasa sampai :</label>
                                        <input type="datetime-local" class="form-control" name="puasaSampai" id="puasaSampai" value="<?= !empty($data->rm11b2MonitoringAnestesi['puasaSampai']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['puasaSampai'])) : '' ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Puasa Minum :</label>
                                        <input type="datetime-local" class="form-control" name="puasaMinum" id="puasaMinum" value="<?= !empty($data->rm11b2MonitoringAnestesi['puasaMinum']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['puasaMinum'])) : '' ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Puasa Makan :</label>
                                        <input type="datetime-local" class="form-control" name="puasaMakan" id="puasaMakan" value="<?= !empty($data->rm11b2MonitoringAnestesi['puasaMakan']) ? date('Y-m-d\TH:i', strtotime($data->rm11b2MonitoringAnestesi['puasaMakan'])) : '' ?>">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Bila bising usus positif :</label>
                                        <input type="text" class="form-control" name="bisingUsus" id="bisingUsus" value="<?= $data->rm11b2MonitoringAnestesi['bisingUsus'] ?? 'SADAR BAIK, MUAL (-), MUNTAH (-), MAKAN MINUM BERTAHAP' ?>">
                                    </div>
                                </div>

                            </div>


                            <div class="border border-info rounded p-1 mb-1">
                                <div class="row">
                                    <!-- Observasi -->
                                    <!-- <div class="col-md-6 "> -->
                                    <label class="form-label fw-bold small mb-0 ms-1">Observasi :</label>
                                    <!-- <input type="text" class="form-control form-control-sm  " name="observasi" id="observasi" value="< $data->rm11b2MonitoringAnestesi['observasi'] ?? 'TIAP 15 MENIT ' ?>"> -->
                                    <!-- </div> -->

                                    <!-- Perfusi -->
                                    <div class="col-md-12 ">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Perfusi :</label>
                                        <input type="text" class="form-control form-control-sm " name="perfusi" id="perfusi" value="<?= $data->rm11b2MonitoringAnestesi['perfusi'] ?? 'HKM, CRT < 2' ?>">
                                    </div>

                                    <!-- Tensi (dengan teks tambahan di kanan) -->
                                    <div class="col-md-12 ">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tensi :</label>
                                        <div class="input-group input-group-sm  ">
                                            <input type="text" class="form-control" name="tensi" id="tensi" value="<?= $data->rm11b2MonitoringAnestesi['tensi'] ?? '' ?>">
                                            <!-- <span class="input-group-text bg-light text-secondary">, bila sistole > 160 mmHg</span>
                                            <input type="text" class="form-control" name="tensi_bila" id="tensi_bila" value="< $data->rm11b2MonitoringAnestesi['tensi_bila'] ?? '' ?>"> -->
                                        </div>
                                    </div>

                                    <!-- Nadi (dengan input tambahan di kanan) -->
                                    <div class="col-md-12 ">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Nadi :</label>
                                        <div class="input-group input-group-sm  ">
                                            <input type="text" class="form-control" name="nadi" id="nadi" value="<?= $data->rm11b2MonitoringAnestesi['nadi'] ?? '' ?>">
                                            <!-- <span class="input-group-text bg-light text-secondary">, bila</span>
                                            <input type="text" class="form-control" name="nadi_bila" id="nadi_bila" value="< $data->rm11b2MonitoringAnestesi['nadi_bila'] ?? '' ?>"> -->
                                        </div>
                                    </div>

                                    <!-- Kesadaran -->
                                    <div class="col-md-6 ">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Kesadaran :</label>
                                        <input type="text" class="form-control form-control-sm  " name="kesadaran" id="kesadaran" value="<?= $data->rm11b2MonitoringAnestesi['kesadaran'] ?? 'COMPOSMENTIS' ?>">
                                    </div>

                                    <!-- Produksi Urine -->
                                    <div class="col-md-6 ">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Produksi Urine :</label>
                                        <input type="text" class="form-control form-control-sm  " name="produksi_urine" id="produksi_urine" value="<?= $data->rm11b2MonitoringAnestesi['produksi_urine'] ?? '20 ML/JAM' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Terapi :</label>
                                    <textarea class="form-control" name="terapi" id="terapi"><?= $data->rm11b2MonitoringAnestesi['terapi'] ?? 'DAMABEM 3X4mg
RANITIDINE 3X50mg
METAMIZOLE 3X1Gr
PAMOL 4X1GR' ?></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Mobilisasi :</label>
                                    <textarea class="form-control" name="mobilisasi" id="mobilisasi"><?= $data->rm11b2MonitoringAnestesi['mobilisasi'] ?? 'IMMOBILISASI 24 JAM, MIKA MIKI SAAT KAKI BISA BERGERAK' ?></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Lain-lain :</label>
                                    <textarea class="form-control" name="pascaOpLain" id="pascaOpLain"><?= $data->rm11b2MonitoringAnestesi['pascaOpLain'] ?? '-' ?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <!-- Perawat -->
                                <div class="col-md-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Perawat :</label>
                                    <input type="text"
                                        name="perawat"
                                        id="perawat"
                                        class="form-control form-control-sm"
                                        list="listPetugas"
                                        placeholder="Ketik atau pilih nama perawat..."
                                        value="<?= isset($data->rm11b2MonitoringAnestesi['perawat']) ? $data->rm11b2MonitoringAnestesi['perawat'] : '' ?>">
                                </div>

                                <!-- Perawat RR -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Perawat RR :</label>
                                    <input type="text"
                                        name="perawatRr"
                                        id="perawatRr"
                                        class="form-control form-control-sm"
                                        list="listPetugas"
                                        placeholder="Ketik atau pilih nama perawat..."
                                        value="<?= isset($data->rm11b2MonitoringAnestesi['perawatRr']) ? $data->rm11b2MonitoringAnestesi['perawatRr'] : '' ?>">
                                </div>

                                <!-- Perawat Anestesi -->
                                <div class="col-md-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Perawat Anestesi :</label>
                                    <input type="text"
                                        name="perawatAnestesi"
                                        id="perawatAnestesi"
                                        class="form-control form-control-sm"
                                        list="listPetugas"
                                        placeholder="Ketik atau pilih nama perawat..."
                                        value="<?= isset($data->rm11b2MonitoringAnestesi['perawatAnestesi']) ? $data->rm11b2MonitoringAnestesi['perawatAnestesi'] : '' ?>">
                                </div>

                                <!-- Satu Datalist Bersama untuk Semua Input Petugas -->
                                <datalist id="listPetugas">
                                    <?php for ($i = 0; $i < count($data->petugas); $i++) { ?>
                                        <option value="<?= $data->petugas[$i]["nama"] ?>">
                                        <?php } ?>
                                </datalist>
                            </div>


                        </div>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12">

                    <div class="alert alert-info" role="alert">
                        <div class="row">
                            <div class="col-12 text-center">Skor Aldrette Pasca Anestesi :</div>
                            <hr>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <!-- Bagian Header TD Pra-Anestesi -->
                                <!-- <div class="mb-1 d-flex align-items-center gap-2">
                                    <label for="td_pra_anestesi" class="form-label fw-semibold mb-0 text-nowrap">TD Pra-Anestesi :</label>
                                    <input type="text" class="form-control form-control-sm w-25" id="td_pra_anestesi" name="td_pra_anestesi" value="<?= $data->rm11b2MonitoringAnestesi['td_pra_anestesi'] ?? '' ?>" placeholder="Masukkan TD...">
                                </div> -->

                                <!-- Tabel Penilaian (Aldrete Score / Pemulihan) -->
                                <div class="table-responsive">
                                    <table class="table table-bordered border-dark table-striped align-middle text-center table-sm" id="aldreteTable">
                                        <thead>
                                            <tr>
                                                <th style="width: 15%;">Parameter</th>
                                                <th style="width: 38%;">Kriteria Penilaian</th>
                                                <th style="width: 5%;">Nilai</th>
                                                <th style="width: 4%;">0"</th>
                                                <th style="width: 4%;">5"</th>
                                                <th style="width: 4%;">15"</th>
                                                <th style="width: 4%;">30"</th>
                                                <th style="width: 4%;">45"</th>
                                                <th style="width: 4%;">1'</th>
                                                <th style="width: 4%;">2'</th>
                                                <th style="width: 4%;">3'</th>
                                                <th style="width: 4%;">4'</th>
                                                <th style="width: 8%;">Keluar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // 1. Ambil data sirkulasi_t (waktu) dari database dan decode jika bentuknya string JSON
                                            $rawSirkulasiT = $data->rm11b2MonitoringAnestesi['sirkulasi_t'] ?? [];
                                            $sirkulasiTData = is_string($rawSirkulasiT) ? json_decode($rawSirkulasiT, true) : $rawSirkulasiT;
                                            if (!is_array($sirkulasiTData)) {
                                                $sirkulasiTData = [];
                                            }

                                            // 2. Ambil nilai sirkulasi_keluar (kolom K) dari database
                                            $sirkulasiKeluar = $data->rm11b2MonitoringAnestesi['sirkulasi_keluar'] ?? '';
                                            ?>

                                            <!-- SIRKULASI -->
                                            <tr data-parameter="sirkulasi">
                                                <td rowspan="3" class="fw-bold bg-white">Sirkulasi</td>
                                                <td class="text-start">TD +/- 20 mmHg dari normal</td>
                                                <td>2</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[0]" value="2" data-col="0" <?= (isset($sirkulasiTData[0]) && $sirkulasiTData[0] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[5]" value="2" data-col="5" <?= (isset($sirkulasiTData[5]) && $sirkulasiTData[5] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[15]" value="2" data-col="15" <?= (!isset($sirkulasiTData[15]) || $sirkulasiTData[15] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[30]" value="2" data-col="30" <?= (!isset($sirkulasiTData[30]) || $sirkulasiTData[30] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[45]" value="2" data-col="45" <?= (!isset($sirkulasiTData[45]) || $sirkulasiTData[45] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[60]" value="2" data-col="60" <?= (!isset($sirkulasiTData[60]) || $sirkulasiTData[60] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[120]" value="2" data-col="120" <?= (isset($sirkulasiTData[120]) && $sirkulasiTData[120] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[180]" value="2" data-col="180" <?= (isset($sirkulasiTData[180]) && $sirkulasiTData[180] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[240]" value="2" data-col="240" <?= (isset($sirkulasiTData[240]) && $sirkulasiTData[240] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_keluar" value="2" data-col="keluar" <?= (empty($sirkulasiKeluar) || $sirkulasiKeluar == '2') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="sirkulasi">
                                                <td class="text-start">TD +/- 20-50 mmHg dari normal</td>
                                                <td>1</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[0]" value="1" data-col="0" <?= (!isset($sirkulasiTData[0]) || $sirkulasiTData[0] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[5]" value="1" data-col="5" <?= (!isset($sirkulasiTData[5]) || $sirkulasiTData[5] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[15]" value="1" data-col="15" <?= (isset($sirkulasiTData[15]) && $sirkulasiTData[15] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[30]" value="1" data-col="30" <?= (isset($sirkulasiTData[30]) && $sirkulasiTData[30] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[45]" value="1" data-col="45" <?= (isset($sirkulasiTData[45]) && $sirkulasiTData[45] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[60]" value="1" data-col="60" <?= (isset($sirkulasiTData[60]) && $sirkulasiTData[60] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[120]" value="1" data-col="120" <?= (isset($sirkulasiTData[120]) && $sirkulasiTData[120] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[180]" value="1" data-col="180" <?= (isset($sirkulasiTData[180]) && $sirkulasiTData[180] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[240]" value="1" data-col="240" <?= (isset($sirkulasiTData[240]) && $sirkulasiTData[240] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_keluar" value="1" data-col="keluar" <?= ($sirkulasiKeluar == '1') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="sirkulasi">
                                                <td class="text-start">TD +/- > 50 mmHg dari normal</td>
                                                <td>0</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[0]" value="0" data-col="0" <?= (isset($sirkulasiTData[0]) && $sirkulasiTData[0] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[5]" value="0" data-col="5" <?= (isset($sirkulasiTData[5]) && $sirkulasiTData[5] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[15]" value="0" data-col="15" <?= (isset($sirkulasiTData[15]) && $sirkulasiTData[15] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[30]" value="0" data-col="30" <?= (isset($sirkulasiTData[30]) && $sirkulasiTData[30] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[45]" value="0" data-col="45" <?= (isset($sirkulasiTData[45]) && $sirkulasiTData[45] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[60]" value="0" data-col="60" <?= (isset($sirkulasiTData[60]) && $sirkulasiTData[60] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[120]" value="0" data-col="120" <?= (isset($sirkulasiTData[120]) && $sirkulasiTData[120] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[180]" value="0" data-col="180" <?= (isset($sirkulasiTData[180]) && $sirkulasiTData[180] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_t[240]" value="0" data-col="240" <?= (isset($sirkulasiTData[240]) && $sirkulasiTData[240] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="sirkulasi_keluar" value="0" data-col="keluar" <?= ($sirkulasiKeluar == '0') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <?php
                                            // 1. Ambil data kesadaran_t (waktu) dari database dan decode jika bentuknya string JSON
                                            $rawKesadaranT = $data->rm11b2MonitoringAnestesi['kesadaran_t'] ?? [];
                                            $kesadaranTData = is_string($rawKesadaranT) ? json_decode($rawKesadaranT, true) : $rawKesadaranT;
                                            if (!is_array($kesadaranTData)) {
                                                $kesadaranTData = [];
                                            }

                                            // 2. Ambil nilai kesadaran_keluar (kolom K) dari database
                                            $kesadaranKeluar = $data->rm11b2MonitoringAnestesi['kesadaran_keluar'] ?? '';
                                            ?>

                                            <!-- KESADARAN -->
                                            <tr data-parameter="kesadaran">
                                                <td rowspan="3" class="fw-bold bg-white">Kesadaran</td>
                                                <td class="text-start">Sadar penuh</td>
                                                <td>2</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[0]" value="2" data-col="0" <?= (!isset($kesadaranTData[0]) || $kesadaranTData[0] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[5]" value="2" data-col="5" <?= (!isset($kesadaranTData[5]) || $kesadaranTData[5] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[15]" value="2" data-col="15" <?= (!isset($kesadaranTData[15]) || $kesadaranTData[15] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[30]" value="2" data-col="30" <?= (!isset($kesadaranTData[30]) || $kesadaranTData[30] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[45]" value="2" data-col="45" <?= (!isset($kesadaranTData[45]) || $kesadaranTData[45] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[60]" value="2" data-col="60" <?= (!isset($kesadaranTData[60]) || $kesadaranTData[60] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[120]" value="2" data-col="120" <?= (isset($kesadaranTData[120]) && $kesadaranTData[120] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[180]" value="2" data-col="180" <?= (isset($kesadaranTData[180]) && $kesadaranTData[180] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[240]" value="2" data-col="240" <?= (isset($kesadaranTData[240]) && $kesadaranTData[240] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_keluar" value="2" data-col="keluar" <?= (empty($kesadaranKeluar) || $kesadaranKeluar == '2') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="kesadaran">
                                                <td class="text-start">Respon terhadap panggilan</td>
                                                <td>1</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[0]" value="1" data-col="0" <?= (isset($kesadaranTData[0]) && $kesadaranTData[0] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[5]" value="1" data-col="5" <?= (isset($kesadaranTData[5]) && $kesadaranTData[5] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[15]" value="1" data-col="15" <?= (isset($kesadaranTData[15]) && $kesadaranTData[15] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[30]" value="1" data-col="30" <?= (isset($kesadaranTData[30]) && $kesadaranTData[30] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[45]" value="1" data-col="45" <?= (isset($kesadaranTData[45]) && $kesadaranTData[45] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[60]" value="1" data-col="60" <?= (isset($kesadaranTData[60]) && $kesadaranTData[60] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[120]" value="1" data-col="120" <?= (isset($kesadaranTData[120]) && $kesadaranTData[120] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[180]" value="1" data-col="180" <?= (isset($kesadaranTData[180]) && $kesadaranTData[180] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[240]" value="1" data-col="240" <?= (isset($kesadaranTData[240]) && $kesadaranTData[240] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_keluar" value="1" data-col="keluar" <?= ($kesadaranKeluar == '1') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="kesadaran">
                                                <td class="text-start">Tidak ada respon</td>
                                                <td>0</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[0]" value="0" data-col="0" <?= (isset($kesadaranTData[0]) && $kesadaranTData[0] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[5]" value="0" data-col="5" <?= (isset($kesadaranTData[5]) && $kesadaranTData[5] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[15]" value="0" data-col="15" <?= (isset($kesadaranTData[15]) && $kesadaranTData[15] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[30]" value="0" data-col="30" <?= (isset($kesadaranTData[30]) && $kesadaranTData[30] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[45]" value="0" data-col="45" <?= (isset($kesadaranTData[45]) && $kesadaranTData[45] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[60]" value="0" data-col="60" <?= (isset($kesadaranTData[60]) && $kesadaranTData[60] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[120]" value="0" data-col="120" <?= (isset($kesadaranTData[120]) && $kesadaranTData[120] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[180]" value="0" data-col="180" <?= (isset($kesadaranTData[180]) && $kesadaranTData[180] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_t[240]" value="0" data-col="240" <?= (isset($kesadaranTData[240]) && $kesadaranTData[240] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="kesadaran_keluar" value="0" data-col="keluar" <?= ($kesadaranKeluar == '0') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <?php
                                            // 1. Ambil data oksigenasi_t (waktu) dari database dan decode jika bentuknya string JSON
                                            $rawOksigenasiT = $data->rm11b2MonitoringAnestesi['oksigenasi_t'] ?? [];
                                            $oksigenasiTData = is_string($rawOksigenasiT) ? json_decode($rawOksigenasiT, true) : $rawOksigenasiT;
                                            if (!is_array($oksigenasiTData)) {
                                                $oksigenasiTData = [];
                                            }

                                            // 2. Ambil nilai oksigenasi_keluar (kolom K) dari database
                                            $oksigenasiKeluar = $data->rm11b2MonitoringAnestesi['oksigenasi_keluar'] ?? '';
                                            ?>

                                            <!-- OKSIGENASI -->
                                            <tr data-parameter="oksigenasi">
                                                <td rowspan="3" class="fw-bold bg-white">Oksigenasi</td>
                                                <td class="text-start">SpO₂ > 92% (dengan udara bebas)</td>
                                                <td>2</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[0]" value="2" data-col="0" <?= (!isset($oksigenasiTData[0]) || $oksigenasiTData[0] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[5]" value="2" data-col="5" <?= (!isset($oksigenasiTData[5]) || $oksigenasiTData[5] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[15]" value="2" data-col="15" <?= (!isset($oksigenasiTData[15]) || $oksigenasiTData[15] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[30]" value="2" data-col="30" <?= (!isset($oksigenasiTData[30]) || $oksigenasiTData[30] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[45]" value="2" data-col="45" <?= (!isset($oksigenasiTData[45]) || $oksigenasiTData[45] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[60]" value="2" data-col="60" <?= (!isset($oksigenasiTData[60]) || $oksigenasiTData[60] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[120]" value="2" data-col="120" <?= (isset($oksigenasiTData[120]) && $oksigenasiTData[120] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[180]" value="2" data-col="180" <?= (isset($oksigenasiTData[180]) && $oksigenasiTData[180] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[240]" value="2" data-col="240" <?= (isset($oksigenasiTData[240]) && $oksigenasiTData[240] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_keluar" value="2" data-col="keluar" <?= (empty($oksigenasiKeluar) || $oksigenasiKeluar == '2') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="oksigenasi">
                                                <td class="text-start">SpO₂ > 92% (dengan suplemen O₂)</td>
                                                <td>1</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[0]" value="1" data-col="0" <?= (isset($oksigenasiTData[0]) && $oksigenasiTData[0] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[5]" value="1" data-col="5" <?= (isset($oksigenasiTData[5]) && $oksigenasiTData[5] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[15]" value="1" data-col="15" <?= (isset($oksigenasiTData[15]) && $oksigenasiTData[15] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[30]" value="1" data-col="30" <?= (isset($oksigenasiTData[30]) && $oksigenasiTData[30] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[45]" value="1" data-col="45" <?= (isset($oksigenasiTData[45]) && $oksigenasiTData[45] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[60]" value="1" data-col="60" <?= (isset($oksigenasiTData[60]) && $oksigenasiTData[60] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[120]" value="1" data-col="120" <?= (isset($oksigenasiTData[120]) && $oksigenasiTData[120] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[180]" value="1" data-col="180" <?= (isset($oksigenasiTData[180]) && $oksigenasiTData[180] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[240]" value="1" data-col="240" <?= (isset($oksigenasiTData[240]) && $oksigenasiTData[240] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_keluar" value="1" data-col="keluar" <?= ($oksigenasiKeluar == '1') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="oksigenasi">
                                                <td class="text-start">SpO₂ < 92% (dengan suplemen O₂)</td>
                                                <td>0</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[0]" value="0" data-col="0" <?= (isset($oksigenasiTData[0]) && $oksigenasiTData[0] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[5]" value="0" data-col="5" <?= (isset($oksigenasiTData[5]) && $oksigenasiTData[5] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[15]" value="0" data-col="15" <?= (isset($oksigenasiTData[15]) && $oksigenasiTData[15] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[30]" value="0" data-col="30" <?= (isset($oksigenasiTData[30]) && $oksigenasiTData[30] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[45]" value="0" data-col="45" <?= (isset($oksigenasiTData[45]) && $oksigenasiTData[45] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[60]" value="0" data-col="60" <?= (isset($oksigenasiTData[60]) && $oksigenasiTData[60] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[120]" value="0" data-col="120" <?= (isset($oksigenasiTData[120]) && $oksigenasiTData[120] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[180]" value="0" data-col="180" <?= (isset($oksigenasiTData[180]) && $oksigenasiTData[180] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_t[240]" value="0" data-col="240" <?= (isset($oksigenasiTData[240]) && $oksigenasiTData[240] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="oksigenasi_keluar" value="0" data-col="keluar" <?= ($oksigenasiKeluar == '0') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <?php
                                            // 1. Ambil data pernafasan_t (waktu) dari database dan decode jika bentuknya string JSON
                                            $rawPernafasanT = $data->rm11b2MonitoringAnestesi['pernafasan_t'] ?? [];
                                            $pernafasanTData = is_string($rawPernafasanT) ? json_decode($rawPernafasanT, true) : $rawPernafasanT;
                                            if (!is_array($pernafasanTData)) {
                                                $pernafasanTData = [];
                                            }

                                            // 2. Ambil nilai pernafasan_keluar (kolom K) dari database
                                            $pernafasanKeluar = $data->rm11b2MonitoringAnestesi['pernafasan_keluar'] ?? '';
                                            ?>

                                            <!-- PERNAFASAN -->
                                            <tr data-parameter="pernafasan">
                                                <td rowspan="3" class="fw-bold bg-white">Pernafasan</td>
                                                <td class="text-start">Bisa menarik nafas dalam dan batuk bebas</td>
                                                <td>2</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[0]" value="2" data-col="0" <?= (!isset($pernafasanTData[0]) || $pernafasanTData[0] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[5]" value="2" data-col="5" <?= (!isset($pernafasanTData[5]) || $pernafasanTData[5] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[15]" value="2" data-col="15" <?= (!isset($pernafasanTData[15]) || $pernafasanTData[15] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[30]" value="2" data-col="30" <?= (!isset($pernafasanTData[30]) || $pernafasanTData[30] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[45]" value="2" data-col="45" <?= (!isset($pernafasanTData[45]) || $pernafasanTData[45] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[60]" value="2" data-col="60" <?= (!isset($pernafasanTData[60]) || $pernafasanTData[60] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[120]" value="2" data-col="120" <?= (isset($pernafasanTData[120]) && $pernafasanTData[120] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[180]" value="2" data-col="180" <?= (isset($pernafasanTData[180]) && $pernafasanTData[180] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[240]" value="2" data-col="240" <?= (isset($pernafasanTData[240]) && $pernafasanTData[240] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_keluar" value="2" data-col="keluar" <?= (empty($pernafasanKeluar) || $pernafasanKeluar == '2') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="pernafasan">
                                                <td class="text-start">Dispeneu atau limitasi bernafas</td>
                                                <td>1</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[0]" value="1" data-col="0" <?= (isset($pernafasanTData[0]) && $pernafasanTData[0] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[5]" value="1" data-col="5" <?= (isset($pernafasanTData[5]) && $pernafasanTData[5] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[15]" value="1" data-col="15" <?= (isset($pernafasanTData[15]) && $pernafasanTData[15] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[30]" value="1" data-col="30" <?= (isset($pernafasanTData[30]) && $pernafasanTData[30] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[45]" value="1" data-col="45" <?= (isset($pernafasanTData[45]) && $pernafasanTData[45] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[60]" value="1" data-col="60" <?= (isset($pernafasanTData[60]) && $pernafasanTData[60] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[120]" value="1" data-col="120" <?= (isset($pernafasanTData[120]) && $pernafasanTData[120] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[180]" value="1" data-col="180" <?= (isset($pernafasanTData[180]) && $pernafasanTData[180] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[240]" value="1" data-col="240" <?= (isset($pernafasanTData[240]) && $pernafasanTData[240] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_keluar" value="1" data-col="keluar" <?= ($pernafasanKeluar == '1') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="pernafasan">
                                                <td class="text-start">Apnea/tidak bernafas</td>
                                                <td>0</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[0]" value="0" data-col="0" <?= (isset($pernafasanTData[0]) && $pernafasanTData[0] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[5]" value="0" data-col="5" <?= (isset($pernafasanTData[5]) && $pernafasanTData[5] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[15]" value="0" data-col="15" <?= (isset($pernafasanTData[15]) && $pernafasanTData[15] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[30]" value="0" data-col="30" <?= (isset($pernafasanTData[30]) && $pernafasanTData[30] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[45]" value="0" data-col="45" <?= (isset($pernafasanTData[45]) && $pernafasanTData[45] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[60]" value="0" data-col="60" <?= (isset($pernafasanTData[60]) && $pernafasanTData[60] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[120]" value="0" data-col="120" <?= (isset($pernafasanTData[120]) && $pernafasanTData[120] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[180]" value="0" data-col="180" <?= (isset($pernafasanTData[180]) && $pernafasanTData[180] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_t[240]" value="0" data-col="240" <?= (isset($pernafasanTData[240]) && $pernafasanTData[240] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="pernafasan_keluar" value="0" data-col="keluar" <?= ($pernafasanKeluar == '0') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <?php
                                            // 1. Ambil data aktivitas_t (waktu) dari database dan decode jika bentuknya string JSON
                                            $rawAktivitasT = $data->rm11b2MonitoringAnestesi['aktivitas_t'] ?? [];
                                            $aktivitasTData = is_string($rawAktivitasT) ? json_decode($rawAktivitasT, true) : $rawAktivitasT;
                                            if (!is_array($aktivitasTData)) {
                                                $aktivitasTData = [];
                                            }

                                            // 2. Ambil nilai aktivitas_keluar (kolom K) dari database
                                            $aktivitasKeluar = $data->rm11b2MonitoringAnestesi['aktivitas_keluar'] ?? '';
                                            ?>

                                            <!-- AKTIVITAS -->
                                            <tr data-parameter="aktivitas">
                                                <td rowspan="3" class="fw-bold bg-white">Aktivitas</td>
                                                <td class="text-start">Menggerakkan 4 ekstremitas</td>
                                                <td>2</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[0]" value="2" data-col="0" <?= (isset($aktivitasTData[0]) && $aktivitasTData[0] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[5]" value="2" data-col="5" <?= (isset($aktivitasTData[5]) && $aktivitasTData[5] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[15]" value="2" data-col="15" <?= (isset($aktivitasTData[15]) && $aktivitasTData[15] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[30]" value="2" data-col="30" <?= (isset($aktivitasTData[30]) && $aktivitasTData[30] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[45]" value="2" data-col="45" <?= (!isset($aktivitasTData[45]) || $aktivitasTData[45] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[60]" value="2" data-col="60" <?= (!isset($aktivitasTData[60]) || $aktivitasTData[60] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[120]" value="2" data-col="120" <?= (isset($aktivitasTData[120]) && $aktivitasTData[120] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[180]" value="2" data-col="180" <?= (isset($aktivitasTData[180]) && $aktivitasTData[180] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[240]" value="2" data-col="240" <?= (isset($aktivitasTData[240]) && $aktivitasTData[240] == '2') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_keluar" value="2" data-col="keluar" <?= (empty($aktivitasKeluar) || $aktivitasKeluar == '2') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="aktivitas">
                                                <td class="text-start">Menggerakkan 2 ekstremitas</td>
                                                <td>1</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[0]" value="1" data-col="0" <?= (isset($aktivitasTData[0]) && $aktivitasTData[0] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[5]" value="1" data-col="5" <?= (isset($aktivitasTData[5]) && $aktivitasTData[5] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[15]" value="1" data-col="15" <?= (!isset($aktivitasTData[15]) || $aktivitasTData[15] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[30]" value="1" data-col="30" <?= (!isset($aktivitasTData[30]) || $aktivitasTData[30] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[45]" value="1" data-col="45" <?= (isset($aktivitasTData[45]) && $aktivitasTData[45] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[60]" value="1" data-col="60" <?= (isset($aktivitasTData[60]) && $aktivitasTData[60] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[120]" value="1" data-col="120" <?= (isset($aktivitasTData[120]) && $aktivitasTData[120] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[180]" value="1" data-col="180" <?= (isset($aktivitasTData[180]) && $aktivitasTData[180] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[240]" value="1" data-col="240" <?= (isset($aktivitasTData[240]) && $aktivitasTData[240] == '1') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_keluar" value="1" data-col="keluar" <?= ($aktivitasKeluar == '1') ? 'checked' : '' ?>></td>
                                            </tr>
                                            <tr data-parameter="aktivitas">
                                                <td class="text-start">Tidak mampu menggerakkan ekstremitas</td>
                                                <td>0</td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[0]" value="0" data-col="0" <?= (!isset($aktivitasTData[0]) || $aktivitasTData[0] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[5]" value="0" data-col="5" <?= (!isset($aktivitasTData[5]) || $aktivitasTData[5] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[15]" value="0" data-col="15" <?= (isset($aktivitasTData[15]) && $aktivitasTData[15] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[30]" value="0" data-col="30" <?= (isset($aktivitasTData[30]) && $aktivitasTData[30] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[45]" value="0" data-col="45" <?= (isset($aktivitasTData[45]) && $aktivitasTData[45] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[60]" value="0" data-col="60" <?= (isset($aktivitasTData[60]) && $aktivitasTData[60] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[120]" value="0" data-col="120" <?= (isset($aktivitasTData[120]) && $aktivitasTData[120] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[180]" value="0" data-col="180" <?= (isset($aktivitasTData[180]) && $aktivitasTData[180] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_t[240]" value="0" data-col="240" <?= (isset($aktivitasTData[240]) && $aktivitasTData[240] == '0') ? 'checked' : '' ?>></td>
                                                <td><input class="form-check-input score-radio" type="radio" name="aktivitas_keluar" value="0" data-col="keluar" <?= ($aktivitasKeluar == '0') ? 'checked' : '' ?>></td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <!-- BARIS CATATAN & TOTAL SKOR -->
                                            <tr>
                                                <td colspan="2" class="text-start align-top">
                                                    <label for="catatanAldrete" class="form-label fw-semibold">Catatan :</label>
                                                    <textarea class="form-control form-control-sm" id="catatanAldrete" name="catatanAldrete" rows="3"><?= $data->rm11b2MonitoringAnestesi['catatanAldrete'] ?? '-' ?></textarea>
                                                </td>
                                                <td colspan="1" class="align-middle fw-bold bg-light text-end">Total</td>
                                                <!-- Kolom total skor di bawah setiap waktu/kolom -->
                                                <td class="fw-bold total-score" data-col="0">0</td>
                                                <td class="fw-bold total-score" data-col="5">0</td>
                                                <td class="fw-bold total-score" data-col="15">0</td>
                                                <td class="fw-bold total-score" data-col="30">0</td>
                                                <td class="fw-bold total-score" data-col="45">0</td>
                                                <td class="fw-bold total-score" data-col="60">0</td>
                                                <td class="fw-bold total-score" data-col="120">0</td>
                                                <td class="fw-bold total-score" data-col="180">0</td>
                                                <td class="fw-bold total-score" data-col="240">0</td>
                                                <td class="fw-bold total-score" data-col="keluar">0</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <!-- Script JavaScript untuk Perhitungan Total Skor Otomatis -->
                                <script>
                                    document.addEventListener('DOMContentLoaded', function() {
                                        const table = document.getElementById('aldreteTable');

                                        function calculateTotals() {
                                            // Ambil semua kolom unik berdasarkan atribut data-col
                                            const columns = ['0', '5', '15', '30', '45', '60', '120', '180', '240', 'keluar'];

                                            columns.forEach(col => {
                                                let columnSum = 0;
                                                // Cari semua parameter kategori (sirkulasi, kesadaran, oksigenasi, pernafasan, aktivitas)
                                                const parameters = ['sirkulasi', 'kesadaran', 'oksigenasi', 'pernafasan', 'aktivitas'];

                                                parameters.forEach(param => {
                                                    // Cari radio button yang dicek pada kategori & kolom tersebut
                                                    const checkedRadio = table.querySelector(`tr[data-parameter="${param}"] input.score-radio[data-col="${col}"]:checked`);
                                                    if (checkedRadio) {
                                                        columnSum += parseInt(checkedRadio.value) || 0;
                                                    }
                                                });

                                                // Tampilkan total ke cell footer yang sesuai
                                                const totalCell = table.querySelector(`tfoot td.total-score[data-col="${col}"]`);
                                                if (totalCell) {
                                                    totalCell.textContent = columnSum;
                                                }
                                            });
                                        }

                                        // Jalankan kalkulasi saat ada radio button yang diklik/diubah
                                        table.addEventListener('change', function(e) {
                                            if (e.target.classList.contains('score-radio')) {
                                                calculateTotals();
                                            }
                                        });

                                        // Hitung saat halaman dimuat (jika ada data lama yang sudah ter-check)
                                        calculateTotals();
                                    });



                                    $(document).ready(function() {
                                        // Fungsi bantu untuk format tanggal ke YYYY-MM-DDTHH:mm
                                        function formatDateTimeLocal(date) {
                                            const year = date.getFullYear();
                                            const month = String(date.getMonth() + 1).padStart(2, '0');
                                            const day = String(date.getDate()).padStart(2, '0');
                                            const hours = String(date.getHours()).padStart(2, '0');
                                            const minutes = String(date.getMinutes()).padStart(2, '0');
                                            return `${year}-${month}-${day}T${hours}:${minutes}`;
                                        }

                                        // 1. Ketika 'waktuInsisi' diubah nilainya
                                        $('#waktuInsisi').on('change', function() {
                                            const valInsisi = $(this).val();
                                            if (!valInsisi) return;

                                            const baseDate = new Date(valInsisi).getTime();

                                            // Mengisi field-field yang bergantung pada waktu insisi
                                            $('#waktuMasukOk').val(formatDateTimeLocal(new Date(baseDate - 20 * 60000)));
                                            $('#waktuPembiusan').val(formatDateTimeLocal(new Date(baseDate - 10 * 60000)));

                                            // Waktu Selesai Operasi (+45 menit)
                                            const selesaiOp = formatDateTimeLocal(new Date(baseDate + 45 * 60000));
                                            $('#waktuSelesaiOp').val(selesaiOp);

                                            // PENTING: Memicu event change secara manual agar fungsi di bawahnya ikut berjalan!
                                            $('#waktuSelesaiOp').trigger('change');

                                            $('#waktuSelesaiAnestesi').val(formatDateTimeLocal(new Date(baseDate + 55 * 60000)));
                                            $('#waktuKeluarOk').val(formatDateTimeLocal(new Date(baseDate + 65 * 60000)));
                                            $('#waktuBayiLahir').val(formatDateTimeLocal(new Date(baseDate + 5 * 60000)));
                                        });

                                        // 2. Ketika 'waktuSelesaiOp' berubah (baik manual maupun otomatis dari insisi)
                                        $('#waktuSelesaiOp').on('change', function() {
                                            const valSelesaiOp = $(this).val();
                                            if (!valSelesaiOp) return;

                                            // Tambah 4 jam (4 * 60 * 60 * 1000 = 14,400,000 ms)
                                            const baseDateOp = new Date(valSelesaiOp).getTime();
                                            const targetDate = new Date(baseDateOp + 4 * 60 * 60 * 1000);
                                            const formattedTarget = formatDateTimeLocal(targetDate);

                                            // Masukkan nilai yang sama ke Minum, Makan, dan Bising Usus
                                            $('#puasaMinum').val(formattedTarget);
                                            $('#puasaMakan').val(formattedTarget);
                                            $('#puasaSampai').val(formattedTarget); // Sesuaikan jika format bising usus berbeda
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</form>