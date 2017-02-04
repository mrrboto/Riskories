<?php
session_start();
if(session_destroy()) // Destroying All Sessions
{
header("Location: /Riskories/login/login.php"); // Redirecting To Home Page
}
?>