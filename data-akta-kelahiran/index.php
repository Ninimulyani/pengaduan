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

    foreach ($db->query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\" AND laporan.tujuan = $id_admin") as $row) {
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

// Logic to handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // Perform the deletion query
    $koneksi->query("DELETE FROM akta_kematian WHERE id = $deleteId");
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
    <link rel="shortcut icon" href="user/public/images/logomaros.png">
    <link rel="shortcut icon" href="../image/logo.png" width="20">

    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Pelayanan Administrasi Kependudukan Kecamatan Tanralili</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">
                <li class="sidebar-profile nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <div class="profile-main">
                        <p class="image">
                            <img alt="image" src="../user/public/images/logomaros.png" width="80">
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
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../perubahan_data/perubahan.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Perubahan Data</span>
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
                <li class="breadcrumb-item active">Data Kelahiran</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Semua Data Kelahiran
                </div>
                <div class="card-body">
                    <a href="create_user.php" class="btn btn-primary mb-3 mx-2">Tambah Data Kelahiran</a>
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pelapor</th>
                                    <th>NIK Pelapor</th>
                                    <th>Nomor Dokumen Perjalanan</th>
                                    <th>Nomor KK Pelapor</th>
                                    <th>Kewarganegaraan Pelapor</th>
                                    <th>Nomor Handphone</th>
                                    <th>Email</th>
                                    <th>Nama Saksi 1</th>
                                    <th>NIK Saksi 1</th>
                                    <th>Nomor KK Saksi 1</th>
                                    <th>Kewarganegaraan Saksi 1</th>
                                    <th>Nama Ayah</th>
                                    <th>NIK Ayah</th>
                                    <th>Tempat Lahir Ayah</th>
                                    <th>Tanggal Lahir Ayah</th>
                                    <th>Kewarganegaraan Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>NIK Ibu</th>
                                    <th>Tempat Lahir Ibu</th>
                                    <th>Tanggal Lahir Ibu</th>
                                    <th>Kewarganegaraan Ibu</th>
                                    <th>NIK Alm</th>
                                    <th>Nama Lengkap Alm</th>
                                    <th>Hari Tanggal Kematian</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch the data from the user table
                                $statement = $koneksi->query("SELECT * FROM akta_kematian ORDER BY id DESC");

                                $no = 1;
                                foreach ($statement as $key) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key['nama_pelapor']; ?></td>
                                        <td><?php echo $key['nik_pelapor']; ?></td>
                                        <td><?php echo $key['nomor_dokumen_perjalanan']; ?></td>
                                        <td><?php echo $key['nomor_kartu_keluarga_pelapor']; ?></td>
                                        <td><?php echo $key['kewarganegaraan_pelapor']; ?></td>
                                        <td><?php echo $key['nomor_handphone']; ?></td>
                                        <td><?php echo $key['email']; ?></td>
                                        <td><?php echo $key['nama_saksi_1']; ?></td>
                                        <td><?php echo $key['nik_saksi_1']; ?></td>
                                        <td><?php echo $key['nomor_kartu_keluarga_saksi_1']; ?></td>
                                        <td><?php echo $key['kewarganegaraan_saksi_1']; ?></td>
                                        <td><?php echo $key['nama_ayah']; ?></td>
                                        <td><?php echo $key['nik_ayah']; ?></td>
                                        <td><?php echo $key['tempat_lahir_ayah']; ?></td>
                                        <td><?php echo $key['tanggal_lahir_ayah']; ?></td>
                                        <td><?php echo $key['kewarganegaraan_ayah']; ?></td>
                                        <td><?php echo $key['nama_ibu']; ?></td>
                                        <td><?php echo $key['nik_ibu']; ?></td>
                                        <td><?php echo $key['tempat_lahir_ibu']; ?></td>
                                        <td><?php echo $key['tanggal_lahir_ibu']; ?></td>
                                        <td><?php echo $key['kewarganegaraan_ibu']; ?></td>
                                        <td><?php echo $key['nik_alm']; ?></td>
                                        <td><?php echo $key['nama_lengkap_alm']; ?></td>
                                        <td><?php echo $key['hari_tanggal_kematian']; ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="edit.php?edit&id=<?= $key['id'] ?>">Edit</a>
                                            <a class="btn btn-danger" href="?action=delete&id=<?= $key['id'] ?>" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
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
    </div>

    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Andi Sri Mulyani</small>
            </div>
        </div>
    </footer>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

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

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/admin.js"></script>
    <script src="js/admin-datatables.js"></script>

</body>

</html>