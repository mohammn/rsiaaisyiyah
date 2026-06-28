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
        width: 33cm;
        /* A4 width */
        min-height: 21cm;
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
        size: 330mm 210mm;
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
        padding: 0.5mm;
    }

    td img {
        margin: auto;
    }

    .tabelTindakan td,
    .tabelTindakan th {
        padding: 0mm;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rm27b Kateter</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="70%" alt=""></div>
                    <div class="col-5">
                        <br><br>
                    </div>
                    <div class="col-3">
                        <div style="text-align: end;">
                            RM 27b
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
                            FORMULIR DATA SURVEILLANS PEMAKAIAN ALAT INVASIF KATETER URIN MENETAP
                        </p>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-4">
                        <b>Jenis Cath :</b> <?= $data->rm27bKateter["jenisCath"] ?> <br>
                    </div>
                    <div class="col-4">
                        <b>Nomor Cath :</b> <?= $data->rm27bKateter["ivCath"] ?>
                    </div>
                    <div class="col-4">
                        <b>Jumah Pengunci :</b> <?= $data->rm27bKateter["jumlahPengunci"] ?> <br>
                    </div>
                </div>

                <?php
                // 1. Filter kolom mana saja dari 1-10 yang ada nama petugasnya
                $kolom_aktif = [];
                for ($i = 1; $i <= 10; $i++) {
                    if (!empty($data->rm27bKateter["petugas" . $i])) {
                        $kolom_aktif[] = $i;
                    }
                }

                // 2. Hitung total kolom aktif untuk menentukan colspan dinamis di header skala
                $total_kolom_aktif = count($kolom_aktif);
                ?>

                <table class="table table-sm table-bordered table-striped tabelTindakan mb-0">
                    <thead>
                        <tr>
                            <th colspan="2" class="align-middle text-center fw-bold" style="font-size: 0.85rem;">ITEM PENCEGAHAN ISK</th>
                            <?php foreach ($kolom_aktif as $i): ?>
                                <th class="text-center align-middle p-1 fw-bold" style="font-size: 0.75rem;">
                                    <?= !empty($data->rm27bKateter["tgl" . $i]) && $data->rm27bKateter["tgl" . $i] !== '0000-00-00' && $data->rm27bKateter["tgl" . $i] !== '00-00-0000' ? date('d/m/Y', strtotime($data->rm27bKateter["tgl" . $i])) : '' ?>
                                </th>
                            <?php endforeach; ?>
                            <th class="text-center align-middle fw-bold" style="font-size: 0.8rem; width: 50px;">Total hari</th>
                            <th class="text-center align-middle fw-bold" style="font-size: 0.8rem; width: 100px;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $judul_tindakan = [
                            1  => "Pemasangan kateter urin",
                            2  => "Pelepasan kateter urin",
                            3  => "Pemasangan dengan teknik aseptik",
                            4  => "Fiksasi kateter terpasang dengan baik",
                            5  => "Urin bag dibawah bladder",
                            6  => "Urin bag menyentuh lantai",
                            7  => "Bladder training dengan klem kateter",
                            8  => "Membuka sambungan antara selang kateter dan selang urin bag",
                            9  => "Perineal hygiene sebelum pemasangan kateter dengan air dan sabun",
                            10 => "Gelas ukur terpisah antar pasien",
                            11 => "Masih ada indikasi pemakaian kateter urin",
                            12 => "a: Demam &ge;38°C",
                            13 => "a: Nyeri supra pubik",
                            14 => "a: Nyeri costovertebral angel",
                            15 => "a: Urgency urin (keinginan yang kuat dan tiba-tiba untuk berkemih)",
                            16 => "a: Frequency urin (sering BAK yang tidak normal)",
                            17 => "a: Dysuria (rasa nyeri dan tidak nyaman saat kencing)",
                            18 => "b: Kuman biakan urin ≥ 10⁵ (CFU) / ml ",
                            19 => "c: Pyuria (urin spesimen dengan ≥ 10 WBC/mm³)"
                        ];

                        for ($row = 1; $row <= 19; $row++):
                            if ($row == 12): ?>
                                <tr>
                                    <td colspan="2" class="align-middle bg-warning bg-opacity-25 small fw-bold text-center">SKALA PENILAIAN PLEBHITHIS</td>
                                    <?php foreach ($kolom_aktif as $i): ?>
                                        <td class="bg-warning bg-opacity-10"></td>
                                    <?php endforeach; ?>
                                    <td class="bg-warning bg-opacity-10"></td>
                                    <td class="bg-warning bg-opacity-10"></td>
                                </tr>
                            <?php endif;

                            $db_hari_string = $data->rm27bKateter["c{$row}"] ?? '';
                            $hari_tercentang = !empty($db_hari_string) ? explode(',', $db_hari_string) : [];

                            // FILTER: Hanya hitung hari yang kolom petugasnya aktif/isi
                            $hari_valid = array_intersect($hari_tercentang, $kolom_aktif);
                            $total_hari = count($hari_valid);
                            ?>
                            <tr>
                                <?php if ($row >= 12):
                                    $split_judul = explode(': ', $judul_tindakan[$row], 2);
                                    if ($row == 12):
                                        echo '<td rowspan="6" class="align-middle text-center fw-bold bg-light" style="width: 40px; font-size: 0.75rem;">' . $split_judul[0] . '</td>';
                                    elseif ($row >= 18):
                                        echo '<td class="align-middle text-center fw-bold bg-light" style="width: 40px; font-size: 0.75rem;">' . $split_judul[0] . '</td>';
                                    endif;
                                    echo '<td class="align-middle bg-light small" style="font-size: 0.65rem;">' . $split_judul[1] . '</td>';
                                else: ?>
                                    <td colspan="2" class="align-middle bg-light small fw-bold" style="font-size: 0.75rem;"><?= $judul_tindakan[$row] ?></td>
                                <?php endif; ?>

                                <?php foreach ($kolom_aktif as $i): ?>
                                    <td class="text-center align-middle p-0" style="font-size: 0.85rem;">
                                        <?= in_array($i, $hari_tercentang) ? '√' : '' ?>
                                    </td>
                                <?php endforeach; ?>

                                <td class="text-center align-middle fw-bold bg-light" style="font-size: 0.7rem;">
                                    <?= $total_hari > 0 ? $total_hari : '' ?>
                                </td>

                                <td class="align-middle p-1 small" style="font-size: 0.7rem; word-break: break-word;">
                                    <?= $data->rm27bKateter["ket{$row}"] ?? '' ?>
                                </td>
                            </tr>
                        <?php endfor; ?>

                        <tr>
                            <td colspan="2" class="align-middle bg-light small fw-bold" style="font-size: 0.75rem;">Nama & Paraf Petugas</td>
                            <?php foreach ($kolom_aktif as $i): ?>
                                <td class="text-center align-middle p-0" style="font-size: 0.45rem; line-height: 1.1; min-width: 20px;">
                                    <div id='qr<?= $i ?>'></div>
                                    <?= $data->rm27bKateter["petugas" . $i] ?? '' ?>
                                </td>
                            <?php endforeach; ?>
                            <td class="bg-light"></td>
                            <td class="bg-light"></td>
                        </tr>
                    </tbody>
                </table>

                <p class="fw-bold text-dark mb-0">Keterangan:</p>
                <ol class="mb-0 ps-3">
                    <li class="mb-0">
                        Formulir bundle pemakaian alat invasif kateter urin di isi sejak tanggal pemasangan kateter urin sampai 2 hari setelah pelepasan kateter urin.
                    </li>
                    <li class="mb-0">
                        Ditemukan kriteria ISK jika terdapat <strong>(Minimal salah satu gejala di item a dan b atau C)</strong> saat memakai kateter dan 2 hari setelah pelepasan kateter.
                    </li>
                    <li class="mb-0">
                        Jika ditemukan kriteria ISK segera laporkan ke Kepala Ruang dan masukkan data pada rekap data surveillan HAI's.
                    </li>
                </ol>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    <?php for ($i = 1; $i <= 10; $i++):
        if ($data->rm27bKateter["petugas" . $i]):
            echo 'var qrcode = new QRCode(document.getElementById("qr' . $i . '"), { width: 30, height: 30, colorDark: "#000000", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.L});';
            echo 'qrcode.makeCode("ttd' . $data->rm27bKateter["petugas" . $i] . '");';
        endif;
    endfor; ?>
    //========================================================
</script>

</html>