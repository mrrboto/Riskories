<?php
    include('../admin/admin_auth.php');
	include('config.php');
	include('db.php');

	if (isset($_POST['email'])){
		setcookie('email_cookie', $_POST['email'], time()+(60*60*24*365));
	}

	include('header.php');
?>
<div class="page-header">
    <h1><?php echo $db ? $settings['title'] : "An epic adventure!"; ?></h1>
</div>
<!--</div>
<div class="container">-->
<br>

<?php


	#
	# get the number of rooms
	#

	list($rooms) = mysql_num_rows(mysql_query("SELECT * FROM `$storyR`",$db));
	$insert = "<br /><b>Rooms:</b> ".number_format($rooms);

	#
	# utility function
	#

	function get_room_depth($room_id){

		if ($room_id == 1){return 1;}

		//list($parent_room_id) = mysql_num_rows(mysql_query("SELECT id FROM choose_rooms WHERE room_1=".$room_id." OR room_2=".$room_id));
        $storyR = $GLOBALS['storyR'];
		$parent_room_id = db_single(mysql_query("SELECT id FROM `$storyR` WHERE room_1=".$room_id." OR room_2=".$room_id));
		//echo "<!-- Parent ID: ".$parent_room_id['id']." --/>";
		if ($parent_room_id['id']){
			return 1 + get_room_depth($parent_room_id['id']);
		}

		return 1;
	}


	#
	# add a new room?
	#

	$problems = array();

	if (isset($_POST['addroom'])){
		if ($settings['enable_recaptcha'] == 1) {
			require_once('recaptchalib.php');
			$privatekey = $settings['recaptcha_private_key'];
			$resp = recaptcha_check_answer ($privatekey,
       	 	                        $_SERVER["REMOTE_ADDR"],
					$_POST["recaptcha_challenge_field"],
					$_POST["recaptcha_response_field"]);
			if (!$resp->is_valid) {
				$problems[] = "The reCAPTCHA wasn't entered correctly. Try again. (".$resp->error.")";
			}
		}


		if (!strlen(trim($_POST['blurb']))) $problems[] = "Please enter your part of the story";

		if (!$_POST['end_here']){
			if (!strlen(trim($_POST['choice1']))) $problems[] = "Please enter the first choice";
			if (!strlen(trim($_POST['choice2']))) $problems[] = "Please enter the second choice";
		}

		if (!count($problems)){

			$ret = db_insert($storyR, array(
				//'email'		=> AddSlashes($_POST['email']),
				'blurb'		=> AddSlashes($_POST['blurb']),
				'text_1'	=> AddSlashes($_POST['choice1']),
				'room_1'	=> 0,
				'text_2'	=> AddSlashes($_POST['choice2']),
				'room_2'	=> 0,
				'end_here'	=> AddSlashes($_POST['end_here']),
				//'ip'		=> AddSlashes($_SERVER['REMOTE_ADDR']),
			));

			//$room_id = $ret['insert_id'];
			$room_id = $ret;

			$opt	= intval($_POST['opt']);
			$from	= intval($_POST['from']);

			db_update($storyR, array(

				"room_$opt" => $room_id,

			), "id=$from AND room_$opt=0");

			print "Your room has been added. <a href=\"room_adm.php?story=$storyT\">Click here</a> to start again.";
			include('footer.txt');
			exit;
		}
	}


	#
	# is this a null (insert a link here) room?
	#

	if (isset($_REQUEST['from']) && !$_GET['room']){

		$from_id = intval($_REQUEST['from']);
		$from_room = db_single(mysql_query("SELECT * FROM `$storyR` WHERE id=$from_id"));

		$depth = get_room_depth($from_id);

		$opt = intval($_REQUEST['opt']);

		if(isset($_COOKIE['email_cookie']))
		{
			$email_cookie = HtmlSpecialChars($_COOKIE['email_cookie']);
		}



		if (count($problems)){

			echo "<div class=\"problems\">\n";
			foreach ($problems as $p){
				echo "&raquo; $p<br />\n";
			}
			echo "</div>\n";
			echo "<br />\n";
		}

        // Start Add New Room
        echo "<div class=\"well\">";
		print "<!-- Depth: $depth -->";
		//print nl2br(htmlentities(chop($settings['new_room_blurb'])))."<br /><br />";
		print "What happens when someone chooses &quot;".HtmlSpecialChars($from_room["text_$opt"])."&quot;?<br/>";
		echo "<br />";
        // Start Form
		print "<form method=\"post\">";
		print "<input type=\"hidden\" name=\"addroom\" value=\"1\">";
		print "<input type=\"hidden\" name=\"from\" value=\"$from_id\">";
		print "<input type=\"hidden\" name=\"opt\" value=\"$opt\">";
        /* Begin textarea code */
        echo "<div class=\"form-group\">"; // added by Spencer
		print "<label for=\"comment\">Riskory room text:</label><br><textarea class=\"form-control\" name=\"blurb\" cols=\"50\" rows=\"10\"></textarea>"; // <br><br> taken out
        echo "</div>"; // added by Spencer
        /* End textarea code */

        /* Begin options code */
        echo "<div class=\"form-group\">"; // added by Spencer
        echo "<label for=\"\">Is this an end room?</label>"; // added by Spencer // Note: for attribute not needed
		if ($depth >= $settings['kill_depth']){
			print "<select class=\"form-control\" name=\"end_here\"><option value=\"0\">The Riskory continues...</option><option value=\"1\">The Riskory ends here</option></select><br>";
		}else{
			print "<input type=\"hidden\" name=\"end_here\" value=\"0\">";
		}
        echo "</div>"; // added by Spencer
        /* End options code */

        /* Begin Choices code */
        echo "<div class=\"form-group\">"; // added by Spencer
        echo "<label for=\"\">Choice 1:</label>"; // added by Spencer // Note: for attribute not needed
		print "<input class=\"form-control\" type=\"text\" name=\"choice1\" size=\"50\">";
        echo "</div>"; // added by Spencer

        echo "<div class=\"form-group\">"; // added by Spencer
        echo "<label for=\"\">Choice 2:</label>"; // added by Spencer // Note: for attribute not needed
		print "<input class=\"form-control\" type=\"text\" name=\"choice2\" size=\"50\">";
        echo "</div>"; // added by Spencer
        /* End Choices code */
		if ($settings['enable_recaptcha'] == 1) {
			echo "Prove you're a human:<br />";
			$recaptcha_theme = " <script type=\"text/javascript\">";
 			$recaptcha_theme .= "var RecaptchaOptions = {";
 			$recaptcha_theme .= "theme : 'white'";
 			$recaptcha_theme .= "};";
			$recaptcha_theme .= " </script>";
			echo $recaptcha_theme;
			echo "<form method=\"post\" action=\"\">";
			require_once('recaptchalib.php');
			$publickey = $settings['recaptcha_public_key'];
			echo recaptcha_get_html($publickey);
		}
		print "<input class=\"btn btn-primary\" type=\"submit\" value=\"Add This Room\">";
        echo "</div>";
        // End Add New Room

		include('footer.txt');
		exit;
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


	$room = db_single(mysql_query("SELECT * FROM `$storyR` WHERE id=$room_id"));

	if (!$room['id']){
		print "error: room $room_id not found";
		include('footer.txt');
		exit;
	}

	$depth = get_room_depth($room_id);


	echo "<!-- depth: ".$depth." -->\n";

	if ($room['id'] == 1){
		//echo "<div class=\"warnbox\">\n";
        echo "<div class=\"alert alert-danger\">\n";
		echo "<strong>Warning:</strong>  ".nl2br(htmlentities(chop($settings['warn_box_blurb'])));
		echo "</div>\n";
	}

	if ($room['end_here']){
		print nl2br(htmlentities(chop($room['blurb'])));
		print "<br><br><b>It's all over.</b> Why not <a href=\"room_adm.php?story=$storyT\">start again</a>.";
	}else{
        //echo "<div class=\"well\"><p>";
        //<div class="panel panel-default">
        //    <div class="panel-body">A Basic Panel</div>
        //</div>

        echo "<div class=\"well\">";
        /* Start Story Panel/Well */
        echo "<div class=\"panel panel-default\"><div class=\"panel-body\"><p>Story text: ";
		print defaulty(nl2br(htmlentities(trim($room['blurb']))))."<br />\n";
		//echo "</p></div>\n";
        echo "</p></div></div>";//end panel and panel body
        /* End Story Panel */

        /* Start Choice Panel */
        //echo
		echo "<b>What will you do?</b><br />\n";
		echo "<div class=\"choices\">\n";
		print "[1] <a class=\"btn btn-primary\" href=\"room_adm.php?story=".$storyT."&room=".$room['room_1']."&from=".$room_id."&opt=1\">".defaulty(htmlentities($room['text_1']))."</a><br/>";
		print "[2] <a class=\"btn btn-primary\" href=\"room_adm.php?story=".$storyT."&room=".$room['room_2']."&from=".$room_id."&opt=2\">".defaulty(htmlentities($room['text_2']))."</a></p>";
		echo "</div>";
        /* End Choice Panel */
        echo "</div>";
 	}
	print "<br>";//print "<br><br><br><br>";
	echo "Something wrong with this entry? Bad spelling/grammar? Empty? Makes no sense? Then <a href=\"report.php?id=".$room['id']."\">report it</a>.<br />";

	//if (isset($_SERVER['PHP_AUTH_USER']) && $_SERVER['PHP_AUTH_USER'])


        echo "<br />";
		echo "<div class=\"alert alert-info\">You're logged in as an admin!";
		echo "<a class=\"pull-right\" href=\"edit.php?story=".$storyT."&id=".$room['id']."\">[Edit]</a>";
		echo "</div>";

	function defaulty($x){
		return strlen($x) ? $x : '<i>Blank</i>';
	}

	include('footer.php');
?>
