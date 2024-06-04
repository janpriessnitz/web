-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2024 at 09:30 AM
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
-- Database: `haua05_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `autori`
--

CREATE TABLE `autori` (
  `id` int(10) UNSIGNED NOT NULL,
  `jmeno` text CHARACTER SET utf8 COLLATE utf8_czech_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `autori`
--

INSERT INTO `autori` (`id`, `jmeno`) VALUES
(22, 'Božena Němcová'),
(23, 'Karel Čapek'),
(24, 'Milan Kundera'),
(25, 'Jane Austen'),
(26, 'Václav Havel'),
(27, 'Astrid Lindgrenová');

-- --------------------------------------------------------

--
-- Table structure for table `knizky`
--

CREATE TABLE `knizky` (
  `id` int(10) UNSIGNED NOT NULL,
  `knizka` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `zanr` int(10) UNSIGNED DEFAULT NULL,
  `autor` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `knizky`
--

INSERT INTO `knizky` (`id`, `knizka`, `zanr`, `autor`) VALUES
(24, 'Babička', 10, 22),
(25, 'Válka s Mloky', 11, 23),
(26, 'Žert', 10, 24),
(27, 'Divá Bára', 10, 22),
(28, 'Pýcha a Předsudek', 12, 25),
(29, 'Moc Bezmocných', 16, 26),
(30, 'Pipi Dlouhá punčocha', 17, 27);

-- --------------------------------------------------------

--
-- Table structure for table `knizky_stitky`
--

CREATE TABLE `knizky_stitky` (
  `id` int(10) UNSIGNED NOT NULL,
  `knizka` int(10) UNSIGNED NOT NULL,
  `stitek` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `knizky_stitky`
--

INSERT INTO `knizky_stitky` (`id`, `knizka`, `stitek`) VALUES
(14, 24, 20),
(15, 24, 21),
(16, 30, 21),
(17, 26, 22),
(18, 26, 23),
(19, 24, 24);

-- --------------------------------------------------------

--
-- Table structure for table `recenze`
--

CREATE TABLE `recenze` (
  `id` int(10) UNSIGNED NOT NULL,
  `uzivatel` int(10) UNSIGNED NOT NULL,
  `text` text NOT NULL,
  `knizka` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `recenze`
--

INSERT INTO `recenze` (`id`, `uzivatel`, `text`, `knizka`) VALUES
(7, 4, 'skvělá knížka, mile napsaná, vždy dojme', 24),
(8, 4, 'na knihu jsem se těšila, ale musela jsem se celý čas jen cítit trapně za všechny postavy - nelíbilo', 26),
(9, 4, 'srdcovka, skvělá pro děti i po tolika letech, nezestárla', 30),
(10, 5, 'společně s RUR stále jedno z nepovedenějších scifi', 25),
(11, 5, 'už dětské knihy moc nečtu ale k této se vždy rád vrátím', 30),
(12, 4, 'jenom banda lidí co k sobě navzájem chodí na oběd PROČ', 28);

-- --------------------------------------------------------

--
-- Table structure for table `stitky`
--

CREATE TABLE `stitky` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazev` varchar(256) NOT NULL,
  `id_vlastnik` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `stitky`
--

INSERT INTO `stitky` (`id`, `nazev`, `id_vlastnik`) VALUES
(18, '10/10', 3),
(20, 'moc se mi nelíbilo', 3),
(22, 'nelíbilo', 4),
(23, 'povinná', 4),
(24, 'rozečteno', 5),
(21, 'z dětství', 4);

-- --------------------------------------------------------

--
-- Table structure for table `uzivatele`
--

CREATE TABLE `uzivatele` (
  `id` int(10) UNSIGNED NOT NULL,
  `jmeno` varchar(256) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `email` varchar(256) NOT NULL,
  `heslo` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `uzivatele`
--

INSERT INTO `uzivatele` (`id`, `jmeno`, `email`, `heslo`) VALUES
(3, 'xXCtenarXx', 'extrem@centrum.cz', '$2y$10$jMh7QbCFMzxKHIhCEftkEOTHkwwVZ2W3LHtcYzpYr4bbpETDXiZWi'),
(4, 'Knihoholka', 'kni@ho.cz', '$2y$10$z3IjL/h2PU6qVFDq0Lz0/e4SNJUM3M8dxfRZxqTTwlycBpuuD6.za'),
(5, 'superuser', 'admin@admin', '$2y$10$NIotHPCz4xDXHujwhiv2veOI7t4x5.e.Ti/6d7xa6q1hMPruIFM86');

-- --------------------------------------------------------

--
-- Table structure for table `zanry`
--

CREATE TABLE `zanry` (
  `id` int(10) UNSIGNED NOT NULL,
  `nazev` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

--
-- Dumping data for table `zanry`
--

INSERT INTO `zanry` (`id`, `nazev`) VALUES
(16, 'esej'),
(12, 'historický román'),
(17, 'pro děti'),
(10, 'román'),
(11, 'sci-fi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `jmeno` (`jmeno`) USING HASH;

--
-- Indexes for table `knizky`
--
ALTER TABLE `knizky`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazev_autor` (`knizka`,`autor`),
  ADD KEY `zanr` (`zanr`),
  ADD KEY `autor` (`autor`);

--
-- Indexes for table `knizky_stitky`
--
ALTER TABLE `knizky_stitky`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recenze_stitek` (`knizka`),
  ADD KEY `stitek_recenze` (`stitek`);

--
-- Indexes for table `recenze`
--
ALTER TABLE `recenze`
  ADD PRIMARY KEY (`id`),
  ADD KEY `recenze` (`knizka`),
  ADD KEY `autor_komentare` (`uzivatel`);

--
-- Indexes for table `stitky`
--
ALTER TABLE `stitky`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazev_vlastnik` (`nazev`,`id_vlastnik`),
  ADD KEY `autor_stitku` (`id_vlastnik`);

--
-- Indexes for table `uzivatele`
--
ALTER TABLE `uzivatele`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `zanry`
--
ALTER TABLE `zanry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nazev` (`nazev`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autori`
--
ALTER TABLE `autori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `knizky`
--
ALTER TABLE `knizky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `knizky_stitky`
--
ALTER TABLE `knizky_stitky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `recenze`
--
ALTER TABLE `recenze`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `stitky`
--
ALTER TABLE `stitky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `zanry`
--
ALTER TABLE `zanry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `knizky`
--
ALTER TABLE `knizky`
  ADD CONSTRAINT `autor` FOREIGN KEY (`autor`) REFERENCES `autori` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `zanr` FOREIGN KEY (`zanr`) REFERENCES `zanry` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `knizky_stitky`
--
ALTER TABLE `knizky_stitky`
  ADD CONSTRAINT `knizka_stitek` FOREIGN KEY (`knizka`) REFERENCES `knizky` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `stitek_knizka` FOREIGN KEY (`stitek`) REFERENCES `stitky` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `recenze`
--
ALTER TABLE `recenze`
  ADD CONSTRAINT `autor_komentare` FOREIGN KEY (`uzivatel`) REFERENCES `uzivatele` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `knizka` FOREIGN KEY (`knizka`) REFERENCES `knizky` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `stitky`
--
ALTER TABLE `stitky`
  ADD CONSTRAINT `autor_stitku` FOREIGN KEY (`id_vlastnik`) REFERENCES `uzivatele` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
