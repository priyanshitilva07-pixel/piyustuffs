-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 10, 2025 at 05:04 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ultras_admin`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reg_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`, `reg_date`) VALUES
(1, 'piyu', '$2y$10$i0zUu0zrQ.ngLZ77L3YF2OPI80a2amh3atuV8ZeLu2SSnbeYw0i0C', '2025-09-15 11:44:35');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(6) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `category` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`, `category`) VALUES
(1, 'Full Sleeve Cover Shirt', 200.00, 'product-item1.jpg', 'Tshirts'),
(2, 'Volunteer Half blue', 388.00, 'product-item2.jpg', 'Tshirts'),
(3, 'Double yellow shirt', 440.00, 'product-item3.jpg', 'Tshirts'),
(4, 'Long belly grey pant', 330.00, 'product-item4.jpg', 'Pants'),
(5, 'Half sleeve T-shirt', 200.00, 'selling-products1.jpg', 'Tshirts'),
(6, 'Stylish Grey T-shirt', 355.00, 'selling-products2.jpg', 'Tshirts'),
(7, 'Silk White Shirt', 355.00, 'selling-products3.jpg', 'Tshirts'),
(8, 'Grunge Hoodie', 455.00, 'selling-products4.jpg', 'Hoodie'),
(9, 'Full sleeve Jeans jacket', 409.00, 'selling-products5.jpg', 'Jackets'),
(10, 'Grey Check Coat', 352.00, 'selling-products6.jpg', 'Outer'),
(11, 'Long Sleeve T-shirt', 400.00, 'selling-products7.jpg', 'Tshirts'),
(12, 'Half Sleeve T-shirt', 200.00, 'selling-products8.jpg', 'Tshirts'),
(13, 'Orange white Nike', 555.00, 'selling-products13.jpg', 'Shoes'),
(14, 'Running Shoe', 300.00, 'selling-products14.jpg', 'Shoes'),
(15, 'Tennis Shoe', 800.00, 'selling-products15.jpg', 'Shoes'),
(16, 'Nike Brand Shoe', 550.00, 'selling-products16.jpg', 'Shoes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
