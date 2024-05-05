-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2024 at 11:46 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_barang` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id`, `nama_barang`, `keterangan`, `harga_jual`, `id_pengguna`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Erigo Tsirt', 'baju nyaman dipakai', 100000, 1, '2024-05-05 14:17:10', '2024-05-05 00:50:33', '2024-05-05 14:17:10'),
(2, 'Baju 2', 'baju ori', 100000, 1, '2024-05-05 01:05:33', '2024-05-05 00:51:26', '2024-05-05 01:05:33'),
(3, 'Baju 3', 'baju ori', 100000, 1, '2024-05-05 01:05:30', '2024-05-05 00:52:45', '2024-05-05 01:05:30'),
(4, 'Baju Edit', 'baru', 90000, 1, NULL, '2024-05-05 14:14:28', '2024-05-05 14:15:58'),
(5, 'Baju 2', 'baru', 100000, 1, NULL, '2024-05-05 14:23:21', '2024-05-05 14:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(9, '2024_05_05_032252_create_barang_table', 2),
(10, '2024_05_05_034249_create_pembelian_table', 2),
(11, '2024_05_05_034439_create_penjualan_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('alwanhafidzin@gmail.com', '$2y$12$FyU1eQKtd0OsoBZRaMfDCOlhjBpxUBR..tkRwMMYiO6goJsd3EwQi', '2024-05-04 18:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_pembelian` int(11) NOT NULL,
  `harga_beli` int(11) NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id`, `jumlah_pembelian`, `harga_beli`, `id_barang`, `id_pengguna`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 10, 90000, 1, 1, '2024-05-05 21:28:16', '2024-05-05 10:00:54', '2024-05-05 10:00:54'),
(2, 10, 90000, 5, 1, NULL, '2024-05-05 14:24:19', '2024-05-05 14:24:19');

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jumlah_penjualan` int(11) NOT NULL,
  `harga_jual` int(11) NOT NULL,
  `id_barang` bigint(20) UNSIGNED NOT NULL,
  `id_pengguna` bigint(20) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`id`, `jumlah_penjualan`, `harga_jual`, `id_barang`, `id_pengguna`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 100000, 1, 1, '2024-05-05 21:28:55', '2024-05-05 10:57:53', '2024-05-05 10:57:53'),
(2, 2, 100000, 5, 1, NULL, '2024-05-05 14:29:39', '2024-05-05 14:29:39'),
(3, 5, 100000, 5, 1, NULL, '2024-05-05 14:31:42', '2024-05-05 14:31:42');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@gmail.com', NULL, '$2y$12$cnc7L4DIDvCkKU2hcpo4dOzmsJmgqAKQ7s49ES0MOTSDkB/Z8Cdx.', NULL, '2024-05-04 17:49:06', '2024-05-04 17:49:06'),
(2, 'Alwan Hafidzin Firdaus', 'alwanhafidzin@gmail.com', NULL, '$2y$12$s9Ox00lB.LWb.f1HUjYGMuKxVFkkFORnDHmoaE1OIJgCb25KK/irW', NULL, '2024-05-04 18:11:10', '2024-05-04 18:11:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id`),
  ADD KEY `barang_id_pengguna_foreign` (`id_pengguna`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pembelian_id_barang_foreign` (`id_barang`),
  ADD KEY `pembelian_id_pengguna_foreign` (`id_pengguna`);

--
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penjualan_id_barang_foreign` (`id_barang`),
  ADD KEY `penjualan_id_pengguna_foreign` (`id_pengguna`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `pembelian_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_id_barang_foreign` FOREIGN KEY (`id_barang`) REFERENCES `barang` (`id`),
  ADD CONSTRAINT `penjualan_id_pengguna_foreign` FOREIGN KEY (`id_pengguna`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
