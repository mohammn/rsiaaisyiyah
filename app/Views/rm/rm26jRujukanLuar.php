<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Kembali</a>
            <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>#modalTambahForm">Daftar Form</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">FORMULIR
                    SKRINING DARI LUAR RUMAH
                    SAKIT</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm26jRujukanLuar) : ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Asal rujukan</td>
                                    <td>: <?= $data->rm26jRujukanLuar["asal"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Alasan dirujuk</td>
                                    <td>: <?= $data->rm26jRujukanLuar["alasan"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Keadaan Umum</td>
                                    <td>: <?= $data->rm26jRujukanLuar["keadaan"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Kesadaran</td>
                                    <td>: <?= $data->rm26jRujukanLuar["kesadaran"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Waktu :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Diagnosa</td>
                                    <td>: <?= $data->rm26jRujukanLuar["diagnosa"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Terapi</td>
                                    <td>: <?= $data->rm26jRujukanLuar["terapi"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Pengirim</td>
                                    <td>: <?= $data->rm26jRujukanLuar["nama"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Bidan Penerima</td>
                                    <td>: <?= $data->rm26jRujukanLuar["petugas"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm26jRujukanLuar['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm26jRujukanLuar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm26jRujukanLuar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                            <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fa fa-edit me-1"></i> Edit
                            </button>
                        <?php endif ?>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                        <?php if ($data->pengaturan["waktu"]): ?>
                            <button class="btn btn-estetik btn-batal" data-bs-toggle="modal" data-bs-target="#modalWaktu">
                                <i class="fa fa-clock-o me-1"></i> Waktu
                            </button>
                        <?php endif; ?>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm26jRujukanLuar.php") ?>

                <div class="text-center">
                    <div class="bg-info" id="pesanError"> </div>
                    <br>
                    <a class="btn btn-estetik btn-hapus" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-cancel me-1"></i> Batal</a>
                    <button class="btn btn-estetik btn-simpan" onclick="simpan('tambah')">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade modal-xl  modal-dialog-scrollable" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                if ($data->rm26jRujukanLuar) : ?>
                    <?= $this->include("rm/partials/formRm26jRujukanLuar.php") ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm26jRujukanLuar['id'] ?? '' ?>)">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form pasien atas nama <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapus()">
                    <i class="fas fa-trash-alt me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal waktu -->
<div class="modal fade" id="modalWaktu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Sesuaikan tanggal dan jam.</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b>. <br> No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. <br><br>
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm26jRujukanLuar) ? date('Y-m-d\TH:i', strtotime($data->rm26jRujukanLuar["tglinput"])) : '' ?>">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="ubahWaktu()">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    function simpan(tujuanSimpan) {
        var noRawat = "<?= $data->pasien['no_rawat'] ?>";


        // Kumpulkan seluruh data ke dalam objek
        // Tangkap array checkbox Handover yang dicentang
        var handOver = [];
        $("input[name='handOver[]']:checked").each(function() {
            handOver.push($(this).val());
        });

        <?php
        $umur = '-';
        if (!empty($data->pasien['tgl_lahir'])) {
            $tglLahir = new DateTime($data->pasien['tgl_lahir']);
            $sekarang = new DateTime(); // Tanggal hari ini
            $diff     = $sekarang->diff($tglLahir);

            // Hasil format: 25 Th 3 Bln 10 Thn
            $umur = $diff->y . ' Th ' . $diff->m . ' Bln ' . $diff->d . ' Thn';
        }
        ?>

        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: noRawat,

            // Data Umum
            asal: $("#asal").val(),
            alasan: $("#alasan").val(),
            keadaan: $("#keadaan").val(),
            kesadaran: $("#kesadaran").val(),
            terapi: $("#terapi").val(),
            tindakan: $("#tindakan").val(),
            umur: '<?= $umur ?>',

            // Handover
            handOver: JSON.stringify(handOver),
            isiHandOverLainLain: $("#isiHandOverLainLain").val(),

            // Keterangan Bidan Penerima
            keteranganBidan: $("input[name='keteranganBidan']:checked").val() || '',
            alasanKeterangan: $("#alasanKeterangan").val(),

            // Data Vital & Diagnosa
            diagnosa: $("#diagnosa").val(),
            td_sistol: $("#td_sistol").val(),
            td_diastol: $("#td_diastol").val(),
            nadi: $("#nadi").val(),
            suhu: $("#suhu").val(),
            rr: $("#rr").val(),
            tfu: $("#tfu").val(),
            djj: $("#djj").val(),
            his: $("#his").val(),
            vt: $("#vt").val(),

            // Petugas & Pengirim
            petugas: $("#petugas").val(),
            nama: $("#nama").val()
        };


        // ===========================================================================

        $("#pesanError").html("");

        // Validasi field Nama yang menerima
        if (nama === "") {
            $("#nama").focus();
            $("#pesanError").html("Pengirim wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm26jRujukanLuar/simpan") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }
    }


    <?php if ($data->rm26jRujukanLuar) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm26jRujukanLuar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url("rm/rm26jRujukanLuar/hapus") ?>',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        function ubahWaktu() {
            waktu = $("#waktu").val();
            noRawat = "<?= $data->rm26jRujukanLuar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26jRujukanLuar/ubahWaktu',
                method: 'post',
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    "noRawat": noRawat,
                    "waktu": waktu
                },
                dataType: 'json',
                success: function(data) {
                    $("#modalWaktu").modal("hide");
                }
            });
        }

        $(document).ready(function() {
            if (window.location.hash === '#modalHapus') {
                tryHapus();
            }
        });

    <?php endif; ?>
</script>
<?php $this->endSection() ?>