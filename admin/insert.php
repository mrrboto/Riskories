<?php
  include('admin_auth.php');
?>
<!DOCTYPE>
<html>
<head>
    <title>Admin Portal - Insert</title>
</head>
<body>

<?php
  readfile('nav.php');

  $name = '';
  $password = '';
  $gender = '';


  if (isset($_POST['submit'])) {
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
            echo '<p>User already exists</p>';
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
				echo '<p>User added.</p>';
		}


    }
  }
?>

<div class="container">

  <div class="row">
    <div class="col-md-6">
      <h4>Insert</h4>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading">Insert a new user into the database</div>
      <div class="panel-body">
        <form method="post" action="">
          <div class="form-group">
            <label for="name">Username:</label>
            <input type="text" class="form-control" name="name" placeholder="" value="<?php
                echo htmlspecialchars($name);
            ?>">
          </div>
          <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="" value="<?php
                echo htmlspecialchars($name);?>">
          </div>

          <div class="form-group">
            <label for="gender">Gender:</label><br>
            <label class="radio-inline"><input type="radio" name="gender" value="f"<?php
                if ($gender === 'f') {
                    echo ' checked';
                }
            ?>>Female</label>
            <label class="radio-inline"><input type="radio" name="gender" value="m"<?php
                if ($gender === 'm') {
                    echo ' checked';
                }
            ?>>Male</label>
          </div>

            <div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
  </div>
  </div>
</div>


</body>
</html>
