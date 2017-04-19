-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Värd: 83.168.227.23
-- Skapad: 19 april 2017 kl 15:25
-- Serverversion: 5.0.83
-- PHP-version: 4.4.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `db1164707_KimPer`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `Cars`
--

DROP TABLE IF EXISTS `Cars`;
CREATE TABLE IF NOT EXISTS `Cars` (
  `car_id` int(11) NOT NULL auto_increment,
  `carName` varchar(255) NOT NULL,
  `owner_id` int(11) NOT NULL,
  PRIMARY KEY  (`car_id`),
  KEY `fk_owner_id` (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Data i tabell `Cars`
--

INSERT INTO `Cars` (`car_id`, `carName`, `owner_id`) VALUES
(5, 'Nissan', 2),
(3, 'Saab', 2);

-- --------------------------------------------------------

--
-- Struktur för tabell `Owner`
--

DROP TABLE IF EXISTS `Owner`;
CREATE TABLE IF NOT EXISTS `Owner` (
  `owner_id` int(11) NOT NULL auto_increment,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  PRIMARY KEY  (`owner_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data i tabell `Owner`
--

INSERT INTO `Owner` (`owner_id`, `firstName`, `lastName`) VALUES
(1, 'Kim', 'Persson'),
(2, 'Sohail', 'Hasware');

DELIMITER $$
--
-- Procedurer
--


DROP PROCEDURE IF EXISTS `sp_show_all_cars`$$
CREATE DEFINER=`u1164707_KimPer`@`%` PROCEDURE `sp_show_all_cars`()
SELECT 
        Cars.car_id,
        Cars.carName AS carname,
        Owner.firstName AS fname,
        Owner.lastName AS lname
    FROM
        (Owner
        JOIN Cars ON ((Owner.owner_id = 
        Cars.owner_id)))$$

