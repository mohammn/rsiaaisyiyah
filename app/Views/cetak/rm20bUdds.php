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
                                <?php
                                $idDicari = $data->rm20bUddsData[$i]["id"];
                                $hasilFilter = array_filter((array) $data->rm20bUddsDataJam, function ($item) use ($idDicari) {
                                    // Pastikan key 'idObat' sesuai dengan huruf besar/kecil di array (di gambar tertulis 'idObat')
                                    return isset($item['idObat']) && $item['idObat'] == $idDicari;
                                });
                                $hasilFilter = array_values($hasilFilter);
                                ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php $kosong = true; ?>
                                        <?php for ($k = 0; $k < count($hasilFilter); $k++) : ?>
                                            <?php if ($hasilFilter[$k]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                                <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                                <td><?= !empty($hasilFilter[$k]['pagi']) ? date($formatJam, strtotime($hasilFilter[$k]['pagi'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['siang']) ? date($formatJam, strtotime($hasilFilter[$k]['siang'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['sore']) ? date($formatJam, strtotime($hasilFilter[$k]['sore'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['malam']) ? date($formatJam, strtotime($hasilFilter[$k]['malam'])) : '-' ?></td>
                                                <?php $kosong = false;
                                                break; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($kosong): ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>
                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 16) {
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
                            <td colspan="3" class="text-center align-middle">Pemberi Obat</td>
                            <?php
                            $petugasPerTanggal = [];

                            foreach ($data->rm20bUddsDataJam as $row) {
                                $tanggal = $row['tanggal'];
                                $pemberiObat = $row['pemberiObatOral'];

                                // Pastikan kolom pemberiObat tidak null atau kosong
                                if (!empty($pemberiObat)) {
                                    // Buat array kosong untuk tanggal tersebut jika belum ada
                                    if (!isset($petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal] = [];
                                    }

                                    // Cek agar nama petugas pemberiObat tidak double di tanggal yang sama
                                    if (!in_array($pemberiObat, $petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal][] = $pemberiObat;
                                    }
                                }
                            }

                            for ($j = 0; $j < count($data->tanggalUnik); $j++) :
                                $petugas = '';
                                if (isset($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]])):
                                    for ($i = 0; $i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]); $i++) :
                                        $petugas .= $petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]][$i];
                                        if ($i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]) - 1) {
                                            $petugas .= ' & ';
                                        }
                                    endfor;
                                    echo '<td colspan="4" class="text-center"> <div id="qrPemObatOral' . $j . '"></div> <small style="font-size:6pt;" id="namaPemObatOral' . $j . '">' . $petugas . '</td>';
                                else:
                                    echo '<td colspan="4" class="text-center"> </td>';
                                endif;
                            endfor; ?>
                        </tr>
                        <tr>
                            <th style="background-color: #eaeaea;">Obat Injeksi</th>
                            <td style="background-color: #eaeaea;" colspan="<?= 3 + (count($data->tanggalUnik) * 4) ?> "></td>
                        </tr>
                        <?php for ($i = 0; $i < count($data->rm20bUddsData); $i++) : ?>
                            <?php if ($data->rm20bUddsData[$i]['jenis_obat'] === 'injeksi'): ?>
                                <?php
                                $idDicari = $data->rm20bUddsData[$i]["id"];
                                $hasilFilter = array_filter((array) $data->rm20bUddsDataJam, function ($item) use ($idDicari) {
                                    // Pastikan key 'idObat' sesuai dengan huruf besar/kecil di array (di gambar tertulis 'idObat')
                                    return isset($item['idObat']) && $item['idObat'] == $idDicari;
                                });
                                $hasilFilter = array_values($hasilFilter);
                                ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php $kosong = true; ?>
                                        <?php for ($k = 0; $k < count($hasilFilter); $k++) : ?>
                                            <?php if ($hasilFilter[$k]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                                <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                                <td><?= !empty($hasilFilter[$k]['pagi']) ? date($formatJam, strtotime($hasilFilter[$k]['pagi'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['siang']) ? date($formatJam, strtotime($hasilFilter[$k]['siang'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['sore']) ? date($formatJam, strtotime($hasilFilter[$k]['sore'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['malam']) ? date($formatJam, strtotime($hasilFilter[$k]['malam'])) : '-' ?></td>
                                                <?php $kosong = false;
                                                break; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($kosong): ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 16) {
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
                                <?php
                                $idDicari = $data->rm20bUddsData[$i]["id"];
                                $hasilFilter = array_filter((array) $data->rm20bUddsDataJam, function ($item) use ($idDicari) {
                                    // Pastikan key 'idObat' sesuai dengan huruf besar/kecil di array (di gambar tertulis 'idObat')
                                    return isset($item['idObat']) && $item['idObat'] == $idDicari;
                                });
                                $hasilFilter = array_values($hasilFilter);
                                ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php $kosong = true; ?>
                                        <?php for ($k = 0; $k < count($hasilFilter); $k++) : ?>
                                            <?php if ($hasilFilter[$k]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                                <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                                <td><?= !empty($hasilFilter[$k]['pagi']) ? date($formatJam, strtotime($hasilFilter[$k]['pagi'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['siang']) ? date($formatJam, strtotime($hasilFilter[$k]['siang'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['sore']) ? date($formatJam, strtotime($hasilFilter[$k]['sore'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['malam']) ? date($formatJam, strtotime($hasilFilter[$k]['malam'])) : '-' ?></td>
                                                <?php $kosong = false;
                                                break; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($kosong): ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 16) {
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
                                <?php
                                $idDicari = $data->rm20bUddsData[$i]["id"];
                                $hasilFilter = array_filter((array) $data->rm20bUddsDataJam, function ($item) use ($idDicari) {
                                    // Pastikan key 'idObat' sesuai dengan huruf besar/kecil di array (di gambar tertulis 'idObat')
                                    return isset($item['idObat']) && $item['idObat'] == $idDicari;
                                });
                                $hasilFilter = array_values($hasilFilter);
                                ?>
                                <tr>
                                    <td><?= $data->rm20bUddsData[$i]["nama_obat"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["dosis"] ?></td>
                                    <td><?= $data->rm20bUddsData[$i]["jumlah"] ?></td>
                                    <?php for ($j = 0; $j < count($data->tanggalUnik); $j++) : ?>
                                        <?php $kosong = true; ?>
                                        <?php for ($k = 0; $k < count($hasilFilter); $k++) : ?>
                                            <?php if ($hasilFilter[$k]['tanggal'] === $data->tanggalUnik[$j]['tanggal']): ?>
                                                <?php $formatJam = (count($data->tanggalUnik) > 3) ? 'H: i' : 'H:i'; ?>
                                                <td><?= !empty($hasilFilter[$k]['pagi']) ? date($formatJam, strtotime($hasilFilter[$k]['pagi'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['siang']) ? date($formatJam, strtotime($hasilFilter[$k]['siang'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['sore']) ? date($formatJam, strtotime($hasilFilter[$k]['sore'])) : '-' ?></td>
                                                <td><?= !empty($hasilFilter[$k]['malam']) ? date($formatJam, strtotime($hasilFilter[$k]['malam'])) : '-' ?></td>
                                                <?php $kosong = false;
                                                break; ?>
                                            <?php endif; ?>
                                        <?php endfor; ?>
                                        <?php if ($kosong): ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                </tr>

                                <?php
                                $barisGolobal++; // Tambahkan hitungan baris global setiap data di-loop

                                if ($barisGolobal == 16) {
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

                        <tr>
                            <td colspan="3" class="text-center align-middle">Pemberi Obat</td>
                            <?php
                            $petugasPerTanggal = [];

                            foreach ($data->rm20bUddsDataJam as $row) {
                                $tanggal = $row['tanggal'];
                                $pemberiObat = $row['pemberiObat'];

                                // Pastikan kolom pemberiObat tidak null atau kosong
                                if (!empty($pemberiObat)) {
                                    // Buat array kosong untuk tanggal tersebut jika belum ada
                                    if (!isset($petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal] = [];
                                    }

                                    // Cek agar nama petugas pemberiObat tidak double di tanggal yang sama
                                    if (!in_array($pemberiObat, $petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal][] = $pemberiObat;
                                    }
                                }
                            }

                            for ($j = 0; $j < count($data->tanggalUnik); $j++) :
                                $petugas = '';
                                if (isset($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]])):
                                    for ($i = 0; $i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]); $i++) :
                                        $petugas .= $petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]][$i];
                                        if ($i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]) - 1) {
                                            $petugas .= ' & ';
                                        }
                                    endfor;
                                    echo '<td colspan="4" class="text-center"> <div id="qrPemObat' . $j . '"></div> <small style="font-size:6pt;" id="namaPemObat' . $j . '">' . $petugas . '</td>';
                                else:
                                    echo '<td colspan="4" class="text-center"> </td>';
                                endif;
                            endfor; ?>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center align-middle">Apoteker</td>
                            <?php
                            $petugasPerTanggal = [];

                            foreach ($data->rm20bUddsDataJam as $row) {
                                $tanggal = $row['tanggal'];
                                $petugasapotker = $row['apoteker'];

                                // Pastikan kolom apoteker tidak null atau kosong
                                if (!empty($petugasapotker)) {
                                    // Buat array kosong untuk tanggal tersebut jika belum ada
                                    if (!isset($petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal] = [];
                                    }

                                    // Cek agar nama petugas petugasapotker tidak double di tanggal yang sama
                                    if (!in_array($petugasapotker, $petugasPerTanggal[$tanggal])) {
                                        $petugasPerTanggal[$tanggal][] = $petugasapotker;
                                    }
                                }
                            }

                            for ($j = 0; $j < count($data->tanggalUnik); $j++) :
                                $petugas = '';
                                if (isset($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]])):
                                    for ($i = 0; $i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]); $i++) :
                                        $petugas .= $petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]][$i];
                                        if ($i < count($petugasPerTanggal[$data->tanggalUnik[$j]["tanggal"]]) - 1) {
                                            $petugas .= ' & ';
                                        }
                                    endfor;
                                    echo '<td colspan="4" class="text-center"> <div id="qrApoteker' . $j . '"></div> <small style="font-size:6pt;" id="namaApoteker' . $j . '">' . $petugas . '</td>';
                                else:
                                    echo '<td colspan="4" class="text-center"> </td>';
                                endif;
                            endfor; ?>
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

    <?php for ($i = 0; $i < count($data->tanggalUnik); $i++) : ?>
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