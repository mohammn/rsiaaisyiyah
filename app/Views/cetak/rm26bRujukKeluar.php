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
    <title>Cetak Penyimpanan Barang</title>

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
                            RM 26b
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold">TRANSFER / RUJUK KE RUMAH SAKIT LAIN
                        </p>
                    </div>
                </div>
                Ringkasan Pasien Yang Dilakukan Transfer/ Rujukan Ke Rumah Sakit Lain

                <table class="table table-bordered table-sm">
                    <tr>
                        <td>Dari Unit</td>
                        <td>: <?= $data->rm26bRujukKeluar['unit'] ?? '' ?></td>
                        <td>Ke Rumah Sakit</td>
                        <td>: <?= $data->rm26bRujukKeluar['rs'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Petugas yg Kontak</td>
                        <td>: <?= $data->rm26bRujukKeluar['petugas'] ?? '' ?></td>
                        <td>Petugas yg Menerima</td>
                        <td>: <?= $data->rm26bRujukKeluar['petugasDihubungi'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal dan Jam</td>
                        <td>: <?= $data->rm26bRujukKeluar['waktuMenghubungi'] ? date('d-m-Y H:i', strtotime($data->rm26bRujukKeluar['waktuMenghubungi'])) : '' ?></td>
                        <td>No. Telp</td>
                        <td>: <?= $data->rm26bRujukKeluar['noPetugasDihubungi'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Ambulance berangkat jam</td>
                        <td>: <?= $data->rm26bRujukKeluar['jamBerangkat'] ? date('d-m-Y H:i', strtotime($data->rm26bRujukKeluar['jamBerangkat'])) : '' ?></td>
                        <td>Tiba di RS tujuan</td>
                        <td>: <?= $data->rm26bRujukKeluar['jamTiba'] ? date('d-m-Y H:i', strtotime($data->rm26bRujukKeluar['jamTiba'])) : '' ?></td>
                    </tr>
                    <tr>
                        <td>Alasan Merujuk</td>
                        <td colspan="3">: <?= $data->rm26bRujukKeluar['alasanRujuk'] ?? '' ?> : <?= $data->rm26bRujukKeluar['alasanRujuk'] == 'Klinikal' ? $data->rm26bRujukKeluar['isiKlinikal'] : $data->rm26bRujukKeluar['isiNonKlinikal'] ?> </td>
                    </tr>
                    <tr>
                        <td>Diagnosa Medis</td>
                        <td colspan="3">: <?= $data->rm26bRujukKeluar['diagnosa'] ?? '' ?> </td>
                    </tr>
                    <tr>
                        <td>Dokter yg Merujuk</td>
                        <td colspan="3">: <?= $data->rm26bRujukKeluar['dokter'] ?? '' ?> </td>
                    </tr>
                </table>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="3" class="text-center fw-bold">CATATAN KLINIS</td>
                    </tr>
                    <tr>
                        <td>1.</td>
                        <td style="width: 30%;">Alergi</td>
                        <td>: <?= $data->rm26bRujukKeluar['alergi'] == 'Ya' ? 'Ya, : ' . $data->rm26bRujukKeluar['isiAlergi'] : 'Tidak'  ?></td>
                    </tr>
                    <tr>
                        <td>2.</td>
                        <td>Riwayat Penyakit Sekarang</td>
                        <td>: <?= $data->rm26bRujukKeluar['riwayatPenyakit'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>3.</td>
                        <td>Riwayat Penyakit Dahulu</td>
                        <td>: <?= $data->rm26bRujukKeluar['penyakit'] == 'Ada' ? 'Ada, : ' . $data->rm26bRujukKeluar['isiPenyakit'] : 'Tidak'  ?></td>
                    </tr>
                    <tr>
                        <td>4.</td>
                        <td>Riwayat Penggunaan Obat</td>
                        <td>: <?= $data->rm26bRujukKeluar['riwayatObat'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>5.</td>
                        <td>Kondisi Pasien Saat ini.</td>
                        <td>
                            : Kesadaran : <?= $data->rm26bRujukKeluar['kesadaran'] ?: '............' ?>
                            GCS : E <?= $data->rm26bRujukKeluar['gcs_e'] ?: '.......' ?>
                            V <?= $data->rm26bRujukKeluar['gcs_v'] ?: '.......' ?>
                            M <?= $data->rm26bRujukKeluar['gcs_m'] ?: '.......' ?>
                            Pupil : <?= $data->rm26bRujukKeluar['pupil_kanan'] ?: '.......' ?> / <?= $data->rm26bRujukKeluar['pupil_kiri'] ?: '.......' ?> mm
                            <br>
                            Reflek cahaya: <?= $data->rm26bRujukKeluar['reflek_cahaya_kanan'] ?: '.......' ?> / <?= $data->rm26bRujukKeluar['reflek_cahaya_kiri'] ?: '.......' ?>
                            SpO2: <?= $data->rm26bRujukKeluar['spo2'] ?: '.......' ?> %
                            TD : <?= $data->rm26bRujukKeluar['td_sistole'] ?: '.......' ?> / <?= $data->rm26bRujukKeluar['td_diastole'] ?: '.......' ?> mmHg
                            <br>
                            Nadi : <?= $data->rm26bRujukKeluar['nadi'] ?: '.......' ?> x/mnt
                            t: <?= $data->rm26bRujukKeluar['suhu'] ?: '.......' ?> &deg;C
                            Rr : <?= $data->rm26bRujukKeluar['rr'] ?: '.......' ?> x/mnt
                            BB Saat ini : <?= $data->rm26bRujukKeluar['bb'] ?: '.......' ?> Kg
                            <br>
                            TB : <?= $data->rm26bRujukKeluar['tb'] ?: '.......' ?> Cm
                        </td>
                    </tr>
                    <tr>
                        <td>6.</td>
                        <td>Kapan Intak Oral Terakhir</td>
                        <td>: <?= $data->rm26bRujukKeluar['waktuIntake'] ? date('d-m-Y H:i', strtotime($data->rm26bRujukKeluar['waktuIntake'])) : '' ?></td>
                    </tr>
                    <tr>
                        <td>7.</td>
                        <td>Pemeriksaan Penunjang</td>
                        <td>: <?= $data->rm26bRujukKeluar['pemeriksaanPenunjang'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td rowspan="2">8.</td>
                        <td>Pengobatan dan Tindakan</td>
                        <td>Jam</td>
                    </tr>
                    <tr>
                        <td>
                            <?php for ($i = 0; $i < count($data->rm26bRujukKeluarData); $i++) : ?>
                                <?= ($i + 1) . '. ' . $data->rm26bRujukKeluarData[$i]["namaTindakan"] ?> <br>
                            <?php endfor; ?>
                        </td>
                        <td>
                            <?php for ($i = 0; $i < count($data->rm26bRujukKeluarData); $i++) : ?>
                                <?= $data->rm26bRujukKeluarData[$i]['waktuTindakan'] ? date('d-m-Y H:i', strtotime($data->rm26bRujukKeluarData[$i]['waktuTindakan'])) : '' ?> <br>
                            <?php endfor; ?>
                        </td>
                    </tr>
                    <?php
                    $alatArray = json_decode($data->rm26bRujukKeluar['alat'] ?? '[]', true) ?: [];
                    $keyLainnya = array_search('Lainnya', $alatArray);
                    if ($keyLainnya !== false) {
                        $alatArray[$keyLainnya] = $data->rm26bRujukKeluar['isiAlatLainnya'] ?: 'Lainnya (...)';
                    }
                    $teksAlat = implode(', ', $alatArray);
                    ?>
                    <tr>
                        <td>9.</td>
                        <td>Pasien Memakai Peralatan Medis</td>
                        <td>: <?= $data->rm26bRujukKeluar['peralatan'] === 'Ya' ? 'Ya, : ' . ($teksAlat ?? '-') : 'Tidak' ?></td>
                    </tr>
                    <tr>
                        <td>10.</td>
                        <td>Perawatan Pasien Lanjutan Yang Dibutuhkan
                        </td>
                        <td>: <?= $data->rm26bRujukKeluar['perawatanLanjutan'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            KET : Kondisi saat pasien dirujuk selama perjalanan (tercantum pada lembar observasi pasien khusus)
                        </td>
                    </tr>
                </table>



                <br><br>


                <div class="row text-center mt-1">
                    <div class="col-12 text-start pe-5">
                        Bangkalan, <?= $data->rm26bRujukKeluar['tglTtd'] ?>
                    </div>
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                                Dokter yg Merujuk
                                <br>
                                <br>
                                <div id="qrDokter" class="pt-2"></div>
                                <br>
                                (<?= $data->rm26bRujukKeluar["dokter"] ?? '' ?> )
                                <br><br>
                            </td>
                            <td>
                                Petugas yg Melakukan Rujukan
                                <br>
                                <br>
                                <div id="qrPetugas" class="pt-2"></div>
                                <br>
                                (<?= $data->rm26bRujukKeluar["petugas"] ?? '' ?> )
                            </td>
                            <td>
                                Petugas yg Menerima Rujukan
                                <br><br><br><br><br><br><br><br><br><br>
                                (<?= $data->rm26bRujukKeluar["petugasDihubungi"] ?: ' .................................... ' ?> )
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="noRawat" value="<?= $data->rm26bRujukKeluar["noRawat"] ?>">
                    <input type="hidden" id="petugas" value="<?= $data->rm26bRujukKeluar["petugas"] ?>">
                    <input type="hidden" id="dokter" value="<?= $data->rm26bRujukKeluar["dokter"] ?>">

                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    // Create a new QRCode instance
    var qrDokter = new QRCode(document.getElementById("qrDokter"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrDokter.makeCode("Di ttd " + $("#dokter").val() + " untuk Penyimpanan Barang. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

    var qrPetugas = new QRCode(document.getElementById("qrPetugas"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrPetugas.makeCode("Di ttd " + $("#petugas").val() + " untuk Penyimpanan Barang. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL
</script>

</html>