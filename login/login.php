<?php
  session_start();

$message = '';

if (isset($_POST['lg_username']) && isset($_POST['lg_password'])) {
    $db = mysqli_connect('localhost', 'root', '', 'riskories');
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
        mysqli_real_escape_string($db, $_POST['lg_username'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $hash = $row['password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['lg_password'], $hash)) {
            $message = 'Login successful.';
            

            $_SESSION['user'] = $row['name'];
            $_SESSION['isAdmin'] = $isAdmin;

			//Demographics logged into session
			$_SESSION['name'] = $row['realName'];
			$_SESSION['soName'] = $row['soName'];
			$_SESSION['age'] = $row['age'];
            
			if ($isAdmin == 0)
			{
				//header('Location: /Riskories/nav/nav.html');
				header('Location: /Riskories/user/profile.php');
			}
			if ($isAdmin == 1)
			{
				header('Location: /Riskories/admin/nav.php');
				//header('Location: /Riskories/nav/profile.php');
			}

        } else {
            $message = 'Login failed.';
        }
    } else {
        $message = 'Login failed.';
    }
    mysqli_close($db);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Riskories Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">    <div class="text-center">

    <img src="../img/logo_1.png" class="rounded" alt="..." width="50%">
    </div>


    </head>
<body>
<!-- All the files that are required -->
<link rel="stylesheet" href="log_style.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<!-- Where all the magic happens -->
<!-- LOGIN FORM -->
<div class="text-center" style="padding:20px 0">
	<div class="logo">login</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form method="post" id="login-form" class="text-left" action="">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
					</div>
					<div class="form-group login-group-text">
                        <a class="link" href="login.php?page=2">Register</a>
                        or log in as
                        <a class="link" href="../guest/guest.php">Guest</a>
					</div>
				</div>
				<button type="submit" class="login-button" value="Login"><i class="fa fa-chevron-right"></i></button>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
</div>
</div>
<div>
<?php

    if(isset($_GET['page']))
    {

        if ($_GET['page'] == 2)
        {
            include('reg.php');
			//echo '<iframe src="reg.php" height="300" width="500" frameborder="0" scrolling="no"></iframe>';
			echo "<p>$message</p>";
        }
    }

?>
</div>
</body>
</html>

