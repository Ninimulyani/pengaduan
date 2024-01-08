<?php

require_once("database.php");

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $login = mysqli_query($koneksi, "SELECT * FROM admin WHERE username='$username' and password='$password'");
    $cek = mysqli_num_rows($login);

    if($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header('location:index.php');
    } else {
        echo "<script>
        alert('Login Gagal, Periksa Username dan Password Anda!');
        header('location:../admin/');
             </script>";
    }
}

?>


<?php

    
    $message = "";
    if(isset($_POST['login'])){
        $username = $_POST['username'];
        $password = md5($_POST['password']);
    
        $login = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username' and password='$password'");
        $cek = mysqli_num_rows($login);
    
        if($cek > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['status'] = "login";
            header('location:user/public/home-2.php');
        } else {
            echo "<script>
            alert('Login Gagal, Periksa Username dan Password Anda!');
            header('location:../admin/');
                 </script>";
        }
    }
 ?>

<?php

    
$message = "";
if(isset($_POST['login'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $login = mysqli_query($koneksi, "SELECT * FROM ketua_rt WHERE username='$username' and password='$password'");
    $cek = mysqli_num_rows($login);

    if($cek > 0) {
        $_SESSION['username'] = $username;
        $_SESSION['status'] = "login";
        header('location:dashboard-rt.php');
    } else {
        echo "<script>
        alert('Login Gagal, Periksa Username dan Password Anda!');
        header('location:../admin/');
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
    <link rel="shortcut icon" href="user/public/images/logo.png" width="20">
    <title>Login - Pengaduan Masyarakat Kelurahan Tamalanrea</title>
    
    <link href="vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    
    <link href="css/admin.css" rel="stylesheet">
</head>

<body class="bg-dark">
    <div class="container">
        <div class="card container card-login mx-auto mt-5">
            <h3 class="text-center" style="padding-top:8px; font-family: monospace;">Login</h3>
            <hr class="custom">
            <div class="card-body">
                <form method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Username</label>
                        <input class="form-control" id="username" type="text" name="username" aria-describedby="userlHelp" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Password</label>
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox"> Remember Password
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-block card-shadow-2" name="login" value="Login">
                </form>
            </div>
            <p class="text-center text-danger"><small><?php echo @$message; ?></small></p>
        </div>
    </div>
    
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<script>
	
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	
</script>
</body>

</html>
