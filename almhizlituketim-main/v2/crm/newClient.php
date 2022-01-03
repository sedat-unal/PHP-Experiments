<?php
include "inc/head.php";
include "inc/sidebar.php";
?>

<body class="scrollable-layout">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Yükleniyor...</span>
    </div>
    <!-- ./ Preloader -->
    <?php
    include "inc/menu.php";
    ?>
    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Müşteri Ekle</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= $site_link ?>index.php">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="<?= $site_link ?>newClient.php">Yeni Müşteri Ekle</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">

                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Müşteri Bilgileri</h6>
                                    <?php
                                    if ($_POST) {
                                        $firmaAdi           = $_POST['firmaAdi'];
                                        $yetkiliKisi        = $_POST['yetkiliKisi'];
                                        $yetkiliEposta      = $_POST['yetkiliEposta'];
                                        $yetkiliTelefon     = $_POST['yetkiliTelefon'];
                                        $hedefUrun          = $_POST['hedefUrun'];
                                        $sektor             = $_POST['sektor'];
                                        $firmaCity          = $_POST['firmaCity'];
                                        $acikAdres          = $_POST['acikAdres'];
                                        $postCode           = $_POST['postCode'];
                                        $vkn                = $_POST['vkn'];
                                        $lang               = $_POST['language'];

                                        $insert = $conn->prepare("INSERT INTO clients SET
                                        client_firm     = :firmaAdi,
                                        client_person   = :yetkiliKisi,
                                        client_email    = :yetkiliEposta,
                                        client_phone    = :yetkiliTelefon,
                                        client_status   = :durum,
                                        client_groups   = :hedefUrun,
                                        client_sektor   = :sektor,
                                        client_city     = :firmaCity,
                                        client_adres    = :acikAdres,
                                        client_postCode = :postCode,
                                        client_vkn      = :vkn,
                                        client_lang     = :lang");
                                        $veri = $insert->execute(array(
                                            "firmaAdi"          => $firmaAdi,
                                            "yetkiliKisi"       => $yetkiliKisi,
                                            "yetkiliEposta"     => $yetkiliEposta,
                                            "yetkiliTelefon"    => $yetkiliTelefon,
                                            "durum"             => 1,
                                            "hedefUrun"         => $hedefUrun,
                                            "sektor"            => $sektor,
                                            "firmaCity"         => $firmaCity,
                                            "acikAdres"         => $acikAdres,
                                            "postCode"          => $postCode,
                                            "vkn"               => $vkn,
                                            "lang"              => $lang
                                        ));

                                        if ($veri) {
                                            echo '
                                        <div class="alert alert-success d-flex align-items-center" role="alert">
                                            <i class="ti-check mr-2"></i> Kayıt Başarılı. Yönlendiriliyorsunuz..
                                        </div>';
                                            header("refresh:2;url=clients.php");
                                        } else {
                                            echo '
                                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                                            <i class="ti-check mr-2"></i> Kayıt Başarısız. Lütfen Tekrar Deneyiniz..
                                        </div>';
                                        }
                                    }

                                    ?>
                                    <form class="needs-validation" method="POST" novalidate="">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">*Firma Adı</label>
                                                <input type="text" name="firmaAdi" class="form-control" id="validationCustom01" placeholder="Firma Adı" required="">
                                                <div class="valid-feedback">
                                                    Onaylandı
                                                </div>
                                                <div class="invalid-feedback">
                                                    Lütfen Firma Adı Giriniz
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom02">*Yetkili Kişi</label>
                                                <input type="text" name="yetkiliKisi" class="form-control" id="validationCustom02" placeholder="Yetkili Kişi Adı" required="">
                                                <div class="valid-feedback">
                                                    Onaylandı
                                                </div>
                                                <div class="invalid-feedback">
                                                    Lütfen Yetkili Kişi Bilgisi Giriniz
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustomUsername">Yetkili e-Posta</label>
                                                <div class="input-group">
                                                    <input type="text" name="yetkiliEposta" class="form-control" id="validationCustomUsername" placeholder="yetkili@eposta.com" aria-describedby="inputGroupPrepend">

                                                    <div class="input-group-append">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom03">Yetkili Telefon Numarası</label>
                                                <input type="number" name="yetkiliTelefon" class="form-control" id="validationCustom03" placeholder="5** *** ** **" required="">
                                                <div class="invalid-feedback">
                                                    Lütfen Telefon Bilgisi Giriniz.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom04">Hedef Ürün Grubu</label>
                                                <input type="text" name="hedefUrun" class="form-control" id="validationCustom04" placeholder="Islak mendil, tuz.." required="">
                                                <div class="invalid-feedback">
                                                    Lütfen Hedef Ürün Grubu Belirtiniz.
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom05">Firma Sektörü</label>
                                                <input type="text" name="sektor" class="form-control" id="validationCustom05" placeholder="Restoran, Toptancı..">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom04">Firma İlçe / İl Adresi</label>
                                                <input type="text" name="firmaCity" class="form-control" id="validationCustom04" placeholder="İlçe / İl bilgisi giriniz">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom05">Firma Açık Adresi</label>
                                                <br>
                                                <textarea type="text" name="acikAdres" class="form-control" id="validationCustom05" placeholder="Adres mahallesi adres sokak"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom04">Firma Posta Kodu</label>
                                                <input type="text" name="postCode" class="form-control" id="validationCustom04">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom05">Firma VKN</label>
                                                <input type="text" name="vkn" class="form-control" id="validationCustom05">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="exampleFormControlSelect1">Tercih Edilen Dil</label>
                                                <select name="language" class="form-control" id="exampleFormControlSelect2">
                                                    <option selected value="tr">Türkçe</option>
                                                    <option value="en">İngilizce</option>
                                                </select>
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Kaydet</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
        <!-- ./ Content -->

        <!-- Footer -->
        <footer class="content-footer">
            <div>© 2020 Gogi - <a href="http://laborasyon.com" target="_blank">Laborasyon</a></div>
            <div>
                <nav class="nav">
                    <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                    <a href="#" class="nav-link">Change Log</a>
                    <a href="#" class="nav-link">Get Help</a>
                </nav>
            </div>
        </footer>
        <!-- ./ Footer -->
    </div>
    <!-- ./ Content body -->
    </div>
    <!-- ./ Content wrapper -->
    </div>
    <!-- ./ Layout wrapper -->

    <!-- Main scripts -->
    <script src="./vendors/bundle.js"></script>

    <!-- Form validation example -->
    <script src="./assets/js/examples/form-validation.js"></script>
    <!-- Prism -->
    <script src="./vendors/prism/prism.js"></script>

    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
</body>

</html>