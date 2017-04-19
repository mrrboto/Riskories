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

    mysqli_close($db);

    //header("Location: ../cyo/index.php");
    ?>
</html>
