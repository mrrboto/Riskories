-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 20, 2017 at 05:04 PM
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
(1, '', '@name went to the beach with @so to do stuff that only a @age year old would do.', 'Choose this route', 2, 'Choose this other route', 3, 0, ''),
(2, '', 'TEST ROOM 2', 'choice 1 (r2)', 0, 'choice 2 (r2)', 0, 0, ''),
(3, '', 'YOU DIED', '', 0, '', 0, 1, '');

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
-- Table structure for table `stories`
--

DROP TABLE IF EXISTS `stories`;
CREATE TABLE IF NOT EXISTS `stories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `table_loc` varchar(60) NOT NULL,
  `place_holder` varchar(60) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `realName` varchar(32) NOT NULL DEFAULT '',
  `soStatus` varchar(11) NOT NULL DEFAULT '',
  `soName` varchar(32) NOT NULL DEFAULT '',
  `age` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `password`, `isAdmin`, `realName`, `soStatus`, `soName`, `age`) VALUES
(6, 'admin', 'm', '$2y$10$JdJIBystbrKhHqw4jiKGP.IPflKiRQtzlt2Uyj./4L0cYpLmRzTke', b'1', '', '0', '', 0),
(9, 'tester1', 'm', '$2y$10$hMiCFwubstqmldTjKU73fu5g9wTc.w9m5RqT6d8qfvBnwLcoahlLS', b'0', 'Bob', 'single', '', 68);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
