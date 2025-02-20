<?php
require_once('../TCPDF/tcpdf.php'); // Sesuaikan dengan path TCPDF Anda
require_once("../database.php"); // Pastikan database.php menggunakan MySQLi dan bukan PDO
logged_admin();

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Periksa apakah $koneksi adalah objek MySQLi
if (!$koneksi instanceof mysqli) {
    die("Kesalahan koneksi ke database.");
}

// Ambil data dari database berdasarkan ID
$stmt = $koneksi->prepare("SELECT * FROM data_anak WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    die("Data tidak ditemukan.");
}

// Buat objek PDF dengan ukuran F4
$pdf = new TCPDF('P', 'mm', array(210, 330), true, 'UTF-8', false);
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Sistem Akta Kematian');
$pdf->SetSubject('Kartu Identitas Anak');

// Atur margin sesuai kertas F4
$pdf->SetMargins(15, 10, 15);
$pdf->AddPage();




// Isi Data dalam Tabel
$pdf->SetFont('helvetica', '', 11);
$html = "
<style>
    table {
        width: 100%;
        border-collapse: separate; /* Gunakan separate agar border-spacing berfungsi */
        border-spacing: 0 10px; /* Jarak antar baris */
        margin-bottom: 10px;
    }
    th, td {
        padding: 8px; /* Memberikan ruang di dalam sel */
    }
    th {
        font-weight: bold;
        text-align: left;
        width: 40%;
    }
</style>


<table>
<strong><u>DATA ANAK</u></strong>
<br>
    <tr><th width='40%'>NIK Anak:</th><td>" . htmlspecialchars($data['nik_anak']) . "</td></tr>
    <tr><th>Nomor Akta Kelahiran:</th><td>" . htmlspecialchars($data['nomor_akta_kelahiran']) . "</td></tr>
    <tr><th>Nama Anak:</th><td>" . htmlspecialchars($data['nama_anak']) . "</td></tr>
    <tr><th>Tempat Lahir:</th><td>" . htmlspecialchars($data['tempat_lahir']) . "</td></tr>
    <tr><th>Tanggal Lahir:</th><td>" . htmlspecialchars($data['tanggal_lahir']) . "</td></tr>
    <tr><th>Anak Ke:</th><td>" . htmlspecialchars($data['anak_ke']) . "</td></tr>
<strong><u>DATA ORANG TUA</u></strong>
    <br>
    <tr><th>Nama Ayah:</th><td>" . htmlspecialchars($data['nama_ayah']) . "</td></tr>
    <tr><th>Nama Ibu:</th><td>" . htmlspecialchars($data['nama_ibu']) . "</td></tr>
<strong><u>DATA PEMOHON</u></strong>
<br>
    <tr><th>Alamat Pemohon:</th><td>" . htmlspecialchars($data['alamat_pemohon']) . "</td></tr>
</table>";

// Tambahkan ke PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 12);

// Posisi awal Y
$y = $pdf->GetY();

// Kolom kiri (tanda tangan kiri)
$pdf->SetXY(15, $y);

$pdf->SetXY(105, $y);
$pdf->MultiCell(90, 5, " Maros " . date("d-m-Y") . "\nPelapor", 0, 'R');

$pdf->Ln(20);


// Simpan atau tampilkan PDF
$pdf->Output('Kartu Identitas Anak_' . htmlspecialchars($data['id']) . '.pdf', 'I');
