-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2023 at 12:08 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.0.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_online`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `kode_barang` char(10) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `stok` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `berat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`kode_barang`, `nama_barang`, `stok`, `harga`, `gambar`, `berat`) VALUES
('BR00000001', 'RAM DDR3 8GB', 93, 450000, 'ram.jpg', 100),
('BR00000002', 'SSD 512GB MIDAFORCE', 96, 600000, 'ssd.jpg', 200),
('BR00000003', 'SSD 256GB MIDAFORCE', 98, 450000, 'ssd2.jpg', 250),
('BR00000004', 'FLASDISK SANDISK 128GB', 199, 200000, 'fd.jpg', 100),
('BR00000005', 'MOUSE', 49, 120000, 'mouse.jpg', 200),
('BR00000006', 'SEPATU', 98, 200000, 'sepatu.jpg', 700);

-- --------------------------------------------------------

--
-- Table structure for table `item_transaksi`
--

CREATE TABLE `item_transaksi` (
  `id` int(11) NOT NULL,
  `kode_barang` char(10) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `kuantitas` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `item_transaksi`
--

INSERT INTO `item_transaksi` (`id`, `kode_barang`, `id_transaksi`, `kuantitas`, `harga_jual`) VALUES
(19, 'BR00000006', 16, 2, 200000),
(20, 'BR00000003', 16, 1, 450000),
(21, 'BR00000001', 16, 2, 450000);

-- --------------------------------------------------------

--
-- Table structure for table `ongkir`
--

CREATE TABLE `ongkir` (
  `id` int(11) NOT NULL,
  `kode_pos_awal` int(11) NOT NULL,
  `kode_pos_tujuan` int(11) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ongkir`
--

INSERT INTO `ongkir` (`id`, `kode_pos_awal`, `kode_pos_tujuan`, `harga`) VALUES
(1, 11111, 22222, 12000),
(2, 11111, 33333, 36000),
(3, 11111, 44444, 20000),
(4, 11111, 55555, 8000);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_hp` varchar(13) NOT NULL,
  `alamat` text NOT NULL,
  `kode_pos` char(5) NOT NULL,
  `tanggal` date NOT NULL,
  `jumlah_total` int(11) NOT NULL,
  `ongkir` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `nama`, `no_hp`, `alamat`, `kode_pos`, `tanggal`, `jumlah_total`, `ongkir`) VALUES
(16, 'afif', '1234567890', '123', '22222', '2023-05-07', 1750000, 12000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`kode_barang`);

--
-- Indexes for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_item_transaksi_to_barang` (`kode_barang`),
  ADD KEY `fk_item_transaksi_to_transaksi` (`id_transaksi`);

--
-- Indexes for table `ongkir`
--
ALTER TABLE `ongkir`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `ongkir`
--
ALTER TABLE `ongkir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD CONSTRAINT `fk_item_transaksi_to_barang` FOREIGN KEY (`kode_barang`) REFERENCES `barang` (`kode_barang`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_item_transaksi_to_transaksi` FOREIGN KEY (`id_transaksi`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
