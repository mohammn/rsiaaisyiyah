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
    <title>Rm 11a1 Bedah</title>

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
                            RM 26f
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold"> PENGKAJIAN PRA BEDAH
                        </p>
                    </div>
                </div>

                <table class="table table-bordered table-sm mb-0">
                    <tr>
                        <td class="fw-bold">
                            1. ANAMNESA
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-borderless table-sm mb-0">
                                <tr>
                                    <td style="width:35%;">a. Tempat Pengkajian</td>
                                    <td>: <?= $data->rm11a1Bedah['tempatPengkajian'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>b. Keluhan Utama</td>
                                    <td>: <?= $data->rm11a1Bedah['keluhan'] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>c. Riwayat Penyakit</td>
                                    <td>:
                                        <?php
                                        $riwayat = json_decode($data->rm11a1Bedah["riwayatPenyakit"] ?? '', true);

                                        if (!empty($riwayat) && is_array($riwayat)) {
                                            // Cari posisi string "Lainnya" di dalam array
                                            $key = array_search('Lainnya', $riwayat);

                                            // Jika ada nilai "Lainnya", ganti dengan isi dari isiRiwayatLainnya (jika ada)
                                            if ($key !== false) {
                                                $isiLainnya = trim($data->rm11a1Bedah["isiRiwayatLainnya"] ?? '');
                                                if (!empty($isiLainnya)) {
                                                    $riwayat[$key] = $isiLainnya; // Mengganti "Lainnya" menjadi isi inputan kustom
                                                }
                                            }

                                            // Cetak dipisahkan koma
                                            echo implode(', ', $riwayat);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>d. Riwayat Operasi</td>
                                    <td>: Jenis Operasi : <?= ($data->rm11a1Bedah['jenisOperasi'] ?? '') ?: '_______' ?>. Lokasi : <?= ($data->rm11a1Bedah['lokasiOperasi'] ?? '') ?: '________' ?>. Tanggal : <?= ($data->rm11a1Bedah['tglOperasi'] ?? '') ?: '______' ?>.</td>
                                </tr>
                                <tr>
                                    <td>e. Riwayat Alergi</td>
                                    <td>:
                                        <?php
                                        $alergi = $data->rm11a1Bedah["riwayatAlergi"] ?? '';
                                        $isiAlergi = trim($data->rm11a1Bedah["isiAlergi"] ?? '');

                                        if (!empty($alergi)) {
                                            if ($alergi === 'Ada') {
                                                echo !empty($isiAlergi) ? "Ada ($isiAlergi)" : "Ada";
                                            } else {
                                                echo $alergi; // Mencetak "Tidak Ada" atau "Tidak Diketahui"
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">2. PEMERIKSAAN FISIK</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="ps-3">TD</td>
                                    <td>: <?= ($data->rm11a1Bedah['td'] ?? '') ?: '-' ?> mmHg</td>
                                    <td>Nadi</td>
                                    <td>: <?= ($data->rm11a1Bedah['nadi'] ?? '') ?: '-' ?> x/mnt</td>
                                    <td>Suhu</td>
                                    <td>: <?= ($data->rm11a1Bedah['suhu'] ?? '') ?: '-' ?> &deg;C</td>
                                </tr>
                                <tr>
                                    <td class="ps-3">Berat Badan</td>
                                    <td>: <?= ($data->rm11a1Bedah['td'] ?? '') ?: '-' ?> Kg</td>
                                    <td>Tinggi Badan</td>
                                    <td>: <?= ($data->rm11a1Bedah['nadi'] ?? '') ?: '-' ?> Cm</td>
                                    <td>Pernafasan</td>
                                    <td>: <?= ($data->rm11a1Bedah['suhu'] ?? '') ?: '-' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">3. HASIL PEMERIKSAAN PENUNJANG <i>(Diisi dengan hasil terbaru)</i></td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td style="width:35%;">a. Laboratorium</td>
                                    <td>: <?= ($data->rm11a1Bedah['laboratorium'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td>b. Radiologi</td>
                                    <td>: <?= ($data->rm11a1Bedah['radiologi'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td>c. Lainnya</td>
                                    <td>: <?= ($data->rm11a1Bedah['penunjangLainnya'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2">d. Apakah sudah melakukan rekonsiliasi obat yang sedang digunakan hari ini ? <?= ($data->rm11a1Bedah['rekonsiliasi'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="ps-3 pt-0"><i>(Lakukan verifikasi dengan melihat catatan obat yang masih digunakan pasien dalam pengkajian keperawatan)</i></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">
                            4. DIAGNOSA / ASESMEN
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td style="width:35%;">a. Dianosa Preoperatif / Tindakan Invasif</td>
                                    <td>: <?= ($data->rm11a1Bedah['diagnosaPreoperatif'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td>b. Diagnosa Lain</td>
                                    <td>:
                                        <?php
                                        $diagnosaLain = $data->rm11a1Bedah['diagnosaLain'] ?? '';
                                        $isiDiagnosaLain = trim($data->rm11a1Bedah['isidiagnosaLain'] ?? '');

                                        if (!empty($diagnosaLain)) {
                                            if ($diagnosaLain === 'Ada') {
                                                echo !empty($isiDiagnosaLain) ? "Ada ($isiDiagnosaLain)" : "Ada";
                                            } else {
                                                echo $diagnosaLain; // Mencetak "Tidak Ada"
                                            }
                                        } else {
                                            echo '-'; // Atau ganti '_______' jika ingin garis bawah
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td class="fw-bold">5. RENCANA TATA LAKSANA</td>
                    </tr>
                    <tr>
                        <td>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td style="width:35%;">a. Rencana Operasi / Tindakan</td>
                                    <td>: <?= ($data->rm11a1Bedah['rencanaOperasi'] ?? '') ?: '-' ?></td>
                                </tr>
                                <tr>
                                    <td>b. Sifat Prosedur</td>
                                    <td>:
                                        <?php
                                        $sifat = $data->rm11a1Bedah['sifatProsedur'] ?? '';
                                        $tglElektif = $data->rm11a1Bedah['isiElektif'] ?? '';

                                        if (!empty($sifat)) {
                                            if ($sifat === 'Elektif') {
                                                echo !empty($tglElektif) ? "Elektif ($tglElektif)" : "Elektif";
                                            } else {
                                                echo $sifat; // Mencetak "Cito" / "Urgent" / lainnya
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <!-- c. Perkiraan Lama Tindakan -->
                                <tr>
                                    <td>c. Perkiraan Lama Tindakan</td>
                                    <td>: <?= ($data->rm11a1Bedah['lamaTindakan'] ?? '') ?: '-' ?></td>
                                </tr>

                                <!-- d. Anestesia -->
                                <tr>
                                    <td>d. Anestesia</td>
                                    <td>: <?= ($data->rm11a1Bedah['anestesia'] ?? '') ?: '-' ?></td>
                                </tr>

                                <!-- e. Puasa -->
                                <tr>
                                    <td>e. Puasa</td>
                                    <td>:
                                        <?php
                                        $puasa = $data->rm11a1Bedah['puasa'] ?? '';
                                        $jamPuasa = $data->rm11a1Bedah['isiMulaiJam'] ?? '';

                                        if (!empty($puasa)) {
                                            if ($puasa === 'Mulai Jam') {
                                                echo !empty($jamPuasa) ? "Mulai Jam ($jamPuasa)" : "Mulai Jam";
                                            } else {
                                                echo $puasa;
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <!-- f. Konsultasi Bagian Terkait -->
                                <tr>
                                    <td>f. Konsultasi Bagian Terkait</td>
                                    <td>:
                                        <?php
                                        $konsul = $data->rm11a1Bedah['konsultasiBagian'] ?? '';
                                        $isiKonsul = trim($data->rm11a1Bedah['isiKonsultasi'] ?? '');

                                        if (!empty($konsul)) {
                                            if ($konsul === 'Ya') {
                                                echo !empty($isiKonsul) ? "Ya ($isiKonsul)" : "Ya";
                                            } else {
                                                echo $konsul;
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <!-- g. Peralatan Yang Digunakan -->
                                <tr>
                                    <td>g. Peralatan Yang Digunakan</td>
                                    <td>:
                                        <?php
                                        $peralatan = $data->rm11a1Bedah['peralatan'] ?? '';
                                        $isiPeralatan = trim($data->rm11a1Bedah['isiPeralatanLain'] ?? '');

                                        if (!empty($peralatan)) {
                                            if ($peralatan === 'Lain – Lain' || $peralatan === 'Lainnya') {
                                                echo !empty($isiPeralatan) ? "Lain-lain ($isiPeralatan)" : "Lain-lain";
                                            } else {
                                                echo $peralatan;
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <!-- h. Pengosongan Kandung Kemih -->
                                <tr>
                                    <td>h. Pengosongan Kandung Kemih</td>
                                    <td>: <?= ($data->rm11a1Bedah['pengosonganKemih'] ?? '') ?: '-' ?></td>
                                </tr>

                                <!-- i. Infus -->
                                <tr>
                                    <td>i. Infus</td>
                                    <td>: <?= ($data->rm11a1Bedah['infus'] ?? '') ?: '-' ?></td>
                                </tr>

                                <!-- j. Persiapan Darah -->
                                <tr>
                                    <td>j. Persiapan Darah</td>
                                    <td>:
                                        <?php
                                        $darah = $data->rm11a1Bedah['persiapanDarah'] ?? '';
                                        $wb = trim($data->rm11a1Bedah['isiWholeBlood'] ?? '');
                                        $prc = trim($data->rm11a1Bedah['isiPackedRed'] ?? '');
                                        $komponenLain = trim($data->rm11a1Bedah['isiKomponenLain'] ?? '');

                                        if (!empty($darah)) {
                                            if ($darah === 'Whole Blood') {
                                                echo "Whole Blood" . (!empty($wb) ? " ($wb Ml)" : "");
                                            } elseif ($darah === 'Pakced Red Cells' || $darah === 'Packed Red Cells') {
                                                echo "Packed Red Cells" . (!empty($prc) ? " ($prc Ml)" : "");
                                            } elseif ($darah === 'Komponen Lain') {
                                                echo "Komponen Lain" . (!empty($komponenLain) ? " ($komponenLain)" : "");
                                            } else {
                                                echo $darah; // Untuk 'Tidak Perlu' atau 'TC'
                                            }
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>

                                <!-- k. Rencana Post Operasi -->
                                <tr>
                                    <td>k. Rencana Post Operasi</td>
                                    <td>: <?= ($data->rm11a1Bedah['rencanaPostOp'] ?? '') ?: '-' ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Catatann : <?= ($data->rm11a1Bedah['catatan'] ?? '') ?: '-' ?></td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="150%" alt=""></div>
                    <div class="col-3">
                        <br><br>
                    </div>
                    <div class="col-5">
                        <div style="text-align: end;">
                            RM 26f
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold"> PENANDAAN LOKASI OPERASI
                        </p>
                    </div>
                </div>


                <table class="table table-bordered">
                    <tr>
                        <td rowspan="3">
                            <div class="text-center">
                                <!-- Wrapper Badan (360x500) -->
                                <div style="position: relative; width: 360px; height: 500px; display: inline-block;">
                                    <!-- Gambar Template Dasar -->
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/badan_wanita.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 360px; height: 500px; z-index: 1;">
                                    <!-- Coretan Medis dari DB (Jika Ada) -->
                                    <?php if (!empty($data->rm11a1Bedah['badan'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['badan']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 360px; height: 500px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <!-- Wrapper Kepala Samping (300x180) -->
                                <div style="position: relative; width: 300px; height: 180px; display: inline-block;">
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/kepala_samping.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 300px; height: 180px; z-index: 1;">
                                    <?php if (!empty($data->rm11a1Bedah['kepalaSamping'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['kepalaSamping']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 300px; height: 180px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <!-- Wrapper Kepala (300x150) -->
                                <div style="position: relative; width: 300px; height: 150px; display: inline-block;">
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/kepala.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 300px; height: 150px; z-index: 1;">
                                    <?php if (!empty($data->rm11a1Bedah['kepala'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['kepala']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 300px; height: 150px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <!-- Wrapper Telapak Tangan (300x160) -->
                                <div style="position: relative; width: 300px; height: 160px; display: inline-block;">
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/telapak_tangan.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 1;">
                                    <?php if (!empty($data->rm11a1Bedah['telapakTangan'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['telapakTangan']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <!-- Wrapper Kaki (300x160) -->
                                <div style="position: relative; width: 300px; height: 160px; display: inline-block;">
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/kaki.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 1;">
                                    <?php if (!empty($data->rm11a1Bedah['kaki'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['kaki']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <!-- Wrapper Punggung Tangan (300x160) -->
                                <div style="position: relative; width: 300px; height: 160px; display: inline-block;">
                                    <img src="<?= base_url('public/assets/img/rm11a1Bedah/punggung_tangan.png') ?>"
                                        style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 1;">
                                    <?php if (!empty($data->rm11a1Bedah['punggungTangan'])): ?>
                                        <img src="<?= base_url('public/ttd/rm11a1Bedah_penandaaan/' . $data->rm11a1Bedah['punggungTangan']) ?>"
                                            style="position: absolute; top: 0; left: 0; width: 300px; height: 160px; z-index: 2;">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>




                <div class="row text-center mt-1">
                    <div class="col-12 text-end pe-5">
                        Bangkalan, <?= $data->rm11a1Bedah['tglTtd'] ?>
                    </div>
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                                DPJP Opertor
                                <br><br>

                                <div id="ttdDokter">
                                    <?php if ($data->rm11a1Bedah["ttdDokter"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm11a1Bedah/' . $data->rm11a1Bedah["ttdDokter"]) . '" alt="tanda tangan Dokter" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm11a1Bedah["dokter"] ?? '-' ?> )
                                <br><br>
                                <?php if (!$data->rm11a1Bedah["ttdDokter"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                            <td></td>
                            <td>
                                Pasien / Wali Pasien
                                <br><br>

                                <div id="ttdWali">
                                    <?php if ($data->rm11a1Bedah["ttdWali"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm11a1Bedah/' . $data->rm11a1Bedah["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm11a1Bedah["nama"] ?> )
                                <br><br>
                                <?php if (!$data->rm11a1Bedah["ttdWali"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="noRawat" value="<?= $data->rm11a1Bedah["noRawat"] ?>">
                    <input type="hidden" id="dokter" value="<?= $data->rm11a1Bedah["dokter"] ?>">
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <?php if (!$data->rm11a1Bedah["ttdWali"]) { ?>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                            <?php } ?>
                        </div>
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


<!-- Modal ttd Wali-->
<div class="modal fade" id="modalTtdWali" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan wali</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdWali" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdWali">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdWali" disabled>Selesai</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal ttd Dokter-->
<div class="modal fade" id="modalTtdDokter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan dokter</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdDokter" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdDokter">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdDokter" disabled>Selesai</button>
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
        var imgWaliEl = $("#ttdWali img");
        var imgDokterEl = $("#ttdDokter img");
        if (imgWaliEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Wali belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        } else if (imgDokterEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Dokter belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        // PERBAIKAN: Menggunakan .attr('data-is-new') untuk membaca string 'true' secara akurat
        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';

        var isDokterNew = (imgDokterEl.attr('data-is-new') === 'true' || imgDokterEl.data('is-new') === true);
        var ttdDokter = isDokterNew ? imgDokterEl.attr('src') : '';


        $.ajax({
            url: '<?= base_url() ?>rm/rm11a1Bedah/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
                ttdWali: ttdWali,
                ttdDokter: ttdDokter,
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

    // Create a new QRCode instance
    // var qrDokter = new QRCode(document.getElementById("qrDokter"), {
    //     width: 100, // Set the width of the QR code
    //     height: 100, // Set the height of the QR code
    //     colorDark: "#000000", // Color of the dark modules (e.g., black squares)
    //     colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
    //     correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    // });

    // Generate the QR code with the desired content
    // qrDokter.makeCode("Di ttd " + $("#dokter").val() + " untuk Tata Tertib. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

    //========================================================

    document.addEventListener('DOMContentLoaded', () => {
        //ttd wali
        const canvasWali = document.getElementById('tempatTtdWali');
        const ctxWali = canvasWali.getContext('2d');
        const hapusTtdWali = document.getElementById('hapusTtdWali');
        const simpanTtdWali = document.getElementById('simpanTtdWali');
        const hasilTtdWali = document.getElementById('ttdWali');


        //=====Waliiii====
        let drawingWali = false;
        let lastXWali = 0;
        let lastYWali = 0;

        // Set drawing styles
        ctxWali.lineWidth = 2;
        ctxWali.lineCap = 'round';
        ctxWali.strokeStyle = '#000';

        function startDrawingWali(e) {
            drawingWali = true;
            [lastXWali, lastYWali] = [e.offsetX || e.touches[0].clientX - canvasWali.getBoundingClientRect().left, e.offsetY || e.touches[0].clientY - canvasWali.getBoundingClientRect().top];
        }

        function drawWali(e) {
            if (!drawingWali) return;
            $("#simpanTtdWali").prop('disabled', false);
            const currentXWali = e.offsetX || e.touches[0].clientX - canvasWali.getBoundingClientRect().left;
            const currentYWali = e.offsetY || e.touches[0].clientY - canvasWali.getBoundingClientRect().top;

            ctxWali.beginPath();
            ctxWali.moveTo(lastXWali, lastYWali);
            ctxWali.lineTo(currentXWali, currentYWali);
            ctxWali.stroke();

            [lastXWali, lastYWali] = [currentXWali, currentYWali];
        }

        function stopDrawingWali() {
            drawingWali = false;
        }

        // Waliiii  Event Listeners for mouse and touch
        canvasWali.addEventListener('mousedown', startDrawingWali);
        canvasWali.addEventListener('mousemove', drawWali);
        canvasWali.addEventListener('mouseup', stopDrawingWali);
        canvasWali.addEventListener('mouseout', stopDrawingWali); // Stop drawing if mouse leaves canvas

        canvasWali.addEventListener('touchstart', startDrawingWali);
        canvasWali.addEventListener('touchmove', drawWali);
        canvasWali.addEventListener('touchend', stopDrawingWali);

        // Clear button functionality
        hapusTtdWali.addEventListener('click', () => {
            $("#simpanTtdWali").prop('disabled', true);
            ctxWali.clearRect(0, 0, canvasWali.width, canvasWali.height);
        });

        // Save button functionality
        simpanTtdWali.addEventListener('click', () => {
            const dataURLWali = canvasWali.toDataURL('image/png');
            const imgWali = document.createElement('img');
            imgWali.src = dataURLWali;
            imgWali.alt = 'Tanda tangan wali pasien';
            imgWali.style.maxWidth = '150px';
            imgWali.style.maxHeight = '100px';

            // TAMBAHKAN BARIS INI SEBAGAI PENANDA GAMBAR BARU
            imgWali.setAttribute('data-is-new', 'true');

            hasilTtdWali.innerHTML = '';
            hasilTtdWali.appendChild(imgWali);
            $("#modalTtdWali").modal("hide");
        });

        // =============untuk ttd dokter===============
        //ttd dokter
        const canvasDokter = document.getElementById('tempatTtdDokter');
        const ctxDokter = canvasDokter.getContext('2d');
        const hapusTtdDokter = document.getElementById('hapusTtdDokter');
        const simpanTtdDokter = document.getElementById('simpanTtdDokter');
        const hasilTtdDokter = document.getElementById('ttdDokter');


        //=====Dokteriii====
        let drawingDokter = false;
        let lastXDokter = 0;
        let lastYDokter = 0;

        // Set drawing styles
        ctxDokter.lineWidth = 2;
        ctxDokter.lineCap = 'round';
        ctxDokter.strokeStyle = '#000';

        function startDrawingDokter(e) {
            drawingDokter = true;
            [lastXDokter, lastYDokter] = [e.offsetX || e.touches[0].clientX - canvasDokter.getBoundingClientRect().left, e.offsetY || e.touches[0].clientY - canvasDokter.getBoundingClientRect().top];
        }

        function drawDokter(e) {
            if (!drawingDokter) return;
            $("#simpanTtdDokter").prop('disabled', false);
            const currentXDokter = e.offsetX || e.touches[0].clientX - canvasDokter.getBoundingClientRect().left;
            const currentYDokter = e.offsetY || e.touches[0].clientY - canvasDokter.getBoundingClientRect().top;

            ctxDokter.beginPath();
            ctxDokter.moveTo(lastXDokter, lastYDokter);
            ctxDokter.lineTo(currentXDokter, currentYDokter);
            ctxDokter.stroke();

            [lastXDokter, lastYDokter] = [currentXDokter, currentYDokter];
        }

        function stopDrawingDokter() {
            drawingDokter = false;
        }

        // Dokteriii  Event Listeners for mouse and touch
        canvasDokter.addEventListener('mousedown', startDrawingDokter);
        canvasDokter.addEventListener('mousemove', drawDokter);
        canvasDokter.addEventListener('mouseup', stopDrawingDokter);
        canvasDokter.addEventListener('mouseout', stopDrawingDokter); // Stop drawing if mouse leaves canvas

        canvasDokter.addEventListener('touchstart', startDrawingDokter);
        canvasDokter.addEventListener('touchmove', drawDokter);
        canvasDokter.addEventListener('touchend', stopDrawingDokter);

        // Clear button functionality
        hapusTtdDokter.addEventListener('click', () => {
            $("#simpanTtdDokter").prop('disabled', true);
            ctxDokter.clearRect(0, 0, canvasDokter.width, canvasDokter.height);
        });

        // Save button functionality
        simpanTtdDokter.addEventListener('click', () => {
            const dataURLDokter = canvasDokter.toDataURL('image/png');
            const imgDokter = document.createElement('img');
            imgDokter.src = dataURLDokter;
            imgDokter.alt = 'Tanda tangan dokter pasien';
            imgDokter.style.maxWidth = '150px';
            imgDokter.style.maxHeight = '100px';

            // TAMBAHKAN BARIS INI SEBAGAI PENANDA GAMBAR BARU
            imgDokter.setAttribute('data-is-new', 'true');

            hasilTtdDokter.innerHTML = '';
            hasilTtdDokter.appendChild(imgDokter);
            $("#modalTtdDokter").modal("hide");
        });

    });
</script>

</html>