<?php
require_once("database.php"); // koneksi DB

logged_admin();
global $total_laporan_masuk, $total_laporan_menunggu, $total_laporan_ditanggapi;
// Logic to handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // Perform the deletion query
    $koneksi->query("DELETE FROM user WHERE id = $deleteId");
    // Redirect to the same page after deletion
    echo "<script>
                alert('Hapus data sukses!');
                document.location='user.php';
                </script>";
    exit();
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
    <link rel="shortcut icon" href="user/public/images/logomaros.png">
    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Pelayanan Administrasi Kependudukan Kecamtan Tanralili</a>
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
                            <img alt="image" src="user/public/images/logomaros.png" width="80">
                            <span class="status"><i class="fa fa-circle text-success"></i></span>
                        </p>
                        <p>
                            <span class="">Admin</span><br><br>
                            <span class="user" style="font-family: monospace;"><?php ?></span>
                        </p>
                    </div>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="../data-penduduk/">
                        <i class="fa fa-fw fa-table"></i>

                        <span class="nav-link-text">Data Penduduk</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="data-akta-kematian/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="perubahan/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Perubahan</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="data-akta-kelahiran/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
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

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">My Dashboard</li>
            </ol>

            <!-- Icon Cards-->
            <div class="row">

                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5"><?php echo $total_laporan_masuk; ?> Laporan Masuk</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Total Laporan Masuk</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5"><?php echo $total_laporan_menunggu; ?> Belum Ditanggapi</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Belum Ditanggapi</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5"><?php echo $total_laporan_ditanggapi; ?> Sudah Ditanggapi</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">Sudah Ditanggapi</span>
                            <span class="float-right">
                                <i class="fa fa-angle-right"></i>
                            </span>
                        </a>
                    </div>
                </div>

            </div>

        </div>
        <!-- ./Icon Cards-->

        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Semua User
            </div>
            <div class="card-body">
                <a href="create_user.php" class="btn btn-primary mb-3 mx-2">Tambah Data User</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No KK</th>
                                <th>Nik</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // Ambil semua record dari tabel laporan
                            $statement = $koneksi->query("SELECT * FROM user ORDER BY nama DESC");

                            $no = 1;
                            foreach ($statement as $key) {
                            ?>
                                <tr>
                                    <td><?php echo $no++ ?></td>
                                    <td><?php echo $key['no_kk']; ?></td>
                                    <td><?php echo $key['nik']; ?></td>
                                    <td><?php echo $key['nama']; ?></td>
                                    <td><?php echo $key['username']; ?></td>
                                    <td><?php echo $key['email']; ?></td>
                                    <td><?php echo $key['alamat']; ?></td>
                                    <td>
                                        <a class="btn btn-warning" href="edit-user.php?edit&id=<?= $key['id'] ?>">Edit</a>
                                        <a class="btn btn-danger" href="?action=delete&id=<?= $key['id'] ?>"
                                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
        </div>
    </div>
    <!-- /.container-fluid-->

    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Kantor Kecamatan Tanralili</small>
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
                <div class="modal-body">Pilih "Logout" jika anda ingin mengakhiri sesi.</div>
                <div class="modal-footer">
                    <button class="btn btn-close card-shadow-2 btn-sm" type="button" data-dismiss="modal">Batal</button>
                    <a class="btn btn-primary btn-sm card-shadow-2" href="login.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Page level plugin JavaScript-->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="js/admin.js"></script>
    <!-- Custom scripts for this page-->
    <script src="js/admin-datatables.js"></script>

    </div>

</body>

</html>