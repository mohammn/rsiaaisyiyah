<?php

/** @var object $data */
if ($data->rm26hKepercayaan) {
    $tglLahir = new \DateTime($data->rm26hKepercayaan["tanggalLahir"]);
}
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
                <h5 class="text-uppercase">IDENTIFIKASI NILAI – NILAI DAN KEPERCAYAAN PASIEN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm26hKepercayaan) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <mark>Yang bertanda tangan :</mark>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->rm26hKepercayaan["nama"] . " (" . $data->rm26hKepercayaan["jk"] . ")" ?></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: <?= $data->rm26hKepercayaan["nik"]  ?></td>
                                </tr>
                                <tr>
                                    <td>TTL</td>
                                    <td>: <?= $data->rm26hKepercayaan["tempatLahir"] . ", " . $tglLahir->format('d-m-Y') ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->rm26hKepercayaan["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->rm26hKepercayaan["sebagai"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row mb-3">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless mb-3">
                                <tr>
                                    <td>Petugas</td>
                                    <td>: <?= $data->rm26hKepercayaan["petugas"] ?></td>
                                </tr>
                                <tr>
                                    <td>Kepercayaan</td>
                                    <td>: <?= nl2br(esc($data->rm26hKepercayaan["nilaiKepercayaan"])) ?></td>
                                </tr>
                            </table>
                            <br>
                            <br>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm26hKepercayaan['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm26hKepercayaan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm26hKepercayaan['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm26hKepercayaan/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm26hKepercayaan['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formRm26hKepercayaan.php") ?>

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
                <?= $this->include("rm/partials/formRm26hKepercayaan.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm26hKepercayaan['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm26hKepercayaan) ? date('Y-m-d\TH:i', strtotime($data->rm26hKepercayaan["tglinput"])) : '' ?>">
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
            $("#nama").val(<?= json_encode($data->pasien['nm_pasien']) ?>);
            $("#jk").val(<?= json_encode($data->pasien['jk']) ?>);
            $("#tglLahir").val(<?= json_encode($data->pasien['tgl_lahir']) ?>);
            $("#tempatLahir").val(<?= json_encode($data->pasien['tmp_lahir']) ?>);
            $("#alamat").val(<?= json_encode($data->pasien['alamat']) ?>);
            $("#nik").val(<?= json_encode($data->pasien['no_ktp']) ?>);
            $("#sebagai").val("Saya sendiri")

            $("#nama").prop('disabled', true);
            $("#jk").prop('disabled', true);
            $("#tempatLahir").prop('disabled', true);
            $("#tglLahir").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#nik").prop('disabled', true);
            $("#sebagai").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
                $("#alamat").val(<?= json_encode($data->pjPasien['alamatPj']) ?>);
                $("#jk").val(<?= json_encode($data->pjPasien['jkPj']) ?>);
                $("#tglLahir").val(<?= json_encode($data->pjPasien['tglLahirPj']) ?>);
                $("#tempatLahir").val(<?= json_encode($data->pjPasien['tempatLahirPj']) ?>);
                $("#nik").val(<?= json_encode($data->pjPasien['nikPj']) ?>);
            <?php endif; ?>
            $("#sebagai").val("Suami")

            $("#nama").prop('disabled', true);
            $("#jk").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#tglLahir").prop('disabled', true);
            $("#tempatLahir").prop('disabled', true);
            $("#nik").prop('disabled', true);
            $("#sebagai").prop('disabled', false);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val(<?= json_encode($data->rm26hKepercayaan['nama'] ?? '') ?>);
            $("#jk").val(<?= json_encode($data->rm26hKepercayaan['jk'] ?? '') ?>);
            $("#tglLahir").val(<?= json_encode($data->rm26hKepercayaan['tanggalLahir'] ?? '') ?>);
            $("#tempatLahir").val(<?= json_encode($data->rm26hKepercayaan['tempatLahir'] ?? '') ?>);
            $("#alamat").val(<?= json_encode($data->rm26hKepercayaan['alamat'] ?? '') ?>);
            $("#nik").val(<?= json_encode($data->rm26hKepercayaan['nik'] ?? '') ?>);
            $("#sebagai").val(<?= json_encode($data->rm26hKepercayaan['sebagai'] ?? 'Suami') ?>);

            $("#nama").prop('disabled', false);
            $("#jk").prop('disabled', false);
            $("#tempatLahir").prop('disabled', false);
            $("#tglLahir").prop('disabled', false);
            $("#alamat").prop('disabled', false);
            $("#nik").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // --- DATA PENANGGUNG JAWAB (Form Kiri) ---
            nama: $('#nama').val(),
            jk: $('#jk').val() || '',
            tempatLahir: $('#tempatLahir').val(),
            tglLahir: $('#tglLahir').val(),
            nik: $('#nik').val(),
            alamat: $('#alamat').val(),
            sebagai: $('#sebagai').val(),

            // --- PEMBERIAN INFORMASI (Form Kanan) ---
            petugas: $('#petugas').val(), // Mengambil id="petugas" (input hidden di kiri atau input disabled paling bawah)
            nilaiKepercayaan: $('#nilaiKepercayaan').val(),
        };

        $("#pesanError").html("");

        if (data.nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else if (!data.jk) {
            $("#jk").focus();
            $("#pesanError").html("Jenis Kelamin wajib dipilih");
        } else if (data.tempatLahir.replace(/\s+/g, "-") == "") {
            $("#tempatLahir").focus();
            $("#pesanError").html("Tempat Lahir wajib diisi");
        } else if (data.tglLahir.replace(/\s+/g, "-") == "") {
            $("#tglLahir").focus();
            $("#pesanError").html("Tanggal lahir wajib diisi");
        } else if (data.nik.replace(/\s+/g, "-") == "") {
            $("#nik").focus();
            $("#pesanError").html("NIK wajib diisi");
        } else if (data.alamat.replace(/\s+/g, "-") == "") {
            $("#alamat").focus();
            $("#pesanError").html("Alamat wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm26hKepercayaan/simpan") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }
    }


    <?php if ($data->rm26hKepercayaan) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm26hKepercayaan['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26hKepercayaan/hapus',
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
            noRawat = "<?= $data->rm26hKepercayaan['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26hKepercayaan/ubahWaktu',
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