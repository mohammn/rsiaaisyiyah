<?php

/** @var object $data */
?>
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
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->penerjemah['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->penerjemah['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->penerjemah['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->penerjemah['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->penerjemah['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">

                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tgl Lahir :</label>
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->penerjemah['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->penerjemah['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->penerjemah['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bertindak sbg :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->penerjemah['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->penerjemah['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->penerjemah['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->penerjemah['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->penerjemah['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->penerjemah['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->penerjemah['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->penerjemah['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->penerjemah['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->penerjemah['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
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
                    <div class="col-12 text-center">Pemilihan Bahasa :</div>
                    <hr>
                </div>

                <div class="row mt-3 mb-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->penerjemah['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Bahasa pengantar pasien :</label>
                        <input type="text" class="form-control" id="bahasa" value="<?= $data->penerjemah['bahasa'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mt-3 mb-2">
                    <div class="col-sm-12">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">No. Telfon yg bertanda tangan :</label>
                        <input type="text" class="form-control" id="noHp" value="<?= $data->penerjemah['noHp'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>