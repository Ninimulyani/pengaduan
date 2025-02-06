<?php
$host = "localhost";
$user = "root";
$pass = "";
$name = "kp";

$db = mysqli_connect($host, $user, $pass, $name);

if (!$db) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
