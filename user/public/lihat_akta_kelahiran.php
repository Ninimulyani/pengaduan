<?php
require_once("../private/database.php"); // Sambungkan ke database
session_start(); // Memulai session

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login-user.php");
    exit();
}

// Ambil ID dari URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mendapatkan detail laporan akta kelahiran berdasarkan ID
    $statement = $db->prepare("SELECT * FROM akta_kelahiran WHERE id = :id");
    $statement->bindParam(':id', $id, PDO::PARAM_INT); // Bind ID dengan tipe integer
    $statement->execute();

    // Ambil hasil query
    $data = $statement->fetch(PDO::FETCH_ASSOC);
    
    if (!$data) {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "ID tidak ditemukan.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantor Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" type="image/png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
</head>

<style>
.navbar {
    width: 100%;
    margin: 0;
    padding: 0;
}

.carousel-inner .item img {
    width: 100%;
    height: 500px;
    object-fit: cover;
}

.carousel-control {
    display: flex;
    align-items: center;
    justify-content: center;
    top: 50%;
    transform: translateY(-50%);
    width: 50px;
    height: 50px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
}

.carousel-control .bi {
    font-size: 24px;
    color: #fff;
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
        js.src = 'https://connect.facebook.net/id_ID/sdk.js';
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    </script>

    <!-- Modal -->
    <div class="modal fade" id="successmodalclear" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content bg-2">
                <div class="modal-header">
                    <h4 class="modal-title text-center text-green" id="successModalLabel">Sukses</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center">Pengajuan Berhasil Dikirim</p>
                    <p class="text-center">Untuk Mengetahui Status Pengajuan</p>
                    <p class="text-center">Silahkan Buka Menu <a href="status.php">STATUS</a></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn button-green" onclick="location.href='home';"
                        data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($_GET['status'])): ?>
    <script type="text/javascript">
    $("#successmodalclear").modal();
    </script>
    <?php endif; ?>

    <!-- Navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top form-shadow">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#navbar-collapse" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">
                    <img alt="Brand" src="images/logomaros.png" width="50">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <li><a href="home-2.php">HOME</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">LAYANAN <span
                                class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="akta_kelahiran.php">Akta Kelahiran</a></li>
                            <li class="divider"></li>
                            <li><a href="kartu_identitas_anak.php">Kartu Identitas Anak</a></li>
                            <li class="divider"></li>
                            <li><a href="akta_kematian.php">Akta Kematian</a></li>
                            <li class="divider"></li>
                            <li><a href="perubahan_data_penduduk.php">Perubahan Data Penduduk</a></li>
                            <li class="divider"></li>
                            <li><a href="surat_pindah_penduduk.php">Surat Pindah Penduduk</a></li>
                        </ul>
                    </li>
                    <li class="active"><a href="status.php">STATUS</a></li>
                    <li><a href="cara-2.php">CARA</a></li>
                    <li><a href="profildinas-2.php">PROFIL DINAS</a></li>
                    <li><a href="faq-2.php">FAQ</a></li>
                    <li><a href="bantuan-2.php">BANTUAN</a></li>
                    <li><a href="kontak-2.php">KONTAK</a></li>
                    <li><a href="login-user.php">LOGOUT</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <h2 class="text-center mb-4">Detail Akta Kelahiran</h2>
        <div class="card">
            <div class="card-shadow form-custom p-4">
                <h5 class="card-title mb-3">Detail Laporan Akta Kelahiran</h5>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Pelapor</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_pelapor']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIK Pelapor</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nik_pelapor']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Dokumen Perjalanan</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['nomor_dokumen_perjalanan']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Kartu Keluarga Pelapor</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['nomor_kartu_keluarga_pelapor']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kewarganegaraan Pelapor</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['kewarganegaraan_pelapor']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Handphone</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nomor_handphone']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Email</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['email']); ?></p>
                    </div>
                </div>

                <!-- Data Saksi 1 -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Saksi 1</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_saksi_1']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIK Saksi 1</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nik_saksi_1']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor Kartu Keluarga Saksi 1</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['nomor_kartu_keluarga_saksi_1']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kewarganegaraan Saksi 1</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['kewarganegaraan_saksi_1']); ?></p>
                    </div>
                </div>

                <!-- Data Informasi Ayah -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Ayah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_ayah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIK Ayah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nik_ayah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Lahir Ayah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tempat_lahir_ayah']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir Ayah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tanggal_lahir_ayah']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kewarganegaraan Ayah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kewarganegaraan_ayah']); ?>
                        </p>
                    </div>
                </div><!-- Data Informasi Ibu -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Ibu</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_ibu']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIK Ibu</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nik_ibu']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Lahir Ibu</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tempat_lahir_ibu']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir Ibu</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tanggal_lahir_ibu']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kewarganegaraan Ibu</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kewarganegaraan_ibu']); ?>
                        </p>
                    </div>
                </div>

                <!-- Data Informasi Anak -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Anak</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_anak']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelamin Anak</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['jk_anak']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tempat Lahir Anak</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tempat_lahir']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal Lahir Anak</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tanggal_lahir_anak']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Pukul Kelahiran</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['pukul']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kelahiran</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['jenis_kelahiran']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kelahiran Ke</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kelahiran_ke']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Penolong Kelahiran</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['penolong_kelahiran']); ?>
                        </p>
                    </div>
                </div>
                <!-- Data Berat dan Panjang Bayi -->
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Berat Bayi (BB)</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['bb_bayi']); ?> kg</p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Panjang Bayi (PB)</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['pb']); ?> cm</p>
                    </div>
                </div>
                <!-- Data Dokumen & Status -->
                <h4 class="mt-3 mb-2">Dokumen & Status</h4>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Dokumen</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['dokumen']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Status</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['status']); ?></p>
                    </div>
                </div>

                <!-- Tombol Kembali ke Status -->
                <div class="form-group row">
                    <div class="col-sm-12">
                        <a href="status.php" class="btn btn-primary">Kembali ke Status</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>