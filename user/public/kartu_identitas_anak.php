<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php");
$user_id = $_SESSION['user_id'];

if (isset($_POST['submit'])) {
    try {
        $user_id = $_SESSION['user_id'];
        $status = "Menunggu";
        $upload_dir = 'uploads/';

        // Upload kartu_keluarga
        $file_name_kk = isset($_FILES['kartu_keluarga']) ? basename($_FILES['kartu_keluarga']['name']) : '';
        $target_file_kk = $upload_dir . $file_name_kk;

        // Upload akta_kelahiran
        $file_name_akta = isset($_FILES['akta_kelahiran']) ? basename($_FILES['akta_kelahiran']['name']) : '';
        $target_file_akta = $upload_dir . $file_name_akta;

        // Upload pasfoto
        $file_name_pasfoto = isset($_FILES['pasfoto']) ? basename($_FILES['pasfoto']['name']) : '';
        $target_file_pasfoto = $upload_dir . $file_name_pasfoto;

        // Move uploaded files
        if (
            move_uploaded_file($_FILES['kartu_keluarga']['tmp_name'], $target_file_kk) &&
            move_uploaded_file($_FILES['akta_kelahiran']['tmp_name'], $target_file_akta) &&
            move_uploaded_file($_FILES['pasfoto']['tmp_name'], $target_file_pasfoto)
        ) {

            $sql = "INSERT INTO data_anak (
                nik_anak, nomor_akta_kelahiran, nama_anak, tempat_lahir, tanggal_lahir, anak_ke,
                nama_ayah, nama_ibu, alamat_pemohon, dokumen_pemohon, kartu_keluarga, akta_kelahiran,
                pasfoto, tanggal_input, status, user_id
            ) VALUES (
                :nik_anak, :nomor_akta_kelahiran, :nama_anak, :tempat_lahir, :tanggal_lahir, :anak_ke,
                :nama_ayah, :nama_ibu, :alamat_pemohon, :dokumen_pemohon, :kartu_keluarga, :akta_kelahiran,
                :pasfoto, CURRENT_TIMESTAMP, :status, :user_id
            )";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':nik_anak', $_POST['nik_anak']);
            $stmt->bindParam(':nomor_akta_kelahiran', $_POST['nomor_akta_kelahiran']);
            $stmt->bindParam(':nama_anak', $_POST['nama_anak']);
            $stmt->bindParam(':tempat_lahir', $_POST['tempat_lahir']);
            $stmt->bindParam(':tanggal_lahir', $_POST['tanggal_lahir']);
            $stmt->bindParam(':anak_ke', $_POST['anak_ke']);
            $stmt->bindParam(':nama_ayah', $_POST['nama_ayah']);
            $stmt->bindParam(':nama_ibu', $_POST['nama_ibu']);
            $stmt->bindParam(':alamat_pemohon', $_POST['alamat_pemohon']);
            $stmt->bindParam(':dokumen_pemohon', $_POST['dokumen_pemohon']);
            $stmt->bindParam(':kartu_keluarga', $file_name_kk);
            $stmt->bindParam(':akta_kelahiran', $file_name_akta);
            $stmt->bindParam(':pasfoto', $file_name_pasfoto);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':user_id', $user_id);

            if ($stmt->execute()) {
                header("Location: home-2.php?status=success");
                exit;
            } else {
                echo 'Gagal menyimpan data.';
            }
        } else {
            echo 'Gagal mengunggah file.';
        }
    } catch (Exception $e) {
        echo 'Terjadi kesalahan: ' . $e->getMessage();
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
    <!-- Validasi -->
    <script src="js/validasi.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
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
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">


                        <!-- Data Pemohon -->
                        <h4>Data Pemohon</h4>
                        <div class="form-group">
                            <label for="nik_anak" class="col-sm-3 control-label">NIK Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik" name="nik_anak"
                                    placeholder="Masukkan NIK Anak" required onkeypress="return hanyaAngka(event)"
                                    oninput="validatenik()" maxlength="16">
                                <small id="nikError" class="text-danger"></small> <!-- Tempat munculnya pesan error -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nomor_akta_kelahiran" class="col-sm-3 control-label">Nomor Akta
                                Kelahiran</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_akta_kelahiran"
                                    name="nomor_akta_kelahiran" placeholder="Masukkan Nomor Akta Kelahiran" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_anak" class="col-sm-3 control-label"> Nama Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_anak" name="nama_anak"
                                    placeholder="Masukkan Nama Anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir" class="col-sm-3 control-label">Tempat Lahir</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                    placeholder="Masukkan Tempat Lahir" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_lahir" class="col-sm-3 control-label">Hari dan Tanggal Lahir</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir"
                                    required>
                            </div>
                            <label for="anakke" class="col-sm-2 control-label">Anak ke</label>
                            <div class="col-sm-4">
                                <input type="number" class="form-control" id="anakke" name="anak_ke" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_ayah" class="col-sm-3 control-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    placeholder="Masukkan Nama Ayah" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_ibu" class="col-sm-3 control-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    placeholder="Masukkan Nama Ibu" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_pemohon" class="col-sm-3 control-label">Alamat Pemohon</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="alamat_pemohon" name="alamat_pemohon"
                                    placeholder="Masukkan Alamat Pemohon" required>
                            </div>
                        </div>

                        <h4>Dokumen Persyaratan</h4>
                        <div class="form-group">
                            <label for="kartu_keluarga" class="col-sm-3 control-label">Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="kartu_keluarga" name="kartu_keluarga"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="akta_kelahiran" class="col-sm-3 control-label">Akta Kelahiran</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="akta_kelahiran" name="akta_kelahiran"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="akta_kelahiran" class="col-sm-3 control-label">KTP Ayah</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="akta_kelahiran" name="akta_kelahiran"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="akta_kelahiran" class="col-sm-3 control-label">KTP Ibu</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="akta_kelahiran" name="akta_kelahiran"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pasfoto" class="col-sm-3 control-label">Pasfoto</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pasfoto" name="pasfoto" required>
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