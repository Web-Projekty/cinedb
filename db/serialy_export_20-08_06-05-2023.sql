-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2023 at 08:08 PM
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
-- Database: `serialy`
--
CREATE DATABASE IF NOT EXISTS `serialy` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci;
USE `serialy`;

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `idA` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`idA`, `jmeno`, `prijmeni`) VALUES
(1, 'Pepa', 'Necky'),
(2, 'Ferdinand', 'von Hirgenschlafen');

-- --------------------------------------------------------

--
-- Table structure for table `hodnoceni`
--

CREATE TABLE `hodnoceni` (
  `idH` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `uzivatel` varchar(20) NOT NULL,
  `hodnota` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `hodnoceni`
--

INSERT INTO `hodnoceni` (`idH`, `idS`, `uzivatel`, `hodnota`) VALUES
(1, 1, 'Pepa', 4);

-- --------------------------------------------------------

--
-- Table structure for table `serialy`
--

CREATE TABLE `serialy` (
  `idS` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `idA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `serialy`
--

INSERT INTO `serialy` (`idS`, `nazev`, `idA`) VALUES
(1, 'Toilet-bound Hanako-kun', 1),
(2, '86', 2);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hodnoceni`
--
ALTER TABLE `hodnoceni`
  MODIFY `idH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `serialy`
--
ALTER TABLE `serialy`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `hodnoceni`
--
ALTER TABLE `hodnoceni`
  ADD CONSTRAINT `hodnoceni_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `serialy` (`idS`);

--
-- Constraints for table `serialy`
--
ALTER TABLE `serialy`
  ADD CONSTRAINT `serialy_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `autori` (`idA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
