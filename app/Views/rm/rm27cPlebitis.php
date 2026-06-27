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
                <h5 class="text-uppercase">BUNDLE INFEKSI LUKA INFUS (PLEBITIS)</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm27cPlebitis) : ?>
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Pre Operasi :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Bulan</td>
                                    <td>: <?= $data->rm27cPlebitis["bulan"] ?></td>
                                </tr>
                                <tr>
                                    <td>Ruang</td>
                                    <td>: <?= $data->rm27cPlebitis["ruang"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>Umur</td>
                                    <td>: <?= $data->rm27cPlebitis["umur"] ?? '' ?></td>
                                </tr>
                                <tr>
                                    <td>Diagnosa masuk</td>
                                    <td>: <?= $data->rm27cPlebitis["diagnosa"] ?? '' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row ">
                                <div class="col-12 text-center">Data ruang operasi :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Lokasi Pemasangan</td>
                                    <td>: <?= !empty(json_decode($data->rm27cPlebitis["lokasiPemasangan"] ?? '[]', true)) ? implode(', ', json_decode($data->rm27cPlebitis["lokasiPemasangan"], true)) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>No IV Cath</td>
                                    <td>: <?= $data->rm27cPlebitis["ivCath"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis cairan</td>
                                    <td>: <?= $data->rm27cPlebitis["jenisCairan"] ?? '...' ?></td>
                                </tr>
                                <tr>
                                    <td>Gol. Obat Injeksi</td>
                                    <td>: <?= !empty(json_decode($data->rm27cPlebitis["golObat"] ?? '[]', true)) ? implode(', ', json_decode($data->rm27cPlebitis["golObat"], true)) : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm27cPlebitis/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm27cPlebitis['id']) ?>" target="_blank">
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

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm27cPlebitis.php") ?>

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
                <?= $this->include("rm/partials/formrm27cPlebitis.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm27cPlebitis['id'] ?? '' ?>)">
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

<script>
    function simpan(tujuanSimpan) {

        var data = {
            tujuanSimpan: tujuanSimpan,
            noRawat: "<?= $data->pasien['no_rawat'] ?>",
            bulan: $('#bulan').val(),
            ruang: $('#ruang').val(),
            umur: $('#umur').val(),
            diagnosa: $('#diagnosa').val(),

            lokasiPemasangan: $('input[name="lokasiPemasangan[]"]:checked').map(function() {
                return this.value;
            }).get(),
            isilokasiPemasanganLainnya: $('#isilokasiPemasanganLainnya').val(),

            golObat: $('input[name="golObat[]"]:checked').map(function() {
                return this.value;
            }).get(),
            isigolObatLainnya: $('#isigolObatLainnya').val(),

            ivCath: $('input[name="ivCath"]:checked').val() || '',
            isiivCath: $('#isiivCath').val(),

            jenisCairan: $('input[name="jenisCairan"]:checked').val() || '',

            // =========================================================================
            // TAMBAHAN: Menangkap checkbox tindakan c1 sampai c17 secara dinamis
            // Akan menghasilkan key: c1, c2, dst. berisi array hari yang dicentang
            // =========================================================================
            ...Object.fromEntries(Array.from({
                length: 17
            }, (_, i) => {
                let id = i + 1;
                let checkedValues = $(`input[name="c${id}[]"]:checked`).map(function() {
                    return this.value;
                }).get();
                return [`c${id}`, checkedValues]; // Menghasilkan properti misal: c1: ["1", "2"]
            })),
            // =========================================================================

            // Array Input Text Keterangan (ID ket1 sampai ket17)
            keterangan: Array.from({
                length: 17
            }, (_, i) => $(`#ket${i+1}`).val() || ''),

            // Array Input Text Petugas (ID petugas1 sampai petugas31)
            ...Object.fromEntries(Array.from({
                length: 10
            }, (_, i) => [`petugas${i+1}`, $(`#petugas${i+1}`).val() || ''])),

            ...Object.fromEntries(Array.from({
                length: 10
            }, (_, i) => [`tgl${i+1}`, $(`#tgl${i+1}`).val() || ''])),
        };

        // console.log(data)

        $.ajax({
            url: '<?= base_url("rm/rm27cPlebitis/simpan") ?>',
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


    <?php if ($data->rm27cPlebitis) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm27cPlebitis['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm27cPlebitis/hapus',
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