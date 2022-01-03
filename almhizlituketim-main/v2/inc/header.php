<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Almila Islak Mendil bir hızlı tüketim markasıdır.">
    <meta name="author" content="Sedat Ünal, sedatunal42@gmail.com">
    <meta name="content-language" content="tr-TR">
    <meta name="copyright" content="(c) 2018 Sedat Ünal (sedatunal42@gmail.com) Tüm Hakları Saklıdır.">
    <meta name="distribution" content="global">
    <meta name="keywords" content="ıslak mendil, hızlı tüketim, flekso baskı, kaya tuzu, şeker">
    <meta name="robots" content="all">
    <meta name="abstract" content="ALM Hızlı Tüketim Grubu tek kullanımlık gıda,hijyen ve kağıt ürünleri üretip satan bir web sitesidir.">
    <meta name="title" content="ALM Hızlı Tüketim Ürünleri">
<meta name="yandex-verification" content="464a71bcb735438c" />


    <title>ALM Hızlı Tüketim Grubu | Üsküdar | İstanbul</title>

    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/reference.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/main_styles.css">
      
      <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131187887-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131187887-1');
</script>

    </head>
    <!-- whatsapp -->
    
    <?php  
    $iphone = stristr(@$_SERVER['HTTP_USER_AGENT'],"iPhone");
    $android = stristr(@$_SERVER['HTTP_USER_AGENT'],"Android");
    $webos = stristr(@$_SERVER['HTTP_USER_AGENT'],"webOS");
    $bberry = stristr(@$_SERVER['HTTP_USER_AGENT'],"BlackBerry");
    $ipod = stristr(@$_SERVER['HTTP_USER_AGENT'],"iPod");
    if ($iphone || $android || $webos || $ipod || $bberry == true)
    {
    ?>
	
<?php }else{?>
    <!-- whatsapp -->
	<div style="width:400px;position:fixed;top:500px;left: 10px;z-index:99999;font-size:12px;">
		<a href="https://api.whatsapp.com/send?phone=905377464864" target="_blank">
			<img style="width:50px;" src="images/vatsapp.png" alt="Bizimle hemen iletişime geçmek için tıklatın.">
		</a>
	</div>
<?php } ?>

  <body>

    <!-- navbar -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">
          <img src="../almwebresim/logo.png" width="50px" height="50px">
          ALM Hızlı Tüketim Grubu
        </a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Anasayfa</a>
            </li>
              <li class="nav-item">
              <a class="nav-link" href="about.php">Kurumsal</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPortfolio" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Ürünlerimiz
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownPortfolio">
                <a class="dropdown-item" href="portfolio-1.php">Hijyen Grubu</a>
                <a class="dropdown-item" href="portfolio-2.php">Gıda Grubu</a>
                <a class="dropdown-item" href="baski.php">Baskı Grubu</a>
                <a class="dropdown-item" href="portfolio-4.php">Kağıt Ambalaj Grubu</a>
                <a class="dropdown-item" href="portfolio-5.php">Reklam Grubu</a>
                <a class="dropdown-item" href="portfolio-6.php">Naylon Poşet Grubu</a>
              </div>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="our_reference.php">Referanslarımız</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">İletişim</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
