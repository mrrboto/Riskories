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
    <div id="adminDeleteAlert" class="container">
        <?php
            //readfile('nav.php');
            //include('../db/config.php');
            //include('../db/db.php');

            $sql = "DELETE FROM users WHERE id=$id";
            mysqli_query($db, $sql);
            $adminDeleteMessage = "User deleted.";
            //echo '<p>User deleted.</p>';

            mysqli_close($db);

            // remove any previous message
            echo "<script type=\"text/javascript\">";
            echo "var alert = document.getElementById(\"adminDeleteAlert\");";
            echo "while (alert.hasChildNodes()) {
                alert.removeChild(alert.lastChild);
            }";
            echo "</script>";

            if(strcmp($adminDeleteMessage, 'User deleted.') == 0) {
                echo "<script type=\"text/javascript\">";
                echo "var alert = document.getElementById(\"adminDeleteAlert\");";
                echo "var div = document.createElement(\"div\");";
                echo "div.setAttribute(\"class\", \"alert alert-success\");";
                echo "var strongTag = document.createElement(\"strong\");";
                echo "var strongText = document.createTextNode(\"Success: \");";
                echo "strongTag.appendChild(strongText);";
                echo "var divText = document.createTextNode(\"User deleted\");";
                echo "div.appendChild(strongTag);";
                echo "div.appendChild(divText);";
                echo "alert.appendChild(div);";
                echo "</script>";
            }
        ?>
    </div>
</body>
</html>
