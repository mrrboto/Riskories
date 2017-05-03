<?php
   include('nav.php');

  if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
  } else {
    header('Location: select.php');
  }
?><!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body style="background: #efefef;">
    <div class="container">
        <?php

          $name = '';
          $gender = '';

          if (isset($_POST['submit'])) {
            $ok = true;
            if (!isset($_POST['name']) || $_POST['name'] === '') {
                $ok = false;
            } else {
                $name = $_POST['name'];
            }
            if (!isset($_POST['gender']) || $_POST['gender'] === '') {
                $ok = false;
            } else {
                $gender = $_POST['gender'];
            }


            if ($ok) {

                $sql = sprintf("UPDATE users SET name='%s', gender='%s'
                  WHERE id=%s",
                  mysqli_real_escape_string($db, $name),
                  mysqli_real_escape_string($db, $gender),
                  $id);
                mysqli_query($db, $sql);
                echo '<p>User updated.</p>'; // <--
                mysqli_close($db);
            }
          } else {

              $sql = sprintf('SELECT * FROM users WHERE id=%s', $id);
              $result = mysqli_query($db, $sql);
              foreach ($result as $row) {
                  $name = $row['name'];
                  $gender = $row['gender'];
              }
              mysqli_close($db);
          }
        ?>
        <div class="well">
            <form method="post" action="">
                <div class="form-group">
                    <label for="name">Username: </label>
                    <input class="form-control" type="text" name="name" value="<?php
                        echo htmlspecialchars($name);
                    ?>">
                </div>
                <div class="form-group">
                    <label for="gender">Gender: </label>
                    <input type="radio" name="gender" value="f"<?php
                        if ($gender === 'f') {
                            echo ' checked'; // <--
                        }
                    ?>>Female
                    <input type="radio" name="gender" value="m"<?php
                        if ($gender === 'm') {
                            echo ' checked'; // <--
                        }
                    ?>>Male<br>
                </div>

                <input class="btn btn-primary" type="submit" name="submit" value="Submit">
            </form>
        </div>
    </div>
</body>
</html>
