-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2019 at 09:23 AM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `xorpin`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `text_comment` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `positive_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `negative_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text_comment`, `positive_product`, `negative_product`, `display`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(2, 'second comment on the product 1', 'good screen', 'touch is bad.', 1, 2, 1, '2019-07-09 22:00:00', NULL),
(3, 'second comment on the product 2', 'good screen', 'touch is bad.', 1, 3, 2, '2019-07-09 22:00:00', NULL),
(4, 'second comment on the product 3', 'good screen', 'touch is bad.', 1, 4, 1, '2019-07-09 22:00:00', NULL),
(5, 'second comment on the product 3', 'good screen', 'touch is bad.', 1, 5, 1, '2019-07-09 22:00:00', NULL),
(6, 'first comment on the product 2....', 'good screen....', 'touch is bad.....', 0, 6, 1, '2019-07-08 22:00:00', '2019-07-16 06:11:30');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `face_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tw_link` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `count_rates` tinyint(4) DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`, `description`, `email`, `phone`, `website`, `address`, `longitude`, `latitude`, `face_link`, `tw_link`, `display`, `active`, `count_rates`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'company 1', 'images/companies-logo/1564027068-company1-company-logo.png', 'about company 1 about company 1 about company 1 about company 1', 'company1@gmail.com', '011469141151', NULL, 'egypt, cairo', '31.19632340314945', '30.04681526366848', NULL, NULL, 1, 1, 70, 1, NULL, '2019-07-16 05:20:50', '2019-07-25 04:47:48'),
(2, 'company 2', 'images/companies-logo/1564026616-company2-company-logo.jpg', 'about company 1 about company 1 about company 1 about company 1', 'company2@gmail.com', '02510515610265', NULL, 'egypt, cairo', '30.86099625471195', '29.23937776608231', NULL, NULL, 1, 1, 70, 1, NULL, '2019-07-16 05:20:50', '2019-07-25 04:18:36'),
(3, 'company 3', 'images/companies-logo/company-default-avatar.jpg', 'about company 1 about company 1 about company 1 about company 1', 'company3@gmail.com', '058181484484', NULL, 'egypt, cairo', '30.86099625471195', '29.23937776608231', NULL, NULL, 1, 1, 45, 1, NULL, '2019-07-16 05:20:50', '2019-07-25 04:47:28');

-- --------------------------------------------------------

--
-- Table structure for table `companies_rates`
--

CREATE TABLE `companies_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies_rates`
--

INSERT INTO `companies_rates` (`id`, `rate`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 3, 1, 1, NULL, NULL),
(2, 4, 2, 1, NULL, NULL),
(3, 2, 3, 1, NULL, NULL),
(4, 5, 4, 1, NULL, NULL),
(5, 5, 5, 1, NULL, NULL),
(6, 3, 1, 2, NULL, NULL),
(7, 4, 2, 2, NULL, NULL),
(8, 2, 3, 2, NULL, NULL),
(9, 5, 4, 2, NULL, NULL),
(10, 5, 5, 3, NULL, NULL),
(11, 2, 3, 3, NULL, NULL),
(12, 5, 4, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_07_06_151257_create_products_table', 1),
(4, '2019_07_06_151358_create_companies_table', 1),
(5, '2019_07_06_151431_create_company_users_table', 1),
(6, '2019_07_06_151459_create_companies_rates_table', 1),
(7, '2019_07_06_151552_create_users_rates_table', 1),
(8, '2019_07_06_151611_create_winners_table', 1),
(9, '2019_07_06_151633_create_product_types_table', 1),
(10, '2019_07_06_151653_create_product_details_table', 1),
(12, '2019_07_06_151729_create_comments_table', 1),
(13, '2019_07_06_151739_create_settings_table', 1),
(14, '2016_06_01_000001_create_oauth_auth_codes_table', 2),
(15, '2016_06_01_000002_create_oauth_access_tokens_table', 2),
(16, '2016_06_01_000003_create_oauth_refresh_tokens_table', 2),
(17, '2016_06_01_000004_create_oauth_clients_table', 2),
(18, '2016_06_01_000005_create_oauth_personal_access_clients_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8mb4_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('62d15465ce3d8a9c6f0e32ba6f31f08e336b7e85faf3cb9db36ab6e5d190daf0b96799ddf84d123c', 1, 2, NULL, '[]', 0, '2019-07-25 06:55:20', '2019-07-25 06:55:20', '2019-08-04 08:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
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
(1, NULL, 'Xorpin Personal Access Client', 'evQXtXUxKPpfYVPVnFeENpaaAM9MfujGFXIxExeT', 'http://localhost', 1, 0, 0, '2019-07-25 06:15:16', '2019-07-25 06:15:16'),
(2, NULL, 'Xorpin Password Grant Client', 'oU1c3pC4YEqhnsfdvEHQcXYFZgVcHtM1PIMxGk4k', 'http://localhost', 0, 1, 0, '2019-07-25 06:15:16', '2019-07-25 06:15:16');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

CREATE TABLE `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2019-07-25 06:15:16', '2019-07-25 06:15:16');

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

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('af6e6dabc07842158430e585b2fcafc15f02946dae9d9dcf21987ee1a2c6d0d9cf60774c7e3fb65d', '62d15465ce3d8a9c6f0e32ba6f31f08e336b7e85faf3cb9db36ab6e5d190daf0b96799ddf84d123c', 0, '2019-08-24 08:55:20');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery` text COLLATE utf8mb4_unicode_ci,
  `price` int(11) NOT NULL,
  `discount` int(11) DEFAULT NULL,
  `percent` tinyint(1) NOT NULL DEFAULT '1',
  `new_price` int(11) DEFAULT NULL,
  `description` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `manufacture_company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_count` int(11) NOT NULL,
  `execute` tinyint(1) NOT NULL DEFAULT '0',
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `count_rates` tinyint(4) DEFAULT '0',
  `type_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `company_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `gallery`, `price`, `discount`, `percent`, `new_price`, `description`, `manufacture_company`, `product_count`, `execute`, `display`, `count_rates`, `type_id`, `user_id`, `company_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Dell insprion 5558', 'images/products/product-5d2d5fcd45f46/product-default-image-5d2d5fcd464b2.jpg', 'images/products/product-5d2d5fcd45f46/product-image-5d2d5fcd94d1f.png,images/products/product-5d2d5fcd45f46/product-image-5d2d5fcda17c5.jpg,images/products/product-5d2d5fcd45f46/product-image-5d2d5fcdab172.jpg', 9497, NULL, 1, NULL, 'description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop', 'Dell', 30, 0, 1, 84, 1, 1, 1, NULL, '2019-07-16 05:25:33', '2019-07-22 07:22:24'),
(2, 'Dell insprion 200', 'images/products/product-5d2d5fcd45f46/product-default-image-5d2d5fcd464b2.jpg', 'images/products/product-5d2d5fcd45f46/product-image-5d2d5fcd94d1f.png,images/products/product-5d2d5fcd45f46/product-image-5d2d5fcda17c5.jpg,images/products/product-5d2d5fcd45f46/product-image-5d2d5fcdab172.jpg', 2000, NULL, 1, NULL, 'description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop description labtop', 'Dell', 30, 0, 1, 30, 2, 1, 2, NULL, '2019-07-16 05:25:33', '2019-07-22 07:28:15'),
(3, 'product 1 comp 1', 'images/products/product-5d30f32089419/product-default-image-5d30f32089685.jpg', 'images/products/product-5d30f32089419/product-image-5d30f320adafb.jpg,images/products/product-5d30f32089419/product-image-5d30f320c7edf.jpg,images/products/product-5d30f32089419/product-image-5d30f320e6d13.jpg', 3000, NULL, 1, NULL, '515a1s5d1as51dsa51d1', 'dell', 120, 0, 1, 20, 1, 20, 1, NULL, '2019-07-18 22:30:57', '2019-07-19 21:43:51'),
(4, 'laptop 2', 'images/products/product-5d30f5e5c169e/product-default-image-5d30f5e5c1770.jpg', 'images/products/product-5d30f5e5c169e/product-image-5d365bb9f032d.jpg,images/products/product-5d30f5e5c169e/product-image-5d365bba3910c.jpg,images/products/product-5d30f5e5c169e/product-image-5d365aff48227.jpg,images/products/product-5d30f5e5c169e/product-image-5d365b0021f2e.jpg,images/products/product-5d30f5e5c169e/product-image-5d30f68c44cd4.jpg', 6000, 20, 1, 4800, 'asdasd', 'dell', 20, 0, 1, 0, 2, 3, 1, NULL, '2019-07-18 22:42:46', '2019-07-23 00:58:35'),
(5, 'منتج 1', 'images/products/product-5d369a8c613d4/product-default-image-5d369a8c61a4b.jpg', 'images/products/product-5d369a8c613d4/product-image-5d369a8c7ce68.jpg,images/products/product-5d369a8c613d4/product-image-5d369a8c8f466.jpg,images/products/product-5d369a8c613d4/product-image-5d369a8cba62e.jpg', 5000, 20, 1, 4000, 'اى وصف اى وصف اى وصف اى وصف اى وصف اى وصف اى وصف اى وصف اى وصف', 'اى شركة', 200, 0, 1, 30, 4, 3, 1, NULL, '2019-07-23 05:26:36', '2019-07-23 05:26:36'),
(6, 'لاب 1 جديد', 'images/products/product-5d392b441e12f/product-default-image-5d392b441e30d.jpg', 'images/products/product-5d392b441e12f/product-image-5d392b4438744.jpg,images/products/product-5d392b441e12f/product-image-5d392b4452a91.jpg,images/products/product-5d392b441e12f/product-image-5d392b4461a06.jpg', 14000, 5, 1, 13300, 'asd asd asd asd asd asd', 'dell', 20, 0, 1, 0, 6, 1, 2, NULL, '2019-07-25 04:08:36', '2019-07-25 04:08:36'),
(7, 'لاب 2 جديد', 'images/products/product-5d392d90d1ec7/product-default-image-5d392d90d20f7.jpg', 'images/products/product-5d392d90d1ec7/product-image-5d392d90f19a1.jpg,images/products/product-5d392d90d1ec7/product-image-5d392d910f081.jpg,images/products/product-5d392d90d1ec7/product-image-5d392d912605a.jpg', 12300, 10, 1, 11070, 'dell asdasd', 'dell', 5, 0, 1, 20, 6, 1, 3, NULL, '2019-07-25 04:18:25', '2019-07-25 04:18:25'),
(8, 'لاب 1 مستعمل', 'images/products/product-5d392e785b03f/product-default-image-5d392e785b1f0.jpg', NULL, 4000, NULL, 1, NULL, 'asd asd asd asd asd', 'hp', 30, 0, 1, 10, 7, 1, 2, NULL, '2019-07-25 04:22:16', '2019-07-25 04:22:16'),
(9, 'لاب 2 مستعمل', 'images/products/product-5d392ec100e34/product-default-image-5d392ec100f57.jpg', NULL, 3000, NULL, 1, NULL, 'dasd ad asd as', 'lenovo', 21, 0, 1, 0, 7, 1, 3, NULL, '2019-07-25 04:23:29', '2019-07-25 04:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `products_rates`
--

CREATE TABLE `products_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `rate` tinyint(4) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products_rates`
--

INSERT INTO `products_rates` (`id`, `rate`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 4, 5, 4, NULL, NULL),
(2, 3, 3, 4, NULL, NULL),
(3, 3, 1, 4, NULL, NULL),
(4, 5, 2, 4, NULL, NULL),
(5, 4, 4, 4, NULL, NULL),
(6, 2, 6, 4, NULL, NULL),
(7, 4, 1, 1, NULL, NULL),
(8, 3, 2, 1, NULL, NULL),
(9, 4, 3, 1, NULL, NULL),
(10, 5, 4, 1, NULL, NULL),
(11, 5, 5, 1, NULL, NULL),
(12, 2, 6, 1, NULL, NULL),
(13, 5, 7, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `product_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `name`, `value`, `display`, `product_id`, `user_id`, `created_at`, `updated_at`) VALUES
(56, 'ram', '16GB', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(57, 'Hard SSD', '120GB', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(58, 'Hard HDD', '1TB', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(59, 'VGA', '2GB Nividia', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(60, 'Blutooth', 'yes', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(61, 'battery', '3000 ml', 1, 1, 1, '2019-07-16 05:25:33', '2019-07-16 05:25:33'),
(62, 'product 1', 'opppp', 1, 3, 1, '2019-07-18 22:30:57', '2019-07-19 21:29:55'),
(63, 'asdasd', 'asd sa d', 1, 3, 1, '2019-07-18 22:30:57', '2019-07-19 21:29:55'),
(64, 'wrase', 'asease', 1, 3, 1, '2019-07-18 22:30:57', '2019-07-19 21:29:55'),
(65, 'asd', 'asda', 1, 4, 1, '2019-07-18 22:42:46', '2019-07-23 00:55:27'),
(66, '1', '1', 1, 5, 3, '2019-07-23 05:26:36', '2019-07-23 05:26:36'),
(67, '2', '2', 1, 5, 3, '2019-07-23 05:26:36', '2019-07-23 05:26:36'),
(68, '3', '3', 1, 5, 3, '2019-07-23 05:26:36', '2019-07-23 05:26:36'),
(69, 'تفاصبل 1', 'تفاصيل 2', 1, 6, 1, '2019-07-25 04:08:36', '2019-07-25 04:08:36'),
(70, 'تفاصبل 1', 'تفاصيل 2', 1, 6, 1, '2019-07-25 04:08:36', '2019-07-25 04:08:36'),
(71, 'adsasd', 'asdsad', 1, 7, 1, '2019-07-25 04:18:25', '2019-07-25 04:18:25');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display` tinyint(1) NOT NULL DEFAULT '1',
  `user_id` int(10) UNSIGNED NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `display`, `user_id`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'labtop', 1, 1, NULL, '2015-09-12 02:08:03', '2019-07-25 04:32:23'),
(2, 'mobile', 1, 1, NULL, '2018-09-11 07:27:24', '2019-07-18 23:28:28'),
(3, 'mathoer-board', 1, 1, NULL, '2019-06-21 10:17:27', NULL),
(4, 'mouse', 1, 1, NULL, '2019-07-11 12:31:28', '2019-07-12 04:08:56'),
(5, 'keyboard', 0, 1, NULL, '2019-07-11 16:40:38', '2019-07-25 04:50:17'),
(6, 'لابات جديدة', 1, 1, NULL, '2019-07-25 04:07:13', '2019-07-25 04:07:13'),
(7, 'لابات مستعملة', 1, 1, NULL, '2019-07-25 04:07:22', '2019-07-25 04:07:22');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `name`, `value`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'اسم الموقع', 'site_name', 'Xorpin', 'string', 1, '2019-07-20 06:52:48', '2019-07-20 06:52:48'),
(2, 'شعار الموقع', 'logo', 'images/settings/setting-image-5d3696c9cd977-logo.png', 'image', 1, '2019-07-20 06:52:18', '2019-07-23 05:21:05'),
(3, 'صور الصفحة الرئيسية', 'carousel', 'images/carousel/carousel-image-5d368f29d1826.jpg,images/carousel/carousel-image-5d368f29e275e.jpg', 'text', 1, '2019-07-22 21:59:30', '2019-07-23 04:38:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `rule` tinyint(1) NOT NULL DEFAULT '0',
  `lang` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ar',
  `company_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `photo`, `active`, `rule`, `lang`, `company_id`, `remember_token`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '01146908152', 'Egypt, cairo', 'images/user-avatar/1562826331-admin-avatar.jpg', 1, 1, 'ar', NULL, 'FP65a0xgRYCZByOtbMaCa5hZ6qiJHMFU6dJbNhu9Qwrt878DYOIWcVGpWamx', NULL, '2019-07-07 14:10:12', '2019-07-12 20:28:11'),
(2, 'Admin 2', 'admin2@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010654664464', 'Egypt, cairo', 'images/user-avatar/default-avatar.png', 0, 1, 'ar', NULL, 'l7pdlUZxmNXLM5URQg53MG8nH3FXF0IZrLGFlscgfPHFtsKgg4lGTbUdKWr2', NULL, '2019-07-07 08:10:01', '2019-07-05 22:00:00'),
(3, 'Admin Comoany 1', 'admin.c.1@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '0106546645', 'Egypt, cairo', 'images/user-avatar/1563490094-admin comoany 1-avatar.jpg', 1, 2, 'ar', 1, '8II6C4qs2MbIfNFHUew2dECsSh4UrxOSA8maKsvNqWZvAk8SFGBMlfKLaph0', NULL, '2019-07-01 01:05:02', '2019-07-18 22:48:15'),
(4, 'Admin Comoany 2', 'admin.c.2@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010654664511', 'Egypt, cairo', 'images/user-avatar/1562964024-admin comoany 2-avatar.jpg', 1, 2, 'ar', 1, 'W6GDjXOTLuDc9Aqt0wmkytSnY9qwibLcILe1AlFcKbEXggMxWwEaMHTJqLwb', NULL, '2019-07-01 00:10:20', '2019-07-12 20:41:09'),
(5, 'Normal user 1', 'user@user.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010635345343', 'Egypt, cairo', 'images/user-avatar/default-avatar.png', 1, 0, 'ar', NULL, 'vVFJhvpNNhBnccllxuZTJQFW6NVWOZFD4v3O9NH33O3qSm2WyWYLmUyRzZ7W', NULL, '2019-07-02 05:19:19', '2019-07-22 07:28:23'),
(6, 'Normal user 2', 'user2@user.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010635345374', 'Egypt, cairo', 'images/user-avatar/1563697045-normal user 2-avatar.jpg', 0, 0, 'ar', NULL, NULL, NULL, '2019-07-03 03:19:11', '2019-07-22 07:28:21'),
(7, 'new user test', 'test@test.test', NULL, '$2y$10$vbfvnaIlqygYjEPDhbmm3eqeMsF09mn5YTzDlQqQ9dNlMjevrxvM.', '015151515100', NULL, 'images/user-avatar/1563464113-new user test-avatar.jpg', 1, 2, 'ar', 1, NULL, NULL, '2019-07-18 15:35:13', '2019-07-21 16:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `winners`
--

CREATE TABLE `winners` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(7, 3, 1, '2019-07-16 06:29:16', '2019-07-16 06:29:16'),
(9, 4, 2, '2019-07-17 16:30:53', '2019-07-17 16:30:53'),
(10, 2, 1, '2019-07-18 16:52:08', '2019-07-22 07:28:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_email_unique` (`email`),
  ADD UNIQUE KEY `companies_phone_unique` (`phone`);

--
-- Indexes for table `companies_rates`
--
ALTER TABLE `companies_rates`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products_rates`
--
ALTER TABLE `products_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- Indexes for table `winners`
--
ALTER TABLE `winners`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies_rates`
--
ALTER TABLE `companies_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products_rates`
--
ALTER TABLE `products_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `winners`
--
ALTER TABLE `winners`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
