<?php
    require_once("database.php"); // koneksi DB

    logged_admin ();
    global $total_laporan_masuk, $total_laporan_menunggu, $total_laporan_ditanggapi;
    if ($id_admin > 0) {
        foreach($db->query("SELECT COUNT(*) FROM laporan WHERE laporan.tujuan = $id_admin") as $row) {
            $total_laporan_masuk = $row['COUNT(*)'];
        }

        foreach($db->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\" AND laporan.tujuan = $id_admin") as $row) {
            $total_laporan_ditanggapi = $row['COUNT(*)'];
        }

        foreach($koneksi>query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\" AND laporan.tujuan = $id_admin") as $row) {
            $total_laporan_menunggu = $row['COUNT(*)'];
        }
    } else {
        foreach($koneksi->query("SELECT COUNT(*) FROM laporan") as $row) {
            $total_laporan_masuk = $row['COUNT(*)'];
        }

        foreach($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\"") as $row) {
            $total_laporan_ditanggapi = $row['COUNT(*)'];
        }

        foreach($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\"") as $row) {
            $total_laporan_menunggu = $row['COUNT(*)'];
        }
    }

    // Logic to handle delete action
        if(isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
            $deleteId = $_GET['id'];
            // Perform the deletion query
            $koneksi->query("DELETE FROM laporan WHERE id = $deleteId");
            // Redirect to the same page after deletion
            echo "<script>
            alert('Hapus data sukses!');
            document.location='index.php';
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
    <link rel="shortcut icon" href="user/public/images/logo.png"width="40">
    <title>Dashboard - Pengaduan Masyarakat Kelurahan Tamalanrea</title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="css/admin.css" rel="stylesheet">

    <style>

</style>
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <!-- Navigation-->
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
                            <img alt="image" src="user/public/images/logo.png" width="80">
                            <span class="status"><i class="fa fa-circle text-success"></i></span>
                        </p>
                        <p>
                            <span class="">Admin</span><br><br>
                            <span class="user" style="font-family: monospace;"><?php echo $divisi; ?></span>
                        </p>
                    </div>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="user.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="kategori.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kategori</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="komentar.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Komentar</span>
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
                    <i class="fa fa-table"></i> Semua Laporan
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <a style="margin-left:20px;" href="cetak.php" class="btn btn-success mb-3" href="">Print</a>
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telpon</th>
                                    <th>Alamat</th>
                                    <th>Tujuan</th>
                                    <th>Isi Laporan</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Status</th>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                            // Ambil semua record dari tabel laporan
                            if ($id_admin > 0) {
                                $statement = $koneksi->query("SELECT * FROM laporan, divisi WHERE laporan.tujuan = divisi.id_divisi AND laporan.tujuan = $id_admin ORDER BY laporan.id DESC");
                            } else {
                                $statement = $koneksi->query("SELECT * FROM laporan, divisi WHERE laporan.tujuan = divisi.id_divisi ORDER BY laporan.id DESC");
                            }

                            foreach ($statement as $key ) {
                                $mysqldate = $key['tanggal'];
                                $phpdate = strtotime($mysqldate);
                                $tanggal = date( 'd/m/Y', $phpdate);
                                ?>
                                <tr>
                                        <td><?php echo $key['nama']; ?></td>
                                        <td><?php echo $key['email']; ?></td>
                                        <td><?php echo $key['telpon']; ?></td>
                                        <td><?php echo $key['alamat']; ?></td>
                                        <td><?php echo $key['nama_divisi']; ?></td>
                                        <td><?php echo $key['isi']; ?></td>
                                        <td><?php echo $tanggal; ?></td>
                                        <td><a class="btn btn-danger" href="<?= 'user/public/' . $key['pdf_path'] ?>" download="<?= 'user/public/' . $key['pdf_path'] ?>">Download PDF</a></td>
                                        <td><?php echo $key['status']; ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="edit.php?edit&id=<?= $key['id'] ?>">Edit</a>
                                            <a class="btn btn-danger" href="?action=delete&id=<?= $key['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                                        </td>
                                </tr>
                
                                <?php
                            }
                            ?>
                                    </td>
                                </tr>
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
                    <small>Copyright © Andi Sri Mulyani</small>
                </div>
            </div>
        </footer>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fa fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
