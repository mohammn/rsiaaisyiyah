<?php

/** @var object $data */
if ($data->icSesar) {
    $tglLahir = new \DateTime($data->icSesar["tanggalLahir"]);
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
                <h5 class="text-uppercase"><i>INFORMED CONSENT</i> TINDAKAN <i>SECTIO CAESARIA</i></h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->icSesar) : ?>
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
                                    <td>: <?= $data->icSesar["nama"] . " (" . $data->icSesar["jk"] . ")" ?></td>
                                </tr>
                                <tr>
                                    <td>NIK</td>
                                    <td>: <?= $data->icSesar["nik"]  ?></td>
                                </tr>
                                <tr>
                                    <td>TTL</td>
                                    <td>: <?= $data->icSesar["tempatLahir"] . ", " . $tglLahir->format('d-m-Y') ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->icSesar["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->icSesar["sebagai"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-3">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless mb-4">
                                <tr>
                                    <td>Petugas</td>
                                    <td>: <?= $data->icSesar["petugas"] ?></td>
                                </tr>
                                <tr>
                                    <td>Dokter</td>
                                    <td>: <?= $data->icSesar["dokter"] ?></td>
                                </tr>
                                <tr>
                                    <td>Saksi</td>
                                    <td>: <?= $data->icSesar["saksi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Tindakan Medis</td>
                                    <td>: <?= $data->icSesar["tindakanMedis"] ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis</td>
                                    <td>: <?= $data->icSesar["jenis"] == 'PERSETUJUAN' ? '<span class="badge-estetik bg-vibrant-teal">PERSETUJUAN</span>' : '<span class="badge-estetik bg-vibrant-red">PENOLAKAN</span>'; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->icSesar['ttdSaksi'] && $data->icSesar['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->icSesar['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/icSesar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->icSesar['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formIcSesar.php") ?>

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
                <?= $this->include("rm/partials/formIcSesar.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->icSesar['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->icSesar) ? date('Y-m-d\TH:i', strtotime($data->icSesar["tglinput"])) : '' ?>">
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
            $("#nik").val("<?= $data->pasien['no_ktp'] ?>")
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
                $("#nama").val("<?= $data->pjPasien['namaPj'] ?>")
                $("#alamat").val("<?= $data->pjPasien['alamatPj'] ?>")
                $("#jk").val("<?= $data->pjPasien['jkPj'] ?>")
                $("#tglLahir").val("<?= $data->pjPasien['tglLahirPj'] ?>")
                $("#tempatLahir").val("<?= $data->pjPasien['tempatLahirPj'] ?>")
                $("#nik").val("<?= $data->pjPasien['nikPj'] ?>")
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
            $("#nama").val(<?= json_encode($data->icSesar['nama'] ?? '') ?>);
            $("#jk").val(<?= json_encode($data->icSesar['jk'] ?? '') ?>);
            $("#tglLahir").val(<?= json_encode($data->icSesar['tanggalLahir'] ?? '') ?>);
            $("#tempatLahir").val(<?= json_encode($data->icSesar['tempatLahir'] ?? '') ?>);
            $("#alamat").val(<?= json_encode($data->icSesar['alamat'] ?? '') ?>);
            $("#nik").val(<?= json_encode($data->icSesar['nik'] ?? '') ?>);
            $("#sebagai").val(<?= json_encode($data->icSesar['sebagai'] ?? 'Suami') ?>);

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
        var noRawat = "<?= $data->pasien["no_rawat"] ?>";
        var nama = $("#nama").val();
        var jk = $("#jk").val();
        var tempatLahir = $("#tempatLahir").val();
        var tglLahir = $("#tglLahir").val();
        var alamat = $("#alamat").val();
        var nik = $("#nik").val();
        var sebagai = $("#sebagai").val();
        var petugas = $("#petugas").val();
        var dokter = $("#dokter").val();
        var saksi = $("#saksi").val();
        var tindakanMedis = $("#tindakanMedis").val();
        var jenis = $('input[name="jenis"]:checked').val();


        // =============== ISIAN INFORMED CONSENT ===============
        var diagnosa = $("#diagnosa").val();;
        var alternatif = $("#alternatif").val();;
        var lainLain = $("#lainLain").val();;
        var diagnosa = $("#diagnosa").val();;
        var indikasiIbu = $('input[name="indikasiIbu[]"]:checked').map(function() {
            return this.value;
        }).get();
        var indikasiJanin = $('input[name="indikasiJanin[]"]:checked').map(function() {
            return this.value;
        }).get();
        var indikasiIbuLainnya = $("#indikasiIbuLainnya").val();;
        var indikasiJaninLainnya = $("#indikasiJaninLainnya").val();;
        // ===========================================================================

        $("#pesanError").html("");

        if (nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else if (!jk) {
            $("#jk").focus();
            $("#pesanError").html("Jenis Kelamin wajib dipilih");
        } else if (tempatLahir.replace(/\s+/g, "-") == "") {
            $("#tempatLahir").focus();
            $("#pesanError").html("Tempat Lahir wajib diisi");
        } else if (tglLahir.replace(/\s+/g, "-") == "") {
            $("#tglLahir").focus();
            $("#pesanError").html("Tanggal lahir wajib diisi");
        } else if (alamat.replace(/\s+/g, "-") == "") {
            $("#alamat").focus();
            $("#pesanError").html("Alamat wajib diisi");
        } else if (nik.replace(/\s+/g, "-") == "") {
            $("#nik").focus();
            $("#pesanError").html("NIK wajib diisi");
        } else if (!dokter) {
            $("#dokter").focus();
            $("#pesanError").html("Dokter wajib dipilih");
        } else if (saksi.replace(/\s+/g, "-") == "") {
            $("#saksi").focus();
            $("#pesanError").html("Saksi wajib diisi");
        } else if (tindakanMedis.replace(/\s+/g, "-") == "") {
            $("#tindakanMedis").focus();
            $("#pesanError").html("Tindakan Medis wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/icSesar/simpan") ?>',
                method: 'POST',
                data: {
                    tujuanSimpan: tujuanSimpan,
                    nama: nama,
                    noRawat: noRawat,
                    jk: jk,
                    tempatLahir: tempatLahir,
                    tglLahir: tglLahir,
                    alamat: alamat,
                    nik: nik,
                    sebagai: sebagai,
                    petugas: petugas,
                    saksi: saksi,
                    dokter: dokter,
                    tindakanMedis: tindakanMedis,
                    jenis: jenis,

                    diagnosa: diagnosa,
                    alternatif: alternatif,
                    lainLain: lainLain,
                    indikasiIbu: indikasiIbu,
                    indikasiJanin: indikasiJanin,
                    indikasiIbuLainnya: indikasiIbuLainnya,
                    indikasiJaninLainnya: indikasiJaninLainnya,
                },
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


    <?php if ($data->icSesar) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->icSesar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/icSesar/hapus',
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
            noRawat = "<?= $data->icSesar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/icSesar/ubahWaktu',
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