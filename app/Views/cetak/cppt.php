<?php

/** @var object $data */
?>
<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>

<style>
    body {
        margin: 0;
        padding: 0;
        background-color: #FFFFFF;
        font: 10pt "Times New Roman", Times, serif;
    }

    .page {
        width: 21cm;
        min-height: 33cm;
        padding: 0.5cm 0.5cm 0.5cm 0.7cm;
        margin: 0.3cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .parent-ol>li::marker,
    .parent-ol ol>li::marker {
        font-weight: bold;
    }

    .parent-ol ol ol>li::marker {
        font-weight: normal;
    }

    .subpage {
        padding: 0cm;
        text-align: justify;
    }

    /* Set margin fisik printer/cetak browser (Penting: Jangan 0 agar tidak menabrak) */
    @page {
        size: 210mm 330mm;
        margin: 12mm 10mm 12mm 10mm;
        /* Atas, Kanan, Bawah, Kiri */
    }

    @media print {

        html,
        body {
            width: 100%;
            height: auto;
            background: #FFF;
        }

        .page {
            margin: 0;
            border: none;
            border-radius: 0;
            width: 100%;
            min-height: initial;
            box-shadow: none;
            background: transparent;
            padding: 0;
            /* Padding utama diserap oleh @page margin */
        }

        .page:not(:last-child) {
            page-break-after: always;
            break-after: page;
        }

        /* --- PERBAIKAN TABEL SUPAYA TIDAK NABRAK & TIDAK TERPOTONG TENGAH --- */
        table {
            border-collapse: collapse;
            width: 100%;
        }

        /* Mengulang header tabel di setiap awal halaman baru */
        thead {
            display: table-header-group;
        }

        /* Mencegah 1 baris SOAP terpotong di tengah-tengah halaman */
        tr {
            page-break-inside: avoid;
            break-inside: avoid;
        }
    }

    .tabel td,
    .tabel th {
        padding: 1mm;
    }

    td img {
        margin: auto;
    }

    .stempel-blue,
    .stempel-blue th,
    .stempel-blue td {
        color: #0033cc !important;
        border-color: #0033cc !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPPT Terintegrasi</title>

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
                            RM 0
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
                    <thead>
                        <tr class="text-center">
                            <th style="background-color: #eaeaea;" colspan="4">
                                <p style="font-size: 14pt; margin:0;" class="text-uppercase">CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
                                </p>
                            </th>
                        </tr>
                        <tr class="text-center">
                            <td colspan="4">
                                Diisi oleh Dokter / Perawat / Fisioterapi / Tenaga Gizi / Apoteker
                            </td>
                        </tr>
                        <tr class="text-center">
                            <th>Tgl & Jam</th>
                            <th>
                                Hasil Pemeriksaan, Analisis, Rencana,
                                Penatalaksanaan Pasien
                                <div class="small fw-normal">
                                    (Ditulis dengan format SOAP/ADIME,
                                    disertai sasaran. Tulis nama, beri paraf pada
                                    akhir catatan)
                                </div>
                            </th>
                            <th>
                                Instruksi PPA Termasuk Pasca
                                Bedah
                                <div class="small fw-normal">
                                    (Instruksi ditulis dengan rinci dan
                                    jelas)
                                </div>
                            </th>
                            <th>
                                Review &
                                Verifikasi DPJP
                                <div class="small fw-normal">
                                    (tulis nama, beri
                                    paraf, tgl, & Jam)
                                    (DPJP harus
                                    membaca/merevie
                                    w seluruh rencana
                                    asuhan)
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if (!empty($data->cppt)): ?>
                            <?php foreach ($data->cppt as $index => $item): ?>
                                <tr style="<?= $index % 2 === 1 ? 'background-color: #fdfdfd;' : '' ?>">

                                    <!-- Tanggal / Jam / Sumber -->
                                    <td class="align-top">
                                        <div><?= esc($item['tanggal_hasil']) ?></div>
                                        <div class="text-xs text-gray-500" style="font-size: 0.75rem; color: #6c757d;"><?= esc($item['jam_hasil']) ?></div>
                                        <div class="badge badge-outline badge-sm mt-1" style="border: 1px solid #ccc;  color: #6c757d; padding: 2px 6px; font-size: 0.75rem; border-radius: 4px; display: inline-block; margin-top: 4px;">
                                            <?= esc($item['sumber'] ?? '-') ?>
                                        </div>
                                    </td>

                                    <!-- Hasil Pemeriksaan (SOAP vs SBAR) -->
                                    <td class="align-top">
                                        <?php if (($item['jenis_hasil'] ?? '') === 'SOAP'): ?>
                                            <div class="space-y-2" style="display: flex; flex-direction: column; gap: 8px;">
                                                <!-- Subjective (S) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">S</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['keluhan'] ?? '-') ?></div>
                                                </div>

                                                <!-- Objective (O) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dbeafe; color: #1e3a8a; border: 1px solid #bfdbfe;">O</div>
                                                    <div style="flex: 1;">
                                                        <div style="white-space: pre-line;"><?= esc($item['pemeriksaan'] ?? '-') ?></div>
                                                        <div style="margin-top: 8px; display: flex; flex-wrap: wrap; gap: 4px; font-size: 0.75rem;">
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">TD <?= esc($item['tensi'] ?? '-') ?></span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">N <?= esc($item['nadi'] ?? '-') ?>/mnt</span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">RR <?= esc($item['respirasi'] ?? '-') ?>/mnt</span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">S <?= esc($item['suhu_tubuh'] ?? '-') ?></span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">SpO2 <?= esc($item['spo2'] ?? '-') ?></span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">GCS <?= esc($item['gcs'] ?? '-') ?></span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">TB <?= esc($item['tinggi'] ?? '-') ?> cm</span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;">BB <?= esc($item['berat'] ?? '-') ?> kg</span>
                                                            <span style="background: #f1f5f9; padding: 2px 6px; border-radius: 4px;"><?= esc($item['kesadaran'] ?? '-') ?></span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Assessment (A) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe;">A</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['penilaian'] ?? '-') ?></div>
                                                </div>

                                                <!-- Plan (P) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">P</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['rtl'] ?? '-') ?></div>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <!-- SBAR -->
                                            <div style="display: flex; flex-direction: column; gap: 8px;">
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca;">S</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['s'] ?? '-') ?></div>
                                                </div>

                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dbeafe; color: #1e3a8a; border: 1px solid #bfdbfe;">B</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['b'] ?? '-') ?></div>
                                                </div>

                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ede9fe; color: #5b21b6; border: 1px solid #ddd6fe;">A</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['a'] ?? '-') ?></div>
                                                </div>

                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0;">R</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['r'] ?? '-') ?></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>


                                        <?php if ($item['jenis_pelaksana'] != 'Dokter' && ($item['jenis_hasil'] ?? '') === 'SOAP' && empty($item['penerima'])): ?>
                                            <br>
                                            <div id="qrPetSoap<?= $index ?>"></div>
                                            <?= esc($item['nama_pelaksana']) ?>


                                            <script>
                                                new QRCode(document.getElementById("qrPetSoap<?= $index ?>"), {
                                                    width: 30, // Set the width of the QR code
                                                    height: 30, // Set the height of the QR code
                                                    colorDark: "#000000", // Color of the dark modules (e.g., black squares)
                                                    colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                    correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                }).makeCode("Di ttd oleh <?= $item['nama_pelaksana'] ?> "); // Replace with your desired text or URL
                                            </script>
                                        <?php endif; ?>


                                    </td>
                                    <td>
                                        <?php if (($item['jenis_hasil'] ?? '') === 'SOAP'): ?>
                                            <div class="space-y-2" style="display: flex; flex-direction: column; gap: 8px;">
                                                <!-- Instruction (I) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #fef9c3; color: #854d0e; border: 1px solid #fde68a;">I</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['instruksi'] ?? '-') ?></div>
                                                </div>

                                                <!-- Evaluation (E) -->
                                                <div style="display: flex; align-items: stretch; gap: 8px;">
                                                    <div style="width: 28px;  display: flex; align-items: flex-start; justify-content: center; border-radius: 6px; padding: 4px 8px; font-size: 0.75rem; font-weight: bold; background-color: #ccfbf1; color: #115e59; border: 1px solid #99f6e4;">E</div>
                                                    <div style="flex: 1; white-space: pre-line;"><?= esc($item['evaluasi'] ?? '-') ?></div>
                                                </div>
                                            </div>

                                            <br>

                                            <?php if (!empty($item['penerima'])): ?>
                                                <table class="table table-sm text-center table-bordered stempel-blue fw-bold" style="border: 2px solid #0033cc !important; width: 200px;">
                                                    <thead>
                                                        <tr>
                                                            <th colspan="2" class="letter-spacing-1">SERAH TERIMA</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="w-50">Menyerahkan</td>
                                                            <td class="w-50">Menerima</td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="2">
                                                                <span class="fw-normal" style="font-size: 7pt;">
                                                                    <?= date('d/m/Y - H:i', strtotime($item['tanggal_hasil'] . ' ' . $item['jam_hasil'])) ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-1">
                                                                <span class="fw-normal" style="font-size: 7pt;"><?= esc($item['nama_pelaksana']) ?></span>
                                                                <br>
                                                                <div id="qrMeny<?= $index ?>"></div>
                                                            </td>
                                                            <td class="py-1">
                                                                <span class="fw-normal" style="font-size: 7pt;"><?= esc($item['penerima']) ?></span>
                                                                <br>
                                                                <div id="qrMene<?= $index ?>"></div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <script>
                                                    new QRCode(document.getElementById("qrMeny<?= $index ?>"), {
                                                        width: 30, // Set the width of the QR code
                                                        height: 30, // Set the height of the QR code
                                                        colorDark: "#0033cc", // Color of the dark modules (e.g., black squares)
                                                        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                    }).makeCode("Di ttd oleh <?= $item['nama_pelaksana'] ?> "); // Replace with your desired text or URL
                                                    new QRCode(document.getElementById("qrMene<?= $index ?>"), {
                                                        width: 30, // Set the width of the QR code
                                                        height: 30, // Set the height of the QR code
                                                        colorDark: "#0033cc", // Color of the dark modules (e.g., black squares)
                                                        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                    }).makeCode("Di ttd oleh <?= $item['nama_pelaksana'] ?> "); // Replace with your desired text or URL
                                                </script>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                    <!-- Petugas / Dokter -->
                                    <td class="align-top">

                                        <?php if (($item['jenis_hasil'] ?? '') != 'SBAR' && !empty($item['jenis_pelaksana'])): ?>

                                            <?php if ($item['jenis_pelaksana'] === 'Dokter' && !empty($item['waktuVerif'])): ?>
                                                <table class="table table-sm text-center table-bordered fw-bold" style="border: 2px solid #000; width: 200px;">
                                                    <tr>
                                                        <th colspan="2">VERIFIKASI</th>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal/Jam</td>
                                                        <td>Tanda Tangan DPJP</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="fw-normal" style="font-size: 7pt;">
                                                            <?= date('d/m/Y - H:i', strtotime($item['waktuVerif'])) ?>
                                                        </td>
                                                        <td>
                                                            <span class="fw-normal" style="font-size: 7pt;"><?= esc($item['nama_pelaksana']) ?></span>
                                                            <br>
                                                            <div id="qrDPJP<?= $index ?>"></div>
                                                        </td>
                                                    </tr>
                                                </table>

                                                <script>
                                                    new QRCode(document.getElementById("qrDPJP<?= $index ?>"), {
                                                        width: 30, // Set the width of the QR code
                                                        height: 30, // Set the height of the QR code
                                                        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
                                                        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                    }).makeCode("Di ttd oleh <?= $item['nama_pelaksana'] ?> "); // Replace with your desired text or URL
                                                </script>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if (($item['jenis_hasil'] ?? '') === 'SBAR' && !empty($item['dokter'])): ?>
                                            <table class="table table-sm text-center table-bordered stempel-blue fw-bold" style="border: 2px solid #0033cc !important; width: 200px;">
                                                <thead>
                                                    <tr>
                                                        <th colspan="2" class="letter-spacing-1">TUBALKON</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="w-50">Yg Menerima</td>
                                                        <td class="w-50">Yg Memberi</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-1">
                                                            <span class="fw-normal" style="font-size: 7pt;"><?= esc($item['petugas']) ?></span>
                                                            <br>
                                                            <span class="fw-normal" style="font-size: 7pt;">
                                                                <?= date('d/m/Y - H:i', strtotime($item['tanggal_hasil'] . ' ' . $item['jam_hasil'])) ?>
                                                            </span>
                                                            <br>
                                                            <div id="qrPet<?= $item['id'] ?>"></div>
                                                        </td>
                                                        <td class="py-1">
                                                            <span class="fw-normal" style="font-size: 7pt;"><?= esc($item['dokter']) ?></span>
                                                            <br>
                                                            <span class="fw-normal" style="font-size: 7pt;">
                                                                <?= date('d/m/Y - H:i', strtotime($item['tanggal_hasil'] . ' ' . $item['jam_hasil'])) ?>
                                                            </span>
                                                            <br>
                                                            <div id="qrDok<?= $item['id'] ?>"></div>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <script>
                                                new QRCode(document.getElementById("qrPet<?= $item['id'] ?>"), {
                                                    width: 30, // Set the width of the QR code
                                                    height: 30, // Set the height of the QR code
                                                    colorDark: "#0033cc", // Color of the dark modules (e.g., black squares)
                                                    colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                    correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                }).makeCode("Di ttd oleh <?= $item['petugas'] ?> "); // Replace with your desired text or URL
                                                new QRCode(document.getElementById("qrDok<?= $item['id'] ?>"), {
                                                    width: 30, // Set the width of the QR code
                                                    height: 30, // Set the height of the QR code
                                                    colorDark: "#0033cc", // Color of the dark modules (e.g., black squares)
                                                    colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
                                                    correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
                                                }).makeCode("Di ttd oleh <?= $item['dokter'] ?> "); // Replace with your desired text or URL
                                            </script>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center" style="text-align: center; padding: 20px;">Belum ada data CPPT</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</body>

</html>