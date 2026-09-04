<?php

/** @var object $data */
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "Times New Roman", Times, serif;
        background-color: #FFFFFF;
    }

    .page {
        width: 27cm;
        height: 3cm;
        /* Gunakan height tetap, bukan min-height untuk cetak label/gelang */
        padding: 0.2cm 0.2cm 0.2cm 0.5cm;
        margin: 0.1cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        box-sizing: border-box;
        /* Memastikan padding tidak menambah ukuran fisik */
    }

    .subpage {
        padding: 0cm;
        text-align: justify;
    }

    /* Pengaturan khusus untuk Mode Cetak (Ctrl+P) */
    @page {
        size: 27cm 3cm landscape;
        /* Memaksa ukuran kertas browser & orientasi landscape */
        margin: 0mm;
        /* Menghilangkan margin bawaan printer */
    }

    @page {
        /* Gunakan mm agar presisi dengan standar media HPRT */
        size: 270mm 30mm landscape;
        margin: 0 !important;
    }

    @media print {

        html,
        body {
            width: 270mm;
            height: 30mm;
            margin: 0 !important;
            padding: 0 !important;
        }

        .page {
            width: 270mm !important;
            height: 30mm !important;
            margin: 0 !important;
            border: none !important;
            box-shadow: none !important;
            page-break-after: avoid;
            page-break-inside: avoid;
        }

        /* Sembunyikan elemen bawaan browser */
        @page {
            margin: 0;
        }
    }

    .tabel td,
    .tabel th {
        padding: 0mm;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Gelang pasien</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <table class="table table-borderless table-sm mt-0 mb-1 tabel fw-bold" style="font-size:small ;margin-left: 100px;">
                    <tr>
                        <td style="width: 70px;">Nama</td>
                        <td>: <?= $data->pasien["nm_pasien"] ?></td>
                    </tr>
                    <tr>
                        <td>Tgl.Lahir</td>
                        <td>: <?= date('d-m-Y', strtotime($data->pasien["tgl_lahir"])) ?></td>
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
</body>

</html>

<script>
    window.print()
</script>