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
$stmt = $koneksi->prepare("SELECT * FROM surat_pindah_penduduk WHERE id = ?");
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
        border-collapse: separate; /* Gunakan separate agar border-spacing berfungsi */
        border-spacing: 0 5px; /* Jarak antar baris */
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
<strong><u>DATA PEMOHON</u></strong>
<br>
    <tr><th>No KK:</th><td>" . htmlspecialchars($data['no_kk']) . "</td></tr>
    <tr><th>Nama Pemohon:</th><td>" . htmlspecialchars($data['nama_lengkap_pemohon']) . "</td></tr>
    <tr><th>NIK Pemohon:</th><td>" . htmlspecialchars($data['nik_pemohon']) . "</td></tr>
    <tr><th>Jenis Permohonan:</th><td>" . htmlspecialchars($data['jenis_permohonan']) . "</td></tr>
    <tr><th>Alamat Jelas:</th><td>" . htmlspecialchars($data['alamat_jelas']) . "</td></tr>
    <tr><th>Desa/Kelurahan Asal:</th><td>" . htmlspecialchars($data['desa_kelurahan_asal']) . "</td></tr>
    <tr><th>Kecamatan Asal:</th><td>" . htmlspecialchars($data['kecamatan_asal']) . "</td></tr>
    <tr><th>Kabupaten/Kota Asal:</th><td>" . htmlspecialchars($data['kabupaten_kota_asal']) . "</td></tr>
    <tr><th>Provinsi Asal:</th><td>" . htmlspecialchars($data['provinsi_asal']) . "</td></tr>
    <tr><th>Kode Pos Asal:</th><td>" . htmlspecialchars($data['kode_pos_asal']) . "</td></tr>

<strong><u>DATA PINDAH</u></strong>
<br>
    <tr><th>Jenis Pindah:</th><td>" . htmlspecialchars($data['jenis_pindah']) . "</td></tr>
    <tr><th>Alamat Pindah:</th><td>" . htmlspecialchars($data['alamat_pindah']) . "</td></tr>
    <tr><th>Desa/Kelurahan Pindah:</th><td>" . htmlspecialchars($data['desa_kelurahan_pindah']) . "</td></tr>
    <tr><th>Kecamatan Pindah:</th><td>" . htmlspecialchars($data['kecamatan_pindah']) . "</td></tr>
    <tr><th>Kabupaten/Kota Pindah:</th><td>" . htmlspecialchars($data['kabupaten_kota_pindah']) . "</td></tr>
    <tr><th>Provinsi Pindah:</th><td>" . htmlspecialchars($data['provinsi_pindah']) . "</td></tr>
    <tr><th>Kode Pos Pindah:</th><td>" . htmlspecialchars($data['kode_pos_pindah']) . "</td></tr>
    <tr><th>Alasan Pindah:</th><td>" . htmlspecialchars($data['alasan_pindah']) . "</td></tr>
    <tr><th>Jenis Kepindahan:</th><td>" . htmlspecialchars($data['jenis_kepindahan']) . "</td></tr>
    <tr><th>Anggota Keluarga Tidak Pindah:</th><td>" . htmlspecialchars($data['anggota_keluarga_tidak_pindah']) . "</td></tr>
    <tr><th>Anggota Keluarga Pindah:</th><td>" . htmlspecialchars($data['anggota_keluarga_pindah']) . "</td></tr>

<strong><u>Daftar Anggota Keluarga Yang Pindah</u></strong>
<br>
<tr>
    <th width='50%'>Daftar NIK Anggota Pindah</th>
    <th width='50%'>Daftar Anggota Pindah</th>
</tr>
<tr>
    <td>" . implode('<br>', unserialize($data['daftar_nik_anggota_pindah']) ?: []) . "</td>
    <td>" . implode('<br>', unserialize($data['daftar_anggota_pindah']) ?: []) . "</td>
</tr>


<strong><u>DATA SPONSOR</u></strong>
<br>
    <tr><th>Nama Sponsor:</th><td>" . htmlspecialchars($data['nama_sponsor']) . "</td></tr>
    <tr><th>Tipe Sponsor:</th><td>" . htmlspecialchars($data['tipe_sponsor']) . "</td></tr>
    <tr><th>Alamat Sponsor:</th><td>" . htmlspecialchars($data['alamat_sponsor']) . "</td></tr>

<strong><u>DATA PERJALANAN</u></strong>
<br>
    <tr><th>Nomor ITAS/ITAP:</th><td>" . htmlspecialchars($data['nomor_itas_itap']) . "</td></tr>
    <tr><th>Tanggal ITAS/ITAP:</th><td>" . htmlspecialchars($data['tanggal_itas_itap']) . "</td></tr>
    <tr><th>Negara Tujuan:</th><td>" . htmlspecialchars($data['negara_tujuan']) . "</td></tr>
    <tr><th>Alamat Tujuan:</th><td>" . htmlspecialchars($data['alamat_tujuan']) . "</td></tr>
    <tr><th>Penanggung Jawab:</th><td>" . htmlspecialchars($data['penanggung_jawab']) . "</td></tr>
    <tr><th>Rencana Tanggal Pindah:</th><td>" . htmlspecialchars($data['rencana_tanggal_pindah']) . "</td></tr>
    <tr><th>Nomor HP:</th><td>" . htmlspecialchars($data['nomor_handphone']) . "</td></tr>
    <tr><th>Email:</th><td>" . htmlspecialchars($data['email']) . "</td></tr>
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