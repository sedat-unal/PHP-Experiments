<?php 

extract($_POST);
include('baglan.php');

var_dump($_POST);

$ret = mysqli_query($connection, "SELECT * FROM proforms WHERE proform_id = '$clientid' LIMIT 1");
$row = $ret->fetch_assoc();
$cid = $row['proform_client'];

$ret2 = mysqli_query($connection, "SELECT * FROM clients WHERE client_id = '$cid' LIMIT 1");
$row2 = $ret2->fetch_assoc();
$clientphone = $row2['client_phone'];

echo $clientphone;


?>