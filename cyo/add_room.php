<?php
error_reporting(E_ALL ^ E_DEPRECATED);
?>

<?php

$title = $_POST['title'];
$room = $title."_rooms";
$room_set = $title."_settings";
//echo $title;

mysql_select_db("riskories", $db);

$sql = "CREATE TABLE `$room` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `blurb` text NOT NULL,
  `text_1` varchar(255) NOT NULL DEFAULT '',
  `room_1` int(11) NOT NULL DEFAULT '0',
  `text_2` varchar(255) NOT NULL DEFAULT '',
  `room_2` int(11) NOT NULL DEFAULT '0',
  `end_here` tinyint(4) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";


$table = "INSERT INTO `$room` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES (1, '', 'This is route 1', 'Choose this route', 0, 'Choose this other route', 0, 0, '');";

$story = "INSERT INTO `stories` (`title`, `table_loc`) VALUES ('$title', '$room');";
$user_add = "ALTER TABLE `users` ADD `$title` VARCHAR(255);";


mysql_query($sql,$db);
mysql_query($table,$db);
mysql_query($story,$db);
mysql_query($user_add, $db);

$sql2 = "CREATE TABLE `$room_set` (
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
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";

$table2 = "INSERT INTO `$room_set` (`id`, `title`, `root_url`, `copyright_text`, `copyright_year`, `copyright_url`, `main_page_text`, `warn_box_blurb`, `new_room_blurb`, `kill_depth`, `privacy_policy`, `enable_adsense`, `adsense_blurb`, `enable_recaptcha`, `recaptcha_public_key`, `recaptcha_private_key`, `enable_analytics`, `analytics_blurb`) VALUES (1, 'Riskories 1', '', 'Your Name', 2012, 'https://github.com/jeffgeiger', 'This is a Riskory...\r\n', 'This has so and so disclaimers.', 'Now it\'s time for you to create your own adventure.', 1, 'We only want your email address to distinguish your work from others in the back end of the website.  We won\'t sell it, give it away, spam you, or anything else.  Promise.', 0x31, '', 0x30, '', '', 0x30, '');";

mysql_query($sql2,$db);
mysql_query($table2,$db);


?>
