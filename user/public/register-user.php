<?php
require_once("database.php");

if (isset($_POST['register'])) {
    $no_kk = $_POST['no_kk'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password

    // Periksa apakah semua field yang diperlukan diisi
    if (!empty($no_kk) && !empty($nik) && !empty($nama) && !empty($username) && !empty($alamat) && !empty($email) && !empty($_POST['password'])) {
        $sql = "INSERT INTO user (no_kk, nik, nama, username, alamat, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssss", $no_kk, $nik, $nama, $username, $alamat, $email, $password);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['no_kk'] = $no_kk;
                $_SESSION['nik'] = $nik;
                $_SESSION['email'] = $email;
                $_SESSION['status'] = "register";
                header('location: login-user.php');
            } else {
                echo "<script>alert('Register Gagal!');</script>";
            }

            $stmt->close();
        } else {
            echo "<script>alert('Gagal menyiapkan SQL.');</script>";
        }
    } else {
        echo "<script>alert('Harap isi semua informasi.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register - Pelayanan Admnistrasi Kependudukan Kecamatan Tanralili</title>

    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card container card-login mx-auto mt-5">
            <h3 class="text-center" style="padding-top:8px; font-family: monospace;">Register</h3>
            <hr class="custom">
            <div class="card-body">
                <form method="post" action="register-user.php">
                    <div class="form-group">
                        <label for="no_kk">Nomor Kartu Keluarga</label>
                        <input class="form-control" id="no_kk" type="text" name="no_kk" placeholder="Masukkan Nomor Kartu Keluarga"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nik">NIK</label>
                        <input class="form-control" id="nik" type="text" name="nik" placeholder="Masukkan NIK"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukkan Nama"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input class="form-control" id="username" type="text" name="username"
                            placeholder="Masukkan Username" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input class="form-control" id="alamat" type="text" name="alamat" placeholder="Masukkan Alamat"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Masukkan Email"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="confirm">Konfirmasi Password</label>
                        <input class="form-control" id="confirm" name="Confirm" type="password"
                            placeholder="Konfirmasi Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block card-shadow-2" name="register"
                        value="Register">
                </form>
            </div>
        </div>
    </div>

    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            const password = document.getElementById('password').value;
            const confirm = document.getElementById('confirm').value;

            if (password !== confirm) {
                e.preventDefault();
                alert('Konfirmasi password tidak cocok!');
            }
        });
    </script>
</body>

</html>