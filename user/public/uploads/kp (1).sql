-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2025 at 04:14 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kp`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `divisi`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Table structure for table `akta_kelahiran`
--

CREATE TABLE `akta_kelahiran` (
  `id` int(255) NOT NULL,
  `nama_pelapor` varchar(322) NOT NULL,
  `nik_pelapor` int(255) NOT NULL,
  `nomor_dokumen_perjalanan` int(255) NOT NULL,
  `nomor_kartu_keluarga_pelapor` int(255) NOT NULL,
  `kewarganegaraan_pelapor` varchar(255) NOT NULL,
  `nomor_handphone` int(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `nama_saksi_1` varchar(225) NOT NULL,
  `nik_saksi_1` int(255) NOT NULL,
  `nomor_kartu_keluarga_saksi_1` int(50) NOT NULL,
  `kewarganegaraan_saksi_1` varchar(50) NOT NULL,
  `nama_ayah` varchar(55) NOT NULL,
  `nik_ayah` int(50) NOT NULL,
  `tempat_lahir_ayah` varchar(50) NOT NULL,
  `tanggal_lahir_ayah` date NOT NULL,
  `kewarganegaraan_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(50) NOT NULL,
  `nik_ibu` varchar(50) NOT NULL,
  `tempat_lahir_ibu` varchar(50) NOT NULL,
  `tanggal_lahir_ibu` varchar(50) NOT NULL,
  `kewarganegaraan_ibu` varchar(50) NOT NULL,
  `nama_anak` varchar(255) NOT NULL,
  `jk_anak` enum('laki_laki','perempuan') NOT NULL,
  `tempat_lahir` enum('RS/RB','Puskesmas','Polindes','Rumah','Lainnya') NOT NULL,
  `tanggal_lahir_anak` date NOT NULL,
  `pukul` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `jenis_kelahiran` enum('Tunggal','Kembar 2','Kembar 3','Kembar 4','Lainnya') NOT NULL,
  `kelahiran_ke` int(50) NOT NULL,
  `penolong_kelahiran` varchar(50) NOT NULL,
  `bb_bayi` int(50) NOT NULL,
  `pb` int(50) NOT NULL,
  `dokumen` varchar(50) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akta_kelahiran`
--

INSERT INTO `akta_kelahiran` (`id`, `nama_pelapor`, `nik_pelapor`, `nomor_dokumen_perjalanan`, `nomor_kartu_keluarga_pelapor`, `kewarganegaraan_pelapor`, `nomor_handphone`, `email`, `nama_saksi_1`, `nik_saksi_1`, `nomor_kartu_keluarga_saksi_1`, `kewarganegaraan_saksi_1`, `nama_ayah`, `nik_ayah`, `tempat_lahir_ayah`, `tanggal_lahir_ayah`, `kewarganegaraan_ayah`, `nama_ibu`, `nik_ibu`, `tempat_lahir_ibu`, `tanggal_lahir_ibu`, `kewarganegaraan_ibu`, `nama_anak`, `jk_anak`, `tempat_lahir`, `tanggal_lahir_anak`, `pukul`, `jenis_kelahiran`, `kelahiran_ke`, `penolong_kelahiran`, `bb_bayi`, `pb`, `dokumen`, `status`, `user_id`) VALUES
(1, 'fsfdsfds', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '2025-01-02', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '7878-07-08', 'hjbjhg', 'jlkj', '', 'RS/RB', '8667-06-07', '2025-01-09 14:30:52.959558', 'Tunggal', 323, 'Dokter', 32, 32, 'kp.sql', NULL, NULL),
(2, 'fsfdsfdsgfg', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '3333-12-31', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '3333-03-23', 'hjbjhg', 'jlkj', '', 'RS/RB', '1111-11-13', '2025-01-09 15:12:34.156134', 'Tunggal', 323, 'Dokter', 32, 32, 'kp.sql', NULL, NULL),
(3, 'fsfdsfdsgfg', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '3333-12-31', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '3333-03-23', 'hjbjhg', 'jlkj', '', 'RS/RB', '1111-11-13', '2025-01-09 15:12:36.830576', 'Tunggal', 323, 'Dokter', 32, 32, 'kp.sql', NULL, NULL),
(4, 'fsfdsfdsgfg', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '2332-03-23', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '0023-03-23', 'hjbjhg', 'jlkj', 'perempuan', 'RS/RB', '0002-03-23', '2025-01-16 13:45:47.741040', 'Kembar 2', 323, 'Dokter', 32, 32, 'MicrosoftProgram_Install_and_Uninstall.meta.diagca', NULL, NULL),
(5, 'fsfdsfdsgfg', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '2332-03-23', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '0023-03-23', 'hjbjhg', 'jlkj', 'perempuan', 'RS/RB', '0002-03-23', '2025-01-16 13:47:32.976448', 'Kembar 2', 323, 'Dokter', 32, 32, 'MicrosoftProgram_Install_and_Uninstall.meta.diagca', NULL, 28),
(9, 'abuu', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '2122-02-21', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '2122-02-12', 'hjbjhg', 'jlkj', '', 'Puskesmas', '1212-02-12', '2025-01-16 15:01:22.363243', 'Kembar 2', 323, 'Dokter', 32, 32, 'MicrosoftProgram_Install_and_Uninstall.meta.diagca', NULL, 27),
(10, 'gonzalo', 43242, 32312, 3232, 'ewadssa', 312321, 'dsda@sads.gmail', 'fdsfsd', 43242, 43242, 'dsf', 'jkhjkhjk', 8798789, 'hjghjg', '1212-02-12', 'Indonesia', 'jklj', 'hjjkhj', 'jbkj', '2323-03-23', 'hjbjhg', 'gonzalo', '', 'RS/RB', '0232-03-23', '2025-01-16 15:06:34.003582', 'Kembar 2', 323, 'Dokter', 32, 32, 'MicrosoftProgram_Install_and_Uninstall.meta.diagca', NULL, 29);

-- --------------------------------------------------------

--
-- Table structure for table `akta_kematian`
--

CREATE TABLE `akta_kematian` (
  `id` int(11) NOT NULL,
  `nama_pelapor` varchar(100) NOT NULL,
  `nik_pelapor` varchar(16) NOT NULL,
  `nomor_dokumen_perjalanan` varchar(50) DEFAULT NULL,
  `nomor_kartu_keluarga_pelapor` varchar(16) NOT NULL,
  `kewarganegaraan_pelapor` varchar(50) NOT NULL,
  `nomor_handphone` varchar(15) NOT NULL,
  `email` varchar(100) NOT NULL,
  `nama_saksi_1` varchar(100) NOT NULL,
  `nik_saksi_1` varchar(16) NOT NULL,
  `nomor_kartu_keluarga_saksi_1` varchar(16) NOT NULL,
  `kewarganegaraan_saksi_1` varchar(50) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nik_ayah` varchar(16) NOT NULL,
  `tempat_lahir_ayah` varchar(100) NOT NULL,
  `tanggal_lahir_ayah` date NOT NULL,
  `kewarganegaraan_ayah` varchar(50) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `nik_ibu` varchar(16) NOT NULL,
  `tempat_lahir_ibu` varchar(100) NOT NULL,
  `tanggal_lahir_ibu` date NOT NULL,
  `kewarganegaraan_ibu` varchar(50) NOT NULL,
  `nik_alm` varchar(16) NOT NULL,
  `nama_lengkap_alm` varchar(100) NOT NULL,
  `hari_tanggal_kematian` date NOT NULL,
  `pukul` time NOT NULL,
  `sebab_kematian` enum('Sakit Biasa','Tua') NOT NULL,
  `tempat_kematian` varchar(100) NOT NULL,
  `yang_menerangkan` varchar(100) NOT NULL,
  `dokumen_persyaratan` varchar(255) DEFAULT NULL,
  `tanggal_input` date NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `akta_kematian`
--

INSERT INTO `akta_kematian` (`id`, `nama_pelapor`, `nik_pelapor`, `nomor_dokumen_perjalanan`, `nomor_kartu_keluarga_pelapor`, `kewarganegaraan_pelapor`, `nomor_handphone`, `email`, `nama_saksi_1`, `nik_saksi_1`, `nomor_kartu_keluarga_saksi_1`, `kewarganegaraan_saksi_1`, `nama_ayah`, `nik_ayah`, `tempat_lahir_ayah`, `tanggal_lahir_ayah`, `kewarganegaraan_ayah`, `nama_ibu`, `nik_ibu`, `tempat_lahir_ibu`, `tanggal_lahir_ibu`, `kewarganegaraan_ibu`, `nik_alm`, `nama_lengkap_alm`, `hari_tanggal_kematian`, `pukul`, `sebab_kematian`, `tempat_kematian`, `yang_menerangkan`, `dokumen_persyaratan`, `tanggal_input`, `status`) VALUES
(1, 'yuyul', '7898765434567890', '1', '2', 'Indonesia', '09876543234567', 'yuyul@gmail.com', 'sak', '756543567845675', '5', 'amerika', 'zunaidin', '77654324567898', 'kampung', '1994-03-06', 'subang', 'ende', '76545678654345', 'bandung', '1995-10-06', 'jaksel', '7543456789876', 'ayoo', '1323-02-21', '03:02:00', '', 'Gedung shopee', 'satpol pp', 'Tugas Web Messenger Genesys_Sri.pdf', '2025-01-06', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `data_anak`
--

CREATE TABLE `data_anak` (
  `id` int(11) NOT NULL,
  `nik_anak` varchar(16) NOT NULL,
  `nomor_akta_kelahiran` varchar(50) NOT NULL,
  `nama_anak` varchar(100) NOT NULL,
  `tempat_lahir` varchar(100) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `anak_ke` int(11) NOT NULL,
  `nama_ayah` varchar(100) NOT NULL,
  `nama_ibu` varchar(100) NOT NULL,
  `alamat_pemohon` text NOT NULL,
  `pdf_path` varchar(255) DEFAULT NULL,
  `tanggal_input` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_anak`
--

INSERT INTO `data_anak` (`id`, `nik_anak`, `nomor_akta_kelahiran`, `nama_anak`, `tempat_lahir`, `tanggal_lahir`, `anak_ke`, `nama_ayah`, `nama_ibu`, `alamat_pemohon`, `pdf_path`, `tanggal_input`, `status`) VALUES
(1, '244324', '32131', 'dsada', 'sda', '1212-02-21', 1, 'qwq', 'ewq', 'dsada', NULL, '2025-01-06 09:13:50', 'Menunggu');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Pengelolaan Informasi Administrasi Kependudukan'),
(2, 'Pemanfaatan Data Dan Inovasi Pelayanan'),
(3, 'Pelayanan Pencatatan Sipil'),
(4, 'Pelayanan Pendaftaran Penduduk'),
(8, 'Lainnya');

-- --------------------------------------------------------

--
-- Table structure for table `ketua_rt`
--

CREATE TABLE `ketua_rt` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ketua_rt`
--

INSERT INTO `ketua_rt` (`id`, `username`, `password`) VALUES
(1, 'ketuart', '827ccb0eea8a706c4c34a16891f84e7b');

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `email` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `isi_komentar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `email`, `isi_komentar`) VALUES
(19, 'nurulmagfiraht@gmail.com', 'menarik'),
(20, 'srimulyani.nini@gmail.com', 'bagus'),
(21, 'ken@gmail.com', 'pelayanan cepat'),
(22, 'nini@gmail.com', 'keren'),
(23, 'srimulyani.nini@gmail.com', 'bagus');

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `id` int(11) NOT NULL,
  `nama` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `telpon` varchar(12) NOT NULL,
  `alamat` varchar(256) NOT NULL,
  `tujuan` int(11) NOT NULL,
  `isi` varchar(2048) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(12) NOT NULL,
  `komentar` text NOT NULL,
  `pdf_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `laporan`
--

INSERT INTO `laporan` (`id`, `nama`, `email`, `telpon`, `alamat`, `tujuan`, `isi`, `tanggal`, `status`, `komentar`, `pdf_path`) VALUES
(1, 'Andi Sri Mulyani', 'srimulyani.nini@gmail.com', '081354888872', 'daya', 1, 'pendaftaran biodata penduduk', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/user_public_uploads_07 PM Regresi Linier ok.pdf'),
(2, 'maya eka', 'maya@gmailc.om', '081354888872', 'pk8', 2, 'pendaftaran akte kelahiran', '2024-01-09 02:05:04', 'Menunggu', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(3, 'ares', 'ares@gamil.com', '085346732345', 'rumah', 2, 'pendaftaran akte kelahiran', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(5, 'niana', 'nia@gmail.com', '081354888872', 'perintis', 1, 'pembuatan ktp', '2024-01-08 05:19:33', 'Menunggu', '', 'uploads/Tabel common Anoda katoda.pdf'),
(6, 'roy', 'roy@gmail.com', '089786543522', 'tanjung bunga', 1, 'pendaftaran biodata penduduk', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/Bab04-Mendapatkan Input dari Keyboard.pdf'),
(7, 'rehan', 'rehan@gmail.com', '098765432234', 'rumah', 3, 'administrasi penduduk', '2024-01-08 11:04:38', 'Menunggu', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(11, 'kucing', 'ken@gmail.com', 'kcsljcslakjf', 'btp', 1, ',zxlkjlkjlasjdlask', '2024-01-08 12:05:11', 'Menunggu', '', 'uploads/212094_NUR FADILLA_Tugas3.pdf'),
(12, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', '081354888872', 'Jl.Mangga Tiga', 3, 'Pendaftaran Akte Kelahiran', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/5_6208532310501885595.pdf'),
(13, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', 'yguhujkl', 'ghjk', 1, 'jhgf', '2024-01-11 04:02:29', 'Menunggu', '', 'uploads/212126 Andi Sri Mulyani.pdf'),
(14, 'Andi Sri Mulyani', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 1, 'administrasi penduduk', '2024-01-11 04:10:44', 'Menunggu', '', ''),
(15, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', '085346732345', 'btp', 1, 'ijuyt', '2024-01-11 04:14:38', 'Menunggu', '', ''),
(16, 'nini', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 3, 'administrasi', '2024-01-11 04:31:56', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(17, 'nini', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 3, 'administrasi', '2024-01-11 04:32:30', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(19, 'renal', 'renal@gmail.com', '089673837474', 'jl. sangir', 4, 'pendaftaran penduduk baru', '2024-01-11 04:34:58', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(20, 'yanto', 'yanto@gmail.com', '081354888872', 'sudiang', 3, 'pendaftaran akte perkawinan', '2024-01-16 02:24:00', 'Menunggu', '', 'uploads/user_public_uploads_user_public_uploads_07 PM Regresi Linier ok.pdf'),
(21, 'veni', 'venI@gmail.com', '08657345678', 'rumah', 1, 'administrasi penduduk', '2024-01-16 02:25:39', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `perubahan_data_penduduk`
--

CREATE TABLE `perubahan_data_penduduk` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `nomor_kk` varchar(16) NOT NULL,
  `alamat_rumah` text NOT NULL,
  `rincian_kk` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`rincian_kk`)),
  `perubahan_elemen_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`perubahan_elemen_data`)),
  `unggah_ttd_digital` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `surat_pindah_penduduk`
--

CREATE TABLE `surat_pindah_penduduk` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nama_lengkap_pemohon` varchar(100) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `jenis_permohonan` varchar(50) NOT NULL,
  `alamat_jelas` text NOT NULL,
  `desa_kelurahan_asal` varchar(100) NOT NULL,
  `kecamatan_asal` varchar(100) NOT NULL,
  `kabupaten_kota_asal` varchar(100) NOT NULL,
  `provinsi_asal` varchar(100) NOT NULL,
  `kode_pos_asal` varchar(10) DEFAULT NULL,
  `jenis_pindah` varchar(50) NOT NULL,
  `alamat_pindah` text NOT NULL,
  `desa_kelurahan_pindah` varchar(100) NOT NULL,
  `kecamatan_pindah` varchar(100) NOT NULL,
  `kabupaten_kota_pindah` varchar(100) NOT NULL,
  `provinsi_pindah` varchar(100) NOT NULL,
  `kode_pos_pindah` varchar(10) DEFAULT NULL,
  `alasan_pindah` varchar(100) NOT NULL,
  `jenis_kepindahan` varchar(50) NOT NULL,
  `anggota_keluarga_tidak_pindah` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`anggota_keluarga_tidak_pindah`)),
  `anggota_keluarga_pindah` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`anggota_keluarga_pindah`)),
  `daftar_anggota_pindah` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`daftar_anggota_pindah`)),
  `nama_sponsor` varchar(100) DEFAULT NULL,
  `tipe_sponsor` varchar(50) DEFAULT NULL,
  `alamat_sponsor` text DEFAULT NULL,
  `nomor_itas_itap` varchar(50) DEFAULT NULL,
  `tanggal_itas_itap` date DEFAULT NULL,
  `negara_tujuan` varchar(100) DEFAULT NULL,
  `alamat_tujuan` text DEFAULT NULL,
  `penanggung_jawab` varchar(100) DEFAULT NULL,
  `rencana_tanggal_pindah` date NOT NULL,
  `nomor_handphone` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `isi_tanggapan` varchar(2048) NOT NULL,
  `tanggal_tanggapan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_laporan`, `admin`, `isi_tanggapan`, `tanggal_tanggapan`) VALUES
(1, 100, 'admin', 'Aplikasi Pengaduan Masyarakat Dispendukcapil Bangkalan adalah aplikasi pengelolaan dan tindak lanjut pengaduan serta pelaporan hasil pengelolaan pengaduan yang disediakan oleh Dispendukcapil Bangkalan sebagai salah satu sarana bagi setiap pejabat/pegawai Dispendukcapil Bangkalan sebagai pihak internal maupun masyarakat luas pengguna layanan Dispendukcapil Bangkalan sebagai pihak eksternal untuk melaporkan dugaan adanya pelanggaran dan/atau ketidakpuasan terhadap pelayanan yang dilakukan/diberikan oleh pejabat/pegawai Dispendukcapil Bangkalan.', '2018-03-25 14:44:57');

-- --------------------------------------------------------

--
-- Table structure for table `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_komentar`
--

INSERT INTO `tb_komentar` (`id`, `komentar`) VALUES
(1, ''),
(2, ''),
(3, ''),
(4, ''),
(5, ''),
(6, ''),
(7, ''),
(8, ''),
(9, ''),
(10, ''),
(11, ''),
(12, ''),
(13, ''),
(14, ''),
(15, ''),
(16, ''),
(17, ''),
(18, ''),
(19, ''),
(20, ''),
(21, ''),
(22, '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telpon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `email`, `password`, `alamat`, `telpon`) VALUES
(1, 'Nini', '', 'nini@gmail.com', '$2y$10$DXiGlgELKqSda/2DOLL60uCEFV9uthuoX4nfmD4Ueg7MhdHQE0/8i', 'daya', ''),
(5, 'tes', '', 'tes@gmail.com', '$2y$10$B9D19r2kT/oUF3FtbRsKE.pmKm8.TVR8DG8p724SsUoKP49/mKwCC', 'TES', ''),
(8, 'ben', 'ben', 'ben@gmail.com', ' ,?b?Y[?K-#Kp', 'perintis', ''),
(10, 'mondi', 'mon', 'mon@gmail.com', ' ,?b?Y[?K-#Kp', 'jalan', '9090'),
(11, 'mimi', 'mimi', 'mimi@gmail.com', '?|???plL4?h??N{', 'jl. macan', '0987654345678'),
(13, 'martin', 'martin', 'martin@gmail.com', '925d7518fc597af0e43f5606f9a51512', 'martin', ''),
(14, 'ade', 'adermaulana', 'ade@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ader', ''),
(15, 'Nurul Magfirah', 'Nurul', 'Nurulmaghfiraht@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'jl.mangga tiga', '0845637826443'),
(16, 'nia', 'nia', 'nia@gmail.com', '04a481486dd84d7c8bfdfc89d38136a6', 'daya', ''),
(17, 'maya', 'maya', 'maya@gmail.com', 'b2693d9c2124f3ca9547b897794ac6a1', 'pk8', ''),
(18, 'ares', 'ares', 'ares@gamil.com', '1769d06df18cb4c2b01931d7f83f3c9a', 'sudiang', ''),
(19, 'roy', 'roy', 'roy@gmail.com', 'd4c285227493531d0577140a1ed03964', 'malang', ''),
(20, 'veni deriati', 'veni', 'veni@gmail.com', '7c29d35ea38818aec6d48841382bb5a8', 'pk7', ''),
(21, 'nana', 'nana', 'nana@gmail.com', '518d5f3401534f5c6c21977f12f60989', 'soreang', ''),
(22, 'aca', 'aca', 'aca@gmail.com', '2671eb6e9150cf9b53eb39752a1fb21c', 'maros', ''),
(23, 'nini', 'nini', 'ninimlyni@gmail.com', 'db5cee64d8879581f189d71178dcb055', 'gowa', ''),
(24, 'ruru', 'nefes', 'nefest@gmail.com', '7243309604eb9f3583bfebab10a757a7', 'nefest', ''),
(26, 'rurud', 'nefes', 'nefest@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'nefest', ''),
(27, 'hkhlkjh', 'nefes', 'ruru@sads.gmail', '$2y$10$FFUuu1ekBPJebuduyq3GPucfTY3QML5lLGZKvpHFQBP3qxAXCAYfq', 'nefest', ''),
(28, 'hkhlkjh', 'nefes', 'ruru@gmail.com', '$2y$10$L9YlO6A3ewTBW2mF56Aq7O.b4wyuRdhDOOttEw0.lpJ/MPPGtSLiC', 'nefest', ''),
(29, 'gonzalo', 'gonzalo', 'gonzalo@gmail.com', '$2y$10$eSV4Aju2Yej1UXfUCnhMg.IsQYjfzmHL4YaK/jfnoX8Kbard8hXte', 'gonzalo', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `divisi` (`divisi`);

--
-- Indexes for table `akta_kelahiran`
--
ALTER TABLE `akta_kelahiran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `akta_kematian`
--
ALTER TABLE `akta_kematian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_anak`
--
ALTER TABLE `data_anak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `ketua_rt`
--
ALTER TABLE `ketua_rt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indexes for table `perubahan_data_penduduk`
--
ALTER TABLE `perubahan_data_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surat_pindah_penduduk`
--
ALTER TABLE `surat_pindah_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- Indexes for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `akta_kelahiran`
--
ALTER TABLE `akta_kelahiran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `akta_kematian`
--
ALTER TABLE `akta_kematian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `data_anak`
--
ALTER TABLE `data_anak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `ketua_rt`
--
ALTER TABLE `ketua_rt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `perubahan_data_penduduk`
--
ALTER TABLE `perubahan_data_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `surat_pindah_penduduk`
--
ALTER TABLE `surat_pindah_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
