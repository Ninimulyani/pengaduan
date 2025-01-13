<?php
require_once("../private/database.php");

if (isset($_POST['submit'])) {
    try {
        $sql = "INSERT INTO akta_kelahiran (
            nama_pelapor, nik_pelapor, nomor_dokumen_perjalanan, nomor_kartu_keluarga_pelapor, kewarganegaraan_pelapor,
            nomor_handphone, email, nama_saksi_1, nik_saksi_1, nomor_kartu_keluarga_saksi_1, kewarganegaraan_saksi_1,
            nama_ayah, nik_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, kewarganegaraan_ayah,
            nama_ibu, nik_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, kewarganegaraan_ibu,
            nama_anak, jk_anak, tempat_lahir, tanggal_lahir_anak, pukul, jenis_kelahiran, kelahiran_ke,
            penolong_kelahiran, bb_bayi, pb, dokumen
        ) VALUES (
            :nama_pelapor, :nik_pelapor, :nomor_dokumen_perjalanan, :nomor_kartu_keluarga_pelapor, :kewarganegaraan_pelapor,
            :nomor_handphone, :email, :nama_saksi_1, :nik_saksi_1, :nomor_kartu_keluarga_saksi_1, :kewarganegaraan_saksi_1,
            :nama_ayah, :nik_ayah, :tempat_lahir_ayah, :tanggal_lahir_ayah, :kewarganegaraan_ayah,
            :nama_ibu, :nik_ibu, :tempat_lahir_ibu, :tanggal_lahir_ibu, :kewarganegaraan_ibu,
            :nama_anak, :jk_anak, :tempat_lahir, :tanggal_lahir_anak, :pukul, :jenis_kelahiran, :kelahiran_ke,
            :penolong_kelahiran, :bb_bayi, :pb, :dokumen
        )";

        $stmt = $db->prepare($sql);

        $uploadDir = 'uploads/';
        $fileName = basename($_FILES['dokumen']['name']);
        $uploadFile = $uploadDir . $fileName;

        if ($_FILES['dokumen']['error'] == UPLOAD_ERR_OK) {
            if ($_FILES['dokumen']['size'] > 10000000) {
                echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Ukuran File Terlalu Besar',
                        text: 'Maksimal ukuran file adalah 10MB.',
                        confirmButtonText: 'OK'
                    });
                </script>";
            } else {
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                if (move_uploaded_file($_FILES['dokumen']['tmp_name'], $uploadFile)) {
                    $stmt->bindParam(':nama_pelapor', $_POST['nama_pelapor']);
                    $stmt->bindParam(':nik_pelapor', $_POST['nik_pelapor']);
                    $stmt->bindParam(':nomor_dokumen_perjalanan', $_POST['nomor_dokumen_perjalanan']);
                    $stmt->bindParam(':nomor_kartu_keluarga_pelapor', $_POST['nomor_kartu_keluarga_pelapor']);
                    $stmt->bindParam(':kewarganegaraan_pelapor', $_POST['kewarganegaraan_pelapor']);
                    $stmt->bindParam(':nomor_handphone', $_POST['nomor_handphone']);
                    $stmt->bindParam(':email', $_POST['email']);
                    $stmt->bindParam(':nama_saksi_1', $_POST['nama_saksi_1']);
                    $stmt->bindParam(':nik_saksi_1', $_POST['nik_saksi_1']);
                    $stmt->bindParam(':nomor_kartu_keluarga_saksi_1', $_POST['nomor_kartu_keluarga_saksi_1']);
                    $stmt->bindParam(':kewarganegaraan_saksi_1', $_POST['kewarganegaraan_saksi_1']);
                    $stmt->bindParam(':nama_ayah', $_POST['nama_ayah']);
                    $stmt->bindParam(':nik_ayah', $_POST['nik_ayah']);
                    $stmt->bindParam(':tempat_lahir_ayah', $_POST['tempat_lahir_ayah']);
                    $stmt->bindParam(':tanggal_lahir_ayah', $_POST['tanggal_lahir_ayah']);
                    $stmt->bindParam(':kewarganegaraan_ayah', $_POST['kewarganegaraan_ayah']);
                    $stmt->bindParam(':nama_ibu', $_POST['nama_ibu']);
                    $stmt->bindParam(':nik_ibu', $_POST['nik_ibu']);
                    $stmt->bindParam(':tempat_lahir_ibu', $_POST['tempat_lahir_ibu']);
                    $stmt->bindParam(':tanggal_lahir_ibu', $_POST['tanggal_lahir_ibu']);
                    $stmt->bindParam(':kewarganegaraan_ibu', $_POST['kewarganegaraan_ibu']);
                    $stmt->bindParam(':nama_anak', $_POST['nama_anak']);
                    $stmt->bindParam(':jk_anak', $_POST['jk_anak']);
                    $stmt->bindParam(':tempat_lahir', $_POST['tempat_lahir']);
                    $stmt->bindParam(':tanggal_lahir_anak', $_POST['tanggal_lahir_anak']);
                    $stmt->bindParam(':pukul', $_POST['pukul']);
                    $stmt->bindParam(':jenis_kelahiran', $_POST['jenis_kelahiran']);
                    $stmt->bindParam(':kelahiran_ke', $_POST['kelahiran_ke']);
                    $stmt->bindParam(':penolong_kelahiran', $_POST['penolong_kelahiran']);
                    $stmt->bindParam(':bb_bayi', $_POST['bb_bayi']);
                    $stmt->bindParam(':pb', $_POST['pb']);
                    $stmt->bindParam(':dokumen', $fileName);

                    if ($stmt->execute()) {
                        echo "<script>
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Disimpan',
                                text: 'Data Anda telah tersimpan ke dalam sistem.',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.href = 'success_page.php';
                            });
                        </script>";
                    } else {
                        echo "<script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Kesalahan Sistem',
                                text: 'Data gagal disimpan ke database.',
                                confirmButtonText: 'OK'
                            });
                        </script>";
                    }
                } else {
                    echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal Mengunggah Dokumen',
                            text: 'Silakan coba lagi.',
                            confirmButtonText: 'OK'
                        });
                    </script>";
                }
            }
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan Pengunggahan',
                    text: 'Error: " . $_FILES['dokumen']['error'] . "',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    } catch (PDOException $e) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Sistem',
                text: 'Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "',
                confirmButtonText: 'OK'
            });
        </script>";
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
                </div>
            </div>
        </nav>

        <div class="main-content">
            <h3>Formulir Pelaporan Pencatatan Sipil Di Dalam Wilayah NKRI</h3>
            <h4>Jenis Laporan Pencatatan Sipil Kelahiran</h4>
            <hr />
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                        <!-- Data Pelapor -->
                        <h4>Data Pelapor</h4>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama_pelapor" placeholder="Masukkan nama pelapor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik" name="nik_pelapor" placeholder="Masukkan NIK pelapor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_dokumen_perjalanan" class="col-sm-3 control-label">Nomor Dokumen Perjalanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_dokumen_perjalanan" name="nomor_dokumen_perjalanan" placeholder="Masukkan nomor dokumen perjalanan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga" class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga" name="nomor_kartu_keluarga_pelapor" placeholder="Masukkan nomor kartu keluarga" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan" name="kewarganegaraan_pelapor" placeholder="Masukkan kewarganegaraan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telpon" class="col-sm-3 control-label">Nomor Handphone</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="telpon" name="nomor_handphone" placeholder="Masukkan nomor handphone" required>
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
                                <input type="text" class="form-control" id="nama_saksi1" name="nama_saksi_1" placeholder="Masukkan nama saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi1" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_saksi1" name="nik_saksi_1" placeholder="Masukkan NIK saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga_saksi1" class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga_saksi1" name="nomor_kartu_keluarga_saksi_1" placeholder="Masukkan nomor kartu keluarga saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_saksi1" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_saksi1" name="kewarganegaraan_saksi_1" placeholder="Masukkan kewarganegaraan saksi 1" required>
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
                                <select class="form-control" id="jk_anak" name="jk_anak" required>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_dilahirkan_anak" class="col-sm-3 control-label">Tempat Dilahirkan</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="tempat_lahir" name="tempat_lahir" required>
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
                                <select class="form-control" id="jenis_kelahiran" name="jenis_kelahiran" required>
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
                                <input type="number" class="form-control" id="kelahiran_ke" name="kelahiran_ke" placeholder="Masukkan urutan kelahiran anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penolong_kelahiran_anak" class="col-sm-3 control-label">Penolong Kelahiran</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="penolong_kelahiran" name="penolong_kelahiran" required>
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
                                <input type="number" step="0.01" class="form-control" id="bb_bayi" name="bb_bayi" placeholder="Masukkan berat bayi dalam kilogram" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="panjang_bayi" class="col-sm-3 control-label">Panjang Bayi (cm)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="pb" name="pb" placeholder="Masukkan panjang bayi dalam sentimeter" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Unggah Dokumen Persyaratan</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="dokumen" name="dokumen" required>
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