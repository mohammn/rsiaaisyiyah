<?php

/** @var object $data */
?>

<?php $this->extend('template') ?>

<?php $this->section('content') ?>


<div class="container-fluid px-4">
    <h3 class="mt-4">Rekam Medis Pasien</h3>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center">
            <span class="me-2">
                <button type="button" class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalTambahForm">
                    Daftar Form
                </button>
                Menampilkan data Rekam Medis pasien : <span class="bg-vibrant-blue text-white p-1"> <?= $data->pasien["nm_pasien"] ?> . (<?= $data->pasien["no_rawat"] ?>)</span></span>
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <table class="table table-striped table-responsive-lg" id="tabelRm">
                <thead>
                    <tr>
                        <th>Nama Form</th>
                        <th>Status</th>
                        <th>TTD</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="tabelDataRm">
                    <?php if ($data->skorPoudji): ?>
                        <?php for ($i = 0; $i < count($data->skorPoudji); $i++) :
                            $tglinput = new \DateTime($data->skorPoudji[$i]["tglinput"]);
                        ?>
                            <tr>
                                <td>Skor Poudji Rochjati (<?= $tglinput->format('d-m-Y'); ?>) </td>
                                <td>
                                    <span class="badge-estetik <?= $data->status["skorPoudji"][$i] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["skorPoudji"][$i] ?></span>
                                </td>
                                <td>
                                    <span class="badge-estetik bg-vibrant-teal">&nbsp; - &nbsp;</span>
                                </td>
                                <td>
                                    <a href="<?= base_url(" rm/skorPoudji/" . str_replace('/', '-', $data->pasien["no_rawat"])) . "/" . $data->skorPoudji[$i]["id"]  ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                    <a href="<?= base_url('/rm/skorPoudji/printskor/' .  $data->skorPoudji[$i]["id"]) ?>" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>
                                    <a href="<?= base_url('/rm/skorPoudji/' . str_replace('/', '-', $data->pasien["no_rawat"]) . "/" .  $data->skorPoudji[$i]["id"])  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endfor; ?>
                    <?php endif; ?>
                    <?php if ($data->persRajal) : ?>
                        <tr>
                            <td>Persetujuan Rawat Jalan</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["persRajal"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["persRajal"] ?></span>
                            </td>
                            <td><?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->persRajal['ttdWali'] and $data->persRajal['ttdSaksi']) ? '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/persetujuanRajal/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/persetujuanRajal/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->dpjp) : ?>
                        <tr>
                            <td>Formulir Pemilihan DPJP</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["dpjp"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["dpjp"] ?></span>
                            </td>
                            <td><?= !empty($data->dpjp['ttdWali']) ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <?= !empty($data->dpjp['ttdWali']) ? '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>' : '<a href="' . base_url('/rm/dpjp/cetak/' . str_replace('/', '-', $data->pasien['no_rawat'])) . '" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-blue"><i class="fas fa-pen-nib"></i> TTD</a>' ?>
                                <a href="<?= base_url('/rm/dpjp/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($data->rekonsiliasiObat) : ?>
                        <tr>
                            <td>Rekonsiliasi Obat</td>
                            <td>
                                <span class="badge-estetik <?= $data->status["rekonsiliasiObat"] === 'Lengkap' ? 'bg-vibrant-teal' : 'bg-vibrant-red' ?> "><?= $data->status["rekonsiliasiObat"] ?></span>
                            </td>
                            <td><?= $data->status['rekonsiliasiObat'] === 'Lengkap' ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<span class="badge-estetik bg-vibrant-red">Belum</span>' ?></td>
                            <td>
                                <a href="<?= base_url(" rm/rekonsiliasiObat/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-purple"><i class="fas fa-search"></i> Lihat</a>
                                <a href=" <?= base_url('/rm/rekonsiliasiObat/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>" target="_blank" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-teal"><i class="fas fa-print"></i> Cetak</a>
                                <a href="<?= base_url('/rm/rekonsiliasiObat/' . str_replace('/', '-', $data->pasien['no_rawat']))  ?>#modalHapus" style="text-decoration: none;" class="btn-estetik btn-sm-estetik bg-vibrant-red"><i class="fas fa-trash"></i> Hapus</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal tambah Form -->
<div class="modal modal-lg fade" id="modalTambahForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Form</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-responsive-lg" id="tabelForm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Form</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1.</td>
                            <td>Skor Poudji Rochjati</td>
                            <td>
                                <a href="<?= base_url("rm/skorPoudji/" . str_replace('/', '-', $data->pasien["no_rawat"])) ?>/0" class="btn-estetik btn-sm-estetik bg-vibrant-blue" style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Persetujuan Rawat Jalan</td>
                            <td>
                                <?= $data->persRajal ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/persetujuanRajal/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Formulir Pemilihan DPJP</td>
                            <td>
                                <?= $data->dpjp ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/dpjp/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                        <tr>
                            <td>2.</td>
                            <td>Rekonsiliasi Obat</td>
                            <td>
                                <?= $data->rekonsiliasiObat ? '<span class="badge-estetik bg-vibrant-teal">Sudah</span>' : '<a href="' . base_url("rm/rekonsiliasiObat/" . str_replace('/', '-', $data->pasien["no_rawat"])) . '" class="btn-estetik btn-sm-estetik bg-vibrant-blue"  style="text-decoration: none;"><i class="fas fa-plus"></i> Tambah</a>' ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class=" modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    $('#tabelRm').DataTable({
        "language": {
            "url": "<?= base_url('public/js/Indonesian.json') ?>" // Opsional: Bahasa Indonesia
        },
        "responsive": true,
        "retrieve": true // Memastikan data baru yang diambil masuk ke table
    });

    $('#tabelForm').DataTable({
        "language": {
            "url": "<?= base_url('public/js/Indonesian.json') ?>" // Opsional: Bahasa Indonesia
        },
        "responsive": true,
        "retrieve": true // Memastikan data baru yang diambil masuk ke table
    });

    function muatData() {
        $.ajax({
            url: '<?= base_url() ?>igd/muatData',
            data: 'tglMulai=' + $("#tglMulai").val() + '&tglAkhir=' + $("#tglAkhir").val(),
            method: 'post',
            dataType: 'json',
            beforeSend: function() {
                // 1. Hancurkan DataTable jika sudah ada sebelumnya agar tidak error "Cannot reinitialise"
                if ($.fn.DataTable.isDataTable('#tabelPasien')) {
                    $('#tabelPasien').DataTable().destroy();
                }
                // 2. Tampilkan loading spinner
                $("#tabelDataPasien").html("<tr><td colspan='11' class='text-center'><i class='fas fa-spinner fa-spin'></i> Memuat data...</td></tr>");
            },
            success: function(data) {
                console.log(data);
                let baris = '';
                for (let i = 0; i < data.length; i++) {
                    // Definisikan base URL di bagian atas script atau kirim dari view ke JS
                    let baseUrl = '<?= base_url() ?>';

                    let noRawatUrl = data[i].no_rawat.replace(/\//g, '-'); // Mengganti '/' menjadi '-' untuk URL

                    baris += '<tr>';
                    baris += '<td>' + (i + 1) + '</td>';
                    baris += '<td>';
                    baris += '    <a href="' + baseUrl + 'pasien/rm/' + noRawatUrl + '" class="link text-brand">';
                    baris += '        ' + data[i].no_rawat;
                    baris += '    </a>';
                    baris += '</td>';
                    baris += '<td>' + (data[i].nm_pasien ?? '-') + '</td>';
                    baris += '<td>' + data[i].no_rkm_medis + '</td>';
                    baris += '<td>' + (data[i].nm_poli ?? '-') + '</td>';
                    baris += '<td>' + (data[i].nm_dokter ?? '-') + '</td>';
                    baris += '<td>' + data[i].tgl_registrasi + '</td>';
                    baris += '<td>' + data[i].jam_reg + '</td>';
                    baris += '<td>' + data[i].status_lanjut + '</td>';
                    baris += '<td>' + data[i].status_bayar + '</td>';
                    baris += '<td>' + data[i].status_poli + '</td>';
                    baris += '</tr>';
                }

                $("#tabelDataPasien").html(baris);
                // 4. Inisialisasi ulang DataTable
                $('#tabelPasien').DataTable({
                    "language": {
                        "url": "<?= base_url('public/js/Indonesian.json') ?>" // Opsional: Bahasa Indonesia
                    },
                    "responsive": true,
                    "retrieve": true // Memastikan data baru yang diambil masuk ke table
                });
            }
        });
    }

    $(document).ready(function() {
        if (window.location.hash === '#modalTambahForm') {
            var myModal = new bootstrap.Modal(document.getElementById('modalTambahForm'));
            myModal.show();
        }
    });
</script>

<?php $this->endSection() ?>