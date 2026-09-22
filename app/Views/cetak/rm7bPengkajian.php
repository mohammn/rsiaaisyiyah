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
        padding: 0.3cm 0.3cm 0.3cm 0.6cm;
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

    .tabel-sempit td,
    .tabel-sempit th {
        padding: 0mm;
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
    <title>Cetak Rm07b Pengkajian</title>

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
                            RM 07b
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold">PENGKAJIAN AWAL KEBIDANAN <br>
                            INSTALASI GAWAT DARURAT
                        </p>
                    </div>
                </div>

                <table class="table table-sm table-bordered mb-0">
                    <tr>
                        <td>
                            <?= !empty($data->rm7bPengkajian["tgl"])
                                ? 'Tanggal : ' . date('d-m-Y', strtotime($data->rm7bPengkajian["tgl"])) . '. jam : ' . date('H:i', strtotime($data->rm7bPengkajian["tgl"])) . ' WIB'
                                : 'Tanggal : -- -- ----. jam --:-- WIB' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td style="width:25%;">Sumber data</td>
                                    <td>: <?= ($data->rm7bPengkajian["sumberData"] ?? '') === "Lainnya" ? ($data->rm7bPengkajian["sumberDataLainnya"] ?? '') : ($data->rm7bPengkajian["sumberData"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <td>Rujukan</td>
                                    <td>: <?= ($data->rm7bPengkajian["rujukan"] ?? '') === "Diantar Oleh" ? 'Diantar oleh : ' . ($data->rm7bPengkajian["pengantarRujukan"] ?? '') : (($data->rm7bPengkajian["rujukan"] ?? '') === 'Ya' ? ($data->rm7bPengkajian["asalRujukan"] ?? '') : ($data->rm7bPengkajian["rujukan"] ?? '-')) ?> </td>
                                </tr>
                                <tr>
                                    <td>Keluarga bisa dihubungi</td>
                                    <td>: <?= $data->rm7bPengkajian["nama"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->rm7bPengkajian["alamat"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>No. Telp</td>
                                    <td>: <?= $data->rm7bPengkajian["noHp"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Transportas waktu datang</td>
                                    <td>: <?= ($data->rm7bPengkajian["transportasiWaktuDatang"] ?? '') === "Lainnya" ? ($data->rm7bPengkajian["transportasiLainnya"] ?? '') : ($data->rm7bPengkajian["transportasiWaktuDatang"] ?? '-') ?> </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>

                <table class="table table-sm table-bordered mb-0">
                    <tr>
                        <td class="text-center fw-bold">DATA SUBJEKTIF</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">A. RIWAYAT KEBIDANAN</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless  mb-0">
                                <tr>
                                    <td style="width:25%;">Keluhan utama</td>
                                    <td>: <?= $data->rm7bPengkajian["keluhanUtama"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat penyakit</td>
                                    <td>: <?= $data->rm7bPengkajian["riwayatPenyakit"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat penyakit keluarga</td>
                                    <td>: <?= $data->rm7bPengkajian["riwayatPenyakitKeluarga"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>RIwayat menstruasi</td>
                                    <td>
                                        <?php if (!empty($data->rm7bPengkajian["mensLainnya"])): ?>
                                            <?= $data->rm7bPengkajian["mensLainnya"] ?? '' ?>
                                        <?php else: ?>
                                            : HPHT : <?= date('d-m-Y', strtotime($data->rm7bPengkajian["hpht"])) ?? '-' ?>, &nbsp;&nbsp;&nbsp; HPL : <?= date('d-m-Y', strtotime($data->rm7bPengkajian["hpl"])) ?? '-' ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Riwayat perkawinan</td>
                                    <td>: <?= ($data->rm7bPengkajian["riwayatPerkawinan"] ?? '') === "Kawin" ? 'Kawin ' . ($data->rm7bPengkajian["jumlahKawin"] ?? '-') . ' Kali. Lama : ' .  ($data->rm7bPengkajian["jumlahKawin"] ?? '-') . ' Tahun' : ($data->rm7bPengkajian["riwayatPerkawinan"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <td>Riwayat KB terakhir</td>
                                    <td>: <?= ($data->rm7bPengkajian["riwayatKbTerakhir"] ?? '') === "Ya" ? 'Ya. jenis : ' . ($data->rm7bPengkajian["jenisKbTerakhir"] ?? '') : ($data->rm7bPengkajian["riwayatKbTerakhir"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <?php
                                    $rawJenis = $data->rm7bPengkajian["jenisGynekologi"] ?? [];
                                    if (is_string($rawJenis)) {
                                        $rawJenis = json_decode($rawJenis, true) ?? [];
                                    }
                                    $lainnyaValue = $data->rm7bPengkajian["jenisGynekologiLainnya"] ?? '';
                                    $processed = array_map(function ($item) use ($lainnyaValue) {
                                        return ($item === 'Lainnya') ? $lainnyaValue : $item;
                                    }, $rawJenis);

                                    $gynekologi = implode(', ', array_filter($processed));
                                    ?>
                                    <td>Riwayat gynekologi</td>
                                    <td>: <?= ($data->rm7bPengkajian["riwayatGynekologi"] ?? '') === "Ada" ? 'Ada. Jenis :' . ($gynekologi ?? '') : ($data->rm7bPengkajian["riwayatGynekologi"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <td>Riwayat alergi</td>
                                    <td>:
                                        <?php
                                        $rawAlergi = $data->rm7bPengkajian["riwayatAlergi"] ?? [];
                                        if (is_string($rawAlergi)) {
                                            $rawAlergi = json_decode($rawAlergi, true) ?? [];
                                        }

                                        $riwayatAlergi = is_array($rawAlergi) ? $rawAlergi : [];
                                        if (in_array('Obat', $riwayatAlergi)) {
                                            echo 'Obat : <i>' . ($data->rm7bPengkajian["jenisNamaObat"] ?? '-') . '</i>. Reaksi : <i>' . ($data->rm7bPengkajian["reaksiObat"] ?? '-') . "</i><br>";
                                        } else {
                                            echo 'Obat : <i>Tidak ada.</i><br>';
                                        }

                                        if (in_array('Makanan', $riwayatAlergi)) {
                                            echo '&nbsp;&nbsp; Makanan : <i>' . ($data->rm7bPengkajian["jenisMakanan"] ?? '-') . '</i>. Reaksi : <i>' . ($data->rm7bPengkajian["reaksiMakanan"] ?? '-') . "</i><br>";
                                        } else {
                                            echo 'Makanan : <i>Tidak ada.</i><br>';
                                        }

                                        if (in_array('Lain-lain', $riwayatAlergi)) {
                                            echo '&nbsp;&nbsp; Alergi Lainnya : <i>' . ($data->rm7bPengkajian["jenisAlergiLainnya"] ?? '-') . '</i>. Reaksi : <i>' . ($data->rm7bPengkajian["reaksiLainnya"] ?? '-') . '</i>';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2">Riwayat Kehamilan dan persalinan :</td>
                                </tr>
                                <tr>
                                    <td colspan="2">
                                        <table class="table table-sm tabel table-striped table-bordered mb-0">
                                            <thead class="text-center">
                                                <tr>
                                                    <th rowspan="3">Hamil Ke</th>
                                                    <th colspan="3">Umur Hamil</th>
                                                    <th rowspan="3">Jenis Persalinan</th>
                                                    <th colspan="2">Penolong</th>
                                                    <th colspan="2">Anak, BB Lahir</th>
                                                    <th colspan="3">Keadaan Anak Sekarang</th>
                                                </tr>
                                                <tr>
                                                    <th rowspan="2">Abortus</th>
                                                    <th rowspan="2">Prematur</th>
                                                    <th rowspan="2">Aterm</th>
                                                    <th rowspan="2">Nakes</th>
                                                    <th rowspan="2">Non Nakes</th>
                                                    <th>JK</th>
                                                    <th>BBL</th>
                                                    <th colspan="2">Hidup (Usia)</th>
                                                    <th rowspan="2">Mati</th>
                                                </tr>
                                                <tr>
                                                    <th>♂ / ♀</th>
                                                    <th>(gram)</th>
                                                    <th>Normal</th>
                                                    <th>Cacat</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Pastikan data dikonversi ke Array jika berupa JSON String
                                                $listData = $data->rm7bPengkajianData ?? [];
                                                if (is_string($listData)) {
                                                    $listData = json_decode($listData, true) ?? [];
                                                }
                                                ?>

                                                <?php if (!empty($listData) && (is_array($listData) || is_object($listData))): ?>
                                                    <?php foreach ($listData as $row): ?>
                                                        <?php
                                                        // Jika elemen di dalam loop masih berupa string JSON, decode dulu
                                                        if (is_string($row)) {
                                                            $row = json_decode($row, true);
                                                        }

                                                        // Ambil nilai helper aman untuk Array atau Object
                                                        $getVal = function ($key) use ($row) {
                                                            if (is_array($row)) return $row[$key] ?? '';
                                                            if (is_object($row)) return $row->$key ?? '';
                                                            return '';
                                                        };

                                                        $jk = $getVal('jk');
                                                        $jkText = '';
                                                        if ($jk === 'L') {
                                                            $jkText = '♂';
                                                        } elseif ($jk === 'P') {
                                                            $jkText = '♀';
                                                        } elseif ($jk === 'TK') {
                                                            $jkText = '-';
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td class="text-center"><?= esc($getVal('hamil_ke')) ?></td>
                                                            <td><?= esc($getVal('abortus')) ?></td>
                                                            <td><?= esc($getVal('prematur')) ?></td>
                                                            <td><?= esc($getVal('aterm')) ?></td>
                                                            <td><?= esc($getVal('jenis_persalinan')) ?></td>
                                                            <td><?= esc($getVal('penolong_nakes')) ?></td>
                                                            <td><?= esc($getVal('penolong_non_nakes')) ?></td>
                                                            <td><?= esc($jkText) ?></td>
                                                            <td class="text-end"><?= esc($getVal('bbl')) ?></td>
                                                            <td><?= esc($getVal('keadaan_normal')) ?></td>
                                                            <td><?= esc($getVal('keadaan_cacat')) ?></td>
                                                            <td><?= esc($getVal('keadaan_mati')) ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php else: ?>
                                                    <tr>
                                                        <td colspan="12" class="text-center text-muted">Tidak ada data riwayat persalinan</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">B. PSIKOSOSIAL DAN EKONOMI</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless  mb-0">
                                <tr>
                                    <?php
                                    $rawPsikologis = $data->rm7bPengkajian["keadaanPsikologis"] ?? [];
                                    if (is_string($rawPsikologis)) {
                                        $rawPsikologis = json_decode($rawPsikologis, true) ?? [];
                                    }
                                    $keadaanPsikologis = is_array($rawPsikologis) ? $rawPsikologis : [];
                                    $lainnyaValue = $data->rm7bPengkajian["keadaanPsikologisLainnya"] ?? '';

                                    $processedPsikologis = array_map(function ($item) use ($lainnyaValue) {
                                        return ($item === 'Lainnya') ? $lainnyaValue : $item;
                                    }, $keadaanPsikologis);
                                    $keadaanPsikologis = implode(', ', array_filter($processedPsikologis));
                                    ?>
                                    <td style="width:25%;">Keadaan psikologis</td>
                                    <td>: <?= $keadaanPsikologis ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tingkat pendidikan</td>
                                    <td>: <?= ($data->rm7bPengkajian["tingkatPendidikan"] ?? '') === "Lainnya" ? ($data->rm7bPengkajian["tingkatPendidikanLainnya"] ?? '-') : ($data->rm7bPengkajian["tingkatPendidikan"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <td>Pekerjaan</td>
                                    <td>: <?= ($data->rm7bPengkajian["pekerjaan"] ?? '') === "Lainnya" ? ($data->rm7bPengkajian["pekerjaanLainnya"] ?? '-') : ($data->rm7bPengkajian["pekerjaan"] ?? '-') ?> </td>
                                </tr>
                                <tr>
                                    <?php
                                    $rawTinggal = $data->rm7bPengkajian["tinggalBersama"] ?? [];
                                    if (is_string($rawTinggal)) {
                                        $rawTinggal = json_decode($rawTinggal, true) ?? [];
                                    }
                                    $tinggalBersama = is_array($rawTinggal) ? $rawTinggal : [];
                                    $lainnyaValue = $data->rm7bPengkajian["tinggalBersamaLainnya"] ?? '';
                                    $processedTinggal = array_map(function ($item) use ($lainnyaValue) {
                                        return ($item === 'Lainnya') ? $lainnyaValue : $item;
                                    }, $tinggalBersama);
                                    $tinggalBersama = implode(', ', array_filter($processedTinggal));
                                    ?>
                                    <td>Tinggal bersama</td>
                                    <td>: <?= $tinggalBersama ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Status Ekonomi</td>
                                    <td>: <?= ($data->rm7bPengkajian["statusEkonomi"] ?? '') === "Asuransi" ? 'Asuransi : ' . ($data->rm7bPengkajian["namaAsuransi"] ?? '-') : ($data->rm7bPengkajian["statusEkonomi"] ?? '-') ?> </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">C. SPIRITUAL</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td style="width:25%;">Menjalankan ibadah</td>
                                    <td>
                                        : <?= $data->rm7bPengkajian['menjalankanIbadah'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Persepsi terhadap sakit</td>
                                    <td>
                                        : <?= $data->rm7bPengkajian['persepsiSakit'] ?? '-' ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Meminta pelayanan spiritual</td>
                                    <td>
                                        : <?= $data->rm7bPengkajian['pelayananSpiritual'] ?? '-' ?>
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
                <br><br>
                <table class="table table-sm table-bordered">
                    <tr>
                        <td class="fw-bold">D. PENGKAJIAN NYERI</td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?= base_url("/public/assets/img/skalanyeri.jpg") ?>" style="width: 50%;" alt="skala nyeri">
                            Skala Nyari : <?= $data->rm7bPengkajian['skalaNyeri'] ?? '-' ?>. Jam : <?= !empty($data->rm7bPengkajian['jamNyeri'] ?? null) ? date('H:i', strtotime($data->rm7bPengkajian['jamNyeri'])) : '--:--' ?> WIB
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            E. RISIKO JATUH SKALA MORSE
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <td>Riwayat jatuh baru atau 3 bulan terakhir</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['riwayatJatuh'] ?? '') === '25' ? 'Ya. (25)' : 'Tidak. (0)' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Diagnosa skunder</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['diagnosaSkunder'] ?? '') === '15' ? 'Ya. (15)' : 'Tidak. (0)' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Menggunakan alat bantu</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['alatBantu2'] ?? '') === '15' ? 'Menggunakan tongkat/kruk. (15)' : (($data->rm7bPengkajian['alatBantu2'] ?? '') === '30' ? '<i>Furniture<i> (30)' : 'Bedrest/dibantu perawat. (0)') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Menggunakan infus</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['menggunakanInfus'] ?? '') === '20' ? 'Ya. (20)' : 'Tidak. (0)' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Gaya berjalan</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['gayaBerjalan'] ?? '') === '20' ? 'Terganggu. (20)' : (($data->rm7bPengkajian['gayaBerjalan'] ?? '') === '10' ? 'Lemah (10)' : 'Normal. (0)') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Status mental</td>
                                            <td>:</td>
                                            <td><?= ($data->rm7bPengkajian['statusMental'] ?? '') === '15' ? 'Lupa keterbatasan diri. (15)' : 'Orientasi sesuai dengan kemampuan diri. (0)' ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Jumlah Skor</td>
                                            <td>:</td>
                                            <td><?= $data->rm7bPengkajian['skorJatuh'] ?? ''  ?></td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">Status</td>
                                            <td>:</td>
                                            <td><?= $data->rm7bPengkajian['statusJatuh'] ?? ''  ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <table class="table table-sm table-bordered mb-0">
                                        <thead>
                                            <tr>
                                                <th colspan="2" align="left">Intervensi Pencegahan Resiko Jatuh ( Skala Morse)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ($data->rm7bPengkajian['statusJatuh'] != 'Tidak Beresiko'): ?>
                                                <tr>
                                                    <td valign="top" style="width:10%;">Resiko Rendah</td>
                                                    <td>
                                                        <table class="table table-sm table-borderless mb-0 tabel-sempit">
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Orientasi Lingkungan</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Roda tempat tidur berada dalam posisi terkunci</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Posisikan tempat tidur pada posisi rendah</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Naikan pagar pengaman tempat tidur</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Berikan edukasi pasien</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Pastikan kebutuhan pribadi dalam jangkauan</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <?php
                                            endif;
                                            if ($data->rm7bPengkajian['statusJatuh'] === 'Resiko Tinggi'):
                                            ?>
                                                <tr>
                                                    <td valign="top">Resiko Tinggi</td>
                                                    <td>
                                                        <table class="table table-sm table-borderless mb-0 tabel-sempit">
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Lakukan semua pedoman pencegahan jatuh risiko rendah</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Berikan tanda risiko jatuh pada <i>bed</i> pasien</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Berikan kancing kuning pada gelang identitas</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Kunjungi dan monitor pasien setiap 1 jam</td>
                                                            </tr>
                                                            <tr>
                                                                <td>✓</td>
                                                                <td>Libatkan keluarga untuk membantu pasien</td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">F. STATUS FUNGSIONAL</td>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <b>1. Nutrisi</b> <br>
                                    Lakukan skrining nutrisi dengan Malnutrio Screening Tools.
                                    <table class="table table-sm table-bordered">
                                        <tr>
                                            <th>No.</th>
                                            <th>Uraian</th>
                                            <th>Skor</th>
                                        </tr>
                                        <tr>
                                            <td>1. </td>
                                            <td>
                                                Apakah pasien mengalami penurunan BB yang tidak
                                                diinginkan dalam 6 bulan terakhir? <br>
                                                <?php
                                                if ($data->rm7bPengkajian["penurunanBb"] == '0') {
                                                    echo 'Tidak ada penurunan BB.';
                                                } else if ($data->rm7bPengkajian["penurunanBb"] == '2') {
                                                    echo 'Tidak yakin/tidak tahu (ada tanda baju menjadi lebih longgar).';
                                                } else {
                                                    echo 'Ya, ada penuruna BB Sebanyak : ';
                                                    if ($data->rm7bPengkajian["penurunanBb"] == '1') {
                                                        echo '1-5 Kg.';
                                                    } else if ($data->rm7bPengkajian["penurunanBb"] == '2') {
                                                        echo '6-10 Kg.';
                                                    } else if ($data->rm7bPengkajian["penurunanBb"] == '3') {
                                                        echo '11-15 Kg.';
                                                    } else if ($data->rm7bPengkajian["penurunanBb"] == '4') {
                                                        echo '>15 Kg.';
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?= $data->rm7bPengkajian["penurunanBb"] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>2.</td>
                                            <td>Apakah asupan makan pasien berkurang karena
                                                penurunan nafsu makan/kesulitan menerima
                                                makanan?
                                                <?= $data->rm7bPengkajian['asupanMakan'] === '1' ? ' Ya' : ' Tidak' ?>
                                            </td>
                                            <td><?= $data->rm7bPengkajian['asupanMakan'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Total Skor</td>
                                            <td><?= $data->rm7bPengkajian['skorStatus'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>3.</td>
                                            <td colspan="2">
                                                Pasien dengan diagnosa khusus : <br>
                                                <?php
                                                $rawDiagnosa = $data->rm7bPengkajian['diagnosaKhusus'] ?? [];

                                                if (is_string($rawDiagnosa)) {
                                                    $rawDiagnosa = json_decode($rawDiagnosa, true) ?? [];
                                                }
                                                $diagnosaKhusus = is_array($rawDiagnosa) ? $rawDiagnosa : [];
                                                $penyakitKronisLainnya = $data->rm7bPengkajian['penyakitKronisLainnya'] ?? '';

                                                $processedDiagnosa = array_map(function ($item) use ($penyakitKronisLainnya) {
                                                    return ($item === 'Penyakit kronis lain') ? $penyakitKronisLainnya : $item;
                                                }, $diagnosaKhusus);

                                                $filtered = array_filter($processedDiagnosa);
                                                echo !empty($filtered) ? implode(', ', $filtered) : '-';
                                                ?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <b>Keluhan lainnya :</b> <br>
                                    <?php
                                    $pengkajian = is_object($data->rm7bPengkajian) ? (array) $data->rm7bPengkajian : ($data->rm7bPengkajian ?? []);

                                    $rawKeluhan = $pengkajian['keluhanLain'] ?? [];

                                    if (is_string($rawKeluhan)) {
                                        $rawKeluhan = json_decode($rawKeluhan, true) ?? [];
                                    }

                                    $keluhanLain = is_array($rawKeluhan) ? $rawKeluhan : [];

                                    $jenisDiet = $pengkajian['jenisDiet'] ?? '';
                                    $keluhanLainnyaInput = $pengkajian['keluhanLainnyaInput'] ?? '';

                                    $processedKeluhan = array_map(function ($item) use ($jenisDiet, $keluhanLainnyaInput) {
                                        if ($item === 'Diet') {
                                            return 'Diet : ' . $jenisDiet;
                                        }
                                        if ($item === 'Lainnya') {
                                            return $keluhanLainnyaInput;
                                        }
                                        return $item;
                                    }, $keluhanLain);

                                    $hasilCetak = array_filter($processedKeluhan);
                                    echo !empty($hasilCetak) ? implode(', ', $hasilCetak) : '-';
                                    ?>
                                    <br>
                                    <hr class="m-0">
                                    <b>2. Eliminasi dan pelepasan</b> <br>
                                    <?php if ($data->rm7bPengkajian["keluhanBak"] === 'Ada'): ?>
                                        BAK : Frekuensi <i><?= $data->rm7bPengkajian["bakFrekuensi"] ?? '-' ?></i> x/hr <br>
                                        Volume : <i><?= $data->rm7bPengkajian["bakVolume"] ?? '-' ?></i> cc. Warna : <i><?= $data->rm7bPengkajian["bakWarna"] ?? '-' ?></i><br>
                                        Keluhan : <i><?= $data->rm7bPengkajian["bakKeluhan"] ?? '-' ?></i>
                                    <?php else: ?>
                                        BAK : Tidak ada keluhan
                                    <?php endif;
                                    if ($data->rm7bPengkajian["keluhanBab"] === 'Ada'):
                                    ?>
                                        <br> BAB : Frekuensi <i><?= $data->rm7bPengkajian["babFrekuensi"] ?? '-' ?></i> x/hr <br>
                                        Konsistensi : <i><?= $data->rm7bPengkajian["babKonsistensi"] ?? '-' ?></i>. Warna : <i><?= $data->rm7bPengkajian["babWarna"] ?? '-' ?></i> <br>
                                        Keluhan : <i><?= $data->rm7bPengkajian["babKeluhan"] ?? '-' ?></i>
                                    <?php else: ?>
                                        <br>
                                        BAB : Tidak ada keluhan
                                    <?php endif;
                                    ?>
                                    <br>
                                    <hr class="m-0">
                                    <b>3. Aktifitas dan istirahat</b> <br>
                                    Tidur/Istirahat : <i><?= ($data->rm7bPengkajian['tidurIstirahat'] ?? '') === 'Ada keluhan' ? 'Ada keluhan : ' . ($data->rm7bPengkajian['tidurIstirahatKet'] ?? '') : ($data->rm7bPengkajian['tidurIstirahat'] ?? '') ?></i> <br>
                                    Aktifitas/latihan dan perwatan diri : <br>
                                    <i><?= $data->rm7bPengkajian["aktivitasLatihan"] ?? '-'  ?> </i><br>
                                    Alat bantu : <br>
                                    <i><?= ($data->rm7bPengkajian['alatBantu'] ?? '') === 'Ya' ? 'Ya : ' . ($data->rm7bPengkajian['alatBantuKet'] ?? '') : ($data->rm7bPengkajian['alatBantu'] ?? '') ?></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <br><br>
                <table class="table table-sm table-bordered mb-0">
                    <tr>
                        <td class="fw-bold text-center">DATA OBJEKTIF</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            1. PEMERIKSAAN UMUM
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td>Keadaan Umum</td>
                                    <td>:</td>
                                    <td><?= $data->rm7bPengkajian['keadaanUmum'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Kesadaran</td>
                                    <td>:</td>
                                    <td><?= $data->rm7bPengkajian['kesadaran'] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Tanda vital</td>
                                    <td>:</td>
                                    <td>
                                        TD : <i><?= $data->rm7bPengkajian['td'] ?? '...' ?></i> mm/Hg. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; RR : <i><?= $data->rm7bPengkajian['rr'] ?? '...' ?></i> x/mnt, <i><?= ($data->rm7bPengkajian['rrTeratur'] ?? '') === 'Tidak' ? 'Tidak Teratur' : ($data->rm7bPengkajian['rrTeratur'] ?? '-') ?></i> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Nadi : <?= $data->rm7bPengkajian['nadi'] ?? '...' ?></i> x/mnt <br>
                                        Suhu : <i><?= $data->rm7bPengkajian['suhuAksila'] ?? '...' ?></i> &deg;C (aksila), &nbsp;&nbsp;&nbsp;&nbsp; <i><?= $data->rm7bPengkajian['suhuRectal'] ?? '...' ?></i> &deg;C (rectal).
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            2. PEMERIKSAAN FISIK
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-bordered mb-0">
                                <tr>
                                    <td style="width: 20%;">a. abdomen
                                        <br><br>
                                        <img src="<?= base_url() ?>public/assets/img/body-wanita.png" width="70%" alt="">
                                    </td>
                                    <td>
                                        <table class="table table-sm table-borderless mb-0 tabel-sempit">
                                            <tr>
                                                <td class="fw-bold border-bottom" colspan="2">Inspeksi :</td>
                                            </tr>
                                            <tr>
                                                <td style="width: 30%;">Bekas Operasi</td>
                                                <td>: <?= $data->rm7bPengkajian['bekasOperasi'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Linea nigra</td>
                                                <td>: <?= $data->rm7bPengkajian['lineaNigra'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Linea alba</td>
                                                <td>: <?= $data->rm7bPengkajian['lineaAlba'] ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ada pembesaran </td>
                                                <td>: <?= $data->rm7bPengkajian['adaPembesaran'] === 'Lainnya' ? $data->rm7bPengkajian['isiPembesaranLainnya'] : ($data->rm7bPengkajian['adaPembesaran'] ?? '-') ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="fw-bold border-bottom">Palpasi</td>
                                            </tr>
                                            <tr>
                                                <td>TFU</td>
                                                <td>: <?= $data->rm7bPengkajian['tfu'] ?? '.....' ?> cm</td>
                                            </tr>
                                            <tr>
                                                <td>Involusi uteri</td>
                                                <td>: <?= $data->rm7bPengkajian['involusiUteri'] ?? '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Kontraksi Uterus</td>
                                                <td>: <?= $data->rm7bPengkajian['kontraksiUteri'] === 'Lainnya' ? ($data->rm7bPengkajian['isiKontraksiLainnya'] ?? '-') : ($data->rm7bPengkajian['kontraksiUteri'] ?? '-') ?>, &nbsp;&nbsp;&nbsp; His : <i><?= $data->rm7bPengkajian['hisLama'] ?? '......' ?></i> x/10mnt, Lama : <i><?= $data->rm7bPengkajian['hisLama'] ?? '.....' ?></i> detik</td>
                                            </tr>
                                            <tr>
                                                <td>Kelainan</td>
                                                <td>: <?= $data->rm7bPengkajian['kelainanPalpasi'] === 'Lainnya' ? $data->rm7bPengkajian['isiKelainanPalpasiLainnya'] : ($data->rm7bPengkajian['kelainanPalpasi'] ?? '-') ?></td>
                                            </tr>
                                            <tr>
                                                <td>Teraba massa</td>
                                                <td>: <?= ($data->rm7bPengkajian['terabaMassa'] ?? '') == 'Ada' ? 'Ada. ukuran : ' . $data->rm7bPengkajian['massaPanjang'] . ' x ' . $data->rm7bPengkajian['massaLebar'] : ($data->rm7bPengkajian['terabaMassa'] ?? '') ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2" class="fw-bold border-bottom">Auskutasi :</td>
                                            </tr>
                                            <tr>
                                                <td>Campuran bising usus</td>
                                                <td>: <?= $data->rm7bPengkajian['bisingUsus'] ?? '' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Denyut jantung janin</td>
                                                <td>:
                                                    <?php if ($data->rm7bPengkajian['djjTeratur'] === 'Lainnya') : ?>
                                                        <?= $data->rm7bPengkajian['isiDjjLainnya'] ?? '-' ?>
                                                    <?php else: ?>
                                                        <?= $data->rm7bPengkajian['djjFrekuensi'] ?? '' ?> x/mnt, <?= $data->rm7bPengkajian['djjTeratur'] ?? '' ?>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>b. Anogenital Inspeksi</td>
                                    <td>
                                        <table class="table table-sm table-borderless mb-0 tabel-sempit">
                                            <tr>
                                                <td style="width: 30%;">Pengeluaran vaginal</td>
                                                <td>: <?= $data->rm7bPengkajian['pengeluaranVaginal'] ?? '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Lochea</td>
                                                <td>: <?= $data->rm7bPengkajian['lochea'] ?? '-' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Volume</td>
                                                <td>: <?= $data->rm7bPengkajian['volume'] ?? '-' ?> cc, Berbau ? <?= $data->rm7bPengkajian['berbau'] === 'Ya' ? 'Ya : ' . ($data->rm7bPengkajian['berbauKet'] ?? '-')  : ($data->rm7bPengkajian['berbau'] ?? '-') ?></td>
                                            </tr>
                                            <tr>
                                                <td>Perinium</td>
                                                <td> :
                                                    <?php
                                                    $rawPerinium = $data->rm7bPengkajian['perinium'] ?? null;

                                                    $periniumArray = is_string($rawPerinium) ? json_decode($rawPerinium, true) : (array) $rawPerinium;

                                                    if (!empty($periniumArray) && is_array($periniumArray)) {
                                                        $formattedArray = array_map(function ($item) use ($data) {
                                                            if ($item === 'Laserasi') {
                                                                $derajat = $data->rm7bPengkajian['laserasiDerajat'] ?? '-';
                                                                return "Laserasi : derajat {$derajat}";
                                                            }
                                                            if ($item === 'Lainnya') {
                                                                return $data->rm7bPengkajian['periniumLainnyaKet'] ?? 'Lainnya';
                                                            }
                                                            return $item;
                                                        }, $periniumArray);
                                                        $hasilCetak = implode(', ', $formattedArray);
                                                    } else {
                                                        $hasilCetak = '-';
                                                    }
                                                    ?>
                                                    <?= esc($hasilCetak) ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Jahitan</td>
                                                <td>:
                                                    <?= esc(!empty($data->rm7bPengkajian['jahitan'])
                                                        ? implode(', ', array_map(
                                                            fn($item) => $item === 'Lainnya' ? ($data->rm7bPengkajian['jahitanLainnyaKet'] ?? 'Lainnya') : $item,
                                                            json_decode($data->rm7bPengkajian['jahitan'], true) ?? []
                                                        ))
                                                        : '-') ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>c. Inspekulo Vagina</td>
                                    <td>
                                        <table class="table table-sm table-borderless mb-0  tabel-sempit">
                                            <tr>
                                                <td style="width: 30%;">
                                                    Kelainan
                                                </td>
                                                <td>
                                                    :
                                                    <?php
                                                    $arr = json_decode($data->rm7bPengkajian['kelainan'] ?? '', true) ?? [];
                                                    $arr = array_map(fn($item) => $item === 'Lainnya' ? ($data->rm7bPengkajian['kelainanLainnyaKet'] ?? 'Lainnya') : $item, $arr);
                                                    ?>
                                                    <?= esc(!empty($arr) ? implode(', ', $arr) : '-') ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    Portio
                                                </td>
                                                <td>: <?= $data->rm7bPengkajian['portio'] == 'Lainnya' ? ($data->rm7bPengkajian['portioLainnyaKet'] ?? '-') : ($data->rm7bPengkajian['portio'] ?? '-') ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Cavum douglasi (Menonjol)</td>
                                                <td>: <?= $data->rm7bPengkajian['cavumDouglasi'] ?? '' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Vagina Toucher (VT)</td>
                                                <td>: <?= $data->rm7bPengkajian['petugasVt'] ?? '' ?></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal dan jam</td>
                                                <td>: <?= !empty($data->rm7bPengkajian['waktuVt']) ? date('d-m-Y H:i', strtotime($data->rm7bPengkajian['waktuVt'])) . ' WIB' : '-' ?></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            3. KESIMPULAN PEMERIKSAAN PENUNJANG
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <b>a. Darah :</b>
                                    <table class="table table-sm table-borderless mb-0">
                                        <tr>
                                            <td style="width: 30%;">HB</td>
                                            <td>: <?= $data->rm7bPengkajian['hb'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Golongan darah</td>
                                            <td>: <?= $data->rm7bPengkajian['golonganDarah'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Rhesus</td>
                                            <td>: <?= $data->rm7bPengkajian['rhesus'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Toxo</td>
                                            <td>: <?= $data->rm7bPengkajian['toxo'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>HbsAg</td>
                                            <td>: <?= $data->rm7bPengkajian['hbsag'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>HIV</td>
                                            <td>: <?= $data->rm7bPengkajian['hiv'] ?? '-' ?></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-6">
                                    <b>b. Urine : </b>
                                    <table class="table table-sm table-borderless ms-2">
                                        <tr>
                                            <td style="width: 30%;">Albumin</td>
                                            <td>: <?= $data->rm7bPengkajian['albumin'] ?? '-' ?></td>
                                        </tr>
                                        <tr>
                                            <td>Reduksi</td>
                                            <td>: <?= $data->rm7bPengkajian['reduksi'] ?? '-' ?></td>
                                        </tr>
                                    </table>
                                    <b>c. USG : </b> <?= $data->rm7bPengkajian['usg'] ?? '-' ?> <br>
                                    <b>d. Lainnya : </b> <?= $data->rm7bPengkajian['pemeriksaanLainnya'] ?? '-' ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>4. DIAGNOSA KEBIDANAN</b><br>
                            <div class="ms-2">
                                <?= $data->rm7bPengkajian['diagnosaKebidanan'] ?? '-' ?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>5. RENCANA TINDAK LANJUT</b><br>
                            <div class="ms-2">
                                <?= $data->rm7bPengkajian['rencanaTindakLanjut'] ?? '-' ?>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="row text-center mt-1">
                    <div class="col-12 text-end pe-5">
                        Bangkalan, <?= $data->rm7bPengkajian['tglTtd'] ?>
                    </div>
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                            </td>
                            <td style="width:40%;">
                            </td>
                            <td>
                                Petugas
                                <br><br>

                                <div id="ttdPetugas">
                                    <?php if ($data->rm7bPengkajian["ttdPetugas"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm7bPengkajian/' . $data->rm7bPengkajian["ttdPetugas"]) . '" alt="tanda tangan Petugas" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm7bPengkajian["petugas"] ?? '-' ?> )
                                <br><br>
                                <?php if (!$data->rm7bPengkajian["ttdPetugas"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPetugas">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>

                    <input type="hidden" id="noRawat" value="<?= $data->rm7bPengkajian["noRawat"] ?>">
                    <input type="hidden" id="petugas" value="<?= $data->rm7bPengkajian["petugas"] ?? '' ?>">


                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <?php if (!$data->rm7bPengkajian["ttdPetugas"]) { ?>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<!-- Modal ttd Petugas-->
<div class="modal fade" id="modalTtdPetugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan petugas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdPetugas" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdPetugas">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdPetugas" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

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


<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    function kunciTtd() {
        $("#pesanError").html("");
        $("#pesanError").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // Ambil elemen gambar
        var imgPetugasEl = $("#ttdPetugas img");
        if (imgPetugasEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Petugas belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        var isPetugasNew = (imgPetugasEl.attr('data-is-new') === 'true' || imgPetugasEl.data('is-new') === true);
        var ttdPetugas = isPetugasNew ? imgPetugasEl.attr('src') : '';


        $.ajax({
            url: '<?= base_url() ?>rm/rm7bPengkajian/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
                ttdPetugas: ttdPetugas,
                "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
            },
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

    document.addEventListener('DOMContentLoaded', () => {
        //ttd petugas
        const canvasPetugas = document.getElementById('tempatTtdPetugas');
        const ctxPetugas = canvasPetugas.getContext('2d');
        const hapusTtdPetugas = document.getElementById('hapusTtdPetugas');
        const simpanTtdPetugas = document.getElementById('simpanTtdPetugas');
        const hasilTtdPetugas = document.getElementById('ttdPetugas');


        //=====Petugasiii====
        let drawingPetugas = false;
        let lastXPetugas = 0;
        let lastYPetugas = 0;

        // Set drawing styles
        ctxPetugas.lineWidth = 2;
        ctxPetugas.lineCap = 'round';
        ctxPetugas.strokeStyle = '#000';

        function startDrawingPetugas(e) {
            drawingPetugas = true;
            [lastXPetugas, lastYPetugas] = [e.offsetX || e.touches[0].clientX - canvasPetugas.getBoundingClientRect().left, e.offsetY || e.touches[0].clientY - canvasPetugas.getBoundingClientRect().top];
        }

        function drawPetugas(e) {
            if (!drawingPetugas) return;
            $("#simpanTtdPetugas").prop('disabled', false);
            const currentXPetugas = e.offsetX || e.touches[0].clientX - canvasPetugas.getBoundingClientRect().left;
            const currentYPetugas = e.offsetY || e.touches[0].clientY - canvasPetugas.getBoundingClientRect().top;

            ctxPetugas.beginPath();
            ctxPetugas.moveTo(lastXPetugas, lastYPetugas);
            ctxPetugas.lineTo(currentXPetugas, currentYPetugas);
            ctxPetugas.stroke();

            [lastXPetugas, lastYPetugas] = [currentXPetugas, currentYPetugas];
        }

        function stopDrawingPetugas() {
            drawingPetugas = false;
        }

        // Petugasiii  Event Listeners for mouse and touch
        canvasPetugas.addEventListener('mousedown', startDrawingPetugas);
        canvasPetugas.addEventListener('mousemove', drawPetugas);
        canvasPetugas.addEventListener('mouseup', stopDrawingPetugas);
        canvasPetugas.addEventListener('mouseout', stopDrawingPetugas); // Stop drawing if mouse leaves canvas

        canvasPetugas.addEventListener('touchstart', startDrawingPetugas);
        canvasPetugas.addEventListener('touchmove', drawPetugas);
        canvasPetugas.addEventListener('touchend', stopDrawingPetugas);

        // Clear button functionality
        hapusTtdPetugas.addEventListener('click', () => {
            $("#simpanTtdPetugas").prop('disabled', true);
            ctxPetugas.clearRect(0, 0, canvasPetugas.width, canvasPetugas.height);
        });

        // Save button functionality
        simpanTtdPetugas.addEventListener('click', () => {
            const dataURLPetugas = canvasPetugas.toDataURL('image/png');
            const imgPetugas = document.createElement('img');
            imgPetugas.src = dataURLPetugas;
            imgPetugas.alt = 'Tanda tangan petugas pasien';
            imgPetugas.style.maxWidth = '150px';
            imgPetugas.style.maxHeight = '100px';

            // TAMBAHKAN BARIS INI SEBAGAI PENANDA GAMBAR BARU
            imgPetugas.setAttribute('data-is-new', 'true');

            hasilTtdPetugas.innerHTML = '';
            hasilTtdPetugas.appendChild(imgPetugas);
            $("#modalTtdPetugas").modal("hide");
        });
    });
</script>

</html>