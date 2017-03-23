-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2017 at 04:17 PM
-- Server version: 5.6.34-log
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skeppslog`
--

-- --------------------------------------------------------

--
-- Table structure for table `crew`
--

CREATE TABLE IF NOT EXISTS `crew` (
  `crewID` int(11) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `Rank` int(4) NOT NULL,
  `planet` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `department` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `crew`
--

INSERT INTO `crew` (`crewID`, `firstName`, `lastName`, `sex`, `Rank`, `planet`, `status`, `department`) VALUES
(1, 'Kim', 'Persson', 'Male', 1, 'Earth', 1, 'Cleaner'),
(2, 'Bertil', 'Kopnik', 'Male', 3, 'Mars', 0, 'Pilot'),
(3, 'Anna', 'Ahl', 'Female', 2, 'Uranus', 1, 'Scientist'),
(4, 'Jöns', 'Berntsson', 'Male', 1, 'Earth', 0, 'Cleaner'),
(5, 'Jane', 'Doe', 'Female', 2, 'Mars', 1, 'Pilot');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crew`
--
ALTER TABLE `crew`
  ADD PRIMARY KEY (`crewID`),
  ADD KEY `Rank` (`Rank`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crew`
--
ALTER TABLE `crew`
  MODIFY `crewID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `crew`
--
ALTER TABLE `crew`
  ADD CONSTRAINT `crew_ibfk_1` FOREIGN KEY (`Rank`) REFERENCES `rank` (`rankID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
