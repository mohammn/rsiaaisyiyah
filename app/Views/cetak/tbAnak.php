<?php

/** @var object $data */
$tgl_lahir = $data->pasien["tgl_lahir"] ?? null;
$tgl_skrining = $data->tbAnak["tglSkrining"] ?? null;

if ($tgl_lahir && $tgl_skrining) {
    $lahir = new DateTime($tgl_lahir);
    $skrining = new DateTime($tgl_skrining);
    $diff = $lahir->diff($skrining);

    $usia = $diff->y; // Hanya menghasilkan angka saja (misal: 4)
} else {
    $usia =  0;
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
        font: 8pt "Tahoma";

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

    .table-padding-minimal th,
    .table-padding-minimal td {
        padding-top: 0mm !important;
        padding-bottom: 0mm !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tb Anak</title>

    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">

                <div class="row">
                    <div class="col-12 text-center">
                        <img src="<?= base_url() ?>public/assets/img/kemenkes.png" alt="logo kemenkes" style="width: 50px;">
                        <img src="<?= base_url() ?>public/assets/img/tosstb.png" alt="logo toss tb" style="width: 50px;">
                        <p style="font-size: 14pt; margin:10px;" class="text-uppercase fw-bold">
                            FORMULIR SKRINING TBC UNTUK USIA &lt; 15 TAHUN
                        </p>
                    </div>
                </div>

                <table class="table table-sm table-bordered table-padding-minimal mb-0">
                    <tr>
                        <th colspan="4" class="text-center bg-info">IDENTITAS DIRI PESERTA</th>
                    </tr>
                    <tr>
                        <td>Tanggal Skrining</td>
                        <td colspan="3">: <?= $data->tbAnak["tglSkrining"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Tempat Skrining</td>
                        <td colspan="3">: <?= $data->tbAnak["tempatSkrining"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td colspan="3">: <?= $data->pasien["nm_pasien"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat KTP</td>
                        <td colspan="3">: <?= $data->pasien["alamat"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Alamat Domisili</td>
                        <td colspan="3">: <?= $data->pasien["alamat"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>NIK</td>
                        <td colspan="3">: <?= $data->pasien["no_ktp"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Pekerjaan</td>
                        <td colspan="3">: <?= $data->pasien["pekerjaan"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>: <?= $data->pasien["tgl_lahir"] ?? '-' ?></td>
                        <td>Usia</td>
                        <td>: <?= $usia ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td colspan="3">: <?= $data->pasien["jk"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td>No. Hp</td>
                        <td colspan="3">: <?= $data->pasien["no_hp"] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">PEMERIKSAAN BERAT BADAN DAN TINGGI BADAN</th>
                    </tr>
                    <tr>
                        <?php if ($usia < 5): ?>
                            <th colspan="4" class="text-center bg-success">Usia &lt; 5 tahun: BB/PB sesuai kategori usia</th>
                        <?php else: ?>
                            <th colspan="4" class="text-center bg-success">Usia 5-15 tahun: IMT/U</th>
                        <?php endif; ?>
                    </tr>
                    <tr>
                        <td colspan="2">Berat Badan <?= $data->tbAnak["beratBadan"] ?? '....' ?> Kg</td>
                        <td colspan="2">Tinggi/Panjang Badan <?= $data->tbAnak["tinggiBadan"] ?? '....' ?> Cm</td>
                    </tr>
                    <tr>
                        <?php if ($usia < 5): ?>
                            <td colspan="2">
                                <b>Standar Hasil Status Gizi:</b><br>
                                &gt;2 tahun menggunakan perhitungan BB/PB dilihat berdasarkan tabel z-score <br>
                                2-5 tahun menggunakan perhitungan BB/TB dilihat berdasarkan tabel z-score
                            </td>
                        <?php else: ?>
                            <td colspan="2">
                                <b>Standar Hasil Status Gizi:</b><br>
                                5-15 tahun menggunakan perhitungan IMT/U dilihat berdasarkan tabel z-score
                            </td>
                        <?php endif; ?>
                        <td colspan="2">
                            <?= $data->tbAnak["statusGizi"] ?? '....' ?>
                        </td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">PEMERIKSAAN RIWAYAT KONTAK TBC</th>
                    </tr>
                    <tr>
                        <td colspan="2">Apakah ada kontak dengan pasien TBC?</td>
                        <td colspan="2"><?php $data->tbAnak['kontakTbc'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jika Ya, jenis kontak TBC :</td>
                        <td colspan="2"><?php $data->tbAnak['jenisKontak'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jika Ya, sebutkan nama kasus indeks TBC :</td>
                        <td colspan="2"><?php $data->tbAnak['indeksTbc'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jika Ya, pilih jenis TBC yang diderita oleh kasus indeks :</td>
                        <td colspan="2"><?php $data->tbAnak['jenisTbc'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">FAKTOR RISIKO</th>
                    </tr>
                    <tr>
                        <td colspan="2">Pernah terdiagnosis/berobat TBC</td>
                        <td colspan="2"><?php $data->tbAnak['berobatTbc'] === 'Ya' ? 'Ya, Tanggal : ' . $data->tbAnak['tglBerobatTbc'] : ($data->tbAnak['berobatTbc'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Kekurangan Gizi</td>
                        <td colspan="2"><?= $data->tbAnak['kurangGizi'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Merokok</td>
                        <td colspan="2"><?= $data->tbAnak['merokok'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Perokok Pasif</td>
                        <td colspan="2"><?= $data->tbAnak['perokokPasif'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Riwayat DM/Kencing Manis</td>
                        <td colspan="2"><?= $data->tbAnak['kencingManis'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">ODHIV</td>
                        <td colspan="2"><?= $data->tbAnak['odhiv'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Lansia &gt; 65 Tahun</td>
                        <td colspan="2"><?= $data->tbAnak['lansia'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Ibu Hamil</td>
                        <td colspan="2"><?= $data->tbAnak['ibuHamil'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Warga Binaan Pemasyarakatan (WBP)</td>
                        <td colspan="2"><?= $data->tbAnak['wbp'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jika WBP, tanggal masuk lapas/rutan</td>
                        <td colspan="2"><?= $data->tbAnak['tglWbp'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Jika WBP, status WBP nya adalah</td>
                        <td colspan="2"><?= $data->tbAnak['statusWbp'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Tinggal di wilayah padat kumuh miskin</td>
                        <td colspan="2"><?= $data->tbAnak['kumuh'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">SKRINING GEJALA</th>
                    </tr>
                    <tr>
                        <th colspan="4" class="bg-success">Gejala</th>
                    </tr>
                    <tr>
                        <td colspan="2">Batuk &gt; minggu</td>
                        <td colspan="2"><?= $data->tbAnak['batuk'] === 'Tidak' ? 'Tidak, Durasi : ' . ($data->tbAnak['durasiBatuk'] ?? '...') : ($data->tbAnak['batuk'] ?? '-') ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Demam hilang timbul tanpa sebab yang jelas &gt; 2 minggu</td>
                        <td colspan="2"><?= $data->tbAnak['demam'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">BB turun tanpa penyebab jelas/BB tidak naik dalam 2 bulan sebelumnya/nafsu makan turun</td>
                        <td colspan="2"><?= $data->tbAnak['bb'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Lesu atau malaise, anak kurang aktif bermain</td>
                        <td colspan="2"><?= $data->tbAnak['lesu'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="bg-success">Tanda (Pemeriksaan Dilakukan oleh Tenaga Kesehatan)</th>
                    </tr>
                    <tr>
                        <td colspan="2">Pembesaran kelenjar getah bening</td>
                        <td colspan="2"><?= $data->tbAnak['getahBening'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="bg-success">Hasil Skrining Gejala TBC</th>
                    </tr>
                    <tr>
                        <td colspan="2">Seseorang dinyatakan <b>skrining gejala TBC positif</b> apabila memiliki salah satu gejala TBC</td>
                        <td colspan="2"><?= $data->tbAnak['posit'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">PEMERIKSAAN RADIOGRAFI TORAKS</th>
                    </tr>
                    <tr>
                        <td colspan="2">Apakah dilakukan Pemeriksaan Radiografi Toraks?</td>
                        <td colspan="2"><?= $data->tbAnak['radiologi'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Skor Pembacaan AI Hasil Pemeriksaan Radiografi Toraks</td>
                        <td colspan="2"><?= $data->tbAnak['skorRadiologi'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Kesan Pembacaan Hasil Pemeriksaan Radiografi Toraks oleh Klinisi</td>
                        <td colspan="2"><?= $data->tbAnak['kesanRadiologi'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Kesimpulan Hasil Pemeriksaan Radiografi Toraks</td>
                        <td colspan="2"><?= $data->tbAnak['kesimpulan'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">TEDUGA TBC</th>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><?= $data->tbAnak['terduga'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" class="text-center bg-info">PEMERIKSAAN TBC LATEN</th>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><?= $data->tbAnak['laten'] ?? '-' ?></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            Fasyankes Rujukan : <?= $data->tbAnak['fasyankes'] ?? '-' ?>
                        </td>
                    </tr>
                </table>

                <div>
                    <b>Keterangan:</b><br>

                    <b>Dikatakan terduga TBC, jika:</b><br>
                    Skrining gejala TBC positif dan/atau pemeriksaan radiografi toraks abnormalitas mengarah ke TBC<br>

                    <b>Dikatakan bukan terduga TBC, jika:</b><br>
                    Skrining gejala TBC negatif dan/atau hasil pemeriksaan radiografi toraks menunjukkan normal/abnormalitas tidak mengarah ke TBC<br>

                    <b>Dikatakan Pemeriksaan TBC Laten "Ya", jika:</b>
                    <ul class="mb-0">
                        <li>Kontak serumah dengan pasien TBC terkonfirmasi bakteriologis yang bukan terduga TBC atau</li>
                        <li>Kelompok berisiko yang bukan terduga TBC</li>
                    </ul>

                    <b>Dikatakan Pemeriksaan TBC Laten "Tidak", jika memenuhi salah satu kriteria berikut:</b>
                    <ul>
                        <li>Dikatakan sebagai terduga TBC</li>
                        <li>Anak usia &lt;5 tahun kontak serumah dengan pasien TBC terkonfirmasi bakteriologis (Diberikan TPT)</li>
                        <li>ODHIV (Diberikan TPT)</li>
                    </ul>
                </div>

                <div class="row text-center mt-1">
                    <table class="table table-borderless">
                        <tr class="text-center" style="margin:auto;">
                            <td>
                                Pemeriksa
                                <br>
                                <br>
                                <div id="qrPetugas" class="pt-2"></div>
                                <br>
                                (<?= $data->tbAnak["petugas"] ?> )
                            </td>
                            <td></td>
                            <td>
                                Pasien
                                <br><br>

                                <div id="ttdWali">
                                    <?php if ($data->tbAnak["ttdWali"]) {
                                        // Sudah ditambahkan 'public/' agar gambar tidak broken/silang
                                        echo '<img src="' . base_url('public/ttd/tbAnak/' . $data->tbAnak["ttdWali"]) . '" alt="tanda tangan Wali" style="max-width: 150px;" data-is-new="false">';
                                    } else {
                                        echo '<br><br><br><br><br>';
                                    } ?>
                                </div>
                                <br>
                                (<?= $data->pasien["nm_pasien"] ?> )
                                <br><br>
                                <?php if (!$data->tbAnak["ttdWali"]) { ?>
                                    <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#modalTtdWali">
                                        Tanda tangan
                                    </button>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" id="noRawat" value="<?= $data->tbAnak["noRawat"] ?>">
                    <input type="hidden" id="petugas" value="<?= $data->tbAnak["petugas"] ?>">
                    <div class="row mt-2">
                        <div class="col-12 text-center">
                            <div class="" id="pesanError"></div>
                            <?php if (!$data->tbAnak["ttdWali"]) { ?>
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
            $("#pesanError").addClass("alert alert-danger").html("Pasien belum tanda tangan.");
            $("#modalKunci").modal("hide");
            return;
        }

        // PERBAIKAN: Menggunakan .attr('data-is-new') untuk membaca string 'true' secara akurat
        var isWaliNew = (imgWaliEl.attr('data-is-new') === 'true' || imgWaliEl.data('is-new') === true);
        var ttdWali = isWaliNew ? imgWaliEl.attr('src') : '';


        $.ajax({
            url: '<?= base_url() ?>rm/tbAnak/simpanTtd',
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
    var qrPetugas = new QRCode(document.getElementById("qrPetugas"), {
        width: 100, // Set the width of the QR code
        height: 100, // Set the height of the QR code
        colorDark: "#000000", // Color of the dark modules (e.g., black squares)
        colorLight: "#ffffff", // Color of the light modules (e.g., white spaces)
        correctLevel: QRCode.CorrectLevel.L // Error correction level (L, M, Q, H)
    });

    // Generate the QR code with the desired content
    qrPetugas.makeCode("Di ttd " + $("#petugas").val() + " untuk Tata Tertib. No Rawat : " + $("#noRawat").val()); // Replace with your desired text or URL

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