<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "kp");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Ambil data dari form
    $nama_array = $_POST['nama']; // Array nama
    $nik_array = $_POST['nik']; // Array NIK
    $shdk_array = $_POST['shdk']; // Array SHDK
    $keterangan_array = $_POST['keterangan']; // Array Keterangan
    $jenis_permohonan_array = $_POST['jenis_permohonan']; // Array Jenis Permohonan
    $semula_array = $_POST['semula']; // Array Semula
    $menjadi_array = $_POST['menjadi']; // Array Menjadi
    $dasar_perubahan_array = $_POST['dasar_perubahan']; // Array Dasar Perubahan

    // Loop untuk menyimpan data ke database
    for ($i = 0; $i < count($nama_array); $i++) {
        $nama = $conn->real_escape_string($nama_array[$i]);
        $nik = $conn->real_escape_string($nik_array[$i]);
        $shdk = $conn->real_escape_string($shdk_array[$i]);
        $keterangan = $conn->real_escape_string($keterangan_array[$i]);
        $jenis_permohonan = $conn->real_escape_string($jenis_permohonan_array[$i]);
        $semula = $conn->real_escape_string($semula_array[$i]);
        $menjadi = $conn->real_escape_string($menjadi_array[$i]);
        $dasar_perubahan = $conn->real_escape_string($dasar_perubahan_array[$i]);

        // Query insert ke tabel perubahan_data_penduduk
        $sql = "INSERT INTO perubahan_data_penduduk (nama, nik, shdk, keterangan, jenis_permohonan, semula, menjadi, dasar_perubahan)
                VALUES ('$nama', '$nik', '$shdk', '$keterangan', '$jenis_permohonan', '$semula', '$menjadi', '$dasar_perubahan')";

        if (!$conn->query($sql)) {
            echo "Error: " . $conn->error;
        }
    }

    echo "Data berhasil ditambahkan.";
}

$conn->close();
