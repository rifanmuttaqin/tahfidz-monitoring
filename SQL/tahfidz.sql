-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 24 Sep 2019 pada 03.50
-- Versi server: 10.1.38-MariaDB
-- Versi PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tahfidz`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_07_03_041142_create_user_table', 1),
(2, '2019_07_03_042750_create_class_table', 1),
(3, '2019_07_03_042949_create_surah_table', 1),
(4, '2019_07_03_043613_create_user_token_table', 1),
(5, '2019_07_03_044115_create_iqro_table', 1),
(6, '2019_07_03_044924_create_sytem_log_table', 1),
(7, '2019_07_03_045155_create_siswa_table', 1),
(8, '2019_07_03_050203_create_siswa_has_surah_table', 1),
(9, '2019_07_03_074151_create_siswa_has_iqro_table', 1),
(10, '2019_07_03_074506_create_report_print_log_table', 1),
(11, '2019_07_03_074842_create_global_setting_table', 1),
(12, '2019_08_12_083949_create_permission_tables', 1),
(13, '2019_08_19_003209_create_siswa_has_parent', 1),
(16, '2019_08_22_002116_create_assessment_log', 2),
(18, '2019_09_05_011908_create_action_log', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Model\\User\\User', 1),
(3, 'App\\Model\\User\\User', 2),
(4, 'App\\Model\\User\\User', 2),
(4, 'App\\Model\\User\\User', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'index surah', 'web', '2019-07-08 09:22:50', '2019-07-08 09:22:50'),
(2, 'view surah', 'web', '2019-07-08 09:22:50', '2019-07-08 09:22:50'),
(3, 'create surah', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(4, 'update surah', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(5, 'delete surah', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(6, 'index user', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(7, 'view user', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(8, 'create user', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(9, 'update user', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(10, 'delete user', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(11, 'index class', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(12, 'view class', 'web', '2019-07-08 09:22:51', '2019-07-08 09:22:51'),
(13, 'create class', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(14, 'update class', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(15, 'delete class', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(16, 'index iqro', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(17, 'view iqro', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(18, 'create iqro', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(19, 'update iqro', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(20, 'delete iqro', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(21, 'index siswa', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(22, 'view siswa', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(23, 'create siswa', 'web', '2019-07-08 09:22:52', '2019-07-08 09:22:52'),
(24, 'update siswa', 'web', '2019-07-08 09:22:53', '2019-07-08 09:22:53'),
(25, 'delete siswa', 'web', '2019-07-08 09:22:53', '2019-07-08 09:22:53'),
(26, 'index home', 'web', '2019-08-19 00:58:03', '2019-08-19 00:58:07'),
(28, 'index parent', 'web', '2019-08-26 00:30:22', '2019-08-26 00:30:24'),
(29, 'create parent', 'web', '2019-08-26 00:30:49', '2019-08-26 00:30:53'),
(30, 'update parent', 'web', '2019-08-26 00:35:15', '2019-08-26 00:35:17'),
(31, 'change password', 'web', '2019-08-26 00:35:20', '2019-08-26 00:35:22'),
(32, 'delete parent', 'web', '2019-08-26 00:35:24', '2019-08-26 00:35:26'),
(33, 'index assessment', 'web', '2019-08-26 00:35:28', '2019-08-26 00:35:30'),
(34, 'create assessment', 'web', '2019-08-26 00:35:33', '2019-08-26 00:35:36'),
(35, 'index role', 'web', '2019-08-26 00:35:38', '2019-08-26 00:35:40'),
(36, 'update role', 'web', '2019-08-26 00:35:42', '2019-08-26 00:35:44'),
(37, 'all report', 'web', '2019-08-26 00:36:50', '2019-08-26 00:36:55'),
(38, 'index profile', 'web', '2019-08-26 07:33:20', '2019-08-26 07:33:28'),
(39, 'update profile', 'web', '2019-08-26 07:33:44', '2019-08-26 07:33:50');

-- --------------------------------------------------------

--
-- Struktur dari tabel `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Creator', 'web', '2019-08-18 17:52:19', '2019-08-18 17:52:19'),
(3, 'Admin', 'web', '2019-08-18 17:53:09', '2019-08-18 17:53:09'),
(4, 'Guru', 'web', '2019-08-18 17:53:31', '2019-08-18 17:53:31');

-- --------------------------------------------------------

--
-- Struktur dari tabel `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(2, 1),
(2, 3),
(2, 4),
(3, 1),
(3, 3),
(3, 4),
(4, 1),
(4, 3),
(4, 4),
(5, 1),
(5, 3),
(5, 4),
(6, 1),
(6, 3),
(6, 4),
(7, 1),
(7, 3),
(7, 4),
(8, 1),
(8, 3),
(8, 4),
(9, 1),
(9, 3),
(9, 4),
(10, 1),
(10, 3),
(10, 4),
(11, 1),
(11, 3),
(11, 4),
(12, 1),
(12, 3),
(12, 4),
(13, 1),
(13, 3),
(13, 4),
(14, 1),
(14, 3),
(14, 4),
(15, 1),
(15, 3),
(15, 4),
(16, 1),
(16, 3),
(16, 4),
(17, 1),
(17, 3),
(17, 4),
(18, 1),
(18, 3),
(18, 4),
(19, 1),
(19, 3),
(19, 4),
(20, 1),
(20, 3),
(20, 4),
(21, 1),
(21, 3),
(21, 4),
(22, 1),
(22, 3),
(22, 4),
(23, 1),
(23, 3),
(23, 4),
(24, 1),
(24, 3),
(24, 4),
(25, 1),
(25, 3),
(25, 4),
(26, 1),
(26, 3),
(26, 4),
(28, 1),
(28, 3),
(28, 4),
(29, 1),
(29, 3),
(29, 4),
(30, 1),
(30, 3),
(30, 4),
(31, 1),
(31, 3),
(31, 4),
(32, 1),
(32, 3),
(32, 4),
(33, 1),
(33, 3),
(33, 4),
(34, 1),
(34, 3),
(34, 4),
(35, 1),
(35, 3),
(35, 4),
(36, 1),
(36, 3),
(36, 4),
(37, 1),
(37, 3),
(37, 4),
(38, 1),
(38, 3),
(38, 4),
(39, 1),
(39, 3),
(39, 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_action_log`
--

CREATE TABLE `tbl_action_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `action_type` int(11) NOT NULL,
  `is_error` int(11) NOT NULL,
  `action_message` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_action_log`
--

INSERT INTO `tbl_action_log` (`id`, `user_id`, `action_type`, `is_error`, `action_message`, `date`, `created_at`, `updated_at`) VALUES
(1, 1, 10, 0, 'Mengakses halaman Profile', '2019-09-24 01:44:37', '2019-09-23 18:44:37', '2019-09-23 18:44:37'),
(2, 1, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:44:48', '2019-09-23 18:44:48', '2019-09-23 18:44:48'),
(3, 1, 10, 0, 'Mengakses halaman role', '2019-09-24 01:45:11', '2019-09-23 18:45:11', '2019-09-23 18:45:11'),
(4, 1, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:45:14', '2019-09-23 18:45:14', '2019-09-23 18:45:14'),
(5, 1, 10, 0, 'Mengakses halaman manajemen user', '2019-09-24 01:45:17', '2019-09-23 18:45:17', '2019-09-23 18:45:17'),
(6, 1, 10, 0, 'Mengakses halaman create manajemen user', '2019-09-24 01:45:19', '2019-09-23 18:45:19', '2019-09-23 18:45:19'),
(7, 1, 10, 0, 'Berhasil menyimpan user', '2019-09-24 01:45:53', '2019-09-23 18:45:53', '2019-09-23 18:45:53'),
(8, 1, 10, 0, 'Mengakses halaman manajemen user', '2019-09-24 01:45:53', '2019-09-23 18:45:53', '2019-09-23 18:45:53'),
(9, 2, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:46:18', '2019-09-23 18:46:18', '2019-09-23 18:46:18'),
(10, 2, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:48:12', '2019-09-23 18:48:12', '2019-09-23 18:48:12'),
(11, 2, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:48:48', '2019-09-23 18:48:48', '2019-09-23 18:48:48'),
(12, 2, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:49:32', '2019-09-23 18:49:32', '2019-09-23 18:49:32'),
(13, 2, 10, 0, 'Mengakses Halaman Assessment', '2019-09-24 01:49:35', '2019-09-23 18:49:35', '2019-09-23 18:49:35'),
(14, 2, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:50:02', '2019-09-23 18:50:02', '2019-09-23 18:50:02'),
(15, 2, 10, 0, 'Mengakses Halaman Laporan Harian', '2019-09-24 01:50:09', '2019-09-23 18:50:09', '2019-09-23 18:50:09'),
(16, 1, 10, 0, 'Mengakses Halaman Home', '2019-09-24 01:50:18', '2019-09-23 18:50:18', '2019-09-23 18:50:18'),
(17, 1, 10, 0, 'Mengakses halaman Profile', '2019-09-24 01:50:41', '2019-09-23 18:50:41', '2019-09-23 18:50:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_assessment_log`
--

CREATE TABLE `tbl_assessment_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `assessment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `range` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_class`
--

CREATE TABLE `tbl_class` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `angkatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_global_setting`
--

CREATE TABLE `tbl_global_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `use_log_setting` tinyint(4) NOT NULL DEFAULT '10',
  `use_log_print` tinyint(4) NOT NULL DEFAULT '10',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_iqro`
--

CREATE TABLE `tbl_iqro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jilid_number` int(11) NOT NULL,
  `total_page` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_report_print_log`
--

CREATE TABLE `tbl_report_print_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `print_by` bigint(20) UNSIGNED NOT NULL,
  `date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa`
--

CREATE TABLE `tbl_siswa` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `memorization_type` int(11) NOT NULL,
  `class_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa_has_iqro`
--

CREATE TABLE `tbl_siswa_has_iqro` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `iqro_id` bigint(20) UNSIGNED DEFAULT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `page` int(11) NOT NULL,
  `date` date NOT NULL,
  `group_page` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa_has_parent`
--

CREATE TABLE `tbl_siswa_has_parent` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_siswa_has_surah`
--

CREATE TABLE `tbl_siswa_has_surah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `siswa_id` bigint(20) UNSIGNED DEFAULT NULL,
  `surah_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ayat` int(11) NOT NULL,
  `date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci,
  `group_ayat` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_surah`
--

CREATE TABLE `tbl_surah` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `surah_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `juz` int(11) NOT NULL,
  `total_ayat` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_system_log`
--

CREATE TABLE `tbl_system_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `action` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `full_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` tinyint(4) NOT NULL DEFAULT '10',
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `username`, `address`, `full_name`, `profile_picture`, `account_type`, `password`, `status`, `email`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, 'Super Admin', NULL, 10, '$2y$10$QutzuxfQabI7K6nd0QLckOTB35dMQdHFgn4h2zMWxZ.npxcF7Rmji', 10, 'admin@gmail.com', '2019-09-24 01:42:36', '2019-09-24 01:42:36'),
(2, 'guru_tahfidz', NULL, 'Guru Tahfidz', NULL, 40, '$2y$10$MPF4ktSyN2xhgXLdljY8weaQagBx79f3hxPUR2grSWNy.8QC6kkRS', 10, 'guru@mail.com', '2019-09-23 18:45:53', '2019-09-23 18:45:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbl_user_token`
--

CREATE TABLE `tbl_user_token` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_expired` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indeks untuk tabel `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indeks untuk tabel `tbl_action_log`
--
ALTER TABLE `tbl_action_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_action_log_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `tbl_assessment_log`
--
ALTER TABLE `tbl_assessment_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_assessment_log_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_class_teacher_id_foreign` (`teacher_id`);

--
-- Indeks untuk tabel `tbl_global_setting`
--
ALTER TABLE `tbl_global_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_iqro`
--
ALTER TABLE `tbl_iqro`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_report_print_log`
--
ALTER TABLE `tbl_report_print_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_report_print_log_print_by_foreign` (`print_by`);

--
-- Indeks untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_siswa_class_id_foreign` (`class_id`);

--
-- Indeks untuk tabel `tbl_siswa_has_iqro`
--
ALTER TABLE `tbl_siswa_has_iqro`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_siswa_has_iqro_siswa_id_foreign` (`siswa_id`),
  ADD KEY `tbl_siswa_has_iqro_iqro_id_foreign` (`iqro_id`);

--
-- Indeks untuk tabel `tbl_siswa_has_parent`
--
ALTER TABLE `tbl_siswa_has_parent`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_siswa_has_parent_parent_id_foreign` (`parent_id`),
  ADD KEY `tbl_siswa_has_parent_siswa_id_foreign` (`siswa_id`);

--
-- Indeks untuk tabel `tbl_siswa_has_surah`
--
ALTER TABLE `tbl_siswa_has_surah`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_siswa_has_surah_siswa_id_foreign` (`siswa_id`),
  ADD KEY `tbl_siswa_has_surah_surah_id_foreign` (`surah_id`);

--
-- Indeks untuk tabel `tbl_surah`
--
ALTER TABLE `tbl_surah`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_system_log`
--
ALTER TABLE `tbl_system_log`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tbl_system_log_user_id_unique` (`user_id`);

--
-- Indeks untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbl_user_token_user_id_foreign` (`user_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT untuk tabel `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tbl_action_log`
--
ALTER TABLE `tbl_action_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `tbl_assessment_log`
--
ALTER TABLE `tbl_assessment_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_global_setting`
--
ALTER TABLE `tbl_global_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_iqro`
--
ALTER TABLE `tbl_iqro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_report_print_log`
--
ALTER TABLE `tbl_report_print_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa_has_iqro`
--
ALTER TABLE `tbl_siswa_has_iqro`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa_has_parent`
--
ALTER TABLE `tbl_siswa_has_parent`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_siswa_has_surah`
--
ALTER TABLE `tbl_siswa_has_surah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_surah`
--
ALTER TABLE `tbl_surah`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_system_log`
--
ALTER TABLE `tbl_system_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_action_log`
--
ALTER TABLE `tbl_action_log`
  ADD CONSTRAINT `tbl_action_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_assessment_log`
--
ALTER TABLE `tbl_assessment_log`
  ADD CONSTRAINT `tbl_assessment_log_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tbl_siswa` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_class`
--
ALTER TABLE `tbl_class`
  ADD CONSTRAINT `tbl_class_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_report_print_log`
--
ALTER TABLE `tbl_report_print_log`
  ADD CONSTRAINT `tbl_report_print_log_print_by_foreign` FOREIGN KEY (`print_by`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_siswa`
--
ALTER TABLE `tbl_siswa`
  ADD CONSTRAINT `tbl_siswa_class_id_foreign` FOREIGN KEY (`class_id`) REFERENCES `tbl_class` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_siswa_has_iqro`
--
ALTER TABLE `tbl_siswa_has_iqro`
  ADD CONSTRAINT `tbl_siswa_has_iqro_iqro_id_foreign` FOREIGN KEY (`iqro_id`) REFERENCES `tbl_iqro` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_siswa_has_iqro_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tbl_siswa` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_siswa_has_parent`
--
ALTER TABLE `tbl_siswa_has_parent`
  ADD CONSTRAINT `tbl_siswa_has_parent_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_siswa_has_parent_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tbl_siswa` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_siswa_has_surah`
--
ALTER TABLE `tbl_siswa_has_surah`
  ADD CONSTRAINT `tbl_siswa_has_surah_siswa_id_foreign` FOREIGN KEY (`siswa_id`) REFERENCES `tbl_siswa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tbl_siswa_has_surah_surah_id_foreign` FOREIGN KEY (`surah_id`) REFERENCES `tbl_surah` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `tbl_system_log`
--
ALTER TABLE `tbl_system_log`
  ADD CONSTRAINT `tbl_system_log_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `tbl_user_token`
--
ALTER TABLE `tbl_user_token`
  ADD CONSTRAINT `tbl_user_token_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
