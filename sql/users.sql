-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 04, 2017 at 06:45 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskories`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `realName` varchar(32) NOT NULL DEFAULT '',
  `soStatus` varchar(11) NOT NULL DEFAULT '',
  `soName` varchar(32) NOT NULL DEFAULT '',
  `age` int(11) DEFAULT '0',
  `Riskory_1` varchar(64) NOT NULL DEFAULT '',
  `Rage` varchar(255) DEFAULT NULL,
  `preQ_Rage` varchar(255) DEFAULT NULL,
  `postQ_Rage` varchar(255) DEFAULT NULL,
  `comments4_Rage` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `password`, `isAdmin`, `realName`, `soStatus`, `soName`, `age`, `Riskory_1`, `Rage`, `preQ_Rage`, `postQ_Rage`, `comments4_Rage`) VALUES
(6, 'admin', 'm', '$2y$10$JdJIBystbrKhHqw4jiKGP.IPflKiRQtzlt2Uyj./4L0cYpLmRzTke', b'1', '', '0', '', 0, '', NULL, NULL, NULL, NULL),
(9, 'test1', 'm', '$2y$10$hMiCFwubstqmldTjKU73fu5g9wTc.w9m5RqT6d8qfvBnwLcoahlLS', b'0', 'Bob', 'single', '', 68, '', 'generic[stock]', NULL, '1c2c3c', 'Cas'),
(21, 'test2', 'm', '$2y$10$5Bxmrbdggx8QDXH0ipeZIul3lzjjhKkbUbEHMH0mrxprNSrlmTAcS', b'0', '', '', '', 0, '', NULL, NULL, NULL, NULL),
(23, 'test3', 'm', '$2y$10$TLzQqc51DlC6YQtwU2jAfebMZNfM00O6OpDYtP6zNnn5PBn2Fz/2C', b'0', '', 'dating', 'Jordan', 0, '', NULL, NULL, NULL, NULL),
(49, 'as', 'm', '$2y$10$CP7lSnlBmxFANIXQIPMPF.PpGAJ.cnrGw.X7PnMHZLTdA7Lrhnm4S', b'0', '', '', '', 0, '', 'generic[stock]', '1a2a3d', '1c2b3c', 'ASdaes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
