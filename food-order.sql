-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 25, 2024 at 02:19 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `food-order`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `full_name`, `username`, `password`) VALUES
(12, 'Administrator', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(4, 'Pizza', 'Food_Category_790.jpg', 'Yes', 'Yes'),
(5, 'Burger', 'Food_Category_344.jpg', 'Yes', 'Yes'),
(6, 'MoMo', 'Food_Category_77.jpg', 'Yes', 'Yes'),
(9, 'Paratha', 'Food_Category_754.jpg', 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_food`
--

CREATE TABLE `tbl_food` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` int(10) NOT NULL,
  `discount` int(10) NOT NULL,
  `new_price` int(10) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_food`
--

INSERT INTO `tbl_food` (`id`, `title`, `description`, `price`, `discount`, `new_price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(3, 'Dumplings Special', 'Chicken Dumplings', 100, 2, 98, 'Food-Name-3649.jpg', 6, 'Yes', 'Yes'),
(4, 'Best Burger', 'Burger with Ham and lots of Cheese', 100, 5, 95, 'Food-Name-6340.jpg', 5, 'Yes', 'Yes'),
(5, 'Smoky BBQ Pizza', 'Best Firewood Pizza ', 100, 3, 97, 'Food-Name-8298.jpg', 4, 'No', 'Yes'),
(6, 'Sadeko Momo', 'Best Spicy Momo ', 120, 0, 120, 'Food-Name-7387.jpg', 6, 'Yes', 'Yes'),
(7, 'Mixed Pizza', 'Pizza with chicken, Ham, Buff, Mushroom and Vegetables', 200, 0, 200, 'Food-Name-7833.jpg', 4, 'Yes', 'Yes'),
(9, 'paratha', 'paratha', 100, 0, 100, 'Food-Name-5357.jpg', 9, 'No', 'Yes'),
(10, 'Kothey Momo', 'Kothey Momo is one of the popular types of Momos that are found in Nepal', 100, 0, 100, 'Food-Name-7639.jpg', 6, 'No', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(10) UNSIGNED NOT NULL,
  `food` varchar(150) NOT NULL,
  `price` int(10) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` int(10) NOT NULL,
  `order_date` datetime NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `customer_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`) VALUES
(4, 'Best Burger', 4, 7, 28, '2024-06-01 06:29:49', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(5, 'Best Burger', 4, 9, 36, '2024-06-01 06:29:56', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(6, 'Dumplings Specials', 5, 8, 40, '2024-06-01 06:38:48', 'Ordered', 'suban tamrakar', '9849494949', 'suban@gmail.com', 'tokha'),
(7, 'Best Burger', 4, 8, 32, '2024-06-01 06:38:48', 'Delivered', 'suban tamrakar', '9849494949', 'suban@gmail.com', 'tokha'),
(10, 'Smoky BBQ Pizza', 6, 1, 6, '2024-06-27 02:17:19', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(11, 'Kothey Momo', 99, 3, 297, '2024-07-08 12:52:07', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(12, 'Dumplings Specials', 5, 3, 15, '2024-07-08 12:52:07', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(13, 'Sadeko Momo', 6, 3, 18, '2024-07-09 02:10:57', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(14, 'paratha', 100, 5, 500, '2024-08-22 07:10:21', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(15, 'Sadeko Momo', 120, 3, 360, '2024-08-22 07:15:14', 'Cancelled', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(16, 'Dumplings Special', 98, 2, 196, '2024-08-22 07:16:39', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(17, 'Best Burger', 95, 1, 95, '2024-08-22 07:16:57', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali'),
(18, 'Mixed Pizza', 200, 1, 200, '2024-08-22 07:16:57', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_ratings`
--

CREATE TABLE `tbl_ratings` (
  `id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `rating` int(10) NOT NULL,
  `description` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_ratings`
--

INSERT INTO `tbl_ratings` (`id`, `food_id`, `user_id`, `rating`, `description`) VALUES
(1, 3, 1, 2, 'good food '),
(2, 3, 1, 3, 'tasty'),
(3, 3, 1, 4, 'nice'),
(4, 3, 1, 5, 'best'),
(5, 4, 1, 0, 'good'),
(6, 4, 1, 4, 'a'),
(7, 4, 1, 5, 'nice');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `full_name`, `username`, `password`, `address`, `contact`, `email`) VALUES
(1, 'srijan joshi', 'srijan', '76f7f3c6b64bfeece42aa805118bb400c8d1fb39', 'banasthali', '9840538231', 'srijanjoshi7@gmail.com'),
(3, 'suban tamrakar', 'suban', 'd067b88a34bd4713841ead86a0723511db79a647', 'tokha', '9849494949', 'suban@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_food`
--
ALTER TABLE `tbl_food`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_food_id` (`food_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_username` (`username`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
