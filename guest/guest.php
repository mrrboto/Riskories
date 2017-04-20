<!DOCTYPE>
<html>
<head>
<title>Guest</title>
</head>
<body>
<h1>Redirecting to stories...</h1>
</body>
<?php
    include('../db/config.php');
    include('../db/db.php');

	#TK GUEST TRACKING INITIALIZATION
	session_start();
	$_SESSION['path'] = '';
	$_SESSION['choiceNum'] = 1;
	//Subject to change like the one in login php
	$_SESSION['storyNum'] = '';
	#TK Story randomization
	$_SESSION['randChoice'] = rand(0,1);
	$_SESSION['stockDemo'] = 1;
	#GUEST DEMOGRAPHICS
	$_SESSION['age'] = '';
	$_SESSION['gender'] = '';
	$_SESSION['realName'] = '';
	$_SESSION['soStatus'] = '';
	$_SESSION['soName'] = '';
	
    mysqli_close($db);
	
	header("Location: guestConsent.php")
    //header("Location: ../cyo/index.php");
    ?>
</html>
