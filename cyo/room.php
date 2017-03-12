<?php
	//session_start();
    include('config.php');
	include('db.php');

	if (isset($_POST['email'])){
		setcookie('email_cookie', $_POST['email'], time()+(60*60*24*365));
	}

	include('header.txt');
?>
<h1><?php echo $db ? $settings['title'] : "An epic adventure!"; ?></h1>
</div>
<div class="content">
<br>

<?php


	#
	# get the number of rooms
	#

	list($rooms) = mysql_num_rows(mysql_query("SELECT * FROM choose_rooms",$db));
	$insert = "<br /><br /><b>Rooms:</b> ".number_format($rooms);

	#
	# utility function
	#

	function get_room_depth($room_id){

		if ($room_id == 1){return 1;}

		//list($parent_room_id) = mysql_num_rows(mysql_query("SELECT id FROM choose_rooms WHERE room_1=".$room_id." OR room_2=".$room_id));
		$parent_room_id = db_single(mysql_query("SELECT id FROM choose_rooms WHERE room_1=".$room_id." OR room_2=".$room_id));
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


	$room = db_single(mysql_query("SELECT * FROM choose_rooms WHERE id=$room_id"));


    //INSERT KEY SWITCH LOGIC HERE

    include('keySwap.php');

    //----------------------------




	if (!$room['id']){
		print "error: room $room_id not found";
		include('footer.txt');
		exit;
	}

	$depth = get_room_depth($room_id);


	echo "<!-- depth: ".$depth." -->\n";

	if ($room['id'] == 1){
		echo "<div class=\"warnbox\">\n";
		echo "<b>Warning:</b>  ".nl2br(htmlentities(chop($settings['warn_box_blurb'])));
		echo "</div>\n";
	}

	if ($room['end_here']){
		print nl2br(htmlentities(trim($room['blurb'])));
		echo "<br><br><b>It's all over.</b>";

    //--------------------CHANGE ONCE MESSAGE PAGE IS READY--------------------------///
        header( "Refresh:5; url=../login/login.php", true, 303);
    //-------------------------------------------------------------------------------///
	}else{
		print defaulty(nl2br(htmlentities(trim($story))))."<br />\n";
		echo "<br />\n";
		echo "<b>What will you do?</b><br />\n";
		echo "<div class=\"choices\">\n";
		print "[1] <a href=\"room.php?room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities($room['text_1']))."</a><br />\n";
		print "[2] <a href=\"room.php?room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities($room['text_2']))."</a><br />\n";
		echo "</div>\n";
	}
	print "<br><br><br><br>";
	echo "Something wrong with this entry? Bad spelling/grammar? Empty? Makes no sense? Then <a href=\"report.php?id=".$room['id']."\">report it</a>.<br />";



	function defaulty($x){
		return strlen($x) ? $x : '<i>Blank</i>';
	}

	include('footer.txt');
?>
