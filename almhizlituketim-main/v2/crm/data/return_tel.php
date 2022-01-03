<?php
include('baglan.php');
extract($_POST);

$ret = mysqli_query($connection, "SELECT * FROM offers WHERE offer_id = '$clientid' LIMIT 1");
$row = $ret->fetch_assoc();
$cid = $row['offer_client'];

$ret2 = mysqli_query($connection, "SELECT * FROM clients WHERE client_id = '$cid' LIMIT 1");
$row2 = $ret2->fetch_assoc();
$clientphone = $row2['client_phone'];


echo $clientphone;

