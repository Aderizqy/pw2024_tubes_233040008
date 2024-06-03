-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 26, 2024 at 02:37 PM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pw2024_tubes_233040008`
--

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `kategori_id` int NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`kategori_id`, `nama`) VALUES
(1, 'Mie'),
(2, 'Dimsum'),
(3, 'Es Segar'),
(4, 'Thai Tea');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `harga` double DEFAULT NULL,
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `detail` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `ketersediaan_stok` enum('Habis','Tersedia') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `kategori_id`, `nama`, `harga`, `foto`, `detail`, `ketersediaan_stok`) VALUES
(1, 1, 'Mie Gacoan', 15000, 'miegacoan.jpg', NULL, 'Tersedia'),
(2, 1, 'Mie Hompimpa', 15000, 'miehompimpa.jpg', '', 'Tersedia'),
(3, 1, 'Mie Suit', 15000, 'miesuit.jpg', '', 'Tersedia'),
(4, 2, 'Lumpia Udang', 14000, 'lumpiaudang.jpg', '', 'Tersedia'),
(5, 2, 'Pangsit Goreng', 14000, 'pangsitgoreng.jpg', '', 'Tersedia'),
(6, 2, 'Siomay Ayam', 14000, 'siomayayam.jpg', '', 'Tersedia'),
(7, 2, 'Udang Keju', 14000, 'udangkeju.jpg', '', 'Tersedia'),
(8, 2, 'Udang Rambutan', 14000, 'udangrambutan.jpg', '', 'Tersedia'),
(9, 3, 'Es Gobak Sodor', 14000, 'esgobaksodor.jpg', '', 'Tersedia'),
(10, 3, 'Es Petak Umpet', 14000, 'espetakumpet.jpg', '', 'Tersedia'),
(11, 3, 'Es Sluku Bathok', 9500, 'esslukubathok.jpg', '', 'Tersedia'),
(12, 3, 'Es Teklek', 9500, 'esteklek.jpg', '', 'Tersedia'),
(13, 4, 'Es Coklat', 12500, 'escoklat.jpg', '', 'Tersedia'),
(14, 4, 'Thai Green Tea', 12500, 'thaigreentea.jpg', '', 'Tersedia'),
(15, 4, 'Thai Tea Ori', 12500, 'thaiteaori.jpg', '', 'Tersedia');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2a$12$/QhLerxivgs4sGeeer8TlO9yYq.3RM9FZNRznZp2YFEJwpDfmmLsW');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`kategori_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`),
  ADD KEY `NAMA` (`nama`),
  ADD KEY `KATEGORI_PRODUK` (`kategori_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `kategori_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `KATEGORI_PRODUK` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`kategori_id`) ON DELETE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
