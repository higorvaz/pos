-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2020 at 10:09 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prefix`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `cat_name`, `date`) VALUES
(1, 'soda', '2020-05-14 09:18:28'),
(2, 'Water', '2020-05-14 09:19:57'),
(3, 'flour', '2020-05-14 09:22:29'),
(4, 'Juice', '2020-05-14 09:23:39'),
(5, 'Fruits', '2020-05-14 10:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `cat_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `datex` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `cat_id`, `price`, `datex`) VALUES
(1, 'Coca Cola', 1, 500, '2020-05-14 09:18:51'),
(2, 'Fanta', 1, 500, '2020-05-14 09:19:13'),
(3, 'Fanta', 1, 500, '2020-05-14 09:19:13'),
(4, 'Sprite', 1, 500, '2020-05-14 09:19:23'),
(5, 'Hill Water', 2, 500, '2020-05-14 09:20:16'),
(6, 'Kilimanjaro', 2, 1000, '2020-05-14 09:20:29'),
(7, 'Masafi', 2, 1200, '2020-05-14 09:20:45'),
(8, 'Azam', 2, 1200, '2020-05-14 09:20:54'),
(9, 'Azam Ngano', 3, 2200, '2020-05-14 09:22:48'),
(10, 'Azam Ata', 3, 1500, '2020-05-14 09:23:04'),
(11, 'Azania', 3, 1500, '2020-05-14 09:23:18'),
(12, 'Kifaru', 3, 1500, '2020-05-14 09:23:26'),
(13, 'Azam Ukwaju', 4, 800, '2020-05-14 09:24:01'),
(36, 'Passion', 4, 1500, '2020-05-14 10:06:24'),
(37, 'Mango', 4, 1200, '2020-05-14 10:07:51'),
(38, 'Apple', 5, 1200, '2020-05-14 10:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Brian', 'kiwagib@gmail.com', '$2y$10$Dr0/MmnLz56TKBwF56R7kOSaYMzumkI1QWxFSO2hO1etCZwbmmNda');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cat` (`cat_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `cat` FOREIGN KEY (`cat_id`) REFERENCES `cat` (`cat_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
