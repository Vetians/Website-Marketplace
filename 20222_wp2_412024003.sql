-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 12, 2026 at 03:31 PM
-- Server version: 8.4.3
-- PHP Version: 8.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `20222_wp2_412024003`
--

-- --------------------------------------------------------

--
-- Table structure for table `berita`
--

CREATE TABLE `berita` (
  `id` int NOT NULL,
  `judul` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `konten` text NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `status` enum('publish','draft') DEFAULT 'publish',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `berita`
--

INSERT INTO `berita` (`id`, `judul`, `slug`, `konten`, `gambar`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Aksi Unjuk Rasa Mahasiswa BEM UI', 'aksi-unjuk-rasa-mahasiswa-bem-ui', 'Aksi demo mahasiswa yang dinisiasi oleh BEM UI akan dilaksanakan pada Jumat, 12 Juni 2026 dengan 5 Tuntutan didalamnya', '1781194598_bfe27d15b8b9956bc78b.jpg', 'publish', '2026-06-11 16:16:38', '2026-06-11 16:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `galeri`
--

CREATE TABLE `galeri` (
  `id` int NOT NULL,
  `judul` varchar(150) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `galeri`
--

INSERT INTO `galeri` (`id`, `judul`, `gambar`, `deskripsi`, `created_at`) VALUES
(3, 'Bazaar Kampus', '1781194789_2d60961088a17ddac26d.jpeg', 'Bazaar Kampus yang diadakan pada tanggal 10 Juni 2026', '2026-06-11 16:19:49');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `deskripsi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `nama`, `slug`, `deskripsi`) VALUES
(1, 'Buku Cetak', 'buku-cetak', 'Buku referensi kuliah, novel, komik'),
(2, 'Elektronik', 'elektronik', 'Laptop, HP, Kalkulator Scientific'),
(3, 'Pakaian', 'pakaian', 'Kemeja, Kaos, Jaket preloved layak pakai'),
(4, 'Aksesoris', 'aksesoris', 'Tas, Sepatu, Topi'),
(6, 'Furniture', 'furniture', 'Furnitur Rumah Tangga');

-- --------------------------------------------------------

--
-- Table structure for table `pesan`
--

CREATE TABLE `pesan` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `subjek` varchar(150) NOT NULL,
  `pesan` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pesan`
--

INSERT INTO `pesan` (`id`, `nama`, `email`, `subjek`, `pesan`, `created_at`) VALUES
(2, 'CHRISTIAN MELHAN 412024003', 'christian.412024003@civitas.ukrida.ac.id', 'hehaheahhahahaha', 'hahadkfakosd', '2026-06-08 01:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `id` int NOT NULL,
  `kategori_id` int NOT NULL,
  `user_id` int NOT NULL,
  `nama` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` int NOT NULL,
  `kondisi` enum('baru','bekas') NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stok` int NOT NULL DEFAULT '1',
  `status` enum('aktif','nonaktif') DEFAULT 'aktif',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`id`, `kategori_id`, `user_id`, `nama`, `slug`, `deskripsi`, `harga`, `kondisi`, `gambar`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 2, 'Buku Tulis', 'buku-tulis', 'Buku tulis kosong yang sudah tidak terpakai masih baru', 10000, 'baru', '1781190662_77e43f03199b37ab7f75.jpg', 10, 'aktif', '2026-06-11 15:08:21', '2026-06-11 15:11:02'),
(5, 2, 2, 'Magnetic Powerbank', 'magnetic-powerbank', 'Magnetic Powerbank 10.000 mAh', 200000, 'bekas', '1781190796_ccdf8f82f56c5d24a47e.jpg', 1, 'aktif', '2026-06-11 15:13:16', '2026-06-11 15:13:16'),
(6, 3, 2, 'Hoodie', 'hoodie', 'Hoodie masih bagus 95%', 300000, 'bekas', '1781190851_140c30768dc5fde59901.jpg', 1, 'aktif', '2026-06-11 15:14:11', '2026-06-11 15:14:11'),
(7, 4, 2, 'Jam Tangan', 'jam-tangan', 'Jam tangan masih hidup kondisi bagus', 150000, 'bekas', '1781190902_4fa1b17fbed7b2c4ecbb.jpg', 1, 'aktif', '2026-06-11 15:15:02', '2026-06-11 15:15:02'),
(8, 6, 2, 'Beanbag', 'beanbag', 'Beanbag kondisi bagus bekas pemakaian 3 bulan', 130000, 'bekas', '1781190949_53266b37a8d450cfff4c.jpg', 1, 'aktif', '2026-06-11 15:15:49', '2026-06-11 15:15:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin@ukrida.ac.id', '$2y$10$w8uDk2fX7FvY0Vp3F7B0M.w2I3W7M8lDq1L9Z3X4E7J7V9D4L2bK.', 'admin', '2026-06-06 01:03:42'),
(2, 'Vet', 'vetian@gmail.com', '$2y$10$MXaevV9d1IeK5dfzuYDDreuAZ7wTSfX2yPjmGlohR5f.9KUn9IriG', 'admin', '2026-06-05 18:49:17'),
(3, 'Chris', 'christian.412024003@civitas.ukrida.ac.id', '$2y$10$awCfwkU3AYPYEcpndS2ZNeqUWMqf5yZ4kkGUL/wbiBKc8l/CSAUli', 'admin', '2026-06-08 01:46:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `berita`
--
ALTER TABLE `berita`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `galeri`
--
ALTER TABLE `galeri`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesan`
--
ALTER TABLE `pesan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kategori_id` (`kategori_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `berita`
--
ALTER TABLE `berita`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `galeri`
--
ALTER TABLE `galeri`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pesan`
--
ALTER TABLE `pesan`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `produk`
--
ALTER TABLE `produk`
  ADD CONSTRAINT `fk_produk_kategori` FOREIGN KEY (`kategori_id`) REFERENCES `kategori` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
