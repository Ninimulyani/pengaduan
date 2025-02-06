<?php
require_once("../database.php"); // Koneksi database
logged_admin();

// Jika menggunakan session, pastikan session sudah dimulai
session_start();

// Logic untuk delete action (jika diperlukan)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = (int)$_GET['id'];
    $koneksi->query("DELETE FROM pemohon WHERE id = $deleteId");
    echo "<script>
            alert('Hapus data sukses!');
            document.location='index.php';
          </script>";
    exit();
}

// Ambil data pemohon
$statement = $koneksi->query("SELECT * FROM pemohon ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../user/public/images/logomaros.png">
    <link rel="shortcut icon" href="../image/logo.png" width="20">
    <title>Dashboard - Data Pemohon</title>
    <!-- Bootstrap CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Font Awesome CSS-->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- DataTables CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/admin.css" rel="stylesheet">
    <!-- Additional Font Awesome versi 6+ jika diperlukan -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index.php">Pelayanan Administrasi Kependudukan Kecamatan Tanralili</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
            aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">
                <!-- Contoh menu sidebar, sesuaikan dengan kebutuhan -->
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="../index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Pemohon">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Pemohon</span>
                    </a>
                </li>
                <!-- Menu lainnya, misalnya Data Penduduk, Permohonan, dsb. -->
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
                        <i class="fa fa-fw fa-sign-out"></i>Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Konten Utama -->
    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Data Pemohon</li>
            </ol>

            <!-- Card Data Pemohon -->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Semua Data Pemohon
                </div>
                <div class="card-body">
                    <a href="tambah_pemohon.php" class="btn btn-primary mb-3 mx-2">Tambah Data Pemohon</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID Pemohon</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>No KK</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                while ($data = $statement->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $data['id']; ?></td>
                                        <td><?php echo $data['nama_lengkap']; ?></td>
                                        <td><?php echo $data['nik']; ?></td>
                                        <td><?php echo $data['no_kk']; ?></td>
                                        <td><?php echo $data['alamat']; ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="detail_penduduk.php?nik=<?php echo $data['nik']; ?>">
                                                <i class="fa fa-eye"></i> Detail Penduduk</a>
                                            <a class="btn btn-secondary btn-sm" href="rincian_permohonan.php?id_pemohon=<?php echo $data['id']; ?>">
                                                <i class="fa fa-info-circle"></i> Rincian Permohonan</a>
                                            <a class="btn btn-warning btn-sm" href="edit_pemohon.php?id=<?php echo $data['id']; ?>">
                                                <i class="fa fa-edit"></i> Edit</a>
                                            <a class="btn btn-danger btn-sm" href="?action=delete&id=<?php echo $data['id']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?');">
                                                <i class=\"fa fa-trash\"></i> Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div> <!-- table-responsive -->
                </div> <!-- card-body -->
                <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
            </div> <!-- card mb-3 -->
        </div> <!-- container-fluid -->
    </div> <!-- content-wrapper -->

    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Andi Sri Mulyani</small>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Pilih \"Logout\" jika anda ingin mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary btn-sm" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript & plugins-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for this template-->
    <script src="../js/admin.js"></script>
    <script src="../js/admin-datatables.js"></script>
</body>

</html>