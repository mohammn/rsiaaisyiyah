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
    <title>Cetak IC Sesar</title>

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
                            RM 27c
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
                            BUNDLE INFEKSI LUKA INFUS (PLEBITIS)
                        </p>
                    </div>
                </div>

                <div class="row p-2">
                    <div class="col-3">
                        <b>Bulan :</b> <?= $data->rm27cPlebitis["bulan"] ?> <br>
                    </div>
                    <div class="col-3">
                        <b>Ruang :</b> <?= $data->rm27cPlebitis["ruang"] ?>
                    </div>
                    <div class="col-3">
                        <b>Umur :</b> <?= $data->rm27cPlebitis["umur"] ?> <br>
                    </div>
                    <div class="col-3">
                        <b>Diagnosa Masuk :</b> <?= $data->rm27cPlebitis["diagnosa"] ?>
                    </div>
                </div>

                <?php
                // 1. Filter kolom mana saja dari 1-10 yang ada nama petugasnya
                $kolom_aktif = [];
                for ($i = 1; $i <= 10; $i++) {
                    if (!empty($data->rm27cPlebitis["petugas" . $i])) {
                        $kolom_aktif[] = $i;
                    }
                }

                // 2. Hitung total kolom aktif untuk menentukan colspan dinamis di header skala
                $total_kolom_aktif = count($kolom_aktif);
                ?>

                <table class="table table-sm table-bordered table-striped tabelTindakan mb-0">
                    <thead>
                        <tr>
                            <th colspan="2" class="align-middle text-center fw-bold" style="font-size: 0.85rem;">ITEM PENCEGAHAN PLEBHITHIS</th>
                            <?php foreach ($kolom_aktif as $i): ?>
                                <th class="text-center align-middle p-1 fw-bold" style="font-size: 0.75rem;">
                                    <?= !empty($data->rm27cPlebitis["tgl" . $i]) && $data->rm27cPlebitis["tgl" . $i] !== '0000-00-00' && $data->rm27cPlebitis["tgl" . $i] !== '00-00-0000' ? date('d/m/Y', strtotime($data->rm27cPlebitis["tgl" . $i])) : '' ?>
                                </th>
                            <?php endforeach; ?>
                            <th class="text-center align-middle fw-bold" style="font-size: 0.8rem; width: 50px;">Total hari</th>
                            <th class="text-center align-middle fw-bold" style="font-size: 0.8rem; width: 100px;">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $judul_tindakan = [
                            1  => "Pemasangan IV kateter baru",
                            2  => "Ruang pemasangan IV Kateter",
                            3  => "Pelepasan IV Kateter",
                            4  => "Nama pemasang IV kateter",
                            5  => "Masih ada alasan pemasangan IV kateter",
                            6  => "Pemasangan sesuai prosedur : Hand hygiene",
                            7  => "Tidak dilakukan re-palpasi setelah disenfeksi",
                            8  => "Fiksasi dengan baik, bersih, tidak basah",
                            9  => "Menggunakan closed sistem saat injeksi melalui IV kateter",
                            10 => "Dilakukan disenfeksi sebelum injeksi melalui IV Kateter",
                            11 => "Tidak ada bekuan darah/clothing",
                            12 => "0: Tidak ada nyeri, kemerahan atau bengkaka",
                            13 => "1a: Tidak ada nyeri, tampak sedikit kemerahan < 2,5 cm tidak ada bengkak tidak ada pengerasan",
                            14 => "1b: Nyeri, tampak sedikit kemerahan <2,5 cm tidak ada bengkak tidak ada pengerasaan",
                            15 => "2: Nyeri, kemerahan tidak ada pengeraasaan 2,5 - 4 cm",
                            16 => "3: Nyeri, kemerahan, bengkak tidak ada pengerasan 4 - 75 cm",
                            17 => "4: Nyeri, kemerahan, bengkak tidak ada pengerasan 4 - 75 cm, keluar cairan purulen"
                        ];

                        for ($row = 1; $row <= 17; $row++):
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

                            $db_hari_string = $data->rm27cPlebitis["c{$row}"] ?? '';
                            $hari_tercentang = !empty($db_hari_string) ? explode(',', $db_hari_string) : [];

                            // FILTER: Hanya hitung hari yang kolom petugasnya aktif/isi
                            $hari_valid = array_intersect($hari_tercentang, $kolom_aktif);
                            $total_hari = count($hari_valid);
                            ?>
                            <tr>
                                <?php if ($row >= 12):
                                    $split_judul = explode(': ', $judul_tindakan[$row], 2);
                                    echo '<td class="align-middle text-center fw-bold bg-light" style="width: 40px; font-size: 0.75rem;">' . $split_judul[0] . '</td>';
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
                                    <?= $data->rm27cPlebitis["ket{$row}"] ?? '' ?>
                                </td>
                            </tr>
                        <?php endfor; ?>

                        <tr>
                            <td colspan="2" class="align-middle bg-light small fw-bold" style="font-size: 0.75rem;">Nama & Paraf Petugas</td>
                            <?php foreach ($kolom_aktif as $i): ?>
                                <td class="text-center align-middle p-0" style="font-size: 0.45rem; line-height: 1.1; min-width: 20px;">
                                    <div id='qr<?= $i ?>'></div>
                                    <?= $data->rm27cPlebitis["petugas" . $i] ?? '' ?>
                                </td>
                            <?php endforeach; ?>
                            <td class="bg-light"></td>
                            <td class="bg-light"></td>
                        </tr>
                    </tbody>
                </table>

                <div class="row m-1">
                    <div class="col-3 border border-secondary">
                        <b>Lokasi Pemasangan :</b>
                        <?php
                        $lokasi_array = json_decode($data->rm27cPlebitis["lokasiPemasangan"] ?? '[]', true);
                        if (!empty($lokasi_array) && is_array($lokasi_array)) {
                            $key = array_search('Lainnya', $lokasi_array);
                            if ($key !== false) {
                                $lokasi_array[$key] = $data->rm27cPlebitis["isilokasiPemasanganLainnya"] ?? 'Lainnya';
                            }
                            echo implode(', ', $lokasi_array);
                        } else {
                            echo '-';
                        }
                        ?>
                    </div>
                    <div class="col-3 border border-secondary">
                        <b>No IV Cath :</b> <?= $data->rm27cPlebitis["ivCath"] === 'Lainnya' ? $data->rm27cPlebitis["isiivCath"] : $data->rm27cPlebitis["ivCath"] ?>
                    </div>
                    <div class="col-3 border border-secondary">
                        <b>Jenis Cairan :</b> <?= $data->rm27cPlebitis["jenisCairan"] ?? '...' ?>
                    </div>
                    <div class="col-3 border border-secondary">
                        <b>Gol. Obat Injeksi yang diberikan :</b>
                        <?php
                        $lokasi_array = json_decode($data->rm27cPlebitis["golObat"] ?? '[]', true);
                        if (!empty($lokasi_array) && is_array($lokasi_array)) {
                            $key = array_search('Lainnya', $lokasi_array);
                            if ($key !== false) {
                                $lokasi_array[$key] = $data->rm27cPlebitis["isigolObatLainnya"] ?? 'Lainnya';
                            }
                            echo implode(', ', $lokasi_array);
                        } else {
                            echo '-';
                        }
                        ?>
                    </div>
                </div>
                Keterangan : Jika Skala Penilaian Phlebitis mencapai 2 segera lakukan penggantian lokasi infus
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    <?php for ($i = 1; $i <= 10; $i++):
        if ($data->rm27cPlebitis["petugas" . $i]):
            echo 'var qrcode = new QRCode(document.getElementById("qr' . $i . '"), { width: 30, height: 30, colorDark: "#000000", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.L});';
            echo 'qrcode.makeCode("ttd' . $data->rm27cPlebitis["petugas" . $i] . '");';
        endif;
    endfor; ?>
    //========================================================
</script>

</html>