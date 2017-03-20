<?php
	$message = '';
	session_start();
?>
<!DOCTYPE html>
<html>
<!-- This document is for the user after completeing a story, to redirect them to register -->
<head>
</head>
<body>
<script>
</script>
<h2> Hey! We hoped you liked the story. If you want to do more please register!</h2>
<p>Would you like to register?</p>

<button onclick="window.location.href='guestReg.php?page=2'">Yes Please</button>
<form method="post" id="reg-form" action=""><br/>
<input type="submit" name="no" value="No">
</form>

<?php
	if(isset($_GET['page']))
    {
        if ($_GET['page'] == 2)
        {
			include('../login/reg.php');
			echo "<p>$message</p>";
		}
	}
	if (isset($_POST['no'])){
		header("Location: ../login/login.php");
	}
?>
