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
	$_SESSION['storyNum'] = 'Riskory_1';
	#TK
    header("Location: ../cyo/index.php");
    ?>
</html>
