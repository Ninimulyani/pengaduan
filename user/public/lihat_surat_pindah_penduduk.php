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
    $statement = $db->prepare("SELECT * FROM surat_pindah_penduduk  WHERE id = :id");
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
                    <label class="col-sm-3 col-form-label">Nomor KK</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['no_kk']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Lengkap Pemohon</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_lengkap_pemohon']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">NIK Pemohon</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nik_pemohon']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Permohonan</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['jenis_permohonan']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Jelas</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['alamat_jelas']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Desa/Kelurahan Asal</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['desa_kelurahan_asal']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kecamatan Asal</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kecamatan_asal']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kabupaten/Kota Asal</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kabupaten_kota_asal']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Provinsi Asal</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['provinsi_asal']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Pos Asal</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kode_pos_asal']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['jenis_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alamat Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['alamat_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Desa/Kelurahan Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['desa_kelurahan_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kecamatan Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kecamatan_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kabupaten/Kota Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['kabupaten_kota_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Provinsi Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['provinsi_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Kode Pos Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['kode_pos_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Alasan Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['alasan_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Jenis Kepindahan</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['jenis_kepindahan']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Anggota Keluarga Tidak Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['anggota_keluarga_tidak_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Anggota Keluarga Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['anggota_keluarga_pindah']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Daftar NIK Anggota Pindah</label>
                    <div class="col-sm-9">
                        <?php 
                    // Mengubah data serialized menjadi array
                    $daftar_nik = unserialize($data['daftar_nik_anggota_pindah']); 
                    if ($daftar_nik && is_array($daftar_nik)) { 
                        // Menampilkan setiap NIK dalam daftar
                        foreach ($daftar_nik as $nik) { 
                            echo '<p class="form-control-plaintext">' . htmlspecialchars($nik) . '</p>';
                        } 
                    } else { 
                        echo '<p class="form-control-plaintext text-muted">Tidak ada data</p>'; 
                    } 
                    ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Daftar Nama Anggota Pindah</label>
                    <div class="col-sm-9">
                        <?php 
                    // Mengubah data serialized menjadi array
                    $daftar_nama = unserialize($data['daftar_anggota_pindah']); 
                    if ($daftar_nama && is_array($daftar_nama)) { 
                        // Menampilkan setiap NIK dalam daftar
                        foreach ($daftar_nama as $nama) { 
                            echo '<p class="form-control-plaintext">' . htmlspecialchars($nama) . '</p>';
                        } 
                    } else { 
                        echo '<p class="form-control-plaintext text-muted">Tidak ada data</p>'; 
                    } 
                    ?>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nama Sponsor</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nama_sponsor']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Nomor ITAS/ITAP</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['nomor_itas_itap']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Tanggal ITAS/ITAP</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['tanggal_itas_itap']); ?>
                        </p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Negara Tujuan</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext"><?php echo htmlspecialchars($data['negara_tujuan']); ?></p>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Rencana Tanggal Pindah</label>
                    <div class="col-sm-9">
                        <p class="form-control-plaintext">
                            <?php echo htmlspecialchars($data['rencana_tanggal_pindah']); ?></p>
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