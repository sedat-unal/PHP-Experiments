<?php

try
{
    $db = new PDO('mysql:host=localhost;dbname=almhizlituketim', "root", "");
}
catch (PDOException $e)
{
    print $e->getMessage();
    die();
}


$setting = $db->query("SELECT * FROM settings");
$setRow = $setting->fetch(PDO::FETCH_ASSOC);
if($setting->rowCount())
{
    $site_href = $setRow["site_href"];
    $site_mail = $setRow["site_mail"];
    $site_title = $setRow["site_title"];
}

