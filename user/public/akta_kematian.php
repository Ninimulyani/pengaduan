<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php");

if (isset($_POST['submit'])) {
    try {
        $user_id = $_SESSION['user_id'];
        $nik_alm = $_POST['nik_alm'];


        // Cek apakah nik_alm sudah ada di database
        $stmtCheck = $db->prepare("SELECT COUNT(*) FROM akta_kematian WHERE nik_alm = :nik_alm");
        $stmtCheck->bindParam(':nik_alm', $nik_alm);
        $stmtCheck->execute();
        $count = $stmtCheck->fetchColumn();

        if ($count > 0) {
            echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
            <script>
              window.onload = function() {
                Swal.fire({
                  icon: 'error',
                  title: 'Gagal!',
                  text: 'Nik Almarhum Telah Ada di Data.',
                  confirmButtonText: 'Lanjutkan'
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = 'akta_kematian.php';
                  }
                });
              };
            </script>";
            exit();
        }


        $statement = $db->query("SELECT id FROM akta_kematian ORDER BY id DESC LIMIT 1");
        $max_id = 1;
        foreach ($statement as $key) {
            $max_id = $key['id'] + 1;
        }


        $status = "Menunggu";
        $upload_dir = 'uploads/';

        // Upload kartu_keluarga
        $file_name_kk = basename($_FILES['kartu_keluarga']['name']);
        $target_file_kk = $upload_dir . $file_name_kk;

        // Upload keterangan_kematian
        $file_name_keterangan = basename($_FILES['keterangan_kematian']['name']);
        $target_file_keterangan = $upload_dir . $file_name_keterangan;

        if (
            move_uploaded_file($_FILES['kartu_keluarga']['tmp_name'], $target_file_kk) &&
            move_uploaded_file($_FILES['keterangan_kematian']['tmp_name'], $target_file_keterangan)
        ) {

            $sql = "INSERT INTO akta_kematian (
                id, user_id, nama_pelapor, nik_pelapor, nomor_dokumen_perjalanan, nomor_kartu_keluarga_pelapor, 
                kewarganegaraan_pelapor, nomor_handphone, email, nama_saksi_1, nik_saksi_1, nomor_kartu_keluarga_saksi_1, 
                kewarganegaraan_saksi_1, nama_ayah, nik_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, 
                kewarganegaraan_ayah, nama_ibu, nik_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, kewarganegaraan_ibu, 
                nik_alm, nama_lengkap_alm, hari_tanggal_kematian, pukul, sebab_kematian, tempat_kematian, 
                yang_menerangkan, kartu_keluarga, keterangan_kematian, tanggal_input, status
            ) VALUES (
                :id, :user_id, :nama_pelapor, :nik_pelapor, :nomor_dokumen_perjalanan, :nomor_kartu_keluarga_pelapor, 
                :kewarganegaraan_pelapor, :nomor_handphone, :email, :nama_saksi_1, :nik_saksi_1, :nomor_kartu_keluarga_saksi_1, 
                :kewarganegaraan_saksi_1, :nama_ayah, :nik_ayah, :tempat_lahir_ayah, :tanggal_lahir_ayah, 
                :kewarganegaraan_ayah, :nama_ibu, :nik_ibu, :tempat_lahir_ibu, :tanggal_lahir_ibu, :kewarganegaraan_ibu, 
                :nik_alm, :nama_lengkap_alm, :hari_tanggal_kematian, :pukul, :sebab_kematian, :tempat_kematian, 
                :yang_menerangkan, :kartu_keluarga, :keterangan_kematian, CURRENT_TIMESTAMP, :status
            )";

            $stmt = $db->prepare($sql);

            $stmt->bindParam(':id', $max_id);
            $stmt->bindParam(':user_id', $user_id);
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
            $stmt->bindParam(':nik_alm', $_POST['nik_alm']);
            $stmt->bindParam(':nama_lengkap_alm', $_POST['nama_lengkap_alm']);
            $stmt->bindParam(':hari_tanggal_kematian', $_POST['hari_tanggal_kematian']);
            $stmt->bindParam(':pukul', $_POST['pukul']);
            $stmt->bindParam(':sebab_kematian', $_POST['sebab_kematian']);
            $stmt->bindParam(':tempat_kematian', $_POST['tempat_kematian']);
            $stmt->bindParam(':yang_menerangkan', $_POST['yang_menerangkan']);
            $stmt->bindParam(':kartu_keluarga', $file_name_kk);
            $stmt->bindParam(':keterangan_kematian', $file_name_keterangan);
            $stmt->bindParam(':status', $status);

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
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
    <!-- Validasi -->
    <script src="js/validasi.js"></script>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
                        <li><a href="cara-2.php">CARA</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">PROFIL DINAS
                                <span class="caret"></span></a>
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
            <h3>Formulir Pelaporan Pencatatatn Sipil Di Dalam Wilayah NKRI</h3>
            <h4>Jenis Laporan Pencatatan Sipil Kematian</h4>
            <hr />
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

                        <!-- Data Pelapor -->
                        <h4>Data Pelapor</h4>
                        <div class="form-group">
                            <label for="nama" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama" name="nama_pelapor"
                                    placeholder="Masukkan nama pelapor" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik" name="nik_pelapor"
                                    placeholder="Masukkan NIK pelapor" required onkeypress="return hanyaAngka(event)"
                                    oninput="validatenik()" maxlength="16">
                                <small id="nikError" class="text-danger"></small> <!-- Tempat munculnya pesan error -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_dokumen_perjalanan" class="col-sm-3 control-label">Nomor Dokumen
                                Perjalanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_dokumen_perjalanan"
                                    name="nomor_dokumen_perjalanan" placeholder="Masukkan nomor dokumen perjalanan"
                                    required onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga" class="col-sm-3 control-label">Nomor Kartu Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga"
                                    name="nomor_kartu_keluarga_pelapor" placeholder="Masukkan nomor kartu keluarga"
                                    required onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan"
                                    name="kewarganegaraan_pelapor" placeholder="Masukkan kewarganegaraan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="telpon" class="col-sm-3 control-label">Nomor Handphone</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="telpon" name="nomor_handphone"
                                    placeholder="Masukkan nomor handphone" required
                                    onkeypress="return hanyaAngka(event)" oninput="validateNoHP()" maxlength="16">
                                <small id="NoHpError" class="text-danger"></small> <!-- Tempat munculnya pesan error -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan email" required>
                            </div>
                        </div>

                        <!-- Data Saksi I -->
                        <h4>Data Saksi I</h4>
                        <div class="form-group">
                            <label for="nama_saksi1" class="col-sm-3 control-label">Nama</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_saksi_1" name="nama_saksi_1"
                                    placeholder="Masukkan nama saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi1" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_saksi_1" name="nik_saksi_1"
                                    placeholder="Masukkan NIK saksi 1" required oninput="validateSaksi()"
                                    maxlength="16">
                                <small id="nikErorSaksi" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga_saksi1" class="col-sm-3 control-label">Nomor Kartu
                                Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nomor_kartu_keluarga_saksi_1"
                                    name="nomor_kartu_keluarga_saksi_1"
                                    placeholder="Masukkan nomor kartu keluarga saksi 1" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_saksi1" class="col-sm-3 control-label">Kewarganegaraan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_saksi1"
                                    name="kewarganegaraan_saksi_1" placeholder="Masukkan kewarganegaraan saksi 1"
                                    required>
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <h4>Data Orang Tua</h4>
                        <div class="form-group">
                            <label for="nama_ayah" class="col-sm-3 control-label">Nama Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                    placeholder="Masukkan nama ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah" class="col-sm-3 control-label">NIK Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_ayah" name="nik_ayah"
                                    placeholder="Masukkan NIK ayah" requiredonkeypress="return hanyaAngka(event)"
                                    oninput="validatenikayah()" maxlength="16">
                                <small id="nikAyahError" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ayah" class="col-sm-3 control-label">Tempat Lahir Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                    placeholder="Masukkan tempat lahir ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ayah" class="col-sm-3 control-label">Tanggal Lahir Ayah</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_ayah"
                                    name="tanggal_lahir_ayah" placeholder="Masukkan tanggal lahir ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ayah" class="col-sm-3 control-label">Kewarganegaraan
                                Ayah</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_ayah"
                                    name="kewarganegaraan_ayah" placeholder="Masukkan kewarganegaraan ayah" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu" class="col-sm-3 control-label">Nama Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                    placeholder="Masukkan nama ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu" class="col-sm-3 control-label">NIK Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_ibu" name="nik_ibu"
                                    placeholder="Masukkan NIK ibu" required onkeypress="return hanyaAngka(event)"
                                    oninput="validatenikibu()" maxlength="16">
                                <small id="nikIbuError" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ibu" class="col-sm-3 control-label">Tempat Lahir Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                    placeholder="Masukkan tempat lahir ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ibu" class="col-sm-3 control-label">Tanggal Lahir Ibu</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                    placeholder="Masukkan tanggal lahir ibu" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ibu" class="col-sm-3 control-label">Kewarganegaraan Ibu</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kewarganegaraan_ibu"
                                    name="kewarganegaraan_ibu" placeholder="Masukkan kewarganegaraan ibu" required>
                            </div>
                        </div>

                        <!-- Data Alm -->
                        <h4>Kematian</h4>
                        <div class="form-group">
                            <label for="nik_alm" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="nik_alm" name="nik_alm"
                                    placeholder="Masukkan NIK" required onkeypress="return hanyaAngka(event)"
                                    oninput="validatenikalm()" maxlength="16">
                                <small id="nikAlmEror" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-3 control-label">Nama Lengkap</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap_alm"
                                    placeholder="Masukkan Nama lengkap" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_kematian" class="col-sm-3 control-label">Hari dan Tanggal
                                Kematian</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_kematian"
                                    name="hari_tanggal_kematian" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pukul_kematian" class="col-sm-3 control-label">Pukul</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="pukul_kematian" name="pukul" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="sebab_kematian" class="col-sm-3 control-label">Sebab Kematian</label>
                            <div class="col-sm-9">
                                <select class="form-control" id="sebab_kematian" name="sebab_kematian" required>
                                    <option value="Laki-laki">Sakit Biasa/Tua</option>
                                    <option value="Perempuan">Wabah Penyakit</option>
                                    <option value="Laki-laki">Kecelakaan</option>
                                    <option value="Perempuan">Kriminalitas</option>
                                    <option value="Laki-laki">Bunuh Diri</option>
                                    <option value="Perempuan">Lain nya</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tempat_kematian" class="col-sm-3 control-label">Tempat Kematian</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="tempat_kematian" name="tempat_kematian"
                                    placeholder="Masukkan Tempat Kematian" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="yang_menerangkan" class="col-sm-3 control-label">Yang Menerangkan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="yang_menerangkan" name="yang_menerangkan"
                                    placeholder="Masukkan Yang Menerangkan" required>
                            </div>
                        </div>

                        <h4>Dokumen Persyaratan</h4>
                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Kartu Keluarga Asli</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="kartu_keluarga" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">KTP Almarhum/Almarhuma</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="keterangan_kematian"
                                    required>
                            </div>
                        </div>
                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Surat Keterangan Kematian</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="kartu_keluarga" required>
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