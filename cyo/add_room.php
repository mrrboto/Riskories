<?php
error_reporting(E_ALL ^ E_DEPRECATED);
?>

<?php

$title = $_POST['title'];
$room = $_POST['title']."_rooms";
//echo $title;

mysql_select_db("riskories", $db);
$sql = "CREATE TABLE `$room` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL DEFAULT '',
  `blurb` text NOT NULL,
  `text_1` varchar(255) NOT NULL DEFAULT '',
  `room_1` int(11) NOT NULL DEFAULT '0',
  `text_2` varchar(255) NOT NULL DEFAULT '',
  `room_2` int(11) NOT NULL DEFAULT '0',
  `end_here` tinyint(4) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=latin1;";


$table = "INSERT INTO `$room` (`id`, `email`, `blurb`, `text_1`, `room_1`, `text_2`, `room_2`, `end_here`, `ip`) VALUES (1, '', 'This is route 1', 'Choose this route', 4, 'Choose this other route', 0, 0, '');";

$story = "INSERT INTO `stories` (`title`, `table_loc`) VALUES ('$title', '$room');";


mysql_query($sql,$db);
mysql_query($table,$db);
mysql_query($story,$db);






?>
