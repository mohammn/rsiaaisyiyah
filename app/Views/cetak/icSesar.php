<?php

/** @var object $data */
if ($data->icSesar) {
    $tglLahir = new \DateTime($data->icSesar["tanggalLahir"]);
}

$tglLahirPasien = new \DateTime($data->pasien["tgl_lahir"]);
$today = new \DateTime();

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
    <title>Cetak IC Sesar</title>

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
                            RM 23h
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
                            <p style="font-size: 14pt; margin:0;" class="text-uppercase"><i><b>INFORMED CONSENT </b></i> TINDAKAN <i>SECTIO CAESARIA</i>
                            </p>
                        </th>
                    </tr>
                    <tr class="text-center">
                        <th style="background-color: #eaeaea;" colspan="4">
                            <p style="font-size: 11pt; margin:0;"><b>PEMBERIAN INFORMASI</b></p>
                        </th>
                    </tr>
                    <tr>
                        <td colspan="2">Dokter Pelaksana Tindakan</td>
                        <td colspan="2"><?= $data->icSesar['dokter'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Pemberi informasi</td>
                        <td colspan="2"><?= $data->icSesar['dokter'] ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Penerima informasi*</td>
                        <td colspan="2"><?= $data->icSesar['nama'] ?></td>
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
                        <td style="width: 80%;">
                            <?= $data->icSesar['diagnosa'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="width: 5%; font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">2</td>
                        <td>
                            Dasar diagnosis
                        </td>
                        <td>
                            Anamnesa, pemeriksaan fisik, USG.
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">3</td>
                        <td>
                            Tindakan Kedokteran
                        </td>
                        <td>
                            <i>Sectio Caesaria</i>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">4</td>
                        <td>Indikasi tindakan</td>
                        <td>
                            <b class="fw-bold">Indikasi ibu : </b>
                            <?php
                            $indikasiIbu = !empty($data->icSesar['indikasiIbu']) ? explode('|', $data->icSesar['indikasiIbu']) : [];
                            $keyLainnya = array_search('Lainnya', $indikasiIbu);
                            if ($keyLainnya !== false && !empty($data->icSesar['indikasiIbuLainnya'])) {
                                $indikasiIbu[$keyLainnya] = 'Lainnya: ' . $data->icSesar['indikasiIbuLainnya'];
                            }
                            ?>

                            <?php if (!empty($indikasiIbu)): ?>
                                <?= esc(implode(', ', $indikasiIbu)) ?>.
                            <?php else: ?>
                                <span class="text-muted small italic">Tidak ada indikasi.</span>
                            <?php endif; ?>

                            <br>

                            <b class="fw-bold">Indikasi Janin : </b>
                            <?php
                            $indikasiJanin = !empty($data->icSesar['indikasiJanin']) ? explode('|', $data->icSesar['indikasiJanin']) : [];

                            $keyLainnyaJanin = array_search('Lainnya', $indikasiJanin);
                            if ($keyLainnyaJanin !== false && !empty($data->icSesar['indikasiJaninLainnya'])) {
                                $indikasiJanin[$keyLainnyaJanin] = 'Lainnya: ' . $data->icSesar['indikasiJaninLainnya'];
                            }
                            ?>

                            <?php if (!empty($indikasiJanin)): ?>
                                <?= esc(implode(', ', $indikasiJanin)) ?>.
                            <?php else: ?>
                                <span class="text-muted small italic">Tidak ada indikasi.</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">5</td>
                        <td>Tata cara</td>
                        <td>
                            Insisi perut (<i>Sectio Caesaria</i>).
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">6</td>
                        <td>Tujuan</td>
                        <td>
                            Mengeluarkan bayi dari dalam rahim melalui prosedr pembedahan apabila persalinan normal tidak meumungkinkan karena ada faktor resiko ibu maupun janin.
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">7</td>
                        <td>Risiko</td>
                        <td>
                            Robekan rahim (4,8-10,1%), kehilangan darah > 1 liter
                            (7,3%-9,2%), cedera kandung kemih, usus (0,5%-
                            0,8%), angkat rahim (0,7%-0,8%), perawatan ICU
                            (0,9%), kematian ibu (1/12000).
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">8</td>
                        <td>Komplikasi</td>
                        <td>
                            Infeksi dalam rahim (5,2%), infeksi luka operasi
                            (3,9%).
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>Prognosis</td>
                        <td>
                            Tergantung kondisi ibu dan janin.
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>Alternatif</td>
                        <td>
                            <?= $data->icSesar['alternatif'] ?>
                        </td>
                        <td class="text-center text-success fw-bold" style="font-size: 1.2rem;">✔</td>
                    </tr>
                    <tr>
                        <td class="text-center">9</td>
                        <td>Lain - lain</td>
                        <td>
                            <?= $data->icSesar['lainLain'] ?>
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
                            <div class="text-muted" style="font-size: 7pt;">( <?= $data->icSesar['dokter'] ? $data->icSesar['dokter'] : '............................' ?> )</div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3" class="p-1" style="vertical-align: top; height: 100px;">
                            Dengan ini menyatakan bahwa saya / keluarga pasien telah menerima informasi sebagaimana di atas yang saya beri tanda / paraf di kolom kanan serta telah diberi kesempatan untuk bertanya / berdiskusi, dan telah memahaminya.
                        </td>
                        <td class="text-center" style="vertical-align: top; font-size: 0.9rem;">
                            <div>Penerima Informasi</div>
                            <?php if ($data->icSesar["ttdWali"]) {
                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                echo '<img src="' . base_url('public/ttd/icSesar/' . $data->icSesar["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 50px;" data-is-new="false">';
                            } else {
                                echo '<br><br>';
                            } ?>
                            <div class="text-muted" style="font-size: 7pt;">( <?= $data->icSesar['nama'] ? $data->icSesar['nama'] : '............................' ?> )</div>
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

            </div>
        </div>

        <div class="page">
            <div class="subpage">
                <div class="container my-4 text-dark" style="max-width: 800px; font-family: 'Times New Roman', Times, serif; line-height: 1.6;">
                    <div class="card p-5 border-dark shadow-sm">

                        <div class="text-center mb-1">
                            <p style="font-size: 14pt;"><b><?= $data->icSesar['jenis'] ?> TINDAKAN KEDOKTERAN</b></p>
                        </div>

                        <div class="mb-1">
                            <p class="mb-1">Saya yang bertanda tangan di bawah ini :</p>

                            <div class="row mb-1">
                                <div class="col-4">Nama</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->icSesar['nama'] ?>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Tanggal lahir / Jenis kelamin</div>
                                <div class="col-8 d-flex align-items-center">
                                    <span class="me-2">:</span>
                                    <?= $data->icSesar["tempatLahir"] . ", " . $tglLahir->format('d-m-Y')  ?></td>
                                    <span class="ms-3">/ <?= $data->icSesar["jk"] == "L" ? 'LAKI - LAKI' : ' PEREMPUAN' ?></span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Alamat</div>
                                <div class="col-8 d-flex align-items-end flex-column">
                                    <div class="w-100 d-flex">
                                        <span class="me-2">:</span>
                                        <?= $data->icSesar['alamat'] ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Bukti diri / KTP</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->icSesar['nik'] ?>
                                </div>
                            </div>
                        </div>

                        <p class="mb-2">Dengan ini menyatakan dengan sesungguhnya telah memberikan :</p>

                        <div class="text-center mb-1">
                            <p style="font-size: 14pt;"><b><?= $data->icSesar['jenis'] ?></b></p>
                        </div>

                        <div class="mb-2">
                            <div class="row mb-1">
                                <div class="col-12 d-flex align-items-center">
                                    <span class="me-2">Untuk dilakukan tindakan medis berupa :</span>
                                    <?= $data->icSesar['tindakanMedis'] ?>
                                </div>
                            </div>

                            <p class="mb-3 fw-bold">Terhadap : <?= $data->icSesar['sebagai'] ?></p>

                            <div class="row mb-1">
                                <div class="col-4">Nama</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['nm_pasien'] ?>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Tanggal lahir / Jenis kelamin</div>
                                <div class="col-8 d-flex align-items-center">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien["tmp_lahir"] . ", " . $tglLahirPasien->format('d-m-Y') ?>
                                    <span class="ms-3">/ <?= $data->pasien["jk"] == "L" ? 'LAKI - LAKI' : ' PEREMPUAN' ?></span>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Alamat</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['alamat'] ?>
                                </div>
                            </div>

                            <div class="row mb-1">
                                <div class="col-4">Dirawat di</div>
                                <div class="col-8 d-flex">
                                    <span class="me-2">:</span>
                                    <?= $data->pasien['nm_bangsal'] ? $data->pasien['nm_bangsal'] : '-' ?>
                                </div>
                            </div>

                            <div class="row mb-1">
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

                        <div class="row text-center mt-1">
                            <div class="col-12 text-end">
                                Bangkalan, <?= $data->icSesar['tglTtd'] ?>
                            </div>
                            <table class="table table-borderless">
                                <tr class="text-center" style="margin:auto;">
                                    <td>
                                        Dokter
                                        <br>
                                        <br>
                                        <div id="qrcode" class="pt-2"></div>
                                        <br>
                                        (<?= $data->icSesar["dokter"] ?> )
                                    </td>
                                    <td>
                                        Saksi
                                        <br><br>
                                        <div id="ttdSaksi">
                                            <?php if ($data->icSesar["ttdSaksi"]) {
                                                // SOLUSI: Menggunakan base_url() murni yang digabung dengan string path
                                                $urlSaksi = base_url() . 'public/ttd/icSesar/' . $data->icSesar["ttdSaksi"];
                                                echo '<img src="' . $urlSaksi . '" alt="tanda tangan Saksi" style="max-width: 150px; max-height: 100px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->icSesar["saksi"] ?> )
                                        <br><br>
                                        <?php if (!$data->icSesar["ttdSaksi"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdSaksi">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        Pasien / Wali Pasien
                                        <br><br>

                                        <div id="ttdWali">
                                            <?php if ($data->icSesar["ttdWali"]) {
                                                // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                                echo '<img src="' . base_url('public/ttd/icSesar/' . $data->icSesar["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                            } else {
                                                echo '<br><br><br><br><br>';
                                            } ?>
                                        </div>
                                        <br>
                                        (<?= $data->icSesar["nama"] ?> )
                                        <br><br>
                                        <?php if (!$data->icSesar["ttdWali"]) { ?>
                                            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                                Tanda tangan
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                            <input type="hidden" id="noRawat" value="<?= $data->icSesar["noRawat"] ?>">
                            <input type="hidden" id="dokter" value="<?= $data->icSesar["dokter"] ?>">
                            <div class="row mt-2">
                                <div class="col-12 text-center">
                                    <div class="" id="pesanError"></div>
                                    <?php if (!$data->icSesar["ttdWali"] and !$data->icSesar["ttdSaksi"]) { ?>
                                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                                    <?php } ?>
                                </div>
                            </div>
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
            url: '<?= base_url() ?>rm/icSesar/simpanTtd',
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