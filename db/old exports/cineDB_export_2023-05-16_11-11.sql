-- phpMyAdmin SQL Dump
-- version 5.0.4deb2+deb11u1
-- https://www.phpmyadmin.net/
--
-- Počítač: localhost:3306
-- Vytvořeno: Úte 16. kvě 2023, 11:11
-- Verze serveru: 10.5.19-MariaDB-0+deb11u2
-- Verze PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáze: `cineDB`
--

-- --------------------------------------------------------

--
-- Struktura tabulky `autori`
--

CREATE TABLE `autori` (
  `idA` int(11) NOT NULL,
  `jmeno` varchar(20) NOT NULL,
  `prijmeni` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `autori`
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
(16, 'Yutaka', 'Uemura');

-- --------------------------------------------------------

--
-- Struktura tabulky `hodnoceni`
--

CREATE TABLE `hodnoceni` (
  `idH` int(11) NOT NULL,
  `idS` int(11) NOT NULL,
  `uzivatel` varchar(20) NOT NULL,
  `hodnota` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `hodnoceni`
--

INSERT INTO `hodnoceni` (`idH`, `idS`, `uzivatel`, `hodnota`) VALUES
(1, 1, 'Pepa', 4),
(2, 1, 'asdfsadf', 1),
(3, 1, 'eeddgfd', 5),
(4, 2, 'qwdd', 2),
(5, 1, 'asd', 3);

-- --------------------------------------------------------

--
-- Struktura tabulky `serialy`
--

CREATE TABLE `serialy` (
  `idS` int(11) NOT NULL,
  `nazev` varchar(50) NOT NULL,
  `idA` int(11) NOT NULL,
  `type` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `serialy`
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
(10, 'Chainsaw Man', 7, 'tv'),
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
-- Struktura tabulky `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` varchar(64) NOT NULL,
  `profileId` int(11) DEFAULT 0,
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Vypisuji data pro tabulku `users`
--

INSERT INTO `users` (`uid`, `username`, `password`, `profileId`, `admin`) VALUES
(2, 'admin', 'efaecc0e8f3165f5d727203a99966bc2436d993c8f3c5d0a46cc5eac40968af7', 0, 1),
(7, 'Wlczak', 'e6f55bdc11809f464e92279a2725f7c6d7c6ad1270c2b68e582b62795aceb8b6', 0, 0),
(8, 'Xd', '24a8ddd4770ac9d4c37be1520e80a6948ab069661b67b065adc6c21af4c561ad', 0, 0);

--
-- Klíče pro exportované tabulky
--

--
-- Klíče pro tabulku `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`idA`);

--
-- Klíče pro tabulku `hodnoceni`
--
ALTER TABLE `hodnoceni`
  ADD PRIMARY KEY (`idH`),
  ADD KEY `tv_show` (`idS`);

--
-- Klíče pro tabulku `serialy`
--
ALTER TABLE `serialy`
  ADD PRIMARY KEY (`idS`),
  ADD KEY `authors` (`idA`);

--
-- Klíče pro tabulku `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT pro tabulky
--

--
-- AUTO_INCREMENT pro tabulku `autori`
--
ALTER TABLE `autori`
  MODIFY `idA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pro tabulku `hodnoceni`
--
ALTER TABLE `hodnoceni`
  MODIFY `idH` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pro tabulku `serialy`
--
ALTER TABLE `serialy`
  MODIFY `idS` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT pro tabulku `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Omezení pro exportované tabulky
--

--
-- Omezení pro tabulku `hodnoceni`
--
ALTER TABLE `hodnoceni`
  ADD CONSTRAINT `hodnoceni_ibfk_1` FOREIGN KEY (`idS`) REFERENCES `serialy` (`idS`);

--
-- Omezení pro tabulku `serialy`
--
ALTER TABLE `serialy`
  ADD CONSTRAINT `serialy_ibfk_1` FOREIGN KEY (`idA`) REFERENCES `autori` (`idA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
