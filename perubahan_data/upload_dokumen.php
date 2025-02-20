<?php
require_once("../database.php"); // Koneksi DB
logged_admin();

// Ambil data dari database jika mode edit
if (isset($_GET['edit'])) {
    $id = $_GET['id'];
    $tampil = mysqli_query($koneksi, "SELECT * FROM pemohon WHERE id = '$id'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        // Ambil daftar dokumen lama dari database (format JSON)
        $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true) ?? [];
    }
}

// Perintah Mengubah Data
if (isset($_POST['submit'])) {
    $id = $_GET['id'];
    $dokumen_pemohon = [];

    // Ambil daftar file lama jika ada
    $tampil = mysqli_query($koneksi, "SELECT dokumen_pemohon FROM pemohon WHERE id = '$id'");
    $data = mysqli_fetch_array($tampil);

    if ($data) {
        $dokumen_pemohon = json_decode($data['dokumen_pemohon'], true) ?? [];
    }

    // Proses unggah file PDF jika ada file baru
    if (!empty($_FILES['dokumen_pemohon']['name'][0])) {
        foreach ($_FILES['dokumen_pemohon']['name'] as $key => $filename) {
            $pdf_tmp = $_FILES['dokumen_pemohon']['tmp_name'][$key];
            $pdf_destination = "uploads/" . time() . "_" . $filename; // Beri timestamp agar unik

            if (move_uploaded_file($pdf_tmp, $pdf_destination)) {
                $dokumen_pemohon[] = $pdf_destination; // Tambahkan ke daftar file
            } else {
                echo "<script>alert('Gagal mengunggah file $filename!');</script>";
            }
        }
    }

    // Simpan ke database dalam format JSON
    $dokumen_pemohon_json = mysqli_real_escape_string($koneksi, json_encode($dokumen_pemohon));

    // UPDATE ke tabel pemohon
    $query = "UPDATE pemohon SET dokumen_pemohon = '$dokumen_pemohon_json' WHERE id = '$id'";
    $simpan = mysqli_query($koneksi, $query);

    if ($simpan) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Diterima',
                    text: 'Dokumen Pemohon Telah di Kirim'
                }).then(() => {
                    window.location.href = 'index.php';
                });
            });
        </script>";
    } else {
        echo "<script>
                alert('Edit data Gagal! " . mysqli_error($koneksi) . "');
                document.location='index.php';
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
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="../data-akta-kematian/index.php">
                        <i class="fa fa-fw fa-table"></i>
                        <span class="nav-link-text">Data Kematian</span>
                    </a>
                </li>
                <li class="nav-item active" data-toggle="tooltip" data-placement="right" title="Tables">
                    <a class="nav-link" href="index.php">
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
                    <a class="nav-link" href="../data-kartu-indentitas-anak/index.php">
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
                <li class="breadcrumb-item active">Upload Dokumen Perubahan Data Penduduk</li>
            </ol>

            <div class="card mb-3">
                <div class="card-header">
                    <i class="fa fa-table"></i> Upload Dokumen Perubahan Data Penduduk
                </div>
                <div class="card-body mx-2 col-8">
                    <a href="index.php" class="btn btn-primary mb-3">Kembali</a>
                    <form method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <input type="file" class="form-control" id="dokumen_pemohon" name="dokumen_pemohon[]"
                                multiple accept=".pdf" onchange="previewFiles()">
                        </div>

                        <!-- Daftar file yang dipilih -->
                        <ul id="fileList" class="list-group mb-3"></ul>

                        <button type="submit" name="submit" class="btn btn-primary">Upload Data Pemohon</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    let selectedFiles = new DataTransfer(); // Simpan file yang sudah dipilih

    document.getElementById("dokumen_pemohon").addEventListener("change", function(event) {
        let fileList = document.getElementById("fileList");
        let newFiles = event.target.files;

        for (let i = 0; i < newFiles.length; i++) {
            let file = newFiles[i];

            // Validasi: hanya file PDF diperbolehkan
            if (file.type !== "application/pdf") {
                alert("Hanya file PDF yang diperbolehkan!");
                return;
            }

            // Validasi ukuran maksimal 2MB
            if (file.size > 2 * 1024 * 1024) {
                alert("Ukuran file terlalu besar! Maksimal 2MB.");
                return;
            }

            // Cek apakah file sudah ada dalam daftar
            let isDuplicate = false;
            for (let j = 0; j < selectedFiles.files.length; j++) {
                if (selectedFiles.files[j].name === file.name) {
                    isDuplicate = true;
                    break;
                }
            }

            if (!isDuplicate) {
                selectedFiles.items.add(file);

                // Tambahkan ke daftar tampilan
                let listItem = document.createElement("li");
                listItem.className = "list-group-item d-flex justify-content-between align-items-center";
                listItem.textContent = file.name;

                // Tombol hapus
                let deleteButton = document.createElement("button");
                deleteButton.className = "btn btn-danger btn-sm";
                deleteButton.textContent = "Hapus";
                deleteButton.onclick = function() {
                    removeFile(file.name);
                };

                listItem.appendChild(deleteButton);
                fileList.appendChild(listItem);
            }
        }

        // Update input file dengan file yang sudah dipilih
        document.getElementById("dokumen_pemohon").files = selectedFiles.files;
    });

    function removeFile(fileName) {
        let fileList = document.getElementById("fileList");
        let newDataTransfer = new DataTransfer();

        for (let i = 0; i < selectedFiles.files.length; i++) {
            if (selectedFiles.files[i].name !== fileName) {
                newDataTransfer.items.add(selectedFiles.files[i]);
            }
        }

        selectedFiles = newDataTransfer;
        document.getElementById("dokumen_pemohon").files = selectedFiles.files;

        // Perbarui tampilan daftar file
        fileList.innerHTML = "";
        for (let i = 0; i < selectedFiles.files.length; i++) {
            let listItem = document.createElement("li");
            listItem.className = "list-group-item d-flex justify-content-between align-items-center";
            listItem.textContent = selectedFiles.files[i].name;

            let deleteButton = document.createElement("button");
            deleteButton.className = "btn btn-danger btn-sm";
            deleteButton.textContent = "Hapus";
            deleteButton.onclick = function() {
                removeFile(selectedFiles.files[i].name);
            };

            listItem.appendChild(deleteButton);
            fileList.appendChild(listItem);
        }
    }
    </script>
</body>

</html>