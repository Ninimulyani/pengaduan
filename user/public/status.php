<?php
require_once("../private/database.php"); // Sambungkan ke database
session_start(); // Memulai session

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session
$nik = $_SESSION['nik']; // Ambil user_id dari session

// Ambil status berdasarkan nik pengguna yang login
$sql = "SELECT status FROM perubahan_data_penduduk WHERE nik = :nik ORDER BY id DESC LIMIT 5"; // Menampilkan 5 status terbaru
$stmt = $db->prepare($sql);
$stmt->execute(['nik' => $nik]);  // Bind nilai nik pada parameter :nik
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel data_anak
$query_data_anak = "SELECT * FROM data_anak WHERE user_id = :user_id";
$stmt_data_anak = $db->prepare($query_data_anak);
$stmt_data_anak->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_data_anak->execute();
$data_anak = $stmt_data_anak->fetchAll(PDO::FETCH_ASSOC);

// Query untuk mendapatkan data dari tabel akta_kelahiran
$query_akta_kelahiran = "SELECT * FROM akta_kelahiran WHERE user_id = :user_id";
$stmt_akta_kelahiran = $db->prepare($query_akta_kelahiran);
$stmt_akta_kelahiran->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_akta_kelahiran->execute();
$akta_kelahiran = $stmt_akta_kelahiran->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel akta_kelahiran
$query_surat_pindah_penduduk = "SELECT * FROM surat_pindah_penduduk WHERE user_id = :user_id";
$stmt_surat_pindah_penduduk = $db->prepare($query_surat_pindah_penduduk);
$stmt_surat_pindah_penduduk->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_surat_pindah_penduduk->execute();
$surat_pindah_penduduk = $stmt_surat_pindah_penduduk->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel akta_kematian
$query_akta_kematian = "SELECT * FROM akta_kematian WHERE nik_pelapor = :nik";
$stmt_akta_kematian = $db->prepare($query_akta_kematian);
$stmt_akta_kematian->bindParam(':nik', $nik, PDO::PARAM_INT);
$stmt_akta_kematian->execute();
$data_kematian = $stmt_akta_kematian->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel pemohon berdasarkan NIK
$query_pemohon = "SELECT * FROM pemohon WHERE user_id = :user_id";
$stmt_pemohon = $db->prepare($query_pemohon);
$stmt_pemohon->bindParam(':user_id', $user_id, PDO::PARAM_STR); // Gunakan PARAM_STR karena NIK biasanya berupa string
$stmt_pemohon->execute();
$data_pemohon = $stmt_pemohon->fetch(PDO::FETCH_ASSOC); // Gunakan fetch() karena hanya satu data yang diambil


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
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<style>
.card-body {
    position: relative;
    /* Menjadikan card-body sebagai konteks untuk posisi absolut */
}

.card-body .btn {
    position: absolute;
    /* Menempatkan tombol di posisi absolut */
    top: 10px;
    /* Mengatur jarak dari atas */
    right: 10px;
    /* Mengatur jarak dari kanan */
}

.navbar {
    width: 100%;
    margin: 0;
    padding: 0;
}

.status-badge {
    display: inline-block;
    padding: 5px 10px;
    border-radius: 15px;
    /* font-weight: bold; */
    color: white;
}

.selesai {
    background-color: #28a745;
    /* Hijau */
}

.menunggu {
    background-color: rgb(235, 176, 0);
    /* Kuning */
    color: white;
}

.carousel-inner .item img {
    width: 100%;
    /* Memastikan gambar memenuhi lebar kontainer carousel */
    height: 500px;
    /* Atur tinggi tetap agar seragam */
    object-fit: cover;
    /* Memastikan gambar tetap proporsional dan mengisi area */
}

.carousel-control {
    display: flex;
    align-items: center;
    /* Pusatkan secara vertikal */
    justify-content: center;
    /* Pusatkan secara horizontal */
    top: 50%;
    /* Atur posisi di tengah secara vertikal */
    transform: translateY(-50%);
    /* Geser ke atas 50% dari ukurannya untuk pusatkan */
    width: 50px;
    /* Ukuran lebar tombol navigasi */
    height: 50px;
    /* Tinggi tombol navigasi */
    background-color: rgba(0, 0, 0, 0.5);
    /* Latar belakang semi transparan */
    border-radius: 50%;
    /* Buat tombol berbentuk bulat */
}

.carousel-control .bi {
    font-size: 24px;
    /* Ukuran ikon */
    color: #fff;
    /* Warna ikon */
}
</style>

<body style="width:100%; margin:0; overflow-x: hidden;">
    <div id="fb-root"></div>
    <script>
    (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = 'https://www.facebook.com/profile.php?id=61555707727963&';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

    <!--Success Modal Saved-->
    <div class="modal fade" id="successmodalclear" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm " role="document">
            <div class="modal-content bg-2">
                <div class="modal-header ">
                    <h4 class="modal-title text-center text-green">Sukses</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Pengajuan Berhasil Di Kirim</p>
                    <p class="text-center">Untuk Mengetahui Status Pengajuan</p>
                    <p class="text-center">Silahkan Buka Menu <a href="status.php">STATUS</a> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn button-green" onclick="location.href='home';"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['status'])) {
    ?>
    <script type="text/javascript">
    $("#successmodalclear").modal();
    </script>
    <?php
    }
    ?>
    <!-- body -->
    <div class="shadow">
        <!-- navbar -->

        <nav class="navbar navbar-inverse navbar-fixed form-shadw">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="">
                        <img alt="Brand" src="images/logomaros.png" width="50">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
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
                        <li class="active"><a href="status.php">STATUS</a></li>
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
                            <a href="#"
                                class="dropdown-toggle flex items-center gap-2 text-gray-700 hover:text-gray-900"
                                data-toggle="dropdown">
                                <i class="fa fa-bell text-xl"></i>
                                <span class="badge bg-red-500 text-white rounded-full text-xs px-2 py-1">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Menampilkan jumlah notifikasi -->
                            </a>
                            <ul class="dropdown-menu absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 w-72"
                                role="menu" id="notificationDropdown">
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
                                                Perubahan Data "<span
                                                    class="font-semibold text-blue-600"><?= htmlspecialchars($notification['status']) ?></span>"
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
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>

        <!-- end navbar -->


        <!-- content -->
        <div class="main-content">
            <div class="section">
                <div class="row">
                    <!-- Social Media Feed -->
                    <div class="col-md-12">
                        <br>
                        <h3 class="text-center h3-custom">Status Perubahan Data</h3>
                        <hr class="custom-line" />

                        <!-- Container flex untuk card -->
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <?php if ($data_pemohon): ?>
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <h3 style="text-transform: capitalize;">
                                                    <?php echo htmlspecialchars($data_pemohon['jenis_permohonan'] ?? 'Tidak Diketahui'); ?>
                                                </h3>
                                                <h5 class="card-subtitle mb-2">Nama Lengkap:
                                                    <?php echo htmlspecialchars($data_pemohon['nama'] ?? 'Tidak Diketahui'); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="card-text mb-1">Nomor KK:
                                                            <?php echo htmlspecialchars($data_pemohon['no_kk'] ?? '-'); ?>
                                                        </p>
                                                        <p class="card-text mb-1">NIK:
                                                            <?php echo htmlspecialchars($data_pemohon['nik'] ?? '-'); ?>
                                                        </p>

                                                        <?php if (!empty($data_pemohon['dokumen'])): ?>
                                                        <a href="../../perubahan_data/uploads/<?php echo rawurlencode($data_pemohon['dokumen']); ?>"
                                                            target="_blank" class="btn btn-primary mt-2">
                                                            <i class="fa fa-external-link"></i> Lihat Dokumen
                                                        </a>
                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>

                                                        <?php if (isset($data_pemohon['status'])): ?>
                                                        <?php if ($data_pemohon['status'] == "Selesai"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge selesai mt-5">
                                                                <i class="fa fa-check-circle"></i>
                                                                <?php echo htmlspecialchars($data_pemohon['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php elseif ($data_pemohon['status'] == "Menunggu Konfirmasi"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge menunggu">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?php echo htmlspecialchars($data_pemohon['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php endif; ?>
                                                        <?php else: ?>
                                                        <p class="text-muted">Status tidak tersedia.</p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php else: ?>
                            <p class="text-center w-100">Belum ada status laporan perubahan data penduduk.</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <!-- Ubah dari col-md-4 menjadi col-md-12 -->
                        <br>
                        <h3 class="text-center h3-custom">Status Akta Kelahiran</h3>
                        <hr class="custom-line" />

                        <!-- Tambahkan container flex untuk card -->
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <!-- Tambahkan class flex-wrap dan gap-3 -->
                            <?php if ($akta_kelahiran): ?>
                            <?php foreach ($akta_kelahiran as $data): ?>
                            <!-- Setiap card dalam col-md-4 -->
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h3 style="text-transform: capitalize;"><?php echo htmlspecialchars($data['jenis_permohonan']); ?></h3> -->
                                                <h5 class="card-subtitle mb-2">Nama Lengkap:
                                                    <?php echo htmlspecialchars($data['nama_anak']); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="card-text mb-1">Jenis Kelamin:
                                                            <?php echo htmlspecialchars($data['jk_anak']); ?>
                                                        </p>
                                                        <p class="card-text mb-1">Tanggal Lahir:
                                                            <?php echo htmlspecialchars($data['tanggal_lahir_anak']); ?>
                                                        </p>
                                                        <?php if (!empty($data['dokumen'])): ?>
                                                        <a href="../../data-akta-kelahiran/uploads/<?php echo rawurlencode($data['dokumen_admin']); ?>"
                                                            target="_blank" style="position:relative;"
                                                            class="btn btn-primary mt-2">
                                                            <i class="fa fa-external-link"></i> Lihat Dokumen
                                                        </a>
                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>

                                                        <?php if ($data['status'] == "Selesai"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge selesai mt-5"
                                                                style="margin-top:20px;">
                                                                <i class="fa fa-check-circle"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php elseif ($data['status'] == "Menunggu Konfirmasi"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge menunggu">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php endif; ?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <p class="text-center w-100">Belum ada status laporan akta kelahiran.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Ubah dari col-md-4 menjadi col-md-12 -->
                        <br>
                        <h3 class="text-center h3-custom">Status Surat Pindah Penduduk</h3>
                        <hr class="custom-line" />

                        <!-- Tambahkan container flex untuk card -->
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <!-- Tambahkan class flex-wrap dan gap-3 -->
                            <?php if ($surat_pindah_penduduk): ?>
                            <?php foreach ($surat_pindah_penduduk as $data): ?>
                            <!-- Setiap card dalam col-md-4 -->
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h3 style="text-transform: capitalize;"><?php echo htmlspecialchars($data['jenis_permohonan']); ?></h3> -->
                                                <h5 class="card-subtitle mb-2">Nama Lengkap Pemohon:
                                                    <?php echo htmlspecialchars($data['nama_lengkap_pemohon']); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="card-text mb-1">Alamat Jelas:
                                                            <?php echo htmlspecialchars($data['jenis_permohonan']); ?>
                                                        </p>
                                                        <p class="card-text mb-1">Alamat Pindah:
                                                            <?php echo htmlspecialchars($data['alamat_pindah']); ?>
                                                        </p>
                                                        <p class="card-text mb-1">No Hp:
                                                            <?php echo htmlspecialchars($data['nomor_handphone']); ?>
                                                        </p>
                                                        <?php if (!empty($data['dokumen'])): ?>
                                                        <a href="../../data-surat-pindah-penduduk/uploads/<?php echo rawurlencode(str_replace('uploads/', '', $data['dokumen'])); ?>"
                                                            target="_blank" style="position:relative;"
                                                            class="btn btn-primary mt-2">

                                                            <i class="fa fa-external-link"></i> Lihat Dokumen
                                                        </a>
                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>

                                                        <?php if ($data['status'] == "Selesai"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge selesai mt-5"
                                                                style="margin-top:20px;">
                                                                <i class="fa fa-check-circle"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php elseif ($data['status'] == "Menunggu Konfirmasi"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge menunggu">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php endif; ?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <p class="text-center w-100">Belum ada status laporan akta kelahiran.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <!-- Ubah dari col-md-4 menjadi col-md-12 -->
                        <br>
                        <h3 class="text-center h3-custom">Status Akta Kematian</h3>
                        <hr class="custom-line" />

                        <!-- Tambahkan container flex untuk card -->
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <!-- Tambahkan class flex-wrap dan gap-3 -->
                            <?php if ($data_kematian): ?>
                            <?php foreach ($data_kematian as $data): ?>
                            <!-- Setiap card dalam col-md-4 -->
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <!-- <h3 style="text-transform: capitalize;"><?php echo htmlspecialchars($data['jenis_permohonan']); ?></h3> -->
                                                <h5 class="card-subtitle mb-2">Nama Lengkap Almarhum:
                                                    <?php echo htmlspecialchars($data['nama_lengkap_alm']); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <p class="card-text mb-1">Sebab Kematian:
                                                            <?php echo htmlspecialchars($data['sebab_kematian']); ?>
                                                        </p>
                                                        <p class="card-text mb-1">Tanggal Kematian:
                                                            <?php echo htmlspecialchars($data['hari_tanggal_kematian']); ?>
                                                        </p>
                                                        <?php if (!empty($data['dokumen'])): ?>
                                                        <a href="../../data-akta-kematian/uploads/<?php echo rawurlencode($data['dokumen']); ?>"
                                                            target="_blank" style="position:relative;"
                                                            class="btn btn-primary mt-2">
                                                            <i class="fa fa-external-link"></i> Lihat Dokumen
                                                        </a>
                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>

                                                        <?php if ($data['status'] == "Selesai"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge selesai mt-5"
                                                                style="margin-top:20px;">
                                                                <i class="fa fa-check-circle"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php elseif ($data['status'] == "Menunggu Konfirmasi"): ?>
                                                        <p class="card-text">
                                                            <span class="status-badge menunggu">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?php echo htmlspecialchars($data['status']); ?>
                                                            </span>
                                                        </p>
                                                        <?php endif; ?>


                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <?php else: ?>
                            <p class="text-center w-100">Belum ada status laporan akta kelahiran.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <a id="top" href="#" onclick="topFunction()">
                <i class="fa fa-arrow-circle-up"></i>
            </a>
        </div>

        <!-- Tambahkan CSS -->
        <style>
        .d-flex.flex-wrap {
            display: flex;
            flex-wrap: wrap;
            margin: -10px;
            /* Compensate for card padding */
        }

        .col-md-4 {
            padding: 10px;
            flex: 0 0 33.333333%;
        }

        .card {
            height: 100%;
            margin: 0;
        }

        @media (max-width: 768px) {
            .col-md-4 {
                flex: 0 0 100%;
            }
        }
        </style>
        <!-- end main-content -->

        <!-- Footer -->
        <footer class="footer text-center">
            <div class="row">
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-map-marker"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kantor</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        Jl. Poros Ammarrang, Kelurahan Borong,
                        <br>Kecamatan Tanralili, Kabupaten Maros, Sulawesi Selatan
                    </p>
                </div>
                <div class="col-md-4 mb-5 mb-lg-0">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-rss"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Sosial Media</h4>
                        </li>
                    </ul>
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                href="https://www.facebook.com/1607792839472522?ref=embed_page">
                                <i class="fa fa-fw fa-facebook"></i>
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline-light btn-social text-center rounded-circle"
                                href="https://x.com/Kel_Tamalanrea?s=20">
                                <i class="fa fa-fw fa-twitter"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <i class="fa fa-top fa-envelope-o"></i>
                        </li>
                        <li class="list-inline-item">
                            <h4 class="text-uppercase mb-4">Kontak</h4>
                        </li>
                    </ul>
                    <p class="mb-0">
                        90553 <br>
                        kelurahan.tamalanrea@gmail.com
                    </p>
                </div>
            </div>
        </footer>
        <!-- /footer -->

        <div class="copyright py-4 text-center text-white">
            <div class="container">
                <small> | Copyright &copy; Kantor Kecamatan Tanralili </small>
            </div>
        </div>
        <!-- shadow -->
    </div>

</body>

</html>