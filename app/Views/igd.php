<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Pasien Instalasi Gawat Darurat</h3>
    <div class="card mb-4" style="border-radius: 20px !important; overflow: hidden !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important;">

        <!-- Card Header Soft Pill Style -->
        <div class="card-header d-flex align-items-center flex-wrap gap-2" style="background-color: #dbeafe !important; border-radius: 50px !important; border: none !important; padding: 10px 20px !important; color: #1e3a8a !important; margin: 12px 12px 0 12px !important;">

            <!-- Icon & Text Utama -->
            <i class="fas fa-calendar-alt me-1" style="color: #1e40af !important; font-size: 15px;"></i>
            <span class="fw-semibold" style="color: #1e3a8a !important; font-size: 13px;">Menampilkan data pasien mulai tanggal:</span>

            <!-- Input Tanggal Mulai -->
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control form-control-sm" id="tglMulai" style="width: auto; background-color: #bfdbfe !important; color: #1d4ed8 !important; border: none !important; border-radius: 20px !important; font-weight: 700; padding: 4px 12px !important;">

            <span class="fw-semibold ms-1" style="color: #1e3a8a !important; font-size: 13px;">Sampai tanggal:</span>

            <!-- Input Tanggal Akhir -->
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control form-control-sm" id="tglAkhir" style="width: auto; background-color: #bfdbfe !important; color: #1d4ed8 !important; border: none !important; border-radius: 20px !important; font-weight: 700; padding: 4px 12px !important;">

        </div>

        <!-- Card Body & Table -->
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