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
                <h5 class="text-uppercase">SERAH TERIMA PEMBERIAN UNIT DOSE DISPENSING SYSTEMS (UDDS)</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm20bUdds) : ?>
                <div class="row mb-2">
                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pasien :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Ruang</td>
                                    <td>: <?= $data->rm20bUdds["ruang"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Kamar</td>
                                    <td>: <?= $data->rm20bUdds["kamar"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Alergi</td>
                                    <td>: <?= $data->rm20bUdds["alergi"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa</td>
                                    <td>: <?= $data->rm20bUdds["diagnosa"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Data Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Dokter</td>
                                    <td>: <?= $data->rm20bUdds["dokter"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Apoteker</td>
                                    <td>: <?= $data->rm20bUdds["apoteker"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Pemberi Obat Oral</td>
                                    <td>: <?= $data->rm20bUdds["pemberiObatOral"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Pemberi Obat</td>
                                    <td>: <?= $data->rm20bUdds["pemberiObat"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm20bUdds/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm20bUdds['id']) ?>" target="_blank">
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
                <br>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="alert alert-info">
                            <input type="hidden" id="idEdit" name="idEdit">
                            <div class="row">
                                <div class="col-sm-12 border border-info rounded p-3">
                                    <label class="form-label d-block fw-bold mb-1" style="font-size: 0.9rem;">Jenis Obat *</label>
                                    <div class="btn-group btn-group-sm w-100" role="group">
                                        <input type="radio" class="btn-check" name="jenisObat" id="oral" value="oral" checked>
                                        <label class="btn btn-outline-info py-1" for="oral">
                                            <i class="fa-regular fa-face-surprise"></i> Oral
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="injeksi" value="injeksi">
                                        <label class="btn btn-outline-info py-1" for="injeksi">
                                            <i class="fa-solid fa-syringe"></i> Injeksi
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="infus" value="infus">
                                        <label class="btn btn-outline-info py-1" for="infus">
                                            <i class="fas fa-bed fa-sm me-1"></i> Infus
                                        </label>

                                        <input type="radio" class="btn-check" name="jenisObat" id="lain" value="lain">
                                        <label class="btn btn-outline-info py-1" for="lain">
                                            <i class="fas fa-clinic-medical fa-sm me-1"></i> Lain-lain
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
                                <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
                                <div class="col-sm-12">
                                    <label class="form-label fw-bold mb-0">Nama Obat</label>
                                    <select id="namaObat" name="namaObat" placeholder="Cari nama obat..." required autocomplete="off">
                                        <option value=""></option>
                                        <?php foreach ($data->dataObat as $obat) : ?>
                                            <option value="<?= $obat['nama_brng'] ?>"><?= $obat['nama_brng']  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <script>
                                    var tomSelectObat = new TomSelect("#namaObat", {
                                        create: false, // Menutup akses untuk menambah data baru di luar list
                                        sortField: {
                                            field: "text",
                                            direction: "asc"
                                        },
                                        maxOptions: 10,

                                        // Bahasa Indonesia tetap dipasang untuk menangani jika pencarian kosong
                                        render: {
                                            no_results: function(data, escape) {
                                                return '<div class="no-results" style="padding: 6px 10px; color: #35cedc;">Obat tidak ditemukan.</div>';
                                            }
                                        }
                                    });
                                </script>
                            </div>
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Dosis :</label>
                                    <input type="text" class="form-control form-control-sm border-info" name="dosis" id="dosis" value="<?= $data->rm20bUdds['dosis'] ?? '' ?>">
                                </div>
                                <div class="col-sm-6">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Jumlah :</label>
                                    <input type="text" class="form-control form-control-sm border-info" name="jumlah" id="jumlah" value="<?= $data->rm20bUdds['jumlah'] ?? '' ?>">
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 text-center">

                                    <button class="btn btn-estetik btn-lihat" id="tombolPerbarui" onclick="simpanObat('perbarui')">
                                        <i class="fas fa-save me-1"></i> Perbarui
                                    </button>

                                    <button class="btn btn-estetik btn-simpan" id="tombolTambahSbar" onclick="simpanObat('tambah')">
                                        <i class="fas fa-save me-1"></i>
                                        <div id="tomboTambah">Tambah</div>
                                    </button>

                                    <button class="btn btn-estetik btn-hapus" onclick="resetFormObat()">
                                        <i class="fas fa-cancel me-1"></i> Batal
                                    </button>


                                    <button data-bs-toggle="modal" data-bs-target="#modalOral" class="btn-estetik btn-sm-estetik bg-vibrant-gray">Oral</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="alert alert-info">
                            <table class="table table-sm table-striped" id="tabelObat">
                                <thead>
                                    <th>Jenis</th>
                                    <th>Nama</th>
                                    <th>Dosis</th>
                                    <th>Jumlah</th>
                                    <th></th>
                                </thead>
                                <tbody id="dataTabelObat">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm20bUdds.php") ?>

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

<div class="modal fade" id="modalOral" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Paket obat oral.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b>klik Buat. maka, paket obat oral akan ditambah secara otomatis.
                </sub><br><br>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button type="button" class="btn btn-estetik btn-simpan" onclick="tambahPaket('oral')"><i class="fas fa-plus me-1"></i> Buat</button>
            </div>
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
                <?= $this->include("rm/partials/formRm20bUdds.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm20bUdds['id'] ?? '' ?>)">
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

<!-- Modal hapus obat-->
<div class="modal fade" id="modalHapusObat" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Data ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idHapus" name="idHapus">
                Apakah anda yakin ingin menghapus Obat : <b id="namaObatHapus"></b> ? <br>
                <div class="alert alert-warning p-1 mt-2"> <i class="fa-solid fa-triangle-exclamation"></i> Peringatan ! Data tidak dapat dikembalikan.</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-hapus" onclick="hapusObat()">
                    <i class="fas fa-trash-alt me-1"></i> Hapus
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal data-->
<div class="modal modal-lg fade  modal-dialog-scrollable" id="modalJam" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Data Obat : <b id="judulObat"></b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row mb-2">
                                <div class="col-12">
                                    <input type="hidden" id="idObatJam" name="idObatJam">
                                    <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Tanggal :</label>
                                    <input type="date" id="tgl" name="tgl" class="form-control">
                                </div>
                            </div>
                            <div class=" border border-info rounded p-2">
                                <label class=" form-label fw-bold mb-0">Jam :</label>
                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pagi :</label>
                                        <input type="time" id="pagi" name="pagi" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Siang :</label>
                                        <input type="time" id="siang" name="siang" class="form-control form-control-sm">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Sore :</label>
                                        <input type="time" id="sore" name="sore" class="form-control form-control-sm">
                                    </div>
                                    <div class="col-6">
                                        <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Malam :</label>
                                        <input type="time" id="malam" name="malam" class="form-control form-control-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="alert alert-info mb-1">
                            <div class="mb-1">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Supervisi Apoterker :</label>
                                <select name="apoteker" id="apoteker" class="form-select form-select-sm">
                                    <option value="">-- Pilih Petugas --</option>
                                    <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                        echo '<option value="' . $data->petugas[$i]["nama"] . '">' . $data->petugas[$i]["nama"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div class="mb-1">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pembari Obat Oral :</label>
                                <select name="pemberiObatOral" id="pemberiObatOral" class="form-select form-select-sm">
                                    <option value="">-- Pilih Petugas --</option>
                                    <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                        echo '<option value="' . $data->petugas[$i]["nama"] . '" >' . $data->petugas[$i]["nama"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                            <div>
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pembari Obat :</label>
                                <select name="pemberiObat" id="pemberiObat" class="form-select form-select-sm">
                                    <option value="">-- Pilih Petugas --</option>
                                    <?php for ($i = 0; $i < count($data->petugas); $i++) {
                                        echo '<option value="' . $data->petugas[$i]["nama"] . '" >' . $data->petugas[$i]["nama"] . '</option>';
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <button class="btn btn-estetik btn-simpan" onclick="simpanJam('tambah')">
                            <i class="fa fa-plus"></i> Tambah
                        </button>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-12">
                        <div class="alert alert-info">
                            Data Tanggal dan Jam
                            <hr>

                            <table class="table table-sm">
                                <thead>
                                    <th>Tanggal</th>
                                    <th>Pagi</th>
                                    <th>Siang</th>
                                    <th>Sore</th>
                                    <th>Malam</th>
                                    <th>Apotker</th>
                                    <th>Pemberi Obat Oral</th>
                                    <th>Pemberi Obat</th>
                                    <th>Hapus</th>
                                </thead>
                                <tbody id="dataTabelJam">

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-close me-1"></i> Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function simpan(tujuanSimpan) {
        // Inisialisasi variabel untuk menampung data berbentuk object/array asosiatif
        var data = {
            // Data Pasien
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            ruang: $('#ruang').val(),
            kamar: $('#kamar').val(),
            alergi: $('#alergi').val(),

            // Data Petugas
            dokter: $('#dokter').val(),
            diagnosa: $('#diagnosa').val()
        };

        $.ajax({
            url: '<?= base_url("rm/rm20bUdds/simpan") ?>',
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


    <?php if ($data->rm20bUdds) : ?>
        muatObat()

        function muatObat() {
            $("#tombolPerbarui").hide();
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/muatObat',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "noRawat=<?= $data->rm20bUdds['noRawat'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {
                    // 1. Cek jika DataTable sudah ada, jika ya, destroy dulu
                    if ($.fn.DataTable.isDataTable('#tabelObat')) {
                        $('#tabelObat').DataTable().destroy();
                    }

                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>';
                        if (data[i].jenis_obat == 'oral') {
                            hasil += '<span class="badge-estetik bg-vibrant-blue">';
                        } else if (data[i].jenis_obat == 'injeksi') {
                            hasil += '<span class="badge-estetik bg-vibrant-teal">';
                        } else if (data[i].jenis_obat == 'infus') {
                            hasil += '<span class="badge-estetik bg-vibrant-purple">';
                        } else {
                            hasil += '<span class="badge-estetik bg-vibrant-red">';
                        }
                        hasil += data[i].jenis_obat
                        hasil += '</td>';
                        hasil += '<td>' + data[i].nama_obat + '</td>';
                        hasil += '<td>' + data[i].dosis + '</td>';
                        hasil += '<td>' + data[i].jumlah + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple" onclick="lihatJam(' + data[i].id + ', `' + data[i].nama_obat + '`)"><i class="fas fa-clock"></i> Jam</a> ';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue" onclick="tryEditObat(' + data[i].id + ')"><i class="fas fa-pen"></i> Edit</a> ';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="tryHapusObat(' + data[i].id + ', `' + data[i].nama_obat + '`)"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#dataTabelObat").html(hasil);

                    // 3. Inisialisasi ulang DataTable setelah HTML selesai dimuat
                    $('#tabelObat').DataTable({
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

        function muatJam(idObat) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/muatJam',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "idObat=" + idObat,
                dataType: 'json',
                success: function(data) {
                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + (data[i].tanggal ? data[i].tanggal.split('-').reverse().join('-') : '-') + '</td>';
                        hasil += `<td>${data[i].pagi ? data[i].pagi.slice(0, 5) : '-'}</td>`;
                        hasil += `<td>${data[i].siang ? data[i].siang.slice(0, 5) : '-'}</td>`;
                        hasil += `<td>${data[i].sore ? data[i].sore.slice(0, 5) : '-'}</td>`;
                        hasil += `<td>${data[i].malam ? data[i].malam.slice(0, 5) : '-'}</td>`;
                        hasil += `<td>${data[i].apoteker ?? '-'}</td>`;
                        hasil += `<td>${data[i].pemberiObatOral ?? '-'}</td>`;
                        hasil += `<td>${data[i].pemberiObat ?? '-'}</td>`;
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="hapusJam(' + data[i].id + ',' + data[i].idObat + ')"><i class="fas fa-trash-alt"></i></a>';
                        hasil += '</td>';
                        hasil += '</tr>';

                    }
                    if (data.length < 1) {
                        hasil += '<tr><td colspan="9" class="text-center">Data Kosong.</td></tr>';
                    }

                    $("#dataTabelJam").html(hasil);
                }
            });
        }

        function lihatJam(id, namaObat) {
            $("#judulObat").html(namaObat);
            $("#idObatJam").val(id);
            muatJam(id);
            $("#modalJam").modal('show');

        }

        function simpanJam(tujuanSimpan) {
            let data = {
                tujuanSimpan: tujuanSimpan,
                idObat: $('#idObatJam').val(),
                noRawat: "<?= $data->pasien['no_rawat'] ?>",

                apoteker: $('#apoteker').val(),
                pemberiObatOral: $('#pemberiObatOral').val(),
                pemberiObat: $('#pemberiObat').val(),

                tanggal: $('#tgl').val(),
                jam: {
                    pagi: $('#pagi').val(),
                    siang: $('#siang').val(),
                    sore: $('#sore').val(),
                    malam: $('#malam').val()
                }
            };

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanJam") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    muatJam(data.id);

                    console.log(data)

                    $('#tgl').val('');
                    $('#pagi').val('');
                    $('#siang').val('');
                    $('#sore').val('');
                    $('#malam').val('');
                    $('#apoteker').val('');
                    $('#pemberiObatOral').val('');
                    $('#pemberiObat').val('');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });

        }

        function hapusJam(id, idObat) {
            console.log(id)
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapusJam',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    muatJam(idObat);
                }
            });
        }

        function simpanObat(tujuanSimpan) {
            let data = {
                tujuanSimpan: tujuanSimpan,
                noRawat: "<?= $data->pasien['no_rawat'] ?>",
                id: $('#idEdit').val(),
                jenis_obat: $('input[name="jenisObat"]:checked').val() || '',
                nama_obat: $('#namaObat').val(),
                dosis: $('#dosis').val(),
                jumlah: $('#jumlah').val(),
                tanggal: $('#tgl').val(),
                jam: {
                    pagi: $('#pagi').val(),
                    siang: $('#siang').val(),
                    sore: $('#sore').val(),
                    malam: $('#malam').val()
                }
            };

            $.ajax({
                url: '<?= base_url("rm/rm20bUdds/simpanObat") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    muatObat();
                    resetFormObat();
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });

        }

        function resetFormObat() {
            $('#idEdit').val('');

            // $('#' + data.jenis_obat).checked(true);
            $("input[name='namaObat']").val('');
            $('#dosis').val('')
            $('#jumlah').val('');
            // 2. Kosongkan TomSelect Nama Obat
            if (typeof tomSelectObat !== 'undefined') {
                tomSelectObat.clear(); // <-- Ini akan membuat select kembali kosong/placeholder
            }

            // 3. Kembalikan radio button ke default (oral)
            $('#oral').prop('checked', true);

            $("#tombolPerbarui").hide();
            $("#tombolTambahSbar").show();
        }

        function tryEditObat(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/lihat',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    console.log(data)
                    $("#tombolPerbarui").show();
                    $("#tombolTambahSbar").hide();

                    $('#idEdit').val(data.id);

                    $("input[name='jenisObat'][value='" + data.jenis_obat + "']").prop('checked', true).change();

                    // $('#' + data.jenis_obat).checked(true);
                    tomSelectObat.setValue(data.nama_obat);
                    $('#dosis').val(data.dosis)
                    $('#jumlah').val(data.jumlah);
                    $('#tgl').val(data.tanggal);
                    $('#pagi').val(data.pagi);
                    $('#siang').val(data.siang);
                    $('#sore').val(data.sore);
                    $('#malam').val(data.malam);

                    $('#dosis').focus()
                }
            });
        }

        function tryHapusObat(id, nama) {
            $("#modalHapusObat").modal("show");
            $("#idHapus").val(id);
            $("#namaObatHapus").html(nama)
        }

        function hapusObat() {
            var id = $("#idHapus").val();

            console.log(id)

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapusObat',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    $("#modalHapusObat").modal("hide");
                    muatObat();
                }
            });
        }

        function tambahPaket(jenis) {
            var noRawat = "<?= $data->pasien["no_rawat"] ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/tambahPaket',
                method: 'post',
                data: {
                    noRawat: noRawat,
                    jenis: jenis
                },
                dataType: 'json',
                success: function(response) {
                    muatObat();
                    $("#modalOral").modal("hide");

                },
                error: function(xhr, status, error) {
                    console.error("Gagal menyimpan data obat: " + error);
                }
            });
        }


        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm20bUdds['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm20bUdds/hapus',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
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