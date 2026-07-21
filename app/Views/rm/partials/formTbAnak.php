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

    .tooltip-container {
        position: relative;
        display: inline-block;
    }

    /* Tombol agar cursor berubah menjadi pointer */
    .tooltip-container button {
        cursor: pointer;
        border: none;
        outline: none;
    }

    /* Styling Kotak Tooltip */
    .tooltip-container .tooltip-text {
        visibility: hidden;
        width: 240px;
        background-color: #2c3e50;
        /* Warna gelap yang elegan */
        color: #fff;
        text-align: left;
        border-radius: 8px;
        padding: 12px;
        position: absolute;
        z-index: 99;
        bottom: 125%;
        /* Memunculkan tooltip di atas tombol */
        left: 50%;
        transform: translateX(-50%);
        opacity: 0;
        transition: opacity 0.3s, visibility 0.3s;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        font-family: sans-serif;
        font-size: 13px;
        line-height: 1.5;
    }

    /* Mengatur list di dalam tooltip agar rapi */
    .tooltip-container .tooltip-text ul {
        margin: 5px 0 0 0;
        padding-left: 15px;
    }

    .tooltip-container .tooltip-text li {
        margin-bottom: 3px;
    }

    /* Efek Panah Kecil di Bawah Kotak Tooltip */
    .tooltip-container .tooltip-text::after {
        content: "";
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -5px;
        border-width: 5px;
        border-style: solid;
        border-color: #2c3e50 transparent transparent transparent;
    }

    /* Aksi saat Kursor di atas Tombol atau Container */
    .tooltip-container:hover .tooltip-text {
        visibility: visible;
        opacity: 1;
    }
</style>
<form>
    <div class="row">
        <div class="container mt-4">

            <div class="row">
                <div class="col-sm-6">
                    <!-- ==================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Pemeriksaan Berat Badan dan Tinggi Badan :</div>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <!-- Berat Badan -->
                            <div class="col-sm-6 mb-2 mb-sm-0">
                                <label for="beratBadan" class="form-label fw-bold small text-secondary mb-1 text-nowrap">Berat Badan :</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" class="form-control" id="beratBadan" name="beratBadan" value="<?= $data->tbAnak['beratBadan'] ?? '' ?>" placeholder="0">
                                    <span class="input-group-text bg-light text-secondary fw-semibold">Kg</span>
                                </div>
                            </div>

                            <!-- Tinggi Badan -->
                            <div class="col-sm-6">
                                <label for="tinggiBadan" class="form-label fw-bold small text-secondary mb-1 text-nowrap">Tinggi Badan :</label>
                                <div class="input-group">
                                    <input type="number" step="0.1" class="form-control" id="tinggiBadan" name="tinggiBadan" value="<?= $data->tbAnak['tinggiBadan'] ?? '' ?>" placeholder="0">
                                    <span class="input-group-text bg-light text-secondary fw-semibold">Cm</span>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12">
                                <div class="d-flex flex-wrap gap-2 border border-info rounded p-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Hasil Status Gizi

                                        <div class="tooltip-container" id="tool5Kurang">
                                            <button type="button" class="btn-estetik btn-sm-estetik bg-vibrant-blue" aria-label="Informasi Hasil Skrining Gejala">
                                                <i class="fas fa-info"></i>
                                            </button>
                                            <div class="tooltip-text">
                                                <ul style="margin-left: 0px;">
                                                    <li>
                                                        &lt;2 tahun menggunakan <br> perhitungan BB/PB <br> dilihat berdasarkan <br>tabel z-score <br>
                                                    </li>
                                                    <li>
                                                        2-5 tahun menggunakan <br> perhitungan BB/TB <br> dilihat berdasarkan <br>tabel z-score
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tooltip-container" id="tool5Lebih">
                                            <button type="button" class="btn-estetik btn-sm-estetik bg-vibrant-blue" aria-label="Informasi Hasil Skrining Gejala">
                                                <i class="fas fa-info"></i>
                                            </button>
                                            <div class="tooltip-text">
                                                5-15 tahun menggunakan <br> perhitungan IMT/U dilihat <br> berdasarkan tabel z-score
                                            </div>
                                        </div>


                                        :
                                    </label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="giziBuruk" value="Gizi buruk" <?= (($data->tbAnak["statusGizi"] ?? '') === "Gizi buruk") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="giziBuruk">Gizi buruk</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="giziKurang" value="Gizi kurang" <?= (($data->tbAnak["statusGizi"] ?? '') === "Gizi kurang") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="giziKurang">Gizi kurang</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="giziBaik" value="Gizi baik" <?= (($data->tbAnak["statusGizi"] ?? '') === "Gizi baik") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="giziBaik">Gizi baik</label>
                                    </div>

                                    <div class="form-check mb-0 me-1" id="berisikoGiziLebih">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="berisikoLebih" value="Berisiko gizi lebih" <?= (($data->tbAnak["statusGizi"] ?? '') === "Berisiko gizi lebih") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="berisikoLebih">Berisiko gizi lebih</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="giziLebih" value="Gizi lebih" <?= (($data->tbAnak["statusGizi"] ?? '') === "Gizi lebih") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="giziLebih">Gizi lebih</label>
                                    </div>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="statusGizi" id="obesitas" value="Obesitas" <?= (($data->tbAnak["statusGizi"] ?? '') === "Obesitas") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="obesitas">Obesitas</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ==================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Pemeriksaan Riwayat Kontak TBC :</div>
                            <hr>
                        </div>
                        <div class="mt-2 border border-info rounded p-2 align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">Apakah ada kontak dg pasien TBC ?</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="kontakTbc" id="tdkTau" value="Tidak Diketahui" <?= (($data->tbAnak["kontakTbc"] ?? '') === "Tidak Diketahui") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tdkTau">Tidak Diketahui</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="kontakTbc" id="tdk" value="Tidak" <?= (($data->tbAnak["kontakTbc"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tdk">Tidak</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="kontakTbc" id="Ya" value="Ya" <?= (($data->tbAnak["kontakTbc"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Ya">Ya</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <br>
                            <label class="form-label fw-bold small text-secondary mb-0">Jika <b>Ya</b> (ada kontak), isi dibawah ini :</label>
                            <hr>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">Jenis kontak TBC :</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisKontak" id="Serumah" value="Kontak Serumah" <?= (($data->tbAnak["jenisKontak"] ?? '') === "Kontak Serumah") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Serumah">Kontak Serumah</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisKontak" id="erat" value="Kontak Erat" <?= (($data->tbAnak["jenisKontak"] ?? '') === "Kontak Erat") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="erat">Kontak Erat</label>
                                        </div>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="jenisKontak" id="kontakLainnya" value="Lainnya" <?= (($data->tbAnak["jenisKontak"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="kontakLainnya">
                                                Lainnya :
                                            </label>
                                            <!-- PERBAIKAN: Menambahkan set value durasiBatuk -->
                                            <input type="text" id="isiJenisKontakLainnya" name="isiJenisKontakLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->tbAnak['isiJenisKontakLainnya'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <label class="form-label fw-bold small text-secondary mb-0">Nama kasus Indeks TBC :</label>
                                    <!-- PERBAIKAN: value diubah dari jenisKontak menjadi indeksTbc -->
                                    <input type="text" class="form-control form-control-sm" name="indeksTbc" id="indeksTbc" value="<?= $data->tbAnak["indeksTbc"] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-sm-12">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">jenis TBC yang diderita oleh kasus indeks :</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisTbc" id="tbcBakteriologis" value="TBC Paru Bakteriologis" <?= (($data->tbAnak["jenisTbc"] ?? '') === "TBC Paru Bakteriologis") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tbcBakteriologis">TBC Paru Bakteriologis</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisTbc" id="tbcKlinis" value="TBC Klinis" <?= (($data->tbAnak["jenisTbc"] ?? '') === "TBC Klinis") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tbcKlinis">TBC Klinis</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisTbc" id="tbcEkstraParu" value="TBC Ekstra Paru" <?= (($data->tbAnak["jenisTbc"] ?? '') === "TBC Ekstra Paru") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tbcEkstraParu">TBC Ekstra Paru</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="jenisTbc" id="tidakDiketahui" value="Tidak Diketahui" <?= (($data->tbAnak["jenisTbc"] ?? '') === "Tidak Diketahui") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tidakDiketahui">Tidak Diketahui</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <!-- ==================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Faktor Risiko :</div>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pernah terdiagnoses/berobat TBC ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="berobatTbc" id="tdkBerobatTbc" value="Tidak" <?= (($data->tbAnak["berobatTbc"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkBerobatTbc">Tidak</label>
                                    </div>

                                    <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                        <input class="form-check-input mt-0" type="radio" name="berobatTbc" id="yaBerobatTbc" value="Ya" <?= (($data->tbAnak["berobatTbc"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="yaBerobatTbc">
                                            Ya, Kapan ?
                                        </label>
                                        <!-- PERBAIKAN: Menambahkan set value tanggal -->
                                        <input type="date" id="tglBerobatTbc" name="tglBerobatTbc" class="form-control form-control-sm" style="width: auto;" value="<?= $data->tbAnak['tglBerobatTbc'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pernah berobat TBC tapi tidak tuntas ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="berobatTbcTakTuntas" id="yaBerobatTbcTdkTuntas" value="Ya" <?= (($data->tbAnak["berobatTbcTakTuntas"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaBerobatTbcTdkTuntas">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="berobatTbcTakTuntas" id="tdkBerobatTbcTdkTuntas" value="Tidak" <?= (($data->tbAnak["berobatTbcTakTuntas"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkBerobatTbcTdkTuntas">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kekurangan Gizi ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <!-- PERBAIKAN: name diubah ke 'kurangGizi' pada kondisi check -->
                                        <input class="form-check-input" type="radio" name="kurangGizi" id="yaKurangGizi" value="Ya" <?= (($data->tbAnak["kurangGizi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaKurangGizi">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <!-- PERBAIKAN: name diubah ke 'kurangGizi' pada kondisi check -->
                                        <input class="form-check-input" type="radio" name="kurangGizi" id="tdkKurangGizi" value="Tidak" <?= (($data->tbAnak["kurangGizi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkKurangGizi">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Merokok ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="merokok" id="yaMerokok" value="Ya" <?= (($data->tbAnak["merokok"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaMerokok">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="merokok" id="tdkMerokok" value="Tidak" <?= (($data->tbAnak["merokok"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkMerokok">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Perokok Pasif ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="perokokPasif" id="yaperokokPasif" value="Ya" <?= (($data->tbAnak["perokokPasif"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaperokokPasif">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="perokokPasif" id="tdkperokokPasif" value="Tidak" <?= (($data->tbAnak["perokokPasif"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkperokokPasif">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Riwayat DM/Kencing Manis ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kencingManis" id="yakencingManis" value="Ya" <?= (($data->tbAnak["kencingManis"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yakencingManis">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kencingManis" id="tdkkencingManis" value="Tidak" <?= (($data->tbAnak["kencingManis"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkkencingManis">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kencingManis" id="tdkTaukencingManis" value="Tidak Diketahui" <?= (($data->tbAnak["kencingManis"] ?? '') === "Tidak Diketahui") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkTaukencingManis">Tidak Diketahui</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">ODHIV ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="odhiv" id="yaodhiv" value="Ya" <?= (($data->tbAnak["odhiv"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaodhiv">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="odhiv" id="tdkodhiv" value="Tidak" <?= (($data->tbAnak["odhiv"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkodhiv">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="odhiv" id="tdkTauodhiv" value="Tidak Diketahui" <?= (($data->tbAnak["odhiv"] ?? '') === "Tidak Diketahui") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkTauodhiv">Tidak Diketahui</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Lansian &gt; 65 tahun ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="lansia" id="yalansia" value="Ya" <?= (($data->tbAnak["lansia"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yalansia">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="lansia" id="tdklansia" value="Tidak" <?= (($data->tbAnak["lansia"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdklansia">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Ibu hamil ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ibuhamil" id="yaibuhamil" value="Ya" <?= (($data->tbAnak["ibuhamil"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaibuhamil">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="ibuhamil" id="tdkibuhamil" value="Tidak" <?= (($data->tbAnak["ibuhamil"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkibuhamil">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2 border border-info rounded p-2 align-items-center">
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">Warga binaan pemasyarakatan (WBP) ?</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="wbp" id="tdkwbp" value="Tidak" <?= (($data->tbAnak["wbp"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="tdkwbp">Tidak</label>
                                        </div>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="wbp" id="yawbp" value="Ya" <?= (($data->tbAnak["wbp"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="yawbp">
                                                Ya, Masuk rutan :
                                            </label>
                                            <!-- PERBAIKAN: Menambahkan set value tanggal masuk rutan -->
                                            <input type="date" id="tglWbp" name="tglWbp" class="form-control form-control-sm" style="width: auto;" value="<?= $data->tbAnak['tglWbp'] ?? '' ?>">
                                        </div>

                                    </div>
                                </div>
                            </div>


                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">Jika WBP, Status WBP nya adalah :</label>

                                        <!-- PERBAIKAN: Menghapus double quotes berlebih pada id="Narapidana"" -->
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="statusWbp" id="Narapidana" value="Narapidana" <?= (($data->tbAnak["statusWbp"] ?? '') === "Narapidana") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Narapidana">Narapidana</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="statusWbp" id="Tahanan" value="Tahanan" <?= (($data->tbAnak["statusWbp"] ?? '') === "Tahanan") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Tahanan">Tahanan</label>
                                        </div>
                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="statusWbp" id="Anak" value="Anak" <?= (($data->tbAnak["statusWbp"] ?? '') === "Anak") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="Anak">Anak</label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Tinggal diwilayah padat kumuh miskin ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kumuh" id="yakumuh" value="Ya" <?= (($data->tbAnak["kumuh"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yakumuh">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kumuh" id="tdkkumuh" value="Tidak" <?= (($data->tbAnak["kumuh"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkkumuh">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Data Tes :</div>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal Skrining :</label>
                                <input type="date" class="form-control" id="tglSkrining" name="tglSkrining" onchange="hitungDanCekUsia()" value="<?= $data->tbAnak['tglSkrining'] ?? '' ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tempat Skrining :</label>
                                <input type="text" class="form-control" id="tempatSkrining" name="tempatSkrining" value="<?= $data->tbAnak['tempatSkrining'] ?? '' ?>">
                            </div>
                        </div>

                    </div>

                    <!-- ====================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Skrining Gejala :</div>
                            <hr>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Batuk &gt; 2 minggu ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="batuk" id="yabatuk" value="Ya" <?= (($data->tbAnak["batuk"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yabatuk">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                        <!-- PERBAIKAN: Kondisi check diubah dari 'wbp' menjadi 'batuk' -->
                                        <input class="form-check-input mt-0" type="radio" name="batuk" id="tdkbatuk" value="Tidak" <?= (($data->tbAnak["batuk"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small text-nowrap" for="tdkbatuk">
                                            Tidak, Durasi :
                                        </label>
                                        <!-- PERBAIKAN: Menambahkan set value durasiBatuk -->
                                        <input type="text" id="durasiBatuk" name="durasiBatuk" class="form-control form-control-sm" style="width: auto;" value="<?= $data->tbAnak['durasiBatuk'] ?? '' ?>">
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <!-- PERBAIKAN: &ngt; diubah menjadi &gt; (lebih besar dari) -->
                                    <label class="form-label fw-bold small text-secondary mb-0">Demam hilang dan timbul tanpa sebab yang jelas &gt; 2 minggu ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="demam" id="yademam" value="Ya" <?= (($data->tbAnak["demam"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yademam">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="demam" id="tdkdemam" value="Tidak" <?= (($data->tbAnak["demam"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkdemam">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">BB turun tanpa penyebab jelas/BB tidak naik dalam 2 bulan sebelumnya/nafsu makan turun</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="bb" id="yabb" value="Ya" <?= (($data->tbAnak["bb"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yabb">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="bb" id="tdkbb" value="Tidak" <?= (($data->tbAnak["bb"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkbb">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Lesu atau malaise, anak kurang aktif bermain</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="lesu" id="yalesu" value="Ya" <?= (($data->tbAnak["lesu"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yalesu">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="lesu" id="tdklesu" value="Tidak" <?= (($data->tbAnak["lesu"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdklesu">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pembesaran kelenjar getah bening ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="getahBening" id="yagetahBening" value="Ya" <?= (($data->tbAnak["getahBening"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yagetahBening">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="getahBening" id="tdkgetahBening" value="Tidak" <?= (($data->tbAnak["getahBening"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkgetahBening">Tidak</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="getahBening" id="tdkTaugetahBening" value="Tidak Diketahui" <?= (($data->tbAnak["getahBening"] ?? '') === "Tidak Diketahui") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkTaugetahBening">Tidak Diketahui</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Seseorang dinyatakan skrining gejala TBC positif apabila memiliki salah satu gejala TBC</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="positif" id="yapositif" value="Ya" <?= (($data->tbAnak["positif"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yapositif">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="positif" id="tdkpositif" value="Tidak" <?= (($data->tbAnak["positif"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkpositif">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>


                    <!-- ===================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Pemeriksaan Radiografi Toraks :</div>
                            <hr>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12  border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Apakah dilakukan Pemeriksaan Radiografi Toraks?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="radiografi" id="yaradiografi" value="Ya" <?= (($data->tbAnak["radiografi"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaradiografi">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="radiografi" id="tdkradiografi" value="Tidak" <?= (($data->tbAnak["radiografi"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkradiografi">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <label class="form-label fw-bold small text-secondary mb-0">Skor Pembacaan AI Hasil Pemeriksaan Radiografi Toraks :</label>
                                <!-- PERBAIKAN: Menambahkan set value pada textarea -->
                                <textarea name="skorRadiologi" id="skorRadiologi" class="form-control"><?= $data->tbAnak['skorRadiologi'] ?? '' ?></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <label class="form-label fw-bold small text-secondary mb-0">Kesan Pembacaan Hasil Pemeriksaan Radiografi Toraks oleh Klinisi :</label>
                                <!-- PERBAIKAN: Menambahkan set value pada textarea -->
                                <textarea name="kesanRadiologi" id="kesanRadiologi" class="form-control"><?= $data->tbAnak['kesanRadiologi'] ?? '' ?></textarea>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12  border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Kesimpulan Hasil Pemeriksaan Radiografi Toraks :</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulan" id="Normal" value="Normal" <?= (($data->tbAnak["kesimpulan"] ?? '') === "Normal") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="Normal">Normal</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulan" id="mengarahTbc" value="Abnormalitas Mengarah TBC" <?= (($data->tbAnak["kesimpulan"] ?? '') === "Abnormalitas Mengarah TBC") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="mengarahTbc">Abnormalitas Mengarah TBC</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="kesimpulan" id="tdkMengarahTbc" value="Abnormalitas Tidak Mengarah TBC" <?= (($data->tbAnak["kesimpulan"] ?? '') === "Abnormalitas Tidak Mengarah TBC") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkMengarahTbc">Abnormalitas Tidak Mengarah TBC</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ======================== -->
                    <div class="alert alert-info">
                        <div class="row mb-1">
                            <div class="col-12 text-center">Hasil Tes TBC :</div>
                            <hr>
                        </div>

                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Terduga TBC ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="terduga" id="yaterduga" value="Terduga TBC" <?= (($data->tbAnak["terduga"] ?? '') === "Terduga TBC") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yaterduga">Terduga TBC</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="terduga" id="tdkterduga" value="Bukan Terduga TBC" <?= (($data->tbAnak["terduga"] ?? '') === "Bukan Terduga TBC") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdkterduga">Bukan Terduga TBC</label>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-12 border border-info rounded p-2 align-items-center">
                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                    <label class="form-label fw-bold small text-secondary mb-0">Pemeriksaan TBC Laten ?</label>

                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="laten" id="yalaten" value="Ya" <?= (($data->tbAnak["laten"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="yalaten">Ya</label>
                                    </div>
                                    <div class="form-check mb-0 me-1">
                                        <input class="form-check-input" type="radio" name="laten" id="tdklaten" value="Tidak" <?= (($data->tbAnak["laten"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                        <label class="form-check-label small" for="tdklaten">Tidak</label>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0">Fasyankes Rujukan :</label>
                                <!-- PERBAIKAN: Menambahkan set value fasyankes -->
                                <input type="text" id="fasyankes" name="fasyankes" class="form-control" value="<?= $data->tbAnak['fasyankes'] ?? '' ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                                <input type="text" class="form-control" id="petugas" value="<?= $data->tbAnak['petugas'] ?? session()->get('nama') ?>" disabled>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</form>

<script>
    var tglLahirStr = "<?= $data->pasien['tgl_lahir'] ?? '' ?>";

    // 2. Buat fungsi untuk mengecek usia
    function hitungDanCekUsia() {
        // Ambil nilai terbaru dari input tglSkrining setiap kali fungsi dipanggil
        var tglSkriningStr = $('#tglSkrining').val();

        if (tglLahirStr && tglSkriningStr) {
            var lahir = new Date(tglLahirStr);
            var skrining = new Date(tglSkriningStr);

            // Hitung selisih tahun secara akurat
            var usiaTahun = skrining.getFullYear() - lahir.getFullYear();
            var m = skrining.getMonth() - lahir.getMonth();

            // Koreksi jika belum melewati bulan/tanggal ulang tahun
            if (m < 0 || (m === 0 && skrining.getDate() < lahir.getDate())) {
                usiaTahun--;
            }

            // Logika Tampil/Sembunyi elemen (Ganti #idElemenKamu dengan ID asli)
            if (usiaTahun < 5) {
                $('#berisikoGiziLebih').show(); // Tampil jika < 5 tahun
                $('#tool5Kurang').show(); // Tampil jika < 5 tahun
                $('#tool5Lebih').hide(); // Tampil jika < 5 tahun

            } else {
                $('#berisikoGiziLebih').hide(); // Sembunyi jika >= 5 tahun
                $('#tool5Kurang').hide(); // Tampil jika < 5 tahun
                $('#tool5Lebih').show(); // Tampil jika < 5 tahun
            }
        } else {
            // Jika tanggal skrining dikosongkan kembali oleh user
            $('#idElemenKamu').hide();
            $('#tool5Kurang').hide(); // Tampil jika < 5 tahun
            $('#tool5Lebih').show(); // Tampil jika < 5 tahun
        }
    }

    // 4. Jalankan sekali saat halaman pertama kali dimuat (antisipasi jika input sudah terisi otomatis)
    hitungDanCekUsia();
</script>