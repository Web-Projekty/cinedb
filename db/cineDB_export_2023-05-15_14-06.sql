-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 15, 2023 at 02:06 PM
-- Server version: 10.5.19-MariaDB-0+deb11u2
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cineDB`
--

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `idA` int(11) NOT NULL,
  `jmeno` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `prijmeni` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hodnoceni`
--

CREATE TABLE `hodnoceni` (
  `idH` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `uzivatel` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `hodnota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serialy`
--

CREATE TABLE `serialy` (
  `idS` int(11) NOT NULL,
  `nazev` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `idA` int(11) NOT NULL,
  `type` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `password` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci NOT NULL,
  `profileId` int(11) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`idA`);

--
-- Indexes for table `hodnoceni`
--
ALTER TABLE `hodnoceni`
  ADD PRIMARY KEY (`idH`),
  ADD KEY `tv_show` (`idS`);

--
-- Indexes for table `serialy`
--
ALTER TABLE `serialy`
  ADD PRIMARY KEY (`idS`),
  ADD KEY `authors` (`idA`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hodnoceni`
--
ALTER TABLE `hodnoceni`
  MODIFY `idH` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serialy`
--
ALTER TABLE `serialy`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `autori`
--
ALTER TABLE `autori`
  ADD CONSTRAINT `autori_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `serialy` (`idA`);

--
-- Constraints for table `serialy`
--
ALTER TABLE `serialy`
  ADD CONSTRAINT `serialy_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `hodnoceni` (`idS`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
