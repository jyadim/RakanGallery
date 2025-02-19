-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 19, 2025 at 05:35 PM
-- Server version: 8.0.30
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rakan_gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE `albums` (
  `id` bigint UNSIGNED NOT NULL,
  `album_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `album_name`, `desc`, `upload_date`, `created_at`, `updated_at`, `user_id`, `slug`) VALUES
(3, 'meme lucu bngt lurd', 'lucu bngt lurrr', '2025-01-30', '2025-01-29 20:32:17', '2025-02-04 23:36:03', 2, 'meme-lucu-bngt-lurd'),
(4, 'asoy geboy', 'aselole', '2025-02-05', '2025-02-04 17:57:47', '2025-02-04 17:57:47', 4, 'asoy-geboy'),
(5, 'Pacar Aku', '>///<', '2025-02-05', '2025-02-04 19:06:34', '2025-02-04 19:06:34', 2, 'pacar-aku');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` bigint UNSIGNED NOT NULL,
  `comments` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `upload_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `parent_id` bigint UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comments`, `upload_date`, `created_at`, `updated_at`, `photo_id`, `user_id`, `parent_id`) VALUES
(6, 'omaigat??!!mas garit??!!', '2025-01-30', '2025-01-29 20:37:38', '2025-01-29 20:37:38', 3, 3, NULL),
(7, 'kuriboh jawa', '2025-01-30', '2025-01-29 20:38:03', '2025-01-29 20:38:03', 3, 2, 6),
(8, '😜😜', '2025-01-30', '2025-01-29 20:38:38', '2025-01-29 20:38:38', 5, 3, NULL),
(10, 'kuriboh jawa', '2025-01-30', '2025-01-29 21:58:02', '2025-01-29 21:58:02', 3, 3, 6),
(11, 'aku mafia shalawat', '2025-02-05', '2025-02-04 18:14:14', '2025-02-04 18:14:14', 13, 2, NULL),
(12, 'mkan-mkan', '2025-02-05', '2025-02-04 23:28:13', '2025-02-04 23:28:13', 10, 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
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
-- Table structure for table `like`
--

CREATE TABLE `like` (
  `id` bigint UNSIGNED NOT NULL,
  `like_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `like`
--

INSERT INTO `like` (`id`, `like_date`, `created_at`, `updated_at`, `photo_id`, `user_id`) VALUES
(1, '2025-02-18', '2025-02-18 08:43:24', '2025-02-18 08:43:24', 13, 2),
(2, '2025-02-18', '2025-02-18 08:43:29', '2025-02-18 08:43:29', 12, 2),
(4, '2025-02-18', '2025-02-18 08:43:43', '2025-02-18 08:43:43', 14, 2),
(6, '2025-02-19', '2025-02-19 10:32:18', '2025-02-19 10:32:18', 3, 2);

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
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_16_010416_2025_01_16_create_photos', 1),
(5, '2025_01_16_010420_2025_01_16_create_albums', 1),
(6, '2025_01_16_010424_2025_01_16_create_comments', 1),
(7, '2025_01_16_010430_2025_01_16_create_like', 1),
(8, '2025_01_16_010441_2025_01_16_add_foreign_like', 1),
(9, '2025_01_16_010446_2025_01_16_add_foreign_photos', 1),
(10, '2025_01_16_010452_2025_01_16_add_foreign_comments', 1),
(11, '2025_01_16_010456_2025_01_16_add_foreign_albums', 1),
(12, '2025_01_16_014742_2025_01_16_add_foreign_id_like', 1),
(13, '2025_01_16_034030_2025_01_16_add_image_path_profile', 1),
(14, '2025_01_16_034938_2025_01_16_status_profile', 1),
(15, '2025_01_16_063654_2025_01_16_add_slug', 1),
(16, '2025_01_18_034631_2025_01_18_add_parent_id_on_comments', 1),
(17, '2025_01_22_020533_2025_01_22_add_verified_users', 1),
(18, '2025_01_23_002702_2025_01_23_add_is_admin', 1),
(19, '2025_01_23_005622_add_email_verified_at_to_users_table', 1),
(20, '2025_01_29_160952_2025_01_29_add_notification', 1),
(21, '2025_02_19_152712_2025_02_19_add_rejected', 2),
(22, '2025_02_19_161105_2025_02_19_add_message_user', 3),
(23, '2025_02_19_161803_2025_02_19_add_message_user', 4),
(24, '2025_02_19_164406_2025_02_19_add_bio_user', 5),
(25, '2025_02_19_164439_2025_02_19_add_status_user', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint UNSIGNED NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `notifiable_type`, `notifiable_id`, `type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(26, 'App\\Models\\User', 2, 'like', '{\"message\":\"MasAmba Liked Your Photo\",\"username\":\"MasAmba\"}', NULL, '2025-02-18 08:42:26', '2025-02-18 08:42:26'),
(27, 'App\\Models\\User', 2, 'like', '{\"message\":\"MasAmba Liked Your Photo\",\"username\":\"MasAmba\"}', NULL, '2025-02-18 08:42:29', '2025-02-18 08:42:29');

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
-- Table structure for table `photos`
--

CREATE TABLE `photos` (
  `id` bigint UNSIGNED NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo_desc` text COLLATE utf8mb4_unicode_ci,
  `upload_date` date NOT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `album_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `photo_name`, `photo_desc`, `upload_date`, `image_path`, `created_at`, `updated_at`, `album_id`, `user_id`, `slug`) VALUES
(3, 'Kuriboh Jawa', 'Pokemon Terkuat', '2025-01-30', 'photos/MK4NU2GZ1jbH0EUeJemtBC7RWr5JTIliziN52zUf.jpg', '2025-01-29 20:32:41', '2025-01-29 20:32:41', 3, 2, 'kuriboh-jawa'),
(4, 'Tidak Menarik', 'Rillkah?', '2025-01-30', 'photos/dRoZ3mIVeBQDVkh9dIftzfbsqooU3Wn6MlUrdV25.jpg', '2025-01-29 20:33:08', '2025-01-29 20:33:08', 3, 2, 'tidak-menarik'),
(5, 'freaky ahh sonic🤪🤪', 'freakyy', '2025-01-30', 'photos/2fWPyruRv0U8C0EX258XbTLRLaJNZCx3x6PmbJfA.jpg', '2025-01-29 20:33:44', '2025-01-29 20:47:37', 3, 2, 'freaky-ahh-sonic'),
(6, 'plankton😩😩', '😩😩', '2025-01-30', 'photos/GnZRAT9JeQJho0a1D77YmoY1YcuWlu698RpXbZDR.jpg', '2025-01-29 20:47:23', '2025-01-29 20:47:23', 3, 2, 'plankton'),
(7, 'Super Gacor', '💵💵🤑🤑', '2025-02-05', 'photos/PFUOpRhvFlvi7Id37Cjkr6AmXmyp6dxkDcIY2CIi.jpg', '2025-02-04 17:46:14', '2025-02-04 17:46:14', 3, 2, 'super-gacor'),
(8, 'ak mw ppat', 'papatt', '2025-02-05', 'photos/J0AKE4WVNimjYtaEKLPWkGbLfBabrtTx7B9hPyOx.jpg', '2025-02-04 17:56:25', '2025-02-04 17:56:25', 3, 2, 'ak-mw-ppat'),
(10, 'Senjata Makan Tuan', 'Kenyang', '2025-02-05', 'photos/MXG6EuoptgFlPsjUEK17jjhTLLYLYZwSaHVmSO8Y.jpg', '2025-02-04 17:59:00', '2025-02-04 17:59:00', 4, 4, 'senjata-makan-tuan'),
(12, 'Menelepon Admin', 'Halo-Halo Admin', '2025-02-05', 'photos/CpCajiKKRcVPI9n0o2pgrDurCejsJOPEXW4btrVI.jpg', '2025-02-04 18:00:24', '2025-02-04 18:00:24', 4, 4, 'menelepon-admin'),
(13, 'aku remaja mesjid', 'masyaallah', '2025-02-05', 'photos/PZ4BlNcfrD5yFUkk3U3q4VG58rgubmgoDU3VSvAz.jpg', '2025-02-04 18:00:51', '2025-02-04 18:00:51', 4, 4, 'aku-remaja-mesjid'),
(14, 'berpikir panjang', 'berpikir', '2025-02-05', 'photos/VZDGTXToz11mOoCm7oFZwkfZvIP0oMRv75brbpnl.jpg', '2025-02-04 18:51:34', '2025-02-04 18:51:34', 4, 4, 'berpikir-panjang'),
(15, 'zero two', 'pacar aku', '2025-02-05', 'photos/AQfHo0M6PWLCtMIWkmg9KHsGVSwCntqzpJTgtsL3.jpg', '2025-02-04 19:06:46', '2025-02-04 19:06:46', 5, 2, 'zero-two'),
(16, 'Singkong', NULL, '2025-02-05', 'photos/mRdT5vUWOKaIaxCJisHt3TWqW0D7El76Bfrbuodz.jpg', '2025-02-04 23:39:46', '2025-02-04 23:39:46', 3, 2, 'singkong'),
(17, 'gomen amanai😂', NULL, '2025-02-05', 'photos/fy00hG6lyaqM8NsFNrB7NI7VawRiWsAkU1w1hIiG.jpg', '2025-02-04 23:40:00', '2025-02-04 23:40:38', 3, 2, 'satrio');

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

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6JuJMdcxfumxXRpGWoxJXE0Kdig5cOl3HZgHB3LL', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiVEE4ZmJMcmtFZ2c5MkM5OG4xcFVUSTFKQWFxS2xpcU1mMnlhZVdpRCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL3Byb2ZpbGUiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1739986444),
('eAgqs4yWYBIQUXGpbCbDxpTsx1qY4B2ypj8rSY3N', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/132.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT2V3ZzhpajZKdm9pZDRVU2VnbFBsaEhUS1pSQ1YwVEh3V3duT2J4RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXNoYm9hcmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1739986422);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `rejected` tinyint(1) NOT NULL DEFAULT '0',
  `message` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `address`, `remember_token`, `created_at`, `updated_at`, `image_path`, `verified`, `is_admin`, `email_verified_at`, `rejected`, `message`, `bio`, `status`) VALUES
(1, 'Admin', 'admin@KennGallery.com', 'AdminMantapWell', '$2y$12$RdKkdwvdB3T3/6SzlUooHeEoeWZwGBJtgs8GkDAOdGlvWwWOu.L1u', 'aa', 'eiZAeChXRGbh0udi6ndtJxYBmgLCKB8EaqenPtYvREQXOXNGtniR6RUIrFLQ', '2025-01-29 18:35:23', '2025-02-19 09:45:56', NULL, 1, 1, '2025-01-29 18:35:23', 0, NULL, NULL, 'verified'),
(2, 'Kenn', 'aselole@gmail.com', 'KennGantengBanget', '$2y$12$1s5d7Lx2.a3Fnq7gUPiO/.E7YsoAxwNox2ZgQyYAbJhkqTD0fTKyC', 'jljl', NULL, '2025-01-29 18:35:42', '2025-02-19 10:34:04', 'profiles/RIIBJsJQndpwAB9rQgW1KHxM8KSa2768eMx0kpN6.jpg', 1, 0, NULL, 0, NULL, 'Certified as Professional Coat Hanger', 'verified'),
(3, 'fdhdhdf', 'tes@gmail.com', 'sdgsdgsdg', '$2y$12$fv69qlgWXaeLEcj5BCMpXOtdsJjA4WKTxmZWmqgpndbbsCAv5QxTe', 'adsvgsdg', NULL, '2025-01-29 18:36:00', '2025-02-19 09:46:01', NULL, 1, 0, NULL, 0, NULL, NULL, 'verified'),
(4, 'Amba', 'asikjos@gmail.com', 'MasAmba', '$2y$12$cKWvzMKRDN4lUdHCJDhPWOAb4yDJpxQhdtYrsUT4enhOFL9aVnWX.', 'jl.in aja dulu', NULL, '2025-01-29 20:21:03', '2025-02-19 09:46:03', 'profiles/1vzReko91dquY30cJRh46Ag1em1jE8AcLi48tLul.jpg', 1, 0, NULL, 0, NULL, NULL, 'verified'),
(8, 'dfafsadfsa', 'test@gmail.com', 'asfsafasf', '$2y$12$d.fUk.DCQ2ZJz7EGIZRwfe7ONgsBH13L2cFDnjThdFkcUyA4wKk.a', 'sfasfsaasfas', NULL, '2025-02-19 09:55:06', '2025-02-19 09:55:15', NULL, 0, 0, NULL, 1, 'Kurang Ganteng', NULL, 'rejected'),
(9, 'sgsdgdad', 'test12@gmail.com', 'safsfaf', '$2y$12$K7F9YrBmdv7OS1D4tJ1RRec7bsl4.dGTMwcWfJMw7Ouxq5NEZ.kZm', 'dgagda', NULL, '2025-02-19 09:58:11', '2025-02-19 09:58:20', NULL, 0, 0, NULL, 1, 'Kurang Ganteng', NULL, 'rejected');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_photo_id_foreign` (`photo_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_photo_id_foreign` (`photo_id`),
  ADD KEY `like_user_id_foreign` (`user_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_album_id_foreign` (`album_id`),
  ADD KEY `photos_user_id_foreign` (`user_id`);

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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `like`
--
ALTER TABLE `like`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
