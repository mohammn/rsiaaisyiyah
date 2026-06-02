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
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->icPembiusan['nama'] ?? '' ?>"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" <?= (empty($data->icPembiusan['jk'])) ? 'selected' : '' ?> disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L" <?= (($data->icPembiusan['jk'] ?? '') === 'L') ? 'selected' : '' ?>>Laki-laki</option>
                            <option value="P" <?= (($data->icPembiusan['jk'] ?? '') === 'P') ? 'selected' : '' ?>>Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir" value="<?= $data->icPembiusan['tempatLahir'] ?? '' ?>">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control" value="<?= $data->icPembiusan['tanggalLahir'] ?? '' ?>">
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-8">
                        <input type="text" class="form-control" id="nik" placeholder="Nomor Identitas (NIK)" value="<?= $data->icPembiusan['nik'] ?? '' ?>">
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
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat" value="<?= $data->icPembiusan['alamat'] ?? '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Suami') ? 'selected' : '' ?>>Suami</option>
                            <option value="Istri" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Istri') ? 'selected' : '' ?>>Istri</option>
                            <option value="Anak" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Anak') ? 'selected' : '' ?>>Anak</option>
                            <option value="Kakak" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Kakak') ? 'selected' : '' ?>>Kakak</option>
                            <option value="Adik" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Adik') ? 'selected' : '' ?>>Adik</option>
                            <option value="Ayah" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Ayah') ? 'selected' : '' ?>>Ayah</option>
                            <option value="Ibu" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Ibu') ? 'selected' : '' ?>>Ibu</option>
                            <option value="Teman" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Teman') ? 'selected' : '' ?>>Teman</option>
                            <option value="Wali" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Wali') ? 'selected' : '' ?>>Wali</option>
                            <option value="Saya sendiri" <?= (($data->icPembiusan['sebagai'] ?? '') === 'Saya sendiri') ? 'selected' : '' ?>>Diri saya sendiri</option>
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
                        <input type="text" class="form-control" id="petugas" value="<?= $data->icPembiusan['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                    <div class="col-6">
                        <label for="saksi" class="form-label">Saksi :</label>
                        <input type="text" class="form-control" id="saksi" value="<?= $data->icPembiusan['saksi'] ?? '' ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="petugas" class="form-label">Dokter :</label>
                        <select name="dokter" id="dokter" class="form-select">
                            <option value="" <?= (empty($data->icPembiusan['dokter'])) ? 'selected' : '' ?> disabled>-- Pilih Dokter --</option>
                            <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                $selected = (($data->icPembiusan['dokter'] ?? '') === $data->dokter[$i]["nm_dokter"]) ? 'selected' : '';
                                echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '" ' . $selected . '>' . $data->dokter[$i]["nm_dokter"] . '</option>';
                            } ?>
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="tindakanMedis" class="form-label">Tindakan medis :</label>
                        <input type="text" class="form-control" id="tindakanMedis" value="<?= $data->icPembiusan['tindakanMedis'] ?? '' ?>">
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
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="diagnosa" class="form-label">Dianosa (WD&DD) :</label>
                        <textarea type="text" class="form-control" id="diagnosa"><?= $data->icPembiusan['diagnosa'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="indikasi" class="form-label">Indikasi Tindakan :</label>
                        <textarea type="text" class="form-control" id="indikasi"><?= $data->icPembiusan['indikasi'] ?? '' ?></textarea>
                    </div>
                </div>
                <div class="row mb-3 border border-info rounded">
                    <div class="col-md-6 mt-2">
                        <div class="mb-3">
                            <b>Tindakan :</b>
                            <label class="form-label fw-bold d-block mb-1">a. Anestesi Regional</label>
                            <div class="ms-3">
                                <div class="form-check my-1">
                                    <input class="form-check-input" type="radio" name="jenis_anestesi" id="spinal" value="Spinal/Epidural"
                                        <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Spinal/Epidural') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="spinal">Spinal/ Epidural</label>
                                </div>

                                <div class="form-check my-1">
                                    <input class="form-check-input" type="radio" name="jenis_anestesi" id="kaudal" value="Kaudal"
                                        <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Kaudal') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="kaudal">Kaudal</label>
                                </div>

                                <div class="form-check my-1">
                                    <input class="form-check-input" type="radio" name="jenis_anestesi" id="blok" value="Blok"
                                        <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Blok') ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="blok">Blok</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <br>
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="radio" name="jenis_anestesi" id="umum" value="Anestesi Umum"
                                <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'Anestesi Umum') ? 'checked' : '' ?>>
                            <label class="form-check-label fw-bold" for="umum">b. Anestesi Umum</label>
                        </div>
                        <label class="form-label fw-bold mb-2">c. Anestesi Kombinasi:</label>

                        <div class="input-group input-group-sm">
                            <div class="input-group-text">
                                <input class="form-check-input mt-0" type="radio" name="jenis_anestesi" id="kombinasi" value="kombinasi"
                                    <?= (($data->icPembiusan['jenisAnestesi'] ?? '') === 'kombinasi') ? 'checked' : '' ?>>
                            </div>
                            <input type="text" class="form-check-label form-control form-control-sm" id="isiKombinasi" name="isiKombinasi" placeholder="Sebutkan kombinasi..."
                                value="<?= ($data->icPembiusan['jenisAnestesi'] ?? '') === 'kombinasi' ? ($data->icPembiusan['isiKombinasi'] ?? '') : '' ?>">
                        </div>
                    </div>
                </div>
                <div class="row mb-3 border border-info rounded">
                    <div class="col-12">
                        <label class="form-label fw-bold d-block mb-1">Tata cara - Anestesi Regional :</label>
                    </div>
                    <div class="col-4">
                        <div class="form-check my-1">
                            <input class="form-check-input" type="radio" name="jenis_anestesi2" id="spinal2" value="Spinal/Epidural"
                                <?= (($data->icPembiusan['jenisAnestesi2'] ?? '') === 'Spinal/Epidural') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="spinal2">Spinal/ Epidural</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check my-1">
                            <input class="form-check-input" type="radio" name="jenis_anestesi2" id="kaudal2" value="Kaudal"
                                <?= (($data->icPembiusan['jenisAnestesi2'] ?? '') === 'Kaudal') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="kaudal2">Kaudal</label>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="form-check my-1">
                            <input class="form-check-input" type="radio" name="jenis_anestesi2" id="blok2" value="Blok"
                                <?= (($data->icPembiusan['jenisAnestesi2'] ?? '') === 'Blok') ? 'checked' : '' ?>>
                            <label class="form-check-label" for="blok2">Blok</label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-6">
                        <label for="prognosis" class="form-label">Prognosis :</label>
                        <textarea type="text" class="form-control" id="prognosis"><?= $data->icPembiusan['prognosis'] ?? '' ?></textarea>
                    </div>
                    <div class="col-6">
                        <label for="alternatif" class="form-label">Alternatif dan Risiko :</label>
                        <textarea type="text" class="form-control" id="alternatif"><?= $data->icPembiusan['alternatif'] ?? '' ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>