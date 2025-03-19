<?php

$serverName = "localhost";
$dBUsername = "root";
$dbPassword = "";
$dBName = "loginsystem";

$conn = mysqli_connect($serverName, $dBUsername, $dbPassword, $dBName);

if (!$conn) {
    die("Connection failed: " .mysqli_connect_error());
}