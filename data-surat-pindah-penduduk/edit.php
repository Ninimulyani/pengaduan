<?php
require_once("../database.php"); // koneksi DB
logged_admin();

$id = $_GET['id'];

// Pastikan koneksi sudah terhubung dengan database
if ($stmt = $koneksi->prepare("SELECT * FROM surat_pindah_penduduk WHERE id = ?")) {
    // Bind parameter
    $stmt->bind_param("i", $id); // "i" untuk integer

    // Eksekusi query
    $stmt->execute();

    // Ambil hasil
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    // Jangan lupa untuk menutup statement setelah selesai
    $stmt->close();
} else {
    // Jika terjadi kesalahan pada query
    echo "Query gagal!";
}

if (isset($_POST['submit'])) {
    // Menyimpan inputan dari form
    $no_kk = $_POST['no_kk'];
    $nama_lengkap_pemohon = $_POST['nama_lengkap_pemohon'];
    $nik = $_POST['nik'];
    $jenis_permohonan = $_POST['jenis_permohonan'];
    $alamat_jelas = $_POST['alamat_jelas'];
    $desa_kelurahan_asal = $_POST['desa_kelurahan_asal'];
    $kecamatan_asal = $_POST['kecamatan_asal'];
    $kabupaten_kota_asal = $_POST['kabupaten_kota_asal'];
    $provinsi_asal = $_POST['provinsi_asal'];
    $kode_pos_asal = $_POST['kode_pos_asal'];
    $jenis_pindah = $_POST['jenis_pindah'];
    $alamat_pindah = $_POST['alamat_pindah'];
    $desa_kelurahan_pindah = $_POST['desa_kelurahan_pindah'];
    $kecamatan_pindah = $_POST['kecamatan_pindah'];
    $kabupaten_kota_pindah = $_POST['kabupaten_kota_pindah'];
    $provinsi_pindah = $_POST['provinsi_pindah'];
    $kode_pos_pindah = $_POST['kode_pos_pindah'];
    $alasan_pindah = $_POST['alasan_pindah'];
    $jenis_kepindahan = $_POST['jenis_kepindahan'];
    $anggota_keluarga_tidak_pindah = $_POST['anggota_keluarga_tidak_pindah'];
    $anggota_keluarga_pindah = $_POST['anggota_keluarga_pindah'];
    $daftar_anggota_pindah = $_POST['daftar_anggota_pindah'];
    $nama_sponsor = $_POST['nama_sponsor'];
    $tipe_sponsor = $_POST['tipe_sponsor'];
    $alamat_sponsor = $_POST['alamat_sponsor'];
    $nomor_itas_itap = $_POST['nomor_itas_itap'];
    $tanggal_itas_itap = $_POST['tanggal_itas_itap'];
    $negara_tujuan = $_POST['negara_tujuan'];
    $alamat_tujuan = $_POST['alamat_tujuan'];
    $penanggung_jawab = $_POST['penanggung_jawab'];
    $rencana_tanggal_pindah = $_POST['rencana_tanggal_pindah'];
    $nomor_handphone = $_POST['nomor_handphone'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];

    // Perintah UPDATE
    $simpan = mysqli_query($koneksi, "UPDATE surat_pindah_penduduk SET 
                no_kk='$no_kk', 
                nama_lengkap_pemohon='$nama_lengkap_pemohon', 
                nik='$nik', 
                jenis_permohonan='$jenis_permohonan', 
                alamat_jelas='$alamat_jelas', 
                desa_kelurahan_asal='$desa_kelurahan_asal', 
                kecamatan_asal='$kecamatan_asal', 
                kabupaten_kota_asal='$kabupaten_kota_asal', 
                provinsi_asal='$provinsi_asal', 
                kode_pos_asal='$kode_pos_asal', 
                jenis_pindah='$jenis_pindah', 
                alamat_pindah='$alamat_pindah', 
                desa_kelurahan_pindah='$desa_kelurahan_pindah', 
                kecamatan_pindah='$kecamatan_pindah', 
                kabupaten_kota_pindah='$kabupaten_kota_pindah', 
                provinsi_pindah='$provinsi_pindah', 
                kode_pos_pindah='$kode_pos_pindah', 
                alasan_pindah='$alasan_pindah', 
                jenis_kepindahan='$jenis_kepindahan', 
                anggota_keluarga_tidak_pindah='$anggota_keluarga_tidak_pindah', 
                anggota_keluarga_pindah='$anggota_keluarga_pindah', 
                daftar_anggota_pindah='$daftar_anggota_pindah', 
                nama_sponsor='$nama_sponsor', 
                tipe_sponsor='$tipe_sponsor', 
                alamat_sponsor='$alamat_sponsor', 
                nomor_itas_itap='$nomor_itas_itap', 
                tanggal_itas_itap='$tanggal_itas_itap', 
                negara_tujuan='$negara_tujuan', 
                alamat_tujuan='$alamat_tujuan', 
                penanggung_jawab='$penanggung_jawab', 
                rencana_tanggal_pindah='$rencana_tanggal_pindah', 
                nomor_handphone='$nomor_handphone', 
                email='$email', 
                status='$status', 
                user_id='$user_id' 
            WHERE id='$_GET[id]'");

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='/pengaduan/data-surat-pindah-penduduk/';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='/pengaduan/data-surat-pindah-penduduk/';
            </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="user/public/images/logo.png">
    <title>Dashboard - Pengaduan Masyarakat Kelurahan Tamalanrea</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Pengaduan Masyarakat Kelurahan Tamalanrea</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">
                <li class="sidebar-profile nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <div class="profile-main">
                        <p class="image">
                            <img alt="image" src="../user/public/images/logo.png" width="80">
                            <span class="status"><i class="fa fa-circle text-success"></i></span>
                        </p>
                        <p>
                            <span class="">Admin</span><br><br>
                            <span class="user" style="font-family: monospace;"><?php echo $divisi; ?></span>
                        </p>
                    </div>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="../index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>

                <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../perubahan_data/perubahan.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Perubahan</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kelahiran/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-kartu-indentitas-anak/">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kartu Identitas Anak</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Surat Pindah Penduduk</span>
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Laporan Kematian</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Akta Kematian
                </div>
                <div class="card-body">
                    <a href="akta_kematian.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="no_kk" class="form-label">No KK</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?php echo $data['no_kk']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap_pemohon" class="form-label">Nama Lengkap Pemohon</label>
                            <input type="text" class="form-control" id="nama_lengkap_pemohon" name="nama_lengkap_pemohon" value="<?php echo $data['nama_lengkap_pemohon']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?php echo $data['nik']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_permohonan" class="form-label">Jenis Permohonan</label>
                            <input type="text" class="form-control" id="jenis_permohonan" name="jenis_permohonan" value="<?php echo $data['jenis_permohonan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_jelas" class="form-label">Alamat Jelas</label>
                            <input type="text" class="form-control" id="alamat_jelas" name="alamat_jelas" value="<?php echo $data['alamat_jelas']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="desa_kelurahan_asal" class="form-label">Desa/Kelurahan Asal</label>
                            <input type="text" class="form-control" id="desa_kelurahan_asal" name="desa_kelurahan_asal" value="<?php echo $data['desa_kelurahan_asal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan_asal" class="form-label">Kecamatan Asal</label>
                            <input type="text" class="form-control" id="kecamatan_asal" name="kecamatan_asal" value="<?php echo $data['kecamatan_asal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten_kota_asal" class="form-label">Kabupaten/Kota Asal</label>
                            <input type="text" class="form-control" id="kabupaten_kota_asal" name="kabupaten_kota_asal" value="<?php echo $data['kabupaten_kota_asal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="provinsi_asal" class="form-label">Provinsi Asal</label>
                            <input type="text" class="form-control" id="provinsi_asal" name="provinsi_asal" value="<?php echo $data['provinsi_asal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kode_pos_asal" class="form-label">Kode Pos Asal</label>
                            <input type="text" class="form-control" id="kode_pos_asal" name="kode_pos_asal" value="<?php echo $data['kode_pos_asal']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_pindah" class="form-label">Jenis Pindah</label>
                            <input type="text" class="form-control" id="jenis_pindah" name="jenis_pindah" value="<?php echo $data['jenis_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_pindah" class="form-label">Alamat Pindah</label>
                            <input type="text" class="form-control" id="alamat_pindah" name="alamat_pindah" value="<?php echo $data['alamat_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="desa_kelurahan_pindah" class="form-label">Desa/Kelurahan Pindah</label>
                            <input type="text" class="form-control" id="desa_kelurahan_pindah" name="desa_kelurahan_pindah" value="<?php echo $data['desa_kelurahan_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kecamatan_pindah" class="form-label">Kecamatan Pindah</label>
                            <input type="text" class="form-control" id="kecamatan_pindah" name="kecamatan_pindah" value="<?php echo $data['kecamatan_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kabupaten_kota_pindah" class="form-label">Kabupaten/Kota Pindah</label>
                            <input type="text" class="form-control" id="kabupaten_kota_pindah" name="kabupaten_kota_pindah" value="<?php echo $data['kabupaten_kota_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="provinsi_pindah" class="form-label">Provinsi Pindah</label>
                            <input type="text" class="form-control" id="provinsi_pindah" name="provinsi_pindah" value="<?php echo $data['provinsi_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="kode_pos_pindah" class="form-label">Kode Pos Pindah</label>
                            <input type="text" class="form-control" id="kode_pos_pindah" name="kode_pos_pindah" value="<?php echo $data['kode_pos_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alasan_pindah" class="form-label">Alasan Pindah</label>
                            <input type="text" class="form-control" id="alasan_pindah" name="alasan_pindah" value="<?php echo $data['alasan_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kepindahan" class="form-label">Jenis Kepindahan</label>
                            <input type="text" class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" value="<?php echo $data['jenis_kepindahan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="anggota_keluarga_tidak_pindah" class="form-label">Anggota Keluarga Tidak Pindah</label>
                            <input type="text" class="form-control" id="anggota_keluarga_tidak_pindah" name="anggota_keluarga_tidak_pindah" value="<?php echo $data['anggota_keluarga_tidak_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="anggota_keluarga_pindah" class="form-label">Anggota Keluarga Pindah</label>
                            <input type="text" class="form-control" id="anggota_keluarga_pindah" name="anggota_keluarga_pindah" value="<?php echo $data['anggota_keluarga_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="daftar_anggota_pindah" class="form-label">Daftar Anggota Pindah</label>
                            <input type="text" class="form-control" id="daftar_anggota_pindah" name="daftar_anggota_pindah" value="<?php echo $data['daftar_anggota_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_sponsor" class="form-label">Nama Sponsor</label>
                            <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor" value="<?php echo $data['nama_sponsor']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tipe_sponsor" class="form-label">Tipe Sponsor</label>
                            <input type="text" class="form-control" id="tipe_sponsor" name="tipe_sponsor" value="<?php echo $data['tipe_sponsor']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_sponsor" class="form-label">Alamat Sponsor</label>
                            <input type="text" class="form-control" id="alamat_sponsor" name="alamat_sponsor" value="<?php echo $data['alamat_sponsor']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_itas_itap" class="form-label">Nomor ITAS/ITAP</label>
                            <input type="text" class="form-control" id="nomor_itas_itap" name="nomor_itas_itap" value="<?php echo $data['nomor_itas_itap']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_itas_itap" class="form-label">Tanggal ITAS/ITAP</label>
                            <input type="date" class="form-control" id="tanggal_itas_itap" name="tanggal_itas_itap" value="<?php echo $data['tanggal_itas_itap']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="negara_tujuan" class="form-label">Negara Tujuan</label>
                            <input type="text" class="form-control" id="negara_tujuan" name="negara_tujuan" value="<?php echo $data['negara_tujuan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_tujuan" class="form-label">Alamat Tujuan</label>
                            <input type="text" class="form-control" id="alamat_tujuan" name="alamat_tujuan" value="<?php echo $data['alamat_tujuan']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="penanggung_jawab" class="form-label">Penanggung Jawab</label>
                            <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" value="<?php echo $data['penanggung_jawab']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="rencana_tanggal_pindah" class="form-label">Rencana Tanggal Pindah</label>
                            <input type="date" class="form-control" id="rencana_tanggal_pindah" name="rencana_tanggal_pindah" value="<?php echo $data['rencana_tanggal_pindah']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                            <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone" value="<?php echo $data['nomor_handphone']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <input type="text" class="form-control" id="status" name="status" value="<?php echo $data['status']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <!-- <label for="status" class="form-label">Status</label> -->
                            <input type="text" class="form-control" id="status" name="user_id" value="<?php echo $data['user_id']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>