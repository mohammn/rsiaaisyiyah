<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>RSIA Aisyiyah</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="<?= base_url() ?>public/css/styles.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/1745f7e20d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- In the <head> section -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.3.4/css/dataTables.bootstrap5.css">

    <!-- Just before the closing </body> tag -->
    <!-- <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.bundle.min.js"></script> -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.3.4/js/dataTables.bootstrap5.js"></script>
    <style>
        .running-text-container {
            width: 30%;
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            padding: 5px;
            margin-left: 65%;
        }

        .running-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 17s linear infinite;
        }

        @keyframes marquee {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-100%, 0);
            }
        }

        /* Base Style */
        .btn-estetik {
            border: none;
            color: #ffffff !important;
            padding: 8px 18px;
            border-radius: 6px;
            font-weight: 600;
            /* Sedikit lebih tebal agar teks lebih jelas di warna cerah */
            font-size: 13px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.1);
            /* Efek matte dalam */
        }

        .btn-estetik:hover {
            /* Gunakan 0.9 agar warna sedikit lebih deep/gelap saat disentuh mouse */
            filter: brightness(0.9);

            /* Efek mengangkat sedikit tetap dipertahankan */
            transform: translateY(-2px);

            /* Perkuat bayangan agar tombol terlihat benar-benar melayang di atas background putih */
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.1), 0 6px 12px rgba(0, 0, 0, 0.15);

            /* Paksa teks tetap putih */
            color: #000000 !important;

            /* Opsional: tambah sedikit kontras */
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
        }

        /* PALET WARNA VIBRANT MATTE (Lebih Tegas) */

        /* Blue Steel (Solid & Profesional) */
        .btn-simpan {
            background-color: #10b981;
        }

        .btn-lihat {
            background-color: #4a90e2;
        }

        /* Electric Purple/Indigo (Modern & Tajam) */
        .btn-edit {
            background-color: #6366f1;
        }

        /* Fresh Teal (Cerah & Bersih) */
        .btn-cetak {
            background-color: #0fb9b1;
        }

        /* Bright Terracotta/Red (Tegas & Berani) */
        .btn-hapus {
            background-color: #eb4d4b;
        }

        .btn-batal {
            background-color: #94a3b8;
        }

        /* FontAwesome Spacing */
        .btn-estetik i {
            width: 18px;
            text-align: center;
        }

        /* --- Varian Tombol Kecil (Small) --- */
        .btn-sm-estetik {
            /* Menimpa padding tombol besar menjadi seukuran badge */
            padding: 3px 10px !important;
            font-size: 11px !important;
            border-radius: 4px;
            /* Radius lebih kecil agar proporsional */
        }

        /* Penyesuaian Icon untuk tombol kecil */
        .btn-sm-estetik i {
            width: 14px !important;
            font-size: 10px !important;
            margin-right: 3px !important;
        }

        /* --- Label Status (Badge) --- */
        .badge-estetik {
            padding: 4px 10px;
            border-radius: 50px;
            /* Bentuk kapsul agar beda dengan tombol */
            font-size: 11px;
            font-weight: 700;
            color: #ffffff !important;
            /* Membuat teks status lebih tegas */
            display: inline-block;
            letter-spacing: 0.5px;
        }

        /* --- PALET WARNA (SERAGAM) --- */

        /* Biru (Tambah / Lengkap / Sudah) */
        .bg-vibrant-blue {
            background-color: #4a90e2;
        }

        /* Ungu (Lihat / Sedang Proses) */
        .bg-vibrant-purple {
            background-color: #6366f1;
        }

        /* Tosca/Teal (Cetak / TTD) */
        .bg-vibrant-teal {
            background-color: #0fb9b1;
        }

        /* Merah (Hapus / Belum / Tidak Lengkap) */
        .bg-vibrant-red {
            background-color: #eb4d4b;
        }

        /* Abu-abu Matte (Tidak Perlu / Netral) */
        .bg-vibrant-gray {
            background-color: #94a3b8;
        }
    </style>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-light bg-light">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="dashboard"><img src="<?= base_url() ?>public/assets/img/logorsiaaisyiyah.png" alt="logo RSIA Aisyiyah" style="width:15%;"> RSIA Aisyiyah</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search-->
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        </div>
        <div class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="running-text-container">
                <div class="running-text">
                    <img src="<?= base_url() ?>public/assets/img/gif/pokemon.gif" alt="run" style="width:5%;"> Selamat datang "<?= session()->get('nama') ?>" di aplikasi rekam medis elektronik RSIA Aisyiyah Bangkalan. Jl. Letnan Ramli No.21, Rw. 02, Keraton, Bangkalan.
                </div>
            </div>
        </div>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li>
                        <hr class="dropdown-divider" />
                    </li>
                    <li><a class="dropdown-item" href="<?= base_url() ?>login/logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading" style="padding:1px;">
                            <img src="<?= base_url() ?>public/assets/img/rsia.jpg" alt="" class="img-fluid" alt="Responsive image">
                        </div>
                        <div class="sb-sidenav-menu-heading">Menu</div>
                        <a class="nav-link <?= (uri_string() == 'dashboard') ? 'active' : '' ?>" href="<?= base_url() ?>dashboard">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <?php if (session()->get('rule') == 2): ?>
                            <a class="nav-link <?= (uri_string() == 'pengaturan') ? 'active' : '' ?>" href="<?= base_url() ?>pengaturan">
                                <div class="sb-nav-link-icon"><i class="fas fa-gears"></i></div>
                                Pengaturan
                            </a>
                        <?php endif; ?>
                        <div class="sb-sidenav-menu-heading">Layanan</div>
                        <a class="nav-link <?= (uri_string() == 'ranap') ? 'active' : '' ?>" href="<?= base_url() ?>ranap">
                            <div class="sb-nav-link-icon"><i class="fas fa-bed"></i></div>
                            Rawat Inap
                        </a><a class="nav-link <?= (uri_string() == 'rajal') ? 'active' : '' ?>" href="<?= base_url() ?>rajal">
                            <div class="sb-nav-link-icon"><i class="fas fa-wheelchair"></i></div>
                            Rawat Jalan
                        </a><a class="nav-link <?= (uri_string() == 'igd') ? 'active' : '' ?>" href="<?= base_url() ?>igd">
                            <div class="sb-nav-link-icon"><i class="fas fa-ambulance"></i></div>
                            Ins. Gawat Darurat
                        </a>
                        <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#rme" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-book"></i></div>
                            Rekam Medis
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="rme" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="persetujuanRajal">Persetujuan rawat jalan</a>
                            </nav>
                        </div> -->
                        <div class="sb-sidenav-menu-heading">Data Master</div>
                        <a class="nav-link <?= (uri_string() == 'pasien') ? 'active' : '' ?>" href="<?= base_url() ?>pasien">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Pasien
                        </a>
                        <?php if (session()->get('rule') == 1 or session()->get('rule') == 2) { ?>
                            <a class="nav-link <?= (uri_string() == 'user') ? 'active' : '' ?>" href="<?= base_url() ?>user">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                User
                            </a>
                            <a class="nav-link <?= (uri_string() == 'log') ? 'active' : '' ?>" href="<?= base_url() ?>log">
                                <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                                Log
                            </a>
                        <?php } ?>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Login sebagai :</div>
                    <?= session()->get('nama') ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <?php $this->renderSection('content'); ?>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Made by <b>MN Dev</b> with <i class="fa fa-heart text-danger" aria-hidden="true"></i> for <b>RSIA Aisyiyah Bangkalan</b></div>
                        <div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="<?= base_url() ?>/public/js/scripts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="<?= base_url() ?>/public/js/datatables-simple-demo.js"></script>
</body>

</html>