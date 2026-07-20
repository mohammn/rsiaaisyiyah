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
                <h5 class="text-uppercase">FORMULIR SKRINING TBC UNTUK USIA &lt; 15 TAHUN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->tbAnak) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pasien :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Tanggal SKrining</td>
                                    <td>: <?= $data->tbAnak["tglSkrining"] ?? '-'  ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat Skringin</td>
                                    <td>: <?= $data->tbAnak["tempatSkrining"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Berat Badan :</td>
                                    <td>: <?= $data->tbAnak["beratBadan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tinggi Badan :</td>
                                    <td>: <?= $data->tbAnak["tinggiBadan"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pemeriksaan :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Kontak TBC :</td>
                                    <td>: <?= $data->tbAnak["kontakTbc"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Terduga TBC</td>
                                    <td>: <?= $data->tbAnak["terduga"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kesimpulan Radiografi Toraks</td>
                                    <td>: <?= $data->tbAnak["kesimpulan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Petugas</td>
                                    <td>: <?= $data->tbAnak["petugas"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->tbAnak['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/tbAnak/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->tbAnak['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/tbAnak/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->tbAnak['id']) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                            <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fa fa-edit me-1"></i> Edit
                            </button>
                        <?php endif ?>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formTbAnak.php") ?>

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
                <?= $this->include("rm/partials/formTbAnak.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->tbAnak['id'] ?? '' ?>)">
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
        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?? '' ?>",

            // --- PEMERIKSAAN BERAT BADAN & TINGGI BADAN ---
            beratBadan: $('#beratBadan').val(),
            tinggiBadan: $('#tinggiBadan').val(),
            statusGizi: $('input[name="statusGizi"]:checked').val() || '',

            // --- PEMERIKSAAN RIWAYAT KONTAK TBC ---
            kontakTbc: $('input[name="kontakTbc"]:checked').val() || '',
            jenisKontak: $('input[name="jenisKontak"]:checked').val() || '',
            indeksTbc: $('#indeksTbc').val(),
            jenisTbc: $('input[name="jenisTbc"]:checked').val() || '',

            // --- FAKTOR RISIKO ---
            berobatTbc: $('input[name="berobatTbc"]:checked').val() || '',
            tglBerobatTbc: $('#tglBerobatTbc').val(),
            berobatTbcTakTuntas: $('input[name="berobatTbcTakTuntas"]:checked').val() || '',
            kurangGizi: $('input[name="kurangGizi"]:checked').val() || '',
            merokok: $('input[name="merokok"]:checked').val() || '',
            perokokPasif: $('input[name="perokokPasif"]:checked').val() || '',
            kencingManis: $('input[name="kencingManis"]:checked').val() || '',
            odhiv: $('input[name="odhiv"]:checked').val() || '',
            lansia: $('input[name="lansia"]:checked').val() || '',
            ibuhamil: $('input[name="ibuhamil"]:checked').val() || '',
            wbp: $('input[name="wbp"]:checked').val() || '',
            tglWbp: $('#tglWbp').val(),
            statusWbp: $('input[name="statusWbp"]:checked').val() || '',
            kumuh: $('input[name="kumuh"]:checked').val() || '',

            // --- DATA TES & SKRINING GEJALA ---
            tglSkrining: $('#tglSkrining').val(),
            tempatSkrining: $('#tempatSkrining').val(),
            batuk: $('input[name="batuk"]:checked').val() || '',
            durasiBatuk: $('#durasiBatuk').val(),
            demam: $('input[name="demam"]:checked').val() || '',
            bb: $('input[name="bb"]:checked').val() || '',
            lesu: $('input[name="lesu"]:checked').val() || '',
            getahBening: $('input[name="getahBening"]:checked').val() || '',
            positif: $('input[name="positif"]:checked').val() || '',

            // --- PEMERIKSAAN RADIOGRAFI TORAKS ---
            radiografi: $('input[name="radiografi"]:checked').val() || '',
            skorRadiologi: $('#skorRadiologi').val(),
            kesanRadiologi: $('#kesanRadiologi').val(),
            kesimpulan: $('input[name="kesimpulan"]:checked').val() || '',

            // --- HASIL TES TBC & PETUGAS ---
            terduga: $('input[name="terduga"]:checked').val() || '',
            laten: $('input[name="laten"]:checked').val() || '',
            fasyankes: $('#fasyankes').val(),
            petugas: $('#petugas').val()
        };

        $("#pesanError").html("");

        if (data.tglSkrining.replace(/\s+/g, "-") == "") {
            $("#tglSkrining").focus();
            $("#pesanError").html("Tanggal Skrining wajib diisi");
        } else if (data.tempatSkrining.replace(/\s+/g, "-") == "") {
            $("#tempatSkrining").focus();
            $("#pesanError").html("Tempat wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/tbAnak/simpan") ?>',
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


    <?php if ($data->tbAnak) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->tbAnak['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/tbAnak/hapus',
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
            noRawat = "<?= $data->tbAnak['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/tbAnak/ubahWaktu',
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