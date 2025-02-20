<?php
require_once("../database.php"); // koneksi DB
logged_admin();

if (isset($_GET['edit']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $koneksi->prepare("SELECT * FROM akta_kelahiran WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    $stmt->close();
}
// Perintah Mengubah Data
if (isset($_POST['submit']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hindari SQL Injection dengan mysqli_real_escape_string
    $nama_pelapor = mysqli_real_escape_string($koneksi, $_POST['nama_pelapor']);
    $nik_pelapor = intval($_POST['nik_pelapor']);
    $nomor_dokumen_perjalanan = intval($_POST['nomor_dokumen_perjalanan']);
    $nomor_kartu_keluarga_pelapor = intval($_POST['nomor_kartu_keluarga_pelapor']);
    $kewarganegaraan_pelapor = mysqli_real_escape_string($koneksi, $_POST['kewarganegaraan_pelapor']);
    $nomor_handphone = intval($_POST['nomor_handphone']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $nama_saksi_1 = mysqli_real_escape_string($koneksi, $_POST['nama_saksi_1']);
    $nik_saksi_1 = intval($_POST['nik_saksi_1']);
    $nomor_kartu_keluarga_saksi_1 = intval($_POST['nomor_kartu_keluarga_saksi_1']);
    $kewarganegaraan_saksi_1 = mysqli_real_escape_string($koneksi, $_POST['kewarganegaraan_saksi_1']);
    $nama_ayah = mysqli_real_escape_string($koneksi, $_POST['nama_ayah']);
    $nik_ayah = intval($_POST['nik_ayah']);
    $tempat_lahir_ayah = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_ayah']);
    $tanggal_lahir_ayah = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_ayah']);
    $kewarganegaraan_ayah = mysqli_real_escape_string($koneksi, $_POST['kewarganegaraan_ayah']);
    $nama_ibu = mysqli_real_escape_string($koneksi, $_POST['nama_ibu']);
    $nik_ibu = mysqli_real_escape_string($koneksi, $_POST['nik_ibu']);
    $tempat_lahir_ibu = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir_ibu']);
    $tanggal_lahir_ibu = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_ibu']);
    $kewarganegaraan_ibu = mysqli_real_escape_string($koneksi, $_POST['kewarganegaraan_ibu']);
    $nama_anak = mysqli_real_escape_string($koneksi, $_POST['nama_anak']);
    $jk_anak = mysqli_real_escape_string($koneksi, $_POST['jk_anak']);
    $tempat_lahir = mysqli_real_escape_string($koneksi, $_POST['tempat_lahir']);
    $tanggal_lahir_anak = mysqli_real_escape_string($koneksi, $_POST['tanggal_lahir_anak']);
    $pukul = mysqli_real_escape_string($koneksi, $_POST['pukul']);
    $jenis_kelahiran = mysqli_real_escape_string($koneksi, $_POST['jenis_kelahiran']);
    $kelahiran_ke = intval($_POST['kelahiran_ke']);
    $penolong_kelahiran = mysqli_real_escape_string($koneksi, $_POST['penolong_kelahiran']);
    $bb_bayi = intval($_POST['bb_bayi']);
    $pb = intval($_POST['pb']);
    $status = mysqli_real_escape_string($koneksi, $_POST['status']);

    // Query update tanpa bind_param
    $query = "UPDATE akta_kelahiran SET 
        nama_pelapor = '$nama_pelapor',
        nik_pelapor = '$nik_pelapor',
        nomor_dokumen_perjalanan = '$nomor_dokumen_perjalanan',
        nomor_kartu_keluarga_pelapor = '$nomor_kartu_keluarga_pelapor',
        kewarganegaraan_pelapor = '$kewarganegaraan_pelapor',
        nomor_handphone = '$nomor_handphone',
        email = '$email',
        nama_saksi_1 = '$nama_saksi_1',
        nik_saksi_1 = '$nik_saksi_1',
        nomor_kartu_keluarga_saksi_1 = '$nomor_kartu_keluarga_saksi_1',
        kewarganegaraan_saksi_1 = '$kewarganegaraan_saksi_1',
        nama_ayah = '$nama_ayah',
        nik_ayah = '$nik_ayah',
        tempat_lahir_ayah = '$tempat_lahir_ayah',
        tanggal_lahir_ayah = '$tanggal_lahir_ayah',
        kewarganegaraan_ayah = '$kewarganegaraan_ayah',
        nama_ibu = '$nama_ibu',
        nik_ibu = '$nik_ibu',
        tempat_lahir_ibu = '$tempat_lahir_ibu',
        tanggal_lahir_ibu = '$tanggal_lahir_ibu',
        kewarganegaraan_ibu = '$kewarganegaraan_ibu',
        nama_anak = '$nama_anak',
        jk_anak = '$jk_anak',
        tempat_lahir = '$tempat_lahir',
        tanggal_lahir_anak = '$tanggal_lahir_anak',
        pukul = '$pukul',
        jenis_kelahiran = '$jenis_kelahiran',
        kelahiran_ke = '$kelahiran_ke',
        penolong_kelahiran = '$penolong_kelahiran',
        bb_bayi = '$bb_bayi',
        pb = '$pb',
        status = '$status'
        WHERE id = $id";

    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Status diperbarui menjadi Selesai dan email telah dikirim.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/pengaduan/data-surat-pindah-penduduk/index.php';
                    }
                });
            });
        </script>";
    } else {
        echo "<script>
                alert('Edit data gagal: " . mysqli_error($koneksi) . "');
                document.location='/pengaduan/data-akta-kelahiran/index.php';
            </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../user/public/images/logomaros.png">
    <link rel="shortcut icon" href="../image/logomaros.png" width="20">
    <title>Dashboard - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="index">Pelayanan Administrasi Kependudukan Kecamatan Tanralili</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav sidebar-menu" id="exampleAccordion">
                <li class="sidebar-profile nav-item" data-toggle="tooltip" data-placement="right" title="Admin">
                    <div class="profile-main">
                        <p class="image">
                            <img alt="image" src="../user/public/images/logomaros.png" width="80">
                        </p>
                        <p>
                            <span class="">Admin</span><br><br>
                        </p>
                    </div>
                </li>

                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="../index.php">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Data User</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kelahiran/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../perubahan_data/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Perubahan</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-kartu-indentitas-anak/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kartu Identitas Anak</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-surat-pindah-penduduk/">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Surat Pindah Penduduk</span>
                    </a>
                </li>

            </ul>

            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                        <i class="fa fa-fw fa-sign-out"></i>Logout
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Laporan Kematian</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Akta Kematian
                </div>
                <div class="card-body mx-2 col-8">
                    <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post">
                        <div class="form-group">
                            <label for="id">Nomor Pengaduan</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?= $data['id'] ?? '' ?>"
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelapor">Nama Pelapor</label>
                            <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor"
                                value="<?= $data['nama_pelapor'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_pelapor">NIK Pelapor</label>
                            <input type="text" class="form-control" id="nik_pelapor" name="nik_pelapor"
                                value="<?= $data['nik_pelapor'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_dokumen_perjalanan">Nomor Dokumen Perjalanan</label>
                            <input type="text" class="form-control" id="nomor_dokumen_perjalanan"
                                name="nomor_dokumen_perjalanan" value="<?= $data['nomor_dokumen_perjalanan'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="nomor_kartu_keluarga_pelapor">Nomor Kartu Keluarga Pelapor</label>
                            <input type="text" class="form-control" id="nomor_kartu_keluarga_pelapor"
                                name="nomor_kartu_keluarga_pelapor"
                                value="<?= $data['nomor_kartu_keluarga_pelapor'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_pelapor">Kewarganegaraan Pelapor</label>
                            <input type="text" class="form-control" id="kewarganegaraan_pelapor"
                                name="kewarganegaraan_pelapor" value="<?= $data['kewarganegaraan_pelapor'] ?? '' ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_handphone">Nomor Handphone</label>
                            <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone"
                                value="<?= $data['nomor_handphone'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="<?= $data['email'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_saksi_1">Nama Saksi 1</label>
                            <input type="text" class="form-control" id="nama_saksi_1" name="nama_saksi_1"
                                value="<?= $data['nama_saksi_1'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi_1">NIK Saksi 1</label>
                            <input type="text" class="form-control" id="nik_saksi_1" name="nik_saksi_1"
                                value="<?= $data['nik_saksi_1'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_kartu_keluarga_saksi_1">Nomor Kartu Keluarga Saksi 1</label>
                            <input type="text" class="form-control" id="nomor_kartu_keluarga_saksi_1"
                                name="nomor_kartu_keluarga_saksi_1"
                                value="<?= $data['nomor_kartu_keluarga_saksi_1'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_saksi_1">Kewarganegaraan Saksi 1</label>
                            <input type="text" class="form-control" id="kewarganegaraan_saksi_1"
                                name="kewarganegaraan_saksi_1" value="<?= $data['kewarganegaraan_saksi_1'] ?? '' ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                value="<?= $data['nama_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah">NIK Ayah</label>
                            <input type="text" class="form-control" id="nik_ayah" name="nik_ayah"
                                value="<?= $data['nik_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                            <input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                value="<?= $data['tempat_lahir_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                            <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                value="<?= $data['tanggal_lahir_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ayah">Kewarganegaraan Ayah</label>
                            <input type="text" class="form-control" id="kewarganegaraan_ayah"
                                name="kewarganegaraan_ayah" value="<?= $data['kewarganegaraan_ayah'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                value="<?= $data['nama_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu">NIK Ibu</label>
                            <input type="text" class="form-control" id="nik_ibu" name="nik_ibu"
                                value="<?= $data['nik_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                            <input type="text" class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                value="<?= $data['tempat_lahir_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                            <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                value="<?= $data['tanggal_lahir_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ibu">Kewarganegaraan Ibu</label>
                            <input type="text" class="form-control" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu"
                                value="<?= $data['kewarganegaraan_ibu'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_anak">Nama Anak</label>
                            <input type="text" class="form-control" id="nama_anak" name="nama_anak"
                                value="<?= $data['nama_anak'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="jk_anak">Jenis Kelamin Anak</label>
                            <select class="form-control" id="jk_anak" name="jk_anak" required>
                                <option value="Laki-laki"
                                    <?= ($data['jk_anak'] ?? '') == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                                <option value="Perempuan"
                                    <?= ($data['jk_anak'] ?? '') == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir Anak</label>
                            <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir"
                                value="<?= $data['tempat_lahir'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_anak">Tanggal Lahir Anak</label>
                            <input type="date" class="form-control" id="tanggal_lahir_anak" name="tanggal_lahir_anak"
                                value="<?= $data['tanggal_lahir_anak'] ?? '' ?>" required>
                        </div>
                        <input type="time" class="form-control" id="pukul" name="pukul"
                            value="<?= isset($data['pukul']) ? date('H:i', strtotime($data['pukul'])) : '' ?>" required>

                        <div class="form-group">
                            <label for="jenis_kelahiran">Jenis Kelahiran</label>
                            <input type="text" class="form-control" id="jenis_kelahiran" name="jenis_kelahiran"
                                value="<?= $data['jenis_kelahiran'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kelahiran_ke">Kelahiran Ke</label>
                            <input type="number" class="form-control" id="kelahiran_ke" name="kelahiran_ke"
                                value="<?= $data['kelahiran_ke'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="penolong_kelahiran">Penolong Kelahiran</label>
                            <input type="text" class="form-control" id="penolong_kelahiran" name="penolong_kelahiran"
                                value="<?= $data['penolong_kelahiran'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="bb_bayi">Berat Badan Bayi (kg)</label>
                            <input type="number" step="0.1" class="form-control" id="bb_bayi" name="bb_bayi"
                                value="<?= $data['bb_bayi'] ?? '' ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="pb">Panjang Badan Bayi (cm)</label>
                            <input type="number" class="form-control" id="pb" name="pb" value="<?= $data['pb'] ?? '' ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <!-- <label for="dokumen">Dokumen</label> -->
                            <input type="text" hidden class="form-control" id="dokumen" name="dokumen"
                                value="<?= $data['dokumen'] ?? '' ?>">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status" required>
                                <option value="Menunggu" <?= ($data['status'] ?? '') == 'Menunggu' ? 'selected' : '' ?>>
                                    Menunggu</option>
                                <option value="Sedang diproses"
                                    <?= ($data['status'] ?? '') == 'Sedang diproses' ? 'selected' : '' ?>>Sedang
                                    diproses</option>
                                <option value="Ditolak" <?= ($data['status'] ?? '') == 'Ditolak' ? 'selected' : '' ?>>
                                    Ditolak</option>
                                <option value="Selesai" <?= ($data['status'] ?? '') == 'Selesai' ? 'selected' : '' ?>>
                                    Selesai</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <!-- <label for="dokumen_admin">Dokumen Admin</label> -->
                            <input type="text" hidden class="form-control" id="dokumen_admin" name="dokumen_admin"
                                value="<?= $data['dokumen_admin'] ?? '' ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>