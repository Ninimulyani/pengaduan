<?php
require_once("../database.php"); // koneksi DB
logged_admin();


if (isset($_GET['edit'])) {
    $tampil = mysqli_query($koneksi, "SELECT * FROM akta_kematian WHERE id = '$_GET[id]'");
    $data = mysqli_fetch_array($tampil);
    if ($data) {
        $id = $data['id'];
        $nama_pelapor = $data['nama_pelapor'];
        $nik_pelapor = $data['nik_pelapor'];
        $nomor_dokumen_perjalanan = $data['nomor_dokumen_perjalanan'];
        $nomor_kartu_keluarga_pelapor = $data['nomor_kartu_keluarga_pelapor'];
        $kewarganegaraan_pelapor = $data['kewarganegaraan_pelapor'];
        $nomor_handphone = $data['nomor_handphone'];
        $email = $data['email'];
        $nama_saksi_1 = $data['nama_saksi_1'];
        $nik_saksi_1 = $data['nik_saksi_1'];
        $nomor_kartu_keluarga_saksi_1 = $data['nomor_kartu_keluarga_saksi_1'];
        $kewarganegaraan_saksi_1 = $data['kewarganegaraan_saksi_1'];
        $nama_ayah = $data['nama_ayah'];
        $nik_ayah = $data['nik_ayah'];
        $tempat_lahir_ayah = $data['tempat_lahir_ayah'];
        $tanggal_lahir_ayah = $data['tanggal_lahir_ayah'];
        $kewarganegaraan_ayah = $data['kewarganegaraan_ayah'];
        $nama_ibu = $data['nama_ibu'];
        $nik_ibu = $data['nik_ibu'];
        $tempat_lahir_ibu = $data['tempat_lahir_ibu'];
        $tanggal_lahir_ibu = $data['tanggal_lahir_ibu'];
        $kewarganegaraan_ibu = $data['kewarganegaraan_ibu'];
        $nik_alm = $data['nik_alm'];
        $nama_lengkap_alm = $data['nama_lengkap_alm'];
        $hari_tanggal_kematian = $data['hari_tanggal_kematian'];
        $status = $data['status'];
    }
}

//Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $simpan = mysqli_query($koneksi, "UPDATE akta_kematian SET
        nama_pelapor = '$_POST[nama_pelapor]',
        nik_pelapor = '$_POST[nik_pelapor]',
        nomor_dokumen_perjalanan = '$_POST[nomor_dokumen_perjalanan]',
        nomor_kartu_keluarga_pelapor = '$_POST[nomor_kartu_keluarga_pelapor]',
        kewarganegaraan_pelapor = '$_POST[kewarganegaraan_pelapor]',
        nomor_handphone = '$_POST[nomor_handphone]',
        email = '$_POST[email]',
        nama_saksi_1 = '$_POST[nama_saksi_1]',
        nik_saksi_1 = '$_POST[nik_saksi_1]',
        nomor_kartu_keluarga_saksi_1 = '$_POST[nomor_kartu_keluarga_saksi_1]',
        kewarganegaraan_saksi_1 = '$_POST[kewarganegaraan_saksi_1]',
        nama_ayah = '$_POST[nama_ayah]',
        nik_ayah = '$_POST[nik_ayah]',
        tempat_lahir_ayah = '$_POST[tempat_lahir_ayah]',
        tanggal_lahir_ayah = '$_POST[tanggal_lahir_ayah]',
        kewarganegaraan_ayah = '$_POST[kewarganegaraan_ayah]',
        nama_ibu = '$_POST[nama_ibu]',
        nik_ibu = '$_POST[nik_ibu]',
        tempat_lahir_ibu = '$_POST[tempat_lahir_ibu]',
        tanggal_lahir_ibu = '$_POST[tanggal_lahir_ibu]',
        kewarganegaraan_ibu = '$_POST[kewarganegaraan_ibu]',
        nik_alm = '$_POST[nik_alm]',
        nama_lengkap_alm = '$_POST[nama_lengkap_alm]',
        hari_tanggal_kematian = '$_POST[hari_tanggal_kematian]',
        status = '$status'
        WHERE id = '$_GET[id]'");

    if ($simpan) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
              <script>
                  document.addEventListener('DOMContentLoaded', function() {
                      Swal.fire({
                          icon: 'success',
                          title: 'Selesai',
                          text: 'Data Berhasil Di Edit.'
                      }).then(() => {
                          window.location.href = '/pengaduan/data-akta-kematian/index.php';
                      });
                  });
              </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal!');
                document.location='/pengaduan/data-akta-kematian/index.php';
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

                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kelahiran/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kelahiran</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-kartu-indentitas-anak/">
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
                            <input type="text" class="form-control" id="id" name="id" value="<?= $id ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="nama_pelapor">Nama Pelapor</label>
                            <input type="text" class="form-control" id="nama_pelapor" name="nama_pelapor"
                                value="<?= $nama_pelapor ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_pelapor">NIK Pelapor</label>
                            <input type="text" class="form-control" id="nik_pelapor" name="nik_pelapor"
                                value="<?= $nik_pelapor ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_dokumen_perjalanan">Nomor Dokumen Perjalanan</label>
                            <input type="text" class="form-control" id="nomor_dokumen_perjalanan"
                                name="nomor_dokumen_perjalanan" value="<?= $nomor_dokumen_perjalanan ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_kartu_keluarga_pelapor">Nomor Kartu Keluarga Pelapor</label>
                            <input type="text" class="form-control" id="nomor_kartu_keluarga_pelapor"
                                name="nomor_kartu_keluarga_pelapor" value="<?= $nomor_kartu_keluarga_pelapor ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_pelapor">Kewarganegaraan Pelapor</label>
                            <input type="text" class="form-control" id="kewarganegaraan_pelapor"
                                name="kewarganegaraan_pelapor" value="<?= $kewarganegaraan_pelapor ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_handphone">Nomor Handphone</label>
                            <input type="text" class="form-control" id="nomor_handphone" name="nomor_handphone"
                                value="<?= $nomor_handphone ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $email ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nama_saksi_1">Nama Saksi 1</label>
                            <input type="text" class="form-control" id="nama_saksi_1" name="nama_saksi_1"
                                value="<?= $nama_saksi_1 ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_saksi_1">NIK Saksi 1</label>
                            <input type="text" class="form-control" id="nik_saksi_1" name="nik_saksi_1"
                                value="<?= $nik_saksi_1 ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nomor_kartu_keluarga_saksi_1">Nomor Kartu Keluarga Saksi 1</label>
                            <input type="text" class="form-control" id="nomor_kartu_keluarga_saksi_1"
                                name="nomor_kartu_keluarga_saksi_1" value="<?= $nomor_kartu_keluarga_saksi_1 ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_saksi_1">Kewarganegaraan Saksi 1</label>
                            <input type="text" class="form-control" id="kewarganegaraan_saksi_1"
                                name="kewarganegaraan_saksi_1" value="<?= $kewarganegaraan_saksi_1 ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" id="nama_ayah" name="nama_ayah"
                                value="<?= $nama_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_ayah">NIK Ayah</label>
                            <input type="text" class="form-control" id="nik_ayah" name="nik_ayah"
                                value="<?= $nik_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ayah">Tempat Lahir Ayah</label>
                            <input type="text" class="form-control" id="tempat_lahir_ayah" name="tempat_lahir_ayah"
                                value="<?= $tempat_lahir_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ayah">Tanggal Lahir Ayah</label>
                            <input type="date" class="form-control" id="tanggal_lahir_ayah" name="tanggal_lahir_ayah"
                                value="<?= $tanggal_lahir_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ayah">Kewarganegaraan Ayah</label>
                            <input type="text" class="form-control" id="kewarganegaraan_ayah"
                                name="kewarganegaraan_ayah" value="<?= $kewarganegaraan_ayah ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" id="nama_ibu" name="nama_ibu"
                                value="<?= $nama_ibu ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_ibu">NIK Ibu</label>
                            <input type="text" class="form-control" id="nik_ibu" name="nik_ibu" value="<?= $nik_ibu ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="tempat_lahir_ibu">Tempat Lahir Ibu</label>
                            <input type="text" class="form-control" id="tempat_lahir_ibu" name="tempat_lahir_ibu"
                                value="<?= $tempat_lahir_ibu ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir_ibu">Tanggal Lahir Ibu</label>
                            <input type="date" class="form-control" id="tanggal_lahir_ibu" name="tanggal_lahir_ibu"
                                value="<?= $tanggal_lahir_ibu ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="kewarganegaraan_ibu">Kewarganegaraan Ibu</label>
                            <input type="text" class="form-control" id="kewarganegaraan_ibu" name="kewarganegaraan_ibu"
                                value="<?= $kewarganegaraan_ibu ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="nik_alm">NIK Alm</label>
                            <input type="text" class="form-control" id="nik_alm" name="nik_alm" value="<?= $nik_alm ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="nama_lengkap_alm">Nama Lengkap Alm</label>
                            <input type="text" class="form-control" id="nama_lengkap_alm" name="nama_lengkap_alm"
                                value="<?= $nama_lengkap_alm ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="hari_tanggal_kematian">Hari Tanggal Kematian</label>
                            <input type="date" class="form-control" id="hari_tanggal_kematian"
                                name="hari_tanggal_kematian" value="<?= $hari_tanggal_kematian ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Menunggu" <?= $status == 'Menunggu' ? 'selected' : '' ?>>Menunggu
                                </option>
                                <option value="Ditolak" <?= $status == 'Ditolak' ? 'selected' : '' ?>>Ditolak</option>
                                <option value="Sedang diproses" <?= $status == 'Sedang diproses' ? 'selected' : '' ?>>
                                    Sedang diproses</option>
                                <option value="Selesai" <?= $status == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>