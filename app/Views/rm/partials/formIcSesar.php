<?php

/** @var object $data */
$indikasiIbu = !empty($data->icSesar['indikasiIbu']) ? explode('|', $data->icSesar['indikasiIbu']) : [];
$indikasiJanin = !empty($data->icSesar['indikasiJanin']) ? explode('|', $data->icSesar['indikasiJanin']) : [];
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
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <input type="hidden" class="form-control" id="petugas" value="<?= $data->icSesar['petugas'] ?? session()->get('nama') ?>">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icSesar['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icSesar['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icSesar['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icSesar['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icSesar['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icSesar['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icSesar['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icSesar['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icSesar['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icSesar['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icSesar['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icSesar['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icSesar['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icSesar['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icSesar['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icSesar['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icSesar['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icSesar['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
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
                        <label for="petugas" class="form-label">Dokter :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->icSesar['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icSesar['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="saksi" class="form-label">Saksi :</label>
                        <input type="text" class="form-control" id="saksi" value="<?= $data->icSesar['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="tindakanMedis" class="form-label">Tindakan medis :</label>
                        <input type="text" class="form-control" id="tindakanMedis" value="<?= $data->icSesar['tindakanMedis'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0  border border-info rounded">
                        <label class="form-label d-block fw-bold text-info-emphasis mb-0" style="font-size: 0.9rem;">
                            JENIS <i>INFORMED CONSENT</i> :
                        </label>
                        <div class="btn-group btn-group-sm w-100" role="group">
                            <input type="radio" class="btn-check" name="jenis" id="setuju" value="PERSETUJUAN"
                                <?= (($data->icSesar['jenis'] ?? 'PERSETUJUAN') === 'PERSETUJUAN') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-success py-2 fw-bold d-flex align-items-center justify-content-center" for="setuju" style="font-size: 0.75rem; white-space: nowrap;">
                                <i class="fas fa-check fa-sm me-1"></i> PERSETUJUAN
                            </label>

                            <input type="radio" class="btn-check" name="jenis" id="tolak" value="PENOLAKAN"
                                <?= (($data->icSesar['jenis'] ?? '') === 'PENOLAKAN') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-danger py-2 fw-bold d-flex align-items-center justify-content-center" for="tolak" style="font-size: 0.75rem; white-space: nowrap;">
                                <i class="fas fa-times fa-sm me-1"></i> PENOLAKAN
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-3">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="diagnosa" class="form-label">Diagnosa :</label>
                        <textarea type="text" class="form-control" id="diagnosa"><?= $data->icSesar['diagnosa'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="alternatif" class="form-label">Alternatif :</label>
                        <textarea type="text" class="form-control" id="alternatif"><?= $data->icSesar['alternatif'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mb-3 border border-info rounded p-2">
                    <div class="col-6">
                        <div class="row">
                            <p class="fw-bold mb-1">Indikasi Tindakan (Ibu) :</p>
                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Panggul Sempit" id="panggul_sempit"
                                    <?= in_array('Panggul Sempit', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="panggul_sempit">
                                    Panggul Sempit
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Partus Lama" id="partus_lama"
                                    <?= in_array('Partus Lama', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="partus_lama">
                                    Partus Lama
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Riwayat SC Sebelumnya" id="riwayat_sc"
                                    <?= in_array('Riwayat SC Sebelumnya', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="riwayat_sc">
                                    Riwayat SC Sebelumnya
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Perdarahan Antepartum" id="perdarahan_antepartum"
                                    <?= in_array('Perdarahan Antepartum', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="perdarahan_antepartum">
                                    Perdarahan Antepartum
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Tumor Jalan Lahir" id="tumor_jalan_lahir"
                                    <?= in_array('Tumor Jalan Lahir', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="tumor_jalan_lahir">
                                    Tumor Jalan Lahir
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Preeklampsia" id="preeklampsia"
                                    <?= in_array('Preeklampsia', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="preeklampsia">
                                    Preeklampsia
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Lilitan Tali Pusar" id="lilitan_tali_pusar"
                                    <?= in_array('Lilitan Tali Pusar', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="lilitan_tali_pusar">
                                    Lilitan Tali Pusar
                                </label>
                            </div>

                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiIbu[]" value="Miopia" id="miopia"
                                    <?= in_array('Miopia', $indikasiIbu ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="miopia">
                                    Miopia
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <p class="fw-bold mb-1">Indikasi Tindakan (Janin) :</p>
                            <!-- Gawat Janin -->
                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiJanin[]" value="Gawat Janin" id="gawat_janin"
                                    <?= in_array('Gawat Janin', $indikasiJanin ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="gawat_janin">
                                    Gawat Janin
                                </label>
                            </div>

                            <!-- Malpresentasi -->
                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiJanin[]" value="Malpresentasi" id="malpresentasi"
                                    <?= in_array('Malpresentasi', $indikasiJanin ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="malpresentasi">
                                    Malpresentasi
                                </label>
                            </div>

                            <!-- Kehamilan Kembar -->
                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiJanin[]" value="Kehamilan Kembar" id="kehamilan_kembar"
                                    <?= in_array('Kehamilan Kembar', $indikasiJanin ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="kehamilan_kembar">
                                    Kehamilan Kembar
                                </label>
                            </div>

                            <!-- Big Baby -->
                            <div class="form-check hover-check">
                                <input class="form-check-input" type="checkbox" name="indikasiJanin[]" value="Big Baby" id="big_baby"
                                    <?= in_array('Big Baby', $indikasiJanin ?? []) ? 'checked' : '' ?>>
                                <label class="form-check-label" for="big_baby">
                                    <em>Big Baby</em>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <label for="lainLain" class="form-label">Lain - lain :</label>
                        <textarea type="text" class="form-control" id="lainLain"><?= $data->icSesar['lainLain'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>