-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2021 at 12:37 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emajer`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_level` int(11) NOT NULL,
  `saldo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `email`, `username`, `password`, `id_kelas`, `id_level`, `saldo`) VALUES
(1, 'M. Yusril Amin', 'yusril@gmail.com', 'user', 'user', 2, 2, '107000'),
(12, 'admin', 'yusrilzima28@gmail.com', 'e41200772', '123', 1, 1, '2000'),
(13, 'andine', 'andine123@gmail.com', 'ibuk', 'ibuk', 1, 2, '50000'),
(17, 'andi', 'andi@gmail.com', 'andi', '123', 1, 1, '-20000');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `Nama_barang` varchar(25) NOT NULL,
  `jumlah_barang` varchar(11) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `kondisi` int(11) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `Nama_barang`, `jumlah_barang`, `id_kelas`, `kondisi`, `foto`) VALUES
(1, 'sapu ijuk', '3', 2, 1, 'aku.jpg'),
(2, 'papan tulis', '1', 2, 2, 'papan.jpg'),
(3, 'penghapus', '1', 2, 3, 'pengahpus.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_detail` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_pengeluaran` int(11) NOT NULL,
  `jumlah_barang` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(11) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, 'TIF A'),
(2, 'TIF B');

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id_level` int(11) NOT NULL,
  `nama_level` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id_level`, `nama_level`) VALUES
(1, 'pengurus'),
(2, 'siswa');

-- --------------------------------------------------------

--
-- Table structure for table `mading`
--

CREATE TABLE `mading` (
  `id_mading` int(11) NOT NULL,
  `jenis_mading` varchar(10) NOT NULL,
  `deskripsi_mading` text NOT NULL,
  `tgl_pembagian` date NOT NULL,
  `id_kelas` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mading`
--

INSERT INTO `mading` (`id_mading`, `jenis_mading`, `deskripsi_mading`, `tgl_pembagian`, `id_kelas`) VALUES
(1, '1', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, distinctio recusandae ullam nesciunt voluptate odit ut. ', '2021-11-02', 1),
(2, '2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, distinctio recusandae ullam nesciunt voluptate odit ut. ', '2021-11-01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL,
  `nominal_pengeluaran` varchar(25) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `id_akun` int(11) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `nominal_pengeluaran`, `tgl_pengeluaran`, `id_akun`, `foto`) VALUES
(1, '20000', '2021-11-02', 17, 'aku.jpg');

--
-- Triggers `pengeluaran`
--
DELIMITER $$
CREATE TRIGGER `Hapus Pengeluaran` AFTER DELETE ON `pengeluaran` FOR EACH ROW UPDATE akun SET saldo = saldo+OLD.nominal_pengeluaran WHERE id_akun = OLD.id_akun
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tambah Pengeluaran` AFTER INSERT ON `pengeluaran` FOR EACH ROW UPDATE akun SET saldo = saldo-NEW.nominal_pengeluaran WHERE id_akun = NEW.id_akun
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update Pengeluaran` AFTER UPDATE ON `pengeluaran` FOR EACH ROW UPDATE akun SET saldo = saldo+OLD.nominal_pengeluaran-NEW.nominal_pengeluaran WHERE id_akun = NEW.id_akun
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `saldo`
--

CREATE TABLE `saldo` (
  `id_saldo` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `tgl_topup` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `jumlah_saldo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_akun`, `tgl_topup`, `jumlah_saldo`) VALUES
(1, 1, '2021-11-26 01:20:01', 90000),
(2, 1, '2021-11-26 01:24:51', 50000),
(4, 13, '2021-11-26 06:44:44', 50000);

--
-- Triggers `saldo`
--
DELIMITER $$
CREATE TRIGGER `Hapus Saldo` AFTER DELETE ON `saldo` FOR EACH ROW UPDATE akun SET saldo = saldo-OLD.jumlah_saldo WHERE id_akun = OLD.id_akun
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Tambah Saldo` AFTER INSERT ON `saldo` FOR EACH ROW UPDATE akun SET saldo = saldo+NEW.jumlah_saldo WHERE id_akun = NEW.id_akun
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `Update Saldo` AFTER UPDATE ON `saldo` FOR EACH ROW UPDATE akun SET saldo = saldo-OLD.jumlah_saldo+NEW.jumlah_saldo WHERE id_akun = NEW.id_akun
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_akun` int(11) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `nominal_transaksi` varchar(20) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_akun`, `nama_kelas`, `tanggal_transaksi`, `nominal_transaksi`, `status`) VALUES
(1, 12, '2', '2021-11-17', '2000', 1),
(2, 1, '2', '2021-11-02', '2000', 2);

--
-- Triggers `transaksi`
--
DELIMITER $$
CREATE TRIGGER `Transaksi` AFTER INSERT ON `transaksi` FOR EACH ROW UPDATE akun SET saldo = saldo+NEW.nominal_transaksi WHERE id_akun = NEW.id_akun
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`),
  ADD KEY `id_kelas` (`id_kelas`,`id_level`),
  ADD KEY `id_level` (`id_level`);

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_barang` (`id_barang`),
  ADD KEY `id_pengeluaran` (`id_pengeluaran`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id_level`);

--
-- Indexes for table `mading`
--
ALTER TABLE `mading`
  ADD PRIMARY KEY (`id_mading`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- Indexes for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD PRIMARY KEY (`id_pengeluaran`),
  ADD KEY `id_pengeluaran` (`id_akun`) USING BTREE;

--
-- Indexes for table `saldo`
--
ALTER TABLE `saldo`
  ADD PRIMARY KEY (`id_saldo`),
  ADD KEY `id_akun` (`id_akun`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `mading`
--
ALTER TABLE `mading`
  MODIFY `id_mading` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  MODIFY `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `akun`
--
ALTER TABLE `akun`
  ADD CONSTRAINT `akun_ibfk_1` FOREIGN KEY (`id_level`) REFERENCES `level` (`id_level`),
  ADD CONSTRAINT `akun_ibfk_2` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`),
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`);

--
-- Constraints for table `mading`
--
ALTER TABLE `mading`
  ADD CONSTRAINT `mading_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);

--
-- Constraints for table `pengeluaran`
--
ALTER TABLE `pengeluaran`
  ADD CONSTRAINT `pengeluaran_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Constraints for table `saldo`
--
ALTER TABLE `saldo`
  ADD CONSTRAINT `saldo_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
