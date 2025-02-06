<?php
session_start(); // Memulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php");
$nik = $_SESSION['nik'];  // Menyimpan nik pengguna yang login

// Ambil status berdasarkan nik pengguna yang login
$sql = "SELECT status FROM perubahan_data_penduduk WHERE nik = :nik ORDER BY id DESC LIMIT 5"; // Menampilkan 5 status terbaru
$stmt = $db->prepare($sql);
$stmt->execute(['nik' => $nik]);  // Bind nilai nik pada parameter :nik
$notifications = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <title>Kantor Kecamatan Tanralili</title>
    <link rel="shortcut icon" href="images/logomaros.png" width="20">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- font Awesome CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <!-- Main Styles CSS -->
    <link href="css/style.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="js/bootstrap.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <script>
        let anggotaCount = 0; // Menyimpan jumlah anggota keluarga yang ada

        // Fungsi untuk menambah anggota keluarga baru
        function tambahAnggota() {
            anggotaCount++; // Menambah hitungan anggota keluarga

            // Membuat elemen anggota keluarga baru
            const anggotaBaru = document.createElement("div");
            anggotaBaru.id = "anggota" + anggotaCount; // ID unik berdasarkan jumlah anggota
            anggotaBaru.classList.add("anggota-keluarga");

            anggotaBaru.innerHTML = `
        <h3>Anggota Keluarga ${anggotaCount}</h3>
        <div class="form-group row">
            <label for="nama_${anggotaCount}" class="col-sm-3 col-form-label">Nama:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_${anggotaCount}" name="nama[${anggotaCount}]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="no_kk_${anggotaCount}" class="col-sm-3 col-form-label">No KK:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="no_kk_${anggotaCount}" name="no_kk[${anggotaCount}]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="nik_${anggotaCount}" class="col-sm-3 col-form-label">NIK:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="nik_${anggotaCount}" name="nik[${anggotaCount}]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="shdk_${anggotaCount}" class="col-sm-3 col-form-label">Status Hubungan Keluarga:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="shdk_${anggotaCount}" name="shdk[${anggotaCount}]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="keterangan_${anggotaCount}" class="col-sm-3 col-form-label">Keterangan:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" id="keterangan_${anggotaCount}" name="keterangan[${anggotaCount}]" required>
            </div>
        </div>
        <h4>Permohonan Perubahan</h4>
        <div id="permohonan${anggotaCount}">
            <div class="form-group row">
                <label for="jenis_permohonan_${anggotaCount}" class="col-sm-3 col-form-label">Jenis Permohonan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jenis_permohonan_${anggotaCount}" name="jenis_permohonan[${anggotaCount}][]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="jenis_permohonan_lainnya_${anggotaCount}" class="col-sm-3 col-form-label">Jenis Lainnya:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="jenis_permohonan_lainnya_${anggotaCount}" name="jenis_permohonan_lainnya[${anggotaCount}][]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="semula_${anggotaCount}" class="col-sm-3 col-form-label">Semula:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="semula_${anggotaCount}" name="semula[${anggotaCount}][]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="menjadi_${anggotaCount}" class="col-sm-3 col-form-label">Menjadi:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="menjadi_${anggotaCount}" name="menjadi[${anggotaCount}][]" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="dasar_perubahan_${anggotaCount}" class="col-sm-3 col-form-label">Dasar Perubahan:</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" id="dasar_perubahan_${anggotaCount}" name="dasar_perubahan[${anggotaCount}][]" required>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-secondary" onclick="tambahPermohonan(${anggotaCount})">Tambah Permohonan</button><br><br>
        <button type="button" class="btn btn-danger" onclick="hapusAnggota(${anggotaCount})">Hapus Anggota</button>
    `;

            // Menambahkan elemen anggota keluarga ke dalam form
            document.getElementById("form").appendChild(anggotaBaru);
        }

        // Fungsi untuk menghapus anggota keluarga berdasarkan ID
        function hapusAnggota(anggotaId) {
            const anggotaDiv = document.getElementById("anggota" + anggotaId);
            if (anggotaDiv) {
                anggotaDiv.remove(); // Menghapus elemen anggota keluarga dari DOM
            }
        }

        // Fungsi untuk menambahkan permohonan baru untuk anggota keluarga
        function tambahPermohonan(anggotaId) {
            const permohonanContainer = document.getElementById('permohonan' + anggotaId);
            const permohonanBaru = document.createElement("div");
            permohonanBaru.classList.add("form-group", "row");
            permohonanBaru.innerHTML = `
        <div class="form-group row">
            <label for="jenis_permohonan_${anggotaId}" class="col-sm-3 col-form-label">Jenis Permohonan:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="jenis_permohonan[${anggotaId}][]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="jenis_permohonan_lainnya_${anggotaId}" class="col-sm-3 col-form-label">Jenis Lainnya:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="jenis_permohonan_lainnya[${anggotaId}][]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="semula_${anggotaId}" class="col-sm-3 col-form-label">Semula:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="semula[${anggotaId}][]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="menjadi_${anggotaId}" class="col-sm-3 col-form-label">Menjadi:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="menjadi[${anggotaId}][]" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="dasar_perubahan_${anggotaId}" class="col-sm-3 col-form-label">Dasar Perubahan:</label>
            <div class="col-sm-9">
                <input type="text" class="form-control" name="dasar_perubahan[${anggotaId}][]" required>
            </div>
        </div>
    `;
            permohonanContainer.appendChild(permohonanBaru);
        }
    </script>

</head>

<style>
    .navbar {
        width: 100%;
        margin: 0;
        padding: 0;
    }
</style>

<body style="width:100%; margin:0;">

    <div class="shadow">
        <nav class="navbar navbar-fixed navbar-inverse form-shadow">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="home.php">
                        <img alt="Brand" src="images/logomaros.png" style="width: 50px;">
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="home-2.php">HOME</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">LAYANAN <span
                                    class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="akta_kelahiran.php">Akta Kelahiran</a></li>
                                <li class="divider"></li>
                                <li><a href="kartu_identitas_anak.php">Kartu Identitas Anak</a></li>
                                <li class="divider"></li>
                                <li><a href="akta_kematian.php">Akta Kematian</a></li>
                                <li class="divider"></li>
                                <li><a href="perubahan_data_penduduk.php">Perubahan Data Penduduk</a></li>
                                <li class="divider"></li>
                                <li><a href="surat_pindah_penduduk.php">Surat Pindah Penduduk</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <li><a href="status.php">STATUS</a></li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="login-user.php">LOGOUT</a></li>

                        <li class="dropdown pull-right relative">
                            <a href="#" class="dropdown-toggle flex items-center gap-2 text-gray-700 hover:text-gray-900" data-toggle="dropdown">
                                <i class="fa fa-bell text-xl"></i>
                                <span class="badge bg-red-500 text-white rounded-full text-xs px-2 py-1">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Menampilkan jumlah notifikasi -->
                            </a>
                            <ul class="dropdown-menu absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 w-72" role="menu" id="notificationDropdown">
                                <?php if (!empty($notifications)): ?>
                                    <?php foreach ($notifications as $notification): ?>
                                        <li class="border-b last:border-none">
                                            <a href="#" class="flex items-center gap-3 p-2 hover:bg-gray-100 rounded-md">
                                                <!-- Icon berdasarkan status -->
                                                <span class="bg-blue-500 text-white rounded-full p-2">
                                                    <?php if ($notification['status'] == 'Selesai'): ?>
                                                        <i class="fa fa-check-circle"></i>
                                                    <?php elseif ($notification['status'] == 'Pending'): ?>
                                                        <i class="fa fa-exclamation-circle"></i>
                                                    <?php else: ?>
                                                        <i class="fa fa-info-circle"></i>
                                                    <?php endif; ?>
                                                </span>
                                                <!-- Isi notifikasi -->
                                                <div>
                                                    <p class="font-medium text-gray-800">
                                                        Perubahan Data "<span class="font-semibold text-blue-600"><?= htmlspecialchars($notification['status']) ?></span>"
                                                    </p>
                                                    <!-- <span class="text-sm text-gray-500">Klik untuk melihat detail</span> -->
                                                </div>
                                            </a>
                                        </li>
                                        <hr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="p-2 text-center text-gray-500">
                                        <i class="fa fa-info-circle text-lg"></i> Tidak ada notifikasi baru.
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container">
            <h1>Form Perubahan Data Penduduk</h1>
            <form id="form" action="process.php" method="POST">
                <h3>Data Pemohon</h3>
                <div class="form-group row">
                    <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik_pemohon" class="col-sm-3 col-form-label">NIK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nik_pemohon" name="nik_pemohon" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_kk_pemohon" class="col-sm-3 col-form-label">Nomor KK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_kk_pemohon" name="no_kk_pemohon" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat_rumah" class="col-sm-3 col-form-label">Alamat Rumah:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah" required>
                    </div>
                </div>

                <hr>
                <h3>Data Anggota Keluarga</h3>
                <button type="button" class="btn btn-primary" onclick="tambahAnggota()">Tambah Anggota Keluarga</button><br><br>
                <div id="anggota1">
                    <h3>Anggota Keluarga 1</h3>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-3 col-form-label">Nama:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nama[0]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="no_kk" class="col-sm-3 col-form-label">No KK:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="no_kk[0]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nik" class="col-sm-3 col-form-label">NIK:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="nik[0]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="shdk" class="col-sm-3 col-form-label">Status Hubungan Keluarga:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="shdk[0]" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="keterangan[0]" required>
                        </div>
                    </div>
                    <h4>Permohonan Perubahan</h4>
                    <div id="permohonan0">
                        <div class="form-group row">
                            <label for="jenis_permohonan" class="col-sm-3 col-form-label">Jenis Permohonan:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jenis_permohonan[0][]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="jenis_permohonan_lainnya" class="col-sm-3 col-form-label">Jenis Lainnya:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="jenis_permohonan_lainnya[0][]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="semula" class="col-sm-3 col-form-label">Semula:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="semula[0][]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="menjadi" class="col-sm-3 col-form-label">Menjadi:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="menjadi[0][]" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="dasar_perubahan" class="col-sm-3 col-form-label">Dasar Perubahan:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="dasar_perubahan[0][]" required>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-secondary" onclick="tambahPermohonan(0)">Tambah Permohonan</button><br><br>
                </div>

                <div id="submit-container" class="submit-container">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>

            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>