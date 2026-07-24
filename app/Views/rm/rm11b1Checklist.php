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
                    CHECKLIST KESELAMATAN DI KAMAR BEDAH <br>
                    <i>(SURGICAL SAFETY CHECKLIST)</i>
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm11b1Checklist) : ?>
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
                                    <td>: <?= $data->rm11b1Checklist["ruang"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal</td>
                                    <td>: <?= !empty($data->rm11b1Checklist["tgl"]) ? date('d-m-Y', strtotime($data->rm11b1Checklist["tgl"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Instruksi Khusus</td>
                                    <td>: <?= $data->rm11b1Checklist["instruksiKhusus"] ?? '-' ?></td>
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
                                    <td>Jam <i>Sign In</i></td>
                                    <td>: <?= !empty($data->rm11b1Checklist["jamSignIn"]) ? substr($data->rm11b1Checklist["jamSignIn"], 0, 5) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Jam <i>Time Out</i></td>
                                    <td>: <?= !empty($data->rm11b1Checklist["jamTimeOut"]) ? substr($data->rm11b1Checklist["jamTimeOut"], 0, 5) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Jam <i>Sign Out</i></td>
                                    <td>: <?= !empty($data->rm11b1Checklist["jamSignOut"]) ? substr($data->rm11b1Checklist["jamSignOut"], 0, 5) : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php
                        $ttd = $data->rm11b1Checklist;
                        if ((
                            $ttd["ttdPerawatAnestesi"] &&
                            $ttd["ttdDokterAnestesi1"] &&
                            $ttd["ttdSirkuler"] &&
                            $ttd["ttdInstrumen"] &&
                            $ttd["ttdAsisten"] &&
                            $ttd["ttdOperator"] &&
                            $ttd["ttdDokterAnestesi2"]
                        )): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm11b1Checklist/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b1Checklist['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm11b1Checklist/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b1Checklist['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formRm11b1Checklist.php") ?>

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
                <?= $this->include("rm/partials/formRm11b1Checklist.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm11b1Checklist['id'] ?? '' ?>)">
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
        // Fungsi Helper untuk mengambil nilai checkbox array sebagai Array JS
        function getCheckedValues(name) {
            return $('input[name="' + name + '"]:checked').map(function() {
                return $(this).val();
            }).get();
        }

        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // --- HEADER / GENERAL ---
            ruang: $('#ruang').val(),
            tgl: $('#tgl').val(),
            jamSignIn: $('#jamSignIn').val(),
            jamTimeOut: $('#jamTimeOut').val(),
            jamSignOut: $('#jamSignOut').val(),

            // --- TAB 1: SIGN IN ---
            verifikasi: getCheckedValues('verifikasi[]'),
            dokterBedah: $('#dokterBedah').val(),
            dokterAnestesi: $('#dokterAnestesi').val(),
            namaTindakan: $('input[name="namaTindakan"]').val(),
            pemberian_tanda_pilihan: $('input[name="pemberian_tanda_pilihan"]:checked').val() || '',
            diagnosa: $('#diagnosa').val(),
            kelengkapan: getCheckedValues('kelengkapan[]'),
            perawatAnestesi: $('#perawatAnestesi').val(),

            // Tanda Vital & Risiko
            kesadaran: $('#kesadaran').val(),
            tekananDarah: $('#tekananDarah').val(),
            nadi: $('#nadi').val(),
            saturasiOksigen: $('#saturasiOksigen').val(),
            suhu: $('#suhu').val(),
            skalaNyeri: $('#skalaNyeri').val(),
            alergi: $('input[name="alergi"]:checked').val() || '',
            isiAlergi: $('#isiAlergi').val(),
            aspirasi: $('input[name="aspirasi"]:checked').val() || '',
            pendrahan: $('input[name="pendrahan"]:checked').val() || '',
            rencanaAnestesi: getCheckedValues('rencanaAnestesi[]'),

            // --- TAB 2: TIME OUT ---
            verbal1: getCheckedValues('verbal1[]'),
            fasilitasOperasi: $('input[name="fasilitasOperasi"]:checked').val() || '',
            profilaksis: $('input[name="profilaksis"]:checked').val() || '',
            profilaksisObat: $('#profilaksisObat').val(),
            profilaksisJam: $('#profilaksisJam').val(),
            profilaksisDosis: $('#profilaksisDosis').val(),
            sirkuler: $('#sirkuler').val(),
            instrumen: $('#instrumen').val(),
            antisipasi1: $('#antisipasi1').val(),
            antisipasi2: $('#antisipasi2').val(),
            antisipasi31: $('input[name="antisipasi31"]:checked').val() || '',
            antisipasi32: $('input[name="antisipasi32"]:checked').val() || '',
            antisipasi33: $('input[name="antisipasi33"]:checked').val() || '',

            // --- TAB 3: SIGN OUT ---
            verbal2: $('#verbal2').val(),
            kelengkapanOperasi: getCheckedValues('kelengkapanOperasi[]'),
            isiKelengkapanLainnya: $('#isiKelengkapanLainnya').val(),
            preparat: $('input[name="preparat"]:checked').val() || '',
            jenis: getCheckedValues('jenis[]'),
            isijenisLainnya: $('#isijenisLainnya').val(),
            formulir: $('input[name="formulir"]:checked').val() || '',
            lengkapiIdentitas: $('input[name="lengkapiIdentitas"]:checked').val() || '',
            asisten: $('#asisten').val(),
            perhatianOperator: $('#perhatianOperator').val(),
            perhatianDokter: $('#perhatianDokter').val(),
            perhatianPerawat: $('#perhatianPerawat').val(),
            ruangPemulihan: $('input[name="ruangPemulihan"]:checked').val() || '',
            periksaKembali: $('input[name="periksaKembali"]:checked').val() || '',
            instruksiKhusus: $('#instruksiKhusus').val(),
            operator: $('#operator').val(),
            drAnestesi: $('#drAnestesi').val()
        };

        $("#pesanError").html("");

        if (data.tgl.replace(/\s+/g, "-") == "") {
            $("#tgl").focus();
            $("#pesanError").html("Tanggal Masuk wajib diisi");
        } else if (data.ruang.replace(/\s+/g, "-") == "") {
            $("#ruang").focus();
            $("#pesanError").html("No. Kartu wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm11b1Checklist/simpan") ?>',
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


    <?php if ($data->rm11b1Checklist) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm11b1Checklist['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11b1Checklist/hapus',
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