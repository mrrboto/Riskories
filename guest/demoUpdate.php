<?php
	$realName = '';
	$soStatus = '';
	$soName = '';
	$gender = '';
	$age = '';

	$ok = false;
	$okRN = true;
	$okSON = true;
	$okSOS = true;
	$okG = true;
	$okA = true;

	if (!isset($_SESSION['realName']) || $_SESSION['realName'] === '') {
		$okRN = false;
	} else {
		$ok = true;
		$name = $_SESSION['realName'];
	}
	if (!isset($_SESSION['soStatus']) || $_SESSION['soStatus'] === '') {
		$okSOS = false;
	} else {
		$ok = true;
		$soStatus = $_SESSION['soStatus'];
	}
	if (!isset($_SESSION['soName']) || $_SESSION['soName'] === '') {
		$okSON = false;
	} else {
		$ok = true;
		$soName = $_SESSION['soName'];
	}
	if (!isset($_SESSION['gender']) || $_SESSION['gender'] === '') {
		$okG = false;
	} else {
		$ok = true;
		$gender = $_SESSION['gender'];
	}
	if (!isset($_SESSION['age']) || $_SESSION['age'] === '') {
		$okA = false;
	} else {
		$ok = true;
		$age = $_SESSION['age'];
	}

	if($ok){
	//create a guest user
		$sql = "INSERT INTO guests (name) VALUES ('guest')";
		mysqli_query($db, $sql);
		$sql = "SELECT * FROM guests
				ORDER BY id DESC
				LIMIT 1";
		$result = mysqli_query($db, $sql);
		$que = mysqli_fetch_assoc($result);
		$eyeD = $que['id'];
		$_SESSION['path'] = substr($_SESSION['path'],0,strlen($_SESSION['path'])-1);
		$_SESSION['path'] .= '[';
			if($okA){
				$sql = sprintf(
				"UPDATE guests
				SET `age`= %s
				WHERE id='%s'",
				mysqli_real_escape_string($db,$_SESSION['age']),
				$eyeD);
				$query = mysqli_query($db, $sql);
				$_SESSION['path'] .= 'a;';
			}
			if($okRN){
				$sql = sprintf(
				"UPDATE guests
				SET `realName`='%s'
				WHERE id='%s'",
				mysqli_real_escape_string($db,$_SESSION['realName']),
				$eyeD);
				$query = mysqli_query($db, $sql);
				$_SESSION['path'] .= 'rN;';
			}
			if($okSOS){
				//check if soName needs to be cleared
				$clar = 0;
				if($_SESSION['soStatus'] === 'single'){
					$clar=1;
				}
				$sql = sprintf(
				"UPDATE guests
				SET `soStatus`='%s'
				WHERE id='%s'",
				$_SESSION['soStatus'],
				$eyeD);
				$query = mysqli_query($db, $sql);

				$_SESSION['path'] .= 'soS;';
			}
			if($okSON){
				$sql = sprintf(
				"UPDATE guests
				SET `soName`='%s'
				WHERE id='%s'",
				mysqli_real_escape_string($db,$_SESSION['soName']),
				$eyeD);
				$query = mysqli_query($db, $sql);
				$_SESSION['path'] .= 'soN;';
			}
			if($okG){
				$sql = sprintf(
				"UPDATE guests
				SET `gender`='%s'
				WHERE id='%s'",
				mysqli_real_escape_string($db,$_SESSION['gender']),
				$eyeD);
				$query = mysqli_query($db, $sql);
				$_SESSION['path'] .= 'g;';
			}
		$_SESSION['path'] .= ']';
		$sql = sprintf(
			"UPDATE guests
			SET `story`='%s'
			WHERE id='%s'",
			mysqli_real_escape_string($db,$_SESSION['path']),
			$eyeD);
		$query = mysqli_query($db, $sql);
		mysqli_close($db);
	}
	header("Location: ../login/login.php");

?>
