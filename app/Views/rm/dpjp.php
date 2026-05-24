<?php

/** @var object $data */
if ($data->dpjp) {
    $tglLahir = new \DateTime($data->dpjp["tanggalLahir"]);
}
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Tutup Form</a>
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>#modalTambahForm">Daftar Fom</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5>FORMULIR PEMILIHAN DPJP</h5>
                <h5>(DOKTER PENANGGUNG JAWAB PASIEN)</h5>
                <h5>RAWAT INAP</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->dpjp) : ?>
                <div class="row">
                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <mark>Yang bertanda tangan :</mark>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->dpjp["nama"] . " (" . $data->dpjp["jk"] . ")" ?></td>
                                </tr>
                                <tr>
                                    <td>TTL / Umur</td>
                                    <td>: <?= $data->dpjp["tempatLahir"] . ", " . $tglLahir->format('d-m-Y') . " / " . $data->dpjp["umur"] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->dpjp["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->dpjp["sebagai"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row pb-2">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <div>
                                <table class="table table-info table-borderless">
                                    <tr>
                                        <td>Petugas</td>
                                        <td>: <?= $data->dpjp["petugas"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dokter DPJP</td>
                                        <td>: <?= $data->dpjp["dokter"] ?></td>
                                    </tr>
                                </table>
                                <br><br><br><br>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->dpjp['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formDpjp") ?>

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

<!-- Modal hapus-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus persetujuan rawat jalan ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form pemilihan DPJP pasien atas nama <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->dpjp) ? date('Y-m-d\TH:i', strtotime($data->dpjp["tglinput"])) : '' ?>">
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
            $("#nama").val("<?= $data->pasien['nm_pasien'] ?>")
            $("#jk").val("<?= $data->pasien['jk'] ?>")
            $("#tglLahir").val("<?= $data->pasien['tgl_lahir'] ?>")
            $("#tempatLahir").val("<?= $data->pasien['tmp_lahir'] ?>")
            $("#alamat").val("<?= $data->pasien['alamat'] ?>")
            $("#sebagai").val("Saya sendiri")

            $("#nama").prop('disabled', true);
            $("#jk").prop('disabled', true);
            $("#tempatLahir").prop('disabled', true);
            $("#tglLahir").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#sebagai").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val("<?= $data->pjPasien['namaPj'] ?>")
                $("#alamat").val("<?= $data->pjPasien['alamatPj'] ?>")
                $("#jk").val("<?= $data->pjPasien['jkPj'] ?>")
                $("#tglLahir").val("<?= $data->pjPasien['tglLahirPj'] ?>")
                $("#tempatLahir").val("<?= $data->pjPasien['tempatLahirPj'] ?>")
            <?php endif; ?>
            $("#sebagai").val("Suami")

            $("#nama").prop('disabled', true);
            $("#jk").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#tglLahir").prop('disabled', true);
            $("#tempatLahir").prop('disabled', true);
            $("#sebagai").prop('disabled', false);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val("")
            $("#jk").val("")
            $("#tglLahir").val("")
            $("#tempatLahir").val("")
            $("#alamat").val("")
            $("#noTelp").val("")
            $("#sebagai").val("Suami")

            $("#nama").prop('disabled', false);
            $("#jk").prop('disabled', false);
            $("#tempatLahir").prop('disabled', false);
            $("#tglLahir").prop('disabled', false);
            $("#alamat").prop('disabled', false);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function tambah() {
        var noRawat = "<?= $data->pasien["no_rawat"] ?>";
        var nama = $("#nama").val();
        var jk = $("#jk").val();
        var tempatLahir = $("#tempatLahir").val();
        var tglLahir = $("#tglLahir").val();
        var alamat = $("#alamat").val();
        var sebagai = $("#sebagai").val();
        var petugas = $("#petugas").val();
        var dokter = $("#dokter").val();
        $("#pesanError").html("")

        if (nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus()
            $("#pesanError").html("Nama wajib diisi")
        } else if (!jk) {
            $("#jk").focus()
            $("#pesanError").html("Jenis Kelamin wajib dipilih")
        } else if (tempatLahir.replace(/\s+/g, "-") == "") {
            $("#tempatLahir").focus()
            $("#pesanError").html("Tempat Lahir wajib diisi")
        } else if (tglLahir.replace(/\s+/g, "-") == "") {
            $("#tglLahir").focus()
            $("#pesanError").html("Tanggal lahir wajib diisi")
        } else if (alamat.replace(/\s+/g, "-") == "") {
            $("#alamat").focus()
            $("#pesanError").html("Alamat wajib diisi")
        } else if (!dokter) {
            $("#dokter").focus()
            $("#pesanError").html("Dokter wajib dipilih")
        } else {
            console.log('7')
            $.ajax({
                url: '<?= base_url() ?>rm/dpjp/tambah',
                method: 'post',
                data: "nama=" + nama + "&noRawat=" + noRawat + "&jk=" + jk + "&tempatLahir=" + tempatLahir + "&tglLahir=" + tglLahir + "&alamat=" + alamat + "&sebagai=" + sebagai + "&petugas=" + petugas + "&dokter=" + dokter,
                dataType: 'json',
                success: function(data) {
                    $("#nama").val("")
                    $("#jk").val(null)
                    $("#tempatLahir").val("")
                    $("#tglLahir").val("")
                    $("#alamat").val("")
                    $("#sebagai").val(null)
                    $("#dokter").val(null)

                    location.reload();
                }
            });
        }
    }


    <?php if ($data->dpjp) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = $("#noRawatHapus").html()

            $.ajax({
                url: '<?= base_url() ?>rm/dpjp/hapus',
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
            noRawat = "<?= $data->pasien["no_rawat"] ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/dpjp/ubahWaktu',
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