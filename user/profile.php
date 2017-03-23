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
    <br>
    <br>
    <b id="welcome">Name : <i><?php echo $_SESSION['name']; ?></i></b>
	<div class="user-dem-link">
		<a class="link" href="profile.php?page=demographic">Edit Demographic</a>
	</div>
	<div class="user-pass-link">
		<a class="link" href="profile.php?page=password">Change Password</a>
	</div>
    <div>
        <a class="link" href="../cyo/index.php">RISKORY</a>
    </div>
</div>

<?php //display stories

    $dbi = mysqli_connect('localhost', 'root', '', 'riskories');
    $sqli = 'SELECT * FROM stories';
    $stories = mysqli_query($dbi, $sqli);

    foreach ($stories as $row)
    {
        $name = $row['title'];
        printf('<li><span><a href="../cyo/index.php?story=%s">%s</a></span></li>',
        $name,
        htmlspecialchars($row['title'])
        );
    }

?>

<?php
	if(isset($_GET['page'])){
		if($_GET['page'] == 'demographic'){
			include('demographic.php');
		}
		else if($_GET['page'] == 'password'){
			include('edit_pass.php');
		}
	}
?>

</body>
</html>
