-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 07:35 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `book_id` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `user_id` int(4) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`user_id`, `image`) VALUES
(1, 'uploads/DavidMitchell.png'),
(10, './images/image-not-available.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `user_id` int(4) NOT NULL,
  `log_message` varchar(255) NOT NULL,
  `log_time` timestamp(2) NOT NULL DEFAULT CURRENT_TIMESTAMP(2) ON UPDATE CURRENT_TIMESTAMP(2)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`user_id`, `log_message`, `log_time`) VALUES
(1, 'user logged in', '2019-05-21 13:08:08.00'),
(1, 'user logged out', '2019-05-21 13:08:09.00'),
(8, 'user logged in', '2019-05-21 13:08:29.00'),
(8, 'user logged out', '2019-05-21 13:08:31.00'),
(9, 'user logged in', '2019-05-21 13:09:24.00'),
(9, 'user logged out', '2019-05-21 13:09:26.00'),
(10, 'user logged in', '2019-05-21 13:09:32.00'),
(10, 'user logged out', '2019-05-21 13:09:33.00'),
(8, 'user logged in', '2019-05-21 13:10:13.00'),
(8, 'user logged in', '2019-05-21 13:16:35.00'),
(8, 'user logged in', '2019-05-21 13:17:51.00'),
(8, 'user logged out', '2019-05-21 13:43:37.00'),
(1, 'user logged out', '2019-05-29 15:58:58.00'),
(8, 'user logged in', '2019-06-28 20:46:25.00'),
(8, 'user logged out', '2019-06-28 20:56:09.00'),
(1, 'user logged in', '2019-06-28 20:56:18.00'),
(1, 'user logged out', '2019-06-28 23:06:09.00'),
(1, 'user logged in', '2019-06-29 00:20:32.00'),
(1, 'user logged out', '2019-06-29 00:28:27.00'),
(8, 'user logged in', '2019-06-29 00:28:31.00'),
(8, 'user logged out', '2019-06-29 22:35:48.00'),
(8, 'user logged in', '2019-07-01 14:40:33.00'),
(8, 'user logged out', '2019-07-01 14:41:09.00'),
(1, 'user logged in', '2019-07-01 15:25:25.00'),
(1, 'user logged out', '2019-07-01 15:28:17.00'),
(13, 'user logged out', '2019-07-01 15:29:10.00'),
(1, 'user logged in', '2019-07-01 15:29:15.00');

-- --------------------------------------------------------

--
-- Table structure for table `userbooks`
--

CREATE TABLE `userbooks` (
  `user_id` int(11) NOT NULL,
  `book_id` varchar(50) NOT NULL,
  `price` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userbooks`
--

INSERT INTO `userbooks` (`user_id`, `book_id`, `price`) VALUES
(8, 'ukNtSB5CIf0C', 19),
(9, 'SqMNAQAAMAAJ', 27),
(8, 'SqMNAQAAMAAJ', 13),
(8, 'SqMNAQAAMAAJ', 12),
(13, 'NTKe4tS2dhgC', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `surname`, `email`, `username`, `password`, `isAdmin`) VALUES
(1, 'Alfred', 'grima', 'yand@gmail.com', 'grimm123', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1),
(8, 'Yandrick', 'sant', 'boithisworks@gmail.com', 'grimm', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0),
(9, 'Yandrick', 'Grima', 'yandrick.alpha.grima@gmail.com', 'admin', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 1),
(10, 'This is a test account', 'image not available', 'image@not.com', 'TestAccount', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0),
(13, 'yandrick', 'grima', 'vcx@gfd', 'indigo', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD KEY `cart_ibfk_1` (`user_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD KEY `log_ibfk_1` (`user_id`);

--
-- Indexes for table `userbooks`
--
ALTER TABLE `userbooks`
  ADD KEY `userbooks_ibfk_1` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userbooks`
--
ALTER TABLE `userbooks`
  ADD CONSTRAINT `userbooks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
