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
                <h5 class="text-uppercase">
                    STATUS ANESTESI
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm11b2StatusAnestesi) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Ruang Rawat</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["ruang"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: <?= !empty($data->rm11b2StatusAnestesi["tgl"]) ? date('d-m-Y', strtotime($data->rm11b2StatusAnestesi["tgl"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Pra-anestesi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["diagnosisPraAnestesi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["tempat"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Spesialis Bedah</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["spesialisBedah"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Asisten Bedah</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["asistenBedah"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Spesialis Anestesiologi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["spesialisAnestesiologi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>asisten/Perawat Anestesiologi</td>
                                    <td>: <?= $data->rm11b2StatusAnestesi["asistenAnestesi"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php
                        $ttd = $data->rm11b2StatusAnestesi;
                        if ((
                            $ttd["ttdDokter1"] &&
                            $ttd["ttdDokter2"] &&
                            $ttd["ttdDokter3"] &&
                            $ttd["ttdDokter4"]
                        )):
                        ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm11b2StatusAnestesi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b2StatusAnestesi['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm11b2StatusAnestesi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b2StatusAnestesi['id']) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm11b2StatusAnestesi.php") ?>

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
                <?php if ($data->rm11b2StatusAnestesi) : ?>
                    <?= $this->include("rm/partials/formRm11b2StatusAnestesi.php") ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm11b2StatusAnestesi['id'] ?? '' ?>)">
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

<script>
    function simpan(tujuanSimpan) {
        var noRawat = "<?= $data->pasien['no_rawat'] ?>";
        // 1. Capture the form data into an array
        var formArray = $("form").serializeArray();

        // 2. Convert it into a clean "data" object
        var data = {};
        $.map(formArray, function(n, i) {
            // If the name ends with [], handle it as an array
            if (n['name'].indexOf('[]') !== -1) {
                var cleanName = n['name'].replace('[]', '');
                if (!data[cleanName]) {
                    data[cleanName] = [];
                }
                data[cleanName].push(n['value']);
            } else {
                // Standard field
                data[n['name']] = n['value'];
            }
        });

        // Now 'data' is ready to be used
        console.log(data);

        data.tujuanSimpan = tujuanSimpan; // adding from a variable
        data.noRawat = noRawat; // adding from a variable

        // ===========================================================================

        $("#pesanError").html("");

        // Validasi field Nama yang menerima
        if (data.nama === "") {
            $("#nama").focus();
            $("#pesanError").html("Pengirim wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm11b2StatusAnestesi/simpan") ?>',
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


    <?php if ($data->rm11b2StatusAnestesi) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm11b2StatusAnestesi['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11b2StatusAnestesi/hapus',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
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