<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body">
                    <div class="small text-white"><i class="fas fa-user"></i> <?= $pasienRajalHariIni ?> Orang</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Pasien Rawat Jalan Hari ini
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body">
                    <div class="small text-white"><i class="fas fa-user"></i> <?= $pasienRajalKemarin ?> Orang</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Pasien Rawat Jalan Kemarin
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-success text-white mb-4">
                <div class="card-body">
                    <div class="small text-white"><i class="fas fa-user"></i> <?= $pasienRanapHariIni ?> Orang</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Pasien Rawat Inap Hari ini
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body">
                    <div class="small text-white"><i class="fas fa-user"></i> <?= $pasienRanapKemarin ?> Orang</div>
                </div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    Pasien Rawat Inap Kemarin
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-area me-1"></i>
                    Pasien Rawat Jalan / Bulan
                </div>
                <div class="card-body"><canvas id="chartPasienRajal" width="100%" height="40"></canvas></div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Pasien Rawat Inap / Bulan
                </div>
                <div class="card-body"><canvas id="chartPasienRanap" width="100%" height="40"></canvas></div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/0.7.0/chartjs-plugin-datalabels.min.js"></script>
<script>
    chartRajalPerbulan()
    chartRanapPerbulan()

    function chartRajalPerbulan() {
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Area Chart Example
        var chartRajal = document.getElementById("chartPasienRajal");
        var chartRajalPerbulan = new Chart(chartRajal, {
            type: 'line',
            data: {
                labels: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
                datasets: [{
                    label: "Pasien ",
                    lineTension: 0.3,
                    backgroundColor: "rgba(2,117,216,0.2)",
                    borderColor: "rgba(2,117,216,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(2,117,216,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(2,117,216,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                }],
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        formatter: function(value) {
                            return value;
                        },
                        font: {
                            weight: 'italic'
                        }
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            },
            // plugin tersedia di global variable ChartDataLabels
            plugins: [ChartDataLabels]
        });

        $.ajax({
            url: '<?= base_url() ?>dashboard/pasienPerBulan',
            method: 'post',
            data: "jenis=Ralan",
            dataType: 'json',
            success: function(data) {
                chartRajalPerbulan.data.datasets[0].data = data.total;
                chartRajalPerbulan.data.labels = data.bulan;

                chartRajalPerbulan.update();
            }
        });


    }



    function chartRanapPerbulan() {
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Bar Chart Example
        var chartRanap = document.getElementById("chartPasienRanap");
        var chartRanapPerbulan = new Chart(chartRanap, {
            type: 'bar',
            data: {
                labels: [
                    "Januari",
                    "Februari",
                    "Maret",
                    "April",
                    "Mei",
                    "Juni",
                    "Juli",
                    "Agustus",
                    "September",
                    "Oktober",
                    "November",
                    "Desember"
                ],
                datasets: [{
                    label: "Pasien",
                    backgroundColor: "rgba(99, 172, 236, 1)",
                    borderColor: "rgba(112, 179, 237, 1)",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'month'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 12
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });

        $.ajax({
            url: '<?= base_url() ?>dashboard/pasienPerBulan',
            method: 'post',
            data: "jenis=Ranap",
            dataType: 'json',
            success: function(data) {
                chartRanapPerbulan.data.datasets[0].data = data.total;
                chartRanapPerbulan.data.labels = data.bulan;

                chartRanapPerbulan.update();
            }
        })
    }
</script>

<?php $this->endSection() ?>