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
                <div class="row mb-1">
                    <div class="col-sm-5">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nama Penitip Barang :</label>
                        <input type="text" class="form-control" id="nama" placeholder="Nama" value="<?= $data->rm26iPenyimpananBarang['nama'] ?? '' ?>">
                    </div>
                    <div class="col-3 pt-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                            <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                        </div>
                    </div>
                    <div class="col-4 pt-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien('pasien')">
                            <label class="form-check-label" for="samaDgPasien">Sama dg pasien</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas :</label>
                        <input type="text" class="form-control" id="petugas" value="<?= $data->rm26iPenyimpananBarang['petugas'] ?? session()->get('nama') ?>" disabled>
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Satpam / yang menerima barang :</label>
                        <select name="satpam" id="satpam" class="form-select">
                            <option value="" <?= $data->rm26iPenyimpananBarang['satpam'] == '' ? ' selected' : '' ?>>-- Pilih Petugas --</option>
                            <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                echo '<option value="' . $data->petugas[$i]["nama"] . '"';
                                if ($data->petugas[$i]["nama"] === $data->rm26iPenyimpananBarang['satpam']) {
                                    echo ' selected';
                                }
                                echo '>' . $data->petugas[$i]["nama"] . '</option>';
                            } ?>
                        </select>
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
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Waktu dititipkan :</label>
                        <input type="datetime-local" id="waktuTitip" name="waktuTitip" class="form-control" value="<?= $data->rm26iPenyimpananBarang['waktuTitip'] ?? '' ?>">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Waktu diserahkan :</label>
                        <input type="datetime-local" id="waktuSerah" name="waktuSerah" class="form-control" value="<?= $data->rm26iPenyimpananBarang['waktuSerah'] ?? '' ?>">
                    </div>
                </div>
                <mark class="text-small" style="font-size: 8pt;">*berkas wajib dittd setelah tgl kembali sudah diisi. karna berkas sudah di ttd tidak dapat diedit !</mark>
            </div>
        </div>
    </div>
</form>