<?php

// require_once("../private/database.php"); // Sambungkan ke database
include('../private/koneksi.php');
session_start();
// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

// Ambil nik dari session pengguna yang login
$nik = $_SESSION['nik'];  // Menyimpan nik pengguna yang login
$user_id_login = $_SESSION['user_id'];  // Menyimpan nik pengguna yang login

// Ambil status berdasarkan NIK pengguna yang login
$sql = "SELECT status FROM perubahan_data_penduduk WHERE nik = ? ORDER BY id DESC LIMIT 5";

// Gunakan prepared statement untuk keamanan
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "s", $nik);
mysqli_stmt_execute($stmt);

// Ambil hasil query
$result = mysqli_stmt_get_result($stmt);
$notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Tutup statement
mysqli_stmt_close($stmt);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_kk = $_POST['no_kk'];
    $nama_lengkap_pemohon = $_POST['nama_pemohon'];
    $nik = $_POST['nik'];
    $jenis_permohonan = $_POST['jenis_permohonan'];
    $alamat_jelas = $_POST['alamat_jelas'];
    $desa_kelurahan_asal = $_POST['desa_asal'];
    $kecamatan_asal = $_POST['kecamatan_asal'];
    $kabupaten_kota_asal = $_POST['kabupaten_asal'];
    $provinsi_asal = $_POST['provinsi_asal'];
    $kode_pos_asal = $_POST['kodepos_asal'];
    $jenis_pindah = $_POST['jenis_pindah'];
    $alamat_pindah = $_POST['alamat_pindah'];
    $desa_kelurahan_pindah = $_POST['desa_pindah'];
    $kecamatan_pindah = $_POST['kecamatan_pindah'];
    $kabupaten_kota_pindah = $_POST['kabupaten_pindah'];
    $provinsi_pindah = $_POST['provinsi_pindah'];
    $kode_pos_pindah = $_POST['kodepos_pindah'];
    $alasan_pindah = $_POST['alasan_pindah'];
    $jenis_kepindahan = $_POST['jenis_kepindahan'];
    $anggota_keluarga_tidak_pindah = isset($_POST['anggota_keluarga_tidak_pindah']) ? implode(", ", $_POST['anggota_keluarga_tidak_pindah']) : '';
    $anggota_keluarga_pindah = isset($_POST['anggota_keluarga_pindah']) ? implode(", ", $_POST['anggota_keluarga_pindah']) : '';
    $status = 'Menunggu';
    $user_id = $user_id_login; // Ganti dengan user_id dari sesi login

    $query = "INSERT INTO surat_pindah_penduduk (
                no_kk, nama_lengkap_pemohon, nik, jenis_permohonan, alamat_jelas, desa_kelurahan_asal, 
                kecamatan_asal, kabupaten_kota_asal, provinsi_asal, kode_pos_asal, jenis_pindah, alamat_pindah, 
                desa_kelurahan_pindah, kecamatan_pindah, kabupaten_kota_pindah, provinsi_pindah, kode_pos_pindah, 
                alasan_pindah, jenis_kepindahan, anggota_keluarga_tidak_pindah, anggota_keluarga_pindah, status, user_id) 
              VALUES (
                '$no_kk', '$nama_lengkap_pemohon', '$nik', '$jenis_permohonan', '$alamat_jelas', '$desa_kelurahan_asal', 
                '$kecamatan_asal', '$kabupaten_kota_asal', '$provinsi_asal', '$kode_pos_asal', '$jenis_pindah', '$alamat_pindah', 
                '$desa_kelurahan_pindah', '$kecamatan_pindah', '$kabupaten_kota_pindah', '$provinsi_pindah', '$kode_pos_pindah', 
                '$alasan_pindah', '$jenis_kepindahan', '$anggota_keluarga_tidak_pindah', '$anggota_keluarga_pindah', '$status', '$user_id')";

    if (mysqli_query($db, $sql)) {
        // Redirect ke halaman sukses atau tampilkan pesan
        header("Location: home-2.php?status=success");
        exit;
    } else {
        echo "<script>alert('Gagal menambahkan data ');</script>";
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

                        <li class="dropdown pull-right relative">
                            <a href="#" class="dropdown-toggle flex items-center gap-2 text-gray-700 hover:text-gray-900" data-toggle="dropdown">
                                <i class="fa fa-bell text-xl"></i>
                                <span class="badge bg-red-500 text-white rounded-full text-xs px-2 py-1">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Menampilkan jumlah notifikasi -->
                            </a>
                            <ul class="dropdown-menu absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 w-72" role="menu" id="notificationDropdown">
                                <?php if (!empty($notifications)): ?>
                                    <?php foreach ($notifications as $notification): ?>
                                        <li class="border-b last:border-none">
                                            <a href="#" class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-md">
                                                <!-- Icon berdasarkan status -->
                                                <span class="bg-blue-500 text-white rounded-full p-2">
                                                    <?php if ($notification['status'] == 'Selesai'): ?>
                                                        <i class="fa fa-check-circle"></i>
                                                    <?php elseif ($notification['status'] == 'Pending'): ?>
                                                        <i class="fa fa-exclamation-circle"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-info-circle"></i>
                                                    <?php endif; ?>
                                                </span>
                                                <!-- Isi notifikasi -->
                                                <div>
                                                    <p class="font-medium text-gray-800">
                                                        Perubahan Data "<span class="font-semibold text-blue-600"><?= htmlspecialchars($notification['status']) ?></span>"
                                                    </p>
                                                    <!-- <span class="text-sm text-gray-500">Klik untuk melihat detail</span> -->
                                                </div>
                                            </a>
                                        </li>
                                        <hr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="p-2 text-center text-gray-500">
                                        <i class="fa fa-info-circle text-lg"></i> Tidak ada notifikasi baru.
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
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
                                <input type="text" class="form-control" id="no_kk" name="no_kk" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nama Lengkap Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-2 control-label">Jenis Permohonan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Jenis Permohonan --</option>
                                    <option value="surat_pindah">Surat Keterangan Pindah</option>
                                    <option value="skpln">Surat Keterangan Pindah Luar Negeri (SKPLN)</option>
                                    <option value="sktt">Surat Keterangan Tempat Tinggal (SKTT)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat_jelas" class="col-sm-2 control-label">Alamat Jelas</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_jelas" name="alamat_jelas"
                                    required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa" name="desa_asal" required></input>
                            </div>
                            <label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan" name="kecamatan_asal" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kebupaten" name="kabupaten_asal" required></input>
                            </div>
                            <label for="provinsi" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi" name="provinsi_asal" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kodepos" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kodepos" name="kodepos_asal" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-3 control-label">Jenis Pindah</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="jenis_permohonan" name="jenis_kepindahan" required>
                                    <option value="">-- Pilih Jenis Pindah --</option>
                                    <option value="surat_pindah">Dalam satu desa/kelurahan atau yang disebut dengan nama
                                        lain</option>
                                    <option value="surat_pindah">Antar desa/kelurahan atau yang disebut dengan nama lain
                                        dalam satu kecamatan</option>
                                    <option value="skpln">Antar kecamatan atau yang disebut dengan nama lain dalam satu
                                        kabupaten/kota</option>
                                    <option value="sktt">Antar kabupaten/kota dalam satu provinsi</option>
                                    <option value="sktt">Antar provinsi</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_pindah" class="col-sm-2 control-label">Alamat Pindah</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_pindah" name="alamat_pindah"
                                    required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa" name="desa_pindah" required></input>
                            </div>
                            <label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan" name="kecamatan_pindah" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kebupaten" name="kabupaten_pindah" required></input>
                            </div>
                            <label for="provinsi" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi" name="provinsi_pindah" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kodepos" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kodepos" name="kodepos_pindah" required></input>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alasan_pindah" class="col-sm-2 control-label">Alasan Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="alasan_pindah" name="alasan_pindah" required>
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
                                <select class="form-control" id="jenis_kepindahan" name="jenis_pindah" required>
                                    <option value="">-- Pilih Jenis Kepindahan --</option>
                                    <option value="kk_baru">Kepala Keluarga</option>
                                    <option value="numpang_kk">Kepala Keluarga dan seluruh Anggota Keluarag</option>
                                    <option value="kk_baru">Kepala Keluarga dan sebagian Anggota Keluarga</option>
                                    <option value="numpang_kk">Anggota Keluarag</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Anggota Keluarga Tidak
                                Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="anggota_keluarga_tidak_pindah" ` required>
                                    <option value="">-- Pilih Anggota Keluarga Tidak Pindah --</option>
                                    <option value="kk_baru">Membuat KK Baru</option>
                                    <option value="numpang_kk">Numpang KK</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Anggota Keluarga yang
                                Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="anggota_keluarga_pindah" required>
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
                            <label for="kabupaten" class="col-sm-1 control-label">No</label>
                            <label for="kabupaten" class="col-sm-3 control-label">NIK</label>
                            <label for="kabupaten" class="col-sm-5 control-label">NAMA LENGKAP</label>
                        </div>

                        <div id="form-container">
                            <!-- Baris pertama form -->
                            <div class="form-group row">
                                <div class="col-sm-1">
                                    <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 1" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 2" required>
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 3" required>
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
                                <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipe_sponsor" class="col-sm-2 control-label">Tipe Sponsor</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tipe_sponsor" name="tipe_sponsor" required>
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
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nomor dan Tanggal ITAS &
                                ITAP</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nomotitap" name="nomotitap" required>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="tanggalitap" name="tanggalitap" required>
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
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Alamat Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_tujuan" name="alamat_tujuan"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Penanggung Jawab</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pindah" class="col-sm-2 control-label">Rencana Tanggal Pindah</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_pindah" name="tanggal_pindah"
                                    required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telepon" class="col-sm-2 control-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="telepon" name="telepon" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" required>
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
                    <div class="col-sm-1">
                        <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 1" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 2" required>
                    </div>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="nama_pemohon[]" placeholder="Col 3" required>
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