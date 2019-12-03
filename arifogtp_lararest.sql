-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 21, 2019 at 10:02 PM
-- Server version: 10.1.41-MariaDB-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `arifogtp_lararest`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `cat_name`, `created_at`, `updated_at`) VALUES
(1, 'Fast food', NULL, NULL),
(2, 'Soft Drinks', NULL, NULL),
(3, 'Chines', NULL, NULL),
(4, 'Mexican', NULL, NULL);

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
(3, '2019_05_25_084601_create_product_types_table', 1),
(4, '2019_05_26_075908_create_categories_table', 1),
(5, '2019_05_26_075988_create_products_table', 1),
(6, '2019_05_28_081604_create_packages_table', 1),
(7, '2019_05_30_093536_create_stock_details_table', 1),
(8, '2019_06_01_084239_create_total_stocks_table', 1),
(9, '2019_06_10_152734_create_orders_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `order_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `items` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packages` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `discount` int(11) NOT NULL,
  `vat` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_no`, `customer_id`, `order_type`, `items`, `packages`, `price`, `discount`, `vat`, `total`, `status`, `created_at`, `updated_at`) VALUES
(1, '1730101', 1, 'Offline', '[\"1:2\",\"4:2\"]', 'null', 340, 0, 15, 391, 'Active', '2019-07-16 11:54:03', '2019-07-16 11:54:03'),
(2, '4081557', 1, 'Offline', 'null', '[\"1:1\"]', 370, 0, 15, 426, 'Active', '2019-07-16 11:54:32', '2019-07-16 11:54:32'),
(3, '7971346', 1, 'Offline', '[\"4:2\",\"2:1\"]', '[\"2:1\"]', 790, 0, 15, 909, 'Active', '2019-07-16 11:56:48', '2019-07-16 11:56:48'),
(4, '3771035', 1, 'Offline', '[\"1:1\"]', '[\"1:2\"]', 840, 0, 15, 966, 'Active', '2019-07-17 10:31:36', '2019-07-17 10:31:36'),
(5, '7935696', 1, 'Offline', '[\"5:20\",\"6:10\"]', 'null', 3990, 0, 15, 4589, 'Active', '2019-09-17 14:30:15', '2019-09-17 14:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `package_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'package_default_image.jpg',
  `items` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `package_name`, `package_image`, `items`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Package Name 1', 'package-name-1-2019-07-17-5d2efc20d2f5f.jpg', '[\"1:2\",\"2:1\",\"4:1\"]', 370, 'Description', '2019-07-16 11:27:22', '2019-07-17 10:44:49'),
(2, 'Package Name 2', 'package-name-2-2019-07-17-5d2efc0ac5e3b.jpg', '[\"1:1\",\"3:2\",\"5:1\"]', 550, 'Description', '2019-07-16 11:40:40', '2019-07-17 10:44:28'),
(3, 'Package Name 3', 'package-name-3-2019-07-17-5d2efbf22d861.jpg', '[\"3:2\",\"1:2\",\"5:2\",\"4:1\"]', 770, 'Description', '2019-07-16 11:42:12', '2019-07-17 10:44:02'),
(4, 'Combo package', 'combo-package-2019-07-17-5d2ef9a9e67f9.jpg', '[\"1:1\",\"5:2\"]', 200, 'dfhf', '2019-07-17 10:34:18', '2019-07-17 10:34:18'),
(5, 'Combo package 1', 'package_default_image.jpg', '[\"3:2\",\"5:2\",\"4:1\"]', 570, 'Combo package Combo package Combo package Combo package Combo package', '2019-07-17 10:48:13', '2019-07-17 10:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('arifur.arif007@gmail.com', '$2y$10$ohED2xWiZ0J1yaa5jmfgZOV8VuqK2cWYb2pOj.EYkRWxpnMNmj/qO', '2019-09-02 03:20:07');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type_id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'product_default_image.jpg',
  `price` int(11) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `type_id`, `cat_id`, `image_name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Ultimate Savings Bucket', 2, 1, 'ultimate-savings-bucket-2019-07-17-5d2efa93a6fe3.jpg', 800, 'Description', '2019-07-16 11:04:58', '2019-07-17 10:38:11'),
(2, 'Burger', 2, 1, 'burger-2019-07-17-5d2efa2e867dc.png', 100, 'Description', '2019-07-16 11:05:52', '2019-07-17 10:36:30'),
(3, 'Burrito', 2, 1, 'burrito-2019-07-17-5d2efa1fdf9f6.jpg', 200, 'Description', '2019-07-16 11:06:25', '2019-07-17 10:36:16'),
(4, 'Mineral Water', 1, 2, 'mineral-water-2019-07-17-5d2efa0778980.jpeg', 70, 'Description', '2019-07-16 11:07:08', '2019-07-17 10:35:51'),
(5, 'coca-cola( 500ml )', 1, 2, 'coca-cola-500ml-2019-07-17-5d2ef9f64ec32.jpeg', 50, 'Description', '2019-07-16 11:25:58', '2019-07-17 10:35:34'),
(6, 'Hot Zinger', 2, 1, 'hot-zinger-2019-07-17-5d2efb09da1a4.jpg', 299, 'Spicy, crunchy whole fillet of chicken in a warm sesame bun, topped with fresh crunchy lettuce and hot and spicy mayo.', '2019-07-17 10:40:10', '2019-07-17 10:40:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `type_name`, `created_at`, `updated_at`) VALUES
(1, 'Storable', NULL, NULL),
(2, 'Non Storable', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_details`
--

CREATE TABLE `stock_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `stock_details`
--

INSERT INTO `stock_details` (`id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 50, '2019-07-16 11:42:45', '2019-07-16 11:42:45'),
(2, 2, 50, '2019-07-16 11:42:52', '2019-07-16 11:42:52'),
(3, 3, 50, '2019-07-16 11:43:00', '2019-07-16 11:43:00'),
(4, 4, 50, '2019-07-16 11:43:21', '2019-07-16 11:43:21'),
(5, 5, 50, '2019-07-16 11:43:28', '2019-07-16 11:43:28');

-- --------------------------------------------------------

--
-- Table structure for table `total_stocks`
--

CREATE TABLE `total_stocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `total_stocks`
--

INSERT INTO `total_stocks` (`id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 1, 40, '2019-07-16 11:42:45', '2019-07-17 10:31:36'),
(2, 2, 46, '2019-07-16 11:42:52', '2019-07-17 10:31:36'),
(3, 3, 48, '2019-07-16 11:43:00', '2019-07-16 11:57:03'),
(4, 4, 43, '2019-07-16 11:43:21', '2019-07-17 10:31:36'),
(5, 5, 29, '2019-07-16 11:43:28', '2019-09-17 14:30:15');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '2',
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mr.Admin', 'admin@example.com', NULL, '$2y$10$yj5zawiM9YlU3zE8./blR.eXePEX6/RUP8DlRvPNbBIS.1WPtwYY6', NULL, NULL, '2019-07-17 11:17:24'),
(2, 2, 'Manager Name', 'manager@example.com', NULL, '$2y$10$dUuCCZ1mQRBQtAW.vF96Z.mzR5./cLEzcEPePTLPmwAmylyZkN2W2', NULL, '2019-07-16 11:45:13', '2019-07-17 11:16:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_details`
--
ALTER TABLE `stock_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `total_stocks`
--
ALTER TABLE `total_stocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `total_stocks_product_id_unique` (`product_id`);

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
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_details`
--
ALTER TABLE `stock_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `total_stocks`
--
ALTER TABLE `total_stocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
