-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table atomicpocket.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.categories: ~1 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `description`, `status_id`, `created_at`, `updated_at`) VALUES
	(1, 'Pengeluaran something', 'Kategori pengeluaran', 1, '2021-11-04 13:43:32', '2021-11-04 13:45:27');
INSERT INTO `categories` (`id`, `name`, `description`, `status_id`, `created_at`, `updated_at`) VALUES
	(2, 'Pemasukan something', 'Deskripsi pemasukan', 1, '2021-11-04 18:24:30', '2021-11-04 18:24:30');
INSERT INTO `categories` (`id`, `name`, `description`, `status_id`, `created_at`, `updated_at`) VALUES
	(3, 'Gaji Bulanan', 'pemasukan', 1, '2021-11-05 03:58:16', '2021-11-05 03:58:16');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.category_statuses
CREATE TABLE IF NOT EXISTS `category_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.category_statuses: ~2 rows (approximately)
DELETE FROM `category_statuses`;
/*!40000 ALTER TABLE `category_statuses` DISABLE KEYS */;
INSERT INTO `category_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Aktif', '2021-11-04 20:42:28', '2021-11-04 20:42:30');
INSERT INTO `category_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(2, 'Tidak Aktif', '2021-11-04 20:42:28', '2021-11-04 20:42:29');
/*!40000 ALTER TABLE `category_statuses` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.failed_jobs: ~0 rows (approximately)
DELETE FROM `failed_jobs`;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.migrations: ~10 rows (approximately)
DELETE FROM `migrations`;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(15, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(16, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(17, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(18, '2019_12_14_000001_create_personal_access_tokens_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(19, '2021_11_04_062141_create_wallets_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(20, '2021_11_04_062222_create_wallet_statuses_table', 1);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(21, '2021_11_04_131935_create_categories_table', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(22, '2021_11_04_132208_create_category_status', 2);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(23, '2021_11_04_135713_create_transactions_table', 3);
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(24, '2021_11_04_135802_create_transaction_statuses_table', 4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.password_resets: ~0 rows (approximately)
DELETE FROM `password_resets`;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.personal_access_tokens: ~0 rows (approximately)
DELETE FROM `personal_access_tokens`;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.transactions
CREATE TABLE IF NOT EXISTS `transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `transaction_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `transaction_date` date NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `wallet_id` int(10) unsigned NOT NULL,
  `category_id` int(10) unsigned NOT NULL,
  `status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.transactions: ~0 rows (approximately)
DELETE FROM `transactions`;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
INSERT INTO `transactions` (`id`, `transaction_code`, `description`, `transaction_date`, `amount`, `wallet_id`, `category_id`, `status_id`, `created_at`, `updated_at`) VALUES
	(1, 'WIN000001', 'contoh', '2021-11-04', '2000000', 1, 2, 1, '2021-11-04 16:28:30', '2021-11-04 16:28:30');
INSERT INTO `transactions` (`id`, `transaction_code`, `description`, `transaction_date`, `amount`, `wallet_id`, `category_id`, `status_id`, `created_at`, `updated_at`) VALUES
	(2, 'WOUT000002', 'asdasdasd', '2021-11-04', '12000', 2, 1, 2, '2021-11-04 16:40:13', '2021-11-04 16:40:13');
INSERT INTO `transactions` (`id`, `transaction_code`, `description`, `transaction_date`, `amount`, `wallet_id`, `category_id`, `status_id`, `created_at`, `updated_at`) VALUES
	(3, 'WIN000003', 'TF temen', '2021-11-04', '50000', 2, 2, 1, '2021-11-04 18:25:40', '2021-11-04 18:25:40');
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.transaction_statuses
CREATE TABLE IF NOT EXISTS `transaction_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.transaction_statuses: ~2 rows (approximately)
DELETE FROM `transaction_statuses`;
/*!40000 ALTER TABLE `transaction_statuses` DISABLE KEYS */;
INSERT INTO `transaction_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Masuk', '2021-11-04 21:11:47', '2021-11-04 21:11:48');
INSERT INTO `transaction_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(2, 'Keluar', '2021-11-04 21:11:46', '2021-11-04 21:11:48');
/*!40000 ALTER TABLE `transaction_statuses` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.users: ~0 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.wallets
CREATE TABLE IF NOT EXISTS `wallets` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `wallet_status_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.wallets: ~2 rows (approximately)
DELETE FROM `wallets`;
/*!40000 ALTER TABLE `wallets` DISABLE KEYS */;
INSERT INTO `wallets` (`id`, `name`, `reference`, `description`, `wallet_status_id`, `created_at`, `updated_at`) VALUES
	(1, 'Dompet Tabungan', '123123123', 'Bank Mandiri', 1, '2021-11-04 10:09:53', '2021-11-04 18:24:43');
INSERT INTO `wallets` (`id`, `name`, `reference`, `description`, `wallet_status_id`, `created_at`, `updated_at`) VALUES
	(2, 'Dompet Digital', '11111111111', 'Bank OVO', 1, '2021-11-04 10:24:32', '2021-11-04 12:54:10');
/*!40000 ALTER TABLE `wallets` ENABLE KEYS */;

-- Dumping structure for table atomicpocket.wallet_statuses
CREATE TABLE IF NOT EXISTS `wallet_statuses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table atomicpocket.wallet_statuses: ~2 rows (approximately)
DELETE FROM `wallet_statuses`;
/*!40000 ALTER TABLE `wallet_statuses` DISABLE KEYS */;
INSERT INTO `wallet_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(1, 'Aktif', '2021-11-04 14:38:54', '2021-11-04 14:38:55');
INSERT INTO `wallet_statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
	(2, 'Tidak Aktif', '2021-11-04 14:39:02', '2021-11-04 14:39:03');
/*!40000 ALTER TABLE `wallet_statuses` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
