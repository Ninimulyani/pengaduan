<?php
session_start();

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php"); // Koneksi ke database

try {
    // Ambil ID terakhir dari tabel 'surat_pindah_penduduk'
    $statement = $db->query("SELECT id FROM surat_pindah_penduduk ORDER BY id DESC LIMIT 1");
    $max_id = $statement->fetchColumn();
    $max_id = ($max_id !== false) ? $max_id + 1 : 1;

    // Direktori penyimpanan file
    $upload_dir = "uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Buat folder jika belum ada
    }

    // Tangani unggahan file kartu_keluarga_asli
    $file_kartu_keluarga_asli = null;
    if (isset($_FILES['kartu_keluarga_asli']) && $_FILES['kartu_keluarga_asli']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['kartu_keluarga_asli']['tmp_name'];
        $file_name = time() . "_" . preg_replace("/[^a-zA-Z0-9.]/", "_", $_FILES['kartu_keluarga_asli']['name']);
        $target_file = $upload_dir . $file_name;

        if (move_uploaded_file($file_tmp, $target_file)) {
            $file_kartu_keluarga_asli = $file_name;
        } else {
            echo "<script>alert('Gagal mengunggah file kartu keluarga asli.');</script>";
        }
    }

    // Cek apakah form disubmit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Serialize data anggota keluarga yang pindah
        $anggota_pindah_serialized = isset($_POST['anggota_pindah']) ? serialize($_POST['anggota_pindah']) : null;
        $nik_anggota_pindah_serialized = isset($_POST['nik_anggota_pindah']) ? serialize($_POST['nik_anggota_pindah']) : null;

        // Persiapan SQL
        $sql = "INSERT INTO surat_pindah_penduduk (
            id, no_kk, nama_lengkap_pemohon, nik_pemohon, jenis_permohonan, alamat_jelas, desa_kelurahan_asal, kecamatan_asal, 
            kabupaten_kota_asal, provinsi_asal, kode_pos_asal, jenis_pindah, alamat_pindah, desa_kelurahan_pindah, 
            kecamatan_pindah, kabupaten_kota_pindah, provinsi_pindah, kode_pos_pindah, alasan_pindah, jenis_kepindahan, 
            anggota_keluarga_tidak_pindah, anggota_keluarga_pindah, daftar_nik_anggota_pindah, daftar_anggota_pindah, 
            nama_sponsor, tipe_sponsor, alamat_sponsor, nomor_itas_itap, tanggal_itas_itap, negara_tujuan, 
            alamat_tujuan, penanggung_jawab, rencana_tanggal_pindah, nomor_handphone, email, kartu_keluarga_asli, tanggal_input, user_id, status
        ) VALUES (
            :id, :no_kk, :nama_lengkap_pemohon, :nik_pemohon, :jenis_permohonan, :alamat_jelas, :desa_kelurahan_asal, :kecamatan_asal,
            :kabupaten_kota_asal, :provinsi_asal, :kode_pos_asal, :jenis_pindah, :alamat_pindah, :desa_kelurahan_pindah,
            :kecamatan_pindah, :kabupaten_kota_pindah, :provinsi_pindah, :kode_pos_pindah, :alasan_pindah, :jenis_kepindahan,
            :anggota_keluarga_tidak_pindah, :anggota_keluarga_pindah, :daftar_nik_anggota_pindah, :daftar_anggota_pindah, 
            :nama_sponsor, :tipe_sponsor, :alamat_sponsor, :nomor_itas_itap, :tanggal_itas_itap, :negara_tujuan, 
            :alamat_tujuan, :penanggung_jawab, :rencana_tanggal_pindah, :nomor_handphone, :email, :kartu_keluarga_asli, CURRENT_TIMESTAMP, :user_id, :status
        )";

        // Persiapkan statement
        $stmt = $db->prepare($sql);

        // Bind parameter
        $stmt->bindParam(':id', $max_id, PDO::PARAM_INT);
        $stmt->bindParam(':no_kk', $_POST['no_kk'], PDO::PARAM_STR);
        $stmt->bindParam(':nama_lengkap_pemohon', $_POST['nama_lengkap_pemohon'], PDO::PARAM_STR);
        $stmt->bindParam(':nik_pemohon', $_POST['nik_pemohon'], PDO::PARAM_STR);
        $stmt->bindParam(':jenis_permohonan', $_POST['jenis_permohonan'], PDO::PARAM_STR);
        $stmt->bindParam(':alamat_jelas', $_POST['alamat_jelas'], PDO::PARAM_STR);
        $stmt->bindParam(':desa_kelurahan_asal', $_POST['desa_kelurahan_asal'], PDO::PARAM_STR);
        $stmt->bindParam(':kecamatan_asal', $_POST['kecamatan_asal'], PDO::PARAM_STR);
        $stmt->bindParam(':kabupaten_kota_asal', $_POST['kabupaten_kota_asal'], PDO::PARAM_STR);
        $stmt->bindParam(':provinsi_asal', $_POST['provinsi_asal'], PDO::PARAM_STR);
        $stmt->bindParam(':kode_pos_asal', $_POST['kode_pos_asal'], PDO::PARAM_STR);
        $stmt->bindParam(':jenis_pindah', $_POST['jenis_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':alamat_pindah', $_POST['alamat_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':desa_kelurahan_pindah', $_POST['desa_kelurahan_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':kecamatan_pindah', $_POST['kecamatan_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':kabupaten_kota_pindah', $_POST['kabupaten_kota_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':provinsi_pindah', $_POST['provinsi_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':kode_pos_pindah', $_POST['kode_pos_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':alasan_pindah', $_POST['alasan_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':jenis_kepindahan', $_POST['jenis_kepindahan'], PDO::PARAM_STR);
        $stmt->bindParam(':anggota_keluarga_tidak_pindah', $_POST['anggota_keluarga_tidak_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':anggota_keluarga_pindah', $_POST['anggota_keluarga_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':daftar_nik_anggota_pindah', $nik_anggota_pindah_serialized, PDO::PARAM_STR);
        $stmt->bindParam(':daftar_anggota_pindah', $anggota_pindah_serialized, PDO::PARAM_STR);
        $stmt->bindParam(':nama_sponsor', $_POST['nama_sponsor'], PDO::PARAM_STR);
        $stmt->bindParam(':tipe_sponsor', $_POST['tipe_sponsor'], PDO::PARAM_STR);
        $stmt->bindParam(':alamat_sponsor', $_POST['alamat_sponsor'], PDO::PARAM_STR);
        $stmt->bindParam(':nomor_itas_itap', $_POST['nomor_itas_itap'], PDO::PARAM_STR);
        $stmt->bindParam(':tanggal_itas_itap', $_POST['tanggal_itas_itap'], PDO::PARAM_STR);
        $stmt->bindParam(':negara_tujuan', $_POST['negara_tujuan'], PDO::PARAM_STR);
        $stmt->bindParam(':alamat_tujuan', $_POST['alamat_tujuan'], PDO::PARAM_STR);
        $stmt->bindParam(':penanggung_jawab', $_POST['penanggung_jawab'], PDO::PARAM_STR);
        $stmt->bindParam(':rencana_tanggal_pindah', $_POST['rencana_tanggal_pindah'], PDO::PARAM_STR);
        $stmt->bindParam(':nomor_handphone', $_POST['nomor_handphone'], PDO::PARAM_STR);
        $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
        $stmt->bindParam(':kartu_keluarga_asli', $file_kartu_keluarga_asli, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        $stmt->bindValue(':status', 'Menunggu', PDO::PARAM_STR);

        // Eksekusi statement
        if ($stmt->execute()) {
            header("Location: home-2.php?status=success");
            exit();
        } else {
            echo "<script>alert('Gagal menambahkan data.');</script>";
        }
    }
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
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
            <h3>Form Surat Keterangan Kependudukan</h3>
            <hr />
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="no_kk" class="col-sm-2 control-label">No KK</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" id="no_kk" name="no_kk"
                                    placeholder="Masukkan Nomor Kartu Keluarga" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nama Lengkap Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_lengkap_pemohon"
                                    name="nama_lengkap_pemohon" placeholder="Masukkan Nama Lengkap Pemohon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik_pemohon" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik_pemohon" name="nik_pemohon"
                                    placeholder="Masukkan NIK" required onkeypress="return hanyaAngka(event)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-2 control-label">Jenis Permohonan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_permohonan" name="jenis_permohonan"
                                    placeholder="Masukkan Jenis Permohonan" required>
                                    <option value="">-- Pilih Jenis Permohonan --</option>
                                    <option value="Surat Keterangan Pindah">Surat Keterangan Pindah</option>
                                    <option value="Surat Keterangan Pindah Luar Negeri (SKPLN)">Surat Keterangan Pindah
                                        Luar Negeri (SKPLN)</option>
                                    <option value="Surat Keterangan Tempat Tinggal (SKTT)">Surat Keterangan Tempat
                                        Tinggal (SKTT)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat_jelas" class="col-sm-2 control-label">Alamat Jelas</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_jelas" name="alamat_jelas"
                                    placeholder="Masukkan Alamat Jelas" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa_kelurahan_asal" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa_kelurahan_asal" name="desa_kelurahan_asal"
                                    placeholder="Masukkan Desa/Kelurahan" required></input>
                            </div>
                            <label for="kecamatan_asal" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan_asal" name="kecamatan_asal"
                                    placeholder="Masukkan Kecamatan" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten_kota_asal" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kabupaten_kota_asal" name="kabupaten_kota_asal"
                                    placeholder="Masukkan Kabupaten/Kota" required></input>
                            </div>
                            <label for="provinsi_asal" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi_asal" name="provinsi_asal"
                                    placeholder="Masukkan Provinsi" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_pos_asal" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kode_pos_asal" name="kode_pos_asal"
                                    placeholder="Masukkan Kode Pos" required
                                    onkeypress="return hanyaAngka(event)"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_pindah" class="col-sm-3 control-label">Jenis
                                Pindah</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="jenis_pindah" name="jenis_pindah"
                                    placeholder="Masukkan Jenis Pindah" required>
                                    <option value="">-- Pilih Jenis Pindah --</option>
                                    <option value="Dalam satu desa/kelurahan atau yang disebut dengan nama
                                        lain">Dalam satu desa/kelurahan atau yang disebut dengan nama
                                        lain</option>
                                    <option value="Antar desa/kelurahan atau yang disebut dengan nama lain
                                        dalam satu kecamatan">Antar desa/kelurahan atau yang disebut dengan nama lain
                                        dalam satu kecamatan</option>
                                    <option value="Antar desa/kelurahan atau yang disebut dengan nama lain
                                        dalam satu kecamatan">Antar desa/kelurahan atau yang disebut dengan nama lain
                                        dalam satu kecamatan</option>
                                    <option value="Antar kabupaten/kota dalam satu provinsi">Antar kabupaten/kota dalam
                                        satu provinsi</option>
                                    <option value="Antar provinsi">Antar provinsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_pindah" class="col-sm-2 control-label">Alamat Pindah</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_pindah" name="alamat_pindah"
                                    placeholder="Masukkan Alamat Pindah" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa_kelurahan_pindah" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa_kelurahan_pindah" name="desa_kelurahan_pindah"
                                    placeholder="Masukkan Desa/Kelurahan" required></input>
                            </div>
                            <label for="kecamatan_pindah" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan_pindah" name="kecamatan_pindah"
                                    placeholder="Masukkan Kecamatan" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten_kota_pindah" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kabupaten_kota_pindah" name="kabupaten_kota_pindah"
                                    placeholder="Masukkan Kabupaten/Kota" required></input>
                            </div>
                            <label for="provinsi_pindah" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi_pindah" name="provinsi_pindah"
                                    placeholder="Masukkan Provinsi" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kode_pos_pindah" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kode_pos_pindah" name="kode_pos_pindah"
                                    placeholder="Masukkan Kode Pos" required
                                    onkeypress="return hanyaAngka(event)"></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alasan_pindah" class="col-sm-2 control-label">Alasan Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="alasan_pindah" name="alasan_pindah"
                                    required>placeholder="Masukkan Alasan Pindah"
                                    <option value="">-- Pilih Alasan Pindah --</option>
                                    <option value="pekerjaan">Pekerjaan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>



                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Jenis Kepindahan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
                                    <option value="">-- Pilih Jenis Kepindahan --</option>
                                    <option value="Antar provinsi">Antar provinsi</option>
                                    <option value="Kepala Keluarga dan seluruh Anggota Keluarag">Kepala Keluarga dan
                                        seluruh Anggota Keluarag</option>
                                    <option value="Kepala Keluarga dan sebagian Anggota Keluarga">Kepala Keluarga dan
                                        sebagian Anggota Keluarga</option>
                                    <option value="Anggota Keluarga">Anggota Keluarga</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anggota_keluarga_tidak_pindah" class="col-sm-2 control-label">Anggota Keluarga
                                Tidak
                                Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="anggota_keluarga_tidak_pindah"
                                    name="anggota_keluarga_tidak_pindah" ` required>
                                    <option value="">-- Pilih Anggota Keluarga Tidak Pindah --</option>
                                    <option value="kk_baru">Membuat KK Baru</option>
                                    <option value="numpang_kk">Numpang KK</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="anggota_keluarga_pindah" class="col-sm-2 control-label">Anggota Keluarga yang
                                Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="anggota_keluarga_pindah" name="anggota_keluarga_pindah"
                                    required>
                                    <option value="">-- Pilih Anggota Keluarga yang Pindah --</option>
                                    <option value="kk_baru">Membuat KK Baru</option>
                                    <option value="numpang_kk">Numpang KK</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Daftar Anggota Keluarga yang
                                Pindah</label>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-3 control-label">NIK</label>
                            <label for="kabupaten" class="col-sm-5 control-label">NAMA LENGKAP</label>
                        </div>

                        <div id="form-container">
                            <!-- Baris pertama form -->
                            <div class="form-group row">
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nik_anggota_pindah[]"
                                        placeholder="NIK" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="anggota_pindah[]"
                                        placeholder="Nama Lengkap" required>
                                </div>
                                <div class="col-sm-1">
                                    <button type="button" class="btn btn-danger remove-form">-</button>
                                </div>
                            </div>
                        </div>
                        <button type="button" id="add-form" class="btn btn-primary">+ Add Form</button>



                        <div mb-2>
                            <label mb-10>Diisi oleh penduduk (Orang Asing) Pemegang ITAS yang Mengajukan SKTT dan OA
                                Pemegang SKTT dan OA pemengang ITAP yang Mengajukan Surat Keterangan Kependudukan Lain
                                nya
                            </label>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nama Sponsor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor"
                                    placeholder="Masukkan Nama Sponsor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipe_sponsor" class="col-sm-2 control-label">Tipe Sponsor</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tipe_sponsor" name="tipe_sponsor"
                                    placeholder="Masukkan Tipe Sponsor" required>
                                    <option value="">-- Pilih Tipe Sponsor --</option>
                                    <option value="kk_baru">Organisasi Internasional</option>
                                    <option value="numpang_kk">Perorangan</option>
                                    <option value="kk_baru">Pemerintah</option>
                                    <option value="numpang_kk">Tanpa Sponsor</option>
                                    <option value="numpang_kk">Perusahaan</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Alamat Sponsor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_sponsor" name="alamat_sponsor"
                                    placeholder="Masukkan Alamat Sponsor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor_itas_itap" class="col-sm-2 control-label">Nomor dan Tanggal ITAS &
                                ITAP</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nomor_itas_itap" name="nomor_itas_itap"
                                    placeholder="Masukkan Nomor ITAS & ITAP" required
                                    onkeypress="return hanyaAngka(event)">
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="tanggal_itas_itap" name="tanggal_itas_itap"
                                    placeholder="Masukkan Tanggal ITAS & ITAP" required>
                            </div>
                        </div>

                        <div mb-2>
                            <label class="control-label">Diisi oleh Penduduk yang Mengajukan Surat Keterangan Pindah
                                Luar Negeri</label>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Negara Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="negara_tujuan" name="negara_tujuan"
                                    placeholder="Masukkan Negara Tujuan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Alamat Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_tujuan" name="alamat_tujuan"
                                    placeholder="Masukkan Alamat Tujuan" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Penanggung Jawab</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                    placeholder="Masukkan Penanggung Jawab" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rencana_tanggal_pindah" class="col-sm-2 control-label">Rencana Tanggal
                                Pindah</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="rencana_tanggal_pindah"
                                    name="rencana_tanggal_pindah" placeholder="Masukkan Rencana Tanggal Pindah"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nomor_handphone" class="col-sm-2 control-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="telpon" name="nomor_handphone"
                                    placeholder="Masukkan Nomor Handphone" required
                                    onkeypress="return hanyaAngka(event)" oninput="validateNohpSuratPindah()"
                                    maxlength="16">
                                <small id="NoHpErrorpindah" class="text-danger"></small>
                                <!-- Tempat munculnya pesan error -->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email" required>
                            </div>
                        </div>

                        <h4>Dokumen Persyaratan</h4>

                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-2 control-label">Kartu Keluarga Asli</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="pdfFile" name="kartu_keluarga_asli"
                                    required>
                            </div>
                        </div>
                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-2 control-label">Surat Pengantar RT/RW</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="pdfFile" name="surat_pengantar_rt/rw"
                                    required>
                            </div>
                        </div>
                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-2 control-label">Surat Pengantar Pindah Yang Distempel
                                Oleh Lurah</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="pdfFile" name="surat_pengantar_lurah"
                                    required>
                            </div>
                        </div>
                        <!-- Upload PDF -->
                        <div class="form-group">
                            <label for="pdfFile" class="col-sm-2 control-label">KTP</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" id="pdfFile" name="ktp" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Fungsi untuk menambah form baru
        $('#add-form').click(function() {
            const newForm = `
                <div class="form-group row">
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nik_anggota_pindah[]" placeholder="NIK" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="anggota_pindah[]" placeholder="Nama Lengkap" required>
                    </div>
                    <div class="col-sm-1">
                        <button type="button" class="btn btn-danger remove-form">-</button>
                    </div>
                </div>`;
            $('#form-container').append(newForm);
        });

        // Fungsi untuk menghapus form
        $('#form-container').on('click', '.remove-form', function() {
            $(this).closest('.form-group').remove();
        });
    });
    </script>
</body>


</html>