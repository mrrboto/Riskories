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
<div class="content">
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

	if ($room['id'] == 1){
		echo "<div class=\"warnbox\">\n";
		echo "<b>Warning:</b>  ".nl2br(htmlentities(chop($settings['warn_box_blurb'])));
		echo "</div>\n";
	}
	#TK UPDATE TRACKING COOKIES
	if (isset($_GET['room'])){
		$_SESSION['path'] = $_SESSION['path'].$_SESSION['choiceNum'].",".$_GET['opt'].";";
		$_SESSION['choiceNum']++;
	}
	#TK

	if ($room['end_here']){
		print nl2br(htmlentities(trim($room['blurb'])));
		echo "<br><br><b>It's all over.</b>";
		#TK purge path if random
		if ($_SESSION['randChoice'] == 1){
			$_SESSION['path'] = 'generic;';
		}
		#TK get the story name
		$_SESSION['storyNum'] = $_GET['story'];
		if(isset($_SESSION['user'])){
			header( "Refresh:5; url=../user/profile.php", true, 303);
		}
		//guest
		else{
			header( "Refresh:5; url=../guest/guestReg.php", true, 303);
		}
	#TK TAKE AWAY THE CHOICE
	}else if($_SESSION['randChoice']){
		print defaulty(nl2br(htmlentities(trim($story))))."<br />\n";
		echo "<br />\n";
		echo "<b>What will you do?</b><br />\n";
		echo "<div class=\"choices\">\n";
		$randRoom = rand(1,2);
		if ($randRoom == 1){
			echo "<a href=\"room.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities("Proceed"))."</a><br />\n";
		}else{
			echo "<a href=\"room.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities("Proceed"))."</a><br />\n";
		}
		echo "</div>\n";
	}
	#TK
	else{
		print defaulty(nl2br(htmlentities(trim($story))))."<br />\n";
		echo "<br />\n";
		echo "<b>What will you do?</b><br />\n";
		echo "<div class=\"choices\">\n";
		print "[1] <a href=\"room.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities($room['text_1']))."</a><br />\n";
		print "[2] <a href=\"room.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities($room['text_2']))."</a><br />\n";
		echo "</div>\n";
	}
	print "<br><br><br><br>";
	echo "Something wrong with this entry? Bad spelling/grammar? Empty? Makes no sense? Then <a href=\"report.php?id=".$room['id']."\">report it</a>.<br />";



	function defaulty($x){
		return strlen($x) ? $x : '<i>Blank</i>';
	}
	include('footer.php');
?>
