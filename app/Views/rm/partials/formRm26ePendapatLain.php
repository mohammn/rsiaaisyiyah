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
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                    <hr>
                </div>
                <input type="hidden" class="form-control" id="petugas" value="<?= $data->rm26ePendapatLain['petugas'] ?? session()->get('nama') ?>">
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->rm26ePendapatLain['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->rm26ePendapatLain['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->rm26ePendapatLain['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->rm26ePendapatLain['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->rm26ePendapatLain['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">

                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tgl Lahir :</label>
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->rm26ePendapatLain['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->rm26ePendapatLain['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->rm26ePendapatLain['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bertindak sbg :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->rm26ePendapatLain['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-4 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dokter DPJP :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->rm26ePendapatLain['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->rm26ePendapatLain['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->rm26ePendapatLain['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row">
                    <div class="col-12 text-center">Pemberian informasi :</div>
                    <hr>
                </div>

                <div class="row mb-2">
                    <div class="col-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Diagnosa :</label>
                        <textarea type="text" class="form-control" id="diagnosa"><?= $data->rm26ePendapatLain['diagnosa'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Hasil pemeriksaan :</label>
                        <textarea type="text" class="form-control" id="hasilPemeriksaan"><?= $data->rm26ePendapatLain['hasilPemeriksaan'] ?? '' ?></textarea>
                    </div>
                </div>
                <hr>
                <mark>Dokter Rumah Sakit lain :</mark>
                <div class="row mb-2 mt-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dokter lain :</label>
                        <input type="text" name="dokterLain" id="dokterLain" class="form-control" value="<?= $data->rm26ePendapatLain['dokterLain'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Ahli :</label>
                        <input type="text" name="ahli" id="ahli" class="form-control" value="<?= $data->rm26ePendapatLain['ahli'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Rumah Sakit :</label>
                        <input type="text" name="rumahSakit" id="rumahSakit" class="form-control" value="<?= $data->rm26ePendapatLain['rumahSakit'] ?? '' ?>">
                    </div>
                </div>

                <br>
            </div>
        </div>
    </div>
</form>