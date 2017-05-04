<?php
  include('nav.php');
?>
<!DOCTYPE>
<html>
<head>
    <title>Admin Portal - Select</title>
</head>
<body style="background: #efefef;">
    <div class="container">
        <ul>
            <?php

            $sql = 'SELECT * FROM users';
            $result = mysqli_query($db, $sql);

            foreach ($result as $row) {
                printf('<li><span>%s (%s)</span>
                  <a href="update.php?id=%s">edit</a>
                  <a href="delete.php?id=%s">delete</a></li>',
                  //htmlspecialchars($row['color']),
                  htmlspecialchars($row['name']),
                  htmlspecialchars($row['gender']),
                  htmlspecialchars($row['id']),
                  htmlspecialchars($row['id'])
                );
            }

            mysqli_close($db);

            ?>
        </ul>
    </div>
</body>
</html>
