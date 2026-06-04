<?php

/** @var object $data */
if ($data->icDarah) {
    $tglLahir = new \DateTime($data->icDarah["tanggalLahir"]);
}

$tglLahirPasien = new \DateTime($data->pasien["tgl_lahir"]);
$today = new \DateTime();

$tglTtd = $data->icDarah['tglTtd'] ?? ''; // Contoh: "4 Juni 2026, Pukul 00:26 WIB"

if (!empty($tglTtd)) {
    // Pecah string berdasarkan karakter ", Pukul "
    $tglTtd = explode(', Pukul ', $tglTtd);

    // Ambil hasilnya
    $tanggalTtd = $tglTtd[0]; // Hasil: "4 Juni 2026"
    $jamTtd     = $tglTtd[1] ?? ''; // Hasil: "00:26 WIB"
    $jamTtd = explode(' WIB', $jamTtd);
    $jamTtd = $jamTtd[0];
} else {
    $tanggalTtd = '';
    $jamTtd     = '';
}

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
    <title>Cetak IC Darah</title>

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
                            RM 23d
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

                <table class="table table-bordered table-sm">
                    <tr class="text-center">
                        <th style="background-color: #eaeaea;" colspan="4">
                            <p style="font-size: 14pt; margin:0;" class="text-uppercase"><i><b>INFORMED CONSENT </b></i> PEMBERIAN DARAH DAN PRODUK DARAH
                            </p>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th style="background-color: #eaeaea;" colspan="4">
                            <p style="font-size: 11pt; margin:0;"><b>PEMBERIAN INFORMASI</b></p>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">Nama Dokter yang Meminta Darah</td>
                        <td colspan="2"><?= $data->icDarah['dokter'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Pemberi informasi</td>
                        <td colspan="2"><?= $data->icDarah['dokter'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Penerima informasi*</td>
                        <td colspan="2"><?= $data->icDarah['nama'] ?></td>
                    </tr>
                    <tr style="font-size: 8pt;">
                        <td colspan="2">Diberikan pada waktu</td>
                        <td>Tanggal : <?= $tanggalTtd ?></td>
                        <td>Jam : <?= $jamTtd ?></td>
                    </tr>
                    <tr class="text-center">
                        <th>No.</th>
                        <th>JENIS INFORMASI</th>
                        <th>ISI INFORMASI</th>
                        <th>TANDA (&#10004;)</th>
                    </tr>
                    <tr>
                        <td class="text-center" style="width: 2%;">1</td>
                        <td style="width: 15%;">Diagnosis</td>
                        <td style="width: 75%;">
                            <?= $data->icDarah['diagnosis'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="width: 10%; font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>
                            Dasar diagnosis
                        </td>
                        <td>
                            <?= $data->icDarah['dasarDiagnosis'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>
                            Tindakan Kedokteran
                        </td>
                        <td>
                            <p class="fw-bold mb-1">Jenis / Komponen Darah :</p>
                            <?php
                            $darahString = !empty($data->icDarah['darah']) ? $data->icDarah['darah'] : '';
                            $darah = !empty($darahString) ? explode('|', $darahString) : [];
                            ?>
                            <?php if (!empty($darah)): ?>
                                <ol type="a" class="ps-3 mb-0">
                                    <?php foreach ($darah as $item): ?>
                                        <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ol>
                                Jenis / komponen darah tersebut diberikan kepada pasien sesuai indikasi.
                            <?php else: ?>
                                <p class="text-muted small italic">Tidak ada jenis/komponen darah yang diberikan.</p>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>
                            Indikasi Tindakan
                        </td>
                        <td>
                            <?php
                            // Mengambil data dari object $data->icIndikasi
                            $indikasi = !empty($data->icDarah['indikasi']) ? explode('|', $data->icDarah['indikasi']) : [];
                            ?>

                            <?php if (!empty($indikasi)): ?>
                                <ol type="a" class="ps-3 mb-0">
                                    <?php foreach ($indikasi as $item): ?>
                                        <li><?= esc($item) ?></li>
                                    <?php endforeach; ?>
                                </ol>
                            <?php else: ?>
                                <p class="text-muted small italic">Tidak ada indikasi yang dipilih.</p>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Tata Cara</td>
                        <td>
                            <ol class="ps-3 mb-0">
                                <li>Menginformasikan kepada pasien/ keluarga tentang tindakan yang akan dilakukan;</li>
                                <li>
                                    Kemudian siapkan peralatan sebagai berikut :
                                    <ol type="a" class="ps-3text-muted">
                                        <li class="fst-italic">Blood Set;</li>
                                        <li class="fst-italic">Abbocath sesuai kebutuhan;</li>
                                        <li>Cairan infuse NaCl 0,9 %;</li>
                                        <li class="fst-italic">ET (Extention Tubing), three way;</li>
                                        <li class="fst-italic">Transfusion pump;</li>
                                        <li class="fst-italic">Blood warmer (jika diperlukan);</li>
                                        <li>Labu darah (sesuai dengan jenis dan golongan darah);</li>
                                        <li>Sarung tangan dan <span class="fst-italic">nierbekken</span>.</li>
                                    </ol>
                                </li>
                                <li>Periksa kelayakan darah dalam labu seperti warna dan bentuknya;</li>
                                <li>
                                    Cocokkan nama pasien, tanggal lahir, golongan darah, nomor labu darah, tanggal pengambilan dan tanggal kadaluarsa antara kartu labu darah, label labu darah, formulir permintaan serta status pasien.
                                    Pencocokan data pasien, data labu darah dilakukan oleh 2 (dua) staf rumah sakit ibu dan anak Aisyiyah dalam memastikan data tersebut.
                                </li>
                            </ol>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Tujuan</td>
                        <td>
                            <ol class="ps-3 mb-0">
                                <li>
                                    Meningkatkan asupan oksigen
                                </li>
                                <li>
                                    Mempertahankan tekanan darah
                                </li>
                                <li>
                                    Memperbaiki sirkuasi darah dan mempertahankan kehidupan
                                </li>
                                <li>
                                    Mencegah dan atau mengurangi pendarahan yang abnormal
                                </li>
                            </ol>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td>Risiko</td>
                        <td>
                            <?php if ($data->icDarah['jenis'] == 'PERSETUJUAN'): ?>
                                <ol class="ps-3 mb-0">
                                    <li>
                                        Demam, gatal-gatal, berdebar-debar, menggigil, flushing (muka
                                        kemerahan), nyeri dada dan sakit kepala, pembengkakan daerah transfusi.
                                    </li>
                                    <li>
                                        Risiko berat yang sangat jarang : reaksi alergi berat, infeksi bakteri atau
                                        virus seperti hepatitis dan HIV/ AIDS dll.
                                    </li>
                                </ol>
                            <?php else : ?>
                                <ol class="ps-3 mb-0">
                                    <li>
                                        Bahaya yang serius terhadap hasil pengobatan.
                                    </li>
                                    <li>
                                        Sakit menjadi lebih berat sampai kematian.
                                    </li>
                                </ol>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td>Komplikasi</td>
                        <td>
                            <p class="mb-0">Komplikasi transfusi darah dapat dibedakan atas :</p>
                            <ol class="ps-3 mb-0">
                                <li class="mb-0">Komplikasi menurut keterlibatan sistem imun tubuh :<ol type="a" class="ps-3 mb-0">
                                        <li class="mb-0">Komplikasi imunologi (berhubungan dengan reaksi transfusi)</li>
                                        <li class="mb-0">Komplikasi non imunologi (disebabkan efek fisik dari komponen darah dan infeksi)</li>
                                    </ol>
                                </li>
                                <li class="mb-0">Komplikasi menurut waktu pemberian transfusi :<ol type="a" class="ps-3 mb-0">
                                        <li class="mb-0">Komplikasi segera (<span class="fst-italic">immediate</span>)</li>
                                        <li class="mb-0">Komplikasi tertunda (<span class="fst-italic">delayed</span>)</li>
                                    </ol>
                                </li>
                            </ol>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                </table>

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <table class="table table-bordered table-sm mt-4">
                    <tr>
                        <td class="text-center">9</td>
                        <td>Alternatif</td>
                        <td>
                            <?= $data->icDarah['alternatif'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">10</td>
                        <td>Prognosis</td>
                        <td>
                            <?= $data->icDarah['prognosis'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">11</td>
                        <td>Lain - lain</td>
                        <td>
                            <?php if (($data->icDarah['jenisBayar'] ?? '') == 'Umum') : ?>
                                Pembiayaan darah transfusi ditanggung oleh pasien dan/ atau
                                keluarga pasien termasuk darah transfusi yang sudah dipesan dan/
                                atau dibeli meskipun tidak terpakai/ sisa yang dikarenakan keadaan
                                pasien.
                            <?php elseif (($data->icDarah['jenisBayar'] ?? '') == 'BPJS') : ?>
                                Pembiayaan tranfusi darah pasien BPJS di tanggung Rumah Sakit
                            <?php else: ?>
                                <?= esc($data->icDarah['lainLain'] ?? '-') ?>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-1" style="vertical-align: top; height: 100px;">
                            Dengan ini menyatakan bahwa saya, telah menerangkan hal-hal di atas secara benar dan jelas dan memberikan kesempatan untuk bertanya / berdiskusi.
                        </td>
                        <td class="text-center" style="vertical-align: top; font-size: 0.9rem;">
                            <div>Dokter</div>
                            <div id="qrKecil" class="pt-1"></div>
                            <div class="text-muted" style="font-size: 7pt;">( <?= $data->icDarah['dokter'] ? $data->icDarah['dokter'] : '............................' ?> )</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-1" style="vertical-align: top; height: 100px;">
                            Dengan ini menyatakan bahwa saya / keluarga pasien telah menerima informasi sebagaimana di atas yang saya beri tanda / paraf di kolom kanan serta telah diberi kesempatan untuk bertanya / berdiskusi, dan telah memahaminya.
                        </td>
                        <td class="text-center" style="vertical-align: top; font-size: 0.9rem;">
                            <div>Penerima Informasi</div>
                            <?php if ($data->icDarah["ttdWali"]) {
                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                echo '<img src="' . base_url('public/ttd/icDarah/' . $data->icDarah["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                            } else {
                                echo '<br><br>';
                            } ?>
                            <div class="text-muted" style="font-size: 7pt;">( <?= $data->icDarah['nama'] ? $data->icDarah['nama'] : '............................' ?> )</div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4" class="p-2 bg-light">
                            <small class="fst-italic">
                                *) Bila pasien tidak kompeten atau tidak mau menerima informasi, maka penerima informasi adalah wali atau keluarga terdekat.
                            </small>
                        </td>
                    </tr>
                </table>

                <div class="container my-4 text-dark" style="max-width: 800px; font-family: 'Times New Roman', Times, serif; line-height: 1.6;">
                    <div class="card p-3 border-dark shadow-sm">

                        <div class="text-center">
                            <p style="font-size: 14pt;" class="mb-1"><b><?= $data->icDarah['jenis'] ?> TINDAKAN KEDOKTERAN</b></p>
                        </div>

                        <div>
                            <p class="mb-0">Saya yang bertanda tangan di bawah ini :</p>

                            <div class="row">
                                <div class="col-4">Nama</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->icDarah['nama'] ?>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Tanggal lahir / Jenis kelamin</div>
                                <div class="col-8 d-flex align-items-center">
                                    <span class="me-2">:</span>
                                    <?= $data->icDarah["tempatLahir"] . ", " . $tglLahir->format('d-m-Y')  ?></td>
                                    <span class="ms-3">/ <?= $data->icDarah["jk"] == "L" ? 'LAKI - LAKI' : ' PEREMPUAN' ?></span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Alamat</div>
                                <div class="col-8 d-flex align-items-end flex-column">
                                    <div class="w-100 d-flex">
                                        <span class="me-2">:</span>
                                        <?= $data->icDarah['alamat'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Bukti diri / KTP</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->icDarah['nik'] ?>
                                </div>
                            </div>
                        </div>

                        <p class="mb-2">Dengan ini menyatakan dengan sesungguhnya telah memberikan :</p>

                        <div class="text-center">
                            <p style="font-size: 14pt;" class="mb-1"><b><?= $data->icDarah['jenis'] ?></b></p>
                        </div>

                        <div class="mb-2">
                            <div class="row ">
                                <div class="col-12 d-flex align-items-center">
                                    <span class="me-2">Untuk dilakukan tindakan medis berupa :</span>
                                    <?= $data->icDarah['tindakanMedis'] ?>
                                </div>
                            </div>

                            <p class="mb-1 fw-bold">Terhadap : <?= $data->icDarah['sebagai'] ?></p>

                            <div class="row ">
                                <div class="col-4">Nama</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['nm_pasien'] ?>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Tanggal lahir / Jenis kelamin</div>
                                <div class="col-8 d-flex align-items-center">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien["tmp_lahir"] . ", " . $tglLahirPasien->format('d-m-Y') ?>
                                    <span class="ms-3">/ <?= $data->pasien["jk"] == "L" ? 'LAKI - LAKI' : ' PEREMPUAN' ?></span>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Alamat</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['alamat'] ?>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">Dirawat di</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['nm_bangsal'] ? $data->pasien['nm_bangsal'] : '-' ?>
                                </div>
                            </div>

                            <div class="row ">
                                <div class="col-4">No. Rekam Medik</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['no_rkm_medis'] ?>
                                </div>
                            </div>
                        </div>

                        <div class="mb-1 text-justify" style="text-align: justify;">
                            Saya memahami perlunya tindakan medis tersebut diatas, serta resiko yang dapat ditimbulkan telah
                            cukup dijelaskan oleh dokter dan telah saya mengerti sepenuhnya. Saya juga menyadari bahwa oleh
                            karena ilmu kedokteran bukanlah ilmu pasti, maka keberhasilan tindakan kedokteran bukanlah
                            keniscayaan, melainkan sangat tergantung kepada izin Tuhan Yang Maha Esa. <br>
                            <p>Demikian pernyataan ini saya buat dengan penuh kesadaran dan tanpa paksaan.</p>
                        </div>

                        <div class="row text-center">
                            <div class="col-12 text-end">
                                Bangkalan, <?= $data->icDarah['tglTtd'] ?>
                            </div>
                            <table class="table table-borderless">
                                <tr class="text-center" style="margin:auto;">
                                    <td>
                                        Dokter
                                        <br>
                                        <br>
                                        <div id="qrcode" class="pt-2"></div>
                                        <br>
                                        (<?= $data->icDarah["dokter"] ?> )
                                    </td>
                                    <td>
                                        Saksi
                                        <br><br>
                                        <div id="ttdSaksi">
                                            <?php if ($data->icDarah["ttdSaksi"]) {
                                                // SOLUSI: Menggunakan base_url() murni yang digabung dengan string path
                                                $urlSaksi = base_url() . 'public/ttd/icDarah/' . $data->icDarah["ttdSaksi"];
                                                echo '<img src="' . $urlSaksi . '" alt="tanda tangan Saksi" style="max-width: 150px; max-height: 100px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->icDarah["saksi"] ?> )
                                        <br><br>
                                        <?php if (!$data->icDarah["ttdSaksi"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdSaksi">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        Pasien / Wali Pasien
                                        <br><br>

                                        <div id="ttdWali">
                                            <?php if ($data->icDarah["ttdWali"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/icDarah/' . $data->icDarah["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->icDarah["nama"] ?> )
                                        <br><br>
                                        <?php if (!$data->icDarah["ttdWali"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            <?php if (!$data->icDarah["ttdWali"] and !$data->icDarah["ttdSaksi"]) { ?>
                                <input type="hidden" id="noRawat" value="<?= $data->icDarah["noRawat"] ?>">
                                <input type="hidden" id="dokter" value="<?= $data->icDarah["dokter"] ?>">
                                <div class="row mt-2">
                                    <div class="col-12 text-center">
                                        <div class="" id="pesanError"></div>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                                    </div>
                                </div>
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

<!-- Modal ttd Saksi-->
<div class="modal fade" id="modalTtdSaksi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Tanda tangan saksi</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bodyTtd">
                <div class="signature-container">
                    <canvas class="tempatTtd" id="tempatTtdSaksi" width="300" height="200"></canvas>
                    <div class="controls">
                        <button class="btn btn-sm btn-secondary" id="hapusTtdSaksi">Bersihkan</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" id="simpanTtdSaksi" disabled>Selesai</button>
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
        var imgSaksiEl = $("#ttdSaksi img");
        var imgWaliEl = $("#ttdWali img");

        // Cek apakah tanda tangan sudah diisi (baik baru maupun lama)
        if (imgSaksiEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Saksi belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }
        if (imgWaliEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Wali belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        // PERBAIKAN: Menggunakan .attr('data-is-new') untuk membaca string 'true' secara akurat
        var isSaksiNew = (imgSaksiEl.attr('data-is-new') === 'true' || imgSaksiEl.data('is-new') === true);
        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);

        var ttdSaksi = isSaksiNew ? imgSaksiEl.attr('src') : '';
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';

        $.ajax({
            url: '<?= base_url() ?>rm/icDarah/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
                ttdSaksi: ttdSaksi,
                ttdWali: ttdWali,
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
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    var qrKecil = new QRCode(document.getElementById("qrKecil"), {
        width: 50, // Set the width of the QR code
        height: 50, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrcode.makeCode("Di ttd oleh " + $("#dokter").val() + " untuk Informed concent. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL
    qrKecil.makeCode("Di ttd oleh " + $("#dokter").val() + " untuk Informed concent. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

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



        //ttd saksi
        const canvasSaksi = document.getElementById('tempatTtdSaksi');
        const ctxSaksi = canvasSaksi.getContext('2d');
        const hapusTtdSaksi = document.getElementById('hapusTtdSaksi');
        const simpanTtdSaksi = document.getElementById('simpanTtdSaksi');
        const hasilTtdSaksi = document.getElementById('ttdSaksi');

        //=====Waliiii====
        let drawingSaksi = false;
        let lastXSaksi = 0;
        let lastYSaksi = 0;

        // Set drawing styles
        ctxSaksi.lineWidth = 2;
        ctxSaksi.lineCap = 'round';
        ctxSaksi.strokeStyle = '#000';

        function startDrawingSaksi(e) {
            drawingSaksi = true;
            [lastXSaksi, lastYSaksi] = [e.offsetX || e.touches[0].clientX - canvasSaksi.getBoundingClientRect().left, e.offsetY || e.touches[0].clientY - canvasSaksi.getBoundingClientRect().top];
        }

        function drawSaksi(e) {
            if (!drawingSaksi) return;
            $("#simpanTtdSaksi").prop('disabled', false);
            const currentXSaksi = e.offsetX || e.touches[0].clientX - canvasSaksi.getBoundingClientRect().left;
            const currentYSaksi = e.offsetY || e.touches[0].clientY - canvasSaksi.getBoundingClientRect().top;

            ctxSaksi.beginPath();
            ctxSaksi.moveTo(lastXSaksi, lastYSaksi);
            ctxSaksi.lineTo(currentXSaksi, currentYSaksi);
            ctxSaksi.stroke();

            [lastXSaksi, lastYSaksi] = [currentXSaksi, currentYSaksi];
        }

        function stopDrawingSaksi() {
            drawingSaksi = false;
        }

        // saksiiii  Event Listeners for mouse and touch
        canvasSaksi.addEventListener('mousedown', startDrawingSaksi);
        canvasSaksi.addEventListener('mousemove', drawSaksi);
        canvasSaksi.addEventListener('mouseup', stopDrawingSaksi);
        canvasSaksi.addEventListener('mouseout', stopDrawingSaksi); // Stop drawing if mouse leaves canvas

        canvasSaksi.addEventListener('touchstart', startDrawingSaksi);
        canvasSaksi.addEventListener('touchmove', drawSaksi);
        canvasSaksi.addEventListener('touchend', stopDrawingSaksi);


        hapusTtdSaksi.addEventListener('click', () => {
            ctxSaksi.clearRect(0, 0, canvasSaksi.width, canvasSaksi.height);
            $("#simpanTtdSaksi").prop('disabled', true);
        });

        simpanTtdSaksi.addEventListener('click', () => {
            const dataURLSaksi = canvasSaksi.toDataURL('image/png');
            const imgSaksi = document.createElement('img');
            imgSaksi.src = dataURLSaksi;
            imgSaksi.alt = 'Tanda tangan saksi';
            imgSaksi.style.maxWidth = '150px';
            imgSaksi.style.maxHeight = '100px';

            // TAMBAHKAN BARIS INI SEBAGAI PENANDA GAMBAR BARU
            imgSaksi.setAttribute('data-is-new', 'true');

            hasilTtdSaksi.innerHTML = '';
            hasilTtdSaksi.appendChild(imgSaksi);
            $("#modalTtdSaksi").modal("hide");
        });
    });
</script>

</html>