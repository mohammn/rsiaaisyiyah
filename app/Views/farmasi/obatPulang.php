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
            <a class="btn btn-estetik btn-simpan" href="<?= base_url(" jenis/farmasi/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>">Farmasi</a>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <div class="text-center">
                <h5 class="text-uppercase">INSTALASI FARMASI <br>DOKUMENTASI KONSELING</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->obatPulang) : ?>
                <div class="row">
                    <div id="viewPemberianObat">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">
                                    <div class="row mb-4">
                                        <div class="col-12 text-center fw-bold">Pemberian Obat :</div>
                                        <hr>
                                        <table class="table table-sm table-bordered bg-white">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama obat yang diberikan</th>
                                                    <th>Jumlah obat</th>
                                                    <th>Aturan pakai</th>
                                                    <th>Pagi</th>
                                                    <th>Siang</th>
                                                    <th>Sore</th>
                                                    <th>Malam</th>
                                                    <th>Instruksi Khusus</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php for ($i = 0; $i < count($data->resepPulang); $i++) :
                                                    $kodeBrng = $data->resepPulang[$i]['kode_brng'];
                                                    $detailObat = $data->obatPulangData[$kodeBrng] ?? null;
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i + 1 ?></td>
                                                        <td><?= $data->resepPulang[$i]['nama_brng'] ?></td>
                                                        <td><?= $data->resepPulang[$i]['jml_barang'] ?></td>
                                                        <td><?= $data->resepPulang[$i]['dosis'] ?></td>

                                                        <!-- Jam Pagi -->
                                                        <td class="text-center">
                                                            <?= !empty($detailObat['pagi']) ? substr($detailObat['pagi'], 0, 5) : '-' ?>
                                                        </td>

                                                        <!-- Jam Siang -->
                                                        <td class="text-center">
                                                            <?= !empty($detailObat['siang']) ? substr($detailObat['siang'], 0, 5) : '-' ?>
                                                        </td>

                                                        <!-- Jam Sore -->
                                                        <td class="text-center">
                                                            <?= !empty($detailObat['sore']) ? substr($detailObat['sore'], 0, 5) : '-' ?>
                                                        </td>

                                                        <!-- Jam Malam -->
                                                        <td class="text-center">
                                                            <?= !empty($detailObat['malam']) ? substr($detailObat['malam'], 0, 5) : '-' ?>
                                                        </td>

                                                        <!-- Instruksi Khusus -->
                                                        <td>
                                                            <?= !empty($detailObat['instruksi']) ? $detailObat['instruksi'] : '-' ?>
                                                        </td>
                                                    </tr>
                                                <?php endfor; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-1">
                                                <span class="fw-bold small text-secondary">Ruang Rawat :</span>
                                                <div class="fw-normal"><?= $data->obatPulang['ruang'] ?? '-' ?></div>
                                            </div>

                                            <div class="mb-1">
                                                <span class="fw-bold small text-secondary">Petugas :</span>
                                                <div class="fw-normal"><?= $data->obatPulang['petugas'] ?? '-' ?></div>
                                            </div>

                                            <div class="mb-1">
                                                <span class="fw-bold small text-secondary">Yang Menerima :</span>
                                                <div class="fw-normal"><?= $data->obatPulang['nama'] ?? '-' ?></div>
                                            </div>
                                        </div>

                                        <div class="col-md-8">
                                            <span class="fw-bold small text-secondary">Keterangan :</span>
                                            <div class="p-2 border rounded bg-white mt-1" style="min-height: 80px; white-space: pre-wrap;"><?= !empty($data->obatPulang['keterangan']) ? $data->obatPulang['keterangan'] : '-' ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php if ($data->obatPulang['ttdWali']): ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/farmasi/obatPulang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/farmasi/obatPulang/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>" target="_blank">
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
                <?= $this->include("farmasi/partials/formObatPulang.php") ?>

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
                if ($data->obatPulang) : ?>
                    <?= $this->include("farmasi/partials/formObatPulang.php") ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->obatPulang['id'] ?? '' ?>)">
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
                <input type="datetime-local" class="form-control" id="waktu" value="<?= !empty($data->obatPulang) ? date('Y-m-d\TH:i', strtotime($data->obatPulang["tglinput"])) : '' ?>">
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

            $("#nama").prop('disabled', true);

            $('#samaDgPasien').prop('checked', false);
        }
        if (!$('#samaDgPj').is(':checked') && !$('#samaDgPasien').is(':checked')) {
            $("#nama").val(<?= json_encode($data->obatPulang['nama'] ?? '') ?>);

            $("#nama").prop('disabled', false);
        }
    }

    function simpan(tujuanSimpan) {
        var noRawat = "<?= $data->pasien['no_rawat'] ?>";
        var nama = $("#nama").val().trim();

        // Loop & ambil seluruh baris obat secara dinamis
        var obatList = [];
        $('.baris-obat').each(function() {
            var item = {
                kode_brng: $(this).find('.kode-brng').val(), // Menangkap value dari input hidden .kode-brng
                pagi: $(this).find('.jam-pagi').val(),
                siang: $(this).find('.jam-siang').val(),
                sore: $(this).find('.jam-sore').val(),
                malam: $(this).find('.jam-malam').val(),
                instruksi: $(this).find('.instruksi').val()
            };
            obatList.push(item);
        });

        // Kumpulkan seluruh data ke dalam objek
        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: noRawat,
            nama: nama,
            ruang: $("#ruang").val(),
            petugas: $("#petugas").val(),
            keterangan: $("#keterangan").val(),
            pemberianObat: obatList // Array obat dinamis
        };

        console.log(data);

        // ===========================================================================

        $("#pesanError").html("");

        // Validasi field Nama yang menerima
        if (nama === "") {
            $("#nama").focus();
            $("#pesanError").html("Nama wajib diisi");
        } else {
            $.ajax({
                url: '<?= base_url("farmasi/obatPulang/simpan") ?>',
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


    <?php if ($data->obatPulang) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->obatPulang['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url("farmasi/obatPulang/hapus") ?>',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('jenis/farmasi/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        function ubahWaktu() {
            waktu = $("#waktu").val();
            noRawat = "<?= $data->obatPulang['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>farmasi/obatPulang/ubahWaktu',
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