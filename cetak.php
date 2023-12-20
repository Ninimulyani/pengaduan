<?php
    require_once("database.php"); // koneksi DB

    logged_admin ();
    global $total_laporan_masuk, $total_laporan_menunggu, $total_laporan_ditanggapi;
    if ($id_admin > 0) {
        foreach($db->query("SELECT COUNT(*) FROM laporan WHERE laporan.tujuan = $id_admin") as $row) {
            $total_laporan_masuk = $row['COUNT(*)'];
        }

        foreach($db->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\" AND laporan.tujuan = $id_admin") as $row) {
            $total_laporan_ditanggapi = $row['COUNT(*)'];
        }

        foreach($koneksi>query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\" AND laporan.tujuan = $id_admin") as $row) {
            $total_laporan_menunggu = $row['COUNT(*)'];
        }
    } else {
        foreach($koneksi->query("SELECT COUNT(*) FROM laporan") as $row) {
            $total_laporan_masuk = $row['COUNT(*)'];
        }

        foreach($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Ditanggapi\"") as $row) {
            $total_laporan_ditanggapi = $row['COUNT(*)'];
        }

        foreach($koneksi->query("SELECT COUNT(*) FROM laporan WHERE status = \"Menunggu\"") as $row) {
            $total_laporan_menunggu = $row['COUNT(*)'];
        }
    }

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>.</title>
    
</head>
<body>
    <div class="container">
        <div class="content-wrapper">
        <img src="../img/tut.png" style="width: 50px; height: auto; margin-left:450px; margin-bottom:10px;">

            <table style="width: 100%;">
                <tr>
                    <td align="center">
                        <span>PENGADUAN MASYARAKAT  <br> <b> PENGADUAN </b> <br> JL. Perintis Kemerdekaan</span>
                        <hr>                    
                    </td>
                </tr>
            </table>
            <section class="content-header">
                <h3 align="center">Laporan Pengaduan</h3>
            </section>
            <section class="content">
                <div class="row">
                    <div class="col-md-12">
                        <table border="1" cellpadding="5px" cellspacing="0px" style="font-size:11;" width="100%">
                            <thead align="center" style="background-color:#D3D3D3">
                            <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telpon</th>
                                    <th>Alamat</th>
                                    <th>Tujuan</th>
                                    <th>Isi Laporan</th>
                                    <th>Tanggal</th>
                                    <th>File</th>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Status</th>
                                    <th class="sorting_asc_disabled sorting_desc_disabled">Aksi</th>
                                </tr>
                            </thead>
                            <tbody style="font-size:9;">
                            <?php
                            // Ambil semua record dari tabel laporan
                            if ($id_admin > 0) {
                                $statement = $koneksi->query("SELECT * FROM laporan, divisi WHERE laporan.tujuan = divisi.id_divisi AND laporan.tujuan = $id_admin ORDER BY laporan.id DESC");
                            } else {
                                $statement = $koneksi->query("SELECT * FROM laporan, divisi WHERE laporan.tujuan = divisi.id_divisi ORDER BY laporan.id DESC");
                            }

                            foreach ($statement as $key ) {
                                $mysqldate = $key['tanggal'];
                                $phpdate = strtotime($mysqldate);
                                $tanggal = date( 'd/m/Y', $phpdate);
                                ?>
                                <tr>
                                        <td><?php echo $key['nama']; ?></td>
                                        <td><?php echo $key['email']; ?></td>
                                        <td><?php echo $key['telpon']; ?></td>
                                        <td><?php echo $key['alamat']; ?></td>
                                        <td><?php echo $key['nama_divisi']; ?></td>
                                        <td><?php echo $key['isi']; ?></td>
                                        <td><?php echo $tanggal; ?></td>
                                        <td><a class="btn btn-danger" href="<?= 'user/public/' . $key['pdf_path'] ?>" download="<?= 'user/public/' . $key['pdf_path'] ?>">Download PDF</a></td>
                                        <td><?php echo $key['status']; ?></td>
                                        <td>
                                            <a class="btn btn-warning" href="edit.php?edit&id=<?= $key['id'] ?>">Edit</a>
                                        </td>
                                </tr>
                
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section><br><br><br>
            <div align="center">
                <?php
                $gmt_offset = 8; // Set the GMT offset to +8 hours
                $date = gmdate("d/m/Y");
                $jam = gmdate("H:i:s", time() + 3600 * $gmt_offset);

                echo "Laporan dicetak pada tanggal $date Jam $jam";
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Use the afterprint event to handle redirection after printing or canceling the print
        window.onafterprint = function() {
            window.location.href = 'index.php';
        };

        // Print the document
        window.print();
    </script>
</body>
</html>
