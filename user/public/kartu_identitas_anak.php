<?php
require_once("../private/database.php");

// Fetch the max id from the 'laporan' table
$statement = $db->query("SELECT id FROM laporan ORDER BY id DESC LIMIT 1");
foreach ($statement as $key) {
    // get max id from tabel laporan
    $max_id = $key['id'] + 1;
}

if (isset($_POST['submit'])) {
    // Set the default status
    $status = "Menunggu";

    // Handle PDF file upload
    $uploadDir = 'uploads/';
    $pdfFileName = $_FILES['pdfFile']['name'];
    $pdfFilePath = $uploadDir . $pdfFileName;

    // Move the uploaded file to the specified directory
    if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $pdfFilePath)) {
        // Insert data into the database
        $sql = "INSERT INTO laporan (id, nama, nik, no_dokumen_perjalanan, no_kartu_keluarga, kewarganegaraan, telpon, email, 
                nama_saksi1, nik_saksi1, no_kartu_keluarga_saksi1, kewarganegaraan_saksi1,
                nama_ayah, nik_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, kewarganegaraan_ayah,
                nama_ibu, nik_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, kewarganegaraan_ibu,
                nama_anak, jenis_kelamin_anak, tempat_dilahirkan_anak, tanggal_lahir_anak, pukul_lahir_anak,
                jenis_kelahiran_anak, kelahiran_ke_anak, penolong_kelahiran_anak, berat_bayi, panjang_bayi, 
                pdf_path, tanggal, status) 
                VALUES ('$max_id', '$_POST[nama]', '$_POST[nik]', '$_POST[no_dokumen_perjalanan]', '$_POST[no_kartu_keluarga]', '$_POST[kewarganegaraan]', 
                        '$_POST[telpon]', '$_POST[email]', '$_POST[nama_saksi1]', '$_POST[nik_saksi1]', '$_POST[no_kartu_keluarga_saksi1]', '$_POST[kewarganegaraan_saksi1]', 
                        '$_POST[nama_ayah]', '$_POST[nik_ayah]', '$_POST[tempat_lahir_ayah]', '$_POST[tanggal_lahir_ayah]', '$_POST[kewarganegaraan_ayah]', 
                        '$_POST[nama_ibu]', '$_POST[nik_ibu]', '$_POST[tempat_lahir_ibu]', '$_POST[tanggal_lahir_ibu]', '$_POST[kewarganegaraan_ibu]', 
                        '$_POST[nama_anak]', '$_POST[jenis_kelamin_anak]', '$_POST[tempat_dilahirkan_anak]', '$_POST[tanggal_lahir_anak]', '$_POST[pukul_lahir_anak]', 
                        '$_POST[jenis_kelahiran_anak]', '$_POST[kelahiran_ke_anak]', '$_POST[penolong_kelahiran_anak]', '$_POST[berat_bayi]', '$_POST[panjang_bayi]', 
                        '$pdfFilePath', CURRENT_TIMESTAMP, '$status')";
        $stmt = $db->prepare($sql);
        $stmt->execute();
    } else {
        echo 'Failed to upload PDF file.';
    }
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Kantor Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20" >
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

<body>

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
                        <li class="active"><a href="layanan.php">LAYANAN</a></li>
                        <li><a href="lihat.php">LIHAT PENGADUAN</a></li>
                        <li><a href="cara-2.php">CARA</a></li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="../../login.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <h3>Formulir Permohonan Kartu Indentias Anak</h3>
            <hr/>
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                        
                        <!-- Data Pelapor -->
                        <h4>Data pemohon</h4>
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
                                <input type="number" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
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
                                <input type="text" class="form-control" id="alamat_pemohon" name="alamat_pemohon" placeholder="Masukkan Nama Ibu" required>
                            </div>
                        </div>

                        

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary" name="submit">Kirim Laporan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
