<?php
include('../db/config.php');
include('../db/db.php');

  session_start();

$message = '';

if (isset($_POST['lg_username']) && isset($_POST['lg_password'])) {

    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
        mysqli_real_escape_string($db, $_POST['lg_username'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $hash = $row['password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['lg_password'], $hash)) {
            $message = 'Login successful.';
            

            $_SESSION['user'] = $row['name'];
            $_SESSION['isAdmin'] = $isAdmin;

			//Demographics logged into session
			$_SESSION['realName'] = $row['realName'];
			$_SESSION['soName'] = $row['soName'];
			$_SESSION['age'] = $row['age'];
			#TK TRACKING VARS
			$_SESSION['choiceNum']=1;
			$_SESSION['path'] = '';
			$_SESSION['storyNum'] = '';
			#TK RANDOMIZATION VARS
			$_SESSION['stockDemo'] = rand(0,1);
			$_SESSION['randChoice'] = rand(0,1); 
			#TK
            
			if ($isAdmin == 0)
			{
				//header('Location: /Riskories/nav/nav.html');
				header('Location: ../user/profile.php');
			}
			if ($isAdmin == 1)
			{
				header('Location: ../admin/admin.php');
				//header('Location: /Riskories/nav/profile.php');
			}

        } else {
            $message = 'Login failed.';
        }
    } else {
        $message = 'Login failed.';
    }
    mysqli_close($db);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Riskories Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1 maximum-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <div class="text-center">
    <img src="../img/logo_1.png" class="rounded" alt="..." width="50%" style="min-width:200px;">
    </div>


    </head>
<body>
<!-- All the files that are required -->
<link rel="stylesheet" href="log_style.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='https://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<!-- jQuery library - Added for Modal -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
<!-- Latest compiled JavaScript - Added for Modal -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<!-- Where all the magic happens -->
<!-- LOGIN FORM -->
<div class="text-center" style="padding:20px 0">
	<div class="logo">login</div>
	<!-- Main Form -->
	<div class="login-form-1">
		<form method="post" id="login-form" class="text-left" action="">
			<div class="login-form-main-message"></div>
			<div class="main-login-form">
				<div class="login-group">
					<div class="form-group">
						<label for="lg_username" class="sr-only">Username</label>
						<input type="text" class="form-control" id="lg_username" name="lg_username" placeholder="username">
					</div>
					<div class="form-group">
						<label for="lg_password" class="sr-only">Password</label>
						<input type="password" class="form-control" id="lg_password" name="lg_password" placeholder="password">
					</div>
					<div class="form-group login-group-text">
                        <!--<a class="link" href="login.php?page=2">Register</a>-->
                        <a class="link" href="#" data-toggle="modal" data-target="#registerConsentModal">Register</a>
                        or log in as
                        <!--<a class="link" href="../guest/guest.php">Guest</a>-->
                        <a class="link" href="#" data-toggle="modal" data-target="#guestConsentModal">Guest</a>
					</div>
				</div>
				<button onclick="displayLoginErrors()" type="submit" class="login-button" value="Login"><i class="fa fa-chevron-right"></i></button>
			</div>
		</form>
	</div>
	<!-- end:Main Form -->
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <!-- empty on purpose -->
            </div>
            <div id="centerSlotForAlert" class="col-md-4">
                <!-- $message should eventually be added here -->
            </div>
            <div class="col-md-4">
                <!-- empty on purpose -->
            </div>
        </div>
    </div>
</div>
<!-- </div> -->
<div>
<?php
    if(isset($_GET['page']))
    {

        if ($_GET['page'] == 2)
        {
            include('reg.php');
            /*echo "<p>$message</p>";
			//echo '<iframe src="reg.php" height="300" width="500" frameborder="0" scrolling="no"></iframe>';
			echo "<div class=\"container alert alert-info\">
                    <strong>Info:</strong> $message</a>.
            ";*/
        }
    }

    // remove any previous message
    echo "<script type=\"text/javascript\">";
    echo "var alert = document.getElementById(\"centerSlotForAlert\");";
    echo "while (alert.hasChildNodes()) {
        alert.removeChild(alert.lastChild);
    }";
    echo "</script>";
    if(strcmp($message, '') == 0) {
    }
    else if(strcmp($message, 'Login failed.') == 0) {
        echo "<script type=\"text/javascript\">";
        echo "var alert = document.getElementById(\"centerSlotForAlert\");";
        echo "var div = document.createElement(\"div\");";
        echo "div.setAttribute(\"class\", \"alert alert-danger\");";
        echo "var strongTag = document.createElement(\"strong\");";
        echo "var strongText = document.createTextNode(\"Error: \");";
        echo "strongTag.appendChild(strongText);";
        echo "var divText = document.createTextNode(\"Login failed\");";
        echo "div.appendChild(strongTag);";
        echo "div.appendChild(divText);";
        echo "alert.appendChild(div);";
        echo "</script>";
    }
    else if(strcmp($message, 'Login successful.') == 0) {
        echo "<script type=\"text/javascript\">";
        echo "var alert = document.getElementById(\"centerSlotForAlert\");";
        echo "var div = document.createElement(\"div\");";
        echo "div.setAttribute(\"class\", \"alert alert-danger\");";
        echo "var strongTag = document.createElement(\"strong\");";
        echo "var strongText = document.createTextNode(\"Success: \");";
        echo "strongTag.appendChild(strongText);";
        echo "var divText = document.createTextNode(\"Login successful\");";
        echo "div.appendChild(strongTag);";
        echo "div.appendChild(divText);";
        echo "alert.appendChild(div);";
        echo "</script>";
    }

    /*$dom = new DOMDocument;
    $dom->loadHTML($html);
    if(strcmp($message, '') == 0) {
        $alert = $dom->getElementbyId('centerSlotForAlert');
        //if($alert->hasChildNodes()) {
            //$alert->removeChild($alert->child[0]);
        //}
        $div = $dom->createElement('div');
        $div->setAttribute('class', 'alert alert-danger');
        $div->nodeValue = "Test";
        $alert->appendChild($div);
    }
    else if(strcmp($message, 'Login failed.') == 0) {
        // danger alert

    }
    else if(strcmp($message, 'Login successful.') == 0) {

    }
    */

?>
</div>

<script type="text/javascript">

//console.log("Hello world");
/*
var alert = document.getElementById("centerSlotForAlert");
var div = document.createElement("div");
div.setAttribute("class", "alert alert-danger");
var strongTag = document.createElement("strong");
var strongText = document.createTextNode("Error: ");
strongTag.appendChild(strongText);
var divText = document.createTextNode("Some error message");
div.appendChild(strongTag);
div.appendChild(divText);
alert.appendChild(div);
*/
// Use this to clear
/*
while (alert.hasChildNodes()) {
    alert.removeChild(alert.lastChild);
}
*/

function agreeToTermsGuest() {
    window.location = "../guest/guest.php";
}
function agreeToTermsRegister() {
    // redirect to login.php?page=2
    window.location = "login.php?page=2";
}

function displayLoginErrors() {
    console.log("Clicked");
}
</script>

 <!-- Modal -->
 <div id="registerConsentModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
     <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h2 class="modal-title">Consent Form</h2>
             </div>
             <div class="modal-body" id="registerModalBody">
                <?php
                    // Grab current consent form from database
                    $db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);
                    $sql = 'SELECT * FROM consentForm';
                    $result = mysqli_query($db, $sql);

                    echo "<script type=\"text/javascript\">";
                    echo "var consentDiv = document.getElementById(\"registerModalBody\");";
                    foreach ($result as $row) {
                        echo "var h4 = document.createElement(\"h4\");";
                        printf("var headerText = document.createTextNode(\"%s\");", htmlspecialchars($row['header']));
                        echo "var p = document.createElement(\"p\");";
                        printf("var pText = document.createTextNode(\"%s\");", htmlspecialchars($row['body']));

                        // Add text to tags
                        echo "h4.appendChild(headerText);";
                        echo "p.appendChild(pText);";

                        // Add tags to div
                        echo "consentDiv.appendChild(h4);";
                        echo "consentDiv.appendChild(p);";
                    }
                    echo "</script>";

                    mysqli_close($db);
                ?>
                <!--
                <h4>Title of research study:</h4> Riskories – how does being embedded in a story affect risk perceptions?
                <h4>Investigator:</h4> Prof. Andrew Maynard
                <h4>Why am I being invited to take part in a research study?</h4>
                 We invite you to take part in a research study because you have an interest in stories and risk and represent our study population.
                 <h4>Why is this research being done?</h4>
                 ASU, SFIS, and FSE are studying narrative as stories relate to risk perceptions.  We are enrolling persons at ASU and elsewhere as our part and to be able to cross compare our results.
                 <h4>How long will the research last?</h4>
                 We expect that individuals will spend on average about 5-15 minutes per story (“riskory”).  The data collection will continue indefinitely as readers continue to engage with the Riskories on the app.
                 <h4>How many people will be studied?</h4>
                 This is unknown.  We hope that at least about 100 or so people will participate in this research study.  You must be 18 years old or older to participate in the study.
                 <h4>What happens if I say, “yes, I want to be in this research”?</h4>
                 You will be allowed to continue on to the app and to engage with the Riskories.  You will enter a few demographics to your profile.  Your demographics will not be known to anyone but you.  The researchers won’t be able to “see” any individual’s information.  You will then be able to engage with one or more Riskories that have your or another’s demographics.
                 <h4>What happens if I say yes, but I change my mind later?</h4>
                 You can leave the research at any time it will not be held against you.
                 <h4>Is there any way being in this study could be bad for me?</h4>
                 There really aren’t any significant risks.  You may feel some uncomfortable thoughts depending on your story choices within the Riskories and how you feel about reading about yourself.
                 <h4>Will being in this study help me in any way?</h4>
                 We cannot promise any benefits to you or others from your taking part in this research. However, possible benefits include increased awareness of risk and how you perceive it.  This could also result in benefits to you depending on the risks you might face in your life.   Also, it could help ASU determine how best to improve its overall risk communications.
                 <h4>What happens to the information collected for the research?</h4>
                 Efforts will be made to limit the use and disclosure of your personal information, including research study records, to people who have a need to review this information. We cannot promise complete secrecy. Organizations that may inspect and copy your information include the University board that reviews research and agencies who want to make sure the study researchers (us, not you) are doing their jobs correctly and protecting your information and rights.
                 <br><br>Information will be anonymized and none of the researchers will know actual identities of study participants nor the demographic information of individual participants. The demographics will be used as an aggregate as will your story plot choices and your pre and post riskory questions.  Records will be safely stored in the administrative side of the app on ASU servers.
                 <h4>What else do I need to know?</h4>
                 This research is not being funded by any outside entities.  There are no financial conflicts of interest.
                 <h4>Who can I talk to?</h4>
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
                 By clicking “Agree To Terms” you are granting your consent.  Thank you and enjoy your Riskories!
                 -->
             </div>
             <div class="modal-footer">
                 <button onclick="agreeToTermsRegister()" class="btn btn-success" data-dismiss="modal">Agree To Terms</a>
             </div>
         </div>
     </div>
 </div>
<!-- End Modal -->
<!-- Modal -->
 <div id="guestConsentModal" class="modal fade" role="dialog">
     <div class="modal-dialog">
     <!-- Modal content-->
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal">&times;</button>
                 <h2 class="modal-title">Consent Form</h2>
             </div>
             <div class="modal-body" id="guestModalBody">
                <?php
                    // Grab current consent form from database
                    $db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);
                    $sql = 'SELECT * FROM consentForm';
                    $result = mysqli_query($db, $sql);

                    echo "<script type=\"text/javascript\">";
                    echo "var consentDiv = document.getElementById(\"guestModalBody\");";
                    foreach ($result as $row) {
                        echo "var h4 = document.createElement(\"h4\");";
                        printf("var headerText = document.createTextNode(\"%s\");", htmlspecialchars($row['header']));
                        echo "var p = document.createElement(\"p\");";
                        printf("var pText = document.createTextNode(\"%s\");", htmlspecialchars($row['body']));

                        // Add text to tags
                        echo "h4.appendChild(headerText);";
                        echo "p.appendChild(pText);";

                        // Add tags to div
                        echo "consentDiv.appendChild(h4);";
                        echo "consentDiv.appendChild(p);";
                    }
                    echo "</script>";

                    mysqli_close($db);
                ?>
                <!--
                <h4>Title of research study:</h4> Riskories – how does being embedded in a story affect risk perceptions?
                <h4>Investigator:</h4> Prof. Andrew Maynard
                <h4>Why am I being invited to take part in a research study?</h4>
                 We invite you to take part in a research study because you have an interest in stories and risk and represent our study population.
                 <h4>Why is this research being done?</h4>
                 ASU, SFIS, and FSE are studying narrative as stories relate to risk perceptions.  We are enrolling persons at ASU and elsewhere as our part and to be able to cross compare our results.
                 <h4>How long will the research last?</h4>
                 We expect that individuals will spend on average about 5-15 minutes per story (“riskory”).  The data collection will continue indefinitely as readers continue to engage with the Riskories on the app.
                 <h4>How many people will be studied?</h4>
                 This is unknown.  We hope that at least about 100 or so people will participate in this research study.  You must be 18 years old or older to participate in the study.
                 <h4>What happens if I say, “yes, I want to be in this research”?</h4>
                 You will be allowed to continue on to the app and to engage with the Riskories.  You will enter a few demographics to your profile.  Your demographics will not be known to anyone but you.  The researchers won’t be able to “see” any individual’s information.  You will then be able to engage with one or more Riskories that have your or another’s demographics.
                 <h4>What happens if I say yes, but I change my mind later?</h4>
                 You can leave the research at any time it will not be held against you.
                 <h4>Is there any way being in this study could be bad for me?</h4>
                 There really aren’t any significant risks.  You may feel some uncomfortable thoughts depending on your story choices within the Riskories and how you feel about reading about yourself.
                 <h4>Will being in this study help me in any way?</h4>
                 We cannot promise any benefits to you or others from your taking part in this research. However, possible benefits include increased awareness of risk and how you perceive it.  This could also result in benefits to you depending on the risks you might face in your life.   Also, it could help ASU determine how best to improve its overall risk communications.
                 <h4>What happens to the information collected for the research?</h4>
                 Efforts will be made to limit the use and disclosure of your personal information, including research study records, to people who have a need to review this information. We cannot promise complete secrecy. Organizations that may inspect and copy your information include the University board that reviews research and agencies who want to make sure the study researchers (us, not you) are doing their jobs correctly and protecting your information and rights.
                 <br><br>Information will be anonymized and none of the researchers will know actual identities of study participants nor the demographic information of individual participants. The demographics will be used as an aggregate as will your story plot choices and your pre and post riskory questions.  Records will be safely stored in the administrative side of the app on ASU servers.
                 <h4>What else do I need to know?</h4>
                 This research is not being funded by any outside entities.  There are no financial conflicts of interest.
                 <h4>Who can I talk to?</h4>
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
                 By clicking “Agree To Terms” you are granting your consent.  Thank you and enjoy your Riskories!
                 -->
             </div>
             <div class="modal-footer">
                 <button onclick="agreeToTermsGuest()" class="btn btn-success" data-dismiss="modal">Agree To Terms</a>
             </div>
         </div>
     </div>
 </div>
 <!-- End Modal -->


</body>
</html>

