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
        margin: 0.5cm auto;
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
        /* Ukuran F4 */
        margin: 0;
        /* Kembalikan ke 0 murni agar Kop Surat aman dari potong otomatis */
    }

    @media print {

        body,
        .book {
            width: initial;
            height: initial;
            background: none;
        }

        .page {
            margin: 0 !important;
            border: none;
            border-radius: initial;
            box-shadow: none;
            background: none;
            width: 21cm;
            height: 33cm;
            /* Kunci tinggi per halaman F4 */
            box-sizing: border-box;

            /* Amankan padding default untuk lembar pertama */
            padding: 0.8cm 0.5cm 1.5cm 1cm !important;

            page-break-after: always;
            break-after: page;
        }

        /* 🌟 TRIK INTI UNTUK LEMBAR KEDUA DAN SETERUSNYA 🌟 */
        /* Jika sebuah halaman (.page) muncul setelah halaman lain, kasih jarak atas lebih longgar */
        .page~.page {
            padding-top: 2.2cm !important;
        }

        /* Hapus margin negatif yang bikin kop surat terpotong kemarin */
        .kop-surat-container {
            margin-top: 0 !important;
        }

        /* Menjaga baris tabel atau tanda tangan tidak terbelah setengah di ujung kertas */
        table tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }
    }

    .tabel td,
    .tabel th {
        padding: 0.3mm;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Rekonsiliasi Obat</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="kop-surat-container">
                    <div class="row m-1">
                        <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="150%" alt=""></div>
                        <div class="col-3">
                            <br><br>
                        </div>
                        <div class="col-5">
                            <div style="text-align: end;">
                                RM 20a
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
                    <br><br>
                    <table class="table table-bordered align-middle text-center tabel w-90" style="font-size: 9pt; border-color: #666;">
                        <thead class="table-light align-middle fw-bold">
                            <tr>
                                <th colspan="11">
                                    <p style="font-size: 14pt; margin-top:10px;"><b>REKONSILIASI DAN RIWAYAT PENGOBATAN PASIEN</b></p>
                                </th>
                            </tr>
                            <tr>
                                <th rowspan="3" style="width: 4%;">NO</th>
                                <th rowspan="3" style="width: 21%;">JENIS OBAT<br><small class="fw-normal text-muted" style="font-size: 0.75rem;">Nama Dagang/ Generik/<br>Herbal/ Fitofarmaka</small></th>
                                <th colspan="3">PEMBERIAN</th>
                                <th rowspan="3" style="width: 15%;">WAKTU PEMBERIAN TERAKHIR</th>
                                <th colspan="2">OBAT DIGUNAKAN SAAT DIRAWAT *</th>
                                <th colspan="2">OBAT DITERUSKAN KETIKA KELUAR RS *</th>
                            </tr>
                            <tr>
                                <th rowspan="2" style="width: 12%;">DOSIS<br><small class="fw-normal text-muted" style="font-size: 0.75rem;">(mg, ml, microgram, unit)</small></th>
                                <th rowspan="2" style="width: 12%;">FREKWENSI</th>
                                <th rowspan="2" style="width: 12%;">CARA PEMBERIAN</th>
                            </tr>
                            <tr>
                                <th style="width: 5%;">YA</th>
                                <th style="width: 5%;">TIDAK</th>
                                <th style="width: 5%;">YA</th>
                                <th style="width: 5%;">TIDAK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Definisikan struktur dasar semua ruangan terlebih dahulu
                            $daftarRuanganH1 = [
                                'igd' => [
                                    'nama'   => 'INSTALASI GAWAT DARURAT',
                                    'perawat' => 'perawatIgd',
                                    'dokter' => 'dokterIgd',
                                    'farmasi' => 'farmasiIgd',
                                    'wTtdP'  => 'waktuPerawatIgd',
                                    'wTtdD' => 'waktuDokterIgd',
                                    'wTtdF' => 'waktuFarmasiIgd'
                                ],
                                'ko'  => [
                                    'nama'   => 'KAMAR OPERASI',
                                    'wajib'  => false,
                                    'perawat' => 'perawatKo',
                                    'dokter' => 'dokterKo',
                                    'farmasi' => 'farmasiKo',
                                    'wTtdP'  => 'waktuPerawatKo',
                                    'wTtdD' => 'waktuDokterKo',
                                    'wTtdF' => 'waktuFarmasiKo'
                                ],
                                'rr'  => [
                                    'nama'   => 'RUANG RECOVERY',
                                    'wajib'  => false,
                                    'perawat' => 'perawatRr',
                                    'dokter' => 'dokterRr',
                                    'farmasi' => 'farmasiRr',
                                    'wTtdP'  => 'waktuPerawatRr',
                                    'wTtdD' => 'waktuDokterRr',
                                    'wTtdF' => 'waktuFarmasiRr'
                                ],
                                'ri'  => [
                                    'nama'   => 'RAWAT INAP',
                                    'wajib'  => true,
                                    'perawat' => 'perawatRi',
                                    'dokter' => 'dokterRi',
                                    'farmasi' => 'farmasiRi',
                                    'wTtdP'  => 'waktuPerawatRi',
                                    'wTtdD' => 'waktuDokterRi',
                                    'wTtdF' => 'waktuFarmasiRi'
                                ]
                            ];

                            $rObat = $data->rekonsiliasiObat;


                            // --- LOOPING RENDER HTML ---
                            foreach ($daftarRuanganH1 as $keyRgn => $rgn) :

                                // Pengaman tambahan untuk ruangan non-wajib (KO/RR) yang tidak di-unset tapi datanya kosong total
                                $obatRuangan = [];
                                if (!empty($data->rekonsiliasiObatData) && is_array($data->rekonsiliasiObatData)) {
                                    foreach ($data->rekonsiliasiObatData as $o) {
                                        if ($o['ruangan'] === $keyRgn) {
                                            $obatRuangan[] = $o;
                                        }
                                    }
                                }
                                $adaPetugas = !empty($rObat[$rgn['perawat']]) || !empty($rObat[$rgn['dokter']]) || !empty($rObat[$rgn['farmasi']]);

                                // Jika ruangan opsional, tidak ada obat, dan tidak ada petugas, jangan render apa-apa (skip)
                                if (isset($rgn['wajib']) && $rgn['wajib'] === false && empty($obatRuangan) && !$adaPetugas) {
                                    continue;
                                }
                            ?>
                                <tr style="font-weight: bold; text-align: center;">
                                    <td colspan="10" style="padding: 5px 0; font-size: 10pt; letter-spacing: 1px; background-color: #eaeaea;">
                                        <?= $rgn['nama']; ?>
                                    </td>
                                </tr>

                                <?php if (!empty($obatRuangan)) :
                                    $no = 1;
                                    foreach ($obatRuangan as $obat) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td class="text-start" style="padding-left: 8px;"><?= esc($obat['namaObat']); ?></td>
                                            <td><?= esc($obat['dosis']); ?></td>
                                            <td><?= esc($obat['frekuensi']); ?></td>
                                            <td><?= esc($obat['caraPemberian']); ?></td>
                                            <td><?= !empty($obat['waktuTerakhir']) && $obat['waktuTerakhir'] != '0000-00-00 00:00:00' ? date('d-m-Y H:i', strtotime($obat['waktuTerakhir'])) : '-'; ?></td>
                                            <td><?= ($obat['dirawat'] === 'ya') ? '✓' : ''; ?></td>
                                            <td><?= ($obat['dirawat'] === 'tidak') ? '✓' : ''; ?></td>
                                            <td><?= ($obat['keluar'] === 'ya') ? '✓' : ''; ?></td>
                                            <td><?= ($obat['keluar'] === 'tidak') ? '✓' : ''; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td class="text-muted text-start" style="padding-left: 8px; font-style: italic;">Tidak ada data obat</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php endif; ?>

                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-bottom: none;">Nama Perawat: <?= !empty($rObat[$rgn['perawat']]) ? esc($rObat[$rgn['perawat']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; vertical-align: top; border-bottom: none;">Tanda Tangan: <br><br></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdP']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdP']])) : '____'; ?> WIB</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none; border-bottom: none;">Nama Dokter : <?= !empty($rObat[$rgn['dokter']]) ? esc($rObat[$rgn['dokter']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none; border-bottom: none;">Tanda Tangan: <br><br></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdD']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdD']])) : '____'; ?> WIB</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none;">Nama Farmasi: <?= !empty($rObat[$rgn['farmasi']]) ? esc($rObat[$rgn['farmasi']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none;">Tanda Tangan: <br><br></td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdF']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdF']])) : '____'; ?> WIB</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>