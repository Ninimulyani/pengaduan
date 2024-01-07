<?php ?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Bantuan | Pengaduan Masyarakat Kelurahan Tamalanrea</title>
    <link rel="shortcut icon" href="images/logo.ico" width="20"">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>

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
                            <img alt="Brand" src="images/logo.png" width="40">
                        </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home-2.php">HOME</a></li>
                        <li><a href="lapor.php">LAPOR</a></li>
                        <li><a href="lihat.php">LIHAT PENGADUAN</a></li>
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
                                <li><a href="profildinas-2.php">Motto / Maklumat Pelayanan</a></li>
                            </ul>
                        </li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li class="active"><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="../../login.php">LOGOUT</a></li>
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


                <h3>Bantuan</h3>
                <hr/>

                <p>Anda dapat menyampaikan pengaduan Anda melalui tiga cara:</p>
                <p><strong>1. Secara Online</strong></p>
                <ul>
                    <li>
                        Masukan data pribadi dan pengaduan Anda di <a href="lapor.php">sini</a>
                    </li>
                    <li>
                        Setelah memasukan semua data yang diperlukan Anda akan mendapatkan nomor pengaduan,
                        catat nomor ini karena Anda akan membutuhkannya untuk mengetahui status pengaduan Anda.
                    </li>
                    <li>
                        Nomor pengaduan ini juga dikirim ke alamat email Anda.
                    </li>
                    <li>
                        Untuk mengetahui status pengaduan, masukan nomor
                        pengaduan Anda pada menu <strong>Lihat Pengaduan</strong>.
                    </li>
                    <li>
                        Bila ada data atau dokumen pelengkap yang ingin
                        disampaikan langsung, dapat menghubungi
                        <a href="kontak.php">Bagian Pengaduan Masyarakat</a>
                    </li>
                </ul>
                <p>&nbsp;</p>
                <p>
                    <strong>2. Melalui Surat</strong>
                </p>
                <ul>
                    <li>
                        Kirimkan surat pengaduan Anda ke alamat
                        <a href="kontak.php">ini</a>
                    </li>
                    <li>
                        Untuk mendapatkan nomor pengaduan silakan hubungi
                        <a href="kontak.php">Bagian Pengaduan Masyarakat</a>
                        Dispendukcapil Bangkalan
                    </li>
                    <li>
                        Untuk mengetahui status pengaduan, masukan nomor pengaduan
                        Anda pada menu <strong>Lihat Pengaduan</strong>.
                    </li>
                </ul>
                <p>&nbsp;</p>
                <p>
                    <strong>3. Datang Langsung</strong>
                </p>
                <ul>
                    <li>
                        Silahkan datang langsung ke alamat
                        <a href="kontak.php">Bagian Hubungan Masyarakat</a>
                        Dispendukcapil Bangkalan
                    </li>
                    <li>
                        Setelah data Anda dimasukan, Anda akan diberikan nomor pengaduan,
                        catat nomor ini karena Anda akan membutuhkannya untuk mengetahui status pengaduan Anda.
                    </li>
                    <li>
                        Untuk mengetahui status pengaduan, masukan nomor pengaduan Anda
                        pada menu <strong>Lihat Pengaduan</strong>.
                    </li>
                </ul>

                <!-- /.section -->

                <hr>
                <!-- link to top -->
                <a id="top" href="#" onclick="topFunction()">
                    <i class="fa fa-arrow-circle-up"></i>
                </a>
                <script>
                    // When the user scrolls down 100px from the top of the document, show the button
                    window.onscroll = function() {scrollFunction()};
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
                            Jalan Soekarno-Hatta No 50
                            <br>Bangkalan, Jawa Timur
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
                                    <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/dispendukcapilbkl/">
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
                                031-3095331 <br>
                                dispendukcapil@bangkalankab.go.id <br>
                                dispendukcapil.bangkalan@gmail.com
                            </p>
                        </div>
                    </div>
                </footer>
                <!-- /footer -->

            <div class="copyright py-4 text-center text-white">
                <div class="container">
                    <small>V-3.0 | Copyright &copy; Dispendukcapil Bangkalan 2018</small>
                </div>
            </div>
            <!-- shadow -->
        </div>

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>

</body>

</html>
