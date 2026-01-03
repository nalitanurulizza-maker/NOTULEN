-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 03, 2026 at 12:54 PM
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
-- Database: `notulen`
--

-- --------------------------------------------------------

--
-- Table structure for table `aktivitas`
--

CREATE TABLE `aktivitas` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `kegiatan` varchar(255) NOT NULL,
  `tanggal` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `aktivitas`
--

INSERT INTO `aktivitas` (`id`, `user_id`, `kegiatan`, `tanggal`) VALUES
(1, 1, 'Menambahkan notulen', '2025-12-21 10:26:25'),
(2, 18, 'Menambahkan notulen', '2025-12-21 20:32:18'),
(3, 18, 'Menambahkan notulen', '2025-12-21 20:49:41'),
(4, 18, 'Menambahkan notulen', '2025-12-22 21:20:45'),
(5, 18, 'Menambahkan notulen', '2025-12-25 00:56:13'),
(6, 18, 'Menambahkan notulen', '2025-12-25 01:02:09'),
(7, 21, 'Menambahkan notulen', '2025-12-25 01:24:52'),
(8, 18, 'Menambahkan notulen', '2025-12-27 20:15:41'),
(9, 18, 'Menambahkan notulen', '2026-01-02 23:10:56');

-- --------------------------------------------------------

--
-- Table structure for table `daftar_peserta`
--

CREATE TABLE `daftar_peserta` (
  `id` int NOT NULL,
  `nama` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `daftar_peserta`
--

INSERT INTO `daftar_peserta` (`id`, `nama`, `email`) VALUES
(28, 'andi lumban gaol', 'andilumbangaol@gmail.com'),
(29, 'dodi', 'Dody@students.polibatam.com'),
(30, 'mita', 'mita@gmail.com'),
(32, 'Aliya putri ramadhani', 'aliya@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `notulen_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`id`, `user_id`, `notulen_id`, `created_at`) VALUES
(4, 17, 2, '2025-12-21 11:49:08'),
(5, 17, 17, '2025-12-24 18:11:06');

-- --------------------------------------------------------

--
-- Table structure for table `isi_notulen`
--

CREATE TABLE `isi_notulen` (
  `id` int NOT NULL,
  `judul` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'judul notulen',
  `tanggal` date DEFAULT NULL COMMENT 'tanggal notulen dibuat',
  `waktu` time NOT NULL,
  `isi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci COMMENT 'isi notulen lengkap',
  `lampiran` varchar(255) NOT NULL,
  `status` enum('draft','aktif','diarsipkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL COMMENT 'simpan status notulen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `isi_notulen`
--

INSERT INTO `isi_notulen` (`id`, `judul`, `tanggal`, `waktu`, `isi`, `lampiran`, `status`) VALUES
(8, 'pemilihan presiden informatika', '2025-09-12', '10:30:00', 'hoho', '', 'aktif'),
(16, 'rapat gogo', '2025-12-25', '00:59:00', 'point penting', '1766598973_Nama anggota.docx', 'diarsipkan'),
(19, 'rapat gogo', '2025-12-27', '20:19:00', 'apa aja dahh', '1766841341_Prak13_Ownership and Permissions.pdf', 'aktif'),
(20, 'rapat organisasi', '2026-01-02', '08:09:00', 'rapat yang dilaksanakan di gedung ', '1767370256_tugas studi kasus mtk.pdf', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `notulen_peserta`
--

CREATE TABLE `notulen_peserta` (
  `id` int NOT NULL,
  `notulen_id` int NOT NULL,
  `peserta_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `notulen_peserta`
--

INSERT INTO `notulen_peserta` (`id`, `notulen_id`, `peserta_id`) VALUES
(1, 14, 17);

-- --------------------------------------------------------

--
-- Table structure for table `pengaturan`
--

CREATE TABLE `pengaturan` (
  `id` int NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengaturan`
--

INSERT INTO `pengaturan` (`id`, `email_admin`, `password_admin`) VALUES
(1, 'admin@gmail.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `no_hp`, `password`, `role`) VALUES
(2, 'peserta', 'nama@email.com', '08214131516', '123456', 'peserta'),
(17, 'mita', 'mita@gmail.com', '08123456', '$2y$10$ESinwO/4q/ZNmMO6iIfjJuO3LO.mB.hoJ2FicYFTK1QJt97yMsNxm', 'peserta'),
(18, 'Nalita', 'nalita@gmail.com', '085212345', '$2y$10$wcVuSLmEImpCoYm/HDoJMu9eFZ8rDSr9HlAO9pM82kQJdxixsXZvG', 'admin'),
(19, 'nalitanrl', 'nalita@gmail.com', '08123456', '$2y$10$Az10rZH3j7eCO2wEYlQbC.Hy7emsmZBnhX/Z/UZK75swnkYjIrTe2', 'peserta'),
(20, 'andi', 'andilumbangaol@gmail.com', '08123456', '$2y$10$3Yd9mw3BNlHTzfMn9vWQd.SUZdGbWB89WtrJfWGKy.IrKuSgbPd/W', 'peserta'),
(21, 'andi lumban', 'andilumbangaol@gmail.com', '08123456', '$2y$10$QvR7DeuKd.CecziV0C0I2eiWzjAXLRDqXY51IZezijiiKeOQ.7wGK', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aktivitas`
--
ALTER TABLE `aktivitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daftar_peserta`
--
ALTER TABLE `daftar_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `isi_notulen`
--
ALTER TABLE `isi_notulen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notulen_peserta`
--
ALTER TABLE `notulen_peserta`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pengaturan`
--
ALTER TABLE `pengaturan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aktivitas`
--
ALTER TABLE `aktivitas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `daftar_peserta`
--
ALTER TABLE `daftar_peserta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `favorite`
--
ALTER TABLE `favorite`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `isi_notulen`
--
ALTER TABLE `isi_notulen`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `notulen_peserta`
--
ALTER TABLE `notulen_peserta`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pengaturan`
--
ALTER TABLE `pengaturan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
