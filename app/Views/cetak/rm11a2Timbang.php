<?php

/** @var object $data */


$tb = $data->rm11a2Timbang;
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
        padding: 0.5cm 0.5cm 0.5cm 1cm;
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

    .tabelInti td,
    .tabelInti th {
        padding: 0.5mm;
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
    <title>Rm 11a2 Timbang Terima</title>

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
                            RM 11a2
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
                <div class="row">
                    <div class="col-12 text-center">
                        <p style="font-size: 14pt; margin:10px; margin-bottom:5;" class="text-uppercase fw-bold"> TIMBANG TERIMA UNTUK KESELAMATAN PEMBEDAHAN
                        </p>
                    </div>
                </div>

                <table class="table table-bordered table-sm mb-0 tabelInti">
                    <tr>
                        <td>DPJP</td>
                        <td>: <?= $data->rm11a2Timbang["dpjp"] ?? '-' ?></td>
                        <td>Diagnosa Medis : <?= $data->rm11a2Timbang["diagnosaMedis"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>SBAR</td>
                        <td>Dari Unit Lain <?= $data->rm11a2Timbang["unitLain"] ?? '...........' ?> ke R. Premedikasi</td>
                        <td>Dari R. Premedikasi ke Kamar Operasi</td>
                    </tr>
                    <tr>
                        <td>SITUATION</td>
                        <td colspan="2">
                            <?php
                            $situasiArr = json_decode($tb['situasi'] ?? '', true) ?? [];
                            ?>
                            <?= !empty($situasiArr) ? implode(', ', $situasiArr) : '-' ?> &nbsp;&nbsp;&nbsp; KELAS : <?= $tb['isiKelas'] ?: '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td rowspan="18" style="vertical-align: middle;">
                            BACKGROUND
                        </td>
                        <td>
                            <b>Diagnosa Pra Operasi :</b> <?= $data->rm11a2Timbang["diagnosaPra"] ?? '-' ?> <br>
                            <b>Rencana Operasi :</b> <?= $data->rm11a2Timbang["rencanaOperasi"] ?? '-' ?>
                        </td>
                        <td>
                            <b>Diagnosa Pra Operasi :</b> <?= $data->rm11a2Timbang["diagnosaPra2"] ?? '-' ?> <br>
                            <b>Rencana Operasi :</b> <?= $data->rm11a2Timbang["rencanaOperasi2"] ?? '-' ?>
                        </td>
                    </tr>
                    <tr><?php
                        // Function reusable untuk format JSON & replace 'lainnya'
                        $formatJsonLainnya = function ($jsonRaw, $isiLainnya) {
                            $arr = json_decode($jsonRaw ?? '', true) ?? [];

                            if (empty($arr) || !is_array($arr)) {
                                return '-';
                            }

                            $key = array_search('lain2', array_map('strtolower', $arr));
                            if ($key !== false && !empty($isiLainnya)) {
                                $arr[$key] = $isiLainnya;
                            }

                            return implode(', ', $arr);
                        };

                        // Panggil fungsi untuk rpd dan rpd2
                        $rpd  = $formatJsonLainnya($data->rm11a2Timbang["rpd"] ?? null, $data->rm11a2Timbang["isiRpdLainnya"] ?? null);
                        $rpd2 = $formatJsonLainnya($data->rm11a2Timbang["rpd2"] ?? null, $data->rm11a2Timbang["isiRpdLainnya2"] ?? null);

                        $isolasi = $formatJsonLainnya($data->rm11a2Timbang["isolasi"] ?? null, $data->rm11a2Timbang["isiIsolasiLainnya"] ?? null);
                        $isolasi2 = $formatJsonLainnya($data->rm11a2Timbang["isolasi2"] ?? null, $data->rm11a2Timbang["isiIsolasiLainnya2"] ?? null);

                        ?>

                        <td><b>RPD : </b> <?= $rpd ?></td>
                        <td><b>RPD : </b> <?= $rpd2 ?></td>
                    </tr>
                    <tr>
                        <td><b>Isolasi : </b> <?= $isolasi ?></td>
                        <td><b>Isolasi : </b> <?= $isolasi2 ?></td>
                    </tr>
                    <tr>
                        <td><b>Alergi : </b> <?= ($data->rm11a2Timbang["alergi"] ?? '-') === 'Ya' ? 'Ya :' . $data->rm11a2Timbang["isiAlergi"] : ($data->rm11a2Timbang["alergi"] ?: '-') ?></td>
                        <td><b>Alergi : </b> <?= ($data->rm11a2Timbang["alergi2"] ?? '-') === 'Ya' ? 'Ya :' . $data->rm11a2Timbang["isiAlergi2"] : ($data->rm11a2Timbang["alergi2"] ?: '-') ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Darah : </b> <?= ($data->rm11a2Timbang["darahStatus"] ?? '-') === 'Ada' ? 'Ada. Jumlah : ' . $data->rm11a2Timbang["jumlahDarah"] : ($data->rm11a2Timbang["darahStatus"] ?: '-') ?>
                            <?php
                            $detail = json_decode($tb['darahDetail'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Pack jenis', $detail)) {
                                $out[] = 'Pack jenis : ' . ($tb['isiPackJenis'] ?: '-');
                            }
                            if (in_array('Golongan', $detail)) {
                                $out[] = 'Golongan : ' . ($tb['isiGolonganDarah'] ?: '-');
                            }

                            $indent = '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo $out ? $indent . implode($indent, $out) : '';
                            ?>
                        </td>
                        <td>
                            <b>Darah : </b> <?= ($data->rm11a2Timbang["darahStatus2"] ?? '-') === 'Ada' ? 'Ada. Jumlah : ' . $data->rm11a2Timbang["jumlahDarah2"] : ($data->rm11a2Timbang["darahStatus2"] ?: '-') ?>
                            <?php
                            $detail = json_decode($tb['darahDetail2'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Pack jenis', $detail)) {
                                $out[] = 'Pack jenis : ' . ($tb['isiPackJenis2'] ?: '-');
                            }
                            if (in_array('Golongan', $detail)) {
                                $out[] = 'Golongan : ' . ($tb['isiGolonganDarah2'] ?: '-');
                            }

                            $indent = '<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                            echo $out ? $indent . implode($indent, $out) : '';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Riwayat tranfusi : </b> <?= ($data->rm11a2Timbang["riwayatTranfusi"] ?? '-') === 'Ya' ? 'Ya. Tanggal : ' . ($data->rm11a2Timbang["tglTranfusi"] ?: '-') . ' Jenis : '  . ($data->rm11a2Timbang["jenisTranfusi"] ?: '-')  . ' Gol : '  . ($data->rm11a2Timbang["golTranfusi"] ?: '-') . ' Jumlah : '  . ($data->rm11a2Timbang["jumlahTranfusi"] ?: '-')  : ($data->rm11a2Timbang["riwayatTranfusi"] ?: '-') ?>
                        </td>
                        <td>
                            <b>Riwayat tranfusi : </b> <?= ($data->rm11a2Timbang["riwayatTranfusi2"] ?? '-') === 'Ya' ? 'Ya. Tanggal : ' . ($data->rm11a2Timbang["tglTranfusi2"] ?: '-') . ' Jenis : '  . ($data->rm11a2Timbang["jenisTranfusi2"] ?: '-')  . ' Gol : '  . ($data->rm11a2Timbang["golTranfusi2"] ?: '-') . ' Jumlah : '  . ($data->rm11a2Timbang["jumlahTranfusi2"] ?: '-')  : ($data->rm11a2Timbang["riwayatTranfusi2"] ?: '-') ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Marking : </b> <?= $data->rm11a2Timbang["markingStatus"] ?: '-' ?>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status : <?= $data->rm11a2Timbang["markingKondisi"] ?: '-' ?>
                        </td>
                        <td><b>Marking : </b> <?= $data->rm11a2Timbang["markingStatus2"] ?: '-' ?>
                            <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Status : <?= $data->rm11a2Timbang["markingKondisi2"] ?: '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Informed Consent : </b> <?= $data->rm11a2Timbang["informedConsent"] ?: '-' ?></td>
                        <td><b>Informed Consent : </b> <?= $data->rm11a2Timbang["informedConsent2"] ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Laboratorium : </b> <i><?= ($data->rm11a2Timbang["labStatus"] ?? '-') === 'Ada' ? 'Ada. Jumlah : ' . $data->rm11a2Timbang["isiLabJml"] : ($data->rm11a2Timbang["labStatus"] ?: '-') ?></i>
                            <br>Perhatian Khusus : <br>
                            <?php
                            $detail = json_decode($tb['perhatianKhusus'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Hb', $detail)) {
                                $out[] = 'Hb : <i>' . ($tb['isiHb'] ?: '-') . ' gr/dl</i>';
                            }
                            if (in_array('BUN', $detail)) {
                                $out[] = 'BUN : <i>' . ($tb['isiBun'] ?: '-') . ' mg/dl</i>';
                            }
                            if (in_array('Albumin', $detail)) {
                                $out[] = 'Albumin : <i>' . ($tb['isiAlbumin'] ?: '-') . ' gr/dl</i>';
                            }
                            if (in_array('Kreatinin', $detail)) {
                                $out[] = 'Kreatinin : <i>' . ($tb['isiKreatinin'] ?: '-') . ' mg/dl</i>';
                            }
                            if (in_array('Lain-lain', $detail) || !empty($tb['isiPkLainLain'])) {
                                $out[] = 'Lain-lain : <i>' . ($tb['isiPkLainLain'] ?: '-') . '</i>';
                            }

                            if (!empty($out)) {
                                $chunks = array_chunk($out, 2);
                                echo '<table style="width: 100%; border-collapse: collapse;">';
                                foreach ($chunks as $chunk) {
                                    echo '<tr>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . $chunk[0] . '</td>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . ($chunk[1] ?? '') . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            }
                            ?>
                        </td>
                        <td>
                            <b>Laboratorium : </b> <i><?= ($data->rm11a2Timbang["labStatus"] ?? '-') === 'Ada' ? 'Ada. Jumlah : ' . $data->rm11a2Timbang["isiLabJml"] : ($data->rm11a2Timbang["labStatus"] ?: '-') ?></i>
                            <br>Perhatian Khusus : <br>
                            <?php
                            $detail = json_decode($tb['perhatianKhusus2'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Hb', $detail)) {
                                $out[] = 'Hb : <i>' . ($tb['isiHb2'] ?: '-') . ' gr/dl</i>';
                            }
                            if (in_array('BUN', $detail)) {
                                $out[] = 'BUN : <i>' . ($tb['isiBun2'] ?: '-') . ' mg/dl</i>';
                            }
                            if (in_array('Albumin', $detail)) {
                                $out[] = 'Albumin : <i>' . ($tb['isiAlbumin2'] ?: '-') . ' gr/dl</i>';
                            }
                            if (in_array('Kreatinin', $detail)) {
                                $out[] = 'Kreatinin : <i>' . ($tb['isiKreatinin2'] ?: '-') . ' mg/dl</i>';
                            }
                            if (in_array('Lain-lain', $detail) || !empty($tb['isiPkLainLain2'])) {
                                $out[] = 'Lain-lain : <i>' . ($tb['isiPkLainLain2'] ?: '-') . '</i>';
                            }

                            if (!empty($out)) {
                                $chunks = array_chunk($out, 2);
                                echo '<table style="width: 100%; border-collapse: collapse;">';
                                foreach ($chunks as $chunk) {
                                    echo '<tr>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . $chunk[0] . '</td>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . ($chunk[1] ?? '') . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Foto : </b> <i><?= ($data->rm11a2Timbang["fotoStatus"] ?? '-') === 'Ada' ? 'Ada, Jml : ' . ($data->rm11a2Timbang["isiFotoJml"] ?: '-') : ($data->rm11a2Timbang["fotoStatus"] ?: '-') ?></i>
                            <br>
                            <?php
                            $detail = json_decode($tb['fotoDetail'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Rontgen', $detail)) {
                                $out[] = 'Rontgen : <i>' . ($tb['isiRontgenKet'] ?: '-') . ' | jml : ' . ($tb['isiRontgenJml'] ?: '-') . '</i>';
                            }
                            if (in_array('USG', $detail)) {
                                $out[] = 'USG : <i>' . ($tb['isiUsgKet'] ?: '-') . ' | jml : ' . ($tb['isiUsgJml'] ?: '-') . '</i>';
                            }
                            if (in_array('BOF jml', $detail) || in_array('BOF', $detail)) {
                                $out[] = 'BOF jml : <i>' . ($tb['isiBofJml'] ?: '-') . '</i>';
                            }
                            if (in_array('IVP jml', $detail) || in_array('IVP', $detail)) {
                                $out[] = 'IVP jml : <i>' . ($tb['isiIvpJml'] ?: '-') . '</i>';
                            }
                            if (in_array('NST', $detail)) {
                                $out[] = 'NST : <i>' . ($tb['isiNst'] ?: '-') . '</i>';
                            }
                            if (in_array('EKG jml', $detail) || in_array('EKG', $detail)) {
                                $out[] = 'EKG jml : <i>' . ($tb['isiEkgJml'] ?: '-') . '</i>';
                            }
                            if (in_array('Echocardiografi jml', $detail) || in_array('Echocardiografi', $detail)) {
                                $out[] = 'Echocardiografi jml : <i>' . ($tb['isiEchoJml'] ?: '-') . '</i>';
                            }
                            if (in_array('Lain-lain', $detail) || !empty($tb['isiFotoLainnya'])) {
                                $out[] = 'Lain-lain : <i>' . ($tb['isiFotoLainnya'] ?: '-') . '</i>';
                            }

                            if (!empty($out)) {
                                $chunks = array_chunk($out, 2);
                                echo '<table style="width: 100%; border-collapse: collapse;">';
                                foreach ($chunks as $chunk) {
                                    echo '<tr>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . $chunk[0] . '</td>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . ($chunk[1] ?? '') . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            }
                            ?>
                        </td>
                        <td>
                            <b>Foto : </b> <i><?= ($data->rm11a2Timbang["fotoStatus2"] ?? '-') === 'Ada' ? 'Ada, Jml : ' . ($data->rm11a2Timbang["isiFotoJml2"] ?: '-') : ($data->rm11a2Timbang["fotoStatus2"] ?: '-') ?></i>
                            <br>
                            <?php
                            $detail = json_decode($tb['fotoDetail2'] ?? '', true) ?? [];
                            $out = [];

                            if (in_array('Rontgen', $detail)) {
                                $out[] = 'Rontgen : <i>' . ($tb['isiRontgenKet2'] ?: '-') . ' | jml : ' . ($tb['isiRontgenJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('USG', $detail)) {
                                $out[] = 'USG : <i>' . ($tb['isiUsgKet2'] ?: '-') . ' | jml : ' . ($tb['isiUsgJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('BOF jml', $detail) || in_array('BOF', $detail)) {
                                $out[] = 'BOF jml : <i>' . ($tb['isiBofJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('IVP jml', $detail) || in_array('IVP', $detail)) {
                                $out[] = 'IVP jml : <i>' . ($tb['isiIvpJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('NST', $detail)) {
                                $out[] = 'NST : <i>' . ($tb['isiNst2'] ?: '-') . '</i>';
                            }
                            if (in_array('EKG jml', $detail) || in_array('EKG', $detail)) {
                                $out[] = 'EKG jml : <i>' . ($tb['isiEkgJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('Echocardiografi jml', $detail) || in_array('Echocardiografi', $detail)) {
                                $out[] = 'Echocardiografi jml : <i>' . ($tb['isiEchoJml2'] ?: '-') . '</i>';
                            }
                            if (in_array('Lain-lain', $detail) || !empty($tb['isiFotoLainnya2'])) {
                                $out[] = 'Lain-lain : <i>' . ($tb['isiFotoLainnya2'] ?: '-') . '</i>';
                            }

                            if (!empty($out)) {
                                $chunks = array_chunk($out, 2);
                                echo '<table style="width: 100%; border-collapse: collapse;">';
                                foreach ($chunks as $chunk) {
                                    echo '<tr>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . $chunk[0] . '</td>';
                                    echo '<td style="width: 50%; vertical-align: top;">' . ($chunk[1] ?? '') . '</td>';
                                    echo '</tr>';
                                }
                                echo '</table>';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Vital Sign : </b> TD : <?= ($tb['isiTdSistole'] ?: '-') ?>/<?= ($tb['isiTdDiastole'] ?: '-') ?> mmHg
                            <br>
                            S : <?= ($tb['isiSuhu'] ?: '-') ?> °C &nbsp;&nbsp;&nbsp; RR : <?= ($tb['isiRr'] ?: '-') ?> X/mnt &nbsp;&nbsp;&nbsp; N : <?= ($tb['isiNadi'] ?: '-') ?> X/mnt
                        </td>
                        <td>
                            <b>Vital Sign : </b> TD : <?= ($tb['isiTdSistole2'] ?: '-') ?>/<?= ($tb['isiTdDiastole2'] ?: '-') ?> mmHg
                            <br>
                            S : <?= ($tb['isiSuhu2'] ?: '-') ?> °C &nbsp;&nbsp;&nbsp; RR : <?= ($tb['isiRr2'] ?: '-') ?> X/mnt &nbsp;&nbsp;&nbsp; N : <?= ($tb['isiNadi2'] ?: '-') ?> X/mnt
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Puasa : </b> <?= ($tb['puasaStatus'] ?? '-') === 'Ya'
                                                ? 'Ya, makan/ minum terakhir jam : ' . ($tb['isiPuasaJam'] ?: '-')
                                                : ($tb['puasaStatus'] ?: '-') ?>
                        </td>
                        <td>
                            <b>Puasa : </b> <?= ($tb['puasaStatus2'] ?? '-') === 'Ya'
                                                ? 'Ya, makan/ minum terakhir jam : ' . ($tb['isiPuasaJam2'] ?: '-')
                                                : ($tb['puasaStatus2'] ?: '-') ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Lavement : </b> <?= ($tb['lavementStatus'] ?? '-') === 'Ya'
                                                    ? 'Ya : ' . ($tb['isiLavementKet'] ?: '-')
                                                    : ($tb['lavementStatus'] ?: '-') ?>
                        </td>
                        <td>
                            <b>Lavement : </b> <?= ($tb['lavementStatus2'] ?? '-') === 'Ya'
                                                    ? 'Ya : ' . ($tb['isiLavementKet2'] ?: '-')
                                                    : ($tb['lavementStatus2'] ?: '-') ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Tampon Anus : </b> <?= $tb['tamponAnus'] ?: '-' ?></td>
                        <td><b>Tampon Anus : </b> <?= $tb['tamponAnus2'] ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td><b>Sceren : </b> <?= $tb['scerenStatus'] ?: '-' ?></td>
                        <td><b>Sceren : </b> <?= $tb['scerenStatus2'] ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>Gigi palsu : </b> <?= ($tb['gigiPalsu'] ?? '-') === 'Ada'
                                                        ? 'Ada' . ($tb['isiGigiDibawaOleh'] ? '<br>dibawa oleh ' . $tb['isiGigiDibawaOleh'] : '')
                                                        : ($tb['gigiPalsu'] ?: '-') ?>
                        </td>
                        <td>
                            <b>Gigi palsu : </b> <?= ($tb['gigiPalsu2'] ?? '-') === 'Ada'
                                                        ? 'Ada' . ($tb['isiGigiDibawaOleh2'] ? '<br>dibawa oleh ' . $tb['isiGigiDibawaOleh2'] : '')
                                                        : ($tb['gigiPalsu2'] ?: '-') ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Kesadaran : </b> <?= ($tb['kesadaran'] ?? '-') === 'Lain-lain'
                                                    ? 'Lain-lain : ' . ($tb['isiKesadaranLain'] ?: '-')
                                                    : ($tb['kesadaran'] ?: '-') ?>
                        </td>
                        <td>
                            <b>Kesadaran : </b> <?= ($tb['kesadaran2'] ?? '-') === 'Lain-lain'
                                                    ? 'Lain-lain : ' . ($tb['isiKesadaranLain2'] ?: '-')
                                                    : ($tb['kesadaran2'] ?: '-') ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Keluarga menunggu di : </b> <?= $tb['keluargaTunggu'] ?: '-' ?>
                            <br>
                            <b>Kontak Person : </b> <?= $tb['isiKontakPerson'] ?: '-' ?>
                            <br>
                            <b>Telp yg dihubungi : </b> <?= $tb['isiTelpHubungi'] ?: '-' ?>
                        </td>
                        <td>
                            <b>Keluarga menunggu di : </b> <?= $tb['keluargaTunggu2'] ?: '-' ?>
                            <br>
                            <b>Kontak Person : </b> <?= $tb['isiKontakPerson2'] ?: '-' ?>
                            <br>
                            <b>Telp yg dihubungi : </b> <?= $tb['isiTelpHubungi2'] ?: '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>ASSESMENT</td>
                        <td> <?= $tb['assesment'] ?: '-' ?></td>
                        <td> <?= $tb['assesment2'] ?: '-' ?></td>
                    </tr>
                    <tr>
                        <td>RECOMMENDATION</td>
                        <td>
                            <?php
                            $didampingiArr = json_decode($tb['didampingi'] ?? '', true) ?? [];
                            ?>
                            <b>Didampingi : </b> <?= !empty($didampingiArr) ? implode(', ', $didampingiArr) : '-' ?>
                            <br>
                            <b>Alat Transport : </b><?= $tb['alatTransport'] ?: '-' ?>
                            <br>
                            <b>Medikasi Khusus : </b><?= $tb['medikasi'] ?: '-' ?>
                        </td>
                        <td>
                            <?php
                            $didampingiArr = json_decode($tb['didampingi2'] ?? '', true) ?? [];
                            ?>
                            <b>Didampingi : </b> <?= !empty($didampingiArr) ? implode(', ', $didampingiArr) : '-' ?>
                            <br>
                            <b>Alat Transport : </b><?= $tb['alatTransport2'] ?: '-' ?>
                            <br>
                            <b>Medikasi Khusus : </b><?= $tb['medikasi2'] ?: '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td class="p-0">
                            <table class="table table-sm table-bordered m-0 text-center">
                                <tr>
                                    <td>
                                        Petugas Pengantar
                                        <div id="ttdPengantar">
                                            <?php if ($data->rm11a2Timbang["ttdPengantar"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11a2Timbang/' . $data->rm11a2Timbang["ttdPengantar"]) . '" alt="tanda tangan Pengantar" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        <b>( <?= $tb['pengantar'] ?: '-' ?> ) </b>
                                        <br>
                                        Tanggal : <?= !empty($tb['waktu']) ? date('d-m-Y', strtotime($tb['waktu'])) : '-' ?>
                                        <br><br>
                                        <?php if (!$data->rm11a2Timbang["ttdPengantar"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPengantar">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        Petugas Penerima
                                        <div id="ttdPenerima">
                                            <?php if ($data->rm11a2Timbang["ttdPenerima"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11a2Timbang/' . $data->rm11a2Timbang["ttdPenerima"]) . '" alt="tanda tangan Penerima" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        <b>( <?= $tb['penerima'] ?: '-' ?> )</b>
                                        <br>
                                        Jam : <?= !empty($tb['waktu']) ? date('H:i', strtotime($tb['waktu'])) : '-' ?>
                                        <br><br>
                                        <?php if (!$data->rm11a2Timbang["ttdPenerima"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPenerima">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table table-sm table-bordered m-0 text-center">
                                <tr>
                                    <td>
                                        Petugas Pengantar
                                        <div id="ttdPengantar2">
                                            <?php if ($data->rm11a2Timbang["ttdPengantar2"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11a2Timbang/' . $data->rm11a2Timbang["ttdPengantar2"]) . '" alt="tanda tangan Pengantar" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        <b>( <?= $tb['pengantar2'] ?: '-' ?> )</b>
                                        <br>
                                        Tanggal : <?= !empty($tb['waktu']) ? date('d-m-Y', strtotime($tb['waktu'])) : '-' ?>
                                        <br><br>
                                        <?php if (!$data->rm11a2Timbang["ttdPengantar2"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPengantar2">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        Petugas Penerima
                                        <div id="ttdPenerima2">
                                            <?php if ($data->rm11a2Timbang["ttdPenerima2"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11a2Timbang/' . $data->rm11a2Timbang["ttdPenerima2"]) . '" alt="tanda tangan Penerima" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        <b>( <?= $tb['penerima2'] ?: '-' ?> )</b>
                                        <br>
                                        Jam : <?= !empty($tb['waktu']) ? date('H:i', strtotime($tb['waktu'])) : '-' ?>
                                        <br><br>
                                        <?php if (!$data->rm11a2Timbang["ttdPenerima2"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPenerima2">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>


                <input type="hidden" id="noRawat" value="<?= $data->rm11a2Timbang["noRawat"] ?>">

                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php
                        // Ambil objek/array RM11B1 Checklist
                        $ttd = $data->rm11a2Timbang;

                        // Cek apakah ADA SALAH SATU TTD yang masih kosong
                        if (
                            !$ttd["ttdPengantar"] ||
                            !$ttd["ttdPenerima"] ||
                            !$ttd["ttdPengantar2"] ||
                            !$ttd["ttdPenerima2"]
                        ) {
                        ?>
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

<!-- Modal ttdPengantar-->
<div class="modal fade" id="modalTtdPengantar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Pengantar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPengantar" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPengantar">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPengantar" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ttdPenerima-->
<div class="modal fade" id="modalTtdPenerima" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Penerima</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPenerima" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPenerima">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPenerima" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal ttdPengantar2-->
<div class="modal fade" id="modalTtdPengantar2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Pengantar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPengantar2" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPengantar2">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPengantar2" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ttdPenerima-->
<div class="modal fade" id="modalTtdPenerima2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Penerima</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPenerima2" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPenerima2">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPenerima2" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    function kunciTtd() {
        $("#pesanError").html("").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // Daftar 7 TTD yang ada di RM11B1 Checklist
        var listTtd = [{
                id: '#ttdPengantar',
                key: 'ttdPengantar'
            },
            {
                id: '#ttdPenerima',
                key: 'ttdPenerima'
            },
            {
                id: '#ttdPengantar2',
                key: 'ttdPengantar2'
            },
            {
                id: '#ttdPenerima2',
                key: 'ttdPenerima2'
            }
        ];

        // Object untuk menampung data AJAX
        var dataPayload = {
            noRawat: noRawat,
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };

        var adaTtdTerisi = false; // Flag penanda apakah minimal ada 1 TTD

        // Loop Pengecekan
        for (var i = 0; i < listTtd.length; i++) {
            var item = listTtd[i];
            var imgEl = $(item.id + " img");

            // Cek apakah elemen gambar ada (TTD terisi)
            if (imgEl.length > 0) {
                adaTtdTerisi = true; // Tandai bahwa minimal ada 1 TTD terisi

                // Cek apakah TTD baru
                var isNew = (imgEl.attr('data-is-new') === 'true' || imgEl.data('is-new') === true);
                dataPayload[item.key] = isNew ? imgEl.attr('src') : '';
            } else {
                // Jika kosong, kirim string kosong ke backend
                dataPayload[item.key] = '';
            }
        }

        // VALIDASI: Jika TIDAK ADA 1 pun TTD yang terisi (kosong semua)
        if (!adaTtdTerisi) {
            $("#pesanError").addClass("alert alert-danger").html("Minimal harus ada 1 tanda tangan yang terisi.");
            $("#modalKunci").modal("hide");
            return; // Hentikan proses, jangan kirim AJAX
        }

        console.log(dataPayload)

        // Kirim AJAX ke Backend jika minimal ada 1 TTD
        $.ajax({
            url: '<?= base_url() ?>rm/rm11a2Timbang/simpanTtd',
            method: 'POST',
            data: dataPayload,
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

    //========================================================

    document.addEventListener('DOMContentLoaded', () => {

        // Helper Function untuk Inisialisasi Canvas Tanda Tangan
        function setupSignaturePad(config) {
            const canvas = document.getElementById(config.canvasId);
            if (!canvas) return; // Guard clause jika elemen tidak ditemukan

            const ctx = canvas.getContext('2d');
            const btnHapus = document.getElementById(config.btnHapusId);
            const btnSimpan = document.getElementById(config.btnSimpanId);
            const containerHasil = document.getElementById(config.hasilId);

            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Styling Canvas
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#000';

            // Mendapatkan posisi koordinat (Support Mouse & Touch)
            function getCoordinates(e) {
                const rect = canvas.getBoundingClientRect();
                const clientX = e.touches ? e.touches[0].clientX : e.clientX;
                const clientY = e.touches ? e.touches[0].clientY : e.clientY;
                return [clientX - rect.left, clientY - rect.top];
            }

            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = getCoordinates(e);
            }

            function draw(e) {
                if (!isDrawing) return;

                // FIX: Menggunakan variabel btnSimpan langsung tanpa jQuery & tanpa error 'undefined'
                if (btnSimpan) btnSimpan.disabled = false;

                const [currentX, currentY] = getCoordinates(e);

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(currentX, currentY);
                ctx.stroke();

                [lastX, lastY] = [currentX, currentY];
            }

            function stopDrawing() {
                isDrawing = false;
            }

            // Event Listeners Mouse
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            // Event Listeners Touch (HP/Tablet)
            canvas.addEventListener('touchstart', startDrawing);
            canvas.addEventListener('touchmove', draw);
            canvas.addEventListener('touchend', stopDrawing);

            // Tombol Hapus / Clear
            if (btnHapus) {
                btnHapus.addEventListener('click', () => {
                    if (btnSimpan) btnSimpan.disabled = true;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                });
            }

            // Tombol Simpan
            if (btnSimpan) {
                btnSimpan.addEventListener('click', () => {
                    const dataURL = canvas.toDataURL('image/png');
                    const img = document.createElement('img');
                    img.src = dataURL;
                    img.alt = config.altText;
                    img.style.maxWidth = '75px';
                    img.style.maxHeight = '50px';
                    img.setAttribute('data-is-new', 'true');

                    if (containerHasil) {
                        containerHasil.innerHTML = '';
                        containerHasil.appendChild(img);
                    }

                    if (config.modalId) {
                        // Menutup modal (asumsi menggunakan Bootstrap)
                        if (window.jQuery && $.fn.modal) {
                            $(`#${config.modalId}`).modal("hide");
                        } else {
                            const modalElem = document.getElementById(config.modalId);
                            if (modalElem && window.bootstrap) {
                                const modalInstance = bootstrap.Modal.getInstance(modalElem) || new bootstrap.Modal(modalElem);
                                modalInstance.hide();
                            }
                        }
                    }
                });
            }
        }

        // ===================================================
        // DAFTAR KONFIGURASI TANDA TANGAN (RM11B1 CHECKLIST)
        // ===================================================
        const signatureConfigs = [{
                canvasId: 'tempatTtdPenerima',
                btnHapusId: 'hapusTtdPenerima',
                btnSimpanId: 'simpanTtdPenerima',
                hasilId: 'ttdPenerima',
                modalId: 'modalTtdPenerima',
                altText: 'Tanda tangan penerima'
            },
            {
                canvasId: 'tempatTtdPengantar',
                btnHapusId: 'hapusTtdPengantar',
                btnSimpanId: 'simpanTtdPengantar',
                hasilId: 'ttdPengantar',
                modalId: 'modalTtdPengantar',
                altText: 'Tanda tangan Pengantar'
            }, {
                canvasId: 'tempatTtdPenerima2',
                btnHapusId: 'hapusTtdPenerima2',
                btnSimpanId: 'simpanTtdPenerima2',
                hasilId: 'ttdPenerima2',
                modalId: 'modalTtdPenerima2',
                altText: 'Tanda tangan penerima 2'
            },
            {
                canvasId: 'tempatTtdPengantar2',
                btnHapusId: 'hapusTtdPengantar2',
                btnSimpanId: 'simpanTtdPengantar2',
                hasilId: 'ttdPengantar2',
                modalId: 'modalTtdPengantar2',
                altText: 'Tanda tangan Pengantar 2'
            }
        ];

        // ===================================================
        // EXECUTE INITIALIZATION (LOOPING)
        // ===================================================
        signatureConfigs.forEach(config => setupSignaturePad(config));

    });
</script>

</html>