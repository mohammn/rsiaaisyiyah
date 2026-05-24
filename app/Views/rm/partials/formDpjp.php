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
                    <div class="col-7"><input type="text" class="form-control" id="nama" placeholder="Nama"></div>
                    <div class="col-5">
                        <select name="jk" id="jk" class="form-select">
                            <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-3 mt-2">
                    <div class="col-5">
                        <input type="text" class="form-control" id="tempatLahir" placeholder="Tempat Lahir">
                    </div>
                    <div class="col-2">
                        Tgl Lahir :
                    </div>
                    <div class="col-5">
                        <input type="date" id="tglLahir" class="form-control">
                    </div>
                </div>
                <div class="mb-1">
                    <div class="row">
                        <div class="col-8">
                            <input type="text" class="form-control" id="alamat" placeholder="Alamat">
                        </div>
                        <div class="col-4">
                            <div class="form-check pt-2">
                                <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                                <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                        <select id="sebagai" class="form-select">
                            <option value="Suami">Suami</option>
                            <option value="Istri">Istri</option>
                            <option value="Anak">Anak</option>
                            <option value="Kakak">Kakak</option>
                            <option value="Adik">Adik</option>
                            <option value="Ayah">Ayah</option>
                            <option value="Ibu">Ibu</option>
                            <option value="Teman">Teman</option>
                            <option value="Wali">Wali</option>
                            <option value="Saya sendiri">Diri saya sendiri</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <div class="pt-5 form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Persetujuan Pemilihan Dokter :</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <small>Dengan ini menyatakan dengan sadar dan sesungguhnya bahwa :
                        <ol type="1">
                            <li>
                                Telah menerima dan memahami informasi mengenai dokter penanggung jawab pasien selama di rawat Rumah Sakit RSIA Aisyiyah
                            </li>
                            <li>
                                Berdasarkan hal tersebut diatas saya memilih dokter :
                                <select name="dokter" id="dokter" class="form-select">
                                    <option value="" selected disabled>-- Pilih Dokter --</option>
                                    <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                        echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '">' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                    } ?>
                                </select>
                                Sebagai dokter penanggung jawab.
                            </li>
                        </ol>
                    </small>
                </div>
                <div class="mb-3">
                    <div class="row">
                        <div class="col-12">
                            <label for="petugas" class="form-label">Petugas :</label>
                            <input type="text" class="form-control" id="petugas" value="<?= session()->get('nama') ?>" disabled>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>