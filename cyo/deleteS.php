<?php
include('../db/config.php');
include('../db/db.php');


if(isset($_GET['story']))
{
    $storyT = $_GET['story'];
    $storyR = $storyT."_rooms";
    $storyS = $storyT."_settings";
}


$drop1 = "DROP TABLE `$storyR`";
$drop2 = "DROP TABLE `$storyS`";
$drop3 = "ALTER TABLE `users` DROP `$storyT`;";
$delete = "DELETE FROM stories WHERE title='$storyT'";

mysqli_query($db, $drop1);
mysqli_query($db, $drop2);
mysqli_query($db, $drop3);
mysqli_query($db, $delete);

echo "<p>Story deleted</p>";
header('Location: ../admin/admin.php');
?>
