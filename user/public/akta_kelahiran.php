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
    <title>Lapor | Kantor Kelurahan Tamalanrea</title>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
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
                        <img alt="Brand" src="images/logo.png" style="width: 40px;">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home-2.php">HOME</a></li>
                        <li class="active"><a href="layanan">LAYANAN</a></li>
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
            <h3>Buat Laporan</h3>
            <hr/>
            <div class="row">
                <div class="col-md-8 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                        
                        <!-- Data Pelapor -->
                        <h4>Data Pelapor</h4>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan nama pelapor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIK pelapor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_dokumen_perjalanan" class="col-sm-3 control-label">Nomor Dokumen Perjalanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_dokumen_perjalanan" name="no_dokumen_perjalanan" placeholder="Masukkan nomor dokumen perjalanan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga" class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga" name="no_kartu_keluarga" placeholder="Masukkan nomor kartu keluarga" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan" placeholder="Masukkan kewarganegaraan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telpon" class="col-sm-3 control-label">Nomor Handphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telpon" name="telpon" placeholder="Masukkan nomor handphone" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" required>
                            </div>
                        </div>

                        <!-- Data Saksi I -->
                        <h4>Data Saksi I</h4>
                        <div class="form-group">
                            <label for="nama_saksi1" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_saksi1" name="nama_saksi1" placeholder="Masukkan nama saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi1" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_saksi1" name="nik_saksi1" placeholder="Masukkan NIK saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga_saksi1" class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga_saksi1" name="no_kartu_keluarga_saksi1" placeholder="Masukkan nomor kartu keluarga saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_saksi1" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_saksi1" name="kewarganegaraan_saksi1" placeholder="Masukkan kewarganegaraan saksi 1" required>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <h4>Data Orang Tua</h4>
                        <div class="form-group">
                            <label for="nama_ayah" class="col-sm-3 control-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah" placeholder="Masukkan nama ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah" class="col-sm-3 control-label">NIK Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_ayah" name="nik_ayah" placeholder="Masukkan NIK ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ayah" class="col-sm-3 control-label">Tempat Lahir Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah" placeholder="Masukkan tempat lahir ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ayah" class="col-sm-3 control-label">Tanggal Lahir Ayah</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah" placeholder="Masukkan tanggal lahir ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ayah" class="col-sm-3 control-label">Kewarganegaraan Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_ayah" name="kewarganegaraan_ayah" placeholder="Masukkan kewarganegaraan ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu" class="col-sm-3 control-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu" placeholder="Masukkan nama ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu" class="col-sm-3 control-label">NIK Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" placeholder="Masukkan NIK ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ibu" class="col-sm-3 control-label">Tempat Lahir Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu" placeholder="Masukkan tempat lahir ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ibu" class="col-sm-3 control-label">Tanggal Lahir Ibu</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu" placeholder="Masukkan tanggal lahir ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ibu" class="col-sm-3 control-label">Kewarganegaraan Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu" placeholder="Masukkan kewarganegaraan ibu" required>
                            </div>
                        </div>

                        <!-- Data Anak -->
                        <h4>Data Anak</h4>
                        <div class="form-group">
                            <label for="nama_anak" class="col-sm-3 control-label">Nama Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_anak" name="nama_anak" placeholder="Masukkan nama anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin_anak" class="col-sm-3 control-label">Jenis Kelamin</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jenis_kelamin_anak" name="jenis_kelamin_anak" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_dilahirkan_anak" class="col-sm-3 control-label">Tempat Dilahirkan</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="tempat_dilahirkan_anak" name="tempat_dilahirkan_anak" required>
                                    <option value="RS/RB">RS/RB</option>
                                    <option value="Puskesmas">Puskesmas</option>
                                    <option value="Polindes">Polindes</option>
                                    <option value="Rumah">Rumah</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_anak" class="col-sm-3 control-label">Hari dan Tanggal Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_anak" name="tanggal_lahir_anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pukul_lahir_anak" class="col-sm-3 control-label">Pukul</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="pukul_lahir_anak" name="pukul_lahir_anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelahiran_anak" class="col-sm-3 control-label">Jenis Kelahiran</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="jenis_kelahiran_anak" name="jenis_kelahiran_anak" required>
                                    <option value="Tunggal">Tunggal</option>
                                    <option value="Kembar 2">Kembar 2</option>
                                    <option value="Kembar 3">Kembar 3</option>
                                    <option value="Kembar 4">Kembar 4</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kelahiran_ke_anak" class="col-sm-3 control-label">Kelahiran Ke-</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="kelahiran_ke_anak" name="kelahiran_ke_anak" placeholder="Masukkan urutan kelahiran anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penolong_kelahiran_anak" class="col-sm-3 control-label">Penolong Kelahiran</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="penolong_kelahiran_anak" name="penolong_kelahiran_anak" required>
                                    <option value="Dokter">Dokter</option>
                                    <option value="Bidan/Perawat">Bidan/Perawat</option>
                                    <option value="Dukun">Dukun</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="berat_bayi" class="col-sm-3 control-label">Berat Bayi (kg)</label>
                            <div class="col-sm-9">
                                <input type="number" step="0.01" class="form-control" id="berat_bayi" name="berat_bayi" placeholder="Masukkan berat bayi dalam kilogram" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="panjang_bayi" class="col-sm-3 control-label">Panjang Bayi (cm)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="panjang_bayi" name="panjang_bayi" placeholder="Masukkan panjang bayi dalam sentimeter" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Unggah PDF</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="pdfFile" required>
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
