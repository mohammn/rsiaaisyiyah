<?php

/** @var object $data */
?>


<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Kembali</a>
            <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>#modalTambahForm">Daftar Form</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">SERAH TERIMA PEMBERIAN UNIT DOSE DISPENSING SYSTEMS (UDDS)</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm20bUdds) : ?>
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pasien :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Ruang</td>
                                    <td>: <?= $data->rm20bUdds["ruang"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Kamar</td>
                                    <td>: <?= $data->rm20bUdds["kamar"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Alergi</td>
                                    <td>: <?= $data->rm20bUdds["alergi"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Dokter</td>
                                    <td>: <?= $data->rm20bUdds["dokter"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa</td>
                                    <td>: <?= $data->rm20bUdds["diagnosa"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Data Tanggal :</div>
                                <hr>
                            </div>
                            <div class="row">
                                <div class="col-sm-6"><input type="date" name="tanggal" id="tanggal" class="form-control"></div>
                                <div class="col-sm-6">
                                    <button class="btn btn-estetik btn-simpan" onclick="simpanTgl('tambah', <?= $data->rm20bUdds['id'] ?? '' ?>)">
                                        <i class="fa fa-plus"></i> Tambah
                                    </button>
                                </div>
                            </div>
                            <table class="table table-info">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Tanggal</th>
                                        <th>Hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelDataTgl">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm20bUdds/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm20bUdds['id']) ?>" target="_blank">
                            <i class="fas fa-print me-1"></i> Cetak
                        </a>
                        <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
                        <button class="btn btn-estetik btn-simpan" id="btnReloadDanModal">
                            <i class="fa fa-clock me-1"></i> Jam
                        </button>
                        <button class="btn btn-estetik btn-batal" data-bs-toggle="modal" data-bs-target="#modalJamSementara">
                            <i class="fa fa-clock me-1"></i> Rencana
                        </button>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>
                <br>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="alert alert-info">
                            <input type="hidden" id="idEdit" name="idEdit">
                            <div class="row">
                                <div class="col-sm-12 border border-info rounded p-3">
                                    <label class="form-label d-block fw-bold mb-1" style="font-size: 0.9rem;">Jenis Obat *</label>
                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <input type="radio" class="btn-check" name="jenisObat" id="oral" value="oral" checked>
                                        <label class="btn btn-outline-info py-1" for="oral">
                                            <i class="fa-regular fa-face-surprise"></i> Oral
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="injeksi" value="injeksi">
                                        <label class="btn btn-outline-info py-1" for="injeksi">
                                            <i class="fa-solid fa-syringe"></i> Injeksi
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="infus" value="infus">
                                        <label class="btn btn-outline-info py-1" for="infus">
                                            <i class="fas fa-bed fa-sm me-1"></i> Infus
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="lain" value="lain">
                                        <label class="btn btn-outline-info py-1" for="lain">
                                            <i class="fas fa-clinic-medical fa-sm me-1"></i> Lain-lain
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                <div class="col-sm-12">
                                    <label class="form-label fw-bold mb-0">Nama Obat</label>
                                    <select id="namaObat" name="namaObat" placeholder="Cari nama obat..." required autocomplete="off">
                                        <option value=""></option>
                                        <?php foreach ($data->dataObat as $obat) : ?>
                                            <option value="<?= $obat['nama_brng'] ?>"><?= $obat['nama_brng']  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <script>
                                    var tomSelectObat = new TomSelect("#namaObat", {
                                        create: false, // Menutup akses untuk menambah data baru di luar list
                                        sortField: {
                                            field: "text",
                                            direction: "asc"
                                        },
                                        maxOptions: 10,

                                        // Bahasa Indonesia tetap dipasang untuk menangani jika pencarian kosong
                                        render: {
                                            no_results: function(data, escape) {
                                                return '<div class="no-results" style="padding: 6px 10px; color: #35cedc;">Obat tidak ditemukan.</div>';
                                            }
                                        }
                                    });
                                </script>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dosis :</label>
                                    <input type="text" class="form-control form-control-sm border-info" name="dosis" id="dosis" value="<?= $data->rm20bUdds['dosis'] ?? '' ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah :</label>
                                    <input type="text" class="form-control form-control-sm border-info" name="jumlah" id="jumlah" value="<?= $data->rm20bUdds['jumlah'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-center">

                                    <button class="btn btn-estetik btn-lihat" id="tombolPerbarui" onclick="simpanObat('perbarui')">
                                        <i class="fas fa-save me-1"></i> Perbarui
                                    </button>

                                    <button class="btn btn-estetik btn-simpan" id="tombolTambahSbar" onclick="simpanObat('tambah')">
                                        <i class="fas fa-save me-1"></i>
                                        <div id="tomboTambah">Tambah</div>
                                    </button>

                                    <button class="btn btn-estetik btn-hapus" onclick="resetFormObat()">
                                        <i class="fas fa-cancel me-1"></i> Batal
                                    </button>


                                    <button data-bs-toggle="modal" data-bs-target="#modalOral" class="btn-estetik btn-sm-estetik bg-vibrant-gray">Oral</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="alert alert-info">
                            <table class="table table-sm table-striped" id="tabelObat">
                                <thead>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Dosis</th>
                                    <th>Jumlah</th>
                                    <th></th>
                                </thead>
                                <tbody id="dataTabelObat">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm20bUdds.php") ?>

                <div class="text-center">
                    <div class="bg-info" id="pesanError"> </div>
                    <br>
                    <a class="btn btn-estetik btn-hapus" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-cancel me-1"></i> Batal</a>
                    <button class="btn btn-estetik btn-simpan" onclick="simpan('tambah')">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<div class="modal fade" id="modalOral" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Paket obat oral.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b>klik Buat. maka, paket obat oral akan ditambah secara otomatis.
                </sub><br><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button type="button" class="btn btn-estetik btn-simpan" onclick="tambahPaket('oral')"><i class="fas fa-plus me-1"></i> Buat</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade modal-xl  modal-dialog-scrollable" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->include("rm/partials/formRm20bUdds.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm20bUdds['id'] ?? '' ?>)">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form pasien atas nama <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapus()">
                    <i class="fas fa-trash-alt me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus obat-->
<div class="modal fade" id="modalHapusObat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idHapus" name="idHapus">
                Apakah anda yakin ingin menghapus Obat : <b id="namaObatHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapusObat()">
                    <i class="fas fa-trash-alt me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal data-->
<div class="modal modal-lg fade  modal-dialog-scrollable" id="modalJamSementara" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Daftar Rencana Pemberian Obat :</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mt-2">
                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal :</label>
                                    <input type="date" id="tglSementara" name="tglSementara" class="form-control">
                                </div>
                            </div>
                            <div class=" border border-info rounded p-2">
                                <label class=" form-label fw-bold mb-0">Jam :</label>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pagi :</label>
                                        <input type="time" id="pagi" name="pagi" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Siang :</label>
                                        <input type="time" id="siang" name="siang" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Sore :</label>
                                        <input type="time" id="sore" name="sore" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Malam :</label>
                                        <input type="time" id="malam" name="malam" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="alert alert-info mb-1">
                            <label class="form-label fw-bold mb-0">Nama Obat</label>
                            <select id="namaObatSementara" name="namaObatSementara" placeholder="Cari nama obat..." required autocomplete="off">
                                <option value=""></option>
                                <?php foreach ($data->dataObat as $obat) : ?>
                                    <option value="<?= $obat['nama_brng'] ?>"><?= $obat['nama_brng']  ?></option>
                                <?php endforeach; ?>
                            </select>

                            <script>
                                var tomSelectObatSementara = new TomSelect("#namaObatSementara", {
                                    create: false, // Menutup akses untuk menambah data baru di luar list
                                    sortField: {
                                        field: "text",
                                        direction: "asc"
                                    },
                                    maxOptions: 10,

                                    // Bahasa Indonesia tetap dipasang untuk menangani jika pencarian kosong
                                    render: {
                                        no_results: function(data, escape) {
                                            return '<div class="no-results" style="padding: 6px 10px; color: #35cedc;">Obat tidak ditemukan.</div>';
                                        }
                                    }
                                });
                            </script>

                            <label class="form-label fw-bold mb-0">Jenis</label>
                            <select name="jenisObatSementara" id="jenisObatSementara" class="form-select">
                                <option value="oral">oral</option>
                                <option value="injeksi">injeksi</option>
                                <option value="infus">infus</option>
                                <option value="lain">Lain-Lain</option>
                            </select>

                            <label class="form-label fw-bold mb-0">Catatan</label>
                            <textarea name="catatan" id="catatan" class="form-control" rows="2"></textarea>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 text-center">
                            <button class="btn btn-estetik btn-simpan" onclick="simpanJamSementara('tambah')">
                                <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>

                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">
                            Data Tanggal dan Jam Sementara
                            <hr>

                            <table class="table table-sm">
                                <thead>
                                    <th>Tanggal</th>
                                    <th>Nama Obat</th>
                                    <th>Jenis</th>
                                    <th>Pagi</th>
                                    <th>Siang</th>
                                    <th>Sore</th>
                                    <th>Malam</th>
                                    <th>Catatan</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody id="dataTabelJamSementara">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-close me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Isi Jam-->
<div class="modal fade modal-xl  modal-dialog-scrollable" id="modalIsiJam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Isian Jam : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th colspan="<?= ((count($data->rm20bUddsDataTgl) * 4) + 1) ?>" class="text-center">Rencana Pemberian</th>
                        </tr>
                        <tr>
                            <th class="text-center">Tanggal</th>
                            <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++) : ?>
                                <th colspan="4" class="text-center"><?= $data->rm20bUddsDataTgl[$i]['tanggal'] ?></th>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <th>Kategori & Nama Obat</th>
                            <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++) : ?>
                                <td class="text-center bg-light">P</td>
                                <td class="text-center bg-light">S</td>
                                <td class="text-center bg-light">S</td>
                                <td class="text-center bg-light">M</td>
                            <?php endfor; ?>
                        </tr>

                        <!-- ======================= ORAL ==================== -->
                        <tr class="table-secondary">
                            <th colspan="<?= ((count($data->rm20bUddsDataTgl) * 4) + 1) ?>">Obat Oral</th>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'oral') : ?>
                                <tr>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                        <?php
                                        $idData = $data->rm20bUddsData[$i]["id"];
                                        $idTgl  = $data->rm20bUddsDataTgl[$j]["id"];

                                        $filterData = array_filter($data->rm20bUddsDataJam, function ($item) use ($idTgl, $idData) {
                                            return $item['idTgl'] == $idTgl && $item['idData'] == $idData;
                                        });
                                        $hasilPencarian = array_values($filterData);
                                        $dataJam = !empty($hasilPencarian) ? $hasilPencarian[0] : null;
                                        ?>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['pagi'] ?? '' ?>" id="pagid<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['siang'] ?? '' ?>" id="siangd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['sore'] ?? '' ?>" id="sored<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['malam'] ?? '' ?>" id="malamd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- Baris Petugas khusus Oral (Opsional jika ingin dipisah per kategori) -->
                        <tr>
                            <td style="font-size: 8pt; font-weight: bold;">Pemberi Obat (Oral)</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center">
                                    <select id="pembObatOrPagit<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatOralPagi']) && $dataPetugasRow['pemberiObatOralPagi'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="pembObatOrSiangt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatOralSiang']) && $dataPetugasRow['pemberiObatOralSiang'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <!-- KOREKSI: Menambahkan huruf 't' pada ID agar konsisten dengan yang lain -->
                                    <select id="pembObatOrSoret<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatOralSore']) && $dataPetugasRow['pemberiObatOralSore'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="pembObatOrMalamt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatOralMalam']) && $dataPetugasRow['pemberiObatOralMalam'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- ================== INJEKSI ==================== -->
                        <tr class="table-secondary">
                            <th colspan="<?= ((count($data->rm20bUddsDataTgl) * 4) + 1) ?>">Obat Injeksi</th>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'injeksi') : ?>
                                <tr>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                        <?php
                                        $idData = $data->rm20bUddsData[$i]["id"];
                                        $idTgl  = $data->rm20bUddsDataTgl[$j]["id"];

                                        $filterData = array_filter($data->rm20bUddsDataJam, function ($item) use ($idTgl, $idData) {
                                            return $item['idTgl'] == $idTgl && $item['idData'] == $idData;
                                        });
                                        $hasilPencarian = array_values($filterData);
                                        $dataJam = !empty($hasilPencarian) ? $hasilPencarian[0] : null;
                                        ?>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['pagi'] ?? '' ?>" id="pagid<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['siang'] ?? '' ?>" id="siangd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['sore'] ?? '' ?>" id="sored<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['malam'] ?? '' ?>" id="malamd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- ================== INFUS ==================== -->
                        <tr class="table-secondary">
                            <th colspan="<?= ((count($data->rm20bUddsDataTgl) * 4) + 1) ?>">Obat Infus</th>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'infus') : ?>
                                <tr>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                        <?php
                                        $idData = $data->rm20bUddsData[$i]["id"];
                                        $idTgl  = $data->rm20bUddsDataTgl[$j]["id"];

                                        $filterData = array_filter($data->rm20bUddsDataJam, function ($item) use ($idTgl, $idData) {
                                            return $item['idTgl'] == $idTgl && $item['idData'] == $idData;
                                        });
                                        $hasilPencarian = array_values($filterData);
                                        $dataJam = !empty($hasilPencarian) ? $hasilPencarian[0] : null;
                                        ?>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['pagi'] ?? '' ?>" id="pagid<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['siang'] ?? '' ?>" id="siangd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['sore'] ?? '' ?>" id="sored<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['malam'] ?? '' ?>" id="malamd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- ================== LAIN-LAIN ==================== -->
                        <tr class="table-secondary">
                            <th colspan="<?= ((count($data->rm20bUddsDataTgl) * 4) + 1) ?>">Lain-lain</th>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'lain') : ?>
                                <tr>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                        <?php
                                        $idData = $data->rm20bUddsData[$i]["id"];
                                        $idTgl  = $data->rm20bUddsDataTgl[$j]["id"];

                                        $filterData = array_filter($data->rm20bUddsDataJam, function ($item) use ($idTgl, $idData) {
                                            return $item['idTgl'] == $idTgl && $item['idData'] == $idData;
                                        });
                                        $hasilPencarian = array_values($filterData);
                                        $dataJam = !empty($hasilPencarian) ? $hasilPencarian[0] : null;
                                        ?>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['pagi'] ?? '' ?>" id="pagid<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['siang'] ?? '' ?>" id="siangd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['sore'] ?? '' ?>" id="sored<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                        <td class="text-center">
                                            <input type="time" value="<?= $dataJam['malam'] ?? '' ?>" id="malamd<?= $idData ?>t<?= $idTgl ?>" style="width:70px; font-size:8pt;" class="form-control form-control-sm">
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- ================== PETUGAS BAGIAN BAWAH ==================== -->
                        <tr class="table-info">
                            <td style="font-size: 8pt; font-weight: bold;">Pemberi Obat (Umum)</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center">
                                    <select id="pembObatPagit<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatPagi']) && $dataPetugasRow['pemberiObatPagi'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="pembObatSiangt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatSiang']) && $dataPetugasRow['pemberiObatSiang'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <!-- KOREKSI: Menambahkan huruf 't' pada ID agar konsisten pembObatSoret... -->
                                    <select id="pembObatSoret<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatSore']) && $dataPetugasRow['pemberiObatSore'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="pembObatMalamt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['pemberiObatMalam']) && $dataPetugasRow['pemberiObatMalam'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                            <?php endfor; ?>
                        </tr>
                        <tr class="table-info">
                            <td style="font-size: 8pt; font-weight: bold;">Apoteker</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center">
                                    <select id="apotekerPagit<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['apotekerPagi']) && $dataPetugasRow['apotekerPagi'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="apotekerSiangt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['apotekerSiang']) && $dataPetugasRow['apotekerSiang'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <!-- KOREKSI: Menambahkan huruf 't' pada ID agar konsisten apotekerSoret... -->
                                    <select id="apotekerSoret<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['apotekerSore']) && $dataPetugasRow['apotekerSore'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                                <td class="text-center">
                                    <select id="apotekerMalamt<?= $idTgl ?>" class="form-select form-select-sm" style="font-size: 7pt;">
                                        <option value="">--</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $selected = isset($dataPetugasRow['apotekerMalam']) && $dataPetugasRow['apotekerMalam'] === $data->petugas[$i]["nama"] ? 'selected' : '';
                                            echo '<option value="' . $data->petugas[$i]["nama"] . '" ' . $selected . '>' . $data->petugas[$i]["nama"] . '</option>';
                                        } ?>
                                    </select>
                                </td>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                </table>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpanJam()">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // 1. KETIKA TOMBOL DIKLIK
        $('#btnReloadDanModal').on('click', function(e) {
            e.preventDefault();

            // Simpan tanda di localStorage bahwa modal #modalIsiJam harus dibuka nanti
            localStorage.setItem('bukaModalSetelahReload', '#modalIsiJam');

            // Reload halaman
            location.reload();
        });

        // 2. SETELAH HALAMAN SELESAI RELOAD (OTOMATIS BERJALAN)
        // Cek apakah ada tanda untuk membuka modal di localStorage
        let targetModal = localStorage.getItem('bukaModalSetelahReload');

        if (targetModal) {
            // Tampilkan modal menggunakan Bootstrap 5
            let myModal = new bootstrap.Modal($(targetModal)[0]);
            myModal.show();

            // Hapus tanda dari localStorage supaya tidak muncul lagi di reload berikutnya
            localStorage.removeItem('bukaModalSetelahReload');
        }
    });

    function simpan(tujuanSimpan) {
        // Inisialisasi variabel untuk menampung data berbentuk object/array asosiatif
        var data = {
            // Data Pasien
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            ruang: $('#ruang').val(),
            kamar: $('#kamar').val(),
            alergi: $('#alergi').val(),

            // Data Petugas
            dokter: $('#dokter').val(),
            diagnosa: $('#diagnosa').val()
        };

        $.ajax({
            url: '<?= base_url("rm/rm20bUdds/simpan") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }

    function ambilDataForm() {
        var mapJam = {};
        var mapPetugas = {};

        // 1. Tangkap semua Jam Pemberian Obat (Tabel jam obat)
        $('table input[type="time"]').each(function() {
            var idAttr = $(this).attr('id');
            var nilai = $(this).val();

            var match = idAttr.match(/^(pagi|siang|sore|malam)d(\d+)t(\d+)$/);

            if (match) {
                var waktu = match[1]; // pagi, siang, sore, malam
                var idData = match[2]; // id obat
                var idTgl = match[3]; // id tanggal
                var key = idData + '_' + idTgl;

                if (!mapJam[key]) {
                    mapJam[key] = {
                        idData: idData,
                        idTgl: idTgl,
                        pagi: '',
                        siang: '',
                        sore: '',
                        malam: ''
                    };
                }
                mapJam[key][waktu] = nilai;
            }
        });

        // 2. Tangkap Data Petugas (Tabel petugas baru)
        $('table select').each(function() {
            var idAttr = $(this).attr('id');
            var nilai = $(this).val();

            var match = idAttr.match(/^(pembObatOr|pembObat|apoteker)(Pagi|Siang|Sore|Malam)t?(\d+)$/);

            if (match) {
                var prefix = match[1]; // pembObatOr, pembObat, atau apoteker
                var shift = match[2]; // Pagi, Siang, Sore, Malam
                var idTgl = match[3]; // id tanggal

                // Inisialisasi object petugas per idTgl jika belum ada
                if (!mapPetugas[idTgl]) {
                    mapPetugas[idTgl] = {
                        idTgl: idTgl,
                        pemberiObatOralPagi: '',
                        pemberiObatOralSiang: '',
                        pemberiObatOralSore: '',
                        pemberiObatOralMalam: '',
                        pemberiObatPagi: '',
                        pemberiObatSiang: '',
                        pemberiObatSore: '',
                        pemberiObatMalam: '',
                        apotekerPagi: '',
                        apotekerSiang: '',
                        apotekerSore: '',
                        apotekerMalam: ''
                    };
                }

                // Pemetaan nama kolom sesuai dengan screenshot struktur tabel DB baru
                var namaKolom = '';
                if (prefix === 'pembObatOr') {
                    namaKolom = 'pemberiObatOral' + shift;
                } else if (prefix === 'pembObat') {
                    namaKolom = 'pemberiObat' + shift;
                } else if (prefix === 'apoteker') {
                    namaKolom = 'apoteker' + shift;
                }

                mapPetugas[idTgl][namaKolom] = nilai;
            }
        });

        // 3. Konversi object mapping menjadi array murni
        var arrJam = [];
        for (var k in mapJam) {
            arrJam.push(mapJam[k]);
        }

        var arrPetugas = [];
        for (var t in mapPetugas) {
            arrPetugas.push(mapPetugas[t]);
        }

        // Mengembalikan dua bagian data terpisah
        return {
            dataJam: arrJam,
            dataPetugas: arrPetugas
        };
    }


    <?php if ($data->rm20bUdds) : ?>
        muatObat()
        muatTgl()

        function muatObat() {
            $("#tombolPerbarui").hide();
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/muatObat',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "idUdds=<?= $data->rm20bUdds['id'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {
                    // 1. Cek jika DataTable sudah ada, jika ya, destroy dulu
                    if ($.fn.DataTable.isDataTable('#tabelObat')) {
                        $('#tabelObat').DataTable().destroy();
                    }

                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>';
                        if (data[i].jenis_obat == 'oral') {
                            hasil += '<span class="badge-estetik bg-vibrant-blue">';
                        } else if (data[i].jenis_obat == 'injeksi') {
                            hasil += '<span class="badge-estetik bg-vibrant-teal">';
                        } else if (data[i].jenis_obat == 'infus') {
                            hasil += '<span class="badge-estetik bg-vibrant-purple">';
                        } else {
                            hasil += '<span class="badge-estetik bg-vibrant-red">';
                        }
                        hasil += data[i].jenis_obat
                        hasil += '</td>';
                        hasil += '<td>' + data[i].nama_obat + '</td>';
                        hasil += '<td>' + data[i].dosis + '</td>';
                        hasil += '<td>' + data[i].jumlah + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue" onclick="tryEditObat(' + data[i].id + ')"><i class="fas fa-pen"></i> Edit</a> ';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="tryHapusObat(' + data[i].id + ', `' + data[i].nama_obat + '`)"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#dataTabelObat").html(hasil);

                    // 3. Inisialisasi ulang DataTable setelah HTML selesai dimuat
                    $('#tabelObat').DataTable({
                        // Anda bisa menambahkan konfigurasi DataTable di sini jika diperlukan, contoh:
                        "language": {
                            "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                            "sProcessing": "Sedang memproses...",
                            "sLengthMenu": "Tampilkan _MENU_ entri",
                            "sZeroRecords": "Tidak ditemukan data yang sesuai",
                            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                            "sInfoPostFix": "",
                            "sSearch": "Cari:",
                            "sUrl": "",
                            "paginate": { // <-- Di sini diubah dari oPaginate menjadi paginate
                                "sFirst": "Pertama",
                                "sPrevious": "Sebelumnya",
                                "sNext": "Selanjutnya",
                                "sLast": "Terakhir"
                            }
                        },
                        "responsive": true,
                        "order": [
                            [0, "desc"]
                        ] // Mengurutkan berdasarkan kolom waktu terbaru
                    });
                }
            });
        }

        function simpanJam() {
            // Ambil data form utama
            var formData = ambilDataForm();
            console.log(formData)

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanJam") ?>',
                method: 'POST',
                data: formData, // Sekarang membawa data array obat DAN variabel tujuanSimpan
                dataType: 'json',
                success: function(response) {
                    $("#modalIsiJam").modal("hide")
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function simpanObat(tujuanSimpan) {
            let data = {
                tujuanSimpan: tujuanSimpan,
                idUdds: "<?= $data->rm20bUdds['id'] ?>",
                idEdit: $('#idEdit').val(),
                jenis_obat: $('input[name="jenisObat"]:checked').val() || '',
                nama_obat: $('#namaObat').val(),
                dosis: $('#dosis').val(),
                jumlah: $('#jumlah').val(),
                tanggal: $('#tgl').val(),
                jam: {
                    pagi: $('#pagi').val(),
                    siang: $('#siang').val(),
                    sore: $('#sore').val(),
                    malam: $('#malam').val()
                }
            };

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanObat") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    muatObat();
                    resetFormObat();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });

        }

        muatJamSementara()

        function muatJamSementara() {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/muatJamSementara',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "idUdds=<?= $data->rm20bUdds['id'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {

                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + (data[i].tgl && data[i].tgl !== '0000-00-00' ? data[i].tgl.split('-').reverse().join('-') : '-') + '</td>';
                        hasil += '<td>' + data[i].namaObat + '</td>';
                        hasil += '<td>' + data[i].jenisObat + '</td>';
                        hasil += '<td>' + (data[i].pagi && data[i].pagi !== '00:00' && data[i].pagi !== '00:00:00' ? data[i].pagi.substring(0, 5) : '-') + '</td>';
                        hasil += '<td>' + (data[i].siang && data[i].siang !== '00:00' && data[i].siang !== '00:00:00' ? data[i].siang.substring(0, 5) : '-') + '</td>';
                        hasil += '<td>' + (data[i].sore && data[i].sore !== '00:00' && data[i].sore !== '00:00:00' ? data[i].sore.substring(0, 5) : '-') + '</td>';
                        hasil += '<td>' + (data[i].malam && data[i].malam !== '00:00' && data[i].malam !== '00:00:00' ? data[i].malam.substring(0, 5) : '-') + '</td>';
                        hasil += '<td>' + data[i].catatan + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="hapusJamSementara(' + data[i].id + ')"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#dataTabelJamSementara").html(hasil);
                }
            });
        }

        function simpanJamSementara(tujuanSimpan) {
            let data = {
                tujuanSimpan: tujuanSimpan,
                idUdds: <?= $data->rm20bUdds['id'] ?? 0 ?>,
                namaObat: $('#namaObatSementara').val(),
                jenisObat: $('#jenisObatSementara').val(),
                catatan: $('#catatan').val(),

                tgl: $('#tglSementara').val(),
                pagi: $('#pagi').val(),
                siang: $('#siang').val(),
                sore: $('#sore').val(),
                malam: $('#malam').val()

            };

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanJamSementara") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    muatJamSementara();

                    $("input[name='namaObatSementara']").val('');
                    if (typeof tomSelectObatSementara !== 'undefined') {
                        tomSelectObatSementara.clear(); // <-- Ini akan membuat select kembali kosong/placeholder
                    }
                    $('#jenisObatSementara').val('');
                    $('#catatan').val('');

                    $('#tglSementara').val('');
                    $('#pagi').val('');
                    $('#siang').val('');
                    $('#sore').val('');
                    $('#malam').val('');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });

        }

        function hapusJamSementara(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapusJamSementara',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    muatJamSementara();
                }
            });
        }


        function resetFormObat() {
            $('#idEdit').val('');

            // $('#' + data.jenis_obat).checked(true);
            $("input[name='namaObat']").val('');
            $('#dosis').val('')
            $('#jumlah').val('');
            // 2. Kosongkan TomSelect Nama Obat
            if (typeof tomSelectObat !== 'undefined') {
                tomSelectObat.clear(); // <-- Ini akan membuat select kembali kosong/placeholder
            }

            // 3. Kembalikan radio button ke default (oral)
            $('#oral').prop('checked', true);

            $("#tombolPerbarui").hide();
            $("#tombolTambahSbar").show();
        }

        function tryEditObat(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/lihat',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $("#tombolPerbarui").show();
                    $("#tombolTambahSbar").hide();

                    $('#idEdit').val(data.id);

                    $("input[name='jenisObat'][value='" + data.jenis_obat + "']").prop('checked', true).change();

                    // $('#' + data.jenis_obat).checked(true);
                    tomSelectObat.setValue(data.nama_obat);
                    $('#dosis').val(data.dosis)
                    $('#jumlah').val(data.jumlah);
                    $('#tgl').val(data.tanggal);
                    $('#pagi').val(data.pagi);
                    $('#siang').val(data.siang);
                    $('#sore').val(data.sore);
                    $('#malam').val(data.malam);

                    $('#dosis').focus()
                }
            });
        }

        function tryHapusObat(id, nama) {
            $("#modalHapusObat").modal("show");
            $("#idHapus").val(id);
            $("#namaObatHapus").html(nama)
        }

        function hapusObat() {
            var id = $("#idHapus").val();

            console.log(id)

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapusObat',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    $("#modalHapusObat").modal("hide");
                    muatObat();
                }
            });
        }

        function tambahPaket(jenis) {
            var id = "<?= $data->rm20bUdds["id"] ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/tambahPaket',
                method: 'post',
                data: {
                    idUdds: id,
                    jenis: jenis
                },
                dataType: 'json',
                success: function(response) {
                    muatObat();
                    $("#modalOral").modal("hide");

                },
                error: function(xhr, status, error) {
                    console.error("Gagal menyimpan data obat: " + error);
                }
            });
        }

        function muatTgl() {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/muatTgl',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "idUdds=" + <?= $data->rm20bUdds["id"] ?? 0 ?>,
                dataType: 'json',
                success: function(data) {
                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + data[i].id + '</td>';
                        hasil += '<td>' + (data[i].tanggal ? data[i].tanggal.split('-').reverse().join('-') : '-') + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="hapusTgl(' + data[i].id + ')"><i class="fas fa-trash-alt"></i></a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }
                    if (data.length < 1) {
                        hasil += '<tr><td colspan="9" class="text-center">Data Kosong.</td></tr>';
                    }

                    $("#tabelDataTgl").html(hasil);
                }
            });
        }

        function simpanTgl(tujuanSimpan, id) {
            let data = {
                tujuanSimpan: tujuanSimpan,
                idUdds: id,

                tanggal: $('#tanggal').val()
            };

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanTgl") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    muatTgl();

                    $('#tanggal').val('');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function hapusTgl(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapusTgl',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    muatTgl();
                }
            });
        }


        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm20bUdds['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapus',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        $(document).ready(function() {
            if (window.location.hash === '#modalHapus') {
                tryHapus();
            }
        });

    <?php endif; ?>
</script>
<?php $this->endSection() ?>