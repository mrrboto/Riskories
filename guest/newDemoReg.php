<?php
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

	if($ok && isset($_SESSION['user'])){
		sleep(1);
		if($okRN){
			$sql = sprintf(
			"UPDATE users
			SET `realName`='%s'
			WHERE name='%s'",
			mysqli_real_escape_string($db,$_SESSION['realName']),
			$_SESSION['user']);
			$query = mysqli_query($db, $sql);
		}
		if($okSOS){
			//check if soName needs to be cleared
			$clar = 0;
			if($_SESSION['soStatus'] === 'single'){
				$clar=1;
			}
			$sql = sprintf(
			"UPDATE users
			SET `soStatus`='%s'
			WHERE name='%s'",
			$_SESSION['soStatus'],
			$_SESSION['user']);
			$query = mysqli_query($db, $sql);

			if($clar==1){
				$sql = sprintf(
				"UPDATE users
				SET `soName`='%s'
				WHERE name='%s'",
				mysqli_real_escape_string($db,'friend'),
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
		}
		if($okSON){
			$sql = sprintf(
			"UPDATE users
			SET `soName`='%s'
			WHERE name='%s'",
			mysqli_real_escape_string($db,$_SESSION['soName']),
			$_SESSION['user']);
			$query = mysqli_query($db, $sql);
		}
		if($okG){
			$sql = sprintf(
			"UPDATE users
			SET `gender`='%s'
			WHERE name='%s'",
			mysqli_real_escape_string($db,$_SESSION['gender']),
			$_SESSION['user']);
			$query = mysqli_query($db, $sql);
		}
		if($okA){
			$sql = sprintf(
			"UPDATE users
			SET `age`= %s
			WHERE name='%s'",
			mysqli_real_escape_string($db,$_SESSION['age']),
			$_SESSION['user']);
			$query = mysqli_query($db, $sql);
		}

		//mysqli_close($db);
	}
	//header("Location: profile.php");	
?>

<script>
window.location = "../user/profile.php";
</script>
