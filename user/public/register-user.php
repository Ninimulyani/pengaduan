<?php
require_once("database.php");

if (isset($_POST['register'])) {
    $no_kk = $_POST['no_kk'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $alamat = $_POST['alamat'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Periksa apakah semua field yang diperlukan diisi
    if (!empty($no_kk) && !empty($nik) && !empty($nama) && !empty($username) && !empty($alamat) && !empty($email) && !empty($password)) {

        // Hash password untuk keamanan
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (no_kk, nik, nama, username, alamat, email, password) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $koneksi->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sssssss", $no_kk, $nik, $nama, $username, $alamat, $email, $hashed_password);

            if ($stmt->execute()) {
                session_start();
                $_SESSION['no_kk'] = $no_kk;
                $_SESSION['nik'] = $nik;
                $_SESSION['email'] = $email;
                $_SESSION['status'] = "register";

                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Data Berhasil Ditambahkan'
                        }).then(() => {
                            window.location.href = 'login-user.php';
                        });
                    });
                </script>";
            } else {
                echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Terjadi kesalahan saat menyimpan data. Coba lagi nanti.'
                        }).then(() => {
                            window.location.href = 'register-user.php';
                        });
                    });
                </script>";
            }
            $stmt->close();
        } else {
            echo "<script>alert('Gagal menyiapkan SQL statement.');</script>";
        }
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Harap isi semua informasi yang diperlukan.'
                }).then(() => {
                    window.history.back();
                });
            });
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
    <title>Register - Pelayanan Administrasi Kependudukan Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .logo-container-right img {
            width: 100px;
            /* Ubah ukuran sesuai kebutuhan */
            height: auto;
            display: block;
            margin: 0 auto 20px auto;
            /* Pusatkan dan beri jarak bawah */
        }

        .split {
            height: 100%;
            width: 50%;
            position: fixed;
            top: 0;
            overflow: hidden;
        }

        .left {
            left: 0;
            background: url('images/kantor.jpg') no-repeat center center;
            background-size: cover;
            position: relative;
        }

        .left::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
        }

        .right {
            right: 0;
            background: #f0f8f5;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            /* Ubah ini agar konten dimulai dari atas */
            padding: 20px;
            overflow-y: auto;
            height: 100vh;
            scroll-behavior: smooth;
            /* Scroll halus */
        }


        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.5);
        }

        .btn-primary {
            border-radius: 25px;
            background: linear-gradient(to right, #28a745, #85d17f);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #218838, #28a745);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #888;
        }
    </style>
</head>

<body>
    <div class="split left"></div>

    <div class="split right">
        <div class="form-container">
            <div class="logo-container-right">
                <img src="images/logomaros.png" alt="Logo Kanan">
            </div>
            <div class="form-header">
                <h3>Register</h3>
            </div>
            <form method="post" action="register-user.php">
                <div class="form-group">
                    <label for="no_kk">Nomor Kartu Keluarga</label>
                    <input class="form-control" id="no_kk" type="text" name="no_kk"
                        placeholder="Masukkan Nomor Kartu Keluarga" required>
                </div>
                <div class="form-group">
                    <label for="nik">NIK</label>
                    <input class="form-control" id="nik" type="text" name="nik" placeholder="Masukkan NIK" required>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input class="form-control" id="nama" type="text" name="nama" placeholder="Masukkan Nama" required>
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
                    <input class="form-control" id="confirm" name="confirm" type="password"
                        placeholder="Konfirmasi Password" required>
                </div>
                <div class="form-group text-center mt-3">
                    <label>Sudah Punya Akun? <a class="small" href="login-user.php">Login</a></label>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
            </form>
            <div class="footer">
                <p>&copy; 2025 Pelayanan Administrasi Kependudukan Kecamatan Tanralili. All rights reserved.</p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
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