<?php

/** @var object $data */


$tb = $data->rm11b2StatusAnestesi;

function formatTgl($datetime)
{
    if (empty($datetime) || $datetime === '0000-00-00 00:00:00') {
        return '..........';
    }

    $time = strtotime($datetime);
    return $time ? date('d-m-Y H:i', $time) . ' WIB' : htmlspecialchars($datetime);
}

// Helper function untuk decoding JSON / Array secara aman
$parseArray = function ($data) {
    if (is_array($data)) return $data;
    if (is_string($data) && !empty($data)) {
        $decoded = json_decode($data, true);
        return is_array($decoded) ? $decoded : [];
    }
    return [];
};
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
    <title>Rm 11b2 Status Anestesi</title>

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
                        <p style="font-size: 14pt; margin:10px; margin-bottom:5;" class="text-uppercase fw-bold"> STATUS ANESTESI
                        </p>
                    </div>
                </div>

                <table class="table tabelSempit table-sm table-bordered">
                    <tr>
                        <td colspan="2">Diisi oleh dokter/perawat : <?= $data->rm11b2StatusAnestesi["petugas"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Ruangan/poli : <?= $data->rm11b2StatusAnestesi["ruang"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table tabelSempit table-sm table-borderless mb-0">
                                <tr>
                                    <td>Diagnosis Pra-anestesi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["diagnosisPraAnestesi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Rencana Tindakan</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["rencanaTindakan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: <?= !empty($data->rm11b2StatusAnestesi["tgl"]) ? date('d-m-Y', strtotime($data->rm11b2StatusAnestesi["tgl"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["tempat"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <table class="table tabelSempit table-sm table-borderless mb-0">
                                <tr>
                                    <td>Spesialis Bedah</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["spesialisBedah"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Asisten Bedah</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["asistenBedah"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Spesialis Anestesiologi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["spesialisAnestesiologi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Asisten/ Perawat Anestesi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["asistenAnestesi"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="fw-bold text-center">I. ASESMEN PRA-ANESTESI</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table tabelSempit table-sm table-borderless mb-0">
                                <tr>
                                    <td>Anamnesa dari</td>
                                    <td>
                                        : <?= implode(', ', array_map(function ($item) use ($data) {
                                                return $item === 'Lainnya' ? ($data->rm11b2StatusAnestesi["anamnesaLainnya"] ?? $item) : $item;
                                            }, json_decode($data->rm11b2StatusAnestesi["anamnesaDari"] ?? '[]', true) ?? [])) ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Riwayat Anestesi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["riwayatAnestesi"] === 'Ada' ? 'Ada : ' . ($data->rm11b2StatusAnestesi["keteranganAnestesi"] ?? '-') : ($data->rm11b2StatusAnestesi["riwayatAnestesi"] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td>Komplikasi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["riwayatKomplikasi"] === 'Ada' ? 'Ada : ' . ($data->rm11b2StatusAnestesi["keteranganKomplikasi"] ?? '-') : ($data->rm11b2StatusAnestesi["riwayatKomplikasi"] ?? '-') ?></td>
                                </tr>
                                <tr>
                                    <td>Obat sedang dikonsumsi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["obatDikonsumsi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat Alergi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["riwayatAlergi"] === 'Ada' ? 'Ada : ' . ($data->rm11b2StatusAnestesi["keteranganAlergi"] ?? '-') : ($data->rm11b2StatusAnestesi["riwayatAlergi"] ?? '-') ?></td>
                                </tr>
                            </table>
                        </td>
                        <td rowspan="2">
                            <b><u>Evaluasi jalan nafas</u></b> <br>
                            <table class="table tabelSempit table-sm table-borderless">
                                <tr>
                                    <td>Bebas</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["bebas"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Alat bantu nafas</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["alatBantuNafas"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Buka mulut</td>
                                    <td>: <?= !empty($data->rm11b2StatusAnestesi['bukaMulut']) ? $data->rm11b2StatusAnestesi['bukaMulut'] : '...' ?> cm</td>
                                </tr>
                                <tr>
                                    <td>Leher</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["leher"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Gerak leher</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["gerakLeher"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Mallampathy (k/p)</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["mallampathy"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Obesitas</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["obesitas"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Massa</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["massa"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            BB : <?= !empty($data->rm11b2StatusAnestesi['beratBadan']) ? $data->rm11b2StatusAnestesi['beratBadan'] : '...' ?>.
                            TB : <?= !empty($data->rm11b2StatusAnestesi['tinggiBadan']) ? $data->rm11b2StatusAnestesi['tinggiBadan'] : '...' ?>.
                            BMI : <?= !empty($data->rm11b2StatusAnestesi['bmi']) ? $data->rm11b2StatusAnestesi['bmi'] : '...' ?> (k/p). <br>

                            Tanda Vital :<br>
                            TD : <?= !empty($data->rm11b2StatusAnestesi['tensiDarah']) ? $data->rm11b2StatusAnestesi['tensiDarah'] : '...' ?> mmHg. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Nadi : <?= !empty($data->rm11b2StatusAnestesi['nadi']) ? $data->rm11b2StatusAnestesi['nadi'] : '...' ?> x/mnt. <br>

                            RR : <?= !empty($data->rm11b2StatusAnestesi['rr']) ? $data->rm11b2StatusAnestesi['rr'] : '...' ?> x/mnt. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Suhu : <?= !empty($data->rm11b2StatusAnestesi['suhu']) ? $data->rm11b2StatusAnestesi['suhu'] : '...' ?> &deg;c. <br>

                            Skor Nyeri : <?= !empty($data->rm11b2StatusAnestesi['skorNyeri']) ? $data->rm11b2StatusAnestesi['skorNyeri'] : '...' ?> (k/p)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table tabelSempit table-sm table-bordered mb-0">
                                <tr>
                                    <th>Fungsi sistem organ</th>
                                    <th>DBN</th>
                                    <th>Catatan</th>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Pernafasan</b><br>
                                        <?php
                                        $pernafasanRaw = $data->rm11b2StatusAnestesi['pernafasan'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($pernafasanRaw)) {
                                            $pernafasan = json_decode($pernafasanRaw, true) ?? [];
                                        } else {
                                            $pernafasan = (array)$pernafasanRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['pernafasanLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['pernafasanLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('Asthma', $pernafasan) ? '✓' : '' ?></td>
                                                <td>Asthma</td>
                                                <td width="20"><?= in_array('Tuberkulosis', $pernafasan) ? '✓' : '' ?></td>
                                                <td>Tuberkulosis</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('PPOK', $pernafasan) ? '✓' : '' ?></td>
                                                <td>PPOK</td>
                                                <td><?= in_array('Dyspnea', $pernafasan) ? '✓' : '' ?></td>
                                                <td>Dyspnea</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Pneumonia', $pernafasan) ? '✓' : '' ?></td>
                                                <td>Pneumonia</td>
                                                <td><?= in_array('Efusi Pleura', $pernafasan) ? '✓' : '' ?></td>
                                                <td>Efusi Pleura</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ?  'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= $data->rm11b2StatusAnestesi['pernafasanDbn'] == 1 ? '✓' : '' ?></td>
                                    <td>Merokok : <?= $data->rm11b2StatusAnestesi['merokok'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Kardiovaskuler</b><br>
                                        <?php
                                        $kardiovaskulerRaw = $data->rm11b2StatusAnestesi['kardiovaskuler'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($kardiovaskulerRaw)) {
                                            $kardiovaskuler = json_decode($kardiovaskulerRaw, true) ?? [];
                                        } else {
                                            $kardiovaskuler = (array)$kardiovaskulerRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['kardiovaskulerLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['kardiovaskulerLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('EKG Abnormal', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>EKG Abnormal</td>
                                                <td width="20"><?= in_array('Hipertensi', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Hipertensi</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Infark myokard', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Infark myokard</td>
                                                <td><?= in_array('Angina', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Angina</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Gagal jantung kongestif', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Gagal jantung kongestif</td>
                                                <td><?= in_array('Murmur', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Murmur</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Limitasi aktifitas', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Limitasi aktifitas</td>
                                                <td><?= in_array('Pacemaker', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td>Pacemaker</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Penyakit katup', $kardiovaskuler) ? '✓' : '' ?></td>
                                                <td colspan="3">Penyakit katup</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ?  'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= $data->rm11b2StatusAnestesi['kardiovaskulerDbn'] == 1 ? '✓' : '' ?></td>
                                    <td>Alkohol : <?= $data->rm11b2StatusAnestesi['alkohol'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Neuro/Muskuloskeletal</b><br>
                                        <?php
                                        $neuroRaw = $data->rm11b2StatusAnestesi['neuroMuskuloskeletal'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($neuroRaw)) {
                                            $neuro = json_decode($neuroRaw, true) ?? [];
                                        } else {
                                            $neuro = (array)$neuroRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['neuroLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['neuroLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('Arthritis', $neuro) ? '✓' : '' ?></td>
                                                <td>Arthritis</td>
                                                <td width="20"><?= in_array('Kelemahan otot', $neuro) ? '✓' : '' ?></td>
                                                <td>Kelemahan otot</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Parestesis', $neuro) ? '✓' : '' ?></td>
                                                <td>Parestesis</td>
                                                <td><?= in_array('Neuromuscular Dis', $neuro) ? '✓' : '' ?></td>
                                                <td>Neuromuscular Dis</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Paralisis', $neuro) ? '✓' : '' ?></td>
                                                <td>Paralisis</td>
                                                <td><?= in_array('CVA/stroke/TIA', $neuro) ? '✓' : '' ?></td>
                                                <td>CVA/stroke/TIA</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Nyeri kepala', $neuro) ? '✓' : '' ?></td>
                                                <td>Nyeri kepala</td>
                                                <td><?= in_array('Penurunan kesadaran', $neuro) ? '✓' : '' ?></td>
                                                <td>Penurunan kesadaran</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Kejang', $neuro) ? '✓' : '' ?></td>
                                                <td>Kejang</td>
                                                <td><?= in_array('Back problema', $neuro) ? '✓' : '' ?></td>
                                                <td>Back problema</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ? 'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= $data->rm11b2StatusAnestesi['neuroMuskuloskeletalDbn'] == 1 ? '✓' : '' ?></td>
                                    <td><?= $data->rm11b2StatusAnestesi['catatanNeuro'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Renal/Endokrin</b><br>
                                        <?php
                                        $renalRaw = $data->rm11b2StatusAnestesi['renalEndokrin'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($renalRaw)) {
                                            $renal = json_decode($renalRaw, true) ?? [];
                                        } else {
                                            $renal = (array)$renalRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['renalLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['renalLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('Diabetes melitus', $renal) ? '✓' : '' ?></td>
                                                <td>Diabetes melitus</td>
                                                <td width="20"><?= in_array('Penyakit thyroid', $renal) ? '✓' : '' ?></td>
                                                <td>Penyakit thyroid</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Gagal ginjal/Dialisis', $renal) ? '✓' : '' ?></td>
                                                <td>Gagal ginjal/Dialisis</td>
                                                <td><?= in_array('Retensi urine', $renal) ? '✓' : '' ?></td>
                                                <td>Retensi urine</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Berat badan turun', $renal) ? '✓' : '' ?></td>
                                                <td>Berat badan turun</td>
                                                <td><?= in_array('ISK', $renal) ? '✓' : '' ?></td>
                                                <td>ISK</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ? 'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= ($data->rm11b2StatusAnestesi['renalEndokrinDbn'] ?? 0) == 1 ? '✓' : '' ?></td>
                                    <td><?= $data->rm11b2StatusAnestesi['catatanRenal'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Hepato/Gastrointestinal</b><br>
                                        <?php
                                        $hepatoRaw = $data->rm11b2StatusAnestesi['hepatoGastro'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($hepatoRaw)) {
                                            $hepato = json_decode($hepatoRaw, true) ?? [];
                                        } else {
                                            $hepato = (array)$hepatoRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['hepatoLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['hepatoLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('Obstruksi Usus', $hepato) ? '✓' : '' ?></td>
                                                <td>Obstruksi Usus</td>
                                                <td width="20"><?= in_array('Tukak peptik/ulkus', $hepato) ? '✓' : '' ?></td>
                                                <td>Tukak peptik/ulkus</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Mual & muntah', $hepato) ? '✓' : '' ?></td>
                                                <td>Mual & muntah</td>
                                                <td><?= in_array('Hepatitis/Ikhterus', $hepato) ? '✓' : '' ?></td>
                                                <td>Hepatitis/Ikhterus</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Sirosis', $hepato) ? '✓' : '' ?></td>
                                                <td colspan="3">Sirosis</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ?  'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= ($data->rm11b2StatusAnestesi['hepatoGastroDbn'] ?? 0) == 1 ? '✓' : '' ?></td>
                                    <td><?= $data->rm11b2StatusAnestesi['catatanHepato'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>Lain-lain</b><br>
                                        <?php
                                        $organLainRaw = $data->rm11b2StatusAnestesi['organLainLain'] ?? '[]';

                                        // Jika data berupa JSON string, decode ke array PHP
                                        if (is_string($organLainRaw)) {
                                            $organLain = json_decode($organLainRaw, true) ?? [];
                                        } else {
                                            $organLain = (array)$organLainRaw;
                                        }

                                        // Ambil data Lainnya
                                        $lainnyaCheck = $data->rm11b2StatusAnestesi['organLainnyaCheck'] ?? 0;
                                        $lainnyaText  = $data->rm11b2StatusAnestesi['organLainnyaText'] ?? '';
                                        ?>

                                        <table border="0" cellpadding="0">
                                            <tr>
                                                <td width="20"><?= in_array('Anemia', $organLain) ? '✓' : '' ?></td>
                                                <td>Anemia</td>
                                                <td width="20"><?= in_array('Immunosupresan', $organLain) ? '✓' : '' ?></td>
                                                <td>Immunosupresan</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Kanker', $organLain) ? '✓' : '' ?></td>
                                                <td>Kanker</td>
                                                <td><?= in_array('Kehamilan', $organLain) ? '✓' : '' ?></td>
                                                <td>Kehamilan</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Dehidrasi', $organLain) ? '✓' : '' ?></td>
                                                <td>Dehidrasi</td>
                                                <td><?= in_array('Riwayat tranfusi', $organLain) ? '✓' : '' ?></td>
                                                <td>Riwayat tranfusi</td>
                                            </tr>
                                            <tr>
                                                <td><?= in_array('Hemofilia', $organLain) ? '✓' : '' ?></td>
                                                <td>Hemofilia</td>
                                                <td><?= in_array('Antikoagulan', $organLain) ? '✓' : '' ?></td>
                                                <td>Antikoagulan</td>
                                            </tr>
                                            <tr>
                                                <td><?= $lainnyaCheck == 1 ? '✓' : '' ?></td>
                                                <td colspan="3"><?= $lainnyaCheck == 1 ?  'Lainnya : ' . $lainnyaText : '' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td><?= ($data->rm11b2StatusAnestesi['organLainLainDbn'] ?? 0) == 1 ? '✓' : '' ?></td>
                                    <td><?= $data->rm11b2StatusAnestesi['catatanOrganLain'] ?? '-' ?></td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <b>Pemeriksaan Laboratorium</b>
                            <table>
                                <tr>
                                    <td>Hb/Het</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['hbHet'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Fungsi ginjal</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['fungsiGinjal'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Fungsi Hati</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['fungsiHati'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Serum Elektrolit</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['serumElektrolit'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Faal Hematosis</td>
                                    <td>BT : <?= $data->rm11b2StatusAnestesi['faalBt'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>CT : <?= $data->rm11b2StatusAnestesi['faalCt'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['lainLainLab'] ?? '-' ?></td>
                                </tr>
                            </table>

                            <b>Pemeriksaan Penunjang</b>
                            <table>
                                <tr>
                                    <td>Echocardiografi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['echocardiografi'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>EKG</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['ekg'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Foto Radiologi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['fotoRadiologi'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Evaluasi Faal Paru</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['evaluasiFaal'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Lain-lain</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi['lainLainPenunjang'] ?? '-' ?></td>
                                </tr>
                            </table>

                            <table class="mb-0">
                                <tr>
                                    <td>
                                        <b>Simpulan Asesmen Pra-Anestesi</b> <br>
                                        PSA ASA : <br>
                                        <?= $data->rm11b2StatusAnestesi['psaAsa'] ?? '-' ?><br>
                                        Penyulit : <br>
                                        <?= $data->rm11b2StatusAnestesi['penyulit'] ?? '-' ?><br>
                                        Komplikasi : <br>
                                        <?= $data->rm11b2StatusAnestesi['komplikasi'] ?? '-' ?><br>
                                        Rencana Tindakan Anestesi : <br>
                                        <?= $data->rm11b2StatusAnestesi['rencanaTindakanAnestesi'] ?? '-' ?>
                                    </td>
                                </tr>
                            </table>
                            <br>

                            <table class="table table-sm tabelSempit table-borderless">
                                <tr>
                                    <td>
                                        Diperiksa Oleh : <br>
                                        <?= $data->rm11b2StatusAnestesi['dokterI'] ?? '-' ?><br>
                                        Tanggal dan Jam : <br>
                                        <?= $data->rm11b2StatusAnestesi['tanggalJamI'] ?? '-' ?>
                                        <br><br>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">
                                        Dokter
                                        <br><br>

                                        <div id="ttdDokter1">
                                            <?php if ($data->rm11b2StatusAnestesi["ttdDokter1"]) {
                                                //Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b2StatusAnestesi/' . $data->rm11b2StatusAnestesi["ttdDokter1"]) . '" alt="tanda tangan Dokter" style="max-width: 100px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b2StatusAnestesi["dokterI"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b2StatusAnestesi["ttdDokter1"]) {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter1">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>



            </div>
        </div>

        <div class="page">
            <div class="subpage">

                <table class="table tabelSempit table-sm table-bordered mb-0" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="fw-bold text-center">
                            II. RENCANA ANESTESI (PRA-ANESTESI)
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-5">
                                    <?php
                                    // Decode JSON untuk obatAwal & permedikasiDetail (penanganan string JSON/Array)
                                    $obatAwalRaw = $data->rm11b2StatusAnestesi["obatAwal"] ?? '[]';
                                    $obatAwal = is_string($obatAwalRaw) ? (json_decode($obatAwalRaw, true) ?? []) : (array)$obatAwalRaw;

                                    $permedikasiDetailRaw = $data->rm11b2StatusAnestesi["permedikasiDetail"] ?? '[]';
                                    $permedikasiDetail = is_string($permedikasiDetailRaw) ? (json_decode($permedikasiDetailRaw, true) ?? []) : (array)$permedikasiDetailRaw;

                                    // Helper function untuk pengecekan aman (toleran terhadap perbedaan spasi/karakter)
                                    $hasDetail = function ($keyword) use ($permedikasiDetail) {
                                        foreach ($permedikasiDetail as $item) {
                                            if (is_string($item) && stripos($item, $keyword) !== false) {
                                                return true;
                                            }
                                        }
                                        return false;
                                    };
                                    ?>

                                    <table class="table table-sm tabelSempit table-striped mb-0">
                                        <!-- Checkbox Utama: Permedikasi -->
                                        <tr>
                                            <td class="text-center">
                                                <?= in_array("Permedikasi", $obatAwal) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3"><b>Permedikasi</b></td>
                                        </tr>

                                        <!-- Item 1: Midazolam -->
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <?= $hasDetail("Midazolam") ? '✓' : '' ?>
                                            </td>
                                            <td style="width: 8px;">Midazolam,</td>
                                            <td>Dosis 0,07-0,15 mg/KgBB, IM</td>
                                        </tr>

                                        <!-- Item 2: Morphine -->
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <?= $hasDetail("Morphine") ? '✓' : '' ?>
                                            </td>
                                            <td>Morphine,</td>
                                            <td>Dosis 0,05-0,2 mg/KgBB, IM</td>
                                        </tr>

                                        <!-- Item 3: Pethidine -->
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <?= $hasDetail("Pethidine") ? '✓' : '' ?>
                                            </td>
                                            <td>Pethidine,</td>
                                            <td>Dosis 0,5-1 mg/KgBB, IM</td>
                                        </tr>

                                        <!-- Item 4: Sulfas Atropin -->
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <?= $hasDetail("Sulfas Atropin") ? '✓' : '' ?>
                                            </td>
                                            <td>Sulfas Atropin,</td>
                                            <td>Dosis 0,01-0,02 mg/KgBB, IM</td>
                                        </tr>

                                        <!-- Item 5: Lainnya -->
                                        <tr>
                                            <td></td>
                                            <td class="text-center">
                                                <?= (!empty($data->rm11b2StatusAnestesi['permedikasiLainnyaCheck']) && $data->rm11b2StatusAnestesi['permedikasiLainnyaCheck'] == 1) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="2">
                                                <?= !empty($data->rm11b2StatusAnestesi['permedikasiLainnya']) ? $data->rm11b2StatusAnestesi['permedikasiLainnya'] : '' ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">
                                                <?= in_array("General Anestesi", is_string($data->rm11b2StatusAnestesi["obatAwal"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatAwal"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatAwal"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3"><b>General Anestesi</b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <?= in_array("Masker", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? '✓ ' : '' ?>Masker
                                            </td>
                                            <td>
                                                <?= in_array("Intubasi", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? '✓ ' : '' ?>Intubasi
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <?= in_array("TIV", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? '✓ ' : '' ?>TIV
                                            </td>
                                            <td>
                                                <?= in_array("LMA", is_string($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["generalAnestesiTipe"] ?? [])) ? '✓ ' : '' ?>LMA
                                            </td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td colspan="2">
                                                <?= (!empty($data->rm11b2StatusAnestesi['gaLainnyaCheck']) && $data->rm11b2StatusAnestesi['gaLainnyaCheck'] == 1) ? '✓ ' : '' ?>Lainnya :
                                                <?= !empty($data->rm11b2StatusAnestesi['gaLainnyaText']) ? $data->rm11b2StatusAnestesi['gaLainnyaText'] : '' ?>
                                            </td>
                                        </tr>
                                    </table>

                                    <b>Induksi</b>
                                    <table class="table table-sm tabelSempit table-striped mb-0" cellpadding="0" cellspacing="0">
                                        <!-- Insufilasi -->
                                        <tr>
                                            <td width="20" class="text-center" valign="top">
                                                <?= in_array("Insufilasi", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3">
                                                Insufilasi dengan : <?= !empty($data->rm11b2StatusAnestesi['insufilasiText']) ? $data->rm11b2StatusAnestesi['insufilasiText'] : '................................' ?>
                                            </td>
                                        </tr>

                                        <!-- Sedatif -->
                                        <tr>
                                            <td width="20" class="text-center" valign="top">
                                                <?= in_array("Sedatif", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3"><b>Sedatif</b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td width="20" class="text-center" valign="top">
                                                <?= in_array("Midazolam, Dosis 0,1-0,4 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Midazolam,</td>
                                            <td>Dosis 0,1-0,4 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Propofol, Dosis 1-2,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Propofol,</td>
                                            <td>Dosis 1-2,5 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Ketamine, Dosis 1-2 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["sedatifDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["sedatifDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Ketamine,</td>
                                            <td>Dosis 1-2 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= (!empty($data->rm11b2StatusAnestesi['sedatifLainnyaCheck']) && $data->rm11b2StatusAnestesi['sedatifLainnyaCheck'] == 1) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="2">
                                                Lainnya : <?= !empty($data->rm11b2StatusAnestesi['sedatifLainnya']) ? $data->rm11b2StatusAnestesi['sedatifLainnya'] : '................................' ?>
                                            </td>
                                        </tr>

                                        <!-- Analgetik -->
                                        <tr>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Analgetik", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3"><b>Analgetik</b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Morphine, Dosis 0,1-1 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Morphine,</td>
                                            <td>Dosis 0,1-1 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Pethidine, Dosis 2,5-5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Pethidine,</td>
                                            <td>Dosis 2,5-5 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Fentanyl, Dosis 2-150 mcg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Fentanyl,</td>
                                            <td>Dosis 2-150 mcg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Ketamine, Dosis 0,25-0,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["analgetikDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["analgetikDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Ketamine,</td>
                                            <td>Dosis 0,25-0,5 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= (!empty($data->rm11b2StatusAnestesi['analgetikLainnyaCheck']) && $data->rm11b2StatusAnestesi['analgetikLainnyaCheck'] == 1) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="2">
                                                Lainnya : <?= !empty($data->rm11b2StatusAnestesi['analgetikLainnya']) ? $data->rm11b2StatusAnestesi['analgetikLainnya'] : '................................' ?>
                                            </td>
                                        </tr>

                                        <!-- Pelumpuh otot -->
                                        <tr>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Pelumpuh otot", is_string($data->rm11b2StatusAnestesi["obatInduksi"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["obatInduksi"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["obatInduksi"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="3"><b>Pelumpuh otot</b></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Atracurium, Dosis 0,5 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Atracurium,</td>
                                            <td>Dosis 0,5 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Vericuronium, Dosis 0,12 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Vericuronium,</td>
                                            <td>Dosis 0,12 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= in_array("Rocuronium, Dosis 0,6-1,2 mg/KgBB, IV", is_string($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '') ? (json_decode($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? '[]', true) ?? []) : (array)($data->rm11b2StatusAnestesi["pelumpuhDetail"] ?? [])) ? '✓' : '' ?>
                                            </td>
                                            <td>Rocuronium,</td>
                                            <td>Dosis 0,6-1,2 mg/KgBB, IV</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td class="text-center" valign="top">
                                                <?= (!empty($data->rm11b2StatusAnestesi['pelumpuhLainnyaCheck']) && $data->rm11b2StatusAnestesi['pelumpuhLainnyaCheck'] == 1) ? '✓' : '' ?>
                                            </td>
                                            <td colspan="2">
                                                Lainnya : <?= !empty($data->rm11b2StatusAnestesi['pelumpuhLainnya']) ? $data->rm11b2StatusAnestesi['pelumpuhLainnya'] : '................................' ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-5">
                                    <?php


                                    $obatMaintenanceData     = $parseArray($data->rm11b2StatusAnestesi["obatMaintenance"] ?? []);
                                    $inhalasiDetailData      = $parseArray($data->rm11b2StatusAnestesi["inhalasiDetail"] ?? []);
                                    $intravenaDetailData     = $parseArray($data->rm11b2StatusAnestesi["intravenaDetail"] ?? []);
                                    $regionalAnestesiTipeData = $parseArray($data->rm11b2StatusAnestesi["regionalAnestesiTipe"] ?? []);
                                    $anestesiLokalDetailData = $parseArray($data->rm11b2StatusAnestesi["anestesiLokalDetail"] ?? []);
                                    ?>

                                    <div>
                                        <div><strong>Maintenance</strong></div>

                                        <!-- 1. INHALASI -->
                                        <div style="margin-bottom: 6px;">
                                            <div>
                                                <span style="display: inline-block; width: 15px; text-align: center; font-weight: bold;"><?= in_array("Inhalasi", $obatMaintenanceData) ? '✓' : '' ?></span>
                                                <strong>Inhalasi :</strong>
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <table class="table table-sm tabelSempit table-striped mb-0">
                                                    <tr>
                                                        <td style="width: 20px;"><span><?= in_array("O2", $inhalasiDetailData) ? '✓' : '' ?></span></td>
                                                        <td style="width: 20px;"><?= in_array("O2", $inhalasiDetailData) ? '1.' : '' ?></td>
                                                        <td colspan="2">O<sub>2</sub></td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Isofluran, 1 MAC = 1,2%", $inhalasiDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Isofluran, 1 MAC = 1,2%", $inhalasiDetailData) ? '2.' : '' ?></td>
                                                        <td style="width: 100px;">Isofluran</td>
                                                        <td>1 MAC = 1,2%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Sevofluran, 1 MAC = 2%", $inhalasiDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Sevofluran, 1 MAC = 2%", $inhalasiDetailData) ? '3.' : '' ?></td>
                                                        <td>Sevofluran,</td>
                                                        <td>1 MAC = 2%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Enfluran, 1 MAC = 1,7%", $inhalasiDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Enfluran, 1 MAC = 1,7%", $inhalasiDetailData) ? '4.' : '' ?></td>
                                                        <td>Enfluran,</td>
                                                        <td>1 MAC = 1,7%</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Desflurane, 1 MAC = 6%", $inhalasiDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Desflurane, 1 MAC = 6%", $inhalasiDetailData) ? '5.' : '' ?></td>
                                                        <td>Desflurane,</td>
                                                        <td>1 MAC = 6%</td>
                                                    </tr>
                                                    <?php if (!empty($data->rm11b2StatusAnestesi['inhalasiLainnyaCheck'])): ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><span>✓</span></td>
                                                            <td colspan="2">Lainnya: <?= htmlspecialchars($data->rm11b2StatusAnestesi['inhalasiLainnya'] ?? '') ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- 2. INTRAVENA -->
                                        <div style="margin-bottom: 6px;">
                                            <div>
                                                <span style="display: inline-block; width: 15px; text-align: center; font-weight: bold;"><?= in_array("Intravena", $obatMaintenanceData) ? '✓' : '' ?></span>
                                                <strong>Intravena</strong>
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <table class="table table-sm tabelSempit table-striped mb-0">
                                                    <tr>
                                                        <td><span><?= in_array("Propofol, Dosis 1-2 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Propofol, Dosis 1-2 mg/KgBB", $intravenaDetailData) ? '1.' : '' ?></td>
                                                        <td>Propofol,</td>
                                                        <td>Dosis 1-2 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Morphine, Dosis 0,1-2 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Morphine, Dosis 0,1-2 mg/KgBB", $intravenaDetailData) ? '2.' : '' ?></td>
                                                        <td>Morphine,</td>
                                                        <td>Dosis 0,1-2 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Pethidine, Dosis 2,5-5 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Pethidine, Dosis 2,5-5 mg/KgBB", $intravenaDetailData) ? '3.' : '' ?></td>
                                                        <td>Pethidine,</td>
                                                        <td>Dosis 2,5-5 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Fentanyl, Dosis 2-150 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Fentanyl, Dosis 2-150 mg/KgBB", $intravenaDetailData) ? '4.' : '' ?></td>
                                                        <td>Fentanyl,</td>
                                                        <td>Dosis 2-150 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Atracurium, Dosis 0,1 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Atracurium, Dosis 0,1 mg/KgBB", $intravenaDetailData) ? '5.' : '' ?></td>
                                                        <td>Atracurium,</td>
                                                        <td>Dosis 0,1 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Vericuronium, Dosis 0,01 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Vericuronium, Dosis 0,01 mg/KgBB", $intravenaDetailData) ? '6.' : '' ?></td>
                                                        <td>Vericuronium,</td>
                                                        <td>Dosis 0,01 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Rocuronium, Dosis 0,15 mg/KgBB", $intravenaDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Rocuronium, Dosis 0,15 mg/KgBB", $intravenaDetailData) ? '7.' : '' ?></td>
                                                        <td>Rocuronium,</td>
                                                        <td>Dosis 0,15 mg/KgBB</td>
                                                    </tr>
                                                    <tr>
                                                        <td></td>
                                                        <td><span><?= !empty($data->rm11b2StatusAnestesi['intravenaLainnyaCheck']) ? '✓' : '' ?></span></td>
                                                        <td><?= htmlspecialchars($data->rm11b2StatusAnestesi['intravenaLainnyaNama'] ?? '....................') ?>,</td>
                                                        <td>Dosis <?= htmlspecialchars($data->rm11b2StatusAnestesi['intravenaLainnyaDosis'] ?? '....................') ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- 3. REGIONAL ANESTESI -->
                                        <div style="margin-bottom: 6px;">
                                            <span style="display: inline-block; width: 15px; text-align: center; font-weight: bold;"><?= in_array("Regional Anestesi", $obatMaintenanceData) ? '✓' : '' ?></span>
                                            <strong>Regional Anestesi :</strong>
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span><?= in_array("SAB", $regionalAnestesiTipeData) ? '✓' : '' ?></span> SAB
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span><?= in_array("Epidural", $regionalAnestesiTipeData) ? '✓' : '' ?></span> Epidural
                                            &nbsp;&nbsp;&nbsp;&nbsp;
                                            <span><?= in_array("PNB", $regionalAnestesiTipeData) ? '✓' : '' ?></span> PNB
                                            <?php if (!empty($data->rm11b2StatusAnestesi['raLainnyaCheck'])): ?>
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                Lainnya : <?= htmlspecialchars($data->rm11b2StatusAnestesi['raLainnyaText'] ?? '') ?>
                                            <?php endif; ?>
                                        </div>

                                        <!-- 4. ANESTESI LOKAL -->
                                        <div style="margin-bottom: 6px;">
                                            <div>
                                                <span style="display: inline-block; width: 15px; text-align: center; font-weight: bold;"><?= in_array("Anestesi Lokal", $obatMaintenanceData) ? '✓' : '' ?></span>
                                                <strong>Anestesi Lokal :</strong>
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <table class="table tabelSempit table-sm table-borderless mb-0">
                                                    <tr>
                                                        <td style="width: 20px;"><span><?= in_array("Lidocaine, Dosis maks. 4,5mg/KgBB (7mg/KgBB dgn epinephrine)", $anestesiLokalDetailData) ? '✓' : '' ?></span></td>
                                                        <td style="width: 20px;"><?= in_array("Lidocaine, Dosis maks. 4,5mg/KgBB (7mg/KgBB dgn epinephrine)", $anestesiLokalDetailData) ? '1.' : '' ?></td>
                                                        <td>
                                                            Lidocaine, Dosis maks. 4,5mg/KgBB<br>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(7mg/KgBB dgn epinephrine)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Bupivacaine, Dosis maks. 2,5mg/KgBB (3mg/KgBB dgn epinephrine)", $anestesiLokalDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Bupivacaine, Dosis maks. 2,5mg/KgBB (3mg/KgBB dgn epinephrine)", $anestesiLokalDetailData) ? '2.' : '' ?></td>
                                                        <td>
                                                            Bupivacaine, Dosis maks. 2,5mg/KgBB<br>
                                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(3mg/KgBB dgn epinephrine)
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span><?= in_array("Ropivacaine, Dosis maks. 3mg/KgBB", $anestesiLokalDetailData) ? '✓' : '' ?></span></td>
                                                        <td><?= in_array("Ropivacaine, Dosis maks. 3mg/KgBB", $anestesiLokalDetailData) ? '3.' : '' ?></td>
                                                        <td>Ropivacaine, Dosis maks. 3mg/KgBB</td>
                                                    </tr>
                                                    <?php if (!empty($data->rm11b2StatusAnestesi['anestesiLokalLainnyaCheck'])): ?>
                                                        <tr>
                                                            <td></td>
                                                            <td><span>✓</span></td>
                                                            <td>Lainnya: <?= htmlspecialchars($data->rm11b2StatusAnestesi['anestesiLokalLainnya'] ?? '') ?></td>
                                                        </tr>
                                                    <?php endif; ?>
                                                </table>
                                            </div>
                                        </div>

                                        <!-- 5. ADDITIF -->
                                        <div style="margin-bottom: 6px;">
                                            <div>
                                                <span style="display: inline-block; width: 15px; text-align: center; font-weight: bold;"><?= in_array("Additif", $obatMaintenanceData) ? '✓' : '' ?></span>
                                                <strong>Additif :</strong>
                                            </div>
                                            <div style="margin-left: 20px;">
                                                <table class="table table-sm tabelSempit table-striped mb-0">
                                                    <tr>
                                                        <td style="width: 20px;">
                                                            <span>
                                                                <?= !empty($data->rm11b2StatusAnestesi['additif1Nama']) ? '✓' : '' ?>
                                                            </span>
                                                        </td>
                                                        <td style="width: 20px;">
                                                        </td>
                                                        <td style="width: 140px;">
                                                            <?= !empty($data->rm11b2StatusAnestesi['additif1Nama']) ? htmlspecialchars($data->rm11b2StatusAnestesi['additif1Nama']) : '..........' ?>
                                                        </td>
                                                        <td>
                                                            Dosis <?= !empty($data->rm11b2StatusAnestesi['additif1Dosis']) ? htmlspecialchars($data->rm11b2StatusAnestesi['additif1Dosis']) : '..........' ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span>
                                                                <?= !empty($data->rm11b2StatusAnestesi['additif2Nama']) ? '✓' : '' ?>
                                                            </span>
                                                        </td>
                                                        <td>
                                                        </td>
                                                        <td>
                                                            <?= !empty($data->rm11b2StatusAnestesi['additif2Nama']) ? htmlspecialchars($data->rm11b2StatusAnestesi['additif2Nama']) : '..........' ?>
                                                        </td>
                                                        <td>
                                                            Dosis <?= !empty($data->rm11b2StatusAnestesi['additif2Dosis']) ? htmlspecialchars($data->rm11b2StatusAnestesi['additif2Dosis']) : '..........' ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-2 d-flex flex-column justify-content-end">
                                    Catatan : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['catatanII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['catatanII']) : '..........' ?> <br>
                                    Disusun Oleh : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['dokterII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['dokterII']) : '..........' ?> <br>
                                    Tanggal : <br>
                                    <?= formatTgl($data->rm11b2StatusAnestesi['tanggalJamII']) ?>
                                    <br><br>
                                    Dokter
                                    <br><br>

                                    <div id="ttdDokter2">
                                        <?php if ($data->rm11b2StatusAnestesi["ttdDokter2"]) {
                                            //Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                            echo '<img src="' . base_url('public/ttd/rm11b2StatusAnestesi/' . $data->rm11b2StatusAnestesi["ttdDokter2"]) . '" alt="tanda tangan Dokter" style="max-width: 100px;" data-is-new="false">';
                                        } else {
                                            echo '<br><br><br><br>';
                                        } ?>
                                    </div>
                                    <br>
                                    (<?= $data->rm11b2StatusAnestesi["dokterII"] ?? '-' ?> )
                                    <br><br>
                                    <?php if (!$data->rm11b2StatusAnestesi["ttdDokter2"]) {
                                    ?>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter2">
                                            Tanda tangan
                                        </button>
                                    <?php } ?>

                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-center">III ASESSMENT PRA-INDUKSI</td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-7">
                                    <table class="table table-sm tabelSempit table-striped mb-0">
                                        <tr>
                                            <td>Makan Terakhir : <?= formatTgl($data->rm11b2StatusAnestesi['makanTerakhir'] ?? '') ?></td>
                                            <td>Minum Terakhir : <?= formatTgl($data->rm11b2StatusAnestesi['minumTerakhir'] ?? '') ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Vital Sign : </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <!-- 1. Row Vital Sign -->
                                                <div class="mb-2">
                                                    TD : <?= !empty($data->rm11b2StatusAnestesi['tdIII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['tdIII']) : '............' ?> mmHg &nbsp;&nbsp;&nbsp;&nbsp;
                                                    HR : <?= !empty($data->rm11b2StatusAnestesi['hrIII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['hrIII']) : '.........' ?> x/mnt &nbsp;&nbsp;&nbsp;&nbsp;
                                                    RR : <?= !empty($data->rm11b2StatusAnestesi['rrIII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['rrIII']) : '.........' ?> x/mnt &nbsp;&nbsp;&nbsp;&nbsp;
                                                    T : <?= !empty($data->rm11b2StatusAnestesi['tIII']) ? htmlspecialchars($data->rm11b2StatusAnestesi['tIII']) : '.........' ?> °C &nbsp;&nbsp;&nbsp;&nbsp;
                                                    SPO<sub>2</sub> : <?= !empty($data->rm11b2StatusAnestesi['spo2III']) ? htmlspecialchars($data->rm11b2StatusAnestesi['spo2III']) : '.........' ?> %
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Masalah saat induksi</td>
                                            <td>: <?= $data->rm11b2StatusAnestesi['masalahInduksiStatus'] === 'Ada' ? 'Ada : ' . (empty($data->rm11b2StatusAnestesi['masalahInduksiText']) ? '.......' : $data->rm11b2StatusAnestesi['masalahInduksiText']) : ($data->rm11b2StatusAnestesi['masalahInduksiStatus'] ?? '....') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Perubahan rencana anestesi</td>
                                            <td>: <?= $data->rm11b2StatusAnestesi['perubahanRencanaStatus'] === 'Ada' ? 'Ada : ' . (empty($data->rm11b2StatusAnestesi['perubahanRencanaText']) ? '.......' : $data->rm11b2StatusAnestesi['perubahanRencanaText']) : ($data->rm11b2StatusAnestesi['perubahanRencanaStatus'] ?? '....') ?></td>
                                        </tr>
                                    </table>

                                    <div class="row">
                                        <div class="col-6"></div>
                                        <div class="col-6 text-center">
                                            Dokter
                                            <br><br>

                                            <div id="ttdDokter3">
                                                <?php if ($data->rm11b2StatusAnestesi["ttdDokter3"]) {
                                                    //Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                    echo '<img src="' . base_url('public/ttd/rm11b2StatusAnestesi/' . $data->rm11b2StatusAnestesi["ttdDokter3"]) . '" alt="tanda tangan Dokter" style="max-width: 50px;" data-is-new="false">';
                                                } else {
                                                    echo '<br><br>';
                                                } ?>
                                            </div>
                                            (<?= $data->rm11b2StatusAnestesi["dokterIII"] ?? '-' ?> )

                                            <?php if (!$data->rm11b2StatusAnestesi["ttdDokter3"]) {
                                            ?>
                                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter3">
                                                    Tanda tangan
                                                </button>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-5">
                                    <b>Premedikasi</b><br>
                                    Agen : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['agen']) ? htmlspecialchars($data->rm11b2StatusAnestesi['agen']) : '.........' ?><br>
                                    Diberikan oleh : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['diberikanOleh']) ? htmlspecialchars($data->rm11b2StatusAnestesi['diberikanOleh']) : '.........' ?><br>
                                    Tanggal dan jam : <br>
                                    <?= formatTgl($data->rm11b2StatusAnestesi['tanggalJamIII']) ?><br>
                                    <div class="text-center">
                                        Perawat/Dokter
                                        <br><br>

                                        <div id="ttdDokter4">
                                            <?php if ($data->rm11b2StatusAnestesi["ttdDokter4"]) {
                                                //Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b2StatusAnestesi/' . $data->rm11b2StatusAnestesi["ttdDokter4"]) . '" alt="tanda tangan Dokter" style="max-width: 50px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br>';
                                            } ?>
                                        </div>
                                        (<?= $data->rm11b2StatusAnestesi["diberikanOleh"] ?? '-' ?> )
                                        <?php if (!$data->rm11b2StatusAnestesi["ttdDokter4"]) {
                                        ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter4">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-center">IV. DAFTAR TILIK KESELAMATAN PASIEN</td>
                    </tr>
                    <tr>
                        <?php
                        // Helper function untuk decoding JSON / Array secara aman
                        $parseArray = function ($data) {
                            if (is_array($data)) return $data;
                            if (is_string($data) && !empty($data)) {
                                $decoded = json_decode($data, true);
                                return is_array($decoded) ? $decoded : [];
                            }
                            return [];
                        };

                        $persiapanData   = $parseArray($data->rm11b2StatusAnestesi["persiapan"] ?? []);
                        $pascaInduksiData = $parseArray($data->rm11b2StatusAnestesi["pascaInduksi"] ?? []);
                        ?>

                        <td>
                            <div class="row">
                                <div class="col-8">
                                    <table class="table table-sm tabelSempit mb-0">
                                        <tr>
                                            <!-- KOLOM KIRI: PERSIAPAN -->
                                            <td style="width: 60%; vertical-align: top; padding-right: 10px;">
                                                <table class="table table-sm tabelSempit table-striped mb-0">
                                                    <tr>
                                                        <td style="width: 15px;"><?= in_array("Identifikasi pasien", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Identifikasi pasien</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Ijin Operasi", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Ijin Operasi</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Puasa dijalankan dengan baik", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Puasa dijalankan dengan baik</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Mesin Anestesi", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Mesin Anestesi</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Suction", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Suction</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Obat-obatan", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Obat-obatan</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Antibiotik profilaksis", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Antibiotik profilaksis</td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td style="width: 60%; vertical-align: top; padding-right: 10px;">
                                                <table class="table table-sm tabelSempit table-striped mb-0">
                                                    <tr>
                                                        <td><?= in_array("Pulse Oxymeter", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Pulse Oxymeter</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("EKG", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>EKG</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Sabuk Pengaman", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Sabuk Pengaman</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("NIBP", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>NIBP</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Urine Kateter", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>Urine Kateter</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("End Tydal CO2", $persiapanData) || in_array("End Tydal CO₂", $persiapanData) ? '✓' : '' ?></td>
                                                        <td>End Tydal CO<sub>2</sub></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-4">
                                    <table class="table table-sm tabelSempit mb-0">
                                        <tr>

                                            <!-- KOLOM KANAN: PASCA INDUKSI -->
                                            <td style="width: 40%; vertical-align: top;">
                                                <div style="font-weight: bold; margin-bottom: 4px;">Pasca Induksi</div>
                                                <table style="width: 100%; border-collapse: collapse;">
                                                    <tr>
                                                        <td style="width: 15px; text-align: center; font-weight: bold; vertical-align: top;"><?= in_array("Titik-titik tekanan diperiksa", $pascaInduksiData) ? '✓' : '' ?></td>
                                                        <td>Titik-titik tekanan diperiksa</td>
                                                    </tr>
                                                    <tr>
                                                        <td><?= in_array("Mata terlindungi", $pascaInduksiData) ? '✓' : '' ?></td>
                                                        <td>Mata terlindungi</td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold text-center">V. TATA LAKSANA</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-bordered mb-0">
                                <tr>
                                    <td>
                                        Teknik Intubasi :<br>
                                        <?= !empty($data->rm11b2StatusAnestesi['teknikIntubasi']) ? htmlspecialchars($data->rm11b2StatusAnestesi['teknikIntubasi']) : '.........' ?><br>
                                    </td>
                                    <td>
                                        Teknik Induksi :<br>
                                        <?= !empty($data->rm11b2StatusAnestesi['teknikInduksi']) ? htmlspecialchars($data->rm11b2StatusAnestesi['teknikInduksi']) : '.........' ?><br>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-3">
                                    Posisi : <br>
                                    <?php

                                    $posisiData = $parseArray($data->rm11b2StatusAnestesi["posisi"] ?? []);
                                    ?>
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td><?= in_array("Supine", $posisiData) ? '✓' : '' ?></td>
                                            <td>Supine</td>
                                        </tr>
                                        <tr>
                                            <td><?= in_array("Prone", $posisiData) ? '✓' : '' ?></td>
                                            <td>Prone</td>
                                        </tr>
                                        <tr>
                                            <td><?= in_array("Trendelenburg", $posisiData) ? '✓' : '' ?></td>
                                            <td>Trendelenburg</td>
                                        </tr>
                                        <tr>
                                            <td><?= in_array("Lithotomy", $posisiData) ? '✓' : '' ?></td>
                                            <td>Lithotomy</td>
                                        </tr>
                                        <tr>
                                            <td><?= in_array("Lateral", $posisiData) ? '✓' : '' ?></td>
                                            <td>Lateral</td>
                                        </tr>

                                        <!-- CETAK LAINNYA HANYA JIKA ADA ISINYA -->
                                        <?php if (!empty($data->rm11b2StatusAnestesi['posisiLainnya'])): ?>
                                            <tr>
                                                <td>✓</td>
                                                <td>Lainnya : <?= htmlspecialchars($data->rm11b2StatusAnestesi['posisiLainnya']) ?></td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </div>
                                <div class="col-3">
                                    Airway <br>
                                    Laringoskopi derajat 1-4 <br>
                                    <?= empty($data->rm11b2StatusAnestesi['airway']) ? '.............' : $data->rm11b2StatusAnestesi['airway'] ?><br>
                                    <?php
                                    $peralatanLainData = $parseArray($data->rm11b2StatusAnestesi["peralatanLain"] ?? []);
                                    $ettJalur           = $data->rm11b2StatusAnestesi['ettJalur'] ?? '';
                                    ?>

                                    <!-- Baris 1: LMA -->
                                    <div>
                                        LMA no <?= !empty($data->rm11b2StatusAnestesi['lmaNo']) ? htmlspecialchars($data->rm11b2StatusAnestesi['lmaNo']) : '........' ?>
                                        &nbsp;&nbsp;Cuff : <?= !empty($data->rm11b2StatusAnestesi['lmaCuff']) ? htmlspecialchars($data->rm11b2StatusAnestesi['lmaCuff']) : '........' ?> ml
                                    </div>

                                    <!-- Baris 2: ETT & Oral/Nasal -->
                                    <div>
                                        ETT <?= !empty($data->rm11b2StatusAnestesi['ettText']) ? htmlspecialchars($data->rm11b2StatusAnestesi['ettText']) : '................' ?>
                                        &nbsp;&nbsp; <?= $ettJalur ?>
                                    </div>

                                    <!-- Baris 3: No. & Cuff -->
                                    <div>
                                        No. <?= !empty($data->rm11b2StatusAnestesi['ettNo']) ? htmlspecialchars($data->rm11b2StatusAnestesi['ettNo']) : '............' ?>
                                        &nbsp;&nbsp;Cuff <?= !empty($data->rm11b2StatusAnestesi['ettCuff']) ? htmlspecialchars($data->rm11b2StatusAnestesi['ettCuff']) : '........' ?> ml
                                    </div>

                                    <!-- Baris 4: NGT & Tampon (Menggunakan Tabel) -->
                                    <table style="border-collapse: collapse; margin-top: 2px;">
                                        <tr>
                                            <td style="width: 15px; text-align: center; font-weight: bold; vertical-align: top;"><?= in_array("NGT", $peralatanLainData) ? '✓' : '' ?></td>
                                            <td style="padding-right: 25px;">NGT</td>

                                            <td style="width: 15px; text-align: center; font-weight: bold; vertical-align: top;"><?= in_array("Tampon", $peralatanLainData) ? '✓' : '' ?></td>
                                            <td>Tampon</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-3">
                                    Lokasi infus / Tipe kanula : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['lokasiInfus']) ? htmlspecialchars($data->rm11b2StatusAnestesi['lokasiInfus']) : '.........' ?>
                                </div>
                                <div class="col-3">
                                    Tempat CVC : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['tempatCvc']) ? htmlspecialchars($data->rm11b2StatusAnestesi['tempatCvc']) : '.........' ?> <br>
                                    Tempat Arterial / Tipe Kanula : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['tempatArterial']) ? htmlspecialchars($data->rm11b2StatusAnestesi['tempatArterial']) : '.........' ?> <br>
                                    Kateter Arteri Pulmonal : <br>
                                    <?= !empty($data->rm11b2StatusAnestesi['kateterArteri']) ? htmlspecialchars($data->rm11b2StatusAnestesi['kateterArteri']) : '.........' ?> <br>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <input type="hidden" id="noRawat" value="<?= $data->rm11b2StatusAnestesi["noRawat"] ?>">

                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php
                        // Ambil objek/array RM11B1 Checklist
                        $ttd = $data->rm11b2StatusAnestesi;

                        // Cek apakah ADA SALAH SATU TTD yang masih kosong
                        if (
                            !$ttd["ttdDokter1"] ||
                            !$ttd["ttdDokter2"] ||
                            !$ttd["ttdDokter3"] ||
                            !$ttd["ttdDokter4"]
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

<div class="modal fade" id="modalTtdDokter1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter1" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter1">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter1" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdDokter2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter2" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter2">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter2" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdDokter3" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter3" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter3">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter3" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalTtdDokter4" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter/Perawat</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter4" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter4">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter4" disabled>Selesai</button>
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
                id: '#ttdDokter1',
                key: 'ttdDokter1'
            },
            {
                id: '#ttdDokter2',
                key: 'ttdDokter2'
            },
            {
                id: '#ttdDokter3',
                key: 'ttdDokter3'
            },
            {
                id: '#ttdDokter4',
                key: 'ttdDokter4'
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
            url: '<?= base_url() ?>rm/rm11b2StatusAnestesi/simpanTtd',
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
                canvasId: 'tempatTtdDokter1',
                btnHapusId: 'hapusTtdDokter1',
                btnSimpanId: 'simpanTtdDokter1',
                hasilId: 'ttdDokter1',
                modalId: 'modalTtdDokter1',
                altText: 'Tanda tangan Dokter 1'
            },
            {
                canvasId: 'tempatTtdDokter2',
                btnHapusId: 'hapusTtdDokter2',
                btnSimpanId: 'simpanTtdDokter2',
                hasilId: 'ttdDokter2',
                modalId: 'modalTtdDokter2',
                altText: 'Tanda tangan Dokter 2'
            }, {
                canvasId: 'tempatTtdDokter3',
                btnHapusId: 'hapusTtdDokter3',
                btnSimpanId: 'simpanTtdDokter3',
                hasilId: 'ttdDokter3',
                modalId: 'modalTtdDokter3',
                altText: 'Tanda tangan Dokter 3'
            }, {
                canvasId: 'tempatTtdDokter4',
                btnHapusId: 'hapusTtdDokter4',
                btnSimpanId: 'simpanTtdDokter4',
                hasilId: 'ttdDokter4',
                modalId: 'modalTtdDokter4',
                altText: 'Tanda tangan Dokter 4'
            }
        ];

        // ===================================================
        // EXECUTE INITIALIZATION (LOOPING)
        // ===================================================
        signatureConfigs.forEach(config => setupSignaturePad(config));

    });
</script>

</html>