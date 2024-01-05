-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2023 at 10:51 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fit_fin_phy`
--

-- --------------------------------------------------------

--
-- Table structure for table `click_counts`
--

CREATE TABLE `click_counts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `phone_book_user_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `click_counts`
--

INSERT INTO `click_counts` (`id`, `phone_book_user_id`, `type`, `created_at`, `updated_at`) VALUES
(1, 2, 'expense', '2023-08-07 19:55:09', '2023-08-07 19:55:09'),
(2, 2, 'expense', '2023-08-07 19:55:50', '2023-08-07 19:55:50'),
(3, 2, 'income', '2023-08-07 20:05:21', '2023-08-07 20:05:21'),
(4, 2, 'bank', '2023-08-07 20:05:29', '2023-08-07 20:05:29'),
(5, 2, 'goal', '2023-08-07 20:05:32', '2023-08-07 20:05:32'),
(6, 2, 'budget', '2023-08-07 20:05:36', '2023-08-07 20:05:36'),
(7, 2, 'reports', '2023-08-07 20:05:39', '2023-08-07 20:05:39'),
(8, 2, 'water-remainder', '2023-08-07 20:05:42', '2023-08-07 20:05:42'),
(9, 2, 'sleep-remainder', '2023-08-07 20:05:44', '2023-08-07 20:05:44'),
(10, 2, 'expense', '2023-07-31 19:55:50', '2023-08-07 19:55:50'),
(11, 2, 'expense', '2023-08-01 19:55:50', '2023-08-07 19:55:50'),
(12, 2, 'expense', '2023-08-02 19:55:50', '2023-08-07 19:55:50'),
(13, 2, 'expense', '2023-08-02 19:55:50', '2023-08-07 19:55:50'),
(14, 2, 'expense', '2023-08-02 19:55:50', '2023-08-07 19:55:50'),
(15, 2, 'expense', '2023-08-03 19:55:50', '2023-08-07 19:55:50'),
(16, 2, 'expense', '2023-08-04 19:55:50', '2023-08-07 19:55:50'),
(17, 2, 'expense', '2023-08-05 19:55:50', '2023-08-07 19:55:50'),
(18, 2, 'expense', '2023-08-06 19:55:50', '2023-08-07 19:55:50'),
(19, 2, 'expense', '2023-08-07 19:55:50', '2023-08-07 19:55:50'),
(20, 2, 'expense', '2023-08-08 19:55:50', '2023-08-07 19:55:50'),
(21, 2, 'expense', '2023-08-08 19:55:50', '2023-08-07 19:55:50'),
(22, 2, 'expense', '2023-08-08 19:55:50', '2023-08-07 19:55:50'),
(23, 2, 'expense', '2023-08-09 19:55:50', '2023-08-07 19:55:50');

-- --------------------------------------------------------

--
-- Table structure for table `configs`
--

CREATE TABLE `configs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(255) NOT NULL,
  `data` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configs`
--

INSERT INTO `configs` (`id`, `key`, `data`, `created_at`, `updated_at`) VALUES
(2, 'advertisement', 'google', '2023-08-10 22:01:53', '2023-08-10 22:10:04'),
(3, 'paid-features', '{\"expense\":0,\"income\":0,\"bank\":0,\"goal\":0,\"budget\":0,\"reports\":0,\"water-remainder\":0,\"sleep-remainder\":0,\"medicine-reminder\":0,\"heart-rate-monitor\":0,\"task-manager\":0,\"habit-manager\":1,\"step-counter\":0,\"calorie-and-distance\":0}', '2023-08-10 22:06:50', '2023-08-10 22:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_06_03_154541_create_phone_book_users_table', 1),
(6, '2023_08_08_011206_create_click_counts_table', 2),
(7, '2023_08_11_005615_create_configs_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `phone_book_users`
--

CREATE TABLE `phone_book_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `profile_url` varchar(255) DEFAULT NULL,
  `social_id` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` date DEFAULT NULL,
  `expires_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `phone_book_users`
--

INSERT INTO `phone_book_users` (`id`, `name`, `email`, `phone`, `profile_url`, `social_id`, `fcm_token`, `is_active`, `api_token`, `created_at`, `updated_at`, `last_login_at`, `expires_at`) VALUES
(2, 'Kevin Patel', 'kp@mailinator.com', '8080800800', 'https://randomuser.me/api/portraits/women/59.jpg', '7FCDZUifwQNcgTQ3Qujh', 'd74ET4xCS5yflPJFu9OzlT:APA91bHkZHZBtfFZqdMpNMRdTBFpepkSDve3h6eluHegMri4OwK2mTgxdIMOh_n2krNwC7s8HORwuCMzFb0l1gMUTxr03i4dEcjKvDcouktAA-dxMb7gNcHJIabgYv9nhni8d0qKsbP0', 1, '2uDDinY1691697500n0wCc81e728d9d4c2f636f067f89cc14862c22b7f155df0bfef8824fe152ae97d2f1OIxx668lDqDnTH079000700169169750031b5a8516b752dd19df55c3d730ccea0', '2023-08-07 19:29:22', '2023-08-10 19:58:20', NULL, NULL),
(4, 'krutik', 'krutikundhad@gmail.com', '9032010780', 'https://randomuser.me/api/portraits/women/59.jpg', '7FCDZUifwQNcgTQ3Qujh', NULL, 1, '4R07MLQ1696329498myZoa87ff679a2f3e71d9181a67b7542122c6ec5174070967d37b1d58ce3da158a1bnvNWv8FXv6rFp6074345900169632949873a4e8963eefdea147fcfabd23701bba', '2023-10-03 07:20:39', '2023-10-03 12:26:04', '2023-10-03', '2023-11-02'),
(5, 'darshan', 'darshan@gmail.com', '9032010780', 'https://randomuser.me/api/portraits/women/59.jpg', '7FCDZUifwQNcgTQ3Qujh', NULL, 1, 'nPMVED16963324086QaFd41d8cd98f00b204e9800998ecf8427e943d56c4dd3a0fd2da59a09de147f902j3GAXpsRSvR9LE04240190016963324087b92dfdbd93e8de581a469d4050097b0', '2023-10-03 11:26:48', '2023-10-03 11:26:48', '2023-10-01', '2023-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(4) NOT NULL DEFAULT 0,
  `is_active` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `last_login_at` date DEFAULT NULL,
  `expires_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `image`, `is_admin`, `is_active`, `remember_token`, `password`, `email_verified_at`, `api_token`, `created_at`, `updated_at`, `last_login_at`, `expires_at`) VALUES
(1, 'Hello', 'hello@gmail.com', NULL, NULL, 1, 1, NULL, '$2y$10$QfuoAThkn/8Jhy68k1DGmOM2zAaDR6LEjanKnaf.GbgnzZyOegVE6', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Black', 'black@gmail.com', NULL, NULL, 1, 1, NULL, '$2y$10$iBG..QniiRwigZRkXTQ0.Oqr3wfbkbUffF2CaWI2b5JgbKZxfgk2O', NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `click_counts`
--
ALTER TABLE `click_counts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `click_counts_phone_book_user_id_foreign` (`phone_book_user_id`);

--
-- Indexes for table `configs`
--
ALTER TABLE `configs`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `phone_book_users`
--
ALTER TABLE `phone_book_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone_book_users_api_token_unique` (`api_token`);

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
-- AUTO_INCREMENT for table `click_counts`
--
ALTER TABLE `click_counts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `configs`
--
ALTER TABLE `configs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `phone_book_users`
--
ALTER TABLE `phone_book_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `click_counts`
--
ALTER TABLE `click_counts`
  ADD CONSTRAINT `click_counts_phone_book_user_id_foreign` FOREIGN KEY (`phone_book_user_id`) REFERENCES `phone_book_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
