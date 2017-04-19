<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
    mysqli_close($connection);
    header("Location: ../login/login.php"); // Redirecting To Home Page
}
?>
