-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Feb 2025 pada 15.58
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.0.30

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
-- Struktur dari tabel `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `divisi` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`, `divisi`) VALUES
(1, 'admin', '827ccb0eea8a706c4c34a16891f84e7b', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_kelahiran`
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
  `status` varchar(255) DEFAULT 'Menunggu',
  `dokumen_admin` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `akta_kematian`
--

CREATE TABLE `akta_kematian` (
  `id` int(11) NOT NULL,
  `user_id` int(255) NOT NULL,
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
  `status` varchar(255) NOT NULL,
  `dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `akta_kematian`
--

INSERT INTO `akta_kematian` (`id`, `user_id`, `nama_pelapor`, `nik_pelapor`, `nomor_dokumen_perjalanan`, `nomor_kartu_keluarga_pelapor`, `kewarganegaraan_pelapor`, `nomor_handphone`, `email`, `nama_saksi_1`, `nik_saksi_1`, `nomor_kartu_keluarga_saksi_1`, `kewarganegaraan_saksi_1`, `nama_ayah`, `nik_ayah`, `tempat_lahir_ayah`, `tanggal_lahir_ayah`, `kewarganegaraan_ayah`, `nama_ibu`, `nik_ibu`, `tempat_lahir_ibu`, `tanggal_lahir_ibu`, `kewarganegaraan_ibu`, `nik_alm`, `nama_lengkap_alm`, `hari_tanggal_kematian`, `pukul`, `sebab_kematian`, `tempat_kematian`, `yang_menerangkan`, `dokumen_persyaratan`, `tanggal_input`, `status`, `dokumen`) VALUES
(1, 29, 'tuyul', '75567845675678io', '4', '5678765456789', 'Indonesia', '098754567890878', 'ini@gmail.com', 'ucu', '76543456789', '6', 'Indonesia', 'inca', '65456789765678', 'kota', '1988-05-08', 'Indonesia', 'dina', '6787656789098', 'disini', '1999-04-09', 'Indonesia', '23456789876543', 'ros', '2024-03-07', '18:58:00', '', 'jalanan', 'saya', 'kp (7).sql', '2025-02-09', 'Menunggu Konfirmasi', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_anak`
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
  `status` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_anak`
--

INSERT INTO `data_anak` (`id`, `nik_anak`, `nomor_akta_kelahiran`, `nama_anak`, `tempat_lahir`, `tanggal_lahir`, `anak_ke`, `nama_ayah`, `nama_ibu`, `alamat_pemohon`, `pdf_path`, `tanggal_input`, `status`, `user_id`) VALUES
(1, '244324', '32131', 'dsada', 'sda', '1212-02-21', 1, 'qwq', 'ewq', 'dsada', '', '2025-01-06 09:13:50', 'Ditolak', 0),
(2, '23', '323', 'jlkj', '3213', '3213-03-21', 3, 'ewqewq', 'ewqewq', 'gonzalo', 'uploads/TugasLesson7 (2).docx', '2025-01-19 12:25:40', 'Selesai', 30),
(3, '23', '323', 'jlkj', '3213', '1221-02-12', 3, 'ewqewq', 'ewqewq', 'gonzalo', '', '2025-01-19 12:34:04', 'Pending', 29),
(4, '287381', '273873', 'jshdjsdh', 'sdjhsd', '2025-02-05', 2, 'dfdjfh', 'jdhfj', 'dhfj', NULL, '2025-02-05 11:21:20', 'Selesai', 30),
(5, '123123123', '321321321', 'selin', 'sjdksj', '2025-02-05', 2, 'nfn', 'dmnmf', 'mdn', NULL, '2025-02-05 11:22:18', 'Selesai', 30),
(6, '23', '323', 'jlkj', '3213', '3232-03-22', 3, 'jkhjkhjk', 'jklj', 'gonzalo', '', '2025-02-07 10:36:24', 'Sedang diProses', 33),
(7, '23', '323', 'jlkj', '3213', '1212-02-12', 2, 'jkhjkhjk', 'jklj', 'gonzalo', NULL, '2025-02-08 19:19:34', 'Selesai', 33),
(8, '244324', '57576', 'fhfghf', 'dfgd', '4334-03-31', 1, 'reeret', 'rer', 'etre', NULL, '2025-02-09 10:02:25', 'Menunggu', 29),
(9, '244324', '323312', 'eweq', 'ewqe', '2322-03-31', 3, 'wqwqw', 'wqw', 'rrerw', NULL, '2025-02-09 10:40:59', 'Selesai', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` int(11) NOT NULL,
  `nama_divisi` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`) VALUES
(1, 'Pengelolaan Informasi Administrasi Kependudukan'),
(2, 'Pemanfaatan Data Dan Inovasi Pelayanan'),
(3, 'Pelayanan Pencatatan Sipil'),
(4, 'Pelayanan Pendaftaran Penduduk'),
(8, 'Lainnya');

-- --------------------------------------------------------

--
-- Struktur dari tabel `laporan`
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
-- Dumping data untuk tabel `laporan`
--

INSERT INTO `laporan` (`id`, `nama`, `email`, `telpon`, `alamat`, `tujuan`, `isi`, `tanggal`, `status`, `komentar`, `pdf_path`) VALUES
(1, 'Kantor Kecamatan Tanralili', 'srimulyani.nini@gmail.com', '081354888872', 'daya', 1, 'pendaftaran biodata penduduk', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/user_public_uploads_07 PM Regresi Linier ok.pdf'),
(2, 'maya eka', 'maya@gmailc.om', '081354888872', 'pk8', 2, 'pendaftaran akte kelahiran', '2024-01-09 02:05:04', 'Menunggu', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(3, 'ares', 'ares@gamil.com', '085346732345', 'rumah', 2, 'pendaftaran akte kelahiran', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(5, 'niana', 'nia@gmail.com', '081354888872', 'perintis', 1, 'pembuatan ktp', '2024-01-08 05:19:33', 'Menunggu', '', 'uploads/Tabel common Anoda katoda.pdf'),
(6, 'roy', 'roy@gmail.com', '089786543522', 'tanjung bunga', 1, 'pendaftaran biodata penduduk', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/Bab04-Mendapatkan Input dari Keyboard.pdf'),
(7, 'rehan', 'rehan@gmail.com', '098765432234', 'rumah', 3, 'administrasi penduduk', '2024-01-08 11:04:38', 'Menunggu', '', 'uploads/Bab07-PBO Java Class Library.pdf'),
(11, 'kucing', 'ken@gmail.com', 'kcsljcslakjf', 'btp', 1, ',zxlkjlkjlasjdlask', '2024-01-08 12:05:11', 'Menunggu', '', 'uploads/212094_NUR FADILLA_Tugas3.pdf'),
(12, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', '081354888872', 'Jl.Mangga Tiga', 3, 'Pendaftaran Akte Kelahiran', '0000-00-00 00:00:00', 'Setuju', '', 'uploads/5_6208532310501885595.pdf'),
(13, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', 'yguhujkl', 'ghjk', 1, 'jhgf', '2024-01-11 04:02:29', 'Menunggu', '', 'uploads/212126 Kantor Kecamatan Tanralili.pdf'),
(14, 'Kantor Kecamatan Tanralili', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 1, 'administrasi penduduk', '2024-01-11 04:10:44', 'Menunggu', '', ''),
(15, 'Nurul Magfirah', 'nurulmagfiraht@gmail.com', '085346732345', 'btp', 1, 'ijuyt', '2024-01-11 04:14:38', 'Menunggu', '', ''),
(16, 'nini', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 3, 'administrasi', '2024-01-11 04:31:56', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(17, 'nini', 'srimulyani.nini@gmail.com', '085346732345', 'daya', 3, 'administrasi', '2024-01-11 04:32:30', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(19, 'renal', 'renal@gmail.com', '089673837474', 'jl. sangir', 4, 'pendaftaran penduduk baru', '2024-01-11 04:34:58', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg'),
(20, 'yanto', 'yanto@gmail.com', '081354888872', 'sudiang', 3, 'pendaftaran akte perkawinan', '2024-01-16 02:24:00', 'Menunggu', '', 'uploads/user_public_uploads_user_public_uploads_07 PM Regresi Linier ok.pdf'),
(21, 'veni', 'venI@gmail.com', '08657345678', 'rumah', 1, 'administrasi penduduk', '2024-01-16 02:25:39', 'Menunggu', '', 'uploads/usecasepengaduan.drawio.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemohon`
--

CREATE TABLE `pemohon` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `alamat_rumah` text NOT NULL,
  `dokumen` varchar(11) NOT NULL,
  `user_id` int(255) NOT NULL,
  `input_id` int(11) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pemohon`
--

INSERT INTO `pemohon` (`id`, `nama_lengkap`, `nik`, `no_kk`, `alamat_rumah`, `dokumen`, `user_id`, `input_id`, `status`, `created_at`) VALUES
(87, 'dsadsadsa', '4324324324325453', '534543432432', 'gonzalo', '', 33, 1, 'Menunggu', '2025-02-08 18:31:43'),
(91, 'dsadsadsa', '765', '534543', 'gonzalo', '', 33, 2, 'Menunggu', '2025-02-08 18:32:47'),
(92, 'noko', '756655589778879`', '454', 'fhfhg', '', 29, 3, 'Menunggu', '2025-02-09 09:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `penduduk`
--

CREATE TABLE `penduduk` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_kk` varchar(20) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `shdk` varchar(50) NOT NULL,
  `keterangan` text DEFAULT NULL,
  `input_id` int(50) NOT NULL,
  `user_id` int(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `penduduk`
--

INSERT INTO `penduduk` (`id`, `nama`, `no_kk`, `nik`, `shdk`, `keterangan`, `input_id`, `user_id`, `created_at`) VALUES
(58, 'nefes', '3235453', '876876342', 'anak432', 'gabut432', 1, 0, '2025-02-08 18:31:43'),
(59, '434', '54654', '765', 'dsa', 'dsa', 2, 0, '2025-02-08 18:32:47'),
(60, 'beng', '7597987907', '43535353', 'fdgdgdg', 'fgdgfdg', 3, 0, '2025-02-09 09:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `permohonan_perubahan`
--

CREATE TABLE `permohonan_perubahan` (
  `id` int(11) NOT NULL,
  `nik` varchar(16) NOT NULL,
  `jenis_permohonan` varchar(100) NOT NULL,
  `semula` text NOT NULL,
  `menjadi` text NOT NULL,
  `dasar_perubahan` text NOT NULL,
  `input_id` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `permohonan_perubahan`
--

INSERT INTO `permohonan_perubahan` (`id`, `nik`, `jenis_permohonan`, `semula`, `menjadi`, `dasar_perubahan`, `input_id`, `created_at`) VALUES
(47, '876876342', 'malas432', 'tentara432', 'polisi432', 'malas saja432', '', '2025-02-08 18:31:43'),
(48, '876876342', 'rewre', 'rew', 'rew', 'rwerew', '', '2025-02-08 18:31:43'),
(49, '876876342', 'malas', 'tentara', 'polisi', 'malas saja432', '', '2025-02-08 18:31:43'),
(50, '765', 'fds', 'fsd', 'hg', 'gfd', '', '2025-02-08 18:32:47'),
(51, '43535353', 'pendidikan_terakhir', 'dgfdgf', 'gfhgfgh', 'fhgfgf', '', '2025-02-09 09:23:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `perubahan_data_penduduk`
--

CREATE TABLE `perubahan_data_penduduk` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `shdk` varchar(100) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `jenis_permohonan` text NOT NULL,
  `jenis_permohonan_lainnya` varchar(100) DEFAULT NULL,
  `semula` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `menjadi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `dasar_perubahan` varchar(100) NOT NULL,
  `status` varchar(50) DEFAULT 'Menunggu Konfirmasi',
  `dokumen` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `perubahan_data_penduduk`
--

INSERT INTO `perubahan_data_penduduk` (`id`, `nama_lengkap`, `no_kk`, `nik`, `shdk`, `keterangan`, `jenis_permohonan`, `jenis_permohonan_lainnya`, `semula`, `menjadi`, `dasar_perubahan`, `status`, `dokumen`) VALUES
(1, 'Surawal Setiawan Rantesalu', '123321', '122221', 'Kepala Keluarga ', 'dfjk', 'pendidikan', '', 'S1', 'S2', 'ksdj', 'Selesai', 'TugasLesson7.docx'),
(2, 'Surawal', '123321', '122221', 'Kepala Keluarga', 'asdasdasd', 'pendidikan', '', 'S2', 'S1', 'DFSDF', 'Ditolak', ''),
(3, 'Surawal', '123321', '122221', 'Kepala Keluarga', 'asdasdasd', 'pekerjaan', '', 'Presiden Republik Indonesia', 'Wakil Presiden Republik Indonesia', 'asasd', 'Sedang diProses', NULL),
(4, 'Surawal', '123321', '122221', 'Kepala Keluarga', 'ksjd', 'lainnya', 'Sembarang', 'asd', 'dsa', 'sdjhds', 'Sedang diProses', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `surat_pindah_penduduk`
--

CREATE TABLE `surat_pindah_penduduk` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(16) NOT NULL,
  `nama_lengkap_pemohon` varchar(100) NOT NULL,
  `nik_pemohon` varchar(16) NOT NULL,
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
  `anggota_keluarga_tidak_pindah` longtext DEFAULT NULL,
  `anggota_keluarga_pindah` longtext DEFAULT NULL,
  `daftar_nik_anggota_pindah` varchar(255) NOT NULL,
  `daftar_anggota_pindah` varchar(255) DEFAULT NULL,
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
  `email` varchar(100) DEFAULT NULL,
  `dokumen` varchar(11) NOT NULL,
  `tanggal_input` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `surat_pindah_penduduk`
--

INSERT INTO `surat_pindah_penduduk` (`id`, `no_kk`, `nama_lengkap_pemohon`, `nik_pemohon`, `jenis_permohonan`, `alamat_jelas`, `desa_kelurahan_asal`, `kecamatan_asal`, `kabupaten_kota_asal`, `provinsi_asal`, `kode_pos_asal`, `jenis_pindah`, `alamat_pindah`, `desa_kelurahan_pindah`, `kecamatan_pindah`, `kabupaten_kota_pindah`, `provinsi_pindah`, `kode_pos_pindah`, `alasan_pindah`, `jenis_kepindahan`, `anggota_keluarga_tidak_pindah`, `anggota_keluarga_pindah`, `daftar_nik_anggota_pindah`, `daftar_anggota_pindah`, `nama_sponsor`, `tipe_sponsor`, `alamat_sponsor`, `nomor_itas_itap`, `tanggal_itas_itap`, `negara_tujuan`, `alamat_tujuan`, `penanggung_jawab`, `rencana_tanggal_pindah`, `nomor_handphone`, `email`, `dokumen`, `tanggal_input`, `status`, `user_id`) VALUES
(1, '3213213', 'dsadsadsa', '3232', 'skpln', 'gonzalo', '321321', '321321', 'dsad', 'dsadsa', '2', 'surat_pindah', 'dsadsada', '32321', '323', 'dsad', 'dsadsa', '2', 'pekerjaan', 'kk_baru', 'kk_baru', 'kk_baru', 'a:2:{i:0;s:5:\"32131\";i:1;s:5:\"32323\";}', 'a:2:{i:0;s:9:\"dsadsadsa\";i:1;s:15:\"dsadsadsadsadsa\";}', 'ewqewq', 'kk_baru', 'gonzalo', '3231312', '0000-00-00', 'Indonesia', 'dsad', '321321', '2323-03-23', '312321', 'chornefirstruru123@gmail.com', '', '2025-01-26', '', 29),
(2, '3213213', 'dsadsadsa', '3232', 'Surat Keterangan Pindah Luar Negeri (SKPLN)', 'dsad', '321321', '321321', 'dsad', 'dsadsa', '2', 'Antar desa/kelurahan atau yang disebut dengan nama', 'gonzalo', '32321', '323', 'dsad', 'dsadsa', '2', 'pekerjaan', 'Antar provinsi', 'numpang_kk', 'kk_baru', 'a:1:{i:0;s:5:\"32131\";}', 'a:1:{i:0;s:9:\"dsadsadsa\";}', 'ewqewq', 'kk_baru', 'gonzalo', '3231312', '0000-00-00', 'Indonesia', 'dsad', '321321', '2321-03-23', '312321', 'chornefirstruru123@gmail.com', '', '2025-02-06', '', 29),
(3, '123123123', 'Harmin, S.Si., M.A.P.', '212121', 'Surat Keterangan Pindah', 'Jalan Sudiang', 'wqwq', 'wqwq', 'sas', 'wqw', '21', 'Antar kabupaten/kota dalam satu provinsi', 'sa', 'wq', 'wq', 'we', 'fd', '21', 'pendidikan', 'Antar provinsi', 'kk_baru', 'kk_baru', 'a:2:{i:0;s:3:\"232\";i:1;s:3:\"324\";}', 'a:2:{i:0;s:21:\"Harmin, S.Si., M.A.P.\";i:1;s:16:\"Kantor Kecamatan Tanralili\";}', 'ewe', 'numpang_kk', 'wqwq', '21', '0000-00-00', 'Indonesia', 'ew', 'ew', '1212-02-21', '212121', 'gonzalo@gmail.com', '', '2025-02-06', '', 29),
(4, '123321', 'Harmin, S.Si., M.A.P.', '212121', 'Surat Keterangan Pindah', 'ewqe', 'wqwq', 'wqwq', 'sas', 'wqw', '21', 'Dalam satu desa/kelurahan atau yang disebut dengan', 'wqw', 'wq', 'wq', 'we', 'fd', '21', 'pendidikan', 'Antar provinsi', 'numpang_kk', 'numpang_kk', 'a:2:{i:0;s:3:\"232\";i:1;s:3:\"324\";}', 'a:2:{i:0;s:21:\"Harmin, S.Si., M.A.P.\";i:1;s:16:\"Kantor Kecamatan Tanralili\";}', 'ewe', 'kk_baru', 'wqwq', '21', '0000-00-00', 'Indonesia', 'ew', 'ew', '2211-02-21', '212121', 'gonzalo@gmail.com', '', '2025-02-06', 'Menunggu', 29),
(5, '123321', 'Harmin, S.Si., M.A.P.', '212121', 'Surat Keterangan Pindah', '323gfgd', 'wqwq', 'wqwq', 'sas', 'wqw', '21', 'Antar desa/kelurahan atau yang disebut dengan nama', 'dsa', 'wq', 'wq', 'we', 'fd', '21', 'pendidikan', 'Kepala Keluarga dan sebagian Anggota Keluarga', 'numpang_kk', 'numpang_kk', 'a:1:{i:0;s:3:\"232\";}', 'a:1:{i:0;s:21:\"Harmin, S.Si., M.A.P.\";}', 'ewe', 'kk_baru', 'wqwq', '21', '0000-00-00', 'Indonesia', 'ew', 'ew', '1211-12-22', '212121', 'gonzalo@gmail.com', '', '2025-02-06', '', 29),
(6, '123321', 'Harmin, S.Si., M.A.P.', '212121', 'Surat Keterangan Pindah Luar Negeri (SKPLN)', 'fds', 'wqwq', 'wqwq', 'sas', 'wqw', '21', 'Antar desa/kelurahan atau yang disebut dengan nama', 'ds', 'wq', 'wq', 'we', 'fd', '21', 'pendidikan', 'Antar provinsi', 'numpang_kk', 'numpang_kk', 'a:2:{i:0;s:3:\"232\";i:1;s:5:\"43242\";}', 'a:2:{i:0;s:21:\"Harmin, S.Si., M.A.P.\";i:1;s:5:\"dsdas\";}', 'ewe', 'numpang_kk', 'wqwq', '21', '0000-00-00', 'Indonesia', 'ew', 'ew', '1221-02-21', '212121', 'gonzalo@gmail.com', '', '2025-02-06', 'Menunggu', 29),
(7, '3213213', 'dsadsadsa', '3232', 'Surat Keterangan Pindah', 'gonzalo', '321321', '321321', 'dsad', 'dsadsa', '2', 'Antar desa/kelurahan atau yang disebut dengan nama', 'gonzalo', '32321', '323', 'dsad', 'dsadsa', '2', 'pekerjaan', 'Kepala Keluarga dan seluruh Anggota Keluarag', 'kk_baru', 'kk_baru', 'a:1:{i:0;s:5:\"32131\";}', 'a:1:{i:0;s:9:\"dsadsadsa\";}', 'ewqewq', 'kk_baru', 'gonzalo', '3231312', '0000-00-00', 'Indonesia', 'dsad', '321321', '1221-02-12', '312321', 'chornefirstruru123@gmail.com', '', '2025-02-08', 'Menunggu', 33),
(8, '3213213', 'dsadsadsa', '3232', 'Surat Keterangan Pindah Luar Negeri (SKPLN)', 'dsad', '321321', '321321', 'dsad', 'dsadsa', '2', 'Antar desa/kelurahan atau yang disebut dengan nama', 'dsad', '32321', '323', 'dsad', 'dsadsa', '2', 'pekerjaan', 'Antar provinsi', 'numpang_kk', 'kk_baru', 'a:1:{i:0;s:5:\"32131\";}', 'a:1:{i:0;s:9:\"dsadsadsa\";}', 'ewqewq', 'numpang_kk', 'gonzalo', '3231312', '0000-00-00', 'Indonesia', 'dsad', '321321', '3223-03-23', '312321', 'chornefirstruru123@gmail.com', '', '2025-02-08', 'Menunggu', 33),
(9, '3213213', 'dsadsadsa', '3232', 'Surat Keterangan Pindah', 'dsad', '321321', '321321', 'dsad', 'dsadsa', '2', 'Antar desa/kelurahan atau yang disebut dengan nama', 'dsad', '32321', '323', 'dsad', 'dsadsa', '2', 'pendidikan', 'Kepala Keluarga dan sebagian Anggota Keluarga', 'numpang_kk', 'kk_baru', 'a:1:{i:0;s:5:\"32131\";}', 'a:1:{i:0;s:9:\"dsadsadsa\";}', 'ewqewq', 'kk_baru', 'gonzalo', '3231312', '0000-00-00', 'Indonesia', 'dsad', '321321', '0322-03-23', '312321', 'chornefirstruru123@gmail.com', '', '2025-02-08', 'Menunggu', 33),
(10, '1234567890', 'roy', '756655589778879', 'Surat Keterangan Tempat Tinggal (SKTT)', 'ghjgjg', 'uyt', 'ytuyt', 'ututiu', 'ttiutyu', '78678', 'Antar provinsi', 'ghj', 'ghjgj', 'ghjgj', 'gjgjg', 'jgjg', '987987', 'pekerjaan', 'Kepala Keluarga dan sebagian Anggota Keluarga', 'numpang_kk', 'kk_baru', 'a:1:{i:0;s:7:\"7686876\";}', 'a:1:{i:0;s:6:\"hghjgh\";}', 'gjhggk', 'numpang_kk', 'hghgh', 'ggjgjgj', '0000-00-00', 'hkhkj', 'hkh', 'khkjhjk', '7987-09-07', 'hgjhg', 'surawalawal2@gmail.com', '', '2025-02-09', 'Menunggu', 29);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `no_kk` varchar(100) NOT NULL,
  `nik` varchar(100) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telpon` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `no_kk`, `nik`, `nama`, `username`, `email`, `password`, `alamat`, `telpon`) VALUES
(1, '', '', 'Nini', '', 'nini@gmail.com', '$2y$10$DXiGlgELKqSda/2DOLL60uCEFV9uthuoX4nfmD4Ueg7MhdHQE0/8i', 'daya', ''),
(8, '', '', 'ben', 'ben', 'ben@gmail.com', ' ,?b?Y[?K-#Kp', 'perintis', ''),
(10, '', '', 'mondi', 'mon', 'mon@gmail.com', ' ,?b?Y[?K-#Kp', 'jalan', '9090'),
(11, '', '', 'mimi', 'mimi', 'mimi@gmail.com', '?|???plL4?h??N{', 'jl. macan', '0987654345678'),
(13, '', '', 'martin', 'martin', 'martin@gmail.com', '925d7518fc597af0e43f5606f9a51512', 'martin', ''),
(14, '', '', 'ade', 'adermaulana', 'ade@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ader', ''),
(16, '', '', 'nia', 'nia', 'nia@gmail.com', '04a481486dd84d7c8bfdfc89d38136a6', 'daya', ''),
(17, '', '', 'maya', 'maya', 'maya@gmail.com', 'b2693d9c2124f3ca9547b897794ac6a1', 'pk8', ''),
(18, '', '', 'ares', 'ares', 'ares@gamil.com', '1769d06df18cb4c2b01931d7f83f3c9a', 'sudiang', ''),
(19, '', '', 'roy', 'roy', 'roy@gmail.com', 'd4c285227493531d0577140a1ed03964', 'malang', ''),
(20, '111111', '222222', 'veni deriati', 'veni', 'veni@gmail.com', '7c29d35ea38818aec6d48841382bb5a8', 'pk7', '082829282'),
(21, '', '', 'nana', 'nana', 'nana@gmail.com', '518d5f3401534f5c6c21977f12f60989', 'soreang', ''),
(22, '', '', 'aca', 'aca', 'aca@gmail.com', '2671eb6e9150cf9b53eb39752a1fb21c', 'maros', ''),
(23, '', '', 'nini', 'nini', 'ninimlyni@gmail.com', 'db5cee64d8879581f189d71178dcb055', 'gowa', ''),
(24, '', '', 'ruru', 'nefes', 'nefest@gmail.com', '7243309604eb9f3583bfebab10a757a7', 'nefest', ''),
(26, '', '', 'rurud', 'nefes', 'nefest@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'nefest', ''),
(27, '', '', 'hkhlkjh', 'nefes', 'ruru@sads.gmail', '$2y$10$FFUuu1ekBPJebuduyq3GPucfTY3QML5lLGZKvpHFQBP3qxAXCAYfq', 'nefest', ''),
(28, '', '', 'hkhlkjh', 'nefes', 'ruru@gmail.com', '$2y$10$L9YlO6A3ewTBW2mF56Aq7O.b4wyuRdhDOOttEw0.lpJ/MPPGtSLiC', 'nefest', ''),
(29, '323232', '32', 'gonzalo', 'gonzalo', 'srimulyani.nini@gmail.com', '$2y$10$eSV4Aju2Yej1UXfUCnhMg.IsQYjfzmHL4YaK/jfnoX8Kbard8hXte', 'gonzalo', '43342'),
(30, '123321', '122221', 'Surawal', 'Surawal', 'mampirlur1@gmail.com', '$2y$10$.p9I5D3hMuWCpUDntCUpoOPEgMU2DZcasZhifTP8GK7IhPeZyQK6a', 'Pinrang', ''),
(31, '', '', 'Surawal', 'Surawal Palangan', 'surawalawal2@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'Pinrang', ''),
(32, '456654', '455554', 'Suranto', 'Suranto', 'surawalawal15@gmail.com', 'f5bb0c8de146c67b44babbf4e6584cc0', 'Pinrang Selatan', ''),
(33, '3213213', '32131', 'dsadsadsa', 'ruru', 'chornefirstruru123@gmail.com', '$2y$10$U8k3mFz9ETaBEfkFey.c4.1uJE.gQyx.zrqKB8E2D/Uvbc5xvmLXW', 'gonzalo', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD KEY `divisi` (`divisi`);

--
-- Indeks untuk tabel `akta_kelahiran`
--
ALTER TABLE `akta_kelahiran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `akta_kematian`
--
ALTER TABLE `akta_kematian`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `data_anak`
--
ALTER TABLE `data_anak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indeks untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tujuan` (`tujuan`);

--
-- Indeks untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `input_id` (`input_id`);

--
-- Indeks untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik` (`nik`),
  ADD KEY `input_id` (`input_id`);

--
-- Indeks untuk tabel `permohonan_perubahan`
--
ALTER TABLE `permohonan_perubahan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `nik` (`nik`),
  ADD KEY `fk_perubahan_input` (`input_id`);

--
-- Indeks untuk tabel `perubahan_data_penduduk`
--
ALTER TABLE `perubahan_data_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `surat_pindah_penduduk`
--
ALTER TABLE `surat_pindah_penduduk`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `akta_kelahiran`
--
ALTER TABLE `akta_kelahiran`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `akta_kematian`
--
ALTER TABLE `akta_kematian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `data_anak`
--
ALTER TABLE `data_anak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `laporan`
--
ALTER TABLE `laporan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `pemohon`
--
ALTER TABLE `pemohon`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT untuk tabel `permohonan_perubahan`
--
ALTER TABLE `permohonan_perubahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT untuk tabel `perubahan_data_penduduk`
--
ALTER TABLE `perubahan_data_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `surat_pindah_penduduk`
--
ALTER TABLE `surat_pindah_penduduk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`divisi`) REFERENCES `divisi` (`id_divisi`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `penduduk`
--
ALTER TABLE `penduduk`
  ADD CONSTRAINT `fk_penduduk_pemohon` FOREIGN KEY (`input_id`) REFERENCES `pemohon` (`input_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `permohonan_perubahan`
--
ALTER TABLE `permohonan_perubahan`
  ADD CONSTRAINT `permohonan_perubahan_ibfk_1` FOREIGN KEY (`nik`) REFERENCES `penduduk` (`nik`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
