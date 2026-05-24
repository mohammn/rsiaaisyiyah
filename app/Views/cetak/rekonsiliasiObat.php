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
        padding: 0mm;
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
                            <table class="table table-borderless table-sm  mt-1 mb-1" style="font-size: xx-small;">
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
                <table class="table table-bordered align-middle text-center tabel w-90" style="font-size: 8pt; border-color: #666;">
                    <thead class="table-light align-middle fw-bold">
                        <tr>
                            <th colspan="11">
                                <p style="font-size: 14pt; margin-top:10px;"><b>REKONSILIASI DAN RIWAYAT PENGOBATAN PASIEN</b></p>
                            </th>
                        </tr>
                        <tr>
                            <td colspan="3" style="font-weight: normal !important; text-align: left; vertical-align: top; padding: 5px 8px !important;">
                                <b>Alergi :</b> <br> <?= $data->rekonsiliasiObat['alergi'] ?>
                            </td>

                            <td colspan="2" style="font-weight: normal !important; text-align: left; vertical-align: top; padding: 5px 8px !important;">
                                <b>Manifestasi Alergi :</b> <br> <?= $data->rekonsiliasiObat['manifestasi'] ?>
                            </td>

                            <td colspan="5" style="font-weight: normal !important; text-align: left; vertical-align: top; padding: 5px 8px !important;">
                                <b>Dampak :</b> <br>
                                <?= $data->rekonsiliasiObat['dampak'] == 'Tidak ada' ? '&#x2714;'  : '&#x25a2';  ?> Tidak Ada
                                <?= $data->rekonsiliasiObat['dampak'] == 'Sedang' ? '&#x2714;'  : '&#x25a2';  ?> Sedang
                                <?= $data->rekonsiliasiObat['dampak'] == 'Ringan' ? '&#x2714;'  : '&#x25a2';  ?> Ringan
                                <?= $data->rekonsiliasiObat['dampak'] == 'Berat' ? '&#x2714;'  : '&#x25a2';  ?> Berat
                            </td>
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

                        // --- LOGIKA PENGECEKAN KONDISI CETAK (PRE-PROCESS) ---

                        // 1. Fungsi bantu untuk cek apakah suatu ruangan punya data obat
                        $cekAdaObat = function ($ruanganKey) use ($data) {
                            if (!empty($data->rekonsiliasiObatData) && is_array($data->rekonsiliasiObatData)) {
                                foreach ($data->rekonsiliasiObatData as $o) {
                                    if ($o['ruangan'] === $ruanganKey) {
                                        return true; // Ditemukan minimal 1 obat
                                    }
                                }
                            }
                            return false;
                        };

                        // 2. Cek validitas masing-masing ruangan (Syarat: Ada obat DAN ada minimal 1 petugas)
                        $koMemenuhiSyarat = $cekAdaObat('ko') || (!empty($rObat['perawatKo']) || !empty($rObat['dokterKo']) || !empty($rObat['farmasiKo']));
                        $rrMemenuhiSyarat = $cekAdaObat('rr') || (!empty($rObat['perawatRr']) || !empty($rObat['dokterRr']) || !empty($rObat['farmasiRr']));

                        // 3. Eksekusi aturan Unset berantai sesuai instruksi Anda
                        if ($koMemenuhiSyarat) {
                            // Jika KO memenuhi syarat, sembunyikan RR dan RI
                            unset($daftarRuanganH1['rr']);
                            unset($daftarRuanganH1['ri']);
                        } else {
                            // Jika KO gagal, cek apakah RR memenuhi syarat
                            if ($rrMemenuhiSyarat) {
                                // Jika RR memenuhi syarat, sembunyikan RI (KO otomatis nanti tersembunyi lewat loop biasa jika kosong)
                                unset($daftarRuanganH1['ri']);
                            }
                        }

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
                                    <td class="text-muted text-start" style="padding-left: 8px; font-style: italic;">Tidak ada obat</td>
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
                                <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-bottom: none;">Tanda Tangan: <div id="ttdPerawat<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                </td>
                                <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdP']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdP']])) : '____'; ?> WIB</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none; border-bottom: none;">Nama Dokter : <?= !empty($rObat[$rgn['dokter']]) ? esc($rObat[$rgn['dokter']]) : '___________________________'; ?></td>
                                <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-top: none; border-bottom: none;">Tanda Tangan: <div id="ttdDokter<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                </td>
                                <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdD']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdD']])) : '____'; ?> WIB</td>
                            </tr>
                            <tr>
                                <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none;">Nama Farmasi: <?= !empty($rObat[$rgn['farmasi']]) ? esc($rObat[$rgn['farmasi']]) : '___________________________'; ?></td>
                                <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-top: none;">Tanda Tangan: <div id="ttdFarmasi<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                </td>
                                <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdF']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdF']])) : '____'; ?> WIB</td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (!$rrMemenuhiSyarat && !$koMemenuhiSyarat): ?>
                            <tr>
                                <td colspan="10" style="text-align:start;">
                                    &nbsp; KET :
                                    <div class="text-center">REKONSILIASI OBAT SAAT ADMISI</div>
                                    <ol>
                                        <li>Daftar obat meliputi obat resep dan non resep yang digunakan sebulan terakhir dan masih dipakai pada saat masuk
                                            rumah sakit.</li>
                                        <li>
                                            Instruksi obat baru ditulis di rencana perawatan atau daftar obat.
                                        </li>
                                        <li>
                                            Review kembali saat pasien akan pulang
                                        </li>
                                        <li>
                                            *Beri tanda &#x2713 sesuai pilihan
                                        </li>
                                    </ol>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if ($koMemenuhiSyarat || $rrMemenuhiSyarat) : ?>
            <div class="page">
                <div class="subpage">
                    <div class="row m-1">
                        <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="150%" alt=""></div>
                        <div class="col-3">
                            <br><br>
                        </div>
                        <div class="col-5">
                        </div>
                    </div>
                    <table class="table table-bordered align-middle text-center tabel w-90" style="font-size: 9pt; border-color: #666;">
                        <thead class="table-light align-middle fw-bold">
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
                            $daftarRuanganH2 = [
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
                                    'wajib'  => true, // Sifatnya Wajib Tampil
                                    'perawat' => 'perawatRi',
                                    'dokter' => 'dokterRi',
                                    'farmasi' => 'farmasiRi',
                                    'wTtdP'  => 'waktuPerawatRi',
                                    'wTtdD' => 'waktuDokterRi',
                                    'wTtdF' => 'waktuFarmasiRi'
                                ]
                            ];

                            if (!$koMemenuhiSyarat && $rrMemenuhiSyarat) {
                                unset($daftarRuanganH2['rr']);
                            }


                            foreach ($daftarRuanganH2 as $keyRgn => $rgn) :

                                // 1. Ambil data obat khusus untuk ruangan ini
                                $obatPerRuangan = [];
                                if (!empty($data->rekonsiliasiObatData) && is_array($data->rekonsiliasiObatData)) {
                                    foreach ($data->rekonsiliasiObatData as $o) {
                                        if ($o['ruangan'] === $keyRgn) {
                                            $obatPerRuangan[] = $o;
                                        }
                                    }
                                }

                                // 2. Cek apakah ada nama petugas yang terisi di database
                                $petugasPerRuangan = !empty($rObat[$rgn['perawat']]) || !empty($rObat[$rgn['dokter']]) || !empty($rObat[$rgn['farmasi']]);

                                // LOGIKA FILTRASI: Jika BUKAN ruangan wajib (KO/RR) DAN obat kosong DAN petugas kosong, langsung SEMBUNYIKAN (skip)
                                if ($rgn['wajib'] === false && !$petugasPerRuangan && empty($obatPerRuangan)) {
                                    continue;
                                }
                            ?>
                                <tr style="font-weight: bold; text-align: center;">
                                    <td colspan="10" style="padding: 5px 0; font-size: 10pt; letter-spacing: 1px; background-color: #eaeaea;">
                                        <?= $rgn['nama']; ?>
                                    </td>
                                </tr>

                                <?php
                                // TAMPILKAN DATA OBAT
                                if (!empty($obatPerRuangan)) :
                                    $no = 1;
                                    foreach ($obatPerRuangan as $obat) :
                                ?>
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
                                    <?php
                                    endforeach;
                                else :
                                    ?>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td class="text-muted text-start" style="padding-left: 8px; font-style: italic;">Tidak ada obat</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php
                                endif;
                                ?>

                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-bottom: none;">Nama Perawat: <?= !empty($rObat[$rgn['perawat']]) ? esc($rObat[$rgn['perawat']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-bottom: none;">Tanda Tangan: <div id="ttdPerawat<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                    </td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdP']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdP']]) && $rObat[$rgn['wTtdP']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdP']])) : '____'; ?> WIB</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none; border-bottom: none;">Nama Dokter : <?= !empty($rObat[$rgn['dokter']]) ? esc($rObat[$rgn['dokter']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-top: none; border-bottom: none;">Tanda Tangan: <div id="ttdDokter<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                    </td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none; border-bottom: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdD']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdD']]) && $rObat[$rgn['wTtdD']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdD']])) : '____'; ?> WIB</td>
                                </tr>
                                <tr>
                                    <td colspan="4" class="text-start" style="padding: 6px 8px; vertical-align: top; border-top: none;">Nama Farmasi: <?= !empty($rObat[$rgn['farmasi']]) ? esc($rObat[$rgn['farmasi']]) : '___________________________'; ?></td>
                                    <td colspan="3" class="text-start" style="padding: 2px 8px; vertical-align: top; border-top: none;">Tanda Tangan: <div id="ttdFarmasi<?= $keyRgn ?>" style="display: inline-block; vertical-align: middle; margin-left: 10px;"></div>
                                    </td>
                                    <td colspan="3" class="text-start" style="padding: 6px 8px; font-size: 8.5pt; border-top: none;">Tanggal : <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('d-m-Y', strtotime($rObat[$rgn['wTtdF']])) : '________'; ?><br>Jam &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: <?= !empty($rObat[$rgn['wTtdF']]) && $rObat[$rgn['wTtdF']] != '0000-00-00 00:00:00' ? date('H:i', strtotime($rObat[$rgn['wTtdF']])) : '____'; ?> WIB</td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <td colspan="10" style="text-align:start;">
                                    &nbsp; KET :
                                    <div class="text-center">REKONSILIASI OBAT SAAT ADMISI</div>
                                    <ol>
                                        <li>Daftar obat meliputi obat resep dan non resep yang digunakan sebulan terakhir dan masih dipakai pada saat masuk
                                            rumah sakit.</li>
                                        <li>
                                            Instruksi obat baru ditulis di rencana perawatan atau daftar obat.
                                        </li>
                                        <li>
                                            Review kembali saat pasien akan pulang
                                        </li>
                                        <li>
                                            *Beri tanda &#x2713 sesuai pilihan
                                        </li>
                                    </ol>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    $.ajax({
        url: '<?= base_url() ?>rm/rekonsiliasiObat/muatData/<?= str_replace('/', '-', $data->pasien['no_rawat']) ?>',
        method: 'get',
        dataType: 'json',
        success: function(data) {
            // 1. Definisikan daftar peran dan ruangan yang mau di-loop
            const roles = ['perawat', 'dokter', 'farmasi'];
            const rooms = ['Igd', 'Ko', 'Rr', 'Ri']; // Sesuai id elemen HTML Anda (misal: ttdPerawatri atau ttdPerawatIgd)

            rooms.forEach(room => {
                roles.forEach(role => {
                    // Contoh gabungan: perawatRi, dokterRi, farmasiIgd, dst.
                    const apiKey = role + room;
                    // ID HTML elemen penampung: ttdPerawatri, ttdDokterri, dst. (pastikan case-sensitive sesuai HTML Anda)
                    const elementId = "ttd" + role.charAt(0).toUpperCase() + role.slice(1) + room.toLowerCase();

                    // 2. Jika datanya ada di API dan elemen HTML-nya eksis di halaman, sikat!
                    const targetElement = document.getElementById(elementId);
                    if (data[apiKey] && targetElement) {

                        // Inisialisasi QRCode cukup tulis 1 kali di sini
                        const qrcode = new QRCode(targetElement, {
                            width: 50,
                            height: 50,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.L
                        });

                        // Set isi teks QR Code secara dinamis
                        const teksQr = `ttd ${data[apiKey]} Rekon. Obat No: <?= $data->pasien['no_rawat'] ?> (${room.toUpperCase()})`;
                        qrcode.makeCode(teksQr);
                    }
                });
            });
        },
        error: function(xhr, status, error) {
            $("#modalKunci").modal("hide");
            $("#pesanError").addClass("alert alert-danger").html("Terjadi kesalahan sistem atau gagal terhubung ke server.");
        }
    });
</script>

</html>