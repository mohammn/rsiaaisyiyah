<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Pasien Instalasi Gawat Darurat</h3>
    <div class="card mb-4">
        <div class="card-header d-flex align-items-center bg-vibrant-blue text-white">

            <span class="me-2">Menampilkan data pasien mulai tanggal:</span>
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control me-3" id="tglMulai" style="width: auto;">

            <span class="me-2">Sampai tanggal:</span>
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control" id="tglAkhir" style="width: auto;">
        </div>
        <div class="card-body" style="overflow-y: auto;">
            <table class="table table-striped table-responsive-lg" id="tabelPasien">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>No Rawat</th>
                        <th>Nama Pasien</th>
                        <th>No RM</th>
                        <th>Poli</th>
                        <th>Dokter</th>
                        <th>Tgl Registrasi</th>
                        <th>Jam Registrasi</th>
                        <th>Status Lanjut</th>
                        <th>Status Bayar</th>
                        <th>Status Poli</th>
                    </tr>
                </thead>
                <tbody id="tabelDataPasien">
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    let tglMulai = sessionStorage.getItem('tglMulaiIgd');
    let tglAkhir = sessionStorage.getItem('tglAkhirIgd');

    if (tglMulai && tglAkhir) {
        $('#tglMulai').val(tglMulai);
        $('#tglAkhir').val(tglAkhir);
    } else {
        let hariIni = new Date().toLocaleDateString('sv-SE'); // Lebih aman dari isu timezone

        $('#tglMulai').val(hariIni);
        $('#tglAkhir').val(hariIni);

        sessionStorage.setItem('tglMulaiIgd', hariIni);
        sessionStorage.setItem('tglAkhirIgd', hariIni);
    }

    muatData();

    function muatData() {
        sessionStorage.setItem('tglMulaiIgd', $("#tglMulai").val());
        sessionStorage.setItem('tglAkhirIgd', $("#tglAkhir").val());

        $.ajax({
            url: '<?= base_url() ?>igd/muatData',
            data: 'tglMulai=' + $("#tglMulai").val() + '&tglAkhir=' + $("#tglAkhir").val(),
            method: 'post',
            dataType: 'json',
            beforeSend: function() {
                if ($.fn.DataTable.isDataTable('#tabelPasien')) {
                    $('#tabelPasien').DataTable().destroy();
                }
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
                    baris += '    <a href="' + baseUrl + 'rm/' + noRawatUrl + '" class="link text-brand">';
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
                    "stateSave": true,
                    "responsive": true,
                    "retrieve": true
                });
            }
        });
    }
</script>

<?php $this->endSection() ?>