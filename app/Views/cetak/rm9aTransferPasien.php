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
    <title>Cetak RM9a Transfer Pasien</title>

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
                            RM 9a
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold"> TRANSFER PASIEN ANTAR UNIT PELAYANAN
                        </p>
                    </div>
                </div>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td>
                            <b>Dikirim Ke unit :</b> <?= $data->rm9aTransferPasien["keUnit"] ?? '..............' ?>
                        </td>
                        <td>
                            <b>Dari Unit :</b> <?= $data->rm9aTransferPasien["dariUnit"] ?? '..............' ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tgl :</b> <?= !empty($data->rm9aTransferPasien["waktu"]) ? date('d-m-Y', strtotime($data->rm9aTransferPasien["waktu"])) : '--/--/----' ?>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <b>Jam :</b> <?= !empty($data->rm9aTransferPasien["waktu"]) ? date('H:i', strtotime($data->rm9aTransferPasien["waktu"])) : '--:--' ?> WIB
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Dokter Penanggung Jawab
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["dokter"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td style="width:40%;">
                            1. Metode Pemindahan
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["metodePindah"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td>
                            2. Indikasi Pindah
                        </td>
                        <td>:
                            <?php
                            $indikasiList = json_decode($data->rm9aTransferPasien["indikasiPindah"] ?? '', true);

                            if (!empty($indikasiList) && is_array($indikasiList)) {
                                $indikasiList = array_map(function ($item) use ($data) {
                                    if ($item === 'Lain-Lain' || $item === 'Lain – Lain') {
                                        return !empty($data->rm9aTransferPasien["isiIndikasiLainnya"])
                                            ? $data->rm9aTransferPasien["isiIndikasiLainnya"]
                                            : 'Lain-Lain';
                                    }
                                    return $item;
                                }, $indikasiList);

                                echo implode(', ', $indikasiList);
                            } else {
                                echo '..............';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3. Diagnosa Medis
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["diagnosa"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td>
                            4. Tindakan yang sudah dilakukan
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["tindakan"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td>
                            5. Obat-obatan yang diberikan
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["obat"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td>
                            6. Pemeriksaan penunjang yang sudah dilakukan
                        </td>
                        <td>: <?= $data->rm9aTransferPasien["pemeriksaan"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td>
                            7. Penggunaan Alat Medis
                        </td>
                        <td>:
                            <?php
                            $alatList = json_decode($data->rm9aTransferPasien["alatMedis"] ?? '', true);

                            if (!empty($alatList) && is_array($alatList)) {
                                echo implode(', ', $alatList);
                            } else {
                                echo '..............';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            8. Bila pemberi persetujuan adalah keluarga / penanggung jawab pasien. <br>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b>Nama :</b> <?= $data->rm9aTransferPasien["nama"] ?? '..............' ?>. &nbsp;&nbsp;&nbsp;&nbsp; <b>Hubungan :</b> <?= $data->rm9aTransferPasien["sebagai"] ?? '..............' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            9. Pasien / keluarga mengetahui dan menyetujui alasan pemindahan : <?= $data->rm9aTransferPasien["setuju"] ?? '..............' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            10. Dokter Penanggung Jawab
                        </td>
                        <td>
                            : <?= $data->rm9aTransferPasien["dokter"] ?? '..............' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            11. Keadaan pasien saat pindah sebelum transfer :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-0">
                            <table class="table table-sm table-bordered m-0">
                                <tr>
                                    <td class="w-50 ps-3">
                                        <b>K/U :</b> <?= !empty($data->rm9aTransferPasien["keadaanKU"]) ? $data->rm9aTransferPasien["keadaanKU"] : '....' ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>TD :</b> <?= !empty($data->rm9aTransferPasien["keadaanTD"]) ? $data->rm9aTransferPasien["keadaanTD"] : '....' ?> mmHg &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>N :</b> <?= !empty($data->rm9aTransferPasien["keadaanN"]) ? $data->rm9aTransferPasien["keadaanN"] : '....' ?> x/mnt<br><br>

                                        <b>S :</b> <?= !empty($data->rm9aTransferPasien["keadaanS"]) ? $data->rm9aTransferPasien["keadaanS"] : '....' ?> &deg;C &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>CRT :</b> <?= !empty($data->rm9aTransferPasien["keadaanCRT"]) ? $data->rm9aTransferPasien["keadaanCRT"] : '....' ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>RR :</b> <?= !empty($data->rm9aTransferPasien["keadaanRR"]) ? $data->rm9aTransferPasien["keadaanRR"] : '....' ?> x/mnt<br><br>

                                        <b>Lain – Lain :</b> <?= !empty($data->rm9aTransferPasien["keadaanLainLain"]) ? $data->rm9aTransferPasien["keadaanLainLain"] : '....' ?><br><br>
                                    </td>
                                    <td>
                                        <b>Keluhan utama :</b> <br>
                                        <?= $data->rm9aTransferPasien["keluhanUtama"] ?? '..............' ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            12. Keadaan pasien saat pindah setelah transfer :
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="p-0">
                            <table class="table table-sm table-bordered m-0">
                                <tr>
                                    <td class="w-50 ps-3">
                                        <b>K/U :</b> <?= !empty($data->rm9aTransferPasien["keadaanKU2"]) ? $data->rm9aTransferPasien["keadaanKU2"] : '....' ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>TD :</b> <?= !empty($data->rm9aTransferPasien["keadaanTD2"]) ? $data->rm9aTransferPasien["keadaanTD2"] : '....' ?> mmHg &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>N :</b> <?= !empty($data->rm9aTransferPasien["keadaanN2"]) ? $data->rm9aTransferPasien["keadaanN2"] : '....' ?> x/mnt<br><br>

                                        <b>S :</b> <?= !empty($data->rm9aTransferPasien["keadaanS2"]) ? $data->rm9aTransferPasien["keadaanS2"] : '....' ?> &deg;C &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>CRT :</b> <?= !empty($data->rm9aTransferPasien["keadaanCRT2"]) ? $data->rm9aTransferPasien["keadaanCRT2"] : '....' ?> &nbsp;&nbsp;&nbsp;&nbsp;
                                        <b>RR :</b> <?= !empty($data->rm9aTransferPasien["keadaanRR2"]) ? $data->rm9aTransferPasien["keadaanRR2"] : '....' ?> x/mnt<br><br>

                                        <b>Lain – Lain :</b> <?= !empty($data->rm9aTransferPasien["keadaanLainLain2"]) ? $data->rm9aTransferPasien["keadaanLainLain2"] : '....' ?><br><br>
                                    </td>
                                    <td>
                                        <b>Keluhan utama :</b> <br>
                                        <?= $data->rm9aTransferPasien["keluhanUtama2"] ?? '..............' ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="p-0" colspan="2">
                            <table class="table table-sm table-bordered m-0 text-center">
                                <tr>
                                    <td class="w-50">Menyerahkan : <br>
                                        Petugas / Perawat
                                        <div id="qrPetugasMenyerahkan" class="p-2"></div>

                                        (<?= $data->rm9aTransferPasien["petugasMenyerahkan"] ?? '..............' ?>)
                                    </td>
                                    <td>Menerima : <br>
                                        Petugas / Perawat

                                        <div id="qrPetugasMenerima" class="p-2"></div>
                                        (<?= $data->rm9aTransferPasien["petugasMenerima"] ?? '..............' ?>)
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    // Create a new QRCode instance
    var qrPetugasMenyerahkan = new QRCode(document.getElementById("qrPetugasMenyerahkan"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });
    var qrPetugasMenerima = new QRCode(document.getElementById("qrPetugasMenerima"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrPetugasMenyerahkan.makeCode("Di ttd <?= $data->rm9aTransferPasien["petugasMenyerahkan"] ?? '..............' ?> untuk Tata Tertib. No Rawat :  <?= $data->rm9aTransferPasien["noRawat"] ?? '..............' ?>"); // Replace with your desired text or URL
    qrPetugasMenerima.makeCode("Di ttd <?= $data->rm9aTransferPasien["petugasMenerima"] ?? '..............' ?> untuk Tata Tertib. No Rawat :  <?= $data->rm9aTransferPasien["noRawat"] ?? '..............' ?>"); // Replace with your desired text or URL
</script>

</html>