<?php
    //include('../user/nav.php');
	session_start();
	$postQs = '';
	$postQ1= '';
	$postQ2 = '';
	$postQ3 = '';
	$comments ='';
	$story = $_GET['story'];
	$_SESSION['storyN'] = $story;

	$postQ1Err = $postQ2Err = $postQ3Err = "";

    if (isset($_POST['saveBtn']))   {
        $ok = true;
        $okComments = true;

		#TK + MAN if the user doesnt fill in one field beside comments change $ok to false and prevent them from moving on
        if (!isset($_POST['postQ1']) || $_POST['postQ1'] === '') {
            $postQ1Err = "Please answer question 1";
            $ok = false;
        } else {
            $postQ1 = $_POST['postQ1'];
			$postQs .= $postQ1;
        }
        if (!isset($_POST['postQ2']) || $_POST['postQ2'] === '') {
            $postQ2Err = "Please answer question 2";
			$ok = false;
        } else {
            $postQ2 = $_POST['postQ2'];
			$postQs .= $postQ2;
        }
        if (!isset($_POST['postQ3']) || $_POST['postQ3'] === '') {
            $postQ3Err = "Please answer question 3";
            $ok = false;
        } else {
            $postQ3 = $_POST['postQ3'];
			$postQs .= $postQ3;
        }
        if (!isset($_POST['comments']) || $_POST['comments'] === '') {
            $okComments = false;
        } else {
            $comments = $_POST['comments'];
        }
		
		#Check if user is guest or registered user
		if($_GET['page']=="user"){	#TK USER VERSION
			#make sure the field isnt already filled
			$db = mysqli_connect('localhost', 'root', '', 'riskories');
			$sql = sprintf("SELECT * FROM users WHERE name='%s' AND 'postQ_$story' IS NULL",
				mysqli_real_escape_string($db, $_SESSION['user']));
			$result = mysqli_query($db, $sql);
			$row = mysqli_fetch_assoc($result);
			if($row){}else{
				$ok = false;
			}
			#if all fields are filled AND the field isnt filled, user can proceed with db calls
			if($ok){
					
					$sql = sprintf(
					"UPDATE users 
					SET `postQ_$story`= '%s'
					WHERE name='%s'",
					mysqli_real_escape_string($db,$postQs),
					mysqli_real_escape_string($db,$_SESSION['user']));
					$query = mysqli_query($db, $sql);
				#check if theres comments, add if there are
				$comments = '';
				if($okComments){
					$comments = $_POST['commnets'];
				}
				$sql = sprintf(
				"UPDATE users 
				SET `comments4_$story`= '%s'
				WHERE name='%s'",
				mysqli_real_escape_string($db,$comments),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
				

				mysqli_close($db);
				header("Location: ../user/profile.php");
			}
		} else if ($_GET['page']=="guest"){ #TK GUEST VERSION
			if($ok){
				$_SESSION['postQ'] = $postQs;
				if($okComments){
					$_SESSION['comments'] = $_POST['comments'];
				}
				
				header("Location: ../guest/guestReg.php?story=$story");
			}	
		}
    }
	#TK
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Post-Questions</title>
        <style>
        .error {color: #FF0000;}
        </style>
    </head>
    <body>


        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Post-Questions</h4>
                </div>
                <!-- EXTRA SAVE BUTTON
                <div class="col-md-1 col-md-offset-5">
                    <a class="btn btn-primary btn-sm pull-right">Save</a>
                </div>-->
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Please answer these quick questions:</div>
                <div class="panel-body">
                <p><span class="error">* required field.</span></p><br>
                <!--
                <em>
                    Please enter your demographic information (blank fields will not be updated):
                </em>
                -->
                <form method="post" id="reg-form" action="">
                       
                        <div class="form-group">
                      <label for="postQ1">Question 1: How much control do you feel you have over risks in your life?</label> <span class="error">* <?php echo $postQ1Err;?></span>
                     <ul>
                        <input type="radio" name="postQ1" id="1a" value="1a"><label for="1a">Not at all to a little control</label><br>
                        <input type="radio" name="postQ1" id="1b" value="1b"><label for="1b">Somewhat but less than 50%</label><br>
                        <input type="radio" name="postQ1" id="1c" value="1c"><label for="1c">About half or so</label><br>
                        <input type="radio" name="postQ1" id="1d" value="1d"><label for="1d">A fair amount or more than half</label><br>
                        <input type="radio" name="postQ1" id="1e" value="1e"><label for="1e">A real lot to all of the time</label>
                    </ul>
                    </div>

                    <div class="form-group">
                      <label for="postQ2">Question 2: How important are the little daily decisions in determining your risks?</label> <span class="error">* <?php echo $postQ2Err;?></span>
                     <ul>
                        <input type="radio" name="postQ2" id="2a" value="2a"><label for="2a">Not at all to a little important</label><br>
                        <input type="radio" name="postQ2" id="2b" value="2b"><label for="2b">Somewhat but less than 50%</label><br>
                        <input type="radio" name="postQ2" id="2c" value="2c"><label for="2c">About half or so</label><br>
                        <input type="radio" name="postQ2" id="2d" value="2d"><label for="2d">A fair amount or more than half</label><br>
                        <input type="radio" name="postQ2" id="2e" value="2e"><label for="2e">A real lot to all important</label>
                    </ul>
                    </div>

                    <div class="form-group">
                      <label for="postQ3">Question 3: How influenced are you by stories?</label> <span class="error">* <?php echo $postQ3Err;?></span>
                     <ul>
                        <input type="radio" name="postQ3" id="3a" value="3a"><label for="3a">Not to a little influenced</label><br>
                        <input type="radio" name="postQ3" id="3b" value="3b"><label for="3b">Somewhat influenced but less than 50%</label><br>
                        <input type="radio" name="postQ3" id="3c" value="3c"><label for="3c">About half or so influenced</label><br>
                        <input type="radio" name="postQ3" id="3d" value="3d"><label for="3d">A fair amount or more than half</label><br>
                        <input type="radio" name="postQ3" id="3e" value="3e"><label for="3e">A real lot to entirely influenced</label>
                    </ul>
                    </div>

                    <div class="form-group">
                      <label for="comments">Comments:</label><br>
                     <ul>
                        <textarea name="comments" id="comments" cols="55" rows="5"></textarea><br>
                    </ul>
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
