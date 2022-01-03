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
<?php include "inc/menu.php";?>
<!-- Content body -->
<div class="content-body">
    <!-- Content -->
    <div class="content ">

        <div class="page-header">
            <div>
                <h3>Ürün Ekle</h3>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?= $site_link ?>index.php">Anasayfa</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            <a href="<?= $site_link ?>newOfferItems.php">Ürün Ekle</a>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <div class="col-md-12">
                        <?php 
                        if(isset($_GET['id'])){
                            $getData = $conn->prepare("SELECT * FROM offeritems WHERE id = :id");
                            $getData->execute([":id" => $_GET['id']]);
                            if($getData->rowCount()){
                                $dArr = $getData->fetch(PDO::FETCH_ASSOC);
                                ?> 
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="card-title">Ürün Bilgileri</h6>
                                        <?php 
                                        if($_POST){
                                            $urunAdi = $_POST['urunAdi'];
                                            if($urunAdi != NULL){
                                                $insert = $conn->prepare("INSERT INTO offeritems SET item_name = :item_name");
                                                $insert->execute([":item_name" => $urunAdi]);
                                            }
                                        }
                                        ?>
                                        <form class="needs-validation" method="POST" novalidate="">
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="validationCustom01">Ürün Adı</label>
                                                    <input type="text" name="urunAdi" class="form-control" id="validationCustom01" value="<?=$dArr['item_name']?>"  required="">
                                                </div>
                                            </div>
                                            <button class="btn btn-primary" type="submit">Kaydet</button>
                                        </form>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                            <?php
                        }else{
                            ?> 
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Ürün Bilgileri</h6>
                                    <?php 
                                    if($_POST){
                                        $urunAdi = $_POST['urunAdi'];
                                        if($urunAdi != NULL){
                                            $insert = $conn->prepare("INSERT INTO offeritems SET item_name = :item_name");
                                            $insert->execute([":item_name" => $urunAdi]);
                                        }
                                    }
                                    ?>
                                    <form class="needs-validation" method="POST" novalidate="">
                                        <div class="form-row">
                                            <div class="col-md-4 mb-3">
                                                <label for="validationCustom01">Ürün Adı</label>
                                                <input type="text" name="urunAdi" class="form-control" id="validationCustom01" required="">
                                            </div>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Kaydet</button>
                                    </form>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>

    </div>
    <!-- ./ Content -->

    <!-- Footer -->
    <?php include "inc/footer.php"; ?>
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