-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 05, 2017 at 09:31 PM
-- Server version: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Table structure for table `ConsentForm`
--

DROP TABLE IF EXISTS `consentForm`;
CREATE TABLE IF NOT EXISTS `consentForm` (
    `html` VARCHAR(5000) NOT NULL DEFAULT ''
) ENGINE = MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ConsentForm`
--

INSERT INTO `consentForm` (`html`) VALUES
('<h4>Title of research study:</h4>Riskories - how does being embedded in a story affect risk perceptions<h4>Investigator:</h4>Prof. Andrew Maynard<h4>Why am I being invited to take part in a research study?</h4>We invite you to take part in a research study because you have an interest in stories and risk and represent our study population.<h4>Why is this research being done?</h4>ASU, SFIS, and FSE are studying narrative as stories relate to risk perceptions.  We are enrolling persons at ASU and elsewhere as our part and to be able to cross compare our results.<h4>How long will the research last?</h4>We expect that individuals will spend on average about 5-15 minutes per story ("riskory").  The data collection will continue indefinitely as readers continue to engage with the Riskories on the app.<h4>How many people will be studied?</h4>This is unknown.  We hope that at least about 100 or so people will participate in this research study.  You must be 18 years old or older to participate in the study.<h4>What happens if I say, "yes, I want to be in this research"?</h4>You will be allowed to continue on to the app and to engage with the Riskories.  You will enter a few demographics to your profile.  Your demographics will not be known to anyone but you.  The researchers wont be able to "see" any individuals information.  You will then be able to engage with one or more Riskories that have your or anothers demographics.<h4>What happens if I say yes, but I change my mind later?</h4>You can leave the research at any time it will not be held against you.<h4>Is there any way being in this study could be bad for me?</h4>There really arent any significant risks.  You may feel some uncomfortable thoughts depending on your story choices within the Riskories and how you feel about reading about yourself.<h4>Will being in this study help me in any way?</h4>We cannot promise any benefits to you or others from your taking part in this research. However, possible benefits include increased awareness of risk and how you perceive it.  This could also result in benefits to you depending on the risks you might face in your life.   Also, it could help ASU determine how best to improve its overall risk communications.<h4>What happens to the information collected for the research?</h4>Efforts will be made to limit the use and disclosure of your personal information, including research study records, to people who have a need to review this information. We cannot promise complete secrecy. Organizations that may inspect and copy your information include the University board that reviews research and agencies who want to make sure the study researchers (us, not you) are doing their jobs correctly and protecting your information and rights.<br><br>Information will be anonymized and none of the researchers will know actual identities of study participants nor the demographic information of individual participants. The demographics will be used as an aggregate as will your story plot choices and your pre and post riskory questions.  Records will be safely stored in the administrative side of the app on ASU servers.<h4>What else do I need to know?</h4>This research is not being funded by any outside entities.  There are no financial conflicts of interest.<h4>Who can I talk to?</h4>If you have questions, concerns, or complaints, talk to the research team at:<ul><li>Jonathan Klane at (480) 965-8498 or jonathan.klane@asu.edu</li><li>Andrew Maynard at (480) 727-8831 or amaynar2@asu.edu</li></ul>This research has been reviewed and approved by the Social Behavioral IRB. You may talk to them at (480) 965-6788 or by email at research.integrity@asu.edu if:<ul><li>Your questions, concerns, or complaints are not being answered by the research team.</li><li>You cannot reach the research team.</li><li>You want to talk to someone besides the research team.</li><li>You have questions about your rights as a research participant.</li><li>You want to get information or provide input about this research.</li></ul><br>By clicking "Agree To Terms" you are granting your consent.  Thank you and enjoy your Riskories!');
/*('<h4>Title of research study:</h4><p>Riskories: how does being embedded in a story affect risk perceptions?</p>');*/



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
(1, '', '@name went to the beach with @so to do stuff that only a @age year old would do.', 'Choose this route', 2, 'Choose this other route', 3, 0, ''),
(2, '', 'TEST ROOM 2', 'choice 1 (r2)', 0, 'choice 2 (r2)', 0, 0, ''),
(3, '', 'YOU DIED', '', 0, '', 0, 1, '');

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
(1, 'dsa', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it\'s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won\'t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '<script type="text/javascript"><!--\r\ngoogle_ad_client = "ca-pub-9002758983777648";\r\n/* ZombieScraper */\r\ngoogle_ad_slot = "8575986931";\r\ngoogle_ad_width = 160;\r\ngoogle_ad_height = 600;\r\n//-->\r\n</script>\r\n<script type="text/javascript"\r\nsrc="http://pagead2.googlesyndication.com/pagead/show_ads.js">\r\n</script>', 0x30, '', '', 0x30, '');

-- --------------------------------------------------------

--
-- Table structure for table `kitten_rooms`
--

CREATE TABLE `kitten_rooms` (
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
-- Dumping data for table `kitten_rooms`
--

INSERT INTO `kitten_rooms` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES
(1, '', 'Rub kit tum?', 'no', 3, 'ye', 2, 0, ''),
(2, '', 'nu', '', 0, '', 0, 1, ''),
(3, '', 'ye', '', 0, '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `kitten_settings`
--

CREATE TABLE `kitten_settings` (
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
-- Dumping data for table `kitten_settings`
--

INSERT INTO `kitten_settings` (`id`, `title`, `root_url`, `copyright_text`, `copyright_year`, `copyright_url`, `main_page_text`, `warn_box_blurb`, `new_room_blurb`, `kill_depth`, `privacy_policy`, `enable_adsense`, `adsense_blurb`, `enable_recaptcha`, `recaptcha_public_key`, `recaptcha_private_key`, `enable_analytics`, `analytics_blurb`) VALUES
(1, 'Riskories 1', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it\'s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won\'t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '', 0x30, '', '', 0x30, '');

-- --------------------------------------------------------

--
-- Table structure for table `pupper_rooms`
--

CREATE TABLE `pupper_rooms` (
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
-- Dumping data for table `pupper_rooms`
--

INSERT INTO `pupper_rooms` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES
(1, '', 'PUPPER?', 'Woof', 2, 'Arf', 3, 0, ''),
(2, '', 'YOU WIN', '', 0, '', 0, 1, ''),
(3, '', 'YOU LOSE', '', 0, '', 0, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `pupper_settings`
--

CREATE TABLE `pupper_settings` (
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
-- Dumping data for table `pupper_settings`
--

INSERT INTO `pupper_settings` (`id`, `title`, `root_url`, `copyright_text`, `copyright_year`, `copyright_url`, `main_page_text`, `warn_box_blurb`, `new_room_blurb`, `kill_depth`, `privacy_policy`, `enable_adsense`, `adsense_blurb`, `enable_recaptcha`, `recaptcha_public_key`, `recaptcha_private_key`, `enable_analytics`, `analytics_blurb`) VALUES
(1, 'Pupper', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it\'s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won\'t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '', 0x30, '', '', 0x30, '');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `title` varchar(60) NOT NULL,
  `table_loc` varchar(60) NOT NULL,
  `place_holder` varchar(60) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stories`
--

INSERT INTO `stories` (`id`, `title`, `table_loc`, `place_holder`) VALUES
(19, 'Kitten', 'Kitten_rooms', ''),
(18, 'pupper', 'pupper_rooms', '');

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
  `pupper` varchar(255) DEFAULT NULL,
  `Kitten` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `gender`, `password`, `isAdmin`, `realName`, `soStatus`, `soName`, `age`, `Riskory_1`, `pupper`, `Kitten`) VALUES
(6, 'admin', 'm', '$2y$10$JdJIBystbrKhHqw4jiKGP.IPflKiRQtzlt2Uyj./4L0cYpLmRzTke', b'1', '', '0', '', 0, '', NULL, NULL),
(9, 'test1', 'm', '$2y$10$hMiCFwubstqmldTjKU73fu5g9wTc.w9m5RqT6d8qfvBnwLcoahlLS', b'0', 'Bob', 'single', '', 68, '', NULL, NULL),
(21, 'test2', 'm', '$2y$10$5Bxmrbdggx8QDXH0ipeZIul3lzjjhKkbUbEHMH0mrxprNSrlmTAcS', b'0', '', '', '', 0, '', NULL, NULL),
(23, 'test3', 'm', '$2y$10$TLzQqc51DlC6YQtwU2jAfebMZNfM00O6OpDYtP6zNnn5PBn2Fz/2C', b'0', '', 'dating', 'Jordan', 0, '', NULL, NULL);

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
-- Indexes for table `kitten_rooms`
--
ALTER TABLE `kitten_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kitten_settings`
--
ALTER TABLE `kitten_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupper_rooms`
--
ALTER TABLE `pupper_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupper_settings`
--
ALTER TABLE `pupper_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `choose_settings`
--
ALTER TABLE `choose_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `kitten_rooms`
--
ALTER TABLE `kitten_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kitten_settings`
--
ALTER TABLE `kitten_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `pupper_rooms`
--
ALTER TABLE `pupper_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `pupper_settings`
--
ALTER TABLE `pupper_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
