<?php
require_once("../database.php"); // koneksi DB

logged_admin();
global $total_laporan_masuk, $total_laporan_menunggu, $total_laporan_ditanggapi;
if ($id_admin > 0) {
    foreach ($db->query("SELECT COUNT(*) FROM laporan WHERE laporan.tujuan = $id_admin") as $row) {
        $total_laporan_masuk = $row['COUNT(*)'];
    }

    foreach ($db->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\" AND laporan.tujuan = $id_admin") as $row) {
        $total_laporan_ditanggapi = $row['COUNT(*)'];
    }

    foreach ($koneksi > query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\" AND laporan.tujuan = $id_admin") as $row) {
        $total_laporan_menunggu = $row['COUNT(*)'];
    }
} else {
    foreach ($koneksi->query("SELECT COUNT(*) FROM laporan") as $row) {
        $total_laporan_masuk = $row['COUNT(*)'];
    }

    foreach ($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\"") as $row) {
        $total_laporan_ditanggapi = $row['COUNT(*)'];
    }

    foreach ($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\"") as $row) {
        $total_laporan_menunggu = $row['COUNT(*)'];
    }
}

require_once("../database.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href=" user/public/images/logo.png">
    <title>Dashboard - Pengaduan Masyarakat Kelurahan Tamalanrea</title>
    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Custom fonts for this template-->
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Page level plugin CSS-->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/admin.css" rel="stylesheet">
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

            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit</li>
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
            <!-- ./Icon Cards-->

            <?php
            // Ambil ID dari URL
            $id = $_GET['id'] ?? '';

            // Ambil data berdasarkan ID
            $sql = "SELECT * FROM perubahan_data_penduduk WHERE id = ?";
            $stmt = $koneksi->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Jika form disubmit, update data
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nama_lengkap = $_POST['nama_lengkap'];
                $no_kk = $_POST['no_kk'];
                $nik = $_POST['nik'];
                $shdk = $_POST['shdk'];
                $keterangan = $_POST['keterangan'];
                $jenis_permohonan = $_POST['jenis_permohonan'];
                $semula = $_POST['semula'];
                $menjadi = $_POST['menjadi'];
                $dasar_perubahan = $_POST['dasar_perubahan'];
                $status = $_POST['status'];

                // Cek apakah ada file yang diunggah
                if (!empty($_FILES["dokumen"]["name"])) {
                    $target_dir = "uploads/"; // Folder penyimpanan
                    $file_name = basename($_FILES["dokumen"]["name"]);
                    $target_file = $target_dir . $file_name;
                    $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    // Validasi jenis file (PDF, JPG, PNG, DOCX)
                    $allowed_types = array("pdf", "jpg", "png", "jpeg", "docx");
                    if (!in_array($file_type, $allowed_types)) {
                        echo "<script>alert('Format file tidak didukung! Hanya PDF, JPG, PNG, DOCX.');</script>";
                    } else {
                        // Pindahkan file ke folder uploads
                        if (move_uploaded_file($_FILES["dokumen"]["tmp_name"], $target_file)) {
                            $dokumen = $file_name; // Simpan nama file ke database
                        } else {
                            echo "<script>alert('Gagal mengupload file!');</script>";
                        }
                    }
                } else {
                    $dokumen = $row['dokumen']; // Jika tidak ada file baru, pakai file lama
                }

                $update_sql = "UPDATE perubahan_data_penduduk 
                   SET nama_lengkap=?, no_kk=?, nik=?, shdk=?, keterangan=?, jenis_permohonan=?, semula=?, menjadi=?, dasar_perubahan=?, status=?, dokumen=?
                   WHERE id=?";

                $stmt = $koneksi->prepare($update_sql);
                $stmt->bind_param("sssssssssssi", $nama_lengkap, $no_kk, $nik, $shdk, $keterangan, $jenis_permohonan, $semula, $menjadi, $dasar_perubahan, $status, $dokumen, $id);

                if ($stmt->execute()) {
                    echo "<script>alert('Data berhasil diperbarui!'); window.location='/pengaduan/perubahan_data/perubahan.php';</script>";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
            ?>
            <!-- Example DataTables Card-->
            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Penduduk
                </div>
                <div class="card-body mx-2 col-8">
                    <a href="user.php" class="btn btn-primary mb-3">Kembali</a>
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">


                        <div class="form-group">
                            <label for="nama_lengkap" class="col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input type="text" class="form-control" name="nama_lengkap" placeholder="Nama Lengkap" value="<?= $row['nama_lengkap'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['namaError'] ?></p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="no_kk" class="col-sm-3 control-label">No. KK</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                    <input type="text" class="form-control" name="no_kk" placeholder="No. KK" value="<?= $row['no_kk'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nik" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                    <input type="text" class="form-control" name="nik" placeholder="NIK" value="<?= $row['nik'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="shdk" class="col-sm-3 control-label">SHDK</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-user"></span></div>
                                    <input type="text" class="form-control" name="shdk" placeholder="SHDK" value="<?= $row['shdk'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="keterangan" class="col-sm-3 control-label">Keterangan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="<?= $row['keterangan'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-3 control-label">Jenis Permohonan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-list-alt"></span></div>
                                    <input type="text" class="form-control" name="jenis_permohonan" placeholder="Jenis Permohonan" value="<?= $row['jenis_permohonan'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="semula" class="col-sm-3 control-label">Semula</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <input type="text" class="form-control" name="semula" placeholder="Semula" value="<?= $row['semula'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="menjadi" class="col-sm-3 control-label">Menjadi</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-pencil"></span></div>
                                    <input type="text" class="form-control" name="menjadi" placeholder="Menjadi" value="<?= $row['menjadi'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dasar_perubahan" class="col-sm-3 control-label">Dasar Perubahan</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-file"></span></div>
                                    <input type="text" class="form-control" name="dasar_perubahan" placeholder="Dasar Perubahan" value="<?= $row['dasar_perubahan'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status" class="col-sm-3 control-label">Status</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-ok-circle"></span></div>
                                    <input type="text" class="form-control" name="status" placeholder="Status" value="<?= $row['status'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="dokumen" class="col-sm-3 control-label">Dokumen</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-file"></span></div>
                                    <input type="file" class="form-control" name="dokumen" placeholder="Dokumen" value="<?= $row['dokumen'] ?>" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-3">
                                <input id="submit" name="submit" type="submit" value="Ubah" class="btn btn-primary-custom form-shadow">
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card-footer small text-muted"></div>
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