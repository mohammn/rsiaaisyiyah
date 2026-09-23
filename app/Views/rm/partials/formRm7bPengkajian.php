<?php

/** @var object $data */

// List semua field yang disimpan sebagai JSON
$jsonFields = [
    'jenisGynekologi',
    'riwayatAlergi',
    'keadaanPsikologis',
    'tinggalBersama',
    'diagnosaKhusus',
    'keluhanLain',
    'perinium',
    'jahitan',
    'kelainan',
    'intervensi'
];

// Otomatis ubah string JSON menjadi Array PHP agar in_array tidak error
if (isset($data->rm7bPengkajian)) {
    foreach ($jsonFields as $field) {
        if (isset($data->rm7bPengkajian[$field]) && is_string($data->rm7bPengkajian[$field])) {
            $data->rm7bPengkajian[$field] = json_decode($data->rm7bPengkajian[$field], true) ?: [];
        } else if (!isset($data->rm7bPengkajian[$field])) {
            $data->rm7bPengkajian[$field] = [];
        }
    }
}
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
        color: #70a9ff;
    }

    /* Membuat kursor pointer saat mengarah ke checkbox dan labelnya */
    .hover-check .form-check-input,
    .hover-check .form-check-label {
        cursor: pointer;
    }
</style>
<form>

    <nav>
        <div class="nav nav-tabs justify-content-center" id="nav-tab" role="tablist">
            <button class="nav-link active" id="data-umum-tab" data-bs-toggle="tab" data-bs-target="#data-umum" type="button" role="tab" aria-controls="data-umum" aria-selected="true">Data Umum</button>
            <button class="nav-link" id="data-subjektif-tab" data-bs-toggle="tab" data-bs-target="#data-subjektif" type="button" role="tab" aria-controls="data-subjektif" aria-selected="false">Data Subjektif</button>
            <button class="nav-link" id="data-ojektif-tab" data-bs-toggle="tab" data-bs-target="#data-ojektif" type="button" role="tab" aria-controls="data-ojektif" aria-selected="false">Data Objektif</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="data-umum" role="tabpanel" aria-labelledby="data-umum-tab">
            <div class="row">
                <div class="col-md-6">

                    <div class="alert alert-info mt-3" role="alert">
                        <div class="row mt-2">
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal dan jam :</label>
                                <input type="datetime-local" id="tgl" name="tgl" value="<?= $data->rm7bPengkajian["tgl"] ?? '' ?>" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas / Bidan :</label>
                                <input type="text" class="form-control" name="petugas" id="petugas" value="<?= $data->rm4PermintaanMasuk['petugas'] ?? session()->get('nama') ?>" readonly>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class=" border border-info rounded p-1">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Sumber Data :</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="sumberData" id="sumberPasien" value="Pasien" <?= (($data->rm7bPengkajian["sumberData"] ?? '') === "Pasien") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="sumberPasien">Pasien</label>
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="sumberData" id="sumberKeluarga" value="Keluarga" <?= (($data->rm7bPengkajian["sumberData"] ?? '') === "Keluarga") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="sumberKeluarga">Keluarga</label>
                                        </div>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="sumberData" id="sumberLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["sumberData"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="sumberLainnya">
                                                Lainnya :
                                            </label>
                                            <input type="text" id="sumberDataLainnya" name="sumberDataLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['sumberDataLainnya'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class=" border border-info rounded p-1">
                                    <div class="d-flex flex-wrap gap-1 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0">Rujukan :</label>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="rujukan" id="rujukanYa" value="Ya" <?= (($data->rm7bPengkajian["rujukan"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="rujukanYa">
                                                Ya, dari :
                                            </label>
                                            <input type="text" id="asalRujukan" name="asalRujukan" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['asalRujukan'] ?? '' ?>">
                                        </div>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="rujukan" id="datangSendiri" value="Datang Sendiri" <?= (($data->rm7bPengkajian["rujukan"] ?? '') === "Datang Sendiri") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="datangSendiri">Datang Sendiri</label>
                                        </div>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="rujukan" id="diantarOleh" value="Diantar Oleh" <?= (($data->rm7bPengkajian["rujukan"] ?? '') === "Diantar Oleh") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="diantarOleh">
                                                Diantar Oleh
                                            </label>
                                            <input type="text" id="pengantarRujukan" name="pengantarRujukan" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['pengantarRujukan'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="alert alert-info mt-3" role="alert">

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary mb-0">Keluarga yg bisa dihubungi :</label>
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" value="<?= $data->rm7bPengkajian['nama'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <div class="form-check pt-4">
                                    <input type="checkbox" class="form-check-input" id="samaDgPj" onchange="setSamadgPasien('pj')">
                                    <label class="form-check-label" for="samaDgPj">Sama dg PJ</label>
                                </div>
                            </div>
                        </div>


                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary mb-0">Alamat :</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" value="<?= $data->rm7bPengkajian['alamat'] ?? '' ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small text-secondary mb-0">No Hp :</label>
                                <input type="text" class="form-control" id="noHp" name="noHp" placeholder="No. HP" value="<?= $data->rm7bPengkajian['noHp'] ?? '' ?>">
                            </div>
                        </div>

                        <div class="row mt-2">
                            <div class="col-sm-12">
                                <div class=" border border-info rounded p-1">
                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                        <label class="form-label fw-bold small text-secondary mb-0 ms-1">Transportasi Waktu Datang :</label>

                                        <div class="form-check mb-0 me-1">
                                            <input class="form-check-input" type="radio" name="transportasiWaktuDatang" id="transAmbulance" value="Ambulance" <?= (($data->rm7bPengkajian["transportasiWaktuDatang"] ?? '') === "Ambulance") ? 'checked' : '' ?>>
                                            <label class="form-check-label small" for="transAmbulance">Ambulance</label>
                                        </div>

                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                            <input class="form-check-input mt-0" type="radio" name="transportasiWaktuDatang" id="transLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["transportasiWaktuDatang"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                            <label class="form-check-label small text-nowrap" for="transLainnya">
                                                Lainnya :
                                            </label>
                                            <input type="text" id="transportasiLainnya" name="transportasiLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['transportasiLainnya'] ?? '' ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="data-subjektif" role="tabpanel" aria-labelledby="data-subjektif-tab">
            <div class="row">
                <div class="container mt-3">
                    <div class="row">

                        <!-- KOLOM KIRI (col-6) -->
                        <div class="col-sm-6">


                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Riwayat Kebidanan :</div>
                                    <hr>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-secondary mb-0">Keluhan utama :</label>
                                        <textarea name="keluhanUtama" id="keluhanUtama" class="form-control"><?= $data->rm7bPengkajian["keluhanUtama"] ?? '' ?></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-secondary mb-0">Riwayat penyakit :</label>
                                        <textarea name="riwayatPenyakit" id="riwayatPenyakit" class="form-control"><?= $data->rm7bPengkajian["riwayatPenyakit"] ?? '' ?></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small text-secondary mb-0">Riwayat penyakit keluarga :</label>
                                        <textarea name="riwayatPenyakitKeluarga" id="riwayatPenyakitKeluarga" class="form-control"><?= $data->rm7bPengkajian["riwayatPenyakitKeluarga"] ?? '' ?></textarea>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat menstruasi :</label>

                                                <div class="d-flex align-items-center gap-1">
                                                    <label class="form-label small mb-0 text-nowrap" for="hpht">HPHT :</label>
                                                    <input type="date" class="form-control form-control-sm" id="hpht" name="hpht" value="<?= $data->rm7bPengkajian['hpht'] ?? '' ?>">
                                                </div>

                                                <div class="d-flex align-items-center gap-1">
                                                    <label class="form-label small mb-0 text-nowrap" for="hpl">HPL :</label>
                                                    <input type="date" class="form-control form-control-sm" id="hpl" name="hpl" value="<?= $data->rm7bPengkajian['hpl'] ?? '' ?>">
                                                </div>

                                                <div class="d-flex align-items-center gap-1">
                                                    <label class="form-label small mb-0 text-nowrap" for="mensLainnya">Lainnya :</label>
                                                    <input type="text" class="form-control form-control-sm" id="mensLainnya" name="mensLainnya" value="<?= $data->rm7bPengkajian['mensLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat Perkawinan :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="riwayatPerkawinan" id="perkawinanBelumKawin" value="Belum Kawin" <?= (($data->rm7bPengkajian["riwayatPerkawinan"] ?? '') === "Belum Kawin") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="perkawinanBelumKawin">Belum Kawin</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="riwayatPerkawinan" id="perkawinanCerai" value="Cerai" <?= (($data->rm7bPengkajian["riwayatPerkawinan"] ?? '') === "Cerai") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="perkawinanCerai">Cerai</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-1">
                                                    <input class="form-check-input mt-0" type="radio" name="riwayatPerkawinan" id="perkawinanKawin" value="Kawin" <?= (($data->rm7bPengkajian["riwayatPerkawinan"] ?? '') === "Kawin") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="perkawinanKawin">
                                                        Kawin :
                                                    </label>
                                                    <input type="number" id="jumlahKawin" name="jumlahKawin" class="form-control form-control-sm" style="width: 60px;" value="<?= $data->rm7bPengkajian['jumlahKawin'] ?? '' ?>">
                                                    <span class="small text-nowrap">kali,</span>
                                                    <label class="small text-nowrap ms-1">lama :</label>
                                                    <input type="number" id="lamaKawin" name="lamaKawin" class="form-control form-control-sm" style="width: 60px;" value="<?= $data->rm7bPengkajian['lamaKawin'] ?? '' ?>">
                                                    <span class="small text-nowrap">tahun</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat KB Terakhir :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="riwayatKbTerakhir" id="kbTidak" value="Tidak" <?= (($data->rm7bPengkajian["riwayatKbTerakhir"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="kbTidak">Tidak</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="radio" name="riwayatKbTerakhir" id="kbYa" value="Ya" <?= (($data->rm7bPengkajian["riwayatKbTerakhir"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="kbYa">
                                                        Ya, jenis :
                                                    </label>
                                                    <input type="text" id="jenisKbTerakhir" name="jenisKbTerakhir" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisKbTerakhir'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-column gap-1">
                                                <!-- Baris 1: Radio Tidak Ada -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat Gynekologi :</label>
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="riwayatGynekologi" id="gynekologiTidakAda" value="Tidak ada" <?= (($data->rm7bPengkajian["riwayatGynekologi"] ?? '') === "Tidak ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiTidakAda">Tidak ada</label>
                                                    </div>
                                                </div>

                                                <!-- Baris 2: Radio Ada & Checkbox Jenis -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center ms-md-4 ms-1">
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="riwayatGynekologi" id="gynekologiAda" value="Ada" <?= (($data->rm7bPengkajian["riwayatGynekologi"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiAda">Ada, jenis :</label>
                                                    </div>

                                                    <!-- Options Checkbox -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="jenisGynekologi[]" id="gynekologiMyoma" value="Myoma" <?= (in_array("Myoma", (array)($data->rm7bPengkajian['jenisGynekologi'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiMyoma">Myoma</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="jenisGynekologi[]" id="gynekologiPolipCx" value="Polip Cx" <?= (in_array("Polip Cx", (array)($data->rm7bPengkajian['jenisGynekologi'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiPolipCx">Polip Cx</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="jenisGynekologi[]" id="gynekologiInfeksiVirus" value="Infeksi Virus" <?= (in_array("Infeksi Virus", (array)($data->rm7bPengkajian['jenisGynekologi'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiInfeksiVirus">Infeksi Virus</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="jenisGynekologi[]" id="gynekologiKanker" value="Kanker" <?= (in_array("Kanker", (array)($data->rm7bPengkajian['jenisGynekologi'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="gynekologiKanker">Kanker</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                        <input class="form-check-input mt-0" type="checkbox" name="jenisGynekologi[]" id="gynekologiLainnya" value="Lainnya" <?= (in_array("Lainnya", (array)($data->rm7bPengkajian['jenisGynekologi'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small text-nowrap" for="gynekologiLainnya">
                                                            Lainnya :
                                                        </label>
                                                        <input type="text" id="jenisGynekologiLainnya" name="jenisGynekologiLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisGynekologiLainnya'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-column gap-1">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat Alergi (<i class="fw-normal" style="color: red;">Tidak perlu dicentang jika tidak ada.</i>) :</label>

                                                <!-- Baris 1: Obat -->
                                                <div class="form-check mb-0 ms-md-3 ms-1 d-flex flex-wrap align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="riwayatAlergi[]" id="alergiObat" value="Obat" <?= (in_array("Obat", (array)($data->rm7bPengkajian['riwayatAlergi'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="alergiObat">
                                                        Nama Obat :
                                                    </label>
                                                    <input type="text" id="jenisNamaObat" name="jenisNamaObat" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisNamaObat'] ?? '' ?>">
                                                    <label class="small text-nowrap ms-1">Reaksi :</label>
                                                    <input type="text" id="reaksiObat" name="reaksiObat" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['reaksiObat'] ?? '' ?>">
                                                </div>

                                                <!-- Baris 2: Makanan -->
                                                <div class="form-check mb-0 ms-md-3 ms-1 d-flex flex-wrap align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="riwayatAlergi[]" id="alergiMakanan" value="Makanan" <?= (in_array("Makanan", (array)($data->rm7bPengkajian['riwayatAlergi'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="alergiMakanan">
                                                        Makanan
                                                    </label>
                                                    <input type="text" id="jenisMakanan" name="jenisMakanan" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisMakanan'] ?? '' ?>">
                                                    <label class="small text-nowrap ms-1">Reaksi :</label>
                                                    <input type="text" id="reaksiMakanan" name="reaksiMakanan" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['reaksiMakanan'] ?? '' ?>">
                                                </div>

                                                <!-- Baris 3: Lain-lain -->
                                                <div class="form-check mb-0 ms-md-3 ms-1 d-flex flex-wrap align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="riwayatAlergi[]" id="alergiLainnya" value="Lain-lain" <?= (in_array("Lain-lain", (array)($data->rm7bPengkajian['riwayatAlergi'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="alergiLainnya">
                                                        Lain-lain
                                                    </label>
                                                    <input type="text" id="jenisAlergiLainnya" name="jenisAlergiLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisAlergiLainnya'] ?? '' ?>">
                                                    <label class="small text-nowrap ms-1">Reaksi :</label>
                                                    <input type="text" id="reaksiLainnya" name="reaksiLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['reaksiLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info mb-0" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Status fungsional :</div>
                                    <hr>
                                </div>

                                <!-- Form Penurunan Berat Badan (MST) - Horizontal Style -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    Apakah pasien mengalami penurunan BB yang tidak diinginkan dalam 6 bulan terakhir :
                                                </label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bbTidakAda" value="0" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bbTidakAda">Tidak ada penurunan BB (skor 0)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bb1_5" value="1" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "1") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bb1_5">1 - 5 kg (skor 1)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bb6_10" value="2" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "2") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bb6_10">6 - 10 kg (skor 2)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bb11_15" value="3" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "3") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bb11_15">11 - 15 kg (skor 3)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bbLebih15" value="4" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "4") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bbLebih15">&gt; 15 kg (skor 4)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="penurunanBb" id="bbTidakYakin" value="2_yakin" <?= (($data->rm7bPengkajian["penurunanBb"] ?? '') == "2_yakin") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="bbTidakYakin">Tidak yakin / tidak tahu (ada tanda baju menjadi lebih longgar) (skor 2)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Form Asupan Makan (MST) - Horizontal Style -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    Apakah asupan makan pasien berkurang karena penurunan nafsu makan/kesulitan menerima makanan :
                                                </label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="asupanMakan" id="asupanMakanYa" value="1" <?= (($data->rm7bPengkajian["asupanMakan"] ?? '') == "1") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="asupanMakanYa">Ya (skor 1)</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="asupanMakan" id="asupanMakanTidak" value="0" <?= (($data->rm7bPengkajian["asupanMakan"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="asupanMakanTidak">Tidak (skor 0)</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-12">
                                        <label class="form-label fw-bold small mb-0 ms-1">Total Skor :</label>
                                        <input type="text" id="skorStatus" name="skorStatus" value="<?= $data->rm7bPengkajian["skorStatus"] ?? '' ?>" readonly class="form-control">
                                    </div>
                                </div>

                                <script>
                                    $(document).ready(function() {
                                        // Fungsi untuk menghitung total skor MST
                                        function hitungTotalSkor() {
                                            let totalSkor = 0;

                                            // 1. Ambil skor penurunan BB
                                            let valBb = $('input[name="penurunanBb"]:checked').val();
                                            if (valBb !== undefined && valBb !== '') {
                                                // parseInt('2_yakin', 10) akan menghasilkan angka 2
                                                totalSkor += parseInt(valBb, 10);
                                            }

                                            // 2. Ambil skor asupan makan
                                            let valAsupan = $('input[name="asupanMakan"]:checked').val();
                                            if (valAsupan !== undefined && valAsupan !== '') {
                                                totalSkor += parseInt(valAsupan, 10);
                                            }

                                            // Tampilkan hasil total skor ke input #skorStatus
                                            $('#skorStatus').val(totalSkor);
                                        }

                                        // Jalankan fungsi saat opsi radio berubah (diklik)
                                        $('input[name="penurunanBb"], input[name="asupanMakan"]').on('change', function() {
                                            hitungTotalSkor();
                                        });

                                        // Jalankan sekali saat halaman pertama kali dimuat (untuk kondisi edit/data terisi)
                                        hitungTotalSkor();
                                    });
                                </script>


                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2">
                                            <label class="form-label fw-bold small text-secondary mb-2 ms-1">
                                                Pasien dengan diagnosa khusus :
                                            </label>

                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagFrakturPanggul" value="Fraktur tulang panggul" <?= (in_array("Fraktur tulang panggul", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagFrakturPanggul">Fraktur tulang panggul</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagSirosisHati" value="Sirosis hati" <?= (in_array("Sirosis hati", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagSirosisHati">Sirosis hati</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagPpok" value="PPOK" <?= (in_array("PPOK", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagPpok">PPOK</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagHemodialisis" value="Hemodialisis" <?= (in_array("Hemodialisis", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagHemodialisis">Hemodialisis</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagDiabetes" value="Diabetes" <?= (in_array("Diabetes", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagDiabetes">Diabetes</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagKanker" value="Kanker" <?= (in_array("Kanker", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagKanker">Kanker</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagBedahDigestive" value="Bedah digestive" <?= (in_array("Bedah digestive", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagBedahDigestive">Bedah digestive</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagStroke" value="Stroke" <?= (in_array("Stroke", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagStroke">Stroke</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagPneumoniaBerat" value="Pneumonia berat" <?= (in_array("Pneumonia berat", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagPneumoniaBerat">Pneumonia berat</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagCederaKepala" value="Cedera kepala" <?= (in_array("Cedera kepala", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagCederaKepala">Cedera kepala</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagTransplantasi" value="Transplantasi" <?= (in_array("Transplantasi", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagTransplantasi">Transplantasi</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagLukaBakar" value="Luka bakar" <?= (in_array("Luka bakar", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagLukaBakar">Luka bakar</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagIcuHcu" value="Pasien kritis di ICU/HCU" <?= (in_array("Pasien kritis di ICU/HCU", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagIcuHcu">Pasien kritis di ICU/HCU</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagUsiaLanjut" value="Usia lanjut" <?= (in_array("Usia lanjut", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagUsiaLanjut">Usia lanjut</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagPsikiatri" value="Psikiatri" <?= (in_array("Psikiatri", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagPsikiatri">Psikiatri</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagKemoterapi" value="Mendapat kemoterapi" <?= (in_array("Mendapat kemoterapi", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagKemoterapi">Mendapat kemoterapi</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="diagnosaKhusus[]" id="diagImunitasRendah" value="Imunitas rendah/HIV-AIDS" <?= (in_array("Imunitas rendah/HIV-AIDS", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagImunitasRendah">Imunitas rendah/HIV-AIDS</label>
                                                </div>

                                                <div class="form-check me-1 mb-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="diagnosaKhusus[]" id="diagPenyakitKronisLain" value="Penyakit kronis lain" <?= (in_array("Penyakit kronis lain", (array)($data->rm7bPengkajian['diagnosaKhusus'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="diagPenyakitKronisLain">
                                                        Penyakit kronis lain :
                                                    </label>
                                                    <input type="text" id="penyakitKronisLainnya" name="penyakitKronisLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['penyakitKronisLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2">
                                            <label class="form-label fw-bold small text-secondary mb-2 ms-1">
                                                Keluhan Lain :
                                            </label>

                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanTidakAda" value="Tidak ada keluhan" <?= (in_array("Tidak ada keluhan", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanTidakAda">Tidak ada keluhan</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanNafsuMakanMenurun" value="Nafsu makan menurun" <?= (in_array("Nafsu makan menurun", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanNafsuMakanMenurun">Nafsu makan menurun</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanMual" value="Mual" <?= (in_array("Mual", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanMual">Mual</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanMuntah" value="Muntah" <?= (in_array("Muntah", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanMuntah">Muntah</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanMulutKulitKering" value="Mulut/kulit kering" <?= (in_array("Mulut/kulit kering", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanMulutKulitKering">Mulut/kulit kering</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanAkralDingin" value="Akral dingin" <?= (in_array("Akral dingin", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanAkralDingin">Akral dingin</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanOedema" value="Oedema" <?= (in_array("Oedema", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanOedema">Oedema</label>
                                                </div>

                                                <div class="form-check me-1 mb-1">
                                                    <input class="form-check-input" type="checkbox" name="keluhanLain[]" id="keluhanMukosa" value="Mukosa" <?= (in_array("Mukosa", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="keluhanMukosa">Mukosa</label>
                                                </div>

                                                <div class="form-check me-1 mb-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="keluhanLain[]" id="keluhanDiet" value="Diet" <?= (in_array("Diet", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="keluhanDiet">
                                                        Diet :
                                                    </label>
                                                    <input type="text" id="jenisDiet" name="jenisDiet" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['jenisDiet'] ?? '' ?>">
                                                </div>

                                                <div class="form-check me-1 mb-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="keluhanLain[]" id="keluhanLainnya" value="Lainnya" <?= (in_array("Lainnya", (array)($data->rm7bPengkajian['keluhanLain'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="keluhanLainnya">
                                                        Lainnya :
                                                    </label>
                                                    <input type="text" id="keluhanLainnyaInput" name="keluhanLainnyaInput" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['keluhanLainnyaInput'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Eliminasi dan Pelepasan -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-secondary d-block mb-2">
                                                Eliminasi dan pelepasan
                                            </label>

                                            <div class="row g-2">
                                                <!-- ================= BAK SECTION ================= -->
                                                <div class="col-12">
                                                    <span class="fw-bold text-secondary small me-2">BAK :</span>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                                        <div class="form-check mb-0 me-1">
                                                            <input class="form-check-input" type="radio" name="keluhanBak" id="keluhanBakTidak" value="Tidak" <?= (($data->rm7bPengkajian["keluhanBak"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="keluhanBakTidak">Tidak ada keluhan</label>
                                                        </div>

                                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                            <input class="form-check-input mt-0" type="radio" name="keluhanBak" id="keluhanBakAda" value="Ada" <?= (($data->rm7bPengkajian["keluhanBak"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                            <label class="form-check-label small text-nowrap" for="keluhanBakAda">Ada keluhan :</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- BAK Frekuensi -->
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Frekuensi</span>
                                                        <input type="number" class="form-control" name="bakFrekuensi" value="<?= $data->rm7bPengkajian["bakFrekuensi"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/hr</span>
                                                    </div>
                                                </div>

                                                <!-- BAK Volume -->
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Volume</span>
                                                        <input type="number" class="form-control" name="bakVolume" value="<?= $data->rm7bPengkajian["bakVolume"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">cc</span>
                                                    </div>
                                                </div>

                                                <!-- BAK Warna -->
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Warna</span>
                                                        <input type="text" class="form-control" name="bakWarna" value="<?= $data->rm7bPengkajian["bakWarna"] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <!-- BAK Keluhan -->
                                                <div class="col-12 mb-2">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Keluhan BAK</span>
                                                        <input type="text" class="form-control" name="bakKeluhan" value="<?= $data->rm7bPengkajian["bakKeluhan"] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- ================= BAB SECTION ================= -->
                                                <div class="col-12 mt-2">
                                                    <span class="fw-bold text-secondary small me-2">BAB :</span>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="d-flex flex-wrap gap-2 align-items-center">
                                                        <div class="form-check mb-0 me-1">
                                                            <input class="form-check-input" type="radio" name="keluhanBab" id="keluhanBabTidak" value="Tidak" <?= (($data->rm7bPengkajian["keluhanBab"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                            <label class="form-check-label small" for="keluhanBabTidak">Tidak ada keluhan</label>
                                                        </div>

                                                        <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                            <input class="form-check-input mt-0" type="radio" name="keluhanBab" id="keluhanBabAda" value="Ada" <?= (($data->rm7bPengkajian["keluhanBab"] ?? '') === "Ada") ? 'checked' : '' ?>>
                                                            <label class="form-check-label small text-nowrap" for="keluhanBabAda">Ada keluhan :</label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- BAB Frekuensi -->
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Frekuensi</span>
                                                        <input type="number" class="form-control" name="babFrekuensi" value="<?= $data->rm7bPengkajian["babFrekuensi"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/hr</span>
                                                    </div>
                                                </div>

                                                <!-- BAB Konsistensi -->
                                                <div class="col-md-4 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Konsistensi</span>
                                                        <input type="text" class="form-control" name="babKonsistensi" value="<?= $data->rm7bPengkajian["babKonsistensi"] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <!-- BAB Warna -->
                                                <div class="col-md-4 col-sm-12">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Warna</span>
                                                        <input type="text" class="form-control" name="babWarna" value="<?= $data->rm7bPengkajian["babWarna"] ?? '' ?>">
                                                    </div>
                                                </div>

                                                <!-- BAB Keluhan -->
                                                <div class="col-12">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Keluhan BAB</span>
                                                        <input type="text" class="form-control" name="babKeluhan" value="<?= $data->rm7bPengkajian["babKeluhan"] ?? '' ?>">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Aktifitas dan Istirahat -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-secondary d-block mb-2">
                                                Aktifitas dan Istirahat
                                            </label>

                                            <div class="d-flex flex-column gap-2">
                                                <!-- Tidur / Istirahat -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tidur / Istirahat :</label>
                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="tidurIstirahat" id="tidurTidakAdaKeluhan" value="Tidak ada keluhan" <?= (($data->rm7bPengkajian["tidurIstirahat"] ?? '') == "Tidak ada keluhan") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="tidurTidakAdaKeluhan">Tidak ada keluhan</label>
                                                    </div>
                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="tidurIstirahat" id="tidurAdaKeluhan" value="Ada keluhan" <?= (($data->rm7bPengkajian["tidurIstirahat"] ?? '') == "Ada keluhan") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="tidurAdaKeluhan">Ada keluhan</label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm ms-2" style="width: 250px;" name="tidurIstirahatKet" value="<?= $data->rm7bPengkajian["tidurIstirahatKet"] ?? '' ?>" placeholder="Keterangan keluhan...">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- Aktivitas / Latihan dan Perawatan Diri -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Aktivitas / Latihan dan Perawatan Diri :</label>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="aktivitasLatihan" id="aktMandiri" value="Mandiri" <?= (($data->rm7bPengkajian["aktivitasLatihan"] ?? '') == "Mandiri") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="aktMandiri">Mandiri</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="aktivitasLatihan" id="aktPerluPengawasan" value="Perlu Pengawasan" <?= (($data->rm7bPengkajian["aktivitasLatihan"] ?? '') == "Perlu Pengawasan") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="aktPerluPengawasan">Perlu Pengawasan</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="aktivitasLatihan" id="aktBantuanSebagian" value="Bantuan Sebagian" <?= (($data->rm7bPengkajian["aktivitasLatihan"] ?? '') == "Bantuan Sebagian") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="aktBantuanSebagian">Bantuan Sebagian</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="aktivitasLatihan" id="aktBantuanTotal" value="Bantuan Total" <?= (($data->rm7bPengkajian["aktivitasLatihan"] ?? '') == "Bantuan Total") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="aktBantuanTotal">Bantuan Total</label>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- Alat Bantu -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Alat Bantu :</label>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="alatBantu" id="alatBantuTidak" value="Tidak" <?= (($data->rm7bPengkajian["alatBantu"] ?? '') == "Tidak") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="alatBantuTidak">Tidak</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="alatBantu" id="alatBantuYa" value="Ya" <?= (($data->rm7bPengkajian["alatBantu"] ?? '') == "Ya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="alatBantuYa">Ya</label>
                                                    </div>

                                                    <input type="text" class="form-control form-control-sm ms-2" style="width: 250px;" name="alatBantuKet" value="<?= $data->rm7bPengkajian["alatBantuKet"] ?? '' ?>" placeholder="Sebutkan jenis alat bantu...">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <!-- KOLOM KANAN (col-6) -->
                        <div class="col-sm-6">


                            <div class="alert alert-info" role="alert">

                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Psikologis dan ekonomi :</div>
                                    <hr>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-column gap-1">
                                                <!-- Baris 1: Label & Opsi 1-4 -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">Keadaan Psikologis :</label>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisKooperatif" value="Kooperatif" <?= (in_array("Kooperatif", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisKooperatif">Kooperatif</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisSedih" value="Sedih" <?= (in_array("Sedih", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisSedih">Sedih</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisMarah" value="Marah" <?= (in_array("Marah", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisMarah">Marah</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisDisorientasi" value="Disorientasi" <?= (in_array("Disorientasi", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisDisorientasi">Disorientasi</label>
                                                    </div>
                                                </div>

                                                <!-- Baris 2: Opsi 5-7 & Lainnya -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center ms-md-4 ms-1">
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisAgitasi" value="Agitasi" <?= (in_array("Agitasi", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisAgitasi">Agitasi</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisCemas" value="Cemas" <?= (in_array("Cemas", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisCemas">Cemas</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="keadaanPsikologis[]" id="psikologisGelisah" value="Gelisah" <?= (in_array("Gelisah", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="psikologisGelisah">Gelisah</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                        <input class="form-check-input mt-0" type="checkbox" name="keadaanPsikologis[]" id="psikologisLainnya" value="Lainnya" <?= (in_array("Lainnya", (array)($data->rm7bPengkajian['keadaanPsikologis'] ?? []))) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small text-nowrap" for="psikologisLainnya">
                                                            Lainnya :
                                                        </label>
                                                        <input type="text" id="keadaanPsikologisLainnya" name="keadaanPsikologisLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['keadaanPsikologisLainnya'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tingkat Pendidikan :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanBelumSekolah" value="Belum Sekolah" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Belum Sekolah") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanBelumSekolah">Belum Sekolah</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanSd" value="SD" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "SD") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanSd">SD</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanSmp" value="SMP" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "SMP") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanSmp">SMP</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanSma" value="SMA" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "SMA") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanSma">SMA</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanDiploma" value="Diploma" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Diploma") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanDiploma">Diploma</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanSarjana" value="Sarjana" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Sarjana") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanSarjana">Sarjana</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="tingkatPendidikan" id="pendidikanPascaSarjana" value="Pasca Sarjana" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Pasca Sarjana") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pendidikanPascaSarjana">Pasca Sarjana</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="radio" name="tingkatPendidikan" id="pendidikanLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="pendidikanLainnya">
                                                        Lainnya :
                                                    </label>
                                                    <input type="text" id="tingkatPendidikanLainnya" name="tingkatPendidikanLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['tingkatPendidikanLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Pekerjaan :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="pekerjaan" id="pekerjaanWiraswasta" value="Wiraswasta" <?= (($data->rm7bPengkajian["pekerjaan"] ?? '') === "Wiraswasta") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pekerjaanWiraswasta">Wiraswasta</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="pekerjaan" id="pekerjaanSwasta" value="Swasta" <?= (($data->rm7bPengkajian["pekerjaan"] ?? '') === "Swasta") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pekerjaanSwasta">Swasta</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="pekerjaan" id="pekerjaanPensiunan" value="Pensiunan" <?= (($data->rm7bPengkajian["pekerjaan"] ?? '') === "Pensiunan") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="pekerjaanPensiunan">Pensiunan</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="radio" name="pekerjaan" id="pekerjaanLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["pekerjaan"] ?? '') === "Lainnya") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="pekerjaanLainnya">
                                                        Lainnya :
                                                    </label>
                                                    <input type="text" id="pekerjaanLainnyaInput" name="pekerjaanLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['pekerjaanLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Tinggal Bersama :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalSuamiIstri" value="Suami/Istri" <?= (in_array("Suami/Istri", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalSuamiIstri">Suami/Istri</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalAnak" value="Anak" <?= (in_array("Anak", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalAnak">Anak</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalTeman" value="Teman" <?= (in_array("Teman", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalTeman">Teman</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalOrangTua" value="Orang Tua" <?= (in_array("Orang Tua", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalOrangTua">Orang Tua</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalSendiri" value="Sendiri" <?= (in_array("Sendiri", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalSendiri">Sendiri</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="tinggalBersama[]" id="tinggalCaregiver" value="Caregiver" <?= (in_array("Caregiver", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="tinggalCaregiver">Caregiver</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="checkbox" name="tinggalBersama[]" id="tinggalLainnya" value="Lainnya" <?= (in_array("Lainnya", (array)($data->rm7bPengkajian['tinggalBersama'] ?? []))) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="tinggalLainnya">
                                                        Lainnya :
                                                    </label>
                                                    <input type="text" id="tinggalBersamaLainnya" name="tinggalBersamaLainnya" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['tinggalBersamaLainnya'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Status Ekonomi :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="statusEkonomi" id="ekonomiUmum" value="Umum" <?= (($data->rm7bPengkajian["statusEkonomi"] ?? '') === "Umum") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ekonomiUmum">Umum</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="statusEkonomi" id="ekonomiBpjs" value="BPJS" <?= (($data->rm7bPengkajian["statusEkonomi"] ?? '') === "BPJS") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ekonomiBpjs">BPJS</label>
                                                </div>

                                                <div class="form-check mb-0 me-1 d-inline-flex align-items-center gap-2">
                                                    <input class="form-check-input mt-0" type="radio" name="statusEkonomi" id="ekonomiAsuransi" value="Asuransi" <?= (($data->rm7bPengkajian["statusEkonomi"] ?? '') === "Asuransi") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small text-nowrap" for="ekonomiAsuransi">
                                                        Asuransi :
                                                    </label>
                                                    <input type="text" id="namaAsuransi" name="namaAsuransi" class="form-control form-control-sm" style="width: auto;" value="<?= $data->rm7bPengkajian['namaAsuransi'] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Spiritual :</div>
                                    <hr>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Menjalankan ibadah :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="menjalankanIbadah" id="ibadahAdaHambatan" value="Ada Hambatan" <?= (($data->rm7bPengkajian["menjalankanIbadah"] ?? '') === "Ada Hambatan") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ibadahAdaHambatan">Ada Hambatan</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="menjalankanIbadah" id="ibadahTidakAdaHambatan" value="Tidak Ada Hambatan" <?= (($data->rm7bPengkajian["menjalankanIbadah"] ?? '') === "Tidak Ada Hambatan") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="ibadahTidakAdaHambatan">Tidak Ada Hambatan</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Persepsi terhadap Sakit :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="persepsiSakit" id="persepsiTidakAdaKeluhan" value="Tidak Ada Keluhan" <?= (($data->rm7bPengkajian["persepsiSakit"] ?? '') === "Tidak Ada Keluhan") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="persepsiTidakAdaKeluhan">Tidak Ada Keluhan</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="persepsiSakit" id="persepsiRasaBersalah" value="Rasa Bersalah" <?= (($data->rm7bPengkajian["persepsiSakit"] ?? '') === "Rasa Bersalah") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="persepsiRasaBersalah">Rasa Bersalah</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Meminta Pelayanan Spiritual :</label>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="pelayananSpiritual" id="spiritualTidak" value="Tidak" <?= (($data->rm7bPengkajian["pelayananSpiritual"] ?? '') === "Tidak") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="spiritualTidak">Tidak</label>
                                                </div>

                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="radio" name="pelayananSpiritual" id="spiritualYa" value="Ya" <?= (($data->rm7bPengkajian["pelayananSpiritual"] ?? '') === "Ya") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="spiritualYa">
                                                        Ya, <span class="fst-italic text-muted">(Lakukan Kolaborasi dengan Bagian Kerohanian)</span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Pengkajian nyeri :</div>
                                    <hr>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-8">
                                        <img src="<?= base_url("/public/assets/img/skalanyeri.jpg") ?>" alt="Skala nyeri" style="width: 100%;">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Skla nyeri :</label>
                                        <input type="number" id="skalaNyeri" name="skalaNyeri" value="<?= $data->rm7bPengkajian["skalaNyeri"] ?? '' ?>" class="form-control">

                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jam :</label>
                                        <input type="time" id="jamNyeri" name="jamNyeri" value="<?= $data->rm7bPengkajian["jamNyeri"] ?? '' ?>" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Resiko jatuh skala morse :</div>
                                    <hr>
                                </div>

                                <!-- Baris 1: Riwayat Jatuh -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Riwayat jatuh baru atau 3 bulan terakhir :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="riwayatJatuh" id="riwayatJatuhYa" value="25" <?= (($data->rm7bPengkajian["riwayatJatuh"] ?? '') == "25") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="riwayatJatuhYa">Ya : 25</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="riwayatJatuh" id="riwayatJatuhTidak" value="0" <?= (($data->rm7bPengkajian["riwayatJatuh"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="riwayatJatuhTidak">Tidak : 0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 2: Diagnosa Skunder -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Diagnosa skunder :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="diagnosaSkunder" id="diagnosaSkunderYa" value="15" <?= (($data->rm7bPengkajian["diagnosaSkunder"] ?? '') == "15") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagnosaSkunderYa">Ya : 15</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="diagnosaSkunder" id="diagnosaSkunderTidak" value="0" <?= (($data->rm7bPengkajian["diagnosaSkunder"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="diagnosaSkunderTidak">Tidak : 0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 3: Menggunakan Alat Bantu -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Menggunakan alat bantu :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="alatBantu2" id="alatBantuBedrest" value="0" <?= (($data->rm7bPengkajian["alatBantu2"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="alatBantuBedrest">Bedrest/ dibantu perawat : 0</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="alatBantu2" id="alatBantuTongkat" value="15" <?= (($data->rm7bPengkajian["alatBantu2"] ?? '') == "15") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="alatBantuTongkat">Menggunakan tongkat / kruk: 15</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="alatBantu2" id="alatBantuFurnitur" value="30" <?= (($data->rm7bPengkajian["alatBantu2"] ?? '') == "30") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small fst-italic" for="alatBantuFurnitur">Furnitur : 30</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 4: Menggunakan Infus -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Menggunakan infus :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="menggunakanInfus" id="infusYa" value="20" <?= (($data->rm7bPengkajian["menggunakanInfus"] ?? '') == "20") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="infusYa">Ya : 20</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="menggunakanInfus" id="infusTidak" value="0" <?= (($data->rm7bPengkajian["menggunakanInfus"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="infusTidak">Tidak : 0</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 5: Gaya Berjalan -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1 mb-2">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Gaya berjalan :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="gayaBerjalan" id="gayaNormal" value="0" <?= (($data->rm7bPengkajian["gayaBerjalan"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="gayaNormal">Normal : 0</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="gayaBerjalan" id="gayaLemah" value="10" <?= (($data->rm7bPengkajian["gayaBerjalan"] ?? '') == "10") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="gayaLemah">Lemah : 10</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="gayaBerjalan" id="gayaTerganggu" value="20" <?= (($data->rm7bPengkajian["gayaBerjalan"] ?? '') == "20") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="gayaTerganggu">Terganggu : 20</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Baris 6: Status Mental -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-2 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">Status Mental :</label>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="statusMental" id="mentalOrientasi" value="0" <?= (($data->rm7bPengkajian["statusMental"] ?? '') == "0") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="mentalOrientasi">Orientasi sesuai dengan kemampuan diri : 0</label>
                                                </div>

                                                <div class="form-check mb-0 me-2">
                                                    <input class="form-check-input" type="radio" name="statusMental" id="mentalLupa" value="15" <?= (($data->rm7bPengkajian["statusMental"] ?? '') == "15") ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="mentalLupa">Lupa keterbatasan diri : 15</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small mb-0 text-nowrap">SKOR :</label>
                                        <input type="text" id="skorJatuh" name="skorJatuh" value="<?= $data->rm7bPengkajian["skorJatuh"] ?? '' ?>" class="form-control" readonly>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small mb-0 text-nowrap">STATUS :</label>
                                        <input type="text" id="statusJatuh" name="statusJatuh" value="<?= $data->rm7bPengkajian["statusJatuh"] ?? '' ?>" class="form-control" readonly>
                                    </div>
                                </div>

                                <hr>

                                <div class="alert alert-warning mt-3 d-none" id="sectionIntervensi">
                                    <h6 class="fw-bold border-bottom pb-2 mb-3">Intervensi Pencegahan Resiko Jatuh (Skala Morse)</h6>

                                    <div id="intervensiRendah" class="d-none mb-3">
                                        <label class="fw-bold text-dark mb-2">Resiko Rendah :</label>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Orientasi Lingkungan" id="ir1">
                                            <label class="form-check-label" for="ir1">Orientasi Lingkungan</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Roda tempat tidur berada dalam posisi terkunci" id="ir2">
                                            <label class="form-check-label" for="ir2">Roda tempat tidur berada dalam posisi terkunci</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Posisikan tempat tidur pada posisi rendah" id="ir3">
                                            <label class="form-check-label" for="ir3">Posisikan tempat tidur pada posisi rendah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Naikan pagar pengaman tempat tidur" id="ir4">
                                            <label class="form-check-label" for="ir4">Naikan pagar pengaman tempat tidur</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Berikan edukasi pasien" id="ir5">
                                            <label class="form-check-label" for="ir5">Berikan edukasi pasien</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-rendah" type="checkbox" name="intervensi[]" value="Pastikan kebutuhan pribadi dalam jangkauan" id="ir6">
                                            <label class="form-check-label" for="ir6">Pastikan kebutuhan pribadi dalam jangkauan</label>
                                        </div>
                                    </div>

                                    <div id="intervensiTinggi" class="d-none">
                                        <label class="fw-bold text-danger mb-2">Resiko Tinggi :</label>
                                        <div class="form-check">
                                            <input class="form-check-input chk-tinggi" type="checkbox" name="intervensi[]" value="Lakukan semua pedoman pencegahan jatuh risiko rendah" id="it1">
                                            <label class="form-check-label" for="it1">Lakukan semua pedoman pencegahan jatuh risiko rendah</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-tinggi" type="checkbox" name="intervensi[]" value="Berikan tanda risiko jatuh pada bed pasien" id="it2">
                                            <label class="form-check-label" for="it2">Berikan tanda risiko jatuh pada bed pasien</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-tinggi" type="checkbox" name="intervensi[]" value="Berikan kancing kuning pada gelang identitas" id="it3">
                                            <label class="form-check-label" for="it3">Berikan kancing kuning pada gelang identitas</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-tinggi" type="checkbox" name="intervensi[]" value="Kunjungi dan monitor pasien setiap 1 jam" id="it4">
                                            <label class="form-check-label" for="it4">Kunjungi dan monitor pasien setiap 1 jam</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input chk-tinggi" type="checkbox" name="intervensi[]" value="Libatkan keluarga untuk membantu pasien" id="it5">
                                            <label class="form-check-label" for="it5">Libatkan keluarga untuk membantu pasien</label>
                                        </div>
                                    </div>
                                </div>

                                <script>
                                    $(document.ready ? $(document).ready(initMorse) : $(initMorse));

                                    function initMorse() {
                                        const radioNames = [
                                            'riwayatJatuh',
                                            'diagnosaSkunder',
                                            'alatBantu2',
                                            'menggunakanInfus',
                                            'gayaBerjalan',
                                            'statusMental'
                                        ];

                                        function updateIntervensi(status) {
                                            // Reset/Sembunyikan semua section & uncheck semua checkbox
                                            $('#sectionIntervensi, #intervensiRendah, #intervensiTinggi').addClass('d-none');
                                            $('.chk-rendah, .chk-tinggi').prop('checked', false);

                                            if (status === 'Resiko Rendah') {
                                                // Tampilkan section & opsi Resiko Rendah, lalu auto-check
                                                $('#sectionIntervensi, #intervensiRendah').removeClass('d-none');
                                                $('.chk-rendah').prop('checked', true);

                                            } else if (status === 'Resiko Tinggi') {
                                                // Tampilkan semua (Rendah & Tinggi), lalu auto-check semua
                                                $('#sectionIntervensi, #intervensiRendah, #intervensiTinggi').removeClass('d-none');
                                                $('.chk-rendah, .chk-tinggi').prop('checked', true);
                                            }
                                        }

                                        function hitungSkorMorse() {
                                            let totalSkor = 0;

                                            // Hitung akumulasi skor dari radio button yang tercentang
                                            radioNames.forEach(function(name) {
                                                let val = $(`input[name="${name}"]:checked`).val();
                                                if (val) {
                                                    totalSkor += parseInt(val, 10);
                                                }
                                            });

                                            // Penentuan Status berdasarkan acuan rentang skor
                                            let status = '';
                                            if (totalSkor <= 24) {
                                                status = 'Tidak Beresiko';
                                            } else if (totalSkor <= 50) {
                                                status = 'Resiko Rendah';
                                            } else {
                                                status = 'Resiko Tinggi';
                                            }

                                            // Set nilai ke input text
                                            $('#skorJatuh').val(totalSkor);
                                            $('#statusJatuh').val(status);

                                            // Update bagian intervensi
                                            updateIntervensi(status);
                                        }

                                        // Jalankan kalkulasi saat ada perubahan radio button
                                        $('input[type=radio]').on('change', hitungSkorMorse);

                                        // Jalankan kalkulasi awal saat halaman dimuat (untuk data yang sudah terisi dari PHP)
                                        hitungSkorMorse();
                                    }
                                </script>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="data-ojektif" role="tabpanel" aria-labelledby="data-ojektif-tab">
            <div class="row">
                <div class="container mt-3">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Pemeriksaan umum :</div>
                                    <hr>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Keadaan umum :</label>
                                        <input type="text" id="keadaanUmum" name="keadaanUmum" value="<?= $data->rm7bPengkajian["keadaanUmum"] ?? '' ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kesadaran :</label>
                                        <input type="text" id="kesadaran" name="kesadaran" value="<?= $data->rm7bPengkajian["kesadaran"] ?? '' ?>" class="form-control">
                                    </div>
                                </div>

                                <!-- Section Tanda Vital -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-dark d-block mb-2">
                                                Tanda Vital :
                                            </label>

                                            <div class="row g-2">
                                                <!-- TD (Tekanan Darah) -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">TD</span>
                                                        <input type="text" class="form-control" name="td" value="<?= $data->rm7bPengkajian["td"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">mmHg</span>
                                                    </div>
                                                </div>

                                                <!-- RR (Respiration Rate) & Keteraturan -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">RR</span>
                                                        <input type="number" class="form-control" name="rr" value="<?= $data->rm7bPengkajian["rr"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/mnt</span>
                                                        <select class="form-select" name="rrTeratur">
                                                            <option value="Teratur" <?= (($data->rm7bPengkajian["rrTeratur"] ?? '') == "Teratur") ? 'selected' : '' ?>>Teratur</option>
                                                            <option value="Tidak" <?= (($data->rm7bPengkajian["rrTeratur"] ?? '') == "Tidak") ? 'selected' : '' ?>>Tidak</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Nadi -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Nadi</span>
                                                        <input type="number" class="form-control" name="nadi" value="<?= $data->rm7bPengkajian["nadi"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/mnt</span>
                                                    </div>
                                                </div>

                                                <!-- Suhu Aksila -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Suhu Aksila</span>
                                                        <input type="text" class="form-control" name="suhuAksila" value="<?= $data->rm7bPengkajian["suhuAksila"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">°C</span>
                                                    </div>
                                                </div>

                                                <!-- Suhu Rectal -->
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="input-group input-group-sm">
                                                        <span class="input-group-text bg-light text-secondary">Suhu Rectal</span>
                                                        <input type="text" class="form-control" name="suhuRectal" value="<?= $data->rm7bPengkajian["suhuRectal"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">°C</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>

                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Pemeriksaan Fisik (Abdomen) :</div>
                                    <hr>
                                </div>

                                <!-- Section Inspeksi -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-dark d-block mb-2">
                                                Inspeksi :
                                            </label>

                                            <div class="d-flex flex-column gap-1">

                                                <!-- 1. Bekas Operasi (disertai input lokasi jika Ada) -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Bekas Operasi :
                                                    </label>

                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="bekasOperasi" id="bekasOpTidakAda" value="Tidak Ada" <?= (($data->rm7bPengkajian["bekasOperasi"] ?? '') == "Tidak Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="bekasOpTidakAda">Tidak Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 ">
                                                        <input class="form-check-input" type="radio" name="bekasOperasi" id="bekasOpAda" value="Ada" <?= (($data->rm7bPengkajian["bekasOperasi"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="bekasOpAda">Ada</label>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 2. Linea Nigra -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Linea Nigra :
                                                    </label>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="lineaNigra" id="lineaNigraAda" value="Ada" <?= (($data->rm7bPengkajian["lineaNigra"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="lineaNigraAda">Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="lineaNigra" id="lineaNigraTidak" value="Tidak Ada" <?= (($data->rm7bPengkajian["lineaNigra"] ?? '') == "Tidak Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="lineaNigraTidak">Tidak Ada</label>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 3. Linea Alba -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Linea Alba :
                                                    </label>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="lineaAlba" id="lineaAlbaAda" value="Ada" <?= (($data->rm7bPengkajian["lineaAlba"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="lineaAlbaAda">Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="lineaAlba" id="lineaAlbaTidak" value="Tidak" <?= (($data->rm7bPengkajian["lineaAlba"] ?? '') == "Tidak") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="lineaAlbaTidak">Tidak</label>
                                                    </div>
                                                </div>


                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 4. Ada Pembesaran -->
                                                <div class="d-flex flex-wrap gap-2 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Ada Pembesaran :
                                                    </label>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="adaPembesaran" id="pembesaranMemanjang" value="Memanjang" <?= (($data->rm7bPengkajian["adaPembesaran"] ?? '') == "Memanjang") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="pembesaranMemanjang">Memanjang</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="adaPembesaran" id="pembesaranMelebar" value="Melebar" <?= (($data->rm7bPengkajian["adaPembesaran"] ?? '') == "Melebar") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="pembesaranMelebar">Melebar</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-2">
                                                        <input class="form-check-input" type="radio" name="adaPembesaran" id="pembesaranLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["adaPembesaran"] ?? '') == "Lainnya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="pembesaranLainnya">Lainnya : </label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" style="width: 80px;" id="isiPembesaranLainnya" name="isiPembesaranLainnya" value="<?= $data->rm7bPengkajian["isiPembesaranLainnya"] ?? '' ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Palpasi -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-dark d-block mb-2">
                                                Palpasi :
                                            </label>

                                            <div class="d-flex flex-column gap-1">
                                                <!-- 1. TFU -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        TFU :
                                                    </label>
                                                    <div class="input-group input-group-sm" style="width: 200px;">
                                                        <input type="number" step="0.1" class="form-control" name="tfu" value="<?= $data->rm7bPengkajian["tfu"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">cm</span>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 2. Involusi Uteri -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Involusi Uteri :
                                                    </label>
                                                    <input type="text" class="form-control form-control-sm" style="max-width: 400px;" name="involusiUteri" value="<?= $data->rm7bPengkajian["involusiUteri"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 3. Kontraksi Uteri & His/Lama -->
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    Kontraksi Uteri :
                                                </label>

                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kontraksiUteri" id="kontraksiTidakAda" value="Tidak Ada" <?= (($data->rm7bPengkajian["kontraksiUteri"] ?? '') == "Tidak Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kontraksiTidakAda">Tidak Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kontraksiUteri" id="kontraksiAda" value="Ada" <?= (($data->rm7bPengkajian["kontraksiUteri"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kontraksiAda">Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kontraksiUteri" id="kontraksiAdekuat" value="Adekuat" <?= (($data->rm7bPengkajian["kontraksiUteri"] ?? '') == "Adekuat") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kontraksiAdekuat">Adekuat</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kontraksiUteri" id="kontraksiInadekuat" value="Inadekuat" <?= (($data->rm7bPengkajian["kontraksiUteri"] ?? '') == "Inadekuat") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kontraksiInadekuat">Inadekuat</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kontraksiUteri" id="kontraksiLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["kontraksiUteri"] ?? '') == "Lainnya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kontraksiLainnya">Lainnya : </label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" style="width:80px;" name="isiKontraksiLainnya" id="isiKontraksiLainnya" value="<?= $data->rm7bPengkajian["isiKontraksiLainnya"] ?? '' ?>">

                                                    <!-- Input His & Lama -->
                                                    <div class="input-group input-group-sm ms-2" style="width: 180px;">
                                                        <span class="input-group-text bg-light text-secondary">His</span>
                                                        <input type="number" class="form-control" name="hisFrekuensi" value="<?= $data->rm7bPengkajian["hisFrekuensi"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/10mnt</span>
                                                    </div>

                                                    <div class="input-group input-group-sm ms-1" style="width: 170px;">
                                                        <span class="input-group-text bg-light text-secondary">Lama</span>
                                                        <input type="number" class="form-control" name="hisLama" value="<?= $data->rm7bPengkajian["hisLama"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">detik</span>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 4. Kelainan -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Kelainan :
                                                    </label>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kelainanPalpasi" id="kelainanNyeriTekan" value="Nyeri Tekan" <?= (($data->rm7bPengkajian["kelainanPalpasi"] ?? '') == "Nyeri Tekan") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanNyeriTekan">Nyeri Tekan</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kelainanPalpasi" id="kelainanCekungan" value="Cekungan pada perut" <?= (($data->rm7bPengkajian["kelainanPalpasi"] ?? '') == "Cekungan pada perut") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanCekungan">Cekungan pada perut</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kelainanPalpasi" id="kelainanBlassPenuh" value="Blass Penuh" <?= (($data->rm7bPengkajian["kelainanPalpasi"] ?? '') == "Blass Penuh") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanBlassPenuh">Blass Penuh</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="kelainanPalpasi" id="kelainanPalpasiLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["kelainanPalpasi"] ?? '') == "Lainnya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanPalpasiLainnya">Lainnya : </label>
                                                    </div>

                                                    <input type="text" class="form-control form-control-sm" style="width:80px;" id="isiKelainanPalpasiLainnya" name="isiKelainanPalpasiLainnya" value="<?= $data->rm7bPengkajian["isiKelainanPalpasiLainnya"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 5. Teraba Massa -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Teraba massa :
                                                    </label>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="terabaMassa" id="massaTidakAda" value="Tidak Ada" <?= (($data->rm7bPengkajian["terabaMassa"] ?? '') == "Tidak Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="massaTidakAda">Tidak Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="terabaMassa" id="massaAda" value="Ada" <?= (($data->rm7bPengkajian["terabaMassa"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="massaAda">Ada</label>
                                                    </div>

                                                    <!-- Input Ukuran Massa -->
                                                    <div class="input-group input-group-sm ms-2" style="width: 230px;">
                                                        <span class="input-group-text bg-light text-secondary">Ukuran</span>
                                                        <input type="text" class="form-control text-center" name="massaPanjang" value="<?= $data->rm7bPengkajian["massaPanjang"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x</span>
                                                        <input type="text" class="form-control text-center" name="massaLebar" value="<?= $data->rm7bPengkajian["massaLebar"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">cm</span>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Auskultasi -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-dark d-block mb-2">
                                                Auskultasi :
                                            </label>

                                            <div class="d-flex flex-column gap-1">
                                                <!-- 1. Campuran Bising Usus -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Campuran Bising Usus :
                                                    </label>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="bisingUsus" id="bisingUsusAda" value="Ada" <?= (($data->rm7bPengkajian["bisingUsus"] ?? '') == "Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="bisingUsusAda">Ada</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="bisingUsus" id="bisingUsusTidak" value="Tidak Ada" <?= (($data->rm7bPengkajian["bisingUsus"] ?? '') == "Tidak Ada") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="bisingUsusTidak">Tidak Ada</label>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 2. Denyut Jantung Janin (DJJ) -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Denyut Jantung Janin (DJJ) :
                                                    </label>

                                                    <!-- Input Frekuensi DJJ -->
                                                    <div class="input-group input-group-sm me-2" style="width: 170px;">
                                                        <input type="number" class="form-control" name="djjFrekuensi" value="<?= $data->rm7bPengkajian["djjFrekuensi"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">x/mnt</span>
                                                    </div>

                                                    <!-- Keteraturan DJJ -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="djjTeratur" id="djjTeraturYa" value="Teratur" <?= (($data->rm7bPengkajian["djjTeratur"] ?? '') == "Teratur") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="djjTeraturYa">Teratur</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="djjTeratur" id="djjTeraturTidak" value="Tidak Teratur" <?= (($data->rm7bPengkajian["djjTeratur"] ?? '') == "Tidak Teratur") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="djjTeraturTidak">Tidak Teratur</label>
                                                    </div>

                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="djjTeratur" id="djjTeraturLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["djjTeratur"] ?? '') == "Lainnya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="djjTeraturLainnya">Lainnya : </label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" style="width: 80px;;" id="isiDjjLainnya" name="isiDjjLainnya" value="<?= $data->rm7bPengkajian["isiDjjLainnya"] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="alert alert-info mb-0" role="alert">
                                    <div class="row mb-1">
                                        <div class="col-12 text-center h5">Pemeriksaan Fisik (Inspekulo Vagina) :</div>
                                        <hr>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="border border-info rounded p-1">
                                                <div class="d-flex flex-wrap gap-1 align-items-center">

                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Kelainan :
                                                    </label>

                                                    <!-- Fistel -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="kelainan[]" id="kelainanFistel" value="Fistel" <?= (in_array("Fistel", $data->rm7bPengkajian["kelainan"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanFistel">Fistel</label>
                                                    </div>

                                                    <!-- Condiloma -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="kelainan[]" id="kelainanCondiloma" value="Condiloma" <?= (in_array("Condiloma", $data->rm7bPengkajian["kelainan"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanCondiloma">Condiloma</label>
                                                    </div>

                                                    <!-- Septum -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="kelainan[]" id="kelainanSeptum" value="Septum" <?= (in_array("Septum", $data->rm7bPengkajian["kelainan"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanSeptum">Septum</label>
                                                    </div>

                                                    <!-- Varises -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="kelainan[]" id="kelainanVarises" value="Varises" <?= (in_array("Varises", $data->rm7bPengkajian["kelainan"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanVarises">Varises</label>
                                                    </div>

                                                    <!-- Lainnya + Input Text -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="checkbox" name="kelainan[]" id="kelainanLainnya" value="Lainnya" <?= (in_array("Lainnya", $data->rm7bPengkajian["kelainan"] ?? [])) ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="kelainanLainnya">Lainnya :</label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" style="width: 100px;" name="kelainanLainnyaKet" value="<?= $data->rm7bPengkajian["kelainanLainnyaKet"] ?? '' ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="border border-info rounded p-1">
                                                <div class="d-flex flex-wrap gap-1 align-items-center">

                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Portio :
                                                    </label>

                                                    <!-- Utuh -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="portio" id="portioUtuh" value="Utuh" <?= (($data->rm7bPengkajian["portio"] ?? '') == "Utuh") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="portioUtuh">Utuh</label>
                                                    </div>

                                                    <!-- Rapuh -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="portio" id="portioRapuh" value="Rapuh" <?= (($data->rm7bPengkajian["portio"] ?? '') == "Rapuh") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="portioRapuh">Rapuh</label>
                                                    </div>

                                                    <!-- Lainnya + Input Text -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="portio" id="portioLainnya" value="Lainnya" <?= (($data->rm7bPengkajian["portio"] ?? '') == "Lainnya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="portioLainnya">Lainnya :</label>
                                                    </div>
                                                    <input type="text" class="form-control form-control-sm" style="width: 180px;" name="portioLainnyaKet" value="<?= $data->rm7bPengkajian["portioLainnyaKet"] ?? '' ?>">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <div class="border border-info rounded p-1">
                                                <div class="d-flex flex-wrap gap-1 align-items-center">

                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Cavum douglasi (Menonjol) :
                                                    </label>

                                                    <!-- Tidak -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="cavumDouglasi" id="cavumDouglasiTidak" value="Tidak" <?= (($data->rm7bPengkajian["cavumDouglasi"] ?? '') == "Tidak") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="cavumDouglasiTidak">Tidak</label>
                                                    </div>

                                                    <!-- Ya -->
                                                    <div class="form-check mb-0 me-1">
                                                        <input class="form-check-input" type="radio" name="cavumDouglasi" id="cavumDouglasiYa" value="Ya" <?= (($data->rm7bPengkajian["cavumDouglasi"] ?? '') == "Ya") ? 'checked' : '' ?>>
                                                        <label class="form-check-label small" for="cavumDouglasiYa">Ya</label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-1">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                Vagina Toucher (VT) :
                                            </label>
                                            <select name="petugasVt" id="petugasVt" class="form-select">
                                                <option value="" <?= ($data->rm7bPengkajian['petugasVt'] ?? '') == '' ? ' selected' : '' ?>>-- Pilih Petugas --</option>
                                                <option value="Tidak dilakukan" <?= ($data->rm7bPengkajian['petugasVt'] ?? '') == 'Tidak dilakukan' ? ' selected' : '' ?>>Tidak dilakukan</option>
                                                <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                                    echo '<option value="' . $data->petugas[$i]["nama"] . '"';
                                                    if ($data->petugas[$i]["nama"] === ($data->rm7bPengkajian['petugasVt'] ?? '')) {
                                                        echo ' selected';
                                                    }
                                                    echo '>' . $data->petugas[$i]["nama"] . '</option>';
                                                } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                Tanggal dan jam :
                                            </label>
                                            <input type="datetime-local" id="waktuVt" name="waktuVt" class="form-control" value="<?= $data->rm7bPengkajian["waktuVt"] ?? '' ?>">
                                        </div>
                                        <div class="col-md-12 mt-1">
                                            <textarea name="ketVt" id="ketVt" class="form-control"><?= $data->rm7bPengkajian["ketVt"] ?? '' ?></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Pemeriksaan Fisik (Anogenital Inspeksi) :</div>
                                    <hr>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pengeluaran Vaginal :</label>
                                        <input type="text" id="pengeluaranVaginal" name="pengeluaranVaginal" value="<?= $data->rm7bPengkajian["pengeluaranVaginal"] ?? '' ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lochea :</label>
                                        <input type="text" id="lochea" name="lochea" value="<?= $data->rm7bPengkajian["lochea"] ?? '' ?>" class="form-control">
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="d-flex flex-wrap gap-1 align-items-center">

                                            <!-- Volume -->
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                Volume :
                                            </label>
                                            <div class="input-group input-group-sm me-2" style="width: 150px;">
                                                <input type="number" id="volume" name="volume" value="<?= $data->rm7bPengkajian["volume"] ?? '' ?>" class="form-control">
                                                <span class="input-group-text bg-light text-secondary">cc</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="d-flex flex-wrap gap-1 align-items-center">

                                            <!-- Berbau -->
                                            <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                Berbau :
                                            </label>

                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="berbau" id="berbauTidak" value="Tidak" <?= (($data->rm7bPengkajian["berbau"] ?? '') == "Tidak") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="berbauTidak">Tidak</label>
                                            </div>

                                            <div class="form-check mb-0 me-1">
                                                <input class="form-check-input" type="radio" name="berbau" id="berbauYa" value="Ya" <?= (($data->rm7bPengkajian["berbau"] ?? '') == "Ya") ? 'checked' : '' ?>>
                                                <label class="form-check-label small" for="berbauYa">Ya</label>
                                            </div>

                                            <!-- Input Keterangan jika Ya -->
                                            <input type="text" class="form-control form-control-sm ms-1" style="width: 200px;" name="berbauKet" value="<?= $data->rm7bPengkajian["berbauKet"] ?? '' ?>">

                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">

                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    Perinium :
                                                </label>

                                                <!-- Utuh -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="perinium[]" id="periniumUtuh" value="Utuh" <?= (in_array("Utuh", $data->rm7bPengkajian["perinium"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="periniumUtuh">Utuh</label>
                                                </div>

                                                <!-- Laserasi + Input Derajat -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="perinium[]" id="periniumLaserasi" value="Laserasi" <?= (in_array("Laserasi", $data->rm7bPengkajian["perinium"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="periniumLaserasi">Laserasi : Derajat</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm me-2" style="width: 80px;" name="laserasiDerajat" value="<?= $data->rm7bPengkajian["laserasiDerajat"] ?? '' ?>">

                                                <!-- Jaringan Parut -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="perinium[]" id="periniumJaringanParut" value="Jaringan Parut" <?= (in_array("Jaringan Parut", $data->rm7bPengkajian["perinium"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="periniumJaringanParut">Jaringan Parut</label>
                                                </div>

                                                <!-- Lainnya + Input Text -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="perinium[]" id="periniumLainnya" value="Lainnya" <?= (in_array("Lainnya", $data->rm7bPengkajian["perinium"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="periniumLainnya">Lainnya :</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm" style="width: 180px;" name="periniumLainnyaKet" value="<?= $data->rm7bPengkajian["periniumLainnyaKet"] ?? '' ?>">

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-1">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">

                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    Jahitan :
                                                </label>

                                                <!-- Baik -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanBaik" value="Baik" <?= (in_array("Baik", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanBaik">Baik</label>
                                                </div>

                                                <!-- Terlepas -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanTerlepas" value="Terlepas" <?= (in_array("Terlepas", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanTerlepas">Terlepas</label>
                                                </div>

                                                <!-- Hematom -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanHematom" value="Hematom" <?= (in_array("Hematom", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanHematom">Hematom</label>
                                                </div>

                                                <!-- Oedem -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanOedem" value="Oedem" <?= (in_array("Oedem", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanOedem">Oedem</label>
                                                </div>

                                                <!-- Ekimosis -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanEkimosis" value="Ekimosis" <?= (in_array("Ekimosis", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanEkimosis">Ekimosis</label>
                                                </div>

                                                <!-- Kemerahan -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanKemerahan" value="Kemerahan" <?= (in_array("Kemerahan", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanKemerahan">Kemerahan</label>
                                                </div>

                                                <!-- Lainnya + Input Text -->
                                                <div class="form-check mb-0 me-1">
                                                    <input class="form-check-input" type="checkbox" name="jahitan[]" id="jahitanLainnya" value="Lainnya" <?= (in_array("Lainnya", $data->rm7bPengkajian["jahitan"] ?? [])) ? 'checked' : '' ?>>
                                                    <label class="form-check-label small" for="jahitanLainnya">Lainnya :</label>
                                                </div>
                                                <input type="text" class="form-control form-control-sm" style="width: 180px;" name="jahitanLainnyaKet" value="<?= $data->rm7bPengkajian["jahitanLainnyaKet"] ?? '' ?>">


                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>



                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center h5">Kesimpulan Pemeriksaan Penunjang :</div>
                                    <hr>
                                </div>

                                <!-- Section Darah -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-secondary d-block mb-2">
                                                a. Darah :
                                            </label>

                                            <div class="d-flex flex-column gap-1">
                                                <!-- 1. HB -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        HB :
                                                    </label>
                                                    <div class="input-group input-group-sm" style="width: 180px;">
                                                        <input type="number" step="0.1" class="form-control" name="hb" value="<?= $data->rm7bPengkajian["hb"] ?? '' ?>">
                                                        <span class="input-group-text bg-light text-secondary">g/dL</span>
                                                    </div>
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 2. Golongan Darah -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Golongan Darah :
                                                    </label>
                                                    <input type="text" class="form-control" name="golonganDarah" value="<?= $data->rm7bPengkajian["golonganDarah"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 3. Rhesus -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Rhesus :
                                                    </label>

                                                    <input type="text" class="form-control" name="rhesus" value="<?= $data->rm7bPengkajian["rhesus"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 4. Toxo -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Toxo :
                                                    </label>

                                                    <input type="text" class="form-control" name="toxo" value="<?= $data->rm7bPengkajian["toxo"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 5. HbsAg -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        HbsAg :
                                                    </label>
                                                    <input type="text" class="form-control" name="hbsag" value="<?= $data->rm7bPengkajian["hbsag"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 6. HIV -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        HIV :
                                                    </label>
                                                    <input type="text" class="form-control" name="hiv" value="<?= $data->rm7bPengkajian["hiv"] ?? '' ?>">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Urine -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <!-- Label Utama -->
                                            <label class="form-label fw-bold text-secondary d-block mb-2">
                                                b. Urine :
                                            </label>

                                            <div class="d-flex flex-column gap-1">
                                                <!-- 1. Albumin -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Albumin :
                                                    </label>
                                                    <input type="text" class="form-control" name="albumin" value="<?= $data->rm7bPengkajian["albumin"] ?? '' ?>">
                                                </div>

                                                <hr class="my-1 border-secondary opacity-25">

                                                <!-- 2. Reduksi -->
                                                <div class="d-flex flex-wrap gap-1 align-items-center">
                                                    <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                        Reduksi :
                                                    </label>
                                                    <input type="text" class="form-control" name="reduksi" value="<?= $data->rm7bPengkajian["reduksi"] ?? '' ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section USG -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    c. USG :
                                                </label>
                                                <input type="text" class="form-control form-control-sm" style="max-width: 500px;" name="usg" value="<?= $data->rm7bPengkajian["usg"] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Section Lainnya -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <div class="border border-info rounded p-2 mb-2">
                                            <div class="d-flex flex-wrap gap-1 align-items-center">
                                                <label class="form-label fw-bold small text-secondary mb-0 ms-1">
                                                    d. Lainnya :
                                                </label>
                                                <input type="text" class="form-control form-control-sm" style="max-width: 500px;" name="pemeriksaanLainnya" value="<?= $data->rm7bPengkajian["pemeriksaanLainnya"] ?? '' ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Diagnosa Kebidanan -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <label class="form-label fw-bold text-secondary mb-1 ms-1">
                                            Diagnosa Kebidanan :
                                        </label>
                                        <textarea class="form-control form-control-sm" name="diagnosaKebidanan" rows="3"><?= $data->rm7bPengkajian["diagnosaKebidanan"] ?? '' ?></textarea>
                                    </div>
                                </div>

                                <!-- Rencana Tindak Lanjut -->
                                <div class="row mt-1">
                                    <div class="col-sm-12">
                                        <label class="form-label fw-bold text-secondary mb-1 ms-1">
                                            Rencana Tindak Lanjut :
                                        </label>
                                        <textarea class="form-control form-control-sm" name="rencanaTindakLanjut" rows="3"><?= $data->rm7bPengkajian["rencanaTindakLanjut"] ?? '' ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>