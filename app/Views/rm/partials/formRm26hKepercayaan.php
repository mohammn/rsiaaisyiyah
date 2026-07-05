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
                <mark>Yang bertanda tangan di bawah ini :</mark>
                <div class="row mb-3 mt-2">
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->rm26hKepercayaan['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->rm26hKepercayaan['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->rm26hKepercayaan['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->rm26hKepercayaan['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->rm26hKepercayaan['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">

                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tgl Lahir :</label>
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->rm26hKepercayaan['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->rm26hKepercayaan['nik'] ?? '' ?>">
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
                        <div class="col-12">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->rm26hKepercayaan['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bertindak sbg :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->rm26hKepercayaan['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-4 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
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

                <div class="row mt-3 mb-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->rm26hKepercayaan['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                </div>

                <hr>
                <div class="row mb-2 mt-2">
                    <div class="col-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nilai-nilai kepercayaan :</label>
                        <textarea name="nilaiKepercayaan" id="nilaiKepercayaan" class="form-control" rows="6"><?= $data->rm26hKepercayaan["nilaiKepercayaan"] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>