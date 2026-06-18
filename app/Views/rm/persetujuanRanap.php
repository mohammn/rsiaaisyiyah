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
                <h3>Persetujuan Rawat Inap</h3>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->persetujuanRanap) : ?>
                <div class="row">
                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row mb-1">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <mark>Yang bertanda tangan :</mark>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama</td>
                                    <td>: <?= $data->persetujuanRanap["namaWali"] ?></td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td>: <?= $data->persetujuanRanap["noTelp"] ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->persetujuanRanap["alamat"] ?></td>
                                </tr>
                                <tr>
                                    <td>Sebagai</td>
                                    <td>: <?= $data->persetujuanRanap["sebagai"] ?></td>
                                </tr>
                                <tr>
                                    <td>Saksi</td>
                                    <td>: <?= $data->persetujuanRanap["saksi"] ?></td>
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
                            <div>
                                <table class="table table-info table-borderless">
                                    <tr>
                                        <td>Petugas</td>
                                        <td>: <?= $data->persetujuanRanap["petugas"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Anggota Keluarga</td>
                                        <td>: <?= $data->persetujuanRanap["namaKeluarga"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pembayaran</td>
                                        <td>: <?= $data->persetujuanRanap["jenis_pasien"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dokter</td>
                                        <td>: <?= $data->persetujuanRanap["dokter"] ?></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Status Jenguk
                                        </td>
                                        <td> :
                                            <?php
                                            if ($data->persetujuanRanap["izin_jenguk"] === 'semua') {
                                                echo "Semua Orang";
                                            } else if ($data->persetujuanRanap["izin_jenguk"] === 'kecuali') {
                                                echo "Semua Orang. Kecuali :" . $data->persetujuanRanap["isi_kecuali"];
                                            } else {
                                                echo "Tidak mau dijenguk. Kecuali :" . $data->persetujuanRanap["isi_kecuali"];
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->persetujuanRanap['ttdWali'] && $data->persetujuanRanap['ttdSaksi']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/persetujuanRanap/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                            <button class="btn btn-estetik btn-edit" class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                                <i class="fas fa-edit me-1"></i> Edit
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
                <?= $this->include("rm/partials/formPersetujuanRanap") ?>

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
<div class="modal modal-xl fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->include("rm/partials/formPersetujuanRanap") ?>
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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus persetujuan rawat Inap ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form Persetujuan Rawat Inap pasien atas nama <b id="namaPasienHapus"></b> dengan no. Rekam Medis : <b id="noRawatHapus"></b> ? <br>
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->persetujuanRanap) ? date('Y-m-d\TH:i', strtotime($data->persetujuanRanap["tglinput"])) : '' ?>">
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
            $("#namaWali").val(<?= json_encode($data->pasien['nm_pasien']) ?>);
            $("#alamat").val(<?= json_encode($data->pasien['alamat']) ?>);
            $("#noTelp").val(<?= json_encode($data->pasien['no_tlp']) ?>);
            $("#sebagai").val("Saya sendiri")

            $("#namaWali").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#noTelp").prop('disabled', true);
            $("#sebagai").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#namaWali").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
                $("#alamat").val(<?= json_encode($data->pjPasien['alamatPj']) ?>);
            <?php endif; ?>
            $("#noTelp").val("")
            $("#sebagai").val("Suami")

            $("#namaWali").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#namaWali").val(<?= json_encode($data->persetujuanRanap['namaWali'] ?? "") ?>);
            $("#alamat").val(<?= json_encode($data->persetujuanRanap['alamat'] ?? "") ?>);
            $("#noTelp").val(<?= json_encode($data->persetujuanRanap['noTelp'] ?? "") ?>);

            $("#sebagai").val(<?= json_encode($data->persetujuanRanap['sebagai'] ?? "Suami") ?>);

            $("#namaWali").prop('disabled', false);
            $("#alamat").prop('disabled', false);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function simpan(tujuan) {
        // Inisialisasi objek data utama
        var formData = {
            // PERBAIKAN 1: Hapus tanda petik manual karena json_encode sudah memberikan tanda petik otomatis
            noRawat: <?= json_encode($data->pasien["no_rawat"] ?? "") ?>,

            // PERBAIKAN 2: Sesuaikan key agar dibaca sebagai 'tujuanSimpan' di Controller CI4
            tujuanSimpan: tujuan,

            // 1. DATA PENANGGUNG JAWAB & SAKSI
            namaWali: $("#namaWali").val(),
            noTelp: $("#noTelp").val(),
            alamat: $("#alamat").val(),
            sebagai: $("#sebagai").val(),
            petugas: $("#petugas").val(),
            saksi: $("#saksi").val(),

            // 2. DATA PELEPASAN INFORMASI MEDIS & PRIVASI
            dokter: $("#dokter").val(),
            namaKeluarga: $("#namaKeluarga").val(),
            izin_jenguk: $(".rad-jenguk:checked").val(),
            isi_kecuali: $("#isi_kecuali").val(),

            // 3. DATA KEWAJIBAN PEMBAYARAN (SINKRONISASI JALUR)
            jenis_pasien: $(".rad-jenis-pasien:checked").val(),
            status_asuransi_umum: "",
            kelas_umum: "",
            kelas_umum_lain_text: "",
            biaya_min: "",
            biaya_max: "",
            no_bpjs: "",
            bpjs_status_kelas: "",
            bpjs_naik_tingkat: "",
            nama_asuransi_lain: ""
        };

        // Ambil nilai secara spesifik berdasarkan jalur pasien yang dipilih
        if (formData.jenis_pasien === "umum") {
            formData.status_asuransi_umum = $('[name="status_asuransi_umum"]:checked').val();
            formData.kelas_umum = $('[name="kelas_umum"]:checked').val();
            formData.kelas_umum_lain_text = $("#kelas_umum_lain_text").val();
            formData.biaya_min = $("#biaya_min").val();
            formData.biaya_max = $("#biaya_max").val();
        } else if (formData.jenis_pasien === "bpjs") {
            formData.no_bpjs = $("#no_bpjs").val();
            formData.bpjs_status_kelas = $('.rad-bpjs-kelas:checked').val();

            if (formData.bpjs_status_kelas === "naik_perawatan") {
                formData.bpjs_naik_tingkat = $('[name="bpjs_naik_tingkat"]:checked').val();
            }
        } else if (formData.jenis_pasien === "asuransi_lain") {
            formData.nama_asuransi_lain = $("#nama_asuransi_lain").val();
        }

        // Reset pesan error
        $("#pesanError").html("");

        // Validasi input (memastikan tidak kosong atau hanya berisi spasi)
        if (!formData.namaWali || formData.namaWali.trim() === "") {
            $("#namaWali").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else if (!formData.noTelp || formData.noTelp.trim() === "") {
            $("#noTelp").focus();
            $("#pesanError").html("No telp. wajib diisi");
        } else if (!formData.alamat || formData.alamat.trim() === "") {
            $("#alamat").focus();
            $("#pesanError").html("Alamat wajib diisi");
        } else if (!formData.saksi || formData.saksi.trim() === "") {
            $("#saksi").focus();
            $("#pesanError").html("Saksi wajib diisi");
        } else if (!formData.namaKeluarga || formData.namaKeluarga.trim() === "") {
            $("#namaKeluarga").focus();
            $("#pesanError").html("Nama Keluarga wajib diisi");
        } else {
            // Kirim data menggunakan AJAX jika semua validasi lolos
            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRanap/simpan',
                method: 'post',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.status === 'success') {
                        location.reload();
                    } else {
                        $("#pesanError").html(data.message || "Gagal menyimpan data");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    $("#pesanError").html("Terjadi kesalahan sistem saat menyimpan.");
                }
            });
        }
    }

    <?php if ($data->persetujuanRanap) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = $("#noRawatHapus").html()

            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRanap/hapus',
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
            noRawat = "<?= $data->pasien["no_rawat"] ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/persetujuanRanap/ubahWaktu',
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