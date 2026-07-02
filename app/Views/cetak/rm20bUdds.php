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
                        <td rowspan="4" class="text-center align-middle"><?= $data->rm20bUdds['dokter'] ?? ''  ?></td>
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

                <table class="table table-sm table-bordered <?= count($data->tanggalUnik) > 3 ? ' tabelData' : '' ?>">
                    <thead>
                        <tr>
                            <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                            <th colspan="<?= count($data->tanggalUnik) * 4 ?>" class="text-center">Rencana waktu pemberian</th>
                        </tr>
                        <tr>
                            <?php for ($i = 0; $i < count($data->tanggalUnik); $i++) : ?>
                                <th colspan="4" class="text-center">Tanggal : <?= $data->tanggalUnik[$i]['tanggal']  ?></th>
                            <?php endfor; ?>
                        </tr>
                        <tr>
                            <th style="background-color: #eaeaea;">Obat Oral</th>
                            <th style="background-color: #eaeaea;">Dosis</th>
                            <th style="background-color: #eaeaea;">Jumlah</th>

                            <?php for ($i = 0; $i < count($data->tanggalUnik); $i++) : ?>
                                <th style="background-color: #eaeaea;" class="text-center">P</th>
                                <th style="background-color: #eaeaea;" class="text-center">S</th>
                                <th style="background-color: #eaeaea;" class="text-center">S</th>
                                <th style="background-color: #eaeaea;" class="text-center">M</th>
                            <?php endfor; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'oral'): ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php if ($data->rm20bUddsData[$i]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                            <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                            <td><?= !empty($data->rm20bUddsData[$i]['pagi']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['pagi'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['siang']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['siang'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['sore']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['sore'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['malam']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['malam'])) : '-' ?></td>
                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>

                                    <?php endfor; ?>
                                </tr>
                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 18) {
                                    $jumlahTanggal = count($data->tanggalUnik);
                                    $colspanRencana = $jumlahTanggal * 4;

                                    // Menentukan class secara dinamis (menggantikan baris menggantung Anda sebelumnya)
                                    $classTambahan = ($jumlahTanggal > 3) ? ' tabelData' : '';
                                    // Tutup halaman lama dan buat struktur tabel baru di halaman berikutnya
                                    echo '</tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="page">
                                                        <div class="subpage">
                                                            <table class="table table-sm table-bordered' . $classTambahan . '">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                                                                        <th colspan="' . $colspanRencana . '" class="text-center">Rencana waktu pemberian</th>
                                                                    </tr>
                                                                    <tr>';
                                    // Render ulang header tanggal di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        $tglSaja = $data->tanggalUnik[$i]['tanggal'] ?? '';
                                        echo '<th colspan="4" class="text-center">Tanggal : ' . $tglSaja . '</th>';
                                    }

                                    echo '</tr>
                                                    <tr>
                                                        <th style="background-color: #eaeaea;">Obat Oral</th>
                                                        <th style="background-color: #eaeaea;">Dosis</th>
                                                        <th style="background-color: #eaeaea;">Jumlah</th>';

                                    // Render ulang kolom P S S M di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        echo '
                                                    <th style="background-color: #eaeaea;" class="text-center">P</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">M</th>';
                                    }
                                    echo ' </tr>
                                                        </thead>
                                                        <tbody>';
                                }
                                ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php
                        $semua_jenis = array_column((array) $data->rm20bUddsData, 'jenis_obat');

                        if (!in_array('oral', $semua_jenis)) {
                            echo "<tr><td>-</td><td>-</td><td>-</td>";
                            for ($i = 0; $i < count($data->tanggalUnik); $i++) {
                                echo "<td></td><td></td><td></td><td></td>";
                            }
                            echo "</tr>";
                        } ?>
                        <tr>
                            <th style="background-color: #eaeaea;">Obat Injeksi</th>
                            <td style="background-color: #eaeaea;" colspan="<?= 3 + (count($data->tanggalUnik) * 4) ?> "></td>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'injeksi'): ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php if ($data->rm20bUddsData[$i]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                            <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                            <td><?= !empty($data->rm20bUddsData[$i]['pagi']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['pagi'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['siang']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['siang'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['sore']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['sore'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['malam']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['malam'])) : '-' ?></td>
                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 18) {
                                    $jumlahTanggal = count($data->tanggalUnik);
                                    $colspanRencana = $jumlahTanggal * 4;

                                    // Menentukan class secara dinamis (menggantikan baris menggantung Anda sebelumnya)
                                    $classTambahan = ($jumlahTanggal > 3) ? ' tabelData' : '';
                                    // Tutup halaman lama dan buat struktur tabel baru di halaman berikutnya
                                    echo '</tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="page">
                                                        <div class="subpage">
                                                            <table class="table table-sm table-bordered' . $classTambahan . '">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                                                                        <th colspan="' . $colspanRencana . '" class="text-center">Rencana waktu pemberian</th>
                                                                    </tr>
                                                                    <tr>';
                                    // Render ulang header tanggal di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        $tglSaja = $data->tanggalUnik[$i]['tanggal'] ?? '';
                                        echo '<th colspan="4" class="text-center">Tanggal : ' . $tglSaja . '</th>';
                                    }

                                    echo '</tr>
                                                    <tr>
                                                        <th style="background-color: #eaeaea;">Obat Injeksi</th>
                                                        <th style="background-color: #eaeaea;">Dosis</th>
                                                        <th style="background-color: #eaeaea;">Jumlah</th>';

                                    // Render ulang kolom P S S M di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        echo '
                                                    <th style="background-color: #eaeaea;" class="text-center">P</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">M</th>';
                                    }
                                    echo ' </tr>
                                                        </thead>
                                                        <tbody>';
                                }
                                ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php
                        $semua_jenis = array_column((array) $data->rm20bUddsData, 'jenis_obat');

                        if (!in_array('injeksi', $semua_jenis)) {
                            echo "<tr><td>-</td><td>-</td><td>-</td>";
                            for ($i = 0; $i < count($data->tanggalUnik); $i++) {
                                echo "<td></td><td></td><td></td><td></td>";
                            }
                            echo "</tr>";
                        } ?>
                        <tr>
                            <th style="background-color: #eaeaea;">Cairan Infus</th>
                            <td style="background-color: #eaeaea;" colspan="<?= 3 + (count($data->tanggalUnik) * 4) ?> "></td>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'infus'): ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php if ($data->rm20bUddsData[$i]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                            <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                            <td><?= !empty($data->rm20bUddsData[$i]['pagi']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['pagi'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['siang']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['siang'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['sore']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['sore'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['malam']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['malam'])) : '-' ?></td>
                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 18) {
                                    $jumlahTanggal = count($data->tanggalUnik);
                                    $colspanRencana = $jumlahTanggal * 4;

                                    // Menentukan class secara dinamis (menggantikan baris menggantung Anda sebelumnya)
                                    $classTambahan = ($jumlahTanggal > 3) ? ' tabelData' : '';
                                    // Tutup halaman lama dan buat struktur tabel baru di halaman berikutnya
                                    echo '</tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="page">
                                                        <div class="subpage">
                                                            <table class="table table-sm table-bordered' . $classTambahan . '">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                                                                        <th colspan="' . $colspanRencana . '" class="text-center">Rencana waktu pemberian</th>
                                                                    </tr>
                                                                    <tr>';
                                    // Render ulang header tanggal di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        $tglSaja = $data->tanggalUnik[$i]['tanggal'] ?? '';
                                        echo '<th colspan="4" class="text-center">Tanggal : ' . $tglSaja . '</th>';
                                    }

                                    echo '</tr>
                                                    <tr>
                                                        <th style="background-color: #eaeaea;">Cairan Infus</th>
                                                        <th style="background-color: #eaeaea;">Dosis</th>
                                                        <th style="background-color: #eaeaea;">Jumlah</th>';

                                    // Render ulang kolom P S S M di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        echo '
                                                    <th style="background-color: #eaeaea;" class="text-center">P</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">M</th>';
                                    }
                                    echo ' </tr>
                                                        </thead>
                                                        <tbody>';
                                }
                                ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php
                        $semua_jenis = array_column((array) $data->rm20bUddsData, 'jenis_obat');

                        if (!in_array('infus', $semua_jenis)) {
                            echo "<tr><td>-</td><td>-</td><td>-</td>";
                            for ($i = 0; $i < count($data->tanggalUnik); $i++) {
                                echo "<td></td><td></td><td></td><td></td>";
                            }
                            echo "</tr>";
                        } ?>
                        <tr>
                            <td style="background-color: #eaeaea;"><b class="mb-0">Lain-lain</b> <br>
                                <div style="font-size: 7pt;" class="mt-0">Alkes,Suppositoria,vaginal sup,Inhalasi</div>
                            </td>
                            <td style="background-color: #eaeaea;" colspan="<?= 3 + (count($data->tanggalUnik) * 4) ?> "></td>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'lain'): ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php if ($data->rm20bUddsData[$i]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                            <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                            <td><?= !empty($data->rm20bUddsData[$i]['pagi']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['pagi'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['siang']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['siang'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['sore']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['sore'])) : '-' ?></td>
                                            <td><?= !empty($data->rm20bUddsData[$i]['malam']) ? date($formatJam, strtotime($data->rm20bUddsData[$i]['malam'])) : '-' ?></td>
                                        <?php else: ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 18) {
                                    $jumlahTanggal = count($data->tanggalUnik);
                                    $colspanRencana = $jumlahTanggal * 4;

                                    // Menentukan class secara dinamis (menggantikan baris menggantung Anda sebelumnya)
                                    $classTambahan = ($jumlahTanggal > 3) ? ' tabelData' : '';
                                    // Tutup halaman lama dan buat struktur tabel baru di halaman berikutnya
                                    echo '</tbody>
                                                    </table>
                                                    </div>
                                                    </div>
                                                    
                                                    <div class="page">
                                                        <div class="subpage">
                                                            <table class="table table-sm table-bordered' . $classTambahan . '">
                                                                <thead>
                                                                    <tr>
                                                                        <th colspan="3" rowspan="2" class="text-center align-middle">Jenis Obat</th>
                                                                        <th colspan="' . $colspanRencana . '" class="text-center">Rencana waktu pemberian</th>
                                                                    </tr>
                                                                    <tr>';
                                    // Render ulang header tanggal di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        $tglSaja = $data->tanggalUnik[$i]['tanggal'] ?? '';
                                        echo '<th colspan="4" class="text-center">Tanggal : ' . $tglSaja . '</th>';
                                    }

                                    echo '</tr>
                                                    <tr>
                                                        <td style="background-color: #eaeaea;"><b class="mb-0">Lain-lain</b> <br>
                                <div style="font-size: 7pt;" class="mt-0">Alkes,Suppositoria,vaginal sup,Inhalasi</div>
                            </td>
                                                        <th style="background-color: #eaeaea;">Dosis</th>
                                                        <th style="background-color: #eaeaea;">Jumlah</th>';

                                    // Render ulang kolom P S S M di halaman baru
                                    for ($i = 0; $i < $jumlahTanggal; $i++) {
                                        echo '
                                                    <th style="background-color: #eaeaea;" class="text-center">P</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">S</th>
                                                    <th style="background-color: #eaeaea;" class="text-center">M</th>';
                                    }
                                    echo ' </tr>
                                                        </thead>
                                                        <tbody>';
                                }
                                ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <?php
                        $semua_jenis = array_column((array) $data->rm20bUddsData, 'jenis_obat');

                        if (!in_array('lain', $semua_jenis)) {
                            echo "<tr><td>-</td><td>-</td><td>-</td>";
                            for ($i = 0; $i < count($data->tanggalUnik); $i++) {
                                echo "<td></td><td></td><td></td><td></td>";
                            }
                            echo "</tr>";
                        } ?>
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
    // Create a new QRCode instance
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    var qrKecil = new QRCode(document.getElementById("qrKecil"), {
        width: 50, // Set the width of the QR code
        height: 50, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrcode.makeCode("Di ttd oleh " + $("#dokter").val() + " untuk Informed concent. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL
    qrKecil.makeCode("Di ttd oleh " + $("#dokter").val() + " untuk Informed concent. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL
</script>

</html>