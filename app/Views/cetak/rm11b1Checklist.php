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
    <title>RM 11b.1 Cheklist keselamatan</title>

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
                            RM 11b.1
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold">
                            CHECKLIST KESELAMATAN DI KAMAR BEDAH <br>
                            <i>(SURGICAL SAFETY CHECKLIST)</i>
                        </p>
                    </div>
                </div>

                <table class="table table-sm table-bordered text-start mb-0">
                    <tr>
                        <td>
                            Ruang Rawat
                        </td>
                        <td colspan="2">: <?= $data->rm11b1Checklist["ruang"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>
                            Tanggal
                        </td>
                        <td colspan="2">: <?= $data->rm11b1Checklist["tgl"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <th class="text-center">
                            <i>SIGN IN</i>(Jam : <?= $data->rm11b1Checklist["jamSignIn"] ?? '--:--' ?> WIB)
                            <br>(Di Ruang Persiapan)
                        </th>
                        <th class="text-center">
                            <i>TIME OUT</i>(Jam : <?= $data->rm11b1Checklist["jamTimeOut"] ?? '--:--' ?> WIB)
                            <br>(Sebelum Insisi)
                        </th>
                        <th class="text-center">
                            <i>SIGN OUT</i>(Jam : <?= $data->rm11b1Checklist["jamSignOut"] ?? '--:--' ?> WIB)
                            <br>(Sebelum Keluar Kamar Operasi)
                        </th>
                    </tr>
                    <tr>
                        <td class="text-center small">Dilakukan oleh Perawat dan DOkter Anestesi</td>
                        <td class="text-center small">Dilakukan oleh Perawat Sirkuler dan Perawat Anestesi</td>
                        <td class="text-center small">Dilakukan oleh Perawat Sirkuler, Dokter Operator, dan Dokter Anestesi</td>
                    </tr>
                    <tr style="font-size: 12px;">
                        <td>
                            <div>
                                <b><u>VERIFIKASI</u></b>
                                <?php
                                // 1. Ambil data verifikasi (Array Checkbox)
                                $verifikasi = [];
                                if (!empty($data->rm11b1Checklist['verifikasi'])) {
                                    $decodedAlasan = json_decode($data->rm11b1Checklist['verifikasi'], true);
                                    $verifikasi = is_array($decodedAlasan) ? $decodedAlasan : [];
                                }

                                // 2. Ambil data pendamping dari DB
                                $dokterBedah           = $data->rm11b1Checklist['dokterBedah'] ?? '';
                                $dokterAnestesi        = $data->rm11b1Checklist['dokterAnestesi'] ?? '';
                                $namaTindakan          = $data->rm11b1Checklist['namaTindakan'] ?? '';
                                $pemberianTandaPilihan = $data->rm11b1Checklist['pemberian_tanda_pilihan'] ?? '';

                                // Helper function untuk centang
                                function isChecked($val, $array)
                                {
                                    return in_array($val, $array) ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                }

                                function isRadioChecked($val, $targetVal)
                                {
                                    return ($val === $targetVal) ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                }
                                ?>

                                <div style="font-size:10px;">
                                    <!-- Helper Function untuk Tampilan Checkbox Sederhana -->
                                    <?php
                                    if (!function_exists('renderBox')) {
                                        function renderBox($condition)
                                        {
                                            return $condition ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                        }
                                    }
                                    ?>

                                    <!-- 1. Identitas dan gelang pasien -->
                                    <div>
                                        <span><?= renderBox(in_array('Identitas dan gelang pasien', $verifikasi)) ?></span> Identitas dan gelang pasien
                                    </div>

                                    <!-- 2. Informed consent & Sub-Paketnya -->
                                    <div>
                                        <span><?= renderBox(in_array('Informed consent', $verifikasi)) ?></span> Informed consent
                                    </div>

                                    <!-- Sub-paket Informed consent -->
                                    <div style="padding-left:20px;">
                                        <div>
                                            <span><?= renderBox(in_array('Dokter Bedah', $verifikasi)) ?></span> Dokter Bedah : <?= htmlspecialchars($dokterBedah ?? '-') ?>
                                        </div>
                                        <div>
                                            <span><?= renderBox(in_array('Dokter anestesi', $verifikasi)) ?></span> Dokter anestesi : <?= htmlspecialchars($dokterAnestesi ?? '-') ?>
                                        </div>
                                        <div>
                                            <span><?= renderBox(in_array('Nama Tindakan', $verifikasi)) ?></span> Nama Tindakan : <?= htmlspecialchars($namaTindakan ?? '-') ?>
                                        </div>
                                    </div>

                                    <!-- 3. Pemberian tanda dilokasi operasi -->
                                    <div>
                                        <span><?= renderBox(in_array('Pemberian tanda dilokasi operasi', $verifikasi)) ?></span> Pemberian tanda dilokasi operasi :
                                    </div>

                                    <!-- Sub-paket Ya / Tidak -->
                                    <div style="padding-left:20px;">
                                        <?= $pemberianTandaPilihan ?? '' ?>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-1">
                                <b><u>DIAGNOSA PASIEN :</u></b>
                                <p class="mb-0"><?= $data->rm11b1Checklist["diagnosa"] ?? '.................................' ?></p>
                            </div>

                            <div class="mt-1">
                                <b><u>PEMERIKSAAN KELENGKAPAN PASIEN :</u></b>
                                <?php
                                // 1. Decode data JSON kelengkapan pasien
                                $kelengkapan = [];
                                if (!empty($data->rm11b1Checklist['kelengkapan'])) {
                                    $decodedKelengkapan = json_decode($data->rm11b1Checklist['kelengkapan'], true);
                                    $kelengkapan = is_array($decodedKelengkapan) ? $decodedKelengkapan : [];
                                }

                                // 2. Daftar opsi kelengkapan pasien
                                $masterKelengkapan = [
                                    'Mesin anestesi',
                                    'IV Line',
                                    'Obat – obatan',
                                    'Laboratorium'
                                ];

                                // Helper function untuk menentukan centang [✔] atau kotak kosong [ ]
                                function renderCheckbox($val, $array)
                                {
                                    // Memeriksa keberadaan string di dalam array (mendukung perbandingan toleran unicode)
                                    $isChecked = false;
                                    foreach ($array as $item) {
                                        if (trim($item) === trim($val)) {
                                            $isChecked = true;
                                            break;
                                        }
                                    }

                                    return $isChecked ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                }
                                ?>

                                <div style="font-size: 10px;">
                                    <?php foreach ($masterKelengkapan as $item): ?>
                                        <div>
                                            <span><?= renderCheckbox($item, $kelengkapan) ?></span> <?= htmlspecialchars($item) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <div class="mt-1">
                                <b><u>PEMERIKSAAN TANDA VITAL :</u></b>

                                <table class="table table-sm table-striped tabel mb-0" style="font-size: 10px;">
                                    <tr>
                                        <td>Kesadaran</td>
                                        <td>: <?= $data->rm11b1Checklist["kesadaran"] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tekanan Darah</td>
                                        <td>: <?= $data->rm11b1Checklist["tekananDarah"] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Nadi</td>
                                        <td>: <?= $data->rm11b1Checklist["nadi"] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saturasi Oksigen</td>
                                        <td>: <?= $data->rm11b1Checklist["saturasiOksigen"] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Suhu</td>
                                        <td>: <?= $data->rm11b1Checklist["suhu"] ?? '-' ?></td>
                                    </tr>
                                    <tr>
                                        <td>Skala Nyeri</td>
                                        <td>: <?= $data->rm11b1Checklist["skalaNyeri"] ?? '-' ?></td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-1">
                                <b><u>RIWAYAT ALERGI :</u></b>
                                <br>
                                <p class="mb-0" style="font-size: 10px;"><?= ($data->rm11b1Checklist["alergi"] ?? '') === 'Ada' ? 'Ada, Sebutkan : ' . ($data->rm11b1Checklist["isiAlergi"] ?? '-') : ($data->rm11b1Checklist["alergi"] ?? '-') ?></p>
                            </div>

                            <div class="mt-1">
                                <b><u>RISIKO ASPIRASI DAN GANGGUAN PERNAFASAN :</u></b>
                                <br>
                                <p class="mb-0" style="font-size: 10px;"><?= ($data->rm11b1Checklist["aspirasi"] ?? '') ?></p>
                            </div>

                            <div class="mt-2">
                                <b><u>RISIKO ASPIRASI DAN GANGGUAN PERNAFASAN :</u></b>
                                <br>
                                <small class="fw-bold">Kehilangan darah &gt; 500 ml :</small>
                                <p class="mb-0" style="font-size: 10px;"><?= ($data->rm11b1Checklist["pendrahan"] ?? '') === 'Ya' ? 'Ya, (satu IV line/CVP)' : ($data->rm11b1Checklist["pendrahan"] ?? '') ?></p>
                            </div>

                            <div class="mt-2">
                                <b><u>RENCANA ANESTESI :</u></b>
                                <br>
                                <p class="mb-0" style="font-size: 10px; margin: 0;">
                                    <?php
                                    $rencana = json_decode($data->rm11b1Checklist["rencanaAnestesi"] ?? '[]', true);

                                    if (is_array($rencana) && !empty($rencana)) {
                                        echo implode(', ', array_map('htmlspecialchars', $rencana));
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                                </p>
                            </div>
                        </td>

                        <!-- ============================ -->

                        <td style="width: 34%;">
                            <div>
                                <b><u>BACA SECARA VERBAL</u></b>
                                <?php
                                $verbal1 = [];
                                if (!empty($data->rm11b1Checklist['verbal1'])) {
                                    $decodeVerbal1 = json_decode($data->rm11b1Checklist['verbal1'], true);
                                    $verbal1 = is_array($decodeVerbal1) ? $decodeVerbal1 : [];
                                }

                                // Helper function sederhana jika belum didefinisikan di atas file
                                if (!function_exists('renderBox')) {
                                    function renderBox($condition)
                                    {
                                        return $condition ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                    }
                                }

                                // Daftar item sesuai gambar
                                $itemsVerbal = [
                                    'Tanggal tindakan',
                                    'Nama tindakan',
                                    'Lokasi tindakan',
                                    'Identitas pasien',
                                    'Prosedur tindakan',
                                    'Informed consent',
                                    'Konfirmasi seluruh anggota tim'
                                ];
                                ?>

                                <div style="margin-top: 5px; font-size: 10px;">
                                    <?php foreach ($itemsVerbal as $item): ?>
                                        <div>
                                            <span><?= renderBox(in_array($item, $verbal1)) ?></span> <?= htmlspecialchars($item) ?>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>


                            <div class="mt-2">
                                <b><u>KELENGKAPAN TIM DAN FASILITAS OPERASI</u></b>
                                <p style="font-size: 10px;">
                                    <?= $data->rm11b1Checklist["fasilitasOperasi"] ?? '-' ?>
                                </p>
                            </div>

                            <div class="mt-2">
                                <b><u>ANTIBIOTIK PROPHYLAXYS</u></b>
                                <small class="fw-bold">Apakah diberikan dalam waktu kurang dari 60 menit :</small> <br>
                                <?= ($data->rm11b1Checklist["profilaksis"] ?? '') == 'Ya'
                                    ? 'Ya. <div style="padding-left:20px; font-size:10px;">Nama Obat : ' . ($data->rm11b1Checklist["profilaksisObat"] ?? '-') .
                                    '<br>Dosis Obat : ' . ($data->rm11b1Checklist["profilaksisDosis"] ?? '-') .
                                    '<br>Jam diberikan : ' . ($data->rm11b1Checklist["profilaksisJam"] ?? '--:-- WIB</div>')
                                    : ($data->rm11b1Checklist["profilaksis"] ?? '-') ?>

                            </div>

                            <div class="mt-2">
                                <b><u>ANTISIPASI KEJADIAN KRITIS</u></b>
                                <ul style="font-size: 10px;" class="ps-3">
                                    <li>
                                        <b>Bagian Bedah :</b> Langkah apa yang
                                        dilakukan bila kondisi kritis atau
                                        kejadian yang tidak diharapkan
                                        pemanjangan lamanya operasi dan
                                        antisipasi kehilangan darah ? <br>
                                        <u><?= $data->rm11b1Checklist["antisipasi1"] ?? '........................' ?></u>
                                    </li>
                                    <li>
                                        <b>Bagian Anestesi :</b> Apakah ada hal
                                        khusus yang perlu diperhatikan pada
                                        pasien ? <br>
                                        <u><?= $data->rm11b1Checklist["antisipasi2"] ?? '........................' ?></u>
                                    </li>
                                    <li>
                                        <b>Bagian Perawat :</b>
                                        Indikator Steril : <br>
                                        <u><?= $data->rm11b1Checklist["antisipasi31"] ?? '-' ?></u> <br>
                                        Masalah Pada Instrument : <br>
                                        <u><?= $data->rm11b1Checklist["antisipasi32"] ?? '-' ?></u> <br>
                                        Adakah alat khusus : <br>
                                        <u><?= $data->rm11b1Checklist["antisipasi33"] ?? '-' ?></u> <br>
                                    </li>
                                </ul>
                            </div>
                        </td>

                        <!-- =================================== -->
                        <td>
                            <div>
                                <b><u>BACA SECARA VERBAL :</u></b>
                                <p style="font-size: 10px;"><?= !empty($data->rm11b1Checklist["verbal2"]) ? '&#10004;' : '[&nbsp;&nbsp;&nbsp;]' ?>Nama tindakan : <?= ($data->rm11b1Checklist["verbal2"] ?? '-') ?></p>
                            </div>


                            <div class="mt-2">
                                <b><u>PERIKSA KELENGKAPAN SEBELUM LUKA OPERASI DITUTUP :</u></b>
                                <?php
                                $kelengkapanOperasi = [];
                                if (!empty($data->rm11b1Checklist['kelengkapanOperasi'])) {
                                    $decodekelengkapanOperasi = json_decode($data->rm11b1Checklist['kelengkapanOperasi'], true);
                                    $kelengkapanOperasi = is_array($decodekelengkapanOperasi) ? $decodekelengkapanOperasi : [];
                                }

                                // Helper function untuk cetak centang
                                if (!function_exists('renderBox')) {
                                    function renderBox($condition)
                                    {
                                        return $condition ? '[&#10004;]' : '[&nbsp;&nbsp;&nbsp;]';
                                    }
                                }

                                // Ambil data untuk kolom Lainnya
                                $isiLainnya = !empty($data->rm11b1Checklist['isiKelengkapanLainnya'])
                                    ? $data->rm11b1Checklist['isiKelengkapanLainnya']
                                    : '...........';
                                ?>

                                <table class="table table-sm table-striped" style="font-size: 10px; width: 100%;">
                                    <!-- Baris 1 -->
                                    <tr>
                                        <td style="width: 50%;">
                                            <span><?= renderBox(in_array('Instrumen', $kelengkapanOperasi)) ?></span> Instrumen
                                        </td>
                                        <td style="width: 50%;">
                                            <span><?= renderBox(in_array('Spon', $kelengkapanOperasi)) ?></span> Spon
                                        </td>
                                    </tr>
                                    <!-- Baris 2 -->
                                    <tr>
                                        <td>
                                            <span><?= renderBox(in_array('Kassa', $kelengkapanOperasi)) ?></span> Kassa
                                        </td>
                                        <td>
                                            <span><?= renderBox(in_array('Depper', $kelengkapanOperasi)) ?></span> Depper
                                        </td>
                                    </tr>
                                    <!-- Baris 3 -->
                                    <tr>
                                        <td>
                                            <span><?= renderBox(in_array('Jarum', $kelengkapanOperasi)) ?></span> Jarum
                                        </td>
                                        <td>
                                            <span><?= renderBox(in_array('Lainnya', $kelengkapanOperasi)) ?></span> Lainnya : <?= htmlspecialchars($isiLainnya) ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <div class="mt-2">
                                <b><u>PERIKSA KELENGKAPAN BAHAN PEMERIKSAAN :</u></b>
                                <ol type="a" class="ps-3">
                                    <li>
                                        Preparat : <u><?= $data->rm11b1Checklist["preparat"] ?? '-' ?></u>
                                    </li>
                                    <li>
                                        Jenis : <u>
                                            <?php
                                            // 1. Decode JSON jenis
                                            $jenisList = json_decode($data->rm11b1Checklist["jenis"] ?? '[]', true);

                                            if (is_array($jenisList) && !empty($jenisList)) {
                                                // Ambil nilai kustom jika 'Lainnya' dipilih
                                                $isiLainnya = !empty($data->rm11b1Checklist["isijenisLainnya"])
                                                    ? $data->rm11b1Checklist["isijenisLainnya"]
                                                    : 'Lainnya';

                                                // 2. Map array: ganti 'Lainnya' dengan isi $isiLainnya
                                                $formattedList = array_map(function ($item) use ($isiLainnya) {
                                                    if (trim($item) === 'Lainnya') {
                                                        return $isiLainnya;
                                                    }
                                                    return $item;
                                                }, $jenisList);

                                                // 3. Cetak dipisah koma
                                                echo htmlspecialchars(implode(', ', $formattedList));
                                            } else {
                                                echo '-';
                                            }
                                            ?>
                                        </u>
                                    </li>
                                    <li>
                                        Formulir : <u><?= $data->rm11b1Checklist["formulir"] ?? '-' ?></u>
                                    </li>
                                    <li>
                                        Telah dilengkapi identitas Pasien : <u><?= $data->rm11b1Checklist["lengkapiIdentitas"] ?? '-' ?></u>
                                    </li>
                                </ol>
                            </div>

                            <div class="mt-2">
                                <b><u>PERHATIAN KHUSUS UNTUK PASIEN :</u></b>
                                <ol class="ps-3" type="a">
                                    <li>
                                        Dari Operator : <br>
                                        <u><?= $data->rm11b1Checklist["perhatianOperator"] ?? '..........................' ?></u>
                                    </li>
                                    <li>
                                        Dari Dokter : <br>
                                        <u><?= $data->rm11b1Checklist["perhatianDokter"] ?? '..........................' ?></u>
                                    </li>
                                    <li>
                                        Dari Perawat : <br>
                                        <u><?= $data->rm11b1Checklist["perhatianPerawat"] ?? '..........................' ?></u>
                                    </li>
                                </ol>
                            </div>

                            <div class="mt-2">
                                <b><u>APAKAH PASIEN SUDAH BISA PINDAH KE RUANG PEMULIHAN :</u></b>
                                <p style="font-size: 10px;"><?= $data->rm11b1Checklist["ruangPemulihan"] ?? '-' ?></p>
                            </div>

                            <div class="mt-2">
                                <b><u>PERIKSA KEMBALI LUKA OPERASI :</u></b>
                                <p style="font-size: 10px;"><?= $data->rm11b1Checklist["periksaKembali"] ?? '-' ?></p>
                            </div>

                            <div class="mt-2">
                                <b><u>INSTRUKSI KHUSUS :</u></b>
                                <p style="font-size: 10px;"><?= $data->rm11b1Checklist["instruksiKhusus"] ?? '...................................' ?></p>
                            </div>

                        </td>
                    </tr>
                    <tr style="font-size: 10px;">
                        <td class="p-0">
                            <table class="table table-sm table-borderless mb-0 text-center">
                                <tr>
                                    <td style="width: 50%;">Perawat Anestesi</td>
                                    <td>dr. Anestesi</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="ttdPerawatAnestesi">
                                            <?php if ($data->rm11b1Checklist["ttdPerawatAnestesi"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdPerawatAnestesi"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["perawatAnestesi"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdPerawatAnestesi"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPerawatAnestesi">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div id="ttdDokterAnestesi1">
                                            <?php if ($data->rm11b1Checklist["ttdDokterAnestesi1"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdDokterAnestesi1"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["dokterAnestesi"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdDokterAnestesi1"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokterAnestesi1">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class=" p-0">
                            <table class="table table-sm table-borderless mb-0 text-center">
                                <tr>
                                    <td style="width: 50%;">Sirkuler</td>
                                    <td>Instrumen</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="ttdSirkuler">
                                            <?php if ($data->rm11b1Checklist["ttdSirkuler"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdSirkuler"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["sirkuler"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdSirkuler"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdSirkuler">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div id="ttdInstrumen">
                                            <?php if ($data->rm11b1Checklist["ttdInstrumen"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdInstrumen"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["instrumen"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdInstrumen"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdInstrumen">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td class="p-0">
                            <table class="table table-sm table-borderless mb-0 text-center">
                                <tr>
                                    <td style="width: 33.3%;">Asisten</td>
                                    <td style="width: 33.3%;">dr. Operator</td>
                                    <td>dr. Anestesi</td>
                                </tr>
                                <tr>
                                    <td>
                                        <div id="ttdAsisten">
                                            <?php if ($data->rm11b1Checklist["ttdAsisten"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdAsisten"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["asisten"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdAsisten"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdAsisten">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div id="ttdOperator">
                                            <?php if ($data->rm11b1Checklist["ttdOperator"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdOperator"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["operator"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdOperator"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdOperator">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <div id="ttdDokterAnestesi2">
                                            <?php if ($data->rm11b1Checklist["ttdDokterAnestesi2"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/rm11b1Checklist/' . $data->rm11b1Checklist["ttdDokterAnestesi2"]) . '" alt="tanda tangan Dokter" style="max-width: 75px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->rm11b1Checklist["drAnestesi"] ?? '-' ?> )
                                        <br><br>
                                        <?php if (!$data->rm11b1Checklist["ttdDokterAnestesi2"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokterAnestesi2">
                                                TTD
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>


                <input type="hidden" id="noRawat" value="<?= $data->rm11b1Checklist["noRawat"] ?>">

                <div class="row mt-2">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php
                        // Ambil objek/array RM11B1 Checklist
                        $ttd = $data->rm11b1Checklist;

                        // Cek apakah ADA SALAH SATU TTD yang masih kosong
                        if (
                            !$ttd["ttdPerawatAnestesi"] ||
                            !$ttd["ttdDokterAnestesi1"] ||
                            !$ttd["ttdSirkuler"] ||
                            !$ttd["ttdInstrumen"] ||
                            !$ttd["ttdAsisten"] ||
                            !$ttd["ttdOperator"] ||
                            !$ttd["ttdDokterAnestesi2"]
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


<!-- Modal ttdPerawatAnestesi-->
<div class="modal fade" id="modalTtdPerawatAnestesi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Perawat Anestesi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPerawatAnestesi" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPerawatAnestesi">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPerawatAnestesi" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdDokterAnestesi1-->
<div class="modal fade" id="modalTtdDokterAnestesi1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter Anestesi <i>Sign In</i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokterAnestesi1" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokterAnestesi1">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokterAnestesi1" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdSirkuler-->
<div class="modal fade" id="modalTtdSirkuler" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Sirkuler</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdSirkuler" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdSirkuler">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdSirkuler" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdInstrumen-->
<div class="modal fade" id="modalTtdInstrumen" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Instrumen</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdInstrumen" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdInstrumen">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdInstrumen" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdAsisten-->
<div class="modal fade" id="modalTtdAsisten" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Asisten</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdAsisten" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdAsisten">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdAsisten" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdOperator-->
<div class="modal fade" id="modalTtdOperator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Operator</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdOperator" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdOperator">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdOperator" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal ttdDokterAnestesi2-->
<div class="modal fade" id="modalTtdDokterAnestesi2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan Dokter Anestesi <i>Sign Out</i></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokterAnestesi2" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokterAnestesi2">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokterAnestesi2" disabled>Selesai</button>
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
                id: '#ttdPerawatAnestesi',
                key: 'ttdPerawatAnestesi'
            },
            {
                id: '#ttdDokterAnestesi1',
                key: 'ttdDokterAnestesi1'
            },
            {
                id: '#ttdSirkuler',
                key: 'ttdSirkuler'
            },
            {
                id: '#ttdInstrumen',
                key: 'ttdInstrumen'
            },
            {
                id: '#ttdAsisten',
                key: 'ttdAsisten'
            },
            {
                id: '#ttdOperator',
                key: 'ttdOperator'
            },
            {
                id: '#ttdDokterAnestesi2',
                key: 'ttdDokterAnestesi2'
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

        // Kirim AJAX ke Backend jika minimal ada 1 TTD
        $.ajax({
            url: '<?= base_url() ?>rm/rm11b1Checklist/simpanTtd',
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
                canvasId: 'tempatTtdPerawatAnestesi',
                btnHapusId: 'hapusTtdPerawatAnestesi',
                btnSimpanId: 'simpanTtdPerawatAnestesi',
                hasilId: 'ttdPerawatAnestesi',
                modalId: 'modalTtdPerawatAnestesi',
                altText: 'Tanda tangan Perawat Anestesi'
            },
            {
                canvasId: 'tempatTtdDokterAnestesi1',
                btnHapusId: 'hapusTtdDokterAnestesi1',
                btnSimpanId: 'simpanTtdDokterAnestesi1',
                hasilId: 'ttdDokterAnestesi1',
                modalId: 'modalTtdDokterAnestesi1',
                altText: 'Tanda tangan Dokter Anestesi Sign In'
            },
            {
                canvasId: 'tempatTtdSirkuler',
                btnHapusId: 'hapusTtdSirkuler',
                btnSimpanId: 'simpanTtdSirkuler',
                hasilId: 'ttdSirkuler',
                modalId: 'modalTtdSirkuler',
                altText: 'Tanda tangan Sirkuler'
            },
            {
                canvasId: 'tempatTtdInstrumen',
                btnHapusId: 'hapusTtdInstrumen',
                btnSimpanId: 'simpanTtdInstrumen',
                hasilId: 'ttdInstrumen',
                modalId: 'modalTtdInstrumen',
                altText: 'Tanda tangan Instrumen'
            },
            {
                canvasId: 'tempatTtdAsisten',
                btnHapusId: 'hapusTtdAsisten',
                btnSimpanId: 'simpanTtdAsisten',
                hasilId: 'ttdAsisten',
                modalId: 'modalTtdAsisten',
                altText: 'Tanda tangan Asisten'
            },
            {
                canvasId: 'tempatTtdOperator',
                btnHapusId: 'hapusTtdOperator',
                btnSimpanId: 'simpanTtdOperator',
                hasilId: 'ttdOperator',
                modalId: 'modalTtdOperator',
                altText: 'Tanda tangan Operator'
            },
            {
                canvasId: 'tempatTtdDokterAnestesi2',
                btnHapusId: 'hapusTtdDokterAnestesi2',
                btnSimpanId: 'simpanTtdDokterAnestesi2',
                hasilId: 'ttdDokterAnestesi2',
                modalId: 'modalTtdDokterAnestesi2',
                altText: 'Tanda tangan Dokter Anestesi Sign Out'
            }
        ];

        // ===================================================
        // EXECUTE INITIALIZATION (LOOPING)
        // ===================================================
        signatureConfigs.forEach(config => setupSignaturePad(config));

    });
</script>

</html>