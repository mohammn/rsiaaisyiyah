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
                <h5 class="text-uppercase">FORMULIR <br>
                    TES DAN KONSELING HIV</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->hiv) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pra tes :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Tanggal Konseling pra tes</td>
                                    <td>: <?= $data->hiv["tglKonselingPra"] ?? '-'  ?></td>
                                </tr>
                                <tr>
                                    <td>Mengetahi tes dari</td>
                                    <td>: <?= $data->hiv["infoTes"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Pemberian Info</td>
                                    <td>: <?= $data->hiv["tglPemberianInfo"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Kesediaan Tes</td>
                                    <td>: <?= $data->hiv["kesediaanTes2"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Hasil tes :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless mb-3">
                                <tr>
                                    <td>Tanggal Tes HIV</td>
                                    <td>: <?= $data->hiv["tglTesHiv"] ?? '-'  ?></td>
                                </tr>
                                <tr>
                                    <td>Kesimpulan Hasil tes</td>
                                    <td>: <?= $data->hiv["kesimpulanTes"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal konseling pasca</td>
                                    <td>: <?= $data->hiv["tglKonselingPasca"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Petugas Konselor</td>
                                    <td>: <?= $data->hiv["petugas"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/hiv/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->hiv['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formHiv.php") ?>

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
                <?= $this->include("rm/partials/formHiv.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->hiv['id'] ?? '' ?>)">
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
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // ==========================================
            // KOLOM KIRI (DATA KLIEN & KONSELING)
            // ==========================================
            statusHamil: $('input[name="statusHamil"]:checked').val() || '',
            umurAnakTerakhir: $('#umurAnakTerakhir').val(),
            jumlahAnak: $('#jumlahAnak').val(),
            kelompokRisiko: $('input[name="kelompokRisiko"]:checked').val() || '',
            jenisPs: $('#jenisPs').val(),
            lamanya: $('#lamanya').val(),
            statusKunjungan: $('input[name="statusKunjungan"]:checked').val() || '',
            statusRujuk: $('input[name="statusRujuk"]:checked').val() || '',

            // Dikirim sebagai Array Murni ke PHP
            alasanTes: $('input[name="alasanTes[]"]:checked').map(function() {
                return this.value;
            }).get(),
            isiAlasanTesLainnya: $('#isiAlasanTesLainnya').val(),

            tglKonselingPra: $('#tglKonselingPra').val(),
            statusKlien: $('input[name="statusKlien"]:checked').val() || '',
            infoTes: $('input[name="infoTes"]:checked').val() || '',
            tglPemberianInfo: $('#tglPemberianInfo').val(),
            pernahTes2: $('input[name="pernahTes2"]:checked').val() || '',
            pernahTesDmn2: $('#pernahTesDmn2').val(),
            pernahTesTgl2: $('#pernahTesTgl2').val(),
            hasilTesSebelumnya2: $('#hasilTesSebelumnya2').val(),

            // Dikirim sebagai Array Murni ke PHP
            penyakit: $('input[name="penyakit[]"]:checked').map(function() {
                return this.value;
            }).get(),
            isiImsLainnya: $('#isiImsLainnya').val(),
            isiPenyakitLainnya: $('#isiPenyakitLainnya').val(),

            kesediaanTes2: $('input[name="kesediaanTes2"]:checked').val() || '',
            tglKonselingPasca: $('#tglKonselingPasca').val(),
            jmlKondom: $('#jmlKondom').val(),
            terimaHasil: $('input[name="terimaHasil"]:checked').val() || '',
            gejalaTb: $('input[name="gejalaTb"]:checked').val() || '',

            // Dikirim sebagai Array Murni ke PHP
            tindakLanjutKts: $('input[name="tindakLanjutKts[]"]:checked').map(function() {
                return this.value;
            }).get(),
            jenisKonselingKts: $('#jenisKonselingKts').val(),
            jenisPetugasPendukung: $('#jenisPetugasPendukung').val(),
            isiLsm: $('#isiLsm').val(),

            statusLayanan: $('input[name="statusLayanan"]:checked').val() || '',
            jenisLayanan: $('input[name="jenisLayanan"]:checked').val() || '',
            petugas: "<?= $data->icDarah['petugas'] ?? session()->get('nama') ?>",

            // ==========================================
            // KOLOM KANAN (PASANGAN & RISIKO)
            // ==========================================
            pasanganTetap: $('input[name="pasanganTetap"]:checked').val() || '',
            pasanganPerempuan: $('input[name="pasanganPerempuan"]:checked').val() || '',
            pasanganHamil: $('input[name="pasanganHamil"]:checked').val() || '',
            tglLahirPasangan: $('#tglLahirPasangan').val(),
            tglTesPasangan: $('#tglTesPasangan').val(),
            hasilTesPasangan: $('#hasilTesPasangan').val(),
            wbp: $('input[name="wbp"]:checked').val() || '',

            hubVag: $('input[name="hubVag"]:checked').val() || '',
            hubVagTgl: $('#hubVagTgl').val(),
            hubAnal: $('input[name="hubAnal"]:checked').val() || '',
            hubAnalTgl: $('#hubAnalTgl').val(),
            gantianSuntik: $('input[name="gantianSuntik"]:checked').val() || '',
            gantianSuntikTgl: $('#gantianSuntikTgl').val(),
            transfusiDarah: $('input[name="transfusiDarah"]:checked').val() || '',
            transfusiDarahTgl: $('#transfusiDarahTgl').val(),
            transmisiIbu: $('input[name="transmisiIbu"]:checked').val() || '',
            transmisiIbuTgl: $('#transmisiIbuTgl').val(),
            isiLainnya: $('#isiLainnya').val(),
            isiLainnyaTgl: $('#isiLainnyaTgl').val(),
            periodeJendela: $('input[name="periodeJendela"]:checked').val() || '',
            periodeJendelaTgl: $('#periodeJendelaTgl').val(),
            kesediaanTes: $('input[name="kesediaanTes"]:checked').val() || '',
            pernahTes: $('input[name="pernahTes"]:checked').val() || '',
            pernahTesDmn: $('#pernahTesDmn').val(),
            pernahTesTgl: $('#pernahTesTgl').val(),
            hasilTesSebelumnya: $('#hasilTesSebelumnya').val(),

            tglTesHiv: $('#tglTesHiv').val(),
            jenisTes: $('input[name="jenisTes"]:checked').val() || '',
            hasilTesR1: $('input[name="hasilTesR1"]:checked').val() || '',
            reagenR1: $('#reagenR1').val(),
            hasilTesR2: $('input[name="hasilTesR2"]:checked').val() || '',
            reagenR2: $('#reagenR2').val(),
            hasilTesR3: $('input[name="hasilTesR3"]:checked').val() || '',
            reagenR3: $('#reagenR3').val(),
            kesimpulanTes: $('input[name="kesimpulanTes"]:checked').val() || '',
            noPdp: $('#noPdp').val(),
            tglPdp: $('#tglPdp').val(),

            // Dikirim sebagai Array Murni ke PHP
            tindakLanjut: $('input[name="tindakLanjut[]"]:checked').map(function() {
                return this.value;
            }).get(),
            isiRujukKonseling: $('#isiRujukKonseling').val(),
            isiRujukKe: $('#isiRujukKe').val(),
            hivPasangan: $('input[name="hivPasangan"]:checked').val() || ''
        };

        $("#pesanError").html("");

        $.ajax({
            url: '<?= base_url("rm/hiv/simpan") ?>',
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


    <?php if ($data->hiv) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->hiv['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/hiv/hapus',
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
            noRawat = "<?= $data->hiv['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/hiv/ubahWaktu',
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