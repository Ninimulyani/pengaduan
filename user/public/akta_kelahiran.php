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

        // Validasi NIK harus terdiri dari 16 digit angka
        if (!preg_match('/^\d{16}$/', $_POST['nik_pelapor'])) {
            echo 'NIK harus terdiri dari 16 digit angka.';
            exit();
        }

        // Cek apakah nik_pelapor sudah ada dalam database
        $stmt_check = $db->prepare("SELECT COUNT(*) FROM akta_kelahiran WHERE nik_pelapor = :nik_pelapor");
        $stmt_check->bindParam(':nik_pelapor', $_POST['nik_pelapor']);
        $stmt_check->execute();
        $nik_exists = $stmt_check->fetchColumn();

        if ($nik_exists > 0) {
            echo 'NIK sudah terdaftar, tidak dapat memasukkan data yang sama.';
            exit();
        }

        // Ambil ID terakhir dan tambahkan 1
        $statement = $db->query("SELECT id FROM akta_kelahiran ORDER BY id DESC LIMIT 1");
        $max_id = 1;
        foreach ($statement as $key) {
            $max_id = $key['id'] + 1;
        }

        $status = "Menunggu";
        $upload_dir = 'uploads/';

        // Upload file
        $file_fields = ['kartu_keluarga_asli', 'buku_nikah', 'ktp_orang_tua', 'ktp_saksi'];
        $uploaded_files = [];

        foreach ($file_fields as $field) {
            if (isset($_FILES[$field]) && $_FILES[$field]['error'] == 0) {
                $file_name = basename($_FILES[$field]['name']);
                $target_file = $upload_dir . $file_name;

                if (move_uploaded_file($_FILES[$field]['tmp_name'], $target_file)) {
                    $uploaded_files[$field] = $file_name;
                } else {
                    echo "Gagal mengunggah file $field.";
                    exit();
                }
            }
        }

        // Insert data ke database
        $sql = "INSERT INTO akta_kelahiran (
            id, nama_pelapor, nik_pelapor, nomor_dokumen_perjalanan, nomor_kartu_keluarga_pelapor, 
            kewarganegaraan_pelapor, nomor_handphone, email, nama_saksi_1, nik_saksi_1, nomor_kartu_keluarga_saksi_1, 
            kewarganegaraan_saksi_1, nama_ayah, nik_ayah, tempat_lahir_ayah, tanggal_lahir_ayah, kewarganegaraan_ayah, 
            nama_ibu, nik_ibu, tempat_lahir_ibu, tanggal_lahir_ibu, kewarganegaraan_ibu, nama_anak, jk_anak, 
            tempat_lahir, tanggal_lahir_anak, pukul, jenis_kelahiran, kelahiran_ke, penolong_kelahiran, bb_bayi, pb, 
            kartu_keluarga_asli, buku_nikah, ktp_orang_tua, ktp_saksi, status, dokumen_pemohon, user_id, created_at
        ) VALUES (
            :id, :nama_pelapor, :nik_pelapor, :nomor_dokumen_perjalanan, :nomor_kartu_keluarga_pelapor, 
            :kewarganegaraan_pelapor, :nomor_handphone, :email, :nama_saksi_1, :nik_saksi_1, :nomor_kartu_keluarga_saksi_1, 
            :kewarganegaraan_saksi_1, :nama_ayah, :nik_ayah, :tempat_lahir_ayah, :tanggal_lahir_ayah, :kewarganegaraan_ayah, 
            :nama_ibu, :nik_ibu, :tempat_lahir_ibu, :tanggal_lahir_ibu, :kewarganegaraan_ibu, :nama_anak, :jk_anak, 
            :tempat_lahir, :tanggal_lahir_anak, :pukul, :jenis_kelahiran, :kelahiran_ke, :penolong_kelahiran, :bb_bayi, :pb, 
            :kartu_keluarga_asli, :buku_nikah, :ktp_orang_tua, :ktp_saksi, :status, :dokumen_pemohon, :user_id, CURRENT_TIMESTAMP
        )";

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':id', $max_id);
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
        $stmt->bindParam(':kartu_keluarga_asli', $uploaded_files['kartu_keluarga_asli']);
        $stmt->bindParam(':buku_nikah', $uploaded_files['buku_nikah']);
        $stmt->bindParam(':ktp_orang_tua', $uploaded_files['ktp_orang_tua']);
        $stmt->bindParam(':ktp_saksi', $uploaded_files['ktp_saksi']);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':dokumen_pemohon', $_POST['dokumen_pemohon']);
        $stmt->bindParam(':user_id', $user_id);

        if ($stmt->execute()) {
            header("Location: home-2.php?status=success");
            exit();
        } else {
            echo 'Gagal menyimpan data.';
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
    <!-- Validasi -->
    <script src="js/validasi.js"></script>
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
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
                            <label for="ndp" class="col-sm-3 control-label">Nomor Dokumen
                                Perjalanan</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="ndp" name="nomor_dokumen_perjalanan"
                                    placeholder="Masukkan nomor dokumen perjalanan" required oninput="validateNDP()"
                                    maxlength="16">
                                <small id="ndpError" class="text-danger"></small> <!-- Tempat munculnya pesan error -->
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
                                <input type="text" class="form-control" id="nama_saksi1" name="nama_saksi_1"
                                    placeholder="Masukkan nama saksi 1" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi_1" class="col-sm-3 control-label">NIK</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nik_saksi_1" name="nik_saksi_1"
                                    placeholder="Masukkan NIK saksi 1" required onkeypress="return hanyaAngka(event)"
                                    oninput="validateSaksi()" maxlength="16">
                                <small id="nikErorSaksi" class="text-danger"></small>
                                <!-- Tempat munculnya pesan error -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="no_kartu_keluarga_saksi1" class="col-sm-3 control-label">Nomor Kartu
                                Keluarga</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="no_kartu_keluarga"
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
                                    placeholder="Masukkan NIK ayah" required onkeypress="return hanyaAngka(event)"
                                    oninput="validatenikayah()" maxlength="16">
                                <small id="nikAyahError" class="text-danger"></small>
                                <!-- Tempat munculnya pesan error -->
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

                        <!-- Data Anak -->
                        <h4>Data Anak</h4>
                        <div class="form-group">
                            <label for="nama_anak" class="col-sm-3 control-label">Nama Anak</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_anak" name="nama_anak"
                                    placeholder="Masukkan nama anak" required>
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
                            <label for="tanggal_lahir_anak" class="col-sm-3 control-label">Hari dan Tanggal
                                Lahir</label>
                            <div class="col-sm-9">
                                <input type="date" class="form-control" id="tanggal_lahir_anak"
                                    name="tanggal_lahir_anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pukul_lahir_anak" class="col-sm-3 control-label">Pukul</label>
                            <div class="col-sm-9">
                                <input type="time" class="form-control" id="pukul_lahir_anak" name="pukul_lahir_anak"
                                    required>
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
                                <input type="number" class="form-control" id="kelahiran_ke" name="kelahiran_ke"
                                    placeholder="Masukkan urutan kelahiran anak" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="penolong_kelahiran_anak" class="col-sm-3 control-label">Penolong
                                Kelahiran</label>
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
                                <input type="number" step="0.01" class="form-control" id="bb_bayi" name="bb_bayi"
                                    placeholder="Masukkan berat bayi dalam kilogram" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="panjang_bayi" class="col-sm-3 control-label">Panjang Bayi (cm)</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="pb" name="pb"
                                    placeholder="Masukkan panjang bayi dalam sentimeter" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>

                        <h3>Dokumen Persyaratan</h3>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Surat Keterangan Kelahiran</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="surat_keterangan_kelahiran"
                                    required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Kartu Keluarga Asli</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="kartu_keluarga_asli"
                                    required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Akta/Buku Nikah</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="akta/buku_nikah" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">KTP Ayah</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="ktp_ayah" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">KTP Ibu</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="ktp_ibu" required>
                            </div>
                        </div>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">KTP Saksi</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="ktp_saksi" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary" name="submit">Kirim Laporan</button>
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>

</body>

</html>