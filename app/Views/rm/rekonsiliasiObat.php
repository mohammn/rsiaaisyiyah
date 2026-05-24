<?php

/** @var object $data */ ?>

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
                <h5>REKONSILIASI DAN RIWAYAT PENGOBATAN PASIEN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rekonsiliasiObat) : ?>
                <div class="row">
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="p-3 bg-info-subtle border border-info text-info-emphasis rounded">
                                <strong>Riwayat Alergi:</strong> <br>
                                <?= esc($data->rekonsiliasiObat["alergi"] ?? '-'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-info-subtle border border-info text-info-emphasis rounded">
                                <strong>Manifestasi:</strong> <br>
                                <?= esc($data->rekonsiliasiObat["manifestasi"] ?? '-'); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 bg-info-subtle border border-info text-info-emphasis rounded">
                                <strong>Dampak:</strong> <br>
                                <?= esc($data->rekonsiliasiObat["dampak"] ?? '-'); ?>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr class="table-info text-center">
                                    <th width="25%">Ruangan</th>
                                    <th width="25%">Perawat</th>
                                    <th width="25%">Dokter</th>
                                    <th width="25%">Farmasi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="table-section text-center">
                                        <strong>IGD</strong> <br>
                                        <small class="text-muted">Instalasi Gawat Darurat</small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['perawatIgd'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuPerawatIgd'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuPerawatIgd'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['dokterIgd'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuDokterIgd'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuDokterIgd'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['farmasiIgd'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuFarmasiIgd'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuFarmasiIgd'])) : '-'; ?>
                                        </small>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-section text-center">
                                        <strong>KO</strong> <br>
                                        <small class="text-muted">Kamar Operasi</small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['perawatKo'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuPerawatKo'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuPerawatKo'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['dokterKo'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuDokterKo'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuDokterKo'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['farmasiKo'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuFarmasiKo'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuFarmasiKo'])) : '-'; ?>
                                        </small>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-section text-center">
                                        <strong>RR</strong> <br>
                                        <small class="text-muted">Recovery Room</small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['perawatRr'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuPerawatRr'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuPerawatRr'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['dokterRr'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuDokterRr'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuDokterRr'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['farmasiRr'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuFarmasiRr'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuFarmasiRr'])) : '-'; ?>
                                        </small>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="table-section text-center">
                                        <strong>RI</strong> <br>
                                        <small class="text-muted">Rawat Inap</small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['perawatRi'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuPerawatRi'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuPerawatRi'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['dokterRi'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuDokterRi'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuDokterRi'])) : '-'; ?>
                                        </small>
                                    </td>
                                    <td>
                                        <strong><?= esc($data->rekonsiliasiObat['farmasiRi'] ?? '-'); ?></strong><br>
                                        <small class="text-muted">
                                            <?= (!empty($data->rekonsiliasiObat['waktuFarmasiRi'])) ? date('d-m-Y H:i', strtotime($data->rekonsiliasiObat['waktuFarmasiRi'])) : '-'; ?>
                                        </small>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <br><br>
                    <div class="text-center">
                        <button class="btn btn-estetik btn-edit" onclick="tryEdit()">
                            <i class="fas fa-edit me-1"></i> Edit
                        </button>
                        <a class="btn btn-estetik btn-lihat" href="<?= base_url('/rm/rekonsiliasiObat/dataObat/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>">
                            <i class="fa fa-medkit me-1"></i> Obat
                        </a>
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rekonsiliasiObat/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                            <i class="fas fa-print me-1"></i> Cetak
                        </a>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRekonsiliasiObat") ?>

                <div class="text-center">
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
<div class="modal fade  modal-xl modal-dialog-scrollable" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Petugas Rekonsiliasi Obat atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->include("rm/partials/formRekonsiliasiObat") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan('edit')">
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
                Apakah anda yakin ingin menghapus Form Rekonsiliasi Obat pasien atas nama <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
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
    function simpan(tujuan) {
        var noRawat = "<?= $data->pasien["no_rawat"] ?>";

        var alergi = $("#alergi").val();
        var manifestasi = $("#manifestasi").val();
        var dampak = $('input[name="dampak"]:checked').val();

        var perawatIgd = $("#perawatIgd").val();
        var dokterIgd = $("#dokterIgd").val();
        var farmasiIgd = $("#farmasiIgd").val();
        var waktuPerawatIgd = $("#waktuPerawatIgd").val();
        var waktuDokterIgd = $("#waktuDokterIgd").val();
        var waktuFarmasiIgd = $("#waktuFarmasiIgd").val();

        var perawatKo = $("#perawatKo").val();
        var dokterKo = $("#dokterKo").val();
        var farmasiKo = $("#farmasiKo").val();
        var waktuPerawatKo = $("#waktuPerawatKo").val();
        var waktuDokterKo = $("#waktuDokterKo").val();
        var waktuFarmasiKo = $("#waktuFarmasiKo").val();

        var perawatRr = $("#perawatRr").val();
        var dokterRr = $("#dokterRr").val();
        var farmasiRr = $("#farmasiRr").val();
        var waktuPerawatRr = $("#waktuPerawatRr").val();
        var waktuDokterRr = $("#waktuDokterRr").val();
        var waktuFarmasiRr = $("#waktuFarmasiRr").val();

        var perawatRi = $("#perawatRi").val();
        var dokterRi = $("#dokterRi").val();
        var farmasiRi = $("#farmasiRi").val();
        var waktuPerawatRi = $("#waktuPerawatRi").val();
        var waktuDokterRi = $("#waktuDokterRi").val();
        var waktuFarmasiRi = $("#waktuFarmasiRi").val();

        // Validasi input sebelum kirim data
        if (alergi.replace(/\s+/g, "-") == "") {
            $("#alergi").focus();
        } else if (manifestasi.replace(/\s+/g, "-") == "") {
            $("#manifestasi").focus();
        } else if (!dampak) {
            $('input[name="dampak"]:first').focus();
        } else {
            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/simpan',
                method: 'post',
                // Data dikirim dalam bentuk Object sesuai dengan variabel di atas
                data: {
                    tujuan: tujuan,
                    noRawat: noRawat,
                    alergi: alergi,
                    manifestasi: manifestasi,
                    dampak: dampak,

                    perawatIgd: perawatIgd,
                    dokterIgd: dokterIgd,
                    farmasiIgd: farmasiIgd,
                    waktuPerawatIgd: waktuPerawatIgd,
                    waktuDokterIgd: waktuDokterIgd,
                    waktuFarmasiIgd: waktuFarmasiIgd,

                    perawatKo: perawatKo,
                    dokterKo: dokterKo,
                    farmasiKo: farmasiKo,
                    waktuPerawatKo: waktuPerawatKo,
                    waktuDokterKo: waktuDokterKo,
                    waktuFarmasiKo: waktuFarmasiKo,

                    perawatRr: perawatRr,
                    dokterRr: dokterRr,
                    farmasiRr: farmasiRr,
                    waktuPerawatRr: waktuPerawatRr,
                    waktuDokterRr: waktuDokterRr,
                    waktuFarmasiRr: waktuFarmasiRr,

                    perawatRi: perawatRi,
                    dokterRi: dokterRi,
                    farmasiRi: farmasiRi,
                    waktuPerawatRi: waktuPerawatRi,
                    waktuDokterRi: waktuDokterRi,
                    waktuFarmasiRi: waktuFarmasiRi
                },
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        }
    }

    <?php if ($data->rekonsiliasiObat) : ?>

        function tryEdit() {
            $("#namaPasienJudulEdit").html("<?= $data->pasien['nm_pasien'] ?>");
            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/muatData/<?= str_replace('/', '-', $data->pasien['no_rawat']) ?>',
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    // --- DATA UTAMA ALERGI ---
                    $("#alergi").val(data.alergi);
                    $("#manifestasi").val(data.manifestasi);

                    // Khusus Radio Button (Dampak): Pilih radio yang value-nya sesuai dari database
                    if (data.dampak) {
                        $(`input[name="dampak"][value="${data.dampak}"]`).prop('checked', true);
                    }

                    // --- DATA IGD ---
                    $("#perawatIgd").val(data.perawatIgd);
                    $("#dokterIgd").val(data.dokterIgd);
                    $("#farmasiIgd").val(data.farmasiIgd);
                    $("#waktuPerawatIgd").val(data.waktuPerawatIgd);
                    $("#waktuDokterIgd").val(data.waktuDokterIgd);
                    $("#waktuFarmasiIgd").val(data.waktuFarmasiIgd);

                    // --- DATA KAMAR OPERASI (KO) ---
                    $("#perawatKo").val(data.perawatKo);
                    $("#dokterKo").val(data.dokterKo);
                    $("#farmasiKo").val(data.farmasiKo);
                    $("#waktuPerawatKo").val(data.waktuPerawatKo);
                    $("#waktuDokterKo").val(data.waktuDokterKo);
                    $("#waktuFarmasiKo").val(data.waktuFarmasiKo);

                    // --- DATA RECOVERY ROOM (RR) ---
                    $("#perawatRr").val(data.perawatRr);
                    $("#dokterRr").val(data.dokterRr);
                    $("#farmasiRr").val(data.farmasiRr);
                    $("#waktuPerawatRr").val(data.waktuPerawatRr);
                    $("#waktuDokterRr").val(data.waktuDokterRr);
                    $("#waktuFarmasiRr").val(data.waktuFarmasiRr);

                    // --- DATA RAWAT INAP (RI) ---
                    $("#perawatRi").val(data.perawatRi);
                    $("#dokterRi").val(data.dokterRi);
                    $("#farmasiRi").val(data.farmasiRi);
                    $("#waktuPerawatRi").val(data.waktuPerawatRi);
                    $("#waktuDokterRi").val(data.waktuDokterRi);
                    $("#waktuFarmasiRi").val(data.waktuFarmasiRi);

                    $("#modalEdit").modal("show");
                }
            });
        }

        function tryHapus() {
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
            $("#modalHapus").modal("show");
        }

        function hapus() {
            var noRawat = $("#noRawatHapus").html()

            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/hapus',
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