-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2019 at 07:08 AM
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

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text_comment`, `positive_product`, `negative_product`, `display`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 'first comment on the product 1', 'good screen', 'touch is bad.', 1, 5, 1, NULL, NULL),
(2, 'second comment on the product 1', 'good screen', 'touch is bad.', 1, 6, 1, NULL, NULL),
(3, 'second comment on the product 2', 'good screen', 'touch is bad.', 1, 4, 2, NULL, NULL),
(4, 'second comment on the product 3', 'good screen', 'touch is bad.', 1, 4, 3, NULL, NULL),
(5, 'second comment on the product 3', 'good screen', 'touch is bad.', 1, 1, 3, NULL, NULL),
(6, 'first comment on the product 2', 'good screen', 'touch is bad.', 1, 5, 2, NULL, NULL);

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `logo`, `description`, `email`, `phone`, `website`, `address`, `longitude`, `latitude`, `face_link`, `tw_link`, `display`, `active`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Software and hardware', 'images/products/product_1/photo-1.jpg', 'description company 1', 'soft@gmail.info', '011118184151', 'http://company1.com', 'egypt, giza', '29.41848484841854854', '31.8418415148548484', 'http://facebook.com/company1', 'http://twitter.com/company1', 1, 1, 1, NULL, NULL),
(3, 'Software and hardware 2', 'images/products/product_1/photo-2.jpg', 'description company 2', 'soft2@gmail.info', '011162630000', 'http://company2.com', 'egypt, giza', '30.41848484841854854', '29.8418415148548484', 'http://facebook.com/company2', 'http://twitter.com/company2', 1, 1, 1, NULL, NULL);

--
-- Dumping data for table `companies_rates`
--

INSERT INTO `companies_rates` (`id`, `rate`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, 1, NULL, NULL),
(2, 4, 2, 1, NULL, NULL),
(3, 4, 3, 1, NULL, NULL),
(4, 1, 4, 1, NULL, NULL),
(5, 3, 1, 2, NULL, NULL),
(6, 3, 2, 2, NULL, NULL),
(7, 4, 3, 2, NULL, NULL),
(8, 2, 4, 2, NULL, NULL),
(9, 5, 5, 2, NULL, NULL);

--
-- Dumping data for table `company_users`
--

INSERT INTO `company_users` (`id`, `rule`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 1, NULL, NULL),
(2, 1, 4, 2, NULL, NULL);

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
(11, '2019_07_06_151707_create_product_details_rel_table', 1),
(12, '2019_07_06_151729_create_comments_table', 1),
(13, '2019_07_06_151739_create_settings_table', 1);

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `photo`, `gallery`, `price`, `discount`, `old_price`, `new_price`, `description`, `manufacture_company`, `product_count`, `execute`, `display`, `type_id`, `user_id`, `company_id`, `created_at`, `updated_at`) VALUES
(1, 'labtop 1', 'images/products/product_1/photo-1.jpg', 'images/products/product_1/photo-1.jpg,\r\nimages/products/product_1/photo-2.jpg,\r\nimages/products/product_1/photo-3.jpg,\r\nimages/products/product_1/photo-4.jpg', 5000, NULL, NULL, NULL, 'description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1.', 'Dell', 10, 0, 1, 1, 1, 1, NULL, NULL),
(2, 'labtop 2', 'images/products/product_2/photo-1.jpg', 'images/products/product_2/photo-1.jpg,\r\nimages/products/product_2/photo-2.jpg,\r\nimages/products/product_2/photo-3.jpg,\r\nimages/products/product_2/photo-4.jpg', 6499, NULL, NULL, NULL, 'description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 1, description labtop 2, description labtop 2.', 'HP', 25, 0, 1, 1, 1, 1, NULL, NULL),
(3, 'phone 1', 'images/products/product_1/photo-3jpg', 'images/products/product_1/photo-1.jpg,\r\nimages/products/product_1/photo-2.jpg,\r\nimages/products/product_1/photo-3.jpg,\r\nimages/products/product_1/photo-4.jpg', 2540, NULL, NULL, NULL, 'description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, description phone 1, ', 'Samsung', 11, 0, 1, 2, 3, 2, NULL, NULL),
(4, 'phone 2', 'images/products/product_2/photo-2.jpg', 'images/products/product_2/photo-1.jpg,\r\nimages/products/product_2/photo-2.jpg,\r\nimages/products/product_2/photo-3.jpg,\r\nimages/products/product_2/photo-4.jpg', 4500, NULL, NULL, NULL, 'description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2, description phone 2.', 'Iphone', 5, 0, 1, 2, 4, 2, NULL, NULL),
(5, 'Mouse zornwee', 'images/products/product_2/photo-2.jpg', 'images/products/product_2/photo-1.jpg,\r\nimages/products/product_2/photo-2.jpg,\r\nimages/products/product_2/photo-3.jpg,\r\nimages/products/product_2/photo-4.jpg', 100, NULL, NULL, NULL, 'description mouse zorn, description mouse zorn, description mouse zorn, description mouse zorn.', 'zornwee', 37, 0, 1, 4, 3, 2, NULL, NULL);

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
(11, 3, 5, 1, NULL, NULL);

--
-- Dumping data for table `product_details`
--

INSERT INTO `product_details` (`id`, `name`, `value`, `display`, `user_id`, `product_type_id`, `created_at`, `updated_at`) VALUES
(1, 'Ram', '16GB', 1, 1, 1, NULL, NULL),
(2, 'Ram', '4GB', 1, 1, 2, NULL, NULL),
(3, 'Ram', '6GB', 1, 1, 2, NULL, NULL),
(4, 'screen size', '16.5 inch', 1, 1, 1, NULL, NULL),
(5, 'wireless', 'bluetooth', 1, 1, 4, NULL, NULL);

--
-- Dumping data for table `product_details_rel`
--

INSERT INTO `product_details_rel` (`id`, `product_id`, `details_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 1, 4, NULL, NULL),
(3, 2, 1, NULL, NULL),
(4, 2, 4, NULL, NULL),
(5, 5, 5, NULL, NULL),
(6, 3, 3, NULL, NULL),
(7, 4, 2, NULL, NULL);

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `name`, `display`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'laptop', 1, 1, NULL, NULL),
(2, 'mobile', 1, 1, NULL, NULL),
(3, 'mathoer-board', 1, 1, NULL, NULL),
(4, 'mouse', 1, 1, NULL, NULL),
(5, 'keyboard', 1, 1, NULL, NULL);

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `slug`, `name`, `value`, `type`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'اسم الموقع', 'website_name', 'Xorpin', 'string', 1, NULL, NULL),
(2, 'ميل الشركة', 'conpany_email', 'xorpin@gmail.info', 'string', 1, NULL, NULL);

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `phone`, `address`, `photo`, `active`, `rule`, `lang`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '01146908152', 'Egypt, cairo', 'images/products/product_1/photo-1.jpg', 1, 1, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00'),
(2, 'Admin 2', 'admin2@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010654664464', 'Egypt, cairo', 'images/products/product_1/photo-2.jpg', 0, 1, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00'),
(3, 'Admin Comoany 1', 'admin.c.1@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010654664500', 'Egypt, cairo', 'images/products/product_1/photo-3.jpg', 1, 2, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00'),
(4, 'Admin Comoany 2', 'admin.c.2@admin.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010654664511', 'Egypt, cairo', 'images/products/product_1/photo-4.jpg', 0, 2, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00'),
(5, 'Normal user 1', 'user@user.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010635345343', 'Egypt, cairo', 'images/products/product_1/photo-2.jpg', 1, 0, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00'),
(6, 'Normal user 2', 'user2@user.com', '2019-07-05 22:00:00', '$2y$10$fNZT3rTc04Z5RpEZkRNF0eVULd09oBnfzG/ma3R0rYR.BFCB5hSt6', '010635345374', 'Egypt, cairo', 'images/products/product_1/photo-3.jpg', 0, 0, 'ar', NULL, '2019-07-05 22:00:00', '2019-07-05 22:00:00');

--
-- Dumping data for table `winners`
--

INSERT INTO `winners` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 5, 3, NULL, NULL),
(2, 6, 5, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
