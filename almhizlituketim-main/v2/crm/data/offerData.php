<?php

include "../inc/connection.php";

extract($_POST);

error_reporting(0);

$firmaAdi = $_POST['firmaAdi'];

$offer_subject = $_POST['offer_subject'];

$tarih = $_POST['simple-date-range-picker-callback'];

$aciklama = $_POST['offer_note'];

$paraBirimi = $_POST['paraBirimi'];



$run = $conn->prepare("INSERT INTO offers SET 

        offer_client    = :offer_client,

        offer_subject   = :offer_subject,

        offer_lastDate  = :offer_lastDate,

        offer_costUnit  = :offer_costUnit, 

        offer_note      = :offer_note,

        offer_status    = :durum");

$run->execute(array(

    'offer_client'      => $firmaAdi,

    'offer_subject'     => $offer_subject,

    'offer_lastDate'    => $tarih,

    'offer_costUnit'    => $paraBirimi,

    'offer_note'        => $aciklama,

    "durum"             => 0

));



$id = $conn->lastInsertId();



$cls = $conn->prepare("UPDATE offers SET offer_number = :num ,offer_pass = :pass WHERE offer_id = :id");

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



    $ekle = $conn->prepare("INSERT INTO offer_content SET 

        offer_number        = :offer_number,

        client_id           = :client_id,

        offer_id            = :offer_id,

        content_item        = :content_item,

        content_desc        = :content_desc,

        content_pcs         = :content_pcs,

        content_unit        = :content_unit,

        content_unitPrice   = :content_unitPrice,

        content_tax         = :content_tax");



    $ekle->execute(array(

        "offer_number"      => $id,

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





    $kaydet = $conn->prepare("INSERT INTO offer_price SET

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

$add = $conn->prepare("UPDATE offers SET offer_total = :total WHERE offer_id = :id");

$add->execute(array(

    "total" => $toplam_price,

    "id" => $id

));

