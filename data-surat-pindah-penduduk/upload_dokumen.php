<?php
require_once("../database.php"); // koneksi DB
logged_admin();

// Ambil data dari database jika mode edit
if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM surat_pindah_penduduk WHERE id = '$id'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $dokumen = $data['dokumen']; // Path PDF dari database
    }
}

// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $id = $_GET['id'];

    // Proses unggah file PDF jika ada file baru
    if (!empty($_FILES['dokumen']['name'])) {
        $dokumen_name = $_FILES['dokumen']['name'];
        $dokumen_tmp = $_FILES['dokumen']['tmp_name'];
        $dokumen_destination = "uploads/" . $dokumen_name;

        if (move_uploaded_file($dokumen_tmp, $dokumen_destination)) {
            $dokumen = $dokumen_destination; // Update path PDF jika file berhasil diunggah
        } else {
            echo "<script>alert('Gagal mengunggah file PDF!');</script>";
        }
    }

    // Update data di database
    $simpan = mysqli_query($koneksi, "UPDATE surat_pindah_penduduk SET dokumen = '$dokumen' WHERE id = '$id'");

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
                    <form method="post" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="dokumen">Unggah Dokumen PDF</label>
                            <input type="file" class="form-control" id="dokumen" name="dokumen">
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>