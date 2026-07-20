-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for laravel
CREATE DATABASE IF NOT EXISTS `laravel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `laravel`;

-- Dumping structure for table laravel.balitas
CREATE TABLE IF NOT EXISTS `balitas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `orang_tua_id` bigint unsigned NOT NULL,
  `posyandu_id` bigint unsigned NOT NULL,
  `nik` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_kelamin` enum('L','P') COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `berat_lahir` decimal(5,2) DEFAULT NULL,
  `panjang_lahir` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `balitas_nik_unique` (`nik`),
  KEY `balitas_orang_tua_id_foreign` (`orang_tua_id`),
  KEY `balitas_posyandu_id_foreign` (`posyandu_id`),
  CONSTRAINT `balitas_orang_tua_id_foreign` FOREIGN KEY (`orang_tua_id`) REFERENCES `orang_tuas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `balitas_posyandu_id_foreign` FOREIGN KEY (`posyandu_id`) REFERENCES `posyandus` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.balitas: ~23 rows (approximately)
INSERT INTO `balitas` (`id`, `orang_tua_id`, `posyandu_id`, `nik`, `nama`, `jenis_kelamin`, `tanggal_lahir`, `berat_lahir`, `panjang_lahir`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '3201010000000000', 'Anak Ibu Budi 1 Gaming', 'L', '2026-07-10', NULL, NULL, '2026-07-16 09:20:20', '2026-07-17 02:18:35'),
	(2, 2, 2, '3201010000000001', 'Anak Ibu Budi 2', 'P', '2025-06-10', 3.10, 50.50, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(3, 3, 1, '3201010000000002', 'Anak Ibu Budi 3', 'L', '2025-05-13', 3.20, 51.00, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(4, 4, 2, '3201010000000003', 'Anak Ibu Budi 4', 'P', '2025-04-03', 3.30, 51.50, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(5, 5, 1, '3201010000000004', 'Anak Ibu Budi 5', 'L', '2025-03-06', NULL, NULL, '2026-07-16 09:20:20', '2026-07-17 08:42:44'),
	(6, 6, 2, '3201010000000005', 'Anak Ibu Budi 6', 'P', '2025-02-13', 3.50, 52.50, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(7, 7, 1, '3201010000000006', 'Anak Ibu Budi 7', 'L', '2025-01-11', 3.60, 53.00, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(8, 8, 2, '3201010000000007', 'Anak Ibu Budi 8', 'P', '2024-12-12', 3.70, 53.50, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(9, 9, 1, '3201010000000008', 'Anak Ibu Budi 9', 'L', '2024-11-04', NULL, NULL, '2026-07-16 09:20:20', '2026-07-17 07:43:16'),
	(10, 10, 2, '3201010000000009', 'Anak Ibu Budi 10', 'P', '2024-10-08', 3.90, 54.50, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(11, 1, 1, '3201010000000010', 'Anak Ibu Budi 134', 'L', '2024-09-03', NULL, NULL, '2026-07-16 09:20:21', '2026-07-17 10:14:15'),
	(12, 2, 2, '3201010000000011', 'Anak Ibu Budi 2', 'P', '2024-07-21', 4.10, 55.50, '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(13, 3, 1, '3201010000000012', 'Anak Ibu Budi 3', 'L', '2025-07-13', 4.20, 56.00, '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(14, 4, 2, '3201010000000013', 'Anak Ibu Budi 4', 'P', '2025-05-31', 4.30, 56.50, '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(15, 5, 1, '3201010000000014', 'Anak Ibu Budi 5', 'L', '2025-05-04', 4.40, 57.00, '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(16, 11, 1, '1234567765432', 'Nama  Test UAT 1', 'L', '2026-06-05', NULL, NULL, '2026-07-17 00:51:14', '2026-07-17 00:51:14'),
	(17, 12, 1, '12345678987666', 'Naufal', 'L', '2024-09-23', NULL, NULL, '2026-07-17 01:29:06', '2026-07-17 02:56:49'),
	(18, 13, 1, '0987645678876567', 'syifa', 'P', '2026-06-12', NULL, NULL, '2026-07-17 02:04:02', '2026-07-17 02:04:02'),
	(20, 15, 1, '117145567679', 'Riyan Arya', 'L', '2026-04-02', NULL, NULL, '2026-07-17 07:17:01', '2026-07-17 07:17:01'),
	(21, 16, 1, '66752369078678', 'Imam Alkhalish', 'L', '2026-04-10', NULL, NULL, '2026-07-17 07:30:40', '2026-07-17 07:30:40'),
	(22, 17, 1, '1172178179818719', 'pasha', 'L', '2024-03-07', NULL, NULL, '2026-07-17 08:05:13', '2026-07-17 08:05:13'),
	(24, 12, 1, '1171985234664130', 'Rajul akhyar', 'L', '2025-11-07', NULL, NULL, '2026-07-19 12:46:11', '2026-07-19 12:46:11'),
	(25, 19, 1, '11712345678', 'almuttaqin', 'L', '2024-12-21', NULL, NULL, '2026-07-19 13:54:54', '2026-07-19 13:54:54');

-- Dumping structure for table laravel.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table laravel.kaders
CREATE TABLE IF NOT EXISTS `kaders` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `posyandu_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `kaders_user_id_foreign` (`user_id`),
  KEY `kaders_posyandu_id_foreign` (`posyandu_id`),
  CONSTRAINT `kaders_posyandu_id_foreign` FOREIGN KEY (`posyandu_id`) REFERENCES `posyandus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `kaders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.kaders: ~3 rows (approximately)
INSERT INTO `kaders` (`id`, `user_id`, `posyandu_id`, `nama`, `no_hp`, `created_at`, `updated_at`) VALUES
	(1, 2, 1, 'Naufal Alif', '81234567890', '2026-07-16 09:20:16', '2026-07-18 04:49:57'),
	(2, 3, 1, 'Kader Mawar 2', '081234567891', '2026-07-16 09:20:17', '2026-07-16 09:20:17'),
	(3, 4, 2, 'Kader Melati 1', '081234567892', '2026-07-16 09:20:17', '2026-07-16 09:20:17');

-- Dumping structure for table laravel.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.migrations: ~13 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2026_07_16_000001_create_puskesmas_table', 1),
	(6, '2026_07_16_000002_create_posyandus_table', 1),
	(7, '2026_07_16_000003_create_kaders_table', 1),
	(8, '2026_07_16_000004_create_orang_tuas_table', 1),
	(9, '2026_07_16_000005_create_balitas_table', 1),
	(10, '2026_07_16_000006_create_pengukurans_table', 1),
	(11, '2026_07_17_000000_add_nik_ibu_to_orang_tuas_table', 2),
	(12, '2026_07_17_000001_add_kecamatan_to_orang_tuas_table', 3),
	(13, '2026_07_19_000000_add_status_validasi_to_pengukurans_table', 3);

-- Dumping structure for table laravel.orang_tuas
CREATE TABLE IF NOT EXISTS `orang_tuas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nama_ibu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nik_ibu` varchar(16) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_ayah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `no_hp_whatsapp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `kecamatan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `orang_tuas_no_hp_whatsapp_unique` (`no_hp_whatsapp`),
  KEY `orang_tuas_user_id_foreign` (`user_id`),
  CONSTRAINT `orang_tuas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.orang_tuas: ~17 rows (approximately)
INSERT INTO `orang_tuas` (`id`, `user_id`, `nama_ibu`, `nik_ibu`, `nama_ayah`, `no_hp_whatsapp`, `alamat`, `kecamatan`, `created_at`, `updated_at`) VALUES
	(1, 5, 'Ibu Budi 1 Gaming', NULL, 'Bapak Budi 1', '081100000001', '{"desa":"Jl. Perumahan No. 12","kecamatan":null}', NULL, '2026-07-16 09:20:17', '2026-07-18 02:10:46'),
	(2, 6, 'Ibu Budi 2', NULL, 'Bapak Budi 2', '081100000002', 'Jl. Perumahan No. 2', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18'),
	(3, 7, 'Ibu Budi 3', NULL, 'Bapak Budi 3', '081100000003', 'Jl. Perumahan No. 3', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18'),
	(4, 8, 'Ibu Budi 4', NULL, 'Bapak Budi 4', '081100000004', 'Jl. Perumahan No. 4', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18'),
	(5, 9, 'Ibu Budi 5', NULL, 'Bapak Budi 5', '081100000005', '{"desa":"Jl. Perumahan No. 512","kecamatan":null}', NULL, '2026-07-16 09:20:19', '2026-07-17 08:42:44'),
	(6, 10, 'Ibu Budi 6', NULL, 'Bapak Budi 6', '081100000006', 'Jl. Perumahan No. 6', NULL, '2026-07-16 09:20:19', '2026-07-16 09:20:19'),
	(7, 11, 'Ibu Budi 7', NULL, 'Bapak Budi 7', '081100000007', 'Jl. Perumahan No. 7', NULL, '2026-07-16 09:20:19', '2026-07-16 09:20:19'),
	(8, 12, 'Ibu Budi 8', NULL, 'Bapak Budi 8', '081100000008', 'Jl. Perumahan No. 8', NULL, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(9, 13, 'Ibu Budi 9', NULL, 'Bapak Budi 9', '0811000000010', 'Jl. Perumahan No. 10', NULL, '2026-07-16 09:20:20', '2026-07-17 07:43:49'),
	(10, 14, 'Ibu Budi 10', NULL, 'Bapak Budi 10', '081100000010', 'Jl. Perumahan No. 10', NULL, '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(11, 15, 'nurhasanah', NULL, '-', '085234664133', '-', NULL, '2026-07-17 00:51:14', '2026-07-17 00:51:14'),
	(12, 16, 'Ellana', '12345678910', '-', '085234664130', 'keuramat', NULL, '2026-07-17 01:29:06', '2026-07-17 03:02:45'),
	(13, 17, 'masyitah', NULL, '-', '09292827262725', '-', NULL, '2026-07-17 02:04:02', '2026-07-17 02:04:02'),
	(15, 19, 'Azzahra', '1171242637638', '-', '098765345678', 'lhoong', NULL, '2026-07-17 07:17:01', '2026-07-17 07:17:01'),
	(16, 20, 'musdhalifah', '8868689678776', '-', '09897875626756376', 'matang', NULL, '2026-07-17 07:30:40', '2026-07-17 07:30:40'),
	(17, 21, 'mariana', '11877181728178', '-', '987977898678', '{"desa":"mulia","kecamatan":"kuta jaya"}', NULL, '2026-07-17 08:05:13', '2026-07-17 08:05:13'),
	(19, 23, 'nulaila', '117209875628342', '-', '09876789286', '{"desa":"lhongg","kecamatan":"matang"}', NULL, '2026-07-19 13:54:54', '2026-07-19 13:54:54');

-- Dumping structure for table laravel.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table laravel.pengukurans
CREATE TABLE IF NOT EXISTS `pengukurans` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `balita_id` bigint unsigned NOT NULL,
  `kader_id` bigint unsigned NOT NULL,
  `tanggal_ukur` date NOT NULL,
  `umur_bulan` int NOT NULL,
  `berat_badan` decimal(5,2) NOT NULL,
  `tinggi_badan` decimal(5,2) NOT NULL,
  `z_score_bbu` decimal(5,2) DEFAULT NULL,
  `z_score_tbu` decimal(5,2) DEFAULT NULL,
  `status_gizi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_validasi` enum('pending','approved','rejected') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengukurans_balita_id_foreign` (`balita_id`),
  KEY `pengukurans_kader_id_foreign` (`kader_id`),
  CONSTRAINT `pengukurans_balita_id_foreign` FOREIGN KEY (`balita_id`) REFERENCES `balitas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengukurans_kader_id_foreign` FOREIGN KEY (`kader_id`) REFERENCES `kaders` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.pengukurans: ~60 rows (approximately)
INSERT INTO `pengukurans` (`id`, `balita_id`, `kader_id`, `tanggal_ukur`, `umur_bulan`, `berat_badan`, `tinggi_badan`, `z_score_bbu`, `z_score_tbu`, `status_gizi`, `status_validasi`, `created_at`, `updated_at`) VALUES
	(1, 1, 1, '2026-05-02', 10, 9.50, 75.00, -0.40, -0.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(2, 1, 1, '2026-06-05', 11, 9.68, 75.90, -0.40, -0.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(3, 1, 1, '2026-07-02', 12, 9.86, 76.80, -0.40, -0.50, 'Normal', 'approved', '2026-07-16 09:20:20', '2026-07-19 11:30:16'),
	(4, 2, 2, '2026-05-02', 11, 10.00, 76.50, 0.30, 0.20, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(5, 2, 2, '2026-06-04', 12, 10.18, 77.40, 0.30, 0.20, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(6, 2, 2, '2026-07-06', 13, 10.36, 78.30, 0.30, 0.20, 'Normal', 'approved', '2026-07-16 09:20:20', '2026-07-19 20:00:47'),
	(7, 3, 3, '2026-05-03', 12, 10.50, 78.00, 1.10, 1.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(8, 3, 3, '2026-06-05', 13, 10.68, 78.90, 1.10, 1.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(9, 3, 3, '2026-07-04', 14, 10.86, 79.80, 1.10, 1.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(10, 4, 1, '2026-05-03', 13, 9.00, 74.00, -0.90, -1.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(11, 4, 1, '2026-06-04', 14, 9.18, 74.90, -0.90, -1.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(12, 4, 1, '2026-07-06', 15, 9.36, 75.80, -0.90, -1.00, 'Normal', 'approved', '2026-07-16 09:20:20', '2026-07-19 14:32:46'),
	(13, 5, 2, '2026-05-02', 14, 10.20, 77.00, 0.60, 0.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(14, 5, 2, '2026-06-03', 15, 10.38, 77.90, 0.60, 0.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(15, 5, 2, '2026-07-03', 16, 10.56, 78.80, 0.60, 0.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(16, 6, 3, '2026-05-02', 15, 9.20, 74.50, -0.70, -0.80, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(17, 6, 3, '2026-06-03', 16, 9.38, 75.40, -0.70, -0.80, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(18, 6, 3, '2026-07-04', 17, 9.56, 76.30, -0.70, -0.80, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(19, 7, 1, '2026-05-05', 16, 11.00, 79.00, 1.60, 1.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(20, 7, 1, '2026-06-05', 17, 11.18, 79.90, 1.60, 1.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(21, 7, 1, '2026-07-06', 18, 11.36, 80.80, 1.60, 1.50, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(22, 8, 2, '2026-05-03', 17, 9.80, 76.00, 0.10, 0.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(23, 8, 2, '2026-06-03', 18, 9.98, 76.90, 0.10, 0.00, 'Normal', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(24, 8, 2, '2026-07-06', 19, 10.16, 77.80, 0.10, 0.00, 'Normal', 'approved', '2026-07-16 09:20:20', '2026-07-19 20:00:35'),
	(25, 9, 3, '2026-05-04', 18, 8.50, 72.00, -1.70, -1.80, 'Risiko', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(26, 9, 3, '2026-06-05', 19, 8.62, 72.60, -1.70, -1.80, 'Risiko', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(27, 9, 3, '2026-07-04', 20, 8.74, 73.20, -1.70, -1.80, 'Risiko', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(28, 10, 1, '2026-05-03', 19, 8.30, 71.50, -1.80, -1.90, 'Risiko', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(29, 10, 1, '2026-06-05', 20, 8.42, 72.10, -1.80, -1.90, 'Risiko', 'pending', '2026-07-16 09:20:20', '2026-07-16 09:20:20'),
	(30, 10, 1, '2026-07-05', 21, 8.54, 72.70, -1.80, -1.90, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(31, 11, 2, '2026-05-06', 20, 8.70, 72.50, -1.50, -1.60, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(32, 11, 2, '2026-06-06', 21, 8.82, 73.10, -1.50, -1.60, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(33, 11, 2, '2026-07-05', 22, 8.94, 73.70, -1.50, -1.60, 'Risiko', 'rejected', '2026-07-16 09:20:21', '2026-07-19 13:31:40'),
	(34, 12, 3, '2026-05-03', 21, 8.60, 72.20, -1.60, -1.70, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(35, 12, 3, '2026-06-05', 22, 8.72, 72.80, -1.60, -1.70, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(36, 12, 3, '2026-07-02', 23, 8.84, 73.40, -1.60, -1.70, 'Risiko', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(37, 13, 1, '2026-05-03', 10, 7.50, 69.00, -2.40, -2.50, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(38, 13, 1, '2026-06-03', 11, 7.56, 69.30, -2.40, -2.50, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(39, 13, 1, '2026-07-04', 12, 7.62, 69.60, -2.40, -2.50, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(40, 14, 2, '2026-05-03', 11, 7.20, 68.00, -2.70, -2.80, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(41, 14, 2, '2026-06-03', 12, 7.26, 68.30, -2.70, -2.80, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(42, 14, 2, '2026-07-05', 13, 7.32, 68.60, -2.70, -2.80, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(43, 15, 3, '2026-05-06', 12, 6.80, 67.00, -3.00, -3.10, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(44, 15, 3, '2026-06-03', 13, 6.86, 67.30, -3.00, -3.10, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(45, 15, 3, '2026-07-06', 14, 6.92, 67.60, -3.00, -3.10, 'Stunting', 'pending', '2026-07-16 09:20:21', '2026-07-16 09:20:21'),
	(46, 17, 1, '2026-07-17', 21, 17.20, 92.20, 7.57, 7.09, 'Normal', 'approved', '2026-07-17 02:02:23', '2026-07-19 02:57:56'),
	(47, 18, 1, '2026-07-17', 1, 12.60, 80.20, 8.32, 10.46, 'Normal', 'approved', '2026-07-17 02:05:07', '2026-07-19 02:55:09'),
	(49, 20, 1, '2026-07-17', 3, 4.30, 67.10, 0.14, 4.20, 'Normal', 'approved', '2026-07-17 07:18:11', '2026-07-19 02:54:41'),
	(50, 21, 1, '2026-07-17', 3, 6.20, 12.30, -0.29, -21.35, 'Stunting', 'approved', '2026-07-17 07:32:10', '2026-07-19 11:18:31'),
	(51, 21, 1, '2026-07-17', 3, 12.50, 79.20, 8.71, 7.74, 'Normal', 'approved', '2026-07-17 07:32:30', '2026-07-19 02:04:25'),
	(52, 21, 1, '2026-07-17', 3, 11.40, 50.20, 7.14, -4.87, 'Stunting', 'approved', '2026-07-17 07:33:24', '2026-07-19 11:22:21'),
	(53, 9, 1, '2026-07-17', 20, 12.50, 87.90, 0.95, 1.22, 'Normal', 'approved', '2026-07-17 07:50:44', '2026-07-19 01:46:44'),
	(54, 22, 1, '2026-07-17', 28, 11.20, 70.10, -1.21, -5.56, 'Stunting', 'approved', '2026-07-17 08:06:22', '2026-07-19 02:58:39'),
	(55, 5, 1, '2026-07-17', 16, 10.20, 78.10, -0.24, -0.65, 'Normal', 'approved', '2026-07-17 08:42:10', '2026-07-19 02:02:32'),
	(56, 5, 1, '2026-07-17', 16, 7.20, 51.20, -2.88, -9.42, 'Stunting', 'approved', '2026-07-17 08:42:26', '2026-07-20 06:46:41'),
	(59, 11, 1, '2026-07-18', 22, 10.00, 78.00, -1.39, -2.25, 'Stunting', 'approved', '2026-07-18 07:18:48', '2026-07-19 19:59:18'),
	(60, 11, 1, '2026-07-18', 22, 17.00, 79.00, 4.13, -1.95, 'Risiko', 'approved', '2026-07-18 07:19:19', '2026-07-19 19:42:52'),
	(61, 11, 1, '2026-07-18', 22, 25.00, 90.00, 10.45, 1.35, 'Normal', 'approved', '2026-07-18 07:19:38', '2026-07-19 01:45:31'),
	(62, 24, 1, '2026-07-19', 8, 45.00, 75.00, 40.44, 1.69, 'Normal', 'approved', '2026-07-19 12:46:55', '2026-07-19 12:47:54'),
	(63, 25, 1, '2026-07-19', 18, 70.00, 90.00, 65.92, 11.78, 'Normal', 'approved', '2026-07-19 13:55:42', '2026-07-19 13:58:42');

-- Dumping structure for table laravel.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table laravel.posyandus
CREATE TABLE IF NOT EXISTS `posyandus` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `puskesmas_id` bigint unsigned NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desa_kelurahan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posyandus_puskesmas_id_foreign` (`puskesmas_id`),
  CONSTRAINT `posyandus_puskesmas_id_foreign` FOREIGN KEY (`puskesmas_id`) REFERENCES `puskesmas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.posyandus: ~2 rows (approximately)
INSERT INTO `posyandus` (`id`, `puskesmas_id`, `nama`, `desa_kelurahan`, `alamat`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Posyandu Mawar', 'Desa Makmur', 'Balai Desa Makmur', '2026-07-16 09:20:16', '2026-07-16 09:20:16'),
	(2, 1, 'Posyandu Melati', 'Desa Sejahtera', 'Balai Desa Sejahtera', '2026-07-16 09:20:16', '2026-07-16 09:20:16');

-- Dumping structure for table laravel.puskesmas
CREATE TABLE IF NOT EXISTS `puskesmas` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned DEFAULT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_faskes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `puskesmas_kode_faskes_unique` (`kode_faskes`),
  KEY `puskesmas_user_id_foreign` (`user_id`),
  CONSTRAINT `puskesmas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.puskesmas: ~1 rows (approximately)
INSERT INTO `puskesmas` (`id`, `user_id`, `nama`, `kode_faskes`, `alamat`, `created_at`, `updated_at`) VALUES
	(1, 1, 'Puskesmas Kecamatan Kuta Alam', 'PKS-001', 'Jl. Kesehatan No. 1, Kota Sehat SPBU', '2026-07-16 09:20:16', '2026-07-18 22:26:23');

-- Dumping structure for table laravel.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('puskesmas','kader','ibu') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ibu',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table laravel.users: ~23 rows (approximately)
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
	(1, 'Admin Puskesmas gaming', 'puskesmas@nutrigen.com', NULL, '$2y$12$5cgmJX1NeUdMaXoU6.ByMuyp2snMNVIZVP0UIbfsfmMr3MuaBrseC', 'puskesmas', NULL, '2026-07-16 09:20:16', '2026-07-18 22:31:14', NULL),
	(2, 'Naufal Alif', 'kader1@nutrigen.com', NULL, '$2y$12$xlFGZvWzQ6JcLXB2yZp3guVCt3mB/qVvb5D1Tjqo0wD/Rx6LAaNt.', 'kader', NULL, '2026-07-16 09:20:16', '2026-07-18 04:49:40', NULL),
	(3, 'Kader Mawar 2', 'kader2@nutrigen.com', NULL, '$2y$12$5/.7iQpBAaO87NuReXWSY.PR8mLLgET.AGU0danmoyd/L1UtHEHLW', 'kader', NULL, '2026-07-16 09:20:17', '2026-07-16 09:20:17', NULL),
	(4, 'Kader Melati 1', 'kader3@nutrigen.com', NULL, '$2y$12$YpDrsvSegXioRP.2ppqCn.TkQLebuqDzhWLNTT/rEz5.ec9qCoPSq', 'kader', NULL, '2026-07-16 09:20:17', '2026-07-16 09:20:17', NULL),
	(5, 'Ibu Budi 1 Gaming', 'ibu1@nutrigen.com', NULL, '$2y$12$KSISr9YRcepJ1gVD9esrTu6HuzxTUmJNAow3AaLx.LQ1xl4Hn5IPe', 'ibu', NULL, '2026-07-16 09:20:17', '2026-07-17 02:18:35', NULL),
	(6, 'Ibu Budi 2', 'ibu2@nutrigen.com', NULL, '$2y$12$r/6V/rcoveMQlqr01DJGneLlpxCmuMlOXpPUD/Jmbry4FzgfATUyG', 'ibu', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18', NULL),
	(7, 'Ibu Budi 3', 'ibu3@nutrigen.com', NULL, '$2y$12$rH7eTTumI6mQHLgnzWX7MOec3jr63Diom7UQLa3VPOJ.CzxqUsDOi', 'ibu', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18', NULL),
	(8, 'Ibu Budi 4', 'ibu4@nutrigen.com', NULL, '$2y$12$4huO9Tq6YdU3Cim.4LW60uMtYCOJH7cPCa01Z9wMptCI//hKE6v1S', 'ibu', NULL, '2026-07-16 09:20:18', '2026-07-16 09:20:18', NULL),
	(9, 'Ibu Budi 5', 'ibu5@nutrigen.com', NULL, '$2y$12$q3HD2mIk4zlGYvYs2VSZJu0RMf9G3lY05UhHD8Xiox8FrH0sgTTP2', 'ibu', NULL, '2026-07-16 09:20:19', '2026-07-16 09:20:19', NULL),
	(10, 'Ibu Budi 6', 'ibu6@nutrigen.com', NULL, '$2y$12$7EfC/v1f74gyjsIM.FWubOiquPVr1Vk4x.1iAXey2plwReh5aVtr2', 'ibu', NULL, '2026-07-16 09:20:19', '2026-07-16 09:20:19', NULL),
	(11, 'Ibu Budi 7', 'ibu7@nutrigen.com', NULL, '$2y$12$IKjTb.FER7CqVoDJgoEbAetDsjCYJJnrHmpySBkTOl8g7pV4QNNsC', 'ibu', NULL, '2026-07-16 09:20:19', '2026-07-16 09:20:19', NULL),
	(12, 'Ibu Budi 8', 'ibu8@nutrigen.com', NULL, '$2y$12$9KJcB76Ab/yz2WiYGHAXouRfcIr87wHIyoaFg.Fd04cA/2wyqkU4C', 'ibu', NULL, '2026-07-16 09:20:20', '2026-07-16 09:20:20', NULL),
	(13, 'Ibu Budi 9', 'ibu9@nutrigen.com', NULL, '$2y$12$e6eIhATVC2itEdrNtZZq4uxCxg5xUQkHHT2CpEjuXD3SSwcncf3XC', 'ibu', NULL, '2026-07-16 09:20:20', '2026-07-16 09:20:20', NULL),
	(14, 'Ibu Budi 10', 'ibu10@nutrigen.com', NULL, '$2y$12$BgfHaNu0NDp.s6.NH1f5TeHVBIYdyKuZf9v5F5uqc3q.V3iJmlT1K', 'ibu', NULL, '2026-07-16 09:20:20', '2026-07-16 09:20:20', NULL),
	(15, 'nurhasanah', '085234664133@nutrigen.com', NULL, '$2y$12$wJ8dBomdBd3T57VeiuSCC.umKq7Febq6hkiRcohC9u2nP9lLBTNKO', 'ibu', NULL, '2026-07-17 00:51:14', '2026-07-17 00:51:14', NULL),
	(16, 'Ellana', '085234664130@nutrigen.com', NULL, '$2y$12$zu0QbvccAAgyhdMb5ZVnFOpKZHCwq6MH1LAyMpyM2bfYNMvIYQS.S', 'ibu', NULL, '2026-07-17 01:29:06', '2026-07-17 02:56:49', NULL),
	(17, 'masyitah', '09292827262725@nutrigen.com', NULL, '$2y$12$gN1e18L/F4oxY2bVpIvxpu1oX7gl1rHmjIl3SpHQ6yucuSpHaiYpK', 'ibu', NULL, '2026-07-17 02:04:02', '2026-07-17 02:04:02', NULL),
	(18, 'maryati', '098782627352@nutrigen.com', NULL, '$2y$12$lzLHFlTmYB1Lf1tpvURmi.UMXDBl8YU3OTL5PfdB/dR3V6LN.qaJG', 'ibu', NULL, '2026-07-17 06:56:34', '2026-07-17 08:39:05', '2026-07-17 08:39:05'),
	(19, 'Azzahra', '098765345678@nutrigen.com', NULL, '$2y$12$n/xwl3b5XXDx4avsyLblB.Ej1ALiLK2fZkOrJUrOAOYS9jNtPHUTq', 'ibu', NULL, '2026-07-17 07:17:01', '2026-07-17 07:17:01', NULL),
	(20, 'musdhalifah', '09897875626756376@nutrigen.com', NULL, '$2y$12$yjkgNXDx.L3dhjMGS94wJeO8moaojlTODMyIrV8s38iuFzTadJPKO', 'ibu', NULL, '2026-07-17 07:30:40', '2026-07-17 07:30:40', NULL),
	(21, 'mariana', '987977898678@nutrigen.com', NULL, '$2y$12$oEaGZOVg6i6ar.l6YFfRQ.AMnv3UCwBpTxoU9zOA2r1x4IgeO9t6e', 'ibu', NULL, '2026-07-17 08:05:13', '2026-07-17 08:05:13', NULL),
	(22, 'AIsyah', '0851614263@nutrigen.com', NULL, '$2y$12$MXWBN30UCSGRSih8E.KBO.RmIrG4LqvKqU1uzrIwvIP8E845OJQUe', 'ibu', NULL, '2026-07-18 07:09:43', '2026-07-18 07:11:11', '2026-07-18 07:11:11'),
	(23, 'nulaila', '09876789286@nutrigen.com', NULL, '$2y$12$ASt.Ctm8Yt7iZUQhynWIeei5jLEo6KX48fTMPGyPjA1ju3zbWQrmG', 'ibu', NULL, '2026-07-19 13:54:54', '2026-07-19 13:54:54', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
