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
                            <div class="form-group">
                                <label for="sectionNumber">Section number: </label>
                                <input name="sectionNumber" type="number" class="form-control">
                            </div>
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

    <?php
        // Grab current consent form
        $sql = 'SELECT * FROM consentForm';
        $result = mysqli_query($db, $sql);

        foreach ($result as $row) {
            printf('<p>%u: <p>', htmlspecialchars($row['sectionNumber']));
            printf('<h4>%s</h4>', htmlspecialchars($row['header']));
            printf('<p>%s</p>', htmlspecialchars($row['body']));

        }

        mysqli_close($db);

    ?>

    <?php
    if (isset($_POST["sectionNumber"]) && isset($_POST["header"]) && isset($_POST["body"])) {
        // isset vs. empty()..
        //echo $_POST["title"];
        echo $_POST["sectionNumber"];
        echo "<br>";
        echo $_POST["header"];
        echo "<br>";
        echo $_POST["body"];
        echo "<p>Test run<p>";
    }

    $sectionNumber = 0;
    $header = "";
    $body = "";
    $ok = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["sectionNumber"]) && isset($_POST["header"]) && isset($_POST["body"])) {
        // Check if title empty
        if (empty($_POST["sectionNumber"])) {
            // error
            $ok = false;
        }
        else {
            $sectionNumber = test_input($_POST["sectionNumber"]);
        }

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

            $sql = sprintf("INSERT INTO consentForm (sectionNumber, header, body) VALUES ('%u', '%s', '%s')", $sectionNumber, $header, $body);

            // $sql = "INSERT INTO MyGuests (firstname, lastname, email)
            // VALUES ('John', 'Doe', 'john@example.com')";

            mysqli_query($db, $sql);

            echo "<p>Form submitted<p>";

            // Close connection to database
            mysqli_close($db);
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
