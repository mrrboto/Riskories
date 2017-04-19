<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<?php
if ($db) {

    if (session_status() == PHP_SESSION_NONE) {
    session_start();
    }

    //Get story title and attributes

    if(isset($_GET['story']))
	{
		$storyT = $_GET['story'];
		$storyR = $storyT."_rooms";
		$storyS = $storyT."_settings";
	}
	else
	{
	    $storyT = "choose";
        $storyR = "choose_rooms";
        $storyS = "choose_settings";

	}
	$settings = db_single(mysqli_query($db, "SELECT * FROM `$storyS` ORDER BY 'id' DESC;"));
	//print_r($settings); //DEBUGGING
}
?>
<title><?php echo $db ? $settings['title'] : "An epic adventure!"; ?></title>

<!--<link rel="stylesheet" type="text/css" media="screen" href="choose.css" />-->
<style>
    /*
    p {
        text-indent: 25px;
    }
    */
    /* Can change these to give more color to page */
    .body {
        background-color: white;
    }
    .container {
        background-color: white;
    }
</style>
<?php
if ($db) {
	if ($settings['enable_analytics'] == 1) {
		echo $settings['analytics_blurb'];
	}
}
?>
</head>

<body class="body" id="body" onload="updateNavbar()">
         <!-- Latest compiled and minified CSS -->
         <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
               integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
         <!-- Latest compiled and minified JavaScript -->
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
         <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

         <?php
         $status = '';
         // Determines whether admin or user logged in and updates navbar accordingly
         if(isset($_SESSION['isAdmin']))
         {
             if($_SESSION['isAdmin'] == 0)
            {
                 // commented by Spencer //echo "<br>&raquo;<a href='../user/profile.php'>Profile</a><br /><br />";
                 $status = 'user';

             }
             else
             {
                 // commented by Spencer //echo "<br>&raquo;<a href='../admin/admin.php'>Profile</a><br /><br />";
                 $status = 'admin';
             }

         }
         else
         {
             //echo "<br>&raquo;<a href='../index.html'>Main Screen</a><br /><br />";
             $status = 'guest';
         }
 		?>
         <?php
         // Determines total number of rooms
 		if ($db) {
            $total_rooms = db_single(mysqli_query($db, "SELECT count(*) as total FROM `$storyR`"));
			//echo "Total Rooms: ".$total_rooms['total'];
             }
 		?>

         <script type="text/javascript">
             // for updating navbar
             function updateNavbar() {
                 var totalRooms = <?php echo json_encode($total_rooms['total']); ?>;
                 var statusOfUser = <?php echo json_encode($status); ?>;

                 // For debugging
                 console.log(totalRooms);
                 console.log(statusOfUser);

                 var ulProfile = document.getElementById("navigationLinks");
                 var ulTotalRooms = document.getElementById("totalRooms");

                 var liTagProfile = document.createElement("li");
                 var aTagProfile = document.createElement("a");

                 var liTagRooms = document.createElement("li");
                 var aTagRooms = document.createElement("a");

                 if(statusOfUser == 'admin') {
                     aTagProfile.setAttribute("href", "../admin/admin.php");
                     // Create text for links
                     aTagProfile.appendChild(document.createTextNode("Admin Profile"));
                 }
                 else if(statusOfUser == 'user') {
                     aTagProfile.setAttribute("href", "../user/profile.php");
                     // Create text for links
                     aTagProfile.appendChild(document.createTextNode("User Profile"));
                 }
                 else if(statusOfUser == 'guest') {
                     aTagProfile.setAttribute("href", "../index.html");
                     // Create text for links
                     aTagProfile.appendChild(document.createTextNode("Guest Exit"));
                 }
                 else {
                     // For debugging
                     console.log("Error unexpected state");
                 }

                 // Create text for links
                 //aTagProfile.appendChild(document.createTextNode("Profile"));
                 aTagRooms.appendChild(document.createTextNode("Total Rooms: " + totalRooms));

                 liTagProfile.appendChild(aTagProfile);
                 liTagRooms.appendChild(aTagRooms);

                 // Add links to unordered list
                 ulProfile.appendChild(liTagProfile);
                 ulTotalRooms.appendChild(liTagRooms);

                 // For debugging
                 console.log(ulProfile);
                 console.log(ulTotalRooms);

                 if(statusOfUser != 'guest') {
                    console.log("Not guest (admin or user)")
                     //<li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                     var liLogout = document.createElement("li");
                     var aLogout = document.createElement("a");
                     var spanLogout = document.createElement("span");
                     spanLogout.setAttribute("class", "glyphicon glyphicon-log-out");
                     aLogout.setAttribute("href", "../login/logout.php");
                     aLogout.appendChild(spanLogout);
                     aLogout.appendChild(document.createTextNode("Logout"));
                     liLogout.appendChild(aLogout);
                     ulTotalRooms.appendChild(liLogout);
                 }
                 else {
                     console.log("Guest")
                 }
             }
         </script>

         <div class="navbar">
             <nav class="container navbar-inverse">
                 <div class="container-fluid">
                     <!-- Brand and toggle get grouped for better mobile display -->
                     <div class="navbar-header">
                         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                             data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                             <span class="sr-only">Toggle navigation</span>
                             <span class="icon-bar"></span>
                             <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                         </button>
                         <a class="navbar-brand" href="profile.php">
                             <img alt="Brand" src="../img/s_logo_3.png" height="45px" width="40px" style="padding-bottom: 20px">
                         </a>
                     </div>

                     <!-- Collect the nav links, forms, and other content for toggling -->
                     <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                         <ul id="navigationLinks" class="nav navbar-nav">
                             <li><a href="../consent/consentform.php">View Consent Form</a></li>
                         </ul>
                         <ul id="totalRooms" class="nav navbar-nav navbar-right">
                             <!--<li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>-->
                         </ul>
                     </div><!-- /.navbar-collapse -->
                 </div><!-- /.container-fluid -->
             </nav>
         </div>

 <div class="container">

