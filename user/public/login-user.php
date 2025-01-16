<?php
require_once("database.php");
session_start(); // Memulai session

$message = "";

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fungsi login user
    function login_user($email, $password) {
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
        $_SESSION['status'] = "login"; // Tandai user sebagai login

        // Redirect ke halaman utama
        header("Location: home-2.php");
        exit();
    } else {
        $message = "Email atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - Pengaduan Masyarakat</title>
    <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="css/admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card container card-login mx-auto mt-5">
            <h3 class="text-center" style="padding-top:8px; font-family: monospace;">Login User</h3>
            <hr class="custom">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Enter Email" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block card-shadow-2" name="login" value="Login">
                    <br>
                    <div class="form-group text-center">
                        <label>Belum Punya Akun? <a class="small" href="register-user.php">Register</a></label>
                    </div>
                </form>
            </div>
            <p class="text-center text-danger"><small><?php echo $message; ?></small></p>
        </div>
    </div>
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>
