<?php

session_start(); // Memulai session
require_once("../private/database.php");

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

// Ambil nik dari session pengguna yang login
$nik = $_SESSION['nik'];  // Menyimpan nik pengguna yang login


// Ambil status berdasarkan nik pengguna yang login
$sql = "SELECT status FROM perubahan_data_penduduk WHERE nik = :nik ORDER BY id DESC LIMIT 5"; // Menampilkan 5 status terbaru
$stmt = $db->prepare($sql);
$stmt->execute(['nik' => $nik]);  // Bind nilai nik pada parameter :nik
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Kontak | Pelayanan Admnistrasi Kependudukan Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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
</style>

<body style="width:100%; margin:0;">

    <div class="shadow">
        <nav class="navbar navbar-fixed navbar-inverse form-shadow">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">
                        <img alt="Brand" src="images/logomaros.png" width="50">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home-2.php">HOME</a></li>
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
                        <li class="active"><a href="kontak-2.php">KONTAK</a></li>
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
                    <!-- <ul class="nav navbar-nav navbar-right">
                            <li><a href="#">LOGIN</a></li>
                            <li><a href="#">REGISTER</a></li>
                        </ul> -->
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <!-- content -->
        <div class="main-content">
            <h3>Kontak</h3>
            <hr />
            <div class="row">
                <div class="col-md-6">
                    <div id="map" class="card-shadow-2" style="width:100%;height:300px"></div>
                    <script>
                        function myMap() {
                            var mapCanvas = document.getElementById("map");
                            var myCenter = new google.maps.LatLng(-5.0658103, 119.6190417);
                            var mapOptions = {
                                center: myCenter,
                                zoom: 18
                            };
                            var map = new google.maps.Map(mapCanvas, mapOptions);
                            var marker = new google.maps.Marker({
                                position: myCenter,
                                animation: google.maps.Animation.BOUNCE
                            });
                            marker.setMap(map);
                        }
                    </script>
                    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXyK9sf3rI0EKVupuALaOAzq1NKlUES98&callback=myMap"></script>
                </div>

                <div class="col-md-6"></div>
            </div>
            <hr>
            <h4>Kantor</h4>
            <p>Jl. Poros Ammarrang, Kelurahan Borong,
            </p>
            <p>Kecamatan Tanralili, Kabupaten Maros, Sulawesi Selatan</p>
            <hr>
            <h4>Contact Info:</h4>
            <p>90553</p>
            <p>kecamatan.tanralili1@gmail.com</p>
            <p>&nbsp;</p>

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


            <!-- end main-content -->
        </div>

        <hr>

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
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/disdukcapilbkl">
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
            <!-- <div class="container"> -->
            <small> Copyright &copy; Kecamatan Tanralili 2024</small>
            <!-- </div> -->
        </div>
        <!-- shadow -->
    </div>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>

</body>

</html>