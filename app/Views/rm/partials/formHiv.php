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
        color: #70a9ff;
    }

    /* Membuat kursor pointer saat mengarah ke checkbox dan labelnya */
    .hover-check .form-check-input,
    .hover-check .form-check-label {
        cursor: pointer;
    }
</style>
<form>
    <div class="row">
        <div class="container mt-4">
            <div class="row">

                <!-- KOLOM KIRI (col-6) -->
                <div class="col-sm-6">
                    <div class="alert alert-info" role="alert">

                        <div class="row mb-1">
                            <div class="col-12 text-center">Data Klien :</div>
                            <hr>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Status Kehamilan :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusHamil" id="hamilI" value="Trimester I" <?= (($data->hiv["statusHamil"] ?? '') === "Trimester I") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hamilI">Trim. I</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusHamil" id="hamilII" value="Trimester II" <?= (($data->hiv["statusHamil"] ?? '') === "Trimester II") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hamilII">Trim. II</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusHamil" id="hamilIII" value="Trimester III" <?= (($data->hiv["statusHamil"] ?? '') === "Trimester III") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hamilIII">Trim. III</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusHamil" id="tidakHamil" value="Tidak Hamil" <?= (($data->hiv["statusHamil"] ?? '') === "Tidak Hamil") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tidakHamil">Tdk Hamil</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusHamil" id="hamilTdkTau" value="Tidak Tahu" <?= (($data->hiv["statusHamil"] ?? '') === "Tidak Tahu") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hamilTdkTau">Tdk Tahu</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-6 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0">Umur Anak Terakhir : <small style="font-size:5pt;">(jika Klien Perempuan)</small></label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="umurAnakTerakhir" id="umurAnakTerakhir" style="max-width: 70px;" value="<?= $data->hiv['umurAnakTerakhir'] ?? '' ?>">
                                    <span class="small text-nowrap">Tahun.</span>
                                </div>
                            </div>
                            <div class="col-md-6 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah Anak Kandung :</label>
                                <div class="d-flex align-items-center gap-1">
                                    <input type="text" class="form-control form-control-sm border-info" name="jumlahAnak" id="jumlahAnak" style="max-width: 70px;" value="<?= $data->hiv['jumlahAnak'] ?? '' ?>">
                                    <span class="small text-nowrap">Orang.</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kelompok Risiko :</label>

                                    <div class="form-check mb-0 me-1 d-flex align-items-center gap-2">
                                        <input class="form-check-input mt-0" type="radio" name="kelompokRisiko" id="ps" value="PS" <?= (($data->hiv["kelompokRisiko"] ?? '') === "PS") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="ps">PS</label>

                                        <select name="jenisPs" id="jenisPs" class="form-select form-select-sm w-auto py-0">
                                            <option value="">-- Pilih --</option>
                                            <option value="Langsung" <?= ($data->hiv['jenisPs'] ?? '') === 'Langsung' ? 'selected' : '' ?>>Langsung</option>
                                            <option value="Tidak Langsung" <?= ($data->hiv['jenisPs'] ?? '') === 'Tidak Langsung' ? 'selected' : '' ?>>Tdk Langsung</option>
                                        </select>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="pelangganPs" value="Pelanggan PS" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Pelanggan PS") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pelangganPs">Pelanggan PS</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="waria" value="Waria" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Waria") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="waria">Waria</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="pasanganRisti" value="Pasangan Risti" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Pasangan Risti") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pasanganRisti">Pasangan Risti</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="penasun" value="Penasun" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Penasun") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="penasun">Penasun</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="lainnya" value="Lainnya" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="lainnya">Lainnya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kelompokRisiko" id="gayLsl" value="Gay/LSL" <?= (($data->hiv["kelompokRisiko"] ?? '') === "Gay/LSL") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gayLsl">Gay/LSL</label>
                                    </div>

                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lamanya :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="text" class="form-control form-control-sm border-info py-0" name="lamanya" id="lamanya" style="max-width: 70px;" value="<?= $data->hiv['lamanya'] ?? '' ?>">
                                        <span class="small text-nowrap">Bln/Thn. <small style="font-size:5pt;">Diisi khusus PS dan Penasun.</small></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Status Kunjungan :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusKunjungan" id="sendiri" value="Datang Sendiri" <?= (($data->hiv["statusKunjungan"] ?? '') === "Datang Sendiri") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="sendiri">Datang Sendiri</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusKunjungan" id="dirujuk" value="Dirujuk" <?= (($data->hiv["statusKunjungan"] ?? '') === "Dirujuk") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="dirujuk">Dirujuk</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Status Rujukan :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="tempatKerja" value="Tempat Kerja" <?= (($data->hiv["statusRujuk"] ?? '') === "Tempat Kerja") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tempatKerja">Tempat Kerja</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="klpDukungan" value="Klp Dukungan" <?= (($data->hiv["statusRujuk"] ?? '') === "Klp Dukungan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klpDukungan">Klp Dukungan</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="pasangan" value="Pasangan" <?= (($data->hiv["statusRujuk"] ?? '') === "Pasangan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pasangan">Pasangan</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="kader" value="Kader" <?= (($data->hiv["statusRujuk"] ?? '') === "Kader") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kader">Kader</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="lsm" value="LSM" <?= (($data->hiv["statusRujuk"] ?? '') === "LSM") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="lsm">LSM</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusRujuk" id="lainLain" value="Lain-Lain" <?= (($data->hiv["statusRujuk"] ?? '') === "Lain-Lain") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="lainLain">Lain-lain</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Konseling Pra Tes :</div>
                            <hr>
                        </div>

                        <div class="row">
                            <!-- PROSES DECODE JSON ALASAN TES -->
                            <?php
                            $alasanTes = [];
                            if (!empty($data->hiv['alasanTes'])) {
                                $decodedAlasan = json_decode($data->hiv['alasanTes'], true);
                                $alasanTes = is_array($decodedAlasan) ? $decodedAlasan : [];
                            }
                            ?>
                            <div class="col-sm-6">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Alasan Tes :</p>
                                    <div class="d-flex flex-column gap-1">
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Ingin tahu saja" id="inginTahu" <?= in_array('Ingin tahu saja', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="inginTahu">Ingin tahu saja</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Merasa beresiko" id="merasaBeresiko" <?= in_array('Merasa beresiko', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="merasaBeresiko">Merasa beresiko</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Mumpung gratis" id="mumpungGratis" <?= in_array('Mumpung gratis', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="mumpungGratis">Mumpung gratis</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Hipertensi" id="Hipertensi" <?= in_array('Hipertensi', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Hipertensi">Hipertensi</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Tes ulang (window period)" id="tesUlang" <?= in_array('Tes ulang (window period)', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tesUlang">Tes ulang (window period)</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Untuk bekerja" id="untukBekerja" <?= in_array('Untuk bekerja', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="untukBekerja">Untuk bekerja</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Ada gejala tertentu" id="adaGejala" <?= in_array('Ada gejala tertentu', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="adaGejala">Ada gejala tertentu</label>
                                        </div>
                                        <div class="form-check hover-check">
                                            <input class="form-check-input" type="checkbox" name="alasanTes[]" value="Akan menikah" id="akanMenikah" <?= in_array('Akan menikah', $alasanTes) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="akanMenikah">Akan menikah</label>
                                        </div>
                                        <div class="form-check hover-check pt-1">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="alasanTes[]" value="Lainnya" id="alasanTesLainnya" <?= in_array('Lainnya', $alasanTes) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="alasanTesLainnya">Lainnya:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 120px;" name="isiAlasanTesLainnya" id="isiAlasanTesLainnya" placeholder="sebutkan..." value="<?= $data->hiv['isiAlasanTesLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0">Tgl Konseling Pra Tes HIV :</label>
                                <input type="date" class="form-control form-control-sm border-info" name="tglKonselingPra" id="tglKonselingPra" value="<?= $data->hiv['tglKonselingPra'] ?? '' ?>">

                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center mb-2 mt-2">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Status Klien :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusKlien" id="statusKlienBaru" value="Baru" <?= (($data->hiv["statusKlien"] ?? '') === "Baru") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="statusKlienBaru">Baru</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusKlien" id="statusKlienLama" value="Lama" <?= (($data->hiv["statusKlien"] ?? '') === "Lama") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="statusKlienLama">Lama</label>
                                    </div>
                                </div>

                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 ">Mengetahui Adanya Tes Dari :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="brosur" value="Brosur" <?= (($data->hiv["infoTes"] ?? '') === "Brosur") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="brosur">Brosur</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="koran" value="Koran" <?= (($data->hiv["infoTes"] ?? '') === "Koran") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="koran">Koran</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="tv" value="TV" <?= (($data->hiv["infoTes"] ?? '') === "TV") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tv">TV</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="petugasKesehatan" value="Petugas Kesehatan" <?= (($data->hiv["infoTes"] ?? '') === "Petugas Kesehatan") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="petugasKesehatan">Petugas Kesehatan</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="teman" value="Teman" <?= (($data->hiv["infoTes"] ?? '') === "Teman") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="teman">Teman</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="petugasOutreach" value="Petugas Outreach" <?= (($data->hiv["infoTes"] ?? '') === "Petugas Outreach") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="petugasOutreach">Petugas Outreach</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="poster" value="Poster" <?= (($data->hiv["infoTes"] ?? '') === "Poster") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="poster">Poster</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="layKonselor" value="Lay Konselor" <?= (($data->hiv["infoTes"] ?? '') === "Lay Konselor") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="layKonselor">Lay Konselor</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="infoTes" id="lainLainInfo" value="Lain-Lain" <?= (($data->hiv["infoTes"] ?? '') === "Lain-Lain") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="lainLainInfo">Lain-lain</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Pemberian informasi :</div>
                            <hr>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label for="tglPemberianInfo" class="form-label fw-bold small text-secondary mb-0">Tgl Pemberian Informasi :</label>
                                    <input type="date" class="form-control form-control-sm border-info w-auto" name="tglPemberianInfo" id="tglPemberianInfo" value="<?= $data->hiv['tglPemberianInfo'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pernah tes HIV Sebelumnya :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pernahTes2" id="pernahTesTdk2" value="Tidak" <?= (($data->hiv["pernahTes2"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pernahTesTdk2">Tidak</label>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 p-2" style="background-color: #eaeaea;">
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="pernahTes2" id="pernahTesYa2" value="Ya" <?= (($data->hiv["pernahTes2"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="pernahTesYa2">Ya.</label>
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dimana :</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="text" class="form-control form-control-sm border-info py-0" name="pernahTesDmn2" id="pernahTesDmn2" style="max-width: 120px;" value="<?= $data->hiv['pernahTesDmn2'] ?? '' ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="date" class="form-control form-control-sm border-info py-0" name="pernahTesTgl2" id="pernahTesTgl2" style="max-width: 120px;" value="<?= $data->hiv['pernahTesTgl2'] ?? '' ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0">Hasil :</label>
                                        <select name="hasilTesSebelumnya2" id="hasilTesSebelumnya2" class="form-select form-select-sm w-25">
                                            <option value="">-- Pilih --</option>
                                            <option value="Non Reaktif" <?= ($data->hiv['hasilTesSebelumnya2'] ?? '') === 'Non Reaktif' ? 'selected' : '' ?>>Non Reaktif</option>
                                            <option value="Reaktif" <?= ($data->hiv['hasilTesSebelumnya2'] ?? '') === 'Reaktif' ? 'selected' : '' ?>>Reaktif</option>
                                            <option value="Tidak Diketahui" <?= ($data->hiv['hasilTesSebelumnya2'] ?? '') === 'Tidak Diketahui' ? 'selected' : '' ?>>Tdk Tahu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <!-- PROSES DECODE JSON PENYAKIT -->
                            <?php
                            $penyakit = [];
                            if (!empty($data->hiv['penyakit'])) {
                                $decodedPenyakit = json_decode($data->hiv['penyakit'], true);
                                $penyakit = is_array($decodedPenyakit) ? $decodedPenyakit : [];
                            }
                            ?>
                            <div class="col-sm-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">Penyakit terkait pasien :</p>
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="TB" id="tb" <?= in_array('TB', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tb">TB</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Diare" id="diare" <?= in_array('Diare', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="diare">Diare</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Kandidiasis oralesovagial" id="kandidiasis" <?= in_array('Kandidiasis oralesovagial', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="kandidiasis">Kandidiasis oralesovagial</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Dermatitis" id="dermatitis" <?= in_array('Dermatitis', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="dermatitis">Dermatitis</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="LGV" id="lgv" <?= in_array('LGV', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="lgv">LGV</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="PCP" id="pcp" <?= in_array('PCP', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="pcp">PCP</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Herpes" id="herpes" <?= in_array('Herpes', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="herpes">Herpes</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Tokoplasmosis" id="tokoplasmosis" <?= in_array('Tokoplasmosis', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tokoplasmosis">Tokoplasmosis</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Wasting syndrome" id="wastingSyndrome" <?= in_array('Wasting syndrome', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="wastingSyndrome">Wasting syndrome</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Sifilis" id="sifilis" <?= in_array('Sifilis', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small fw-bold" for="sifilis">Sifilis</label>
                                        </div>
                                        <div class="form-check hover-check pe-2">
                                            <input class="form-check-input" type="checkbox" name="penyakit[]" value="Hepatitis" id="hepatitis" <?= in_array('Hepatitis', $penyakit) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="hepatitis">Hepatitis</label>
                                        </div>
                                        <div class="form-check hover-check pt-1 pe-2">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="penyakit[]" value="IMS lainnya" id="imsLainnya" <?= in_array('IMS lainnya', $penyakit) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="imsLainnya">IMS lainnya:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiImsLainnya" id="isiImsLainnya" placeholder="sebutkan..." value="<?= $data->hiv['isiImsLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                        <div class="form-check hover-check pt-1 pe-2">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="penyakit[]" value="Lainnya" id="penyakitLainnya" <?= in_array('Lainnya', $penyakit) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="penyakitLainnya">Lainnya:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiPenyakitLainnya" id="isiPenyakitLainnya" placeholder="sebutkan..." value="<?= $data->hiv['isiPenyakitLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kesediaan untuk tes :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesediaanTes2" id="kesediaanTesTdk2" value="Tidak" <?= (($data->hiv["kesediaanTes2"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kesediaanTesTdk2">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesediaanTes2" id="kesediaanTesYa2" value="Ya" <?= (($data->hiv["kesediaanTes2"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kesediaanTesYa2">Ya.</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Konseling pasca tes :</div>
                            <hr>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label for="tglKonselingPasca" class="form-label fw-bold small text-secondary mb-0">Tgl konseling pasca tes :</label>
                                    <input type="date" class="form-control form-control-sm border-info w-auto" name="tglKonselingPasca" id="tglKonselingPasca" value="<?= $data->hiv['tglKonselingPasca'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label for="jmlKondom" class="form-label fw-bold small text-secondary mb-0">Jumlah kondom diberikan :</label>
                                    <input type="text" class="form-control form-control-sm border-info w-auto" name="jmlKondom" id="jmlKondom" value="<?= $data->hiv['jmlKondom'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Terima hasil :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="terimaHasil" id="terimaHasilTdk" value="Tidak" <?= (($data->hiv["terimaHasil"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="terimaHasilTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="terimaHasil" id="terimaHasilYa" value="Ya" <?= (($data->hiv["terimaHasil"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="terimaHasilYa">Ya.</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kaji gejala TB :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="gejalaTb" id="gejalaTbTdk" value="Tidak" <?= (($data->hiv["gejalaTb"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gejalaTbTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="gejalaTb" id="gejalaTbYa" value="Ya" <?= (($data->hiv["gejalaTb"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gejalaTbYa">Ya.</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <!-- PROSES DECODE JSON TINDAK LANJUT KTS -->
                            <?php
                            $tindakLanjutKts = [];
                            if (!empty($data->hiv['tindakLanjutKts'])) {
                                $decodedKts = json_decode($data->hiv['tindakLanjutKts'], true);
                                $tindakLanjutKts = is_array($decodedKts) ? $decodedKts : [];
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">TINDAK LANJUT ( KTS ) <span class="fw-normal text-muted">(boleh diisi lebih dari satu)</span> :</p>
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Tes ulang" id="tesUlangKts" <?= in_array('Tes ulang', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tesUlangKts">Tes ulang</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke PDP" id="rujukPdpKts" <?= in_array('Rujuk ke PDP', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukPdpKts">Rujuk ke PDP</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Layanan PTRM" id="rujukPtrm" <?= in_array('Rujuk ke Layanan PTRM', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukPtrm">Rujuk ke Layanan PTRM</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Layanan IMS" id="rujukIms" <?= in_array('Rujuk ke Layanan IMS', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukIms">Rujuk ke Layanan IMS</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke PPIA" id="rujukPpiaKts" <?= in_array('Rujuk ke PPIA', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukPpiaKts">Rujuk ke PPIA</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Rehab" id="rujukRehab" <?= in_array('Rujuk ke Rehab', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukRehab">Rujuk ke Rehab</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Layanan LASS" id="rujukLass" <?= in_array('Rujuk ke Layanan LASS', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukLass">Rujuk ke Layanan LASS</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Layanan TB" id="rujukTb" <?= in_array('Rujuk ke Layanan TB', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukTb">Rujuk ke Layanan TB</label>
                                        </div>
                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke Profesional" id="rujukProfesional" <?= in_array('Rujuk ke Profesional', $tindakLanjutKts) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukProfesional">Rujuk ke Profesional</label>
                                        </div>

                                        <div class="form-check hover-check pt-1 pe-1">
                                            <div class="d-flex align-items-center gap-1">
                                                <input class="form-check-input mt-0" type="checkbox" name="tindakLanjutKts[]" value="Konseling" id="konselingKts" <?= in_array('Konseling', $tindakLanjutKts) ? 'checked' : '' ?>>
                                                <label class="form-check-label small me-1" for="konselingKts">Konseling:</label>
                                                <select name="jenisKonselingKts" id="jenisKonselingKts" class="form-select form-select-sm w-auto py-0">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Pasangan" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Pasangan' ? 'selected' : '' ?>>1. Pasangan</option>
                                                    <option value="Keluarga" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Keluarga' ? 'selected' : '' ?>>2. Keluarga</option>
                                                    <option value="Pencegahan positif" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Pencegahan positif' ? 'selected' : '' ?>>3. Pencegahan positif</option>
                                                    <option value="Kepatuhan minum obat" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Kepatuhan minum obat' ? 'selected' : '' ?>>4. Kepatuhan minum obat</option>
                                                    <option value="Paliatif" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Paliatif' ? 'selected' : '' ?>>5. Paliatif</option>
                                                    <option value="Lain - lain" <?= ($data->hiv['jenisKonselingKts'] ?? '') === 'Lain - lain' ? 'selected' : '' ?>>6. Lain - lain</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-check hover-check pt-1 pe-1">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input mt-0 me-1" type="checkbox" name="tindakLanjutKts[]" value="Rujuk ke petugas pendukung" id="rujukPetugas" <?= in_array('Rujuk ke petugas pendukung', $tindakLanjutKts) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="rujukPetugas">Rujuk ke petugas pendukung:</label>
                                                </div>
                                                <select name="jenisPetugasPendukung" id="jenisPetugasPendukung" class="form-select form-select-sm w-auto py-0 me-1">
                                                    <option value="">-- Pilih --</option>
                                                    <option value="Komunitas" <?= ($data->hiv['jenisPetugasPendukung'] ?? '') === 'Komunitas' ? 'selected' : '' ?>>1. Komunitas</option>
                                                    <option value="LSM" <?= ($data->hiv['jenisPetugasPendukung'] ?? '') === 'LSM' ? 'selected' : '' ?>>2. LSM</option>
                                                    <option value="Kader" <?= ($data->hiv['jenisPetugasPendukung'] ?? '') === 'Kader' ? 'selected' : '' ?>>3. Kader</option>
                                                </select>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px; font-size:7pt;" name="isiLsm" id="isiLsm" placeholder="Nama LSM (khusus pilihan LSM)" value="<?= $data->hiv['isiPetugasLainnya'] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Status layanan :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusLayanan" id="rs" value="Rumah Sakit" <?= (($data->hiv["statusLayanan"] ?? '') === "Rumah Sakit") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="rs">Rumah Sakit</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusLayanan" id="pskms" value="Puskesmas" <?= (($data->hiv["statusLayanan"] ?? '') === "Puskesmas") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pskms">Puskesmas</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusLayanan" id="klinik" value="Klinik" <?= (($data->hiv["statusLayanan"] ?? '') === "Klinik") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="klinik">Klinik</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Jenis layanan :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="jenisLayanan" id="menetap" value="Layanan menetap" <?= (($data->hiv["jenisLayanan"] ?? '') === "Layanan menetap") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="menetap">Layanan menetap</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="jenisLayanan" id="gerak" value="Layanan Bergerak" <?= (($data->hiv["jenisLayanan"] ?? '') === "Layanan Bergerak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gerak">Layanan Bergerak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label for="petugas" class="form-label fw-bold small text-secondary mb-0">Petugas Konselor :</label>
                                    <input type="text" class="form-control form-control-sm w-auto" style="min-width: 250px;" id="petugas" value="<?= $data->icDarah['petugas'] ?? session()->get('nama') ?>" disabled>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- KOLOM KANAN (col-6) -->
                <div class="col-sm-6">
                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Pasangan Klien :</div>
                            <hr>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Klien Punya Pasangan Tetap (jika Perempuan) :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganTetap" id="pastapYa" value="Ya" <?= (($data->hiv["pasanganTetap"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pastapYa">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganTetap" id="pastapTdk" value="Tidak" <?= (($data->hiv["pasanganTetap"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pastapTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Punya Pasangan Perempuan (jika Laki-laki) :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganPerempuan" id="pasperYa" value="Ya" <?= (($data->hiv["pasanganPerempuan"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pasperYa">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganPerempuan" id="pasperTdk" value="Tidak" <?= (($data->hiv["pasanganPerempuan"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pasperTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pasangan Hamil (jika Laki-laki) :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganHamil" id="pashamYa" value="Ya" <?= (($data->hiv["pasanganHamil"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pashamYa">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pasanganHamil" id="pashamTdk" value="Tidak" <?= (($data->hiv["pasanganHamil"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pashamTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-md-4 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0">Tanggal Lahir Pasangan :</label>
                                <input type="date" class="form-control form-control-sm border-info" name="tglLahirPasangan" id="tglLahirPasangan" value="<?= $data->hiv['tglLahirPasangan'] ?? '' ?>">
                            </div>
                            <div class="col-md-5 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0">Tanggal Tes Terakhir Pasangan :</label>
                                <input type="date" class="form-control form-control-sm border-info" name="tglTesPasangan" id="tglTesPasangan" value="<?= $data->hiv['tglTesPasangan'] ?? '' ?>">
                            </div>
                            <div class="col-md-3 mb-2 mb-md-0 d-flex flex-wrap align-items-center gap-2">
                                <label class="form-label fw-bold small text-secondary mb-0">Hasil :</label>
                                <select name="hasilTesPasangan" id="hasilTesPasangan" class="form-select form-select-sm">
                                    <option value="">-- Pilih --</option>
                                    <option value="HIV (+)" <?= ($data->hiv['hasilTesPasangan'] ?? '') === 'HIV (+)' ? 'selected' : '' ?>>HIV (+)</option>
                                    <option value="HIV (-)" <?= ($data->hiv['hasilTesPasangan'] ?? '') === 'HIV (-)' ? 'selected' : '' ?>>HIV (-)</option>
                                    <option value="Tidak Diketahui" <?= ($data->hiv['hasilTesPasangan'] ?? '') === 'Tidak Diketahui' ? 'selected' : '' ?>>Tdk Tahu</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Populasi Khusus :</div>
                            <hr>
                        </div>

                        <div class="row mb-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Klien WBR (Warga Binaan Pemasyarakatan) :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="wbp" id="wbpYa" value="Ya" <?= (($data->hiv["wbp"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="wbpYa">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="wbp" id="wbpTdk" value="Tidak" <?= (($data->hiv["wbp"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="wbpTdk">Tidak</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Kajian tingkat risiko :</div>
                            <hr>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Hubungan Seks Vaginal Berisiko :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hubVag" id="hubVagTdk" value="Tidak" <?= (($data->hiv["hubVag"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hubVagTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hubVag" id="hubVagYa" value="Ya" <?= (($data->hiv["hubVag"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hubVagYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="hubVagTgl" id="hubVagTgl" style="max-width: 120px;" value="<?= $data->hiv['hubVagTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Hubungan Anal Seks Berisiko :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hubAnal" id="hubAnalTdk" value="Tidak" <?= (($data->hiv["hubAnal"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hubAnalTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hubAnal" id="hubAnalYa" value="Ya" <?= (($data->hiv["hubAnal"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hubAnalYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="hubAnalTgl" id="hubAnalTgl" style="max-width: 120px;" value="<?= $data->hiv['hubAnalTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Bergantian peralatan suntik :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="gantianSuntik" id="gantianSuntikTdk" value="Tidak" <?= (($data->hiv["gantianSuntik"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gantianSuntikTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="gantianSuntik" id="gantianSuntikYa" value="Ya" <?= (($data->hiv["gantianSuntik"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="gantianSuntikYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="gantianSuntikTgl" id="gantianSuntikTgl" style="max-width: 120px;" value="<?= $data->hiv['gantianSuntikLog'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Transfusi Darah :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="transfusiDarah" id="transfusiDarahTdk" value="Tidak" <?= (($data->hiv["transfusiDarah"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="transfusiDarahTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="transfusiDarah" id="transfusiDarahYa" value="Ya" <?= (($data->hiv["transfusiDarah"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="transfusiDarahYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="transfusiDarahTgl" id="transfusiDarahTgl" style="max-width: 120px;" value="<?= $data->hiv['transfusiDarahTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Transmisi ibu ke anak :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="transmisiIbu" id="transmisiIbuTdk" value="Tidak" <?= (($data->hiv["transmisiIbu"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="transmisiIbuTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="transmisiIbu" id="transmisiIbuYa" value="Ya" <?= (($data->hiv["transmisiIbu"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="transmisiIbuYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="transmisiIbuTgl" id="transmisiIbuTgl" style="max-width: 120px;" value="<?= $data->hiv['transmisiIbuTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Lainnya (Sebutkan) : </label>
                                    <input type="text" id="isiLainnya" name="isiLainnya" class="form-control form-control-sm w-25" value="<?= $data->hiv['isiLainnya'] ?? '' ?>">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="isiLainnyaTgl" id="isiLainnyaTgl" style="max-width: 120px;" value="<?= $data->hiv['isiLainnyaTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Periode Jendela (window periode) :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="periodeJendela" id="periodeJendelaTdk" value="Tidak" <?= (($data->hiv["periodeJendela"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="periodeJendelaTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="periodeJendela" id="periodeJendelaYa" value="Ya" <?= (($data->hiv["periodeJendela"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="periodeJendelaYa">Ya.</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="date" class="form-control form-control-sm border-info py-0" name="periodeJendelaTgl" id="periodeJendelaTgl" style="max-width: 120px;" value="<?= $data->hiv['periodeJendelaTgl'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kesediaan untuk tes :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesediaanTes" id="kesediaanTesTdk" value="Tidak" <?= (($data->hiv["kesediaanTes"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kesediaanTesTdk">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesediaanTes" id="kesediaanTesYa" value="Ya" <?= (($data->hiv["kesediaanTes"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="kesediaanTesYa">Ya.</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pernah tes HIV Sebelumnya :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="pernahTes" id="pernahTesTdk" value="Tidak" <?= (($data->hiv["pernahTes"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="pernahTesTdk">Tidak</label>
                                    </div>

                                    <div class="d-flex flex-wrap gap-2 p-2" style="background-color: #eaeaea;">
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="pernahTes" id="pernahTesYa" value="Ya" <?= (($data->hiv["pernahTes"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="pernahTesYa">Ya.</label>
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dimana :</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="text" class="form-control form-control-sm border-info py-0" name="pernahTesDmn" id="pernahTesDmn" style="max-width: 120px;" value="<?= $data->hiv['pernahTesDmn'] ?? '' ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kapan :</label>
                                        <div class="d-flex align-items-center gap-1">
                                            <input type="date" class="form-control form-control-sm border-info py-0" name="pernahTesTgl" id="pernahTesTgl" style="max-width: 120px;" value="<?= $data->hiv['pernahTesTgl'] ?? '' ?>">
                                        </div>

                                        <label class="form-label fw-bold small text-secondary mb-0">Hasil :</label>
                                        <select name="hasilTesSebelumnya" id="hasilTesSebelumnya" class="form-select form-select-sm w-25">
                                            <option value="">-- Pilih --</option>
                                            <option value="Non Reaktif" <?= ($data->hiv['hasilTesSebelumnya'] ?? '') === 'Non Reaktif' ? 'selected' : '' ?>>Non Reaktif</option>
                                            <option value="Reaktif" <?= ($data->hiv['hasilTesSebelumnya'] ?? '') === 'Reaktif' ? 'selected' : '' ?>>Reaktif</option>
                                            <option value="Tidak Diketahui" <?= ($data->hiv['hasilTesSebelumnya'] ?? '') === 'Tidak Diketahui' ? 'selected' : '' ?>>Tdk Tahu</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info" role="alert">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Tes Antibodi HIV :</div>
                            <hr>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Tgl Tes HIV :</label>
                                    <input type="date" class="form-control form-control-sm border-info w-auto" name="tglTesHiv" id="tglTesHiv" value="<?= $data->hiv['tglTesHiv'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Jenis Tes HIV :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="jenisTes" id="rapid" value="Rapid Test" <?= (($data->hiv["jenisTes"] ?? '') === "Rapid Test") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="rapid">Rapid</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="jenisTes" id="elisa" value="Elisa" <?= (($data->hiv["jenisTes"] ?? '') === "Elisa") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="elisa">Elisa</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Hasil Tes R1 :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR1" id="hasilTesR1Tdk" value="Non Reaktif" <?= (($data->hiv["hasilTesR1"] ?? '') === "Non Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR1Tdk">Non Reaktif</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR1" id="hasilTesR1Ya" value="Reaktif" <?= (($data->hiv["hasilTesR1"] ?? '') === "Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR1Ya">Reaktif</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nama Reagen :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="text" class="form-control form-control-sm border-info py-0" name="reagenR1" id="reagenR1" style="max-width: 120px;" value="<?= $data->hiv['reagenR1'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Hasil Tes R2 :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR2" id="hasilTesR2Tdk" value="Non Reaktif" <?= (($data->hiv["hasilTesR2"] ?? '') === "Non Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR2Tdk">Non Reaktif</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR2" id="hasilTesR2Ya" value="Reaktif" <?= (($data->hiv["hasilTesR2"] ?? '') === "Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR2Ya">Reaktif</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nama Reagen :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="text" class="form-control form-control-sm border-info py-0" name="reagenR2" id="reagenR2" style="max-width: 120px;" value="<?= $data->hiv['reagenR2'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Hasil Tes R3 :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR3" id="hasilTesR3Tdk" value="Non Reaktif" <?= (($data->hiv["hasilTesR3"] ?? '') === "Non Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR3Tdk">Non Reaktif</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hasilTesR3" id="hasilTesR3Ya" value="Reaktif" <?= (($data->hiv["hasilTesR3"] ?? '') === "Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hasilTesR3Ya">Reaktif</label>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nama Reagen :</label>
                                    <div class="d-flex align-items-center gap-1">
                                        <input type="text" class="form-control form-control-sm border-info py-0" name="reagenR3" id="reagenR3" style="max-width: 120px;" value="<?= $data->hiv['reagenR3'] ?? '' ?>">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kesimpulan Hasil Tes HIV :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulanTes" id="keskesNon" value="Non Reaktif" <?= (($data->hiv["kesimpulanTes"] ?? '') === "Non Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="keskesNon">Non Reaktif</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulanTes" id="keskesReaktif" value="Reaktif" <?= (($data->hiv["kesimpulanTes"] ?? '') === "Reaktif") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="keskesReaktif">Reaktif</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulanTes" id="keskesInter" value="Indeterminate" <?= (($data->hiv["kesimpulanTes"] ?? '') === "Indeterminate") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="keskesInter">Indeterminate</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">No. Reg. Nasional PDP :</label>
                                    <input type="text" name="noPdp" id="noPdp" class="form-control form-control-sm" style="width: 140px;" value="<?= $data->hiv['noPdp'] ?? '' ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Tgl Masuk PDP :</label>
                                    <input type="date" class="form-control form-control-sm border-info w-auto" name="tglPdp" id="tglPdp" value="<?= $data->hiv['tglPdp'] ?? '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <!-- PROSES DECODE JSON TINDAK LANJUT TIPK -->
                            <?php
                            $tindakLanjut = [];
                            if (!empty($data->hiv['tindakLanjut'])) {
                                $decodedTl = json_decode($data->hiv['tindakLanjut'], true);
                                $tindakLanjut = is_array($decodedTl) ? $decodedTl : [];
                            }
                            ?>
                            <div class="col-md-12">
                                <div class="border border-info rounded p-2 h-100">
                                    <p class="form-label fw-bold small text-secondary mb-2">TINDAK LANJUT ( TIPK ) <span class="fw-normal text-muted">(boleh diisi lebih dari satu)</span> :</p>
                                    <div class="d-flex flex-wrap align-items-center gap-1">
                                        <div class="form-check hover-check pt-1 pe-1">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="tindakLanjut[]" value="Rujuk konseling" id="rujukKonseling" <?= in_array('Rujuk konseling', $tindakLanjut) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="rujukKonseling">Rujuk konseling:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiRujukKonseling" id="isiRujukKonseling" placeholder="sebutkan..." value="<?= $data->hiv['isiRujukKonseling'] ?? '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-check hover-check pt-1 pe-1">
                                            <div class="d-flex flex-wrap align-items-center gap-1">
                                                <div class="d-flex align-items-center">
                                                    <input class="form-check-input me-1" type="checkbox" name="tindakLanjut[]" value="Rujuk ke" id="rujukKe" <?= in_array('Rujuk ke', $tindakLanjut) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small me-1" for="rujukKe">Rujuk ke:</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm border-info" style="max-width: 150px;" name="isiRujukKe" id="isiRujukKe" placeholder="sebutkan..." value="<?= $data->hiv['isiRujukKe'] ?? '' ?>">
                                            </div>
                                        </div>

                                        <div class="form-check hover-check pe-1">
                                            <input class="form-check-input" type="checkbox" name="tindakLanjut[]" value="Rujuk ke PDP dan PPIA" id="rujukPdpPpia" <?= in_array('Rujuk ke PDP dan PPIA', $tindakLanjut) ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="rujukPdpPpia">Rujuk ke PDP dan PPIA</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3 mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Bagaimana status HIV pasangan :</label>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hivPasangan" id="hivPasanganTdk" value="HIV (-)" <?= (($data->hiv["hivPasangan"] ?? '') === "HIV (-)") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hivPasanganTdk">HIV (-)</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hivPasangan" id="hivPasanganYa" value="HIV (+)" <?= (($data->hiv["hivPasangan"] ?? '') === "HIV (+)") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hivPasanganYa">HIV (+)</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="hivPasangan" id="hivPasanganTdkTau" value="Tidak Tahu" <?= (($data->hiv["hivPasangan"] ?? '') === "Tidak Tahu") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="hivPasanganTdkTau">Tidak Tau</label>
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