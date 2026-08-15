<?php $this->extend('template') ?>

<?php $this->section('content') ?>

<div class="container-fluid px-4">
    <h3 class="mt-4">Pasien Rawat Inap</h3>
    <div class="card mb-4" style="border-radius: 20px !important; overflow: hidden !important; border: 1px solid #e2e8f0 !important; box-shadow: 0 4px 12px rgba(0,0,0,0.03) !important;">

        <!-- Card Header Soft Pill Style -->
        <div class="card-header d-flex align-items-center flex-wrap gap-2" style="background-color: #dbeafe !important; border-radius: 50px !important; border: none !important; padding: 10px 20px !important; color: #1e3a8a !important; margin: 12px 12px 0 12px !important;">

            <!-- Icon & Text Utama -->
            <i class="fas fa-id-card me-1" style="color: #1e40af !important; font-size: 16px;"></i>
            <span class="fw-semibold" style="color: #1e3a8a !important; font-size: 13px;">Menampilkan data pasien mulai tanggal:</span>

            <!-- Input Tanggal Mulai -->
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control form-control-sm" id="tglMulai" style="width: auto; background-color: #bfdbfe !important; color: #1d4ed8 !important; border: none !important; border-radius: 20px !important; font-weight: 700; padding: 4px 12px !important;">

            <span class="fw-semibold ms-1" style="color: #1e3a8a !important; font-size: 13px;">Sampai tanggal:</span>

            <!-- Input Tanggal Akhir -->
            <input type="date" onchange="muatData()" value="<?= date('Y-m-d'); ?>" class="form-control form-control-sm" id="tglAkhir" style="width: auto; background-color: #bfdbfe !important; color: #1d4ed8 !important; border: none !important; border-radius: 20px !important; font-weight: 700; padding: 4px 12px !important;">

            <span class="fw-semibold ms-1" style="color: #1e3a8a !important; font-size: 13px;">dan Status Pasien:</span>

            <!-- Select Status -->
            <select class="form-select form-select-sm" onchange="muatData()" name="status" id="status" style="width: auto; background-color: #bfdbfe !important; color: #1d4ed8 !important; border: none !important; border-radius: 20px !important; font-weight: 700; padding: 4px 28px 4px 12px !important;">
                <option value="belum">Belum</option>
                <option value="sudah">Sudah</option>
                <option value="semua">Semua</option>
            </select>

            <span class="fw-semibold" style="color: #1e3a8a !important; font-size: 13px;">Pulang</span>

        </div>

        <!-- Card Body & Table -->
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
    let tglMulai = sessionStorage.getItem('tglMulaiRanap');
    let tglAkhir = sessionStorage.getItem('tglAkhirRanap');
    let status = sessionStorage.getItem('status');

    if (tglMulai && tglAkhir && status) {
        $('#tglMulai').val(tglMulai);
        $('#tglAkhir').val(tglAkhir);
        $('#status').val(status);
    } else {
        let hariIni = new Date().toLocaleDateString('sv-SE'); // Lebih aman dari isu timezone

        $('#tglMulai').val(hariIni);
        $('#tglAkhir').val(hariIni);
        $('#status').val('belum');

        sessionStorage.setItem('tglMulaiRanap', hariIni);
        sessionStorage.setItem('tglAkhirRanap', hariIni);
        sessionStorage.setItem('status', 'belum');
    }

    muatData();

    function muatData() {
        sessionStorage.setItem('tglMulaiRanap', $("#tglMulai").val());
        sessionStorage.setItem('tglAkhirRanap', $("#tglAkhir").val());
        sessionStorage.setItem('status', $("#status").val());

        $.ajax({
            url: '<?= base_url() ?>ranap/muatData',
            data: 'tglMulai=' + $("#tglMulai").val() + '&tglAkhir=' + $("#tglAkhir").val() + '&status=' + $("#status").val(),
            method: 'post',
            dataType: 'json',
            beforeSend: function() {
                if ($.fn.DataTable.isDataTable('#tabelPasien')) {
                    $('#tabelPasien').DataTable().destroy();
                }
                // 2. Tampilkan loading spinner
                $("#tabelDataPasien").html("<tr><td colspan='11' class='text-center'><i class='fas fa-spinner fa-spin'></i> Memuat data...</td></tr>");
            },
            success: function(data) {
                sessionStorage.setItem('tglMulai', $("#tglMulai").val());
                sessionStorage.setItem('tglAkhir', $("#tglAkhir").val());
                sessionStorage.setItem('status', $("#status").val());

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