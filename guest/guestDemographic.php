<?php
	if(!isset($_GET['gpage'])){
		session_start();
	}
    include('../db/config.php');
	include('../db/db.php');

	if (isset($_POST['saveBtn']) && !isset($_GET['gpage']))	{
		$_SESSION['realName'] = $_POST['realName'];
		$_SESSION['soStatus'] = $_POST['soStatus'];
		$_SESSION['soName'] = $_POST['soName'];
		$_SESSION['gender'] = $_POST['gender'];
		$_SESSION['age'] = $_POST['age'];

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
            <div>
                blank fields will not be used
                <div class="panel-body">
                <!--
                <em>
                    Please enter your demographic information (blank fields will not be updated):
                </em>
                -->
                <form method="post" id="reg-form" action="">
                    <?php #THIS WILL FILL IN THE FIELD IF THE USER HAS INPUT DEMOGRAPHICS
					if($_SESSION['realName']!=''){
						$realName =$_SESSION['realName'];
							echo "	<div class=\"form-group\">
									<label for=\"realName\">First Name:</label>
									<input type=\"text\" class=\"form-control\" name=\"realName\" placeholder=\"\" value=$realName>
									</div> ";
					} else { ?>
						<div class="form-group">
						<label for="realName">First Name:</label>
						<input type="text" class="form-control" name="realName" placeholder="">
						</div>
					<?php }

					#THIS WILL FILL IN THE FIELD IF THE USER HAS INPUT DEMOGRAPHICS
					if($_SESSION['age']!=''){
						$age =$_SESSION['age'];
							echo "	<div class=\"form-group\">
									<label for=\"age\">Age:</label>
									<input type=\"text\" class=\"form-control\" name=\"age\" placeholder=\"\" value=$age>
									</div>";
					} else { ?>
						<div class="form-group">
						<label for="age">Age:</label>
						<input type="text" class="form-control" name="age" placeholder="">
						</div>
					<?php } ?>

					<div class="form-group">
					<label for="gender">Gender: </label>
					<select class="form-control" name="gender" id="gender">
						<?php
							if($_SESSION['gender']==''){
                               echo "<option value=\"\">Please Select One</option>";
							}
							if($_SESSION['gender']=='f'){
								echo "<option id=\"female\" value=\"f\" selected=\"selected\">Female</option>";
							} else{
                                echo "<option id=\"female\" value=\"f\">Female</option>";
							}
							if($_SESSION['gender']=='m'){
								echo "<option id=\"male\" value=\"m\" selected=\"selected\">Male</option>";
							} else {
                                echo "<option id=\"male\" value =\"m\">Male</option>";
							} ?>
                    </select>
                    </div>
                        <div class="form-group">
                      <label for="maritalStatus">Marital Status: </label>
                      <select class="form-control" name="soStatus" id="soStatus"  onchange="changeSOS()">
                            <?php
							if ($_SESSION['soStatus']==''){
								echo "<option value=\"\">Please Select One</option>";
							}
							if ($_SESSION['soStatus']=='single'){
								echo "<option name=\"single\" id=\"single\" value=\"single\" selected=\"selected\">Single</option>";
							}else{
								echo "<option name=\"single\" id=\"single\" value=\"single\">Single</option>";
							}
							if ($_SESSION['soStatus']=='dating'){
								echo "<option name=\"dating\" id=\"dating\" value=\"dating\" selected=\"selected\">Dating</option>";
							}else{
								echo "<option name=\"dating\" id=\"dating\" value=\"dating\">Dating</option>";
							}
							if ($_SESSION['soStatus']=='married'){
								echo "<option name=\"married\" id=\"married\" value=\"married\" selected=\"selected\">Married</option>";
							} else {
								echo "<option name=\"married\" id=\"married\" value=\"married\">Married</option>";
							}
							?>
                      </select>
                    </div>
					<?php
					if ($_SESSION['soName']!=''){
						$soName = $_SESSION['soName'];
						echo 	"<div class=\"form-group\" id=\"SONLbl\">
								<label for=\"soName\">Significant Other Name:</label>
								<input type=\"text\" class=\"form-control\" name=\"soName\" id=\"soName\" placeholder=\"\" value=$soName>
								</div>";
					} else { ?>
						<div class="form-group" id="SONLbl">
						<label for="soName">Significant Other Name:</label>
						<input type="text" class="form-control" name="soName" id="soName" placeholder="">
						</div>
					<?php }
					if(!isset($_GET['gpage'])){
                        echo "<div class=\"dem-save\">
								<button type=\"submit\" name=\"saveBtn\" class=\"btn btn-primary\">Continue</button>
							</div>";
					}
					?>

                    </form>
                    </div>
                </div>
            </div>
    </body>
</html>
