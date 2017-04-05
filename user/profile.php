<?php
include('nav.php');
//testing user auth if admin or not
//echo $_SESSION['isAdmin'];
#TK STORING USER PATHS FOR BOTH GUEST AND USER
//TESTING FOR STORING
//echo $_SESSION['path'];
if (isset ($_SESSION['path'])){
	//echo "<p>testerino<p>";
	if($_SESSION['path'] != ''){
		//echo "<p>testerino<p>";
		$_SESSION['path'] = substr($_SESSION['path'],0,strlen($_SESSION['path'])-1);
		$db = mysqli_connect('localhost', 'root', '', 'riskories');
		$sql = sprintf("SELECT * FROM users WHERE name='%s' AND %s IS NULL",
        mysqli_real_escape_string($db, $_SESSION['user']),
		mysqli_real_escape_string($db, $_SESSION['storyNum'])
		);
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		if($row){
			$updateSQL = sprintf("UPDATE users SET %s='%s' WHERE name='%s'",
			mysqli_real_escape_string($db, $_SESSION['storyNum']),
			mysqli_real_escape_string($db, $_SESSION['path']),
			mysqli_real_escape_string($db,$_SESSION['user'])
			);
			$result = mysqli_query($db, $updateSQL);
			//echo $_SESSION['storyNum'].$_SESSION['path'].$_SESSION['user'];
		}
		
		$_SESSION['path'] = '';
		$_SESSION['choiceNum'] = 1;
	}
}
#TK

?>

<?php
	if(isset($_GET['page'])){
		if($_GET['page'] == 'demographic'){
			include('demographic.php');
		}
		else if($_GET['page'] == 'password'){
			include('edit_pass.php');
		}
	}
?>

<!DOCTYPE>
<html>
    <head>
        <title>User Portal</title>
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

            a.list-group-item,
            button.list-group-item {
              color: #efefef;
            }

            a.list-group-item:hover,
            button.list-group-item:hover,
            a.list-group-item:focus,
            button.list-group-item:focus {
              color: #efefef;
              text-decoration: none;
              background-color: #202c74;
            }

        </style>

        <?php //display stories

            $dbi = mysqli_connect('localhost', 'root', '', 'riskories');
            $sqli = 'SELECT * FROM stories';
            $stories = mysqli_query($dbi, $sqli);

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
                printf('<span style="text-align:center">
                        <a href="../cyo/room.php?story=%s"
                        class="list-group-item">%s</a></span>',
                        $row['title'],
                        htmlspecialchars($row['title'])
                      );
            }

        ?>

    </body>
</html>
