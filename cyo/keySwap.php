<?php
    session_start();

    $name = $_SESSION['name'];
    $soName = $_SESSION['soName'];
    $age = $_SESSION['age'];

    $story2 = str_replace('@name', $name, $room['blurb']);
    $story1 = str_replace('@so', $soName, $story2);
    $story = str_replace('@age', $age, $story1);
?>

