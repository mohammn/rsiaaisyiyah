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
        padding: 1mm;
    }

    td img {
        margin: auto;
    }

    .tabelTindakan td,
    .tabelTindakan th {
        padding: 0.3mm;
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
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="90%" alt=""></div>
                    <div class="col-5">
                        <br><br>
                    </div>
                    <div class="col-3">
                        <div style="text-align: end;">
                            RM 27a
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
                            BUNDLE PENGUMPULAN DATA SURVEILANS INFEKSI LUKA OPERASI
                        </p>
                    </div>
                </div>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td rowspan="6" class="text-center fw-bold" style="writing-mode: vertical-lr; transform: rotate(180deg); white-space: nowrap; margin: 0 auto;"><b>PRE OPERASI</b></td>
                        <td colspan="3" style="background-color: #eaeaea;"><b>Diisi oleh petugas unit pengirim (RAWIN/IGD)</b></td>
                        <td colspan="1" style="background-color: #eaeaea;"><b>Unit : </b> <?= $data->lukaOperasi["unit"] ?? '' ?></td>
                        <td style="background-color: #eaeaea;" colspan="2"><b>Nama petugas :</b> <?= $data->lukaOperasi["petugasPreOperasi"] ?? '' ?></td>
                        <td colspan="2" style="background-color: #eaeaea;">
                            <div style="display: flex; align-items: center; gap: 8px; width: 100%;">
                                <b>Paraf :</b>
                                <div id="ttdPre"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Tanggal MRS</b> <br><?= !empty($data->lukaOperasi["tglMrs"]) ? date('d/m/Y', strtotime($data->lukaOperasi["tglMrs"])) : '' ?></td>
                        <td><b>Tanggal Operasi</b> <br> <?= !empty($data->lukaOperasi["tglOperasi"]) ? date('d/m/Y', strtotime($data->lukaOperasi["tglOperasi"])) : '' ?></td>
                        <td><b>Berat Badan</b> <br><?= $data->lukaOperasi["beratBadan"] ?? '...' ?> Kg</td>
                        <td><b>Jenis Operasi</b> <br> <?= $data->lukaOperasi["jenisOps"] ?? '' ?></td>
                        <td><b>Operasi Krn Trauma</b> <br> <?= $data->lukaOperasi["trauma"] ?? '' ?></td>
                        <td><b>Diagnosa Pre Op:</b> <br> <?= $data->lukaOperasi["diagnosaPre"] ?? '' ?></td>
                        <td colspan="2"><b>Kualifikasi Dokter Bedah</b> <br>
                            <?php
                            if (!empty($data->lukaOperasi['kualifikasi'])):
                                $kualifikasiArray = json_decode($data->lukaOperasi['kualifikasi'], true);
                                if (is_array($kualifikasiArray)):
                                    $key = array_search('Lainnya', $kualifikasiArray);
                                    if ($key !== false && !empty($data->lukaOperasi['isiKualifikasiLainnya'])) {
                                        $kualifikasiArray[$key] = $data->lukaOperasi['isiKualifikasiLainnya'];
                                    }
                                    echo implode(', ', $kualifikasiArray);
                                else:
                                    echo esc($data->lukaOperasi['kualifikasi']); // Cadangan jika isinya ternyata string biasa
                                endif;
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Suhu Pasien</b><br> <?= $data->lukaOperasi["suhuPasien"] ?? '...' ?>&deg;C ( <?= $data->lukaOperasi["isiSuhuPasien"] ?? '...' ?> ) &deg;C</td>
                        <td><b>Albumin</b><br> <?= $data->lukaOperasi["albumin"] ?? '...' ?> g/dl</td>
                        <td colspan="2"><b>Gula Darah</b><br> <?= $data->lukaOperasi["gulaDarah"] ?? '...' ?> ( <?= $data->lukaOperasi["isiGulaDarah"] ?? '...' ?> )</td>
                        <td><b>Steroid Jangka Panjang</b><br> <?= $data->lukaOperasi["steroid"] == 'Ya' ? 'Ya, Nama obat : ' . $data->lukaOperasi["isiSteroid"] : $data->lukaOperasi["steroid"] ?></td>
                        <td rowspan="2" colspan="2"><b>Penyakit infeksi lain:</b><br>
                            <?php
                            if (!empty($data->lukaOperasi['penyakitInfeksi'])):
                                $kualifikasiArray = json_decode($data->lukaOperasi['penyakitInfeksi'], true);

                                if (is_array($kualifikasiArray)):
                                    $key = array_search('Lainnya', $kualifikasiArray);
                                    if ($key !== false && !empty($data->lukaOperasi['isipenyakitInfeksiLainnya'])) {
                                        $kualifikasiArray[$key] = $data->lukaOperasi['isipenyakitInfeksiLainnya'];
                                    }
                                    echo implode(', ', $kualifikasiArray);
                                else:
                                    echo esc($data->lukaOperasi['penyakitInfeksi']); // Cadangan jika isinya ternyata string biasa
                                endif;
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Merokok</b><br> <?= $data->lukaOperasi["merokok"] ?? '' ?></td>
                        <td colspan="3"><b>Penyakit saat ini</b> <br>
                            <?php
                            if (!empty($data->lukaOperasi['penyakit'])):
                                $kualifikasiArray = json_decode($data->lukaOperasi['penyakit'], true);
                                if (is_array($kualifikasiArray)):
                                    $key = array_search('Lainnya', $kualifikasiArray);
                                    if ($key !== false && !empty($data->lukaOperasi['isiPenyakitLainnya'])) {
                                        $kualifikasiArray[$key] = $data->lukaOperasi['isiPenyakitLainnya'];
                                    }
                                    echo implode(', ', $kualifikasiArray);
                                else:
                                    echo esc($data->lukaOperasi['penyakit']); // Cadangan jika isinya ternyata string biasa
                                endif;
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td><b>Radioterapi Sebelumnya</b><br> <?= $data->lukaOperasi["radioterapi"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2" rowspan="2"><b>Screening MRSA</b><br> <?= $data->lukaOperasi["mrsa"] == 'Ya' ? 'Ya, Hasil : ' . $data->lukaOperasi["hasilMrsa"] : $data->lukaOperasi["mrsa"] ?></td>
                        <td rowspan="2" colspan="2"><b>Pencukuran</b><br> <?= $data->lukaOperasi["pencukuran"] ?? '' ?></td>
                        <td><b>Waktu Pencukuran</b><br> <?= $data->lukaOperasi["waktuPencukuran"] ?? '' ?></td>
                        <td rowspan="2"><b>Mandi Sebelum OPr</b><br> <?= $data->lukaOperasi["mandi"] ?? '' ?></td>
                        <td rowspan="2" colspan="2"><b>Profilaksis</b><br> <?= $data->lukaOperasi["profilaksis"] == "Ya" ? 'Ya. Nama Obat : ' . $data->lukaOperasi["profilaksisObat"] . ' Dosis : ' . $data->lukaOperasi["profilaksisDosis"] . ' <br> diberikan jam : ' . $data->lukaOperasi["profilaksisJam"]  : 'Tidak' ?>
                            <br> <b>Skintest</b> : <?= $data->lukaOperasi["skintest"] == "Ya" ? 'Ya. Hasil : ' . $data->lukaOperasi["skintestHasil"]  : 'Tidak' ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Persiapan usus</b>
                            <br><?= $data->lukaOperasi["persiapanUsus"] == "Ya" ? 'Ya. Dengan : ' . $data->lukaOperasi["persiapanUsusDg"]  : 'Tidak' ?>
                        </td>
                    </tr>

                    <!-- baris selanjutnyaaa -->

                    <tr>
                        <td rowspan="7" class="text-center fw-bold" style="writing-mode: vertical-lr; transform: rotate(180deg); white-space: nowrap; margin: 0 auto;">DI RUANG OPERASI</td>
                        <td colspan="2" style="background-color: #eaeaea;"><b>Diisi oleh petugas IBS</b></td>
                        <td colspan="3" style="background-color: #eaeaea;"><b>Nama petugas :</b> <?= $data->lukaOperasi["petugasRuangOperasi"] ?? '' ?></td>
                        <td colspan="3" style="background-color: #eaeaea;">
                            <div style="display: flex; align-items: center; gap: 8px; width: 100%;">
                                <b>Paraf :</b>
                                <div id="ttdOps"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Ruang Operasi</b><br> <?= $data->lukaOperasi["ruangOperasi"] ?? '...' ?> Ronde : <?= $data->lukaOperasi["ronde"] ?? '...' ?></td>
                        <td colspan="2" rowspan="3"><b>Prosedur Operasi</b><br>
                            <?php
                            if (!empty($data->lukaOperasi['prosedurOperasi'])):
                                $kualifikasiArray = json_decode($data->lukaOperasi['prosedurOperasi'], true);

                                if (is_array($kualifikasiArray)):
                                    $key = array_search('Lainnya', $kualifikasiArray);
                                    if ($key !== false && !empty($data->lukaOperasi['isiprosedurOperasiLainnya'])) {
                                        $kualifikasiArray[$key] = $data->lukaOperasi['isiprosedurOperasiLainnya'];
                                    }
                                    $key = array_search('Lainnya2', $kualifikasiArray);
                                    if ($key !== false && !empty($data->lukaOperasi['isiprosedurOperasiLainnya2'])) {
                                        $kualifikasiArray[$key] = $data->lukaOperasi['isiprosedurOperasiLainnya2'];
                                    }
                                    echo implode(', ', $kualifikasiArray);
                                else:
                                    echo esc($data->lukaOperasi['prosedurOperasi']); // Cadangan jika isinya ternyata string biasa
                                endif;
                            else:
                                echo '-';
                            endif;
                            ?>
                        </td>
                        <td rowspan="3"><b>Multiprosedur dgn insisi yg sama</b><br> <?= $data->lukaOperasi["multiProsedur"] ?? '' ?></td>
                        <td rowspan="3"><b>ASA Score</b><br> <?= $data->lukaOperasi["asaScore"] ?? '' ?></td>
                        <td rowspan="3"><b>Klasifikasi Luka</b><br> <?= $data->lukaOperasi["klasifikasiLuka"] ?? '' ?></td>
                        <td><b>Jumlah Staf</b><br> <?= $data->lukaOperasi["jumlahStaff"] ?? '' ?> Orang</td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Sirkulasi udara OK</b><br> <?= $data->lukaOperasi["sirkulasi"] ?? '...' ?> x/jam</td>
                        <td rowspan="2">
                            <b>lama Operasi</b> <br>
                            Mulai Jam : <?= $data->lukaOperasi["jamMulaiOps"] ?? '...' ?> <br>
                            Selesai Jam : <?= $data->lukaOperasi["jamSelesaiOps"] ?? '...' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Tekanan Udara</b> <?= $data->lukaOperasi["tekananUdara"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Suhu Ruang operasi</b> <br> <?= $data->lukaOperasi["suhuRuang"] ?? '...' ?> &deg;C</td>
                        <td><b>Jamur AC Ruang Operasi</b> <br> <?= $data->lukaOperasi["jamurAc"] ?? '...' ?></td>
                        <td colspan="2"><b>Drain</b> <br> <?= $data->lukaOperasi["drain"] == 'Ya' ? 'Ya, Jenis : ' . $data->lukaOperasi["drainJenis"] : 'Tidak' ?></td>
                        <td><b>Antibiotik Tambahan saat OP</b><br>
                            <?= $data->lukaOperasi["antibiotik"] == "Ya" ? 'Ya. Nama Obat : ' . $data->lukaOperasi["antibiotikObat"] . ' Dosis : ' . $data->lukaOperasi["antibiotikDosis"] . ' <br> pukul : ' . $data->lukaOperasi["antibiotikJam"]  : 'Tidak' ?>
                        </td>
                        <td colspan="2"><b>Disinfeksi kulit</b> <br> <?= $data->lukaOperasi["disinfeksiKulit"] == 'Lainnya' ? $data->lukaOperasi["isiDisinfeksiKulitLainnya"] : $data->lukaOperasi["disinfeksiKulit"] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Kelembapan Ruang Operasi</b> <br> <?= $data->lukaOperasi["kelembapan"] ?? '...' ?> %</td>
                        <td rowspan="2" colspan="3"><b>Implant</b> <br> <?= $data->lukaOperasi["implant"] == 'Ya' ? 'Ya, Jenis : ' . $data->lukaOperasi["implantJenis"]  : $data->lukaOperasi["implant"] ?> <br>
                            <b>Sterilisasi Implat di CSSD :</b> <br>
                            <?= $data->lukaOperasi["sterilisasi"] ?? '...' ?>
                        </td>
                        <td rowspan="2"><b>indikator Instrument/alat steril</b> <br> <?= $data->lukaOperasi["indikator"] ?? '...' ?></td>
                        <td rowspan="2" colspan="2"><b>Diagnosa Post Op</b> <br> <?= $data->lukaOperasi["diagnosaPost"] ?? '...' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"><b>Angka Kuman Udara Ruang Operasi</b> <br> <?= $data->lukaOperasi["angkaKuman"] ?? '...' ?></td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="70%" alt=""></div>
                    <div class="col-5">
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <?php
                // --- 1. CHECKBOX TINDAKAN PER HARI ---
                $tgl = $data->lukaOperasi['tgl'] ?? [];
                if (is_string($tgl)) {
                    $tgl = json_decode($tgl, true) ?? explode(',', $tgl);
                }

                $rawatLuka = $data->lukaOperasi['rawatLuka'] ?? [];
                if (is_string($rawatLuka)) {
                    $rawatLuka = json_decode($rawatLuka, true) ?? explode(',', $rawatLuka);
                }

                $transparan = $data->lukaOperasi['transparan'] ?? [];
                if (is_string($transparan)) {
                    $transparan = json_decode($transparan, true) ?? explode(',', $transparan);
                }

                $thypafix = $data->lukaOperasi['thypafix'] ?? [];
                if (is_string($thypafix)) {
                    $thypafix = json_decode($thypafix, true) ?? explode(',', $thypafix);
                }

                // Sesuai koreksi: Menggunakan key 'drain'
                $drain = $data->lukaOperasi['drainTindakan'] ?? [];
                if (is_string($drain)) {
                    $drain = json_decode($drain, true) ?? explode(',', $drain);
                }

                $aff = $data->lukaOperasi['aff'] ?? [];
                if (is_string($aff)) {
                    $aff = json_decode($aff, true) ?? explode(',', $aff);
                }

                $angkat = $data->lukaOperasi['angkat'] ?? [];
                if (is_string($angkat)) {
                    $angkat = json_decode($angkat, true) ?? explode(',', $angkat);
                }

                // Sesuai koreksi: Menggunakan key 'antibiotik'
                $antibiotik = $data->lukaOperasi['antibiotikTindakan'] ?? [];
                if (is_string($antibiotik)) {
                    $antibiotik = json_decode($antibiotik, true) ?? explode(',', $antibiotik);
                }

                $krs = $data->lukaOperasi['krs'] ?? [];
                if (is_string($krs)) {
                    $krs = json_decode($krs, true) ?? explode(',', $krs);
                }

                $kontrol = $data->lukaOperasi['kontrol'] ?? [];
                if (is_string($kontrol)) {
                    $kontrol = json_decode($kontrol, true) ?? explode(',', $kontrol);
                }

                $mrs = $data->lukaOperasi['mrs'] ?? [];
                if (is_string($mrs)) {
                    $mrs = json_decode($mrs, true) ?? explode(',', $mrs);
                }


                // --- 2. CHECKBOX IDENTIFIKASI ILO PER HARI ---
                $nyeri = $data->lukaOperasi['nyeri'] ?? [];
                if (is_string($nyeri)) {
                    $nyeri = json_decode($nyeri, true) ?? explode(',', $nyeri);
                }

                $demam = $data->lukaOperasi['demam'] ?? [];
                if (is_string($demam)) {
                    $demam = json_decode($demam, true) ?? explode(',', $demam);
                }

                $kemerahan = $data->lukaOperasi['kemerahan'] ?? [];
                if (is_string($kemerahan)) {
                    $kemerahan = json_decode($kemerahan, true) ?? explode(',', $kemerahan);
                }

                $drainase = $data->lukaOperasi['drainase'] ?? [];
                if (is_string($drainase)) {
                    $drainase = json_decode($drainase, true) ?? explode(',', $drainase);
                }

                $bengkak = $data->lukaOperasi['bengkak'] ?? [];
                if (is_string($bengkak)) {
                    $bengkak = json_decode($bengkak, true) ?? explode(',', $bengkak);
                }

                $kuman = $data->lukaOperasi['kuman'] ?? [];
                if (is_string($kuman)) {
                    $kuman = json_decode($kuman, true) ?? explode(',', $kuman);
                }

                $ada = $data->lukaOperasi['ada'] ?? [];
                if (is_string($ada)) {
                    $ada = json_decode($ada, true) ?? explode(',', $ada);
                }

                $diagnosa = $data->lukaOperasi['diagnosa'] ?? [];
                if (is_string($diagnosa)) {
                    $diagnosa = json_decode($diagnosa, true) ?? explode(',', $diagnosa);
                }
                ?>

                <?php
                // 1. Ambil hanya kolom hari yang memiliki petugas
                $kolomAktif = [];
                for ($i = 1; $i <= 10; $i++) {
                    if (!empty($data->lukaOperasi["petugas" . $i])) {
                        $kolomAktif[] = $i;
                    }
                }

                // 2. Hitung sisa kolom untuk menyeimbangkan colspan
                $jumlahKolomAktif = count($kolomAktif);
                $totalColspanHeader = $jumlahKolomAktif + 1; // Label + Kolom Aktif
                $totalColspanILO    = $jumlahKolomAktif + 2; // Total kolom dalam satu baris normal

                // Bagi sisa kolom bawah secara proporsional agar tidak pecah
                $colspanBawahKiri = max(2, ceil($totalColspanILO / 3));
                $colspanBawahKanan = $totalColspanILO - $colspanBawahKiri;
                ?>

                <table class="table table-bordered table-striped tabelTindakan mb-0">
                    <tr>
                        <th rowspan="25" class="text-center" style="writing-mode: vertical-lr; transform: rotate(180deg); white-space: nowrap; margin: 0 auto;">POST OPERASI</th>
                        <th colspan="<?= $totalColspanHeader ?>" class="text-center">
                            Beri Tanda (√) Sesuai Tindakan dan Gejala.
                        </th>
                        <th rowspan="2" class="text-center align-middle">Ket.</th>
                    </tr>
                    <tr>
                        <th>Post Ops Hari ke-</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle"><?= $i ?></td>
                        <?php endforeach; ?>
                    </tr>
                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Tanggal</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= !empty($tgl[$i - 1]) ? (new DateTime($tgl[$i - 1]))->format('d/m/Y') : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Rwt Luka</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $rawatLuka) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketRawatLuka'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Dressing : Transparan</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $transparan) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketTransparan'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Dressing : Thypafix</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $thypafix) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketThypafix'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">
                            Buang cairan/membuka drain (<?= $data->lukaOperasi["buangCairan"] ?? '' ?>)
                        </th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $drain) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketDrain'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Aff drain, oleh <?= $data->lukaOperasi["affDrain"] ?? '' ?></th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $aff) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketAff'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Angkat Jahitan</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $angkat) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketAngkat'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Antibiotik (<?= $data->lukaOperasi['isiAntibiotik'] ?? '' ?>) </th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $antibiotik) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketAntibiotik'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">KRS. Kontrol Tgl</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $krs) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketKrs'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kontrol Poli</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $kontrol) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketKontrol'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">MRS ulang</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $mrs) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketMrs'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-warning bg-opacity-25 text-dark small fw-bold text-uppercase" style="letter-spacing: 0.5px;">
                            IDENTIFIKASI ILO
                        </th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="bg-warning bg-opacity-10"></td>
                        <?php endforeach; ?>
                        <td class="bg-warning bg-opacity-10"></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Nyeri lokal dan sakit</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $nyeri) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketNyeri'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Demam (&ge; 38&deg;C)</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $demam) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketDemam'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kemerahan</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $kemerahan) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketKemerahan'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Drainase purulen / pus</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $drainase) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketDrainase'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Bengkak terlokalisir</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $bengkak) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketBengkak'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Kuman pada kultur pus</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $kuman) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketKuman'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Ada abses saat re-operasai /pemeriksaan radiologi/PA</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $ada) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketAda'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Diagnosa Dokter : SSI</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle">
                                <?= in_array($i, $diagnosa) ? '√' : '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td><?= $data->lukaOperasi['ketDiagnosa'] ?? '' ?></td>
                    </tr>

                    <tr>
                        <th class="align-middle bg-light text-secondary small fw-bold">Nama Petugas</th>
                        <?php foreach ($kolomAktif as $i): ?>
                            <td class="text-center align-middle" style="font-size: 0.4rem;">
                                <div id='qr<?= $i ?>'></div>
                                <?= $data->lukaOperasi["petugas" . $i] ?? '' ?>
                            </td>
                        <?php endforeach; ?>
                        <td></td>
                    </tr>

                    <tr>
                        <td colspan="<?= $colspanBawahKiri ?>">
                            <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jenis lokasi infeksi : </label>
                            <?= $data->lukaOperasi["jenisLokasi"] ?? '' ?>
                        </td>
                        <td colspan="<?= $colspanBawahKanan ?>">
                            <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lokasi Spesifik Untuk Infeksi Organ / Rongga : </label>
                            <?= (isset($data->lukaOperasi["lokasiSpesifik"]) && $data->lukaOperasi["lokasiSpesifik"] === 'lainnya') ? ($data->lukaOperasi['isiLokasiSpesifikLainnya'] ?? '') : ($data->lukaOperasi["lokasiSpesifik"] ?? '') ?>
                        </td>
                    </tr>
                </table>

                <div class="row m-2">
                    <div class="col-4 border border-secondary">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jenis lokasi infeksi : </label>
                        <?= $data->lukaOperasi["jenisLokasi"] ?>
                    </div>
                    <div class="col-8 border border-secondary">
                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Lokasi Spesifik Untuk Infeksi Organ / Rongga : </label> <?= $data->lukaOperasi["lokasiSpesifik"] === 'lainnya' ? $data->lukaOperasi['isiLokasiSpesifikLainnya'] : $data->lukaOperasi["lokasiSpesifik"] ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-6">
                        <h6 class="fw-bold mb-2 small text-dark">ASA Scoring:</h6>
                        <ol class="ps-3 mb-0" style="list-style-type: decimal;">
                            <li class="small">Pasien sehat</li>
                            <li class="small">Pasien dengan gangguan sistemik ringan-sedang</li>
                            <li class="small">Pasien dengan gangguan sistemik berat aktivitas.</li>
                            <li class="small" value="4">Pasien dengan gangguan sistemik berat yang mengancam kehidupan</li>
                            <li class="small">Pasien tidak diharapkan hidup walaupun dioperasi ataun tidak tindakan dapat meninggal dalam 24 jam.</li>
                        </ol>
                    </div>
                    <div class="col-sm-6">
                        <div class="mb-3">
                            <h6 class="fw-bold mb-2 small text-dark">Definisi Tingkat Kontaminasi Daerah Operasi</h6>
                            <ol class="ps-3 mb-0" style="list-style-type: decimal; text-align: justify;">
                                <li class="small mb-1">
                                    <strong>Bersih :</strong> Luka operasi tidak infeksi, tidak ada inflamasi dan tidak membuka traktus respiratorius/orofaring, traktus gastrointestinal/biliar, traktus genitourinarius dimana kasus luka operasi ini ditutup secara primer serta sistem drainase tertutup.
                                </li>
                                <li class="small mb-1">
                                    <strong>Bersih Terkontaminasi :</strong> Luka operasi yang memasuki / membuka traktus respiratorius, pencernaan/biliar, appendiks, vagina dan orofaring.
                                </li>
                                <li class="small mb-1">
                                    <strong>Terkontaminasi :</strong> Luka operasi yang membuka semua sistem traktus kecuali ovarium dan nyata terjadi pencemaran (perforasi) baru dan luka trauma dan insisi yang akut &lt; 6 jam - inflamasi non purulen.
                                </li>
                                <li class="small">
                                    <strong>Luka kotor :</strong> Luka traumatik &gt; 6 jam dengan hilangnya jaringan dan tampak infeksi atau perforasi visceral.
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    <?php for ($i = 1; $i <= 10; $i++):
        if ($data->lukaOperasi["petugas" . $i]):
            echo 'var qrcode = new QRCode(document.getElementById("qr' . $i . '"), { width: 30, height: 30, colorDark: "#000000", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.L});';
            echo 'qrcode.makeCode("ttd' . $data->lukaOperasi["petugas" . $i] . '");';
        endif;
    endfor; ?>

    <?php if ($data->lukaOperasi["petugasRuangOperasi"]) : ?>
        var qrRops = new QRCode(document.getElementById("ttdOps"), {
            width: 30, // Set the width of the QR code
            height: 30, // Set the height of the QR code
            colorDark: "#000000", // Color of the dark modules (e.g., black squares)
            colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
            correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
        });
        qrRops.makeCode("ttd <?= $data->lukaOperasi["petugasRuangOperasi"] ?>"); // Replace with your desired text or URL
    <?php endif; ?>


    <?php if ($data->lukaOperasi["petugasPreOperasi"]) : ?>
        var qrPre = new QRCode(document.getElementById("ttdPre"), {
            width: 30, // Set the width of the QR code
            height: 30, // Set the height of the QR code
            colorDark: "#000000", // Color of the dark modules (e.g., black squares)
            colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
            correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
        });
        qrPre.makeCode("ttd <?= $data->lukaOperasi["petugasPreOperasi"] ?>"); // Replace with your desired text or URL
    <?php endif; ?>

    // Create a new QRCode instance
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });



    // Generate the QR code with the desired content
    qrcode.makeCode("Di ttd oleh " + $("#dokter").val() + " untuk Informed concent. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

    //========================================================
</script>

</html>