-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jun 2021 om 10:46
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
CREATE DATABASE IF NOT EXISTS `dumbbellgym` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dumbbellgym`;

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
(1, 1, 'Bench Press', 'FitnessMuscels/Chest/BenchPress.png', 'FitnessMuscels/Chest/BenchPress.mp4', '3 reps X 12 sets'),
(2, 1, 'Cable Press ', 'FitnessMuscels/Chest/CablePress.png', 'FitnessMuscels/Chest/CablePress.mp4', ''),
(3, 2, 'Barbell Rows ', 'FitnessMuscels/Back/BarbellRows.png', 'FitnessMuscels/Back/BarbellRows.mp4', ''),
(4, 3, 'Biceps Curl Stang', 'FitnessMuscels/ShouldersArms/BicepsCurlStang.png', 'FitnessMuscels/ShouldersArms/BicepsCurlStang.mp4', ''),
(5, 4, 'Barbell Squat ', 'FitnessMuscels/Legs/BarbellSquat.png', 'FitnessMuscels/Legs/BarbellSquat.mp4', ''),
(6, 5, 'Push Ups ', 'FunctionalTraining/Chest/PushUps.png', 'FunctionalTraining/Chest/PushUps.mp4', ''),
(7, 6, 'Band Back  ', 'FunctionalTraining/Back/Bandback.png', 'FunctionalTraining/Back/Bandback.mp4', ''),
(8, 7, 'Russian Pushup ', 'FunctionalTraining/ShouldersArms/RussianPushUp.png', 'FunctionalTraining/ShouldersArms/RussianPushUp.mp4', ''),
(9, 8, 'Squats', 'FunctionalTraining/Legs/Squats.png', 'FunctionalTraining/Legs/Squats.mp4', ''),
(10, 9, 'Skipping ', 'CardioSession/training/Skipping.png', 'CardioSession/training/Skipping.mp4', ''),
(11, 1, 'Dumbell Press', 'FitnessMuscels/Chest/DumbellPress.png', 'FitnessMuscels/Chest/DummbellPress.mp4', ''),
(12, 2, 'Seated Cable Row', 'FitnessMuscels/Back/SeatedCableRow.png', 'FitnessMuscels/Back/SeatedCableRow.mp4', ''),
(13, 2, 'Lat Pulldown', 'FitnessMuscels/Back/LatPulldown.png', 'FitnessMuscels/Back/LatPulldown.mp4', ''),
(14, 3, 'Shoulder Press', 'FitnessMuscels/ShouldersArms/ShoulderPress.png', 'FitnessMuscels/ShouldersArms/ShoulderPress.mp4', ''),
(15, 3, 'Triceps Pushdown', 'FitnessMuscels/ShouldersArms/TricepsPushdown.png', 'FitnessMuscels/ShouldersArms/TricepsPushdown.mp4', ''),
(16, 4, 'Leg Extension', 'FitnessMuscels/Legs/LegExtension.png', 'FitnessMuscels/Legs/LegExtension.mp4', ''),
(17, 4, 'Standing Calf Raises', 'FitnessMuscels/Legs/StandingCalfRaises.png', 'FitnessMuscels/Legs/StandingCalfRaises.mp4', ''),
(18, 5, 'Diamond Pushup', 'FunctionalTraining/Chest/DiamondPushup.png', 'FunctionalTraining/Chest/DiamondPushup.mp4', ''),
(19, 5, 'Decline Pushup', 'FunctionalTraining/Chest/DeclinePushup.png', 'FunctionalTraining/Chest/DeclinePushup.mp4', ''),
(20, 6, 'Flex Hang', 'FunctionalTraining/Back/FlexHang.png', 'FunctionalTraining/Back/FlexHang.mp4', ''),
(21, 6, 'Pull Up', 'FunctionalTraining/Back/PullUp.png', 'FunctionalTraining/Back/PullUp.mp4', ''),
(22, 8, 'Jumping Squats', 'FunctionalTraining/Legs/JumpingSquats.png', 'FunctionalTraining/Legs/JumpingSquats.mp4', ''),
(23, 8, 'Walking Lunges', 'FunctionalTraining/Legs/WalkingLunges.png', 'FunctionalTraining/Legs/WalkingLunges.mp4', ''),
(26, 7, 'Dumbbell Band Biceps Currells', 'FunctionalTraining/ShouldersArms/DumbbellBandBicepsCurrells.png', 'FunctionalTraining/ShouldersArms/DumbbellBandBicepsCurrells.mp4', ''),
(27, 7, 'Pushup Press', 'FunctionalTraining/ShouldersArms/PushUpPress.png', 'FunctionalTraining/ShouldersArms/PushUpPress.mp4', ''),
(28, 9, 'Benchdip', 'CardioSession/training/Benchdip.png', 'CardioSession/training/Benchdip.mp4', ''),
(29, 9, 'Bicycle Crunch', 'CardioSession/training/BicycleCrunch.png', 'CardioSession/training/BicycleCrunch.mp4', ''),
(30, 9, 'Elbow Plank', 'CardioSession/training/ElbowPlank.png', 'CardioSession/training/ElbowPlank.mp4', ''),
(31, 9, 'Foot To Foot Cranch', 'CardioSession/training/FootToFootCranch.png', 'CardioSession/training/FootToFootCranch.mp4', ''),
(32, 9, 'Leg Raises Abs', 'CardioSession/training/LegRaisesAbs.png', 'CardioSession/training/LegRaisesAbs.mp4', ''),
(33, 9, 'Press Up', 'CardioSession/training/PressUP.png', 'CardioSession/training/PressUP.mp4', ''),
(34, 9, 'Pullup Bar', 'CardioSession/training/PullUpBar.png', 'CardioSession/training/PullUpBar.mp4', ''),
(35, 9, 'Raised Leg Plank', 'CardioSession/training/RaisedLegPlank.png', 'CardioSession/training/RaisedLegPlank.mp4', ''),
(36, 9, 'Scissors Ab', 'CardioSession/training/ScissorsAb.png', 'CardioSession/training/ScissorsAb.mp4', ''),
(37, 9, 'Sitting Twist', 'CardioSession/training/SittingTwist.png', 'CardioSession/training/SittingTwist.mp4', ''),
(38, 9, 'StepUp With Dumbbell', 'CardioSession/training/StepUpWithDumbbell.png', 'CardioSession/training/StepUpWithDumbbell.mp4', '');

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
  `productimg2` varchar(255) NOT NULL,
  `productdesc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `products`
--

INSERT INTO `products` (`productid`, `productcatagoryid`, `productname`, `productprice`, `productimg`, `productimg2`, `productdesc`) VALUES
(144, 2, 'protein', '30', '/uploads/20-06-2021/portein.png', '/uploads/20-06-2021/portein2.png', '<ul>\r\n	<li>550g</li>\r\n	<li>protein</li>\r\n</ul>\r\n'),
(145, 3, 'Fitness mat', '25', '/uploads/20-06-2021/material.png', '/uploads/20-06-2021/1200x435.jpg', '<ul>\r\n	<li>width: 180cm</li>\r\n	<li>height: 180cm</li>\r\n</ul>\r\n'),
(149, 1, 'tshirt', '15', '/uploads/21-06-2021/whitshirt(1).png', '/uploads/21-06-2021/rtfd.png', '<p>123</p>\r\n'),
(152, 1, 'short', '20', '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253A_ZH_ZH_885x.png', '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253B_ZH_ZH_290x.jpg', '<ul>\r\n	<li>short</li>\r\n	<li>&nbsp;</li>\r\n</ul>\r\n');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_catagory`
--

CREATE TABLE `product_catagory` (
  `productcatagoryid` int(11) NOT NULL,
  `p_catagoryname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product_catagory`
--

INSERT INTO `product_catagory` (`productcatagoryid`, `p_catagoryname`) VALUES
(1, 'Clothes'),
(2, 'Sports Nutrition'),
(3, 'Material');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `product_imagelibrary`
--

CREATE TABLE `product_imagelibrary` (
  `imagelibraryid` int(11) NOT NULL,
  `productid` int(11) NOT NULL,
  `imagelibraryname` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `product_imagelibrary`
--

INSERT INTO `product_imagelibrary` (`imagelibraryid`, `productid`, `imagelibraryname`) VALUES
(145, 144, '/uploads/20-06-2021/portein(1).png'),
(146, 144, '/uploads/20-06-2021/portein2(1).png'),
(150, 145, '/uploads/20-06-2021/material2.png'),
(165, 149, '/uploads/21-06-2021/shirt.jpg'),
(166, 149, '/uploads/21-06-2021/whitshirt(1).png'),
(170, 145, '/uploads/21-06-2021/1200x435(1).jpg'),
(171, 145, '/uploads/21-06-2021/material(1).png'),
(172, 149, '/uploads/21-06-2021/rtfd(1).png'),
(173, 152, '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253A_ZH_ZH_885x(1).png'),
(174, 152, '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253B_ZH_ZH_290x(1).jpg'),
(175, 152, '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253C_ZH_ZH_290x.png'),
(176, 152, '/uploads/22-06-2021/CriticalShortSageGreenGMSH3253D2_ZH_ZH_438x.png');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `subscriptions`
--

CREATE TABLE `subscriptions` (
  `user_subid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `substatus` int(11) NOT NULL,
  `subdate` date NOT NULL,
  `subprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Gegevens worden geëxporteerd voor tabel `subscriptions`
--

INSERT INTO `subscriptions` (`user_subid`, `userid`, `substatus`, `subdate`, `subprice`) VALUES
(1, 19, 1, '2021-06-16', 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `userlevel` int(11) NOT NULL,
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

INSERT INTO `users` (`userid`, `userlevel`, `useruid`, `firstname`, `lastname`, `password`, `useremail`, `userpostcode`, `useradress`, `userplaats`) VALUES
(16, 0, 'lwrdahmd', 'ahmad', 'kassem', '$2y$10$/jxdwnbpbKLIQaiOgGLb7unR5vYEq4Xzb9zQfeJjWAfajjIgshO.m', 'lwrdahmd37@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhoven'),
(17, 0, 'EnjoyNMyTime', 'ahmad', 'kassem', '$2y$10$BIxcklTKEyad0WDmbjToje5Vl9i5.lIoA4FeomKENqJw56iXlmSJa', 'gamin@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhvoen'),
(18, 0, 'RipOff20', 'ahmad', 'kassem', '$2y$10$cT3Wn93o1W5OJ7nt6c0EzetI9yITr6s3x0bIaCJJ3RrGtwNFcRNjK', 'kill@gmail.com', '5621ep', 'lorentzstraat 1', 'Eindhoven'),
(19, 0, 'misstodis', 'Duc', 'Nguyen', '$2y$10$9NvQUqy7K9HVM9uhU.jZxu116Jg1kwAa3rVmsOue9z5sC5GA8C6SW', 'nduc21312000@hotmail.com', '5754GE', 'Peellandsingel, 158', 'DEURNE'),
(20, 0, 'ducnguyen', 'khoa', 'Nguyen', '$2y$10$i45fvI3vjNMIvo1cioxMHOK1GDAX9Y.ivSXoMZBfZXPZB4laiBd2m', 'nduc2312000@gmail.com', '5709GH', 'helmond', 'Helmond');

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
-- Indexen voor tabel `product_imagelibrary`
--
ALTER TABLE `product_imagelibrary`
  ADD PRIMARY KEY (`imagelibraryid`),
  ADD KEY `productid_fk` (`productid`);

--
-- Indexen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`user_subid`),
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
  MODIFY `cursusinfoid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT voor een tabel `products`
--
ALTER TABLE `products`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;

--
-- AUTO_INCREMENT voor een tabel `product_catagory`
--
ALTER TABLE `product_catagory`
  MODIFY `productcatagoryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `product_imagelibrary`
--
ALTER TABLE `product_imagelibrary`
  MODIFY `imagelibraryid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;

--
-- AUTO_INCREMENT voor een tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `user_subid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

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
-- Beperkingen voor tabel `product_imagelibrary`
--
ALTER TABLE `product_imagelibrary`
  ADD CONSTRAINT `productid_fk` FOREIGN KEY (`productid`) REFERENCES `products` (`productid`);

--
-- Beperkingen voor tabel `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `userid_fk` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
