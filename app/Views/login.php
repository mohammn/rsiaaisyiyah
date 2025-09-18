<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>RSIA Aisyiyah | Log in </title>

    <!-- Bootstrap -->

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/1745f7e20d.js" crossorigin="anonymous"></script>

    <!-- Custom Theme Style -->
    <link href="<?= base_url() ?>public/css/custom.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.min.css">
</head>

<body class="login" style="background :url(<?= base_url() . "public/assets/img/login.jpg" ?>); height:100%; background-position:center; background-size: cover; no-repeat;">
    <div>
        <div class="login_wrapper" style="background-color: #98e6b8ff; padding:20px;">
            <form method="post" action="<?= base_url() ?>login/auth">
                <img src="<?= base_url() ?>public/assets/img/logorsia.png" width="90%" alt="">
                <h3 class="inline-block">Login</h3>
                <div class="form-group row mt-2">
                    <select class="form-control" id="nama" name="nama">
                        <?php for ($i = 0; $i < count($user); $i++) : ?>
                            <option value="<?= $user[$i]["id"] ?>"><?= $user[$i]["id"] . ". " . $user[$i]["nama"] ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
                <div class="form-group row">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password" required />
                </div>
                <div class="form-group row">
                    <input type="submit" class="btn btn-success" value="Log in" />
                </div>

                <div class="row">
                    <div class="col-12 text-center"><?php echo session()->getFlashdata('message'); ?></div>
                </div>

                <div class="clearfix"></div>

                <div class="separator">

                    <div class="clearfix"></div>

                    <div>
                        <sub>Made by <b>MN Dev</b> with <i class="fa fa-heart text-danger" aria-hidden="true"></i> to : </sub><br>
                        <h4 style="display: inline;"><i style="color: white;" class="fa fa-hospital"></i> RSIA Aisyiyah </h4><sub>Bangkalan</sub>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>