<html>
<head>
    <title>Admin Portal - Add</title>
</head>
<body>
<?php

    include('nav.php');

    $dbi = mysqli_connect('localhost', 'root', '', 'riskories');
    $sqli = 'SELECT * FROM stories';
    $stories = mysqli_query($dbi, $sqli);
?>

<form method='post' action=''><div>
Story Name: <input type='text' name='title'>
<input type='submit' name='save' value='Save'></div></form>



<?php //display stories

    foreach ($stories as $row)
    {
        printf('<li><span><a href="../cyo/room_adm.php?story=%s">%s</a></span>&nbsp&nbsp
        <a href="../cyo/create.php?story=%s">create</a></li>',
        $row['title'],
        htmlspecialchars($row['title']),
        $row['title']
        );
    }

?>


<?php //check if save is clicked

    if (isset($_POST['save']))
    {
        if(!isset($_POST['title']) || $_POST['title'] == '')
        {
            echo "<p>Field cannot be blank</p>";
        }
        else
        {
            include('../cyo/add_room.php');
            echo "<p>Story added</p>";
            header('Location: nav.php');
        }

    }
?>

    </body>
</html>
