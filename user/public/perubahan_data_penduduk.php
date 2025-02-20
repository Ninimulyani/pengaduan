<?php
session_start(); // Memulai session

// Periksa apakah pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    // Jika belum login, arahkan ke halaman login
    header("Location: login-user.php");
    exit();
}

require_once("../private/database.php");
$user_id = $_SESSION['user_id'];  // Menyimpan nik pengguna yang login

// Ambil status berdasarkan nik pengguna yang login
$sql = "SELECT status FROM pemohon WHERE user_id = :user_id ORDER BY id DESC LIMIT 5"; // Menampilkan 5 status terbaru
$stmt = $db->prepare($sql);
$stmt->execute(['user_id' => $user_id]);  // Bind nilai nik pada parameter :nik
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
    <!-- Validasi -->
    <script src="js/validasi.js"></script>
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
    <!-- Tambahkan link ke Font Awesome di dalam tag <head> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
</head>

<style>
.navbar {
    width: 100%;
    margin: 0;
    padding: 0;
}

#form-container {
    display: flex;
    flex-direction: column;
}

#submit-button {
    margin-top: auto;
}
</style>

<body style="width:100%; margin:0;">
    <div class="shadow">
        <nav class="navbar navbar-fixed navbar-inverse shadow-lg">
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
                            <a href="#"
                                class="dropdown-toggle flex items-center gap-2 text-gray-700 hover:text-gray-900"
                                data-toggle="dropdown">
                                <i class="fa fa-bell text-xl"></i>
                                <span class="badge bg-red-500 text-white rounded-full text-xs px-2 py-1">
                                    <?php echo count($notifications); ?>
                                </span> <!-- Menampilkan jumlah notifikasi -->
                            </a>
                            <ul class="dropdown-menu absolute right-0 mt-2 bg-white shadow-lg rounded-lg p-2 w-72"
                                role="menu" id="notificationDropdown">
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
                                                Perubahan Data "<span
                                                    class="font-semibold text-blue-600"><?= htmlspecialchars($notification['status']) ?></span>"
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
        <div class="main-content">
            <h1>Form Perubahan Data Penduduk</h1>
            <form id="form" action="process.php" method="POST" enctype="multipart/form-data">
                <h3>Data Pemohon</h3>
                <div class="form-group row">
                    <label for="nama_lengkap" class="col-sm-3 col-form-label">Nama Lengkap:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                            placeholder="Masukkan Nama Lengkap" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik_pemohon" class="col-sm-3 col-form-label">NIK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="nik_pemohon" name="nik_pemohon"
                            placeholder="Masukkan NIK" required onkeypress="return hanyaAngka(event)"
                            oninput="validatepemohon()" maxlength="16">
                        <small id="nikPemohonEror" class="text-danger"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_kk_pemohon" class="col-sm-3 col-form-label">Nomor KK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="no_kk_pemohon" name="no_kk_pemohon"
                            placeholder="Masukkan Nomor KK" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="alamat_rumah" class="col-sm-3 col-form-label">Alamat Rumah:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="alamat_rumah" name="alamat_rumah"
                            placeholder="Masukkan Alamat Rumah" required>
                    </div>
                </div>

                <input type="hidden" id="input_id" name="input_id" value="<?php echo rand(1000, 9999); ?>">


                <hr>
                <form id="form">
                    <h3>Data Anggota Keluarga</h3>
                    <div class="form-group row">
                        <label for="jumlah_anggota" class="col-sm-3 col-form-label">Jumlah Anggota Keluarga:</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="jumlah_anggota" min="1" value="1"
                                onchange="aturAnggota()">
                        </div>
                    </div>
                    <div id="anggota-container"></div>

                    <!-- Upload PDF -->
                    <div class="form-group">
                        <label for="pdfFile" class="col-sm-3 control-label">Kartu Keluarga</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="pdfFile" name="kartu_keluarga"
                                placeholder="Masukkan Nama Anggota Keluarga" required>
                        </div>
                    </div>

                    <!-- Upload PDF -->
                    <div class="form-group">
                        <label for="pdfFile" class="col-sm-3 control-label">Dokumen Pendukung</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="pdfFile" name="dokumen_pendukung" placeholder="Masukkan Dokumen Pendukung
                            " required>
                        </div>
                    </div>

                    <div class="submit-container">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>

                <script>
                function aturAnggota() {
                    const jumlahAnggota = document.getElementById('jumlah_anggota').value;
                    const container = document.getElementById('anggota-container');
                    container.innerHTML = ''; // Kosongkan container sebelum menambah anggota baru

                    for (let i = 0; i < jumlahAnggota; i++) {
                        const anggota = document.createElement('div');
                        anggota.id = `anggota${i}`;
                        anggota.innerHTML = `
                <h3>Anggota Keluarga ${i + 1}</h3>
                <div class="form-group row">
                    <label for="nama_${i}" class="col-sm-3 col-form-label">Nama:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nama[${i}]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="no_kk_${i}" class="col-sm-3 col-form-label">No KK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="no_kk[${i}]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nik_${i}" class="col-sm-3 col-form-label">NIK:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="nik[${i}]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="shdk_${i}" class="col-sm-3 col-form-label">Status Hubungan Keluarga:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="shdk[${i}]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="keterangan_${i}" class="col-sm-3 col-form-label">Keterangan:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="keterangan[${i}]" required>
                    </div>
                </div>
                <h4>Permohonan Perubahan</h4>
                <div id="permohonan-container-${i}">
                    ${buatPermohonanHTML(i, 0)}
                </div>
                <button type="button" class="btn btn-secondary" onclick="tambahPermohonan(${i})">Tambah Permohonan</button>
                <hr>
            `;
                        container.appendChild(anggota);
                    }
                }

                function buatPermohonanHTML(anggotaId, permohonanId) {
                    return `
            <div class="permohonan" id="permohonan-${anggotaId}-${permohonanId}">
                <div class="form-group row">
                    <label for="jenis_permohonan_${anggotaId}_${permohonanId}" class="col-sm-3 col-form-label">Jenis Permohonan:</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="jenis_permohonan[${anggotaId}][]" required>
                            <option value="pendidikan_terakhir">Pendidikan Terakhir</option>
                            <option value="agama">Agama</option>
                            <option value="pekerjaan">Pekerjaan</option>
                            <option value="lain_lain">Lain-lain</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="semula_${anggotaId}_${permohonanId}" class="col-sm-3 col-form-label">Semula:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="semula[${anggotaId}][]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="menjadi_${anggotaId}_${permohonanId}" class="col-sm-3 col-form-label">Menjadi:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="menjadi[${anggotaId}][]" required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="dasar_perubahan_${anggotaId}_${permohonanId}" class="col-sm-3 col-form-label">Dasar Perubahan:</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="dasar_perubahan[${anggotaId}][]" required>
                    </div>
                </div>
            </div>
                `;
                }

                function tambahPermohonan(anggotaId) {
                    const permohonanContainer = document.getElementById(`permohonan-container-${anggotaId}`);
                    const permohonanId = permohonanContainer.getElementsByClassName('permohonan').length;
                    const permohonanBaru = buatPermohonanHTML(anggotaId, permohonanId);
                    permohonanContainer.insertAdjacentHTML('beforeend', permohonanBaru);
                }

                // Jalankan fungsi aturAnggota() saat halaman pertama kali dimuat
                window.onload = aturAnggota;
                </script>

</body>

</html>