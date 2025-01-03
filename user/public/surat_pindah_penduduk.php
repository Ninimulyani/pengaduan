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
                        <li class="active"><a href="layanan.php">LAYANAN</a></li>
                        <li><a href="lihat.php">LIHAT PENGADUAN</a></li>
                        <li><a href="cara-2.php">CARA</a></li>
                        <li><a href="faq-2.php">FAQ</a></li>
                        <li><a href="bantuan-2.php">BANTUAN</a></li>
                        <li><a href="kontak-2.php">KONTAK</a></li>
                        <li><a href="../../login.php">LOGOUT</a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="main-content">
            <h3>Form Surat Keterangan Kependudukan</h3>
            <hr/>
            <div class="row">
                <div class="col-md-13 card-shadow-2 form-custom">
                    <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="no_kk" class="col-sm-2 control-label">No KK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="no_kk" name="no_kk" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nama Lengkap Pemohon</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nik" class="col-sm-2 control-label">NIK</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nik" name="nik" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="jenis_permohonan" class="col-sm-2 control-label">Jenis Permohonan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Jenis Permohonan --</option>
                                    <option value="surat_pindah">Surat Keterangan Pindah</option>
                                    <option value="skpln">Surat Keterangan Pindah Luar Negeri (SKPLN)</option>
                                    <option value="sktt">Surat Keterangan Tempat Tinggal (SKTT)</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="alamat_jelas" class="col-sm-2 control-label">Alamat Jelas</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_jelas" name="alamat_jelas" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa" name="desa" required></input>
                            </div>
                            <label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan" name="kecamatan" required></input>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kebupaten" name="kabupaten" required></input>
                            </div>
                            <label for="provinsi" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi" name="provinsi" required></input>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="kodepos" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kodepos" name="kodepos" required></input>
                            </div>
                        </div>  

                        <div class="form-group">
                        <label for="jenis_permohonan" class="col-sm-3 control-label">Jenis Pindah</label>
                            <div class="col-sm-5">
                                <select class="form-control" id="jenis_permohonan" name="jenis_permohonan" required>
                                    <option value="">-- Pilih Jenis Pindah --</option>
                                    <option value="surat_pindah">ADalam satu desa/kelurahan atau yang disebut dengan nama lain</option>
                                    <option value="surat_pindah">Antar desa/kelurahan atau yang disebut dengan nama lain dalam satu kecamatan</option>
                                    <option value="skpln">Antar kecamatan atau yang disebut dengan nama lain dalam satu kabupaten/kota</option>
                                    <option value="sktt">Antar kabupaten/kota dalam satu provinsi</option>
                                    <option value="sktt">Antar provinsi</option>
                                </select>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="alamat_pindah" class="col-sm-2 control-label">Alamat Pindah</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="alamat_pindah" name="alamat_pindah" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="desa" class="col-sm-3 control-label">Desa/ Kelurahan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="desa" name="desa" required></input>
                            </div>
                            <label for="kecamatan" class="col-sm-3 control-label">Kecamatan</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kecamatan" name="kecamatan" required></input>
                            </div>
                        </div> 

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-3 control-label">Kabupaten/Kota</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="kebupaten" name="kabupaten" required></input>
                            </div>
                            <label for="provinsi" class="col-sm-3 control-label">Provinsi</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="provinsi" name="provinsi" required></input>
                            </div>
                        </div>  

                        <div class="form-group">
                            <label for="kodepos" class="col-sm-3 control-label">Kode Pos</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control" id="kodepos" name="kodepos" required></input>
                            </div>
                        </div>  
                        
                        <div class="form-group">
                            <label for="alasan_pindah" class="col-sm-2 control-label">Alasan Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="alasan_pindah" name="alasan_pindah" required>
                                    <option value="">-- Pilih Alasan Pindah --</option>
                                    <option value="pekerjaan">Pekerjaan</option>
                                    <option value="pendidikan">Pendidikan</option>
                                    <option value="lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                                                
                        
                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Jenis Kepindahan</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
                                    <option value="">-- Pilih Jenis Kepindahan --</option>
                                    <option value="kk_baru">Kepala Keluarga</option>
                                    <option value="numpang_kk">Kepala Keluarga dan seluruh Anggota Keluarag</option>
                                    <option value="kk_baru">Kepala Keluarga dan sebagian Anggota Keluarga</option>
                                    <option value="numpang_kk">Anggota Keluarag</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Anggota Keluarga Tidak Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
                                    <option value="">-- Pilih Anggota Keluarga Tidak Pindah --</option>
                                    <option value="kk_baru">Membuat KK Baru</option>
                                    <option value="numpang_kk">Numpang KK</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jenis_kepindahan" class="col-sm-2 control-label">Anggota Keluarga yang Pindah</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="jenis_kepindahan" name="jenis_kepindahan" required>
                                    <option value="">-- Pilih Anggota Keluarga yang Pindah --</option>
                                    <option value="kk_baru">Membuat KK Baru</option>
                                    <option value="numpang_kk">Numpang KK</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Daftar Anggota Keluarga yang Pindah</label>
                        </div>

                        <div class="form-group">
                            <label for="kabupaten" class="col-sm-1 control-label">No</label>
                            <label for="kabupaten" class="col-sm-3 control-label">NIK</label>
                            <label for="kabupaten" class="col-sm-5 control-label">NAMA LENGKAP</label>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-1">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" required>
                            </div>
                        </div>

                        <div mb-2>
                        <label mb-10>Diisi oleh penduduk (Orang Asing) Pemegang ITAS yang Mengajukan SKTT dan OA Pemegang SKTT dan OA pemengang ITAP yang Mengajukan Surat Keterangan Kependudukan Lain nya
                        </label>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nama Sponsor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama_sponsor" name="nama_sponsor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tipe_sponsor" class="col-sm-2 control-label">Tipe Sponsor</label>
                            <div class="col-sm-10">
                                <select class="form-control" id="tipe_sponsor" name="tipe_sponsor" required>
                                    <option value="">-- Pilih Tipe Sponsor --</option>
                                    <option value="kk_baru">Organisasi Internasional</option>
                                    <option value="numpang_kk">Perorangan</option>
                                    <option value="kk_baru">Pemerintah</option>
                                    <option value="numpang_kk">Tanpa Sponsor</option>
                                    <option value="numpang_kk">Perusahaan</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Alamat Sponsor</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_sponsor" name="alamat_sponsor" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Nomor dan Tanggal ITAS & ITAP</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="nomotitap" name="nomotitap" required>
                            </div>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="tanggalitap" name="tanggalitap" required>
                            </div>
                        </div>

                        <div mb-2>
                        <label class="control-label" >Diisi oleh Penduduk yang Mengajukan Surat Keterangan Pindah Luar Negeri</label>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Negara Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="negara_tujuan" name="negara_tujuan" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Alamat Tujuan</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="alamat_tujuan" name="alamat_tujuan" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pemohon" class="col-sm-2 control-label">Penanggung Jawab</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tanggal_pindah" class="col-sm-2 control-label">Rencana Tanggal Pindah</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="tanggal_pindah" name="tanggal_pindah" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="telepon" class="col-sm-2 control-label">Nomor Handphone</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" id="telepon" name="telepon" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" name="email" required>
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

</body>

</html>
