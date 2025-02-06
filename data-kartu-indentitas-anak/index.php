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



if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Sedang diProses"
    $queryUpdateStatus = "UPDATE data_anak SET status = 'Sedang diProses' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        echo "<script>
                alert('Diterima');
                document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
              </script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}


if (isset($_GET['action']) && $_GET['action'] == 'reject' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Sedang diProses"
    $queryUpdateStatus = "UPDATE data_anak SET status = 'Ditolak' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        echo "<script>
                alert('Ditolak');
                document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
              </script>";
    } else {
        echo "Error: " . $koneksi->error;
    }
}
// Logic to handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // Perform the deletion query
    $koneksi->query("DELETE FROM data_anak WHERE id = $deleteId");
    // Redirect to the same page after deletion
    echo "<script>
                alert('Hapus data sukses!');
                document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
                </script>";
    exit();
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Memuat PHPMailer jika menggunakan Composer

if (isset($_GET['action']) && $_GET['action'] == 'done' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Selesai"
    $queryUpdateStatus = "UPDATE data_anak SET status = 'Selesai' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        // Ambil NIK dari tabel data_anak berdasarkan ID
        $queryId = "SELECT user_id FROM data_anak WHERE id = '$id'";
        $resultId = $koneksi->query($queryId);

        if ($resultId->num_rows > 0) {
            $rowId = $resultId->fetch_assoc();
            $id_ayah = $rowId['user_id'];

            // Cari email di tabel user berdasarkan NIK
            $queryUser = "SELECT email FROM user WHERE id = '$id_ayah'";
            $resultUser = $koneksi->query($queryUser);

            if ($resultUser->num_rows > 0) {
                $rowUser = $resultUser->fetch_assoc();
                $userEmail = $rowUser['email'];

                // Inisialisasi PHPMailer
                $mail = new PHPMailer(true);

                try {
                    // Pengaturan SMTP
                    $mail->isSMTP();
                    $mail->Host       = 'smtp.gmail.com';         // Server SMTP Gmail
                    $mail->SMTPAuth   = true;
                    $mail->Username   = 'surawalawal094@gmail.com';   // Email pengirim
                    $mail->Password   = 'xudi dsnm nysy krqi';     // App Password Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Gunakan STARTTLS
                    $mail->Port       = 587;

                    // Informasi pengirim dan penerima
                    $mail->setFrom('surawalawal094@gmail.com', 'Pengaduan System');
                    $mail->addAddress($userEmail); // Email penerima

                    // Konten email
                    $mail->isHTML(true);
                    $mail->Subject = 'Pemberitahuan: Perubahan Data Telah Selesai';
                    $mail->Body    = "
                        <html>
                        <head>
                            <title>Perubahan Data Selesai</title>
                        </head>
                        <body>
                            <p>Yth. Pengguna,</p>
                            <p>Dengan ini kami memberitahukan bahwa data kartu identitas anak anda telah selesai diproses.</p>
                            <p>Silakan periksa detail data kartu identitas anak Anda di sistem kami.</p>
                            <br>
                            <p>Hormat kami,</p>
                            <p>Tim Administrasi</p>
                        </body>
                        </html>
                    ";

                    // Kirim email
                    $mail->send();
                    echo "<script>
                            alert('Status diperbarui menjadi Selesai dan email telah dikirim.');
                            document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
                          </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Status diperbarui menjadi Selesai, namun email gagal dikirim. Error: {$mail->ErrorInfo}');
                            document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Email pengguna tidak ditemukan di tabel user.');
                        document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('NIK tidak ditemukan di tabel data_anak.');
                    document.location='/pengaduan/data-kartu-indentitas-anak/index.php';
                  </script>";
        }
    } else {
        echo "Error: " . $koneksi->error;
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
    <link rel="shortcut icon" href="user/public/images/logomaros.png">
    <link rel="shortcut icon" href="../image/logo.png" width="20">

    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">


</head>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="user/public/images/logomaros.png">
    <title>Dashboard - Pengaduan Masyarakat Kelurahan Tamalanrea</title>
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
                    <a class="nav-link" href="../perubahan_data/perubahan.php">
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
                                    <th>NIK Anak</th>
                                    <th>Nomor Akta Kelahiran</th>
                                    <th>Nama Anak</th>
                                    <th>Tempat Lahir</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Anak Ke</th>
                                    <th>Nama Ayah</th>
                                    <th>Nama Ibu</th>
                                    <th>Alamat Pemohon</th>
                                    <!-- <th>PDF Path</th> -->
                                    <th>Tanggal Input</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $statement = $koneksi->query("SELECT * FROM data_anak ORDER BY id DESC");

                                $no = 1;
                                foreach ($statement as $key) {
                                ?>
                                    <tr>
                                        <td><?php echo $no++ ?></td>
                                        <td><?php echo $key['nik_anak']; ?></td>
                                        <td><?php echo $key['nomor_akta_kelahiran']; ?></td>
                                        <td><?php echo $key['nama_anak']; ?></td>
                                        <td><?php echo $key['tempat_lahir']; ?></td>
                                        <td><?php echo $key['tanggal_lahir']; ?></td>
                                        <td><?php echo $key['anak_ke']; ?></td>
                                        <td><?php echo $key['nama_ayah']; ?></td>
                                        <td><?php echo $key['nama_ibu']; ?></td>
                                        <td><?php echo $key['alamat_pemohon']; ?></td>
                                        <!-- <td><?php echo $key['pdf_path']; ?></td> -->
                                        <td><?php echo $key['tanggal_input']; ?></td>
                                        <td>
                                            <?php if (!empty($key['pdf_path'])): ?>
                                                <span class="text-success"><i class="fas fa-check-circle"></i> Done</span>

                                            <?php else: ?>
                                                <a class="btn btn-primary" href="upload_dokumen.php?edit&id=<?= $key['id'] ?>">
                                                    <i class="fas fa-upload"></i>
                                                </a>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            // Fetch status dari database
                                            $status = $key['status'];

                                            if ($status == 'Sedang diProses') {
                                                // Tampilkan tombol "Diproses" dengan ikon
                                                echo '<a class="btn btn-warning" href="?action=done&id=' . $key['id'] . '">
                <i class="fas fa-spinner"></i> Diproses
              </a>';
                                            } elseif ($status == 'Menunggu') {
                                                // Tampilkan tombol "Accept" dan "Reject" dengan ikon
                                                echo '<a class="btn btn-success" href="?action=accept&id=' . $key['id'] . '">
                <i class="fas fa-check"></i> 
              </a> ';
                                                echo '<a class="btn btn-danger" href="?action=reject&id=' . $key['id'] . '" onclick="return confirm(\'Are you sure you want to reject this item?\')">
                <i class="fas fa-times"></i> 
              </a>';
                                            } elseif ($status == 'Selesai') {
                                                // Tampilkan status "Selesai" dalam bentuk ikon disabled
                                                echo '<span class="btn btn-success disabled">
                <i class="fas fa-check-circle"></i> Selesai
              </span>';
                                            }
                                            ?>
                                        </td>
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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/admin-datatables.js"></script>


</body>

</html>