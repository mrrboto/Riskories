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

    $story2 = str_replace('@name', $name, $room['blurb']);
    $story1 = str_replace('@so', $soName, $story2);
    $story = str_replace('@age', $age, $story1);
?>

