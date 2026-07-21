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
                <h5 class="text-uppercase">Surat Permintaan Masuk Rumah Sakit</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm4PermintaanMasuk) : ?>
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
                                    <td>: <?= empty($data->rm4PermintaanMasuk["nama"]) ? $data->pasien["nm_pasien"] : $data->rm4PermintaanMasuk["nama"] ?></td>
                                </tr>
                                <tr>
                                    <td>No. Kartu</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["noKartu"] ?? '-'  ?></td>
                                </tr>
                                <tr>
                                    <td>No. SEP</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["noSep"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Pembiayaan</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["biaya"] == 'Lainnya' ? 'Lainnya : ' . ($data->rm4PermintaanMasuk["isiBiayaLain"] ?? '-')  : ($data->rm4PermintaanMasuk["biaya"] ?? '-') ?></td>
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
                            <table class="table table-info table-borderless mb-4">
                                <tr>
                                    <td>Hari dan Tanggal :</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["tglMasuk"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Ruangan di Tuju</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["ruang"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>DPJP</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["dokter"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa</td>
                                    <td>: <?= $data->rm4PermintaanMasuk["diagnosa"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm4PermintaanMasuk['ttdWali'] and $data->rm4PermintaanMasuk['ttdDokter'] and $data->rm4PermintaanMasuk['ttdPetugas']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm4PermintaanMasuk/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm4PermintaanMasuk['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm4PermintaanMasuk/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm4PermintaanMasuk['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formRm4PermintaanMasuk.php") ?>

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
                <?= $this->include("rm/partials/formRm4PermintaanMasuk.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm4PermintaanMasuk['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm4PermintaanMasuk) ? date('Y-m-d\TH:i', strtotime($data->rm4PermintaanMasuk["tglinput"])) : '' ?>">
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
        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // --- DATA PENANGGUNG JAWAB (Form Kiri) ---
            nama: $('#nama').val(),
            noKartu: $('#noKartu').val(),
            noSep: $('#noSep').val(),
            biaya: $('input[name="biaya"]:checked').val() || '', // Mengambil radio button yang dipilih
            isiBiayaLain: $('#isiBiayaLain').val(),

            // --- PEMBERIAN INFORMASI (Form Kanan) ---
            tglMasuk: $('#tglMasuk').val(),
            ruang: $('#ruang').val(),
            petugas: $('#petugas').val(), // Tetap bisa terbaca meskipun input 'disabled'
            dokter: $('#dokter').val(),
            diagnosa: $('#diagnosa').val()
        };

        $("#pesanError").html("");

        if (data.tglMasuk.replace(/\s+/g, "-") == "") {
            $("#tglMasuk").focus();
            $("#pesanError").html("Tanggal Masuk wajib diisi");
        } else if (data.noKartu.replace(/\s+/g, "-") == "") {
            $("#noKartu").focus();
            $("#pesanError").html("No. Kartu wajib diisi");
        } else if (data.diagnosa.replace(/\s+/g, "-") == "") {
            $("#diagnosa").focus();
            $("#pesanError").html("Diagnosa wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm4PermintaanMasuk/simpan") ?>',
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


    <?php if ($data->rm4PermintaanMasuk) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm4PermintaanMasuk['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm4PermintaanMasuk/hapus',
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
            noRawat = "<?= $data->rm4PermintaanMasuk['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm4PermintaanMasuk/ubahWaktu',
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