<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RSIA Aisyiyah | Log in </title>
    <link rel="icon" type="image/x-icon" href="<?= base_url() ?>public/assets/img/rsiaaisyiyahicon.ico">

    <!-- Bootstrap -->

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1745f7e20d.js" crossorigin="anonymous"></script>

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>public/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
</head>

<body class="bg-light d-flex align-items-center justify-content-center min-vh-100" style="background: linear-gradient(135deg, rgba(240,244,248,0.9), rgba(209,230,245,0.0)), url('<?= base_url() . "public/assets/img/login.jpg" ?>') no-repeat center center; background-size: cover;">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-md-6 col-lg-4">

                <!-- Card Login -->
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-sm-5 bg-white">

                        <!-- Logo & Title -->
                        <div class="text-center mb-4">
                            <img src="<?= base_url() ?>public/assets/img/logorsia.png" class="img-fluid mb-3" style="max-height: 70px; object-fit: contain;" alt="Logo RSIA">
                            <h4 class="fw-bold text-secondary m-0">Selamat Datang</h4>
                            <small class="text-muted">Silahkan masuk ke akun Anda</small>
                        </div>

                        <!-- Flash Message / Alert -->
                        <?php if (session()->getFlashdata('message')) : ?>
                            <div class="alert alert-danger text-center py-2 small" role="alert">
                                <?= session()->getFlashdata('message'); ?>
                            </div>
                        <?php endif; ?>

                        <!-- Form -->
                        <form method="post" action="<?= base_url() ?>login/auth">

                            <!-- Input Nama / User (Dropdown) -->
                            <div class="mb-3">
                                <label for="nama" class="form-label small fw-semibold text-muted">Pilih Pengguna</label>
                                <select class="form-select" id="nama" name="nama" required>
                                    <option value="" disabled selected hidden>Pilih nama Anda...</option>
                                    <?php for ($i = 0; $i < count($user); $i++) : ?>
                                        <option value="<?= $user[$i]["id"] ?>">
                                            <?= $user[$i]["id"] . ". " . $user[$i]["nama"] ?>
                                        </option>
                                    <?php endfor; ?>
                                </select>
                            </div>

                            <!-- Input Password -->
                            <div class="mb-4">
                                <label for="password" class="form-label small fw-semibold text-muted">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan password" required />
                            </div>

                            <!-- Tombol Submit -->
                            <div class="d-grid mb-4">
                                <button type="submit" class="btn btn-primary fw-semibold py-2 rounded-3 shadow-sm">
                                    <i class="fa fa-sign-in-alt me-2"></i> Log in
                                </button>
                            </div>

                            <hr class="text-muted opacity-25">

                            <!-- Footer Instansi -->
                            <div class="text-center mt-3 pt-2">
                                <p class="m-0 text-secondary fw-semibold small">
                                    <i class="fa fa-hospital text-primary me-1"></i> RSIA Aisyiyah
                                </p>
                                <span class="badge bg-secondary-subtle text-secondary px-2 py-1 rounded-pill style=" font-size: 0.75rem;">Bangkalan</span>
                            </div>

                            <!-- Footer Developer -->
                            <div class="text-center mt-4">
                                <sub class="text-muted text-opacity-70 d-block" style="font-size: 0.7rem;">
                                    Made by <b>MN Dev</b> with <i class="fa fa-heart text-danger"></i>
                                </sub>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- End Card -->

            </div>
        </div>
    </div>

</body>

</html>