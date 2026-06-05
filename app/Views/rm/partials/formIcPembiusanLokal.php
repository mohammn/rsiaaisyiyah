<?php

/** @var object $data */
$indikasiIbu = !empty($data->icPembiusanLokal['indikasiIbu']) ? explode('|', $data->icPembiusanLokal['indikasiIbu']) : [];
$indikasiJanin = !empty($data->icPembiusanLokal['indikasiJanin']) ? explode('|', $data->icPembiusanLokal['indikasiJanin']) : [];
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
                <input type="hidden" class="form-control" id="petugas" value="<?= $data->icPembiusanLokal['petugas'] ?? session()->get('nama') ?>">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icPembiusanLokal['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icPembiusanLokal['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icPembiusanLokal['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icPembiusanLokal['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icPembiusanLokal['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icPembiusanLokal['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icPembiusanLokal['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icPembiusanLokal['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icPembiusanLokal['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
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
                            <option value="" <?= (empty($data->icPembiusanLokal['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icPembiusanLokal['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="saksi" class="form-label">Saksi :</label>
                        <input type="text" class="form-control" id="saksi" value="<?= $data->icPembiusanLokal['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="tindakanMedis" class="form-label">Tindakan medis :</label>
                        <input type="text" class="form-control" id="tindakanMedis" value="<?= $data->icPembiusanLokal['tindakanMedis'] ?? '' ?>">
                    </div>
                    <div class="col-md-6 mt-2 mt-md-0  border border-info rounded">
                        <label class="form-label d-block fw-bold text-info-emphasis mb-0" style="font-size: 0.9rem;">
                            JENIS <i>INFORMED CONSENT</i> :
                        </label>
                        <div class="btn-group btn-group-sm w-100" role="group">
                            <input type="radio" class="btn-check" name="jenis" id="setuju" value="PERSETUJUAN"
                                <?= (($data->icPembiusanLokal['jenis'] ?? 'PERSETUJUAN') === 'PERSETUJUAN') ? 'checked' : '' ?>>
                            <label class="btn btn-outline-success py-2 fw-bold d-flex align-items-center justify-content-center" for="setuju" style="font-size: 0.75rem; white-space: nowrap;">
                                <i class="fas fa-check fa-sm me-1"></i> PERSETUJUAN
                            </label>

                            <input type="radio" class="btn-check" name="jenis" id="tolak" value="PENOLAKAN"
                                <?= (($data->icPembiusanLokal['jenis'] ?? '') === 'PENOLAKAN') ? 'checked' : '' ?>>
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
                <div class="row mb-2">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-12">
                        <label for="diagnosis" class="form-label ">Diagnosis (WD & DD) :</label>
                        <textarea class="form-control" id="diagnosis" rows="2" placeholder="Masukkan Diagnosis..."><?= $data->icPembiusanLokal['diagnosis'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="prognosis" class="form-label ">Prognosis :</label>
                        <textarea class="form-control" id="prognosis" rows="2" placeholder="Masukkan prognosis..."><?= $data->icPembiusanLokal['prognosis'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="alternatif" class="form-label ">Alternatif dan Risiko :</label>
                        <textarea class="form-control" id="alternatif" rows="3" placeholder="Masukkan Alternatif & Risiko..."><?= $data->icPembiusanLokal['alternatif'] ?? '' ?></textarea>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <label for="lainLain" class="form-label ">Lain - lain :</label>
                        <textarea class="form-control" id="lainLain" rows="2" placeholder="Masukkan Lain - lain..."><?= $data->icPembiusanLokal['lainLain'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>