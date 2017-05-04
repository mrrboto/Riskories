<!DOCTYPE html>
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
                            <div class="form-group">
                                <label for="consentFormTitle">Consent form title: </label>
                                <input name="title" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="consentFormSectionHeader1">Consent form section header 1: </label>
                                <input name="header1" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="consentFormBody1">Consent form body 1: </label>
                                <textarea name="body1" class="form-control" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                      </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST["title"]) && isset($_POST["header1"]) && isset($_POST["body1"])) {
        // isset vs. empty()..
        echo $_POST["title"];
        echo "<br>";
        echo $_POST["header1"];
        echo "<br>";
        echo $_POST["body1"];
    }

    $title = "";
    $header1 = "";
    $body1 = "";
    $ok = true;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Check if title empty
        if (empty($_POST["title"])) {
            // error
            $ok = false;
        }
        else {
            $title = test_input($_POST["title"]);
        }

        // Check if header1 empty
        if (empty($_POST["header1"])) {
            // error
            $ok = false;
        }
        else {
            $header1 = test_input($_POST["header1"]);
        }

        // Check if body1 empty
        if (empty($_POST["body1"])) {
            // error
            $ok = false;
        }
        else {
            $body1 = testinput($_POST["body1"]);
        }
    }

    // Update database
    if($ok) {
        $sql = sprintf("UPDATE ConsentForm SET Title='%s', HeaderOne='%s', BodyOne='%s'",
          mysqli_real_escape_string($db, $title),
          mysqli_real_escape_string($db, $header1),
          mysqli_real_escape_string($db, $body1));

        mysqli_query($db, $sql);

        echo "<p>Form submitted<p>";

        // Close connection to database
        mysqli_close($db);
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
