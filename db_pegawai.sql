-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 13, 2020 at 06:39 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pegawai`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `kode_barang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_barang` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_barang` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `kode_barang`, `nama_barang`, `harga_barang`) VALUES
(1, 'UDC3957234', 'KACANG KUACI RASA JERUK 10G', 5000),
(2, 'UDC9375824', 'PERMEN YUPI 25S', 12000),
(3, 'UDC9385739', 'ES KIKO RAINBOW 250G', 17000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id`, `id_pegawai`, `id_barang`, `qty`, `updated_at`, `created_at`) VALUES
(1, 31, 2, 3, '2020-09-13 02:48:09', '2020-09-13 02:48:09'),
(2, 31, 1, 6, '2020-09-13 02:52:11', '2020-09-13 02:52:11');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pegawai`
--

CREATE TABLE `tb_pegawai` (
  `id` int(11) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `posisi` text NOT NULL,
  `gaji` int(11) NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pegawai`
--

INSERT INTO `tb_pegawai` (`id`, `nama`, `posisi`, `gaji`, `photo`, `created_at`, `updated_at`) VALUES
(28, 'Zuhri', 'IT Staff', 500000, NULL, '2020-08-29 10:04:09', NULL),
(31, 'joni', 'stafg', 1000000, 'joni-2020-09-13-113649-lRPC6B5p46.png', '2020-08-29 10:04:09', '2020-09-13 04:36:49'),
(36, 'Fulan 2', 'Staff', 4000000, NULL, '2020-08-29 03:05:38', '2020-08-29 03:05:38');

-- --------------------------------------------------------

--
-- Table structure for table `tb_topping`
--

CREATE TABLE `tb_topping` (
  `id` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `nama_topping` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_topping` double NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tb_topping`
--

INSERT INTO `tb_topping` (`id`, `id_barang`, `nama_topping`, `harga_topping`, `updated_at`, `created_at`) VALUES
(1, 1, 'SAUS KEJU', 6000, '2020-09-13 10:23:45', '0000-00-00 00:00:00'),
(2, 1, 'SUSU VANILLA', 10000, '2020-09-13 10:23:45', '0000-00-00 00:00:00'),
(3, 2, 'GARAM MANIS PEDAS', 3000, '2020-09-13 10:23:45', '0000-00-00 00:00:00'),
(4, 2, 'SAUS TOMAT', 4000, '2020-09-13 10:23:45', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kode_barang` (`kode_barang`);

--
-- Indexes for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tb_topping`
--
ALTER TABLE `tb_topping`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_pegawai`
--
ALTER TABLE `tb_pegawai`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tb_topping`
--
ALTER TABLE `tb_topping`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
