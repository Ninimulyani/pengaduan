<?php
// Koneksi ke database
$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "kp";

// Membuat koneksi
$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name) or die(mysqli_error($koneksi));

// Fungsi untuk mengambil data admin yang login
function logged_admin($admin_login)
{
    global $koneksi, $divisi, $id_admin;

    // Menyusun query SQL dengan menggunakan JOIN untuk menggabungkan tabel admin dan divisi
    $sql = "SELECT admin.id_admin, admin.username, divisi.nama_divisi 
            FROM admin 
            INNER JOIN divisi ON admin.divisi = divisi.id_divisi
            WHERE admin.username = ?";

    // Menyiapkan query
    $stmt = $koneksi->prepare($sql);
    if (!$stmt) {
        die("Pernyataan SQL tidak valid: " . mysqli_error($koneksi));  // Jika gagal menyiapkan statement
    }

    // Mengikat parameter untuk username (menggunakan 's' untuk string)
    $stmt->bind_param('s', $admin_login);

    // Menjalankan query
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $divisi = $row['nama_divisi'];
            $id_admin = $row['id_admin'];

            // Mengembalikan hasil dalam bentuk array untuk penggunaan lebih lanjut
            return array('id_admin' => $id_admin, 'divisi' => $divisi);
        } else {
            // Jika tidak ditemukan
            return null;
        }
    } else {
        // Jika query gagal dijalankan
        echo "Gagal menjalankan query: " . mysqli_error($koneksi);
        return null;
    }
}

// Contoh penggunaan fungsi
$admin_login = 'username_admin';  // Gantilah dengan username yang ingin diuji
$admin_data = logged_admin($admin_login);

if ($admin_data) {
    echo "ID Admin: " . $admin_data['id_admin'] . "<br>";
    echo "Divisi: " . $admin_data['divisi'];
} else {
    echo "Admin tidak ditemukan.";
}
