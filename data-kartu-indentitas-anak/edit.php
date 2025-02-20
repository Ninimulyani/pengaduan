<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../user/public/images/logomaros.png">
    <link rel="shortcut icon" href="../image/logomaros.png" width="20">

    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php

require_once("../database.php"); // koneksi DB
logged_admin();

// Ambil data dari database jika mode edit
if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM data_anak WHERE id = '$id'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $nik_anak = $data['nik_anak'];
        $nomor_akta_kelahiran = $data['nomor_akta_kelahiran'];
        $nama_anak = $data['nama_anak'];
        $tempat_lahir = $data['tempat_lahir'];
        $tanggal_lahir = $data['tanggal_lahir'];
        $anak_ke = $data['anak_ke'];
        $nama_ayah = $data['nama_ayah'];
        $nama_ibu = $data['nama_ibu'];
        $alamat_pemohon = $data['alamat_pemohon'];
        $status = $data['status'];
    }
}

// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $nik_anak = $_POST['nik_anak'];
    $nomor_akta_kelahiran = $_POST['nomor_akta_kelahiran'];
    $nama_anak = $_POST['nama_anak'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tanggal_lahir = $_POST['tanggal_lahir'];
    $anak_ke = $_POST['anak_ke'];
    $nama_ayah = $_POST['nama_ayah'];
    $nama_ibu = $_POST['nama_ibu'];
    $alamat_pemohon = $_POST['alamat_pemohon'];
    $status = $_POST['status'];

    // Proses unggah file PDF
    if (!empty($_FILES['pdf']['name'])) {
        $pdf_name = $_FILES['pdf']['name'];
        $pdf_tmp = $_FILES['pdf']['tmp_name'];
        $pdf_destination = "uploads/" . $pdf_name;

        if (move_uploaded_file($pdf_tmp, $pdf_destination)) {
            // Update path PDF jika file berhasil diunggah
            $pdf = $pdf_destination;
        } else {
            echo "<script>alert('Gagal mengunggah file PDF!');</script>";
        }
    }

    // Update data di database
    $simpan = mysqli_query($koneksi, "UPDATE data_anak SET
        nik_anak = '$nik_anak',
        nomor_akta_kelahiran = '$nomor_akta_kelahiran',
        nama_anak = '$nama_anak',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir = '$tanggal_lahir',
        anak_ke = '$anak_ke',
        nama_ayah = '$nama_ayah',
        nama_ibu = '$nama_ibu',
        alamat_pemohon = '$alamat_pemohon',
        status = '$status'
        WHERE id = '$id'");

    if ($simpan) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Edit data sukses.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'index.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
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
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
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
                <li class="breadcrumb-item active">Edit Kartu Identitas Anak</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Kartu Identitas Anak
                </div>
                <div class="card-body mx-2 col-8">
                    <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="nik_anak">NIK Anak</label>
                            <input type="text" class="form-control" id="nik_anak" name="nik_anak"
                                value="<?= $nik_anak ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_akta_kelahiran">Nomor Akta Kelahiran</label>
                            <input type="text" class="form-control" id="nomor_akta_kelahiran"
                                name="nomor_akta_kelahiran" value="<?= $nomor_akta_kelahiran ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_anak">Nama Anak</label>
                            <input type="text" class="form-control" id="nama_anak" name="nama_anak"
                                value="<?= $nama_anak ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                value="<?= $tempat_lahir ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                value="<?= $tanggal_lahir ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="anak_ke">Anak Ke</label>
                            <input type="number" class="form-control" id="anak_ke" name="anak_ke"
                                value="<?= $anak_ke ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                value="<?= $nama_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                value="<?= $nama_ibu ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="alamat_pemohon">Alamat Pemohon</label>
                            <input type="text" class="form-control" id="alamat_pemohon" name="alamat_pemohon"
                                value="<?= $alamat_pemohon ?>" required>
                        </div>
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
                        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>