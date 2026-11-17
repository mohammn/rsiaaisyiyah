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
                <h5 class="text-uppercase">
                    MONITORING INTRA ANESTESI
                </h5>
                Untuk pasien : <b><?= $data->pasien["nm_pasien"] ?></b> (<?= $data->pasien["no_rkm_medis"] ?>). NIK: <?= $data->pasien["no_ktp"] ?><br>
                No Rawat : <b><?= $data->pasien["no_rawat"] ?></b>. Lahir : <?= $data->pasien["tgl_lahir"] ?> <br>
                Alamat : <?= $data->pasien["alamat"] ?>
                <hr>
            </div>

            <?php if ($data->rm11b2MonitoringAnestesi) : ?>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Data Anestesi :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Waktu Masuk Ok</td>
                                    <td>: <?= !empty($data->rm11b2MonitoringAnestesi["waktuMasukOk"]) ? date('d-m-Y H:i', strtotime($data->rm11b2MonitoringAnestesi["waktuMasukOk"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Pembiusan</td>
                                    <td>: <?= !empty($data->rm11b2MonitoringAnestesi["waktuPembiusan"]) ? date('d-m-Y H:i', strtotime($data->rm11b2MonitoringAnestesi["waktuPembiusan"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Insisi</td>
                                    <td>: <?= !empty($data->rm11b2MonitoringAnestesi["waktuInsisi"]) ? date('d-m-Y H:i', strtotime($data->rm11b2MonitoringAnestesi["waktuInsisi"])) : '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Waktu Selesai Operasi</td>
                                    <td>: <?= !empty($data->rm11b2MonitoringAnestesi["waktuSelesaiOp"]) ? date('d-m-Y H:i', strtotime($data->rm11b2MonitoringAnestesi["waktuSelesaiOp"])) : '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-12 text-center">Petugas :</div>
                                <hr>
                            </div>
                            <table class="table table-info table-borderless">
                                <tr>
                                    <td>Dokter DPJP</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["dokter1"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Perawat</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["perawat"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Perawat RR</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["perawatRr"] ?? '-' ?></td>
                                </tr>
                                <tr>
                                    <td>Penata Anestesi</td>
                                    <td>: <?= $data->rm11b2MonitoringAnestesi["perawatAnestesi"] ?? '-' ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <br><br>
                    <div class="text-center">
                        <?php
                        $ttd = $data->rm11b2MonitoringAnestesi;
                        if ((
                            $ttd["ttdDokter"] &&
                            $ttd["ttdPerawat"] &&
                            $ttd["ttdPerawatRr"] &&
                            $ttd["ttdAnestesi"]
                        )):
                        ?>
                            <a class="btn btn-estetik btn-cetak" href="<?= base_url('/rm/rm11b2MonitoringAnestesi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b2MonitoringAnestesi['id']) ?>" target="_blank">
                                <i class="fas fa-print me-1"></i> Cetak
                            </a>
                        <?php else: ?>
                            <a class="btn btn-estetik btn-simpan" href="<?= base_url('/rm/rm11b2MonitoringAnestesi/cetak/' . str_replace('/', '-', $data->pasien['no_rawat']) . '/' . $data->rm11b2MonitoringAnestesi['id']) ?>" target="_blank">
                                <i class="fas fa-pen-nib me-1"></i> TTD
                            </a>
                        <?php endif; ?>
                        <button class="btn btn-estetik btn-lihat" data-bs-toggle="modal" data-bs-target="#modalEdit">
                            <i class="fa fa-edit me-1"></i> Edit
                        </button>
                        <button class="btn btn-estetik btn-hapus" onclick="tryHapus()">
                            <i class="fas fa-trash-alt me-1"></i> Hapus
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row mt-3 g-3">
                    <div class="col-md-6">
                        <div class="bg-light p-2 rounded border border-secondary">
                            <div class="w-100 text-center">
                                <h5>Monitoring Intra Anestesi</h5>
                            </div>
                            <!-- Berikan height (misal: 350px atau 400px) pada div pembungkusnya -->
                            <div style="position: relative; height: 350px; width: 100%;">
                                <canvas id="chartMonitoringIntraAnestesi"></canvas>
                            </div>

                            <div class="w-100 mt-3 text-center">
                                <b>Data Monitoring :</b>
                            </div>
                            <hr>

                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>S</th>
                                        <th>D</th>
                                        <th>RR</th>
                                        <th>SP02</th>
                                        <th>Nadi</th>
                                        <th>hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelIntraAnestesi">

                                </tbody>
                            </table>

                            <div class="w-100 mt-3 text-center">
                                <button class="btn btn-sm btn-estetik btn-lihat" onclick="tryTambahIntra()">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-light p-2 rounded border border-secondary">
                            <div class="w-100 text-center">
                                <h5>Monitoring Pasca Anestesi</h5>
                            </div>
                            <!-- Berikan height (misal: 350px atau 400px) pada div pembungkusnya -->
                            <div style="position: relative; height: 350px; width: 100%;">
                                <canvas id="chartMonitoringPascaAnestesi"></canvas>
                            </div>

                            <div class="w-100 mt-3 text-center">
                                <b>Data Monitoring :</b>
                            </div>
                            <hr>

                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Waktu</th>
                                        <th>S</th>
                                        <th>D</th>
                                        <th>RR</th>
                                        <th>SP02</th>
                                        <th>Nadi</th>
                                        <th>hapus</th>
                                    </tr>
                                </thead>
                                <tbody id="tabelPascaAnestesi">

                                </tbody>
                            </table>

                            <div class="w-100 mt-3 text-center">
                                <button class="btn btn-sm btn-estetik btn-lihat" onclick="tryTambahPasca()">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>

            <?php else : ?>
                <h6 class="text-center">Form isian :</h6>
                <?= $this->include("rm/partials/formRm11b2MonitoringAnestesi.php") ?>

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
                <?php if ($data->rm11b2MonitoringAnestesi) : ?>
                    <?= $this->include("rm/partials/formRm11b2MonitoringAnestesi.php") ?>
                <?php endif; ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-estetik btn-batal" data-bs-dismiss="modal"><i class="fas fa-ban me-1"></i> Batal</button>
                <button class="btn btn-estetik btn-simpan" onclick="simpan(<?= $data->rm11b2MonitoringAnestesi['id'] ?? '' ?>)">
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

<!-- Modal Monitoring INTRA-->
<div class="modal fade" id="modalIntraAnestesi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data monitoring intra anestesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-white rounded shadow-sm border">
                    <!-- Waktu -->
                    <div class="mb-3" style="max-width: 200px;">
                        <label class="form-label small fw-bold text-secondary">Waktu</label>
                        <input type="time" id="inputWaktu" class="form-control form-control-sm">
                    </div>

                    <!-- Baris Input Parameter -->
                    <div class="row g-2">
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Sistolik (mmHg)</label>
                            <input type="number" id="inputSistolik" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Diastolik (mmHg)</label>
                            <input type="number" id="inputDiastolik" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">RR (x/mnt)</label>
                            <input type="number" id="inputRR" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">SpO₂ (%)</label>
                            <input type="number" id="inputSpO2" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Nadi</label>
                            <input type="number" step="0.1" id="inputTemp" value="0" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="tombolSimpanIntra" class="btn btn-primary" onclick="simpanMonitoringIntra('tambah')">Simpan</button>
                <button type="button" id="tombolTemplateIntra" class="btn btn-info" onclick="simpanMonitoringIntra('template')">Template</button>
                <button type="button" id="tombolUpdateIntra" class="btn btn-warning" onclick="simpanMonitoringIntra('update')">Update</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Monitoring PASCA-->
<div class="modal fade" id="modalPascaAnestesi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Tambah data monitoring pasca anestesi</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="p-3 bg-white rounded shadow-sm border">
                    <!-- Waktu -->
                    <div class="mb-3" style="max-width: 200px;">
                        <label class="form-label small fw-bold text-secondary">Waktu</label>
                        <input type="time" id="inputWaktu2" class="form-control form-control-sm">
                    </div>

                    <!-- Baris Input Parameter -->
                    <div class="row g-2">
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Sistolik (mmHg)</label>
                            <input type="number" id="inputSistolik2" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Diastolik (mmHg)</label>
                            <input type="number" id="inputDiastolik2" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">RR (x/mnt)</label>
                            <input type="number" id="inputRR2" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">SpO₂ (%)</label>
                            <input type="number" id="inputSpO22" value="0" class="form-control form-control-sm">
                        </div>
                        <div class="col">
                            <label class="form-label small fw-bold text-secondary">Nadi</label>
                            <input type="number" step="0.1" id="inputTemp2" value="0" class="form-control form-control-sm">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" id="tombolSimpanPasca" class="btn btn-primary" onclick="simpanMonitoringPasca('tambah')">Simpan</button>
                <button type="button" id="tombolTemplatePasca" class="btn btn-info" onclick="simpanMonitoringPasca('template')">Template</button>
                <button type="button" id="tombolUpdatePasca" class="btn btn-warning" onclick="simpanMonitoringPasca('update')">Update</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    function simpan(tujuanSimpan) {
        var noRawat = "<?= $data->pasien['no_rawat'] ?>";
        // 1. Capture the form data into an array
        var formArray = $("form").serializeArray();

        // 2. Convert it into a clean "data" object
        var data = {};
        $.map(formArray, function(n, i) {
            // If the name ends with [], handle it as an array
            if (n['name'].indexOf('[]') !== -1) {
                var cleanName = n['name'].replace('[]', '');
                if (!data[cleanName]) {
                    data[cleanName] = [];
                }
                data[cleanName].push(n['value']);
            } else {
                // Standard field
                data[n['name']] = n['value'];
            }
        });

        // Now 'data' is ready to be used
        console.log(data);

        data.tujuanSimpan = tujuanSimpan; // adding from a variable
        data.noRawat = noRawat; // adding from a variable

        // ===========================================================================

        $("#pesanError").html("");

        $.ajax({
            url: '<?= base_url("rm/rm11b2MonitoringAnestesi/simpan") ?>',
            method: 'POST',
            data: data,
            dataType: 'json',
            success: function(response) {
                location.reload()
            },
            error: function(xhr, status, error) {
                console.error("RESPON SERVER MENTAH:", xhr.responseText); // Cek F12 Console bagian ini!
                alert("Terjadi kesalahan sistem. Cek console browser.");
            }
        });

    }


    <?php if ($data->rm11b2MonitoringAnestesi) : ?>

        function tryHapus() {
            $("#modalHapus").modal("show");
            $("#namaPasienHapus").html("<?= $data->pasien["nm_pasien"] ?>")
            $("#noRawatHapus").html("<?= $data->pasien["no_rawat"] ?>")
        }

        function hapus() {
            var noRawat = "<?= $data->rm11b2MonitoringAnestesi['noRawat'] ?? '' ?>";

            $.ajax({
                url: '<?= base_url() ?>rm/rm11b2MonitoringAnestesi/hapus',
                method: 'post',
                data: "noRawat=" + noRawat,
                dataType: 'json',
                success: function(data) {
                    location.href = "<?= base_url('rm/' . str_replace('/', '-', $data->pasien['no_rawat'])) ?>";
                }
            });
        }

        function chartMonitoringIntraAnestesi() {
            var ctx = document.getElementById("chartMonitoringIntraAnestesi").getContext('2d');

            if (window.myAnesthesiaChart instanceof Chart) {
                window.myAnesthesiaChart.destroy();
            }

            window.myAnesthesiaChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["00:00"],
                    datasets: [{
                            label: "Sistolik",
                            data: [0],
                            borderColor: "#ef4444",
                            backgroundColor: "#ef4444",
                            pointBackgroundColor: "#ef4444",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointStyle: 'circle', // 1. Bulat
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "Diastolik",
                            data: [0],
                            borderColor: "#3b82f6",
                            backgroundColor: "#3b82f6",
                            pointBackgroundColor: "#3b82f6",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 7,
                            pointStyle: 'rectRot', // 2. Belah Ketupat
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "RR",
                            data: [0],
                            borderColor: "#10b981",
                            backgroundColor: "#10b981",
                            pointBackgroundColor: "#10b981",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointStyle: 'rect', // 3. Kotak
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "Nadi",
                            data: [0],
                            borderColor: "#f59e0b",
                            backgroundColor: "#f59e0b",
                            pointBackgroundColor: "#f59e0b",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 7,
                            pointStyle: 'triangle', // 4. Segitiga
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "SpO2",
                            data: [0],
                            borderColor: "#8b5cf6",
                            backgroundColor: "#8b5cf6",
                            pointBackgroundColor: "#8b5cf6",
                            pointBorderColor: "#8b5cf6", // Border disamakan agar silangnya tebal dan jelas
                            pointBorderWidth: 2.5,
                            pointRadius: 6,
                            pointStyle: 'crossRot', // 5. Tanda Silang (X) - Pasti muncul & sangat kontras untuk cetak hitam-putih
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#4a5568',
                                font: {
                                    weight: 'normal',
                                    size: 11
                                }
                            }
                        },
                        y: {
                            min: 0,
                            max: 140,
                            ticks: {
                                stepSize: 20,
                                color: '#4a5568',
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: "rgba(226, 232, 240, 0.8)",
                                borderDash: [2, 2]
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 14,
                                boxHeight: 14,
                                padding: 15,
                                color: '#2d3748',
                                font: {
                                    size: 12,
                                    weight: 'normal'
                                },
                                generateLabels: function(chart) {
                                    const originalLabels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                                    originalLabels.forEach((label, index) => {
                                        const dataset = chart.data.datasets[index];
                                        label.pointStyle = dataset.pointStyle;
                                        label.pointStyleWidth = 12;
                                    });
                                    return originalLabels;
                                }
                            }
                        }
                    }
                }
            });
        }

        function chartMonitoringPascaAnestesi() {
            var ctx = document.getElementById("chartMonitoringPascaAnestesi").getContext('2d');

            if (window.myAnesthesibChart instanceof Chart) {
                window.myAnesthesibChart.destroy();
            }

            window.myAnesthesibChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ["00:00"],
                    datasets: [{
                            label: "Sistolik",
                            data: [0],
                            borderColor: "#ef4444",
                            backgroundColor: "#ef4444",
                            pointBackgroundColor: "#ef4444",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointStyle: 'circle', // 1. Bulat
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "Diastolik",
                            data: [0],
                            borderColor: "#3b82f6",
                            backgroundColor: "#3b82f6",
                            pointBackgroundColor: "#3b82f6",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 7,
                            pointStyle: 'rectRot', // 2. Belah Ketupat
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "RR",
                            data: [0],
                            borderColor: "#10b981",
                            backgroundColor: "#10b981",
                            pointBackgroundColor: "#10b981",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 6,
                            pointStyle: 'rect', // 3. Kotak
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "Nadi",
                            data: [0],
                            borderColor: "#f59e0b",
                            backgroundColor: "#f59e0b",
                            pointBackgroundColor: "#f59e0b",
                            pointBorderColor: "#ffffff",
                            pointBorderWidth: 2,
                            pointRadius: 7,
                            pointStyle: 'triangle', // 4. Segitiga
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        },
                        {
                            label: "SpO2",
                            data: [0],
                            borderColor: "#8b5cf6",
                            backgroundColor: "#8b5cf6",
                            pointBackgroundColor: "#8b5cf6",
                            pointBorderColor: "#8b5cf6", // Border disamakan agar silangnya tebal dan jelas
                            pointBorderWidth: 2.5,
                            pointRadius: 6,
                            pointStyle: 'crossRot', // 5. Tanda Silang (X) - Pasti muncul & sangat kontras untuk cetak hitam-putih
                            borderWidth: 1.5,
                            tension: 0.1,
                            fill: false
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        x: {
                            grid: {
                                display: false
                            },
                            ticks: {
                                color: '#4a5568',
                                font: {
                                    weight: 'normal',
                                    size: 11
                                }
                            }
                        },
                        y: {
                            min: 0,
                            max: 140,
                            ticks: {
                                stepSize: 20,
                                color: '#4a5568',
                                font: {
                                    size: 11
                                }
                            },
                            grid: {
                                color: "rgba(226, 232, 240, 0.8)",
                                borderDash: [2, 2]
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                usePointStyle: true,
                                boxWidth: 14,
                                boxHeight: 14,
                                padding: 15,
                                color: '#2d3748',
                                font: {
                                    size: 12,
                                    weight: 'normal'
                                },
                                generateLabels: function(chart) {
                                    const originalLabels = Chart.defaults.plugins.legend.labels.generateLabels(chart);
                                    originalLabels.forEach((label, index) => {
                                        const dataset = chart.data.datasets[index];
                                        label.pointStyle = dataset.pointStyle;
                                        label.pointStyleWidth = 12;
                                    });
                                    return originalLabels;
                                }
                            }
                        }
                    }
                }
            });
        }

        $(document).ready(function() {
            if (window.location.hash === '#modalHapus') {
                tryHapus();
            }

            chartMonitoringIntraAnestesi();
            chartMonitoringPascaAnestesi();

            // 2. Tarik data dari database dan perbarui isinya
            getDataMonitoringIntra();
            getDataMonitoringPasca();
        });

        function tryTambahIntra() {

            $("#tombolSimpanIntra").show();
            $("#tombolTemplateIntra").show();
            $("#tombolUpdateIntra").hide();

            $('#inputWaktu').prop('disabled', false);

            $('#inputWaktu').val('');
            $('#inputSistolik').val(0);
            $('#inputDiastolik').val(0);
            $('#inputRR').val(0);
            $('#inputSpO2').val(0);
            $('#inputTemp').val(0);

            $('#modalIntraAnestesi').modal('show');
        }

        function simpanMonitoringIntra(tujuan) {
            var data = {
                // ID / Informasi Tambahan (Opsional/Disesuaikan)
                idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",

                // --- DATA WAKTU & TANDA VITAL ---
                waktu: $('#inputWaktu').val(),
                sistolik: parseFloat($('#inputSistolik').val()) || 0,
                diastolik: parseFloat($('#inputDiastolik').val()) || 0,
                rr: parseFloat($('#inputRR').val()) || 0,
                spo2: parseFloat($('#inputSpO2').val()) || 0,
                temp: parseFloat($('#inputTemp').val()) || 0,
                jenis: 'intra',
                tujuan: tujuan
            };

            // Validasi sederhana
            if (!data.waktu) {
                alert("Silakan isi waktu monitoring terlebih dahulu!");
                return;
            }

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/simpanMonitoring") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#inputWaktu').val('');
                    $('#inputSistolik').val(0);
                    $('#inputDiastolik').val(0);
                    $('#inputRR').val(0);
                    $('#inputSpO2').val(0);
                    $('#inputTemp').val(0);

                    $('#modalIntraAnestesi').modal('hide');

                    if (data.status === 'ignored') {
                        alert(data.message);
                    } else {
                        getDataMonitoringIntra();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function getDataMonitoringIntra() {
            var data = {
                // ID / Informasi Tambahan (Opsional/Disesuaikan)
                idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",
                jenis: 'intra'
            };

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoring") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Ambil data yang sudah dikelompokkan dari server untuk grafik
                        const cd = response.chart_data;
                        // Ambil data mentah dari database untuk tabel
                        const dbData = response.data_db;

                        // 1. Cek apakah grafik sudah diinisialisasi
                        if (window.myAnesthesiaChart instanceof Chart) {

                            // --- PERBARUI LABEL (SUMBU X / WAKTU) ---
                            window.myAnesthesiaChart.data.labels = cd.jam;

                            // --- PERBARUI DATA MASING-MASING DATASET ---
                            window.myAnesthesiaChart.data.datasets[0].data = cd.sistolik;
                            window.myAnesthesiaChart.data.datasets[1].data = cd.diastolik;
                            window.myAnesthesiaChart.data.datasets[2].data = cd.rr;
                            window.myAnesthesiaChart.data.datasets[3].data = cd.temp;
                            window.myAnesthesiaChart.data.datasets[4].data = cd.spo2;

                            // 2. Render ulang grafik agar perubahan langsung tampil
                            window.myAnesthesiaChart.update();

                            console.log("Grafik berhasil diperbarui dengan data terbaru!");

                            // --- 3. MUAT DATA KE DALAM TABEL ---
                            let rowsHtml = '';
                            if (dbData && dbData.length > 0) {
                                dbData.forEach(function(item) {
                                    rowsHtml += `<tr>
                                <td>${item.waktu}</td>
                                <td>${item.sistolik}</td>
                                <td>${item.diastolik}</td>
                                <td>${item.rr}</td>
                                <td>${item.spo2}</td>
                                <td>${item.temp}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info btn-sm py-0 px-1" onclick="tryEditIntra(${item.id})">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger btn-sm py-0 px-1" onclick="hapusMonitoring(${item.id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                                });
                            } else {
                                rowsHtml = `<tr><td colspan="7" class="text-center text-muted">Belum ada data monitoring.</td></tr>`;
                            }

                            // Masukkan baris ke dalam tbody tabel
                            $('#tabelIntraAnestesi').html(rowsHtml);

                        } else {
                            // Jika grafik belum ada/belum dirender, panggil fungsi pembuat chart utamanya
                            chartMonitoringAnestesi();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function tryEditIntra(id) {
            data = {
                id: id
            }

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoringById") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    $("#tombolSimpanIntra").hide();
                    $("#tombolTemplateIntra").hide();
                    $("#tombolUpdateIntra").show();

                    $('#inputWaktu').val(response.data.waktu);
                    $('#inputWaktu').prop('disabled', true);
                    $('#inputSistolik').val(response.data.sistolik);
                    $('#inputDiastolik').val(response.data.diastolik);
                    $('#inputRR').val(response.data.rr);
                    $('#inputSpO2').val(response.data.spo2);
                    $('#inputTemp').val(response.data.temp);

                    $("#modalIntraAnestesi").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function hapusMonitoring(id) {
            if (confirm("Apakah Anda yakin ingin menghapus data monitoring ini?")) {
                $.ajax({
                    url: '<?= base_url("rm/rm11b2MonitoringAnestesi/hapusMonitoring") ?>',
                    method: 'POST',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            getDataMonitoringIntra();
                            getDataMonitoringPasca();
                        } else {
                            alert(response.message || "Gagal menghapus data.");
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("Terjadi kesalahan: " + error);
                    }
                });
            }
        }

        function tryTambahPasca() {

            $("#tombolSimpanPasca").show();
            $("#tombolTemplatePasca").show();
            $("#tombolUpdatePasca").hide();

            $('#inputWaktu2').prop('disabled', false);

            $('#inputWaktu2').val('');
            $('#inputSistolik2').val(0);
            $('#inputDiastolik2').val(0);
            $('#inputRR2').val(0);
            $('#inputSpO22').val(0);
            $('#inputTemp2').val(0);

            $('#modalPascaAnestesi').modal('show');
        }

        function simpanMonitoringPasca(tujuan) {
            var data = {
                // ID / Informasi Tambahan (Opsional/Disesuaikan)
                idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",

                // --- DATA WAKTU & TANDA VITAL ---
                waktu: $('#inputWaktu2').val(),
                sistolik: parseFloat($('#inputSistolik2').val()) || 0,
                diastolik: parseFloat($('#inputDiastolik2').val()) || 0,
                rr: parseFloat($('#inputRR2').val()) || 0,
                spo2: parseFloat($('#inputSpO22').val()) || 0,
                temp: parseFloat($('#inputTemp2').val()) || 0,
                jenis: 'pasca',
                tujuan: tujuan
            };

            // Validasi sederhana
            if (!data.waktu) {
                alert("Silakan isi waktu monitoring terlebih dahulu!");
                return;
            }

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/simpanMonitoring") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(data) {
                    $('#inputWaktu2').val('');
                    $('#inputSistolik2').val(0);
                    $('#inputDiastolik2').val(0);
                    $('#inputRR2').val(0);
                    $('#inputSpO22').val(0);
                    $('#inputTemp2').val(0);

                    $('#modalPascaAnestesi').modal('hide');

                    if (data.status === 'ignored') {
                        alert(data.message);
                    } else {
                        getDataMonitoringPasca();
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function getDataMonitoringPasca() {
            var data = {
                // ID / Informasi Tambahan (Opsional/Disesuaikan)
                idMonitoring: "<?= isset($data->rm11b2MonitoringAnestesi['id']) ? $data->rm11b2MonitoringAnestesi['id'] : '' ?>",
                jenis: 'pasca'
            };

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoring") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    if (response.status === 'success') {
                        // Ambil data yang sudah dikelompokkan dari server untuk grafik
                        const cd = response.chart_data;
                        // Ambil data mentah dari database untuk tabel
                        const dbData = response.data_db;

                        // 1. Cek apakah grafik sudah diinisialisasi
                        if (window.myAnesthesiaChart instanceof Chart) {

                            // --- PERBARUI LABEL (SUMBU X / WAKTU) ---
                            window.myAnesthesibChart.data.labels = cd.jam;

                            // --- PERBARUI DATA MASING-MASING DATASET ---
                            window.myAnesthesibChart.data.datasets[0].data = cd.sistolik;
                            window.myAnesthesibChart.data.datasets[1].data = cd.diastolik;
                            window.myAnesthesibChart.data.datasets[2].data = cd.rr;
                            window.myAnesthesibChart.data.datasets[3].data = cd.temp;
                            window.myAnesthesibChart.data.datasets[4].data = cd.spo2;

                            // 2. Render ulang grafik agar perubahan langsung tampil
                            window.myAnesthesibChart.update();

                            console.log("Grafik berhasil diperbarui dengan data terbaru!");

                            // --- 3. MUAT DATA KE DALAM TABEL ---
                            let rowsHtml = '';
                            if (dbData && dbData.length > 0) {
                                dbData.forEach(function(item) {
                                    rowsHtml += `<tr>
                                <td>${item.waktu}</td>
                                <td>${item.sistolik}</td>
                                <td>${item.diastolik}</td>
                                <td>${item.rr}</td>
                                <td>${item.spo2}</td>
                                <td>${item.temp}</td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-info btn-sm py-0 px-1" onclick="tryEditPasca(${item.id})">
                                        <i class="fa fa-pen"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-danger btn-sm py-0 px-1" onclick="hapusMonitoring(${item.id})">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>`;
                                });
                            } else {
                                rowsHtml = `<tr><td colspan="7" class="text-center text-muted">Belum ada data monitoring.</td></tr>`;
                            }

                            // Masukkan baris ke dalam tbody tabel
                            $('#tabelPascaAnestesi').html(rowsHtml);

                        } else {
                            // Jika grafik belum ada/belum dirender, panggil fungsi pembuat chart utamanya
                            chartMonitoringAnestesi();
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

        function tryEditPasca(id) {
            data = {
                id: id
            }

            $.ajax({
                url: '<?= base_url("rm/rm11b2MonitoringAnestesi/getDataMonitoringById") ?>',
                method: 'POST',
                data: data,
                dataType: 'json',
                success: function(response) {
                    $("#tombolSimpanPasca").hide();
                    $("#tombolTemplatePasca").hide();
                    $("#tombolUpdatePasca").show();

                    $('#inputWaktu2').val(response.data.waktu);
                    $('#inputWaktu2').prop('disabled', true);
                    $('#inputSistolik2').val(response.data.sistolik);
                    $('#inputDiastolik2').val(response.data.diastolik);
                    $('#inputRR2').val(response.data.rr);
                    $('#inputSpO22').val(response.data.spo2);
                    $('#inputTemp2').val(response.data.temp);

                    $("#modalPascaAnestesi").modal('show');
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Terjadi kesalahan: " + error);
                }
            });
        }

    <?php endif; ?>
</script>
<?php $this->endSection() ?>