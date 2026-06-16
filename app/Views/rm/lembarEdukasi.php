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
                <h5 class="text-uppercase">LEMBAR EDUKASI TERINTEGRASI</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->lembarEdukasi) : ?>
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
                                    <td>: <?= $data->lembarEdukasi["nama"] ?></td>
                                </tr>
                                <tr>
                                    <td>Bahasa</td>
                                    <td>: <?= $data->lembarEdukasi["bahasa"] ?></td>
                                </tr>
                                <tr>
                                    <td>Kebutuhan Penerjemah</td>
                                    <td>: <?= $data->lembarEdukasi["penerjemah"] ?></td>
                                </tr>
                                <tr>
                                    <td>Pendidikan</td>
                                    <td>: <?= $data->lembarEdukasi["pendidikan"] ?></td>
                                </tr>
                                <tr>
                                    <td>Agama</td>
                                    <td>: <?= $data->lembarEdukasi["agama"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-1">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless mb-4">
                                <tr>
                                    <td>Petugas</td>
                                    <td>: <?= $data->lembarEdukasi["petugas"] ?></td>
                                </tr>
                                <tr>
                                    <td>Kesulitan baca & tulis</td>
                                    <td>: <?= $data->lembarEdukasi["baca_tulis"] ?></td>
                                </tr>
                                <tr>
                                    <td>Kesulitan Komunikasi</td>
                                    <td>: <?= $data->lembarEdukasi["komunikasi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Hambatan Edukasi</td>
                                    <td>: <?= $data->lembarEdukasi["hambatan_edukasi"] ?></td>
                                </tr>
                                <tr>
                                    <td>Intervensi Hambatan</td>
                                    <td>: <?= $data->lembarEdukasi["intervensi_hambatan"] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if (!empty($data->lembarEdukasi['ttdWali']) && !empty($data->lembarEdukasi['ttd_1']) && !empty($data->lembarEdukasi['ttd_2']) && !empty($data->lembarEdukasi['ttd_3']) && !empty($data->lembarEdukasi['ttd_4']) && !empty($data->lembarEdukasi['ttd_5']) && !empty($data->lembarEdukasi['ttd_6']) && !empty($data->lembarEdukasi['ttd_7']) && !empty($data->lembarEdukasi['ttd_8'])): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->lembarEdukasi['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/lembarEdukasi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->lembarEdukasi['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formLembarEdukasi.php") ?>

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
                <?= $this->include("rm/partials/formLembarEdukasi.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->lembarEdukasi['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->lembarEdukasi) ? date('Y-m-d\TH:i', strtotime($data->lembarEdukasi["tglinput"])) : '' ?>">
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
            $("input[name='agama'][value='<?= $data->pasien['agama'] ?>' i]").prop('checked', true);
            $("#sebagai").val("Saya sendiri");

            $("#nama").prop('disabled', true);
            $("input[name='agama']").prop('disabled', true);
            $("#sebagai").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
            <?php endif; ?>
            $("#sebagai").val("Suami")

            $("#nama").prop('disabled', true);

            $("input[name='agama']").prop('disabled', false);
            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val(<?= json_encode($data->lembarEdukasi['nama'] ?? '') ?>);
            $("input[name='agama'][value='<?= $data->lembarEdukasi['agama'] ?? '' ?>' i]").prop('checked', true);
            $("#sebagai").val(<?= json_encode($data->lembarEdukasi['sebagai'] ?? 'Suami') ?>);

            $("#nama").prop('disabled', false);
            $("input[name='agama']").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        // Mengambil data dari form dan menyimpannya ke dalam variabel objek
        var identitas = {
            noRawat: "<?= $data->pasien["no_rawat"] ?>",
            petugas: $('#petugas').val(),
            nama: $('#nama').val(),

            agama: $('input[name="agama"]:checked').val() || '',
            bahasa: $('input[name="bahasa"]:checked').val() === 'Lainnya' ?
                $('input[name="bahasa_lainnya_input"]').val() : ($('input[name="bahasa"]:checked').val() || ''),

            penerjemah: $('input[name="penerjemah"]:checked').val() || '',

            pendidikan: $('input[name="pendidikan"]:checked').val() === 'Lainnya' ?
                $('input[name="pendidikan_lainnya_input"]').val() : ($('input[name="pendidikan"]:checked').val() || ''),

            bacaTulis: $('input[name="bacaTulis"]:checked').val() === 'Ya' ?
                'Ya: ' + $('input[name="bacaTulisPenjelasan"]').val() : ($('input[name="bacaTulis"]:checked').val() || ''),
            komunikasi: $('input[name="komunikasi"]:checked').val() === 'Ya' ?
                'Ya: ' + $('input[name="komunikasiPenjelasan"]').val() : ($('input[name="komunikasi"]:checked').val() || ''),
            hambatan_edukasi: $('input[name="hambatan_edukasi"]:checked').val() === 'Lainnya' ?
                $('input[name="hambatan_lainnya_input"]').val() : ($('input[name="hambatan_edukasi"]:checked').val() || ''),
            intervensi_hambatan: $('input[name="intervensi_hambatan"]:checked').val() || '',
            nilai_keyakinan: $('input[name="nilai_keyakinan"]').val(),
            kesediaan_informasi: $('input[name="kesediaan_informasi"]:checked').val() || ''
        };

        let dataEdukasi = {};

        // Loop dari angka 1 sampai 8
        for (let idx = 1; idx <= 8; idx++) {
            dataEdukasi[idx] = {
                lainnya: $(`#lainnya_${idx}`).val() || '',
                tanggal: $(`input[name="tgl[${idx}]"]`).val() || '',

                // Menangkap nilai semua checkbox metode yang dicentang pada indeks terkait
                metode: $(`input[name="metode[${idx}][]"]:checked`).map(function() {
                    return this.value;
                }).get(),

                // Menangkap nilai semua checkbox media yang dicentang pada indeks terkait
                media: $(`input[name="media[${idx}][]"]:checked`).map(function() {
                    return this.value;
                }).get(),

                // Menangkap nilai radio button evaluasi yang aktif
                evaluasi: $(`input[name="evaluasi[${idx}]"]:checked`).val() || null,

                petugas: $(`select[name="petugas[${idx}]"]`).val() || '',
                wali: $(`input[name="wali[${idx}]"]`).val() || ''
            };
        }

        // Cek hasilnya di console log browser Anda
        console.log(dataEdukasi);

        $("#pesanError").html("");

        if (identitas.nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/lembarEdukasi/simpan") ?>',
                method: 'POST',
                data: {
                    tujuanSimpan: tujuanSimpan,
                    identitas: identitas,
                    dataEdukasi: dataEdukasi,
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


    <?php if ($data->lembarEdukasi) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->lembarEdukasi['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/lembarEdukasi/hapus',
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
            noRawat = "<?= $data->lembarEdukasi['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/lembarEdukasi/ubahWaktu',
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