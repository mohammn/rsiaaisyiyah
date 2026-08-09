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
                        <div class="col-12 text-center fw-bold">1. Anamnesa :</div>
                        <hr>
                    </div>
                    <mark>Yang bertanda tangan di bawah ini :</mark>
                    <div class="row mb-3 mt-2">
                        <div class="col-6">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $data->rm11a1Bedah['nama'] ?? '' ?>">
                        </div>
                        <div class="col-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                                <label class="form-check-label small" for="samaDgPasien">Sama dg pasien</label>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                                <label class="form-check-label small" for="samaDgPj">Sama dg PJ</label>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                <label class="form-label fw-bold small text-secondary mb-0">Tempat pengkajian :</label>
                                <div class="form-check mb-0 me-1">
                                    <input class="form-check-input" type="radio" name="tempatPengkajian" id="tempatPengkajianIgd" value="Instalasi Gawat Darurat / Kamar Bersalin" <?= (($data->rm11a1Bedah["tempatPengkajian"] ?? '') === "Instalasi Gawat Darurat / Kamar Bersalin") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="tempatPengkajianIgd">Instalasi Gawat Darurat / Kamar Bersalin</label>
                                </div>
                                <div class="form-check mb-0 me-1">
                                    <input class="form-check-input" type="radio" name="tempatPengkajian" id="tempatPengkajianRi" value="Unit Rawat Inap : Ruang Perawatan / HCU" <?= (($data->rm11a1Bedah["tempatPengkajian"] ?? '') === "Unit Rawat Inap : Ruang Perawatan / HCU") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="tempatPengkajianRi">Unit Rawat Inap : Ruang Perawatan / HCU</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-0">Keluhan Utama :</label>
                            <textarea name="keluhan" id="keluhan" class="form-control"><?= $data->rm11a1Bedah['keluhan'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <!-- PROSES DECODE JSON RIWAYAT PENYAKIT -->
                        <?php
                        $riwayatPenyakit = [];
                        if (!empty($data->rm11a1Bedah['riwayatPenyakit'])) {
                            $decodeRiwayat = json_decode($data->rm11a1Bedah['riwayatPenyakit'], true);
                            $riwayatPenyakit = is_array($decodeRiwayat) ? $decodeRiwayat : [];
                        }
                        ?>
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Riwayat Penyakit :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="riwayatPenyakit[]" value="Hipertensi" id="riwHipertensi" <?= in_array('Hipertensi', $riwayatPenyakit) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="riwHipertensi">Hipertensi</label>
                                    </div>

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="riwayatPenyakit[]" value="Diabetes" id="riwDiabetes" <?= in_array('Diabetes', $riwayatPenyakit) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="riwDiabetes">Diabetes</label>
                                    </div>

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="checkbox" name="riwayatPenyakit[]" value="Hepatitis" id="riwHepatitis" <?= in_array('Hepatitis', $riwayatPenyakit) ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="riwHepatitis">Hepatitis</label>
                                    </div>

                                    <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="checkbox" name="riwayatPenyakit[]" value="Lainnya" id="riwLainnya" <?= in_array('Lainnya', $riwayatPenyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="riwLainnya">Lainnya :</label>
                                        </div>
                                        <input type="text" name="isiRiwayatLainnya" id="isiRiwayatLainnya" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a1Bedah['isiRiwayatLainnya'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="border border-info rounded p-1">
                                <label class="form-label fw-bold small text-secondary mb-0">Riwayat Operasi :</label>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label class="form-label small text-secondary mb-0">Jenis Operasi :</label>
                                        <input type="text" id="jenisOperasi" name="jenisOperasi" class="form-control form-control-sm" value="<?= $data->rm11a1Bedah['jenisOperasi'] ?? '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label small text-secondary mb-0 mt-1">Dimana :</label>
                                        <input type="text" id="lokasiOperasi" name="lokasiOperasi" class="form-control form-control-sm" value="<?= $data->rm11a1Bedah['lokasiOperasi'] ?? '' ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label class="form-label small text-secondary mb-0 mt-1">Kapan :</label>
                                        <input type="date" id="tglOperasi" name="tglOperasi" class="form-control form-control-sm" value="<?= $data->rm11a1Bedah['tglOperasi'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Riwayat Alergi :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="radio" name="riwayatAlergi" value="Tidak Ada" id="alergiTidakAda" <?= ($data->rm11a1Bedah['riwayatAlergi'] ?? '') === 'Tidak Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="alergiTidakAda">Tidak Ada</label>
                                    </div>

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="radio" name="riwayatAlergi" value="Tidak Diketahui" id="alergiTidakDiketahui" <?= ($data->rm11a1Bedah['riwayatAlergi'] ?? '') === 'Tidak Diketahui' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="alergiTidakDiketahui">Tidak Diketahui</label>
                                    </div>

                                    <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="radio" name="riwayatAlergi" value="Ada" id="alergiAda" <?= ($data->rm11a1Bedah['riwayatAlergi'] ?? '') === 'Ada' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="alergiAda">Ada, sebutkan :</label>
                                        </div>
                                        <input type="text" name="isiAlergi" id="isiAlergi" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a1Bedah['isiAlergi'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">2. Pemeriksaan Fisik :</div>
                        <hr>
                    </div>

                    <!-- Baris 1: TD & Berat Badan -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">TD :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="td" name="td" class="form-control" value="<?= $data->rm11a1Bedah['td'] ?? '' ?>">
                                <span class="input-group-text">mmHg</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">Berat Badan :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="beratBadan" name="beratBadan" class="form-control" value="<?= $data->rm11a1Bedah['beratBadan'] ?? '' ?>">
                                <span class="input-group-text">Kg</span>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 2: Nadi & Tinggi Badan -->
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">Nadi :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="nadi" name="nadi" class="form-control" value="<?= $data->rm11a1Bedah['nadi'] ?? '' ?>">
                                <span class="input-group-text">x/mnt</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">Tinggi Badan :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="tinggiBadan" name="tinggiBadan" class="form-control" value="<?= $data->rm11a1Bedah['tinggiBadan'] ?? '' ?>">
                                <span class="input-group-text">Cm</span>
                            </div>
                        </div>
                    </div>

                    <!-- Baris 3: Suhu & Pernafasan -->
                    <div class="row">
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">Suhu :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="suhu" name="suhu" class="form-control" value="<?= $data->rm11a1Bedah['suhu'] ?? '' ?>">
                                <span class="input-group-text">°C</span>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label fw-bold small text-secondary mb-1">Pernafasan :</label>
                            <div class="input-group input-group-sm">
                                <input type="text" id="pernafasan" name="pernafasan" class="form-control" value="<?= $data->rm11a1Bedah['pernafasan'] ?? '' ?>">
                                <span class="input-group-text">x/mnt</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">3. Hasil Pemeriksaan Penunjang <i>(Diisi dengan hasil terbaru)</i> :</div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-1">Laboratorium :</label>
                            <textarea name="laboratorium" id="laboratorium" class="form-control"><?= $data->rm11a1Bedah['laboratorium'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-1">Radiologi :</label>
                            <textarea name="radiologi" id="radiologi" class="form-control"><?= $data->rm11a1Bedah['radiologi'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-1">Lainnya :</label>
                            <textarea name="penunjangLainnya" id="penunjangLainnya" class="form-control"><?= $data->rm11a1Bedah['penunjangLainnya'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                <label class="form-label fw-bold small text-secondary mb-0">Apakah sudah melakukan rekonsiliasi terhadap obat yang sedang digunakan saat ini :</label>
                                <div class="form-check mb-0 me-1">
                                    <input class="form-check-input" type="radio" name="rekonsiliasi" id="rekonsiliasiSudah" value="Sudah" <?= (($data->rm11a1Bedah["rekonsiliasi"] ?? '') === "Sudah") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rekonsiliasiSudah">Sudah</label>
                                </div>
                                <div class="form-check mb-0 me-1">
                                    <input class="form-check-input" type="radio" name="rekonsiliasi" id="rekonsiliasiBelum" value="Belum" <?= (($data->rm11a1Bedah["rekonsiliasi"] ?? '') === "Belum") ? 'checked' : '' ?>>
                                    <label class="form-check-label small" for="rekonsiliasiBelum">Belum</label>
                                </div>
                                <label class="form-label small text-secondary mb-0"><i>(Lakukan verifikasi dengan melihat catatan obat yang masih digunakan pasien dalam pengkajian keperawatan)</i></label>
                            </div>
                        </div>
                    </div>

                </div>

            </div>

            <!-- =========== KANAN =============== -->
            <div class="col-md-6">

                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">4. Diagnosa / Asesmen :</div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-1">Diagnosa Preoperatif / Tindakan Infasif :</label>
                            <textarea name="diagnosaPreoperatif" id="diagnosaPreoperatif" class="form-control"><?= $data->rm11a1Bedah['diagnosaPreoperatif'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Diagnosa Lain :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="radio" name="diagnosaLain" value="Tidak Ada" id="diagnosaLainTidakAda" <?= ($data->rm11a1Bedah['diagnosaLain'] ?? '') === 'Tidak Ada' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="diagnosaLainTidakAda">Tidak Ada</label>
                                    </div>

                                    <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="radio" name="diagnosaLain" value="Ada" id="diagnosaLainAda" <?= ($data->rm11a1Bedah['diagnosaLain'] ?? '') === 'Ada' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="diagnosaLainAda">Ada, sebutkan :</label>
                                        </div>
                                        <input type="text" name="isidiagnosaLain" id="isidiagnosaLain" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a1Bedah['isidiagnosaLain'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info">
                    <div class="row mb-1">
                        <div class="col-12 text-center fw-bold">5. Rencana Tatalaksana :</div>
                        <hr>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <label class="form-label fw-bold small text-secondary mb-1">Rencana Operasi / Tindakan :</label>
                            <textarea name="rencanaOperasi" id="rencanaOperasi" class="form-control"><?= $data->rm11a1Bedah['rencanaOperasi'] ?? '' ?></textarea>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Sifat Prosedur :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">

                                    <div class="form-check hover-check pe-1">
                                        <input class="form-check-input" type="radio" name="sifatProsedur" value="Cito" id="sifatProsedurCito" <?= ($data->rm11a1Bedah['sifatProsedur'] ?? '') === 'Cito' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sifatProsedurCito">Cito</label>
                                    </div>

                                    <div class="form-check hover-check pe-1 d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="radio" name="sifatProsedur" value="Elektif Hari/Tanggal" id="sifatProsedurElektif" <?= ($data->rm11a1Bedah['sifatProsedur'] ?? '') === 'Elektif Hari/Tanggal' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="sifatProsedurElektif">Elektif Hari/Tanggal :</label>
                                        </div>
                                        <input type="date" name="isiElektif" id="isiElektif" class="form-control form-control-sm border-info" style="max-width: 150px;" value="<?= $data->rm11a1Bedah['isiElektif'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <p class="form-label fw-bold small text-secondary mb-0">Perikiraan Lama Tindakan :</p>
                            <div class="row align-items-center">
                                <div class="col-sm-6">
                                    <input type="text" name="lamaTindakan" id="lamaTindakan" class="form-control form-control-sm" value="<?= $data->rm11a1Bedah['lamaTindakan'] ?? '' ?>">
                                </div>
                                <div class="col-sm-6">
                                    <p class="form-label small text-secondary mb-0"><b>Menit/jam</b> diisi manual.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- d. Anestesia -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Anestesia :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="anestesia" value="Lokal" id="anestesiaLokal" <?= ($data->rm11a1Bedah['anestesia'] ?? '') === 'Lokal' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="anestesiaLokal">Lokal</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="anestesia" value="Konsul Pendampingan Anestesi" id="anestesiaPendampingan" <?= ($data->rm11a1Bedah['anestesia'] ?? '') === 'Konsul Pendampingan Anestesi' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="anestesiaPendampingan">Konsul Pendampingan Anestesi</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="anestesia" value="Konsul Pembiusan" id="anestesiaPembiusan" <?= ($data->rm11a1Bedah['anestesia'] ?? '') === 'Konsul Pembiusan' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="anestesiaPembiusan">Konsul Pembiusan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- e. Puasa -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Puasa :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="puasa" value="Tidak Perlu" id="puasaTidakPerlu" <?= ($data->rm11a1Bedah['puasa'] ?? '') === 'Tidak Perlu' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="puasaTidakPerlu">Tidak Perlu</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="puasa" value="Sesuai Rencana Anestesi" id="puasaSesuaiRencana" <?= ($data->rm11a1Bedah['puasa'] ?? '') === 'Sesuai Rencana Anestesi' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="puasaSesuaiRencana">Sesuai Rencana Anestesi</label>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-1">
                                        <div>
                                            <input class="form-check-input" type="radio" name="puasa" value="Mulai Jam" id="puasaMulaiJam" <?= ($data->rm11a1Bedah['puasa'] ?? '') === 'Mulai Jam' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="puasaMulaiJam">Mulai Jam :</label>
                                        </div>
                                        <input type="time" name="isiMulaiJam" id="isiMulaiJam" class="form-control form-control-sm border-info" style="max-width: 130px;" value="<?= $data->rm11a1Bedah['isiMulaiJam'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- f. Konsultasi Bagian Terkait -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Konsultasi Bagian Terkait :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="konsultasiBagian" value="Tidak Perlu" id="konsultasiTidakPerlu" <?= ($data->rm11a1Bedah['konsultasiBagian'] ?? '') === 'Tidak Perlu' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="konsultasiTidakPerlu">Tidak Perlu</label>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center gap-1">
                                        <div>
                                            <input class="form-check-input" type="radio" name="konsultasiBagian" value="Ya" id="konsultasiYa" <?= ($data->rm11a1Bedah['konsultasiBagian'] ?? '') === 'Ya' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="konsultasiYa">Ya :</label>
                                        </div>
                                        <input type="text" name="isiKonsultasi" id="isiKonsultasi" class="form-control form-control-sm border-info" style="max-width: 250px;" value="<?= $data->rm11a1Bedah['isiKonsultasi'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- g. Peralatan Yang Digunakan -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Peralatan Yang Digunakan :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="peralatan" value="Tidak Perlu" id="peralatanTidakPerlu" <?= ($data->rm11a1Bedah['peralatan'] ?? '') === 'Tidak Perlu' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="peralatanTidakPerlu">Tidak Perlu</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="peralatan" value="Laparoskopi" id="peralatanLaparoskopi" <?= ($data->rm11a1Bedah['peralatan'] ?? '') === 'Laparoskopi' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="peralatanLaparoskopi">Laparoskopi</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="peralatan" value="Mikroskop" id="peralatanMikroskop" <?= ($data->rm11a1Bedah['peralatan'] ?? '') === 'Mikroskop' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="peralatanMikroskop">Mikroskop</label>
                                    </div>
                                    <div class="form-check hover-check d-flex align-items-center">
                                        <div>
                                            <input class="form-check-input" type="radio" name="peralatan" value="Lain-Lain" id="peralatanLain" <?= ($data->rm11a1Bedah['peralatan'] ?? '') === 'Lain-Lain' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="peralatanLain">Lain - Lain :</label>
                                        </div>
                                        <input type="text" name="isiPeralatanLain" id="isiPeralatanLain" class="form-control form-control-sm border-info" style="max-width: 200px;" value="<?= $data->rm11a1Bedah['isiPeralatanLain'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- h. Pengosongan Kandung Kemih -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Pengosongan Kandung Kemih :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="pengosonganKemih" value="Ya" id="pengosonganYa" <?= ($data->rm11a1Bedah['pengosonganKemih'] ?? '') === 'Ya' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pengosonganYa">Ya</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="pengosonganKemih" value="Tidak" id="pengosonganTidak" <?= ($data->rm11a1Bedah['pengosonganKemih'] ?? '') === 'Tidak' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pengosonganTidak">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- i. Infus -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Infus :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="infus" value="Tidak Perlu" id="infusTidakPerlu" <?= ($data->rm11a1Bedah['infus'] ?? '') === 'Tidak Perlu' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="infusTidakPerlu">Tidak Perlu</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="infus" value="Dikamar Operasi/Tindakan" id="infusKamarOperasi" <?= ($data->rm11a1Bedah['infus'] ?? '') === 'Dikamar Operasi/Tindakan' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="infusKamarOperasi">Dikamar Operasi/Tindakan</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="infus" value="IVFD" id="infusIVFD" <?= ($data->rm11a1Bedah['infus'] ?? '') === 'IVFD' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="infusIVFD">IVFD</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- j. Persiapan Darah -->
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <div class="border border-info rounded p-1">
                                <p class="form-label fw-bold small text-secondary mb-0">Persiapan Darah :</p>
                                <div class="d-flex flex-wrap align-items-center mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="persiapanDarah" value="Tidak Perlu" id="darahTidakPerlu" <?= ($data->rm11a1Bedah['persiapanDarah'] ?? '') === 'Tidak Perlu' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="darahTidakPerlu">Tidak Perlu</label>
                                    </div>

                                    <div class="form-check hover-check d-flex align-items-center gap-1">
                                        <input class="form-check-input" type="radio" name="persiapanDarah" value="Whole Blood" id="darahWB" <?= ($data->rm11a1Bedah['persiapanDarah'] ?? '') === 'Whole Blood' ? 'checked' : '' ?>>
                                        <label class="form-check-label small fst-italic text-nowrap" for="darahWB">Whole Blood</label>
                                        <div class="input-group input-group-sm ms-1" style="max-width: 130px;">
                                            <input type="text" name="isiWholeBlood" id="isiWholeBlood" class="form-control border-info" value="<?= $data->rm11a1Bedah['isiWholeBlood'] ?? '' ?>">
                                            <span class="input-group-text">Ml</span>
                                        </div>
                                    </div>

                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="persiapanDarah" value="TC" id="darahTC" <?= ($data->rm11a1Bedah['persiapanDarah'] ?? '') === 'TC' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="darahTC">TC</label>
                                    </div>

                                    <div class="form-check hover-check d-flex align-items-center gap-1">
                                        <input class="form-check-input" type="radio" name="persiapanDarah" value="Packed Red Cells" id="darahPRC" <?= ($data->rm11a1Bedah['persiapanDarah'] ?? '') === 'Packed Red Cells' ? 'checked' : '' ?>>
                                        <label class="form-check-label small fst-italic text-nowrap" for="darahPRC">Packed Red Cells</label>
                                        <div class="input-group input-group-sm ms-1" style="max-width: 130px;">
                                            <input type="text" name="isiPackedRed" id="isiPackedRed" class="form-control border-info" value="<?= $data->rm11a1Bedah['isiPackedRed'] ?? '' ?>">
                                            <span class="input-group-text">Ml</span>
                                        </div>
                                    </div>

                                    <div class="form-check hover-check d-flex align-items-center gap-2">
                                        <div>
                                            <input class="form-check-input" type="radio" name="persiapanDarah" value="Komponen Lain" id="darahKomponenLain" <?= ($data->rm11a1Bedah['persiapanDarah'] ?? '') === 'Komponen Lain' ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="darahKomponenLain">Komponen Lain :</label>
                                        </div>
                                        <input type="text" name="isiKomponenLain" id="isiKomponenLain" class="form-control form-control-sm border-info" style="max-width: 200px;" value="<?= $data->rm11a1Bedah['isiKomponenLain'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- k. Rencana Post Operasi & Catatan/Dokter -->
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <div class="border border-info rounded p-1 h-100">
                                <p class="form-label fw-bold small text-secondary mb-0">Rencana Post Operasi :</p>
                                <div class="d-flex flex-column mt-2">
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="rencanaPostOp" value="Ruang Rawat Intensif (NICU/ PICU/ HCU)" id="postOpIntensif" <?= ($data->rm11a1Bedah['rencanaPostOp'] ?? '') === 'Ruang Rawat Intensif (NICU/ PICU/ HCU)' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="postOpIntensif">Ruang Rawat Intensif (NICU/ PICU/ HCU)</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="rencanaPostOp" value="Ruang Perawatan Biasa" id="postOpBiasa" <?= ($data->rm11a1Bedah['rencanaPostOp'] ?? '') === 'Ruang Perawatan Biasa' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="postOpBiasa">Ruang Perawatan Biasa</label>
                                    </div>
                                    <div class="form-check hover-check">
                                        <input class="form-check-input" type="radio" name="rencanaPostOp" value="Pulang" id="postOpPulang" <?= ($data->rm11a1Bedah['rencanaPostOp'] ?? '') === 'Pulang' ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="postOpPulang">Pulang</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="border rounded p-2 bg-light">
                                <p class="form-label fw-bold small text-secondary mb-0">Catatan :</p>
                                <textarea name="catatan" id="catatan" class="form-control form-control-sm mb-2" rows="3"><?= $data->rm11a1Bedah['catatan'] ?? '' ?></textarea>

                                <p class="form-label fw-bold small text-secondary mb-0">Dokter :</p>
                                <select name="dokter" id="dokter" class="form-select form-select-sm">
                                    <option value="" <?= (empty($data->rm11a1Bedah['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                        $selected = (($data->rm11a1Bedah['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
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