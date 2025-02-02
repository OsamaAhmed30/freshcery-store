-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 01, 2025 at 07:09 PM
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
-- Database: `freshcery`
--
CREATE DATABASE IF NOT EXISTS `freshcery` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `freshcery`;

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--
-- Creation: Jan 17, 2025 at 02:43 PM
--

DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(3) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `admins`
--

TRUNCATE TABLE `admins`;
--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fullname`, `email`, `username`, `password`, `image`, `created_at`) VALUES
(1, 'admin', 'admin@admin.com', 'admin45', '$2y$10$imOEIZvwA2cqHMag8u6/QO1byVYl7gu1CmElH4mFfjBp0jGj4S5.q', 'user-1.avif', '2025-01-19 14:33:50');

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--
-- Creation: Jan 16, 2025 at 04:50 PM
-- Last update: Feb 01, 2025 at 06:05 PM
--

DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(3) NOT NULL,
  `product_id` int(3) NOT NULL,
  `user_id` int(3) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(3) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `carts`
--

TRUNCATE TABLE `carts`;
--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `product_id`, `user_id`, `price`, `quantity`, `image`, `created_at`) VALUES
(45, 4, 8, 50, 2, 'apple.jpg', '2025-01-21 15:06:12'),
(72, 1, 1, 10, 1, 'tomato.jpg', '2025-02-01 18:05:38'),
(73, 4, 1, 25, 1, 'apple.jpg', '2025-02-01 18:05:41'),
(74, 5, 1, 360, 1, 'Froz-check.jpg', '2025-02-01 18:05:45');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--
-- Creation: Jan 24, 2025 at 09:36 PM
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(4) NOT NULL,
  `name` varchar(200) NOT NULL,
  `image` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `categories`
--

TRUNCATE TABLE `categories`;
--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `description`, `created_at`) VALUES
(1, 'Vegetables', 'vegetables.jpg', 'Freshly Harvested Veggies From Local Growers', '2024-12-13 15:01:59'),
(2, 'Fruits', 'fruits.jpg', 'Variety of Fruits From Local Growers', '2024-12-13 15:01:59'),
(3, 'Meats', 'meats.jpg', 'Protein Rich Ingridients From Local Farmers', '2024-12-13 15:03:27'),
(4, 'Fishes', 'fish.jpg', 'Protein Rich Ingridients From Local Farmers', '2024-12-13 15:03:27'),
(8, 'Clothes', 'clothes.jpg', 'Nice Clothes', '2025-01-24 12:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--
-- Creation: Jan 16, 2025 at 04:50 PM
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(200) NOT NULL,
  `user_id` int(3) NOT NULL,
  `shipping` decimal(5,0) NOT NULL DEFAULT 0,
  `status` varchar(200) DEFAULT NULL,
  `tax` int(4) NOT NULL DEFAULT 0,
  `total` decimal(10,0) NOT NULL,
  `discount` int(3) NOT NULL DEFAULT 0,
  `payment_status` varchar(200) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `orders`
--

TRUNCATE TABLE `orders`;
--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `shipping`, `status`, `tax`, `total`, `discount`, `payment_status`, `created_at`) VALUES
(1, 1, 20, 'finished', 0, 1140, 0, 'paid', '2025-01-31 15:26:52'),
(2, 1, 20, 'finished', 0, 45, 0, 'not paid', '2025-02-01 17:06:54'),
(3, 1, 20, 'finished', 0, 45, 0, 'not paid', '2025-02-01 17:08:10'),
(4, 1, 20, 'finished', 0, 380, 0, 'not paid', '2025-02-01 17:08:42'),
(5, 1, 20, 'finished', 0, 380, 0, 'not paid', '2025-02-01 17:09:18'),
(6, 1, 20, 'finished', 0, 45, 0, 'not paid', '2025-02-01 17:13:48'),
(7, 1, 20, 'finished', 0, 45, 0, 'not paid', '2025-02-01 17:15:31'),
(8, 1, 20, 'finished', 0, 45, 0, 'paid', '2025-02-01 17:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--
-- Creation: Jan 31, 2025 at 02:35 PM
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(3) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `last_name` varchar(200) NOT NULL,
  `address` text NOT NULL,
  `order_id` int(3) NOT NULL,
  `email` varchar(200) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `street` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `country` varchar(200) NOT NULL,
  `postal_code` varchar(10) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `order_details`
--

TRUNCATE TABLE `order_details`;
--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `first_name`, `last_name`, `address`, `order_id`, `email`, `phone_number`, `street`, `city`, `country`, `postal_code`, `notes`, `created_at`) VALUES
(1, 'user', '1', 'new cairo', 1, 'user-1@user.com', '111', 'new cairo', 'Cairo', 'Egypt', '002', '', '2025-01-31 15:26:52'),

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--
-- Creation: Jan 16, 2025 at 04:50 PM
--

DROP TABLE IF EXISTS `order_items`;
CREATE TABLE `order_items` (
  `id` int(200) NOT NULL,
  `product_id` int(3) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `name` varchar(200) NOT NULL,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `order_items`
--

TRUNCATE TABLE `order_items`;
--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `product_id`, `price`, `quantity`, `subtotal`, `name`, `order_id`, `created_at`) VALUES
(1, 4, 25, 2, 50, 'Apple', 1, '2025-01-31 15:26:52'),
(2, 3, 350, 1, 350, 'Cow Meat', 1, '2025-01-31 15:26:52'),
(3, 5, 360, 2, 720, 'Frozen Checken', 1, '2025-01-31 15:26:52'),
(4, 4, 25, 1, 25, 'Apple', 2, '2025-02-01 17:06:54'),
(5, 4, 25, 1, 25, 'Apple', 3, '2025-02-01 17:08:10'),
(6, 5, 360, 1, 360, 'Frozen Checken', 4, '2025-02-01 17:08:42'),
(7, 5, 360, 1, 360, 'Frozen Checken', 5, '2025-02-01 17:09:18'),
(8, 4, 25, 1, 25, 'Apple', 6, '2025-02-01 17:13:48'),
(9, 4, 25, 1, 25, 'Apple', 7, '2025-02-01 17:15:31'),
(10, 4, 25, 1, 25, 'Apple', 8, '2025-02-01 17:17:39');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--
-- Creation: Jan 27, 2025 at 02:39 PM
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(3) NOT NULL,
  `name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `old_price` decimal(10,0) DEFAULT NULL,
  `new_price` decimal(10,0) NOT NULL,
  `quantity` int(3) NOT NULL,
  `image` text DEFAULT NULL,
  `exp_date` varchar(200) NOT NULL,
  `category_id` int(3) NOT NULL,
  `status` int(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `products`
--

TRUNCATE TABLE `products`;
--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `old_price`, `new_price`, `quantity`, `image`, `exp_date`, `category_id`, `status`, `created_at`) VALUES
(1, 'Tomato', 'fresh and in several processed forms, including dried, purée, paste, ketchup, sauce, soup, and canned whole-peeled.', 13, 10, 1, 'tomato.jpg', '2025-01-10', 1, 1, '2024-12-17 17:45:37'),
(2, 'Gold Fish', 'Fresh and Testy Fish Meat', 115, 95, 2, 'fish.jpg', '2025-03-11', 4, 0, '2024-12-17 17:45:37'),
(3, 'Cow Meat', 'Fresh and Testy cow Meat', 390, 350, 1, 'cow-meat.jpg', '2025-01-21', 3, 1, '2024-12-17 17:49:46'),
(4, 'Apple', 'Fresh and Testy Fruit', 40, 25, 1, 'apple.jpg', '2026-02-18', 2, 1, '2024-12-17 17:49:46'),
(5, 'Frozen Checken', 'Good Frozen Chicken', 400, 360, 5, 'Froz-check.jpg', '2025-02-07', 3, 1, '2024-12-18 18:10:55'),
(6, 'Banana', 'Fresh and Testy Fruit.', 15, 12, 1, 'product.svg', '2027-01-19', 2, 0, '2024-12-19 19:16:56'),
(7, 'Orange', 'Fresh Orange', 25, 20, 10, 'product.svg', '2025-02-10', 2, 1, '2025-02-01 17:05:43');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--
-- Creation: Jan 17, 2025 at 02:49 PM
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(3) NOT NULL,
  `fullname` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(200) NOT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `street` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `postal_code` varchar(200) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `username`, `password`, `address`, `city`, `street`, `country`, `postal_code`, `image`, `created_at`) VALUES
(1, 'user', 'user@user.com', 'user-1', '$2y$10$GiHJIMKbdt6/kuqBZ02AIu1HA9TH3AYSLTyP5ZUnT8TiBi86/B/kO', NULL, NULL, NULL, NULL, NULL, 'user-1.png', '2024-12-06 20:23:52'),


--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_id` (`order_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
