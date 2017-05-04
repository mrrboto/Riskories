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
#TK to drop the pre and post questions 4 drops pre 5 drops post 6 drops the comments
$drop4 = "ALTER TABLE `users` DROP `preQ_$storyT`;";
$drop5 = "ALTER TABLE `users` DROP `postQ_$storyT`;";
$drop6 = "ALTER TABLE `users` DROP `comments4_$storyT`;";
#TK
$delete = "DELETE FROM stories WHERE title='$storyT'";

mysqli_query($db, $drop1);
mysqli_query($db, $drop2);
mysqli_query($db, $drop3);
#TK execute above queries
mysqli_query($db, $drop4);
mysqli_query($db, $drop5);
mysqli_query($db, $drop6);
#TK
mysqli_query($db, $delete);

echo "<p>Story deleted</p>"; // <--
header('Location: ../admin/admin.php');
?>
