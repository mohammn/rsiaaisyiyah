<?php

/** @var object $data */
$darah = !empty($data->icDarah['darah']) ? explode('|', $data->icDarah['darah']) : [];
$indikasi = !empty($data->icDarah['indikasi']) ? explode('|', $data->icDarah['indikasi']) : [];
?>
<style>
    /* Efek hover pada pembungkus form-check */
    .hover-check {
        padding: 1px 15px;
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
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icDarah['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icDarah['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icDarah['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icDarah['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icDarah['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icDarah['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icDarah['nik'] ?? '' ?>">
                    </div>
                    <div class="col-4">
                        <div class="form-check pt-2">
                            <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                            <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                        </div>
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="vol-12">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icDarah['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icDarah['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icDarah['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icDarah['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icDarah['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icDarah['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icDarah['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icDarah['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icDarah['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icDarah['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icDarah['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-5 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-6">
                        <label for="petugas" class="form-label">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->icDarah['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                    <div class="col-6">
                        <label for="saksi" class="form-label">Saksi :</label>
                        <input type="text" class="form-control" id="saksi" value="<?= $data->icDarah['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="petugas" class="form-label">Dokter :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->icDarah['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icDarah['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="tindakanMedis" class="form-label">Tindakan medis :</label>
                        <input type="text" class="form-control" id="tindakanMedis" value="<?= $data->icDarah['tindakanMedis'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>
                <div class="row mb-3 border border-info rounded p-2">
                    <div class="col-12">
                        <p class="fw-bold mb-1">Komponen darah yang tersedia sebagai berikut :</p>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="Whole Blood" id="wb"
                                <?= in_array('Whole Blood', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="wb">
                                Darah penuh (<em>Whole Blood</em>)
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="PRC" id="prc"
                                <?= in_array('PRC', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="prc">
                                <em>Packed Red Cell</em> (PRC)
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="TC" id="tc"
                                <?= in_array('TC', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="tc">
                                <em>Thrombocyte Concentrate</em> (TC)
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="FFP" id="ffp"
                                <?= in_array('FFP', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ffp">
                                <em>Fresh Frozen Plasma</em> (FFP)
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="Cryoprecipitate" id="cryo"
                                <?= in_array('Cryoprecipitate', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="cryo">
                                <em>Cryoprecipitate</em>
                            </label>
                        </div>

                        <div class="form-check hover-check mb-2">
                            <input class="form-check-input" type="checkbox" name="darah[]" value="Washed Red Cell" id="wrc"
                                <?= in_array('Washed Red Cell', $darah) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="wrc">
                                Darah merah cuci (<em>Washed Red Cell</em>)
                            </label>
                        </div>

                        <p class="text-muted small mt-2 mb-0">* Komponen darah tersebut diberikan kepada pasien sesuai indikasi</p>
                    </div>
                </div>
                <div class="row border border-info rounded p-2">
                    <div class="col-12">
                        <p class="fw-bold mb-1">Tujuan / Indikasi :</p>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="indikasi[]" value="Anemia perdarahan akut" id="ind_anemia_akut"
                                <?= in_array('Anemia perdarahan akut', $indikasi) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ind_anemia_akut">
                                Anemia karena perdarahan akut.
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="indikasi[]" value="Anemia kronik" id="ind_anemia_kronik"
                                <?= in_array('Anemia kronik', $indikasi) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ind_anemia_kronik">
                                Anemia kronik.
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="indikasi[]" value="Perdarahan kurang komponen" id="ind_perdarahan_komponen"
                                <?= in_array('Perdarahan kurang komponen', $indikasi) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ind_perdarahan_komponen">
                                Perdarahan karena kekurangan komponen darah (trombosit, faktor pembekuan)
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="indikasi[]" value="Plasma loss / Hipoalbuminemia" id="ind_plasma_loss"
                                <?= in_array('Plasma loss / Hipoalbuminemia', $indikasi) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ind_plasma_loss">
                                Plasma loss atau hipoalbuminemia jika tidak dapat diberikan plasma substitute atau larutan albumin
                            </label>
                        </div>

                        <div class="form-check hover-check">
                            <input class="form-check-input" type="checkbox" name="indikasi[]" value="Profilaksis operasi" id="ind_profilaksis"
                                <?= in_array('Profilaksis operasi', $indikasi) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="ind_profilaksis">
                                Profilaksis karena operasi besar atau riwayat operasi sebelumnya
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>