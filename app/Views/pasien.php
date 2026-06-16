<?php

/** @var object $data */
?>
<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row m-3">
    <div class="col-md-12 p-1">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Data Pasien</h4>
            </div>
            <div class="card-body">
                <table class="table" id="tabelPasien">
                    <thead>
                        <tr>
                            <td>No.</td>
                            <td>No. Rm</td>
                            <td>Nama</td>
                            <td>NIK</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < count($data->pasien); $i++) {
                            echo "<tr>";
                            echo "<td>" . ($i + 1) . "</td>";
                            echo "<td>" . $data->pasien[$i]["no_rkm_medis"] . "</td>";
                            echo "<td>" . $data->pasien[$i]["nm_pasien"] . "</td>";
                            echo "<td>" . $data->pasien[$i]["no_ktp"] . "</td>";
                            echo '<td> <button class="btn-estetik btn-sm-estetik bg-vibrant-purple" onclick="lihatPj(\'' . esc($data->pasien[$i]["no_rkm_medis"], 'js') . '\', \'' . esc($data->pasien[$i]["nm_pasien"], 'js') . '\', \'' . esc($data->pasien[$i]["namakeluarga"], 'js') . '\', \'' . esc($data->pasien[$i]["alamatpj"] . ', Desa/kel. ' . $data->pasien[$i]["kelurahanpj"] . ', Kec. ' . $data->pasien[$i]["kecamatanpj"] . ', ' . $data->pasien[$i]["kabupatenpj"], 'js') . '\')"><i class="fas fa-search"></i> Lihat PJ</button></td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalPj" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Lihat Penanggung Jawab Pasien</h5>
            </div>
            <div class="modal-body">
                Data Penanggung Jawab Pasien <b id="namaPasien"></b> <br> no RM : <b id="noRm"></b> <br>
                Data Penanggung Jawab <b id="status"></b> ada.
                <br>
                <hr>
                <form>
                    <div class="mb-3">
                        <label for="namaPj" class="form-label fw-bold">Nama PJ</label>
                        <input type="text" id="namaPj" class="form-control" placeholder="Masukkan nama lengkap penanggung jawab">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="nik" class="form-label fw-bold">NIK</label>
                            <input type="text" id="nikPj" class="form-control" placeholder="Masukkan 16 digit NIK">
                        </div>
                        <div class="col-md-6">
                            <label for="jkPj" class="form-label fw-bold">Jenis Kelamin</label>
                            <select name="jkPj" id="jkPj" class="form-select">
                                <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="tempatLahirPj" class="form-label fw-bold">Tempat Lahir</label>
                            <input type="text" id="tempatLahirPj" class="form-control" placeholder="Tempat lahir Penanggung Jawab">
                        </div>
                        <div class="col-md-6">
                            <label for="tglLahirPj" class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="date" id="tglLahirPj" class="form-control">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamatPj" class="form-label fw-bold">Alamat Lengkap (Jalan, Desa, Kec, Kab)</label>
                        <textarea name="alamatPj" id="alamatPj" class="form-control" rows="3" placeholder="Contoh: Jl. Raya Bilaporah No. 45, RT 02/RW 01, Ds. Bilaporah, Kec. Bangkalan..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpanPj()">
                    <i class="fa fa-floppy-o me-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tabelPasien').DataTable({
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
        "retrieve": true
    });

    function lihatPj(noRm, namaPasien, namaPj, alamatPj) {
        resetIsian();
        $("#namaPasien").html(namaPasien);
        $("#noRm").html(noRm);

        $("#namaPj").val(namaPj);
        $("#alamatPj").val(alamatPj);

        $("#modalPj").modal("show");

        $.ajax({
            url: '<?= base_url() ?>pasien/lihatPj',
            method: 'post',
            data: 'noRm=' + noRm,
            dataType: 'json',
            success: function(data) {
                if (data) {
                    $("#status").html('<span class = "badge-estetik bg-vibrant-teal"> Sudah </span>');

                    $("#namaPj").val(data.namaPj);
                    $("#nikPj").val(data.nikPj);
                    $("#tglLahirPj").val(data.tglLahirPj);
                    $("#tempatLahirPj").val(data.tempatLahirPj);
                    $("#jkPj").val(data.jkPj);
                    $("#alamatPj").val(data.alamatPj);
                } else {
                    $("#status").html('<span class = "badge-estetik bg-vibrant-red"> Belum </span>');
                }
            }
        });
    }

    function resetIsian() {
        $("#namaPj").val("");
        $("#nikPj").val("");
        $("#tglLahirPj").val("");
        $("#tempatLahirPj").val("");
        $("#jkPj").val("");
        $("#alamatPj").val("");
        $("#noRm").html("");
    }

    function simpanPj() {
        namaPj = $("#namaPj").val();
        nikPj = $("#nikPj").val();
        tglLahirPj = $("#tglLahirPj").val();
        tempatLahirPj = $("#tempatLahirPj").val();
        jkPj = $("#jkPj").val();
        alamatPj = $("#alamatPj").val();
        noRm = $("#noRm").html();

        if (namaPj == "") {
            $("#namaPj").focus()
        } else if (nikPj == "") {
            $("#nikPj").focus();
        } else if (tglLahirPj == "") {
            $("#tglLahirPj").focus();
        } else if (tempatLahirPj == "") {
            $("#tempatLahirPj").focus();
        } else if (jkPj != 'L' && jkPj != 'P') {
            $("#jkPj").focus();
        } else if (alamatPj == "") {
            $("#alamatPj").focus();
        } else {
            $.ajax({
                url: '<?= base_url() ?>pasien/simpanPj',
                method: 'post',
                data: 'noRm=' + noRm + '&namaPj=' + namaPj + '&nikPj=' + nikPj + '&tglLahirPj=' + tglLahirPj + '&tempatLahirPj=' + tempatLahirPj + '&jkPj=' + jkPj + '&alamatPj=' + alamatPj,
                dataType: 'json',
                success: function(data) {
                    resetIsian();

                    $("#modalPj").modal("hide");
                }
            });
        }
    }
</script>
<?php $this->endSection() ?>