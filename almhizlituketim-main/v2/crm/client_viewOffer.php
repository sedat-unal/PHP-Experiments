<?php
function base64_url_encode($input)
{
    return strtr(base64_encode($input), '+/=', '-_,');
}

function base64_url_decode($input)
{
    return base64_decode(strtr($input, '-_,', '+/='));
}
if (!isset($_GET["id"])) {

    $a = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
    $parca = explode('id', $a);
    if (strlen($parca[1]) > 0) {
        $ClientID = base64_url_decode($parca[1]);
    } else {
        header("location: 404.php");
    }
} else {
    $ClientID = base64_url_decode($_GET["id"]);
}
include "inc/connection.php";
$get_data = $conn->prepare("SELECT * FROM offers WHERE offer_number = :pass");
$get_data->execute(array(
    ":pass" => $ClientID
));
if ($get_data->rowCount() < 1) {
    header("location: 404.php");
}
$arr = $get_data->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $site_name ?></title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./assets/media/image/favicon.png" />

    <!-- Main css -->
    <link rel="stylesheet" href="./vendors/bundle.css" type="text/css">

    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">


    <!-- App css -->
    <link rel="stylesheet" href="./assets/css/app.min.css" type="text/css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="scrollable-layout" style="background-color:white">
    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-icon"></div>
        <span>Yükleniyor...</span>
    </div>
    <!-- ./ Preloader -->

    <!-- Layout wrapper -->
    <div class="layout-wrapper">
        <!-- Content wrapper -->
        <div class="content-wrapper">

            <!-- Content body -->
            <div class="content-body">
                <!-- Content -->
                <div class="content ">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body p-50">
                                    <?php
                                    $getData = $conn->prepare("SELECT * FROM offers WHERE offer_id = :id");
                                    $getData->execute(array(
                                        "id" => $ClientID
                                    ));
                                    $dRow = $getData->fetch(PDO::FETCH_ASSOC);

                                    $number = $dRow['offer_number'];
                                    $get_tax = $conn->prepare("SELECT * FROM tax INNER JOIN offer_price ON tax.tax_id = offer_price.offer_tax WHERE offer_number = :num");
                                    $get_tax->execute(array(
                                        "num" => $number
                                    ));
                                    $numRow = $get_tax->fetch(PDO::FETCH_ASSOC);

                                    //Teklifin para birimi.
                                    $costUnit = $dRow['offer_costUnit'];
                                    if ($costUnit == 1) {
                                        $cost = "₺";
                                    } else if ($costUnit == 2) {
                                        $cost = "$";
                                    } else {
                                        $cost = "€";
                                    }

                                    $cid = $dRow['offer_client'];
                                    $get_Lang = $conn->prepare("SELECT client_lang FROM clients WHERE client_id = :id");
                                    $get_Lang->execute(array(
                                        "id" => $cid
                                    ));
                                    $cRow = $get_Lang->fetch(PDO::FETCH_ASSOC);

                                    $num = $dRow['offer_number'];

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
                                            <?php

                                            if ($arr['offer_status'] != 0) {
                                            ?>
                                                <a href="javascript:window.print()" class="btn btn-success ml-2">Yazdır</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a data-toggle="modal" data-target="#exampleModal2" class="btn btn-primary">Teklifi Kabul Et</a>
                                                <a data-toggle="modal" data-target="#exampleModal1" class="btn btn-danger ml-2">Teklifi Reddet</a>
                                                <a href="javascript:window.print()" class="btn btn-success ml-2">Yazdır</a>
                                            <?php
                                            }

                                            ?>

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
                                                <p>TOTAL TAX : <?php $kdv = ($dRow['offer_total'] * $numRow['tax_number'] / 100);
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
                                            <?php

                                            if ($arr['offer_status'] != 0) {
                                            ?>
                                                <a href="javascript:window.print()" class="btn btn-success ml-2">Print</a>
                                            <?php
                                            } else {
                                            ?>
                                                <a data-toggle="modal" data-target="#exampleModal2" class="btn btn-primary">Accept The Offer</a>
                                                <a data-toggle="modal" data-target="#exampleModal1" class="btn btn-danger ml-2">Reject The Offer</a>
                                                <a href="javascript:window.print()" class="btn btn-success ml-2">Print</a>
                                            <?php
                                            }

                                            ?>

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

    <?php
    if ($cRow['client_lang'] == "tr") {
    ?>
        <!-- Modal 1 Ret -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal1Label">Teklif Reddediliyor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır, Reddetme</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='offerNo.php?id=<?= $ClientID ?>'">Evet, Reddet</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2 Kabul -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal1Label">Teklif Kabul Ediliyor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Hayır, Etme</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='offerYes.php?id=<?= $ClientID ?>'">Evet, Kabul Et</button>
                    </div>
                </div>
            </div>
        </div>

    <?php
    } else {
    ?>
        <!-- Modal 1 Ret -->
        <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal1Label">Offer Rejected</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Don't Reject</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='offerNo.php?id=<?= $ClientID ?>'">Yes, Reject</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal 2 Kabul -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModal1Label">Offer Accepted</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No, Don't</button>
                        <button type="button" class="btn btn-primary" onclick="window.location.href='offerYes.php?id=<?= $ClientID ?>'">Yes, Accept</button>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }



    ?>
    <!-- ./ Layout wrapper -->

    <!-- Main scripts -->
    <script src="./vendors/bundle.js"></script>


    <!-- App scripts -->
    <script src="./assets/js/app.min.js"></script>
</body>

</html>