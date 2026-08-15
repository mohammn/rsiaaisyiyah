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
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/operasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">RM Operasi</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">PENGKAJIAN PRA BEDAH
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm11a1Bedah) : ?>
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data PJ dan Pasien :</div>
                                <hr>
                            </div>
                            <mark>Yang bertanda tangan :</mark>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->rm11a1Bedah["nama"]  ?></td>
                                </tr>
                                <tr>
                                    <td>Tempat Pengkasian</td>
                                    <td>: <?= $data->rm11a1Bedah["tempatPengkajian"]  ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Keluhan Utama</td>
                                    <td>: <?= $data->rm11a1Bedah["keluhan"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat Penyakit</td>
                                    <td>:
                                        <?php
                                        $riwayat = json_decode($data->rm11a1Bedah["riwayatPenyakit"] ?? '', true);

                                        if (!empty($riwayat) && is_array($riwayat)) {
                                            // Cari posisi string "Lainnya" di dalam array
                                            $key = array_search('Lainnya', $riwayat);

                                            // Jika ada nilai "Lainnya", ganti dengan isi dari isiRiwayatLainnya (jika ada)
                                            if ($key !== false) {
                                                $isiLainnya = trim($data->rm11a1Bedah["isiRiwayatLainnya"] ?? '');
                                                if (!empty($isiLainnya)) {
                                                    $riwayat[$key] = $isiLainnya; // Mengganti "Lainnya" menjadi isi inputan kustom
                                                }
                                            }

                                            // Cetak dipisahkan koma
                                            echo implode(', ', $riwayat);
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-3">
                                <div class="col-12 text-center">Hasil Pemeriksaan Penunjang :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless mb-4">
                                <tr>
                                    <td>Laboratorium</td>
                                    <td>: <?= $data->rm11a1Bedah["laboratorium"] ?></td>
                                </tr>
                                <tr>
                                    <td>Radiologi</td>
                                    <td>: <?= $data->rm11a1Bedah["radiologi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Lainnya</td>
                                    <td>: <?= $data->rm11a1Bedah["penunjangLainnya"] ?></td>
                                </tr>
                                <tr>
                                    <td>Rekonsiliasi</td>
                                    <td>: <?= $data->rm11a1Bedah["rekonsiliasi"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm11a1Bedah['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm11a1Bedah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm11a1Bedah/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                            <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fa fa-edit me-1"></i> Edit
                            </button>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm11a1Bedah/penandaan/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>">
                                <i class="fas fa-pencil me-1"></i> Edit Lokasi Ops
                            </a>
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
                <?= $this->include("rm/partials/formRm11a1Bedah.php") ?>

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
                <?= $this->include("rm/partials/formRm11a1Bedah.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm11a1Bedah['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm11a1Bedah) ? date('Y-m-d\TH:i', strtotime($data->rm11a1Bedah["tglinput"])) : '' ?>">
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

            $('#samaDgPj').prop('checked', false);
            $("#nama").prop('disabled', true);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
            <?php endif; ?>

            $("#nama").prop('disabled', true);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val(<?= json_encode($data->rm11a1Bedah['nama'] ?? '') ?>);

            $("#nama").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // 1. Anamnesa
            nama: $('#nama').val(),
            tempatPengkajian: $('input[name="tempatPengkajian"]:checked').val() || '',
            keluhan: $('#keluhan').val(),

            // Riwayat Penyakit (Checkbox Array)
            riwayatPenyakit: $('input[name="riwayatPenyakit[]"]:checked').map(function() {
                return $(this).val();
            }).get(),
            isiRiwayatLainnya: $('#isiRiwayatLainnya').val(),

            // Riwayat Operasi
            jenisOperasi: $('#jenisOperasi').val(),
            lokasiOperasi: $('#lokasiOperasi').val(),
            tglOperasi: $('#tglOperasi').val(),

            // Riwayat Alergi
            riwayatAlergi: $('input[name="riwayatAlergi"]:checked').val() || '',
            isiAlergi: $('#isiAlergi').val(),

            // 2. Pemeriksaan Fisik
            td: $('#td').val(),
            beratBadan: $('#beratBadan').val(),
            nadi: $('#nadi').val(),
            tinggiBadan: $('#tinggiBadan').val(),
            suhu: $('#suhu').val(),
            pernafasan: $('#pernafasan').val(),

            // 3. Hasil Pemeriksaan Penunjang
            laboratorium: $('#laboratorium').val(),
            radiologi: $('#radiologi').val(),
            penunjangLainnya: $('#penunjangLainnya').val(),
            rekonsiliasi: $('input[name="rekonsiliasi"]:checked').val() || '',

            // 4. Diagnosa / Asesmen
            diagnosaPreoperatif: $('#diagnosaPreoperatif').val(),
            diagnosaLain: $('input[name="diagnosaLain"]:checked').val() || '',
            isidiagnosaLain: $('#isidiagnosaLain').val(),

            // 5. Rencana Tatalaksana
            rencanaOperasi: $('#rencanaOperasi').val(),
            sifatProsedur: $('input[name="sifatProsedur"]:checked').val() || '',
            isiElektif: $('#isiElektif').val(),
            lamaTindakan: $('#lamaTindakan').val(),
            anestesia: $('input[name="anestesia"]:checked').val() || '',
            puasa: $('input[name="puasa"]:checked').val() || '',
            isiMulaiJam: $('#isiMulaiJam').val(),
            konsultasiBagian: $('input[name="konsultasiBagian"]:checked').val() || '',
            isiKonsultasi: $('#isiKonsultasi').val(),
            peralatan: $('input[name="peralatan"]:checked').val() || '',
            isiPeralatanLain: $('#isiPeralatanLain').val(),
            pengosonganKemih: $('input[name="pengosonganKemih"]:checked').val() || '',
            infus: $('input[name="infus"]:checked').val() || '',

            // Persiapan Darah
            persiapanDarah: $('input[name="persiapanDarah"]:checked').val() || '',
            isiWholeBlood: $('#isiWholeBlood').val(),
            isiPackedRed: $('#isiPackedRed').val(),
            isiKomponenLain: $('#isiKomponenLain').val(),

            // Post Op & Penutup
            rencanaPostOp: $('input[name="rencanaPostOp"]:checked').val() || '',
            catatan: $('#catatan').val(),
            dokter: $('#dokter').val() || ''
        };

        $("#pesanError").html("");

        if (data.nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm11a1Bedah/simpan") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    if (tujuanSimpan == 'tambah') {
                        location.href = "<?= base_url('rm/rm11a1Bedah/penandaan/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                    } else {
                        location.reload();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }
    }


    <?php if ($data->rm11a1Bedah) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm11a1Bedah['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11a1Bedah/hapus',
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
            noRawat = "<?= $data->rm11a1Bedah['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11a1Bedah/ubahWaktu',
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