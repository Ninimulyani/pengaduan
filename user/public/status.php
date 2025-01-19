<?php
require_once("../private/database.php"); // Sambungkan ke database
session_start(); // Memulai session

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

// Query untuk mendapatkan data dari tabel data_anak
$query_data_anak = "SELECT * FROM data_anak WHERE user_id = :user_id";
$stmt_data_anak = $db->prepare($query_data_anak);
$stmt_data_anak->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_data_anak->execute();
$data_anak = $stmt_data_anak->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mendapatkan data dari tabel akta_kelahiran
$query_akta_kelahiran = "SELECT * FROM akta_kelahiran WHERE user_id = :user_id";
$stmt_akta_kelahiran = $db->prepare($query_akta_kelahiran);
$stmt_akta_kelahiran->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_akta_kelahiran->execute();
$akta_kelahiran = $stmt_akta_kelahiran->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel akta_kematian
$query_akta_kematian = "SELECT * FROM akta_kematian WHERE user_id = :user_id";
$stmt_akta_kematian = $db->prepare($query_akta_kematian);
$stmt_akta_kematian->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_akta_kematian->execute();
$data_kematian = $stmt_akta_kematian->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Kantor Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<style>
.card-body {
    position: relative;
    /* Menjadikan card-body sebagai konteks untuk posisi absolut */
}

.card-body .btn {
    position: absolute;
    /* Menempatkan tombol di posisi absolut */
    top: 10px;
    /* Mengatur jarak dari atas */
    right: 10px;
    /* Mengatur jarak dari kanan */
}

.navbar {
    width: 100%;
    margin: 0;
    padding: 0;
}

.carousel-inner .item img {
    width: 100%;
    /* Memastikan gambar memenuhi lebar kontainer carousel */
    height: 500px;
    /* Atur tinggi tetap agar seragam */
    object-fit: cover;
    /* Memastikan gambar tetap proporsional dan mengisi area */
}

.carousel-control {
    display: flex;
    align-items: center;
    /* Pusatkan secara vertikal */
    justify-content: center;
    /* Pusatkan secara horizontal */
    top: 50%;
    /* Atur posisi di tengah secara vertikal */
    transform: translateY(-50%);
    /* Geser ke atas 50% dari ukurannya untuk pusatkan */
    width: 50px;
    /* Ukuran lebar tombol navigasi */
    height: 50px;
    /* Tinggi tombol navigasi */
    background-color: rgba(0, 0, 0, 0.5);
    /* Latar belakang semi transparan */
    border-radius: 50%;
    /* Buat tombol berbentuk bulat */
}

.carousel-control .bi {
    font-size: 24px;
    /* Ukuran ikon */
    color: #fff;
    /* Warna ikon */
}
</style>

<body style="width:100%; margin:0; overflow-x: hidden;">
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://www.facebook.com/profile.php?id=61555707727963&';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

    <!--Success Modal Saved-->
    <div class="modal fade" id="successmodalclear" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content bg-2">
                <div class="modal-header ">
                    <h4 class="modal-title text-center text-green">Sukses</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Pengajuan Berhasil Di Kirim</p>
                    <p class="text-center">Untuk Mengetahui Status Pengajuan</p>
                    <p class="text-center">Silahkan Buka Menu <a href="status.php">STATUS</a> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn button-green" onclick="location.href='home';"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['status'])) {
    ?>
    <script type="text/javascript">
    $("#successmodalclear").modal();
    </script>
    <?php
    }
    ?>
    <!-- body -->
    <div class="shadow">
        <!-- navbar -->
        <nav class="navbar navbar-inverse navbar-fixed form-shadw">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
                        <img alt="Brand" src="images/logomaros.png" width="50">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home-2.php">HOME</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">LAYANAN <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="akta_kelahiran.php">Akta Kelahiran</a></li>
                                <li class="divider"></li>
                                <li><a href="kartu_identitas_anak.php">Kartu Identitas Anak</a></li>
                                <li class="divider"></li>
                                <li><a href="akta_kematian.php">Akta Kematian</a></li>
                                <li class="divider"></li>
                                <li><a href="perubahan_data_penduduk.php">Perubahan Data Penduduk</a></li>
                                <li class="divider"></li>
                                <li><a href="surat_pindah_penduduk.php">Surat Pindah Penduduk</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <li class="active"><a href="status.php">STATUS</a></li>
                        <li><a href="cara-2.php">CARA</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">PROFIL DINAS
                                <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profildinas-2.php">Profil Dinas</a></li>
                                <li class="divider"></li>
                                <li><a href="profildinas-2.php">Visi dan Misi</a></li>
                                <li class="divider"></li>
                                <li><a href="profildinas-2.php">Struktur Organisasi</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="login-user.php">LOGOUT</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- end navbar -->


        <!-- content -->
        <div class="main-content">
            <!-- section -->
            <div class="section">
                <div class="row">

                    <!-- Social Media Feed -->
                    <div class="col-md-4">
                        <br>
                        <!-- header text social-feed -->
                        <h3 class="text-center h3-custom">Status Laporan</h3>
                        <hr class="custom-line" />
                        <!-- end header text social-feed -->
                        <!-- Instagram Feed -->
                        <div class="box">
                            <div class="box-icon shadow">
                                <span class="fa fa-2x fa-instagram"></span>
                            </div>
                            <div class="info">
                                <h3 class="text-center"></h3>
                                <!-- Loop through the akta_kelahiran array to display statuses -->
                                <?php if ($akta_kelahiran): ?>
                                <?php foreach ($akta_kelahiran as $data): ?>
                                <!-- Logika untuk menentukan apakah data baru -->
                                <?php 
                                    $is_new = false;
                                    if (isset($data['created_at'])) {
                                        $created_at = new DateTime($data['created_at']);
                                        $now = new DateTime();
                                        $interval = $now->diff($created_at);
                                        // Data dianggap baru jika dibuat dalam 24 jam terakhir
                                        if ($interval->days == 0 && $interval->h < 24) {
                                            $is_new = true;
                                        }
                                    }
                                    ?>

                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-subtitle mb-2 text-muted">Nama Anak:
                                            <?php echo htmlspecialchars($data['nama_anak']); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">Tanggal Lahir:
                                            <?php echo htmlspecialchars($data['tanggal_lahir_anak']); ?></p>
                                        <p class="card-text">Status: <?php echo htmlspecialchars($data['status']); ?>
                                        </p>
                                        <?php if ($is_new): ?>
                                        <p class="text-success"><strong>Laporan data kelahiran</strong></p>
                                        <?php endif; ?>
                                        <a href="lihat_akta_kelahiran.php?id=<?php echo $data['id']; ?>"
                                            class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <p class="text-center">Belum ada status laporan akta kelahiran.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- End Instagram Feed -->
                        <hr>
                        <!-- Facebook Feed -->
                        <div class="box">
                            <div class="box-icon shadow">
                                <span class="fa fa-2x fa-facebook"></span>
                            </div>
                            <div class="info">
                                <h3 class="text-center"></h3>
                                <!-- Loop through the akta_kelahiran_data array to display statuses -->
                                <?php if ($data_kematian): ?>
                                <?php foreach ($data_kematian as $data): ?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-subtitle mb-2 text-muted">Nama Lengkap Almarhum:
                                            <?php echo htmlspecialchars($data['nama_lengkap_alm']); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <p class="card-text mb-1">Tanggal Kematian:
                                                    <?php echo htmlspecialchars($data['hari_tanggal_kematian']); ?>
                                                </p>
                                                <p class="card-text mb-1">Status:
                                                    <?php echo htmlspecialchars($data['status']); ?>
                                                </p>
                                            </div>
                                            <a href="lihat_akta_kematian.php?id=<?php echo $data['id']; ?>"
                                                class="btn btn-primary">Lihat Detail</a>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <p class="text-center">Belum ada status laporan akta kelahiran.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- End Facebook Feed -->

                        <hr>
                        <!-- Facebook Feed -->
                        <div class="box">
                            <div class="box-icon shadow">
                                <span class="fa fa-2x fa-facebook"></span>
                            </div>
                            <div class="info">
                                <h3 class="text-center"></h3>
                                <!-- Loop through the akta_kelahiran_data array to display statuses -->
                                <?php if ($data_anak): ?>
                                <?php foreach ($data_anak as $data): ?>
                                <div class="card mb-3">
                                    <div class="card-header">
                                        <h5 class="card-subtitle mb-2 text-muted">Nama Anak:
                                            <?php echo htmlspecialchars($data['nama_anak']); ?>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <div>
                                            <p class="card-text mb-1">Tanggal Lahir:
                                                <?php echo htmlspecialchars($data['tanggal_lahir']); ?>
                                            </p>
                                            <p class="card-text mb-1">Status:
                                                <?php echo htmlspecialchars($data['status']); ?>
                                            </p>
                                        </div>
                                        <a href="lihat_kartu_identitas_anak.php?id=<?php echo $data['id']; ?>"
                                            class="btn btn-primary">Lihat Detail</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <p class="text-center">Belum ada status laporan akta kelahiran.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- End Facebook Feed -->
                        <hr>
                        <!-- Facebook Feed -->

                        <!-- End Facebook Feed -->
                    </div>
                    <!-- End Social Media Feed -->
                </div>
                <!-- end row -->
            </div>
            <!-- /.section -->

            <!-- link to top -->
            <a id="top" href="#" onclick="topFunction()">
                <i class="fa fa-arrow-circle-up"></i>
            </a>
            <script>
            // When the user scrolls down 100px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            function scrollFunction() {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    document.getElementById("top").style.display = "block";
                } else {
                    document.getElementById("top").style.display = "none";
                }
            }
            // When the user clicks on the button, scroll to the top of the document
            function topFunction() {
                document.body.scrollTop = 0;
                document.documentElement.scrollTop = 0;
            }
            </script>
            <!-- link to top -->

        </div>
        <!-- end main-content -->

        <!-- Footer -->
        <footer class="footer text-center">
            <div class="row">
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-map-marker"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kantor</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        Jl. Poros Ammarrang, Kelurahan Borong,
                        <br>Kecamatan Tanralili, Kabupaten Maros, Sulawesi Selatan
                    </p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-rss"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Sosial Media</h4>
                        </li>
                    </ul>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                href="https://www.facebook.com/1607792839472522?ref=embed_page">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                href="https://x.com/Kel_Tamalanrea?s=20">
                                <i class="fa fa-fw fa-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-envelope-o"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kontak</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        90553 <br>
                        kelurahan.tamalanrea@gmail.com
                    </p>
                </div>
            </div>
        </footer>
        <!-- /footer -->

        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small> | Copyright &copy; Kantor Kecamatan Tanralili </small>
            </div>
        </div>
        <!-- shadow -->
    </div>

</body>

</html>