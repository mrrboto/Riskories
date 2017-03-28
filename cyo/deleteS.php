<?php
include('../cyo/config.php');
include('../cyo/db.php');
error_reporting(E_ALL ^ E_DEPRECATED);
?>

<?php

if(isset($_GET['story']))
{
    $storyT = $_GET['story'];
    $storyR = $storyT."_rooms";
    $storyS = $storyT."_settings";
}


mysql_select_db("riskories", $db);

$drop1 = "DROP TABLE $storyR";
$drop2 = "DROP TABLE $storyS";
$drop3 = "ALTER TABLE `users` DROP `$storyT`;";
$delete = "DELETE FROM stories WHERE title='$storyT'";

mysql_query($drop1,$db);
mysql_query($drop2,$db);
mysql_query($drop3,$db);
mysql_query($delete,$db);

echo "<p>Story deleted</p>";
header('Location: ../admin/nav.php');
?>
