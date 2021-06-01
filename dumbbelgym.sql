-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jun 2021 om 12:14
-- Serverversie: 10.4.14-MariaDB
-- PHP-versie: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dumbbelgym`
--
CREATE DATABASE IF NOT EXISTS `dumbbelgym` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dumbbelgym`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `catagories`
--

CREATE TABLE `catagories` (
  `CatagoryId` int(11) NOT NULL,
  `CatagoryName` varchar(255) NOT NULL,
  `CatagoryImage` varchar(255) NOT NULL,
  `CatagoryDesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `catagories`
--

INSERT INTO `catagories` (`CatagoryId`, `CatagoryName`, `CatagoryImage`, `CatagoryDesc`) VALUES
(1, 'Functional Training', '', 'Functional fitness training is a type of strength training that readies your body for daily activities. These exercises equip you for the most important type of physical fitness, the kind that preps you for real-life, daily living stuff like bending, twisting, lifting, loading, pushing, pulling, squatting, and hauling.'),
(2, 'Cardio Session', '', 'Cardio training generally involves exercising at a constant moderate level of intensity, for a specified duration, during which the cardiovascular system is allowed to replenish oxygen to working muscles. Typical activities include walking, jogging, cycling, swimming, jump rope, stair climbing, and rowing.'),
(3, 'Muscle Fitness', '', 'Muscle fitness means having muscles that can lift heavier objects or muscles that will work longer before becoming exhausted. Muscle fitness improves when a person does activities that build or maintain muscles (strength) or that increase how long a person can use his or her muscles (endurance).');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cursus`
--

CREATE TABLE `cursus` (
  `CursusId` int(11) NOT NULL,
  `CursusNaam` varchar(255) NOT NULL,
  `CursusSubcatagory` varchar(255) NOT NULL,
  `CursusVideo` varchar(255) NOT NULL,
  `CatagoryId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `SubId` int(11) NOT NULL,
  `UserId` int(11) NOT NULL,
  `SubDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `SubPrice` int(5) NOT NULL,
  `SubStatus` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `UserId` int(11) NOT NULL,
  `FirstName` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `PassWord` varchar(255) NOT NULL,
  `UserEmail` varchar(255) NOT NULL,
  `UserPostCode` varchar(255) NOT NULL,
  `UserHuisNummer` varchar(255) NOT NULL,
  `UserAdress` varchar(255) NOT NULL,
  `UserPlaats` varchar(255) NOT NULL,
  `SubStatus` int(1) NOT NULL,
  `SubDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`UserId`, `FirstName`, `LastName`, `PassWord`, `UserEmail`, `UserPostCode`, `UserHuisNummer`, `UserAdress`, `UserPlaats`, `SubStatus`, `SubDate`) VALUES
(4, 'f', 'f', 'sdfs', 'sdfds', 'sdf', 'sdf', 'sdf', 'dsdsf', 0, '2021-05-21 10:44:21');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`CatagoryId`);

--
-- Indexen voor tabel `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`CursusId`),
  ADD KEY `catagory_FK` (`CatagoryId`);

--
-- Indexen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`SubId`),
  ADD KEY `UserSub_FK` (`UserId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserId`),
  ADD UNIQUE KEY `UserEmail` (`UserEmail`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `catagories`
--
ALTER TABLE `catagories`
  MODIFY `CatagoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `cursus`
--
ALTER TABLE `cursus`
  MODIFY `CursusId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `SubId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `catagory_FK` FOREIGN KEY (`CatagoryId`) REFERENCES `catagories` (`CatagoryId`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `UserSub_FK` FOREIGN KEY (`UserId`) REFERENCES `users` (`UserId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
