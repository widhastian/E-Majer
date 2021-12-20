-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 08:16 AM
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
  `id_akun` varchar(15) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_kelas` varchar(15) NOT NULL,
  `id_level` int(11) NOT NULL,
  `saldo` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama`, `email`, `username`, `password`, `id_kelas`, `id_level`, `saldo`) VALUES
('M-44732', 'Muh. Yusril Amin', 'yusril@gmail.com', 'yusrilamin23', '123', 'K-02', 1, '86000'),
('M-46346', 'yusril111', 'yusril123@gmail.com', 'akuyusril', '123', 'K-02', 2, '0'),
('M-47195', 'Dinda Kusmara', 'dinda@gmail.com', 'dinda', '123', 'K-02', 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` varchar(15) NOT NULL,
  `Nama_barang` varchar(25) NOT NULL,
  `jumlah_barang` varchar(11) NOT NULL,
  `id_kelas` varchar(15) NOT NULL,
  `kondisi` int(11) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `Nama_barang`, `jumlah_barang`, `id_kelas`, `kondisi`, `foto`) VALUES
('B-35630', 'Indomilk', '12', 'K-02', 1, 'Barang_B-35630.png'),
('B-52348', 'Indomilk', '12', 'K-02', 2, 'Barang_B-52348.jpg'),
('B-58248', 'papan tulis', '1', 'K-02', 2, 'Barang_B-58248.png'),
('B-65352', 'Penghapus', '2', 'K-02', 1, 'Barang_B-65352.png'),
('B-88285', 'sss', '12', 'K-02', 3, 'Barang_B-88285.png');

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengeluaran`
--

CREATE TABLE `detail_pengeluaran` (
  `id_detail` varchar(15) NOT NULL,
  `id_barang` varchar(15) NOT NULL,
  `id_pengeluaran` varchar(15) NOT NULL,
  `jumlah` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pengeluaran`
--

INSERT INTO `detail_pengeluaran` (`id_detail`, `id_barang`, `id_pengeluaran`, `jumlah`) VALUES
('DT-72701', 'B-58248', 'BL-99489', '3');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` varchar(15) NOT NULL,
  `nama_kelass` varchar(50) NOT NULL,
  `nominal_uangkas` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelass`, `nominal_uangkas`) VALUES
('K-01', 'TIF A', '2000'),
('K-02', 'TIF B', '2000'),
('K-26430', 'TIF D', '2000'),
('K-29092', 'TIF G', '2000'),
('K-54609', 'TIF D', '2000'),
('K-92735', 'TIF E', '2000');

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
  `id_mading` varchar(15) NOT NULL,
  `jenis_mading` varchar(10) NOT NULL,
  `deskripsi_mading` text NOT NULL,
  `tgl_pembagian` date NOT NULL,
  `id_kelas` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mading`
--

INSERT INTO `mading` (`id_mading`, `jenis_mading`, `deskripsi_mading`, `tgl_pembagian`, `id_kelas`) VALUES
('MDG-64866', '2', 'wewew', '2021-12-14', 'K-02'),
('MDG-6490', '1', 'wewew', '2021-12-03', 'K-02'),
('MDG-72122', '1', 'ssss', '2021-12-09', 'K-02');

-- --------------------------------------------------------

--
-- Table structure for table `minggu`
--

CREATE TABLE `minggu` (
  `id_minggu` int(11) NOT NULL,
  `nama_minggu` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `nama_kelas` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `minggu`
--

INSERT INTO `minggu` (`id_minggu`, `nama_minggu`, `tanggal`, `nama_kelas`) VALUES
(1, 'Minggu 1', '2021-12-15', 'K-02'),
(2, 'Minggu 2', '2021-12-22', 'K-02');

-- --------------------------------------------------------

--
-- Table structure for table `pengeluaran`
--

CREATE TABLE `pengeluaran` (
  `id_pengeluaran` varchar(15) NOT NULL,
  `nominal_pengeluaran` varchar(25) NOT NULL,
  `tgl_pengeluaran` date NOT NULL,
  `id_akun` varchar(15) NOT NULL,
  `nama_kelas` varchar(15) NOT NULL,
  `foto` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengeluaran`
--

INSERT INTO `pengeluaran` (`id_pengeluaran`, `nominal_pengeluaran`, `tgl_pengeluaran`, `id_akun`, `nama_kelas`, `foto`) VALUES
('BL-21871', '10000', '2021-12-10', 'M-44732', 'K-02', 'Nota_BL-21871.jpg'),
('BL-74195', '20000', '2021-12-12', 'M-44732', 'K-02', 'Nota_BL-74195.jpg'),
('BL-80022', '10000', '2021-12-15', 'M-44732', 'K-02', 'Nota_BL-80022.png'),
('BL-99489', '10000', '2021-12-03', 'M-44732', 'K-02', 'Nota_BL-99489.png');

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
  `id_akun` varchar(15) NOT NULL,
  `tgl_topup` date NOT NULL,
  `jumlah_saldo` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saldo`
--

INSERT INTO `saldo` (`id_saldo`, `id_akun`, `tgl_topup`, `jumlah_saldo`) VALUES
(1, 'M-44732', '2021-12-09', '100000');

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
  `id_transaksi` varchar(15) NOT NULL,
  `id_akun` varchar(15) NOT NULL,
  `nama_kelas` varchar(25) NOT NULL,
  `tanggal_pembayaran` date NOT NULL,
  `nominal_transaksi` varchar(20) NOT NULL,
  `status` int(11) NOT NULL,
  `id_minggu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `id_akun`, `nama_kelas`, `tanggal_pembayaran`, `nominal_transaksi`, `status`, `id_minggu`) VALUES
('TR-25026', 'M-44732', 'K-02', '2021-12-18', '2000', 2, 2),
('TR-68829', 'M-44732', 'K-02', '2021-12-30', '2000', 2, 1),
('TR-91294', 'M-47195', 'K-02', '2021-12-18', '2000', 1, 1);

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
-- Indexes for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
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
-- Indexes for table `minggu`
--
ALTER TABLE `minggu`
  ADD PRIMARY KEY (`id_minggu`);

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
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_minggu` (`id_minggu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `level`
--
ALTER TABLE `level`
  MODIFY `id_level` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `minggu`
--
ALTER TABLE `minggu`
  MODIFY `id_minggu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `saldo`
--
ALTER TABLE `saldo`
  MODIFY `id_saldo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Constraints for table `detail_pengeluaran`
--
ALTER TABLE `detail_pengeluaran`
  ADD CONSTRAINT `detail_pengeluaran_ibfk_1` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `detail_pengeluaran_ibfk_2` FOREIGN KEY (`id_pengeluaran`) REFERENCES `pengeluaran` (`id_pengeluaran`);

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
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`id_minggu`) REFERENCES `minggu` (`id_minggu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;