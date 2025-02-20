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
    <link href="../css/navbar.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
require_once("../database.php"); // koneksi DB




if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Sedang diProses"
    $queryUpdateStatus = "UPDATE data_anak SET status = 'Sedang diProses' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: 'Berhasil',
                          text: 'Status berhasil diperbarui menjadi Sedang Diproses.'
                      }).then(() => {
                          window.location.href = '/pengaduan/data-kartu-indentitas-anak/index.php';
                      });
                  });
              </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'error',
                          title: 'Gagal',
                          text: 'Terjadi kesalahan: " . $koneksi->error . "'
                      });
                  });
              </script>";
    }
}


// Logic to handle delete action
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];
    // Perform the deletion query
    $koneksi->query("DELETE FROM data_anak WHERE id = $deleteId");
    // Redirect to the same page after deletion
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Berhasil Dihapus',
                        text: 'Data telah dihapus dari sistem.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'index.php';
                        }
                    });
                });
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
                    $mail->Username   = 'srimulyani.nini@gmail.com';   // Email pengirim
                    $mail->Password   = 'zbwc cyus tlkb wosw';     // App Password Gmail
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Gunakan STARTTLS
                    $mail->Port       = 587;

                    // Informasi pengirim dan penerima
                    $mail->setFrom('srimulyani.nini@gmail.com', 'Pengaduan System');
                    $mail->addAddress($userEmail); // Email penerima

                    // Konten email
                    $mail->isHTML(true);
                    $mail->Subject = 'Pemberitahuan: Data Kartu Identitas Anak Telah Selesai';
                    $mail->Body    = "
                        <html>
                        <head>
                            <title>Permohonan Anda Telah Selesai</title>
                        </head>
                        <body>
                            <p>Yth. Masyarakat Kecamatan Tanralili,</p>
                            <p>Dengan ini kami memberitahukan bahwa permohonan Kartu Identitas Anak yang anda ajukan telah selesai diproses.</p>
                            <p>Silakan periksa detail permohonan Anda di sistem kami.</p>
                            <br>
                            <p>Hormat kami,</p>
                            <p>Bagian Dsidukcapil Kantor Kecamatan Tanralili</p>
                        </body>
                        </html>
                    ";

                    // Kirim email
                    $mail->send();
                    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            Swal.fire({
                                icon: 'success',
                                title: 'Selesai',
                                text: 'Status diperbarui menjadi Selesai dan email telah dikirim.'
                            }).then(() => {
                                window.location.href = '/pengaduan/data-kartu-indentitas-anak/index.php';
                            });
                        });
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
                <li class="breadcrumb-item active">Data Kartu Identitas Anak</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Semua Data Kelahiran
                </div>
                <div class="card-body">
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
                                    <th>Tanggal Input</th>
                                    <th>Cetak Dokumen</th>
                                    <th>Dokumen Persyaratan</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $statement = $koneksi->query("SELECT * FROM data_anak ORDER BY id DESC");
                                $no = 1;
                                foreach ($statement as $key) : ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $key['nik_anak'] ?></td>
                                    <td><?= $key['nomor_akta_kelahiran'] ?></td>
                                    <td><?= $key['nama_anak'] ?></td>
                                    <td><?= $key['tempat_lahir'] ?></td>
                                    <td><?= $key['tanggal_lahir'] ?></td>
                                    <td><?= $key['anak_ke'] ?></td>
                                    <td><?= $key['nama_ayah'] ?></td>
                                    <td><?= $key['nama_ibu'] ?></td>
                                    <td><?= $key['alamat_pemohon'] ?></td>
                                    <td><?= $key['tanggal_input'] ?></td>
                                    <td><a href="cetak_genarate_pdf.php?id=<?= $key['id'] ?>" target="_blank"
                                            class="btn btn-primary">
                                            Lihat
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                            $fileCount = 0; // Menghitung jumlah file yang ada
                                            if (!empty($key['kartu_keluarga'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['kartu_keluarga'];
                                                $fileName = $key['kartu_keluarga'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if (!empty($key['akta_kelahiran'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['akta_kelahiran'];
                                                $fileName = $key['akta_kelahiran'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if (!empty($key['pasfoto'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['pasfoto'];
                                                $fileName = $key['pasfoto'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if ($fileCount === 0) {
                                                echo '<span class="text-danger">Belum ada file yang diunggah</span>';
                                            }
                                            ?>
                                    </td>
                                    <td>
                                        <?php if (!empty($key['dokumen_pemohon'])) : ?>
                                        <?php 
                                            // Decode JSON untuk mendapatkan daftar file
                                            $dokumen_pemohon = json_decode($key['dokumen_pemohon'], true); 
                                        ?>
                                        <?php if (!empty($dokumen_pemohon)) : ?>
                                        <ul>
                                            <?php foreach ($dokumen_pemohon as $file) : ?>
                                            <li>
                                                <a href="<?= htmlspecialchars($file) ?>" target="_blank">
                                                    <?= basename($file) ?>
                                                </a>
                                            </li>
                                            <?php endforeach; ?>
                                        </ul>
                                        <?php endif; ?>
                                        <?php else : ?>
                                        <a class="btn btn-primary btn-sm"
                                            href="upload_dokumen.php?edit&id=<?= $key['id'] ?>">
                                            <i class="fa fa-upload"></i> Upload
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                            $status = $key['status'];
                                            if ($status == 'Sedang diProses') : ?>
                                        <a class="btn btn-warning btn-sm" href="?action=done&id=<?= $key['id'] ?>">
                                            <i class="fas fa-spinner"></i> Diproses
                                        </a>
                                        <?php elseif ($status == 'Menunggu') : ?>
                                        <a class="btn btn-success btn-sm" href="?action=accept&id=<?= $key['id'] ?>">
                                            <i class="fas fa-check"></i> Terima
                                        </a>
                                        <a class="btn btn-danger btn-sm"
                                            href="alasan_ditolak.php?edit&id=<?= $key['id'] ?>">
                                            <i class="fas fa-times"></i> Tolak
                                        </a>
                                        <?php elseif ($status == 'Ditolak') : ?>
                                        <span class="btn btn-danger btn-sm disabled">
                                            <i class="fas fa-check-circle"></i> Ditolak
                                        </span>
                                        <br>
                                        <small><strong>Alasan:
                                            </strong><?= htmlspecialchars($key['alasan_ditolak']) ?></small>
                                        <?php elseif ($status == 'Selesai') : ?>
                                        <span class="btn btn-success btn-sm disabled">
                                            <i class="fas fa-check-circle"></i> Selesai
                                        </span>
                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <a class="btn btn-info btn-sm" href="edit.php?edit&id=<?= $key['id'] ?>">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        <a class="btn btn-danger" href="#" onclick="confirmDelete('<?= $key['id'] ?>')">
                                            <i class="fa fa-trash"></i>Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
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
                <small> © Kantor Kecamatan Tanralili</small>
            </div>
        </div>
    </footer>

    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

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

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="../js/admin.js"></script>
    <script src="../js/admin-datatables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "?action=delete&id=" + id;
            }
        });
    }
    </script>


</body>

</html>