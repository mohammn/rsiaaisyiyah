<?php

/** @var object $data */
$penyakit = !empty($data->lukaOperasi['penyakit']) ? explode('|', $data->lukaOperasi['penyakit']) : [];
$kualifikasi = !empty($data->lukaOperasi['kualifikasi']) ? explode('|', $data->lukaOperasi['kualifikasi']) : [];
$penyakitInfeksi = !empty($data->lukaOperasi['penyakitInfeksi']) ? explode('|', $data->lukaOperasi['penyakitInfeksi']) : [];
$prosedurOperasi = !empty($data->lukaOperasi['prosedurOperasi']) ? explode('|', $data->lukaOperasi['prosedurOperasi']) : [];
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
    <ul class="nav nav-tabs fw-bold justify-content-center" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="preOperasi-tab" data-bs-toggle="tab" data-bs-target="#preOperasi" type="button" role="tab" aria-controls="preOperasi" aria-selected="true">Pre Operasi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link " id="ruangOperasi-tab" data-bs-toggle="tab" data-bs-target="#ruangOperasi" type="button" role="tab" aria-controls="ruangOperasi" aria-selected="false">di Ruang Operasi</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="postOperasi-tab" data-bs-toggle="tab" data-bs-target="#postOperasi" type="button" role="tab" aria-controls="postOperasi" aria-selected="false">Post Operasi</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="preOperasi" role="tabpanel" aria-labelledby="preOperasi-tab">
            <br>
            <div class="row">
                <?php
                // Mengubah string JSON dari database menjadi array PHP agar in_array() berfungsi saat edit
                $penyakit_list = [];
                if (!empty($data->lukaOperasi['penyakit'])) {
                    $decoded = json_decode($data->lukaOperasi['penyakit'], true);
                    $penyakit_list = is_array($decoded) ? $decoded : [];
                }
                ?>

                <div class="col-12 col-md-6">
                    <div class="alert alert-info p-3">

                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="unit" class="form-label fw-bold small text-secondary mb-1">Unit :</label>
                                <input type="text" class="form-control form-control-sm border-info" id="unit" name="unit" value="<?= $data->lukaOperasi['unit'] ?? '' ?>">
                            </div>
                            <div class="col-sm-6">
                                <label for="petugasPreOperasi" class="form-label fw-bold small text-secondary mb-1">Petugas Pre Operasi :</label>
                                <select name="petugasPreOperasi" id="petugasPreOperasi" class="form-select form-select-sm">
                                    <option value="" <?= ($data->lukaOperasi["petugasPreOperasi"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->lukaOperasi["petugasPreOperasi"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>

                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-2 mb-md-0">
                                <label for="tglMrs" class="form-label fw-bold small text-secondary mb-1">Tgl MRS :</label>
                                <input type="date" id="tglMrs" name="tglMrs" class="form-control form-control-sm border-info" value="<?= $data->lukaOperasi['tglMrs'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="tglOperasi" class="form-label fw-bold small text-secondary mb-1">Tgl Ops. :</label>
                                <input type="date" id="tglOperasi" name="tglOperasi" class="form-control form-control-sm border-info" value="<?= $data->lukaOperasi['tglOperasi'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-7 mb-2 mb-md-0">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center h-100">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Suhu Pasien :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="suhuPasien" id="dibawah38" value="< 38" <?= (($data->lukaOperasi["suhuPasien"] ?? '') === "< 38") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="dibawah38">&lt; 38&deg;C</label>
                                    </div>
                                    <div class="form-check me-2 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="suhuPasien" id="diatas38" value="≥ 38" <?= (($data->lukaOperasi["suhuPasien"] ?? '') === "≥ 38") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="diatas38">&ge; 38&deg;C</label>
                                    </div>

                                    <div class="d-flex align-items-center gap-2 ms-sm-auto mt-2 mt-sm-0">
                                        <label class="form-label small mb-0 text-nowrap" for="isiSuhuPasien">Nilai :</label>
                                        <input type="text" class="form-control form-control-sm border-info" name="isiSuhuPasien" id="isiSuhuPasien" style="max-width: 70px;" value="<?= $data->lukaOperasi['isiSuhuPasien'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center h-100">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Merokok :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="merokok" id="merokokYa" value="Ya" <?= (($data->lukaOperasi["merokok"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="merokokYa">Ya</label>
                                    </div>
                                    <div class="form-check me-2 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="merokok" id="merokokTidak" value="Tidak" <?= (($data->lukaOperasi["merokok"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="merokokTidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Screening MRSA :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="mrsa" id="mrsaTdk" value="Tidak" <?= (($data->lukaOperasi["mrsa"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mrsaTdk">Tidak</label>
                                    </div>
                                    <div class="form-check bg-light rounded px-2 py-1 border border-light-subtle d-flex align-items-center gap-2 flex-wrap mb-1 mb-sm-0">
                                        <div>
                                            <input class="form-check-input" type="radio" name="mrsa" id="mrsaYa" value="Ya" <?= (($data->lukaOperasi["mrsa"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small fw-semibold" for="mrsaYa">Ya, Hasil:</label>
                                        </div>
                                        <div class="d-flex flex-wrap gap-2">
                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="hasilMrsa" id="mrsaPositif" value="Positif" <?= (($data->lukaOperasi["hasilMrsa"] ?? '') === "Positif") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-danger fw-bold" for="mrsaPositif">(+) Positif</label>
                                            </div>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="hasilMrsa" id="mrsaNegatif" value="Negatif" <?= (($data->lukaOperasi["hasilMrsa"] ?? '') === "Negatif") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-success fw-bold" for="mrsaNegatif">(-) Negatif</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label for="beratBadan" class="form-label fw-bold small text-secondary mb-0 text-nowrap">Berat Badan :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="beratBadan" id="beratBadan" style="max-width: 70px;" value="<?= $data->lukaOperasi['beratBadan'] ?? '' ?>">
                                    <span class="small text-nowrap">Kg.</span>
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center h-100">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Jenis Ops:</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="jenisOps" id="opsElektif" value="Elektif" <?= (($data->lukaOperasi["jenisOps"] ?? '') === "Elektif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="opsElektif">Elektif</label>
                                    </div>
                                    <div class="form-check me-2 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="jenisOps" id="opsDarurat" value="Darurat" <?= (($data->lukaOperasi["jenisOps"] ?? '') === "Darurat") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="opsDarurat">Darurat</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-7 mb-2 mb-md-0">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center h-100">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Ops Krn Trauma:</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="trauma" id="traumaYa" value="Ya" <?= (($data->lukaOperasi["trauma"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="traumaYa">Ya</label>
                                    </div>
                                    <div class="form-check me-2 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="trauma" id="traumaTdk" value="Tidak" <?= (($data->lukaOperasi["trauma"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="traumaTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex flex-wrap align-items-center gap-2">
                                <label for="albumin" class="form-label fw-bold small text-secondary mb-0 text-nowrap">Albumin :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="albumin" id="albumin" style="max-width: 70px;" value="<?= $data->lukaOperasi['albumin'] ?? '' ?>">
                                    <span class="small text-nowrap">g/dl.</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center gap-2">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-2 text-nowrap">Gula darah :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="gulaDarah" id="dibawah200" value="≤ 200" <?= (($data->lukaOperasi["gulaDarah"] ?? '') === "≤ 200") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="dibawah200">&le; 200 mg/dL</label>
                                    </div>

                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="gulaDarah" id="diatas200" value="> 200" <?= (($data->lukaOperasi["gulaDarah"] ?? '') === "> 200") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="diatas200">&gt; 200 mg/dL</label>
                                    </div>
                                    <div class="d-flex align-items-center gap-2 ms-sm-auto mt-2 mt-sm-0">
                                        <label class="form-label small mb-0 text-nowrap" for="isiGulaDarah">Nilai :</label>
                                        <input type="text" class="form-control form-control-sm border-info" name="isiGulaDarah" id="isiGulaDarah" style="max-width: 70px;" value="<?= $data->lukaOperasi['isiGulaDarah'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 mb-3 mb-md-0">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Penyakit saat ini :</p>
                                    <div class="d-flex flex-column gap-1">

                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="DM" id="DM" <?= in_array('DM', $penyakit_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="DM">DM</label>
                                        </div>

                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="CGK" id="CGK" <?= in_array('CGK', $penyakit_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="CGK">CGK</label>
                                        </div>

                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Sepsis" id="Sepsis" <?= in_array('Sepsis', $penyakit_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Sepsis">Sepsis</label>
                                        </div>

                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Hipertensi" id="Hipertensi" <?= in_array('Hipertensi', $penyakit_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Hipertensi">Hipertensi</label>
                                        </div>

                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Hepatitis" id="Hepatitis" <?= in_array('Hepatitis', $penyakit_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Hepatitis">Hepatitis</label>
                                        </div>

                                        <div class="form-check hover-check pt-1">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="penyakit[]" value="Lainnya" id="penyakitLainnya" <?= in_array('Lainnya', $penyakit_list) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="penyakitLainnya">Lainnya:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 120px;" name="isiPenyakitLainnya" id="isiPenyakitLainnya" placeholder="sebutkan..." value="<?= $data->lukaOperasi['isiPenyakitLainnya'] ?? '' ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="d-flex flex-column gap-2 h-100">

                                    <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Pencukuran :</label>
                                        <div class="form-check me-3 mb-1 mb-sm-0">
                                            <input class="form-check-input" type="radio" name="pencukuran" id="clipper" value="Clipper" <?= (($data->lukaOperasi["pencukuran"] ?? '') === "Clipper") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="clipper">Clipper</label>
                                        </div>
                                        <div class="form-check me-3 mb-1 mb-sm-0">
                                            <input class="form-check-input" type="radio" name="pencukuran" id="silet" value="Silet" <?= (($data->lukaOperasi["pencukuran"] ?? '') === "Silet") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="silet">Silet</label>
                                        </div>
                                        <div class="form-check me-2 mb-1 mb-sm-0">
                                            <input class="form-check-input" type="radio" name="pencukuran" id="tidakDilakukan" value="Tidak dilakukan" <?= (($data->lukaOperasi["pencukuran"] ?? '') === "Tidak dilakukan") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="tidakDilakukan">Tidak dilakukan</label>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap me-2">Waktu Cukur :</label>
                                        <div class="d-flex align-items-center gap-1 small">
                                            <span>Pukul</span>
                                            <input type="time" class="form-control form-control-sm border-info px-1" id="waktuCukur" name="waktuCukur" style="width: 100px;" value="<?= $data->lukaOperasi["waktuPencukuran"] ?? '' ?>">
                                            <span>WIB</span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-column border border-info rounded p-2 flex-grow-1 justify-content-center">
                                        <div class="d-flex flex-wrap align-items-center">
                                            <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Persiapan usus :</label>
                                            <div class="form-check me-3 mb-1 mb-sm-0">
                                                <input class="form-check-input" type="radio" name="persiapanUsus" id="persiapanUsusYa" value="Ya" <?= (($data->lukaOperasi["persiapanUsus"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="persiapanUsusYa">Ya</label>
                                            </div>
                                            <div class="form-check me-2 mb-1 mb-sm-0">
                                                <input class="form-check-input" type="radio" name="persiapanUsus" id="persiapanUsusTdk" value="Tidak" <?= (($data->lukaOperasi["persiapanUsus"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="persiapanUsusTdk">Tidak</label>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-center gap-1 small mt-2">
                                            <span class="text-nowrap">Dengan :</span>
                                            <input type="text" class="form-control form-control-sm border-info" style="max-width: 160px;" id="persiapanUsusDg" name="persiapanUsusDg" placeholder="nama preparat..." value="<?= $data->lukaOperasi["persiapanUsusDg"] ?? '' ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <?php
                // Mengubah string JSON dari database menjadi array PHP untuk Kualifikasi Dokter Bedah
                $kualifikasi_list = [];
                if (!empty($data->lukaOperasi['kualifikasi'])) {
                    $decoded_kualifikasi = json_decode($data->lukaOperasi['kualifikasi'], true);
                    $kualifikasi_list = is_array($decoded_kualifikasi) ? $decoded_kualifikasi : [];
                }

                // Mengubah string JSON dari database menjadi array PHP untuk Penyakit Infeksi Lain
                $infeksi_list = [];
                if (!empty($data->lukaOperasi['penyakitInfeksi'])) {
                    $decoded_infeksi = json_decode($data->lukaOperasi['penyakitInfeksi'], true);
                    $infeksi_list = is_array($decoded_infeksi) ? $decoded_infeksi : [];
                }
                ?>

                <div class="col-12 col-md-6">
                    <div class="alert alert-info p-3" role="alert">

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="diagnosaPre" class="form-label fw-bold small text-secondary mb-1">Diagnosa Pre Operasi :</label>
                                <input type="text" class="form-control form-control-sm border-info" id="diagnosaPre" name="diagnosaPre" value="<?= $data->lukaOperasi['diagnosaPre'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Steroid Jangka Panjang :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="steroid" id="steroidTdk" value="Tidak" <?= (($data->lukaOperasi["steroid"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="steroidTdk">Tidak</label>
                                    </div>
                                    <div class="form-check d-flex align-items-center gap-1 flex-wrap mb-1 mb-sm-0">
                                        <div class="d-flex align-items-center me-1">
                                            <input class="form-check-input me-1" type="radio" name="steroid" id="steroidYa" value="Ya" <?= (($data->lukaOperasi["steroid"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="steroidYa">Ya, nama obat :</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiSteroid" id="isiSteroid" value="<?= $data->lukaOperasi['isiSteroid'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-3 text-nowrap">Mandi sebelum operasi :</label>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="mandi" id="bodywash" value="Chlorhexidine bodywash" <?= (($data->lukaOperasi["mandi"] ?? '') === "Chlorhexidine bodywash") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="bodywash">Chlorhexidine bodywash</label>
                                    </div>
                                    <div class="form-check me-3 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="mandi" id="sabunLain" value="Sabun Lain" <?= (($data->lukaOperasi["mandi"] ?? '') === "Sabun Lain") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="sabunLain">Sabun lain</label>
                                    </div>
                                    <div class="form-check me-2 mb-1 mb-sm-0">
                                        <input class="form-check-input" type="radio" name="mandi" id="mandiTidak" value="Tidak Dilakukan" <?= (($data->lukaOperasi["mandi"] ?? '') === "Tidak Dilakukan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="mandiTidak">Tidak dilakukan</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-5 mb-3 mb-md-0 d-flex flex-column gap-2">
                                <div class="border border-info rounded p-2 flex-grow-1">
                                    <p class="form-label fw-bold small text-secondary mb-2">Kualifikasi Dokter Bedah :</p>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="kualifikasi[]" value="Spesialis" id="Spesialis" <?= in_array('Spesialis', $kualifikasi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Spesialis">Spesialis</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="kualifikasi[]" value="Konsultan" id="Konsultan" <?= in_array('Konsultan', $kualifikasi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Konsultan">Konsultan</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="kualifikasi[]" value="Associate Specialist" id="Associate" <?= in_array('Associate Specialist', $kualifikasi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Associate">Associate Specialist</label>
                                    </div>

                                    <div class="form-check hover-check pt-1">
                                        <div class="d-flex flex-wrap align-items-center gap-1">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input me-1" type="checkbox" name="kualifikasi[]" value="Lainnya" id="kualifikasiLainnya" <?= in_array('Lainnya', $kualifikasi_list) ? 'checked' : '' ?>>
                                                <label class="form-check-label small me-1 text-nowrap" for="kualifikasiLainnya">Lainnya:</label>
                                            </div>
                                            <input type="text" class="form-control form-control-sm border-info" style="max-width: 110px;" name="isiKualifikasiLainnya" id="isiKualifikasiLainnya" placeholder="sebutkan..." value="<?= $data->lukaOperasi['isiKualifikasiLainnya'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-1 mb-sm-0 me-2 text-nowrap">Radioterapi :</label>
                                    <div class="d-flex gap-2">
                                        <div class="form-check me-2">
                                            <input class="form-check-input" type="radio" name="radioterapi" id="radioterapiYa" value="Ya" <?= (($data->lukaOperasi["radioterapi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="radioterapiYa">Ya</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="radioterapi" id="radioterapiTidak" value="Tidak" <?= (($data->lukaOperasi["radioterapi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="radioterapiTidak">Tidak</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Penyakit infeksi lain :</p>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="Kulit" id="Kulit" <?= in_array('Kulit', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Kulit">Kulit</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="Mulut/Gigi" id="MulutGigi" <?= in_array('Mulut/Gigi', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="MulutGigi">Mulut/gigi</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="Mata" id="Mata" <?= in_array('Mata', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Mata">Mata</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="THT" id="Tht" <?= in_array('THT', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Tht">THT</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="GI Tract" id="Gi" <?= in_array('GI Tract', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Gi">GI tract</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="penyakitInfeksi[]" value="Paru" id="Paru" <?= in_array('Paru', $infeksi_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Paru">Paru</label>
                                    </div>

                                    <div class="form-check hover-check pt-1">
                                        <div class="d-flex flex-wrap align-items-center gap-1">
                                            <div class="d-flex align-items-center">
                                                <input class="form-check-input me-1" type="checkbox" name="penyakitInfeksi[]" value="Lainnya" id="penyakitInfeksiLainnya" <?= in_array('Lainnya', $infeksi_list) ? 'checked' : '' ?>>
                                                <label class="form-check-label small me-1 text-nowrap" for="penyakitInfeksiLainnya">Lainnya:</label>
                                            </div>
                                            <input type="text" class="form-control form-control-sm border-info" style="max-width: 130px;" name="isipenyakitInfeksiLainnya" id="isipenyakitInfeksiLainnya" placeholder="sebutkan..." value="<?= $data->lukaOperasi['isipenyakitInfeksiLainnya'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-column border border-info rounded p-2 gap-2">
                                    <label class="form-label fw-bold small text-secondary mb-0">Profilaksis :</label>

                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="radio" name="profilaksis" id="profilaksisTidak" value="Tidak" <?= (($data->lukaOperasi["profilaksis"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="profilaksisTidak">Tidak</label>
                                    </div>

                                    <div class="bg-light rounded p-2 d-flex flex-column gap-2">
                                        <div class="d-flex align-items-center gap-2 flex-wrap">
                                            <div class="form-check mb-0 me-2">
                                                <input class="form-check-input" type="radio" name="profilaksis" id="profilaksisYa" value="Ya" <?= (($data->lukaOperasi["profilaksis"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="profilaksisYa">Ya, Nama Obat : </label>
                                            </div>
                                            <input type="text" name="profilaksisObat" id="profilaksisObat" class="form-control form-control-sm border-info me-2" style="max-width: 120px;" value="<?= $data->lukaOperasi['profilaksisObat'] ?? '' ?>">

                                            <div class="d-flex align-items-center small text-nowrap me-2">
                                                <span class="me-1">Jam:</span>
                                                <input type="time" name="profilaksisJam" id="profilaksisJam" class="form-control form-control-sm border-info" style="max-width: 90px;" value="<?= $data->lukaOperasi['profilaksisJam'] ?? '' ?>">
                                            </div>

                                            <div class="d-flex align-items-center small text-nowrap">
                                                <span class="me-1">Dosis:</span>
                                                <input type="text" name="profilaksisDosis" id="profilaksisDosis" class="form-control form-control-sm border-info" style="max-width: 80px;" value="<?= $data->lukaOperasi['profilaksisDosis'] ?? '' ?>">
                                            </div>
                                        </div>

                                        <div class="d-flex align-items-center gap-3 small text-nowrap ps-sm-4 flex-wrap pt-1 border-top border-light-subtle">
                                            <div class="fw-semibold text-secondary">Skintest :</div>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="skintest" id="skintestTidak" value="Tidak" <?= (($data->lukaOperasi["skintest"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="skintestTidak">Tidak</label>
                                            </div>
                                            <div class="form-check mb-0 d-flex align-items-center gap-1 flex-wrap">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="radio" name="skintest" id="skintestYa" value="Ya" <?= (($data->lukaOperasi["skintest"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap me-1" for="skintestYa">Ya, Hasil :</label>
                                                </div>
                                                <input type="text" name="skintestHasil" id="skintestHasil" class="form-control form-control-sm border-info" style="max-width: 120px; padding: 0.15rem 0.3rem; font-size: 0.75rem;" value="<?= $data->lukaOperasi['skintestHasil'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="ruangOperasi" role="tabpanel" aria-labelledby="ruangOperasi-tab">
            <br>
            <div class="row">
                <?php
                // Mengubah string JSON dari database menjadi array PHP untuk Prosedur Operasi
                $prosedur_list = [];
                if (!empty($data->lukaOperasi['prosedurOperasi'])) {
                    $decoded_prosedur = json_decode($data->lukaOperasi['prosedurOperasi'], true);
                    $prosedur_list = is_array($decoded_prosedur) ? $decoded_prosedur : [];
                }
                ?>

                <div class="col-md-6">
                    <div class="alert alert-info p-3">

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="petugasRuangOperasi" class="form-label fw-bold small text-secondary mb-1">Petugas Operasi :</label>
                                <select name="petugasRuangOperasi" id="petugasRuangOperasi" class="form-select form-select-sm">
                                    <option value="" <?= ($data->lukaOperasi["petugasRuangOperasi"] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    for ($j = 0; $j < count($data->petugas); $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->lukaOperasi["petugasRuangOperasi"] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ruang Operasi :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangOperasi" id="ruang1" value="1" <?= (($data->lukaOperasi["ruangOperasi"] ?? '') === "1") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruang1">1</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangOperasi" id="ruang2" value="2" <?= (($data->lukaOperasi["ruangOperasi"] ?? '') === "2") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruang2">2</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangOperasi" id="ruang3" value="3" <?= (($data->lukaOperasi["ruangOperasi"] ?? '') === "3") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruang3">3</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangOperasi" id="ruang4" value="4" <?= (($data->lukaOperasi["ruangOperasi"] ?? '') === "4") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruang4">4</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ruangOperasi" id="ruang5" value="5" <?= (($data->lukaOperasi["ruangOperasi"] ?? '') === "5") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ruang5">5</label>
                                    </div>

                                    Ronde <input type="text" name="ronde" id="ronde" class="form-control form-control-sm border-info" style="width:40px;" value="<?= $data->lukaOperasi['ronde'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-wrap align-items-center gap-2 mb-2 mb-md-0">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Sirkulasi udara OK :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="sirkulasi" id="sirkulasi" style="max-width: 80px;" value="<?= $data->lukaOperasi['sirkulasi'] ?? '' ?>">
                                    <span class="small text-nowrap">x/jam.</span>
                                </div>
                            </div>

                            <div class="col-md-6 mb-2 mb-md-0">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center w-100">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tekanan udara :</label>
                                    <div class="d-flex gap-2">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="tekananUdara" id="tekananPositif" value="Positif" <?= (($data->lukaOperasi["tekananUdara"] ?? '') === "Positif") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tekananPositif">Positif</label>
                                        </div>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="tekananUdara" id="tekananNegatif" value="Negatif" <?= (($data->lukaOperasi["tekananUdara"] ?? '') === "Negatif") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tekananNegatif">Negatif</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 d-flex flex-wrap align-items-center gap-2 mb-2 mb-md-0">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Suhu R. Ops :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="suhuRuang" id="suhuRuang" style="max-width: 80px;" value="<?= $data->lukaOperasi['suhuRuang'] ?? '' ?>">
                                    <span class="small text-nowrap">&deg;C.</span>
                                </div>
                            </div>

                            <div class="col-md-6 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kelembapan R. Ops :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="kelembapan" id="kelembapan" style="max-width: 80px;" value="<?= $data->lukaOperasi['kelembapan'] ?? '' ?>">
                                    <span class="small text-nowrap">%</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-12 d-flex align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Angka kuman udara ruang operasi :</label>
                                <input type="text" class="form-control form-control-sm border-info" name="angkaKuman" id="angkaKuman" value="<?= $data->lukaOperasi['angkaKuman'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Prosedur Operasi :</p>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="prosedurOperasi[]" value="LSCS" id="lscs" <?= in_array('LSCS', $prosedur_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="lscs">LSCS</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="prosedurOperasi[]" value="Appendictomy" id="appendictomy" <?= in_array('Appendictomy', $prosedur_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="appendictomy">Appendictomy</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="prosedurOperasi[]" value="Explorasi CBD" id="cbd" <?= in_array('Explorasi CBD', $prosedur_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="cbd">Explorasi CBD</label>
                                    </div>

                                    <div class="form-check hover-check mb-1">
                                        <input class="form-check-input" type="checkbox" name="prosedurOperasi[]" value="ORIF" id="orif" <?= in_array('ORIF', $prosedur_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="orif">ORIF</label>
                                    </div>

                                    <div class="form-check hover-check mb-2">
                                        <input class="form-check-input" type="checkbox" name="prosedurOperasi[]" value="Abdominal hysterectomy" id="abdominal" <?= in_array('Abdominal hysterectomy', $prosedur_list) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="abdominal">Abdominal hysterectomy</label>
                                    </div>

                                    <div class="form-check hover-check d-flex flex-wrap gap-2 align-items-center mb-2">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input me-2" type="checkbox" name="prosedurOperasi[]" value="Lainnya" id="prosedurOperasiLainnya" <?= in_array('Lainnya', $prosedur_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap mb-0" for="prosedurOperasiLainnya">Lainnya:</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 180px; min-width: 120px;" name="isiprosedurOperasiLainnya" id="isiprosedurOperasiLainnya" placeholder="sebutkan..." value="<?= $data->lukaOperasi['isiprosedurOperasiLainnya'] ?? '' ?>">
                                    </div>

                                    <div class="form-check hover-check d-flex flex-wrap gap-2 align-items-center">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input me-2" type="checkbox" name="prosedurOperasi[]" value="Lainnya2" id="prosedurOperasiLainnya2" <?= in_array('Lainnya2', $prosedur_list) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap mb-0" for="prosedurOperasiLainnya2">Lainnya:</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm border-info" style="max-width: 180px; min-width: 120px;" name="isiprosedurOperasiLainnya2" id="isiprosedurOperasiLainnya2" placeholder="sebutkan..." value="<?= $data->lukaOperasi['isiprosedurOperasiLainnya2'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-column gap-2 h-100">
                                    <div class="border border-info rounded p-2 d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Multiprosedur dgn insisi yg sama :</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="multiProsedur" id="multiProsedurYa" value="Ya" <?= (($data->lukaOperasi["multiProsedur"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="multiProsedurYa">Ya</label>
                                            </div>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="multiProsedur" id="multiProsedurTdk" value="Tidak" <?= (($data->lukaOperasi["multiProsedur"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="multiProsedurTdk">Tidak</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-2 d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jamur AC ruang operasi :</label>
                                        <div class="d-flex gap-2">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="jamurAc" id="jamurAcPositif" value="Positif" <?= (($data->lukaOperasi["jamurAc"] ?? '') === "Positif") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="jamurAcPositif">Positif</label>
                                            </div>
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="jamurAc" id="jamurAcNegatif" value="Negatif" <?= (($data->lukaOperasi["jamurAc"] ?? '') === "Negatif") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="jamurAcNegatif">Negatif</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-2 d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Drain :</label>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="drain" id="drainTdk" value="Tidak" <?= (($data->lukaOperasi["drain"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="drainTdk">Tidak</label>
                                        </div>
                                        <div class="form-check mb-0 d-flex align-items-center gap-1">
                                            <input class="form-check-input" type="radio" name="drain" id="drainYa" value="Ya" <?= (($data->lukaOperasi["drain"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap mb-0" for="drainYa">Ya, jenis :</label>
                                            <input type="text" name="drainJenis" id="drainJenis" class="form-control form-control-sm border-info" style="max-width: 120px;" value="<?= $data->lukaOperasi['drainJenis'] ?? '' ?>">
                                        </div>
                                    </div>

                                    <div class="border border-info rounded p-2 d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Implant :</label>
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="implant" id="implantTdk" value="Tidak" <?= (($data->lukaOperasi["implant"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="implantTdk">Tidak</label>
                                        </div>
                                        <div class="form-check mb-0 d-flex align-items-center gap-1">
                                            <input class="form-check-input" type="radio" name="implant" id="implantYa" value="Ya" <?= (($data->lukaOperasi["implant"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap mb-0" for="implantYa">Ya, jenis :</label>
                                            <input type="text" name="implantJenis" id="implantJenis" class="form-control form-control-sm border-info" style="max-width: 120px;" value="<?= $data->lukaOperasi['implantJenis'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <div class="alert alert-info">

                        <!-- 1. Sterilisasi Implant -->
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 mb-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Sterilisasi implant di CSSD :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="sterilisasi" id="sterilisasiYa" value="Ya" <?= (($data->lukaOperasi["sterilisasi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sterilisasiYa">Ya</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="sterilisasi" id="sterilisasiTdk" value="Tidak" <?= (($data->lukaOperasi["sterilisasi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sterilisasiTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. ASA Score -->
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">ASA Score :</label>

                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="asaScore" id="asa<?= $i ?>" value="<?= $i ?>" <?= (($data->lukaOperasi["asaScore"] ?? '') == $i) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="asa<?= $i ?>"><?= $i ?></label>
                                        </div>
                                    <?php endfor; ?>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Antibiotik Tambahan -->
                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="border border-info rounded p-2 d-flex flex-column gap-1">
                                    <label class="form-label fw-bold small text-secondary mb-0">Antibiotik tambahan saat Operasi :</label>

                                    <div class="form-check me-0">
                                        <input class="form-check-input" type="radio" name="antibiotik" id="antibiotikTidak" value="Tidak" <?= (($data->lukaOperasi["antibiotik"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="antibiotikTidak">Tidak</label>
                                    </div>

                                    <div class="bg-light rounded p-2 d-flex flex-column gap-2">
                                        <div class="d-flex flex-wrap align-items-center gap-2">
                                            <div class="form-check mb-0">
                                                <input class="form-check-input" type="radio" name="antibiotik" id="antibiotikYa" value="Ya" <?= (($data->lukaOperasi["antibiotik"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small text-nowrap" for="antibiotikYa">Ya, Nama Obat :</label>
                                            </div>

                                            <input type="text" name="antibiotikObat" id="antibiotikObat" class="form-control form-control-sm border-info" style="max-width: 100px;" value="<?= $data->lukaOperasi['antibiotikObat'] ?? '' ?>">

                                            <div class="d-flex align-items-center gap-1 small text-nowrap">
                                                <span>Diberi jam :</span>
                                                <input type="time" name="antibiotikJam" id="antibiotikJam" class="form-control form-control-sm border-info" style="max-width: 80px;" value="<?= $data->lukaOperasi['antibiotikJam'] ?? '' ?>">
                                            </div>

                                            <div class="d-flex align-items-center gap-1 small text-nowrap">
                                                <span>Dosis :</span>
                                                <input type="text" name="antibiotikDosis" id="antibiotikDosis" class="form-control form-control-sm border-info" style="max-width: 80px;" value="<?= $data->lukaOperasi['antibiotikDosis'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. Indikator Instrumen -->
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Indikator instrumen/alat steril :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="indikator" id="indikatorInternal" value="Internal" <?= (($data->lukaOperasi["indikator"] ?? '') === "Internal") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="indikatorInternal">Internal</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="indikator" id="indikatorExternal" value="External" <?= (($data->lukaOperasi["indikator"] ?? '') === "External") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="indikatorExternal">External</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="indikator" id="indikatorTidakAda" value="Tidak Ada" <?= (($data->lukaOperasi["indikator"] ?? '') === "Tidak Ada") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="indikatorTidakAda">Tidak Ada</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 5. Klasifikasi Luka -->
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Klasifikasi Luka :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="klasifikasiLuka" id="klasifikasiLukaBersih" value="Bersih" <?= (($data->lukaOperasi["klasifikasiLuka"] ?? '') === "Bersih") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klasifikasiLukaBersih">Bersih</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="klasifikasiLuka" id="klasifikasiLukaBersihTerkontaminasi" value="Bersih Terkontaminasi" <?= (($data->lukaOperasi["klasifikasiLuka"] ?? '') === "Bersih Terkontaminasi") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klasifikasiLukaBersihTerkontaminasi">Bersih Terkontaminasi</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="klasifikasiLuka" id="klasifikasiLukaTerkontaminasi" value="Terkontaminasi" <?= (($data->lukaOperasi["klasifikasiLuka"] ?? '') === "Terkontaminasi") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klasifikasiLukaTerkontaminasi">Terkontaminasi</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="klasifikasiLuka" id="klasifikasiLukaKotor" value="Kotor" <?= (($data->lukaOperasi["klasifikasiLuka"] ?? '') === "Kotor") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klasifikasiLukaKotor">Kotor</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 6. Jumlah Staff & Jam Ops -->
                        <div class="row mb-2">
                            <div class="col-md-5 mt-1">
                                <div class="d-flex align-items-center gap-1">
                                    <label id="lblJumlahStaff" for="jumlahStaff" class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah Staff :</label>
                                    <input type="number" class="form-control form-control-sm border-info" id="jumlahStaff" name="jumlahStaff" style="max-width: 70px;" value="<?= $data->lukaOperasi['jumlahStaff'] ?? '' ?>">
                                    <span class="small text-nowrap">Org</span>
                                </div>
                            </div>
                            <div class="col-md-7 mt-1">
                                <div class="border border-info rounded p-1">
                                    <div class="d-flex flex-wrap align-items-center gap-2">
                                        <label for="jamMulaiOps" class="form-label fw-bold small text-secondary mb-0 text-nowrap me-1">Ops :</label>

                                        <div class="d-flex align-items-center gap-1 small text-nowrap">
                                            <span>Mulai</span>
                                            <input type="time" class="form-control form-control-sm border-info px-1" id="jamMulaiOps" name="jamMulaiOps" style="width: 75px;" value="<?= $data->lukaOperasi['jamMulaiOps'] ?? '' ?>">
                                        </div>

                                        <div class="d-flex align-items-center gap-1 small text-nowrap ms-sm-2">
                                            <span>Selesai</span>
                                            <input type="time" class="form-control form-control-sm border-info px-1" id="jamSelesaiOps" name="jamSelesaiOps" style="width: 75px;" value="<?= $data->lukaOperasi['jamSelesaiOps'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 7. Disinfeksi Kulit -->
                        <div class="row mb-2">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Disinfeksi kulit :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="disinfeksiKulit" id="disinfeksiKulitChlorhexidine" value="Chlorhexidine" <?= (($data->lukaOperasi["disinfeksiKulit"] ?? '') === "Chlorhexidine") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="disinfeksiKulitChlorhexidine">Chlorhexidine</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="disinfeksiKulit" id="disinfeksiKulitPovidone" value="Povidone iodine" <?= (($data->lukaOperasi["disinfeksiKulit"] ?? '') === "Povidone iodine") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="disinfeksiKulitPovidone">Povidone iodine</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="disinfeksiKulit" id="disinfeksiKulitAlkohol70" value="Alkohol 70%" <?= (($data->lukaOperasi["disinfeksiKulit"] ?? '') === "Alkohol 70%") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="disinfeksiKulitAlkohol70">Alkohol 70%</label>
                                    </div>
                                    <div class="form-check mb-0 d-flex align-items-center gap-1">
                                        <input class="form-check-input" type="radio" name="disinfeksiKulit" id="disinfeksiKulitLainnya" value="Lainnya" <?= (($data->lukaOperasi["disinfeksiKulit"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small me-1 mb-0" for="disinfeksiKulitLainnya">Lainnya:</label>
                                        <input type="text" id="isiDisinfeksiKulitLainnya" name="isiDisinfeksiKulitLainnya" class="form-control form-control-sm border-info" style="max-width: 120px;" value="<?= $data->lukaOperasi['isiDisinfeksiKulitLainnya'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 8. Diagnosa Post Operasi -->
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="diagnosaPost" class="form-label fw-bold small text-secondary mb-1">Diagnosa Post Operasi :</label>
                                <input type="text" class="form-control form-control-sm border-info" id="diagnosaPost" name="diagnosaPost" value="<?= $data->lukaOperasi['diagnosaPost'] ?? '' ?>">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="postOperasi" role="tabpanel" aria-labelledby="postOperasi-tab">
            <br>
            <!-- Keluarkan tag style dari dalam table -->
            <style>
                .no-spin::-webkit-outer-spin-button,
                .no-spin::-webkit-inner-spin-button {
                    -webkit-appearance: none;
                    margin: 0;
                }
            </style>

            <?php
            $tgl = $data->lukaOperasi['tgl'] ?? [];
            if (is_string($tgl)) {
                $tgl = json_decode($tgl, true) ?? explode(',', $tgl);
            }


            // --- 1. CHECKBOX TINDAKAN PER HARI ---
            $rawatLuka = $data->lukaOperasi['rawatLuka'] ?? [];
            if (is_string($rawatLuka)) {
                $rawatLuka = json_decode($rawatLuka, true) ?? explode(',', $rawatLuka);
            }

            $transparan = $data->lukaOperasi['transparan'] ?? [];
            if (is_string($transparan)) {
                $transparan = json_decode($transparan, true) ?? explode(',', $transparan);
            }

            $thypafix = $data->lukaOperasi['thypafix'] ?? [];
            if (is_string($thypafix)) {
                $thypafix = json_decode($thypafix, true) ?? explode(',', $thypafix);
            }

            // Sesuai koreksi: Menggunakan key 'drain'
            $drain = $data->lukaOperasi['drainTindakan'] ?? [];
            if (is_string($drain)) {
                $drain = json_decode($drain, true) ?? explode(',', $drain);
            }

            $aff = $data->lukaOperasi['aff'] ?? [];
            if (is_string($aff)) {
                $aff = json_decode($aff, true) ?? explode(',', $aff);
            }

            $angkat = $data->lukaOperasi['angkat'] ?? [];
            if (is_string($angkat)) {
                $angkat = json_decode($angkat, true) ?? explode(',', $angkat);
            }

            // Sesuai koreksi: Menggunakan key 'antibiotik'
            $antibiotik = $data->lukaOperasi['antibiotikTindakan'] ?? [];
            if (is_string($antibiotik)) {
                $antibiotik = json_decode($antibiotik, true) ?? explode(',', $antibiotik);
            }

            $krs = $data->lukaOperasi['krs'] ?? [];
            if (is_string($krs)) {
                $krs = json_decode($krs, true) ?? explode(',', $krs);
            }

            $kontrol = $data->lukaOperasi['kontrol'] ?? [];
            if (is_string($kontrol)) {
                $kontrol = json_decode($kontrol, true) ?? explode(',', $kontrol);
            }

            $mrs = $data->lukaOperasi['mrs'] ?? [];
            if (is_string($mrs)) {
                $mrs = json_decode($mrs, true) ?? explode(',', $mrs);
            }


            // --- 2. CHECKBOX IDENTIFIKASI ILO PER HARI ---
            $nyeri = $data->lukaOperasi['nyeri'] ?? [];
            if (is_string($nyeri)) {
                $nyeri = json_decode($nyeri, true) ?? explode(',', $nyeri);
            }

            $demam = $data->lukaOperasi['demam'] ?? [];
            if (is_string($demam)) {
                $demam = json_decode($demam, true) ?? explode(',', $demam);
            }

            $kemerahan = $data->lukaOperasi['kemerahan'] ?? [];
            if (is_string($kemerahan)) {
                $kemerahan = json_decode($kemerahan, true) ?? explode(',', $kemerahan);
            }

            $drainase = $data->lukaOperasi['drainase'] ?? [];
            if (is_string($drainase)) {
                $drainase = json_decode($drainase, true) ?? explode(',', $drainase);
            }

            $bengkak = $data->lukaOperasi['bengkak'] ?? [];
            if (is_string($bengkak)) {
                $bengkak = json_decode($bengkak, true) ?? explode(',', $bengkak);
            }

            $kuman = $data->lukaOperasi['kuman'] ?? [];
            if (is_string($kuman)) {
                $kuman = json_decode($kuman, true) ?? explode(',', $kuman);
            }

            $ada = $data->lukaOperasi['ada'] ?? [];
            if (is_string($ada)) {
                $ada = json_decode($ada, true) ?? explode(',', $ada);
            }

            $diagnosa = $data->lukaOperasi['diagnosa'] ?? [];
            if (is_string($diagnosa)) {
                $diagnosa = json_decode($diagnosa, true) ?? explode(',', $diagnosa);
            }
            ?>

            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th colspan="11" class="text-center">
                            Beri Tanda (√) Sesuai Tindakan dan Gejala.
                        </th>
                        <th rowspan="2" class="text-center align-middle">
                            Ket.
                        </th>
                    </tr>
                    <tr>
                        <th>Post Ops Hari ke-</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle"><?= $i ?></td>
                        <?php endfor; ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Tanggal</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle">
                                <input type="date"
                                    name="tgl[]"
                                    id="tgl<?= $i ?>"
                                    class="form-control form-control-sm border-info text-center p-0 no-spin"
                                    style="width: 50px; font-size: 0.5rem;" aria-label="Tgl Kolom <?= $i ?>"
                                    value="<?= $tgl[$i - 1] ?? '' ?>">
                            </td>
                        <?php endfor; ?>
                        <td></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Rwt Luka</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="rawatLuka[]" id="rawatLuka<?= $i ?>" aria-label="Rawat Luka Kolom <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $rawatLuka) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketRawatLuka" id="ketRawatLuka" value="<?= $data->lukaOperasi['ketRawatLuka'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Dressing : Transparan</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="transparan[]" id="transparan<?= $i ?>" aria-label="Dressing transparan <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $transparan) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketTransparan" id="ketTransparan" value="<?= $data->lukaOperasi['ketTransparan'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Dressing : Thypafix</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="thypafix[]" id="thypafix<?= $i ?>" aria-label="Dressing thypafix <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $thypafix) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketThypafix" id="ketThypafix" value="<?= $data->lukaOperasi['ketThypafix'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">
                            Buang cairan/membuka drain
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="buangCairan" id="buangCairanTertutup" value="Tertutup" <?= (($data->lukaOperasi["buangCairan"] ?? '') === "Tertutup") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="buangCairanTertutup">Tertutup</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="buangCairan" id="buangCairanTerbuka" value="Terbuka" <?= (($data->lukaOperasi["buangCairan"] ?? '') === "Terbuka") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="buangCairanTerbuka">Terbuka</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="buangCairan" id="buangCairanTdk" value="Tidak ada" <?= (($data->lukaOperasi["buangCairan"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="buangCairanTdk">Tidak ada</label>
                            </div>
                        </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="drainTindakan[]" id="drainTindakan<?= $i ?>" aria-label="Buang Cairan <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $drain) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketDrain" id="ketDrain" value="<?= $data->lukaOperasi['ketDrain'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Aff drain, oleh
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="affDrain" id="affDrainDokter" value="Dokter" <?= (($data->lukaOperasi["affDrain"] ?? '') === "Dokter") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="affDrainDokter">Dokter</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="affDrain" id="affDrainPerawat" value="Perawat" <?= (($data->lukaOperasi["affDrain"] ?? '') === "Perawat") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="affDrainPerawat">Perawat</label>
                            </div>
                            <div class="form-check mb-0 me-1">
                                <input class="form-check-input" type="radio" name="affDrain" id="affDrainTdk" value="Tidak ada" <?= (($data->lukaOperasi["affDrain"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                <label class="form-check-label small" for="affDrainTdk">Tidak ada</label>
                            </div>
                        </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="aff[]" id="aff<?= $i ?>" aria-label="aff Drain <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $aff) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketAff" id="ketAff" value="<?= $data->lukaOperasi['ketAff'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Angkat Jahitan</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="angkat[]" id="angkat<?= $i ?>" aria-label="angkat <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $angkat) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketAngkat" id="ketAngkat" value="<?= $data->lukaOperasi['ketAngkat'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Antibiotik <input type="text" name="isiAntibiotik" id="isiAntibiotik" value="<?= $data->lukaOperasi['isiAntibiotik'] ?? '' ?>" class="form-control form-control-sm"> </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="antibiotikTindakan[]" id="antibiotikTindakan<?= $i ?>" aria-label="antibiotik <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $antibiotik) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketAntibiotik" id="ketAntibiotik" value="<?= $data->lukaOperasi['ketAntibiotik'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">KRS. Kontrol Tgl
                            <input type="date" name="tglKrs" id="tglKrs" class="form-control form-control-sm border-info text-end p-0 no-spin" style="font-size: 0.7rem;" value="<?= $data->lukaOperasi['tglKrs'] ?? '' ?>">
                        </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="krs[]" id="krs<?= $i ?>" aria-label="krs <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $krs) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketKrs" id="ketKrs" value="<?= $data->lukaOperasi['ketKrs'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kontrol Poli
                            <input type="date" name="tglKontrol" id="tglKontrol" class="form-control form-control-sm border-info text-end p-0 no-spin" style="font-size: 0.7rem;" value="<?= $data->lukaOperasi['tglKontrol'] ?? '' ?>">
                        </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="kontrol[]" id="kontrol<?= $i ?>" aria-label="kontrol <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $kontrol) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketKontrol" id="ketKontrol" value="<?= $data->lukaOperasi['ketKontrol'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">MRS ulang
                            <input type="date" name="tglMrsTindakan" id="tglMrsTindakan" class="form-control form-control-sm border-info text-end p-0 no-spin" style="font-size: 0.7rem;" value="<?= $data->lukaOperasi['tglMrsTindakan'] ?? '' ?>">
                        </th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="mrs[]" id="mrs<?= $i ?>" aria-label="mrs <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $mrs) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketMrs" id="ketMrs" value="<?= $data->lukaOperasi['ketMrs'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>
                    <tr>
                        <th colspan="33" class="text-center align-middle bg-warning bg-opacity-25 text-dark small fw-bold text-uppercase" style="letter-spacing: 0.5px;">
                            IDENTIFIKASI ILO
                        </th>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Nyeri lokal dan sakit</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="nyeri[]" id="nyeri<?= $i ?>" aria-label="nyeri <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $nyeri) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketNyeri" id="ketNyeri" value="<?= $data->lukaOperasi['ketNyeri'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Demam (&ge; 38&deg;C)</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="demam[]" id="demam<?= $i ?>" aria-label="demam <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $demam) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketDemam" id="ketDemam" value="<?= $data->lukaOperasi['ketDemam'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kemerahan</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="kemerahan[]" id="kemerahan<?= $i ?>" aria-label="kemerahan <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $kemerahan) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketKemerahan" id="ketKemerahan" value="<?= $data->lukaOperasi['ketKemerahan'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Drainase purulen / pus</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="drainase[]" id="drainase<?= $i ?>" aria-label="drainase <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $drainase) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketDrainase" id="ketDrainase" value="<?= $data->lukaOperasi['ketDrainase'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Bengkak terlokalisir</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="bengkak[]" id="bengkak<?= $i ?>" aria-label="bengkak <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $bengkak) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketBengkak" id="ketBengkak" value="<?= $data->lukaOperasi['ketBengkak'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kuman pada kultur pus</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="kuman[]" id="kuman<?= $i ?>" aria-label="kuman <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $kuman) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketKuman" id="ketKuman" value="<?= $data->lukaOperasi['ketKuman'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Ada abses saat re-operasai /pemeriksaan radiologi/PA</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="ada[]" id="ada<?= $i ?>" aria-label="ada <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $ada) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketAda" id="ketAda" value="<?= $data->lukaOperasi['ketAda'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Diagnosa Dokter : SSI</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-2">
                                <div class="form-check hover-check d-inline-block m-0 p-0">
                                    <input class="form-check-input m-0"
                                        type="checkbox"
                                        name="diagnosa[]" id="diagnosa<?= $i ?>" aria-label="diagnosa <?= $i ?>"
                                        value="<?= $i ?>" <?= in_array($i, $diagnosa) ? 'checked' : '' ?>>
                                </div>
                            </td>
                        <?php endfor; ?>
                        <td>
                            <input type="text" name="ketDiagnosa" id="ketDiagnosa" value="<?= $data->lukaOperasi['ketDiagnosa'] ?? '' ?>" class="form-control form-control-sm" style="width: 80px;font-size: 0.6rem;">
                        </td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Nama Petugas</th>
                        <?php for ($i = 1; $i <= 10; $i++): ?>
                            <td class="text-center align-middle p-1">
                                <select name="petugas<?= $i ?>"
                                    id="petugas<?= $i ?>"
                                    class="form-select form-select-sm text-center appearance-none border-info p-1"
                                    style="width: 60px; font-size: 0.6rem; background: none !important; padding-right: 0.25rem !important;"
                                    aria-label="Petugas Kolom <?= $i ?>">
                                    <option value="" <?= ($data->lukaOperasi["petugas" . $i] ?? '') === '' ? 'selected' : '' ?>>Pilih</option>
                                    <?php
                                    $jumlah_petugas = isset($data->petugas) ? count($data->petugas) : 0;
                                    for ($j = 0; $j < $jumlah_petugas; $j++) {
                                        $nama_petugas = $data->petugas[$j]["nama"];
                                        $selected = ($nama_petugas === ($data->lukaOperasi["petugas" . $i] ?? '')) ? 'selected' : '';
                                        echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                    }
                                    ?>
                                </select>
                            </td>
                        <?php endfor; ?>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="33" class="text-center fw-bold bg-light text-dark small">
                            BILA TERJADI INFEKSI, Beri tanda √ pada kotak yang sesuai
                        </td>
                    </tr>

                    <tr>
                        <td colspan="33" class="p-3">
                            <div class="row align-items-center row-gap-3">
                                <div class="col-12 col-lg-4 border-end border-light">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jenis lokasi infeksi :</label>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisLokasi" id="superfisial" value="Superfisial" <?= (($data->lukaOperasi["jenisLokasi"] ?? '') === "Superfisial") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="superfisial">Superfisial</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisLokasi" id="organRongga" value="Organ Rongga" <?= (($data->lukaOperasi["jenisLokasi"] ?? '') === "Organ Rongga") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="organRongga">Organ Rongga</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisLokasi" id="dalamFascia" value="Dalam (Fascia/otot)" <?= (($data->lukaOperasi["jenisLokasi"] ?? '') === "Dalam (Fascia/otot)") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="dalamFascia">Dalam (Fascia/otot)</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisLokasi" id="jenisLokasiTidak" value="Tidak ada" <?= (($data->lukaOperasi["jenisLokasi"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="jenisLokasiTidak">Tidak ada</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 col-lg-8">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lokasi Spesifik Untuk Infeksi Organ / Rongga :</label>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="gastrointestinal" value="Sal Gastrointestinal" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Sal Gastrointestinal") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="gastrointestinal">Sal Gastrointestinal</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="genital" value="Sal genital perempuan" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Sal genital perempuan") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="genital">Sal genital perempuan</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="Intra-Abdominal" value="Intra-Abdominal" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Intra-Abdominal") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Intra-Abdominal">Intra-Abdominal</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="endokardium" value="Endokardium" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Endokardium") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="endokardium">Endokardium</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="sendi" value="Sendi / Bursa" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Sendi / Bursa") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="sendi">Sendi / Bursa</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="peri" value="Peri/miokardium" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Peri/miokardium") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="peri">Peri/miokardium</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="vaginal" value="Vaginal Cuff" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "Vaginal Cuff") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="vaginal">Vaginal Cuff</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="lokasiSpesifik" id="lokasiSpesifikLainnya" value="lainnya" <?= (($data->lukaOperasi["lokasiSpesifik"] ?? '') === "lainnya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="lokasiSpesifikLainnya">Lainnya
                                                <input type="text" id="isiLokasiSpesifikLainnya" name="isiLokasiSpesifikLainnya" value="<?= $data->lukaOperasi['isiLokasiSpesifikLainnya'] ?? '' ?>" class="form-control form-control-sm d-inline-block ms-1" style="width: 100px;">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</form>