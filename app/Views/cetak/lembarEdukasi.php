<?php

/** @var object $data */

?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #FFFFFF;
        /* Light gray background for visual separation */
        font: 10pt "Tahoma";

        font-family: "Times New Roman", Times, serif;
    }

    .page {
        width: 21cm;
        /* A4 width */
        min-height: 33cm;
        /* A4 height */
        padding: 0.5cm 0.5cm 0.5cm 0.9cm;
        /* Example padding for content */
        margin: 0.3cm auto;
        /* Center pages and add margin between them */
        border: 1px #D3D3D3 solid;
        /* Light border for page effect */
        border-radius: 5px;
        /* Rounded corners */
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        /* Subtle shadow */
    }

    .parent-ol>li::marker {
        font-weight: bold;
    }

    /* Reset font-weight for any nested ordered lists */
    .parent-ol ol>li::marker {
        font-weight: bold;
    }

    .parent-ol ol ol>li::marker {
        font-weight: normal;
    }

    .subpage {
        padding: 0cm;
        /* Inner padding for subpage content */
        /* Add other styling for content within the page */
        text-align: justify;
    }

    @page {
        size: 210mm 330mm;
        /* Set default page size for printing */
        margin: 0;
        /* Remove default print margins */
    }

    @media print {

        body,
        .book {
            width: initial;
            height: initial;
        }

        .page {
            margin: 0;
            /* Remove margins in print mode */
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            /* page-break-after: always; */
            /* Force a page break after each .page div */
        }

        .page:not(:last-child) {
            page-break-after: always;
            break-after: page;
            /* Standar CSS modern, ada baiknya ditulis berdampingan */
        }
    }


    .tabel td,
    .tabel th {
        padding: 1mm;
    }

    td img {
        margin: auto;
    }

    .bodyTtd {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 0;
        background-color: #f0f0f0;
    }

    .signature-container {
        border: 1px solid #ccc;
        background-color: #fff;
        padding: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .tempatTtd {
        border: 1px solid #000;
        background-color: #fff;
        cursor: crosshair;
    }

    .controls {
        margin-top: 10px;
        text-align: center;
    }

    .tombol {
        padding: 8px 15px;
        margin: 0 5px;
        cursor: pointer;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak IC Pembiusan Lokal</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="150%" alt=""></div>
                    <div class="col-3">
                        <br><br>
                    </div>
                    <div class="col-5">
                        <div style="text-align: end;">
                            RM 16
                        </div>
                        <div class="border border-dark" style="display: flex; justify-content: center;">
                            <table class="table table-borderless table-sm  mt-1 mb-1 tabel" style="font-size: xx-small;">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->pasien["nm_pasien"] ?></td>
                                </tr>
                                <tr>
                                    <td>Tgl.Lahir</td>
                                    <td>: <?= $data->pasien["tgl_lahir"] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->pasien["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: <?= $data->pasien["no_ktp"] ?></td>
                                </tr>
                                <tr>
                                    <td>No.RM</td>
                                    <td>: <?= $data->pasien["no_rkm_medis"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <br>

                <table class="table table-bordered table-sm">
                    <tr class="text-center">
                        <th style="background-color: #eaeaea;" colspan="2">
                            <p style="font-size: 14pt; margin:0;" class="text-uppercase">LEMBAR EDUKASI TERINTEGRASI
                            </p>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">KEMAMPUAN DAN KEMAUAN EDUKASI</td>
                    </tr>
                    <tr>
                        <td style="width: 30%;">Bahasa yang dipakai</td>
                        <td>
                            : <?= $data->lembarEdukasi["bahasa"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kebutuhan Penerjemah</td>
                        <td>
                            : <?= $data->lembarEdukasi["penerjemah"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Pendidikan
                        </td>
                        <td>
                            : <?= $data->lembarEdukasi["pendidikan"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kesulitan Baca & Tulis</td>
                        <td>
                            : <?= $data->lembarEdukasi["baca_tulis"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kesulitan Komunikasi</td>
                        <td>
                            : <?= $data->lembarEdukasi["komunikasi"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>
                            : <?= $data->lembarEdukasi["agama"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Hambatan Edukasi
                        </td>
                        <td>
                            : <?= $data->lembarEdukasi["hambatan_edukasi"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Intervensi Hambatan</td>
                        <td>
                            : <?= $data->lembarEdukasi["intervensi_hambatan"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Nilai-nilai dan keyakinan yang dianut</td>
                        <td>
                            : <?= $data->lembarEdukasi["nilai_keyakinan"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ketersediaan Pasien/Keluarga* untuk menerima informasi yang diberikan</td>
                        <td>
                            : <?= $data->lembarEdukasi["kesediaan_informasi"] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <table class="table table-borderless ms-5" style="width:90%;">
                                <tr>
                                    <td></td>
                                    <td class="text-center">
                                        Bangkalan, <?= $data->lembarEdukasi['tglTtd'] ?>
                                    </td>
                                </tr>
                                <tr class="text-center" style="margin:auto;">
                                    <td>
                                        Petugas
                                        <br>
                                        <br>
                                        <div id="qrcode" class="pt-2"></div>
                                        <br>
                                        (<?= $data->lembarEdukasi["petugas"] ?> )
                                    </td>
                                    <td>
                                        Pasien / Wali Pasien
                                        <br><br>

                                        <div id="ttdWali">
                                            <?php if ($data->lembarEdukasi["ttdWali"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->lembarEdukasi["nama"] ?> )
                                        <br><br>
                                        <?php if (!$data->lembarEdukasi["ttdWali"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Materi Edukasi</th>
                            <th>Tanggal</th>
                            <th>Metode Edukasi</th>
                            <th>Media Edukasi</th>
                            <th>Evaluasi</th>
                            <th>Paraf Nama Edukator</th>
                            <th>Paraf Nama Pasien/Keluarga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Administrasi</strong>
                                <ol type="a" class="mb-0">
                                    <li>Tata tertib rumah sakit</li>
                                    <li>Hak & kewajiban pasien</li>
                                    <li>Pengisian <em>inform consent</em></li>
                                    <li>General Consent</li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_1"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_1"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_1"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_1"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_1"] ?? '' ?></td>
                            <td>
                                <div id="qr1"></div>
                                <p class="mb-0" id='petugas1'><?= $data->lembarEdukasi["petugas_1"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_1">
                                    <?php if ($data->lembarEdukasi["ttd_1"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_1"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_1"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_1"] && $data->lembarEdukasi["wali_1"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_1">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Dokter spesialis/Umum</strong>
                                <ol type="a" class="mb-0">
                                    <li>Penjelasan penyakit, penyebab, tanda & gejala, prognosa</li>
                                    <li>Hasil pemeriksaan</li>
                                    <li>Tindakan medis</li>
                                    <li>Perkiraan hari rawat</li>
                                    <li>Penjelasan komplikasi yang mungkin terjadi</li>
                                    <li>Penggunaan alat medis</li>
                                    <li><?= $data->lembarEdukasi["lainnya_2"] ?: '...........................' ?></li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_2"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_2"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_2"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_2"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_2"] ?? '' ?></td>
                            <td>
                                <div id="qr2"></div>
                                <p class="mb-0" id='petugas2'><?= $data->lembarEdukasi["petugas_2"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_2">
                                    <?php if ($data->lembarEdukasi["ttd_2"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_2"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_2"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_2"] && $data->lembarEdukasi["wali_2"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_2">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>Materi Edukasi</th>
                            <th>Tanggal</th>
                            <th>Metode Edukasi</th>
                            <th>Media Edukasi</th>
                            <th>Evaluasi</th>
                            <th>Paraf Nama Edukator</th>
                            <th>Paraf Nama Pasien/Keluarga</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Manajemen Nyeri</strong>
                                <ol type="a" class="mb-0">
                                    <li>Farmakologi</li>
                                    <li>Non farmakologi</li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_3"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_3"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_3"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_3"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_3"] ?? '' ?></td>
                            <td>
                                <div id="qr3"></div>
                                <p class="mb-0" id='petugas3'><?= $data->lembarEdukasi["petugas_3"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_3">
                                    <?php if ($data->lembarEdukasi["ttd_3"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_3"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_3"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_3"] && $data->lembarEdukasi["wali_3"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_3">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Nutrisi</strong>
                                <ol type="a" class="mb-0">
                                    <li>Diet nutrisi</li>
                                    <li>Penyuluhan nutrisi</li>
                                    <li><?= $data->lembarEdukasi["lainnya_4"] ?: '...........................' ?></li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_4"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_4"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_4"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_4"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_4"] ?? '' ?></td>
                            <td>
                                <div id="qr4"></div>
                                <p class="mb-0" id='petugas4'><?= $data->lembarEdukasi["petugas_4"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_4">
                                    <?php if ($data->lembarEdukasi["ttd_4"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_4"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_4"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_4"] && $data->lembarEdukasi["wali_4"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_4">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <strong>Farmasi</strong>
                                <ol type="a" class="mb-0">
                                    <li>Nama obat dan kegunaan</li>
                                    <li>Aturan pemakaian dan dosis obat</li>
                                    <li>Cara penyimpanan</li>
                                    <li>Efek samping obat</li>
                                    <li>Kontraindikasi obat</li>
                                    <li><?= $data->lembarEdukasi["lainnya_5"] ?: '...........................' ?></li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_5"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_5"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_5"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_5"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_5"] ?? '' ?></td>
                            <td>
                                <div id="qr5"></div>
                                <p class="mb-0" id='petugas5'><?= $data->lembarEdukasi["petugas_5"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_5">
                                    <?php if ($data->lembarEdukasi["ttd_5"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_5"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_5"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_5"] && $data->lembarEdukasi["wali_5"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_5">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Perawat/Bidan</strong>
                                <ol type="a" class="mb-0">
                                    <li>
                                        Pendidikan kesehatan tentang :
                                        <br><?= $data->lembarEdukasi["lainnya_6"] ?: '...........................' ?>
                                    </li>
                                    <li>Penanganan & cara perawatan dirumah</li>
                                    <li>Perawatan luka</li>
                                    <li>Hand hygine</li>
                                    <li>Keamanan lingkungan perawatan</li>
                                    <li>Teknik memandikan bayi</li>
                                    <li>Post natal care</li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_6"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_6"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_6"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_6"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_6"] ?? '' ?></td>
                            <td>
                                <div id="qr6"></div>
                                <p class="mb-0" id='petugas6'><?= $data->lembarEdukasi["petugas_6"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_6">
                                    <?php if ($data->lembarEdukasi["ttd_6"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_6"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_6"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_6"] && $data->lembarEdukasi["wali_6"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_6">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <strong>Lainnya</strong>
                                <ol type="a" class="mb-0">
                                    <li>Orientasi Ruangan</li>
                                    <li>Etika Batuk</li>
                                    <li><?= $data->lembarEdukasi["lainnya_7"] ?: '...........................' ?></li>
                                </ol>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_7"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_7"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_7"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_7"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_7"] ?? '' ?></td>
                            <td>
                                <div id="qr7"></div>
                                <p class="mb-0" id='petugas7'><?= $data->lembarEdukasi["petugas_7"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_7">
                                    <?php if ($data->lembarEdukasi["ttd_7"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_7"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_7"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_7"] && $data->lembarEdukasi["wali_7"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_7">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?= $data->lembarEdukasi["lainnya_8"] ?: '...........................' ?>
                            </td>
                            <td><?= isset($data->lembarEdukasi["tgl_8"]) ? date('d-m-Y', strtotime($data->lembarEdukasi["tgl_8"])) : '' ?></td>
                            <td><?= $data->lembarEdukasi["metode_8"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["media_8"] ?? '' ?></td>
                            <td><?= $data->lembarEdukasi["evaluasi_8"] ?? '' ?></td>
                            <td>
                                <div id="qr8"></div>
                                <p class="mb-0" id='petugas8'><?= $data->lembarEdukasi["petugas_8"] ?? '' ?></p>
                            </td>
                            <td class="text-center">
                                <div id="ttdResult_8">
                                    <?php if ($data->lembarEdukasi["ttd_8"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/lembarEdukasi/' . $data->lembarEdukasi["ttd_8"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                                    } ?>
                                </div>
                                <?= $data->lembarEdukasi["wali_8"] ?>
                                <br>
                                <?php if (!$data->lembarEdukasi["ttd_8"] && $data->lembarEdukasi["wali_8"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtd_8">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="7">
                                <p style="font-size: 9pt; line-height: 1.5;" class="mb-0 p-2">
                                    Keterangan Evaluasi : <br>
                                    1 = Tidak Mengerti: Pasien/keluarga tidak dapat memahami edukasi sama. <br>
                                    2 = Kurang Mengerti: Pasien/keluarga bingung dan membutuhkan edukasi ulang. <br>
                                    3 = Cukup Mengerti: Pasien/keluarga hanya memahami poin-poin utama. <br>
                                    4 = Mengerti: Pasien/keluarga mampu menjelaskan, tetapi dibantu sedikit oleh edukator. <br>
                                    5 = Sangat Mengerti: Pasien/keluarga mampu menjelaskan kembali materi tanpa kesalahan.
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <input type="hidden" id="noRawat" value="<?= $data->lembarEdukasi["noRawat"] ?>">
                <input type="hidden" id="petugas" value="<?= $data->lembarEdukasi["petugas"] ?>">
                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php if (!$data->lembarEdukasi["ttdWali"] || (!$data->lembarEdukasi["ttd_1"] && $data->lembarEdukasi["wali_1"]) || (!$data->lembarEdukasi["ttd_2"] && $data->lembarEdukasi["wali_2"]) || (!$data->lembarEdukasi["ttd_3"] && $data->lembarEdukasi["wali_3"]) || (!$data->lembarEdukasi["ttd_4"] && $data->lembarEdukasi["wali_4"]) || (!$data->lembarEdukasi["ttd_5"] && $data->lembarEdukasi["wali_5"]) || (!$data->lembarEdukasi["ttd_6"] && $data->lembarEdukasi["wali_6"]) || (!$data->lembarEdukasi["ttd_7"] && $data->lembarEdukasi["wali_7"]) || (!$data->lembarEdukasi["ttd_8"] && $data->lembarEdukasi["wali_8"])) { ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- Modal Kunci TTD-->
<div class="modal fade" id="modalKunci" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Kunci tanda tangan ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin mengunci tanda tangan ?<br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Tanda tangan tidak dapat diubah kembali.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" onclick="kunciTtd()">Kunci</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ttd Wali-->
<div class="modal fade" id="modalTtdWali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan wali</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdWali" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdWali">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdWali" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<?php for ($i = 1; $i < 9; $i++): ?>
    <div class="modal fade" id="modalTtd_<?= $i ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel_<?= $i ?>" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel_<?= $i ?>">Tanda tangan wali ke-<?= $i ?></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bodyTtd">
                    <div class="signature-container">
                        <canvas class="tempatTtd" id="tempatTtd_<?= $i ?>" width="300" height="200" style="border: 1px dashed #ccc; display: block; margin: 0 auto;"></canvas>

                        <div class="controls mt-2 text-center">
                            <button class="btn btn-sm btn-secondary" id="hapusTtd_<?= $i ?>">Bersihkan</button>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary" id="simpanTtd_<?= $i ?>" disabled>Selesai</button>
                </div>
            </div>
        </div>
    </div>
<?php endfor; ?>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    function kunciTtd() {
        $("#pesanError").html("");
        $("#pesanError").removeClass("alert alert-danger");

        // 1. Ganti menjadi objek {} atau pastikan array hanya berisi string Base64/src
        let ttd = {};
        for (let idx = 1; idx <= 8; idx++) {
            let imgEl = $(`#ttdResult_${idx} img`);

            // Cek apakah gambar tanda tangan ada
            if (imgEl.length > 0) {
                // Cek apakah ini tanda tangan baru (punya atribut data-is-new='true')
                let isNew = (imgEl.attr('data-is-new') === 'true' || imgEl.data('is-new') === true);

                // Jika baru, ambil src-nya (base64). Jika tidak baru/kosong, kirim string kosong
                ttd[idx] = isNew ? imgEl.attr('src') : '';
            } else {
                ttd[idx] = ''; // Tidak ada tanda tangan di slot ini
            }
        }

        var noRawat = $("#noRawat").val();
        var imgWaliEl = $("#ttdWali img");

        if (imgWaliEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Wali belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';

        $.ajax({
            url: '<?= base_url() ?>rm/lembarEdukasi/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
                ttdWali: ttdWali,
                ttd: ttd, // Sekarang berisi {1: 'data:image/...', 2: '', ...}
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            },
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                } else {
                    $("#modalKunci").modal("hide");
                    $("#pesanError").addClass("alert alert-danger").html(response.message);
                }
            },
            error: function(xhr, status, error) {
                $("#modalKunci").modal("hide");
                $("#pesanError").addClass("alert alert-danger").html("Terjadi kesalahan sistem atau gagal terhubung ke server.");
            }
        });
    }

    // Create a new QRCode instance
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrcode.makeCode("Di ttd oleh " + $("#petugas").val() + " untuk Lembar edukasi terintegrasi. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

    // Mengubah loop agar berjalan dari 1 sampai 8 (sesuai jumlah ttd edukasi)
    for (let i = 1; i <= 8; i++) {
        // 1. Mengubah #petugas2 menjadi dinamis sesuai index (#petugas1, #petugas2, dst)
        if ($(`#petugas${i}`).html()) {
            // 2. Mengubah target elemen qr2 menjadi dinamis (#qr1, #qr2, dst)
            var qrcode = new QRCode(document.getElementById(`qr${i}`), {
                width: 50, // Set the width of the QR code
                height: 50, // Set the height of the QR code
                colorDark: "#000000", // Color of the dark modules
                colorLight: "#ffffff", // Color of the light modules
                correctLevel: QRCode.CorrectLevel.L // Error correction level
            });
            // 3. Mengubah konten teks QR agar mengambil nama petugas sesuai index i
            qrcode.makeCode("Ttd " + $(`#petugas${i}`).html() + " u/ Lembar edukasi. No Rawat:" + $("#noRawat").val());
        }
    }

    //========================================================

    document.addEventListener('DOMContentLoaded', () => {
        //ttd wali
        const canvasWali = document.getElementById('tempatTtdWali');
        const ctxWali = canvasWali.getContext('2d');
        const hapusTtdWali = document.getElementById('hapusTtdWali');
        const simpanTtdWali = document.getElementById('simpanTtdWali');
        const hasilTtdWali = document.getElementById('ttdWali');


        //=====Waliiii====
        let drawingWali = false;
        let lastXWali = 0;
        let lastYWali = 0;

        // Set drawing styles
        ctxWali.lineWidth = 2;
        ctxWali.lineCap = 'round';
        ctxWali.strokeStyle = '#000';

        function startDrawingWali(e) {
            drawingWali = true;
            [lastXWali, lastYWali] = [e.offsetX || e.touches[0].clientX - canvasWali.getBoundingClientRect().left, e.offsetY || e.touches[0].clientY - canvasWali.getBoundingClientRect().top];
        }

        function drawWali(e) {
            if (!drawingWali) return;
            $("#simpanTtdWali").prop('disabled', false);
            const currentXWali = e.offsetX || e.touches[0].clientX - canvasWali.getBoundingClientRect().left;
            const currentYWali = e.offsetY || e.touches[0].clientY - canvasWali.getBoundingClientRect().top;

            ctxWali.beginPath();
            ctxWali.moveTo(lastXWali, lastYWali);
            ctxWali.lineTo(currentXWali, currentYWali);
            ctxWali.stroke();

            [lastXWali, lastYWali] = [currentXWali, currentYWali];
        }

        function stopDrawingWali() {
            drawingWali = false;
        }

        // Waliiii  Event Listeners for mouse and touch
        canvasWali.addEventListener('mousedown', startDrawingWali);
        canvasWali.addEventListener('mousemove', drawWali);
        canvasWali.addEventListener('mouseup', stopDrawingWali);
        canvasWali.addEventListener('mouseout', stopDrawingWali); // Stop drawing if mouse leaves canvas

        canvasWali.addEventListener('touchstart', startDrawingWali);
        canvasWali.addEventListener('touchmove', drawWali);
        canvasWali.addEventListener('touchend', stopDrawingWali);

        // Clear button functionality
        hapusTtdWali.addEventListener('click', () => {
            $("#simpanTtdWali").prop('disabled', true);
            ctxWali.clearRect(0, 0, canvasWali.width, canvasWali.height);
        });

        // Save button functionality
        simpanTtdWali.addEventListener('click', () => {
            const dataURLWali = canvasWali.toDataURL('image/png');
            const imgWali = document.createElement('img');
            imgWali.src = dataURLWali;
            imgWali.alt = 'Tanda tangan wali pasien';
            imgWali.style.maxWidth = '150px';
            imgWali.style.maxHeight = '100px';

            // TAMBAHKAN BARIS INI SEBAGAI PENANDA GAMBAR BARU
            imgWali.setAttribute('data-is-new', 'true');

            hasilTtdWali.innerHTML = '';
            hasilTtdWali.appendChild(imgWali);
            $("#modalTtdWali").modal("hide");
        });

    });

    document.addEventListener('DOMContentLoaded', () => {

        // Fungsi utama untuk inisialisasi signature pad berdasarkan ID unik
        function initSignaturePad(id) {
            const canvas = document.getElementById(`tempatTtd_${id}`);
            // Validasi jika elemen tidak ditemukan di HTML agar tidak error
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            const btnHapus = document.getElementById(`hapusTtd_${id}`);
            const btnSimpan = document.getElementById(`simpanTtd_${id}`);
            const hasilTtd = document.getElementById(`ttdResult_${id}`);
            const modalId = `#modalTtd_${id}`; // Selector untuk JQuery Modal

            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Set drawing styles
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            function getCoordinates(e) {
                if (e.touches && e.touches.length > 0) {
                    const rect = canvas.getBoundingClientRect();
                    return [
                        e.touches[0].clientX - rect.left,
                        e.touches[0].clientY - rect.top
                    ];
                } else {
                    return [e.offsetX, e.offsetY];
                }
            }

            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = getCoordinates(e);

                // Mencegah scroll layar saat mulai menyentuh canvas di mobile
                if (e.touches) e.preventDefault();
            }

            function draw(e) {
                if (!isDrawing) return;

                // Perbaikan: Menghilangkan spasi pada $ {id}
                $(`#simpanTtd_${id}`).prop('disabled', false);

                const [currentX, currentY] = getCoordinates(e);

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(currentX, currentY);
                ctx.stroke();

                [lastX, lastY] = [currentX, currentY];

                // Mencegah scroll layar saat menggores tanda tangan di mobile
                if (e.touches) e.preventDefault();
            }

            function stopDrawing() {
                isDrawing = false;
            }

            // Event Listeners Mouse
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            // Event Listeners Touch (Mobile)
            // Ditambahkan { passive: false } agar e.preventDefault() bekerja dengan baik di browser modern
            canvas.addEventListener('touchstart', startDrawing, {
                passive: false
            });
            canvas.addEventListener('touchmove', draw, {
                passive: false
            });
            canvas.addEventListener('touchend', stopDrawing);

            // Tombol Hapus
            if (btnHapus) {
                btnHapus.addEventListener('click', () => {
                    // Perbaikan: Menyatukan baris string literal yang terputus
                    $(`#simpanTtd_${id}`).prop('disabled', true);
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                });
            }

            // Tombol Simpan
            if (btnSimpan) {
                btnSimpan.addEventListener('click', () => {
                    const dataURL = canvas.toDataURL('image/png');
                    const img = document.createElement('img');
                    img.src = dataURL;
                    img.alt = `Tanda tangan ${id}`;
                    img.style.maxWidth = '150px';
                    img.style.maxHeight = '100px';
                    img.setAttribute('data-is-new', 'true');

                    if (hasilTtd) {
                        hasilTtd.innerHTML = '';
                        hasilTtd.appendChild(img);
                    }
                    $(modalId).modal("hide");
                });
            }
        }

        // --- Eksekusi Inisialisasi untuk 8 Tanda Tangan ---
        // Loop dari angka 1 sampai 8
        for (let i = 1; i <= 8; i++) {
            initSignaturePad(i);
        }

    });
</script>

</html>