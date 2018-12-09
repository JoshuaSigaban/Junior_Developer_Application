<?php
$dBServername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "developercodingtestdb";

// connection
$conn = mysqli_connect($dBServername, $dBUsername, $dBPassword, $dBName);

// connection check
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
