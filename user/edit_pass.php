<!DOCTYPE html>
<html>
<head>
<!--  ?><script>alert("it works")</script>< ?php -->
</head>
<body>

  <div class="container">
  	<div class="row">
  		<div class="col-md-6">
  			<h4>Change Password</h4>
  		</div>
  		<div class="col-md-1 col-md-offset-5">
  			<a class="btn btn-primary btn-sm pull-right">Update Password</a>
  		</div>
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
  </div>

<?php
  $message = '';
  //checks if save button is pressed
  if(isset($_POST['saveBtn'])){
     $db = mysqli_connect('localhost', 'root', '', 'riskories');
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

  }
  echo "<p>$message</p>";
?>

<div name="input_div">
</div>
</body>
</html>
