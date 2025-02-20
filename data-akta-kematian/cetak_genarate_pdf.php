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
$stmt = $koneksi->prepare("SELECT * FROM akta_kematian WHERE id = ?");
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
$pdf->SetSubject('Akta Kematian');

// Atur margin sesuai kertas F4
$pdf->SetMargins(15, 10, 15);
$pdf->AddPage();

$pdf->SetFont('helvetica', 'B', 17);
$pdf->SetXY(180, 10); // Sesuaikan posisi agar di pojok kanan atas
$pdf->Cell(20, 10, 'F.2-01', 0, 1, 'R');


// Header PDF
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Cell(0, 5, 'FORMULIR PELAPORAN PENCATATAN SIPIL DI DALAM WILAYAH NKRI', 0, 1, 'C');
$pdf->Ln(5);

$pdf->Cell(0, 5, 'Jenis Laporan Pencatatan Sipil Kematian', 0, 1, 'C');
$pdf->Ln(3);

// Isi Data dalam Tabel
$pdf->SetFont('helvetica', '', 11);
$html = "
<style>
    table {
        width: 100%;
        border: 1px solid black;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    th {
        font-weight: bold;
        text-align: left;
    }
</style>
<table>
<strong><u>DATA PELAPOR</u></strong>
<br>
    <tr><th width='40%'>Nama Pelapor    :</th><td>" . htmlspecialchars($data['nama_pelapor']) . "</td></tr>
    <tr><th>NIK Pelapor     :</th><td>" . htmlspecialchars($data['nik_pelapor']) . "</td></tr>
    <tr><th>Nomor Dokumen Perjalanan    :</th><td>" . htmlspecialchars($data['nomor_dokumen_perjalanan']) . "</td></tr>
    <tr><th>Nomor KK Pelapor    :</th><td>" . htmlspecialchars($data['nomor_kartu_keluarga_pelapor']) . "</td></tr>
    <tr><th>Kewarganegaraan Pelapor :</th><td>" . htmlspecialchars($data['kewarganegaraan_pelapor']) . "</td></tr>
    <tr><th>Nomor Handphone :</th><td>" . htmlspecialchars($data['nomor_handphone']) . "</td></tr>
    <tr><th>Alamat Email    :</th><td>" . htmlspecialchars($data['email']) . "</td></tr>
</table>
<p>
<br>
<table>
<strong><u>DATA SAKSI 1</u></strong>
    <br>
    <tr><th>Nama Saksi 1    :</th><td>" . htmlspecialchars($data['nama_saksi_1']) . "</td></tr>
    <tr><th>NIK Saksi 1 :</th><td>" . htmlspecialchars($data['nik_saksi_1']) . "</td></tr>
    <tr><th>Nomor KK Saksi 1    :</th><td>" . htmlspecialchars($data['nomor_kartu_keluarga_saksi_1']) . "</td></tr>
    <tr><th>Kewarganegaraan Saksi 1 :</th><td>" . htmlspecialchars($data['kewarganegaraan_saksi_1']) . "</td></tr>
<strong><u>DATA SAKSI II</u></strong>
    <br>
    <tr><th>Nama Saksi 2    :</th><td>" . htmlspecialchars($data['nama_saksi_1']) . "</td></tr>
    <tr><th>NIK Saksi 2 :</th><td>" . htmlspecialchars($data['nik_saksi_1']) . "</td></tr>
    <tr><th>Nomor KK Saksi 2    :</th><td>" . htmlspecialchars($data['nomor_kartu_keluarga_saksi_1']) . "</td></tr>
    <tr><th>Kewarganegaraan Saksi 2 :</th><td>" . htmlspecialchars($data['kewarganegaraan_saksi_1']) . "</td></tr>
</table>
<p>
<table>
<strong><u>DATA ORANG TUA**</u></strong>
    <br>
    <tr><th>Nama Ayah   :</th><td>" . htmlspecialchars($data['nama_ayah']) . "</td></tr>
    <tr><th>NIK Ayah    :</th><td>" . htmlspecialchars($data['nik_ayah']) . "</td></tr>
    <tr><th>Tempat & Tanggal Lahir Ayah :</th><td>" . htmlspecialchars($data['tempat_lahir_ayah']) . ", " . htmlspecialchars($data['tanggal_lahir_ayah']) . "</td></tr>
    <tr><th>Kewarganegaraan Ayah    :</th><td>" . htmlspecialchars($data['kewarganegaraan_ayah']) . "</td></tr>
    <tr><th>Nama Ibu    :</th><td>" . htmlspecialchars($data['nama_ibu']) . "</td></tr>
    <tr><th>NIK Ibu :</th><td>" . htmlspecialchars($data['nik_ibu']) . "</td></tr>
    <tr><th>Tempat & Tanggal Lahir Ibu  :</th><td>" . htmlspecialchars($data['tempat_lahir_ibu']) . ", " . htmlspecialchars($data['tanggal_lahir_ibu']) . "</td></tr>
    <tr><th>Kewarganegaraan Ibu :</th><td>" . htmlspecialchars($data['kewarganegaraan_ibu']) . "</td></tr>
</table>
<p>
<table>
<strong><u>DATA ANAK</u></strong>
<br>
    <tr><th>1. Nama Anak:</th><td>" . htmlspecialchars($data['nik_alm']) . "</td></tr>
    <tr><th>2. Jenis Kelamin:</th><td>" . htmlspecialchars($data['nama_lengkap_alm']) . "</td></tr>
    <tr><th>3. Tempat Dilahirkan:</th><td>" . htmlspecialchars($data['hari_tanggal_kematian']) . "</td></tr>
    <tr><th>4. Tempat Kelahiran:</th><td>" . htmlspecialchars($data['pukul']) . "</td></tr>
    <tr><th>5. Hari dan Tanggal Lahir:</th><td>" . htmlspecialchars($data['sebab_kematian']) . "</td></tr>
    <tr><th>6. Pukul    :</th><td>" . htmlspecialchars($data['tempat_kematian']) . "</td></tr>
    <tr><th>7. Jenis Kelahiran  :</th><td>" . htmlspecialchars($data['yang_menerangkan']) . "</td></tr>
</table>";
// Tambahkan ke PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(10);

$pdf->SetFont('helvetica', '', 12);

// Posisi awal Y
$y = $pdf->GetY();

// Kolom kiri (tanda tangan kiri)
$pdf->SetXY(15, $y);

$pdf->SetXY(15, $y);
$pdf->MultiCell(90, 5, "Mengetahui\nKepala Desa / Lurah\nPejabat Dukcapil Yang Membidangi", 0, 'L');

$pdf->SetXY(105, $y);
$pdf->MultiCell(90, 5, " Maros " . date("d-m-Y") . "\nPelapor", 0, 'R');

$pdf->Ln(20);

$pdf->SetXY(15, $pdf->GetY());
$pdf->Cell(90, 10, '(.....................................)', 0, 0, 'L');
$pdf->Cell(90, 10, '(.....................................)', 0, 1, 'R');

// Simpan atau tampilkan PDF
$pdf->Output('akta_kelahiran_' . htmlspecialchars($data['id']) . '.pdf', 'I');
