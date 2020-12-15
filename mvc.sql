-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2020 at 12:52 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mvc`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_sale` int(11) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `body` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `price`, `price_sale`, `soluong`, `image`, `name`, `body`, `created_at`) VALUES
(3, 4, 10000, 1000, 1, NULL, 'Máy lọc nước', 'Máy lọc nước kanguru', '2020-12-14 14:03:22'),
(4, 4, 12000, 7000, 10, NULL, 'Máy lọc nước Kanguro', 'Máy lọc nước chính hãng', '2020-12-14 14:04:03'),
(5, 4, 10000, 90000, 10, NULL, 'hoangviet', 'Máy lọc nước kanguru', '2020-12-14 14:21:55'),
(6, 4, 10000, 90000, 10, NULL, 'hoangviet', 'Máy lọc nước kanguru', '2020-12-14 14:49:34'),
(7, 4, 100000, 90000, 0, NULL, 'hoangviet', 'Máy lọc nước kanguru', '2020-12-14 14:53:49'),
(8, 4, 100, 10, 1, NULL, 'dsadsadad', 'ádaddsa', '2020-12-14 14:59:39'),
(9, 4, 10000, 90000, 10, NULL, 'dsadsđ', 'Máy lọc nước kanguru', '2020-12-14 15:07:44'),
(10, 4, 10000, 90000, 12, NULL, 'sadasdad', 'Máy lọc nước kanguru', '2020-12-14 15:08:24'),
(11, 4, 10000, 7000, 12, NULL, 'hoangviet', 'Máy lọc nước kanguru', '2020-12-14 15:09:13'),
(12, 4, 10000, 7000, 12, 'images.jpg', 'hoangviet', 'Máy lọc nước kanguru', '2020-12-14 15:10:42');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `permission` varchar(191) NOT NULL DEFAULT 'user',
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `permission`, `password`) VALUES
(4, 'ádsdadsad', 'vietch.ndm@gmail.com', 'admin', '$2y$10$7YXS5fRf0LwmcBqCdB8tw.Buip9IdnQ/.vHiP2mefL2MkIkAJpX/e'),
(5, 'hoangviet1', 'tungngu@gmail.com', 'user', '$2y$10$dwv547jg2Wq8OBD8erePd.ndnN2hgxGhvgLlw4/C0bAitT9hbhwBW');

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
