<?php





$user   = "rfyalmhi_data";
$pass   = "aDK!n@qy+0Cr";
$db     = "rfyalmhi_crm";
$host   = "5.2.87.161";



// $user   = "root";

// $pass   = "";

// $db     = "crm";

// $host   = "localhost";



try

{

    $conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $conn->exec("SET NAMES 'utf8'; SET CHARSET 'utf8'");

}catch (PDOException $e)

{

    print "MYSQL CONNECTION FAILED. PLEASE CONTACT TO YOUR SYSTEM ADMIN !</br>HERE IS FAILED CODE : ". $e->getMessage();

    die();

}







## Setting Query ##

$getSettings = $conn->prepare("SELECT * FROM settings");

$getSettings->execute();

$sRow = $getSettings->fetch(PDO::FETCH_ASSOC);

$site_name          = $sRow["site_name"];

$site_mail          = $sRow["site_mail"];

$site_phone         = $sRow["site_phone"];

$site_link          = $sRow["site_link"];

$company_name       = $sRow["company_name"];

$company_address    = $sRow["company_address"];

$company_city       = $sRow["company_city"];

$company_vkn        = $sRow["company_vkn"];

$company_phone      = $sRow["company_phone"];

$company_postCode   = $sRow["company_postCode"];



#######################################################################



$getAdmin = $conn->prepare("SELECT * FROM admins Where admin_id = 1");

$getAdmin->execute();

$adminRow = $getAdmin->fetch(PDO::FETCH_ASSOC);

$adminUser = $adminRow["admin_kadi"];



?>