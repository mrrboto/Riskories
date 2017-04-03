<!DOCTYPE>
<html>
<head>
<title>Guest</title>
</head>
<body>
<h1>Redirecting to stories...</h1>
</body>
<?php
	#TK GUEST TRACKING INITIALIZATION
	session_start();
	$_SESSION['path'] = '';
	$_SESSION['choiceNum'] = 1;
	//Subject to change like the one in login php
	$_SESSION['storyNum'] = '';
	#TK Story randomization
	$_SESSION['randChoice'] = rand(0,1);
	$_SESSION['stockDemo'] = rand(0,1);
	#TK
    header("Location: ../cyo/index.php");
    ?>
</html>
