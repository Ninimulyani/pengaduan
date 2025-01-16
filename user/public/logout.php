<?php
session_start(); // Memulai session

// Hapus semua session
session_unset();

// Hancurkan session
session_destroy();

// Arahkan kembali ke halaman login
header("Location: login-user.php");
exit();
?>
