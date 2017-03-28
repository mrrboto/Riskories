<?php
    session_start();

    if(isset($_SESSION['name']))
    {
        $name = $_SESSION['name'];
        $soName = $_SESSION['soName'];
        $age = $_SESSION['age'];
    }
    else
    {
        $name = 'you';
        $soName = 'a friend';
        $age = 'whatever';
    }

    //SWAP for story text
    $story2 = str_replace('@name', $name, $room['blurb']);
    $story1 = str_replace('@so', $soName, $story2);
    $story = str_replace('@age', $age, $story1);

	//SWAP for choice 1 text
    $choice1_2 = str_replace('@name', $name, $room['text_1']);
	$choice1_1 = str_replace('@so', $soName, $choice1_2);
	$choice1 = str_replace('@age', $age, $choice1_1);

	//SWAP for choice 2 text
    $choice2_2 = str_replace('@name', $name, $room['text_2']);
	$choice2_1 = str_replace('@so', $soName, $choice2_2);
	$choice2 = str_replace('@age', $age, $choice2_1);

?>

