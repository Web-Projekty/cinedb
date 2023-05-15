-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 09:37 PM
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
-- Database: `accounts`
--
CREATE DATABASE IF NOT EXISTS `accounts` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci;
USE `accounts`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `profileId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `profileId`) VALUES
(1, 'Wlczak', '1d996e033d612d9af2b44b70061ee0e868bfd14c2dd90b129e1edeb7953e7985', 1),
(2, 'Pepa', '309ed86ab5228601dd4903d09a0bbca86d566bd9c7426f85ae59be5544bdea2b', 15),
(9, 'Phone', '9f14bc145b0d0759f2ae8ddb5ae24aedd45014314e1cd9a169bf32c9873e5ad1', 9),
(11, 'testing', 'efaecc0e8f3165f5d727203a99966bc2436d993c8f3c5d0a46cc5eac40968af7', 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
