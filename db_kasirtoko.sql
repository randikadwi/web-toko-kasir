-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 06:28 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kasirtoko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `stok` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `id_kategori`, `harga`, `stok`, `id_satuan`, `created_at`, `updated_at`) VALUES
(1, 'Faber Castell Pencil 2B', 1, 4000, 20, 1, '2021-06-07 10:54:39', '2021-06-07 11:18:02'),
(2, 'Snowman Spidol Whiteboard Hitam', 1, 12000, 24, 1, '2021-06-07 10:55:44', '2021-06-07 11:18:35'),
(3, 'Kuaci Rebo 150 gr', 2, 13000, 15, 1, '2021-06-07 10:59:19', '2021-06-07 11:19:07'),
(4, 'Chocolatos Kaleng', 2, 27000, 10, 7, '2021-06-07 11:02:09', '2021-06-07 11:19:32'),
(5, 'Yakult', 3, 1500, 50, 1, '2021-06-07 11:03:12', '2021-06-07 11:20:00'),
(6, 'Harga larutan cap badak', 3, 6500, 12, 9, '2021-06-07 11:05:07', '2021-06-07 11:20:36'),
(7, 'Beras', 4, 10000, 100, 2, '2021-06-07 11:06:56', '2021-06-07 11:21:18'),
(8, 'Gulaku', 4, 12500, 18, 1, '2021-06-07 11:08:26', '2021-06-07 11:22:06'),
(9, 'Lifebuoy Sabun cair', 5, 34000, 15, 1, '2021-06-07 11:09:16', '2021-06-07 11:22:29'),
(10, 'Djarum Super ', 8, 180000, 10, 5, '2021-06-07 11:10:16', '2021-06-07 11:27:09'),
(11, 'Pita', 6, 2000, 0, 3, '2021-06-07 11:11:26', '2021-06-07 11:11:26');

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `id_kategori` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`id_kategori`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Alat Tulis', '2021-06-07 10:43:30', '2021-06-07 10:43:30'),
(2, 'Makanan', '2021-06-07 10:43:42', '2021-06-07 10:43:42'),
(3, 'Minuman', '2021-06-07 10:43:48', '2021-06-07 10:43:48'),
(4, 'Sembako', '2021-06-07 10:43:54', '2021-06-07 10:43:54'),
(5, 'Peralatan Mandi dan Mencuci', '2021-06-07 10:44:08', '2021-06-07 10:44:08'),
(6, 'Perlengkapan Rumah Tangga', '2021-06-07 10:44:20', '2021-06-07 10:44:20'),
(7, 'Obat-obatan', '2021-06-07 10:44:31', '2021-06-07 10:44:31'),
(8, 'Lain-lain', '2021-06-07 10:44:37', '2021-06-07 10:44:37');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `id_pegawai` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(1) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`id_pegawai`, `username`, `password`, `role`, `nama`, `alamat`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'admin123', '$2y$10$LYeiZAa8SMfCsirko4DhFuYG5wSSEnGn0sOgDVKc4gFaOr7CP7pdK', 1, 'Mas Admin', 'jakarta', '081999888777', '2021-06-07 03:19:31', '2021-06-07 03:19:31'),
(2, 'randikadwi', '$2y$10$YX7kcaKSHtIsDzcEvuo4AupKlJ5k.pkpk1bS2zWejkDQjXgym4Egy', 3, 'Randika Dwi M', 'Bandung', '0865123723213', '2021-06-07 03:34:11', '2021-06-07 03:34:11'),
(3, 'antonius', '$2y$10$oWwafj.5aBI1fMcB/Msc5OByZNInr1bt8j48rwflxCLq.KmGBlf0S', 2, 'Antonius Randy', 'Bekasi', '0875253123123', '2021-06-07 03:35:21', '2021-06-07 03:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `perusahaan`
--

CREATE TABLE `perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `perusahaan`
--

INSERT INTO `perusahaan` (`id_perusahaan`, `nama`, `alamat`, `email`, `no_telp`, `created_at`, `updated_at`) VALUES
(1, 'PT Garuda Food', 'Jogjakarta', 'garudafoodID@gmail.com', '02293223', '2021-06-07 03:40:28', '2021-06-07 03:40:28'),
(2, 'PT WingsFood', 'Jakarta', 'wingsfood@gmail.com', '02241241', '2021-06-07 03:41:11', '2021-06-07 03:41:11'),
(3, 'PT Alat Tulis Kantor', 'Depok', 'atk@gmail.com', '022345353', '2021-06-07 07:29:52', '2021-06-07 07:29:52'),
(4, 'PT Jaya Abadi', 'Bandung', 'jayaabadi@yahoo.com', '022348395', '2021-06-07 07:32:26', '2021-06-07 07:32:26'),
(5, 'PT Djarum ', 'Kudus', 'djarum@gmail.com', '02263254', '2021-06-07 07:33:28', '2021-06-07 07:33:28'),
(6, 'Unilever Indonesia PT Tbk', 'Semarang', 'unileverid@gmail.com', '02293434', '2021-06-07 07:37:18', '2021-06-07 07:37:18');

-- --------------------------------------------------------

--
-- Table structure for table `satuan_barang`
--

CREATE TABLE `satuan_barang` (
  `id_satuan` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `satuan_barang`
--

INSERT INTO `satuan_barang` (`id_satuan`, `nama`, `created_at`, `updated_at`) VALUES
(1, 'Pcs', '2021-06-07 10:41:34', '2021-06-07 10:41:34'),
(2, 'Kg', '2021-06-07 10:41:56', '2021-06-07 10:41:56'),
(3, 'Meter', '2021-06-07 10:42:06', '2021-06-07 10:42:06'),
(4, 'Liter', '2021-06-07 10:42:13', '2021-06-07 10:42:13'),
(5, 'Slop', '2021-06-07 10:42:21', '2021-06-07 10:42:21'),
(6, 'Lembar', '2021-06-07 10:42:27', '2021-06-07 10:42:27'),
(7, 'Box', '2021-06-07 10:42:45', '2021-06-07 10:42:45'),
(8, 'Bungkus', '2021-06-07 10:42:53', '2021-06-07 10:42:53'),
(9, 'Botol', '2021-06-07 11:04:25', '2021-06-07 11:04:25');

-- --------------------------------------------------------

--
-- Table structure for table `stok_keluar`
--

CREATE TABLE `stok_keluar` (
  `id_stok_keluar` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `updator` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stok_masuk`
--

CREATE TABLE `stok_masuk` (
  `id_stok_masuk` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `id_supplier` int(11) NOT NULL,
  `id_kategori` int(11) NOT NULL,
  `id_satuan` int(11) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga_total` int(11) NOT NULL,
  `updator` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stok_masuk`
--

INSERT INTO `stok_masuk` (`id_stok_masuk`, `id_barang`, `id_supplier`, `id_kategori`, `id_satuan`, `nama_barang`, `harga`, `jumlah`, `harga_total`, `updator`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, 1, 'Faber Castell Pencil 2B', 3000, 20, 60000, 'Randika Dwi M', '2021-06-07 11:18:02', '2021-06-07 11:18:02'),
(2, 2, 3, 1, 1, 'Snowman Spidol Whiteboard Hitam', 10000, 24, 240000, 'Randika Dwi M', '2021-06-07 11:18:35', '2021-06-07 11:18:35'),
(3, 3, 1, 2, 1, 'Kuaci Rebo 150 gr', 10000, 15, 150000, 'Randika Dwi M', '2021-06-07 11:19:07', '2021-06-07 11:19:07'),
(4, 4, 1, 2, 7, 'Chocolatos Kaleng', 24000, 10, 240000, 'Antonius Randy', '2021-06-07 11:19:32', '2021-06-07 11:19:32'),
(5, 5, 2, 3, 1, 'Yakult', 1100, 50, 55000, 'Randika Dwi M', '2021-06-07 11:20:00', '2021-06-07 11:20:00'),
(6, 6, 2, 3, 9, 'Harga larutan cap badak', 5200, 12, 62400, 'Randika Dwi M', '2021-06-07 11:20:36', '2021-06-07 11:20:36'),
(7, 7, 4, 4, 2, 'Beras', 9300, 100, 930000, 'Randika Dwi M', '2021-06-07 11:21:18', '2021-06-07 11:21:18'),
(8, 8, 4, 4, 1, 'Gulaku', 10000, 18, 180000, 'Randika Dwi M', '2021-06-07 11:22:06', '2021-06-07 11:22:06'),
(9, 9, 6, 5, 1, 'Lifebuoy Sabun cair', 30000, 15, 450000, 'Randika Dwi M', '2021-06-07 11:22:29', '2021-06-07 11:22:29'),
(10, 10, 5, 8, 5, 'Djarum Super ', 168000, 5, 840000, 'Randika Dwi M', '2021-06-07 11:24:44', '2021-06-07 11:24:44'),
(11, 10, 5, 8, 5, 'Djarum Super ', 168000, 5, 840000, 'Randika Dwi M', '2021-06-07 11:27:09', '2021-06-07 11:27:09');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id_supplier` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `no_telp` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id_supplier`, `nama`, `no_telp`, `alamat`, `id_perusahaan`, `created_at`, `updated_at`) VALUES
(1, 'Anang', '08323342323', 'Jogjakarta', 1, '2021-06-07 07:35:18', '2021-06-07 07:35:18'),
(2, 'Toto', '08234387384', 'Tangerang', 2, '2021-06-07 07:38:49', '2021-06-07 07:38:49'),
(3, 'Dodi', '0821312312', 'Karawang', 3, '2021-06-07 07:39:39', '2021-06-07 07:39:39'),
(4, 'Ilham', '08934345343', 'Cimahi', 4, '2021-06-07 07:41:39', '2021-06-07 07:41:39'),
(5, 'Akbar', '082234343332', 'Jogjakarta', 5, '2021-06-07 07:42:32', '2021-06-07 07:42:32'),
(6, 'Bambang', '08345354345', 'Semarang', 6, '2021-06-07 07:45:26', '2021-06-07 07:45:26');

-- --------------------------------------------------------

--
-- Table structure for table `temp_detail_transaksi`
--

CREATE TABLE `temp_detail_transaksi` (
  `id_temp` int(11) NOT NULL,
  `id_transaksi` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `jumlah_barang` int(11) NOT NULL,
  `total_harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `id_transaksi` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_kasir` varchar(255) NOT NULL,
  `total_harga` int(11) NOT NULL,
  `total_bayar` int(11) NOT NULL,
  `total_kembalian` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`),
  ADD KEY `fk_id_kategori` (`id_kategori`),
  ADD KEY `fk_id_satuan` (`id_satuan`);

--
-- Indexes for table `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD KEY `fk_id_transaksi` (`id_transaksi`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id_pegawai`);

--
-- Indexes for table `perusahaan`
--
ALTER TABLE `perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indexes for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  ADD PRIMARY KEY (`id_satuan`);

--
-- Indexes for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  ADD PRIMARY KEY (`id_stok_keluar`);

--
-- Indexes for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  ADD PRIMARY KEY (`id_stok_masuk`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id_supplier`),
  ADD KEY `fk_id_perusahaan` (`id_perusahaan`);

--
-- Indexes for table `temp_detail_transaksi`
--
ALTER TABLE `temp_detail_transaksi`
  ADD PRIMARY KEY (`id_temp`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`id_transaksi`),
  ADD KEY `fk_username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id_pegawai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `perusahaan`
--
ALTER TABLE `perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `satuan_barang`
--
ALTER TABLE `satuan_barang`
  MODIFY `id_satuan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `stok_keluar`
--
ALTER TABLE `stok_keluar`
  MODIFY `id_stok_keluar` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stok_masuk`
--
ALTER TABLE `stok_masuk`
  MODIFY `id_stok_masuk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id_supplier` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `temp_detail_transaksi`
--
ALTER TABLE `temp_detail_transaksi`
  MODIFY `id_temp` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `id_transaksi` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `fk_id_kategori` FOREIGN KEY (`id_kategori`) REFERENCES `kategori_barang` (`id_kategori`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_id_satuan` FOREIGN KEY (`id_satuan`) REFERENCES `satuan_barang` (`id_satuan`) ON DELETE CASCADE;

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `fk_id_perusahaan` FOREIGN KEY (`id_perusahaan`) REFERENCES `perusahaan` (`id_perusahaan`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
