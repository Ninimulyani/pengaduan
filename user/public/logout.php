<?php
session_start(); // Memulai session

// Hapus semua session
session_unset();

// Hancurkan session
session_destroy();

// Hapus cookie sesi (opsional, untuk memastikan)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Arahkan kembali ke halaman login
header("Location: login-user.php");
exit();
?>