-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2017 at 03:35 AM
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
-- Table structure for table `choose_rooms`
--

DROP TABLE IF EXISTS `choose_rooms`;
CREATE TABLE IF NOT EXISTS `choose_rooms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `blurb` text NOT NULL,
  `text_1` varchar(255) NOT NULL DEFAULT '',
  `room_1` int(11) NOT NULL DEFAULT '0',
  `text_2` varchar(255) NOT NULL DEFAULT '',
  `room_2` int(11) NOT NULL DEFAULT '0',
  `end_here` tinyint(4) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choose_rooms`
--

INSERT INTO `choose_rooms` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES
(3, '', 'This is route 1', 'Choose this route', 0, 'Choose this other route', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `choose_settings`
--

DROP TABLE IF EXISTS `choose_settings`;
CREATE TABLE IF NOT EXISTS `choose_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) DEFAULT NULL,
  `root_url` varchar(128) DEFAULT NULL,
  `copyright_text` varchar(64) DEFAULT NULL,
  `copyright_year` int(11) DEFAULT NULL,
  `copyright_url` varchar(128) DEFAULT NULL,
  `main_page_text` text,
  `warn_box_blurb` text,
  `new_room_blurb` text,
  `kill_depth` int(11) DEFAULT NULL,
  `privacy_policy` text,
  `enable_adsense` binary(1) DEFAULT NULL,
  `adsense_blurb` text,
  `enable_recaptcha` binary(1) DEFAULT NULL,
  `recaptcha_public_key` varchar(64) DEFAULT NULL,
  `recaptcha_private_key` varchar(64) DEFAULT NULL,
  `enable_analytics` binary(1) DEFAULT NULL,
  `analytics_blurb` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choose_settings`
--

INSERT INTO `choose_settings` (`id`, `title`, `root_url`, `copyright_text`, `copyright_year`, `copyright_url`, `main_page_text`, `warn_box_blurb`, `new_room_blurb`, `kill_depth`, `privacy_policy`, `enable_adsense`, `adsense_blurb`, `enable_recaptcha`, `recaptcha_public_key`, `recaptcha_private_key`, `enable_analytics`, `analytics_blurb`) VALUES
(1, 'Riskories 1', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it''s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won''t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9002758983777648";\r\n/* ZombieScraper */\r\ngoogle_ad_slot = "8575986931";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 0x30, '', '', 0x30, '');

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
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `color`, `password`, `isAdmin`) VALUES
(7, 'tester1', 'f', '#f00', '$2y$10$su6F2fUpgrnPPwia2LjJ6e8zs5OZz0xsWlPbSnwqdglTyhEqjxLfG', b'0'),
(8, 'admin', 'm', '#f00', '$2y$10$NKC6chuMrYVR2n.SmUg4fOCQcMyaKSdF5Tb.p7oU0IsRmGuUO7C6u', b'1'),
(13, 'newuser', 'm', '#0f0', '$2y$10$U6a1jhyCsUpTcZvkRgjZXuZ2vmGQMOQhUV1U1R1PpkmYX4wg36nE2', b'0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
