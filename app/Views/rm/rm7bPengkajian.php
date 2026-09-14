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
                <h5 class="text-uppercase">PENGKAJIAN AWAL KEBIDANAN <br>
                    INSTALASI GAWAT DARURAT</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm7bPengkajian) : ?>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Keluarga</td>
                                    <td>: <?= $data->rm7bPengkajian["nama"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td>: <?= $data->rm7bPengkajian["alamat"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>No. Hp</td>
                                    <td>: <?= $data->rm7bPengkajian["noHp"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Bidan</td>
                                    <td>: <?= $data->rm7bPengkajian["petugas"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Keadaan :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Kaluhan Utama</td>
                                    <td>: <?= $data->rm7bPengkajian["keluhanUtama"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat Keluhan</td>
                                    <td>: <?= $data->rm7bPengkajian["riwayatKeluhan"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Keadaan Umum</td>
                                    <td>: <?= $data->rm7bPengkajian["keadaanUmum"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Kesadaran</td>
                                    <td>: <?= $data->rm7bPengkajian["kesadaran"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="col-12">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center fw-bold">
                                    Riwayat Kehamilan dan kelahiran
                                </div>
                            </div>
                            <hr class="m-0 mb-2">
                            <style>
                                .tabel td,
                                .tabel th {
                                    padding: 0mm;
                                }
                            </style>

                            <table class="table table-sm tabel table-striped table-bordered table-responsive mb-0">
                                <thead class="text-center">
                                    <tr>
                                        <th rowspan="3">Hamil Ke</th>
                                        <th colspan="3">Umur Hamil</th>
                                        <th rowspan="3">Jenis Persalinan</th>
                                        <th colspan="2">Penolong</th>
                                        <th colspan="2">Anak, BB Lahir</th>
                                        <th colspan="3">Keadaan Anak Sekarang</th>
                                        <th rowspan="3">Aksi</th>
                                    </tr>
                                    <tr>
                                        <th rowspan="2">Abortus</th>
                                        <th rowspan="2">Prematur</th>
                                        <th rowspan="2">Aterm</th>
                                        <th rowspan="2">Nakes</th>
                                        <th rowspan="2">Non Nakes</th>
                                        <th>JK</th>
                                        <th>BBL</th>
                                        <th colspan="2">Hidup (Usia)</th>
                                        <th rowspan="2">Mati</th>
                                    </tr>
                                    <tr>
                                        <th>♂ / ♀</th>
                                        <th>(gram)</th>
                                        <th>Normal</th>
                                        <th>Cacat</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelRiwayatData">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm7bPengkajian['ttdPetugas']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm7bPengkajian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm7bPengkajian/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm7bPengkajian['id']) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
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
                <?= $this->include("rm/partials/formRm7bPengkajian.php") ?>

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
                <?php
                if ($data->rm7bPengkajian) : ?>
                    <?= $this->include("rm/partials/formRm7bPengkajian.php") ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm7bPengkajian['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm7bPengkajian) ? date('Y-m-d\TH:i', strtotime($data->rm7bPengkajian["tglinput"])) : '' ?>">
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
        if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
                $("#alamat").val(<?= json_encode($data->pjPasien['alamatPj']) ?>);
            <?php endif; ?>
            $("#nama").prop('readonly', true);
            $("#alamat").prop('readonly', true);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked')) {
            $("#nama").val(<?= json_encode($data->rm3TataTertib['nama'] ?? '') ?>);
            $("#alamat").val(<?= json_encode($data->rm3TataTertib['alamat'] ?? '') ?>);

            $("#nama").prop('readonly', false);
            $("#alamat").prop('readonly', false);
        }
    }

    function simpan(tujuanSimpan) {
        var noRawat = "<?= $data->pasien['no_rawat'] ?>";
        // 1. Capture the form data into an array
        var formArray = $("form").serializeArray();

        // 2. Convert it into a clean "data" object
        var data = {};
        $.map(formArray, function(n, i) {
            // If the name ends with [], handle it as an array
            if (n['name'].indexOf('[]') !== -1) {
                var cleanName = n['name'].replace('[]', '');
                if (!data[cleanName]) {
                    data[cleanName] = [];
                }
                data[cleanName].push(n['value']);
            } else {
                // Standard field
                data[n['name']] = n['value'];
            }
        });

        // Now 'data' is ready to be used
        console.log(data);

        data.tujuanSimpan = tujuanSimpan; // adding from a variable
        data.noRawat = noRawat; // adding from a variable

        // ===========================================================================

        $("#pesanError").html("");

        // Validasi field Nama yang menerima
        if (data.nama === "") {
            $("#nama").focus();
            $("#pesanError").html("Pengirim wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm7bPengkajian/simpan") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    location.reload()
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }
    }

    <?php if ($data->rm7bPengkajian) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm7bPengkajian['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url("rm/rm7bPengkajian/hapus") ?>',
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
            noRawat = "<?= $data->rm7bPengkajian['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm7bPengkajian/ubahWaktu',
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

        function muatRiwayat() {
            $.ajax({
                url: '<?= base_url() ?>rm/rm7bPengkajian/muatRiwayat',
                method: 'post',
                data: {
                    "id": <?= $data->rm7bPengkajian['id'] ?>
                },
                dataType: 'json',
                success: function(response) {
                    var html = '';

                    // 1. Loop data riwayat dari server jika ada
                    if (response && response.length > 0) {
                        $.each(response, function(i, row) {
                            var jkText = '';
                            if (row.jk === 'L') jkText = 'Laki-laki (♂)';
                            else if (row.jk === 'P') jkText = 'Perempuan (♀)';
                            else if (row.jk === 'TK') jkText = 'Tidak Diketahui';

                            html += '<tr>';
                            html += '<td>' + (row.hamil_ke ?? '') + '</td>';
                            html += '<td>' + (row.abortus ?? '') + '</td>';
                            html += '<td>' + (row.prematur ?? '') + '</td>';
                            html += '<td>' + (row.aterm ?? '') + '</td>';
                            html += '<td>' + (row.jenis_persalinan ?? '') + '</td>';
                            html += '<td>' + (row.penolong_nakes ?? '') + '</td>';
                            html += '<td>' + (row.penolong_non_nakes ?? '') + '</td>';
                            html += '<td>' + jkText + '</td>';
                            html += '<td>' + (row.bbl ?? '') + '</td>';
                            html += '<td>' + (row.keadaan_normal ?? '') + '</td>';
                            html += '<td>' + (row.keadaan_cacat ?? '') + '</td>';
                            html += '<td>' + (row.keadaan_mati ?? '') + '</td>';
                            html += '<td class="text-center">';
                            html += '  <button type="button" class="btn btn-sm btn-estetik btn-hapus text-nowrap" onclick="hapusRiwayat(' + row.id + ')"><i class="fa-solid fa-trash"></i></button>';
                            html += '</td>';
                            html += '</tr>';
                        });
                    }

                    // 2. Tempelkan baris input di paling akhir data
                    html += `
                <tr>
                    <td>
                        <input type="number" class="form-control form-control-sm" id="hamil_ke" name="hamil_ke" style="width: 65px;">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="abortus" name="abortus" style="width: 70px;">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="prematur" name="prematur" style="width: 70px;">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="aterm" name="aterm" style="width: 70px;">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="jenis_persalinan" name="jenis_persalinan">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="penolong_nakes" name="penolong_nakes">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="penolong_non_nakes" name="penolong_non_nakes">
                    </td>
                    <td>
                        <select class="form-select form-select-sm" id="jk" name="jk">
                            <option value="">-- Pilih --</option>
                            <option value="L">Laki-laki (♂)</option>
                            <option value="P">Perempuan (♀)</option>
                            <option value="TK">Tidak Diketahui</option>
                        </select>
                    </td>
                    <td>
                        <input type="number" class="form-control form-control-sm" id="bbl" name="bbl" style="width: 75px;">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="keadaan_normal" name="keadaan_normal">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="keadaan_cacat" name="keadaan_cacat">
                    </td>
                    <td>
                        <input type="text" class="form-control form-control-sm" id="keadaan_mati" name="keadaan_mati">
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-estetik btn-cetak" id="btn-tambah" onclick="tambahRiwayat()"><i class="fa-solid fa-plus"></i></button>
                    </td>
                </tr>
            `;

                    // 3. Render seluruh isi ke tbody
                    $("#tabelRiwayatData").html(html);
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memuat riwayat:", error);
                }
            });
        }

        // Jalankan fungsi otomatis saat halaman terbuka
        $(document).ready(function() {
            muatRiwayat();
        });

        function tambahRiwayat() {
            var data = {
                idPengkajian: <?= $data->rm7bPengkajian['id'] ?>,
                hamil_ke: $('#hamil_ke').val(),
                abortus: $('#abortus').val(),
                prematur: $('#prematur').val(),
                aterm: $('#aterm').val(),
                jenis_persalinan: $('#jenis_persalinan').val(),
                penolong_nakes: $('#penolong_nakes').val(),
                penolong_non_nakes: $('#penolong_non_nakes').val(),
                jk: $('#jk').val(),
                jk_text: $('#jk').val() ? $('#jk option:selected').text() : '',
                bbl: $('#bbl').val(),
                keadaan_normal: $('#keadaan_normal').val(),
                keadaan_cacat: $('#keadaan_cacat').val(),
                keadaan_mati: $('#keadaan_mati').val()
            };

            // Validasi sederhana: pastikan minimal 'hamil_ke' diisi
            if (!data.hamil_ke) {
                alert('Silakan isi Hamil Ke terlebih dahulu!');
                $('#hamil_ke').focus();
                return;
            }

            $.ajax({
                url: '<?= base_url("rm/rm7bPengkajian/tambahRiwayat") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    muatRiwayat();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });

        }

        function hapusRiwayat(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data riwayat ini?')) {
                $.ajax({
                    url: '<?= base_url() ?>rm/rm7bPengkajian/hapusRiwayat',
                    method: 'post',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            // Refresh tampilan tabel setelah hapus
                            muatRiwayat();
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Terjadi kesalahan saat menghapus data.');
                        console.error(error);
                    }
                });
            }
        }

    <?php endif; ?>
</script>
<?php $this->endSection() ?>