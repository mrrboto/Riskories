<?php
    include('../db/config.php');
	include('../db/db.php');

	if (isset($_POST['saveBtn']))	{
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
	
		#TK REDIRECT TO RANDOM Story
		$sql = sprintf("SELECT * FROM stories");
		$result = mysqli_query($db, $sql);
		$rows = mysqli_num_rows($result);
		$counter = rand(1,$rows);
		for ($i = 0; $i < $counter; $i++){
			$row = mysqli_fetch_assoc($result);
		}
		$go2 = sprintf("Location: ../cyo/index.php%s",
		"?story=".$row['title']
		);
		echo $go2;
		header($go2);
		#TK
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
                    <h4>Enter your Demographics (optional)</h4>
                </div>
                <!-- EXTRA SAVE BUTTON
                <div class="col-md-1 col-md-offset-5">
                    <a class="btn btn-primary btn-sm pull-right">Save</a>
                </div>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">blank fields will not be used</div>
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
                            <button type="submit" name="saveBtn" class="btn btn-primary">Continue</button>
                        </div>

                    </form>
                    </div>
                </div>
            </div>
    </body>
</html>
