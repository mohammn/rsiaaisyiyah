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
                <h5 class="text-uppercase">TRANSFER / RUJUK KE RUMAH SAKIT LAIN</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm26bRujukKeluar) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Penanggung Jawab :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Nama Petugas</td>
                                    <td>: <?= $data->rm26bRujukKeluar["petugas"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Dokter Perujuk</td>
                                    <td>: <?= $data->rm26bRujukKeluar["dokter"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Ke Rumah Sakit</td>
                                    <td>: <?= $data->rm26bRujukKeluar["rs"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Alasan Merujuk</td>
                                    <td>: <?= $data->rm26bRujukKeluar["alasanRujuk"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Kondisi Pasien :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Riwayat Penyakit Sekarang</td>
                                    <td>: <?= $data->rm26bRujukKeluar["riwayatPenyakit"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Riwayat Penggunaan Obat</td>
                                    <td>: <?= $data->rm26bRujukKeluar["riwayatObat"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Pemeriksaan Penunjang</td>
                                    <td>: <?= $data->rm26bRujukKeluar["pemeriksaanPenunjang"] ?? ''  ?></td>
                                </tr>
                                <tr>
                                    <td>Perawatan lanjutan</td>
                                    <td>: <?= $data->rm26bRujukKeluar["perawatanLanjutan"] ?? ''  ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm26bRujukKeluar/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm26bRujukKeluar['id']) ?>" target="_blank">
                            <i class="fas fa-pen-nib me-1"></i> Cetak
                        </a>
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
                    <div class="row mt-2">
                        <div class="col-4">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-12 text-center">Tambah Tindakan :</div>
                                    <hr>
                                </div>
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Pengobatan dan tindakan :</label>
                                <input type="text" id="namaTindakan" name="namaTindakan" class="form-control form-control-sm" value="<?= $data->rm26bRujukKeluar['namaTindakan'] ?? '' ?>">
                                <label class="form-label fw-bold small text-secondary mb-0 text-nowrap">Waktu :</label>
                                <input type="datetime-local" id="waktuTindakan" name="waktuTindakan" class="form-control form-control-sm" value="<?= $data->rm26bRujukKeluar['waktuTindakan'] ?? '' ?>">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <button class="btn btn-estetik btn-simpan mt-2" onclick="simpanData('tambah')">
                                            <i class="fas fa-plus me-1"></i> Tambah
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="alert alert-info">
                                <div class="row">
                                    <div class="col-12 text-center">Data Pengobatan dan Tindakan :</div>
                                    <hr>
                                </div>
                                <table class="table teble-striped">
                                    <thead>
                                        <th>No.</th>
                                        <th>Nama Pengobatan dan Tindakan</th>
                                        <th>Waktu</th>
                                        <th>Hapus</th>
                                    </thead>
                                    <tbody id="isiTabelTindakan">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm26bRujukKeluar.php") ?>

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
                <?= $this->include("rm/partials/formRm26bRujukKeluar.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm26bRujukKeluar['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->rm26bRujukKeluar) ? date('Y-m-d\TH:i', strtotime($data->rm26bRujukKeluar["tglinput"])) : '' ?>">
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
            $("#nama").val(<?= json_encode($data->rm26bRujukKeluar['nama'] ?? '') ?>);

            $("#nama").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        // Mengambil nilai checkbox 'alat[]' yang dicentang dan dimasukkan ke dalam Array
        var alatTerpilih = [];
        $('input[name="alat[]"]:checked').each(function() {
            alatTerpilih.push($(this).val());
        });

        var data = {
            // Tetap dipertahankan sesuai request awal
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",

            // --- DATA RUJUKAN (Form Kiri) ---
            unit: $('#unit').val(),
            rs: $('#rs').val(),
            petugas: $('#petugas').val(),
            waktuMenghubungi: $('#waktuMenghubungi').val(),
            petugasDihubungi: $('#petugasDihubungi').val(),
            noPetugasDihubungi: $('#noPetugasDihubungi').val(),
            jamBerangkat: $('#jamBerangkat').val(),
            jamTiba: $('#jamTiba').val(),

            // Alasan Merujuk (Radio & Teks tambahan)
            alasanRujuk: $('input[name="alasanRujuk"]:checked').val() || '',
            isiKlinikal: $('#isiKlinikal').val(),
            isiNonKlinikal: $('#isiNonKlinikal').val(),

            diagnosa: $('#diagnosa').val(),
            dokter: $('#dokter').val(),

            // Alergi (Radio & Teks tambahan)
            alergi: $('input[name="alergi"]:checked').val() || '',
            isiAlergi: $('#isiAlergi').val(),

            riwayatPenyakit: $('#riwayatPenyakit').val(),
            riwayatObat: $('#riwayatObat').val(),

            // Riwayat Penyakit Dahulu (Radio & Teks tambahan)
            penyakit: $('input[name="penyakit"]:checked').val() || '',
            isiPenyakit: $('#isiPenyakit').val(),

            // --- CATATAN KLINIS (Form Kanan) ---
            kesadaran: $('input[name="kesadaran"]').val(),
            gcs_e: $('input[name="gcs_e"]').val(),
            gcs_v: $('input[name="gcs_v"]').val(),
            gcs_m: $('input[name="gcs_m"]').val(),

            pupil_kanan: $('input[name="pupil_kanan"]').val(),
            pupil_kiri: $('input[name="pupil_kiri"]').val(),
            reflek_cahaya_kanan: $('input[name="reflek_cahaya_kanan"]').val(),
            reflek_cahaya_kiri: $('input[name="reflek_cahaya_kiri"]').val(),

            td_sistole: $('input[name="td_sistole"]').val(),
            td_diastole: $('input[name="td_diastole"]').val(),
            nadi: $('input[name="nadi"]').val(),
            spo2: $('input[name="spo2"]').val(),
            rr: $('input[name="rr"]').val(),
            suhu: $('input[name="suhu"]').val(),
            bb: $('input[name="bb"]').val(),
            tb: $('input[name="tb"]').val(),

            waktuIntake: $('#waktuIntake').val(),
            pemeriksaanPenunjang: $('#pemeriksaanPenunjang').val(),

            // Peralatan Medis (Radio, Checkbox Array, & Teks tambahan)
            peralatan: $('input[name="peralatan"]:checked').val() || '',
            alat: alatTerpilih, // Berupa array, contoh: ["Infus", "Oksigen"]
            isiAlatLainnya: $('#isiAlatLainnya').val(),

            perawatanLanjutan: $('#perawatanLanjutan').val()
        };

        $("#pesanError").html("");

        if (data.petugas.replace(/\s+/g, "-") == "") {
            $("#petugas").focus();
            $("#pesanError").html("Petugas wajib diisi");
        } else if (data.dokter.replace(/\s+/g, "-") == "") {
            $("#dokter").focus();
            $("#pesanError").html("Dokter wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("rm/rm26bRujukKeluar/simpan") ?>',
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

    function simpanData(tujuanSimpan) {
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            id: "<?= $data->rm26bRujukKeluar['id'] ?? 0 ?>",

            namaTindakan: $('#namaTindakan').val(),
            waktuTindakan: $('#waktuTindakan').val()
        };

        $.ajax({
            url: '<?= base_url("rm/rm26bRujukKeluar/simpanData") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(data) {
                muatData();
                $('#namaTindakan').val('');
                $('#waktuTindakan').val('');
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert("Terjadi kesalahan: " + error);
            }
        });

    }


    <?php if ($data->rm26bRujukKeluar) : ?>

        muatData()

        function muatData() {
            $.ajax({
                url: '<?= base_url() ?>rm/rm26bRujukKeluar/muatData',
                method: 'post',
                // Perbaikan format data string: tanda kutip dipindahkan agar dibaca sebagai key-value yang valid
                data: "id=<?= $data->rm26bRujukKeluar['id'] ?? 0 ?>",
                dataType: 'json',
                success: function(data) {
                    let hasil = '';
                    for (let i = 0; i < data.length; i++) {
                        hasil += '<tr>';
                        hasil += '<td>' + (i + 1) + '</td>';
                        hasil += '<td>' + data[i].namaTindakan + '</td>';
                        hasil += '<td>' + data[i].waktuTindakan + '</td>';
                        hasil += '<td>';
                        hasil += '<a href="javascript:void(0);" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"  onclick="hapusData(' + data[i].id + ')"><i class="fas fa-trash-alt"></i> Hapus</a>';
                        hasil += '</td>';
                        hasil += '</tr>';
                    }

                    // 2. Masukkan data ke dalam tbody
                    $("#isiTabelTindakan").html(hasil);
                }
            });
        }

        function hapusData(id) {
            $.ajax({
                url: '<?= base_url() ?>rm/rm26bRujukKeluar/hapusData',
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
            var noRawat = "<?= $data->rm26bRujukKeluar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26bRujukKeluar/hapus',
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
            noRawat = "<?= $data->rm26bRujukKeluar['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm26bRujukKeluar/ubahWaktu',
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