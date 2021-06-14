<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Kasir Toko | Login</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/bootstrap.min.css">
    <!-- Our Custom CSS -->
    <link rel=" stylesheet" href="<?= base_url() ?>/assets/css/style.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="<?= base_url() ?>/assets/css/jquery.mCustomScrollbar.min.css">
    <!-- Font Awesome JS -->
    <script defer src="<?= base_url() ?>/assets/js/solid.js"></script>
    <script defer src="<?= base_url() ?>/assets/js/fontawesome.js"></script>
    <script src="<?= base_url() ?>/assets/js/jquery-3.6.0.min.js"></script>

    <style>
    .navbar-login {
        width: 100%;
        height: 100px;
        background-color: silver;
        vertical-align: middle;
    }

    .judul {
        line-height: 1.5;
        display: inline-block;
        vertical-align: middle;
        color: #3C378F;
    }

    .navbar-default {
        box-shadow: none;
        background-color: transparent;
    }

    .form-login {
        background-color: #6C63FF;
        width: 350px;
        height: 400px;
        border-radius: 10px;
        display: inline-block;
        vertical-align: middle;
    }

    .bg-login {
        position: absolute;
        /* right: -20px; */
        /* top: 0px; */
        /* height: 100%; */
        width: 100%;
        bottom: 0px;
    }

    .input-size {
        width: 270px;
        height: 50px;
    }

    .containerform {
        width: 350px;
        height: 400px;
        background-color: #6C63FF;
        border-radius: 10px;
    }

    .img-login {
        width: 0px;
        height: 0px;
    }

    @media only screen and (min-width: 992px) {
        .img-login {
            width: 100%;
            height: 100%;
        }
    }
    </style>

</head>

<body>
    <!-- bg -->
    <img class="bg-login" src="<?= base_url() ?>/assets/img/shadow-bg-login.svg" class="d-flex justify-content-center"
        alt="">

    <div class="ml-5">
        <nav class="navbar navbar-default ">
            <a class="navbar-brand offset-1" href="#">
                <!-- <img  src="<?= base_url() ?>/assets/img/Storefront.svg" class="d-inline-block" alt=""> -->
                <img width="60px" src="<?= base_url() ?>/assets/img/logo.png" class="d-inline-block mr-3" alt="">
                <h2 class="judul">KASIR TOKO</h2>
            </a>
        </nav>
    </div>

    <div class="container d-flex justify-content-center">
        <div class="row">
            <!-- login form -->
            <div class="col-lg-5 col-sm-12">
                <div class="containerform">

                    <h5 class="pt-5 pb-2 d-flex justify-content-center">login to your account</h5>

                    <div class="d-flex justify-content-center">
                        <form action="<?= base_url() ?>/login/auth">
                            <?php if (session()->getFlashdata('msg')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('msg') ?></div>
                            <?php endif; ?>
                            <div class="form-group my-4">
                                <input type="text" placeholder="username" name="username"
                                    class="form-control input-size" id="inputUserName">
                            </div>
                            <div class="form-group my-4">
                                <div class="input-group" id="show_hide_password">
                                    <input type="password" placeholder="passowrd" name="password"
                                    class="form-control input-size" id="inputPassword">
                                    <div class="input-group-append">
                                        <div class="input-group-text" id="basic-addon2">
                                        <a href=""><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            

                            
                            <div class="">
                                <button type="submit" class="btn input-size"
                                    style="background-color: #3C378F; color: white;">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- login image -->
            <div class="col-lg-7 col-sm-12">
                <div class="d-flex justify-content-center">
                    <img class="img-login" src="<?= base_url() ?>/assets/img/Login.svg">
                </div>
            </div>
            <!-- and row -->
        </div>
    </div>

    <!-- FOOTER -->


    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="<?= base_url() ?>/assets/js/jquery-3.3.1.slim.min.js"> </script>
    <!-- Popper.JS -->
    <script src="<?= base_url() ?>/assets/js//popper.min.js"> </script>
    <!-- Bootstrap JS -->
    <script src="<?= base_url() ?>/assets/js/bootstrap.min.js"> </script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="<?= base_url() ?>/assets/js/jquery.mCustomScrollbar.concat.min.js"> </script>

    <script type="text/javascript">
    $(document).ready(function() {
        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function() {
            $('#sidebar, #content').toggleClass('active');
            $('.collapse.in').toggleClass('in');
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });
    });


    /////// SHOW/HIDE password /////
    $(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye-slash" );
            $('#show_hide_password i').removeClass( "fa-eye" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
            $('#show_hide_password i').addClass( "fa-eye" );
        }
    });
});


    </script>




    <!-- <i toggle="#password-field" class=" fa fa-fw fa-eye field-icon toggle-password"></i> -->
</body>

</html>