<?php
include('user_auth.php');
//testing user auth if admin or not
//echo $_SESSION['isAdmin'];
?>
<!DOCTYPE>
<html>
<head>
<title>User Portal</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>
<body>
	<header class="navbar">
	  <div class="container navbar-inverse" role="banner">
	    <nav role="navigation">
	      <!-- Brand and toggle get grouped for better mobile display -->
	      <div class="navbar-header">
	        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	          <span class="sr-only">Toggle navigation</span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	          <span class="icon-bar"></span>
	        </button>
	        <a class="navbar-brand" href="#">Riskories</a>
	      </div>

	      <!-- Collect the nav links, forms, and other content for toggling -->
	      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	        <ul class="nav navbar-nav">
	          <li><a href="#">Home<span class="sr-only">(current)</span></a></li>
	          <li><a href="#">About</a></li>
	        </ul>
	      </div><!-- /.navbar-collapse -->
	  </nav>
	<div>
	</header>

	<div class="container" id="profile">
		<div class="row">
			<div class="col-md-4">
				<h4 id="welcome">Welcome: <strong><?php echo $_SESSION['user']; ?></strong></h4>
			</div>
			<div class="col-md-1 col-md-offset-7">
				<b id="logout"><a class="btn btn-danger btn-sm pull-right" href="../login/logout.php">Log Out</a></b>
			</div>
		</div>
		<div class="list-group">
			<a href="profile.php?page=demographic"><button type="button" class="list-group-item">Edit Demographics</button></a>
			<a href="profile.php?page=password"><button type="button" class="list-group-item">Change Password</button></a>
		</div>
	</div>

<?php
	if(isset($_GET['page'])){
		if($_GET['page'] == 'demographic'){
			include('demographic.php');
		}
		else if($_GET['page'] == 'password'){
			include('edit_pass.php');
		}
	}
?>

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</body>
</html>
