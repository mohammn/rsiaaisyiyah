<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Pasien Rawat Inap</h3>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center bg-vibrant-blue text-white">

            <span class="me-2">Menampilkan data pasien mulai tanggal:</span>
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control me-3" id="tglMulai" style="width: auto;">

            <span class="me-2">Sampai tanggal:</span>
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control" id="tglAkhir" style="width: auto;">

            <span class="me-2"> &nbsp; dan Status Pasien:</span>
            <select class="form-select" onchange="muatData()" style="width: 20%;" name="status" id="status">
                <option value="belum">Belum</option>
                <option value="sudah">Sudah</option>
                <option value="semua">Semua</option>
            </select>
            &nbsp; Pulang
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <table class="table table-striped table-responsive-lg" id="tabelPasien">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rawat</th>
                        <th>No RM</th>
                        <th>Nama Pasien</th>
                        <th>Alamat</th>
                        <th>Penanggung Jawab</th>
                        <th>Hub PJ</th>
                        <th>Jenis Bayar</th>
                        <th>Kamar</th>
                        <th>Tgl Masuk</th>
                        <th>Tgl Keluar</th>
                        <th>Lama Inap</th>
                        <th>Dokter PJ</th>
                    </tr>
                </thead>
                <tbody id="tabelDataPasien">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    muatData();

    function muatData() {
        $.ajax({
            url: '<?= base_url() ?>ranap/muatData',
            data: 'tglMulai=' + $("#tglMulai").val() + '&tglAkhir=' + $("#tglAkhir").val() + '&status=' + $("#status").val(),
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
                    let baseUrl = '<?= base_url() ?>';
                    let noRawatUrl = data[i].no_rawat.replace(/\//g, '-'); // Mengganti '/' menjadi '-' untuk URL

                    baris += '<tr>';
                    baris += '<td>' + (i + 1) + '</td>';
                    baris += '<td>';
                    baris += '    <a href="' + baseUrl + 'rm/' + noRawatUrl + '" class="link text-brand">';
                    baris += '        ' + data[i].no_rawat;
                    baris += '    </a>';
                    baris += '</td>';
                    baris += '<td>' + data[i].no_rkm_medis + '</td>';
                    baris += '<td>' + data[i].nm_pasien + '</td>';
                    baris += '<td>' + data[i].alamat + '</td>';
                    baris += '<td>' + data[i].p_jawab + '</td>';
                    baris += '<td>' + data[i].hubunganpj + '</td>';
                    baris += '<td>' + data[i].png_jawab + '</td>';
                    baris += '<td>' + data[i].kd_kamar + '-' + data[i].nm_bangsal + '</td>';
                    baris += '<td>' + data[i].tgl_masuk + '-' + data[i].jam_masuk + '</td>';
                    baris += '<td>' + data[i].tgl_keluar + '-' + data[i].jam_keluar + '</td>';
                    baris += '<td>' + data[i].lama + '</td>';
                    baris += '<td>' + data[i].nm_dokter + '</td>';
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
</script>

<?php $this->endSection() ?>