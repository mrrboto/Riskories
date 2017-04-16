<?php

  $name = '';
  $password = '';
  $gender = '';
  $color = '';
  $message = '';

    //echo "<p style='text-align:center'>THIS FEATURE IS CURRENTLY DISABLED</p>";

  if (isset($_POST['submit'])) {
	if($_POST['password']===$_POST['password_cf']){
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
            include('../db/config.php');
            include('../db/db.php');
			$query = mysqli_query($db, "SELECT name FROM users WHERE name='$name'");
			if (mysqli_num_rows($query) != 0)
			{
				$message = 'Username already exists.';
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
				$message = 'User added.';

				$_SESSION['user'] = $name;
				$_SESSION['isAdmin'] = 0;
				header("Location: ../user/profile.php");
			}

            mysqli_close($db);
		}
    }else{
		$message = 'Passwords do not match';
	}
  }
?>


<!DOCTYPE html>
<html>
<!-- source of the crappy CSS
<style>
.consentH1{
	font-size: 18px;
	color: red;
}
.consentDiv{
	font-size: 12px;
	background-color: blue;
	color: yellow;
}
</style>
-->
<!--TK-->
<body>
<!-- Latest compiled and minified JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous">
</script>
<div class="text-center" style="padding:0px 0">
<div class="logo">Register</div>
<div class="login-form-1">
    <form method="post" id="login-form" class="text-center" action="">
        <div class="login-form-main-message"></div>
        <div class="main-login-form">
            <div class="login-group">
                <div class="form-group">
                    <input type="text" class="form-control" id="lg_username" name="name" placeholder="enter username">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="lg_password" name="password" placeholder="enter password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="lg_password_cf" name="password_cf" placeholder="confirm password">
                </div>
                <div class="form-group">
                    Gender:
                    <input type="radio" name="gender" value="f"<?php
                    if ($gender === 'f') {
                        echo ' checked';
                    }?>>female
                    <input type="radio" name="gender" value="m"<?php
                    if ($gender === 'm') {
                        echo ' checked';
                    }?>>male<br>
                </div>
            </div>
			<!-- Tyler added this, feel free to CSS it better -->
            <!--
			<div name="Consent" class ="consentDiv">
			<h1 class="consentH1">Title of research study:</h1> Riskories – how does being embedded in a story affect risk perceptions? 
			<h1 class="consentH1">Investigator:</h1> Prof. Andrew Maynard
			<h1 class="consentH1">Why am I being invited to take part in a research study?</h1>
			We invite you to take part in a research study because you have an interest in stories and risk and represent our study population. 
			<h1 class="consentH1">Why is this research being done?</h1>
			ASU, SFIS, and FSE are studying narrative as stories relate to risk perceptions.  We are enrolling persons at ASU and elsewhere as our part and to be able to cross compare our results.  
			<h1 class="consentH1">How long will the research last?</h1>
			We expect that individuals will spend on average about 5-15 minutes per story (“riskory”).  The data collection will continue indefinitely as readers continue to engage with the Riskories on the app.  
			<h1 class="consentH1">How many people will be studied?</h1>
			This is unknown.  We hope that at least about 100 or so people will participate in this research study.  You must be 18 years old or older to participate in the study. 
			<h1 class="consentH1">What happens if I say, “yes, I want to be in this research”?</h1>
			You will be allowed to continue on to the app and to engage with the Riskories.  You will enter a few demographics to your profile.  Your demographics will not be known to anyone but you.  The researchers won’t be able to “see” any individual’s information.  You will then be able to engage with one or more Riskories that have your or another’s demographics.    
			<h1 class="consentH1">What happens if I say yes, but I change my mind later?</h1>
			You can leave the research at any time it will not be held against you.
			<h1 class="consentH1">Is there any way being in this study could be bad for me?</h1>
			There really aren’t any significant risks.  You may feel some uncomfortable thoughts depending on your story choices within the Riskories and how you feel about reading about yourself.  
			<h1 class="consentH1">Will being in this study help me in any way?</h1>
			We cannot promise any benefits to you or others from your taking part in this research. However, possible benefits include increased awareness of risk and how you perceive it.  This could also result in benefits to you depending on the risks you might face in your life.   Also, it could help ASU determine how best to improve its overall risk communications.  
			<h1 class="consentH1">What happens to the information collected for the research?</h1>
			Efforts will be made to limit the use and disclosure of your personal information, including research study records, to people who have a need to review this information. We cannot promise complete secrecy. Organizations that may inspect and copy your information include the University board that reviews research and agencies who want to make sure the study researchers (us, not you) are doing their jobs correctly and protecting your information and rights. 
			<br><br>Information will be anonymized and none of the researchers will know actual identities of study participants nor the demographic information of individual participants. The demographics will be used as an aggregate as will your story plot choices and your pre and post riskory questions.  Records will be safely stored in the administrative side of the app on ASU servers. 
			<h1 class="consentH1">What else do I need to know?</h1>
			This research is not being funded by any outside entities.  There are no financial conflicts of interest. 
			<h1 class="consentH1">Who can I talk to?</h1>
			If you have questions, concerns, or complaints, talk to the research team at: 
			<br>•	Jonathan Klane at (480) 965-8498 or jonathan.klane@asu.edu  
			<br>•	Andrew Maynard at (480) 727-8831 or amaynar2@asu.edu 
			<br>This research has been reviewed and approved by the Social Behavioral IRB. You may talk to them at (480) 965-6788 or by email at research.integrity@asu.edu if:
			<br>•	Your questions, concerns, or complaints are not being answered by the research team.
			<br>•	You cannot reach the research team.
			<br>•	You want to talk to someone besides the research team.
			<br>•	You have questions about your rights as a research participant.
			<br>•	You want to get information or provide input about this research.
			<br><br>
			By clicking “Continue” you are granting your consent.  Thank you and enjoy your Riskories! 
			</div>
			Tyler addition ends here -->
            <!--<button class="btn-primary" data-toggle="modal" data-target="#myModal">Agree To Terms</button>-->
            <button class="login-button" type="submit" name="submit" value="Login"><i class="fa fa-chevron-right"></i></button>
        </div>
    </form>
</div>
</div>
</body>
</html>


