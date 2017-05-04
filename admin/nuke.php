<?php
//KR Nuke Export
//Include config and db files for easy sql connection
include('../db/config.php');
include('../db/db.php');

 session_start();

 $sqli = 'DELETE FROM users WHERE isAdmin != 1';
 $result = mysqli_query($db, $sqli);
 mysqli_close($db);

header("Location: ../admin/admin.php");
