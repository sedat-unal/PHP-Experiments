<?php

include "inc/head.php";

include "inc/sidebar.php";

if (isset($_GET['id'])) {
    //Eğer id verilmişse
    $id = $_GET['id'];
    $update = 1;
} else {
    //Eğer id verilmemişse
    $update = 0;
}

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

                    <h3>Ürün <?php echo $update == 0 ? "Ekle" : "Düzenle" ?></h3>

                    <nav aria-label="breadcrumb">

                        <ol class="breadcrumb">

                            <li class="breadcrumb-item">

                                <a href="<?= $site_link ?>index.php">Anasayfa</a>

                            </li>

                            <li class="breadcrumb-item active" aria-current="page">

                                <a href="<?= $site_link ?>newItem.php"> <?php echo $update == 0 ? "Yeni Ürün Ekle" : "Ürün Düzenle" ?></a>

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

                                    <h6 class="card-title">Ürün Bilgileri</h6>

                                    <?php

                                    if ($update == 0) { 
                                        //Eğer id verilmemişse
                                        if ($_POST) {
                                            $itemName       = $_POST['itemName'];
                                            $itemDesc       = $_POST['priceDesc'];
                                            $itemContent    = $_POST['priceContent'];
                                            $itemMinOrder   = $_POST['priceMinOrder'];
                                            $itemUnitPrice  = $_POST['priceUnitPrice'];

                                            $ınsertItem = $conn->prepare("INSERT INTO pricelist SET
                                                price_title     = :price_title,
                                                price_desc      = :price_desc,
                                                price_content   = :price_content,
                                                price_minOrder  = :price_minOrder,
                                                price_unitPrice = :price_unitPrice
                                            ");
                                            $ınsertItem->execute(array(
                                                "price_title"      => $itemName,
                                                "price_desc"       => $itemDesc,
                                                "price_content"    => $itemContent,
                                                "price_minOrder"   => $itemMinOrder,
                                                "price_unitPrice"  => $itemUnitPrice
                                            ));

                                            if ($ınsertItem) {
                                                echo '
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    <i class="ti-check mr-2"></i> Kayıt Başarılı. Yönlendiriliyorsunuz..
                                                </div>';
                                                header("refresh:2;url=priceList.php");
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

                                                    <label>Ürün Adı</label>

                                                    <input type="text" name="itemName" class="form-control" id="itemName" placeholder="Ürün Adı" required="">

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Ürün Açıklaması</label>

                                                    <br>

                                                    <textarea type="text" name="priceDesc" class="form-control" id="priceDesc" placeholder="Ürün Açıklaması"></textarea>

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Ürün İçeriği</label>

                                                    <br>

                                                    <textarea type="text" name="priceContent" class="form-control" id="priceContent" placeholder="Ürünün içeriği"></textarea>

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Minimum Sipariş Adedi</label>

                                                    <input type="text" name="priceMinOrder" class="form-control" id="priceMinOrder" placeholder="Minimum Sipariş Adedi" required="">

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Birim Fiyat</label>

                                                    <input type="text" name="priceUnitPrice" class="form-control" id="priceUnitPrice" placeholder="Birim Fiyatı" required="">

                                                </div>

                                            </div>

                                            <button class="btn btn-primary" type="submit">Kaydet</button>

                                        </form>


                                    <?php
                                    } else {
                                        $getItem = $conn->prepare("SELECT * FROM pricelist WHERE price_id = :id");
                                        $getItem->execute(array(
                                            ":id" => $id
                                        ));
                                        $iRow = $getItem->fetch(PDO::FETCH_ASSOC);

                                        if ($_POST) {
                                            $itemName       = $_POST['itemName'];
                                            $itemDesc       = $_POST['priceDesc'];
                                            $itemContent    = $_POST['priceContent'];
                                            $itemMinOrder   = $_POST['priceMinOrder'];
                                            $itemUnitPrice  = $_POST['priceUnitPrice'];

                                            $ınsertItem = $conn->prepare("UPDATE pricelist SET
                                                price_title     = :price_title,
                                                price_desc      = :price_desc,
                                                price_content   = :price_content,
                                                price_minOrder  = :price_minOrder,
                                                price_unitPrice = :price_unitPrice WHERE price_id = :id");
                                            $ınsertItem->execute(array(
                                                "price_title"      => $itemName,
                                                "price_desc"       => $itemDesc,
                                                "price_content"    => $itemContent,
                                                "price_minOrder"   => $itemMinOrder,
                                                "price_unitPrice"  => $itemUnitPrice,
                                                "id"               => $id
                                            ));

                                            if ($ınsertItem) {
                                                echo '
                                                <div class="alert alert-success d-flex align-items-center" role="alert">
                                                    <i class="ti-check mr-2"></i> Kayıt Başarılı. Yönlendiriliyorsunuz..
                                                </div>';
                                                header("refresh:2;url=priceList.php");
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

                                                    <label>Ürün Adı</label>

                                                    <input type="text" name="itemName" class="form-control" id="itemName" value="<?= $iRow['price_title'] ?>" required="">

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Ürün Açıklaması</label>

                                                    <br>

                                                    <textarea type="text" name="priceDesc" class="form-control" id="priceDesc"><?= $iRow['price_desc'] ?></textarea>

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Ürün İçeriği</label>

                                                    <br>

                                                    <textarea type="text" name="priceContent" class="form-control" id="priceContent"><?= $iRow['price_content'] ?></textarea>

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Minimum Sipariş Adedi</label>

                                                    <input type="text" name="priceMinOrder" class="form-control" id="priceMinOrder" value="<?= $iRow['price_minOrder'] ?>" required="">

                                                </div>

                                            </div>

                                            <div class="form-row">

                                                <div class="col-md-4 mb-3">

                                                    <label>Birim Fiyat</label>

                                                    <input type="text" name="priceUnitPrice" class="form-control" id="priceUnitPrice" value="<?= $iRow['price_unitPrice'] ?>" required="">

                                                </div>

                                            </div>

                                            <button class="btn btn-primary" type="submit">Kaydet</button>

                                        </form>
                                    <?php
                                    }

                                    ?>



                                </div>

                            </div>



                        </div>

                    </div>



                </div>

            </div>



        </div>

        <!-- ./ Content -->



        <!-- Footer -->

        <?php include("inc/footer.php"); ?>

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