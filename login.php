<?php
  session_start();

$message = '';

if (isset($_POST['name']) && isset($_POST['password'])) {
    $db = mysqli_connect('localhost', 'root', '', 'riskories');
    $sql = sprintf("SELECT * FROM users WHERE name='%s'",
        mysqli_real_escape_string($db, $_POST['name'])
    );
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_assoc($result);
    if ($row) {
        $hash = $row['password'];
        $isAdmin = $row['isAdmin'];

        if (password_verify($_POST['password'], $hash)) {
            $message = 'Login successful.';
            

            $_SESSION['user'] = $row['name'];
            $_SESSION['isAdmin'] = $isAdmin;
            
            header('Location: nav.html');

        } else {
            $message = 'Login failed.';
        }
    } else {
        $message = 'Login failed.';
    }
    mysqli_close($db);
}


?><!DOCTYPE html>
<html>
<head>
    <title>PHP</title>
</head>
<body>
<?php
//readfile('nav.html');

echo "<p>$message</p>";
?>
<form method="post" action="">
    User name <input type="text" name="name"><br>
    Password <input type="password" name="password"><br>
    <input type="submit" value="Login">
</form>

</body>
</html>