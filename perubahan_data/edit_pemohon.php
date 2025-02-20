<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="user/public/images/logomaros.png">
    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>

<?php
require_once("../database.php"); // koneksi DB
logged_admin();

$id = $_GET['id'] ?? ''; // Ambil ID dari URL jika ada

$nama_lengkap = '';
$nik = '';
$no_kk = '';
$alamat_rumah = '';
$status = '';

// Ambil data dari database jika mode edit
if (!empty($id)) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM pemohon WHERE id = '$id'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $nama_lengkap = $data['nama_lengkap'];
        $nik  = $data['nik'];
        $no_kk = $data['no_kk'];
        $alamat_rumah = $data['alamat_rumah'];
        $status = $data['status'];
    }
}

// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $nama_lengkap = $_POST['nama_lengkap'];
    $nik = $_POST['nik'];
    $no_kk = $_POST['no_kk'];
    $alamat_rumah = $_POST['alamat_rumah'];
    $status = $_POST['status'];

    // Update data di database
    $simpan = mysqli_query($koneksi, "UPDATE pemohon SET 
        nama_lengkap = '$nama_lengkap',
        nik = '$nik',
        no_kk = '$no_kk',
        alamat_rumah = '$alamat_rumah',
        status = '$status'
        WHERE id = '$id'");

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='index.php';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='index.php';
            </script>";
    }
}
?>


<body class="fixed-nav sticky-footer" id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Pelayanan Administrasi Kependudukan Kecamatan Tanralili</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">
                <li class="sidebar-profile nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <div class="profile-main">
                        <p class="image">
                            <img alt="image" src="../user/public/images/logomaros.png" width="80">
                        </p>
                        <p>
                            <span class="">Admin</span><br><br>
                        </p>
                    </div>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="../index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kematian/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../perubahan_data/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Perubahan</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kelahiran/">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
                    </a>
                </li>
                <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kartu Identitas Anak</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-surat-pindah-penduduk/">
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
                <li class="breadcrumb-item active">Edit Laporan Perubahan</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Laporan
                </div>
                <div class="card-body mx-2">
                    <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nama_lengkap">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                value="<?= $nama_lengkap ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik ">NIK </label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="no_kk">Nomor KK</label>
                            <input type="text" class="form-control" id="no_kk" name="no_kk" value="<?= $no_kk ?>"
                                required>
                        </div>
                        <label for="alamat_rumah">Alamat Pemohon</label>
                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"
                            value="<?= $alamat_rumah ?>" required>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Menunggu" <?= $status == 'Menunggu' ? 'selected' : '' ?>>Menunggu
                                </option>
                                <option value="Ditolak" <?= $status == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                <option value="Sedang diproses" <?= $status == 'Sedang diproses' ? 'selected' : '' ?>>
                                    Sedang diproses</option>
                                <option value="Selesai" <?= $status == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mb-3">Simpan Perubahan</button>
                </div>
                </form>

            </div>
        </div>
    </div>
    </div>
</body>

</html>