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
        /* Container Utama yang membungkus Gambar + Teks */
        .marquee-wrapper {
            display: flex;
            align-items: center;
            width: 45%;
            /* Menggantikan fungsi width 30% + margin Anda agar pas di navbar */
            margin-left: auto;
            /* Otomatis menggeser seluruh komponen ke kanan navbar */
            overflow: hidden;
        }

        /* Container khusus teks berjalan */
        .running-text-container {
            flex-grow: 1;
            /* Mengisi sisa ruang di sebelah kanan gambar */
            overflow: hidden;
            white-space: nowrap;
            box-sizing: border-box;
            padding: 5px;
        }

        .running-text {
            display: inline-block;
            padding-left: 100%;
            animation: marquee 17s linear infinite;
        }

        /* Animasi Marquee (Pastikan ini sudah ada di CSS Anda) */
        @keyframes marquee {
            0% {
                transform: translate(0, 0);
            }

            100% {
                transform: translate(-100%, 0);
            }
        }

        /* ==========================================================================
   1. BUTTON ESTETIK (Solid Fill & Kontras Tinggi)
   ========================================================================== */

        .btn-estetik {
            border: none !important;
            color: #ffffff !important;
            padding: 6px 14px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 12px;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            cursor: pointer;
            text-decoration: none !important;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .btn-estetik:hover {
            filter: brightness(0.9) !important;
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.12);
            color: #000 !important;
            /* Paksa teks tetap putih terang */
        }

        .btn-estetik:active {
            transform: translateY(0);
        }

        /* Warna Solid Tombol (Class Asli Kamu) */
        .btn-simpan {
            background-color: #10b981 !important;
        }

        .btn-lihat {
            background-color: #4a90e2 !important;
        }

        .btn-edit {
            background-color: #6366f1 !important;
        }

        .btn-cetak {
            background-color: #0fb9b1 !important;
        }

        .btn-hapus {
            background-color: #eb4d4b !important;
        }

        .btn-batal {
            background-color: #94a3b8 !important;
        }

        /* FontAwesome Spacing */
        .btn-estetik i {
            font-size: 12px;
            text-align: center;
        }

        /* Varian Tombol Kecil */
        .btn-sm-estetik {
            padding: 3px 9px !important;
            font-size: 11px !important;
            border-radius: 4px;
        }

        .btn-sm-estetik i {
            font-size: 10px !important;
        }


        /* ==========================================================================
   2. BADGE STATUS (Soft Transparan & Elegant Border)
   ========================================================================== */

        .badge-estetik {
            padding: 3px 10px;
            border-radius: 50px;
            /* Bentuk Kapsul Modern */
            font-size: 11px;
            font-weight: 600;
            display: inline-block;
            letter-spacing: 0.3px;
            border: 1px solid transparent;
        }

        /* Perubahan Warna Badge Transparan Elegan (Class Asli Kamu) */

        /* Biru (Sudah / Lengkap) */
        .bg-vibrant-blue {
            background-color: rgba(74, 144, 226, 0.12) !important;
            border-color: rgba(74, 144, 226, 0.3) !important;
            color: #2563eb !important;
        }

        /* Ungu (Proses / Lihat) */
        .bg-vibrant-purple {
            background-color: rgba(99, 102, 241, 0.12) !important;
            border-color: rgba(99, 102, 241, 0.3) !important;
            color: #4f46e5 !important;
        }

        /* Tosca / Teal (Cetak / TTD) */
        .bg-vibrant-teal {
            background-color: rgba(15, 185, 177, 0.12) !important;
            border-color: rgba(15, 185, 177, 0.3) !important;
            color: #0d9488 !important;
        }

        /* Merah (Belum / Hapus / Tidak Lengkap) */
        .bg-vibrant-red {
            background-color: rgba(235, 77, 75, 0.12) !important;
            border-color: rgba(235, 77, 75, 0.3) !important;
            color: #dc2626 !important;
        }

        /* Abu-abu Soft Netral */
        .bg-vibrant-gray {
            background-color: rgba(148, 163, 184, 0.15) !important;
            border-color: rgba(148, 163, 184, 0.3) !important;
            color: #475569 !important;
        }

        /* ==========================================================================
   GLOBAL TYPOGRAPHY & RESET (SB-ADMIN MODERN OVERRIDE)
   ========================================================================== */

        /* 1. Font System & Base Typography (Global) */
        body,
        .sb-nav-fixed,
        #layoutSidenav_content {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif !important;
            font-size: 13px !important;
            /* Ukuran dasar UI modern (ringkas & padat) */
            color: #334155 !important;
            /* Slate dark (nyaman di mata) */
            background-color: #f8fafc !important;
            /* Background halaman soft */
        }

        /* 2. Overrides Semua Heading (H1 - H6) */
        h1,
        .h1 {
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            letter-spacing: -0.3px;
        }

        h2,
        .h2 {
            font-size: 1.35rem !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            letter-spacing: -0.3px;
        }

        h3,
        .h3 {
            font-size: 1.2rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        h4,
        .h4 {
            font-size: 1.1rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        h5,
        .h5 {
            font-size: 0.95rem !important;
            font-weight: 600 !important;
            color: #1e293b !important;
        }

        h6,
        .h6 {
            font-size: 0.85rem !important;
            font-weight: 600 !important;
            color: #475569 !important;
        }

        /* 3. Header Navbar Atas (Top Navigation Bar) */
        .sb-topnav,
        .navbar {
            font-size: 13px !important;
            background-color: #ffffff !important;
            border-bottom: 1px solid #e2e8f0 !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.02) !important;
        }

        .sb-topnav .navbar-brand {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
            letter-spacing: -0.2px;
        }

        /* 4. Sidebar Navigasi Kiri */
        .sb-sidenav {
            background-color: #ffffff !important;
            border-right: 1px solid #e2e8f0 !important;
        }

        .sb-sidenav .sb-sidenav-menu-heading,
        .sidebar-heading {
            font-size: 10px !important;
            font-weight: 700 !important;
            letter-spacing: 0.8px !important;
            color: #94a3b8 !important;
            text-transform: uppercase !important;
            padding: 16px 16px 4px 16px !important;
        }

        .sb-sidenav .nav-link {
            font-size: 12.5px !important;
            font-weight: 500 !important;
            color: #475569 !important;
            padding: 8px 14px !important;
            margin: 2px 10px !important;
            border-radius: 6px !important;
            transition: all 0.2s ease !important;
        }

        .sb-sidenav .nav-link:hover {
            color: #2563eb !important;
            background-color: #f1f5f9 !important;
        }

        .sb-sidenav .nav-link .sb-nav-link-icon {
            font-size: 13px !important;
            color: #64748b !important;
        }

        .sb-sidenav .nav-link:hover .sb-nav-link-icon {
            color: #2563eb !important;
        }

        /* 5. Card Container / Panel (FIXED FOR WIDGETS & REGULAR CARDS) */

        /* Card Default / Biasa */
        .card:not([class*="bg-"]) {
            border: 1px solid #e2e8f0 !important;
            border-radius: 10px !important;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04) !important;
            background-color: #ffffff !important;
        }

        .card:not([class*="bg-"]) .card-header {
            background-color: #ffffff !important;
            border-bottom: 1px solid #f1f5f9 !important;
            font-size: 13px !important;
            font-weight: 600 !important;
            color: #1e293b !important;
            padding: 12px 16px !important;
        }

        /* Fix Card Warna / Card Widget (Dashboard Stats) */
        .card[class*="bg-"] {
            border: none !important;
            border-radius: 10px !important;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06) !important;
        }

        .card[class*="bg-"],
        .card[class*="bg-"] .card-body,
        .card[class*="bg-"] .card-footer,
        .card[class*="bg-"] .text-white,
        .card[class*="bg-"] a,
        .card[class*="bg-"] i {
            color: #ffffff !important;
            /* Paksa warna teks & elemen di dalamnya kembali putih */
        }

        /* Modern Gradient untuk Widget Warna Dashboard */
        .card.bg-primary {
            background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
        }

        .card.bg-success {
            background: linear-gradient(135deg, #10b981, #059669) !important;
        }

        .card.bg-warning {
            background: linear-gradient(135deg, #f59e0b, #d97706) !important;
        }

        .card.bg-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626) !important;
        }

        .card.bg-info {
            background: linear-gradient(135deg, #06b6d4, #0891b2) !important;
        }


        /* 6. SEMUA TABEL & DATATABLES GLOBAL */
        table,
        .table,
        table.dataTable {
            font-size: 12px !important;
            color: #334155 !important;
            border-color: #f1f5f9 !important;
        }

        table th,
        .table th,
        table.dataTable thead th {
            font-size: 11.5px !important;
            font-weight: 700 !important;
            color: #475569 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            background-color: #f8fafc !important;
            border-bottom: 2px solid #e2e8f0 !important;
            padding: 10px 12px !important;
        }

        table td,
        .table td,
        table.dataTable tbody td {
            padding: 8px 12px !important;
            vertical-align: middle !important;
        }

        /* Kontrol DataTables (Show entries, Search, Pagination) */
        .dataTables_wrapper {
            font-size: 12px !important;
            color: #64748b !important;
        }

        .dataTables_wrapper .dataTables_filter input,
        .dataTables_wrapper .dataTables_length select,
        .form-control,
        .form-select {
            font-size: 12px !important;
            border-radius: 6px !important;
            border: 1px solid #cbd5e1 !important;
            padding: 5px 10px !important;
            color: #334155 !important;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #4a90e2 !important;
            box-shadow: 0 0 0 3px rgba(74, 144, 226, 0.15) !important;
        }

        /* 7. Modal & Popup */
        .modal-content {
            border-radius: 10px !important;
            border: none !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }

        .modal-header {
            border-bottom: 1px solid #f1f5f9 !important;
            padding: 14px 20px !important;
        }

        .modal-title {
            font-size: 14px !important;
            font-weight: 700 !important;
            color: #0f172a !important;
        }

        /* ==========================================================================
   DATATABLES v2 PAGINATION & DROPDOWN OVERRIDE (PRESISI BANTUAN INSPECT)
   ========================================================================== */

        /* 1. PERBAIKAN DROPDOWN LENGTH (DataTables v2) */
        .dt-container .dt-length select,
        div.dt-container div.dt-length select {
            padding-top: 4px !important;
            padding-bottom: 4px !important;
            padding-left: 10px !important;
            padding-right: 26px !important;
            /* Mencegah panah nindih angka */
            font-size: 12px !important;
            height: auto !important;
            min-width: 60px !important;
            border-radius: 6px !important;
            border: 1px solid #cbd5e1 !important;
            background-color: #ffffff !important;
            cursor: pointer !important;
            /* Custom Icon Panah Halus */
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%3c64748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e") !important;
            background-repeat: no-repeat !important;
            background-position: right 8px center !important;
            background-size: 10px 10px !important;
            -webkit-appearance: none !important;
            -moz-appearance: none !important;
            appearance: none !important;
        }

        /* 2. PERBAIKAN PAGINATION (DataTables v2 + Bootstrap 5) */
        .dt-container .dt-paging ul.pagination {
            gap: 5px !important;
            /* Kasih jarak antar tombol pagination */
            margin: 0 !important;
        }

        /* Base State Tombol Page (Menembak ke tag button.page-link) */
        .dt-container .dt-paging .dt-paging-button .page-link {
            border: 1px solid #e2e8f0 !important;
            border-radius: 6px !important;
            /* Bikin tombol melengkung modern */
            background: #ffffff !important;
            color: #475569 !important;
            font-size: 12px !important;
            font-weight: 500 !important;
            padding: 6px 12px !important;
            margin: 0 !important;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            transition: all 0.2s ease !important;
        }

        /* Hover State */
        .dt-container .dt-paging .dt-paging-button:not(.active):not(.disabled) .page-link:hover {
            background: #f1f5f9 !important;
            color: #2563eb !important;
            border-color: #cbd5e1 !important;
        }

        /* Active State (Halaman Aktif) */
        .dt-container .dt-paging .dt-paging-button.active .page-link {
            background: #2563eb !important;
            /* Biru Solid Modern */
            color: #ffffff !important;
            border-color: #2563eb !important;
            font-weight: 600 !important;
            box-shadow: 0 2px 4px rgba(37, 99, 235, 0.25) !important;
        }

        /* Disabled State (Tombol Mati) */
        .dt-container .dt-paging .dt-paging-button.disabled .page-link {
            background: #f8fafc !important;
            color: #94a3b8 !important;
            border-color: #e2e8f0 !important;
            cursor: not-allowed !important;
            opacity: 0.6 !important;
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

            <div class="marquee-wrapper">
                <div class="me-2 flex-shrink-0">
                    <img src="<?= base_url() ?>public/assets/img/gif/penguin.gif" alt="run" style="width: 35px; height: auto;">
                </div>

                <div class="running-text-container">
                    <div class="running-text">
                        Selamat datang "<?= session()->get('nama') ?>" di aplikasi rekam medis elektronik RSIA Aisyiyah Bangkalan. Jl. Letnan Ramli No.21, Rw. 02, Keraton, Bangkalan.
                    </div>
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