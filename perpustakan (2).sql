-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2024 at 02:06 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpustakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `email`, `nama_lengkap`, `alamat`, `level`) VALUES
(5, 'yanto@gmail.com', 'yanto', 'jl yanto', 'anggota'),
(9, 'botan@gmail.com', 'botan si botan', 'jl.botan', 'anggota');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(10) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `pengarang` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun_terbit` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`) VALUES
(43, 'ontong', 'ontong begitu', 'ontong', '2024-09-04'),
(53, 'gajelas', 'ga jelas', 'ga jelas', '2024-10-05');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `kd_pinjam` char(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_anggota` int(10) NOT NULL,
  `id_buku` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `perpustakan_peminjaman`
--

CREATE TABLE `perpustakan_peminjaman` (
  `kd_pinjam` int(10) NOT NULL,
  `tgl_pinjam` date NOT NULL,
  `tgl_kembali` date NOT NULL,
  `id_anggota` int(10) NOT NULL,
  `id_buku` int(10) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `status` varchar(50) DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `perpustakan_peminjaman`
--

INSERT INTO `perpustakan_peminjaman` (`kd_pinjam`, `tgl_pinjam`, `tgl_kembali`, `id_anggota`, `id_buku`, `judul_buku`, `nama_lengkap`, `status`) VALUES
(7, '2024-10-22', '2024-10-26', 9, 43, 'ontong', 'botan si botan', 'dikembalikan'),
(8, '2024-10-03', '2024-10-22', 5, 53, 'gajelas', 'yanto', 'dikembalikan'),
(9, '2024-10-26', '2024-10-11', 9, 53, 'gajelas', 'botan si botan', 'dipinjam'),
(10, '2024-10-23', '2024-10-24', 9, 43, 'ontong', 'botan si botan', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `level` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `email`, `nama_lengkap`, `alamat`, `level`) VALUES
(1, 'admin', 'admin', 'admin@gmail.com', 'admin123', 'jl.admin', 'admin'),
(2, 'anggota', 'anggota', 'anggota@gmail.com', 'anggota keluarga', 'jl.anggota', 'anggota'),
(3, 'petugas', 'petugas', 'petugas@gmail.com', 'petugas nih bos', 'jl petugas', 'anggota'),
(5, 'mahasiswa', 'mahasiswa', 'mahasiswa@gmail.com', 'mahasiswa nih bos', 'jl mahasiswa', 'anggota'),
(7, 'siswa', 'siswa', 'siswa@gmail.com', 'asda', 'jl.siswa', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `perpustakan_peminjaman`
--
ALTER TABLE `perpustakan_peminjaman`
  ADD PRIMARY KEY (`kd_pinjam`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `perpustakan_peminjaman`
--
ALTER TABLE `perpustakan_peminjaman`
  MODIFY `kd_pinjam` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
