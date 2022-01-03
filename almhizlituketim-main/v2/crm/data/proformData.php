<?php
include "../inc/connection.php";
extract($_POST);
$firmaAdi = $_POST['firmaAdi'];
$teklifFrima = $_POST['teklifFirma'];
$offer_subject = $_POST['offer_subject'];
$tarih = $_POST['daterangepicker'];
$aciklama = $_POST['offer_note'];

$run = $conn->prepare("INSERT INTO proforms SET 
        proform_client      = :proform_client,
        proform_subject     = :proform_subject,
        proform_date        = :proform_date,
        proform_note        = :proform_note,
        proform_status      = :durum");
$run->execute(array(
    'proform_client'      => $firmaAdi,
    'proform_subject'     => $offer_subject,
    'proform_date'        => $tarih,
    'proform_note'        => $aciklama,
    "durum"               => 0
));

$id = $conn->lastInsertId();

$cls = $conn->prepare("UPDATE proforms SET proform_number = :num ,proform_pass = :pass WHERE proform_id = :id");
$cls->execute(array(
    ":num"  => $id,
    ":pass" =>  md5("$id"),
    ":id"   => $id
));

for ($j = 0; $j < count($_POST['group-a']); $j++) {
    $arr = $_POST['group-a'][$j];
    $items = json_encode($arr, true);
    $dizi = json_decode($items, true);
    $item = $dizi["items"];
    $item_content = $dizi["item_content"];
    $item_pcs = $dizi["item_pcs"];
    $unit = $dizi["unit"];
    $item_price = $dizi["item_price"];
    $tax = $dizi["tax"];

    $ekle = $conn->prepare("INSERT INTO proform_content SET 
        proform_number      = :proform_number,
        client_id           = :client_id,
        offer_id            = :offer_id,
        content_item        = :content_item,
        content_desc        = :content_desc,
        content_pcs         = :content_pcs,
        content_unit        = :content_unit,
        content_unitPrice   = :content_unitPrice,
        content_tax         = :content_tax");

    $ekle->execute(array(
        "proform_number"    => $id,
        "client_id"         => $firmaAdi,
        "offer_id"          => $id,
        "content_item"      => $item,
        "content_desc"      => $item_content,
        "content_pcs"       => $item_pcs,
        "content_unit"      => $unit,
        "content_unitPrice" => $item_price,
        "content_tax"       => $tax
    ));

    $price = $item_price * $item_pcs;


    $kaydet = $conn->prepare("INSERT INTO proform_price SET
        offer_pcs = :offer_pcs,
        offer_price = :offer_price,
        offer_tax = :offer_tax,
        offer_number = :offer_number");
    $kaydet->execute(array(
        "offer_pcs" => $item_pcs,
        "offer_price" => $price,
        "offer_tax" => $tax,
        "offer_number" => $id
    ));


    $dizi = array(
        "$j" => "$price"
    );

    $toplam += $dizi[$j];

};

$toplam_price = $toplam;
$add = $conn->prepare("UPDATE proforms SET proform_total = :total WHERE proform_id = :id");
$add->execute(array(
    "total" => $toplam_price,
    "id" => $id
));
