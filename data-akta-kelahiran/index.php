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

logged_admin();
global $total_laporan_masuk, $total_laporan_menunggu, $total_laporan_ditanggapi;




if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $deleteId = $_GET['id'];

    if ($koneksi->query("DELETE FROM akta_kelahiran WHERE id = $deleteId")) {
        echo "<script>
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
    } else {
        echo "<script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menghapus Data',
                        text: 'Terjadi kesalahan saat menghapus data. Coba lagi nanti.',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location = 'index.php';
                        }
                    });
                });
              </script>";
    }
    exit();
}


if (isset($_GET['action']) && $_GET['action'] == 'accept' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Sedang diProses"
    $queryUpdateStatus = "UPDATE akta_kelahiran SET status = 'Sedang diProses' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: 'Selesai',
                          text: 'Status berhasil diperbarui menjadi Sedang diProses.'
                      }).then(() => {
                          window.location.href = '/pengaduan/data-akta-kelahiran/index.php';
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




use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php'; // Memuat PHPMailer jika menggunakan Composer

if (isset($_GET['action']) && $_GET['action'] == 'done' && isset($_GET['id'])) {
    // Ambil ID dari URL
    $id = $_GET['id'];

    // Update status menjadi "Selesai"
    $queryUpdateStatus = "UPDATE akta_kelahiran SET status = 'Selesai' WHERE id = '$id'";

    if ($koneksi->query($queryUpdateStatus)) {
        // Ambil NIK dari tabel akta_kelahiran berdasarkan ID
        $queryUserID = "SELECT user_id FROM akta_kelahiran WHERE id = '$id'";
        $resultUserID = $koneksi->query($queryUserID);

        if ($resultUserID->num_rows > 0) {
            $rowiduser = $resultUserID->fetch_assoc();
            $User_id = $rowiduser['user_id'];

            // Cari email di tabel user berdasarkan NIK
            $queryUser = "SELECT email FROM user WHERE id = '$User_id'";
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
                    $mail->Subject = 'Pemberitahuan: Perubahan Data Telah Selesai';
                    $mail->Body    = "
                        <html>
                        <head>
                            <title>Perubahan Data Selesai</title>
                        </head>
                        <body>
                            <p>Yth. Pengguna,</p>
                            <p>Dengan ini kami memberitahukan bahwa Surat Pindah  telah selesai diproses.</p>
                            <p>Silakan periksa detail Surat Pindah Penduduk Anda di sistem kami.</p>
                            <br>
                            <p>Hormat kami,</p>
                            <p>Tim Administrasi</p>
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
                                title: 'Diterima',
                                text: 'Status diperbarui menjadi Selesai dan email telah dikirim.'
                            }).then(() => {
                                window.location.href = '/pengaduan/data-akta-kelahiran/index.php';
                            });
                        });
                    </script>";
                } catch (Exception $e) {
                    echo "<script>
                            alert('Status diperbarui menjadi Selesai, namun email gagal dikirim. Error: {$mail->ErrorInfo}');
                            document.location='/pengaduan/data-surat-pindah-penduduk/index.php';
                          </script>";
                }
            } else {
                echo "<script>
                        alert('Email pengguna tidak ditemukan di tabel user.');
                        document.location='/pengaduan/data-surat-pindah-penduduk/index.php';
                      </script>";
            }
        } else {
            echo "<script>
                    alert('NIK tidak ditemukan di tabel akta_kelahiran.');
                    document.location='/pengaduan/data-surat-pindah-penduduk/index.php';
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
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-kartu-indentitas-anak/index.php">
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
                                    <th>Nama Anak</th>
                                    <th>Jenis Kelamin Anak</th>
                                    <th>Tempat Lahir Anak</th>
                                    <th>Tanggal Lahir Anak</th>
                                    <th>Pukul</th>
                                    <th>Jenis Kelahiran</th>
                                    <th>Kelahiran Ke</th>
                                    <th>Penolong Kelahiran</th>
                                    <th>Berat Badan Bayi</th>
                                    <th>Panjang Badan</th>
                                    <th>Cetak Form</th>
                                    <th>Dokumen Persyaratan</th>
                                    <th>Dokumen</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Fetch data from the table akta_kelahiran
                                $stmt = $koneksi->prepare("SELECT * FROM akta_kelahiran ORDER BY id DESC");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $no = 1;
                                while ($key = $result->fetch_assoc()) {
                                    $status = $key['status'];
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($key['nama_pelapor']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nik_pelapor']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nomor_dokumen_perjalanan']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nomor_kartu_keluarga_pelapor']); ?></td>
                                    <td><?php echo htmlspecialchars($key['kewarganegaraan_pelapor']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nomor_handphone']); ?></td>
                                    <td><?php echo htmlspecialchars($key['email']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nama_saksi_1']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nik_saksi_1']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nomor_kartu_keluarga_saksi_1']); ?></td>
                                    <td><?php echo htmlspecialchars($key['kewarganegaraan_saksi_1']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nama_ayah']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nik_ayah']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tempat_lahir_ayah']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tanggal_lahir_ayah']); ?></td>
                                    <td><?php echo htmlspecialchars($key['kewarganegaraan_ayah']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nama_ibu']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nik_ibu']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tempat_lahir_ibu']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tanggal_lahir_ibu']); ?></td>
                                    <td><?php echo htmlspecialchars($key['kewarganegaraan_ibu']); ?></td>
                                    <td><?php echo htmlspecialchars($key['nama_anak']); ?></td>
                                    <td><?php echo htmlspecialchars($key['jk_anak']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tempat_lahir']); ?></td>
                                    <td><?php echo htmlspecialchars($key['tanggal_lahir_anak']); ?></td>
                                    <td><?php echo htmlspecialchars($key['pukul']); ?></td>
                                    <td><?php echo htmlspecialchars($key['jenis_kelahiran']); ?></td>
                                    <td><?php echo htmlspecialchars($key['kelahiran_ke']); ?></td>
                                    <td><?php echo htmlspecialchars($key['penolong_kelahiran']); ?></td>
                                    <td><?php echo htmlspecialchars($key['bb_bayi']); ?> kg</td>
                                    <td><?php echo htmlspecialchars($key['pb']); ?> cm</td>
                                    <td><a href="kelahiran_genarate_pdf.php?id=<?= $key['id'] ?>" target="_blank"
                                            class="btn btn-primary">
                                            Download PDF
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                            $fileCount = 0; // Menghitung jumlah file yang ada
                                            if (!empty($key['kartu_keluarga_asli'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['kartu_keluarga_asli'];
                                                $fileName = $key['kartu_keluarga_asli'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if (!empty($key['buku_nikah'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['buku_nikah'];
                                                $fileName = $key['buku_nikah'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if (!empty($key['ktp_orang_tua'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['ktp_orang_tua'];
                                                $fileName = $key['ktp_orang_tua'];
                                                echo "<strong>$fileCount.</strong> <a href='$filePath' target='_blank'>$fileName</a><br>";
                                            }

                                            if (!empty($key['ktp_saksi'])) {
                                                $fileCount++;
                                                $filePath = "../../../pengaduan/user/public/uploads/" . $key['ktp_saksi'];
                                                $fileName = $key['ktp_saksi'];
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
                                        <!-- Tombol Edit -->
                                        <a class="btn btn-warning" href="edit.php?edit&id=<?= $key['id'] ?>"> <i
                                                class="fa fa-edit"></i> Edit</a>

                                        <!-- Tombol Delete dengan konfirmasi -->
                                        <a class="btn btn-danger" href="#" onclick="confirmDelete('<?= $key['id'] ?>')">
                                            <i class="fa fa-trash"></i>Delete</a>
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
                <small>Copyright © Kantor Kecamatan Tanralili</small>
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
    function confirmReject(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data ini akan ditolak!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, tolak!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '?action=reject&id=' + id;
            }
        });
    }
    </script>

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

    <script>
    function showAcceptedAlert(id) {
        Swal.fire({
            icon: 'success',
            title: 'Data telah diterima!',
            showConfirmButton: false,
            timer: 1500
        }).then(() => {
            window.location.href = "?action=accept&id=" + id;
        });
    }
    </script>



</body>

</html>