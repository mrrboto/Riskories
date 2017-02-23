<!DOCTYPE html>
<html>
<head>
</head>
<body onload="changeSOS()">
<link rel="stylesheet" href="log_style.css">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
<link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

<?php
	$realName = '';
	$soStatus = '';
	$soName = '';
	$gender = '';
	$age = '';
	
	if (isset($_POST['saveBtn']))	{
		$ok = false;
		$okRN = true;
		$okSON = true;
		$okSOS = true;
		$okG = true;
		$okA = true;
		if (!isset($_POST['realName']) || $_POST['realName'] === '') {
			$okRN = false;
		} else {
			$ok = true;
			$name = $_POST['realName'];
		}
		if (!isset($_POST['soStatus']) || $_POST['soStatus'] === '') {
			$okSOS = false;
		} else {
			$ok = true;
			$soStatus = $_POST['soStatus'];
		}
		if (!isset($_POST['soName']) || $_POST['soName'] === '') {
			$okSON = false;
		} else {
			$ok = true;
			$soName = $_POST['soName'];
		}
		if (!isset($_POST['gender']) || $_POST['gender'] === '') {
			$okG = false;
		} else {
			$ok = true;
			$gender = $_POST['gender'];
		}
		if (!isset($_POST['age']) || $_POST['age'] === '') {
			$okA = false;
		} else {
			$ok = true;
			$age = $_POST['age'];
		}
		
		if($ok){
			if($okRN){
				$db = mysqli_connect('localhost', 'root', '', 'riskories');
				$sql = sprintf(
				"UPDATE users 
				SET `realName`='%s'
				WHERE name='%s'",
				//need to escape this
				$_POST['realName'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okSOS){
				$db = mysqli_connect('localhost', 'root', '', 'riskories');
				$sql = sprintf(
				"UPDATE users 
				SET `soStatus`='%s'
				WHERE name='%s'",
				//need to escape this
				$_POST['soStatus'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okSON){
				$db = mysqli_connect('localhost', 'root', '', 'riskories');
				$sql = sprintf(
				"UPDATE users 
				SET `soName`='%s'
				WHERE name='%s'",
				//need to escape this
				$_POST['soName'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okG){
				$db = mysqli_connect('localhost', 'root', '', 'riskories');
				$sql = sprintf(
				"UPDATE users 
				SET `gender`='%s'
				WHERE name='%s'",
				//need to escape this
				$_POST['realName'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
			if($okA){
				$db = mysqli_connect('localhost', 'root', '', 'riskories');
				$sql = sprintf(
				"UPDATE users 
				SET `age`= %s
				WHERE name='%s'",
				//need to escape this
				$_POST['age'],
				$_SESSION['user']);
				$query = mysqli_query($db, $sql);
			}
		}
	}
?>
<div class="text-center" style="padding:10px 0">
    <div class="logo">Enter your demographic information, blank fields will not be updated</div>
    <div class="reg-form-1">
        <form class="text-center" method="post" id="reg-form" action=""> 

        <div class="reg-group">
		First Name: <input type="text" id="realName" name="realName" value="<?php /*echo htmlspecialchars($name);*/?>"><br>

		<script>
		function changeSOS(){
			var l = document.getElementById("soStatus").value
			var son = document.getElementById("soName")
			var sonL = document.getElementById("SONLbl")
			if (l=="dating" || l=="married"){
				son.style.visibility = "visible"
				sonL.style.visibility = "visible"
			}
			else{
				son.style.visibility = "hidden"
				sonL.style.visibility = "hidden"
			}
		}
		
		function back(){
			window.history.back();
		}
		</script>
	
		Marital Status:<select name="soStatus" id="soStatus" onchange="changeSOS()">
		<option value="">Please Select</option>
		<option id="single" value="single"> Single </option>
		<option id="dating" value="dating">Dating </option>
		<option id="married" value="married"> Married </option>
		</select><br>
		
		<text id="SONLbl">Significant Other Name:</text> <input type="text" id="soName" name="soName" value="<?php /*echo htmlspecialchars(soName);*/?>"><br>
		
		Gender: <select name="gender" id="gender">
				<option value="">Please Select</option>
				<option id="female" value="f">Female</option>
				<option id="male" value ="m">Male</option>
				</select><br>
				
		Age: <input type="text" name="age" value="<?php /*echo htmlspecialchars(age);*/?>"><br><br>
		
		<div class="dem-save">
			<input type="submit" name="saveBtn" value="Save">
			</form>
		</div>		
		</div>
    </form>
</div>
<?php
	if(isset($_GET['page'])) {
		if ($_GET['page'] === 'ic') {
?>
				<script>
				alert("it works")
				</script>
<?php
		}	
	}
?>
</div>
</body>
</html>
			