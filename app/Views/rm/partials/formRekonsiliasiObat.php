<?php

/** @var object $data */
?>
<form>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <div class="row mb-1">
                    <div class="col-12 text-center">Alergi :</div>
                    <hr>
                </div>
                <div class="container-fluid p-0">
                    <div class="row g-3">
                        <!-- Bagian 1: Alergi Obat -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alegi" class="form-label text-secondary fw-semibold mb-1">Alergi Obat</label>
                                <textarea name="alergi" id="alergi" class="form-control" rows="3" style="resize: none;" placeholder="Masukkan Alergi Obat di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Bagian 2: Manifestasi Alergi -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="manifestasi" class="form-label text-secondary fw-semibold mb-1">Manifestasi Alergi</label>
                                <textarea name="manifestasi" id="manifestasi" class="form-control" rows="3" style="resize: none;" placeholder="Masukkan Manifestasi Alergi di sini..."></textarea>
                            </div>
                        </div>

                        <!-- Bagian 3: Dampak -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label text-secondary fw-semibold mb-1">Dampak <span class="text-danger">*</span></label>
                                <!-- Ditambahkan d-flex dan align-items-center agar pilihan radio tegak lurus di tengah kotak -->
                                <div class="p-2 border rounded bg-light d-flex align-items-center justify-content-start flex-wrap w-100" style="height: calc(2rem * 2 + 20px);">

                                    <!-- Pilihan 1: Tidak Ada -->
                                    <div class="form-check form-check-inline mb-0 me-2 small">
                                        <input class="form-check-input" type="radio" name="dampak" id="dampak_tidak_ada" value="Tidak Ada" required>
                                        <label class="form-check-label" for="dampak_tidak_ada">Tidak Ada</label>
                                    </div>

                                    <!-- Pilihan 2: Ringan -->
                                    <div class="form-check form-check-inline mb-0 me-2 small">
                                        <input class="form-check-input" type="radio" name="dampak" id="dampak_ringan" value="Ringan">
                                        <label class="form-check-label" for="dampak_ringan">Ringan</label>
                                    </div>

                                    <!-- Pilihan 3: Sedang -->
                                    <div class="form-check form-check-inline mb-0 me-2 small">
                                        <input class="form-check-input" type="radio" name="dampak" id="dampak_sedang" value="Sedang">
                                        <label class="form-check-label" for="dampak_sedang">Sedang</label>
                                    </div>

                                    <!-- Pilihan 4: Berat -->
                                    <div class="form-check form-check-inline mb-0 small">
                                        <input class="form-check-input" type="radio" name="dampak" id="dampak_berat" value="Berat">
                                        <label class="form-check-label" for="dampak_berat">Berat</label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Petugas Instalasi Gawat Darurat</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <div class="row mb-3 align-items-center">
                        <label for="perawatIgd" class="col-sm-3 col-form-label text-secondary fw-semibold">Perawat</label>
                        <div class="col-sm-5">
                            <select name="perawatIgd" id="perawatIgd" class="form-select">
                                <option value="" selected>-- Pilih Perawat --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuPerawatIgd" name="waktuPerawatIgd" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="dokterIgd" class="col-sm-3 col-form-label text-secondary fw-semibold">Dokter</label>
                        <div class="col-sm-5">
                            <select name="dokterIgd" id="dokterIgd" class="form-select">
                                <option value="" selected>-- Pilih Dokter --</option>
                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '">' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuDokterIgd" name="waktuDokterIgd" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="farmasiIgd" class="col-sm-3 col-form-label text-secondary fw-semibold">Farmasi</label>
                        <div class="col-sm-5">
                            <select name="farmasiIgd" id="farmasiIgd" class="form-select">
                                <option value="" selected>-- Pilih Farmasi --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuFarmasiIgd" name="waktuFarmasiIgd" class="form-control text-secondary small">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Petugas Kamar Operasi :</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <div class="row mb-3 align-items-center">
                        <label for="perawatKo" class="col-sm-3 col-form-label text-secondary fw-semibold">Perawat</label>
                        <div class="col-sm-5">
                            <select name="perawatKo" id="perawatKo" class="form-select">
                                <option value="" selected>-- Pilih Perawat --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuPerawatKo" name="waktuPerawatKo" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="dokterKo" class="col-sm-3 col-form-label text-secondary fw-semibold">Dokter</label>
                        <div class="col-sm-5">
                            <select name="dokterKo" id="dokterKo" class="form-select">
                                <option value="" selected>-- Pilih Dokter --</option>
                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '">' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuDokterKo" name="waktuDokterKo" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="farmasiKo" class="col-sm-3 col-form-label text-secondary fw-semibold">Farmasi</label>
                        <div class="col-sm-5">
                            <select name="farmasiKo" id="farmasiKo" class="form-select">
                                <option value="" selected>-- Pilih Farmasi --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuFarmasiKo" name="waktuFarmasiKo" class="form-control text-secondary small">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Petugas Ruang Recovery :</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <div class="row mb-3 align-items-center">
                        <label for="perawatRr" class="col-sm-3 col-form-label text-secondary fw-semibold">Perawat</label>
                        <div class="col-sm-5">
                            <select name="perawatRr" id="perawatRr" class="form-select">
                                <option value="" selected>-- Pilih Perawat --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuPerawatRr" name="waktuPerawatRr" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="dokterRr" class="col-sm-3 col-form-label text-secondary fw-semibold">Dokter</label>
                        <div class="col-sm-5">
                            <select name="dokterRr" id="dokterRr" class="form-select">
                                <option value="" selected>-- Pilih Dokter --</option>
                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '">' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuDokterRr" name="waktuDokterRr" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="farmasiRr" class="col-sm-3 col-form-label text-secondary fw-semibold">Farmasi</label>
                        <div class="col-sm-5">
                            <select name="farmasiRr" id="farmasiRr" class="form-select">
                                <option value="" selected>-- Pilih Farmasi --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuFarmasiRr" name="waktuFarmasiRr" class="form-control text-secondary small">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6">
            <div class="alert alert-info" role="alert">
                <div class="row mb-1">
                    <div class="col-12 text-center">Petugas Rawat Inap :</div>
                    <hr>
                </div>
                <div class="mb-4">
                    <div class="row mb-3 align-items-center">
                        <label for="perawatRi" class="col-sm-3 col-form-label text-secondary fw-semibold">Perawat</label>
                        <div class="col-sm-5">
                            <select name="perawatRi" id="perawatRi" class="form-select">
                                <option value="" selected>-- Pilih Perawat --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuPerawatRi" name="waktuPerawatRi" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="dokterRi" class="col-sm-3 col-form-label text-secondary fw-semibold">Dokter</label>
                        <div class="col-sm-5">
                            <select name="dokterRi" id="dokterRi" class="form-select">
                                <option value="" selected>-- Pilih Dokter --</option>
                                <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                    echo '<option value="' . $data->dokter[$i]["nm_dokter"] . '">' . $data->dokter[$i]["nm_dokter"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuDokterRi" name="waktuDokterRi" class="form-control text-secondary small">
                        </div>
                    </div>

                    <div class="row mb-3 align-items-center">
                        <label for="farmasiRi" class="col-sm-3 col-form-label text-secondary fw-semibold">Farmasi</label>
                        <div class="col-sm-5">
                            <select name="farmasiRi" id="farmasiRi" class="form-select">
                                <option value="" selected>-- Pilih Farmasi --</option>
                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                    echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                } ?>
                            </select>
                        </div>
                        <div class="col-sm-4">
                            <input type="datetime-local" id="waktuFarmasiRi" name="waktuFarmasiRi" class="form-control text-secondary small">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>