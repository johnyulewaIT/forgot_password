<?php 
// DB credentials.
// params to connect to the database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "forgot_pass";

// connect to the database

    $conn = mysqli_connect($dbHost, $dbUser, $dbPass,$dbName);
    if (!$conn) {
        die ("Connection Failed");
    }

?>