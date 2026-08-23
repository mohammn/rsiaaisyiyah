<?php

/** @var object $data */
// dd($data->resepPulang);
?>
<form>
    <div class="row">
        <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                <div class="col-12 text-center">Data Umum :</div>
                <hr>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Asal Rujukan :</label>
                        <input type="text" class="form-control mb-2" id="asal" value="<?= $data->rm26jRujukanLuar['asal'] ?? '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Alasan dirujuk :</label>
                        <input type="text" class="form-control mb-2" id="alasan" value="<?= $data->rm26jRujukanLuar['alasan'] ?? '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Keadaan Umum :</label>
                        <input type="text" class="form-control mb-2" id="keadaan" value="<?= $data->rm26jRujukanLuar['keadaan'] ?? '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kesadaran :</label>
                        <input type="text" class="form-control mb-2" id="kesadaran" value="<?= $data->rm26jRujukanLuar['kesadaran'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Terapi :</label>
                        <input type="text" class="form-control mb-2" id="terapi" value="<?= $data->rm26jRujukanLuar['terapi'] ?? '' ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tindakan :</label>
                        <input type="text" class="form-control mb-2" id="tindakan" value="<?= $data->rm26jRujukanLuar['tindakan'] ?? '' ?>">

                    </div>
                </div>

                <div class="row mt-2">
                    <!-- PROSES DECODE JSON HAND OVER -->
                    <?php
                    $handOver = [];
                    if (!empty($data->rm26jRujukanLuar['handOver'])) {
                        $decodedHandOver = json_decode($data->rm26jRujukanLuar['handOver'], true);
                        $handOver = is_array($decodedHandOver) ? $decodedHandOver : [];
                    }
                    ?>
                    <div class="col-md-12">

                        <div class="border border-info rounded p-2">
                            <p class="form-label fw-bold small text-secondary mb-1">Handover :</p>
                            <div class="row g-1">

                                <!-- Baris 1: USG & Laboratorium -->
                                <div class="col-6 col-md-4">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="checkbox" name="handOver[]" value="USG" id="handOverUSG" <?= in_array('USG', $handOver) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="handOverUSG">USG</label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-8">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="checkbox" name="handOver[]" value="Laboratorium" id="handOverLaboratorium" <?= in_array('Laboratorium', $handOver) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="handOverLaboratorium">Laboratorium</label>
                                    </div>
                                </div>

                                <!-- Baris 2: Buku KIA & Lain-Lain -->
                                <div class="col-6 col-md-4">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="checkbox" name="handOver[]" value="Buku KIA" id="handOverBukuKIA" <?= in_array('Buku KIA', $handOver) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="handOverBukuKIA">Buku KIA</label>
                                    </div>
                                </div>

                                <div class="col-6 col-md-8">
                                    <div class="form-check hover-check d-flex align-items-center gap-1">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="handOver[]" value="Lain-Lain" id="handOverLainLain" <?= in_array('Lain-Lain', $handOver) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="handOverLainLain">Lain-Lain</label>
                                        </div>
                                        <input type="text" name="isiHandOverLainLain" id="isiHandOverLainLain" class="form-control form-control-sm border-info" style="max-width: 250px;" value="<?= $data->rm26jRujukanLuar['isiHandOverLainLain'] ?? '' ?>">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-1">
                    <div class="col-12">
                        <div class="border border-info rounded p-2">
                            <!-- Label Judul -->
                            <label class="form-label fw-bold small text-secondary mb-2">Keterangan (Diisi Bidan Penerima)</label>

                            <!-- Pilihan TERIMA / TOLAK -->
                            <div class="d-flex align-items-center gap-4 mb-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="keteranganBidan" id="keteranganTerima" value="Terima" <?= (($data->rm26jRujukanLuar["keteranganBidan"] ?? '') === "Terima") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="keteranganTerima">Terima</label>
                                </div>
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="keteranganBidan" id="keteranganTolak" value="Tolak" <?= (($data->rm26jRujukanLuar["keteranganBidan"] ?? '') === "Tolak") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="keteranganTolak">Tolak</label>
                                </div>
                            </div>

                            <!-- Input Alasan -->
                            <div class="d-flex align-items-center gap-2">
                                <label for="alasanKeterangan" class="form-label small fw-bold mb-0 text-nowrap">Alasan :</label>
                                <input type="text" class="form-control form-control-sm border-info" name="alasanKeterangan" id="alasanKeterangan" value="<?= $data->rm26jRujukanLuar['alasanKeterangan'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

        <div class="col-md-6">
            <div class="alert alert-info" role="alert">
                <div class="col-12 text-center">Data Vital :</div>
                <hr>

                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosaa :</label>
                <textarea name="diagnosa" id="diagnosa" class="form-control  mb-2"><?= $data->rm26jRujukanLuar['diagnosa'] ?? '' ?></textarea>

                <div class="border border-info rounded p-1">
                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanda-tanda Vital :</label>
                    <div class="container">
                        <!-- Baris 1: T & N -->
                        <div class="row g-2 mb-1">
                            <!-- T (Tekanan Darah) -->
                            <div class="col-md-6">
                                <label for="td_sistol" class="form-label fw-bold small mb-1">T :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="td_sistol" name="td_sistol" class="form-control form-control-sm" placeholder="Sistol" value="<?= $data->rm26jRujukanLuar['td_sistol'] ?? '' ?>">
                                    <span class="input-group-text">/</span>
                                    <input type="number" id="td_diastol" name="td_diastol" class="form-control form-control-sm" placeholder="Diastol" value="<?= $data->rm26jRujukanLuar['td_diastol'] ?? '' ?>">
                                    <span class="input-group-text">mmHg</span>
                                </div>
                            </div>

                            <!-- N (Nadi) -->
                            <div class="col-md-6">
                                <label for="nadi" class="form-label fw-bold small mb-1">N :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="nadi" name="nadi" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['nadi'] ?? '' ?>">
                                    <span class="input-group-text">x/m</span>
                                </div>
                            </div>
                        </div>

                        <!-- Baris 2: S & Rr -->
                        <div class="row g-2 mb-1">
                            <!-- S (Suhu) -->
                            <div class="col-md-6">
                                <label for="suhu" class="form-label fw-bold small mb-1">S :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="suhu" name="suhu" step="0.1" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['suhu'] ?? '' ?>">
                                    <span class="input-group-text">°C</span>
                                </div>
                            </div>

                            <!-- Rr (Respirasi) -->
                            <div class="col-md-6">
                                <label for="rr" class="form-label fw-bold small mb-1">Rr :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="rr" name="rr" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['rr'] ?? '' ?>">
                                    <span class="input-group-text">x/m</span>
                                </div>
                            </div>
                        </div>

                        <!-- Baris 3: TFU & DJJ -->
                        <div class="row g-2 mb-1">
                            <!-- TFU -->
                            <div class="col-md-6">
                                <label for="tfu" class="form-label fw-bold small mb-1">TFU :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="tfu" name="tfu" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['tfu'] ?? '' ?>">
                                    <span class="input-group-text">cm</span>
                                </div>
                            </div>

                            <!-- DJJ -->
                            <div class="col-md-6">
                                <label for="djj" class="form-label fw-bold small mb-1">DJJ :</label>
                                <div class="input-group input-group-sm">
                                    <input type="number" id="djj" name="djj" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['djj'] ?? '' ?>">
                                    <span class="input-group-text">x/m</span>
                                </div>
                            </div>
                        </div>

                        <!-- Baris 4: His & VT -->
                        <div class="row g-1">
                            <!-- His -->
                            <div class="col-md-6">
                                <label for="his" class="form-label fw-bold small mb-1">His :</label>
                                <input type="text" id="his" name="his" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['his'] ?? '' ?>">
                            </div>

                            <!-- VT -->
                            <div class="col-md-6">
                                <label for="vt" class="form-label fw-bold small mb-1">VT :</label>
                                <input type="text" id="vt" name="vt" class="form-control form-control-sm" value="<?= $data->rm26jRujukanLuar['vt'] ?? '' ?>">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bidan Penerima :</label>
                        <input type="text" class="form-control mb-2" id="petugas" value="<?= $data->rm26jRujukanLuar['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pengirim :</label>
                        <input type="text" class="form-control" id="nama" value="<?= $data->rm26jRujukanLuar['nama'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>