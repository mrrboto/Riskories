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
<form method="post" id="reg-form" action="">
<input type="submit" name="yes" value="Yes">
<input type="submit" name="no" value="No">
</form>

<?php
	if(isset($_POST['yes'])){
		include('../login/reg.php');
	}
	if (isset($_POST['no'])){
		header("Location: ../login/login.php");
	}
?>