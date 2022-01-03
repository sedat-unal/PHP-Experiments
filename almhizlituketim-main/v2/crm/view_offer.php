<?php
include "inc/head.php";
include "inc/sidebar.php";

$id = $_GET['id'];

if (!isset($id)) {
    header("location:offers.php");
}


?>

<body class="scrollable-layout">
    <?php include "inc/menu.php"; ?>


    <!-- Content body -->
    <div class="content-body">
        <!-- Content -->
        <div class="content ">

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-50">
                            <?php
                            //Genel veri çekimi
                            $getData = $conn->prepare("SELECT * FROM offers WHERE offer_id = :id");
                            $getData->execute(array(
                                "id" => $id
                            ));
                            $dRow = $getData->fetch(PDO::FETCH_ASSOC);
                            
                            //Teklif numarasına göre kdv çekimi.
                            $number = $dRow['offer_number'];
                            $get_tax = $conn->prepare("SELECT * FROM tax INNER JOIN offer_price ON tax.tax_id = offer_price.offer_tax WHERE offer_number = :num");
                            $get_tax->execute(array(
                                "num" => $number
                            ));
                            $numRow = $get_tax->fetch(PDO::FETCH_ASSOC);

                            //Teklifin para birimi.
                            $costUnit = $dRow['offer_costUnit'];
                            if($costUnit == 1)
                            {
                                $cost = "₺";
                            }
                            else if ($costUnit == 2)
                            {
                                $cost = "$";
                            }
                            else
                            {
                                $cost = "€";
                            }

                            //Teklif yapılan müşterinin tercih dilini çektim.
                            $cid = $dRow['offer_client'];
                            $get_Lang = $conn->prepare("SELECT client_lang FROM clients WHERE client_id = :id");
                            $get_Lang->execute(array(
                                "id" => $cid
                            ));
                            $cRow = $get_Lang->fetch(PDO::FETCH_ASSOC);


                            if ($cRow['client_lang'] == "tr") {
                            ?>
                                <div class="invoice">
                                    <div class="d-md-flex justify-content-between align-items-center">
                                        <h5 class="font-weight-bold d-flex align-items-center">
                                            <!-- <img src="./assets/media/image/dark-logo.png" alt="dark logo"> -->
                                            <?= "Konu : " . $dRow['offer_subject']  ?>
                                        </h5>
                                        <h3 class="text-xs-left m-b-0">Teklif #TKF-<?= $dRow['offer_number'] ?></h3>
                                    </div>
                                    <hr class="m-t-b-50">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 style="color:red"><u>Teklifin Geçerlilik Tarihi </u>: <?= $dRow['offer_lastDate'];  ?></h6>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:30px">
                                        <div class="col-md-6">
                                            <p>
                                                <b><u>Teklif Veren</u></b>
                                            </p>
                                            <p>
                                                <!-- <img src="./assets/media/image/dark-logo.png" alt="dark logo"> -->
                                                ALM HIZLI TÜKETİM
                                            </p>
                                            <p>Burhaniye Mah Gülerce Sok,<br>No: 22/A-B,<br>Üsküdar, İstanbul</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-right">
                                                <b>Sayın</b>
                                            </p>
                                            <?php
                                            $getClientData = $conn->prepare("SELECT * FROM clients WHERE client_id = :client_id");
                                            $client_id = $dRow['offer_client'];
                                            $getClientData->execute(array(
                                                "client_id" => $client_id
                                            ));
                                            $cRow = $getClientData->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <p class="text-right">
                                                <?= $cRow['client_firm']; ?><br>
                                                <?= $cRow['client_person']; ?><br>
                                                <?= $cRow['client_adres']; ?><br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-4 mt-4">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Ürün Adı</th>
                                                    <th>Ürün Açıklaması</th>
                                                    <th class="text-right">MİKTAR</th>
                                                    <th class="text-right">BİRİM</th>
                                                    <th class="text-right">BİRİM FİYAT</th>
                                                    <th class="text-right">KDV (%)</th>
                                                    <th class="text-right">Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getUrun = $conn->prepare("SELECT * FROM offer_content INNER JOIN offers ON offer_content.offer_number = offers.offer_number INNER JOIN items ON offer_content.content_item = items.item_id INNER JOIN unit ON offer_content.content_unit = unit.unit_id INNER JOIN tax ON offer_content.content_tax = tax.tax_id WHERE offer_content.offer_number = :num");
                                                $getUrun->execute(array(
                                                    "num" => $dRow['offer_number']
                                                ));

                                                $sayi = $getUrun->rowCount();

                                                $gRow = $getUrun->fetchAll();
                                                $i = 1;
                                                foreach ($gRow as $item) {
                                                ?>
                                                    <tr class="text-right">
                                                        <td class="text-left"><?= $i ?></td>
                                                        <td class="text-left"><?= $item['item_title'] ?></td>
                                                        <td class="text-left"><?= $item['content_desc'] ?></td>
                                                        <td><?= $item['content_pcs'] ?></td>
                                                        <td><?= $item['unit_title'] ?></td>
                                                        <td><?= $item['content_unitPrice'] . " " . $cost; ?></td>
                                                        <td><?= $item['tax_number'] . " %" ?></td>
                                                        <td name="number">
                                                            <?php
                                                            $rakam = $item['content_pcs'] * $item['content_unitPrice'];
                                                            echo $rakam . " " . $cost;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                ++$i;
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right">
                                        <p>Ara Toplam : <?php $tTutar = $dRow['offer_total'];
                                                            echo number_format($tTutar, 2, ",", ".") . " " . $cost; ?></p>
                                        <p>KDV : <?php $kdv = ($dRow['offer_total'] * $numRow['tax_number'] / 100);
                                                    echo number_format($kdv, 2, ",", ".") . " " . $cost; ?></p>
                                        <h4 class="font-weight-800">Toplam : <?php $total = $tTutar + $kdv;
                                                                                echo number_format($total, 2, ",", ".") . " " . $cost ?></h4>
                                    </div>
                                    <div>
                                        <h4><u>Notlar</u></h4>
                                        <p>
                                            <?php
                                            $note = $dRow['offer_note'];
                                            $bol = explode(".", $note);
                                            $say = count($bol);
                                            for ($i = 0; $i < $say; $i++) {
                                                echo $bol[$i] . "<br>";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <!-- <p class="text-center small text-muted  m-t-50">
                                    <span class="row">
                                        <span class="col-md-6 offset-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, at.
                                        </span>
                                    </span>
                                </p> -->
                                </div>
                                <div class="text-right d-print-none">
                                    <hr class="my-5">
                                    <a href="javascript:window.print()" class="btn btn-success ml-2">Yazdır</a>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="invoice">
                                    <div class="d-md-flex justify-content-between align-items-center">
                                        <h5 class="font-weight-bold d-flex align-items-center">
                                            <!-- <img src="./assets/media/image/dark-logo.png" alt="dark logo"> -->
                                            <?= "Subject : " . $dRow['offer_subject']  ?>
                                        </h5>
                                        <h3 class="text-xs-left m-b-0">Offer No #TKF-<?= $dRow['offer_number'] ?></h3>
                                    </div>
                                    <hr class="m-t-b-50">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 style="color:red"><u>Offer Validty Date </u>: <?= $dRow['offer_lastDate'];  ?></h6>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top:30px">
                                        <div class="col-md-6">
                                            <p>
                                                <b><u>Bill To </u></b>
                                            </p>
                                            <p>
                                                <!-- <img src="./assets/media/image/dark-logo.png" alt="dark logo"> -->
                                                ALM HIZLI TÜKETİM
                                            </p>
                                            <p>Burhaniye Mah Gülerce Sok,<br>No: 22/A-B,<br>Üsküdar, İstanbul</p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="text-right">
                                                <b><u>Ship To</u></b>
                                            </p>
                                            <?php
                                            $getClientData = $conn->prepare("SELECT * FROM clients WHERE client_id = :client_id");
                                            $client_id = $dRow['offer_client'];
                                            $getClientData->execute(array(
                                                "client_id" => $client_id
                                            ));
                                            $cRow = $getClientData->fetch(PDO::FETCH_ASSOC);
                                            ?>
                                            <p class="text-right">
                                                <?= $cRow['client_firm']; ?><br>
                                                <?= $cRow['client_person']; ?><br>
                                                <?= $cRow['client_adres']; ?><br>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table mb-4 mt-4">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Item Name</th>
                                                    <th>Description</th>
                                                    <th class="text-right">QTY</th>
                                                    <th class="text-right">UNIT</th>
                                                    <th class="text-right">UNIT PRICE</th>
                                                    <th class="text-right">TAX (%)</th>
                                                    <th class="text-right">TOTAL</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getUrun = $conn->prepare("SELECT * FROM offer_content INNER JOIN offers ON offer_content.offer_number = offers.offer_number INNER JOIN items ON offer_content.content_item = items.item_id INNER JOIN unit ON offer_content.content_unit = unit.unit_id INNER JOIN tax ON offer_content.content_tax = tax.tax_id WHERE offer_content.offer_number = :num");
                                                $getUrun->execute(array(
                                                    "num" => $dRow['offer_number']
                                                ));

                                                $sayi = $getUrun->rowCount();

                                                $gRow = $getUrun->fetchAll();
                                             
                                                $i = 1;
                                                foreach ($gRow as $item) {
                                                ?>
                                                    <tr class="text-right">
                                                        <td class="text-left"><?= $i ?></td>
                                                        <td class="text-left"><?= $item['item_title'] ?></td>
                                                        <td class="text-left"><?= $item['content_desc'] ?></td>
                                                        <td><?= $item['content_pcs'] ?></td>
                                                        <td><?= $item['unit_title'] ?></td>
                                                        <td><?= $item['content_unitPrice'] . " " . $cost; ?></td>
                                                        <td><?= $item['tax_number'] . " %" ?></td>
                                                        <td name="number">
                                                            <?php
                                                            $rakam = $item['content_pcs'] * $item['content_unitPrice'];
                                                            echo $rakam . " " . $cost;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                ++$i;
                                                }
                                                ?>


                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="text-right">
                                        <p>SUBTOTAL : <?php $tTutar = $dRow['offer_total'];
                                                            echo number_format($tTutar, 2, ",", ".") . " " . $cost; ?></p>
                                        <p>TOTAL TAX : <?php $kdv = ($dRow['offer_total'] * 18 / 100);
                                                    echo number_format($kdv, 2, ",", ".") . " " . $cost; ?></p>
                                        <h4 class="font-weight-800">BALANCE DUE : <?php $total = $tTutar + $kdv;
                                                                                echo number_format($total, 2, ",", ".") . " " . $cost ?></h4>
                                    </div>
                                    <div>
                                        <h4><u>NOTES</u></h4>
                                        <p>
                                            <?php
                                            $note = $dRow['offer_note'];
                                            $bol = explode(".", $note);
                                            $say = count($bol);
                                            for ($i = 0; $i < $say; $i++) {
                                                echo $bol[$i] . "<br>";
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <!-- <p class="text-center small text-muted  m-t-50">
                                    <span class="row">
                                        <span class="col-md-6 offset-3">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ab, at.
                                        </span>
                                    </span>
                                </p> -->
                                </div>
                                <div class="text-right d-print-none">
                                    <hr class="my-5">
                                    <a href="javascript:window.print()" class="btn btn-success ml-2">Print</a>
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


    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
</body>

</html>