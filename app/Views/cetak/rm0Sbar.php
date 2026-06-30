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
        padding: 1cm 1cm 1cm 2cm;
        /* Example padding for content */
        margin: 0.5cm auto;
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
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak SBAR</title>

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
                            RM 0
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
                        <br>
                        <p style="font-size: 14pt; margin:0;">CATATAN KOMUNIKASI SBAR <?= $data->rm0Sbar['judul'] ?></p>
                    </div>
                </div>
                <?php for ($i = 0; $i < count($data->rm0SbarData); $i++): ?>

                    <?php if ($i % 3 == 0 and $i != 0) {
                        echo '</div>
                                    </div>
                                <div class="page">
                                    <div class="subpage">';
                    } ?>

                    <table class="table table-bordered table-sm">
                        <tr>
                            <th style="width: 20%; background-color: #eaeaea;" class="text-center">Tanggal</th>
                            <th style="background-color: #eaeaea;" colspan="3" class="text-center">SBAR</th>
                        </tr>
                        <tr>
                            <td rowspan="4" class="text-center fw-bold" style="vertical-align: middle;">
                                <?= $data->rm0SbarData[$i]["waktu"] ?? "" ?>
                            </td>
                            <td style="width: 6%;">
                                <b>S :</b>
                            </td>
                            <td colspan="2">
                                <?= $data->rm0SbarData[$i]['s'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>B :</b>
                            </td>
                            <td colspan="2">
                                <?= $data->rm0SbarData[$i]['b'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>A :</b>
                            </td>
                            <td colspan="2">
                                <?= $data->rm0SbarData[$i]['a'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b>R :</b>
                            </td>
                            <td colspan="2">
                                <?= $data->rm0SbarData[$i]['r'] ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <b>Petugas</b>
                                <br>
                                <div id="qrPetugas<?= $i ?>" class="mb-1"></div>
                                <?= $data->rm0SbarData[$i]['petugas'] ?? '' ?><br>
                                <small><?= $data->rm0SbarData[$i]['waktu'] ?? '' ?></small>
                            </td>
                            <td style="width:50%;" class=" text-center">
                                <b>Dokter</b>
                                <?php
                                if (($data->rm0SbarData[$i]['tglVerif'] ?? '')): ?>
                                    <br>
                                    <div id="qrDokter<?= $i ?>" class="mb-1">
                                    </div>
                                <?php else: ?>
                                    <br><br><br><br>
                                <?php endif; ?>

                                <?= $data->rm0SbarData[$i]['dokter'] ?? '' ?>
                                <br>
                                <small><?= $data->rm0SbarData[$i]['tglVerif'] ?? '' ?></small>
                            </td>
                        </tr>
                    </table>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</body>


<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    <?php for ($i = 0; $i < count($data->rm0SbarData); $i++): ?>
        var qrcode = new QRCode(document.getElementById("qrPetugas<?= $i ?>"), {
            width: 50, // Set the width of the QR code
            height: 50, // Set the height of the QR code
            colorDark: "#000000", // Color of the dark modules (e.g., black squares)
            colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
            correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
        });
        qrcode.makeCode("Di ttd oleh <?= $data->rm0SbarData[$i]['petugas'] ?> untuk SBAR : <?= $data->rm0Sbar['judul'] ?> no Rawat : <?= $data->rm0Sbar['noRawat'] ?>  "); // Replace with your desired text or URL
        <?php
        if (($data->rm0SbarData[$i]['tglVerif'] ?? '')): ?>
            var qrcodeDokter = new QRCode(document.getElementById("qrDokter<?= $i ?>"), {
                width: 50, // Set the width of the QR code
                height: 50, // Set the height of the QR code
                colorDark: "#000000", // Color of the dark modules (e.g., black squares)
                colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
            });
            qrcodeDokter.makeCode("Di ttd oleh <?= $data->rm0SbarData[$i]['dokter'] ?> untuk SBAR : <?= $data->rm0Sbar['judul'] ?> no Rawat : <?= $data->rm0Sbar['noRawat'] ?>  "); // Replace with your desired text or URL

        <?php endif; ?>
    <?php endfor; ?>

    //========================================================
</script>

</html>