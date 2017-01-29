-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2017 at 01:05 AM
-- Server version: 5.7.9
-- PHP Version: 5.6.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskories`
--
CREATE DATABASE IF NOT EXISTS `riskories` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `riskories`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `color` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `color`, `password`, `isAdmin`) VALUES
(5, 'test', 'm', '#f00', '$2y$10$QhPcp6O65dfGw7U7TDMwAOpp1ckfSDUWwgNN8eTu524GRk6YyZ4M6', b'0'),
(4, 'test', 'f', '#0f0', '$2y$10$F8dIXbezLs8n7/D53kaT6ucnNCbw6nWJ/lJq9zrP4SToVFJfrs9zu', b'0'),
(6, 'admin', 'm', '#f00', '$2y$10$JdJIBystbrKhHqw4jiKGP.IPflKiRQtzlt2Uyj./4L0cYpLmRzTke', b'1');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
