<?php
session_start(); // Memulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php");

// Fetch the max id from the 'data_anak' table
$statement = $db->query("SELECT id FROM data_anak ORDER BY id DESC LIMIT 1");
$max_id = $statement->fetchColumn() + 1;  // Get the last ID and add 1

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Set default status (can be changed based on conditions)
    $status = "Menunggu";

    // Prepare the SQL query with placeholders
    $sql = "INSERT INTO data_anak (
        id, nik_anak, nomor_akta_kelahiran, nama_anak, tempat_lahir, tanggal_lahir, anak_ke, 
        nama_ayah, nama_ibu, alamat_pemohon, tanggal_input, status
    ) VALUES (
        :id, :nik_anak, :nomor_akta_kelahiran, :nama_anak, :tempat_lahir, :tanggal_lahir, :anak_ke,
        :nama_ayah, :nama_ibu, :alamat_pemohon, CURRENT_TIMESTAMP, :status
    )";

    // Prepare the statement
    $stmt = $db->prepare($sql);

    // Bind the form input values to the parameters
    $stmt->bindParam(':id', $max_id, PDO::PARAM_INT);
    $stmt->bindParam(':nik_anak', $_POST['nik_anak'], PDO::PARAM_STR);
    $stmt->bindParam(':nomor_akta_kelahiran', $_POST['nomor_akta_kelahiran'], PDO::PARAM_STR);
    $stmt->bindParam(':nama_anak', $_POST['nama_anak'], PDO::PARAM_STR);
    $stmt->bindParam(':tempat_lahir', $_POST['tempat_lahir'], PDO::PARAM_STR);
    $stmt->bindParam(':tanggal_lahir', $_POST['tanggal_lahir'], PDO::PARAM_STR);
    $stmt->bindParam(':anak_ke', $_POST['anak_ke'], PDO::PARAM_INT);
    $stmt->bindParam(':nama_ayah', $_POST['nama_ayah'], PDO::PARAM_STR);
    $stmt->bindParam(':nama_ibu', $_POST['nama_ibu'], PDO::PARAM_STR);
    $stmt->bindParam(':alamat_pemohon', $_POST['alamat_pemohon'], PDO::PARAM_STR);
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);  // Default status

    try {
        // Execute the query
        $stmt->execute();
        echo "Data berhasil disimpan!";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
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
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">
                        <img alt="Brand" src="images/logomaros.png" style="width: 50px;">
                    </a>
                </div>
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
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="login-user.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <h3>Formulir Permohonan Kartu Identitas Anak</h3>
            <hr />
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post">

                        <!-- Data Pemohon -->
                        <h4>Data Pemohon</h4>
                        <div class="form-group">
                            <label for="nik_anak" class="col-sm-3 control-label">NIK Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_anak" name="nik_anak" placeholder="Masukkan NIK Anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor_akta_kelahiran" class="col-sm-3 control-label">Nomor Akta Kelahiran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_akta_kelahiran" name="nomor_akta_kelahiran" placeholder="Masukkan Nomor Akta Kelahiran" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_anak" class="col-sm-3 control-label"> Nama Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_anak" name="nama_anak" placeholder="Masukkan Nama Anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-sm-3 control-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-sm-3 control-label">Hari dan Tanggal Lahir</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                            </div>
                            <label for="anakke" class="col-sm-2 control-label">Anak ke</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="anakke" name="anak_ke" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_ayah" class="col-sm-3 control-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukkan Nama Ayah" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_ibu" class="col-sm-3 control-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Masukkan Nama Ibu" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_pemohon" class="col-sm-3 control-label">Alamat Pemohon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat_pemohon" name="alamat_pemohon" placeholder="Masukkan Alamat Pemohon" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary" name="submit">Kirim Permohonan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>