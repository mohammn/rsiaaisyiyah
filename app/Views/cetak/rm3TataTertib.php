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
    <title>Cetak Tata Tertib</title>

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
                            RM 03
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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold"> TATA TERTIB RAWAT INAP </p>
                    </div>
                </div>

                Rumah Sakit Ibu dan Anak Aisyiyah akan selalu berusaha menciptakan suasana rawat inap yang tenang,
                aman, dan tertib. Untuk menciptakan suasana rawat inap yang tenang, aman, dan tertib tersebut, maka pasien,
                keluarga pasien maupun pengunjung diwajibkan untuk mentaati segala peraturan yang berlaku di Rumah Sakit
                Ibu dan Anak Aisyiyah, yaitu:
                <br><br>

                <ol style="margin-left: 0; padding-left: 20px;">
                    <!-- 1. Aturan untuk berkunjung -->
                    <li>Aturan untuk berkunjung:
                        <ul style="list-style-type: square; margin-left: 0; padding-left: 20px;">
                            <li><strong>Pagi:</strong> jam 10.00 - 12.00 WIB</li>
                            <li><strong>Sore:</strong> jam 16.00 - 18.00 WIB</li>
                        </ul>
                    </li>

                    <!-- 2. Penunggu pasien -->
                    <li>Penunggu pasien :
                        <ul style="list-style-type: square; margin-left: 0; padding-left: 20px;">
                            <li>Hanya diperkenankan dijaga oleh 2 orang penunggu pasien dan keluarga pasien menggunakan tanda pengenal khusus yang diberikan oleh Rumah Sakit.</li>
                            <li>Kamar bersalin tidak boleh ditunggu oleh keluarga pasien (menginap).</li>
                        </ul>
                    </li>

                    <!-- 3. Larangan -->
                    <li>Pasien, keluarga pasien, penunggu dan pengunjung dilarang untuk :
                        <ol type="a" style="margin-left: 0; padding-left: 20px;">
                            <li>Memberikan uang (tip) kepada staf Rumah Sakit Ibu dan Anak Aisyiyah.</li>
                            <li>Membawa barang – barang di dalam ruangan sebagai berikut :
                                <ol type="1" style="margin-left: 0; padding-left: 20px;">
                                    <li>Membawa perhiasan, uang dalam jumlah besar, senjata api/barang berharga lainnya.</li>
                                    <li>Meletakkan <em>handphone</em>, laptop, tab, dan barang berharga lainnya dengan sembarangan di lingkungan rumah sakit.</li>
                                    <li>Membawa barang – barang elektronik/alat – alat yang mempergunakan listrik (seperti: teko elektrik, <em>hair driyer</em>, kompor listrik, <em>rice cooker</em>, dll).</li>
                                    <li>Membawa makan dan minum untuk pasien tanpa seizin Dokter yang merawat.</li>
                                    <li>Membawa peralatan tidur (seperti: Kasur, Bantal, Tikar dsb).</li>
                                    <li>Rumah Sakit Ibu dan Anak Aisyiyah tidak bertanggung jawab atas kerusakan atau kehilangan barang – barang tersebut.</li>
                                </ol>
                            </li>
                            <li>Meninggalkan Rumah Sakit Ibu dan Anak Aisyiyah tanpa seizin Dokter yang merawat (khusus untuk pasien).</li>
                            <li>Merokok, mengkonsumsi minuman keras dan narkoba di seluruh area Rumah Sakit Ibu dan Anak Aisyiyah.</li>
                            <li>Membawa obat – obatan dari luar (wajib membeli di Rumah Sakit Ibu dan Anak Aisyiyah).</li>
                            <li>Masuk kedalam ruangan operasi</li>
                            <li>Tidak boleh mengambil gambar di area Rumah Sakit.</li>
                            <li>Dilarang untuk mencuci pakaian sendiri.</li>
                        </ol>
                    </li>

                    <!-- 4. Biaya perbaikan -->
                    <li>Biaya perbaikan/ penggantian barang milik Rumah Sakit Ibu dan Anak Aisyiyah yang rusak / hilang akibat kelalaian keluarga/pengunjung pasien akan dibebankan kepada pasien.</li>

                    <!-- 5. Menjaga kebersihan -->
                    <li>Menjaga kebersihan :
                        <ul style="list-style-type: square; margin-left: 0; padding-left: 20px;">
                            <li>Membuang sampah harus pada tempat yang telah disediakan</li>
                        </ul>
                    </li>

                    <!-- 6. Menjaga keindahan -->
                    <li>Menjaga keindahan dan kerapihan ruangan:
                        <ul style="list-style-type: square; margin-left: 0; padding-left: 20px;">
                            <li>Tidak diperkenankan menjemur pakaian tidak pada tempatnya.</li>
                        </ul>
                    </li>
                </ol>
                <br><br>

                <div class="row text-center mt-1">
                    <div class="col-12 text-end pe-5">
                        Bangkalan, <?= $data->rm3TataTertib['tglTtd'] ?>
                    </div>
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                                Petugas
                                <br>
                                <br>
                                <div id="qrcode" class="pt-2"></div>
                                <br>
                                (<?= $data->rm3TataTertib["petugas"] ?> )
                            </td>
                            <td>

                            </td>
                            <td>
                                Pasien / Wali Pasien
                                <br><br>

                                <div id="ttdWali">
                                    <?php if ($data->rm3TataTertib["ttdWali"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/rm3TataTertib/' . $data->rm3TataTertib["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->rm3TataTertib["nama"] ?> )
                                <br><br>
                                <?php if (!$data->rm3TataTertib["ttdWali"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="noRawat" value="<?= $data->rm3TataTertib["noRawat"] ?>">
                    <input type="hidden" id="petugas" value="<?= $data->rm3TataTertib["petugas"] ?>">
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <?php if (!$data->rm3TataTertib["ttdWali"]) { ?>
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

<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    function kunciTtd() {
        $("#pesanError").html("");
        $("#pesanError").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // Ambil elemen gambar
        var imgWaliEl = $("#ttdWali img");
        if (imgWaliEl.length === 0) {
            $("#pesanError").addClass("alert alert-danger").html("Wali belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        // PERBAIKAN: Menggunakan .attr('data-is-new') untuk membaca string 'true' secara akurat
        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';


        $.ajax({
            url: '<?= base_url() ?>rm/rm3TataTertib/simpanTtd',
            method: 'post',
            data: {
                noRawat: noRawat,
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

    // Generate the QR code with the desired content
    qrcode.makeCode("Di ttd " + $("#petugas").val() + " untuk Tata Tertib. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

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



    });
</script>

</html>