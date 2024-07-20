-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2024 at 10:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appkasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailtransaksi`
--

CREATE TABLE `detailtransaksi` (
  `id` int(11) NOT NULL,
  `transaksi_id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `total` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detailtransaksi`
--

INSERT INTO `detailtransaksi` (`id`, `transaksi_id`, `produk_id`, `quantity`, `harga`, `total`) VALUES
(13, 1, 1, 3, 4000.00, 12000.00),
(14, 1, 2, 1, 9000.00, 9000.00),
(15, 2, 1, 1, 4000.00, 4000.00),
(16, 2, 4, 1, 9000.00, 9000.00),
(17, 2, 5, 1, 15000.00, 15000.00),
(18, 2, 6, 2, 6000.00, 12000.00),
(19, 3, 1, 2, 4000.00, 8000.00),
(20, 3, 3, 1, 9000.00, 9000.00),
(21, 3, 4, 1, 15000.00, 15000.00),
(22, 4, 1, 1, 4000.00, 4000.00),
(23, 4, 2, 1, 9000.00, 9000.00),
(24, 4, 3, 1, 15000.00, 15000.00),
(25, 4, 4, 1, 6000.00, 6000.00),
(26, 4, 5, 1, 4000.00, 4000.00),
(27, 4, 6, 1, 14000.00, 14000.00),
(28, 4, 7, 2, 11000.00, 22000.00),
(29, 4, 8, 2, 11000.00, 22000.00),
(30, 5, 2, 1, 4000.00, 4000.00),
(31, 5, 4, 2, 9000.00, 18000.00),
(32, 5, 7, 1, 15000.00, 15000.00),
(33, 6, 1, 5, 4000.00, 20000.00),
(34, 6, 7, 1, 9000.00, 9000.00),
(35, 7, 3, 1, 4000.00, 4000.00),
(36, 8, 2, 1, 4000.00, 4000.00),
(37, 8, 4, 1, 9000.00, 9000.00),
(38, 9, 2, 1, 4000.00, 4000.00),
(39, 9, 4, 1, 9000.00, 9000.00),
(40, 9, 7, 1, 15000.00, 15000.00),
(41, 10, 1, 1, 4000.00, 4000.00),
(42, 10, 2, 1, 9000.00, 9000.00),
(43, 10, 5, 1, 15000.00, 15000.00),
(44, 10, 7, 1, 6000.00, 6000.00),
(45, 11, 1, 1, 4000.00, 4000.00),
(46, 11, 3, 1, 9000.00, 9000.00),
(47, 12, 4, 1, 4000.00, 4000.00),
(48, 12, 7, 1, 9000.00, 9000.00),
(49, 13, 2, 1, 4000.00, 4000.00),
(50, 13, 3, 1, 9000.00, 9000.00),
(51, 14, 6, 1, 4000.00, 4000.00);

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(11) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `prefix` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `kategori`, `prefix`) VALUES
(3, 'Makanan', 'FD-'),
(4, 'Minuman', 'DR-');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `kategori_id` int(11) NOT NULL,
  `kode_produk` char(6) NOT NULL,
  `namaProduk` varchar(100) NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp(),
  `updatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `kode_produk`, `namaProduk`, `harga`, `stock`, `gambar`, `createdAt`, `updatedAt`) VALUES
(1, 3, 'FD-001', 'Chitatos', 4000.00, 36, 'chi.jpg\r\n', '2024-06-28 00:55:35', '2024-07-09 19:38:13'),
(2, 3, 'FD-002', 'Oreo', 9000.00, 43, 'oreo.jpg', '2024-06-28 01:32:37', '2024-07-09 19:40:22'),
(3, 3, 'FD-003', 'Kinder joy', 15000.00, 45, 'kj.jpg', '2024-06-28 02:51:17', '2024-07-09 19:40:22'),
(4, 3, 'FD-004', 'Tictac', 6000.00, 42, 'tictac.jpg', '2024-06-28 03:04:46', '2024-07-09 19:39:45'),
(5, 3, 'FD-005', 'Happydent white', 4000.00, 47, 'hp.jpg', '2024-07-08 04:28:30', '2024-07-09 19:36:45'),
(6, 3, 'FD-006', 'Pocky Chocolate', 14000.00, 46, 'pc.jpg', '2024-07-08 04:39:22', '2024-07-09 19:41:48'),
(7, 4, 'DR-007', 'Cimory Yogurt Original', 11000.00, 43, 'cmo.jpg', '2024-07-09 17:21:14', '2024-07-09 19:39:45'),
(8, 4, 'DR-008', 'Cimory Yogurt Brown Sugar', 11000.00, 48, 'cmb.jpg', '2024-07-09 17:27:48', '2024-07-09 18:57:48');

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id` int(11) NOT NULL,
  `produk_id` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id`, `produk_id`, `jumlah`, `user`, `createdAt`) VALUES
(1, 1, 50, 'Park Sungho', '2024-06-28 03:31:05'),
(2, 2, 50, 'Park Sungho', '2024-06-28 03:31:29'),
(3, 3, 50, 'Park Sungho', '2024-06-28 03:31:35'),
(4, 4, 50, 'Park Sungho', '2024-06-28 03:31:42'),
(5, 5, 50, 'abiyya', '2024-07-08 04:28:42'),
(6, 6, 50, 'Park Sungho', '2024-07-08 04:39:29'),
(7, 7, 50, 'abiyya', '2024-07-09 17:25:49'),
(8, 8, 50, 'abiyya', '2024-07-09 17:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `tunai` decimal(10,2) NOT NULL,
  `kembalian` decimal(10,2) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp(),
  `user` varchar(255) NOT NULL,
  `nama_pelanggan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`id`, `total`, `tunai`, `kembalian`, `tanggal`, `user`, `nama_pelanggan`) VALUES
(1, 21000.00, 50000.00, 29000.00, '2024-06-28 06:25:39', 'abiyya', 'ahsan'),
(2, 62000.00, 100000.00, 38000.00, '2024-07-08 14:27:48', 'Larisa', 'abida'),
(3, 29000.00, 50000.00, 21000.00, '2024-07-09 07:25:01', 'Larisa', 'Iki'),
(4, 96000.00, 100000.00, 4000.00, '2024-07-09 18:57:48', 'Larisa', 'rara'),
(5, 58000.00, 70000.00, 12000.00, '2024-07-09 19:07:34', 'Larisa', 'yasna'),
(6, 75000.00, 80000.00, 5000.00, '2024-07-09 19:25:09', 'Larisa', 'ghozi'),
(7, 30000.00, 30000.00, 0.00, '2024-07-09 19:29:47', 'Larisa', 'abida'),
(8, 15000.00, 20000.00, 5000.00, '2024-07-09 19:33:27', 'Larisa', 'gheca'),
(9, 26000.00, 50000.00, 24000.00, '2024-07-09 19:34:46', 'Larisa', 'ghea'),
(10, 44000.00, 50000.00, 6000.00, '2024-07-09 19:36:45', 'Larisa', 'aka'),
(11, 19000.00, 20000.00, 1000.00, '2024-07-09 19:38:13', 'Larisa', 'azkia'),
(12, 17000.00, 20000.00, 3000.00, '2024-07-09 19:39:45', 'Larisa', 'gholib'),
(13, 24000.00, 25000.00, 1000.00, '2024-07-09 19:40:22', 'Larisa', 'radhiah'),
(14, 70000.00, 100000.00, 30000.00, '2024-07-09 19:41:48', 'Larisa', 'labib');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `role` enum('admin','manager','kasir','inventori') NOT NULL,
  `email` varchar(100) NOT NULL,
  `nohp` char(13) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `role`, `email`, `nohp`, `createdAt`) VALUES
('abi', '$2y$10$h6QTFQ9a6QEmoiSo9mivQuftYk5HxF0gVwZs1GwuhYJluJt5r6boi', 'abiyya', 'admin', 'abi@gmail.com', '089776566789', '2024-06-28 05:58:53'),
('lala', '$2y$10$0MrHczY4slEMQH3vxeHC/O8hKoqAJBRRa2QD2XmGdtnl1l8pMf7JG', 'Larisa', 'kasir', 'lala1122@gmail.com', '089177651123', '2024-07-08 11:24:05'),
('sungho', '$2y$10$8iETOpMv3jwzL91iXaza2.M0VwK/odc8VSFikG2F8Cu0R/zXyNu0.', 'Park Sungho', 'admin', 'sungho@gmail.com', '089765434564', '2024-06-26 02:41:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD PRIMARY KEY (`id`),
  ADD KEY `produk_id` (`produk_id`),
  ADD KEY `detailtransaksi_ibfk_1` (`transaksi_id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stok_masuk_ibfk_1` (`produk_id`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailtransaksi`
--
ALTER TABLE `detailtransaksi`
  ADD CONSTRAINT `detailtransaksi_ibfk_1` FOREIGN KEY (`transaksi_id`) REFERENCES `transaksi` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailtransaksi_ibfk_2` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`);

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`);

--
-- Constraints for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD CONSTRAINT `stok_masuk_ibfk_1` FOREIGN KEY (`produk_id`) REFERENCES `produk` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
