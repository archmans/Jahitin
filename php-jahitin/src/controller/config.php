<?php

$server = "php-jahitin-db";
$username = "user";
$password = "jahitin";
$database = "php_jahitin"; 

$conn = mysqli_connect($server, $username, $password, $database);

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}
?>
