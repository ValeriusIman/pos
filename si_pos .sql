-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 22, 2020 at 04:52 PM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `si_pos`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `kode_barang` varchar(20) NOT NULL,
  `nama_barang` varchar(30) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT 0,
  `stock` int(11) DEFAULT 0,
  `jenis_barang_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `is_active` tinyint(4) DEFAULT 1,
  `profit` int(11) NOT NULL DEFAULT 0,
  `HPP` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `kode_barang`, `nama_barang`, `harga_barang`, `stock`, `jenis_barang_id`, `satuan_id`, `is_active`, `profit`, `HPP`) VALUES
(41, 'A001', 'Fanta', 5000, 71, 6, 6, 1, 1000, 4000),
(42, 'A002', 'Lasegar Anggur', 5000, 96, 6, 6, 1, 1000, 4000),
(43, 'A003', 'Adem Sari', 2500, 992, 6, 9, 1, 1000, 1500),
(44, 'B001', 'Pensil 2B', 4500, 897, 5, 7, 1, 1000, 3500),
(45, 'C001', 'Indomie Goreng', 3500, 73, 4, 9, 1, 1000, 2500),
(46, 'C002', 'Indomie Soto', 3500, 200, 4, 9, 1, 1000, 2500);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `total_hpp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item_beli`
--

CREATE TABLE `item_beli` (
  `id_item_beli` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `satuan_id` int(11) NOT NULL,
  `harga_item_beli` int(11) NOT NULL,
  `qty_item_beli` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `isi` int(11) NOT NULL,
  `transaksi_beli_id` int(11) NOT NULL,
  `profit` int(11) NOT NULL,
  `HPP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_beli`
--

INSERT INTO `item_beli` (`id_item_beli`, `barang_id`, `satuan_id`, `harga_item_beli`, `qty_item_beli`, `harga_jual`, `isi`, `transaksi_beli_id`, `profit`, `HPP`) VALUES
(5, 41, 6, 48000, 1, 5000, 12, 15, 1000, 4000),
(6, 42, 6, 48000, 1, 5000, 12, 16, 1000, 4000),
(7, 43, 9, 36000, 1, 2500, 24, 17, 1000, 1500),
(8, 44, 7, 30000, 1, 3500, 12, 18, 1000, 2500),
(9, 41, 6, 48000, 1, 5000, 12, 19, 1000, 4000),
(10, 42, 6, 48000, 1, 5000, 12, 19, 1000, 4000),
(11, 44, 7, 42000, 1, 4500, 12, 20, 1000, 3500),
(12, 45, 11, 100000, 1, 3500, 40, 21, 1000, 2500),
(13, 45, 11, 100000, 1, 3500, 40, 22, 1000, 2500),
(14, 46, 11, 100000, 1, 3500, 40, 23, 1000, 2500);

--
-- Triggers `item_beli`
--
DELIMITER $$
CREATE TRIGGER `update_HPP` BEFORE INSERT ON `item_beli` FOR EACH ROW BEGIN
	UPDATE barang SET HPP = NEW.HPP
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_harga` BEFORE INSERT ON `item_beli` FOR EACH ROW BEGIN
	UPDATE barang SET harga_barang = NEW.harga_jual
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_profit` BEFORE INSERT ON `item_beli` FOR EACH ROW BEGIN
	UPDATE barang SET profit = NEW.profit
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_transaksi`
--

CREATE TABLE `item_transaksi` (
  `id_item_transaksi` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `total_item_transaksi` int(11) NOT NULL,
  `harga_item_transaksi` int(11) NOT NULL,
  `qty_item_transaksi` int(11) NOT NULL,
  `total_hpp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item_transaksi`
--

INSERT INTO `item_transaksi` (`id_item_transaksi`, `barang_id`, `transaksi_id`, `total_item_transaksi`, `harga_item_transaksi`, `qty_item_transaksi`, `total_hpp`) VALUES
(104, 41, 91, 50000, 5000, 10, 40000),
(105, 42, 92, 15000, 5000, 3, 12000),
(106, 43, 93, 17500, 2500, 7, 10500),
(107, 41, 94, 5000, 5000, 1, 4000),
(108, 42, 94, 5000, 5000, 1, 4000),
(109, 43, 94, 2500, 2500, 1, 1500),
(110, 41, 95, 5000, 5000, 1, 4000),
(111, 44, 96, 4500, 4500, 1, 3500),
(112, 41, 97, 15000, 5000, 3, 12000),
(113, 41, 98, 5000, 5000, 1, 4000),
(114, 44, 99, 4500, 4500, 1, 3500),
(115, 44, 100, 450000, 4500, 100, 350000),
(117, 41, 102, 10000, 5000, 2, 8000),
(118, 44, 102, 4500, 4500, 1, 3500);

--
-- Triggers `item_transaksi`
--
DELIMITER $$
CREATE TRIGGER `stock_min` BEFORE INSERT ON `item_transaksi` FOR EACH ROW BEGIN
	UPDATE barang SET stock = stock - NEW.qty_item_transaksi
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `item_tunda`
--

CREATE TABLE `item_tunda` (
  `id_item_tunda` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `tunda_id` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `hpp` int(11) NOT NULL,
  `total_hpp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_barang`
--

CREATE TABLE `jenis_barang` (
  `id_jenis_barang` int(11) NOT NULL,
  `jenis_barang` varchar(20) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jenis_barang`
--

INSERT INTO `jenis_barang` (`id_jenis_barang`, `jenis_barang`, `is_active`) VALUES
(4, 'Bahan Pokok', 1),
(5, 'Alat Tulis', 1),
(6, 'Minuman', 1),
(8, 'Makanan Ringan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pelanggan`
--

CREATE TABLE `pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(20) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pelanggan`
--

INSERT INTO `pelanggan` (`id_pelanggan`, `nama_pelanggan`, `no_telp`, `is_active`) VALUES
(12, 'Umum', '', 1),
(13, 'Budi', '1212-1212-1221', 1),
(15, 'Rini', '3232-3232-3232', 1);

-- --------------------------------------------------------

--
-- Table structure for table `satuan`
--

CREATE TABLE `satuan` (
  `id_satuan` int(11) NOT NULL,
  `satuan_barang` varchar(20) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan`
--

INSERT INTO `satuan` (`id_satuan`, `satuan_barang`, `is_active`) VALUES
(5, 'kg', 1),
(6, 'kaleng', 1),
(7, 'Kotak', 1),
(9, 'pcs', 1),
(10, 'botol', 1),
(11, 'Kardus', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `id_stock` int(11) NOT NULL,
  `no_struck` varchar(30) NOT NULL,
  `date` date NOT NULL,
  `type` varchar(5) NOT NULL,
  `detail` text NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`id_stock`, `no_struck`, `date`, `type`, `detail`, `user_id`) VALUES
(30, 'In/2020/06/15 0', '2020-06-15', 'In', '', 3),
(32, 'Out/2020/06/15 ', '2020-06-15', 'Out', 'Pecah', 3),
(33, 'In/2020/06/15 19:09:26', '2020-06-15', 'In', '', 3),
(34, 'In/2020/06/15 22:16:01', '2020-06-15', 'In', '', 3),
(35, 'In/2020/06/17 08:42:30', '2020-06-17', 'In', '', 3),
(36, 'In/2020/06/18 08:19:43', '2020-06-18', 'In', '', 3),
(37, 'Out/2020/06/18 08:20:17', '2020-06-18', 'Out', 'Rusak', 3),
(38, 'Out/2020/06/18 18:21:35', '2020-06-18', 'Out', '', 3),
(39, 'In/2020/06/19 10:03:26', '2020-06-19', 'In', '', 3),
(40, 'Out/2020/06/19 10:03:47', '2020-06-19', 'Out', 'Kemasan Rusak', 3),
(41, 'In/2020/06/19 11:04:07', '2020-06-19', 'In', '', 3),
(42, 'Out/2020/06/21 15:43:43', '2020-06-21', 'Out', 'Anda bingung untuk mencari selisih waktu dan tanggal dalam aplikasi yang Anda buat? Jangan khawatir, dengan statement SQL, Anda dapat mencarinya dengan mudah.\n\nApabila Anda familiar dengan PHP, maka setahu saya tidak ada function dalam PHP yang dapat digunakan untuk mencari selisih waktu dan tanggal secara instan, atau tinggal pakai. Namun Anda terlebih dahulu membuatnya sendiri, dan itu tentu saja butuh waktu banyak.', 3);

-- --------------------------------------------------------

--
-- Table structure for table `stock_item`
--

CREATE TABLE `stock_item` (
  `id_stock_item` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_item`
--

INSERT INTO `stock_item` (`id_stock_item`, `stock_id`, `barang_id`, `supplier_id`, `qty`) VALUES
(1, 30, 41, 8, 100),
(3, 33, 42, 8, 100),
(4, 34, 43, 8, 1000),
(5, 35, 44, 11, 1000),
(6, 36, 45, 6, 40),
(7, 39, 45, 10, 40),
(8, 41, 46, 6, 200);

--
-- Triggers `stock_item`
--
DELIMITER $$
CREATE TRIGGER `insertStock` BEFORE INSERT ON `stock_item` FOR EACH ROW BEGIN
	UPDATE barang SET stock = stock + NEW.qty
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_item`
--

CREATE TABLE `stock_out_item` (
  `id_stock_out` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `barang_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_out_item`
--

INSERT INTO `stock_out_item` (`id_stock_out`, `stock_id`, `barang_id`, `supplier_id`, `qty`) VALUES
(1, 32, 41, 8, 5),
(2, 37, 45, 6, 3),
(3, 38, 45, 6, 2),
(4, 40, 45, 10, 2),
(5, 42, 41, 7, 10);

--
-- Triggers `stock_out_item`
--
DELIMITER $$
CREATE TRIGGER `insertStockOut` BEFORE INSERT ON `stock_out_item` FOR EACH ROW BEGIN
	UPDATE barang SET stock = stock - NEW.qty
	WHERE id_barang = NEW.barang_id;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama_supplier` varchar(20) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `alamat` varchar(30) DEFAULT NULL,
  `keterangan` varchar(30) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama_supplier`, `no_telp`, `alamat`, `keterangan`, `is_active`) VALUES
(6, 'Toko A', '2222-2222-2222', 'Kalasan', 'IndoMie', 1),
(7, 'Toko B', '3333-3333-3333', 'Maguwoharjo', 'Minyak Goreng', 1),
(8, 'Toko C', '9999-9999-9999', 'padang', 'Minuman', 1),
(10, 'Toko D', '9999-9999-9999', 'padang', 'Alat Tulis', 1),
(11, 'Toko E', '9898-9899-9998', 'Maguwoharjo', 'Alat Tulis', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `no_transaksi` varchar(100) NOT NULL,
  `tanggal_transaksi` date NOT NULL,
  `total_harga` int(11) NOT NULL,
  `diskon` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `kembalian` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `grand_total` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pelanggan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id_transaksi`, `no_transaksi`, `tanggal_transaksi`, `total_harga`, `diskon`, `bayar`, `kembalian`, `nomor`, `grand_total`, `user_id`, `pelanggan_id`) VALUES
(91, 'TRX/200615/0001', '2020-04-15', 50000, 0, 50000, 0, 1, 50000, 3, 12),
(92, 'TRX/200615/0002', '2020-05-15', 15000, 0, 20000, 5000, 2, 15000, 3, 12),
(93, 'TRX/200616/0001', '2020-06-16', 17500, 0, 20000, 2500, 1, 17500, 3, 12),
(94, 'TRX/200616/0002', '2020-06-16', 12500, 1000, 20000, 8500, 2, 11500, 3, 12),
(95, 'TRX/200617/0001', '2020-06-17', 5000, 0, 5000, 0, 1, 5000, 3, 12),
(96, 'TRX/200617/0002', '2020-06-17', 4500, 0, 5000, 500, 2, 4500, 3, 12),
(97, 'TRX/200617/0003', '2020-06-17', 15000, 0, 20000, 5000, 3, 15000, 7, 12),
(98, 'TRX/200618/0001', '2020-06-18', 5000, 0, 5000, 0, 1, 5000, 3, 12),
(99, 'TRX/200618/0002', '2020-06-18', 4500, 0, 5000, 500, 2, 4500, 3, 13),
(100, 'TRX/200619/0001', '2020-06-19', 450000, 2000, 450000, 2000, 1, 448000, 3, 12),
(102, 'TRX/200619/0002', '2020-06-19', 14500, 0, 20000, 5500, 2, 14500, 3, 12);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_beli`
--

CREATE TABLE `transaksi_beli` (
  `id_pembelian` int(11) NOT NULL,
  `no_pembelian` varchar(20) NOT NULL,
  `tanggal` date NOT NULL,
  `biaya` int(11) NOT NULL,
  `nomor` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transaksi_beli`
--

INSERT INTO `transaksi_beli` (`id_pembelian`, `no_pembelian`, `tanggal`, `biaya`, `nomor`, `user_id`, `supplier_id`) VALUES
(15, 'PB/200614/0001', '2020-04-14', 48000, 1, 3, 6),
(16, 'PB/200615/0001', '2020-04-15', 48000, 1, 3, 8),
(17, 'PB/200616/0001', '2020-05-16', 36000, 1, 3, 8),
(18, 'PB/200616/0002', '2020-05-16', 30000, 2, 3, 6),
(19, 'PB/200616/0003', '2020-06-16', 96000, 3, 3, 7),
(20, 'PB/200617/0001', '2020-06-17', 42000, 1, 3, 11),
(21, 'PB/200618/0001', '2020-06-18', 100000, 1, 3, 6),
(22, 'PB/200619/0001', '2020-06-19', 100000, 1, 3, 10),
(23, 'PB/200619/0002', '2020-06-19', 100000, 2, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_tunda`
--

CREATE TABLE `transaksi_tunda` (
  `id_tunda` int(11) NOT NULL,
  `no_tunda` varchar(50) NOT NULL,
  `nomor` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `jenis_kelamin` varchar(10) DEFAULT NULL,
  `alamat` varchar(50) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `tanggal_lahir` varchar(15) DEFAULT NULL,
  `level` int(1) DEFAULT NULL,
  `is_active` int(1) DEFAULT NULL,
  `token` varchar(200) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `email`, `nama`, `password`, `jenis_kelamin`, `alamat`, `no_telp`, `tanggal_lahir`, `level`, `is_active`, `token`, `date_created`) VALUES
(3, 'iman@gmail.com', 'iman', '$2y$10$No8m91I9IgbGnH685JdsqO.fA4RmNhfq/rhM4btADEZKfBzcco3W6', 'Laki-Laki', 'Cupuwatu 2', '1212-1212-1212', '14-08-1998', 1, 1, 'a379bdafdf1af0d1d2ecb5882c7fcfc1', 1587732841),
(7, 'admin@material.com', 'ADMIN', '$2y$10$XXqCJ0dFmwQErD2qOOuoFubI6cVgFhyYknFAfSmgiNaOnNmEkhKQq', 'Laki-Laki', 'Kalasan', '1111-1111-1111', '2003-05-06', 2, 1, '675d2427658dfab108def6260fe4b9e3', 1589263297),
(12, 'andi@gmail.com', 'Andi', '$2y$10$5X6PJcn1MFodRWFotorLTenEnqYda/QoKUyc9/9Eo/PJmsLo8AxFK', 'Laki-Laki', 'Kinali', '1234-1234-1234', '01-06-2003', 1, 1, '36b3d5b785e54f9249602da6184a3ed0', 1591798192);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD UNIQUE KEY `nomor_barang` (`kode_barang`),
  ADD KEY `jenis_barang_id` (`jenis_barang_id`),
  ADD KEY `satuan_id` (`satuan_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `item_beli`
--
ALTER TABLE `item_beli`
  ADD PRIMARY KEY (`id_item_beli`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `satuan_id` (`satuan_id`),
  ADD KEY `transaksi_beli_id` (`transaksi_beli_id`);

--
-- Indexes for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD PRIMARY KEY (`id_item_transaksi`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `transaksi_id` (`transaksi_id`);

--
-- Indexes for table `item_tunda`
--
ALTER TABLE `item_tunda`
  ADD PRIMARY KEY (`id_item_tunda`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `tunda_id` (`tunda_id`);

--
-- Indexes for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  ADD PRIMARY KEY (`id_jenis_barang`);

--
-- Indexes for table `pelanggan`
--
ALTER TABLE `pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indexes for table `satuan`
--
ALTER TABLE `satuan`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id_stock`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD PRIMARY KEY (`id_stock_item`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `stock_out_item`
--
ALTER TABLE `stock_out_item`
  ADD PRIMARY KEY (`id_stock_out`),
  ADD KEY `barang_id` (`barang_id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `pelanggan_id` (`pelanggan_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaksi_beli`
--
ALTER TABLE `transaksi_beli`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `transaksi_tunda`
--
ALTER TABLE `transaksi_tunda`
  ADD PRIMARY KEY (`id_tunda`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `item_beli`
--
ALTER TABLE `item_beli`
  MODIFY `id_item_beli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  MODIFY `id_item_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `item_tunda`
--
ALTER TABLE `item_tunda`
  MODIFY `id_item_tunda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `jenis_barang`
--
ALTER TABLE `jenis_barang`
  MODIFY `id_jenis_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pelanggan`
--
ALTER TABLE `pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `satuan`
--
ALTER TABLE `satuan`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `id_stock` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `stock_item`
--
ALTER TABLE `stock_item`
  MODIFY `id_stock_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_out_item`
--
ALTER TABLE `stock_out_item`
  MODIFY `id_stock_out` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `transaksi_beli`
--
ALTER TABLE `transaksi_beli`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `transaksi_tunda`
--
ALTER TABLE `transaksi_tunda`
  MODIFY `id_tunda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`jenis_barang_id`) REFERENCES `jenis_barang` (`id_jenis_barang`),
  ADD CONSTRAINT `barang_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`);

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `item_beli`
--
ALTER TABLE `item_beli`
  ADD CONSTRAINT `item_beli_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `item_beli_ibfk_2` FOREIGN KEY (`satuan_id`) REFERENCES `satuan` (`id_satuan`),
  ADD CONSTRAINT `item_beli_ibfk_3` FOREIGN KEY (`transaksi_beli_id`) REFERENCES `transaksi_beli` (`id_pembelian`);

--
-- Constraints for table `item_transaksi`
--
ALTER TABLE `item_transaksi`
  ADD CONSTRAINT `item_transaksi_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `item_transaksi_ibfk_4` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id_transaksi`);

--
-- Constraints for table `item_tunda`
--
ALTER TABLE `item_tunda`
  ADD CONSTRAINT `item_tunda_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `item_tunda_ibfk_3` FOREIGN KEY (`tunda_id`) REFERENCES `transaksi_tunda` (`id_tunda`);

--
-- Constraints for table `stock`
--
ALTER TABLE `stock`
  ADD CONSTRAINT `stock_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `stock_item`
--
ALTER TABLE `stock_item`
  ADD CONSTRAINT `stock_item_ibfk_1` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `stock_item_ibfk_2` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `stock_item_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `stock_out_item`
--
ALTER TABLE `stock_out_item`
  ADD CONSTRAINT `stock_out_item_ibfk_1` FOREIGN KEY (`barang_id`) REFERENCES `barang` (`id_barang`),
  ADD CONSTRAINT `stock_out_item_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stock` (`id_stock`),
  ADD CONSTRAINT `stock_out_item_ibfk_3` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`pelanggan_id`) REFERENCES `pelanggan` (`id_pelanggan`),
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);

--
-- Constraints for table `transaksi_beli`
--
ALTER TABLE `transaksi_beli`
  ADD CONSTRAINT `transaksi_beli_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`),
  ADD CONSTRAINT `transaksi_beli_ibfk_2` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id_supplier`);

--
-- Constraints for table `transaksi_tunda`
--
ALTER TABLE `transaksi_tunda`
  ADD CONSTRAINT `transaksi_tunda_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
