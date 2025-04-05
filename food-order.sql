-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2025 at 06:24 AM
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
(9, 'Paratha', 'Food_Category_754.jpg', 'No', 'Yes'),
(10, 'sekuwa', 'Food_Category_785.jpg', 'No', 'No');

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
(10, 'Kothey Momo', 'Kothey Momo is one of the popular types of Momos that are found in Nepal', 100, 4, 96, 'Food-Name-7639.jpg', 6, 'No', 'Yes'),
(22, 'aloo paratha', 'paratha made wit aloo', 50, 0, 50, 'Food-Name-2066.jpg', 9, 'No', 'Yes');

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
  `customer_address` varchar(255) NOT NULL,
  `payment_status` varchar(50) NOT NULL DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `food`, `price`, `qty`, `total`, `order_date`, `status`, `customer_name`, `customer_contact`, `customer_email`, `customer_address`, `payment_status`) VALUES
(14, 'paratha', 100, 5, 500, '2024-08-22 07:10:21', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(15, 'Sadeko Momo', 120, 3, 360, '2024-08-22 07:15:14', 'Cancelled', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(16, 'Dumplings Special', 98, 2, 196, '2024-08-22 07:16:39', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(17, 'Best Burger', 95, 1, 95, '2024-08-22 07:16:57', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(18, 'Mixed Pizza', 200, 1, 200, '2024-08-22 07:16:57', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(19, 'Mixed Pizza', 200, 3, 600, '2024-08-25 06:08:07', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(20, 'Best Burger', 95, 1, 95, '2024-08-25 06:08:07', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(21, 'Dumplings Special', 98, 1, 98, '2024-08-25 06:08:07', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(22, 'Smoky BBQ Pizza', 97, 4, 388, '2024-08-25 07:39:22', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(23, 'Best Burger', 95, 4, 380, '2024-08-25 07:39:58', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(24, 'Smoky BBQ Pizza', 97, 4, 388, '2024-11-21 09:19:56', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(25, 'Best Burger', 95, 1, 95, '2024-11-21 09:19:56', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(26, 'aloo paratha', 50, 1, 50, '2024-11-21 03:53:25', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(27, 'Dumplings Special', 98, 1, 98, '2024-11-21 03:57:05', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(28, 'aloo paratha', 50, 1, 50, '2024-11-21 03:57:23', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Pending'),
(29, 'Mixed Pizza', 200, 3, 600, '2024-11-29 05:58:30', 'Ordered', 'suban tamrakar', '9849494949', 'suban@gmail.com', 'tokha', 'Pending'),
(30, 'aloo paratha', 50, 1, 50, '2024-11-29 06:09:59', 'Ordered', 'suban tamrakar', '9849494949', 'suban@gmail.com', 'tokha', 'Pending'),
(31, 'aloo paratha', 50, 3, 150, '2024-12-04 01:28:36', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(32, 'Sadeko Momo', 120, 2, 240, '2024-12-04 01:28:36', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(33, 'Best Burger', 95, 1, 95, '2024-12-04 06:16:35', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(34, 'Sadeko Momo', 120, 1, 120, '2024-12-05 05:22:18', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(35, 'aloo paratha', 50, 3, 150, '2024-12-05 05:40:58', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(36, 'Mixed Pizza', 200, 2, 400, '2024-12-21 17:20:59', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(37, 'Sadeko Momo', 120, 1, 120, '2024-12-21 17:20:59', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(38, 'Dumplings Special', 98, 1, 98, '2024-12-21 17:28:03', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(39, 'Smoky BBQ Pizza', 97, 4, 388, '2024-12-22 10:35:43', 'Delivered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(40, 'Best Burger', 95, 3, 285, '2025-01-03 14:28:54', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(41, 'Best Burger', 95, 3, 285, '2025-01-03 14:31:47', 'On Delivery', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(42, 'Best Burger', 95, 1, 95, '2025-02-21 06:11:50', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Cash on Delivery'),
(43, 'Best Burger', 95, 1, 95, '2025-02-22 05:12:25', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(44, 'Sadeko Momo', 120, 1, 120, '2025-02-22 05:13:00', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(45, 'Best Burger', 95, 2, 190, '2025-04-05 09:57:23', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid'),
(46, 'Dumplings Special', 98, 2, 196, '2025-04-05 10:03:53', 'Ordered', 'srijan joshi', '9840538231', 'srijanjoshi7@gmail.com', 'banasthali', 'Paid');

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
(7, 4, 1, 5, 'nice'),
(8, 3, 1, 4, 'momos are amazing '),
(11, 9, 3, 4, 'its very tasty'),
(16, 7, 3, 5, 'pizza is yummy!'),
(17, 9, 3, 4, 'authentic taste !!!'),
(18, 9, 3, 5, 'nice');

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

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_interactions`
--

CREATE TABLE `tbl_user_interactions` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `food_id` int(10) UNSIGNED NOT NULL,
  `interaction_type` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_user_interactions`
--

INSERT INTO `tbl_user_interactions` (`id`, `user_id`, `food_id`, `interaction_type`, `created_at`) VALUES
(2, 1, 3, 'view', '2024-11-27 03:57:09'),
(3, 1, 3, 'view', '2024-11-27 03:58:54'),
(4, 1, 3, 'view', '2024-11-27 03:59:15'),
(5, 1, 3, 'view', '2024-11-27 03:59:20'),
(6, 1, 3, 'view', '2024-11-27 03:59:24'),
(7, 1, 3, 'view', '2024-11-27 03:59:25'),
(8, 1, 4, 'view', '2024-11-27 03:59:50'),
(9, 1, 5, 'view', '2024-11-27 04:04:18'),
(10, 1, 5, 'view', '2024-11-27 04:05:28'),
(11, 1, 5, 'view', '2024-11-27 04:05:29'),
(12, 1, 5, 'view', '2024-11-27 04:06:04'),
(13, 1, 5, 'view', '2024-11-27 04:06:07'),
(14, 1, 5, 'view', '2024-11-27 04:06:07'),
(15, 1, 5, 'view', '2024-11-27 04:06:07'),
(16, 1, 5, 'view', '2024-11-27 04:06:17'),
(17, 1, 5, 'view', '2024-11-27 04:08:56'),
(18, 1, 5, 'view', '2024-11-27 04:15:24'),
(19, 1, 5, 'view', '2024-11-27 04:15:28'),
(20, 1, 5, 'view', '2024-11-27 04:15:29'),
(21, 1, 5, 'view', '2024-11-27 04:15:29'),
(22, 1, 5, 'view', '2024-11-27 04:18:16'),
(23, 1, 5, 'view', '2024-11-27 04:18:56'),
(24, 1, 5, 'view', '2024-11-27 04:18:57'),
(25, 1, 5, 'view', '2024-11-27 04:18:58'),
(26, 1, 5, 'view', '2024-11-27 04:18:58'),
(27, 1, 5, 'view', '2024-11-27 04:19:11'),
(28, 1, 5, 'view', '2024-11-27 04:19:37'),
(29, 1, 3, 'view', '2024-11-28 04:11:11'),
(30, 1, 3, 'view', '2024-11-28 23:53:16'),
(31, 1, 7, 'view', '2024-11-28 23:53:20'),
(32, 1, 9, 'view', '2024-11-28 23:53:32'),
(33, 1, 3, 'view', '2024-11-28 23:54:04'),
(34, 1, 5, 'view', '2024-11-28 23:54:21'),
(35, 1, 4, 'view', '2024-11-28 23:54:33'),
(36, 3, 5, 'view', '2024-11-28 23:54:57'),
(37, 3, 5, 'view', '2024-11-28 23:56:45'),
(38, 3, 7, 'review', '2024-11-28 23:57:02'),
(39, 3, 7, 'view', '2024-11-28 23:57:02'),
(40, 3, 7, 'view', '2024-11-28 23:57:12'),
(41, 3, 9, 'review', '2024-11-28 23:57:25'),
(42, 3, 9, 'view', '2024-11-28 23:57:25'),
(43, 3, 9, 'view', '2024-11-28 23:58:17'),
(44, 3, 9, 'view', '2024-11-28 23:58:31'),
(45, 3, 4, 'review', '2024-11-28 23:58:42'),
(46, 3, 4, 'view', '2024-11-28 23:58:42'),
(47, 3, 4, 'view', '2024-11-28 23:58:55'),
(48, 3, 9, 'view', '2024-11-28 23:59:05'),
(49, 3, 9, 'view', '2024-11-28 23:59:16'),
(50, 3, 3, 'view', '2024-11-28 23:59:40'),
(51, 3, 7, 'view', '2024-11-29 00:01:04'),
(52, 3, 4, 'review', '2024-11-29 00:01:46'),
(53, 3, 4, 'view', '2024-11-29 00:01:46'),
(54, 3, 4, 'view', '2024-11-29 00:06:03'),
(55, 3, 4, 'view', '2024-11-29 00:06:04'),
(56, 3, 4, 'view', '2024-11-29 00:06:04'),
(57, 3, 3, 'view', '2024-11-29 00:06:06'),
(58, 3, 7, 'view', '2024-11-29 00:06:19'),
(59, 3, 7, 'view', '2024-11-29 00:07:09'),
(60, 3, 7, 'review', '2024-11-29 00:07:51'),
(61, 3, 7, 'view', '2024-11-29 00:07:51'),
(62, 3, 9, 'view', '2024-11-29 00:08:09'),
(63, 3, 9, 'review', '2024-11-29 00:08:25'),
(64, 3, 9, 'view', '2024-11-29 00:08:25'),
(65, 3, 9, 'review', '2024-11-29 00:08:49'),
(66, 3, 9, 'view', '2024-11-29 00:08:49'),
(67, 3, 7, 'view', '2024-11-29 00:09:07'),
(68, 3, 7, 'view', '2024-11-29 00:09:10'),
(69, 3, 7, 'view', '2024-11-29 00:09:16'),
(70, 3, 7, 'view', '2024-11-29 00:12:34'),
(71, 3, 7, 'view', '2024-11-29 00:12:55'),
(72, 3, 7, 'cart', '2024-11-29 00:13:23'),
(73, 3, 4, 'view', '2024-11-29 00:13:35'),
(74, 3, 4, 'view', '2024-11-29 00:14:42'),
(75, 3, 4, 'view', '2024-11-29 00:14:44'),
(76, 3, 4, 'view', '2024-11-29 00:16:10'),
(77, 3, 4, 'view', '2024-11-29 00:18:25'),
(78, 3, 10, 'view', '2024-11-29 00:18:39'),
(79, 3, 10, 'view', '2024-11-29 00:19:29'),
(80, 3, 10, 'view', '2024-11-29 00:19:30'),
(81, 3, 10, 'view', '2024-11-29 00:19:30'),
(82, 3, 10, 'view', '2024-11-29 00:19:31'),
(83, 3, 10, 'view', '2024-11-29 00:20:18'),
(84, 3, 10, 'view', '2024-11-29 00:20:46'),
(85, 3, 10, 'view', '2024-11-29 00:20:51'),
(86, 3, 10, 'view', '2024-11-29 00:21:01'),
(87, 3, 10, 'view', '2024-11-29 00:22:18'),
(88, 3, 5, 'view', '2024-11-29 00:24:47'),
(89, 3, 22, 'cart', '2024-11-29 00:24:56'),
(90, 3, 22, 'view', '2024-11-29 00:26:33'),
(91, 1, 5, 'cart', '2024-12-04 00:00:42'),
(92, 1, 5, 'cart', '2024-12-04 00:02:33'),
(93, 1, 10, 'cart', '2024-12-04 00:03:59'),
(94, 1, 22, 'cart', '2024-12-04 00:04:04'),
(95, 1, 4, 'cart', '2024-12-04 00:09:18'),
(96, 1, 9, 'cart', '2024-12-04 00:09:24'),
(97, 1, 4, 'cart', '2024-12-04 00:11:47'),
(98, 1, 10, 'cart', '2024-12-04 00:11:51'),
(99, 1, 10, 'cart', '2024-12-04 00:13:47'),
(100, 1, 9, 'cart', '2024-12-04 00:13:52'),
(101, 1, 3, 'view', '2024-12-04 00:14:39'),
(102, 1, 10, 'cart', '2024-12-04 00:15:58'),
(103, 1, 7, 'cart', '2024-12-04 00:16:03'),
(104, 1, 10, 'cart', '2024-12-04 00:18:02'),
(105, 1, 22, 'cart', '2024-12-04 00:18:06'),
(106, 1, 4, 'cart', '2024-12-04 00:21:06'),
(107, 1, 4, 'cart', '2024-12-04 00:22:54'),
(108, 1, 22, 'cart', '2024-12-04 00:28:17'),
(109, 1, 6, 'cart', '2024-12-04 00:28:24'),
(110, 1, 4, 'cart', '2024-12-04 00:31:31'),
(111, 1, 6, 'cart', '2024-12-04 23:37:12'),
(112, 1, 22, 'cart', '2024-12-04 23:55:03'),
(113, 1, 22, 'view', '2024-12-05 00:02:25'),
(114, 1, 22, 'cart', '2024-12-05 00:02:29'),
(115, 1, 3, 'view', '2024-12-05 00:06:27'),
(116, 1, 3, 'cart', '2024-12-05 00:08:16'),
(117, 1, 3, 'view', '2024-12-21 11:27:03'),
(118, 1, 3, 'view', '2024-12-21 11:31:56'),
(119, 1, 3, 'view', '2024-12-21 11:32:32'),
(120, 1, 7, 'view', '2024-12-21 11:33:01'),
(121, 1, 7, 'view', '2024-12-21 11:33:28'),
(122, 1, 7, 'cart', '2024-12-21 11:33:29'),
(123, 1, 6, 'cart', '2024-12-21 11:34:21'),
(124, 1, 3, 'view', '2024-12-21 11:42:56'),
(125, 1, 3, 'cart', '2024-12-21 11:42:57'),
(126, 1, 3, 'view', '2024-12-21 11:48:00'),
(127, 1, 3, 'view', '2024-12-21 11:48:52'),
(128, 1, 3, 'cart', '2024-12-21 11:48:52'),
(129, 1, 3, 'cart', '2024-12-22 04:34:05'),
(130, 1, 5, 'view', '2024-12-22 04:49:06'),
(131, 1, 5, 'cart', '2024-12-22 04:49:35'),
(132, 1, 3, 'view', '2024-12-22 04:52:31'),
(133, 1, 4, 'cart', '2025-01-03 08:43:16'),
(134, 1, 4, 'cart', '2025-01-03 08:44:41'),
(135, 1, 5, 'cart', '2025-01-30 23:57:06'),
(136, 1, 4, 'view', '2025-02-21 00:26:15'),
(137, 1, 4, 'view', '2025-02-21 00:26:19'),
(138, 1, 3, 'view', '2025-02-21 00:26:24'),
(139, 1, 4, 'view', '2025-02-21 00:26:25'),
(140, 1, 4, 'view', '2025-02-21 00:26:27'),
(141, 1, 4, 'cart', '2025-02-21 00:26:31'),
(142, 1, 4, 'view', '2025-02-21 00:26:53'),
(143, 1, 4, 'cart', '2025-02-21 00:26:54'),
(144, 1, 9, 'cart', '2025-02-21 23:23:33'),
(145, 1, 4, 'cart', '2025-02-21 23:26:19'),
(146, 1, 6, 'cart', '2025-02-21 23:27:31'),
(147, 1, 4, 'cart', '2025-04-05 04:08:02'),
(148, 1, 4, 'cart', '2025-04-05 04:08:40'),
(149, 1, 3, 'cart', '2025-04-05 04:18:16'),
(150, 1, 3, 'view', '2025-04-05 04:19:04'),
(151, 1, 3, 'view', '2025-04-05 04:19:33'),
(152, 1, 3, 'view', '2025-04-05 04:19:34'),
(153, 1, 3, 'view', '2025-04-05 04:19:34'),
(154, 1, 7, 'view', '2025-04-05 04:20:17');

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
-- Indexes for table `tbl_user_interactions`
--
ALTER TABLE `tbl_user_interactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `food_id` (`food_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_food`
--
ALTER TABLE `tbl_food`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user_interactions`
--
ALTER TABLE `tbl_user_interactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_ratings`
--
ALTER TABLE `tbl_ratings`
  ADD CONSTRAINT `fk_food_id` FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`),
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`);

--
-- Constraints for table `tbl_user_interactions`
--
ALTER TABLE `tbl_user_interactions`
  ADD CONSTRAINT `tbl_user_interactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`id`),
  ADD CONSTRAINT `tbl_user_interactions_ibfk_2` FOREIGN KEY (`food_id`) REFERENCES `tbl_food` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
