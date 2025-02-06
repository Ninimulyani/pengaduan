<?php
require_once("../private/database.php");
session_start(); // Memulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

// Ambil nik dari session pengguna yang login
$nik = $_SESSION['nik'];  // Menyimpan nik pengguna yang login

// Fungsi untuk merandom avatar profil
function RandomAvatar()
{
    $photoAreas = array("avatar1.png", "avatar2.png", "avatar3.png", "avatar4.png", "avatar5.png", "avatar6.png", "avatar7.png", "avatar8.png", "avatar9.png", "avatar10.png", "avatar11.png");
    $randomNumber = array_rand($photoAreas);
    $randomImage = $photoAreas[$randomNumber];
    echo $randomImage;
}

// Ambil status berdasarkan nik pengguna yang login
$sql = "SELECT status FROM perubahan_data_penduduk WHERE nik = :nik ORDER BY id DESC LIMIT 5"; // Menampilkan 5 status terbaru
$stmt = $db->prepare($sql);
$stmt->execute(['nik' => $nik]);  // Bind nilai nik pada parameter :nik
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Tampilkan status dalam dropdown
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<style>
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
                    <button type="button" class="btn button-green" onclick="location.href='/pengaduan/user/public/home-2.php';" data-dismiss="modal">Tutup</button>
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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
                        <li class="active"><a href="home-2.php">HOME</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">LAYANAN <span class="caret"></span></a>
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
                        <li><a href="status.php">STATUS</a></li>
                        <li><a href="cara-2.php">CARA</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">PROFIL DINAS <span class="caret"></span></a>
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
                        <li class="dropdown pull-right relative">
                            <a href="#" class="dropdown-toggle flex items-center gap-2 text-gray-700 hover:text-gray-900" data-toggle="dropdown">
                                <i class="fa fa-bell text-xl"></i>
                                <span class="badge bg-red-500 text-white rounded-full text-xs px-2 py-1">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Menampilkan jumlah notifikasi -->
                            </a>
                            <ul class="dropdown-menu absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 w-72" role="menu" id="notificationDropdown">
                                <?php if (!empty($notifications)): ?>
                                    <?php foreach ($notifications as $notification): ?>
                                        <li class="border-b last:border-none">
                                            <a href="#" class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-md">
                                                <!-- Icon berdasarkan status -->
                                                <span class="bg-blue-500 text-white rounded-full p-2">
                                                    <?php if ($notification['status'] == 'Selesai'): ?>
                                                        <i class="fa fa-check-circle"></i>
                                                    <?php elseif ($notification['status'] == 'Pending'): ?>
                                                        <i class="fa fa-exclamation-circle"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-info-circle"></i>
                                                    <?php endif; ?>
                                                </span>
                                                <!-- Isi notifikasi -->
                                                <div>
                                                    <p class="font-medium text-gray-800">
                                                        Perubahan Data "<span class="font-semibold text-blue-600"><?= htmlspecialchars($notification['status']) ?></span>"
                                                    </p>
                                                    <!-- <span class="text-sm text-gray-500">Klik untuk melihat detail</span> -->
                                                </div>
                                            </a>
                                        </li>
                                        <hr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="p-2 text-center text-gray-500">
                                        <i class="fa fa-info-circle text-lg"></i> Tidak ada notifikasi baru.
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>


                    </ul>
                </div>
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- end navbar -->

        <!-- start slider -->
        <div id="mainCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#mainCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#mainCarousel" data-slide-to="1"></li>
                <li data-target="#mainCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="images/kantor.jpg" alt="...">
                    <div class="carousel-caption welcome">
                        <h2 class="animated bounceInRight">Selamat Datang</h2>
                        <h3 class="animated bounceInLeft">Website Pelayanan Administrasi Kependudukan Kecamatan Tanralili</h3>
                    </div>
                </div>
                <div class="item">
                    <img src="images/pejabat.jpg" alt="...">
                    <div class="carousel-caption">
                        <h2 class="animated bounceInDown">Pejabat</h2>
                    </div>
                </div>
                <div class="item">
                    <img src="images/header_3.jpg" alt="...">
                    <div class="carousel-caption">
                        <h2 class="animated bounceInUp">Pengumuman</h2>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <!-- Controls -->
            <a class="left carousel-control" style="margin-left:2%;" href="#mainCarousel" role="button" data-slide="prev">
                <i class="fi fi-br-angle-left"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#mainCarousel" style="margin-right:2%;" role="button" data-slide="next">
                <i class="fi fi-br-angle-right"></i>
                <span class="sr-only">Next</span>
            </a>

        </div>
        <!-- end Slider -->

        <!-- content -->
        <div class="main-content">
            <!-- section -->
            <div class="section">
                <div class="row">

                    <!-- Social Media Feed -->
                    <div class="col-md-4">
                        <br>
                        <!-- header text social-feed -->
                        <h3 class="text-center h3-custom">Social Feed</h3>
                        <hr class="custom-line" />
                        <!-- end header text social-feed -->
                        <!-- Instagram Feed -->
                        <div class="box">
                            <div class="box-icon shadow">
                                <span class="fa fa-2x fa-instagram"></span>
                            </div>
                            <div class="info">
                                <h3 class="text-center">instagram</h3>
                                <a class="instagram-timeline" data-height="300" data-width="500" href="https://www.instagram.com/kecamatantanralili/" ddata-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.instagram.com/kecamatantanralili/" class="fb-xfbml-parse-ignore">
                                        <a href="https://www.instagram.com/kecamatantanralili/">Kecamatan Tanralili</a>
                                    </blockquote>
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
                                <h3 class="text-center">facebook</h3>
                                <div class="fb-page" data-height="300" data-width="500" data-href="https://www.facebook.com/profile.php?id=61555707727963&" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                    <blockquote cite="https://www.facebook.com/profile.php?id=61555707727963&" class="fb-xfbml-parse-ignore">
                                        <a href="https://www.facebook.com/profile.php?id=61555707727963&">Kecamatan Tanralili</a>
                                    </blockquote>
                                </div>
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
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/1607792839472522?ref=embed_page">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://x.com/Kel_Tamalanrea?s=20">
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