-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Des 2023 pada 17.07
-- Versi server: 10.4.27-MariaDB
-- Versi PHP: 8.1.12

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
(0, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 0),
(1, 'admin1', '25f43b1486ad95a1398e3eeb3d83bc4010015fcc9bedb35b432e00298d5021f7', 1),
(2, 'admin2', '1c142b2d01aa34e9a36bde480645a57fd69e14155dacfab5a3f9257b77fdc8d8', 2),
(3, 'admin3', '4fc2b5673a201ad9b1fc03dcb346e1baad44351daa0503d5534b4dfdcc4332e0', 3),
(4, 'admin4', '110198831a426807bccd9dbdf54b6dcb5298bc5d31ac49069e0ba3d210d970ae', 4),
(8, 'nini', '827ccb0eea8a706c4c34a16891f84e7b', 0);

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
(0, 'Super Admin'),
(1, 'Pelayanan Pendaftaran Penduduk'),
(2, 'Pelayanan Pencatatan Sipil'),
(3, 'Pengelolaan Informasi Administrasi Kependudukan'),
(4, 'Pemanfaatan Data Dan Inovasi Pelayanan');

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
(1, 'tes', 'tea', 'tes', 'tes', 2, 'tes', '2023-11-15 18:35:12', 'tes', '', ''),
(2, 'adede', 'ade@gmail.com', '121212', '12112', 1, '1212 wakwaww2', '0000-00-00 00:00:00', 'Setuju', 'wkwkudud', ''),
(3, 'uding', 'uding@gmail.com', '12122121', 'alamat', 2, 'udin', '2023-11-27 00:30:52', 'Menunggu', 'udin', ''),
(4, 'martin', 'martin@gmail.com', '293939', 'wkwk', 3, 'wadidawwwwww', '2023-11-30 07:57:05', 'Setuju', 'dkdkwkwkk', ''),
(5, 'udina', 'udin@gmail.com', '123239239', 'alamat', 0, '', '0000-00-00 00:00:00', 'Menunggu', 'fejisfjsiefjiefsjiefj', ''),
(6, 'tes', 'tes@gmail.com', '121212', 'sakdw', 0, 'dikdike', '0000-00-00 00:00:00', 'Menunggu', 'dekiiekddldl', ''),
(7, 'uding', 'uidsjdi@gmail.com', '9090', 'wakwaw', 1, 'wkwk', '2023-12-05 15:43:37', 'Menunggu', 'wwkk', '../../uploads/NAME CARD.pdf'),
(8, 'tes', 'tstim@gmail.com', '232332', 'dakdi', 1, 'dwidwkim', '2023-12-05 15:44:10', 'Menunggu', 'dwkwdi', '../../uploads/LOGO.pdf'),
(9, 'wakwa', 'wakwaw@gmail.com', '232323', 'dkdkie', 1, 'dekek', '2023-12-05 15:48:05', 'Menunggu', 'dekidei', '../../uploads/BUKU Logo Mimi.pdf'),
(10, 'wadiwa', 'odadin@gmail.com', '1w323', 'dke', 1, 'dewkid', '2023-12-05 15:48:57', 'Menunggu', 'deied', 'uploads/MOCK UP.pdf');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggapan`
--

CREATE TABLE `tanggapan` (
  `id_tanggapan` int(11) NOT NULL,
  `id_laporan` int(11) NOT NULL,
  `admin` varchar(64) NOT NULL,
  `isi_tanggapan` varchar(2048) NOT NULL,
  `tanggal_tanggapan` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data untuk tabel `tanggapan`
--

INSERT INTO `tanggapan` (`id_tanggapan`, `id_laporan`, `admin`, `isi_tanggapan`, `tanggal_tanggapan`) VALUES
(1, 100, 'admin', 'Aplikasi Pengaduan Masyarakat Dispendukcapil Bangkalan adalah aplikasi pengelolaan dan tindak lanjut pengaduan serta pelaporan hasil pengelolaan pengaduan yang disediakan oleh Dispendukcapil Bangkalan sebagai salah satu sarana bagi setiap pejabat/pegawai Dispendukcapil Bangkalan sebagai pihak internal maupun masyarakat luas pengguna layanan Dispendukcapil Bangkalan sebagai pihak eksternal untuk melaporkan dugaan adanya pelanggaran dan/atau ketidakpuasan terhadap pelayanan yang dilakukan/diberikan oleh pejabat/pegawai Dispendukcapil Bangkalan.', '2018-03-25 14:44:57');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_komentar`
--

CREATE TABLE `tb_komentar` (
  `id` int(11) NOT NULL,
  `komentar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_komentar`
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
(9, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
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
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `username`, `email`, `password`, `alamat`, `telpon`) VALUES
(1, 'Nini', '', 'nini@gmail.com', '$2y$10$DXiGlgELKqSda/2DOLL60uCEFV9uthuoX4nfmD4Ueg7MhdHQE0/8i', 'daya', ''),
(2, 'Nini', '', 'nini@gmail.com', '$2y$10$ta9lJjDZhACio5BYLc4G4eIn52F20JvwSvODCZYxux.dkbUXoNBpi', 'daya', ''),
(3, 'Nini', '', 'nini@gmail.com', '$2y$10$rEzmvGQYEULWSb6i/7xJ6uqrMVXWONOggkpUUM.BGIH/PUJFl2Gfu', 'daya', ''),
(4, 'Nini', '', 'nini@gmail.com', '$2y$10$wz/vm4ksn7NQRbof/D9jV.i7myEtn45oRw1w19DOBxdeSoS6WHJEG', 'daya', ''),
(5, 'tes', '', 'tes@gmail.com', '$2y$10$B9D19r2kT/oUF3FtbRsKE.pmKm8.TVR8DG8p724SsUoKP49/mKwCC', 'TES', ''),
(6, 'kucing', 'kucing', 'kucing@gmail.com', 'b65845fca59b323bd285bdcada3454c8', 'kucing', ''),
(7, 'nini', 'nini', 'nini@gmail.com', ' ,?b?Y[?K-#Kp', 'daya', ''),
(8, 'ben', 'ben', 'ben@gmail.com', ' ,?b?Y[?K-#Kp', 'perintis', ''),
(9, 'ben', 'ben', 'ben@gmail.com', '?|???plL4?h??N{', 'perintis', ''),
(10, 'mon', 'mon', 'mon@gmail.com', ' ,?b?Y[?K-#Kp', 'jalan', ''),
(11, 'mimi', 'mimi', 'mimi@gmail.com', '?|???plL4?h??N{', 'njhgf', ''),
(12, 'udin', 'udin', 'udin@gmail.com', 'k윅(G$.8JMZ??+?', 'udin', ''),
(13, 'martin', 'martin', 'martin@gmail.com', '925d7518fc597af0e43f5606f9a51512', 'martin', ''),
(14, 'ade', 'adermaulana', 'ade@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ader', ''),
(15, 'ade', 'adermaulana', 'ade@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'ader', '');

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
-- Indeks untuk tabel `tanggapan`
--
ALTER TABLE `tanggapan`
  ADD PRIMARY KEY (`id_tanggapan`);

--
-- Indeks untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
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
-- AUTO_INCREMENT untuk tabel `tb_komentar`
--
ALTER TABLE `tb_komentar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`divisi`) REFERENCES `divisi` (`id_divisi`);

--
-- Ketidakleluasaan untuk tabel `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `laporan_ibfk_1` FOREIGN KEY (`tujuan`) REFERENCES `divisi` (`id_divisi`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
