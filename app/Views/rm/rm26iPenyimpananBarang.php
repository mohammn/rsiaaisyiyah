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
                <h5 class="text-uppercase">DAFTAR PENYIMPANAN BARANG MILIK PASIEN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm26iPenyimpananBarang) : ?>
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
                                    <td>Nama Penitip</td>
                                    <td>: <?= $data->rm26iPenyimpananBarang["nama"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Petugas</td>
                                    <td>: <?= $data->rm26iPenyimpananBarang["petugas"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Waktu :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Waktu dititipkan :</td>
                                    <td>:
                                        <?php
                                        $waktuTitip = $data->rm26iPenyimpananBarang["waktuTitip"] ?? null;
                                        if ($waktuTitip && $waktuTitip != '0000-00-00 00:00:00') {
                                            echo date('d-m-Y, H:i', strtotime($waktuTitip)) . ' WIB';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Waktu diserahkan :</td>
                                    <td>:
                                        <?php
                                        $waktuSerah = $data->rm26iPenyimpananBarang["waktuSerah"] ?? null;
                                        if ($waktuSerah && $waktuSerah != '0000-00-00 00:00:00') {
                                            echo date('d-m-Y, H:i', strtotime($waktuSerah)) . ' WIB';
                                        } else {
                                            echo '-';
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                            <mark class="text-small" style="font-size: 8pt;">*berkas wajib dittd setelah tgl kembali sudah diisi. karna berkas sudah di ttd tidak dapat diedit !</mark>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->rm26iPenyimpananBarang['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm26iPenyimpananBarang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm26iPenyimpananBarang['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm26iPenyimpananBarang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm26iPenyimpananBarang['id']) ?>" target="_blank">
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
                    <?php if (!$data->rm26iPenyimpananBarang['ttdWali']): ?>
                        <div class="row mt-2">
                            <div class="col-4">
                                <div class="alert alert-info">
                                    <div class="row">
                                        <div class="col-12 text-center">Tambah Barang :</div>
                                        <hr>
                                    </div>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Nama Barang :</label>
                                    <input type="text" id="namaBarang" name="namaBarang" class="form-control form-control-sm" value="<?= $data->rm26iPenyimpananBarang['namaBarang'] ?? '' ?>">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah :</label>
                                    <input type="text" id="jumlah" name="jumlah" class="form-control form-control-sm" value="<?= $data->rm26iPenyimpananBarang['jumlah'] ?? '' ?>">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kondisi saat dititipkan :</label>
                                    <select name="kondisiTitip" id="kondisiTitip" class="form-select form-select-sm">
                                        <option value="Baik">Baik</option>
                                        <option value="Buruk">Buruk</option>
                                    </select>
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Kondisi saat diserahkan :</label>
                                    <select name="kondisiSerah" id="kondisiSerah" class="form-select form-select-sm">
                                        <option value="Baik">Baik</option>
                                        <option value="Buruk">Buruk</option>
                                    </select>
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <button class="btn btn-estetik btn-simpan mt-2" onclick="simpanBarang('tambah')">
                                                <i class="fas fa-plus me-1"></i> Tambah
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="alert alert-info">
                                    <div class="row">
                                        <div class="col-12 text-center">Data Barang :</div>
                                        <hr>
                                    </div>
                                    <table class="table teble-striped">
                                        <thead>
                                            <th>No.</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kondisi saat dititipkan</th>
                                            <th>Kondisi saat diserahkan</th>
                                            <th>Hapus</th>
                                        </thead>
                                        <tbody id="isiTabelBarang">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm26iPenyimpananBarang.php") ?>

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
                <?= $this->include("rm/partials/formRm26iPenyimpananBarang.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm26iPenyimpananBarang['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm26iPenyimpananBarang) ? date('Y-m-d\TH:i', strtotime($data->rm26iPenyimpananBarang["tglinput"])) : '' ?>">
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

            $("#nama").prop('disabled', true);

            $('#samaDgPj').prop('checked', false);
        } else if (asal == 'pj') {
            <?php if ($data->pjPasien): ?>
                $("#nama").val(<?= json_encode($data->pjPasien['namaPj']) ?>);
            <?php endif; ?>

            $('#samaDgPasien').prop('checked', false);
            $("#nama").prop('disabled', true);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val(<?= json_encode($data->rm26iPenyimpananBarang['nama'] ?? '') ?>);

            $("#nama").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // --- DATA PENANGGUNG JAWAB (Form Kiri) ---
            nama: $('#nama').val(),
            petugas: $('#petugas').val(), // Mengambil id="petugas" (input hidden di kiri atau input disabled paling bawah)
            satpam: $('#satpam').val(), // Mengambil id="petugas" (input hidden di kiri atau input disabled paling bawah)
            waktuTitip: $('#waktuTitip').val() || '',
            waktuSerah: $('#waktuSerah').val(),
        };

        $("#pesanError").html("");

        if (data.nama.replace(/\s+/g, "-") == "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm26iPenyimpananBarang/simpan") ?>',
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

    function simpanBarang(tujuanSimpan) {
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            id: "<?= $data->rm26iPenyimpananBarang['id'] ?? 0 ?>",

            namaBarang: $('#namaBarang').val(),
            jumlah: $('#jumlah').val(),
            kondisiTitip: $('#kondisiTitip').val(),
            kondisiSerah: $('#kondisiSerah').val(),
        };

        $.ajax({
            url: '<?= base_url("rm/rm26iPenyimpananBarang/simpanBarang") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                muatData();
                $('#namaBarang').val('');
                $('#jumlah').val('');
                $('#kondisiTitip').val('Baik');
                $('#kondisiSerah').val('Baik');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }


    <?php if ($data->rm26iPenyimpananBarang) : ?>

        muatData()

        function muatData() {
            $.ajax({
                url: '<?= base_url() ?>rm/rm26iPenyimpananBarang/muatData',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "id=<?= $data->rm26iPenyimpananBarang['id'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {
                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + (i + 1) + '</td>';
                        hasil += '<td>' + data[i].namaBarang + '</td>';
                        hasil += '<td>' + data[i].jumlah + '</td>';
                        hasil += '<td>' + data[i].kondisiTitip + '</td>';
                        hasil += '<td>' + data[i].kondisiSerah + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="hapusBarang(' + data[i].id + ')"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';
                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#isiTabelBarang").html(hasil);
                }
            });
        }

        function hapusBarang(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm26iPenyimpananBarang/hapusBarang',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    muatData();
                }
            });
        }

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm26iPenyimpananBarang['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26iPenyimpananBarang/hapus',
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
            noRawat = "<?= $data->rm26iPenyimpananBarang['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26iPenyimpananBarang/ubahWaktu',
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