<?php
include('nav.php');
//testing user auth if admin or not
//echo $_SESSION['isAdmin'];

#TK temp? rerandom randomizers every time this page loads
//echo "stockdemo".$_SESSION['stockDemo']." nochoice".$_SESSION['randChoice'];
#TK STORING USER PATHS FOR BOTH GUEST AND USER
if (isset ($_SESSION['path'])){
	if($_SESSION['path'] != ''){


		$_SESSION['path'] = substr($_SESSION['path'],0,strlen($_SESSION['path'])-1);
		#MAKE SURE STORY PATH IS EMPTY IN DB
		$sql = sprintf("SELECT * FROM users WHERE name='%s' AND %s IS NULL",
        mysqli_real_escape_string($db, $_SESSION['user']),
		mysqli_real_escape_string($db, $_SESSION['storyNum'])
		);
		//echo $_SESSION['user']."did".$_SESSION['storyNum'];
		$result = mysqli_query($db, $sql);
		$row = mysqli_fetch_assoc($result);
		if($row){
			#TK CHECK DEMOGRAPHICS
			$_SESSION['path'] .= '[';
			//stock demographics werent used
			if ($_SESSION['stockDemo'] == 0){
				$anyFilled = false;
				if ($row['age'] != 0){
					$_SESSION['path'] .= 'a;';
					$anyFilled = true;
				}
				if ($row['realName'] != ''){
					$_SESSION['path'] .= 'rN;';
					$anyFilled = true;
				}
				if ($row['soStatus'] != ''){
					$_SESSION['path'] .= 'soS;';
					$anyFilled = true;
				}
				if ($row['soName'] != ''){
					$_SESSION['path'] .= 'soN;';
					$anyFilled = true;
				}
				if ($anyFilled)
				{
					$_SESSION['path'] = substr($_SESSION['path'],0,strlen($_SESSION['path'])-1);
				}
			}
			//stock demographics were used
			else{
				$_SESSION['path'] .= 'stock';
			}
			$_SESSION['path'] .= ']';
			#TK END DEMO CHECK
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

        //mysqli_close($db);
	}
}
$_SESSION['randChoice'] = rand(0,1);
$_SESSION['stockDemo'] = rand(0,1);

if (!isset($_SESSION['age'])){
	$_SESSION['age'] = 0;
}
if (!isset($_SESSION['realName'])){
	$_SESSION['realName'] = '';
}
if (!isset($_SESSION['soName'])){
	$_SESSION['soName'] = '';
}
//echo $_SESSION['randChoice'];
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

        <!-- LIST CSS STYLE CUSTOM
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
        -->

        <?php //display stories

            $sqli = 'SELECT * FROM stories';
            $stories = mysqli_query($db, $sqli);

            if(mysqli_num_rows($stories) > 0)
            {
                /*echo '<div class="container">
                        <div class="row">
                            <div class="col-md-2">
                                <h4>Riskories</h4>
                                <ul class="list-group">';
                */
                 echo '<div class="container">
                    <h4>Current Riskories</h4>
                        <ul class="list-group">';
            }

            foreach ($stories as $row)
            {
               /* printf('<li class="list-group-item">
                        <h4 class="list-group-item-heading"><a href="../cyo/room.php?story=%s">%s</a></h4>
                        <p class="list-group-item-text">A story about..</p>
                    </li>',
                    $row['title'],
                    $row['title'],
                    $row['title'],
                    htmlspecialchars($row['title'])
                  );*/
				printf('<li class="list-group-item">
                        <h4 class="list-group-item-heading"><a href="../questions/preQ.php?page=user&story=%s">%s</a></h4>
                        <p class="list-group-item-text">A story about..</p>
                    </li>',
                    $row['title'],
                    $row['title'],
                    $row['title'],
                    htmlspecialchars($row['title'])
                  );
                /*
                printf('<span style="text-align:center">
                        <a href="../cyo/room.php?story=%s"
                        class="list-group-item">%s</a></span>',
                        $row['title'],
                        htmlspecialchars($row['title'])
                      );
                */
            }

            mysqli_close($db);
        ?>

    </body>
</html>
