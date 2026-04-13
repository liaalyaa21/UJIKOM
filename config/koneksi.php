<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "taskhub";

$koneksi = mysqli_connect($host, $user, $pass, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>