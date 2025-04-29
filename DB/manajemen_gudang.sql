-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 29, 2025 at 03:16 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `manajemen_gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `produk_barang`
--

CREATE TABLE `produk_barang` (
  `id_produk` int(11) NOT NULL,
  `kode_produk` varchar(50) NOT NULL,
  `nama_produk` varchar(100) NOT NULL,
  `deskripsi` text DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `merek` varchar(50) DEFAULT NULL,
  `jumlah_stok` int(11) DEFAULT 0,
  `satuan` varchar(20) DEFAULT NULL,
  `lokasi_gudang` varchar(50) DEFAULT NULL,
  `harga_beli` decimal(12,2) DEFAULT NULL,
  `harga_jual` decimal(12,2) DEFAULT NULL,
  `tanggal_masuk` date DEFAULT NULL,
  `tanggal_kedaluwarsa` date DEFAULT NULL,
  `status_produk` enum('Aktif','Habis','Kadaluarsa') DEFAULT 'Aktif',
  `foto_produk` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `produk_barang`
--

INSERT INTO `produk_barang` (`id_produk`, `kode_produk`, `nama_produk`, `deskripsi`, `kategori`, `merek`, `jumlah_stok`, `satuan`, `lokasi_gudang`, `harga_beli`, `harga_jual`, `tanggal_masuk`, `tanggal_kedaluwarsa`, `status_produk`, `foto_produk`) VALUES
(1, 'PRD001', 'Sabun Cair 1L', 'Sabun cair aroma lemon untuk mandi', 'Kebutuhan Rumah Tangga', 'Lifebuoy', 120, 'botol', 'Rak A1', 12000.00, 15000.00, '2025-04-01', '2026-04-01', 'Aktif', '/img/produk/sabun1.jpg'),
(2, 'PRD002', 'Beras Premium 5Kg', 'Beras pulen dan harum', 'Sembako', 'Cap Raja', 80, 'karung', 'Rak B3', 65000.00, 70000.00, '2025-04-02', NULL, 'Aktif', '/img/produk/beras5kg.jpg'),
(3, 'PRD003', 'Minyak Goreng 2L', 'Minyak goreng kelapa sawit murni', 'Sembako', 'Tropical', 200, 'botol', 'Rak C1', 28000.00, 32000.00, '2025-04-03', '2026-01-01', 'Aktif', '/img/produk/minyak.jpg'),
(4, 'PRD004', 'Gula Pasir 1Kg', 'Gula pasir putih bersih', 'Sembako', 'Gulaku', 150, 'kg', 'Rak B1', 11000.00, 13000.00, '2025-04-04', NULL, 'Aktif', '/img/produk/gula.jpg'),
(5, 'PRD005', 'Kopi Instan 100gr', 'Kopi instan hitam tanpa gula', 'Minuman', 'Nescafe', 95, 'bungkus', 'Rak D2', 7500.00, 9500.00, '2025-04-05', '2026-03-01', 'Aktif', '/img/produk/kopi.jpg'),
(6, 'PRD006', 'Teh Celup 25pcs', 'Teh celup isi 25 kantong', 'Minuman', 'Sariwangi', 100, 'kotak', 'Rak D3', 9500.00, 12000.00, '2025-04-06', '2026-02-15', 'Aktif', '/img/produk/teh.jpg'),
(7, 'PRD007', 'Pasta Gigi 150gr', 'Pasta gigi anti bakteri', 'Kebutuhan Pribadi', 'Pepsodent', 70, 'tube', 'Rak A2', 9000.00, 11000.00, '2025-04-07', '2026-05-01', 'Aktif', '/img/produk/pasta.jpg'),
(8, 'PRD008', 'Susu Bubuk 400gr', 'Susu bubuk tinggi kalsium', 'Minuman', 'Dancow', 60, 'bungkus', 'Rak D1', 32000.00, 36000.00, '2025-04-08', '2026-02-28', 'Aktif', '/img/produk/susu.jpg'),
(9, 'PRD009', 'Detergen Bubuk 800gr', 'Detergen wangi untuk mesin cuci', 'Kebutuhan Rumah Tangga', 'Rinso', 130, 'pak', 'Rak A3', 17000.00, 20000.00, '2025-04-09', '2026-01-15', 'Aktif', '/img/produk/detergen.jpg'),
(10, 'PRD010', 'Tissue Gulung 2 Ply', 'Tissue toilet lembut dan tebal', 'Kebutuhan Rumah Tangga', 'Nice', 300, 'roll', 'Rak E1', 4500.00, 5500.00, '2025-04-10', NULL, 'Aktif', '/img/produk/tissue.jpg'),
(11, 'PRD223', 'dawfawf', 'saafaawd', 'Sembako', 'safaf', 100, 'botol', 'A', 342525.00, 243242.00, '2025-04-15', '2028-06-29', 'Aktif', 'Screenshot (13).png'),
(12, 'PRD111', 'afada', 'sdasdasd', 'Kebutuhan Pribadi', 'daada', 231, 'roll', 'C', 2324121.00, 323123.00, '2025-04-10', '2025-10-29', 'Aktif', 'Screenshot (23).png'),
(13, 'PRD0231', 'sadafadwe', 'dgfjdnsnsfaw adadawcgwetreger', 'Kebutuhan Rumah Tangga', 'Lenovo', 120, 'tube', 'A', 532532432.00, 9999999999.99, '2025-04-28', '2025-08-22', 'Aktif', 'Screenshot (47).png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_hp` varchar(20) DEFAULT NULL,
  `role` enum('Admin','Staf','Manajer') NOT NULL DEFAULT 'Staf',
  `status` enum('Aktif','Nonaktif') DEFAULT 'Aktif',
  `foto_profil` varchar(255) DEFAULT NULL,
  `tanggal_dibuat` datetime DEFAULT current_timestamp(),
  `terakhir_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `nama_lengkap`, `username`, `password`, `email`, `no_hp`, `role`, `status`, `foto_profil`, `tanggal_dibuat`, `terakhir_login`) VALUES
(1, 'Sari Oktaviani', 'sari.okt', 'hashed_password_123', 'sari.oktaviani@email.com', '081234567890', 'Admin', 'Aktif', '/img/user/sari.jpg', '2025-04-01 08:30:00', '2025-04-20 14:05:00'),
(2, 'Dedi Firmansyah', 'dedi123', 'hashed_password_456', 'dedi.firmansyah@email.com', '082112233445', 'Staf', 'Aktif', '/img/user/dedi.jpg', '2025-04-02 09:00:00', '2025-04-21 16:45:00'),
(3, 'Arif Wijaya', 'arifw', 'hashed_password_789', 'arif.wijaya@email.com', '081398877665', 'Manajer', 'Nonaktif', '/img/user/arif.jpg', '2025-04-03 10:15:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `produk_barang`
--
ALTER TABLE `produk_barang`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `kode_produk` (`kode_produk`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `produk_barang`
--
ALTER TABLE `produk_barang`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
