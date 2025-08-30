-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 30, 2025 at 09:03 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sbspay`
--

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `id` bigint(20) NOT NULL,
  `company` text NOT NULL,
  `api_key` text NOT NULL,
  `api_secret` text NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `api`
--

INSERT INTO `api` (`id`, `company`, `api_key`, `api_secret`, `status`) VALUES
(1, 'sbs', 'rzp_test_bYrGWIGbg2EZpR', '3uup2nTuBqthwU8xEkrFHpo4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) NOT NULL,
  `product_name` text NOT NULL,
  `image_path` text NOT NULL,
  `price` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `image_path`, `price`, `status`) VALUES
(1, 'Data Science', '../assets/img/1.jpg', '2', 1),
(2, 'Graphics Design', '../assets/img/2.jpg', '2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `razorpay_id` varchar(255) NOT NULL,
  `product_id` bigint(20) DEFAULT NULL,
  `price` double(11,2) NOT NULL,
  `datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `transaction_id`, `user_id`, `razorpay_id`, `product_id`, `price`, `datetime`, `status`) VALUES
(1, 'order_R6pZpWUpoBAn9z', 1, 'pay_R6pa31pF6UgKw5', 2, 2.00, '2025-08-18 14:30:39', 'success'),
(2, 'order_R75WNGrKOeuHij', 1, 'pay_R75X8RMEAbhwAw', 1, 1.00, '2025-08-19 06:07:51', 'success'),
(3, 'order_R75WNGrKOeuHij', 1, 'pay_R75X8RMEAbhwAw', 1, 1.00, '2025-08-19 06:16:13', 'success'),
(4, 'order_R7tNe5owWwaleF', 1, 'pay_R7tOUSj2FV5nRu', NULL, 1.00, '2025-08-21 06:54:56', 'successdb'),
(5, 'order_R7u0qg5OuOiYPS', 1, 'pay_R7u167DlTdxVeP', NULL, 1.00, '2025-08-21 07:30:03', 'successcr'),
(6, 'order_R7uKBnyloCYRyK', 1, 'pay_R7uL06LQHFYeNj', NULL, 1.00, '2025-08-21 07:48:59', 'successdb'),
(7, 'order_R7uT5I69in2TWq', 1, 'pay_R7uTi6hrjXMwgc', NULL, 1.00, '2025-08-21 07:57:14', 'successdb'),
(8, 'order_R7uY37RcfKxvuV', 1, 'pay_R7uYN9BX9Kl0la', NULL, 1.00, '2025-08-21 08:01:38', 'successdb'),
(9, 'order_R8j9LxQOL88bFT', 1, 'pay_R8j9qoZkfmKqPU', NULL, 1.00, '2025-08-23 09:31:47', 'successdb'),
(10, 'order_R8j9LxQOL88bFT', 1, 'pay_R8j9qoZkfmKqPU', NULL, 1.00, '2025-08-23 09:34:35', 'successdb'),
(11, 'order_R8jVBzOxjB2DeD', 1, 'pay_R8jVWp5OS6VxQR', NULL, 1.00, '2025-08-23 09:52:17', 'successdb'),
(12, 'order_R9theywzXxtPZu', 1, 'pay_R9tnueuFRIoGrA', NULL, 1.00, '2025-08-26 08:35:35', 'successdb'),
(13, 'order_RAefxxqM3GVlXw', 1, 'pay_RAegS6uSbkx0vc', NULL, 1.00, '2025-08-28 06:27:08', 'successdb'),
(14, 'order_RAegj1zPIQtmSF', 1, 'pay_RAemBjzhzV9ESb', NULL, 1.00, '2025-08-28 06:32:35', 'successdb'),
(15, 'order_RAemTCvFXggvn6', 1, 'pay_RAensfhKyBe2dV', NULL, 1.00, '2025-08-28 06:34:13', 'successdb'),
(16, 'order_RAex9gQlq1orzG', 1, 'pay_RAeyjp7JI9PJGX', NULL, 1.00, '2025-08-28 06:44:26', 'successdb'),
(17, 'order_RAeyzI9T5TjXvC', 1, 'pay_RAf12OMCx6NL3l', NULL, 1.00, '2025-08-28 06:46:39', 'successdb'),
(18, 'order_RAf1L41fWwBXxz', 1, 'pay_RAfGUHZaznW1Ie', NULL, 1.00, '2025-08-28 07:01:25', 'successdb'),
(19, 'order_RAg2CsRNjYz6mh', 1, 'pay_RAg2uTf26MsKH2', 1, 2.00, '2025-08-28 07:47:14', 'success');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `mobile`, `status`) VALUES
(1, 'admin', 'admin', 'softdreams4u@gmail.com', '8144065688', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wallet_table`
--

CREATE TABLE `wallet_table` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `totalamount` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallet_table`
--

INSERT INTO `wallet_table` (`id`, `user_id`, `totalamount`) VALUES
(1, 1, '11.00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wallet_table`
--
ALTER TABLE `wallet_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wallet_table`
--
ALTER TABLE `wallet_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
