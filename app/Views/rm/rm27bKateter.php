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
                <h5 class="text-uppercase">FORMULIR DATA SURVEILLANS PEMAKAIAN ALAT INVASIF KATETER URIN MENETAP</h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm27bKateter) : ?>
                <div class="row">

                    <div class="col-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Cath :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>No Cath</td>
                                    <td>: <?= $data->rm27bKateter["ivCath"] === 'Lainnya' ? $data->rm27bKateter["isiivCath"]  : $data->rm27bKateter["ivCath"] ?></td>
                                </tr>
                                <tr>
                                    <td>Jenis Cath</td>
                                    <td>: <?= $data->rm27bKateter["jenisCath"] === 'Lainnya' ? $data->rm27bKateter["isiJenisCath"] : $data->rm27bKateter["jenisCath"] ?></td>
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
                                    <td>Jumlah Penguncian</td>
                                    <td>: <?= $data->rm27bKateter["jumlahPengunci"] ?? "...." ?> Cc</td>
                                </tr>
                                <tr>
                                    <td>Jumlah Petugas</td>
                                    <td>:
                                        <?php
                                        $totalPetugas = 0;
                                        for ($i = 1; $i <= 10; $i++) {
                                            if ($data->rm27bKateter["petugas" . $i]) {
                                                $totalPetugas++;
                                            }
                                        }
                                        echo ' ' . $totalPetugas . ' ';
                                        ?>
                                        Orang
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm27bKateter/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm27bKateter['id']) ?>" target="_blank">
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
                <?= $this->include("rm/partials/formRm27bKateter.php") ?>

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
                <?= $this->include("rm/partials/formRm27bKateter.php") ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm27bKateter['id'] ?? '' ?>)">
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
            jumlahPengunci: $('#jumlahPengunci').val(),

            jenisCath: $('input[name="jenisCath"]:checked').val() || '',
            isiJenisCath: $('#isiJenisCath').val(),

            ivCath: $('input[name="ivCath"]:checked').val() || '',
            isiivCath: $('#isiivCath').val(),


            // =========================================================================
            // TAMBAHAN: Menangkap checkbox tindakan c1 sampai c17 secara dinamis
            // Akan menghasilkan key: c1, c2, dst. berisi array hari yang dicentang
            // =========================================================================
            ...Object.fromEntries(Array.from({
                length: 19
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
                length: 19
            }, (_, i) => $(`#ket${i+1}`).val() || ''),

            // Array Input Text Petugas (ID petugas1 sampai petugas31)
            ...Object.fromEntries(Array.from({
                length: 10
            }, (_, i) => [`petugas${i+1}`, $(`#petugas${i+1}`).val() || ''])),

            ...Object.fromEntries(Array.from({
                length: 10
            }, (_, i) => [`tgl${i+1}`, $(`#tgl${i+1}`).val() || ''])),
        };

        console.log(data)

        $.ajax({
            url: '<?= base_url("rm/rm27bKateter/simpan") ?>',
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


    <?php if ($data->rm27bKateter) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm27bKateter['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm27bKateter/hapus',
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