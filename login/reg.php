<!DOCTYPE html>
<html>
<body>
<?php

  $name = '';
  $password = '';
  $gender = '';
  $color = '';
  $message = '';

  if (isset($_POST['submit'])) {
	if($_POST['password']===$_POST['newPass']){
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
			$db = mysqli_connect('localhost', 'root', '', 'riskories');
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
		}
    }else{
		$message = 'Passwords do not match';
	}
  }
?>
<div class="text-center" style="padding:10px 0">
    <div class="logo">register</div>
    <div class="reg-form-1">
        <form class="text-center" method="post" id="reg-form" action="">

        <div class="reg-group">


            User name: <input type="text" name="name" class="form-control" value="<?php
            echo htmlspecialchars($name);?>"><br>

            Password: <input type="password" name="password" class="form-control"><br>
			
			Confirm Password: <input type="password" name="newPass" class="form-control"><br>
            
			Gender:
            <input type="radio" name="gender" value="f"<?php
            if ($gender === 'f') {
                echo ' checked';
            }?>>female
            <input type="radio" name="gender" value="m"<?php
            if ($gender === 'm') {
                echo ' checked';
            }?>>male<br>
			
			
            <div class="reg-submit">
                <input type="submit" name="submit" value="Submit">
            </div>
        </div>
    </form>
</div>
</div>
</body>
</html>
