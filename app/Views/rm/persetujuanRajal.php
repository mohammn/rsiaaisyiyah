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
                <h3>Persetujuan Rawat Jalan</h3>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->persetujuanRajal) : ?>
                <div class="row">
                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-1">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <mark>Yang bertanda tangan :</mark>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->persetujuanRajal["nama"] ?></td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td>: <?= $data->persetujuanRajal["noHp"] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->persetujuanRajal["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->persetujuanRajal["sebagai"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-1">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <div>
                                <table class="table table-info table-borderless">
                                    <tr>
                                        <td>Petugas</td>
                                        <td>: <?= $data->persetujuanRajal["petugas"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Saksi</td>
                                        <td>: <?= $data->persetujuanRajal["saksi"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Anggota Keluarga</td>
                                        <td>: <?= $data->persetujuanRajal["keluarga"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>: <?= $data->persetujuanRajal["pembayaran"] ?></td>
                                    </tr>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <button class="btn btn-estetik btn-edit" onclick="tryEdit()">
                            <i class="fas fa-edit me-1"></i> Edit
                        </button>
                        <?php if ($data->persetujuanRajal['selesai']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
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
                <?= $this->include("rm/partials/formPersRajal") ?>

                <div class="text-center">
                    <div class="bg-info" id="pesanError"> </div>
                    <br>
                    <a class="btn btn-estetik btn-hapus" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-cancel me-1"></i> Batal</a>
                    <button class="btn btn-estetik btn-simpan" onclick="tambah()">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="noTelpEdit" class="form-label">No telp :</label>
                    <input type="text" class="form-control" id="noTelpEdit" placeholder="No Telpon">
                </div>
                <input type="hidden" id="noRmedit">
                <div class="mb-0">
                    <label for="namaKeluargaEdit" class="form-label">Anggota keluarga yang bisa melihat Rekam Medis :</label>
                    <textarea id="namaKeluargaEdit" class="form-control" placeholder="Ketik nama keluarga. dipisah koma apabila lebih dari satu nama."></textarea>
                </div>
                <sub class="alert alert-warning m-0 p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="edit()">
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus persetujuan rawat jalan ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form Persetujuan Rawat Jalan pasien atas nama <b id="namaPasienHapus"></b> dengan no. Rekam Medis : <b id="noRmHapus"></b> ? <br>
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->persetujuanRajal) ? date('Y-m-d\TH:i', strtotime($data->persetujuanRajal["tglinput"])) : '' ?>">
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
    <?php if (!$data->pjPasien): ?>
        $('#samaDgPj').prop('disabled', true);
    <?php endif; ?>

    function setSamadgPasien(asal) {
        if (asal == 'pasien') {
            $("#namaWali").val(<?= json_encode($data->pasien['nm_pasien']) ?>);
            $("#alamat").val(<?= json_encode($data->pasien['alamat']) ?>);
            $("#noTelp").val(<?= json_encode($data->pasien['no_tlp']) ?>);
            $("#sebagai").val("Saya sendiri")

            $("#namaWali").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#noTelp").prop('disabled', true);
            $("#sebagai").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#namaWali").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
                $("#alamat").val(<?= json_encode($data->pjPasien['alamatPj']) ?>);
            <?php endif; ?>
            $("#noTelp").val("")
            $("#sebagai").val("Suami")

            $("#namaWali").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#namaWali").val("")
            $("#alamat").val("")
            $("#noTelp").val("")
            $("#sebagai").val("Suami")

            $("#namaWali").prop('disabled', false);
            $("#alamat").prop('disabled', false);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function tambah() {
        var noRm = "<?= $data->pasien["no_rkm_medis"] ?>";
        var namaWali = $("#namaWali").val();;
        var noTelp = $("#noTelp").val();
        var alamat = $("#alamat").val();
        var sebagai = $("#sebagai").val();
        var petugas = $("#petugas").val();
        var saksi = $("#saksi").val();
        var namaKeluarga = $("#namaKeluarga").val()
        var pembayaran = $("#pembayaran").val()
        $("#pesanError").html("")

        if (namaWali.replace(/\s+/g, "-") == "") {
            $("#namaWali").focus()
            $("#pesanError").html("Nama wajib diisi")
        } else if (noTelp.replace(/\s+/g, "-") == "") {
            $("#noTelp").focus()
            $("#pesanError").html("No telp. wajib diisi")
        } else if (alamat.replace(/\s+/g, "-") == "") {
            $("#alamat").focus()
            $("#pesanError").html("Alamat wajib diisi")
        } else if (saksi.replace(/\s+/g, "-") == "") {
            $("#saksi").focus()
            $("#pesanError").html("Saksi wajib diisi")
        } else if (namaKeluarga.replace(/\s+/g, "-") == "") {
            $("#namaKeluarga").focus()
            $("#pesanError").html("Nama Keluarga wajib diisi")
        } else {
            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRajal/tambah',
                method: 'post',
                data: "namaWali=" + namaWali + "&noRm=" + noRm + "&noTelp=" + noTelp + "&alamat=" + alamat + "&sebagai=" + sebagai + "&petugas=" + petugas + "&saksi=" + saksi + "&namaKeluarga=" + namaKeluarga + "&pembayaran=" + pembayaran,
                dataType: 'json',
                success: function(data) {
                    $("#namaWali").val("")
                    $("#noTelp").val("")
                    $("#alamat").val("")
                    $("#saksi").val("")
                    $("#namaKeluarga").val("")

                    location.reload();
                }
            });
        }
    }


    <?php if ($data->persetujuanRajal) : ?>

        function tryEdit() {
            $("#namaPasienJudulEdit").html("<?= $data->pasien["nm_pasien"] ?>");

            $("#noRmedit").val("<?= $data->pasien["no_rkm_medis"] ?>");
            $("#namaKeluargaEdit").val("<?= $data->persetujuanRajal["keluarga"] ?>");
            $("#noTelpEdit").val("<?= $data->persetujuanRajal["noHp"] ?>");
            $("#modalEdit").modal("show");
        }

        function edit() {
            var noRm = $("#noRmedit").val()
            var namaKeluarga = $("#namaKeluargaEdit").val()
            var noTelp = $("#noTelpEdit").val()

            if (namaKeluarga.replace(/\s+/g, "-") == "") {
                $("#namaWali").focus()
            } else {
                $.ajax({
                    url: '<?= base_url() ?>rm/persetujuanRajal/edit',
                    method: 'post',
                    data: "namaKeluarga=" + namaKeluarga + "&noRm=" + noRm + "&noTelp=" + noTelp,
                    dataType: 'json',
                    success: function(data) {
                        $("#noRmedit").val("")
                        $("#namaKeluargaEdit").val("")
                        $("#noTelpEdit").val("")

                        location.reload();
                    }
                });
            }
        }

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRmHapus").html("<?= $data->pasien["no_rkm_medis"] ?>")
        }

        function hapus() {
            var noRm = $("#noRmHapus").html()

            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRajal/hapus',
                method: 'post',
                data: "noRm=" + noRm,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        function ubahWaktu() {
            waktu = $("#waktu").val();
            noRm = "<?= $data->pasien["no_rkm_medis"] ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRajal/ubahWaktu',
                method: 'post',
                data: {
                    "<?= csrf_token() ?>": "<?= csrf_hash() ?>",
                    "noRm": noRm,
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