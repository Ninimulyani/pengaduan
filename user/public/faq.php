<?php
require_once("../private/database.php");

if (isset($_POST['submit'])) {
    // Set the default status
    $status = "Menunggu";

    // Insert data into the database without handling PDF file
    $sql = "INSERT INTO `komentar` (`email`, `isi_komentar`) 
            VALUES (:email, :isi_komentar)";
    $stmt = $db->prepare($sql);

    // Bind parameters to the statement
    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':isi_komentar', $_POST['isi_komentar']);

    // Execute the statement
    $stmt->execute();

    echo "Selesai validasi";
    header("Location: ../public/faq.php");
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>FAQ | Kantor Kelurahan Tamalanrea</title>
    <link rel="shortcut icon" href="images/logo.ico" width="20">
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
                            <li><a href="home.php">HOME</a></li>
                            <li><a href="cara.php">CARA</a></li>
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
                            <li  class="active"><a href="">FAQ</a></li>
                            <li><a href="bantuan.php">BANTUAN</a></li>
                            <li><a href="kontak.php">KONTAK</a></li>
                            <li><a href="../../login.php">LOGIN</a></li>
                            <li><a href="register-user.php">REGISTER</a></li>
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
                <h3>Frequently Asked Question (FAQ):</h3>
                <hr/>
                <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                <div class="form-group">
                            <label for="email" class="col-sm-1 control-label">Email</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="example@domain.com" value="<?= @$_GET['email'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['emailError'] ?></p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telpon" class="col-sm-1 control-label">Isi Komentar</label>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="glyphicon glyphicon-phone"></span></div>
                                    <input type="text" class="form-control" id="isi_komentar" name="isi_komentar" placeholder="Dimana alamat kantornya ?" value="<?= @$_GET['isi_komentar'] ?>" required>
                                </div>
                                <p class="error"><?= @$_GET['telponError'] ?></p>
                            </div>
                        </div>

                        <div class="col-sm-10 col-sm-offset-1">
                                <input id="submit" name="submit" type="submit" value="Kirim Komentar" class="btn btn-primary-custom form-shadow">
                            </div>
                        </div>
                        <br>
                        <br>
		        <p class="text-justify">
                    Q: Apakah Aplikasi Pengaduan Masyarakat Kelurahan Tamalanrea ini?
                    <br />
		            A: Aplikasi Pengaduan Masyarakat Kelurahan Tamalanrea adalah aplikasi
                    pengelolaan dan tindak lanjut pengaduan serta pelaporan hasil pengelolaan pengaduan yang
                    disediakan oleh Kelurahan Tamalanrea sebagai salah satu sarana bagi
                    setiap pejabat/pegawai Kelurahan Tamalanrea sebagai pihak internal
                    maupun masyarakat luas pengguna layanan Kelurahan Tamalanrea sebagai
                    pihak eksternal untuk melaporkan dugaan adanya pelanggaran dan/atau ketidakpuasan terhadap
                    pelayanan yang dilakukan/diberikan oleh pejabat/pegawai Kelurahan Tamalanrea.
                </p>
                <hr/>
        		<p class="text-justify">
                    Q: Apakah nomor pengaduan itu dan apa yang harus saya lakukan terhadap nomor pengaduan ini?
                    <br />
        		    A: Nomor pengaduan adalah nomor yang digunakan sebagai identitas dari sebuah laporan atau pengaduan
                    yang didapatkan ketika pelapor menyampaikan laporan melalui aplikasi ini.
                    Simpan dengan baik nomor pengaduan yang Anda peroleh, jangan sampai tercecer dan
                    diketahui oleh pihak yang tidak berhak karena pelayanan untuk mengetahui status tindak
                    lanjut pengaduan yang disampaikan hanya dapat diberikan melalui nomor pengaduan tersebut.
                </p>
                <hr/>
        		<p class="text-justify">
                    Q: Apakah bentuk respon yang diberikan kepada pelapor atas pengaduan yang disampaikan?
                    <br />
        		    A: Respon yang diberikan kepada pelapor berupa respon awal (ucapan terima kasih telah melakukan pengaduan)
                     dan status/tindak lanjut pengaduan paling akhir sesuai dengan respon yang telah diberikan
                     oleh pihak penerima pengaduan. Respon terkait dengan status/tindak lanjut pengaduan dapat
                     dilihat dalam history pengaduan.
                </p>
                <hr/>
        		<p class="text-justify">
                    Q: Berapa lama respon atas pengaduan yang disampaikan diberikan kepada pelapor?
                    <br />
        		    A: Sesuai dengan KMK 149 tahun 2011 jawaban/respon atas pengaduan yang
                    disampaikan wajib diberikan dalam kurun waktu paling lambat 30 (tiga puluh)
                    hari terhitung sejak pengaduan diterima.
                    <br />
        		    Untuk respon yang disampaikan tertulis melalui surat dapat diberikan apabila
                    pelapor mencantumkan identitas secara jelas (nama dan alamat koresponden).
                    Untuk respon dari media pengaduan lainnya akan disampaikan dan diberikan
                    sesuai identitas pelapor yang dicantumkan dalam media pengaduan tersebut.
                </p>
                <hr/>
        		<p class="text-justify">
                    Q: Apakah pengaduan yang saya berikan akan selalu mendapatkan respon?
                    <br />
        		    A: Pengaduan yang Anda berikan akan direspon dan tercantum dalam aplikasi
                    ini dan akan terupdate secara otomatis sesuai dengan respon yang telah
                    diberikan oleh pihak penerima pengaduan.
                    <br />
            		Untuk dapat melihat respon yang diberikan, Anda dapat
                    melihat status pengaduan dalam menu Lihat Pengaduan sesuai dengan nomor
                    pengaduan yang didapatkan.
                    <br />
            		Sebagai catatan, pengaduan Anda akan lebih mudah ditindaklanjuti
                    apabila memenuhi unsur pengaduan.
                </p>
                <hr/>
        		<p class="text-justify">
                    Q: Apakah kerahasiaan identitas saya sebagai pengadu/pelapor terjaga?
                    <br />
        		    A: Kerahasiaan identitas Anda sebagai pelapor akan terjaga seperti yang telah
                    disebutkan dalam KMK 149 tahun 2011. Namun agar kerahasiaan identitas Anda dapat
                    lebih terjaga sebaiknya Anda memperhatikan hal-hal sebagaimana disebutkan di <a href="bantuan.php">sini.</a>
                </p>
                <hr>
            </div>

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
                            Jl. Bumi Tamalanrea Permai No.1, Tamalanrea,
                            <br>Kec. Tamalanrea, Kota Makassar, Sulawesi Selatan
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
                                90245 <br>
                                kelurahantamalanrea@tamalanrea.go.id <br>
                                kelurahan.tamalanrea@gmail.com
                            </p>
                        </div>
                    </div>
                </footer>
                <!-- /footer -->

            <div class="copyright py-4 text-center text-white">
                <div class="container">
                    <small> | Copyright &copy; Kantor Kelurahan Tamalanrea</small>
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
