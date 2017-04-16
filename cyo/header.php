<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>

<?php
if ($db) {

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
<link rel="stylesheet" type="text/css" media="screen" href="choose.css" />
<?php
if ($db) {
	if ($settings['enable_analytics'] == 1) {
		echo $settings['analytics_blurb'];
	}
}
?>
</head>

<body id="body">
<div class="content">

