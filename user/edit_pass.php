<?php
    include('nav.php');

  $message = '';
  //checks if save button is pressed
  if(isset($_POST['saveBtn'])){

     //this call selects only current user from database
     $queryString = sprintf("SELECT * FROM `users` WHERE name='%s'", $_SESSION['user']);
     $res = mysqli_query($db,$queryString);
     $spec = mysqli_fetch_assoc($res);

    if(password_verify($_POST['currPass'],$spec["password"]) && ($_POST['newPass']!=='' && isset($_POST['newPass'])) && ($_POST['confirmPass']!=='' && isset($_POST['confirmPass'])) && (($_POST['newPass']) === ($_POST['confirmPass'])) ) {
      $hashed = password_hash($_POST['newPass'], PASSWORD_DEFAULT);
      $sql = sprintf(
      "UPDATE users
      SET password='%s'
      WHERE name='%s'",
      mysqli_real_escape_string($db,$hashed),
      $_SESSION['user']);
      $query = mysqli_query($db, $sql);
      $message = 'Your password has been changed';
    }
    else if(!password_verify($_POST['currPass'],$spec["password"])){
      $message = 'The wrong current password has been entered';
    }
    else if(!($_POST['newPass']!=='' && isset($_POST['newPass']))){
      $message = 'You forgot to put in a new password';
    }
    else if(!($_POST['confirmPass']!=='' && isset($_POST['confirmPass']))){
      $message = 'You forgot to retype your new password';
    }
    else /*if(isset($_POST['newPass']) !== isset($_POST['confirmPass']))*/ {
      $message = 'New password and Confirm password are not the same';
    }


    mysqli_close($db);

  }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Portal - Change Password</title>
    </head>
    <body style="background: #efefef;">

      <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h4>Change Password</h4>
            </div>
            <!-- OTHER PASSWORD BUTTON
            <div class="col-md-1 col-md-offset-5">
                <a class="btn btn-primary btn-sm pull-right">Update Password</a>
            </div>-->
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Please enter your current password, then enter your new password:</div>
            <div class="panel-body">
            <!--
            <em>
                Please enter your current password, then enter your new password:
            </em>
            -->
                <form method="post" id="reg-form" action="">
                        <div class="form-group">
                        <label for="currPass">Old Password:</label>
                        <input type="password" class="form-control" name="currPass" placeholder="">
                    </div>
                        <div class="form-group">
                        <label for="newPass">New Password:</label>
                        <input type="password" class="form-control" name="newPass" placeholder="">
                    </div>
                        <div class="form-group">
                        <label for="confirmPass">Confirm New Password:</label>
                        <input type="password" class="form-control" name="confirmPass" placeholder="">
                    </div>
                        <div class="dem-save">
                            <button type="submit" name="saveBtn" class="btn btn-primary">Update Password</button>
                        </div>

                    </form>
             </div>
        </div>
        <div id="editPassAlert">

        </div>
        <?php
            /*echo "<p>$message</p>";*/
            /* Added by SR */
            // remove any previous message
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"editPassAlert\");";
            echo "while (alert.hasChildNodes()) {
                alert.removeChild(alert.lastChild);
            }";
            echo "</script>";

            if(strcmp($message, 'Your password has been changed') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"editPassAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-success\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Success: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"Your password has been changed\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }

            else if(strcmp($message, 'The wrong current password has been entered') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"editPassAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-danger\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Error: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"The wrong current password has been entered\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }

            else if(strcmp($message, 'You forgot to put in a new password') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"editPassAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-danger\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Error: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"You forgot to put in a new password\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }

            else if(strcmp($message, 'You forgot to retype your new password') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"editPassAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-danger\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Error: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"You forgot to retype your new password\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }

            else if(strcmp($message, 'New password and Confirm password are not the same') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"editPassAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-danger\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Error: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"New password and Confirm password are not the same\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }
            /* End Added by SR */
        ?>
      </div>
</body>
</html>
