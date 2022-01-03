<?php

$user   = "rfyalmhi_data";
$pass   = "aDK!n@qy+0Cr";
$db     = "rfyalmhi_crm";
$host   = "5.2.87.161";



// $user   = "root";

// $pass   = "";

// $db     = "crm";

// $host   = "localhost";



$connection = mysqli_connect("$host", "$user", "$pass", "$db");

if (mysqli_connect_errno()) {

    echo "Failed to connect to MySQL: " . mysqli_connect_error();

}

mysqli_query($connection, "SET NAMES 'utf8'");

