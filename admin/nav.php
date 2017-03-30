<?php
include('admin_auth.php');
include('../cyo/config.php');
include('../cyo/db.php');
?>


<html>
    <head>
    <style>
        .test {
            padding-bottom: 10px;
        }
        .test ul {
            list-style-type: none;
            margin: 0;
            padding: 0px;
            width: 200px;
            background-color: #f1f1f1;
        }

        .test li a {
            display: block;
            color: #000;
            padding: 8px 16px;
            text-decoration: none;
        }

        /* Change the link color on hover */
        .test li a:hover {
            background-color: #555;
            color: white;
        }
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
          integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    </head>
    <body>

    <header class="navbar">
        <nav class="container navbar-inverse">
            <div class="container-fluid">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">
                    <img alt="Brand" src="../img/s_logo_3.png" height="45px" width="40px" style="padding-bottom: 20px">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="#">Home <span class="sr-only">(current)</span></a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
     </header>

            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Admin Portal</h4>
                    </div>
                    <div class="col-md-1 col-md-offset-7">
                        <b id="logout"><a class="btn btn-danger btn-sm pull-right" href="../login/logout.php">Log Out</a></b>
                    </div>
                </div>

                <div class="list-group">
                    <a href="insert.php"><button type="button" class="list-group-item">Insert</button></a>
                    <a href="select.php"><button type="button" class="list-group-item">Select</button></a>
                    <a href="update.php"><button type="button" class="list-group-item">Update</button></a>
                    <a href="delete.php"><button type="button" class="list-group-item">Delete</button></a>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <h4>Riskories</h4>
                    </div>
                </div>

                <div class="list-group">
                    <a href="../cyo/create.php"><button type="button" class="list-group-item">Create</button></a>
                    <a href="../cyo/index.php"><button type="button" class="list-group-item">Edit</button></a>
                    <a href="add.php"><button type="button" class="list-group-item">New Story</button></a>
                </div>
            </div>

<!--
>>>>>>> master
<h2>Admin Portal</h2>
<div class="test">
<ul>
<li><a href="insert.php">INSERT</a></li>
<li><a href="select.php">SELECT</a></li>
<li><a href="update.php">UPDATE</a></li>
<li><a href="delete.php">DELETE</a></li>
<li><a href="../login/logout.php">LOGOUT</a></li>

</ul>
</div>

<div class="test" style="float: middle">
<h2>Riskories</h2>
<ul>
<li><a href="../cyo/create.php">CREATE</a></li>
<li><a href="../cyo/index.php">EDIT</a></li>
<li><a href="add.php">NEW STORY</a></li>
</ul>
</div>
<<<<<<< HEAD
-->

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </body>
</html>
