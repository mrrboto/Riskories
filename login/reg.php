<?php

  $name = '';
  $password = '';
  $gender = '';
  $color = '';
  $message = '';

    echo "<p style='text-align:center'>THIS FEATURE IS CURRENTLY DISABLED</p>";

  if (isset($_POST['submit'])) {
	if($_POST['password']===$_POST['password_cf']){
		$ok = true;
		if (!isset($_POST['name']) || $_POST['name'] === '') {
			$ok = false;
		} else {
			$name = $_POST['name'];
		}
		if (!isset($_POST['password']) || $_POST['password'] === '') {
			$ok = false;
		} else {
			$password = $_POST['password'];
		}
		if (!isset($_POST['gender']) || $_POST['gender'] === '') {
			$ok = false;
		} else {
			$gender = $_POST['gender'];
		}

		if ($ok) {
			$hash = password_hash($password, PASSWORD_DEFAULT);

			// add database code here
            include('../db/config.php');
            include('../db/db.php');
			$query = mysqli_query($db, "SELECT name FROM users WHERE name='$name'");
			if (mysqli_num_rows($query) != 0)
			{
				$message = 'Username already exists.';
			}
			else
			{
				$sql = sprintf("INSERT INTO users (name, password, gender) VALUES (
				'%s', '%s', '%s')",
				mysqli_real_escape_string($db, $name),
				mysqli_real_escape_string($db, $hash),
				mysqli_real_escape_string($db, $gender));
				mysqli_query($db, $sql);
				mysqli_close($db);
				$message = 'User added.';

				$_SESSION['user'] = $name;
				$_SESSION['isAdmin'] = 0;
				header("Location: ../user/profile.php");
			}

            mysqli_close($db);
		}
    }else{
		$message = 'Passwords do not match';
	}
  }
?>


<!--<!DOCTYPE html>
<html>
<body>
<div class="text-center" style="padding:0px 0">
<div class="logo">register</div>
<div class="login-form-1">
    <form method="post" id="login-form" class="text-center" action="">
        <div class="login-form-main-message"></div>
        <div class="main-login-form">
            <div class="login-group">
                <div class="form-group">
                    <input type="text" class="form-control" id="lg_username" name="name" placeholder="enter username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="lg_password" name="password" placeholder="enter password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="lg_password_cf" name="password_cf" placeholder="confirm password">
                </div>
                <div class="form-group">
                    Gender:
                    <input type="radio" name="gender" value="f"<?php
                    if ($gender === 'f') {
                        echo ' checked';
                    }?>>female
                    <input type="radio" name="gender" value="m"<?php
                    if ($gender === 'm') {
                        echo ' checked';
                    }?>>male<br>
                </div>
            </div>
            <button type="submit" name="submit" class="login-button" value="Login"><i class="fa fa-chevron-right"></i></button>
        </div>
    </form>
</div>
</div>
</body>
</html>-->


