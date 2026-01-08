<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "kothamate_db";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}
?>
