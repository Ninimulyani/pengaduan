<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Cara | Kantor Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
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
                    <a class="navbar-brand" href="home">
                        <img alt="Brand" src="images/logomaros.png" width="50">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collase navbar-collapse" id="bs-example-navbar-collapse-1">
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
                        <li class="active"><a href="status.php">STATUS</a></li>
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

            <h3>Cara Melapor</h3>
            <hr />
            <img class="img-cara img-responsive card-shadow-2" src="images/caramaros.png" alt="">
            <br>
            <ol>
                <li>
                    <p>Klik menu &quot;Lapor&quot; untuk merekam pengaduan baru.</p>
                </li>
                <li>
                    <p>Isi form Tambah Pengaduan sesuai informasi yang Anda ketahui.</p>
                </li>
                <li>
                    <p>Perhatikan beberapa hal di bawah ini:
                        <br />Semua kotak yang ada wajib diisi.
                        <br />Pastikan informasi yang diberikan sedapat mungkin memenuhi unsur 4W 1H.
                    </p>
                </li>
                <li>
                    <p>Jika Anda memiliki bukti dalam bentuk file seperti foto, silakan dilengkapi di halaman pengaduan, caranya:
                        <br />Setelah membaca petunjuk untuk menyertakan lampiran, klik kotak kecil di bawah petunjuk tersebut,
                        dan lanjutkan prosesnya.
                    </p>
                </li>
                <li>
                    <p>Setelah selesai mengisi, silakan klik tombol &quot;Kirim Pengaduan&quot;
                        untuk melanjutkan atau klik tombol &quot;Hapus&quot; untuk membatalkan proses pelaporan Anda.
                    </p>
                </li>
                <li>
                    <p>
                        Catat dan Simpan dengan baik nomor pengaduan yang Anda peroleh saat membuat
                        pengaduan untuk mengetahui status/tindak lanjut pengaduan yang Anda sampaikan.
                    </p>
                </li>
                <li>
                    <p>
                        Untuk Bantuan mengenai cara melaporkan pengaduan, bisa dilihat di menu Bantuan
                        yang telah tersedia di aplikasi.
                    </p>
                </li>
                <li>
                    <p>
                        Kelurahan Tamalanrea akan menghubungi Anda melalui saluran yang telah Anda
                        cantumkan dalam form pengaduan apabila pengaduan yang Anda sampaikan belum
                        memenuhi kriteria untuk ditindaklanjuti.
                    </p>
                </li>
            </ol>

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
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/profile.php?id=61555707727963&">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/disdukcapilbkl">
                                <i class="fa fa-fw fa-instagram"></i>
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
            <small>V-3.0 | Copyright &copy; Kantor Kecamatan Tanralili</small>
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