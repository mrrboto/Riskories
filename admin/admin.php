<?php
include('nav.php');

$message = '';

if (isset($_POST['save']))
{
    if(!isset($_POST['title']) || $_POST['title'] == '')
    {
        $message = "<p>Field cannot be blank</p>";
    }
    else if(preg_match("/[^A-Za-z0-9\' ']/", $_POST['title']))
    {
        $message = "<p>Title cannot contain special characters</p>";
    }
    else
    {
        include('../cyo/add_room.php');
        $message = "<p>Story added</p>";
        header('Location: admin.php');
    }
}
?>
<!DOCTYPE>
<html>
    <head>
        <title>Admin Portal</title>
    </head>
    <body style="background: #efefef;">

        <style>

            .list-group {

                max-width: 330px;
            }
            .list-group-item {
                position: relative;
                display: block;
                padding: 10px 15px;
                margin-bottom: -1px;
                background-color: #000;
                border: 1px solid #ddd;
                max-width: 330px;
            }

        </style>


        <div class="container">
            <a href="admin.php?add=1"><button type="button" class="btn btn-default btn-md">
                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Story
                </button>
            </a>
            <ul class="list-group">
                <?php

                    if(isset($_GET['add']))
                    {
                        echo '<form method="post" action="" class="navbar-form navbar-left" role="search">
                        <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Story Name">
                        </div>
                        <button type="submit" name="save" class="btn btn-default">Submit</button>'.$message.'
                      </form>
                     </div>';
                    }

                ?>
            </ul>
        </div>

        <!--START STORY LIST -->
        <?php

        $dbi = mysqli_connect('localhost', 'root', '', 'riskories');
        $sqli = 'SELECT * FROM stories';
        $stories = mysqli_query($dbi, $sqli);

        if(mysqli_num_rows($stories) > 0)
        {
            echo '<div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <h4>Riskories</h4>
                        </div>
                    </div>

                    <div class="bs-example">
                        <ul class="list-group">';
        }
        foreach ($stories as $row)
        {
            printf('<li class="list-group-item"><span><a href="../cyo/room_adm.php?story=%s">%s</a></span>&nbsp&nbsp
                                <a href="../cyo/create.php?story=%s">create</a>&nbsp&nbsp
                                <a href="../cyo/deleteS.php?story=%s">delete</a></li>',
                   $row['title'],
                   htmlspecialchars($row['title']),
                   $row['title'],
                   $row['title']
                  );
        }

        ?>
        </ul>
    </div>
</div>
</body>
</html>
