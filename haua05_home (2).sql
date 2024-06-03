-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 02, 2024 at 11:11 AM
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
(1, 'Agatha Christie'),
(2, 'Karel Jaromír Erben');

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
(3, 'Hercule Poirot', 6, 1),
(4, 'Kytice', 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `knizky_stitky`
--

CREATE TABLE `knizky_stitky` (
  `id` int(10) UNSIGNED NOT NULL,
  `knizka` int(10) UNSIGNED NOT NULL,
  `stitek` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `stitky`
--

CREATE TABLE `stitky` (
  `id` int(10) UNSIGNED NOT NULL,
  `autor` int(10) UNSIGNED NOT NULL,
  `nazev` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_czech_ci;

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
(1, 'Knihomolka', 'kniho@molka.cz', '1234'),
(2, 'JitkaCteKnizky', 'jitka@knizky.com', 'boty');

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
(1, 'detektivka'),
(2, 'román'),
(6, 'sci-fi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autori`
--
ALTER TABLE `autori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `knizky`
--
ALTER TABLE `knizky`
  ADD PRIMARY KEY (`id`),
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
  ADD KEY `autor_stitku` (`autor`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `knizky`
--
ALTER TABLE `knizky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `knizky_stitky`
--
ALTER TABLE `knizky_stitky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `recenze`
--
ALTER TABLE `recenze`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stitky`
--
ALTER TABLE `stitky`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uzivatele`
--
ALTER TABLE `uzivatele`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `zanry`
--
ALTER TABLE `zanry`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  ADD CONSTRAINT `knizka_stitek` FOREIGN KEY (`knizka`) REFERENCES `knizky` (`id`),
  ADD CONSTRAINT `stitek_knizka` FOREIGN KEY (`stitek`) REFERENCES `stitky` (`id`);

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
  ADD CONSTRAINT `autor_stitku` FOREIGN KEY (`autor`) REFERENCES `uzivatele` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
