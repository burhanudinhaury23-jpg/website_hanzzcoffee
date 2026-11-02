
-- phpMyAdmin SQL Dump
-- Database: hanzz_coffee_db
-- Server: 127.0.0.1
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

SET NAMES utf8mb4;

-- --------------------------------------------------------
-- Database: hanzz_coffee_db
-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS `hanzz_coffee_db`
DEFAULT CHARACTER SET utf8mb4
COLLATE utf8mb4_general_ci;

USE `hanzz_coffee_db`;

-- --------------------------------------------------------
-- Struktur tabel users
-- --------------------------------------------------------

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Struktur tabel produk
-- --------------------------------------------------------

CREATE TABLE `produk` (
  `id` int(11) NOT NULL,
  `nama_produk` varchar(150) NOT NULL,
  `kategori` varchar(50) NOT NULL,
  `harga` int(11) NOT NULL,
  `deskripsi` text NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT '',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------
-- Dumping data tabel produk
-- --------------------------------------------------------

INSERT INTO `produk`
(`id`, `nama_produk`, `kategori`, `harga`, `deskripsi`, `gambar`) VALUES

(1, 'Caffè Latte', 'Kopi', 25000,
'Perpaduan espresso dan susu dengan tekstur lembut.',
'caffe-latte.jpg'),

(2, 'Americano', 'Kopi', 22000,
'Kopi hitam dengan perpaduan espresso dan air.',
'americano.jpg'),

(3, 'Es Kopi Susu', 'Kopi', 20000,
'Kopi susu dingin dengan rasa manis dan menyegarkan.',
'es-kopi-susu.jpg'),

(4, 'Cappuccino', 'Kopi', 28000,
'Perpaduan espresso, susu, dan foam yang lembut.',
'cappuccino.jpg'),

(5, 'Croissant Butter', 'Makanan', 25000,
'Pastry berlapis yang renyah di luar dan lembut di dalam.',
'croissant-butter.jpg'),

(6, 'Pizza Special', 'Makanan', 45000,
'Pizza gurih dengan topping pilihan, cocok dinikmati bersama teman.',
'pizza-special.jpg'),

(7, 'Roti Panggang', 'Makanan', 30000,
'Roti panggang dengan rasa lezat untuk teman ngopi.',
'roti-panggang.jpg'),

(8, 'Chicken Salad', 'Makanan', 35000,
'Hidangan salad segar dengan tambahan daging ayam.',
'chicken-salad.jpg'),

(9, 'Kopi Pilihan Barista', 'Kopi', 30000,
'Kopi pilihan dengan racikan khusus barista.',
'kopi-pilihan-barista.jpg');

-- --------------------------------------------------------
-- Indexes for dumped tables
-- --------------------------------------------------------

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

ALTER TABLE `produk`
  ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------
-- AUTO_INCREMENT
-- --------------------------------------------------------

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `produk`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT=10;

COMMIT;
