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
        padding: 1cm;
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
            page-break-after: always;
            /* Force a page break after each .page div */
        }
    }

    .tabel td,
    .tabel th {
        padding: 0;
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
    <title>Cetak Persetujuan Rawat Jalan</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="120%" alt=""></div>
                    <div class="col-3">
                        <br><br>
                    </div>
                    <div class="col-5 border border-dark" style="display: flex; justify-content: center;">
                        <table class="table table-borderless table-sm mt-3 tabel" style="font-size: xx-small;">
                            <tr>
                                <td>Nama</td>
                                <td>: <?= $nm_pasien ?></td>
                            </tr>
                            <tr>
                                <td>Tgl.Lahir</td>
                                <td>: <?= $tgl_lahir ?></td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>: <?= $alamat ?></td>
                            </tr>
                            <tr>
                                <td>NIK</td>
                                <td>: <?= $no_ktp ?></td>
                            </tr>
                            <tr>
                                <td>No.RM</td>
                                <td>: <?= $no_rkm_medis ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 text-center mt-2">
                        <h5>PERSETUJUAN UMUM RAWAT JALAN</h5>
                    </div>
                </div>
                <b>Yang bertanda tangan dibawah ini :</b>
                <table class="table table-sm table-borderless w-50 tabel">
                    <tr>
                        <td>Nama</td>
                        <td>: <?= $nama ?></td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>: <?= $alamatWali ?></td>
                    </tr>
                    <tr>
                        <td>No. Telp/Hp </td>
                        <td>: <?= $noHp ?></td>
                    </tr>
                    <tr>
                        <td>Sebagai</td>
                        <td>: <?= $sebagai ?></td>
                    </tr>
                </table>
                <div class="row">
                    <div class="col-12 text-center">
                        <h6>PASIEN DAN/ ATAU WALI HUKUM HARUS MEMBACA, MEMAHAMI <br>
                            DAN MENGISI INFORMASI BERIKUT
                        </h6>
                    </div>
                </div>
                <ol type="A" class="parent-ol">
                    <li>
                        <b>HAK DAN KEWAJIBAN SEBAGAI PASIEN.</b> Saya menyatakan bahwa saya telah mendapatkan informasi tentang
                        hak dan kewajiban pada saat pendaftaran untuk mendapatkan perawatan di Rumah Sakit Ibu dan Anak Aisyiyah.
                        <ol type="1">
                            <li>
                                <b>Hak - Hak Pasien Rumah Sakit Ibu dan Anak Aisyiyah</b>
                                <ol type="a">
                                    <li>
                                        Memperoleh informasi mengenai tata tertib dan peraturan yang berlaku di Rumah Sakit Ibu dan Anak Aisyiyah;
                                    </li>
                                    <li>
                                        Memperoleh informasi tentang hak dan kewajiban pasien;
                                    </li>
                                    <li>
                                        Memperoleh layanan yang manusiawi, adil, jujur, dan tanpa diskriminasi;
                                    </li>
                                    <li>
                                        Memperoleh layanan kesehatan yang bermutu sesuai dengan standar profesi dan standar prosedur operasional;
                                    </li>
                                    <li>
                                        Memperoleh pelayanan yang efektif dan efisien sehingga pasien terhindar dari kerugian fisik dan materi;
                                    </li>
                                    <li>
                                        Mengajukan pengaduan atas kualitas pelayanan yang didapatkan;
                                    </li>
                                    <li>
                                        Memilih Dokter serta kelas perawatan sesuai dengan keinginannya dan peraturan yang berlaku di rumah sakit;
                                    </li>
                                    <li>
                                        Meminta konsultasi tentang penyakit yang dideritanya kepada Dokter yang mempunyai Surat Izin Praktik (SIP) baik di dalam maupun luar Rumah Sakit;
                                    </li>
                                    <li>
                                        Mendapatkan privasi dan kerahasiaan penyakit yang diderita termasuk data – data medisnya;
                                    </li>
                                    <li>
                                        Mendapatkan informasi yang meliputi diagnosis dan tata cara tindakan medis, tujuan tindakan medis, alternatif tindakan, risiko dan komplikasi yang mungkin terjadi, dan prognosis terhadap tindakan yang dilakukan serta perkiraan biaya pengobatan;
                                    </li>
                                    <li>
                                        Memberikan persetujuan atau menolak atas tindakan yang akan dilakukan oleh Tenaga Kesehatan terhadap penyakit yang dideritanya;
                                    </li>
                                    <li>
                                        Didampingi keluarganya dalam keadaan kritis;
                                    </li>
                                    <li>
                                        Menjalankan ibadah sesuai agama atau kepercayaan yang dianutnya selama hal tersebut tidak mengganggu pasien lainnya;
                                    </li>
                                    <li>
                                        Memperoleh keamanan dan keselamatan dirinya selama dalam perawatan di Rumah Sakit;
                                    </li>
                                    <li>
                                        Mengajukan usul, saran, perbaikan atas perlakuan Rumah Sakit terhadap dirinya;
                                    </li>
                                    <li>
                                        Menolak pelayanan bimbingan rohani yang tidak sesuai dengan agama dan kepercayaan yang dianut;
                                    </li>
                                    <li>
                                        Menggugat dan/ atau menuntut Rumah Sakit apabila Rumah Sakit diduga memberikan pelayanan yang tidak sesuai dengan standar baik secara perdata ataupun pidana;
                                    </li>
                                    <li>
                                        Mengeluhkan pelayanan Rumah Sakit yang tidak sesuai standar pelayanan melalui media cetak dan elektronik sesuai dengan ketentuan peraturan perundang – undangan. <i style="color: red;">(sebaiknya bisa menghubungi contact person yang sudah dipasang di tiap unit)</i>
                                        <i>(Sumber: Undang – Undang Republik Indonesia Nomor 44 Tahun 2009 tentang Rumah Sakit; Pasal 32)</i>
                                    </li>
                                </ol>
                                <br>
                            <li>
                                <b>Kewajiban Pasien Rumah Sakit Ibu dan Anak Aisyiyah</b>
                                <ol type="a">
                                    <li>
                                        Mematuhi peraturan yang berlaku di Rumah Sakit;
                                    </li>
                                    <li>
                                        Menggunakan fasilitas Rumah Sakit secara bertanggung jawab;
                                    </li>
                                    <li>
                                        Menghormati hak – hak pasien lain, pengunjung dan hak Tenaga Kesehatan serta petugas lainnya yang bekerja di Rumah Sakit:
                                    </li>
                                    <li>
                                        Memberikan informasi yang jujur, lengkap dan akurat sesuai kemampuan dan pengetahuannya tentang masalah kesehatannya;
                                    </li>
                                    <li>
                                        Memberikan informasi mengenai kemampuan finansial dan jaminan kesehatan yang dimilikinya;
                                    </li>
                                    <li>
                                        Mematuhi rencana terapi yang direkomendasikan oleh Tenaga Kesehatan di Rumah Sakit dan disetujui oleh Pasien yang bersangkutan setelah mendapatkan penjelasan sesuai ketentuan peraturan perundang – undangan;
                                    </li>
                                    <li>
                                        Menerima segala konsekuensi atas keputusan pribadinya untuk menolak rencana terapi yang direkomendasikan oleh Tenaga Kesehatan dan/ atau tidak mematuhi petunjuk yang diberikan oleh Tenaga Kesehatan dalam rangka penyembuhan penyakit atau masalah kesehatannya;
                                    </li>
                                    <li>
                                        Memberikan imbalan jasa atas pelayanan yang diterima.
                                        <i>(Sumber: Peraturan Menteri Kesehatan Republik Indonesia Nomor 4 Tahun 2018 tentang Kewajiban Rumah Sakit dan Kewajiban Paien; Pasal 26)</i>
                                    </li>
                                </ol>

                            </li>
                    </li>
                </ol>
                </li>
                </ol>
            </div>
        </div>
        <div class="page">
            <div class="subpage">
                <div class="row m-1">
                    <div class="col-4"><br><img src="<?= base_url() ?>public/assets/img/logorsia.png" width="120%" alt=""><br><br></div>
                    <div class="col-8">
                        <br><br>
                    </div>
                </div>
                <ol type="A" start="2" class="parent-ol">
                    <li>
                        <b>PERSETUJUAN PELAYANAN KESEHATAN</b>
                        <ol type="1">
                            <li>
                                Saya mengetahui bahwa saya memiliki kondisi yang membutuhkan perawatan medis, saya mengizinkan dokter dan profesional kesehatan lainnya untuk melakukan prosedur diagnostik dan untuk memberikan pengobatan medis seperti yang diperlukan dalam penilaian profesional mereka. Prosedur diagnostik dan perawatan medis termasuk tetapi tidak terbatas pada electrocardiograms, x-ray, tes darah terapi fisik, dan pemberian obat-obatan, pemasangan alat kesehatan termasuk pemasangan infus, pemasangan kateter dan pengambilan darah untuk pemeriksaan laboratorium atau pemeriksaan patologi yang dibutuhkan untuk pengobatan tindkan yang aman, kecuali prosedur yang membutuhkan persetujuan khusus secara tertulis.
                            </li>
                            <li>
                                Saya memiliki hak untuk mengajukan pertanyaan tentang perawatan dan pengobatan termasuk identitas setiap orang yang memberikan perawatan dan pengobatan tersebut, guna memberikan persetujuan atau penolakan untuk prosedur pengobatan;
                            </li>
                            <li>
                                Saya sadar bahwa praktik kedokteran dan bedah bukanlah ilmu pasti dan saya mengakui bahwa tidak ada jaminan atas hasil apapun, terhadap perawatan prosedur atau pemeriksaan apapun yg dilakukan kepada saya;
                            </li>
                            <li>
                                Dalam suatu upaya pengobatan dan perawatan yang baik diperlukan suatu hubungan yang didasari atas saling menghargai dan menghormati, antara dokter, perawat, tenaga kesehatan dan petugas rumah sakit lainnya dengan pasien dan/keluarganya. Untuk itu saya mendukung sepenuhnya upaya menciptakan hubungan tersebut.
                                <br>
                                <br>
                            </li>

                        </ol>
                    </li>
                    <li>
                        <b>RAHASIA KEDOKTERAN</b> <br>
                        Saya setuju Rumah Sakit Ibu dan Anak Aisyiyah untuk menjaga privasi dan menjamin rahasia kedokteran saya baik untuk kepentingan perawatan atau pengobatan, pendidikan maupun penelitian kecuali saya mengungkapkan sendiri atau orang lain yang saya beri kuasa sebagai Penjamin. <br><br>
                    </li>
                    <li>
                        <b>PELEPASAN INFORMASI MEDIS</b>
                        <ol type="1">
                            <li>
                                Saya memahami informasi yang ada didalam diri Saya, termasuk Diagnosis, hasil laboratorium dan hasil tes diagnostik yang akan di gunakan untuk perawatan medis, akan dijamin kerahasiaannya oleh Rumah Sakit Ibu dan Anak Aisyiyah.
                            </li>
                            <li>
                                Saya setuju untuk melepaskan rahasia kedokteran terkait dengan kondisi kesehatan, tindakan, dan pengobatan saya di Rumah Sakit Ibu dan Anak Aisyiyah kepada:
                                <ol type="a">
                                    <li>
                                        Dokter dan tenaga kesehatan lain yang memberikan perawatan dan pengobatan kepada saya;
                                    </li>
                                    <li>
                                        Lembaga pemerintah lain yang berwenang.
                                    </li>
                                    <li>
                                        Perusahaan Asuransi Kesehatan atau perusahaan lainnya yang menjamin pembiayaan saya.
                                    </li>
                                    <li>
                                        Anggota keluarga saya, sebutkan :
                                        <ol type="1">
                                            <?php
                                            $dataKeluarga = explode(",", $keluarga);
                                            for ($i = 0; $i < count($dataKeluarga); $i++) {
                                                echo "<li>" . $dataKeluarga[$i] . "</li>";
                                            } ?>
                                        </ol>
                                        <br>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                    <li>
                        <b>PEMBAYARAN</b> <br>
                        <?= strtoupper($pembayaran) ?>

                    </li>
                </ol>
                SAYA TELAH MEMBACA dan SEPENUHNYA SETUJU dengan setiap pernyataan yang terdapat pada formulir ini dan menandatangani tanpa paksaan dan dengan kesadaran penuh.
                <table class="table table-borderless mt-5">
                    <tr>
                        <td colspan="3" class="text-end pe-5">Bangkalan, <?= $tglinput ?></td>
                    </tr>
                    <tr class="text-center" style="margin:auto;">
                        <td>
                            Pemberi Informasi
                            <br>
                            <br>
                            <div id="qrcode" class="pt-2"></div>
                            <br>
                            (<?= $petugas ?> )
                        </td>
                        <td>
                            Saksi Keluarga
                            <br>
                            <br>
                            <div id="ttdSaksi">
                                <?php if ($selesai) {
                                    echo '<img src="' . $ttdSaksi . '" alt="tanda tangan Saksi" style="max-width: 150px;">';
                                } else {
                                    echo '<br><br><br><br><br><br>';
                                } ?>
                            </div>
                            <br>
                            (<?= $saksi ?> )
                            <br><br>
                            <?php if (!$selesai) { ?>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdSaksi">
                                    Tanda tangan
                                </button>
                            <?php } ?>
                        </td>
                        <td>
                            Pasien / Wali Pasien
                            <br><br>

                            <div id="ttdWali">
                                <?php if ($selesai) {
                                    echo '<img src="' . $ttdWali . '" alt="tanda tangan Wali" style="max-width: 150px;">';
                                } else {
                                    echo '<br><br><br><br><br><br>';
                                } ?>
                            </div>
                            <br>
                            (<?= $nama ?> )
                            <br><br>
                            <?php if (!$selesai) { ?>
                                <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                    Tanda tangan
                                </button>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
                <input type="hidden" id="noRm" value="<?= $noRm ?>">
                <input type="hidden" id="petugas" value="<?= $petugas ?>">
                <div class="row mt-5">
                    <div class="col-12 text-center">
                        <div class="" id="pesanError"></div>
                        <?php if (!$selesai) { ?>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalKunci">Selesaikan dan kunci Tanda tangan.</button>
                        <?php } ?>
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
        $("#pesanError").html("")
        $("#pesanError").removeClass("alert alert-danger");

        var noRm = $("#noRm").val()
        var ttdSaksi = $("#ttdSaksi img").attr('src')
        var ttdWali = $("#ttdWali img").attr('src')

        if (ttdSaksi === undefined) {
            $("#pesanError").addClass("alert alert-danger");
            $("#pesanError").html("Saksi belum tanda tangan.")
            $("#modalKunci").modal("hide");
        } else if (ttdWali === undefined) {
            $("#pesanError").addClass("alert alert-danger");
            $("#modalKunci").modal("hide");
            $("#pesanError").html("Wali belum tanda tangan.")
        } else {
            $.ajax({
                url: '<?= base_url() ?>persetujuanRajal/simpanTtd',
                method: 'post',
                data: {
                    noRm: noRm,
                    ttdSaksi: ttdSaksi,
                    ttdWali: ttdWali
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        }
    }


    // Create a new QRCode instance
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.H // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrcode.makeCode("Di tanda tangani oleh " + $("#petugas").val() + " untuk Persetujuan Rawat Jalan. No RM : " + $("#noRm").val()); // Replace with your desired text or URL

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
            const dataURLWali = canvasWali.toDataURL('image/png'); // Get signature as PNG data URL
            const imgWali = document.createElement('img');
            imgWali.src = dataURLWali;
            imgWali.alt = 'Tanda tangan wali pasien';
            imgWali.style.maxWidth = '150px';
            imgWali.style.mazHeight = '100px';

            hasilTtdWali.innerHTML = '';
            hasilTtdWali.appendChild(imgWali);
            $("#modalTtdWali").modal("hide")

            // You can also send this dataURL to a server for storage
            // console.log(dataURL);
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
            const dataURLSaksi = canvasSaksi.toDataURL('image/png'); // Get signature as PNG data URL
            const imgSaksi = document.createElement('img');
            imgSaksi.src = dataURLSaksi;
            imgSaksi.alt = 'Tanda tangan saksi';
            imgSaksi.style.maxWidth = '150px';
            imgSaksi.style.mazHeight = '100px';

            hasilTtdSaksi.innerHTML = '';
            hasilTtdSaksi.appendChild(imgSaksi);
            $("#modalTtdSaksi").modal("hide")

            // You can also send this dataURL to a server for storage
            // console.log(dataURL);

        });
    });
</script>

</html>