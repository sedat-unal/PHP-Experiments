<?php
session_start();

ob_start();

include "inc/connection.php";

?>



<!doctype html>

<html lang="en">



<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Gogi - Admin and Dashboard Template</title>



    <!-- Favicon -->

    <link rel="shortcut icon" href="./assets/media/image/favicon.png" />



    <!-- Plugin styles -->

    <link rel="stylesheet" href="./vendors/bundle.css" type="text/css">



    <!-- App styles -->

    <link rel="stylesheet" href="./assets/css/app.min.css" type="text/css">

</head>



<body class="form-membership">



    <!-- begin::preloader-->

    <div class="preloader">

        <div class="preloader-icon"></div>

    </div>

    <!-- end::preloader -->



    <div class="form-wrapper">



        <!-- logo -->

        <div id="logo">

            <p class="h5"><?= $site_name ?></p>

            <!-- <img src="./assets/media/image/dark-logo.png" alt="image"> -->

        </div>

        <!-- ./ logo -->





        <h5>Giriş Yap</h5>



        <!-- form -->

        <?php

        if ($_POST) {

            include "inc/connection.php";







            $email = $_POST['email'];

            $passw = $_POST['password'];



            $vericek = $conn->prepare("SELECT * FROM admins WHERE admin_user = '" . $email . "' and admin_pass = '" . $passw . "'");

            $vericek->execute();

            $veriRow = $vericek->fetch(PDO::FETCH_ASSOC);

            if ($vericek->rowCount()) {

                $_SESSION["login"] = true;

                $_SESSION['admin_id'] = $veriRow["admin_id"];

                $_SESSION["user"] = $veriRow["admin_kadi"];

                $_SESSION["pass"] = $passw;

                $_SESSION["role"] = $veriRow["admin_role"];

                $_SESSION["admin_name"] = $veriRow["admin_name"];

                if ($email == $veriRow["admin_user"]) {

                    if ($passw == $veriRow["admin_pass"]) {

                        if ($veriRow["admin_status"] == 0) {

                            echo "<div class='alert alert-success'>Başarıyla Giriş Yapıldı. Yönlendiriliyorsunuz..</div>";

                            header("Refresh:3;url = index.php");
                        }else{
                            echo "<div class='alert alert-danger'>Görünüşe Göre Yetkileriniz Kaldırılmış. Lütfen Yöneticiniz İle Görüşün..<a href=javascript:history.back(-1)>Geri Don</a></div>";
                        }
                    }
                }
            } else {

                if ($email = "" or $passw = "") {

                    echo "<div class='alert alert-danger'>Lütfen bilgileri eksiksiz giriniz ! <a href=javascript:history.back(-1)>Geri Don</a></div>";
                } else {

                    echo "<div class='alert alert-danger'>Kullanıcı adı veya şifre hatalı. <a href=javascript:history.back(-1)>Geri Don</a></div>";
                }
            }
        }

        ?>

        <form name="login" method="post">

            <div class="form-group">

                <input type="text" name="email" class="form-control" placeholder="Email Adresiniz" required autofocus>

            </div>

            <div class="form-group">

                <input type="password" name="password" class="form-control" placeholder="Şifreniz" required>

            </div>

            <div class="form-group d-flex justify-content-between">

                <div class="custom-control custom-checkbox">

                    <input type="checkbox" class="custom-control-input" checked="" id="customCheck1">

                    <label class="custom-control-label" for="customCheck1">Beni Hatırla</label>

                </div>

                <a href="recovery-password.html">Parolayı Sıfırla</a>

            </div>

            <button class="btn btn-primary btn-block">Giriş Yap</button>

            <hr>

            <!-- <p class="text-muted">Login with your social media account.</p>

        <ul class="list-inline">

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-facebook">

                    <i class="fa fa-facebook"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-twitter">

                    <i class="fa fa-twitter"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-dribbble">

                    <i class="fa fa-dribbble"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-linkedin">

                    <i class="fa fa-linkedin"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-google">

                    <i class="fa fa-google"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-behance">

                    <i class="fa fa-behance"></i>

                </a>

            </li>

            <li class="list-inline-item">

                <a href="#" class="btn btn-floating btn-instagram">

                    <i class="fa fa-instagram"></i>

                </a>

            </li>

        </ul> -->

        </form>

        <!-- ./ form -->





    </div>



    <!-- Plugin scripts -->

    <script src="./vendors/bundle.js"></script>



    <!-- App scripts -->

    <script src="./assets/js/app.min.js"></script>

</body>



</html>

<?php ob_end_flush(); ?>