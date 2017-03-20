-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 13, 2017 at 11:43 PM
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
-- Table structure for table `choose_rooms`
--

CREATE TABLE `choose_rooms` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `blurb` text NOT NULL,
  `text_1` varchar(255) NOT NULL DEFAULT '',
  `room_1` int(11) NOT NULL DEFAULT '0',
  `text_2` varchar(255) NOT NULL DEFAULT '',
  `room_2` int(11) NOT NULL DEFAULT '0',
  `end_here` tinyint(4) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choose_rooms`
--

INSERT INTO `choose_rooms` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES
(1, '', 'This is route 1', 'Choose this route', 4, 'Choose this other route', 0, 0, ''),
(4, '', '@name is @age and @so is cool', 'dasd', 0, 'asdasd', 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `choose_settings`
--

CREATE TABLE `choose_settings` (
  `id` int(11) NOT NULL,
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
  `analytics_blurb` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `choose_settings`
--

INSERT INTO `choose_settings` (`id`, `title`, `root_url`, `copyright_text`, `copyright_year`, `copyright_url`, `main_page_text`, `warn_box_blurb`, `new_room_blurb`, `kill_depth`, `privacy_policy`, `enable_adsense`, `adsense_blurb`, `enable_recaptcha`, `recaptcha_public_key`, `recaptcha_private_key`, `enable_analytics`, `analytics_blurb`) VALUES
(1, 'Riskories 1', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it\'s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won\'t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9002758983777648";\r\n/* ZombieScraper */\r\ngoogle_ad_slot = "8575986931";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 0x30, '', '', 0x30, '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `color` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isAdmin` bit(1) NOT NULL DEFAULT b'0',
  `realName` varchar(32) NOT NULL,
  `soStatus` varchar(11) NOT NULL,
  `soName` varchar(32) NOT NULL,
  `age` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `color`, `password`, `isAdmin`, `realName`, `soStatus`, `soName`, `age`) VALUES
(6, 'admin', 'm', '#f00', '$2y$10$JdJIBystbrKhHqw4jiKGP.IPflKiRQtzlt2Uyj./4L0cYpLmRzTke', b'1', '', '0', '', 0),
(9, 'test1', '', '#f00', '$2y$10$ikRbtyl8vxQ/5hXVp0m9Y.KbtakBhx8pFV8pejoo6f38672nhUmke', b'0', 'Jimmy', 'married', 'Robby', 68);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `choose_rooms`
--
ALTER TABLE `choose_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `choose_settings`
--
ALTER TABLE `choose_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `choose_rooms`
--
ALTER TABLE `choose_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `choose_settings`
--
ALTER TABLE `choose_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
