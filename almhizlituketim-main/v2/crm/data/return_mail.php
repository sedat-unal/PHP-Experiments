<?php

extract($_POST);
include "baglan.php";

$ret = mysqli_query($connection, "SELECT offer_client FROM offers WHERE offer_id = '$clientid' LIMIT 1");
$row = $ret->fetch_assoc();
$cid = $row['offer_client'];

$ret2 = mysqli_query($connection, "SELECT client_email FROM clients WHERE client_id = '$cid' AND client_email!='' AND client_email LIKE '%@%.%' LIMIT 1");
$row2 = $ret2->fetch_assoc();
$mail = $row2['client_email'];
echo $mail;
