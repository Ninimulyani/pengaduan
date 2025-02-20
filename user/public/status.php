<?php
require_once("../private/database.php"); // Sambungkan ke database
session_start(); // Memulai session

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

$user_id = $_SESSION['user_id']; // Ambil user_id dari session

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
$query_akta_kematian = "SELECT * FROM akta_kematian WHERE user_id = :user_id";
$stmt_akta_kematian = $db->prepare($query_akta_kematian);
$stmt_akta_kematian->bindParam(':user_id', $user_id, PDO::PARAM_INT);
$stmt_akta_kematian->execute();
$data_kematian = $stmt_akta_kematian->fetchAll(PDO::FETCH_ASSOC);


// Query untuk mendapatkan data dari tabel pemohon berdasarkan NIK
$query_pemohon = "SELECT * FROM pemohon WHERE user_id = :user_id";
$stmt_pemohon = $db->prepare($query_pemohon);
$stmt_pemohon->bindParam(':user_id', $user_id, PDO::PARAM_STR); // Gunakan PARAM_STR karena NIK biasanya berupa string
$stmt_pemohon->execute();
$data_pemohon = $stmt_pemohon->fetchAll(PDO::FETCH_ASSOC); // Gunakan fetch() karena hanya satu data yang diambil
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
    padding: 15px;
}

.card-body .btn {
    /* Hapus position: absolute; */
    position: static;
    /* Tambahkan margin agar lebih rapi */
    margin-top: 10px;
}

.action-container {
    display: flex;
    align-items: center;
    /* Agar tombol dan status badge sejajar */
    gap: 10px;
    /* Beri jarak antar elemen */
    margin-top: 15px;
    /* Tambahkan margin agar tidak menempel dengan teks di atas */
}

.status-badge {

    display: inline-block;
    padding: 5px 10px;
    border-radius: 15px;
    color: white;
    font-size: 14px;
    margin-top: 10px;
    /* Menambahkan jarak ke atas */
}

.diproses {
    background-color: rgb(42, 166, 248);
}

.tolak {
    background-color: rgb(235, 0, 0);
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

.navbar {
    width: 100%;
    margin: 0;
    padding: 0;
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
                    <button type="button" class="btn button-green" onclick="location.href='home-2.php';"
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
                    <br>
                    <h2 class="text-center h1-custom">Status Anda</h2>
                    <!-- Social Media Feed -->
                    <div class="col-md-12">
                        <!-- Container flex untuk card -->
                        <?php if (!empty($data_pemohon)): ?>
                        <br>
                        <h3 class="text-center h3-custom">Perubahan Data Penduduk</h3>
                        <hr class="custom-line" />
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <?php foreach ($data_pemohon as $data): ?>
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                </h3>
                                                <h5 class="card-subtitle mb-2">Nama Lengkap:
                                                    <?= htmlspecialchars($data['nama'] ?? 'Tidak Diketahui'); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text mb-1">Nomor KK:
                                                    <?= htmlspecialchars($data['no_kk'] ?? '-'); ?></p>
                                                <p class="card-text mb-1">NIK:
                                                    <?= htmlspecialchars($data['nik'] ?? '-'); ?></p>

                                                <?php if (!empty($data['dokumen_pemohon'])): ?>
                                                <?php 
                                                // Decode JSON ke dalam array
                                                $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true); 

                                                if (!empty($dokumen_pemohon)) : ?>
                                                <div>
                                                    <?php foreach ($dokumen_pemohon as $dokumen): ?>
                                                    <a href="../../perubahan_data/<?= rawurlencode($dokumen); ?>"
                                                        target="_blank" class="btn btn-primary mt-2">
                                                        <i class="fa fa-external-link"></i> <?= basename($dokumen); ?>
                                                    </a>
                                                    <br> <!-- Pindah baris agar rapi -->
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>

                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>


                                                <?php if (isset($data['status'])): ?>
                                                <p class="card-text">
                                                    <?php if ($data['status'] == "Selesai"): ?>
                                                    <span class="status-badge selesai mt-5" onclick="showSelesai()">
                                                        <i class="fa fa-check-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Menunggu"): ?>
                                                    <span class="status-badge menunggu" onclick="showMenunggu()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Sedang diProses"): ?>
                                                    <span class="status-badge diproses" onclick="showSedangDiproses()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Ditolak"): ?>
                                                    <!-- Tombol untuk menampilkan pop-up -->
                                                    <span class="status-badge tolak"
                                                        onclick="showAlasanDitolak('<?= htmlspecialchars($data['alasan_ditolak']); ?>')">
                                                        <i class="fa fa-times-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </p>
                                                <?php else: ?>
                                                <p class="text-muted">Status tidak tersedia.</p>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>

                        <?php if (!empty($data_anak)): ?>
                        <div class="col-md-12">
                            <br>
                            <h3 class="text-center h3-custom">Kartu Identitas Anak</h3>
                            <hr class="custom-line" />
                            <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                                <?php foreach ($data_anak as $data): ?>
                                <div class="col-md-4 mb-3">
                                    <div class="box">
                                        <div class="info">
                                            <div cla ss="card">
                                                <div class="card-header">
                                                    <h5 class="card-subtitle mb-2"></h5>
                                                </div>
                                                <div class="card-body">
                                                    <p class="card-text mb-1">NIK:
                                                        <?= htmlspecialchars($data['nik_anak']); ?></p>
                                                    <p class="card-text mb-1">Nama Lengkap:
                                                        <?= htmlspecialchars($data['nama_anak']); ?></p>
                                                    <p class="card-text mb-1">Tanggal Lahir:
                                                        <?= htmlspecialchars($data['tanggal_lahir']); ?></p>

                                                    <div class="card-text">
                                                        <?php if (!empty($data['dokumen_pemohon'])): ?>
                                                        <?php 
                                                        // Decode JSON ke dalam array
                                                        $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true); 

                                                        if (!empty($dokumen_pemohon)) : ?>
                                                        <div>
                                                            <?php foreach ($dokumen_pemohon as $dokumen): ?>
                                                            <a href="../../data-kartu-indentitas-anak/<?= rawurlencode($dokumen); ?>"
                                                                target="_blank" class="btn btn-primary mt-2">
                                                                <i class="fa fa-external-link"></i>
                                                                <?= basename($dokumen); ?>
                                                            </a>
                                                            <br> <!-- Agar tiap dokumen tampil di baris baru -->
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>

                                                        <?php else: ?>
                                                        <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                        <?php endif; ?>


                                                        <p class="card-text">
                                                            <?php if ($data['status'] == "Selesai"): ?>
                                                            <span class="status-badge selesai" onclick="showSelesai()">
                                                                <i class="fa fa-check-circle"></i>
                                                                <?= htmlspecialchars($data['status']); ?>
                                                            </span>
                                                            <?php elseif ($data['status'] == "Menunggu"): ?>
                                                            <span class="status-badge menunggu"
                                                                onclick="showMenunggu()">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?= htmlspecialchars($data['status']); ?>
                                                            </span>
                                                            <?php elseif ($data['status'] == "Sedang diProses"): ?>
                                                            <span class="status-badge diproses"
                                                                onclick="showSedangDiproses()">
                                                                <i class="fa fa-hourglass-half"></i>
                                                                <?= htmlspecialchars($data['status']); ?>
                                                            </span>
                                                            <?php elseif ($data['status'] == "Ditolak"): ?>
                                                            <!-- Tombol untuk menampilkan pop-up -->
                                                            <span class="status-badge tolak"
                                                                onclick="showAlasanDitolak('<?= htmlspecialchars($data['alasan_ditolak']); ?>')">
                                                                <i class="fa fa-times-circle"></i>
                                                                <?= htmlspecialchars($data['status']); ?>
                                                            </span>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                </div>



                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <?php endif; ?>

                    </div>

                    <?php if (!empty($akta_kelahiran)): ?>
                    <div class="col-md-12">
                        <br>
                        <h3 class="text-center h3-custom">Status Akta Kelahiran</h3>
                        <hr class="custom-line" />
                        <div class="d-flex flex-wrap gap-3" style="padding-left: 20px;">
                            <?php foreach ($akta_kelahiran as $data): ?>
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-subtitle mb-2">Nama Lengkap:
                                                    <?= htmlspecialchars($data['nama_anak']); ?></h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text mb-1">Jenis Kelamin:
                                                    <?= htmlspecialchars($data['jk_anak']); ?></p>
                                                <p class="card-text mb-1">Tanggal Lahir:
                                                    <?= htmlspecialchars($data['tanggal_lahir_anak']); ?></p>
                                                <?php if (!empty($data['dokumen_pemohon'])): ?>
                                                <?php 
                                                // Decode JSON ke dalam array
                                                $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true); 

                                                if (!empty($dokumen_pemohon)) : ?>
                                                <div>
                                                    <?php foreach ($dokumen_pemohon as $dokumen): ?>
                                                    <a href="../../data-akta-kelahiran/<?= rawurlencode($dokumen); ?>"
                                                        target="_blank" class="btn btn-primary mt-2">
                                                        <i class="fa fa-external-link"></i> <?= basename($dokumen); ?>
                                                    </a>
                                                    <br> <!-- Agar tiap dokumen tampil di baris baru -->
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>

                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>

                                                <p class="card-text">
                                                    <?php if ($data['status'] == "Selesai"): ?>
                                                    <span class="status-badge selesai" onclick="showSelesai()">
                                                        <i class="fa fa-check-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Menunggu"): ?>
                                                    <span class="status-badge menunggu" onclick="showMenunggu()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Sedang diProses"): ?>
                                                    <span class="status-badge diproses" onclick="showSedangDiproses()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Ditolak"): ?>
                                                    <!-- Tombol untuk menampilkan pop-up -->
                                                    <span class="status-badge tolak"
                                                        onclick="showAlasanDitolak('<?= htmlspecialchars($data['alasan_ditolak']); ?>')">
                                                        <i class="fa fa-times-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>


                    <?php if (!empty($surat_pindah_penduduk)): ?>
                    <div class="col-md-12">
                        <br>
                        <h3 class="text-center h3-custom">Status Surat Pindah Penduduk</h3>
                        <hr class="custom-line" />

                        <div class="row" style="padding-left: 20px;">
                            <?php foreach ($surat_pindah_penduduk as $data): ?>
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-subtitle mb-2">Nama Lengkap Pemohon:
                                                    <?= htmlspecialchars($data['nama_lengkap_pemohon'] ?? 'Tidak Diketahui'); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text mb-1">Alamat Jelas:
                                                    <?= htmlspecialchars($data['jenis_permohonan'] ?? '-'); ?></p>
                                                <p class="card-text mb-1">Alamat Pindah:
                                                    <?= htmlspecialchars($data['alamat_pindah'] ?? '-'); ?></p>
                                                <p class="card-text mb-1">No Hp:
                                                    <?= htmlspecialchars($data['nomor_handphone'] ?? '-'); ?></p>

                                                <?php if (!empty($data['dokumen_pemohon'])): ?>
                                                <?php 
                                                // Decode JSON ke dalam array
                                                $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true); 

                                                if (!empty($dokumen_pemohon)) : ?>
                                                <div>
                                                    <?php foreach ($dokumen_pemohon as $dokumen): ?>
                                                    <a href="../../data-surat-pindah-penduduk/<?= rawurlencode($dokumen); ?>"
                                                        target="_blank" class="btn btn-primary mt-2">
                                                        <i class="fa fa-external-link"></i> <?= basename($dokumen); ?>
                                                    </a>
                                                    <br> <!-- Supaya setiap file tampil di baris baru -->
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>

                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>


                                                <p class="card-text">
                                                    <?php if ($data['status'] == "Selesai"): ?>
                                                    <span class="status-badge selesai mt-5" onclick="showSelesai()">
                                                        <i class="fa fa-check-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Menunggu"): ?>
                                                    <span class="status-badge menunggu" onclick="showMenunggu()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Sedang diProses"): ?>
                                                    <span class="status-badge diproses" onclick="showSedangDiproses()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Ditolak"): ?>
                                                    <!-- Tombol untuk menampilkan pop-up -->
                                                    <span class="status-badge tolak"
                                                        onclick="showAlasanDitolak('<?= htmlspecialchars($data['alasan_ditolak']); ?>')">
                                                        <i class="fa fa-times-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php else: ?>
                    <!-- Tidak ada data, tidak menampilkan apa pun -->
                    <?php endif; ?>


                    <?php if (!empty($data_kematian)): ?>
                    <div class="col-md-12">
                        <br>
                        <h3 class="text-center h3-custom">Status Akta Kematian</h3>
                        <hr class="custom-line" />

                        <div class="row" style="padding-left: 20px;">
                            <?php foreach ($data_kematian as $data): ?>
                            <div class="col-md-4 mb-3">
                                <div class="box">
                                    <div class="info">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-subtitle mb-2">Nama Lengkap Almarhum:
                                                    <?= htmlspecialchars($data['nama_lengkap_alm'] ?? 'Tidak Diketahui'); ?>
                                                </h5>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text mb-1">Sebab Kematian:
                                                    <?= htmlspecialchars($data['sebab_kematian'] ?? '-'); ?></p>
                                                <p class="card-text mb-1">Tanggal Kematian:
                                                    <?= htmlspecialchars($data['hari_tanggal_kematian'] ?? '-'); ?></p>

                                                <?php if (!empty($data['dokumen_pemohon'])): ?>
                                                <?php 
                                                // Decode JSON ke dalam array
                                                $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true); 

                                                if (!empty($dokumen_pemohon)) : ?>
                                                <div>
                                                    <?php foreach ($dokumen_pemohon as $dokumen): ?>
                                                    <a href="../../data-akta-kematian/<?= rawurlencode($dokumen); ?>"
                                                        target="_blank" class="btn btn-primary mt-2">
                                                        <i class="fa fa-external-link"></i> <?= basename($dokumen); ?>
                                                    </a>
                                                    <br> <!-- Supaya setiap file tampil di baris baru -->
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>

                                                <?php else: ?>
                                                <p class="text-muted">Tidak ada dokumen tersedia.</p>
                                                <?php endif; ?>


                                                <p class="card-text">
                                                    <?php if ($data['status'] == "Selesai"): ?>
                                                    <span class="status-badge selesai mt-5" onclick="showSelesai()">
                                                        <i class="fa fa-check-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Menunggu"): ?>
                                                    <span class="status-badge menunggu" onclick="showMenunggu()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Sedang diProses"): ?>
                                                    <span class="status-badge diproses" onclick="showSedangDiproses()">
                                                        <i class="fa fa-hourglass-half"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php elseif ($data['status'] == "Ditolak"): ?>
                                                    <!-- Tombol untuk menampilkan pop-up -->
                                                    <span class="status-badge tolak"
                                                        onclick="showAlasanDitolak('<?= htmlspecialchars($data['alasan_ditolak']); ?>')">
                                                        <i class="fa fa-times-circle"></i>
                                                        <?= htmlspecialchars($data['status']); ?>
                                                    </span>
                                                    <?php endif; ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>


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
                        kecamatan.tanralili1@gmail.com
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

    <!-- Tambahkan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function showAlasanDitolak(alasan) {
        Swal.fire({
            icon: 'error',
            title: 'Data Ditolak',
            text: alasan ? alasan : 'Tidak ada alasan yang diberikan.',
            confirmButtonText: 'OK'
        });
    }
    </script>
    <script>
    function showMenunggu() {
        Swal.fire({
            icon: 'info',
            title: 'Menunggu',
            text: 'Silakan menunggu admin memproses permohonan anda.',
            confirmButtonText: 'OK'
        });
    }

    function showSedangDiproses() {
        Swal.fire({
            icon: 'info',
            title: 'Data Sedang Diproses',
            text: 'Silakan menunggu hingga proses selesai.',
            confirmButtonText: 'OK'
        });
    }

    function showSelesai() {
        Swal.fire({
            icon: 'success',
            title: 'Data Anda Telah Selesai',
            text: 'Silakan Mengunduh file di lihat Dokumen.',
            confirmButtonText: 'OK'
        });
    }
    </script>

</body>

</html>