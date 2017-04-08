<?php
    include('nav.php');

	$realName = '';
	$soStatus = '';
	$soName = '';
	$gender = '';
	$age = '';

	if (isset($_POST['saveBtn']))	{
		$ok = false;
		$okRN = true;
		$okSON = true;
		$okSOS = true;
		$okG = true;
		$okA = true;
		if (!isset($_POST['realName']) || $_POST['realName'] === '') {
			$okRN = false;
		} else {
			$ok = true;
			$name = $_POST['realName'];
		}
		if (!isset($_POST['soStatus']) || $_POST['soStatus'] === '') {
			$okSOS = false;
		} else {
			$ok = true;
			$soStatus = $_POST['soStatus'];
		}
		if (!isset($_POST['soName']) || $_POST['soName'] === '') {
			$okSON = false;
		} else {
			$ok = true;
			$soName = $_POST['soName'];
		}
		if (!isset($_POST['gender']) || $_POST['gender'] === '') {
			$okG = false;
		} else {
			$ok = true;
			$gender = $_POST['gender'];
		}
		if (!isset($_POST['age']) || $_POST['age'] === '') {
			$okA = false;
		} else {
			$ok = true;
			$age = $_POST['age'];
		}

		if($ok){
            include('../db/config.php');
            include('../db/db.php');
			if($okRN){
				$sql = sprintf(
				"UPDATE users
				SET `realName`='%s'
				WHERE name='%s'",
				mysqli_real_escape_string($db,$_POST['realName']),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okSOS){
				//check if soName needs to be cleared
				$clar = 0;
				if($_POST['soStatus'] === 'single'){
					$clar=1;
				}
				$sql = sprintf(
				"UPDATE users
				SET `soStatus`='%s'
				WHERE name='%s'",
				$_POST['soStatus'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);

				if($clar==1){
					$sql = sprintf(
					"UPDATE users
					SET `soName`='%s'
					WHERE name='%s'",
					mysqli_real_escape_string($db,'friend'),
					$_SESSION['user']);
					$query = mysqli_query($db, $sql);
				}
			}
			if($okSON){
				$sql = sprintf(
				"UPDATE users
				SET `soName`='%s'
				WHERE name='%s'",
				mysqli_real_escape_string($db,$_POST['soName']),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okG){
				$sql = sprintf(
				"UPDATE users
				SET `gender`='%s'
				WHERE name='%s'",
				mysqli_real_escape_string($db,$_POST['gender']),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okA){
				$sql = sprintf(
				"UPDATE users
				SET `age`= %s
				WHERE name='%s'",
				mysqli_real_escape_string($db,$_POST['age']),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}

            mysqli_close($db);
		}
		header("Location: profile.php");
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Portal - Demographics</title>
    </head>
    <body onload="changeSOS()" style="background: #efefef;">

		<script>

            function changeSOS(){
                var l = document.getElementById("soStatus").value
                var son = document.getElementById("soName")
                var sonL = document.getElementById("SONLbl")
                if (l=="dating" || l=="married"){
                    son.style.visibility = "visible"
                    sonL.style.visibility = "visible"
                }
                else{
                    son.style.visibility = "hidden"
                    sonL.style.visibility = "hidden"
                }
            }

            function back(){
                window.history.back();
            }

        </script>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Edit Demographics</h4>
                </div>
                <!-- EXTRA SAVE BUTTON
                <div class="col-md-1 col-md-offset-5">
                    <a class="btn btn-primary btn-sm pull-right">Save</a>
                </div>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Please enter your demographic information (blank fields will not be updated):</div>
                <div class="panel-body">
                <!--
                <em>
                    Please enter your demographic information (blank fields will not be updated):
                </em>
                -->
                <form method="post" id="reg-form" action="">
                        <div class="form-group">
                    <label for="realName">First Name:</label>
                    <input type="text" class="form-control" name="realName" placeholder="">
                    </div>
                        <div class="form-group">
                    <label for="age">Age:</label>
                    <input type="text" class="form-control" name="age" placeholder="">
                    </div>
                        <div class="form-group">
                      <label for="gender">Gender: </label>
                      <select class="form-control" name="gender" id="gender">
                                <option value="">Please Select One</option>
                                <option id="female" value="f">Female</option>
                                <option id="male" value ="m">Male</option>
                      </select>
                    </div>
                        <div class="form-group">
                      <label for="maritalStatus">Marital Status: </label>
                      <select class="form-control" name="soStatus" id="soStatus"  onchange="changeSOS()">
                            <option value="">Please Select One</option>
                            <option name="single" id="single" value="single">Single</option>
                            <option name="dating" id="dating" value="dating">Dating</option>
                            <option name="married" id="married" value="married">Married</option>
                      </select>
                    </div>
                        <div class="form-group" id="SONLbl">
                    <label for="soName">Significant Other Name:</label>
                    <input type="text" class="form-control" name="soName" id="soName" placeholder="">
                    </div>

                        <div class="dem-save">
                            <button type="submit" name="saveBtn" class="btn btn-primary">Save</button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
    </body>
</html>
