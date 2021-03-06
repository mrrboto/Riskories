<?php
	//session_start();
    include('../db/config.php');
	include('../db/db.php');

	if (isset($_POST['email'])){
		setcookie('email_cookie', $_POST['email'], time()+(60*60*24*365));
	}

	include('header.php');
?>
<h1><?php echo $db ? $settings['title'] : "An epic adventure!"; ?></h1>
</div>
<div class="container">
<br>

<?php

	#
	# get the number of rooms
	#

	list($rooms) = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `$storyR`"));
	$insert = "<br /><br /><b>Rooms:</b> ".number_format($rooms);

	#
	# utility function
	#

	function get_room_depth($room_id){

		if ($room_id == 1){return 1;}

		//list($parent_room_id) = mysql_num_rows(mysql_query("SELECT id FROM choose_rooms WHERE room_1=".$room_id." OR room_2=".$room_id));
        $db = $GLOBALS['db'];
        $storyR = $GLOBALS['storyR'];
		$parent_room_id = db_single(mysqli_query($db, "SELECT id FROM `$storyR` WHERE room_1=".$room_id." OR room_2=".$room_id));
		//echo "<!-- Parent ID: ".$parent_room_id['id']." --/>";
		if ($parent_room_id['id']){
			return 1 + get_room_depth($parent_room_id['id']);
		}

		return 1;
	}



	#
	# just a regular old choice room
	#
	if(isset($_GET['room']))
	{
		$room_id = max(intval($_GET['room']), 1);
	}
	else
	{
		$room_id = 1;
	}

    //change when adding rooms
	$room = db_single(mysqli_query($db, "SELECT * FROM `$storyR` WHERE id=$room_id"));


    //INSERT KEY SWITCH LOGIC HERE

    include('keySwap.php');

    //----------------------------




	if (!$room['id']){
		print "error: room $room_id not found";
		include('footer.php');
		exit;
	}

	$depth = get_room_depth($room_id);


	echo "<!-- depth: ".$depth." -->\n";


    /*
    if ($room['id'] == 1){
        echo "<div class=\"alert alert-danger\">\n";
 		echo "<strong>Warning:</strong>  ".nl2br(htmlentities(chop($settings['warn_box_blurb'])));
  		echo "</div>\n";
		//echo "<div class=\"warnbox\">\n";
		//echo "<b>Warning:</b>  ".nl2br(htmlentities(chop($settings['warn_box_blurb'])));
		//echo "</div>\n";
	}*/

#TK UPDATE TRACKING COOKIES
	if (isset($_GET['room'])){
		#TK add risk factor
		//first get option and from what room
		$opts = $_GET['opt'];
		$fram = $_GET['from'];
		//make a query using story name and from
		$sql = sprintf("SELECT * FROM %s WHERE id='%s'",
			mysqli_real_escape_string($db, $_GET['story']."_rooms"),
			mysqli_real_escape_string($db, $fram)
		);
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		//use the returned row to select the risk factor for choice
		$riskLvl = $row['choice'.$opts.'_risk'];
		#TK
		//accumulate path and increment choice num
		$_SESSION['path'] = $_SESSION['path'].$_SESSION['choiceNum'].",".$riskLvl.";";
		$_SESSION['choiceNum']++;
	}
	#TK

	if ($room['end_here']){

        echo "<div class=\"well\">";
        echo "<h4>Riskory Text:</h4>";
        echo "<div class=\"panel panel-default\"><div class=\"panel-body\"><p>";
		print nl2br(htmlentities(trim($room['blurb'])))."<br />\n";
        echo "</p></div></div>";//end panel and panel body
		echo "<b>It's all over.</b></div>";

		#TK purge path if random
		if ($_SESSION['randChoice'] == 1){
			$_SESSION['path'] = 'generic;';
		}
		#TK get the story name
		$_SESSION['storyNum'] = $_GET['story'];
		if(isset($_SESSION['user'])){
			$dir = $_GET['story'];
			header( "Refresh:5; url=../questions/postQ.php?page=user&story=$dir", true, 303);
		}
		//guest
		else{
			$dir = $_GET['story'];
			header( "Refresh:5; url=../questions/postQ.php?page=guest&story=$dir", true, 303);
		}
	#TK TAKE AWAY THE CHOICE
	}else if($_SESSION['randChoice']){
        echo "<div class=\"well\">"; // added by Spencer
        echo "<h4>Riskory Text:</h4>";
        echo "<div class=\"panel panel-default\"><div class=\"panel-body\"><p>";
  		print defaulty(nl2br(htmlentities(trim($story))))."<br />\n";
        echo "</p></div></div>";//end panel and panel body
		//echo "<br />\n";
		//echo "<b>What will you do?</b><br />\n";
		//echo "<div class=\"choices\">\n";
        echo "<h4>Available Decisions:</h4>";
		$randRoom = rand(1,2);
		if ($randRoom == 1){
			echo "<a class=\"btn btn-primary\" a href=\"room.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities("Proceed"))."</a><br />\n";
		}else{
			echo "<a class=\"btn btn-primary\" a href=\"room.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities("Proceed"))."</a><br />\n";
		}
		//echo "</div>\n";
        echo "</div>"; // end well
	}
	#TK
	else{
        echo "<div class=\"well\">"; // added by Spencer
        echo "<h4>Riskory Text:</h4>";
        echo "<div class=\"panel panel-default\"><div class=\"panel-body\"><p>";
  		print defaulty(nl2br(htmlentities(trim($story))))."<br />\n";
        echo "</p></div></div>";//end panel and panel body
        echo "<h4>Available Decisions:</h4>";
        print "[1] <a class=\"btn btn-primary\" href=\"room.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities($room['text_1']))."</a><br/>";
 		print "[2] <a class=\"btn btn-primary\" href=\"room.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities($room['text_2']))."</a></p>";
		//echo "<br />\n";
		//echo "<b>What will you do?</b><br />\n";
		//echo "<div class=\"choices\">\n";
		//print "[1] <a href=\"room.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities($room['text_1']))."</a><br />\n";
		//print "[2] <a href=\"room.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities($room['text_2']))."</a><br />\n";
		//echo "</div>\n";
        echo "</div>"; // end well
	}
	print "<br>";//print "<br><br><br><br>";

    #VP REMOVED REPORT FEATURE
    /*
    echo "Something wrong with this entry? Bad spelling/grammar? Empty? Makes no sense? Then <a href=\"report.php?id=".$room['id']."\">report it</a>.<br />";
    */


	function defaulty($x){
		return strlen($x) ? $x : '<i>Blank</i>';
	}
	include('footer.php');
?>
