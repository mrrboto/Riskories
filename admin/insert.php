<?php
  include('nav.php');
?>
<!DOCTYPE>
<html>
<head>
    <title>Admin Portal - Insert</title>
</head>
<body style="background: #efefef;">

<?php
  //readfile('nav.php');

  $name = '';
  $password = '';
  $gender = '';

    // added by SR
    $message = '';

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

		$query = mysqli_query($db, "SELECT name FROM users WHERE name='$name'");
		if (mysqli_num_rows($query) != 0)
		{
            //echo '<p>User already exists</p>';
            $message = "User already exists";
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
				//echo '<p>User added.</p>';
                $message = "User added";
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

    <div id="adminInsertAlert">

    </div>
    <?php
        /* Added by SR */
        // remove any previous message
        echo "<script type=\"text/javascript\">";
        echo "var alert = document.getElementById(\"adminInsertAlert\");";
        echo "while (alert.hasChildNodes()) {
            alert.removeChild(alert.lastChild);
        }";
        echo "</script>";

        if(strcmp($message, 'User added') == 0) {
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"adminInsertAlert\");";
            echo "var div = document.createElement(\"div\");";
            echo "div.setAttribute(\"class\", \"alert alert-success\");";
            echo "var strongTag = document.createElement(\"strong\");";
            echo "var strongText = document.createTextNode(\"Success: \");";
            echo "strongTag.appendChild(strongText);";
            echo "var divText = document.createTextNode(\"User added\");";
            echo "div.appendChild(strongTag);";
            echo "div.appendChild(divText);";
            echo "alert.appendChild(div);";
            echo "</script>";
        }
        else if(strcmp($message, 'User already exists') == 0) {
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"adminInsertAlert\");";
            echo "var div = document.createElement(\"div\");";
            echo "div.setAttribute(\"class\", \"alert alert-info\");";
            echo "var strongTag = document.createElement(\"strong\");";
            echo "var strongText = document.createTextNode(\"Info: \");";
            echo "strongTag.appendChild(strongText);";
            echo "var divText = document.createTextNode(\"User already exists\");";
            echo "div.appendChild(strongTag);";
            echo "div.appendChild(divText);";
            echo "alert.appendChild(div);";
            echo "</script>";
        }
    ?>
</div>


</body>
</html>
