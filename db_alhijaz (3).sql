-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2018 at 01:07 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_alhijaz`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_lengkap` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(160) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `nama_lengkap`, `email`, `password`, `login_at`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ARI RUSMILAND', 'admin@gmail.com', '$2y$10$R080AXXiJmezJ.OOHDdOEuPGuuZNqBGnEtpmMVWnLgMoREoLekQk2', '2018-08-01 09:07:17', '2018-07-28 09:00:14', 'MDkYDGzOryljxCayBIX89yvlr2dQv1DtuaWy1bL1WwF4acddqMqDLp2TQcIJ', '2018-07-05 05:10:53', '2018-08-01 02:07:17'),
(2, 'ismail', 'ISMAIL AZHAFIR ROHAGA', 'ismail@gmail.com', '$2y$10$Dlfku2fa.BURTT55Ceig2uater7zp0f.zoLepCbUZB8kSpYmqKMUy', '2018-07-12 08:23:52', '2018-07-12 08:24:49', 'lGqexutR7c4euviyqdAp6mMQIBuhSH9FAdlsvgnWrJpZfmFTsvxTZ2RsL09e', '2018-07-10 20:48:18', '2018-07-12 01:24:49'),
(3, 'rachmizard', 'RACHMIZARD', 'rachmizard11072000@gmail.com', '$2y$10$FiyAS6sKDxA2AN28ckYuoO9StrgyOOy9S2IVliQMqi/KIH6cmaAq.', '2018-07-28 18:07:36', '2018-07-28 18:18:38', '1SCjwj1FwhOiMSSW2mEzwZjEhyU6kJ1SW0aRqUJyYaWO5ekFVhXoD6RF7xrr', '2018-07-28 04:20:20', '2018-07-28 11:18:38');

-- --------------------------------------------------------

--
-- Table structure for table `detail_jadwals`
--

CREATE TABLE `detail_jadwals` (
  `id` int(10) UNSIGNED NOT NULL,
  `jadwal_id` int(11) NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_double` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_triple` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga_quard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_madinah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hotel_mekah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `manasik_tanggal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(191) NOT NULL,
  `judul` varchar(191) NOT NULL,
  `jawaban` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `jamaah`
--

CREATE TABLE `jamaah` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_umrah` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jamaah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_berangkat` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_pulang` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maskapai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_fee` enum('Ya','Tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jamaah`
--

INSERT INTO `jamaah` (`id`, `id_umrah`, `id_jamaah`, `tgl_daftar`, `nama`, `tgl_berangkat`, `tgl_pulang`, `maskapai`, `marketing`, `staff`, `no_telp`, `fee`, `jumlah_fee`, `created_at`, `updated_at`) VALUES
(8, 'AIWA91209120', 'JMH192012', '07/02/2018', 'Yusuf AlFaisaly', '07/25/2018', '07/30/2018', 'SAUDIA', '1', 'YUDI KERTAYASA', 921210921, '8900000', 'Ya', '2018-07-26 07:56:48', '2018-07-26 07:56:48'),
(9, 'AIWA91209120', 'JMH192012', '08/28/2018', 'Ahmad Subagja', '08/29/2018', '08/30/2018', 'SAUDIA', '1', 'YUDI KERTAYASA', 91821298129, '8900000', 'Ya', '2018-08-01 02:13:00', '2018-08-01 02:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `laporan_jamaah`
--

CREATE TABLE `laporan_jamaah` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_umrah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_jamaah` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_daftar` date NOT NULL,
  `tgl_berangkat` date NOT NULL,
  `tgl_pulang` date NOT NULL,
  `maskapai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marketing` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fee` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jumlah_bayar_fee` enum('Ya','Tidak') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `subjek` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `subjek`, `user_id`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Login ke website.', '1', '2018-07-26 07:40:37', '2018-07-26 07:40:37', '2018-07-26 07:40:37'),
(2, 'Logout dari website.', '1', '2018-07-26 07:41:16', '2018-07-26 07:41:16', '2018-07-26 07:41:16'),
(3, 'Login ke website.', '1', '2018-07-26 07:49:03', '2018-07-26 07:49:03', '2018-07-26 07:49:03'),
(4, 'Mengedit data di table jamaah.', '1', '2018-07-26 07:53:08', '2018-07-26 07:53:08', '2018-07-26 07:53:08'),
(5, 'Menghapus data di table jamaah.', '1', '2018-07-26 07:55:58', '2018-07-26 07:55:58', '2018-07-26 07:55:58'),
(6, 'Menghapus data di table jamaah.', '1', '2018-07-26 07:56:07', '2018-07-26 07:56:07', '2018-07-26 07:56:07'),
(7, 'Menghapus data di table jamaah.', '1', '2018-07-26 07:56:16', '2018-07-26 07:56:16', '2018-07-26 07:56:16'),
(8, 'Menghapus data di table jamaah.', '1', '2018-07-26 07:56:24', '2018-07-26 07:56:24', '2018-07-26 07:56:24'),
(9, 'Menambahkan 1 data di table jamaah.', '1', '2018-07-26 07:56:48', '2018-07-26 07:56:48', '2018-07-26 07:56:48'),
(10, 'Logout dari website.', '1', '2018-07-26 08:21:54', '2018-07-26 08:21:54', '2018-07-26 08:21:54'),
(11, 'Login ke website.', '1', '2018-07-26 09:24:56', '2018-07-26 09:24:56', '2018-07-26 09:24:56'),
(12, 'Mengedit data di table jamaah.', '1', '2018-07-26 09:25:36', '2018-07-26 09:25:36', '2018-07-26 09:25:36'),
(13, 'Menambahkan 1 data di table jamaah.', '1', '2018-07-26 09:28:07', '2018-07-26 09:28:07', '2018-07-26 09:28:07'),
(14, 'Login ke website.', '1', '2018-07-27 12:50:26', '2018-07-27 12:50:26', '2018-07-27 12:50:26'),
(15, 'Menghapus data di table jamaah.', '1', '2018-07-27 12:52:08', '2018-07-27 12:52:08', '2018-07-27 12:52:08'),
(16, 'Login ke website.', '1', '2018-07-28 01:57:02', '2018-07-28 01:57:02', '2018-07-28 01:57:02'),
(17, 'Menambahkan 1 data di table Gallery.', '1', '2018-07-28 01:57:45', '2018-07-28 01:57:45', '2018-07-28 01:57:45'),
(18, 'Logout dari website.', '1', '2018-07-28 02:00:14', '2018-07-28 02:00:14', '2018-07-28 02:00:14'),
(19, 'Login ke website.', '3', '2018-07-28 04:22:18', '2018-07-28 04:22:18', '2018-07-28 04:22:18'),
(20, 'Logout dari website.', '3', '2018-07-28 04:22:40', '2018-07-28 04:22:40', '2018-07-28 04:22:40'),
(21, 'Login ke website.', '3', '2018-07-28 04:50:29', '2018-07-28 04:50:29', '2018-07-28 04:50:29'),
(22, 'Logout dari website.', '3', '2018-07-28 04:51:26', '2018-07-28 04:51:26', '2018-07-28 04:51:26'),
(23, 'Login ke website.', '3', '2018-07-28 04:57:18', '2018-07-28 04:57:18', '2018-07-28 04:57:18'),
(24, 'Menambahkan 1 data di table Gallery.', '3', '2018-07-28 05:00:24', '2018-07-28 05:00:24', '2018-07-28 05:00:24'),
(25, 'Menambahkan 1 data di table Gallery.', '3', '2018-07-28 05:03:53', '2018-07-28 05:03:53', '2018-07-28 05:03:53'),
(26, 'Menghapus 1 data di table Gallery.', '3', '2018-07-28 05:06:00', '2018-07-28 05:06:00', '2018-07-28 05:06:00'),
(27, 'Menambahkan 1 data di table Gallery.', '3', '2018-07-28 05:06:26', '2018-07-28 05:06:26', '2018-07-28 05:06:26'),
(28, 'Login ke website.', '3', '2018-07-28 10:54:16', '2018-07-28 10:54:16', '2018-07-28 10:54:16'),
(29, 'Logout dari website.', '3', '2018-07-28 10:55:18', '2018-07-28 10:55:18', '2018-07-28 10:55:18'),
(30, 'Login ke website.', '3', '2018-07-28 11:07:36', '2018-07-28 11:07:36', '2018-07-28 11:07:36'),
(31, 'Logout dari website.', '3', '2018-07-28 11:18:38', '2018-07-28 11:18:38', '2018-07-28 11:18:38'),
(32, 'Login ke website.', '1', '2018-07-28 12:09:04', '2018-07-28 12:09:04', '2018-07-28 12:09:04'),
(33, 'Login ke website.', '1', '2018-07-29 11:34:05', '2018-07-29 11:34:05', '2018-07-29 11:34:05'),
(34, 'Login ke website.', '1', '2018-07-29 12:16:46', '2018-07-29 12:16:46', '2018-07-29 12:16:46'),
(35, 'Login ke website.', '1', '2018-07-31 01:33:19', '2018-07-31 01:33:19', '2018-07-31 01:33:19'),
(36, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:44:58', '2018-07-31 04:44:58', '2018-07-31 04:44:58'),
(37, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:45:29', '2018-07-31 04:45:29', '2018-07-31 04:45:29'),
(38, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:46:27', '2018-07-31 04:46:27', '2018-07-31 04:46:27'),
(39, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:47:38', '2018-07-31 04:47:38', '2018-07-31 04:47:38'),
(40, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:50:55', '2018-07-31 04:50:55', '2018-07-31 04:50:55'),
(41, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:52:13', '2018-07-31 04:52:13', '2018-07-31 04:52:13'),
(42, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 04:54:21', '2018-07-31 04:54:21', '2018-07-31 04:54:21'),
(43, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 06:11:12', '2018-07-31 06:11:12', '2018-07-31 06:11:12'),
(44, 'Login ke website.', '1', '2018-07-31 09:42:51', '2018-07-31 09:42:51', '2018-07-31 09:42:51'),
(45, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 09:44:23', '2018-07-31 09:44:23', '2018-07-31 09:44:23'),
(46, 'Mengedit 1 data di table kalkuklasi.', '1', '2018-07-31 09:44:42', '2018-07-31 09:44:42', '2018-07-31 09:44:42'),
(47, 'Login ke website.', '1', '2018-08-01 01:38:02', '2018-08-01 01:38:02', '2018-08-01 01:38:02'),
(48, 'Login ke website.', '1', '2018-08-01 01:41:10', '2018-08-01 01:41:10', '2018-08-01 01:41:10'),
(49, 'Login ke website.', '1', '2018-08-01 01:42:06', '2018-08-01 01:42:06', '2018-08-01 01:42:06'),
(50, 'Login ke website.', '1', '2018-08-01 01:45:05', '2018-08-01 01:45:05', '2018-08-01 01:45:05'),
(51, 'Login ke website.', '1', '2018-08-01 01:45:42', '2018-08-01 01:45:42', '2018-08-01 01:45:42'),
(52, 'Login ke website.', '1', '2018-08-01 01:52:04', '2018-08-01 01:52:04', '2018-08-01 01:52:04'),
(53, 'Login ke website.', '1', '2018-08-01 01:53:59', '2018-08-01 01:53:59', '2018-08-01 01:53:59'),
(54, 'Login ke website.', '1', '2018-08-01 01:54:56', '2018-08-01 01:54:56', '2018-08-01 01:54:56'),
(55, 'Login ke website.', '1', '2018-08-01 01:56:39', '2018-08-01 01:56:39', '2018-08-01 01:56:39'),
(56, 'Login ke website.', '1', '2018-08-01 01:57:18', '2018-08-01 01:57:18', '2018-08-01 01:57:18'),
(57, 'Login ke website.', '1', '2018-08-01 01:58:22', '2018-08-01 01:58:22', '2018-08-01 01:58:22'),
(58, 'Login ke website.', '1', '2018-08-01 02:02:21', '2018-08-01 02:02:21', '2018-08-01 02:02:21'),
(59, 'Login ke website.', '1', '2018-08-01 02:05:11', '2018-08-01 02:05:11', '2018-08-01 02:05:11'),
(60, 'Login ke website.', '1', '2018-08-01 02:05:52', '2018-08-01 02:05:52', '2018-08-01 02:05:52'),
(61, 'Login ke website.', '1', '2018-08-01 02:07:17', '2018-08-01 02:07:17', '2018-08-01 02:07:17'),
(62, 'Menambahkan 1 data di table jamaah.', '1', '2018-08-01 02:13:00', '2018-08-01 02:13:00', '2018-08-01 02:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_broadcasts`
--

CREATE TABLE `master_broadcasts` (
  `id` int(10) UNSIGNED NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_brosurs`
--

CREATE TABLE `master_brosurs` (
  `id` int(10) UNSIGNED NOT NULL,
  `file_brosur` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_brosurs`
--

INSERT INTO `master_brosurs` (`id`, `file_brosur`, `description`, `created_at`, `updated_at`) VALUES
(1, 'u9220252_aiwa.sql', 'Ini brosurku', '2018-07-26 07:50:55', '2018-07-26 07:50:55');

-- --------------------------------------------------------

--
-- Table structure for table `master_galleries`
--

CREATE TABLE `master_galleries` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deskripsi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_galleries`
--

INSERT INTO `master_galleries` (`id`, `file`, `tanggal`, `judul`, `deskripsi`, `tipe`, `created_at`, `updated_at`) VALUES
(2, '5928.jpg', '07/28/2018', 'Rifqi Subagja', 'Wkwkwkwkw', 'jpg', '2018-07-28 05:00:24', '2018-07-28 05:00:24'),
(3, '8324.jpg', '07/28/2018', 'AD', 'aDAda', 'jpg', '2018-07-28 05:03:53', '2018-07-28 05:03:53'),
(4, '7334.JPG', '07/28/2018', 'Annisa Firtsa', 'Annisa Calon Rifqi', 'JPG', '2018-07-28 05:06:26', '2018-07-28 05:06:26');

-- --------------------------------------------------------

--
-- Table structure for table `master_hotels`
--

CREATE TABLE `master_hotels` (
  `id` int(10) UNSIGNED NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kota` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lokasi_map` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `skor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_itenaries`
--

CREATE TABLE `master_itenaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `detailjadwal_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `judul` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_itinerary` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_itenaries`
--

INSERT INTO `master_itenaries` (`id`, `detailjadwal_id`, `judul`, `tanggal_itinerary`, `link`, `created_at`, `updated_at`) VALUES
(5, '2018-10-20', 'Keberangkatan', '07/31/2018', 'http://115.124.86.218/aiw/up/itinerary/20180711150047_ITINERARY_16_OKTOBER_2018_(CT_IST).pdf', '2018-07-18 20:57:04', '2018-07-18 20:57:04'),
(6, '2018-10-16', 'Keberangkatan', '10/17/2018', 'http://115.124.86.218/aiw/up/itinerary/20180711150047_ITINERARY_16_OKTOBER_2018_(CT_IST).pdf', '2018-07-19 07:37:48', '2018-07-19 07:37:48'),
(11, '2018-11-17', 'Keberangkatan', '11/17/2018', 'http://115.124.86.218/aiw/up/itinerary/20180525171929_ITINERARY_17_OKTOBER_2018_(CGK_MED).pdf', '2018-08-01 04:48:42', '2018-08-01 04:52:44'),
(12, '2018-10-17', 'Keberangkatan', '10/17/2018', 'http://115.124.86.218/aiw/up/itinerary/20180525171929_ITINERARY_17_OKTOBER_2018_(CGK_MED).pdf', '2018-08-01 06:08:48', '2018-08-01 06:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `master_jadwals`
--

CREATE TABLE `master_jadwals` (
  `id` int(10) UNSIGNED NOT NULL,
  `tanggal_keberangkatan` date NOT NULL,
  `waktu_keberangkatan` datetime NOT NULL,
  `pesawat_keberangkatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bandara_keberangkatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_kepulangan` date NOT NULL,
  `waktu_kepulangan` datetime NOT NULL,
  `pesawat_kepulangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bandara_kepulangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `maskapai` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `paket` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `seat_total` int(11) NOT NULL,
  `seat_terpakai` int(11) NOT NULL,
  `ready_mofa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ready_visa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_promo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_kalkulasis`
--

CREATE TABLE `master_kalkulasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `harga_default` bigint(191) NOT NULL,
  `harga_promo` bigint(191) NOT NULL,
  `harga_infant` bigint(191) NOT NULL,
  `harga_full` bigint(191) NOT NULL,
  `harga_lite` bigint(191) NOT NULL,
  `diskon_balita_uhud` bigint(191) NOT NULL,
  `diskon_balita_nur` bigint(191) NOT NULL,
  `diskon_balita_rhm` bigint(191) NOT NULL,
  `harga_visa` bigint(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `master_kalkulasis`
--

INSERT INTO `master_kalkulasis` (`id`, `harga_default`, `harga_promo`, `harga_infant`, `harga_full`, `harga_lite`, `diskon_balita_uhud`, `diskon_balita_nur`, `diskon_balita_rhm`, `harga_visa`, `created_at`, `updated_at`) VALUES
(1, 1200000, 0, 9500000, 1200000, 500000, 2500000, 4000000, 4500000, 7600000, NULL, '2018-07-31 09:44:42');

-- --------------------------------------------------------

--
-- Table structure for table `master_komisis`
--

CREATE TABLE `master_komisis` (
  `id` int(10) UNSIGNED NOT NULL,
  `total_komisi_reguler` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_reguler_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_reguler_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_reguler_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_komisi_promo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_promo_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_promo_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_promo_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_komisi_haji` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_haji_1` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_haji_2` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `komisi_haji_3` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_notifikasis`
--

CREATE TABLE `master_notifikasis` (
  `id` int(10) UNSIGNED NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `tanggal_notifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `waktu_notifikasi` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pesan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_vouchers`
--

CREATE TABLE `master_vouchers` (
  `id` int(10) UNSIGNED NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `potongan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tipe` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
(1, '2018_06_08_033109_create_anggotas_table', 1),
(2, '2018_06_08_033148_create_master__jadwals_table', 1),
(3, '2018_06_08_033232_create_caljams_table', 1),
(5, '2018_06_08_033322_create_detail__jadwals_table', 1),
(6, '2018_06_08_033438_create_master_itenaries_table', 1),
(7, '2018_06_08_033507_create_master_notifikasis_table', 1),
(8, '2018_06_08_033537_create_master_galleries_table', 1),
(9, '2018_06_08_033550_create_master_brosurs_table', 1),
(10, '2018_06_08_033607_create_master_komisis_table', 1),
(11, '2018_06_08_033623_create_admins_table', 1),
(12, '2018_06_08_040125_create_master_vouchers_table', 1),
(13, '2018_06_08_040138_create_master_kalkulasis_table', 1),
(14, '2018_06_08_040153_create_master_broadcasts_table', 1),
(15, '2018_06_10_070514_create_admins_table', 2),
(18, '2018_07_10_082845_create_hotels_table', 5),
(19, '2018_06_08_033301_create_master_hotels_table', 6),
(20, '2018_07_11_032649_create_logs_table', 7),
(21, '2018_07_20_091610_create_laporan_jamaah_table', 8),
(22, '2018_06_08_033232_create_prospeks_table', 9),
(23, '2018_07_05_125842_create_jamaah_table', 9),
(24, '2016_06_01_000001_create_oauth_auth_codes_table', 10),
(25, '2016_06_01_000002_create_oauth_access_tokens_table', 10),
(26, '2016_06_01_000003_create_oauth_refresh_tokens_table', 10),
(27, '2016_06_01_000004_create_oauth_clients_table', 10),
(28, '2016_06_01_000005_create_oauth_personal_access_clients_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

CREATE TABLE `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Alhijaz Personal Access Client', 'mWo0q4jTQ1gi3SsAOHXUHqPcpjyaV8izjhxlau78', 'http://localhost', 1, 0, 0, '2018-07-30 02:29:55', '2018-07-30 02:29:55'),
(2, NULL, 'Alhijaz Password Grant Client', 'WLfc6pII4hSMvrowE8StnabAPUvxPNUaTIkAQrs6', 'http://localhost', 0, 1, 0, '2018-07-30 02:29:55', '2018-07-30 02:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-07-30 02:29:55', '2018-07-30 02:29:55');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('danudirja@gmail.com', '$2y$10$n2QlM83H/34SMB1oySDj0un1tRQt59u0F4ZdXbZO.NCh9vlKVbfZW', '2018-07-28 04:04:17'),
('admin@gmail.com', '$2y$10$f14FpzVuNc3i5PX6h3wzv.7sQDj.3d/dLo9Y8x9J97sYXp1gaW4dq', '2018-08-01 01:34:38');

-- --------------------------------------------------------

--
-- Table structure for table `prospeks`
--

CREATE TABLE `prospeks` (
  `id` int(10) UNSIGNED NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` bigint(20) NOT NULL,
  `jml_dewasa` int(11) NOT NULL,
  `jml_infant` int(11) NOT NULL,
  `jml_balita` int(11) NOT NULL,
  `jml_visa` int(80) NOT NULL,
  `jml_balita_kasur` int(80) NOT NULL,
  `tgl_keberangkatan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dobel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `triple` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quard` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `passport` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `meningitis` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `pas_foto` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `buku_nikah` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `fc_akta` enum('true','false') COLLATE utf8mb4_unicode_ci NOT NULL,
  `visa_progresif` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diskon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_followup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pembayaran` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perlengkapan_balita` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `perlengkapan_dewasa` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `prospeks`
--

INSERT INTO `prospeks` (`id`, `anggota_id`, `pic`, `no_telp`, `jml_dewasa`, `jml_infant`, `jml_balita`, `jml_visa`, `jml_balita_kasur`, `tgl_keberangkatan`, `jenis`, `dobel`, `triple`, `quard`, `passport`, `meningitis`, `pas_foto`, `buku_nikah`, `fc_akta`, `visa_progresif`, `diskon`, `keterangan`, `tanggal_followup`, `pembayaran`, `perlengkapan_balita`, `perlengkapan_dewasa`, `created_at`, `updated_at`) VALUES
(1, 1, 'Wahid al Awaluddin', 85220690012, 2, 0, 1, 2, 0, '16 Oct 2018\nRute : CGKIST / ISTMED => JEDIST / ISTCGK\nPesawat : TK 57 / 5304', 'RAHMAH', '0', '3', '0', 'true', 'false', 'true', 'false', 'true', '7600000', '0', 'Tes', '28/7/2018', 'SUDAH', 'FULL', 'DEFAULT', '2018-07-27 11:44:16', '2018-07-28 03:05:09'),
(2, 1, 'Randi al Akbar', 123, 4, 2, 0, 3, 1, '16 Oct 2018\nRute : CGKIST / ISTMED => JEDIST / ISTCGK\nPesawat : TK 57 / 5304', 'RAHMAH', '2', '3', '0', 'true', 'false', 'true', 'false', 'true', '7600000', '0', 'TESR123', '31/7/2018', 'BELUM', 'NULL', 'PROMO', '2018-07-28 03:07:25', '2018-07-28 03:07:25'),
(3, 1, 'Ujang Suhara', 1829812912, 3, 0, 0, 3, 0, '16 Oct 2018\nRute : CGKIST / ISTMED => JEDIST / ISTCGK\nPesawat : TK 57 / 5304', 'RAHMAH', '0', '3', '0', 'false', 'false', 'true', 'true', 'true', '98000000', '0', 'ASD', '4/8/2018', 'BELUM', 'NULL', 'DEFAULT', '2018-07-28 05:42:20', '2018-07-28 05:47:29'),
(4, 1, 'Arbaatun', 356, 2, 0, 1, 1, 0, '16 Oct 2018\nRute : CGKIST / ISTMED => JEDIST / ISTCGK\nPesawat : TK 57 / 5304', 'RAHMAH', '2', '0', '0', 'true', 'false', 'false', 'false', 'false', '7600000', '0', '3 Orang...', '30/7/2018', 'BELUM', 'FULL', 'DEFAULT', '2018-07-28 05:45:53', '2018-07-28 05:57:13'),
(5, 1, 'Zyan', 123, 1, 0, 0, 0, 0, '16 Oct 2018\nRute : CGKIST / ISTMED => JEDIST / ISTCGK\nPesawat : TK 57 / 5304', 'RAHMAH', '0', '0', '1', 'true', 'false', 'true', 'false', 'false', '7600000', '0', 'jones.', '30/7/2018', 'SUDAH', 'NULL', 'DEFAULT', '2018-07-28 05:48:50', '2018-07-28 05:56:46');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(120) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_ktp` int(90) NOT NULL,
  `alamat` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_telp` varchar(90) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL,
  `koordinator` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unique_id` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encrypted_password` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `salt` varchar(90) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(6) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `login_at` datetime DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `email`, `username`, `password`, `jenis_kelamin`, `no_ktp`, `alamat`, `no_telp`, `status`, `koordinator`, `foto`, `unique_id`, `encrypted_password`, `salt`, `pin`, `remember_token`, `created_at`, `updated_at`, `login_at`, `last_login`) VALUES
(1, 'DANU DIRJA', 'danudirja@gmail.com', 'danudirja', '$2y$10$WAgUhWnCYaYnz9UKbIYxxuYUB/Y4z.wzSpzKINiShjeyKgr69OOBa', 'L', 12912, 'bandung', '1920192', '1', '4', NULL, NULL, NULL, NULL, NULL, NULL, '2018-07-26 09:05:54', '2018-08-01 07:09:35', '2018-07-26 16:07:46', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `detail_jadwals`
--
ALTER TABLE `detail_jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jamaah`
--
ALTER TABLE `jamaah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporan_jamaah`
--
ALTER TABLE `laporan_jamaah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_broadcasts`
--
ALTER TABLE `master_broadcasts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_brosurs`
--
ALTER TABLE `master_brosurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_galleries`
--
ALTER TABLE `master_galleries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_hotels`
--
ALTER TABLE `master_hotels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_itenaries`
--
ALTER TABLE `master_itenaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_jadwals`
--
ALTER TABLE `master_jadwals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_kalkulasis`
--
ALTER TABLE `master_kalkulasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_komisis`
--
ALTER TABLE `master_komisis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_notifikasis`
--
ALTER TABLE `master_notifikasis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_vouchers`
--
ALTER TABLE `master_vouchers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_access_tokens`
--
ALTER TABLE `oauth_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_access_tokens_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_auth_codes`
--
ALTER TABLE `oauth_auth_codes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_clients_user_id_index` (`user_id`);

--
-- Indexes for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_personal_access_clients_client_id_index` (`client_id`);

--
-- Indexes for table `oauth_refresh_tokens`
--
ALTER TABLE `oauth_refresh_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`);

--
-- Indexes for table `prospeks`
--
ALTER TABLE `prospeks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `detail_jadwals`
--
ALTER TABLE `detail_jadwals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `jamaah`
--
ALTER TABLE `jamaah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `laporan_jamaah`
--
ALTER TABLE `laporan_jamaah`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;
--
-- AUTO_INCREMENT for table `master_broadcasts`
--
ALTER TABLE `master_broadcasts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_brosurs`
--
ALTER TABLE `master_brosurs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_galleries`
--
ALTER TABLE `master_galleries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `master_hotels`
--
ALTER TABLE `master_hotels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_itenaries`
--
ALTER TABLE `master_itenaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `master_jadwals`
--
ALTER TABLE `master_jadwals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_kalkulasis`
--
ALTER TABLE `master_kalkulasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `master_komisis`
--
ALTER TABLE `master_komisis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_notifikasis`
--
ALTER TABLE `master_notifikasis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `master_vouchers`
--
ALTER TABLE `master_vouchers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `oauth_clients`
--
ALTER TABLE `oauth_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `oauth_personal_access_clients`
--
ALTER TABLE `oauth_personal_access_clients`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `prospeks`
--
ALTER TABLE `prospeks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
