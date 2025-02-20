<?php
// Include your database connection file
require_once("../private/database.php");

// Ambil nilai parameter 'id' dari URL
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Periksa apakah nilai 'id' telah diberikan
if ($id !== null) {
    // Gunakan parameterized query untuk mencegah SQL Injection
    $query = "SELECT * FROM laporan LEFT JOIN divisi ON laporan.tujuan = divisi.id_divisi WHERE laporan.id = :nomor";
    $statement = $db->prepare($query);

    // Ikat nilai parameter
    $statement->bindParam(':nomor', $id, PDO::PARAM_INT);

    // Eksekusi query
    $statement->execute();

    // Ambil hasil query
    $result = $statement->fetch(PDO::FETCH_ASSOC);
}

?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Lihat Pengaduan | Kelurahan Tamalanrea</title>
    <link rel="shortcut icon" href="images/logo.ico" width="20">
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
</head>

<body>
    <!-- Modal for showing error message -->
    <div class="modal fade" id="failedmodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content bg-2">
                <div class="modal-header ">
                    <h4 class="modal-title text-center text-danger">Gagal</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Nomor Pengaduan Tidak Ditemukan</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" onclick="location.href='lihat';" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    // Show modal if $notFound is set
    if (isset($nomorError)) {
    ?>
        <script type="text/javascript">
            $("#failedmodal").modal();
        </script>
    <?php
    }
    ?>

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
                        <img alt="Brand" src="images/logomaros.png" width="40">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home.php">HOME</a></li>
                        <li><a href="lapor.php">LAPOR</a></li>
                        <li class="active"><a href="status.php">LIHAT PENGADUAN</a></li>
                        <li><a href="cara.php">CARA</a></li>
                        <!-- Add more navigation items as needed -->
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav><!-- /.nav -->

        <!-- Main content -->
        <div class="main-content">
            <h3>Detail Pengaduan</h3>

            <div class="panel-body-lihat card-shadow-2">
                <div class="row">
                    <div class="col-md-4">
                        <h3 class="h3-laporan custom">Laporan Detail</h3>
                    </div>
                </div>
                <hr class="hr-laporan">
                <a class="media-left" href="#"><img class="img-circle card-shadow-2 img-sm" src="images/avatar/avatar1.png"></a>
                <div class="media-body">
                    <?php if ($result):  ?>
                        <div>
                            <h4 class="text-green profil-name" style="font-family: monospace;"><?php echo $result['nama_divisi']; ?></h4>
                            <h4 class="text-green profil-name" style="font-family: monospace;"><?php echo $result['nama']; ?></h4>
                            <p class="text-green profil-name" style="font-family: monospace;"><span style="color:black">email :</span> <?php echo $result['email']; ?></p>
                            <p class="text-green profil-name" style="font-family: monospace;"><span style="color:black">telpon :</span><?php echo $result['telpon']; ?></p>
                            <p class="text-green profil-name" style="font-family: monospace;"><span style="color:black">alamat :</span><?php echo $result['alamat']; ?></p>
                            <p class="text-green profil-name" style="font-family: monospace;"><span style="color:black">tanggal :</span><?php echo $result['tanggal']; ?></p>
                        </div>

                        <hr class="hr-laporan">
                    <?php endif; ?>
                </div>

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

            <hr>

            <!-- Footer -->
            <div class="footer footer-bottom text-center">
                <div class="row">
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <ul class="list-inline mb-0">
                            <!-- Add footer content as needed -->
                        </ul>
                    </div>
                    <div class="col-md-4 mb-5 mb-lg-0">
                        <ul class="list-inline mb-0">
                            <!-- Add footer content as needed -->
                        </ul>
                    </div>
                    <div class="col-md-4">
                        <ul class="list-inline mb-0">
                            <!-- Add footer content as needed -->
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /footer -->

            <div class="copyright py-4 text-center text-white">
                <div class="container">
                    <small> | Copyright &copy; Kantor Kecamatan Tanralili</small>
                </div>
            </div>
        </div>

        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>
        <!-- Bootstrap JavaScript -->
        <script src="js/bootstrap.js"></script>
</body>

</html>