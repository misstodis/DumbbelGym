-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 02 jun 2021 om 00:17
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
-- Database: `proftaak`
--
CREATE DATABASE IF NOT EXISTS `proftaak` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `proftaak`;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `catagories`
--

DROP TABLE IF EXISTS `catagories`;
CREATE TABLE `catagories` (
  `catagoryid` int(11) NOT NULL,
  `cursusid` int(11) NOT NULL,
  `catagoryimage` varchar(255) NOT NULL,
  `catagoryname` varchar(255) NOT NULL,
  `catagorydesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `cursus`
--

DROP TABLE IF EXISTS `cursus`;
CREATE TABLE `cursus` (
  `cursusid` int(11) NOT NULL,
  `catagoryid` int(11) NOT NULL,
  `cursusvideo` text NOT NULL,
  `cursusname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

DROP TABLE IF EXISTS `products`;
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

DROP TABLE IF EXISTS `product_catagory`;
CREATE TABLE `product_catagory` (
  `productcatagoryid` int(11) NOT NULL,
  `p_catagoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE `subscriptions` (
  `userid` int(11) NOT NULL,
  `cursusid` int(11) NOT NULL,
  `substatus` varchar(255) NOT NULL,
  `subdate` date NOT NULL,
  `subprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `useruid` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `useremail` varchar(255) NOT NULL,
  `userpostcode` varchar(255) NOT NULL,
  `userhousenumber` int(5) NOT NULL,
  `useradress` varchar(255) NOT NULL,
  `userplaats` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `catagories`
--
ALTER TABLE `catagories`
  ADD PRIMARY KEY (`catagoryid`),
  ADD KEY `cursusid_catagory_fk` (`cursusid`);

--
-- Indexen voor tabel `cursus`
--
ALTER TABLE `cursus`
  ADD PRIMARY KEY (`cursusid`);

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
  ADD KEY `cursusid_fk` (`cursusid`),
  ADD KEY `userid_fk` (`userid`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`),
  ADD UNIQUE KEY `useremail` (`useremail`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `catagories`
--
ALTER TABLE `catagories`
  MODIFY `catagoryid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `cursus`
--
ALTER TABLE `cursus`
  MODIFY `cursusid` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `catagories`
--
ALTER TABLE `catagories`
  ADD CONSTRAINT `cursusid_catagory_fk` FOREIGN KEY (`cursusid`) REFERENCES `cursus` (`cursusid`);

--
-- Beperkingen voor tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_catagory_fk` FOREIGN KEY (`productcatagoryid`) REFERENCES `product_catagory` (`productcatagoryid`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `cursusid_fk` FOREIGN KEY (`cursusid`) REFERENCES `cursus` (`cursusid`),
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
