<?php
$id = $_GET['id'];

if(!isset($id))
{
    echo "İşlem Başarısız";
}
include "inc/connection.php";

$update = $conn->prepare("UPDATE offers SET offer_status = :durum WHERE offer_id = :pass");
$update->execute(array(
    ":durum" => "1",
    ":pass" => $id
));
if($update)
{
    $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
    header("Location: ".$url);
}
else
{
    echo "failed";
}
?>