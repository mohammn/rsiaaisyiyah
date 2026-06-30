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
                <h5 class="text-uppercase">CATATAN KOMUNIKASI SBAR <?= $data->rm0Sbar['judul'] ?? '' ?></h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm0Sbar) : ?>
                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center fw-bold">SBAR : <?= $data->rm0Sbar["judul"] ?? "...." ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm0Sbar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm0Sbar['id']) ?>" target="_blank">
                        <i class="fas fa-print me-1"></i> Cetak
                    </a>
                    <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                        <i class="fa fa-edit me-1"></i> Edit
                    </button>
                    <button class="btn btn-estetik btn-hapus" onclick="tryHapusJudul()">
                        <i class="fas fa-trash-alt me-1"></i> Hapus
                    </button>
                </div>
                <br>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">form :</div>
                                <input type="hidden" id="idEdit" name="idEdit">
                                <hr>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-4">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Petugas</label>
                                    <select name="petugas" id="petugas" class="form-select">
                                        <option value="" <?= empty($data->rm0Sbar["petugas"]) ? 'selected' : '' ?>>-- Pilih Petugas --</option>
                                        <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                            $nama_petugas = $data->petugas[$i]["nama"];
                                            $selected = ($nama_petugas === ($data->rm0Sbar["petugas"] ?? '')) ? 'selected' : '';
                                            echo '<option value="' . $nama_petugas . '" ' . $selected . '>' . $nama_petugas . '</option>';
                                        } ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dokter</label>
                                    <select name="dokter" id="dokter" class="form-select">
                                        <option value="" <?= empty($data->rm0Sbar["dokter"]) ? 'selected' : '' ?>>-- Pilih Dokter --</option>
                                        <?php for ($i = 0; $i < count($data->dokter); $i++) {
                                            $nama_dokter = $data->dokter[$i]["nm_dokter"];
                                            // Perbaikan: Diubah dari "petugas" menjadi "dokter"
                                            $selected = ($nama_dokter === ($data->rm0Sbar["dokter"] ?? '')) ? 'selected' : '';
                                            echo '<option value="' . $nama_dokter . '" ' . $selected . '>' . $nama_dokter . '</option>';
                                        } ?>
                                    </select>
                                </div>

                                <div class="col-sm-4">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal dan jam</label>
                                    <?php
                                    // Konversi format TIMESTAMP dari DB (YYYY-MM-DD HH:MM:SS) ke format HTML datetime-local (YYYY-MM-DDTHH:MM)
                                    $waktu_value = (!empty($data->rm0Sbar["waktu"])) ? date('Y-m-d\TH:i', strtotime($data->rm0Sbar["waktu"])) : '';
                                    ?>
                                    <input type="datetime-local" id="waktu" name="waktu" class="form-control" value="<?= $waktu_value ?>">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-secondary text-center mb-0 text-nowrap w-100 border-bottom border-secondary border-2">S</label>
                                    <textarea name="s" id="s" class="form-control" rows="4"><?= $data->rm0Sbar["s"] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-secondary mb-0 text-nowrap w-100 text-center border-bottom border-secondary border-2">B</label>
                                    <textarea name="b" id="b" class="form-control" rows="4"><?= $data->rm0Sbar["b"] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-secondary mb-0 text-nowrap w-100 text-center border-bottom border-secondary border-2">A</label>
                                    <textarea name="a" id="a" class="form-control" rows="4"><?= $data->rm0Sbar["a"] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label fw-bold text-secondary mb-0 text-nowrap w-100 text-center border-bottom border-secondary border-2">R</label>
                                    <textarea name="r" id="r" class="form-control" rows="4"><?= $data->rm0Sbar["r"] ?? '' ?></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-center">

                                    <button class="btn btn-estetik btn-lihat" id="tombolPerbarui" onclick="simpan('perbarui')">
                                        <i class="fas fa-save me-1"></i> Perbarui
                                    </button>

                                    <button class="btn btn-estetik btn-simpan" id="tombolTambahSbar" onclick="simpan('tambah')">
                                        <i class="fas fa-save me-1"></i>
                                        <div id="tomboTambah">Tambah</div>
                                    </button>

                                    <button class="btn btn-estetik btn-hapus" onclick="resetForm()">
                                        <i class="fas fa-cancel me-1"></i> Batal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Data :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-sm table-striped " id="tabelSbar">
                                <thead>
                                    <tr>
                                        <th>
                                            Waktu
                                        </th>
                                        <th>
                                            Petugas
                                        </th>
                                        <th>
                                            Dokter
                                        </th>
                                        <th>
                                            Tgl Verif
                                        </th>
                                        <th>
                                            tindakan
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="dataTabelSbar"></tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <label class="form-label fw-bold text-secondary mb-0 text-nowrap">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="<?= $data->rm0Sbar["judul"] ?? '' ?>">
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <div class="bg-info" id="pesanError"> </div>
                    <br>
                    <a class="btn btn-estetik btn-hapus" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-cancel me-1"></i> Batal</a>
                    <button class="btn btn-estetik btn-simpan" onclick="simpanJudul('tambah')">
                        <i class="fas fa-save me-1"></i> Simpan
                    </button>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<!-- Modal edit-->
<div class="modal fade  modal-dialog-scrollable" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data : </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <label class="form-label fw-bold text-secondary mb-0 text-nowrap">Judul</label>
                            <input type="text" name="judul" id="judul" class="form-control" value="<?= $data->rm0Sbar["judul"] ?? '' ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpanJudul(<?= $data->rm0Sbar['id'] ?? '' ?>)">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Lihat-->
<div class="modal fade" id="modalLihat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Detail SBAR</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="idVerif" id="idVerif">
                <table class="table table-sm table-striped">
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td id="dwaktu"></td>
                    </tr>
                    <tr>
                        <td>Petugas</td>
                        <td>:</td>
                        <td id="dpetugas"></td>
                    </tr>
                    <tr>
                        <td>Dokter</td>
                        <td>:</td>
                        <td id="ddokter"></td>
                    </tr>
                    <tr>
                        <td>S</td>
                        <td>:</td>
                        <td id="ds"></td>
                    </tr>
                    <tr>
                        <td>B</td>
                        <td>:</td>
                        <td id="db"></td>
                    </tr>
                    <tr>
                        <td>A</td>
                        <td>:</td>
                        <td id="da"></td>
                    </tr>
                    <tr>
                        <td>R</td>
                        <td>:</td>
                        <td id="dr"></td>
                    </tr>
                    <tr>
                        <td>Verif</td>
                        <td>:</td>
                        <td id="dtglVerif"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-close me-1"></i> Tutup</button>
                <button class="btn btn-estetik btn-simpan" id="tombolVerif" onclick="verif()">
                    <i class="fas fa-check me-1"></i> Verif
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
                <input type="hidden" id="idHapus" name="idHapus">
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Data SBAR pasien <b id="namaPasienHapus"></b> dengan no Rawat : <b id="noRawatHapus"></b> ? <br>
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

<div class="modal fade" id="modalHapusJudul" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <input type="hidden" id="idHapus" name="idHapus">
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Data SBAR dengan judul <b><?= $data->rm0Sbar["judul"] ?? '' ?></b> pada pasien <b id="namaPasienHapusJudul"></b> dengan no Rawat : <b id="noRawatHapusJudul"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Semua Data <b>SBAR</b> akan dihapus dan tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapusJudul()">
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
            id: $('#idEdit').val(),
            idSbar: "<?= $data->rm0Sbar['id'] ?? 0 ?>",

            petugas: $('#petugas').val(),
            dokter: $('#dokter').val(),
            waktu: $('#waktu').val(),

            s: $('#s').val(),
            b: $('#b').val(),
            a: $('#a').val(),
            r: $('#r').val(),
        };

        console.log(data)

        $.ajax({
            url: '<?= base_url("rm/rm0Sbar/simpan") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                muatData();
                resetForm();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }

    function simpanJudul(tujuanSimpan) {
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            id: "<?= $data->rm0Sbar['id'] ?? 0 ?>",

            judul: $('#judul').val(),
        };

        $.ajax({
            url: '<?= base_url("rm/rm0Sbar/simpanJudul") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                location.href = "<?= base_url('rm/rm0Sbar/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>/" + data.id;
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }

    function resetForm() {
        $('#idEdit').val('');
        $('#petugas').val('');
        $('#dokter').val('');
        $('#waktu').val('');

        $('#s').val('');
        $('#b').val('');
        $('#a').val('');
        $('#r').val('');


        $("#tombolPerbarui").hide();
        $("#tombolTambahSbar").show();
    }

    function lihat(id) {
        $('#tombolVerif').hide();
        $.ajax({
            url: '<?= base_url() ?>rm/rm0Sbar/lihat',
            method: 'post',
            // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $('#idVerif').val(data.id);
                $('#dpetugas').html(data.petugas);
                $('#ddokter').html(data.dokter);
                $('#dwaktu').html(data.waktu);

                $('#ds').html(data.s);
                $('#db').html(data.b);
                $('#da').html(data.a);
                $('#dr').html(data.r);

                if (data.tglVerif) {
                    $('#dtglVerif').html(data.tglVerif);
                } else {
                    $('#dtglVerif').html('<span class="badge-estetik bg-vibrant-red">Belum</span>');
                    if (data.dokter === '<?= session()->get('nama') ?>') {
                        $('#tombolVerif').show();
                    }
                }

                $("#modalLihat").modal("show");
            }
        });
    }

    function verif() {
        var id = $("#idVerif").val();
        $.ajax({
            url: '<?= base_url() ?>rm/rm0Sbar/verif',
            method: 'post',
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#modalLihat").modal("hide");
                muatData();
            }
        });
    }

    function tryEdit(id) {
        $.ajax({
            url: '<?= base_url() ?>rm/rm0Sbar/lihat',
            method: 'post',
            // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
            data: "id=" + id,
            dataType: 'json',
            success: function(data) {
                $("#tombolPerbarui").show();
                $("#tombolTambahSbar").hide();

                $('#idEdit').val(data.id);
                $('#petugas').val(data.petugas);
                $('#dokter').val(data.dokter);
                $('#waktu').val(data.waktu);

                $('#s').val(data.s);
                $('#b').val(data.b);
                $('#a').val(data.a);
                $('#r').val(data.r);
                $('#s').focus()
            }
        });
    }


    <?php if ($data->rm0Sbar) : ?>
        muatData()

        function muatData() {
            $("#tombolPerbarui").hide();
            $.ajax({
                url: '<?= base_url() ?>rm/rm0Sbar/muatData',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "idSbar=<?= $data->rm0Sbar['id'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {
                    // 1. Cek jika DataTable sudah ada, jika ya, destroy dulu
                    if ($.fn.DataTable.isDataTable('#tabelSbar')) {
                        $('#tabelSbar').DataTable().destroy();
                    }

                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + data[i].waktu + '</td>';
                        hasil += '<td>' + data[i].petugas + '</td>';
                        hasil += '<td>' + data[i].dokter + '</td>';
                        hasil += '<td>';
                        if (data[i].tglVerif) {
                            hasil += data[i].tglVerif;
                        } else {
                            hasil += '<span class="badge-estetik bg-vibrant-red">Belum</span>'
                        }
                        hasil += '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple" onclick="lihat(' + data[i].id + ')"><i class="fas fa-eye"></i> lihat</a> ';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue" onclick="tryEdit(' + data[i].id + ')"><i class="fas fa-pen"></i> Edit</a> ';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="tryHapus(' + data[i].id + ')"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#dataTabelSbar").html(hasil);

                    // 3. Inisialisasi ulang DataTable setelah HTML selesai dimuat
                    $('#tabelSbar').DataTable({
                        // Anda bisa menambahkan konfigurasi DataTable di sini jika diperlukan, contoh:
                        "language": {
                            "sEmptyTable": "Tidak ada data yang tersedia pada tabel ini",
                            "sProcessing": "Sedang memproses...",
                            "sLengthMenu": "Tampilkan _MENU_ entri",
                            "sZeroRecords": "Tidak ditemukan data yang sesuai",
                            "sInfo": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
                            "sInfoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
                            "sInfoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
                            "sInfoPostFix": "",
                            "sSearch": "Cari:",
                            "sUrl": "",
                            "paginate": { // <-- Di sini diubah dari oPaginate menjadi paginate
                                "sFirst": "Pertama",
                                "sPrevious": "Sebelumnya",
                                "sNext": "Selanjutnya",
                                "sLast": "Terakhir"
                            }
                        },
                        "responsive": true,
                        "order": [
                            [0, "desc"]
                        ] // Mengurutkan berdasarkan kolom waktu terbaru
                    });
                }
            });
        }

        function tryHapus(id) {
            $("#modalHapus").modal("show");
            $("#idHapus").val(id);
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var id = $("#idHapus").val();

            console.log(id)

            $.ajax({
                url: '<?= base_url() ?>rm/rm0Sbar/hapus',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    $("#modalHapus").modal("hide");
                    muatData();
                }
            });
        }

        function tryHapusJudul() {
            $("#modalHapusJudul").modal("show");
            $("#namaPasienHapusJudul").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapusJudul").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapusJudul() {
            var id = "<?= $data->rm0Sbar['id'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm0Sbar/hapusJudul',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        $(document).ready(function() {
            if (window.location.hash === '#modalHapusJudul') {
                tryHapusJudul();
            }
        });

    <?php endif; ?>
</script>
<?php $this->endSection() ?>