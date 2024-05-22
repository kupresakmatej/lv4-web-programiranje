<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gameshop_db";

$con = mysqli_connect($servername, $username, $password, $dbname);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    die();
}

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
?>