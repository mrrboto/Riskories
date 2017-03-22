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
	#TK
    header("Location: ../cyo/index.php");
    ?>
</html>
