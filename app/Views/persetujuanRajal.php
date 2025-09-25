<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h1 class="mt-4">Persetujuan Rawat Jalan</h1>
    <div class="card mb-4">
        <div class="card-header">
            <button class="btn btn-info" onclick="tryTambah()">Tambah Pasien</button>
            <i class="fas fa-table me-1"></i>
            Data pasien
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <table class="table table-striped table-responsive-lg" id="tabelPasien">
                <thead>
                    <tr>
                        <th>No. RM</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="tabelDataPasien">
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah Pasien-->
<div class="modal fade modal-xl" id="modalTambahPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah persetujuan rawat jalan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-2">
                    <b class="h6"><i class="fa-regular fa-circle-question"></i> Petunjuk : </b> <small><mark><i> Cari pasien yang akan ditambahkan surat <b class="text-info">Skor Poedji Rochjati</b>, lalu klik tombol <i class="fas fa-plus"></i> di ujung kanan.</i></mark></small>
                </div>
                <hr>
                <div class="card-body" style="overflow-y: auto;">
                    <table class="table table-striped table-responsive" id="tabelTambahPasien">
                        <thead>
                            <tr>
                                <th>No. RM</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tgl Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody id="tabelDataTambahPasien">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah Persetujuan rajal-->
<div class="modal fade modal-xl" id="modalTambahPersRajal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Persetujuan Rawat Jalan untuk pasien : <b id="namaPasienJudul"></b></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="alert alert-info">
                                <div class="row mb-1">
                                    <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                    <hr>
                                </div>
                                <input type="hidden" id="noRmTambahPersRajal">
                                <input type="hidden" id="namaPasien">
                                <input type="hidden" id="alamatPasien">
                                <input type="hidden" id="noTelpPasien">
                                <mark>Yang bertanda tangan di bawah ini :</mark>
                                <div class="row mb-3 mt-2">
                                    <div class="col-6"><input type="text" class="form-control" id="namaWali" placeholder="Nama"></div>
                                    <div class="col-6"><input type="text" maxlength="13" class="form-control" id="noTelp" placeholder="Nomor HP"></div>
                                </div>
                                <div class="mb-1">
                                    <input type="text" class="form-control" id="alamat" placeholder="Alamat">
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="sebagai" class="form-label">Beritindak sebagai :</label>
                                        <select id="sebagai" class="form-select">
                                            <option value="Suami">Suami</option>
                                            <option value="Istri">Istri</option>
                                            <option value="Anak">Anak</option>
                                            <option value="Ayah">Ayah</option>
                                            <option value="Ibu">Ibu</option>
                                            <option value="Wali">Wali</option>
                                            <option value="Saya sendiri">Diri saya sendiri</option>
                                        </select>
                                    </div>
                                    <div class="col-6">
                                        <div class="pt-5 form-check">
                                            <input type="checkbox" class="form-check-input" id="samaDgPasien" onchange="setSamadgPasien()">
                                            <label class="form-check-label" for="samaDgPasien">Sama dengan pasien</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-info">
                                <div class="row mb-1">
                                    <div class="col-12 text-center">Petugas dan saksi :</div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="petugas" class="form-label">Petugas :</label>
                                            <input type="text" class="form-control" id="petugas" value="<?= session()->get('nama') ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="saksi" class="form-label">Saksi :</label>
                                            <input type="text" class="form-control" id="saksi" placeholder="Nama saksi">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-6">

                            <div class="alert alert-info" role="alert">
                                <div class="row mb-1">
                                    <div class="col-12 text-center">Pelepasan Informasi Medis :</div>
                                    <hr>
                                </div>
                                <div class="mb-2">
                                    <small>Setuju untuk melepaskan rahasia kedokteran terkait dengan kondisi kesehatan, tindakan, dan pengobatan saya di
                                        Rumah Sakit Ibu dan Anak Aisyiyah kepada :
                                        <ol type="a">
                                            <li>
                                                Dokter dan tenaga kesehatan lain yang memberikan perawatan dan pengobatan kepada saya;
                                            </li>
                                            <li>
                                                Perusahaan Asuransi Kesehatan atau perusahaan lainnya yang menjamin pembiayaan saya.
                                            </li>
                                            <li>
                                                Lembaga pemerintah lain yang berwenang.
                                            </li>
                                            <li>
                                                Anggota keluarga saya, sebutkan : <br>
                                                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub>
                                            </li>
                                        </ol>
                                    </small>
                                    <textarea type="text" class="form-control" id="namaKeluarga" placeholder="Ketik nama keluarga. dipisah koma apabila lebih dari satu nama."></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="pembayaran" class="form-label">Pembayaran :</label>
                                    <select id="pembayaran" class="form-select">
                                        <option value="Pasien Umum">Pasien Umum</option>
                                        <option value="Pasien BPJS Kesehatan">Pasien BPJS Kesehatan</option>
                                        <option value="Pasien Asuransi Lain">Pasien Asuransi Lain</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info" onclick="tambahPasien()">Proses</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit data Wali pasien atas nama : <b id="namaPasienJudulEdit"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="noTelpEdit" class="form-label">No telp :</label>
                    <input type="text" class="form-control" id="noTelpEdit" placeholder="No Telpon">
                </div>
                <input type="hidden" id="noRmedit">
                <div class="mb-0">
                    <label for="namaKeluargaEdit" class="form-label">Anggota keluarga yang bisa melihat Rekam Medis :</label>
                    <textarea id="namaKeluargaEdit" class="form-control" placeholder="Ketik nama keluarga. dipisah koma apabila lebih dari satu nama."></textarea>
                </div>
                <sub class="alert alert-warning m-0 p-0"><b>Petunjuk : </b><i>dipisah koma (,) apabila lebih dari 1.</i></sub><br><br>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="edit()">Simpan</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="modalHapusPasien" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus persetujuan rawat jalan ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah anda yakin ingin menghapus Form Persetujuan Rawat Jalan pasien atas nama <b id="namaPasienHapus"></b> dengan no RM : <b id="noRmHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="hapusPasien()">Hapus</button>
            </div>
        </div>
    </div>
</div>

<script>
    muatData()
    muatTambahPasien()

    function muatData() {
        if ($.fn.DataTable.isDataTable('#tabelPasien')) {
            $('#tabelPasien').DataTable().destroy();
        }
        $.ajax({
            url: '<?= base_url() ?>persetujuanRajal/muatdatapasien',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr>" +
                        "<td>" + data[i].noRm + "</td>" +
                        "<td>" + data[i].no_ktp + "</td>" +
                        "<td>" + data[i].nm_pasien + "</td>" +
                        "<td>" + data[i].tgl_lahir + "</td>" +
                        "<td>" + data[i].alamat + "</td>" +
                        "<td>" + data[i].jk + "</td>" +
                        "<td>" + '<a class="btn btn-info btn-sm" href="persetujuanRajal/printpersrajal/' + data[i].noRm + '" target="_blank" ><i class="fas fa-eye"></i></a> ' +
                        ' <button class="btn btn-info btn-sm" onclick="tryEdit(\'' + data[i].noRm + '\',\'' + data[i].keluarga + '\',\'' + data[i].nm_pasien + '\', \'' + data[i].noHp + '\')"><i class="fa fa-pencil"></i></button> ' +
                        ' <button class="btn btn-secondary btn-sm"><i class="fas fa-trash"  onclick="tryHapus(\'' + data[i].noRm + '\',\'' + data[i].nm_pasien + '\')"></i></button> ' +
                        "</td></tr>"
                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="6">Data Masih kosong :)</td>'
                }

                $("#tabelDataPasien").html(tabel)
                $("#tabelPasien").DataTable()

            }
        });
    }

    function tryTambah() {
        $("#modalTambahPasien").modal("show");
    }

    function muatTambahPasien() {
        if ($.fn.DataTable.isDataTable('#tabelTambahPasien')) {
            $('#tabelTambahPasien').DataTable().destroy();
        }
        $.ajax({
            url: '<?= base_url() ?>persetujuanRajal/muattambahpasien',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr>" +
                        "<td>" + data[i].no_rkm_medis + "</td>" +
                        "<td>" + data[i].no_ktp + "</td>" +
                        "<td>" + data[i].nm_pasien + "</td>" +
                        "<td>" + data[i].tgl_lahir + "</td>" +
                        "<td>" + data[i].alamat + "</td>" +
                        "<td>" + data[i].jk + "</td>" +
                        "<td>" + '<button class="btn btn-info btn-sm" onclick="tryTambahPasien(\'' + data[i].no_rkm_medis + '\', \'' + data[i].nm_pasien + '\', \'' + data[i].alamat + '\', \'' + data[i].no_tlp + '\')"><i class="fas fa-plus"></i></button> ' +
                        "</td></tr>"
                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="6">Data Masih kosong :)</td>'
                }

                $("#tabelDataTambahPasien").html(tabel)
                $("#tabelTambahPasien").DataTable({
                    responsive: true
                })

            }
        });
    }

    function tryTambahPasien(noRm, namaPasien, alamatPasien, noTelpPasien) {
        $("#modalTambahPasien").modal("hide");

        $("#namaPasienJudul").html(namaPasien);

        $("#noRmTambahPersRajal").val(noRm);
        $("#namaPasien").val(namaPasien);
        $("#alamatPasien").val(alamatPasien);
        $("#noTelpPasien").val(noTelpPasien);
        $("#modalTambahPersRajal").modal("show");
    }

    function setSamadgPasien() {
        if ($('#samaDgPasien').is(':checked')) {
            $("#namaWali").val($("#namaPasien").val())
            $("#alamat").val($("#alamatPasien").val())
            $("#noTelp").val($("#noTelpPasien").val())
            $("#sebagai").val("Saya sendiri")

            $("#namaWali").prop('disabled', true);
            $("#alamat").prop('disabled', true);
            $("#noTelp").prop('disabled', true);
            $("#sebagai").prop('disabled', true);
        } else {
            $("#namaWali").val("")
            $("#alamat").val("")
            $("#noTelp").val("")
            $("#sebagai").val("Suami")

            $("#namaWali").prop('disabled', false);
            $("#alamat").prop('disabled', false);
            $("#noTelp").prop('disabled', false);
            $("#sebagai").prop('disabled', false);
        }
    }

    function tambahPasien() {
        var noRm = $("#noRmTambahPersRajal").val()
        var namaWali = $("#namaWali").val()
        var noTelp = $("#noTelp").val()
        var alamat = $("#alamat").val()
        var sebagai = $("#sebagai").val()
        var petugas = $("#petugas").val()
        var saksi = $("#saksi").val()
        var namaKeluarga = $("#namaKeluarga").val()
        var pembayaran = $("#pembayaran").val()

        if (namaWali.replace(/\s+/g, "-") == "") {
            $("#namaWali").focus()
        } else if (noTelp.replace(/\s+/g, "-") == "") {
            $("#noTelp").focus()
        } else if (alamat.replace(/\s+/g, "-") == "") {
            $("#alamat").focus()
        } else if (saksi.replace(/\s+/g, "-") == "") {
            $("#saksi").focus()
        } else if (namaKeluarga.replace(/\s+/g, "-") == "") {
            $("#namaKeluarga").focus()
        } else {
            $.ajax({
                url: '<?= base_url() ?>persetujuanRajal/tambahPasien',
                method: 'post',
                data: "namaWali=" + namaWali + "&noRm=" + noRm + "&noTelp=" + noTelp + "&alamat=" + alamat + "&sebagai=" + sebagai + "&petugas=" + petugas + "&saksi=" + saksi + "&namaKeluarga=" + namaKeluarga + "&pembayaran=" + pembayaran,
                dataType: 'json',
                success: function(data) {
                    $("#noRmTambahPersRajal").val("")
                    $("#namaWali").val("")
                    $("#noTelp").val("")
                    $("#alamat").val("")
                    $("#saksi").val("")
                    $("#namaKeluarga").val("")

                    window.open("persetujuanRajal/printpersrajal/" + noRm, "_blank");

                    muatData()
                    $("#modalTambahPersRajal").modal("hide");
                }
            });
        }
    }

    function tryEdit(noRm, namaKeluarga, namaPasien, noTelp) {
        $("#namaPasienJudulEdit").html(namaPasien);

        $("#noRmedit").val(noRm);
        $("#namaKeluargaEdit").val(namaKeluarga);
        $("#noTelpEdit").val(noTelp);
        $("#modalEdit").modal("show");
    }

    function edit() {
        var noRm = $("#noRmedit").val()
        var namaKeluarga = $("#namaKeluargaEdit").val()
        var noTelp = $("#noTelpEdit").val()

        if (namaKeluarga.replace(/\s+/g, "-") == "") {
            $("#namaWali").focus()
        } else {
            $.ajax({
                url: '<?= base_url() ?>persetujuanRajal/editpasien',
                method: 'post',
                data: "namaKeluarga=" + namaKeluarga + "&noRm=" + noRm + "&noTelp=" + noTelp,
                dataType: 'json',
                success: function(data) {
                    $("#noRmedit").val("")
                    $("#namaKeluargaEdit").val("")
                    $("#noTelpEdit").val("")

                    muatData()
                    $("#modalEdit").modal("hide");
                }
            });
        }
    }

    function tryHapus(noRm, nama) {
        $("#modalHapusPasien").modal("show");
        $("#namaPasienHapus").html(nama)
        $("#noRmHapus").html(noRm)
    }

    function hapusPasien() {
        var noRm = $("#noRmHapus").html()

        $.ajax({
            url: '<?= base_url() ?>persetujuanRajal/hapuspasien',
            method: 'post',
            data: "noRm=" + noRm,
            dataType: 'json',
            success: function(data) {
                $("#noRmHapus").html("")
                $("#modalHapusPasien").modal("hide");
                muatData()
            }
        });
    }
</script>
<?php $this->endSection() ?>