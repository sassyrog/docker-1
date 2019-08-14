-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 10, 2019 at 05:48 PM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.17-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `GetSchwifty`

USE GetSchwifty;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `UserID` int(11) NOT NULL,
  `Role` int(11) NOT NULL DEFAULT '1',
  `Firstname` varchar(255) NOT NULL,
  `LastName` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `DateAdded` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `DateDeleted` datetime DEFAULT NULL,
  `Deleted` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`UserID`, `Role`, `Firstname`, `LastName`, `Username`, `Email`, `Password`, `DateAdded`, `DateDeleted`, `Deleted`) VALUES
(14, 1, 'rtgrgtrg', 'rgrtgrtg', 'fgfg', 'rogerndaba@gmail.co', '$2y$12$b991Fk1Yb4RYVCGCk3oJFeidnSWJAF96V4NXnvL0m/b1U4wmemCoS', '2019-05-09 22:27:24', NULL, 0),
(15, 1, 'rtgrgtrg', 'rgrtgrtger', 'hfghfhghfgh', 'dfrlkgrl@kfdf.df', '$2y$12$wZ6bm0TghkOXCq5YNzbCFedTfcDRF7dzt64w7S7qgj0udwRUEGDFS', '2019-05-09 22:32:40', NULL, 0),
(16, 1, 'rtgrgtrg', 'rgrtgrtg', 'rtgtrh', 'rogerndaba@gmail.com', '$2y$12$Ov4VRQ3D4TL6RCVVtJr1RuebIHuwxIGiNkLKQiwb4MiPJvCt3CCX.', '2019-05-09 22:54:20', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
