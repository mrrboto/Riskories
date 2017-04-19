<?php
    include('nav.php');

    if (isset($_GET['id']) && ctype_digit($_GET['id'])) {
        $id = $_GET['id'];
    } else {
        header('Location: select.php');
    }

?>
<!DOCTYPE>
<html>
<head>
    <title>PHP</title>
</head>
<body style="background: #efefef;">
<?php
    //readfile('nav.php');
    //include('../db/config.php');
    //include('../db/db.php');

    $sql = "DELETE FROM users WHERE id=$id";
    mysqli_query($db, $sql);
    echo '<p>User deleted.</p>';

    mysqli_close($db);
?>
</body>
</html>
