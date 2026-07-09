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
        padding: 0.3cm 0.3cm 0.3cm 0.7cm;
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

    .tabelData td,
    .tabelData th {
        padding: 0.2mm;
    }

    td img {
        margin: auto;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak RM20b UDDS</title>

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
                            RM 23h
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

                <div class="row">
                    <div class="col-12 text-center">
                        <p style="font-size: 14pt; margin:0;" class="text-uppercase">
                            SERAH TERIMA PEMBERIAN <i>UNIT DOSE DISPENSING SYSTEMS</i> (UDDS)
                        </p>
                    </div>
                </div>

                <table class="table table-bordered table-sm">
                    <tr>
                        <th rowspan="5" class="text-center align-middle">DAFTAR OBAT PASIEN RAWAT INAP</th>
                        <th class="text-center" colspan="2">Identitas Pasien</th>
                        <th class="text-center">Identitas Dokter</th>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>: <?= $data->rm20bUdds['ruang'] ?? ''  ?></td>
                        <td rowspan="4" class="text-center align-middle">
                            <div id="ttdDokter" class="mb-1"></div>
                            <?= $data->rm20bUdds['dokter'] ?? ''  ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Kamar</td>
                        <td>: <?= $data->rm20bUdds['kamar'] ?? ''  ?></td>
                    </tr>
                    <tr>
                        <td>Riwayat Alergi</td>
                        <td>: <?= $data->rm20bUdds['alergi'] ?? ''  ?></td>
                    </tr>
                    <tr>
                        <td>Diagnosa</td>
                        <td>: <?= $data->rm20bUdds['diagnosa'] ?? ''  ?></td>
                    </tr>
                </table>

                <?php $barisGolobal = 0; ?>

                <table class="table table-sm table-bordered <?= count($data->rm20bUddsDataTgl) > 3 ? ' tabelData' : '' ?>">
                    <thead>
                        <tr>
                            <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                            <th colspan="<?= count($data->rm20bUddsDataTgl) * 4 ?>" class="text-center">Rencana waktu pemberian</th>
                        </tr>
                        <tr>
                            <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++) : ?>
                                <th colspan="4" class="text-center">Tanggal : <?= $data->rm20bUddsDataTgl[$i]['tanggal']  ?></th>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <th style="background-color: #eaeaea;">Obat Oral</th>
                            <th style="background-color: #eaeaea;">Dosis</th>
                            <th style="background-color: #eaeaea;">Jumlah</th>

                            <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++) : ?>
                                <th style="background-color: #eaeaea;" class="text-center">P</th>
                                <th style="background-color: #eaeaea;" class="text-center">S</th>
                                <th style="background-color: #eaeaea;" class="text-center">S</th>
                                <th style="background-color: #eaeaea;" class="text-center">M</th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- ====================ORAL======================== -->
                        <?php $jmlData = 0; ?>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'oral') : ?>
                                <?php $jmlData++; ?>
                                <?php $barisGolobal++; ?>
                                <tr>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
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
                                            <?= (!empty($dataJam['pagi'])) ? date('H:i', strtotime($dataJam['pagi'])) : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= (!empty($dataJam['siang'])) ? date('H:i', strtotime($dataJam['siang'])) : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= (!empty($dataJam['sore'])) ? date('H:i', strtotime($dataJam['sore'])) : '' ?>
                                        </td>
                                        <td class="text-center">
                                            <?= (!empty($dataJam['malam'])) ? date('H:i', strtotime($dataJam['malam'])) : '' ?>
                                        </td>
                                    <?php endfor; ?>
                                </tr>
                            <?php endif; ?>



                            <!-- ====================================== PENCETAK KERATS BARU============================= -->
                            <?php
                            //     if ($barisGolobal == 20) {
                            //         echo '
                            //         </tbody>
                            //         </table>
                            //             </div>
                            //             </div>
                            //             <div class="page">
                            //             <div class="subpage">
                            //             ';

                            //         echo '<table class="table table-sm table-bordered';
                            //         if (count($data->rm20bUddsDataTgl) > 3) {
                            //             echo ' tabelData';
                            //         }
                            //         echo  '">';

                            //         echo '<thead>
                            //                     <tr>
                            //                         <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                            //                         <th colspan="';
                            //         echo (count($data->rm20bUddsDataTgl) * 4) . '" class="text-center">Rencana waktu pemberian</th>
                            //                 </tr>
                            // <tr>';
                            //         for ($l = 0; $l < count($data->rm20bUddsDataTgl); $l++) {
                            //             echo '<th colspan="4" class="text-center">Tanggal :' . $data->rm20bUddsDataTgl[$l]['tanggal'] . '</th>';
                            //         }
                            //         echo '</tr>
                            // <tr>
                            //     <th style="background-color: #eaeaea;">Obat Oral</th>
                            //     <th style="background-color: #eaeaea;">Dosis</th>
                            //     <th style="background-color: #eaeaea;">Jumlah</th>';

                            //         for ($l = 0; $l < count($data->rm20bUddsDataTgl); $l++) {
                            //             echo '<th style="background-color: #eaeaea;" class="text-center">P</th>
                            //         <th style="background-color: #eaeaea;" class="text-center">S</th>
                            //         <th style="background-color: #eaeaea;" class="text-center">S</th>
                            //         <th style="background-color: #eaeaea;" class="text-center">M</th>';
                            //         }
                            //         echo '</tr>
                            //                 </thead>';
                            // } 
                            ?>


                            <!-- ====================================== AKHIR PENCETAK KERATS BARU============================= -->




                        <?php endfor; ?>

                        <?php if ($jmlData == 0): ?>
                            <th>
                                -
                            </th>
                            <td></td>
                            <td></td>
                            <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++): ?>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            <?php endfor; ?>
                        <?php endif; ?>

                        <!-- ================PEMBERI OBAT ORAL====================== -->

                        <tr>
                            <td style="font-size: 8pt; font-weight: bold;" colspan="3">Pemberi Obat (Oral)</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatOralPagi<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatOralPagi'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatOralSiang<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatOralSiang'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatOralSore<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatOralSore'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatOralMalam<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatOralSiang'] ?? '' ?>
                                </td>
                            <?php endfor; ?>
                        </tr>

                        <!-- =============================================================================== -->


                        <?php $judulObat = [['injeksi', 'Obat Injeksi'], ['infus', 'Cairan Infus'], ['lain', 'Lain-lain']]; ?>

                        <?php for ($k = 0; $k < count($judulObat); $k++): ?>
                            <tr>
                                <th>
                                    <?= $judulObat[$k][1] ?>
                                </th>
                                <td></td>
                                <td></td>
                                <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++): ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php endfor; ?>
                            </tr>
                            <?php $jmlData = 0; ?>

                            <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                                <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === $judulObat[$k][0]) : ?>
                                    <?php $jmlData++; ?>
                                    <tr>
                                        <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                        <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                        <td style="font-size: 8pt; vertical-align: middle;"><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
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
                                                <?= (!empty($dataJam['pagi'])) ? date('H:i', strtotime($dataJam['pagi'])) : '' ?>
                                            </td>
                                            <td class="text-center">
                                                <?= (!empty($dataJam['siang'])) ? date('H:i', strtotime($dataJam['siang'])) : '' ?>
                                            </td>
                                            <td class="text-center">
                                                <?= (!empty($dataJam['sore'])) ? date('H:i', strtotime($dataJam['sore'])) : '' ?>
                                            </td>
                                            <td class="text-center">
                                                <?= (!empty($dataJam['malam'])) ? date('H:i', strtotime($dataJam['malam'])) : '' ?>
                                            </td>
                                        <?php endfor; ?>
                                    </tr>
                                <?php endif; ?>
                            <?php endfor; ?>

                            <?php if ($jmlData == 0): ?>
                                <th>
                                    -
                                </th>
                                <td></td>
                                <td></td>
                                <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++): ?>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                <?php endfor; ?>
                            <?php endif; ?>
                        <?php endfor; ?>


                        <!-- ================PEMBERI OBAT dan APOTEKER====================== -->

                        <tr>
                            <td style="font-size: 8pt; font-weight: bold;" colspan="3">Pemberi Obat</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatPagi<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatPagi'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatSiang<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatSiang'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatSore<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatSore'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="pemberiObatMalam<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['pemberiObatSiang'] ?? '' ?>
                                </td>
                            <?php endfor; ?>
                        </tr>

                        <tr>
                            <td style="font-size: 8pt; font-weight: bold;" colspan="3">Apoteker</td>
                            <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
                                <?php
                                $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
                                $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
                                    return $item['idTgl'] == $idTgl;
                                });
                                $hasilPetugas = array_values($filterPetugas);
                                $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
                                ?>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="apotekerPagi<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['apotekerPagi'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="apotekerSiang<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['apotekerSiang'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="apotekerSore<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['apotekerSore'] ?? '' ?>
                                </td>
                                <td class="text-center" style="font-size: 5pt;">
                                    <div id="apotekerMalam<?= $idTgl ?>"></div>
                                    <?= $dataPetugasRow['apotekerSiang'] ?? '' ?>
                                </td>
                            <?php endfor; ?>
                        </tr>


                    </tbody>

                </table>

                <table>
                    <tr>
                        <td>KET :</td>
                        <td>Pagi </td>
                        <td>: 00.00 – 10.59</td>
                        <td>&nbsp;&nbsp;</td>
                        <td>Sore</td>
                        <td>: 14.01 – 18.30</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Siang </td>
                        <td>: 11.00 – 14.00</td>
                        <td>&nbsp;&nbsp;</td>
                        <td>Malam</td>
                        <td>: 18.31 – 23.59</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    // Ganti $("#ttdDokter")[0] dengan document.getElementById('ttdDokter')
    var ttdDokter = new QRCode(document.getElementById("ttdDokter"), {
        width: 50,
        height: 50,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.L
    });

    ttdDokter.makeCode("Di ttd <?= $data->rm20bUdds['dokter'] ?? ''  ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>"); // Replace with your desired text or URL

    <?php for ($j = 0; $j < count($data->rm20bUddsDataTgl); $j++) : ?>
        <?php
        $idTgl = $data->rm20bUddsDataTgl[$j]['id'];
        $filterPetugas = array_filter($data->rm20bUddsDataPetugas, function ($item) use ($idTgl) {
            return $item['idTgl'] == $idTgl;
        });
        $hasilPetugas = array_values($filterPetugas);
        $dataPetugasRow = !empty($hasilPetugas) ? $hasilPetugas[0] : null;
        ?>
        <?php if ($dataPetugasRow):  ?>


            // ===================PEMBERI OBAT ORAL===================
            <?php if (!empty($dataPetugasRow["pemberiObatOralPagi"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatOralPagi<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatOralPagi"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatOralSiang"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatOralSiang<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatOralSiang"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatOralSore"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatOralSore<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatOralSore"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatOralMalam"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatOralMalam<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatOralMalam"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            // ===================PEMBERI OBAT ====================
            <?php if (!empty($dataPetugasRow["pemberiObatPagi"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatPagi<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatPagi"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatSiang"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatSiang<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatSiang"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatSore"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatSore<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatSore"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["pemberiObatMalam"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("pemberiObatMalam<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["pemberiObatMalam"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>



            // =======================APOTEKER=============
            <?php if (!empty($dataPetugasRow["apotekerPagi"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("apotekerPagi<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["apotekerPagi"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["apotekerSiang"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("apotekerSiang<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["apotekerSiang"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["apotekerSore"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("apotekerSore<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["apotekerSore"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>

            <?php if (!empty($dataPetugasRow["apotekerMalam"])):  ?>
                var petugasapotker = new QRCode(document.getElementById("apotekerMalam<?= $idTgl ?>"), {
                    width: 40,
                    height: 40,
                    colorDark: "#000000",
                    colorLight: "#ffffff",
                    correctLevel: QRCode.CorrectLevel.L
                });

                petugasapotker.makeCode("Di ttd <?= $dataPetugasRow["apotekerMalam"] ?> untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
            <?php endif; ?>
        <?php endif; ?>

    <?php endfor; ?>


    <?php for ($i = 0; $i < count($data->rm20bUddsDataTgl); $i++) : ?>
        if ($("#namaPemObat<?= $i ?>").length > 0) {
            var ttd = new QRCode(document.getElementById("qrPemObat<?= $i ?>"), {
                width: 40,
                height: 40,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.L
            });

            var nama = $("#namaPemObat<?= $i ?>").html();
            ttd.makeCode("Di ttd " + nama + " untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
        }

        if ($("#namaApoteker<?= $i ?>").length > 0) {
            var petugasapotker = new QRCode(document.getElementById("qrApoteker<?= $i ?>"), {
                width: 40,
                height: 40,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.L
            });

            var nama = $("#namaApoteker<?= $i ?>").html();
            petugasapotker.makeCode("Di ttd " + nama + " untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>"); // Replace with your desired text or URL
        }

        if ($("#namaPemObatOral<?= $i ?>").length > 0) {
            var ttd = new QRCode(document.getElementById("qrPemObatOral<?= $i ?>"), {
                width: 40,
                height: 40,
                colorDark: "#000000",
                colorLight: "#ffffff",
                correctLevel: QRCode.CorrectLevel.L
            });

            var nama = $("#namaPemObatOral<?= $i ?>").html();
            ttd.makeCode("Di ttd " + nama + " untuk UDDS. No Rawat : <?= $data->pasien['no_rawat'] ?? ''  ?>");
        }
    <?php endfor; ?>
</script>

</html>