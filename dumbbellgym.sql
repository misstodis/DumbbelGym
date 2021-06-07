-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 07 jun 2021 om 08:57
-- Serverversie: 10.4.17-MariaDB
-- PHP-versie: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dumbbellgym`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `categories`
--

CREATE TABLE `categories` (
  `catagoryid` int(11) NOT NULL,
  `catagoryname` varchar(255) NOT NULL,
  `catagoryimage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `categories`
--

INSERT INTO `categories` (`catagoryid`, `catagoryname`, `catagoryimage`) VALUES
(1, 'Fitness Muscles Building', 'Muscles.png'),
(2, 'Functional Training', 'functional.png'),
(3, 'Cardio Session', 'carido.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cursus`
--

CREATE TABLE `cursus` (
  `cursusid` int(11) NOT NULL,
  `catagoryid` int(11) NOT NULL,
  `cursusname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `cursus`
--

INSERT INTO `cursus` (`cursusid`, `catagoryid`, `cursusname`) VALUES
(1, 1, 'Chest-FMB'),
(2, 1, 'Back-FMB'),
(3, 1, 'Shoulder & Arm-FMB'),
(4, 1, 'Legs-FMB'),
(5, 2, 'Chest-FT'),
(6, 2, 'Back-FT'),
(7, 2, 'Shoulder & Arm-FT'),
(8, 2, 'Legs-FT'),
(9, 3, 'Training-CD');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cursus_info`
--

CREATE TABLE `cursus_info` (
  `cursusinfoid` int(11) NOT NULL,
  `cursusid` int(11) NOT NULL,
  `cursusinfoname` varchar(255) NOT NULL,
  `cursusinfoimage` varchar(255) NOT NULL,
  `cursusinfovideo` varchar(255) NOT NULL,
  `cursusinforeps` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `cursus_info`
--

INSERT INTO `cursus_info` (`cursusinfoid`, `cursusid`, `cursusinfoname`, `cursusinfoimage`, `cursusinfovideo`, `cursusinforeps`) VALUES
(1, 1, 'Bench Press', 'FitnessMuscels/Chest/BenchPress.png', 'FitnessMuscels/Chest/BenchPress.mp4', ''),
(2, 1, 'Cable Press ', 'FitnessMuscels/Chest/CablePress.png', 'FitnessMuscels/Chest/CablePress.mp4', ''),
(3, 2, 'Barbell Rows ', '', '', ''),
(4, 3, 'Biceps Curl Stand', '', '', ''),
(5, 4, 'Squat ', '', '', ''),
(6, 5, 'PushUps ', '', '', ''),
(7, 6, 'Band Back  ', '', '', ''),
(8, 7, 'Russian Pushup ', '', '', ''),
(9, 8, 'Squats', '', '', ''),
(10, 9, 'Skipping ', '', '', ''),
(11, 1, 'DumbellPress', 'FitnessMuscels/Chest/DumbellPress.png', 'FitnessMuscels/Chest/DummbellPress.mp4', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE `products` (
  `productid` int(11) NOT NULL,
  `productcatagoryid` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `productprice` varchar(255) NOT NULL,
  `productimg` varchar(255) NOT NULL,
  `productdesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_catagory`
--

CREATE TABLE `product_catagory` (
  `productcatagoryid` int(11) NOT NULL,
  `p_catagoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `userid` int(11) NOT NULL,
  `substatus` varchar(255) NOT NULL,
  `subdate` date NOT NULL,
  `subprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `useruid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpostcode` varchar(255) NOT NULL,
  `useradress` varchar(255) NOT NULL,
  `userplaats` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userid`, `useruid`, `firstname`, `lastname`, `password`, `useremail`, `userpostcode`, `useradress`, `userplaats`) VALUES
(16, 'lwrdahmd', 'ahmad', 'kassem', '$2y$10$/jxdwnbpbKLIQaiOgGLb7unR5vYEq4Xzb9zQfeJjWAfajjIgshO.m', 'lwrdahmd37@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhoven'),
(17, 'EnjoyNMyTime', 'ahmad', 'kassem', '$2y$10$BIxcklTKEyad0WDmbjToje5Vl9i5.lIoA4FeomKENqJw56iXlmSJa', 'gamin@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhvoen'),
(18, 'RipOff20', 'ahmad', 'kassem', '$2y$10$cT3Wn93o1W5OJ7nt6c0EzetI9yITr6s3x0bIaCJJ3RrGtwNFcRNjK', 'kill@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhoven');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catagoryid`);

--
-- Indexen voor tabel `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`cursusid`),
  ADD KEY `catagoryid_fk` (`catagoryid`);

--
-- Indexen voor tabel `cursus_info`
--
ALTER TABLE `cursus_info`
  ADD PRIMARY KEY (`cursusinfoid`),
  ADD KEY `cursusid_fk` (`cursusid`);

--
-- Indexen voor tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`productid`),
  ADD KEY `product_catagory_fk` (`productcatagoryid`);

--
-- Indexen voor tabel `product_catagory`
--
ALTER TABLE `product_catagory`
  ADD PRIMARY KEY (`productcatagoryid`);

--
-- Indexen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD KEY `userid_fk` (`userid`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `useremail` (`useremail`),
  ADD UNIQUE KEY `useruid` (`useruid`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `catagoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `cursus`
--
ALTER TABLE `cursus`
  MODIFY `cursusid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `cursus_info`
--
ALTER TABLE `cursus_info`
  MODIFY `cursusinfoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `product_catagory`
--
ALTER TABLE `product_catagory`
  MODIFY `productcatagoryid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `cursus`
--
ALTER TABLE `cursus`
  ADD CONSTRAINT `catagoryid_fk` FOREIGN KEY (`catagoryid`) REFERENCES `categories` (`catagoryid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `cursus_info`
--
ALTER TABLE `cursus_info`
  ADD CONSTRAINT `cursusid_fk` FOREIGN KEY (`cursusid`) REFERENCES `cursus` (`cursusid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_catagory_fk` FOREIGN KEY (`productcatagoryid`) REFERENCES `product_catagory` (`productcatagoryid`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
