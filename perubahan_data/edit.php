<?php
require_once("../database.php");
logged_admin();

$id = '';
$nik = '';

$jenis_permohonan = '';
$semula = '';
$menjadi = '';
$dasar_perubahan = '';

// Ambil NIK dari URL
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
}

// Cek apakah ada ID yang dikirim untuk proses edit
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM permohonan_perubahan WHERE id = '$id'");
    $data = mysqli_fetch_assoc($tampil);
    if ($data) {
        $jenis_permohonan = $data['jenis_permohonan'];
        $semula = $data['semula'];
        $menjadi = $data['menjadi'];
        $dasar_perubahan = $data['dasar_perubahan'];
    }
}


// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $jenis_permohonan = mysqli_real_escape_string($koneksi, $_POST['jenis_permohonan']);
    $semula = mysqli_real_escape_string($koneksi, $_POST['semula']);
    $menjadi = mysqli_real_escape_string($koneksi, $_POST['menjadi']);
    $dasar_perubahan = mysqli_real_escape_string($koneksi, $_POST['dasar_perubahan']);

    $simpan = mysqli_query($koneksi, "UPDATE permohonan_perubahan SET
        jenis_permohonan = '$jenis_permohonan',
        semula = '$semula',
        menjadi = '$menjadi',
        dasar_perubahan = '$dasar_perubahan'
        WHERE id = '$id'");

if ($simpan) {
    echo "<script>
            alert('Edit data sukses!');
            document.location='detail_perubahan.php?nik=$nik';
          </script>";
} else {
    echo "<script>
            alert('Edit data gagal!');
            document.location='detail_perubahan.php?nik=$nik';
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
    <title>Edit Data Perubahan Penduduk</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="../css/admin.css" rel="stylesheet">
</head>

<body class="fixed-nav sticky-footer" id="page-top">
    <div class="content-wrapper">
        <div class="container-fluid">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="index.php">Dashboard</a>
                </li>
                <li class="breadcrumb-item active">Edit Perubahan Data Penduduk</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Edit Data Perubahan Penduduk
                </div>
                <div class="card-body">
                    <a href="detail_perubahan.php?nik=<?= $nik ?>" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post">
                        <div class="form-group">
                            <label for="nik">NIK</label>
                            <input type="text" class="form-control" id="nik" name="nik" value="<?= $nik ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label for="jenis_permohonan">Jenis Permohonan</label>
                            <input type="text" class="form-control" id="jenis_permohonan" name="jenis_permohonan"
                                value="<?= $jenis_permohonan ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="semula">Semula</label>
                            <input type="text" class="form-control" id="semula" name="semula" value="<?= $semula ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="menjadi">Menjadi</label>
                            <input type="text" class="form-control" id="menjadi" name="menjadi" value="<?= $menjadi ?>"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="dasar_perubahan">Dasar Perubahan</label>
                            <input type="text" class="form-control" id="dasar_perubahan" name="dasar_perubahan"
                                value="<?= $dasar_perubahan ?>" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>