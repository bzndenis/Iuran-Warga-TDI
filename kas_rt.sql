-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2022 at 06:14 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kas_rt`
--

-- --------------------------------------------------------

--
-- Table structure for table `iuran`
--

CREATE TABLE `iuran` (
  `id` int(11) NOT NULL,
  `keterangan` tinytext NOT NULL,
  `tanggal` date NOT NULL,
  `bulan` int(2) NOT NULL,
  `tahun` year(4) NOT NULL,
  `jumlah` decimal(10,2) NOT NULL,
  `warga_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `iuran`
--

INSERT INTO `iuran` (`id`, `keterangan`, `tanggal`, `bulan`, `tahun`, `jumlah`, `warga_id`) VALUES
(1, 'Bayar Kas', '2022-07-11', 7, 2022, '50000.00', 1),
(2, 'Bayar Kas', '2022-10-08', 8, 2022, '50000.00', 2),
(5, 'Bayar Kas', '2022-07-09', 7, 2022, '20000.00', 8),
(6, 'Bayar Kas', '2022-07-10', 7, 2022, '35000.00', 13);

-- --------------------------------------------------------

--
-- Table structure for table `warga`
--

CREATE TABLE `warga` (
  `id` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `jkelamin` enum('L','P') NOT NULL,
  `alamat` tinytext NOT NULL,
  `no_rumah` varchar(10) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `slug` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `warga`
--

INSERT INTO `warga` (`id`, `nik`, `nama`, `jkelamin`, `alamat`, `no_rumah`, `status`, `slug`) VALUES
(1, '312010', 'Ilham Nur Utomo', 'L', 'Cibarusah', '23', 1, 'Ilham-Nur-Utomo'),
(2, '312025', 'Hans', 'L', 'Cibarusah', '5', 1, 'Hans'),
(3, '312023', 'Napoli', 'L', 'Cikarang', '13', 1, 'Napoli'),
(4, '312039', 'Yelan', 'P', 'Liyue', '65', 1, 'Yelan'),
(5, '320103', 'Xiao', 'L', 'Liyue', '12', 1, 'Xiao'),
(6, '312086', 'Yae Miko', 'P', 'Inazuma', '42', 1, 'Yae-Miko'),
(7, '31201071', 'Benett', 'L', 'Mondstadt', '79', 1, 'Benett'),
(8, '312028', 'Xingqiu', 'L', 'liyue', '29', 1, 'Xingqiu'),
(9, '312091', 'Diluc', 'L', 'Mondstadt', '62', 1, 'Diluc'),
(10, '312054', 'Real', 'P', 'Kp. 5', '48', 1, 'Real'),
(11, '9891', 'Ini', 'L', 'Curug', '232', 0, 'Ini'),
(12, '34241', 'Bapak', 'P', 'Curug', '4121', 0, 'Bapak'),
(13, '98981', 'Budi', 'L', 'Curug', '891', 0, 'Budi'),
(15, '3252', 'Yora', 'L', 'cikoronko', '0320', 2, 'Yora'),
(16, '214', 'ora', 'P', 'oi', '981', 0, 'ora'),
(19, '1123', 'kiiu', 'L', 'oio', '98', 0, 'kiiu'),
(20, '98', 'fanny', 'P', 'ioo', '71', 0, 'fanny'),
(21, '535', 'fff', 'L', 'ffd', '32', 0, 'fff'),
(22, '4234', 'ad', 'L', 'fcf', '43', 0, 'ad'),
(23, '3532', 'assa', 'P', 'gb', '45', 0, 'assa'),
(24, '8790', 'kook', 'L', 'yue', '686', 0, 'kook'),
(27, '54353', 'oooooooo', 'P', 'fsfa', '42', 0, 'oooooooo'),
(28, '4141', 'tuyi', 'P', 'jhjhj', '53', 0, 'tuyi'),
(31, '311021', 'yuri', 'P', 'sjdk', '21', 0, 'yuri');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `iuran`
--
ALTER TABLE `iuran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_iuran_warga_idx` (`warga_id`);

--
-- Indexes for table `warga`
--
ALTER TABLE `warga`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nik_UNIQUE` (`nik`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `iuran`
--
ALTER TABLE `iuran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `warga`
--
ALTER TABLE `warga`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `iuran`
--
ALTER TABLE `iuran`
  ADD CONSTRAINT `fk_iuran_warga_idx` FOREIGN KEY (`warga_id`) REFERENCES `warga` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
