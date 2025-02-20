<?php
require_once("database.php");
session_start(); // Memulai session

$message = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fungsi login user
    function login_user($email, $password)
    {
        global $koneksi; // Mengakses koneksi database global

        // Query untuk mengambil data user berdasarkan email
        $sql = "SELECT * FROM user WHERE email = ?";
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("s", $email); // Bind parameter email
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user) {
            // Verifikasi password
            if (password_verify($password, $user['password'])) {
                return $user; // Return data user jika password cocok
            }
        }
        return false; // Return false jika login gagal
    }

    // Memanggil fungsi login
    $user = login_user($email, $password);

    if ($user) {
        // Simpan data user ke dalam session
        $_SESSION['user_id'] = $user['id']; // Simpan user ID
        $_SESSION['email'] = $user['email']; // Simpan email
        $_SESSION['nik'] = $user['nik']; // Simpan email
        $_SESSION['status'] = "login"; // Tandai user sebagai login

        // Redirect ke halaman utama
        header("Location: home-2.php");
        exit();
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'error',
                    title: 'Login Gagal',
                    text: 'Email Atau password salah!'
                }).then(() => {
                    window.location.href = 'login-user.php';
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
    <title>Login - Website Pelayanan Administrasi</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
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
            /* Overlay untuk membuat gambar lebih gelap */
        }

        .logo-container-right {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo-container-right img {
            width: 120px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            margin-bottom: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            position: relative;
            text-align: center;
        }



        .right {
            right: 0;
            background: #f0f8f5;
            /* Warna netral yang cocok untuk logo hijau */
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            position: relative;
        }

        .form-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-header img {
            width: 50px;
            margin-bottom: 10px;
        }

        .form-header h3 {
            font-size: 24px;
            font-weight: bold;
        }

        .form-control {
            border-radius: 25px;
            box-shadow: none;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #4facfe;
            box-shadow: 0 0 8px rgba(79, 172, 254, 0.5);
        }

        .btn-primary {
            border-radius: 25px;
            background: linear-gradient(to right, #28a745, #85d17f);
            /* Warna hijau gradasi */
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
    <div class="split left">
        <div class="logo-container">
        </div>
    </div>

    <div class="split right">
        <div class="form-container">
            <div class="logo-container-right">
                <img src="images/logomaros.png" alt="Logo Kanan">
            </div>
            <div class="form-header">
                <h3>Login User</h3>
            </div>
            <form method="post">
                <div class="form-group text-center mt-3">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Masukkan Email"
                        required>
                </div>
                <div class="form-group text-center mt-3">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password"
                        placeholder="Masukkan Password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                <div class="form-group text-center mt-3">
                    <label>Belum Punya Akun? <a class="small" href="register-user.php">Register</a></label>
                </div>
            </form>
            <div class="footer">
                <p>&copy; 2025 Website Pelayanan Kecamatan Tanralili. All rights reserved.</p>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>