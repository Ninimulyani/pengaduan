<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kp";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// Periksa koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}


// ambil data dari user yang login
function logged_admin()
{
    global $koneksi, $admin_login, $id_admin;
    $sql = "SELECT * FROM admin WHERE admin.username = ?";

    // Coba menyiapkan pernyataan
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        die("Pernyataan SQL tidak valid: " . mysqli_error($koneksi));
    }

    $stmt->bind_param('s', $admin_login);

    // Pastikan query dieksekusi dengan sukses
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $id_admin = $row['id_admin']; // Pastikan kolom ini ada di tabel admin
        }
    } else {
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
    }
}