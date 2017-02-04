<?php
include('user_auth.php');
//testing user auth if admin or not
//echo $_SESSION['isAdmin'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Your Home Page</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['user']; ?></i></b>
<b id="logout"><a href="logout.php">Log Out</a></b>
</div>
</body>
</html>