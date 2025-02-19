-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Feb 2025 pada 09.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `albums`
--

CREATE TABLE `albums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `album_name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `upload_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `albums`
--

INSERT INTO `albums` (`id`, `album_name`, `desc`, `upload_date`, `created_at`, `updated_at`, `user_id`, `slug`) VALUES
(3, 'meme lucu bngt lurd', 'lucu bngt lurrr', '2025-01-30', '2025-01-29 20:32:17', '2025-02-04 23:36:03', 2, 'meme-lucu-bngt-lurd'),
(4, 'asoy geboy', 'aselole', '2025-02-05', '2025-02-04 17:57:47', '2025-02-04 17:57:47', 4, 'asoy-geboy'),
(5, 'Pacar Aku', '>///<', '2025-02-05', '2025-02-04 19:06:34', '2025-02-04 19:06:34', 2, 'pacar-aku');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `comments` text NOT NULL,
  `upload_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `comments`
--

INSERT INTO `comments` (`id`, `comments`, `upload_date`, `created_at`, `updated_at`, `photo_id`, `user_id`, `parent_id`) VALUES
(6, 'omaigat??!!mas garit??!!', '2025-01-30', '2025-01-29 20:37:38', '2025-01-29 20:37:38', 3, 3, NULL),
(7, 'kuriboh jawa', '2025-01-30', '2025-01-29 20:38:03', '2025-01-29 20:38:03', 3, 2, 6),
(8, '😜😜', '2025-01-30', '2025-01-29 20:38:38', '2025-01-29 20:38:38', 5, 3, NULL),
(10, 'kuriboh jawa', '2025-01-30', '2025-01-29 21:58:02', '2025-01-29 21:58:02', 3, 3, 6),
(11, 'aku mafia shalawat', '2025-02-05', '2025-02-04 18:14:14', '2025-02-04 18:14:14', 13, 2, NULL),
(12, 'mkan-mkan', '2025-02-05', '2025-02-04 23:28:13', '2025-02-04 23:28:13', 10, 2, NULL),
(13, 'pacarku ini men', '2025-02-19', '2025-02-18 21:19:21', '2025-02-18 21:19:21', 20, 4, NULL),
(14, 'test', '2025-02-19', '2025-02-18 21:41:23', '2025-02-18 21:41:23', 3, 2, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `like`
--

CREATE TABLE `like` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `like_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `photo_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `like`
--

INSERT INTO `like` (`id`, `like_date`, `created_at`, `updated_at`, `photo_id`, `user_id`) VALUES
(6, '2025-01-30', '2025-01-29 20:37:18', '2025-01-29 20:37:18', 3, 3),
(7, '2025-01-30', '2025-01-29 20:37:20', '2025-01-29 20:37:20', 4, 3),
(8, '2025-01-30', '2025-01-29 20:37:22', '2025-01-29 20:37:22', 5, 3),
(9, '2025-01-30', '2025-01-29 21:00:00', '2025-01-29 21:00:00', 3, 2),
(10, '2025-01-30', '2025-01-29 21:58:06', '2025-01-29 21:58:06', 6, 3),
(12, '2025-02-05', '2025-02-04 17:40:29', '2025-02-04 17:40:29', 5, 2),
(13, '2025-02-05', '2025-02-04 17:40:31', '2025-02-04 17:40:31', 6, 2),
(14, '2025-02-05', '2025-02-04 18:01:37', '2025-02-04 18:01:37', 7, 4),
(15, '2025-02-05', '2025-02-04 18:13:10', '2025-02-04 18:13:10', 3, 4),
(16, '2025-02-05', '2025-02-04 18:13:12', '2025-02-04 18:13:12', 4, 4),
(17, '2025-02-05', '2025-02-04 18:13:14', '2025-02-04 18:13:14', 5, 4),
(18, '2025-02-05', '2025-02-04 18:13:15', '2025-02-04 18:13:15', 6, 4),
(19, '2025-02-05', '2025-02-04 18:13:56', '2025-02-04 18:13:56', 12, 2),
(20, '2025-02-05', '2025-02-04 18:14:25', '2025-02-04 18:14:25', 10, 2),
(22, '2025-02-05', '2025-02-04 23:08:42', '2025-02-04 23:08:42', 8, 4),
(24, '2025-02-05', '2025-02-04 23:08:49', '2025-02-04 23:08:49', 12, 4),
(25, '2025-02-05', '2025-02-04 23:08:53', '2025-02-04 23:08:53', 15, 4),
(26, '2025-02-05', '2025-02-04 23:29:16', '2025-02-04 23:29:16', 10, 4),
(28, '2025-02-19', '2025-02-18 20:51:17', '2025-02-18 20:51:17', 17, 2),
(29, '2025-02-19', '2025-02-18 21:19:06', '2025-02-18 21:19:06', 21, 4),
(30, '2025-02-19', '2025-02-18 21:19:08', '2025-02-18 21:19:08', 20, 4),
(31, '2025-02-19', '2025-02-18 21:47:48', '2025-02-18 21:47:48', 16, 2),
(32, '2025-02-19', '2025-02-18 23:38:03', '2025-02-18 23:38:03', 24, 2),
(33, '2025-02-19', '2025-02-19 00:03:55', '2025-02-19 00:03:55', 13, 2),
(36, '2025-02-19', '2025-02-19 00:05:48', '2025-02-19 00:05:48', 14, 2),
(37, '2025-02-19', '2025-02-19 00:06:21', '2025-02-19 00:06:21', 4, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
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
(20, '2025_01_29_160952_2025_01_29_add_notification', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(255) NOT NULL,
  `data` text NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `notifications`
--

INSERT INTO `notifications` (`id`, `notifiable_type`, `notifiable_id`, `type`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
(28, 'App\\Models\\User', 4, 'like', '{\"message\":\"KennGantengBanget Liked Your Photo\",\"username\":\"KennGantengBanget\"}', NULL, '2025-02-19 00:03:55', '2025-02-19 00:03:55'),
(29, 'App\\Models\\User', 4, 'like', '{\"message\":\"KennGantengBanget Liked Your Photo\",\"username\":\"KennGantengBanget\"}', NULL, '2025-02-19 00:05:34', '2025-02-19 00:05:34'),
(30, 'App\\Models\\User', 4, 'like', '{\"message\":\"KennGantengBanget Liked Your Photo\",\"username\":\"KennGantengBanget\"}', NULL, '2025-02-19 00:05:48', '2025-02-19 00:05:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `photos`
--

CREATE TABLE `photos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `photo_name` varchar(255) DEFAULT NULL,
  `photo_desc` text DEFAULT NULL,
  `upload_date` date NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `album_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `photos`
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
(17, 'gomen amanai😂', NULL, '2025-02-05', 'photos/fy00hG6lyaqM8NsFNrB7NI7VawRiWsAkU1w1hIiG.jpg', '2025-02-04 23:40:00', '2025-02-04 23:40:38', 3, 2, 'satrio'),
(20, 'Cantik Bwangett', '💕🌹', '2025-02-19', 'photos/MzzDlLyHqiGASVfMIGIHNbi2tOg9k4dhEoMpeEZp.jpg', '2025-02-18 19:53:14', '2025-02-18 19:53:14', 5, 2, 'cantik-bwangett'),
(21, 'allahuakbarrr', NULL, '2025-02-19', 'photos/klLYW8wwSacnadfxZJ0M7EZ0tsJxbAES8cSgA8Xj.jpg', '2025-02-18 19:55:51', '2025-02-18 19:55:51', 5, 2, 'allahuakbarrr'),
(24, 'pro kontra', NULL, '2025-02-19', 'photos/u8SLyn7kHRxfdBequT1w61UgXhQFi52hl2OjCrWl.jpg', '2025-02-18 21:44:16', '2025-02-18 21:53:58', 3, 2, 'dvadv');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('tFbxPeK6TuVZyF4QPZWigWwT1DNI7TenxwnNOg2u', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiakNzM2dMNlhKaGhxT0h5aDY2V0lkNGJOdDZocldsY1FYWjMwTUpYaiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2xvZ2luIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1739952093),
('XVgw032AlQimWGAxdXBBZN6r9jU8LBzDV9iab0ZV', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoidW9tSDZ1OWVZZ2NLZ3BlNHFJYVltTWt5QUE4ZDJyelJyc2ZRSEJpUyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NTI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC91c2VyL2FsYnVtL21lbWUtbHVjdS1ibmd0LWx1cmQiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjM6InVybCI7YToxOntzOjg6ImludGVuZGVkIjtzOjM2OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvdXNlci9kYXNoYm9hcmQiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToyO30=', 1739954226);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `email_verified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `address`, `remember_token`, `created_at`, `updated_at`, `image_path`, `status`, `verified`, `is_admin`, `email_verified_at`) VALUES
(1, 'Admin', 'admin@KennGallery.com', 'AdminMantapWell', '$2y$12$RdKkdwvdB3T3/6SzlUooHeEoeWZwGBJtgs8GkDAOdGlvWwWOu.L1u', 'aa', 'GK5wNLqTLD08SLmmzJe4G0JYozdW69dycHdrAoKPZV8Wsv62m59UQ6tZ7bhs', '2025-01-29 18:35:23', '2025-01-29 18:35:23', NULL, NULL, 1, 1, '2025-01-29 18:35:23'),
(2, 'Kenn', 'aselole@gmail.com', 'KennGantengBanget', '$2y$12$1s5d7Lx2.a3Fnq7gUPiO/.E7YsoAxwNox2ZgQyYAbJhkqTD0fTKyC', 'jljlanan', NULL, '2025-01-29 18:35:42', '2025-02-18 21:58:29', 'profiles/RIIBJsJQndpwAB9rQgW1KHxM8KSa2768eMx0kpN6.jpg', 'Certified as a Professional Coat Hanger', 1, 0, NULL),
(3, 'fdhdhdf', 'tes@gmail.com', 'sdgsdgsdg', '$2y$12$fv69qlgWXaeLEcj5BCMpXOtdsJjA4WKTxmZWmqgpndbbsCAv5QxTe', 'adsvgsdg', NULL, '2025-01-29 18:36:00', '2025-01-29 18:36:10', NULL, NULL, 1, 0, NULL),
(4, 'Amba', 'asikjos@gmail.com', 'MasAmba', '$2y$12$cKWvzMKRDN4lUdHCJDhPWOAb4yDJpxQhdtYrsUT4enhOFL9aVnWX.', 'jl.in aja dulu', NULL, '2025-01-29 20:21:03', '2025-02-18 19:50:00', 'profiles/1vzReko91dquY30cJRh46Ag1em1jE8AcLi48tLul.jpg', 'No Woman No Cry', 1, 0, NULL),
(6, 'Crossflow Turbinee', 'test@gmail.com', 'sdsdf', '$2y$12$j3WVuYk8Em4gmhuXteM6VeaPT6R14qsxrAJfJf2jk4K5kl27/Vule', 'sdfdsf', NULL, '2025-02-18 21:46:50', '2025-02-18 21:46:50', NULL, NULL, 0, 0, NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `albums`
--
ALTER TABLE `albums`
  ADD PRIMARY KEY (`id`),
  ADD KEY `albums_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_photo_id_foreign` (`photo_id`),
  ADD KEY `comments_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `like`
--
ALTER TABLE `like`
  ADD PRIMARY KEY (`id`),
  ADD KEY `like_photo_id_foreign` (`photo_id`),
  ADD KEY `like_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `photos_album_id_foreign` (`album_id`),
  ADD KEY `photos_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `albums`
--
ALTER TABLE `albums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `like`
--
ALTER TABLE `like`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT untuk tabel `photos`
--
ALTER TABLE `photos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `albums`
--
ALTER TABLE `albums`
  ADD CONSTRAINT `albums_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `like`
--
ALTER TABLE `like`
  ADD CONSTRAINT `like_photo_id_foreign` FOREIGN KEY (`photo_id`) REFERENCES `photos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_album_id_foreign` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `photos_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
