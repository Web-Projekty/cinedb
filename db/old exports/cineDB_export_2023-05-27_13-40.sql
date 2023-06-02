-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 27, 2023 at 01:40 PM
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
CREATE DATABASE IF NOT EXISTS `cineDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_czech_ci;
USE `cineDB`;

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
(1, 'Masaomi', 'Andou'),
(2, 'Yasuhiro', 'Yoshiura'),
(3, 'Daisuke', 'Hiramaki'),
(4, 'Hideaki', 'Anno'),
(5, 'Ei', 'Aoki'),
(6, 'Tsutomu', 'Mizushima'),
(7, 'Ryuu', 'Nakayama'),
(8, 'Gorou', 'Taniguchi'),
(9, 'Toshimasa', 'Ishii'),
(10, 'Ryouma', 'Ebata'),
(11, 'Kazuya', 'Nakanishi'),
(12, 'Kazuhiro', 'Furuhashi'),
(13, 'Masaharu', 'Watanabe'),
(14, 'Kana', 'Akatsuki'),
(15, 'Shinpei', 'Ezaki'),
(16, 'Yutaka', 'Uemura'),
(17, 'Tatsuki', 'Fujimoto');

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
(1, 1, 'Pepa', 4),
(2, 1, 'asdfsadf', 1),
(3, 1, 'eeddgfd', 5),
(4, 2, 'qwdd', 2),
(5, 1, 'asd', 3),
(10, 1, 'Jabko S Máslem', 3),
(11, 5, 'Xd', 5),
(12, 1, 'Xd', 5),
(13, 10, 'Xd', 4),
(14, 16, 'Xd', 5);

-- --------------------------------------------------------

--
-- Table structure for table `serialy`
--

CREATE TABLE `serialy` (
  `idS` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `idA` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `serialy`
--

INSERT INTO `serialy` (`idS`, `nazev`, `idA`, `type`) VALUES
(1, 'Toilet-bound Hanako-kun', 1, 'tv'),
(2, '86', 9, 'tv'),
(3, 'Patema Inverted', 2, 'movie'),
(5, 'Oshi no Ko', 3, 'tv'),
(6, 'Neon Genesis Evangelion', 4, 'tv'),
(7, 'Fate/Zero', 5, 'tv'),
(8, 'Girls und Panzer', 6, 'tv'),
(9, 'One Punch Man', 7, 'tv'),
(10, 'Chainsaw Man', 17, 'tv'),
(11, 'Code Geass: Lelouch of the Rebellion', 8, 'tv'),
(12, 'One Piece Film: Red', 8, 'movie'),
(13, 'Bocchi the Rock!', 9, 'tv'),
(14, 'That Time I Got Reincarnated as a Slime', 10, 'tv'),
(15, 'The Eminence in Shadow', 11, 'tv'),
(16, 'Spy x Family', 12, 'tv'),
(17, 'Re:ZERO -Starting Life in Another World-', 13, 'tv'),
(18, 'Violet Evergarden: The Movie', 14, 'movie'),
(19, 'Violet Evergarden', 14, 'tv'),
(20, 'Vivy -Fluorite Eye\'s Song-', 15, 'tv'),
(21, 'Attack on Titan', 15, 'tv'),
(22, 'Saga of Tanya the Evil', 16, 'tv'),
(23, 'One Piece', 16, 'tv');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `profileId` int(11) DEFAULT 0,
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `profileId`, `admin`) VALUES
(2, 'admin', 'efaecc0e8f3165f5d727203a99966bc2436d993c8f3c5d0a46cc5eac40968af7', 0, 1),
(7, 'Wlczak', 'e6f55bdc11809f464e92279a2725f7c6d7c6ad1270c2b68e582b62795aceb8b6', 0, 0),
(8, 'Xd', '24a8ddd4770ac9d4c37be1520e80a6948ab069661b67b065adc6c21af4c561ad', 7, 0),
(14, 'Jabko S Máslem', '62966f61bad899bd2053e031f00c9700d1e0191d8f332a7116fb8e0d54c041e7', 0, 0),
(15, 'completelySanePerson', '07a2c325cbf37a16f3796fd3f5c2aec24d5b472808784b84ef30dd3256fefbea', 0, 1);

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
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `hodnoceni`
--
ALTER TABLE `hodnoceni`
  MODIFY `idH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `serialy`
--
ALTER TABLE `serialy`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

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
