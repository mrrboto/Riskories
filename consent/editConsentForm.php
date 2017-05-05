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
                            <div class="form-group">
                                <label for="consentFormHTML">Consent Form HTML: </label>
                                <textarea id="consentFormTextArea" name="consentFormHTML" class="form-control" rows="10" oninput="textAreaChanged()"></textarea>
                            </div>
                            <button type="submit" name="save" class="btn btn-primary">Save</button> <!-- button type="submit|button|reset" -->
                      </form>
                </div>
            </div>
        </div>

        <div class="row" id="consentUpdateAlert">

        </div>

        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Live Look</h4></div>
                <div class="panel-body" id="storedConsentForm">
                </div>
            </div>
        </div>

    </div>

    <script type="text/javascript">
        // Script to update live HTML
        function textAreaChanged() {
            console.log("Event called");
            // Access text area value
            var textAreaValue = document.getElementById('consentFormTextArea').value;
            // Update html
            var liveHTML = document.getElementById('storedConsentForm');
            liveHTML.innerHTML = textAreaValue;
        }
    </script>


    <?php
        /// Grab current consent form
        $sql = 'SELECT * FROM consentForm';
        $result = mysqli_query($db, $sql);

        echo "<script type=\"text/javascript\">";
        // Grab string from database and put into text area and stored consent form div
        echo "var consentTextArea = document.getElementById(\"consentFormTextArea\");";
        echo "var storedConsentDiv = document.getElementById(\"storedConsentForm\");";
        foreach($result as $row) {
            printf("consentTextArea.value = '%s';", $row['html']);
            printf("storedConsentDiv.innerHTML = '%s';", $row['html']);
        }
        echo "</script>";

        mysqli_close($db);
    ?>

    <?php
        $db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);

        if (!$db)
        {
            die('Could not connect: ' . mysqli_error($db). "\n\nHave you run the install.php script yet?");
        }

        /*// If Delete all pressed empty the consentForm table
        if (isset($_POST['delete']))
        {
            mysqli_query($db, "TRUNCATE TABLE consentForm;");
            echo "<script type=\"text/javascript\">";
            echo "console.log('Delete pressed');";
            echo "</script>";
            // remove any previous message then notify user of update
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"consentUpdateAlert\");";
            echo "while (alert.hasChildNodes()) {
                alert.removeChild(alert.lastChild);
            }";
            echo "var div = document.createElement(\"div\");";
            echo "div.setAttribute(\"class\", \"alert alert-success\");";
            echo "var strongTag = document.createElement(\"strong\");";
            echo "var strongText = document.createTextNode(\"Success: \");";
            echo "strongTag.appendChild(strongText);";
            echo "var divText = document.createTextNode(\"Previous consent form deleted. Please refresh page to see results.\");";
            echo "div.appendChild(strongTag);";
            echo "div.appendChild(divText);";
            echo "alert.appendChild(div);";
            echo "</script>";
        }*/

        /*// If add is pressed
        if(isset($_POST['add']))
        {
            // Refresh the page to update results
            echo "<script type=\"text/javascript\">";
            echo "console.log('Add pressed');";
            echo "</script>";
            // remove any previous message then notify user of update
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"consentUpdateAlert\");";
            echo "while (alert.hasChildNodes()) {
                alert.removeChild(alert.lastChild);
            }";
            echo "var div = document.createElement(\"div\");";
            echo "div.setAttribute(\"class\", \"alert alert-success\");";
            echo "var strongTag = document.createElement(\"strong\");";
            echo "var strongText = document.createTextNode(\"Success: \");";
            echo "strongTag.appendChild(strongText);";
            echo "var divText = document.createTextNode(\"Section added. Please refresh page to see results.\");";
            echo "div.appendChild(strongTag);";
            echo "div.appendChild(divText);";
            echo "alert.appendChild(div);";
            echo "</script>";
        }*/
    ?>

    <?php
    $consentHTML = "";
    $ok = true;

    // If save is pressed..
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {

        // Testing
        echo "<script type=\"text/javascript\">";
        echo "console.log('Save pressed');";
        echo "</script>";

        // Check if empty
        if (empty($_POST["consentFormHTML"])) {
            // error
            $ok = false;
        }
        else {
            //$consentHTML = test_input($_POST["consentFormHTML"]);
            $consentHTML = $_POST["consentFormHTML"];
            echo "<script type=\"text/javascript\">";
            printf("console.log('%s');", $consentHTML);
            echo "</script>";
        }

        // Update database
        if($ok) {
            $db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);

            if (!$db)
            {
                die('Could not connect: ' . mysqli_error($db). "\n\nHave you run the install.php script yet?");
            }

            // Drop previous entries
            mysqli_query($db, "TRUNCATE TABLE consentForm;");

            $sql = sprintf("INSERT INTO consentForm (html) VALUES ('%s')", $consentHTML);

            mysqli_query($db, $sql);

            // Close connection to database
            mysqli_close($db);

            // Refresh the page to update results..

            // Notify user of update
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"consentUpdateAlert\");";
            echo "while (alert.hasChildNodes()) {
                alert.removeChild(alert.lastChild);
            }";
            echo "var div = document.createElement(\"div\");";
            echo "div.setAttribute(\"class\", \"alert alert-success\");";
            echo "var strongTag = document.createElement(\"strong\");";
            echo "var strongText = document.createTextNode(\"Success: \");";
            echo "strongTag.appendChild(strongText);";
            echo "var divText = document.createTextNode(\"Form updated. Please refresh page to see results.\");";
            echo "div.appendChild(strongTag);";
            echo "div.appendChild(divText);";
            echo "alert.appendChild(div);";
            echo "</script>";


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
