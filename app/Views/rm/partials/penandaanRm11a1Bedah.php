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
    <title>Penandaan Lokasi Operasi</title>

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
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold"> PENANDAAN LOKASI BEDAH
                        </p>
                        <mark class="small">
                            *mengedit penandaan lokasi sama dengan menandai dari awal.
                        </mark>
                    </div>
                </div>


                <table class="table table-bordered">
                    <tr>
                        <td rowspan="3">
                            <div class="text-center">
                                <canvas class="tempatTtd" id="badan" width="360" height="500"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/badan_wanita.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearBadan">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <canvas class="tempatTtd" id="kepalaSamping" width="300" height="180"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/kepala_samping.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearKepalaSamping">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <canvas class="tempatTtd" id="kepala" width="300" height="150"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/kepala.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearKepala">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <canvas class="tempatTtd" id="telapakTangan" width="300" height="160"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/telapak_tangan.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearTelapakTangan">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="text-center">
                                <canvas class="tempatTtd" id="kaki" width="300" height="160"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/kaki.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearKaki">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="text-center">
                                <canvas class="tempatTtd" id="punggungTangan" width="300" height="160"
                                    style="background-image: url('<?= base_url('public/assets/img/rm11a1Bedah/punggung_tangan.png') ?>'); background-size: cover; background-position: center;">
                                </canvas>
                                <div class="controls">
                                    <button class="btn btn-sm btn-secondary" id="clearPunggungTangan">Bersihkan</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>




                <div class="row text-center mt-1">
                    <input type="hidden" id="noRawat" value="<?= $data->rm11a1Bedah["noRawat"] ?>">
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <a class="btn btn-secondary" href="<?= base_url("rm/rm11a1Bedah/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Batal</a>
                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan simpan gambar.</button>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Simpan gambar ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menyimpan gambar ?<br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! saat edit, data lama otomatis di clear. dan perlu gambar ulang semua.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" onclick="kirimGambar()">Kunci</button>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/davidshimjs-qrcodejs/qrcode.min.js"></script>
<script>
    function kirimGambar() {

        $("#pesanError").html("");
        $("#pesanError").removeClass("alert alert-danger");

        var noRawat = $("#noRawat").val();

        // 1. Siapkan payload awal dengan noRawat dan CSRF Token
        var postData = {
            noRawat: noRawat,
            "<?= csrf_token() ?>": "<?= csrf_hash() ?>"
        };

        // 2. Loop semua canvas penandaan, ambil data Base64 HANYA jika pernah dicoret
        if (window.canvasInstances) {
            Object.keys(window.canvasInstances).forEach(function(canvasId) {
                var instance = window.canvasInstances[canvasId];

                // Jika canvas dicoret, kirimkan Base64. Jika tidak, kirim string kosong
                if (instance && instance.isDrawn) {
                    postData[canvasId] = instance.getImageData();
                } else {
                    postData[canvasId] = '';
                }
            });
        }

        // 3. Kirim data via AJAX
        $.ajax({
            url: '<?= base_url() ?>rm/rm11a1Bedah/simpanPenandaan',
            method: 'post',
            data: postData,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    location.href = "<?= base_url('rm/rm11a1Bedah/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>"
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
        // 1. Daftar semua ID Canvas & Button Bersihkan terkait
        const canvasConfigs = [{
                canvasId: 'badan',
                btnId: 'clearBadan'
            },
            {
                canvasId: 'kepalaSamping',
                btnId: 'clearKepalaSamping'
            },
            {
                canvasId: 'kepala',
                btnId: 'clearKepala'
            },
            {
                canvasId: 'telapakTangan',
                btnId: 'clearTelapakTangan'
            },
            {
                canvasId: 'kaki',
                btnId: 'clearKaki'
            },
            {
                canvasId: 'punggungTangan',
                btnId: 'clearPunggungTangan'
            }
        ];

        // Object untuk menampung instance & status tiap canvas
        window.canvasInstances = {};

        // 2. Fungsi inisialisasi untuk setiap canvas
        function initCanvas(canvasId, btnId) {
            const canvas = document.getElementById(canvasId);
            const clearBtn = document.getElementById(btnId);
            if (!canvas) return;

            const ctx = canvas.getContext('2d');
            let isDrawing = false;
            let lastX = 0;
            let lastY = 0;

            // Simpan status & helper ke object global
            window.canvasInstances[canvasId] = {
                element: canvas,
                ctx: ctx,
                isDrawn: false, // Flag penanda: true jika PERNAH dicoret, false jika KOSONG

                // Helper method jika ingin ekspor gambar ke Base64 (untuk Ajax/Server)
                getImageData: function() {
                    return this.isDrawn ? canvas.toDataURL('image/png') : null;
                }
            };

            // Set style corat-coret (warna merah, line width 2)
            ctx.lineWidth = 2;
            ctx.lineCap = 'round';
            ctx.strokeStyle = '#ff0000';

            function getCoordinates(e) {
                const rect = canvas.getBoundingClientRect();
                if (e.touches && e.touches[0]) {
                    return [
                        e.touches[0].clientX - rect.left,
                        e.touches[0].clientY - rect.top
                    ];
                }
                return [
                    e.offsetX || e.clientX - rect.left,
                    e.offsetY || e.clientY - rect.top
                ];
            }

            function startDrawing(e) {
                isDrawing = true;
                [lastX, lastY] = getCoordinates(e);
            }

            function draw(e) {
                if (!isDrawing) return;
                e.preventDefault(); // Mencegah scroll layar saat coret-coret di HP/Touch

                const [currentX, currentY] = getCoordinates(e);

                ctx.beginPath();
                ctx.moveTo(lastX, lastY);
                ctx.lineTo(currentX, currentY);
                ctx.stroke();

                [lastX, lastY] = [currentX, currentY];

                // Tandai bahwa canvas ini SUDAH DICORET
                window.canvasInstances[canvasId].isDrawn = true;
            }

            function stopDrawing() {
                isDrawing = false;
            }

            // Event Listeners (Mouse)
            canvas.addEventListener('mousedown', startDrawing);
            canvas.addEventListener('mousemove', draw);
            canvas.addEventListener('mouseup', stopDrawing);
            canvas.addEventListener('mouseout', stopDrawing);

            // Event Listeners (Touch HP/Tablet)
            canvas.addEventListener('touchstart', startDrawing, {
                passive: false
            });
            canvas.addEventListener('touchmove', draw, {
                passive: false
            });
            canvas.addEventListener('touchend', stopDrawing);

            // Clear button functionality
            if (clearBtn) {
                clearBtn.addEventListener('click', () => {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    // Reset status flag menjadi FALSE kembali
                    window.canvasInstances[canvasId].isDrawn = false;
                });
            }
        }

        // 3. Jalankan inisialisasi untuk seluruh canvas
        canvasConfigs.forEach(config => initCanvas(config.canvasId, config.btnId));
    });
</script>

</html>