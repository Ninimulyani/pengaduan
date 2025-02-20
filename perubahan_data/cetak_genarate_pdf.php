<?php
ob_start(); // Tangkap semua output

require_once('../TCPDF/tcpdf.php');
require_once("../database.php");
logged_admin();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    exit("ID tidak ditemukan.");
}

$id = (int)$_GET['id']; // Pastikan integer

// Cek koneksi database
if (!$koneksi instanceof mysqli) {
    exit("Kesalahan koneksi ke database.");
}

$stmt = $koneksi->prepare("
    SELECT 
        p.id, p.no_kk, p.nama_lengkap, p.nik, p.alamat_rumah,
        pend.nik AS nik_penduduk, pend.nama AS nama_penduduk, pend.no_kk AS no_kk_penduduk, pend.shdk, pend.keterangan AS keterangan_penduduk,
        perm.nik AS nik_permohonan, perm.jenis_permohonan, perm.semula, perm.menjadi  
    FROM pemohon p
    JOIN penduduk pend ON p.input_id = pend.input_id
    JOIN permohonan_perubahan perm ON pend.nik = perm.nik
    WHERE p.id = ?
");
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
$pdf->SetFont('helvetica', '', 10);
$html = "
<style>
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 5px;
        margin-bottom: 10px;
    }
    th, td {
        padding: 8px;
    }
    th {
        font-weight: bold;
        text-align: left;
        width: 40%;
    }
</style>

<table>
<strong><u>DATA PEMOHON</u></strong>
<br>
    <tr><th>No KK:</th><td>" . htmlspecialchars($data['no_kk']) . "</td></tr>
    <tr><th>Nama Pemohon:</th><td>" . htmlspecialchars($data['nama_lengkap']) . "</td></tr>
    <tr><th>NIK Pemohon:</th><td>" . htmlspecialchars($data['nik']) . "</td></tr>
    <tr><th>Alamat Pemohon:</th><td>" . htmlspecialchars($data['alamat_rumah']) . "</td></tr>

<strong><u>DATA PENDUDUK</u></strong>
<br>
    <tr><th>NIK Penduduk:</th><td>" . htmlspecialchars($data['nik_penduduk']) . "</td></tr>
    <tr><th>Nama Penduduk:</th><td>" . htmlspecialchars($data['nama_penduduk']) . "</td></tr>
    <tr><th>No KK Penduduk:</th><td>" . htmlspecialchars($data['no_kk_penduduk']) . "</td></tr>
    <tr><th>SHDK:</th><td>" . htmlspecialchars($data['shdk']) . "</td></tr>
    <tr><th>Keterangan:</th><td>" . htmlspecialchars($data['keterangan_penduduk']) . "</td></tr>

<strong><u>PERMOHONAN PERUBAHAN</u></strong>
<br>
    <tr><th>NIK Permohonan:</th><td>" . htmlspecialchars($data['nik_permohonan']) . "</td></tr>
    <tr><th>Jenis Permohonan:</th><td>" . htmlspecialchars($data['jenis_permohonan']) . "</td></tr>
    <tr><th>Semula:</th><td>" . htmlspecialchars($data['semula']) . "</td></tr>
    <tr><th>Menjadi:</th><td>" . htmlspecialchars($data['menjadi']) . "</td></tr>
</table>";



$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Ln(10);
$pdf->SetFont('helvetica', '', 12);

// Posisi awal Y
$y = $pdf->GetY();

// Posisi tanda tangan
$pdf->SetXY(105, $y);
$pdf->MultiCell(90, 5, " Maros " . date("d-m-Y") . "\nPelapor", 0, 'R');

$pdf->Ln(20);

// Simpan atau tampilkan PDF
$pdf->Output('Kartu_Identitas_Anak_' . htmlspecialchars($data['id']) . '.pdf', 'I');