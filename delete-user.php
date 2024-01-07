<?php 
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kp";

$koneksi = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die(mysqli_error($koneksi));

$id = $_GET['id'];
mysql_query("DELETE FROM user WHERE id='$id'")or die(mysql_error());
 
header("location:user.php?pesan=hapus");
?>