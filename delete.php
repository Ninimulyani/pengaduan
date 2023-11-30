<?php
include "database.php";
    if (isset($_GET['id'])) {
        $id =htmlspecialchars($_GET["id"]);
        $id = base64_decode($id);
        

        $sql="delete from laporan where id ='$id' ";
        $hasil=mysqli_query($koneksi,$sql);

            if ($hasil) {
                echo '<script language="javascript"> location.href ="index.php?msg=succes_hapus"; </script>';
            }
            else {
                echo "<div class='alert alert-danger'> Data Gagal dihapus.</div>";

            }
        }
?>