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
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak HIV</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="row">
                    <div class="col-3"><br><img src="<?= base_url() ?>public/assets/img/baktiHusada.png" width="50%" alt=""></div>
                    <div class="col-6 text-center align-middle">
                        <br><br>
                        <p style="font-size: 18pt; margin:10px;" class="text-uppercase fw-bold">FORMULIR <br> TES DAN KONSELING HIV
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <img src="<?= base_url() ?>public/assets/img/aids.png" width="80%" alt="">
                    </div>
                </div>
                <hr style="height: 5px; background-color: black; border: none;">

                <table class="table table-borderless table-sm mb-1">
                    <tr>
                        <td>NO. REKAM MEDIS</td>
                        <td>: <?= $data->pasien['no_rkm_medis'] ?? '' ?></td>
                        <td>NIK</td>
                        <td>: <?= $data->pasien['no_ktp'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>NO. REGISTER</td>
                        <td>: <?= $data->pasien['no_rawat'] ?? '' ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;"><b>DATA KLIEN</b></td>
                    </tr>
                    <tr>
                        <td>
                            <b>NAMA</b>
                        </td>
                        <td colspan="3">
                            <?= $data->pasien['nm_pasien'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>ALAMAT</b>
                        </td>
                        <td colspan="3">
                            <?= $data->pasien['alamat'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>PROPINSI</b>
                        </td>
                        <td colspan="3">
                            <?= $data->pasien['nm_prop'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>KOTA/KABUPATEN</b>
                        </td>
                        <td colspan="3">
                            <?= $data->pasien['nm_kab'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>NAMA IBU KANDUNG</b>
                        </td>
                        <td colspan="3">
                            <?= $data->pasien['nm_ibu'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>JENIS KELAMIN</b> <br>
                            <?= $data->pasien['jk'] ?? '-' ?>
                        </td>
                        <td>
                            <b>STATUS PERKAWINAN</b> <br>
                            <?= $data->pasien['stts_nikah'] ?? '-' ?>
                        </td>
                        <td colspan="2">
                            <b>TANGGAL LAHIR</b><br>
                            <?= !empty($data->pasien['tgl_lahir']) && $data->pasien['tgl_lahir'] !== '0000-00-00'
                                ? date('d-m-y', strtotime($data->pasien['tgl_lahir']))
                                : '-'
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>STATUS KEHAMILAN</b> <br>
                            <?= $data->hiv['statusHamil'] ?? '-' ?>
                        </td>
                        <td>
                            <b>UMUR ANAK TERAKHIR</b> <small style="font-size: 8pt;">(Jika klien Perempuan)</small> <br>
                            <?= $data->hiv['umurAnakTerakhir'] ?? '-' ?> Tahun
                        </td>
                        <td colspan="2">
                            <b>JUMLAH ANAK KANDUNG</b> <br>
                            <?= $data->hiv['jumlahAnak'] ?? '-' ?> Orang
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>PENDIDIKAN TERAKHIR</b> <br>
                            <?= $data->pasien['pnd'] ?? '-' ?>
                        </td>

                        <td colspan="2" rowspan="5">
                            <table class="table table-sm table-bordered mb-0">
                                <tr>
                                    <td style="background-color: #eaeaea;">PASANGAN KLIEN</td>
                                </tr>
                                <tr>
                                    <td style="background-color: #eaeaea; font-size:8pt;">JIKA KLIEN PEREMPUAN</td>
                                </tr>
                                <tr>
                                    <td><b>KLIEN PUNYA PASANGAN TETAP ?</b> <?= $data->hiv['pasanganTetap'] ?? '-' ?> </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #eaeaea; font-size:8pt;">JIKA KLIEN LAKI-LAKI</td>
                                </tr>
                                <tr>
                                    <td><b>KLIEN PUNYA PASANGAN TETAP ?</b> <?= $data->hiv['pasanganPerempuan'] ?? '-' ?> </td>
                                </tr>
                                <tr>
                                    <td><b>APAKAH PASANGAN HAMIL ?</b> <?= $data->hiv['pasanganHamil'] ?? '-' ?> </td>
                                </tr>
                                <tr>
                                    <td style="background-color: #eaeaea; font-size:8pt;"></td>
                                </tr>
                                <tr>
                                    <td><b>TANGGAL LAHIR PASANGAN :</b> <?= !empty($data->hiv['tglLahirPasangan']) && $data->hiv['tglLahirPasangan'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglLahirPasangan'])) : '-' ?> </td>
                                </tr>
                                <tr>
                                    <td>
                                        <b>STATUS PASANGAN : </b> <?= $data->hiv['hasilTesPasangan'] ?? '-' ?> <br>
                                        <b>TANGGAL TES TERAKHIR PASANGAN :</b> <?= !empty($data->hiv['tglTesPasangan']) && $data->hiv['tglTesPasangan'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglTesPasangan'])) : '-' ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>PEKERJAAN</b> <br>
                            <?= $data->pasien['pekerjaan'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>KELOMPOK RISIKO</b> <br>
                            <?= isset($data->hiv['kelompokRisiko']) ? ($data->hiv['kelompokRisiko'] === 'PS' ? 'PS : ' . $data->hiv['jenisPs'] : $data->hiv['kelompokRisiko']) : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <b>Lamanya : </b> <?= $data->hiv['lamanya'] ?? '-' ?> Bulan. <small>*khusus PS dan Penasun</small>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>STATUS KUNJUNGAN</b> <br>
                            <?= $data->hiv['statusKunjungan'] ?? '-' ?>
                        </td>
                        <td>
                            <b>STATUS RUJUKAN</b> <br>
                            <?= $data->hiv['statusRujuk'] ?? '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;"><b>POPULASI KHUSUS</b></td>
                    </tr>
                    <tr>
                        <td colspan="4"><b>Klien WBP (Warga Binaan Pemasyarakatan) ? </b> <?= $data->hiv['wbp'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;"><b>KONSELING PRA TES</b></td>
                    </tr>
                    <tr>
                        <td>
                            <b>TANGGAL KONSELING PRA TES HIV</b>
                        </td>
                        <td>
                            <?= !empty($data->hiv['tglKonselingPra']) && $data->hiv['tglKonselingPra'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglKonselingPra'])) : '-' ?>
                        </td>
                        <td colspan="2"><b>STATUS KLIEN : </b> <?= $data->hiv['statusKlien'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>
                            <b>ALASAN TES HIV</b>
                        </td>
                        <td colspan="3">
                            <?php
                            $alasanArray = json_decode($data->hiv['alasanTes'] ?? '[]', true) ?? [];
                            if (($key = array_search('Lainnya', $alasanArray)) !== false) {
                                $alasanArray[$key] = $data->hiv['isiAlasanTesLainnya'] ?? 'Lainnya';
                            }
                            echo !empty($alasanArray) ? implode(', ', $alasanArray) : '-';
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>MENGETAHUI ADANYA TES DARI</b></td>
                        <td colspan="3"><?= $data->hiv['infoTes'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="fw-bold" style="background-color: #f6f6f6;">KONSELING PRA TES</td>
                    </tr>
                    <tr>
                        <td class="fw-bold">HUBUNGAN SEKS VAGINAL BERISIKO</td>
                        <td>
                            <?= !empty($data->hiv['hubVag'])
                                ? ($data->hiv['hubVag'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['hubVagTgl']) && $data->hiv['hubVagTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['hubVagTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                        <td>
                            <b>ANAL SEKS BERISIKO</b>
                        </td>
                        <td>
                            <?= !empty($data->hiv['hubAnal'])
                                ? ($data->hiv['hubAnal'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['hubAnalTgl']) && $data->hiv['hubAnalTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['hubAnalTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">BERGANTIAN PERALATAN SUNTIK</td>
                        <td>
                            <?= !empty($data->hiv['gantianSuntik'])
                                ? ($data->hiv['gantianSuntik'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['gantianSuntikTgl']) && $data->hiv['gantianSuntikTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['gantianSuntikTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                        <td>
                            <b>TRANSFUSI DARAH</b>
                        </td>
                        <td>
                            <?= !empty($data->hiv['transfusiDarah'])
                                ? ($data->hiv['transfusiDarah'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['transfusiDarahTgl']) && $data->hiv['transfusiDarahTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['transfusiDarahTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">TRANSMISI IBU KE ANAK</td>
                        <td>
                            <?= !empty($data->hiv['transmisiIbu'])
                                ? ($data->hiv['transmisiIbu'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['transmisiIbuTgl']) && $data->hiv['transmisiIbuTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['transmisiIbuTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                        <td>
                            <b>LAINNYA (SEBUTKAN)</b>
                        </td>
                        <td>
                            <?= !empty($data->hiv['isiLainnya'])
                                ? ($data->hiv['isiLainnya'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['isiLainnyaTgl']) && $data->hiv['isiLainnyaTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['isiLainnyaTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><b>PERIODE JENDELA</b><small>(Window periode)</small></td>
                        <td>
                            <?= !empty($data->hiv['periodeJendela'])
                                ? ($data->hiv['periodeJendela'] === 'Ya'
                                    ? 'Ya, Kapan : ' . (!empty($data->hiv['periodeJendelaTgl']) && $data->hiv['periodeJendelaTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['periodeJendelaTgl'])) : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                        <td>
                            <b>KESEDIAAN TES</b>
                        </td>
                        <td>
                            <?= !empty($data->hiv['kesediaanTes']) ? ($data->hiv['kesediaanTes'] === 'Ya' ? 'Ya' : 'Tidak') : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>PERNAH TES HIV SEBELUMNYA</b>
                        </td>
                        <td colspan="3">
                            <?= !empty($data->hiv['pernahTes'])
                                ? ($data->hiv['pernahTes'] === 'Ya'
                                    ? 'Ya, Dimana ? di : ' . (!empty($data->hiv['pernahTesDmn']) ? $data->hiv['pernahTesDmn'] : '-') .
                                    '. Tanggal : ' . (!empty($data->hiv['pernahTesTgl']) && $data->hiv['pernahTesTgl'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['pernahTesTgl'])) : '-') .
                                    '. Hasil : ' . (!empty($data->hiv['hasilTesSebelumnya']) ? $data->hiv['hasilTesSebelumnya'] : '-')
                                    : 'Tidak')
                                : '-'
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div class="row">
                    <div class="col-3"><br><img src="<?= base_url() ?>public/assets/img/baktiHusada.png" width="50%" alt=""></div>
                    <div class="col-6 text-center align-middle">
                        <br><br>
                        <p style="font-size: 18pt; margin:10px;" class="text-uppercase fw-bold">FORMULIR <br> TES DAN KONSELING HIV
                        </p>
                    </div>
                    <div class="col-3 text-end">
                        <img src="<?= base_url() ?>public/assets/img/aids.png" width="80%" alt="">
                    </div>
                </div>
                <hr style="height: 5px; background-color: black; border: none;">

                <table class="table table-borderless table-sm mb-1">
                    <tr>
                        <td>NO. REKAM MEDIS</td>
                        <td>: <?= $data->pasien['no_rkm_medis'] ?? '' ?></td>
                        <td>NIK</td>
                        <td>: <?= $data->pasien['no_ktp'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>NO. REGISTER</td>
                        <td>: <?= $data->pasien['no_rawat'] ?? '' ?></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>


                <table class="table table-sm table-bordered">
                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;">
                            <b>PEMBERIAN INFORMASI</b> <small><i>isikan bila penawaran tes oleh petugas kesehatan (TIPK)</i></small>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">PERNAH TES HIV SEBELUMNYA</td>
                        <td colspan="3">
                            <?= !empty($data->hiv['pernahTes2']) ? ($data->hiv['pernahTes2'] === 'Ya' ? 'Ya, Dimana ? di : ' . (!empty($data->hiv['pernahTesDmn2']) ? $data->hiv['pernahTesDmn2'] : '-') . '. Tanggal : ' .  (!empty($data->hiv['pernahTesTgl2']) ? $data->hiv['pernahTesTgl2'] : '-') . '. Hasil : ' . (!empty($data->hiv['hasilTesSebelumnya2']) ? $data->hiv['hasilTesSebelumnya2'] : '-') : 'Tidak') : '-' ?>
                        </td>

                    </tr>
                    <tr>
                        <td class="fw-bold">PENYAKIT TERKAIT PASIEN</td>
                        <td colspan="3">
                            <?php
                            // 1. Ambil data JSON dan decode menjadi Array PHP
                            $penyakitArray = json_decode($data->hiv['penyakit'] ?? '[]', true) ?? [];

                            if (!empty($penyakitArray)) {
                                // 2. Manipulasi "IMS lainnya" -> ditambahkan info dari $data->hiv['isiImsLainnya']
                                if (($keyIms = array_search('IMS lainnya', $penyakitArray)) !== false) {
                                    $detailIms = !empty($data->hiv['isiImsLainnya']) ? ' : ' . $data->hiv['isiImsLainnya'] : '';
                                    $penyakitArray[$keyIms] = 'IMS lainnya' . $detailIms;
                                }

                                // 3. Manipulasi "Lainnya" -> diganti dengan isi dari $data->hiv['isiPenyakitLainnya']
                                if (($keyLainnya = array_search('Lainnya', $penyakitArray)) !== false) {
                                    $penyakitArray[$keyLainnya] = !empty($data->hiv['isiPenyakitLainnya'])
                                        ? $data->hiv['isiPenyakitLainnya']
                                        : 'Lainnya';
                                }
                                echo implode(', ', $penyakitArray);
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>KESEDIAAN UNTUK TES</b>
                        </td>
                        <td>
                            <?= $data->hiv['kesediaanTes2'] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;">
                            <b>TES ANTIBODI HIV</b>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            TANGGAL TES HIV
                        </td>
                        <td>
                            <?= !empty($data->hiv['tglTesHiv']) && $data->hiv['tglTesHiv'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglTesHiv'])) : '-' ?>
                        </td>
                        <td class="fw-bold">
                            JENIS TES HIV
                        </td>
                        <td>
                            <?= $data->hiv['jenisTes'] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            HASIL TES R1
                        </td>
                        <td>
                            <?= $data->hiv['hasilTesR1'] ?? '' ?>
                        </td>
                        <td class="fw-bold">
                            NAMA REAGEN
                        </td>
                        <td>
                            <?= $data->hiv['reagenR1'] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            HASIL TES R2
                        </td>
                        <td>
                            <?= $data->hiv['hasilTesR2'] ?? '' ?>
                        </td>
                        <td class="fw-bold">
                            NAMA REAGEN
                        </td>
                        <td>
                            <?= $data->hiv['reagenR2'] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            HASIL TES R3
                        </td>
                        <td>
                            <?= $data->hiv['hasilTesR3'] ?? '' ?>
                        </td>
                        <td class="fw-bold">
                            NAMA REAGEN
                        </td>
                        <td>
                            <?= $data->hiv['reagenR3'] ?? '' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            NOMOR REGISTRASI NASIONAL PDP
                        </td>
                        <td>
                            <?= $data->hiv['noPdp'] ?? '' ?>
                        </td>
                        <td class="fw-bold">
                            Tgl Masuk PDP
                        </td>
                        <td>
                            <?= !empty($data->hiv['tglPdp']) && $data->hiv['tglPdp'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglPdp'])) : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            TINDAK LANJUT (TIPK)
                        </td>
                        <td colspan="3">
                            <?php
                            // 1. Ambil data JSON dan decode menjadi Array PHP
                            $tindakLanjutArray = json_decode($data->hiv['tindakLanjut'] ?? '[]', true) ?? [];

                            if (!empty($tindakLanjutArray)) {
                                // 2. Manipulasi "Rujuk ke" -> ditambahkan info dari $data->hiv['isiRujukKe']
                                if (($keyRujukKe = array_search('Rujuk ke', $tindakLanjutArray)) !== false) {
                                    $detailRujukKe = !empty($data->hiv['isiRujukKe']) ? ' : ' . $data->hiv['isiRujukKe'] : '';
                                    $tindakLanjutArray[$keyRujukKe] = 'Rujuk ke' . $detailRujukKe;
                                }

                                // 3. Manipulasi "Rujuk konseling" -> ditambahkan info dari $data->hiv['isiRujukKonseling']
                                if (($keyRujukKonseling = array_search('Rujuk konseling', $tindakLanjutArray)) !== false) {
                                    $detailKonseling = !empty($data->hiv['isiRujukKonseling']) ? ' : ' . $data->hiv['isiRujukKonseling'] : '';
                                    $tindakLanjutArray[$keyRujukKonseling] = 'Rujuk konseling' . $detailKonseling;
                                }

                                // 4. Cetak menjadi string dipisahkan koma (a, b, c, d)
                                echo implode(', ', $tindakLanjutArray);
                            } else {
                                // Jika data kosong atau null, cetak -
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;">
                        </td>
                    </tr>

                    <tr>
                        <td class="fw-bold">
                            Bagaimana Status HIV Pasangan ?
                        </td>
                        <td colspan="3">
                            <?= $data->hiv['hivPasangan'] ?? '' ?>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" style="background-color: #eaeaea;">
                            <b>KONSELING PASCA TES</b>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>TANGGAL KONSELING PASCA TES</b>
                        </td>
                        <td colspan="3">
                            <?= !empty($data->hiv['tglKonselingPasca']) && $data->hiv['tglKonselingPasca'] !== '0000-00-00' ? date('d-m-Y', strtotime($data->hiv['tglKonselingPasca'])) : '-' ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>TERIMA HASIL</b>
                        </td>
                        <td>
                            <?= $data->hiv['terimaHasil'] ?? '-' ?>
                        </td>
                        <td>
                            <b>KAJI GELAJA TB :</b> <?= $data->hiv['gejalaTb'] ?? '-' ?>
                        </td>
                        <td>
                            <b>Jumlah Kondom yang diberikan : </b> <?= $data->hiv['jmlKondom'] ?? '-' ?> Buah
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>TINDAK LANJUT (KTS)</b>
                        </td>
                        <td colspan="3">
                            <?php
                            // 1. Ambil data JSON dan decode menjadi Array PHP
                            $tindakLanjutKtsArray = json_decode($data->hiv['tindakLanjutKts'] ?? '[]', true) ?? [];

                            if (!empty($tindakLanjutKtsArray)) {
                                // 2. Manipulasi "Konseling" -> ditambahkan info dari $data->hiv['jenisKonselingKts']
                                if (($keyKonseling = array_search('Konseling', $tindakLanjutKtsArray)) !== false) {
                                    $detailKonseling = !empty($data->hiv['jenisKonselingKts']) ? ' : ' . $data->hiv['jenisKonselingKts'] : '';
                                    $tindakLanjutKtsArray[$keyKonseling] = 'Konseling' . $detailKonseling;
                                }

                                // 3. Manipulasi "Rujuk ke petugas pendukung" -> ditambahkan info dari $data->hiv['jenisPetugasPendukung']
                                if (($keyPetugas = array_search('Rujuk ke petugas pendukung', $tindakLanjutKtsArray)) !== false) {
                                    $detailPetugas = !empty($data->hiv['jenisPetugasPendukung']) ? ' : ' . $data->hiv['jenisPetugasPendukung'] : '';
                                    $tindakLanjutKtsArray[$keyPetugas] = 'Rujuk ke petugas pendukung' . $detailPetugas;
                                }

                                // 4. Cetak menjadi string dipisahkan koma (a, b, c, d)
                                echo implode(', ', $tindakLanjutKtsArray);
                            } else {
                                // Jika data kosong atau null, cetak -
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>NAMA KONSELOR / PETUGAS KESEHATAN</b>
                        </td>
                        <td colspan="3">
                            <?= $data->hiv['petugas'] ?? '-' ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>STATUS Layanan</b>
                        </td>
                        <td colspan="3">
                            <?= $data->hiv['statusLayanan'] ?? '-' ?>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b>JENIS PELAYANAN</b>
                        </td>
                        <td colspan="3">
                            <?= $data->hiv['jenisLayanan'] ?? '-' ?>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
</body>

</html>