<?php

    session_start();

    //If the user is an admin - redirect to room_adm.php
    if (isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1)
    {
        header('Location: /Riskories/cyo/room_adm.php');
       //header('Location: /Riskories/nav/profile.php');
    }



    include('config.php');
	include('db.php');
	include('header.php');



print nl2br(htmlentities(chop($settings['main_page_text'])));
?>


<br /><br />
So what are you waiting for?
<?php
//$story = $_GET['story'];
echo "<a href='room.php?story=$storyT' style='font-size: 140%;'>Start playing</a>.
<br /><br />"
?>
<?php
	include('footer.php');
?>
