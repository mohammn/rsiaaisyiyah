<?php

// Fungsi helper singkat untuk mengubah format datetime
function formatDateTime($datetimeStr)
{
    if (empty($datetimeStr) || $datetimeStr === '-') {
        return '-';
    }
    try {
        $date = new DateTime($datetimeStr);
        return $date->format('d-m-Y H:i') . ' WIB';
    } catch (Exception $e) {
        return $datetimeStr; // Mengembalikan string asli jika format tidak valid
    }
}

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

    .tabelSempit td,
    .tabelSempit th {
        padding-top: 0mm;
        padding-bottom: 0mm;
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
    <title>Rm 11b2 Monitoring Anestesi</title>

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
                            RM 11b2
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
                        <p style="font-size: 14pt; margin:10px; margin-bottom:5;" class="text-uppercase fw-bold"> INTRA ANESTESI
                        </p>
                    </div>
                </div>

                <div class="bg-light p-2 rounded border border-secondary">
                    <div class="w-100 text-center">
                        <b>Monitoring Intra Anestesi</b>
                    </div>
                    <!-- Berikan height (misal: 350px atau 400px) pada div pembungkusnya -->
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="chartMonitoringIntraAnestesi"></canvas>
                    </div>
                </div>
                <br>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless tabelSempit mb-0">
                                <tr>
                                    <td>Obat-obatan</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["obatObatan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Ventilasi</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["ventilasi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>TV</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["tv"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Rate</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["rate"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>PEEP</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["peep"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Gas Flow :</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <div class="form-group">
                                            <div style="padding-left: 15px;">
                                                <?php
                                                // Ambil data gasFlow dari objek
                                                $rawGasFlow = $data->rm11b2MonitoringAnestesi['gasFlow'] ?? [];

                                                // Jika disimpan sebagai string JSON, decode dulu. Jika sudah berupa array, lewati.
                                                $selectedGas = is_string($rawGasFlow) ? json_decode($rawGasFlow, true) : $rawGasFlow;
                                                if (!is_array($selectedGas)) {
                                                    $selectedGas = [];
                                                }

                                                // Ambil nilai masing-masing input
                                                $n2oVal  = $data->rm11b2MonitoringAnestesi['n2o_value'] ?? '';
                                                $o2Val   = $data->rm11b2MonitoringAnestesi['o2_value'] ?? '';
                                                $inhVal  = $data->rm11b2MonitoringAnestesi['inhalasi_value'] ?? '';
                                                ?>

                                                <!-- 1. N2O (Hanya tampil jika ada di dalam array gasFlow) -->
                                                <?php if (in_array('N2O', $selectedGas)): ?>
                                                    <div>
                                                        ✔ N<sub>2</sub>O : <strong><?= esc($n2oVal) ?></strong> Lpm
                                                    </div>
                                                <?php endif; ?>

                                                <!-- 2. O2 (Hanya tampil jika ada di dalam array gasFlow) -->
                                                <?php if (in_array('O2', $selectedGas) || in_array('O2', $selectedGas)): ?>
                                                    <div>
                                                        ✔ O<sub>2</sub> : <strong><?= esc($o2Val) ?></strong> Lpm
                                                    </div>
                                                <?php endif; ?>

                                                <!-- 3. Air (Hanya tampil jika ada di dalam array gasFlow) -->
                                                <?php if (in_array('Air', $selectedGas)): ?>
                                                    <div>
                                                        ✔ Air
                                                    </div>
                                                <?php endif; ?>

                                                <!-- 4. Gas Inhalasi (Hanya tampil jika ada di dalam array gasFlow) -->
                                                <?php if (in_array('Gas Inhalasi', $selectedGas)): ?>
                                                    <div>
                                                        ✔ Gas Inhalasi :
                                                        <div style="padding-left: 15px;">
                                                            <strong><?= esc($inhVal) ?></strong>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>


                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="table table-sm table-borderless tabelSempit mb-0">
                                <tr>
                                    <td>Waktu Masuk OK</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuMasukOk"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Pembiusan</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuPembiusan"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Insisi</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuInsisi"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Selesai Operasi</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuSelesaiOp"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Selesai Anestesi</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuSelesaiAnestesi"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Keluar Ok</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuKeluarOk"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Bayi Lahir</td>
                                    <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuBayiLahir"] ?? null) ?></td>
                                </tr>
                                <tr>
                                    <td>Apgar Score</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["apgarScore"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>BB</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["bb"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>TB</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["tb"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                </table>
                <table class="table table-sm table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center bg-light">Cairan Pra-anestesi</th>
                            <th class="text-center bg-light">Cairan Intra-Anestesi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="p-0">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cairan Masuk</th>
                                            <th>Catatan Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td>Kristaloid</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["kristaloidPra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kolloid</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["kolloidPra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Darah</td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="ps-3">
                                                            WB : <?= $data->rm11b2MonitoringAnestesi["wbPra"] ?? '-' ?><br>
                                                            FFP : <?= $data->rm11b2MonitoringAnestesi["ffpPra"] ?? '-' ?><br>
                                                            PRC : <?= $data->rm11b2MonitoringAnestesi["prcPra"] ?? '-' ?><br>
                                                            TC : <?= $data->rm11b2MonitoringAnestesi["tcPra"] ?? '-' ?><br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain-lain</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["cairanLainPra"] ?? '-' ?></td>
                                                    </tr>

                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-sm table-borderless">
                                                    <tr>
                                                        <td>Urin</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["urinPra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>S&I</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["s_iPra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Darah</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["darahPra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>EBV</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["ebvPra"] ?? '-' ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                            <td class="p-0">
                                <table class="table table-sm table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>Cairan Masuk</th>
                                            <th>Catatan Keluar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td>Kristaloid</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["kristaloidIntra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kolloid</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["kolloidIntra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Darah</td>
                                                        <td>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="ps-3">
                                                            WB : <?= $data->rm11b2MonitoringAnestesi["wbIntra"] ?? '-' ?><br>
                                                            FFP : <?= $data->rm11b2MonitoringAnestesi["ffpIntra"] ?? '-' ?><br>
                                                            PRC : <?= $data->rm11b2MonitoringAnestesi["prcIntra"] ?? '-' ?><br>
                                                            TC : <?= $data->rm11b2MonitoringAnestesi["tcIntra"] ?? '-' ?><br>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lain-lain</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["cairanLainIntra"] ?? '-' ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                <table class="table table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td>Urin</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["urinIntra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>S&I</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["s_iIntra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Darah</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["darahIntra"] ?? '-' ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>EBV</td>
                                                        <td>: <?= $data->rm11b2MonitoringAnestesi["ebvIntra"] ?? '-' ?></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td style="width: 40%;">
                            <b>Anestesi Regional / Blok Saraf Perifer</b>
                            <table class="table table-sm table-borderless mb-0 tabelSempit">
                                <tr>
                                    <td>Teknik</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["teknik"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Anestesi Lokal Obat</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["anestesi_lokal_obat"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tipe</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["tipe"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Jumlah Volume</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["jumlah_volume"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Masalah/Keterangan</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["masalah_keterangan"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                        <td style="width: 40%;">
                            <b>Catatan :</b> <br>
                            <?= nl2br(esc($data->rm11b2MonitoringAnestesi["catatanIntra"])) ?? '-' ?>
                        </td>
                        <td class="text-center">
                            Bangkalan,
                            <?php
                            $waktuTtd1 = $data->rm11b2MonitoringAnestesi["waktuTtd1"] ?? null;
                            if (!empty($waktuTtd1) && $waktuTtd1 !== '-') {
                                $date = new DateTime($waktuTtd1);
                                echo $date->format('d-m-Y');
                            } else {
                                echo '-';
                            }
                            ?>
                            <br>
                            Dokter DPJP
                            <div id="ttdDokter">
                                <?php if ($data->rm11b2MonitoringAnestesi["ttdDokter"]) {
                                    // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                    echo '<img src="' . base_url('public/ttd/rm11b2MonitoringAnestesi/' . $data->rm11b2MonitoringAnestesi["ttdDokter"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                } else {
                                    echo '<br><br><br><br><br>';
                                } ?>
                            </div>
                            <br>
                            (<?= $data->rm11b2MonitoringAnestesi["dokter1"] ?? '-' ?> )
                            <br><br>
                            <?php if (!$data->rm11b2MonitoringAnestesi["ttdDokter"]) {
                            ?>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter">
                                    TTD
                                </button>
                            <?php }
                            ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="150%" alt=""></div>
                    <div class="col-3">
                        <br><br>
                    </div>
                    <div class="col-5">
                        <div style="text-align: end;">
                            RM 11b2
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
                        <p style="font-size: 14pt; margin:10px; margin-bottom:5;" class="text-uppercase fw-bold"> PASCA ANESTESI
                        </p>
                    </div>
                </div>


                <div class="bg-light p-2 rounded border border-secondary">
                    <div class="w-100 text-center">
                        <b>Monitoring Pasca Anestesi</b>
                    </div>
                    <!-- Berikan height (misal: 350px atau 400px) pada div pembungkusnya -->
                    <div style="position: relative; height: 300px; width: 100%;">
                        <canvas id="chartMonitoringPascaAnestesi"></canvas>
                    </div>
                </div>
                <br>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td style="width: 50%;">
                            <table class="table table-sm table-borderless">
                                <tr>
                                    <td>Pendarahan</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["pendarahan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kontraksi Uterus</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["kontraksi_uterus"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kompartemen Syndrom</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["kompartemen_syndrom"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Masalah / Komentar</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["masalah_komentar"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <b>Pesanan / Tindakan di ruang pulih sadar :</b><br>
                            <?= nl2br(esc($data->rm11b2MonitoringAnestesi["perasanTindakan"] ?? '-')) ?>
                        </td>
                    </tr>
                </table>

                <?php
                // Ambil dan decode JSON dari kolom bromage_t
                $bromage_t = json_decode($data->rm11b2MonitoringAnestesi['bromage_t'] ?? '{}', true) ?: [];
                $bromage_keluar = $data->rm11b2MonitoringAnestesi['bromage_keluar'] ?? '';
                ?>

                <table class="table table-bordered align-middle text-center table-sm table-hover" id="bromageTable">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 35%;">Bromage Score</th>
                            <th style="width: 7%;">N</th>
                            <th style="width: 4%;">0"</th>
                            <th style="width: 4%;">5"</th>
                            <th style="width: 4%;">15"</th>
                            <th style="width: 4%;">30"</th>
                            <th style="width: 4%;">45"</th>
                            <th style="width: 4%;">1'</th>
                            <th style="width: 4%;">2'</th>
                            <th style="width: 4%;">3'</th>
                            <th style="width: 4%;">4'</th>
                            <th style="width: 8%;">K</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- BROMAGE 3 -->
                        <tr>
                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage3.png" width="50%" alt="">
                                <div class="small fw-semibold mt-1">Bromage 3 (complete)</div>
                            </td>
                            <td class="fw-bold">3</td>
                            <td><?= (($bromage_t['0'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['5'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['15'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['30'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['45'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['60'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['120'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['180'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['240'] ?? '') == '3') ? '✓' : '' ?></td>
                            <td><?= ($bromage_keluar == '3') ? '✓' : '' ?></td>
                        </tr>

                        <!-- BROMAGE 2 -->
                        <tr>
                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage2.png" width="50%" alt="">
                                <div class="small fw-semibold mt-1">Bromage 2 (almost complete)</div>
                            </td>
                            <td class="fw-bold">2</td>
                            <td><?= (($bromage_t['0'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['5'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['15'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['30'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['45'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['60'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['120'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['180'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['240'] ?? '') == '2') ? '✓' : '' ?></td>
                            <td><?= ($bromage_keluar == '2') ? '✓' : '' ?></td>
                        </tr>

                        <!-- BROMAGE 1 -->
                        <tr>
                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage1.png" width="50%" alt="">
                                <div class="small fw-semibold mt-1">Bromage 1 (partial)</div>
                            </td>
                            <td class="fw-bold">1</td>
                            <td><?= (($bromage_t['0'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['5'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['15'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['30'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['45'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['60'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['120'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['180'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['240'] ?? '') == '1') ? '✓' : '' ?></td>
                            <td><?= ($bromage_keluar == '1') ? '✓' : '' ?></td>
                        </tr>

                        <!-- BROMAGE 0 -->
                        <tr>
                            <td class="text-center align-middle bg-white" style="height: 70px;">
                                <img src="<?= base_url() ?>public/assets/img/Rm11b2MonitoringAnestesi/bromage0.png" width="50%" alt="">
                                <div class="small fw-semibold mt-1">Bromage 0 (none)</div>
                            </td>
                            <td class="fw-bold">0</td>
                            <td><?= (($bromage_t['0'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['5'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['15'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['30'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['45'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['60'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['120'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['180'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= (($bromage_t['240'] ?? '') == '0') ? '✓' : '' ?></td>
                            <td><?= ($bromage_keluar == '0') ? '✓' : '' ?></td>
                        </tr>
                    </tbody>
                </table>

                <?php
                // Ambil dan decode JSON untuk masing-masing parameter dari database
                $sirkulasi = json_decode($data->rm11b2MonitoringAnestesi['sirkulasi_t'] ?? '{}', true) ?: [];
                $sirkulasi_keluar = $data->rm11b2MonitoringAnestesi['sirkulasi_keluar'] ?? '';

                $kesadaran = json_decode($data->rm11b2MonitoringAnestesi['kesadaran_t'] ?? '{}', true) ?: [];
                $kesadaran_keluar = $data->rm11b2MonitoringAnestesi['kesadaran_keluar'] ?? '';

                $oksigenasi = json_decode($data->rm11b2MonitoringAnestesi['oksigenasi_t'] ?? '{}', true) ?: [];
                $oksigenasi_keluar = $data->rm11b2MonitoringAnestesi['oksigenasi_keluar'] ?? '';

                $pernafasan = json_decode($data->rm11b2MonitoringAnestesi['pernafasan_t'] ?? '{}', true) ?: [];
                $pernafasan_keluar = $data->rm11b2MonitoringAnestesi['pernafasan_keluar'] ?? '';

                $aktivitas = json_decode($data->rm11b2MonitoringAnestesi['aktivitas_t'] ?? '{}', true) ?: [];
                $aktivitas_keluar = $data->rm11b2MonitoringAnestesi['aktivitas_keluar'] ?? '';

                // Daftar waktu yang ada pada kolom tabel
                $waktu_kolom = ['0', '5', '15', '30', '45', '60', '120', '180', '240'];
                ?>

            </div>
        </div>
        <div class="page">
            <div class="subpage">
                <br>
                <b>TD Pra-Anestesi : <?= $data->rm11b2MonitoringAnestesi["td_pra_anestesi"] ?? '-' ?>.</b><br><br>
                <table class="table table-bordered table-sm table-striped table-hover align-middle text-center" id="aldreteTable">
                    <thead>
                        <tr>
                            <th style="width: 15%;">Parameter</th>
                            <th style="width: 38%;">Kriteria Penilaian</th>
                            <th style="width: 5%;">N</th>
                            <th style="width: 4%;">0"</th>
                            <th style="width: 4%;">5"</th>
                            <th style="width: 4%;">15"</th>
                            <th style="width: 4%;">30"</th>
                            <th style="width: 4%;">45"</th>
                            <th style="width: 4%;">1'</th>
                            <th style="width: 4%;">2'</th>
                            <th style="width: 4%;">3'</th>
                            <th style="width: 4%;">4'</th>
                            <th style="width: 8%;">k</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- SIRKULASI -->
                        <tr>
                            <td rowspan="3" class="fw-bold bg-white">Sirkulasi</td>
                            <td class="text-start">TD +/- 20 mmHg dari normal</td>
                            <td class="fw-bold">2</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($sirkulasi[$w] ?? '') == '2') ? '2' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($sirkulasi_keluar == '2') ? '2' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">TD +/- 20-50 mmHg dari normal</td>
                            <td class="fw-bold">1</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($sirkulasi[$w] ?? '') == '1') ? '1' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($sirkulasi_keluar == '1') ? '1' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">TD +/- > 50 mmHg dari normal</td>
                            <td class="fw-bold">0</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($sirkulasi[$w] ?? '') == '0') ? '0' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($sirkulasi_keluar == '0') ? '0' : '' ?></td>
                        </tr>

                        <!-- KESADARAN -->
                        <tr>
                            <td rowspan="3" class="fw-bold bg-white">Kesadaran</td>
                            <td class="text-start">Sadar penuh</td>
                            <td class="fw-bold">2</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($kesadaran[$w] ?? '') == '2') ? '2' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($kesadaran_keluar == '2') ? '2' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Respon terhadap panggilan</td>
                            <td class="fw-bold">1</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($kesadaran[$w] ?? '') == '1') ? '1' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($kesadaran_keluar == '1') ? '1' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Tidak ada respon</td>
                            <td class="fw-bold">0</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($kesadaran[$w] ?? '') == '0') ? '0' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($kesadaran_keluar == '0') ? '0' : '' ?></td>
                        </tr>

                        <!-- OKSIGENASI -->
                        <tr>
                            <td rowspan="3" class="fw-bold bg-white">Oksigenasi</td>
                            <td class="text-start">SpO₂ > 92% (dengan udara bebas)</td>
                            <td class="fw-bold">2</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($oksigenasi[$w] ?? '') == '2') ? '2' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($oksigenasi_keluar == '2') ? '2' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">SpO₂ > 92% (dengan suplemen O₂)</td>
                            <td class="fw-bold">1</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($oksigenasi[$w] ?? '') == '1') ? '1' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($oksigenasi_keluar == '1') ? '1' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">SpO₂ < 92% (dengan suplemen O₂)</td>
                            <td class="fw-bold">0</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($oksigenasi[$w] ?? '') == '0') ? '0' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($oksigenasi_keluar == '0') ? '0' : '' ?></td>
                        </tr>

                        <!-- PERNAFASAN -->
                        <tr>
                            <td rowspan="3" class="fw-bold bg-white">Pernafasan</td>
                            <td class="text-start">Bisa menarik nafas dalam dan batuk bebas</td>
                            <td class="fw-bold">2</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($pernafasan[$w] ?? '') == '2') ? '2' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($pernafasan_keluar == '2') ? '2' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Dispeneu atau limitasi bernafas</td>
                            <td class="fw-bold">1</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($pernafasan[$w] ?? '') == '1') ? '1' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($pernafasan_keluar == '1') ? '1' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Apnea/tidak bernafas</td>
                            <td class="fw-bold">0</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($pernafasan[$w] ?? '') == '0') ? '0' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($pernafasan_keluar == '0') ? '0' : '' ?></td>
                        </tr>

                        <!-- AKTIVITAS -->
                        <tr>
                            <td rowspan="3" class="fw-bold bg-white">Aktivitas</td>
                            <td class="text-start">Menggerakkan 4 ekstremitas</td>
                            <td class="fw-bold">2</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($aktivitas[$w] ?? '') == '2') ? '2' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($aktivitas_keluar == '2') ? '2' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Menggerakkan 2 ekstremitas</td>
                            <td class="fw-bold">1</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($aktivitas[$w] ?? '') == '1') ? '1' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($aktivitas_keluar == '1') ? '1' : '' ?></td>
                        </tr>
                        <tr>
                            <td class="text-start">Tidak mampu menggerakkan ekstremitas</td>
                            <td class="fw-bold">0</td>
                            <?php foreach ($waktu_kolom as $w): ?>
                                <td><?= (($aktivitas[$w] ?? '') == '0') ? '0' : '' ?></td>
                            <?php endforeach; ?>
                            <td><?= ($aktivitas_keluar == '0') ? '0' : '' ?></td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" class="text-start align-top">
                                <label for="catatanAldrete" class="form-label fw-semibold">Catatan :</label>
                                <div class="p-1 border rounded bg-light"><?= $data->rm11b2MonitoringAnestesi['catatanAldrete'] ?? '-' ?></div>
                            </td>
                            <td colspan="1" class="align-middle fw-bold bg-light text-end">Total</td>
                            <?php
                            // Menghitung total skor per kolom waktu secara otomatis
                            foreach ($waktu_kolom as $w):
                                $tot = (int)($sirkulasi[$w] ?? 0) + (int)($kesadaran[$w] ?? 0) + (int)($oksigenasi[$w] ?? 0) + (int)($pernafasan[$w] ?? 0) + (int)($aktivitas[$w] ?? 0);
                            ?>
                                <td class="fw-bold"><?= $tot ?></td>
                            <?php endforeach; ?>
                            <?php
                            $tot_keluar = (int)($sirkulasi_keluar !== '' ? $sirkulasi_keluar : 0) + (int)($kesadaran_keluar !== '' ? $kesadaran_keluar : 0) + (int)($oksigenasi_keluar !== '' ? $oksigenasi_keluar : 0) + (int)($pernafasan_keluar !== '' ? $pernafasan_keluar : 0) + (int)($aktivitas_keluar !== '' ? $aktivitas_keluar : 0);
                            ?>
                            <td class="fw-bold"><?= $tot_keluar ?></td>
                        </tr>
                    </tfoot>
                </table>

                Pasien Pindah ke : <b><?= $data->rm11b2MonitoringAnestesi["pindahKe"] ?? '-' ?>.</b> Tanggal / Jam : <b><?= formatDateTime($data->rm11b2MonitoringAnestesi["waktuPindah"] ?? null) ?>.</b> Disetujui oleh : <b><?= $data->rm11b2MonitoringAnestesi["disetujuiOleh"] ?? '-' ?>.</b> TT : <b><?= $data->rm11b2MonitoringAnestesi["tt"] ?? '-' ?>.</b>
                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="3" class="text-center fw-bold">Pesanan Pasien Pindah Pasca Anestesi</td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>Infus</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["infus"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td rowspan="4">2</td>
                        <td>Puasa sampai dengan</td>
                        <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["puasaSampai"] ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Minum</td>
                        <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["puasaMinum"] ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Makan</td>
                        <td>: <?= formatDateTime($data->rm11b2MonitoringAnestesi["puasaMakan"] ?? null) ?></td>
                    </tr>
                    <tr>
                        <td>Bising usus</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["bisingUsus"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td rowspan="6">3</td>
                        <td>Observasi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["observasi"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Tensi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["tensi"] ?? '-' ?> bila sistole > 160 mmHg <?= $data->rm11b2MonitoringAnestesi["tensi_bila"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Nadi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["nadi"] ?? '-' ?> bila <?= $data->rm11b2MonitoringAnestesi["nadi_bila"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Kesadaran</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["kesadaran"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Produksi urin</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["produksi_urine"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Perfusi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["perfusi"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Terapi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["terapi"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Mobilisasi</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["mobilisasi"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Lain-lain</td>
                        <td>: <?= $data->rm11b2MonitoringAnestesi["pascaOpLain"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="text-center" style="width: 33.34%;">
                                        Perawat
                                        <div id="ttdPerawat">
                                            <?php if ($data->rm11b2MonitoringAnestesi["ttdPerawat"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b2MonitoringAnestesi/' . $data->rm11b2MonitoringAnestesi["ttdPerawat"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b2MonitoringAnestesi["perawat"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b2MonitoringAnestesi["ttdPerawat"]) {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPerawat">
                                                TTD
                                            </button>
                                        <?php }
                                        ?>
                                    </td>
                                    <td class="text-center" style="width: 33.34%;">
                                        Perawat RR
                                        <div id="ttdPerawatRr">
                                            <?php if ($data->rm11b2MonitoringAnestesi["ttdPerawatRr"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b2MonitoringAnestesi/' . $data->rm11b2MonitoringAnestesi["ttdPerawatRr"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b2MonitoringAnestesi["perawatRr"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b2MonitoringAnestesi["ttdPerawatRr"]) {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPerawatRr">
                                                TTD
                                            </button>
                                        <?php }
                                        ?>
                                    </td>
                                    <td class="text-center">
                                        Anestesi
                                        <div id="ttdAnestesi">
                                            <?php if ($data->rm11b2MonitoringAnestesi["ttdAnestesi"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b2MonitoringAnestesi/' . $data->rm11b2MonitoringAnestesi["ttdAnestesi"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b2MonitoringAnestesi["perawatAnestesi"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b2MonitoringAnestesi["ttdAnestesi"]) {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdAnestesi">
                                                TTD
                                            </button>
                                        <?php }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <input type="hidden" id="noRawat" value="<?= $data->rm11b2MonitoringAnestesi["noRawat"] ?>">

                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php
                        // Ambil objek/array RM11B1 Checklist
                        $ttd = $data->rm11b2MonitoringAnestesi;

                        // Cek apakah ADA SALAH SATU TTD yang masih kosong
                        if (
                            !$ttd["ttdDokter"] ||
                            !$ttd["ttdPerawat"] ||
                            !$ttd["ttdPerawatRr"] ||
                            !$ttd["ttdAnestesi"]
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

<div class="modal fade" id="modalTtdDokter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdPerawat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Perawat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPerawat" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPerawat">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPerawat" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdPerawatRr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Perawat RR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPerawatRr" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPerawatRr">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPerawatRr" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdAnestesi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Anestesi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdAnestesi" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdAnestesi">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdAnestesi" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>

<script>
    function chartMonitoringIntraAnestesi() {
        var ctx = document.getElementById("chartMonitoringIntraAnestesi").getContext('2d');

        if (window.myAnesthesiaChart instanceof Chart) {
            window.myAnesthesiaChart.destroy();
        }

        window.myAnesthesiaChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["00:00"],
                datasets: [{
                        label: "Sistolik",
                        data: [0],
                        borderColor: "#ef4444",
                        backgroundColor: "#ef4444",
                        pointBackgroundColor: "#ef4444",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointStyle: 'circle',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "Diastolik",
                        data: [0],
                        borderColor: "#3b82f6",
                        backgroundColor: "#3b82f6",
                        pointBackgroundColor: "#3b82f6",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 7,
                        pointStyle: 'rectRot',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "RR",
                        data: [0],
                        borderColor: "#10b981",
                        backgroundColor: "#10b981",
                        pointBackgroundColor: "#10b981",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointStyle: 'rect',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "Temp",
                        data: [0],
                        borderColor: "#f59e0b",
                        backgroundColor: "#f59e0b",
                        pointBackgroundColor: "#f59e0b",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 7,
                        pointStyle: 'triangle',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "SpO2",
                        data: [0],
                        borderColor: "#8b5cf6",
                        backgroundColor: "#8b5cf6",
                        pointBackgroundColor: "#8b5cf6",
                        pointBorderColor: "#8b5cf6",
                        pointBorderWidth: 2.5,
                        pointRadius: 6,
                        pointStyle: 'crossRot',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#4a5568',
                            font: {
                                weight: 'normal',
                                size: 11
                            }
                        }
                    },
                    y: {
                        ticks: {
                            stepSize: 20,
                            color: '#4a5568',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: "rgba(226, 232, 240, 0.8)",
                            borderDash: [2, 2]
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 14,
                            boxHeight: 14,
                            padding: 15,
                            color: '#2d3748',
                            font: {
                                size: 12,
                                weight: 'normal'
                            },
                            generateLabels: function(chart) {
                                const originalLabels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                                originalLabels.forEach((label, index) => {
                                    const dataset = chart.data.datasets[index];
                                    label.pointStyle = dataset.pointStyle;
                                    label.pointStyleWidth = 12;
                                });
                                return originalLabels;
                            }
                        }
                    }
                }
            },
            // --- PLUGIN KUSTOM UNTUK MENAMPILKAN ANGKA DI ATAS TITIK GRAFIK ---
            plugins: [{
                id: 'customCanvasValLabels',
                afterDatasetsDraw(chart) {
                    const {
                        ctx
                    } = chart;
                    ctx.save();

                    chart.data.datasets.forEach((dataset, datasetIndex) => {
                        const meta = chart.getDatasetMeta(datasetIndex);
                        if (!meta.hidden) {
                            meta.data.forEach((element, index) => {
                                const dataVal = dataset.data[index];

                                // Jangan tampilkan angka jika nilainya 0 atau kosong (opsional)
                                if (dataVal !== undefined && dataVal !== null) {
                                    ctx.font = 'bold 11px sans-serif';
                                    ctx.fillStyle = dataset.borderColor; // Warna teks mengikuti warna garis dataset
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'bottom';

                                    // Posisi teks sedikit di atas titik koordinat (y - 10 pixel)
                                    const position = element.tooltipPosition();
                                    ctx.fillText(dataVal, position.x, position.y - 10);
                                }
                            });
                        }
                    });
                    ctx.restore();
                }
            }]
        });
    }

    function getDataMonitoringIntra() {
        var data = {
            // ID / Informasi Tambahan (Opsional/Disesuaikan)
            idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",
            jenis: 'intra'
        };

        $.ajax({
            url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoring") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Ambil data yang sudah dikelompokkan dari server untuk grafik
                    const cd = response.chart_data;
                    // Ambil data mentah dari database untuk tabel
                    const dbData = response.data_db;

                    // 1. Cek apakah grafik sudah diinisialisasi
                    if (window.myAnesthesiaChart instanceof Chart) {

                        // --- PERBARUI LABEL (SUMBU X / WAKTU) ---
                        window.myAnesthesiaChart.data.labels = cd.jam;

                        // --- PERBARUI DATA MASING-MASING DATASET ---
                        window.myAnesthesiaChart.data.datasets[0].data = cd.sistolik;
                        window.myAnesthesiaChart.data.datasets[1].data = cd.diastolik;
                        window.myAnesthesiaChart.data.datasets[2].data = cd.rr;
                        window.myAnesthesiaChart.data.datasets[3].data = cd.temp;
                        window.myAnesthesiaChart.data.datasets[4].data = cd.spo2;

                        // 2. Render ulang grafik agar perubahan langsung tampil
                        window.myAnesthesiaChart.update();

                        console.log("Grafik berhasil diperbarui dengan data terbaru!");

                        // --- 3. MUAT DATA KE DALAM TABEL ---
                        let rowsHtml = '';
                        if (dbData && dbData.length > 0) {
                            dbData.forEach(function(item) {
                                rowsHtml += `<tr>
                                <td>${item.waktu}</td>
                                <td>${item.sistolik}</td>
                                <td>${item.diastolik}</td>
                                <td>${item.rr}</td>
                                <td>${item.spo2}</td>
                                <td>${item.temp}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-sm py-0 px-1" onclick="hapusMonitoring(${item.id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                            });
                        } else {
                            rowsHtml = `<tr><td colspan="7" class="text-center text-muted">Belum ada data monitoring.</td></tr>`;
                        }

                        // Masukkan baris ke dalam tbody tabel
                        $('#tabelIntraAnestesi').html(rowsHtml);

                    } else {
                        // Jika grafik belum ada/belum dirender, panggil fungsi pembuat chart utamanya
                        chartMonitoringAnestesi();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });
    }

    function chartMonitoringPascaAnestesi() {
        var ctx = document.getElementById("chartMonitoringPascaAnestesi").getContext('2d');

        if (window.myAnesthesibChart instanceof Chart) {
            window.myAnesthesibChart.destroy();
        }

        window.myAnesthesibChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["00:00"],
                datasets: [{
                        label: "Sistolik",
                        data: [0],
                        borderColor: "#ef4444",
                        backgroundColor: "#ef4444",
                        pointBackgroundColor: "#ef4444",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointStyle: 'circle',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "Diastolik",
                        data: [0],
                        borderColor: "#3b82f6",
                        backgroundColor: "#3b82f6",
                        pointBackgroundColor: "#3b82f6",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 7,
                        pointStyle: 'rectRot',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "RR",
                        data: [0],
                        borderColor: "#10b981",
                        backgroundColor: "#10b981",
                        pointBackgroundColor: "#10b981",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointStyle: 'rect',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "Temp",
                        data: [0],
                        borderColor: "#f59e0b",
                        backgroundColor: "#f59e0b",
                        pointBackgroundColor: "#f59e0b",
                        pointBorderColor: "#ffffff",
                        pointBorderWidth: 2,
                        pointRadius: 7,
                        pointStyle: 'triangle',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    },
                    {
                        label: "SpO2",
                        data: [0],
                        borderColor: "#8b5cf6",
                        backgroundColor: "#8b5cf6",
                        pointBackgroundColor: "#8b5cf6",
                        pointBorderColor: "#8b5cf6",
                        pointBorderWidth: 2.5,
                        pointRadius: 6,
                        pointStyle: 'crossRot',
                        borderWidth: 1.5,
                        tension: 0.1,
                        fill: false
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#4a5568',
                            font: {
                                weight: 'normal',
                                size: 11
                            }
                        }
                    },
                    y: {
                        ticks: {
                            stepSize: 20,
                            color: '#4a5568',
                            font: {
                                size: 11
                            }
                        },
                        grid: {
                            color: "rgba(226, 232, 240, 0.8)",
                            borderDash: [2, 2]
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 14,
                            boxHeight: 14,
                            padding: 15,
                            color: '#2d3748',
                            font: {
                                size: 12,
                                weight: 'normal'
                            },
                            generateLabels: function(chart) {
                                const originalLabels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                                originalLabels.forEach((label, index) => {
                                    const dataset = chart.data.datasets[index];
                                    label.pointStyle = dataset.pointStyle;
                                    label.pointStyleWidth = 12;
                                });
                                return originalLabels;
                            }
                        }
                    }
                }
            },
            // PERBAIKAN: Posisikan array plugins di luar objek 'options' (sejajar dengan 'type', 'data', 'options')
            plugins: [{
                id: 'customCanvasValLabels',
                afterDatasetsDraw(chart) {
                    const {
                        ctx
                    } = chart;
                    ctx.save();

                    chart.data.datasets.forEach((dataset, datasetIndex) => {
                        const meta = chart.getDatasetMeta(datasetIndex);
                        if (!meta.hidden) {
                            meta.data.forEach((element, index) => {
                                const dataVal = dataset.data[index];

                                // Sembunyikan jika nilai 0 atau kosong (ubah sesuai kebutuhan)
                                if (dataVal !== undefined && dataVal !== null && dataVal !== 0) {
                                    ctx.font = 'bold 11px sans-serif';
                                    ctx.fillStyle = dataset.borderColor;
                                    ctx.textAlign = 'center';
                                    ctx.textBaseline = 'bottom';

                                    const position = element.tooltipPosition();
                                    ctx.fillText(dataVal, position.x, position.y - 10);
                                }
                            });
                        }
                    });
                    ctx.restore();
                }
            }]
        });
    }

    function getDataMonitoringPasca() {
        var data = {
            // ID / Informasi Tambahan (Opsional/Disesuaikan)
            idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",
            jenis: 'pasca'
        };

        $.ajax({
            url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoring") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Ambil data yang sudah dikelompokkan dari server untuk grafik
                    const cd = response.chart_data;
                    // Ambil data mentah dari database untuk tabel
                    const dbData = response.data_db;

                    // 1. Cek apakah grafik sudah diinisialisasi
                    if (window.myAnesthesiaChart instanceof Chart) {

                        // --- PERBARUI LABEL (SUMBU X / WAKTU) ---
                        window.myAnesthesibChart.data.labels = cd.jam;

                        // --- PERBARUI DATA MASING-MASING DATASET ---
                        window.myAnesthesibChart.data.datasets[0].data = cd.sistolik;
                        window.myAnesthesibChart.data.datasets[1].data = cd.diastolik;
                        window.myAnesthesibChart.data.datasets[2].data = cd.rr;
                        window.myAnesthesibChart.data.datasets[3].data = cd.temp;
                        window.myAnesthesibChart.data.datasets[4].data = cd.spo2;

                        // 2. Render ulang grafik agar perubahan langsung tampil
                        window.myAnesthesibChart.update();

                        console.log("Grafik berhasil diperbarui dengan data terbaru!");

                        // --- 3. MUAT DATA KE DALAM TABEL ---
                        let rowsHtml = '';
                        if (dbData && dbData.length > 0) {
                            dbData.forEach(function(item) {
                                rowsHtml += `<tr>
                                <td>${item.waktu}</td>
                                <td>${item.sistolik}</td>
                                <td>${item.diastolik}</td>
                                <td>${item.rr}</td>
                                <td>${item.spo2}</td>
                                <td>${item.temp}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-danger btn-sm py-0 px-1" onclick="hapusMonitoring(${item.id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                            });
                        } else {
                            rowsHtml = `<tr><td colspan="7" class="text-center text-muted">Belum ada data monitoring.</td></tr>`;
                        }

                        // Masukkan baris ke dalam tbody tabel
                        $('#tabelPascaAnestesi').html(rowsHtml);

                    } else {
                        // Jika grafik belum ada/belum dirender, panggil fungsi pembuat chart utamanya
                        chartMonitoringAnestesi();
                    }
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });
    }

    $(document).ready(function() {
        chartMonitoringIntraAnestesi();
        chartMonitoringPascaAnestesi();

        // 2. Tarik data dari database dan perbarui isinya
        getDataMonitoringIntra();
        getDataMonitoringPasca();
    });

    function kunciTtd() {
        $("#pesanError").html("").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // Daftar 7 TTD yang ada di RM11B1 Checklist
        var listTtd = [{
                id: '#ttdDokter',
                key: 'ttdDokter'
            },
            {
                id: '#ttdPerawat',
                key: 'ttdPerawat'
            },
            {
                id: '#ttdPerawatRr',
                key: 'ttdPerawatRr'
            },
            {
                id: '#ttdAnestesi',
                key: 'ttdAnestesi'
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
            url: '<?= base_url() ?>rm/rm11b2MonitoringAnestesi/simpanTtd',
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
                canvasId: 'tempatTtdDokter',
                btnHapusId: 'hapusTtdDokter',
                btnSimpanId: 'simpanTtdDokter',
                hasilId: 'ttdDokter',
                modalId: 'modalTtdDokter',
                altText: 'Tanda tangan Dokter'
            },
            {
                canvasId: 'tempatTtdPerawat',
                btnHapusId: 'hapusTtdPerawat',
                btnSimpanId: 'simpanTtdPerawat',
                hasilId: 'ttdPerawat',
                modalId: 'modalTtdPerawat',
                altText: 'Tanda tangan Perawat'
            }, {
                canvasId: 'tempatTtdPerawatRr',
                btnHapusId: 'hapusTtdPerawatRr',
                btnSimpanId: 'simpanTtdPerawatRr',
                hasilId: 'ttdPerawatRr',
                modalId: 'modalTtdPerawatRr',
                altText: 'Tanda tangan Perawat RR'
            }, {
                canvasId: 'tempatTtdAnestesi',
                btnHapusId: 'hapusTtdAnestesi',
                btnSimpanId: 'simpanTtdAnestesi',
                hasilId: 'ttdAnestesi',
                modalId: 'modalTtdAnestesi',
                altText: 'Tanda tangan Anestesi'
            }
        ];

        // ===================================================
        // EXECUTE INITIALIZATION (LOOPING)
        // ===================================================
        signatureConfigs.forEach(config => setupSignaturePad(config));

    });
</script>

</html>