<?php

/** @var object $data */
if ($data->rm4PermintaanMasuk) {
    $tglLahirPasien = new \DateTime($data->pasien["tgl_lahir"]);
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
    <title>Cetak Permintaan Masuk RS</title>

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
                            RM 04
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold">SURAT PERMINTAAN MASUK RUMAH SAKIT
                        </p>
                    </div>
                </div>

                <table class="table table-borderless table-sm mt-2">
                    <tr>
                        <td style="width:25%">Nama Pasien</td>
                        <td>: <?= $data->pasien["nm_pasien"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Tempat, Tanggal lahir :</td>
                        <td>: <?= $data->pasien["tmp_lahir"] . ", " . $tglLahirPasien->format('d-m-Y') ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>: <?= $data->pasien['jk'] == 'L' ? 'Laki-laki' : 'Perempuan' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $data->pasien["alamat"] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td>: <?= $data->pasien['no_ktp'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Kartu</td>
                        <td>: <?= $data->rm4PermintaanMasuk['noKartu'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Nomor SEP</td>
                        <td>: <?= $data->rm4PermintaanMasuk['noSep'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Penjamin Biaya</td>
                        <td>: <?= $data->rm4PermintaanMasuk["biaya"] == 'Lainnya' ? 'Lainnya : ' . ($data->rm4PermintaanMasuk["isiBiayaLain"] ?? '-')  : ($data->rm4PermintaanMasuk["biaya"] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td>Diagnosa Masuk</td>
                        <td>: <?= $data->rm4PermintaanMasuk['diagnosa'] ?? '' ?></td>
                    </tr>
                </table>
                <br>

                <b>Harap Masuk Rumah Sakit :</b>

                <table class="table table-borderless table-sm mt-2">
                    <tr>
                        <td style="width:25%">Hari & Tanggal</td>
                        <td>:
                            <?php
                            $tglMasuk = $data->rm4PermintaanMasuk['tglMasuk'] ?? '';
                            if (!empty($tglMasuk)) {
                                // Mengubah string tanggal menjadi timestamp
                                $timestamp = strtotime($tglMasuk);

                                // Daftar nama hari dalam Bahasa Indonesia
                                $hariArr = [
                                    'Sunday'    => 'Minggu',
                                    'Monday'    => 'Senin',
                                    'Tuesday'   => 'Selasa',
                                    'Wednesday' => 'Rabu',
                                    'Thursday'  => 'Kamis',
                                    'Friday'    => 'Jumat',
                                    'Saturday'  => 'Sabtu'
                                ];

                                $namaHariInggris = date('l', $timestamp); // Mengambil nama hari Inggris (e.g. Thursday)
                                $namaHariIndo = $hariArr[$namaHariInggris]; // Mencocokkan ke bahasa Indonesia
                                $tanggalFormat = date('d-m-Y', $timestamp); // Format dd-mm-yyyy

                                echo $namaHariIndo . ', ' . $tanggalFormat;
                            } else {
                                echo '-';
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Ruangan Yang Dituju</td>
                        <td>: <?= $data->rm4PermintaanMasuk['ruang'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>DPJP</td>
                        <td>: <?= $data->rm4PermintaanMasuk['dokter'] ?? '' ?></td>
                    </tr>
                </table>


                <br>

                <div class="row text-center mt-1">
                    <div class="col-12 text-end pe-5">
                        Bangkalan, <?= $data->rm4PermintaanMasuk['tglTtd'] ?>
                    </div>
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                                DPJP
                                <br><br>

                                <div id="ttdDokter">
                                    <?php if ($data->rm4PermintaanMasuk["ttdDokter"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm4PermintaanMasuk/' . $data->rm4PermintaanMasuk["ttdDokter"]) . '" alt="tanda tangan Dokter" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm4PermintaanMasuk["dokter"] ?? '-' ?> )
                                <br><br>
                                <?php if (!$data->rm4PermintaanMasuk["ttdDokter"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdDokter">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                            <td style="width:40%;">
                                Pasien / Wali Pasien
                                <br><br>

                                <div id="ttdWali">
                                    <?php if ($data->rm4PermintaanMasuk["ttdWali"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm4PermintaanMasuk/' . $data->rm4PermintaanMasuk["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= empty($data->rm4PermintaanMasuk["nama"]) ? $data->pasien["nm_pasien"] : $data->rm4PermintaanMasuk["nama"] ?> )
                                <br><br>
                                <?php if (!$data->rm4PermintaanMasuk["ttdWali"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                            <td>
                                Petugas
                                <br><br>

                                <div id="ttdPetugas">
                                    <?php if ($data->rm4PermintaanMasuk["ttdPetugas"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm4PermintaanMasuk/' . $data->rm4PermintaanMasuk["ttdPetugas"]) . '" alt="tanda tangan Petugas" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm4PermintaanMasuk["petugas"] ?? '-' ?> )
                                <br><br>
                                <?php if (!$data->rm4PermintaanMasuk["ttdPetugas"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdPetugas">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="noRawat" value="<?= $data->rm4PermintaanMasuk["noRawat"] ?>">
                    <input type="hidden" id="petugas" value="<?= $data->rm4PermintaanMasuk["petugas"] ?>">
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <?php if (!$data->rm4PermintaanMasuk["ttdWali"] and !$data->rm4PermintaanMasuk["ttdDokter"] and !$data->rm4PermintaanMasuk["ttdPetugas"]) { ?>
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

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    // var qrPetugas = new QRCode(document.getElementById("qrPetugas"), {
    //     width: 100, // Set the width of the QR code
    //     height: 100, // Set the height of the QR code
    //     colorDark: "#000000", // Color of the dark modules (e.g., black squares)
    //     colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
    //     correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    // });

    // Generate the QR code with the desired content
    // qrPetugas.makeCode("Di ttd ?= $data->rm4PermintaanMasuk["petugas"] ?  untuk Permintaan masuk RS. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

    // var qrDokter = new QRCode(document.getElementById("qrDokter"), {
    //     width: 100, // Set the width of the QR code
    //     height: 100, // Set the height of the QR code
    //     colorDark: "#000000", // Color of the dark modules (e.g., black squares)
    //     colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
    //     correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    // });

    // // Generate the QR code with the desired content
    // qrDokter.makeCode("Di ttd ?= $data->rm4PermintaanMasuk["dokter"] ? untuk Permintaan masuk RS. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL




    function kunciTtd() {
        $("#pesanError").html("");
        $("#pesanError").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // Ambil elemen gambar
        var imgWaliEl = $("#ttdWali img");
        var imgDokterEl = $("#ttdDokter img");
        var imgPetugasEl = $("#ttdPetugas img");
        if (imgWaliEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Wali belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        } else if (imgDokterEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Dokter belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        } else if (imgPetugasEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Petugas belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        // PERBAIKAN: Menggunakan .attr('data-is-new') untuk membaca string 'true' secara akurat
        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';

        var isDokterNew = (imgDokterEl.attr('data-is-new') === 'true' || imgDokterEl.data('is-new') === true);
        var ttdDokter = isDokterNew ? imgDokterEl.attr('src') : '';

        var isPetugasNew = (imgPetugasEl.attr('data-is-new') === 'true' || imgPetugasEl.data('is-new') === true);
        var ttdPetugas = isPetugasNew ? imgPetugasEl.attr('src') : '';


        $.ajax({
            url: '<?= base_url() ?>rm/rm4PermintaanMasuk/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
                ttdWali: ttdWali,
                ttdDokter: ttdDokter,
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


        // =============untuk ttd petugas===============
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