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
            <a class="btn btn-estetik btn-cetak" href="<?= base_url(" rm/operasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">RM Operasi</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">
                    TIMBANG TERIMA UNTUK KESELAMATAN PEMBEDAHAN
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm11a2Timbang) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>DPJP</td>
                                    <td>: <?= $data->rm11a2Timbang["dpjp"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa Medis</td>
                                    <td>: <?= $data->rm11a2Timbang["diagnosaMedis"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Situation</td>
                                    <td>: <?= !empty($data->rm11a2Timbang["situasi"]) && is_array(json_decode($data->rm11a2Timbang["situasi"], true)) ? implode(', ', json_decode($data->rm11a2Timbang["situasi"], true)) : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Diagnosa Pra Operasi</td>
                                    <td>: <?= $data->rm11a2Timbang["diagnosaPra"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Rencana Operasi</td>
                                    <td>: <?= $data->rm11a2Timbang["rencanaOperasi"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Medikasi Khusus</td>
                                    <td>: <?= $data->rm11a2Timbang["medikasi"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm11a2Timbang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11a2Timbang['id']) ?>" target="_blank">
                            <i class="fas fa-pen-nib me-1"></i> TTD
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
                <?= $this->include("rm/partials/formRm11a2Timbang.php") ?>

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
                <?= $this->include("rm/partials/formRm11a2Timbang.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm11a2Timbang['id'] ?? '' ?>)">
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
        // Helper function untuk mengambil nilai checkbox array (pilihan berganda)
        function getCheckedValues(name) {
            return $('input[name="' + name + '"]:checked').map(function() {
                return $(this).val();
            }).get();
        }

        var data = {
            // --- HEADER / SBAR & SITUASI ---
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            dpjp: $('#dpjp').val(),
            unitLain: $('#unitLain').val(),
            diagnosaMedis: $('#diagnosaMedis').val(),
            situasi: getCheckedValues('situasi[]'),
            isiKelas: $('#isiKelas').val(),

            // --- KOLOM KIRI (PENYERAHAN DARI RUANGAN) ---
            diagnosaPra: $('#diagnosaPra').val(),
            rencanaOperasi: $('#rencanaOperasi').val(),
            rpd: getCheckedValues('rpd[]'),
            isiRpdLainnya: $('#isiRpdLainnya').val(),
            isolasi: getCheckedValues('isolasi[]'),
            isiIsolasiLainnya: $('#isiIsolasiLainnya').val(),
            alergi: $('input[name="alergi"]:checked').val() || '',
            isiAlergi: $('#isiAlergi').val(),
            darahStatus: $('input[name="darahStatus"]:checked').val() || '',
            jumlahDarah: $('#jumlahDarah').val(),
            darahDetail: getCheckedValues('darahDetail[]'),
            isiPackJenis: $('#isiPackJenis').val(),
            isiGolonganDarah: $('#isiGolonganDarah').val(),
            markingStatus: $('input[name="markingStatus"]:checked').val() || '',
            markingKondisi: $('input[name="markingKondisi"]:checked').val() || '',
            informedConsent: $('input[name="informedConsent"]:checked').val() || '',
            labStatus: $('input[name="labStatus"]:checked').val() || '',
            isiLabJml: $('#isiLabJml').val(),
            perhatianKhusus: getCheckedValues('perhatianKhusus[]'),
            isiHb: $('#isiHb').val(),
            isiBun: $('#isiBun').val(),
            isiPkLainLain: $('#isiPkLainLain').val(),
            isiAlbumin: $('#isiAlbumin').val(),
            isiKreatinin: $('#isiKreatinin').val(),
            fotoStatus: $('input[name="fotoStatus"]:checked').val() || '',
            isiFotoJml: $('#isiFotoJml').val(),
            fotoDetail: getCheckedValues('fotoDetail[]'),
            isiRontgenKet: $('#isiRontgenKet').val(),
            isiRontgenJml: $('#isiRontgenJml').val(),
            isiUsgKet: $('#isiUsgKet').val(),
            isiUsgJml: $('#isiUsgJml').val(),
            isiBofJml: $('#isiBofJml').val(),
            isiNst: $('#isiNst').val(),
            isiEchoJml: $('#isiEchoJml').val(),
            isiIvpJml: $('#isiIvpJml').val(),
            isiEkgJml: $('#isiEkgJml').val(),
            isiFotoLainnya: $('#isiFotoLainnya').val(),
            isiTdSistole: $('#isiTdSistole').val(),
            isiTdDiastole: $('#isiTdDiastole').val(),
            isiSuhu: $('#isiSuhu').val(),
            isiRr: $('#isiRr').val(),
            isiNadi: $('#isiNadi').val(),
            puasaStatus: $('input[name="puasaStatus"]:checked').val() || '',
            isiPuasaJam: $('#isiPuasaJam').val(),
            lavementStatus: $('input[name="lavementStatus"]:checked').val() || '',
            isiLavementKet: $('#isiLavementKet').val(),
            tamponAnus: $('input[name="tamponAnus"]:checked').val() || '',
            scerenStatus: $('input[name="scerenStatus"]:checked').val() || '',
            gigiPalsu: $('input[name="gigiPalsu"]:checked').val() || '',
            isiGigiDibawaOleh: $('#isiGigiDibawaOleh').val(),
            kesadaran: $('input[name="kesadaran"]:checked').val() || '',
            isiKesadaranLain: $('#isiKesadaranLain').val(),
            keluargaTunggu: $('input[name="keluargaTunggu"]:checked').val() || '',
            isiKontakPerson: $('#isiKontakPerson').val(),
            isiTelpHubungi: $('#isiTelpHubungi').val(),

            // --- ASSESSMENT, RECOMMENDATION & PETUGAS (SISI KIRI) ---
            assesment: $('input[name="assesment"]:checked').val() || '',
            didampingi: getCheckedValues('didampingi[]'),
            alatTransport: $('input[name="alatTransport"]:checked').val() || '',
            medikasi: $('#medikasi').val(),
            waktu: $('#waktu').val(),
            pengantar: $('#pengantar').val(),
            penerima: $('#penerima').val(),

            // --- KOLOM KANAN (PENERIMAAN DI OK) ---
            diagnosaPra2: $('#diagnosaPra2').val(),
            rencanaOperasi2: $('#rencanaOperasi2').val(),
            rpd2: getCheckedValues('rpd2[]'),
            isiRpdLainnya2: $('#isiRpdLainnya2').val(),
            isolasi2: getCheckedValues('isolasi2[]'),
            isiIsolasiLainnya2: $('#isiIsolasiLainnya2').val(),
            alergi2: $('input[name="alergi2"]:checked').val() || '',
            isiAlergi2: $('#isiAlergi2').val(),
            darahStatus2: $('input[name="darahStatus2"]:checked').val() || '',
            jumlahDarah2: $('#jumlahDarah2').val(),
            darahDetail2: getCheckedValues('darahDetail2[]'),
            isiPackJenis2: $('#isiPackJenis2').val(),
            isiGolonganDarah2: $('#isiGolonganDarah2').val(),
            markingStatus2: $('input[name="markingStatus2"]:checked').val() || '',
            markingKondisi2: $('input[name="markingKondisi2"]:checked').val() || '',
            informedConsent2: $('input[name="informedConsent2"]:checked').val() || '',
            labStatus2: $('input[name="labStatus2"]:checked').val() || '',
            isiLabJml2: $('#isiLabJml2').val(),
            perhatianKhusus2: getCheckedValues('perhatianKhusus2[]'),
            isiHb2: $('#isiHb2').val(),
            isiBun2: $('#isiBun2').val(),
            isiPkLainLain2: $('#isiPkLainLain2').val(),
            isiAlbumin2: $('#isiAlbumin2').val(),
            isiKreatinin2: $('#isiKreatinin2').val(),
            fotoStatus2: $('input[name="fotoStatus2"]:checked').val() || '',
            isiFotoJml2: $('#isiFotoJml2').val(),
            fotoDetail2: getCheckedValues('fotoDetail2[]'),
            isiRontgenKet2: $('#isiRontgenKet2').val(),
            isiRontgenJml2: $('#isiRontgenJml2').val(),
            isiUsgKet2: $('#isiUsgKet2').val(),
            isiUsgJml2: $('#isiUsgJml2').val(),
            isiBofJml2: $('#isiBofJml2').val(),
            isiNst2: $('#isiNst2').val(),
            isiEchoJml2: $('#isiEchoJml2').val(),
            isiIvpJml2: $('#isiIvpJml2').val(),
            isiEkgJml2: $('#isiEkgJml2').val(),
            isiFotoLainnya2: $('#isiFotoLainnya2').val(),
            isiTdSistole2: $('#isiTdSistole2').val(),
            isiTdDiastole2: $('#isiTdDiastole2').val(),
            isiSuhu2: $('#isiSuhu2').val(),
            isiRr2: $('#isiRr2').val(),
            isiNadi2: $('#isiNadi2').val(),
            puasaStatus2: $('input[name="puasaStatus2"]:checked').val() || '',
            isiPuasaJam2: $('#isiPuasaJam2').val(),
            lavementStatus2: $('input[name="lavementStatus2"]:checked').val() || '',
            isiLavementKet2: $('#isiLavementKet2').val(),
            tamponAnus2: $('input[name="tamponAnus2"]:checked').val() || '',
            scerenStatus2: $('input[name="scerenStatus2"]:checked').val() || '',
            gigiPalsu2: $('input[name="gigiPalsu2"]:checked').val() || '',
            isiGigiDibawaOleh2: $('#isiGigiDibawaOleh2').val(),
            kesadaran2: $('input[name="kesadaran2"]:checked').val() || '',
            isiKesadaranLain2: $('#isiKesadaranLain2').val(),
            keluargaTunggu2: $('input[name="keluargaTunggu2"]:checked').val() || '',
            isiKontakPerson2: $('#isiKontakPerson2').val(),
            isiTelpHubungi2: $('#isiTelpHubungi2').val(),

            // --- ASSESSMENT, RECOMMENDATION & PETUGAS (SISI KANAN / SUFFIX 2) ---
            assesment2: $('input[name="assesment2"]:checked').val() || '',
            didampingi2: getCheckedValues('didampingi2[]'),
            alatTransport2: $('input[name="alatTransport2"]:checked').val() || '',
            medikasi2: $('#medikasi2').val(),
            waktu2: $('#waktu2').val(),
            pengantar2: $('#pengantar2').val(),
            penerima2: $('#penerima2').val(),

            // --- Riwayat Transfusi 1 ---
            riwayatTranfusi: $('input[name="riwayatTranfusi"]:checked').val() || '',
            tglTranfusi: $('#tglTranfusi').val(),
            jenisTranfusi: $('#jenisTranfusi').val(),
            golTranfusi: $('#golTranfusi').val(),
            jumlahTranfusi: $('#jumlahTranfusi').val(),

            // --- Riwayat Transfusi 2 ---
            riwayatTranfusi2: $('input[name="riwayatTranfusi2"]:checked').val() || '',
            tglTranfusi2: $('#tglTranfusi2').val(),
            jenisTranfusi2: $('#jenisTranfusi2').val(),
            golTranfusi2: $('#golTranfusi2').val(),
            jumlahTranfusi2: $('#jumlahTranfusi2').val()
        };

        $("#pesanError").html("");

        if (data.diagnosaMedis.replace(/\s+/g, "-") == "") {
            $("#diagnosaMedis").focus();
            $("#pesanError").html("Diagnosa Medis wajib diisi");
        } else if (data.unitLain.replace(/\s+/g, "-") == "") {
            $("#unitLain").focus();
            $("#pesanError").html("Unit Lain wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm11a2Timbang/simpan") ?>',
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


    <?php if ($data->rm11a2Timbang) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm11a2Timbang['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11a2Timbang/hapus',
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