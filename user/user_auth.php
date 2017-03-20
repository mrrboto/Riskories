<?php
session_start();

if(!isset($_SESSION['isAdmin']) || $_SESSION['isAdmin'] != 0){
mysqli_close($connection); // Closing Connection
header('Location: /Riskories/login/login.php'); // Redirecting To Home

}
/*
if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    echo "not an admin";
}
else
{
    header('Location: login.php');
}*/

?>
