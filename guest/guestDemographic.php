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

            <!-- Latest compiled and minified CSS -->
            <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
                  integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
            <!-- Latest compiled and minified JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
            </script>

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

        <div class="navbar">
         <nav class="container navbar-inverse">
             <div class="container-fluid">
                 <!-- Brand and toggle get grouped for better mobile display -->
                 <div class="navbar-header">
                     <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                         data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                         <span class="sr-only">Toggle navigation</span>
                         <span class="icon-bar"></span>
                         <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                     </button>
                     <span class='navbar-brand'>
                       <img alt='Brand' src='../img/s_logo_3.png' height='45px' width='40px' style='padding-bottom: 20px'>
                     </span>
                 </div>

                 <!-- Collect the nav links, forms, and other content for toggling -->
                 <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                     <ul class="nav navbar-nav navbar-right">
                         <li><a href='../index.html'><span class='glyphicon glyphicon-log-out'></span>Exit</a></li>
                    </ul>
                 </div><!-- /.navbar-collapse -->
             </div><!-- /.container-fluid -->
         </nav>
        </div>


        <div class="container">
            <!--<div class="row"></div>
                <div class="col-md-6">
                    <h4>Enter your Demographics (optional)</h4>
                </div> -->
                <!-- EXTRA SAVE BUTTON
                <div class="col-md-1 col-md-offset-5">
                    <a class="btn btn-primary btn-sm pull-right">Save</a>
                </div>-->
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Enter your Demographics (optional)</h4> <small>blank fields will not be used</small></div>
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
                    </div> <!-- end panel body -->
                </div>
            </div>
    </body>
</html>
