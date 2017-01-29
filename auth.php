<?php
session_start();

if (!isset($_SESSION['isAdmin']) || !$_SESSION['isAdmin']) {
    echo "not an admin";
}
else
{    
    header('Location: nav.html');
}

?>
