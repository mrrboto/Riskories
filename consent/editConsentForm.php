<!DOCTYPE html>
<?php
include('../db/config.php');
include('../db/db.php');
?>
<html>

<head>
</head>
<body>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <div class="navbar">
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
                    <a class="navbar-brand" href="../admin/admin.php">
                        <img alt="Brand" src="../img/s_logo_3.png" height="45px" width="40px" style="padding-bottom: 20px">
                    </a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="../admin/admin.php">Home<span class="sr-only">(current)</span></a></li>
                        <li><a href="../consent/consentform.php">View Consent Form</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                               aria-expanded="false">Users <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                <li><a href="../admin/insert.php">Add</a></li>
                                <li><a href="../admin/select.php">List</a></li>
                            </ul>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="../login/logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Edit Consent Form</h4></div>
                  <div class="panel-body">
                      <form method="post">
                            <!--<div class="form-group">
                                <label for="consentFormTitle">Consent form title: </label>
                                <input name="title" type="text" class="form-control">
                            </div>-->
                            <!--<div class="form-group">
                                <label for="sectionNumber">Section number: </label>
                                <input name="sectionNumber" type="number" class="form-control">
                            </div>-->
                            <div class="form-group">
                                <label for="consentFormSectionHeader">Section header: </label>
                                <input name="header" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="consentFormBody">Section body: </label>
                                <textarea name="body" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-primary">Delete All</button> <!-- button type="submit|button|reset" -->
                      </form>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Current Consent Form</h4></div>
                <div class="panel-body" id="storedConsentForm">

                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        console.log(document.getElementById("storedConsentForm"));
    </script>

    <?php
        // Grab current consent form
        $sql = 'SELECT * FROM consentForm';
        $result = mysqli_query($db, $sql);

        echo "<script type=\"text/javascript\">";
        //echo "var consentDiv = document.getElementById(\"storedConsentForm\");";
        echo "var consentDiv = document.getElementById(\"storedConsentForm\");";
        foreach ($result as $row) {
            //printf('%u: ', htmlspecialchars($row['sectionNumber']));
            //printf('<h4>%s</h4>', htmlspecialchars($row['header']));
            //printf('<p>%s</p>', htmlspecialchars($row['body']));

            echo "var h4 = document.createElement(\"h4\");";
            printf("var headerText = document.createTextNode(\"%s\");", htmlspecialchars($row['header']));
            echo "var p = document.createElement(\"p\");";
            printf("var pText = document.createTextNode(\"%s\");", htmlspecialchars($row['body']));

            // Add text to tags
            echo "h4.appendChild(headerText);";
            echo "p.appendChild(pText);";

            // Add tags to div
            echo "consentDiv.appendChild(h4);";
            echo "consentDiv.appendChild(p);";
        }
        echo "</script>";

        mysqli_close($db);

    ?>

    <?php
    //if (isset($_POST["header"]) && isset($_POST["body"])) {
        // isset vs. empty()..
        //echo $_POST["title"];
        /*echo $_POST["sectionNumber"];
        echo "<br>";
        echo $_POST["header"];
        echo "<br>";
        echo $_POST["body"];*/
        //echo "<p>Test run<p>";
    //}

    $sectionNumber = 0;
    $header = "";
    $body = "";
    $ok = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["header"]) && isset($_POST["body"])) {
        // Check if title empty
        /*if (empty($_POST["sectionNumber"])) {
            // error
            $ok = false;
        }
        else {
            $sectionNumber = test_input($_POST["sectionNumber"]);
        }*/

        // Check if header1 empty
        if (empty($_POST["header"])) {
            // error
            $ok = false;
        }
        else {
            $header = test_input($_POST["header"]);
        }

        // Check if body1 empty
        if (empty($_POST["body"])) {
            // error
            $ok = false;
        }
        else {
            $body = test_input($_POST["body"]);
        }

        // Update database
        if($ok) {
            /*$sql = sprintf("UPDATE ConsentForm SET Title='%s', Header1='%s', Body1='%s'",
              mysqli_real_escape_string($db, $title),
              mysqli_real_escape_string($db, $header1),
              mysqli_real_escape_string($db, $body1));*/
            $db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);

            if (!$db)
            {
                die('Could not connect: ' . mysqli_error($db). "\n\nHave you run the install.php script yet?");
            }

            $sql = sprintf("INSERT INTO consentForm (sectionNumber, header, body) VALUES ('%u', '%s', '%s')", $sectionNumber, $header, $body);

            // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
            // VALUES ('John', 'Doe', 'john@example.com')";

            mysqli_query($db, $sql);

            //echo "<p>Form submitted<p>"; // for testing

            // Close connection to database
            mysqli_close($db);

            /*// Refresh the page to update results
            echo "<script type=\"text/javascript\">";
            echo "window.location.reload();";
            echo "</script>";*/
        }
    }

    // From: https://www.w3schools.com/php/php_form_validation.asp // For protecting against SQL injection
    function test_input($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    ?>
</body>
</html>
