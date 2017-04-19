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
        include('../cyo/addS.php');
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

        <!-- LIST CSS STYLE CUSTOM -->
        <style>

            .list-group {
                max-width: 250px;
                min-width: 250px;
            }
            .list-group-item {
                position: relative;
                display: block;
                padding: 10px 15px;
                margin-bottom: -1px;
                background-color: #000;
                border: 1px solid #ddd;
                max-width: 250px;
                min-width: 250px;
            }

        </style>

        <!-- START NEW STORY/DEFAULT STORY BUTTONS CONTAINER + LOGIC -->
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <span style="padding-right:15px">
                        <a href="admin.php?add=1">
                        <button type="button" class="btn btn-default btn-md">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> New Story
                        </button></a>
                    </span>
                    <span style="padding-right:15px">
                    <a href="../cyo/room_adm.php"><button type="button" class="btn btn-default btn-md">
                        Default Story
                        </button></a>
                    </span>
                    <a href="../admin/excel.php"><button type="button" class="btn btn-default btn-md">
                        Export CSV
                        </button>
                    </a>
                    <ul>
                    <?php

                        if(isset($_GET['add']))
                        {
                            echo '<form method="post" action="" class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                            <input type="text" style="max-width: 200px;" name="title" class="form-control" placeholder="Story Name">
                            </div>
                            <button type="submit" name="save" class="btn btn-default">Submit</button>'.$message.'
                          </form>';
                        }

                    ?>
                    </ul>
                </div>
            </div>
        </div>


        <!--START STORY LIST -->
        <?php
        $sqli = 'SELECT * FROM stories';
        $stories = mysqli_query($db, $sqli);

        if(mysqli_num_rows($stories) > 0)
        {
            echo '<div class="container">
                    <div class="row">
                        <div class="col-md-2">
                            <h4>Riskories</h4>
                            <ul class="list-group">';
        }
        foreach ($stories as $row)
        {
            printf('<li class="list-group-item">
                        <a href="../cyo/room_adm.php?story=%s">%s</a>
                        <span style="float:right;">
                            <a href="../cyo/create.php?story=%s">create</a>&nbsp&nbsp
                            <a href="../cyo/deleteS.php?story=%s">delete</a>
                        </span>
                    </li>',
                    $row['title'],
                    htmlspecialchars($row['title']),
                    $row['title'],
                    $row['title']
                  );
        }

        mysqli_close($db);
        ?>
        </ul>
    </div>
</div><!--end story row-->
</div><!--end story container-->
</body>
</html>

