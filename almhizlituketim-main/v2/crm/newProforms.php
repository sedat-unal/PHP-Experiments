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
    <?php include "inc/menu.php"; ?>


    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="page-header">
                <div>
                    <h3>Proforma Fatura Oluştur</h3>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="<?= $site_link ?>index.php">Anasayfa</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                <a href="<?= $site_link ?>proforms.php">Proforma Fatura Oluştur</a>
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <form method="POST" id="offerForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="inputState"> Firma Adı</label>
                                <select name="firmaAdi" id="inputState" class="form-control" required="">
                                    <?php
                                    $getFirm = $conn->prepare("SELECT * FROM clients ORDER BY client_id DESC");
                                    $getFirm->execute();
                                    $fRow = $getFirm->fetchAll();
                                    foreach ($fRow as $item) {
                                    ?>
                                        <option value="<?= $item['client_id']; ?>"><?= $item['client_firm']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="inputState">Teklifin Konusu / Firma Adı</label>
                                <select name="teklifFirma" id="input1" class="form-control" required="">
                                    <?php
                                    $getFirm = $conn->prepare("SELECT * FROM offers INNER JOIN clients ON offers.offer_client = clients.client_id ORDER BY offer_id DESC");
                                    $getFirm->execute();
                                    $fRow = $getFirm->fetchAll();
                                    foreach ($fRow as $item) {
                                    ?>
                                        <option value="<?= $item['offer_id']; ?>"><?= $item['offer_subject'] . " / " . $item['client_firm']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="inputPassword4">Konu</label>
                                <input type="text" name="offer_subject" class="form-control" id="inputPassword4" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="inputAddress">Proformanın Tarihi</label>
                                <input type="text" name="daterangepicker" class="form-control">
                            </div>
                        </div>
                        <div class="alert-repeater">
                            <div data-repeater-list="group-a">
                                <div data-repeater-item>
                                    <div class="form-row">
                                        <div class="col-md-2 form-group">
                                            <label for="items">Ürün</label>
                                            <?php
                                            $getUrun = $conn->prepare("SELECT * FROM items ORDER BY item_id DESC");
                                            $getUrun->execute();
                                            $uRow = $getUrun->fetchAll();
                                            ?>
                                            <select name="items" id="items" class="form-control">
                                                <?php
                                                foreach ($uRow as $item) {
                                                ?>
                                                    <option value="<?= $item['item_id'] ?>"><?= $item['item_title'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3 form-group">
                                            <label for="item_content">Ürün Açıklaması</label>
                                            <input type="text" class="form-control" name="item_content" id="item_content" required>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="item_pcs">Adet</label>
                                            <input type="number" step="any" class="form-control" name="item_pcs" id="item_pcs" required>
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <label for="unit">Birim</label>
                                            <?php
                                            $getBirim = $conn->prepare("SELECT * FROM unit");
                                            $getBirim->execute();
                                            $bRow = $getBirim->fetchAll();
                                            ?>
                                            <select name="unit" id="unit" class="form-control" required>
                                                <?php
                                                foreach ($bRow as $unit) {
                                                ?>
                                                    <option value="<?= $unit['unit_id'] ?>"><?= $unit['unit_title'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2 form-group">
                                            <label for="item_price">Birim Fiyat</label>
                                            <input type="number" step="any" class="form-control" name="item_price" id="item_price" required>
                                        </div>
                                        <div class="col-md-1 form-group">
                                            <label for="tax">KDV</label>
                                            <?php
                                            $getTax = $conn->prepare("SELECT * FROM tax");
                                            $getTax->execute();
                                            $tRow = $getTax->fetchAll();
                                            ?>
                                            <select name="tax" id="tax" class="form-control">
                                                <?php
                                                foreach ($tRow as $tax) {
                                                ?>
                                                    <option value="<?= $tax['tax_id'] ?>"><?= $tax['tax_number'] ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-1 col-sm-12 form-group">
                                            <div><label>&nbsp;</label></div>
                                            <button type="button" class="btn btn-danger" data-repeater-delete>
                                                <i class="ti-close font-size-10"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="button" style="margin-bottom:30px;" class="btn btn-primary" data-repeater-create>
                                <i class="ti-plus font-size-10 mr-2"></i> Satır Ekle
                            </button>
                        </div>
                        <div>
                            <label for="offer_note">Teklif Notları</label>
                            <br>
                            <textarea rows="4" cols="50" id="offer_note" name="offer_note"></textarea>
                        </div>
                        <button style="margin-top:30px" type="submit" class="btn btn-primary" onclick="">Kaydet ve Teklifi Görüntüle</button>
                    </form>
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
    <script>

    </script>
    <!-- Main scripts -->
    <script src="./vendors/bundle.js"></script>

    <!-- Datepicker -->
    <script src="./vendors/datepicker/daterangepicker.js"></script>
    <script>
        $(document).ready(function() {
            $('input[name="daterangepicker"]').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                },
                function(start, label) {
                    swal("Tarih Ayarlanmıştır", start.format('DD-MM-YYYY'), "success")
                }
            );
        });
    </script>
    <script>
        $(document).on("submit", "#offerForm", function(event) {
            event.preventDefault();
            $.ajax({
                url: "data/proformData.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
            });
        });
    </script>
    <!-- Form repeater -->
    <script src="./vendors/jquery.repeater.min.js"></script>

    <script>
        $(document).ready(function() {
            $(function() {
                $('.basic-repeater').repeater({
                    show: function() {
                        $(this).slideDown();
                    }
                });

                $('.alert-repeater').repeater({
                    show: function() {
                        $(this).slideDown();
                    },
                    hide: function(deleteElement) {
                        swal({
                                title: "Satır Siliniyor",
                                text: "Bu satırı silmek istediğinize emin misiniz ?",
                                icon: "warning",
                                buttons: true,
                                dangerMode: true,
                            })
                            .then((willDelete) => {
                                if (willDelete) {
                                    $(this).slideUp(deleteElement);
                                }
                            })
                    }
                });
            });

        });
    </script>
    <!-- Prism -->
    <script src="./vendors/prism/prism.js"></script>

    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
</body>

</html>