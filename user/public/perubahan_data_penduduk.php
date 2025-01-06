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
    <!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.min.css">
</head>

<body>

    <div class="shadow">
        <nav class="navbar navbar-fixed navbar-inverse form-shadow">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
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
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">LAYANAN <span class="caret"></span></a>
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
                        <li><a href="cara-2.php">CARA</a></li>
                        <li class="dropdown">
                            <a href="profildinas-2.php" class="dropdown-toggle" data-toggle="dropdown">PROFIL DINAS <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="profildinas-2.php">Profil Dinas</a></li>
                                <li class="divider"></li>
                                <li><a href="profildinas-2.php">Visi dan Misi</a></li>
                                <li class="divider"></li>
                                <li><a href="profildinas-2.php">Struktur Organisasi</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="../../login.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <h3>Form Surat Perubahan Elemen Data Kependudukan</h3>
            <hr/>
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                    <H5>Yang Bertanda Tangan di bawah ini</H5>
                        <div class="form-group">
                            <label for="no_kk" class="col-sm-2 control-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_kk" name="no_kk" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-2 control-label">Nomor KK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-2 control-label">Alamat Rumah</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                        </div>
                        <H5>Dengan Rincian KK sebagai berikut :</H5>
                        <div id="dynamic-nama">
                        <div class="nama-container">
                            <div class="form-group">
                                <label for="nama" class="col-sm-2 control-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama[]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="nik" class="col-sm-2 control-label">NIK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nik[]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="shdk" class="col-sm-2 control-label">SHDK</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="shdk[]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="keterangan[]" required>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: -20px; margin-bottom: 20px;">
                        <button type="button" id="add-nama" class="btn btn-success">Tambah Data</button>
                        <button type="button" id="remove-nama" class="btn btn-danger" style="display: none;">Hapus Data</button>
                    </div>
                        <H5>Menyatakan Bahwa data elemen data kependudukan saya dan anggota keluarga saya telah berubah, dengan rincian:</H5>
                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-2 control-label">Elemen Data</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Elemen Data --</option>
                                    <option value="surat_pindah">Pendidikan Terakhir</option>
                                    <option value="skpln">Pekerjaan</option>
                                    <option value="sktt">Agama</option>
                                    <option value="sktt">Lainnya</option>
                                </select>
                            </div>
                        </div>
                    

                        <!-- Dynamic form area -->
                    <div id="dynamic-form">
                        <div class="form-container">
                            <div class="form-group">
                                <label for="jenis_permohonan" class="col-sm-2 control-label">Elemen Data</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="jenis_permohonan[]" required>
                                        <option value="">-- Pilih Elemen Data --</option>
                                        <option value="pendidikan">Pendidikan Terakhir</option>
                                        <option value="pekerjaan">Pekerjaan</option>
                                        <option value="agama">Agama</option>
                                        <option value="lainnya">Lainnya</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="semula" class="col-sm-2 control-label">Semula</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="semula[]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="menjadi" class="col-sm-2 control-label">Menjadi</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="menjadi[]" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="dasar_perubahan" class="col-sm-2 control-label">Dasar Perubahan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="dasar_perubahan[]" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan[]" required></textarea>
                                </div>
                            </div>
                            <hr>
                        </div>
                    </div>
                    <div style="text-align: right; margin-top: -20px; margin-bottom: 20px;">
    <button type="button" id="add-field" class="btn btn-success">Tambah</button>
    <button type="button" id="remove-field" class="btn btn-danger" style="display: none;">Hapus</button>
</div>

                                                <!-- Upload PDF -->
                                                <div class="form-group">
                            <label for="pdfFile" class="col-sm-3 control-label">Unggah TTD Digital</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" id="pdfFile" name="pdfFile" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        const dynamicForm = document.getElementById('dynamic-form');
        const addButton = document.getElementById('add-field');
        const removeButton = document.getElementById('remove-field');

        // Add a new form field
        addButton.addEventListener('click', function () {
            const newField = `
                <div class="form-container">
                    <div class="form-group">
                        <label for="jenis_permohonan" class="col-sm-2 control-label">Elemen Data</label>
                        <div class="col-sm-10">
                            <select class="form-control" name="jenis_permohonan[]" required>
                                <option value="">-- Pilih Elemen Data --</option>
                                <option value="pendidikan">Pendidikan Terakhir</option>
                                <option value="pekerjaan">Pekerjaan</option>
                                <option value="agama">Agama</option>
                                <option value="lainnya">Lainnya</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="semula" class="col-sm-2 control-label">Semula</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="semula[]" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="menjadi" class="col-sm-2 control-label">Menjadi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="menjadi[]" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="dasar_perubahan" class="col-sm-2 control-label">Dasar Perubahan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="dasar_perubahan[]" required></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="keterangan[]" required></textarea>
                        </div>
                    </div>
                    <hr>
                </div>`;
            dynamicForm.insertAdjacentHTML('beforeend', newField);

            // Show the remove button if more than 1 form exists
            toggleRemoveButton();
        });

        // Remove the last form field
        removeButton.addEventListener('click', function () {
            const formContainers = dynamicForm.getElementsByClassName('form-container');
            if (formContainers.length > 1) {
                formContainers[formContainers.length - 1].remove();
            }
            // Hide the remove button if only 1 form remains
            toggleRemoveButton();
        });

        // Show or hide the remove button based on form count
        function toggleRemoveButton() {
            const formContainers = dynamicForm.getElementsByClassName('form-container');
            removeButton.style.display = formContainers.length > 1 ? 'inline-block' : 'none';
        }
        const dynamicNama = document.getElementById('dynamic-nama');
const addNamaButton = document.getElementById('add-nama');
const removeNamaButton = document.getElementById('remove-nama');

// Tambahkan elemen Nama, NIK, SHDK, dan Keterangan
addNamaButton.addEventListener('click', function () {
    const newNamaField = `
        <div class="nama-container">
            <div class="form-group">
                <label for="nama" class="col-sm-2 control-label">Nama</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama[]" required>
                </div>
            </div>
            <div class="form-group">
                <label for="nik" class="col-sm-2 control-label">NIK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="nik[]" required>
                </div>
            </div>
            <div class="form-group">
                <label for="shdk" class="col-sm-2 control-label">SHDK</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="shdk[]" required>
                </div>
            </div>
            <div class="form-group">
                <label for="keterangan" class="col-sm-2 control-label">Keterangan</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" name="keterangan[]" required>
                </div>
            </div>
            <hr>
        </div>`;
    dynamicNama.insertAdjacentHTML('beforeend', newNamaField);
    toggleRemoveNamaButton();
});

// Hapus elemen Nama, NIK, SHDK, dan Keterangan terakhir
removeNamaButton.addEventListener('click', function () {
    const namaContainers = dynamicNama.getElementsByClassName('nama-container');
    if (namaContainers.length > 1) {
        namaContainers[namaContainers.length - 1].remove();
    }
    toggleRemoveNamaButton();
});

// Tampilkan atau sembunyikan tombol hapus berdasarkan jumlah elemen
function toggleRemoveNamaButton() {
    const namaContainers = dynamicNama.getElementsByClassName('nama-container');
    removeNamaButton.style.display = namaContainers.length > 1 ? 'inline-block' : 'none';
}

    </script>
</body>

</html>
