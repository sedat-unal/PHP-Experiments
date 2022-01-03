<?php 

/* $username = "rfyalmhi_blog";
$password = "FNaT%-@0g23L";
$db = "rfyalmhi_almNew";
$host = "localhost"; */
$username = "root";
$password = "";
$db = "alm";
$host = "localhost";

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->query("SET CHARACTER SET utf8");
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}


$getSettings = $conn->query("SELECT * FROM settings", PDO::FETCH_ASSOC);
if($getSettings->rowCount()) {
    foreach($getSettings as $settingRow) {
        $settings[] = $settingRow;
    }
}
