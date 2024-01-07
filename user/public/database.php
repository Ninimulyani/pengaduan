<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kp";

$koneksi = mysqli_connect($db_host,$db_user,$db_pass,$db_name) or die(mysqli_error($koneksi));

// ambil data dari user yang login
function logged_admin() {
    global $koneksi, $admin_login, $divisi, $id_admin;
    $sql = "SELECT * FROM admin, divisi WHERE admin.username = ? AND admin.divisi = divisi.id_divisi";
    
    // Coba menyiapkan pernyataan
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        die("Pernyataan SQL tidak valid: " . mysqli_error($koneksi)); // Menggunakan mysqli_error() untuk menampilkan pesan kesalahan
    }

    $stmt->bind_param('s', $admin_login); // 's' menunjukkan bahwa Anda mengikat sebuah string (sesuaikan dengan tipe data kolomnya)

    // Pastikan query dieksekusi dengan sukses
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $divisi = $row['nama_divisi'];
            $id_admin = $row['id_admin'];
        }
    } else {
        // Handle kesalahan eksekusi query jika perlu
        echo "Gagal menjalankan query: " . mysqli_error($koneksi); // Menggunakan mysqli_error() untuk menampilkan pesan kesalahan
    }
}




