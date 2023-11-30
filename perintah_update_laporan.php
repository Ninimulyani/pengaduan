<?php

    require_once("database.php");
    
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id=htmlspecialchars($_POST["id"]);
        $nama=input($_POST["nama"]);
        $angkatan=input($_POST["angkatan"]);
        $telpon=input($_POST["telpon"]);
        $email=input($_POST["email"]);
        $alamat=input($_POST["alamat"]);
        $nama_divisi=input($_POST["nama_divisi"]);
        $isi=input($_POST["isi"]);
        $status=input($_POST["status"]);
        

        $sql="UPDATE laporan SET
        nama='$nama',
        email='$email',
        telpon='$telpon',
        alamat='$alamat',
        nama_divisi='$nama_divisi',
        isi='$isi',
        status='$status'
		where id=$id";
        
        $hasil=mysqli_query($koneksi,$sql);

        if ($hasil) {
            echo '<script language="javascript"> location.href ="index.php?msg=succes_edit"; </script>';
        }
        else {
            echo "<div class='alert alert-danger'> Data Gagal disimpan.</div>";

        }

    }

    ?>