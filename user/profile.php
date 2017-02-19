<?php
include('user_auth.php');
//testing user auth if admin or not
//echo $_SESSION['isAdmin'];
?>
<!DOCTYPE>
<html>
<head>
<title>User Portal</title>
</head>
<body>
<div id="profile">
<b id="welcome">Welcome : <i><?php echo $_SESSION['user']; ?></i></b>
<b id="logout"><a href="../login/logout.php">Log Out</a></b>
</div>
</body>
</html>
