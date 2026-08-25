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
                <h5 class="text-uppercase">TRANSFER PASIEN ANTAR UNIT PELAYANAN
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm9aTransferPasien) : ?>
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pemindahan :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Penanggung Jawab</td>
                                    <td>: <?= $data->rm9aTransferPasien["nama"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->rm9aTransferPasien["sebagai"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Dari unit</td>
                                    <td>: <?= $data->rm9aTransferPasien["dariUnit"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Ke unit</td>
                                    <td>: <?= $data->rm9aTransferPasien["keUnit"] ?></td>
                                </tr>
                                <tr>
                                    <td>Metode Pemindahan</td>
                                    <td>: <?= $data->rm9aTransferPasien["metodePindah"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data pasien :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Diagnosa Medis</td>
                                    <td>: <?= $data->rm9aTransferPasien["diagnosa"] ?></td>
                                </tr>
                                <tr>
                                    <td>Tindakan yang sudah dilakukan</td>
                                    <td>: <?= $data->rm9aTransferPasien["tindakan"] ?></td>
                                </tr>
                                <tr>
                                    <td>Obat-obatan yang diberikan</td>
                                    <td>: <?= $data->rm9aTransferPasien["obat"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Pemeriksaan penunjang</td>
                                    <td>: <?= $data->rm9aTransferPasien["pemeriksaan"]  ?></td>
                                </tr>
                                <tr>
                                    <td>DPJP</td>
                                    <td>: <?= $data->rm9aTransferPasien["dokter"]  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm9aTransferPasien/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm9aTransferPasien['id']) ?>" target="_blank">
                            <i class="fas fa-print me-1"></i> Cetak
                        </a>
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
                <?= $this->include("rm/partials/formRm9aTransferPasien.php") ?>

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
                <?= $this->include("rm/partials/formRm9aTransferPasien.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm9aTransferPasien['id'] ?? '' ?>)">
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
    <?php if (!$data->pjPasien): ?>
        $('#samaDgPj').prop('disabled', true);
    <?php endif; ?>

    function setSamadgPasien(asal) {
        if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
            <?php endif; ?>
            $("#sebagai").val("Suami")

            $("#nama").prop('disabled', true);
            $("#sebagai").prop('disabled', false);

        }
        if (!$('#samaDgPj').is(':checked')) {
            $("#nama").val(<?= json_encode($data->rm9aTransferPasien['nama'] ?? '') ?>);
            $("#sebagai").val(<?= json_encode($data->rm9aTransferPasien['sebagai'] ?? 'Suami') ?>);

            $("#nama").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // Data Penanggung Jawab & Transfer
            nama: $('#nama').val(),
            sebagai: $('#sebagai').val(),
            dariUnit: $('#dariUnit').val(),
            keUnit: $('#keUnit').val(),
            dokter: $('#dokter').val(),
            waktu: $('#waktu').val(),
            metodePindah: $('input[name="metodePindah"]:checked').val() || '',

            // Indikasi Pindah & Diagnosa
            indikasiPindah: $('input[name="indikasiPindah[]"]:checked').map(function() {
                return $(this).val();
            }).get(),
            isiIndikasiLainnya: $('#isiIndikasiLainnya').val(),
            diagnosa: $('#diagnosa').val(),
            tindakan: $('#tindakan').val(),
            obat: $('#obat').val(),
            pemeriksaan: $('#pemeriksaan').val(),

            // Alat Medis & Persetujuan
            alatMedis: $('input[name="alatMedis[]"]:checked').map(function() {
                return $(this).val();
            }).get(),
            setuju: $('input[name="setuju"]:checked').val() || '',

            // Keadaan Pasien Sebelum Transfer
            keadaanKU: $('#keadaanKU').val(),
            keadaanTD: $('#keadaanTD').val(),
            keadaanN: $('#keadaanN').val(),
            keadaanS: $('#keadaanS').val(),
            keadaanCRT: $('#keadaanCRT').val(),
            keadaanRR: $('#keadaanRR').val(),
            keadaanLainLain: $('#keadaanLainLain').val(),
            keluhanUtama: $('#keluhanUtama').val(),

            // Keadaan Pasien Setelah Transfer
            keadaanKU2: $('#keadaanKU2').val(),
            keadaanTD2: $('#keadaanTD2').val(),
            keadaanN2: $('#keadaanN2').val(),
            keadaanS2: $('#keadaanS2').val(),
            keadaanCRT2: $('#keadaanCRT2').val(),
            keadaanRR2: $('#keadaanRR2').val(),
            keadaanLainLain2: $('#keadaanLainLain2').val(),
            keluhanUtama2: $('#keluhanUtama2').val(),

            // Petugas
            petugasMenyerahkan: $('#petugasMenyerahkan').val(),
            petugasMenerima: $('#petugasMenerima').val(),
            petugas: $('#petugas').val()
        };


        $.ajax({
            url: '<?= base_url("rm/rm9aTransferPasien/simpan") ?>',
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



    <?php if ($data->rm9aTransferPasien) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm9aTransferPasien['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm9aTransferPasien/hapus',
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