-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2025 at 02:12 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fashionstore_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accessories`
--

CREATE TABLE `accessories` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `accessories`
--

INSERT INTO `accessories` (`id`, `name`, `price`, `qty`, `image`, `created_at`) VALUES
(1, 'Barkin', 799.99, 10, '6925f4906a259.png', '2025-11-25 18:25:20'),
(2, 'Capucines.', 899.99, 10, '6925f4a038f37.png', '2025-11-25 18:25:36'),
(3, 'Christopher M', 1299.99, 10, '6925f4b2cb0f0.png', '2025-11-25 18:25:54'),
(4, 'Coussin Bucket', 1599.99, 10, '6925f4c61a0b8.png', '2025-11-25 18:26:14'),
(5, 'Ice Latte', 699.99, 10, '6925f4d6ac7a4.png', '2025-11-25 18:26:30'),
(6, 'Montsouris PM', 599.99, 10, '6925f50aceb60.png', '2025-11-25 18:27:22'),
(7, 'LV x TM Venice NM', 1299.99, 10, '6925f51c7e65b.png', '2025-11-25 18:27:40'),
(8, 'Keepall Bandoulière ', 1799.99, 10, '6925f530478dd.png', '2025-11-25 18:28:00'),
(9, 'Vivienne Backpack', 799.99, 9, '6925f53da5e66.png', '2025-11-25 18:28:13');

-- --------------------------------------------------------

--
-- Table structure for table `men`
--

CREATE TABLE `men` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `men`
--

INSERT INTO `men` (`id`, `name`, `price`, `qty`, `image`, `created_at`) VALUES
(1, 'ZIP-UP DENIM POLO SHIRT', 49.99, 10, '6925e63e17da9.png', '2025-11-25 17:24:14'),
(2, ' LINEN SHIRT', 39.99, 10, '6925e6639870d.png', '2025-11-25 17:24:51'),
(3, 'Monogram Down Blouson', 399.99, 9, '6925e7bb185b3.png', '2025-11-25 17:30:35'),
(4, 'CONTRAST GRAPHIC PRINT SHIRT', 39.99, 10, '6925e7d7613c6.png', '2025-11-25 17:31:03'),
(5, 'LINEN SHIRT2', 39.99, 9, '6925e7f35ac32.png', '2025-11-25 17:31:31'),
(6, ' Light Denim Short-Sleeved Shirt', 89.99, 10, '6925e8192e0b0.png', '2025-11-25 17:32:09'),
(7, 'RELAXED FIT ABSTRACT PRINT SHIRT', 69.99, 10, '6925e8356b966.png', '2025-11-25 17:32:37'),
(8, 'VISCOSE AND JUTE SHIRT', 69.99, 9, '6925e9892d1ed.png', '2025-11-25 17:38:17'),
(9, 'ZIP-UP DENIM POLO SHIRT', 49.99, 10, '6925e99ef021e.png', '2025-11-25 17:38:38'),
(10, 'FLORAL PRINT SHIRT', 79.99, 9, '6925e9b431ba8.png', '2025-11-25 17:39:00'),
(11, 'FLOWING TIE-DYE PRINT SHIRT', 79.99, 9, '6925ea9ae3cc2.png', '2025-11-25 17:42:50'),
(12, 'FLORAL JACQUARD SHIRT', 39.99, 10, '6925eb3869f9a.png', '2025-11-25 17:45:28'),
(13, 'RELAXED FIT ABSTRACT PRINT SHIRT', 39.99, 10, '6925eb4ce42dc.png', '2025-11-25 17:45:48'),
(14, 'SEERSUCKER COMFORT SHIRT', 39.99, 5, '6925eb5c118c0.png', '2025-11-25 17:46:04'),
(15, 'TEXTURED EMBROIDERY SHIRT.png', 39.99, 8, '6925eb7052621.png', '2025-11-25 17:46:24');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `order_number` varchar(50) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(50) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_number`, `customer_name`, `customer_phone`, `customer_email`, `total_amount`, `order_date`) VALUES
(1, 'ORD-1764122289142', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 79.98, '2025-11-26 01:58:09'),
(2, 'ORD-1764122475177', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 79.99, '2025-11-26 02:01:15'),
(3, 'ORD-1764122639789', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 69.99, '2025-11-26 02:03:59'),
(4, 'ORD-1764122662079', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 799.99, '2025-11-26 02:04:22'),
(5, 'ORD-1764123247217', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 79.98, '2025-11-26 02:14:07'),
(6, 'ORD-1764124447421', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 39.99, '2025-11-26 02:34:07'),
(7, 'ORD-1764339781923', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 79.99, '2025-11-28 14:23:02'),
(8, 'ORD-1764340278681', 'vatana pin', '0333333333', 'vatanaking20@gmail.com', 399.99, '2025-11-28 14:31:18'),
(9, 'ORD-1764672783306', 'bora', '09292393', 'bora@gmail.com', 399.99, '2025-12-02 10:53:03'),
(10, 'ORD-1764672962058', 'bora', '09292393', 'bora@gmail.com', 119.97, '2025-12-02 10:56:02');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int NOT NULL,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `category` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `quantity` int NOT NULL,
  `subtotal` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `category`, `product_name`, `product_price`, `quantity`, `subtotal`) VALUES
(1, 1, 14, 'men', 'SEERSUCKER COMFORT SHIRT', 39.99, 2, 79.98),
(2, 2, 11, 'men', 'FLOWING TIE-DYE PRINT SHIRT', 79.99, 1, 79.99),
(3, 3, 8, 'men', 'VISCOSE AND JUTE SHIRT', 69.99, 1, 69.99),
(4, 4, 9, 'accessories', 'Vivienne Backpack', 799.99, 1, 799.99),
(5, 5, 15, 'men', 'TEXTURED EMBROIDERY SHIRT.png', 39.99, 2, 79.98),
(6, 6, 5, 'men', 'LINEN SHIRT2', 39.99, 1, 39.99),
(7, 7, 10, 'men', 'FLORAL PRINT SHIRT', 79.99, 1, 79.99),
(8, 8, 3, 'men', 'Monogram Down Blouson', 399.99, 1, 399.99),
(9, 9, 9, 'women', 'Short Hooded Duffle Coat.', 399.99, 1, 399.99),
(10, 10, 14, 'men', 'SEERSUCKER COMFORT SHIRT', 39.99, 3, 119.97);

-- --------------------------------------------------------

--
-- Table structure for table `women`
--

CREATE TABLE `women` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `women`
--

INSERT INTO `women` (`id`, `name`, `price`, `qty`, `image`, `created_at`) VALUES
(1, 'Denim-Effect Knit Jacket', 99.99, 10, '6925f0fe6b94f.png', '2025-11-25 18:10:06'),
(2, 'Denim-Effect Knit Skirt', 99.99, 10, '6925f10e10816.png', '2025-11-25 18:10:22'),
(3, 'Embroidered Signature T-Shirt', 29.99, 10, '6925f1226cc56.png', '2025-11-25 18:10:42'),
(4, 'Monogram Accent Fleece Jacket', 699.00, 10, '6925f134bd78f.png', '2025-11-25 18:11:00'),
(5, 'Monogram Brushed Knit Cardigan', 199.99, 4, '6925f14d7494d.png', '2025-11-25 18:11:25'),
(6, 'Monogram Toweling Cardigan.', 299.99, 10, '6925f164577c6.png', '2025-11-25 18:11:48'),
(7, 'Monogram Toweling Mini Skirt', 199.99, 10, '6925f1751aaec.png', '2025-11-25 18:12:05'),
(8, 'Monogram Toweling Zip-Up Jacket', 199.99, 10, '6925f1877e4ba.png', '2025-11-25 18:12:23'),
(9, 'Short Hooded Duffle Coat.', 399.99, 9, '6925f19bdb79a.png', '2025-11-25 18:12:43'),
(10, 'Flame Jacquard Cape', 399.99, 10, '6925f1b3adb0a.png', '2025-11-25 18:13:07'),
(11, 'Flame Jacquard Mini Skirt', 199.99, 10, '6925f1c333695.png', '2025-11-25 18:13:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessories`
--
ALTER TABLE `accessories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `men`
--
ALTER TABLE `men`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_number` (`order_number`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Indexes for table `women`
--
ALTER TABLE `women`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessories`
--
ALTER TABLE `accessories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `men`
--
ALTER TABLE `men`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `women`
--
ALTER TABLE `women`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
