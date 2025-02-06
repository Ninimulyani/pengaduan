<?php
require_once("../database.php"); // koneksi DB
logged_admin();

if (isset($_GET['edit'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM perubahan_data_penduduk WHERE id = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
        $id = $data['id'];
        $nama = $data['nama'];
        $nik = $data['nik'];
        $shdk = $data['shdk'];
        $keterangan = $data['keterangan'];
        $jenis_permohonan = $data['jenis_permohonan'];
        $semula = $data['semula'];
        $menjadi = $data['menjadi'];
        $dasar_perubahan = $data['dasar_perubahan'];
    }
}

// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $simpan = mysqli_query($koneksi, "UPDATE perubahan_data_penduduk SET
        nama = '$_POST[nama]',
        nik = '$_POST[nik]',
        shdk = '$_POST[shdk]',
        keterangan = '$_POST[keterangan]',
        jenis_permohonan = '$_POST[jenis_permohonan]',
        semula = '$_POST[semula]',
        menjadi = '$_POST[menjadi]',
        dasar_perubahan = '$_POST[dasar_perubahan]'
        WHERE id = '$_GET[id]'");

    if ($simpan) {
        echo "<script>
                alert('Edit data sukses!');
                document.location='perubahan_data_penduduk.php';
            </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='perubahan_data_penduduk.php';
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

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kematian/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="perubahan.php">
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
                <li class="breadcrumb-item active">Edit Perubahan Data Penduduk</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Perubahan Penduduk
                </div>
                <div class="card-body">
                    <a href="perubahan_data_penduduk.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post">
                        <div class="form-group">
                            <label for="id">Nomor Pengaduan</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $nama ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="shdk">SHDK</label>
                            <input type="text" class="form-control" id="shdk" name="shdk" value="<?= $shdk ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?= $keterangan ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jenis_permohonan">Jenis Permohonan</label>
                            <input type="text" class="form-control" id="jenis_permohonan" name="jenis_permohonan" value="<?= $jenis_permohonan ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="semula">Semula</label>
                            <input type="text" class="form-control" id="semula" name="semula" value="<?= $semula ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="menjadi">Menjadi</label>
                            <input type="text" class="form-control" id="menjadi" name="menjadi" value="<?= $menjadi ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="dasar_perubahan">Dasar Perubahan</label>
                            <input type="text" class="form-control" id="dasar_perubahan" name="dasar_perubahan" value="<?= $dasar_perubahan ?>" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>