<?php

/** @var object $data */ ?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <div class="card mb-4">
        <div class="card-header">
            <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Tutup Form</a>
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" rm/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>#modalTambahForm">Daftar Fom</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5>REKONSILIASI DAN RIWAYAT PENGOBATAN PASIEN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>
            <h6 class="text-center">Form isian :</h6>
            <?= $this->include("rm/partials/formRekonsiliasiObatData") ?>
            <div class="text-center">
                <button class="btn btn-estetik btn-simpan" id="tombolTambah" onclick="simpanObat('tambah')">
                    <i class="fas fa-plus me-1"></i> Tambah
                </button>
                <button class="btn btn-estetik btn-edit" id="tombolEdit" onclick="simpanObat('edit')">
                    <i class="fa fa-pencil-square-o me-1"></i> Perbarui
                </button>
                <button class="btn btn-estetik btn-batal" id="tombolBatal" onclick="batal()">
                    <i class="fas fa-cancel me-1"></i> Batal
                </button>
                <a class="btn btn-estetik btn-lihat" href="<?= base_url(" rm/rekonsiliasiObat/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>"><i class="fas fa-check me-1"></i> Selesai</a>


                <button data-bs-toggle="modal" data-bs-target="#modalKo" class="btn-estetik btn-sm-estetik bg-vibrant-gray">Operasi</button>
                <button data-bs-toggle="modal" data-bs-target="#modalRr" class="btn-estetik btn-sm-estetik bg-vibrant-gray">Recovery</button>
            </div>
            <br><br>

            <h6 class="text-center">Data Obat :</h6>
            <div class="table-responsive mt-3">
                <table class="table table-bordered align-middle text-center" style="font-size: 0.85rem; border-color: #666;">
                    <thead class="table-light align-middle fw-bold">
                        <tr>
                            <th rowspan="3" style="width: 4%;">NO</th>
                            <th rowspan="3" style="width: 10%;">RUANGAN</th>
                            <th rowspan="3" style="width: 21%;">JENIS OBAT<br><small class="fw-normal text-muted" style="font-size: 0.75rem;">Nama Dagang/ Generik/<br>Herbal/ Fitofarmaka</small></th>
                            <th colspan="3">PEMBERIAN</th>
                            <th rowspan="3" style="width: 15%;">WAKTU PEMBERIAN TERAKHIR</th>
                            <th colspan="2">OBAT DIGUNAKAN SAAT DIRAWAT *</th>
                            <th colspan="2">OBAT DITERUSKAN KETIKA KELUAR RS *</th>
                            <th rowspan="3">Aksi</th>
                        </tr>
                        <tr>
                            <th rowspan="2" style="width: 12%;">DOSIS<br><small class="fw-normal text-muted" style="font-size: 0.75rem;">(mg, ml, microgram, unit)</small></th>
                            <th rowspan="2" style="width: 12%;">FREKWENSI</th>
                            <th rowspan="2" style="width: 12%;">CARA PEMBERIAN</th>
                        </tr>
                        <tr>
                            <th style="width: 5%;">YA</th>
                            <th style="width: 5%;">TIDAK</th>
                            <th style="width: 5%;">YA</th>
                            <th style="width: 5%;">TIDAK</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($data->rekonsiliasiObatData) && is_array($data->rekonsiliasiObatData)) : ?>
                            <?php
                            $noGlobal = 1;

                            // Konfigurasi kelompok: Nama badge, Warna badge, dan Warna latar belakang baris (kondisional)
                            $ruanganUrutan = [
                                'igd' => ['nama' => 'IGD', 'badge' => 'bg-danger text-white',      'row_bg' => '#fff5f5'], // Merah sangat muda
                                'ko'  => ['nama' => 'KO',  'badge' => 'bg-warning text-dark',     'row_bg' => '#fffdf0'], // Kuning sangat muda
                                'rr'  => ['nama' => 'RR',  'badge' => 'bg-info text-dark',        'row_bg' => '#f0faff'], // Biru sangat muda
                                'ri'  => ['nama' => 'RI',  'badge' => 'bg-success text-white',    'row_bg' => '#f5fdf6']  // Hijau sangat muda
                            ];

                            foreach ($ruanganUrutan as $keyRgn => $rgnConfig) :
                                foreach ($data->rekonsiliasiObatData as $obat) :
                                    if ($obat['ruangan'] == $keyRgn) :
                            ?>
                                        <tr style="background-color: <?= $rgnConfig['row_bg']; ?>;">
                                            <td><?= $noGlobal++; ?></td>
                                            <td>
                                                <span class="badge <?= $rgnConfig['badge']; ?> fw-bold" style="font-size: 0.75rem; padding: 4px 8px; min-width: 45px; display: inline-block;">
                                                    <?= $rgnConfig['nama']; ?>
                                                </span>
                                            </td>
                                            <td class="text-start fw-bold text-dark"><?= esc($obat['namaObat']); ?></td>
                                            <td><?= esc($obat['dosis']); ?></td>
                                            <td><?= esc($obat['frekuensi']); ?></td>
                                            <td><?= esc($obat['caraPemberian']); ?></td>
                                            <td>
                                                <?= !empty($obat['waktuTerakhir']) ? date('d-m-Y H:i', strtotime($obat['waktuTerakhir'])) . ' WIB' : '-'; ?>
                                            </td>
                                            <td><?= ($obat['dirawat'] == 'ya') ? '<i class="fas fa-check text-success"></i>' : ''; ?></td>
                                            <td><?= ($obat['dirawat'] == 'tidak') ? '<i class="fas fa-check text-danger"></i>' : ''; ?></td>
                                            <td><?= ($obat['keluar'] == 'ya') ? '<i class="fas fa-check text-success"></i>' : ''; ?></td>
                                            <td><?= ($obat['keluar'] == 'tidak') ? '<i class="fas fa-check text-danger"></i>' : ''; ?></td>
                                            <td>
                                                <button onclick="tryEdit(<?= $obat['id'] ?>)" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-pen"></i></button>
                                                <button onclick="tryHapus(<?= $obat['id'] ?>, '<?= $obat['namaObat'] ?>')" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i></button>
                                            </td>
                                        </tr>
                            <?php
                                    endif;
                                endforeach;
                            endforeach;
                            ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="12" class="text-center text-muted py-4 fw-bold">
                                    <i class="fas fa-info-circle me-1"></i> Belum ada data obat yang dimasukkan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal KO-->
<div class="modal fade" id="modalKo" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Paket obat Kamar Operasi.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b>Masukkan waktu pemberian terakhir. dan klik Buat. maka, paket obat kamar operasi akan ditambah secara otomatis.
                </sub><br><br>

                <input type="datetime-local" name="waktuko" id="waktuko" class="form-control w-50">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button type="button" class="btn btn-estetik btn-simpan" onclick="tambahPaket('ko')"><i class="fas fa-plus me-1"></i> Buat</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal RR-->
<div class="modal fade" id="modalRr" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Paket obat Ruang Recovery.</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <sub class="alert alert-warning m-1 p-0"><b>Petunjuk : </b>Masukkan waktu pemberian terakhir. dan klik Buat. maka, paket obat Ruang Recovery akan ditambah secara otomatis.
                </sub><br><br>

                <input type="datetime-local" name="wakturr" id="wakturr" class="form-control w-50">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button type="button" class="btn btn-estetik btn-simpan" onclick="tambahPaket('rr')"><i class="fas fa-plus me-1"></i> Buat</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal hapus-->
<div class="modal fade" id="modalHapus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Hapus Obat ?</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="idHapus">
                Apakah anda yakin ingin menghapus obat : <b id="namaObatHapus"></b> ? <br>
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

<script>
    $("#tombolEdit").hide();
    $("#tombolBatal").hide();

    function simpanObat(tujuan) {
        // Ambil nomor rawat langsung dari data pasien
        var noRawat = "<?= $data->pasien["no_rawat"] ?>";
        if (tujuan == 'edit') {
            var id = $('input[name="id"]').val();
        } else {
            var id = "<?= $data->rekonsiliasiObat["id"] ?>";
        }

        // Tangkap data dari form obat baru
        var namaObat = $('select[name="namaObat"]').val();
        var ruangan = $('input[name="ruangan"]:checked').val();
        var dosis = $('input[name="dosis"]').val();
        var frekuensi = $('input[name="frekuensi"]').val();
        var caraPemberian = $('input[name="caraPemberian"]').val();
        var waktuTerakhir = $('input[name="waktuTerakhir"]').val();
        var dirawat = $('input[name="dirawat"]:checked').val();
        var keluar = $('input[name="keluar"]:checked').val();

        if (!namaObat || namaObat.trim() == "") {
            tomSelectObat.focus();
        } else if (!ruangan) {
            $('input[name="ruangan"]:first').focus();
        } else if (dosis.trim() == "") {
            $('input[name="dosis"]').focus();
        } else if (frekuensi.trim() == "") {
            $('input[name="frekuensi"]').focus();
        } else if (caraPemberian.trim() == "") {
            $('input[name="caraPemberian"]').focus();
        } else if (!waktuTerakhir) {
            $('input[name="waktuTerakhir"]').focus();
        } else {
            // Jika validasi lolos, jalankan AJAX kirim data obat
            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/simpanObat',
                method: 'post',
                data: {
                    tujuan: tujuan,
                    id: id,
                    noRawat: noRawat,
                    namaObat: namaObat,
                    ruangan: ruangan,
                    dosis: dosis,
                    frekuensi: frekuensi,
                    caraPemberian: caraPemberian,
                    waktuTerakhir: waktuTerakhir, // Mengirim null/kosong jika tidak diisi
                    dirawat: dirawat,
                    keluar: keluar
                },
                dataType: 'json',
                success: function(response) {
                    // Berhasil disimpan, reload halaman untuk memperbarui daftar tabel rekam medis
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Gagal menyimpan data obat: " + error);
                }
            });
        }
    }

    function tambahPaket(kamar) {
        var noRawat = "<?= $data->pasien["no_rawat"] ?>";
        var id = "<?= $data->rekonsiliasiObat["id"] ?>";

        if (kamar == 'ko') {
            var waktu = $('#waktuko').val();
        } else {
            var waktu = $('#wakturr').val();
        }

        if (!waktu) {
            $('#waktu' + kamar).focus();
        } else {
            // Jika validasi lolos, jalankan AJAX kirim data obat
            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/tambahPaket',
                method: 'post',
                data: {
                    id: id,
                    noRawat: noRawat,
                    waktu: waktu,
                    kamar: kamar
                },
                dataType: 'json',
                success: function(response) {
                    // Berhasil disimpan, reload halaman untuk memperbarui daftar tabel rekam medis
                    location.reload();
                },
                error: function(xhr, status, error) {
                    console.error("Gagal menyimpan data obat: " + error);
                }
            });
        }
    }


    <?php if ($data->rekonsiliasiObatData) : ?>

        function tryEdit(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/muatDataObat/' + id,
                method: 'get',
                dataType: 'json',
                success: function(data) {
                    // 1. Set ID Primary Key ke hidden input
                    $("input[name='id']").val(data.id);

                    // 2. Set Nilai Input Text & Datetime-Local
                    $("input[name='namaObat']").val(data.namaObat);
                    $("input[name='dosis']").val(data.dosis);
                    $("input[name='frekuensi']").val(data.frekuensi);
                    $("input[name='caraPemberian']").val(data.caraPemberian);

                    // Format datetime-local membutuhkan format YYYY-MM-DDTHH:MM
                    if (data.waktuTerakhir) {
                        // Mengubah format dari DB (YYYY-MM-DD HH:MM:SS) menjadi (YYYY-MM-DDTHH:MM)
                        let formattedDateTime = data.waktuTerakhir.replace(' ', 'T').substring(0, 16);
                        $("input[name='waktuTerakhir']").val(formattedDateTime);
                    } else {
                        $("input[name='waktuTerakhir']").val('');
                    }

                    // 3. Set Value Radio Button "Ruangan" (igd / ko / rr / ri)
                    // Memicu trigger .change() agar style Bootstrap btn-check ikut berubah aktif
                    $("input[name='ruangan'][value='" + data.ruangan + "']").prop('checked', true).change();

                    // 4. Set Value Radio Button "Obat Digunakan Saat Dirawat" (ya / tidak)
                    $("input[name='dirawat'][value='" + data.dirawat + "']").prop('checked', true).change();

                    // 5. Set Value Radio Button "Obat Diteruskan Ketika Keluar RS" (ya / tidak)
                    $("input[name='keluar'][value='" + data.keluar + "']").prop('checked', true).change();

                    $("#tombolTambah").hide();
                    $("#tombolEdit").show();
                    $("#tombolBatal").show();

                    $("input[name='namaObat']").focus();
                },
                error: function(xhr, status, error) {
                    console.error("Gagal memuat data obat: ", error);
                    alert("Terjadi kesalahan. Gagal mengambil data obat.");
                }
            });
        }

        function batal() {
            $("#tombolTambah").show();
            $("#tombolEdit").hide();
            $("#tombolBatal").hide();

            $("input[name='id']").val('');
            $("input[name='namaObat']").val('');
            $("input[name='dosis']").val('');
            $("input[name='frekuensi']").val('');
            $("input[name='caraPemberian']").val('');
            $("input[name='waktuTerakhir']").val('');
        }

        function tryHapus(id, namaObat) {
            $("#idHapus").val(id)
            $("#namaObatHapus").html(namaObat)
            $("#modalHapus").modal("show");
        }

        function hapus() {
            var id = $("#idHapus").val()

            $.ajax({
                url: '<?= base_url() ?>rm/rekonsiliasiObat/hapusObat',
                method: 'post',
                data: "id=" + id,
                dataType: 'json',
                success: function(data) {
                    location.reload();
                }
            });
        }

    <?php endif; ?>
</script>
<?php $this->endSection() ?>