-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2026 at 07:28 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `branch_referral_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `follow_ups`
--

CREATE TABLE `follow_ups` (
  `id` int NOT NULL,
  `referral_id` varchar(20) NOT NULL,
  `follow_up_date` date NOT NULL,
  `method` varchar(50) NOT NULL,
  `result` varchar(50) NOT NULL,
  `notes` text,
  `next_action` varchar(255) DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `follow_ups`
--

INSERT INTO `follow_ups` (`id`, `referral_id`, `follow_up_date`, `method`, `result`, `notes`, `next_action`, `due_date`, `created_at`) VALUES
(1, 'REF-GM-001', '2026-09-23', 'Telepon', 'Tertarik', 'Nasabah mau coba Livin.', 'Kirim link download', '2026-09-10', '2026-09-23 00:20:52'),
(2, 'REF-GM-002', '2026-09-08', 'Tatap Muka', 'Pengajuan', 'Dokumen lengkap, diajukan ke teller.', 'Aktivasi rekening', '2026-09-15', '2026-09-23 23:17:10'),
(3, 'REF-GM-003', '2026-09-10', 'Email', 'Dokumen', 'Minta slip gaji 3 bulan.', 'Tunggu dokumen', '2026-09-17', '2026-09-24 03:00:52'),
(4, 'REF-GM-004', '2026-09-12', 'Telepon', 'Tidak terhubung', 'Tidak diangkat 2x.', 'Coba lagi', '2026-09-14', '2026-09-24 14:11:17'),
(5, 'REF-GM-004', '2026-09-15', 'Telepon', 'Tidak terhubung', 'Penghasilan di bawah minimum.', '-', '2026-09-16', '2026-09-24 14:11:54'),
(6, 'REF-GM-001', '2026-09-21', 'WhatsApp', 'Tertarik', 'Konfirmasi minat, minta link registrasi.', 'Kirim link registras', '2026-09-23', '2026-09-24 16:22:22'),
(7, 'REF-GM-002', '2026-09-18', 'Telepon', 'Berhasil', 'Rekening aktif, nasabah puas.', 'Aktivasi selesai', '2026-09-20', '2026-09-24 16:24:37'),
(8, 'REF-GM-005', '2026-09-20', 'WhatsApp', 'Tertarik', 'Sudah berhasil dihubungi, mau kunjungan cabang.', 'Jadwalkan kunjungan', '2026-09-24', '2026-09-24 16:27:23'),
(10, 'REF-GM-008', '2026-09-21', 'Sistem', 'Update Action', 'Pembaruan Rencana Action', 'Tanda tangan akad', '2026-09-25', '2026-09-25 02:30:44'),
(11, 'REF-GM-010', '2026-09-26', 'Email', 'Menunggu keputusan', 'Menunggu keputusan oranbg tua', 'Hubungi calon nasabah', '2026-09-29', '2026-09-25 12:36:26'),
(12, 'REF-GM-010', '2026-09-30', 'Telepon', 'Menunggu keputusan', 'Masih menunggu keputusan', 'Hubungi calon nasabah', '2026-10-03', '2026-09-25 12:38:06');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` smallint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referrals`
--

CREATE TABLE `referrals` (
  `id` int NOT NULL,
  `referral_id` varchar(20) NOT NULL,
  `customer_name` varchar(100) NOT NULL,
  `phone_number` varchar(20) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `referral_source` varchar(50) DEFAULT NULL,
  `referrer_name` varchar(100) DEFAULT NULL,
  `status` varchar(30) DEFAULT 'Baru',
  `due_date` date DEFAULT NULL,
  `next_action` varchar(255) DEFAULT NULL,
  `notes` text,
  `unsuccessful_reason` varchar(255) DEFAULT NULL,
  `outcome_notes` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `referrals`
--

INSERT INTO `referrals` (`id`, `referral_id`, `customer_name`, `phone_number`, `product_type`, `referral_source`, `referrer_name`, `status`, `due_date`, `next_action`, `notes`, `unsuccessful_reason`, `outcome_notes`, `created_at`) VALUES
(1, 'REF-GM-001', 'Andi Setiawan', '081234567890', 'Livin\'', 'Nasabah Existing', 'Budi Santoso', 'Tertarik', '2026-09-23', 'Kirim link registras', 'Nasabah tertarik, menunggu info lebih lanjut.', NULL, NULL, '2026-09-23 02:40:45'),
(6, 'REF-GM-002', 'Sari Wahyuni', '08623456724', 'Tabungan', 'Pegawai', 'Siti Rahma', 'Berhasil', '2026-09-20', 'Aktivasi selesai', 'Rekening tabungan berhasil dibuka.', NULL, NULL, '2026-09-23 06:17:04'),
(11, 'REF-GM-003', 'Budi Kurnia', '087800004512', 'KPR', 'Event', 'Dewi Lestari', 'Proses', '2026-09-17', 'Tunggu dokumen', 'Menunggu dokumen income.', NULL, NULL, '2026-09-24 00:00:00'),
(12, 'REF-GM-004', 'Rina Marlina', '081300112200', 'Kartu Kredit', 'Merchant/Partner', 'BINTANG RAMDHAN', 'Tidak Berhasil', '2026-09-16', '-', 'Tidak memenuhi syarat penghasilan.', 'Dokumen tidak lengkap', NULL, '2026-09-07 00:00:00'),
(13, 'REF-GM-005', 'Agus Saputra', '082101019988', 'Tabungan SimPel', 'Sekolah/Universitas', 'ELISABET JUNIITA HIA', 'Sudah Dihubungi', '2026-09-24', 'Jadwalkan kunjungan', 'Siswa kelas 10, tertarik tabungan pelajar.', NULL, NULL, '2026-09-24 00:00:00'),
(14, 'REF-GM-006', 'Hendra Wijaya', '0852-****-1177', 'Livin\'', 'Pegawai', 'ANTASARI SIHOMBING', 'Baru', NULL, NULL, NULL, NULL, NULL, '2026-09-12 00:00:00'),
(15, 'REF-GM-007', 'Maya Kusuma', '081702025543', 'Tabungan', 'Nasabah Existing', 'ELVARETTA SAVANA RAZAQI', 'Baru', '2026-09-22', 'Hubungi calon nasabah', 'Direferensikan dari nasabah lama.', NULL, NULL, '2026-09-13 00:00:00'),
(16, 'REF-GM-008', 'Doni Hartono', '088891916612', 'KPR', 'Event', 'DIANA', 'Berhasil', '2026-09-25', 'Tanda tangan akad', 'Pengajuan KPR 500jt disetujui.', NULL, NULL, '2026-09-14 00:00:00'),
(17, 'REF-GM-009', 'Fitri Rahayu', '081212348844', 'Kartu Kredit', 'Merchant/Partner', 'HALIYYA ZHAHWA ZOHAYNA', 'Tertarik', '2026-09-24', 'Hubungi calon nasabah', 'Tertarik kartu kredit gold.', NULL, NULL, '2026-09-15 00:00:00'),
(18, 'REF-GM-010', 'Rudi Firmansyah', '085745613309', 'Tabungan SimPel', 'Sekolah/Universitas', 'KUMAR JAYA', 'Tertarik', '2026-10-03', 'Hubungi calon nasabah', 'Perlu persetujuan orang tua.', NULL, NULL, '2026-09-16 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `nip`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Pegawai Mandiri', NULL, '$2y$12$UYiq3QvOSqfnRaqeB8UYEe3h2lh9SKWMkHQRJ/khJA8Q5Foe9Doh6', 'JkneQmJRVipDcBena724BQBTpzU903t6hMYrLTY9Aey3J7J1EfOQelqSt7Hw', '2026-09-23 15:55:17', '2026-09-23 15:55:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`),
  ADD KEY `failed_jobs_connection_queue_failed_at_index` (`connection`,`queue`,`failed_at`);

--
-- Indexes for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `referral_id` (`referral_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `referrals`
--
ALTER TABLE `referrals`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `referral_id` (`referral_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_nip_unique` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `follow_ups`
--
ALTER TABLE `follow_ups`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `referrals`
--
ALTER TABLE `referrals`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `follow_ups`
--
ALTER TABLE `follow_ups`
  ADD CONSTRAINT `follow_ups_ibfk_1` FOREIGN KEY (`referral_id`) REFERENCES `referrals` (`referral_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
