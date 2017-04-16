</div>
	<p style="margin: 0;">
		<?php
        if(isset($_SESSION['isAdmin']))
        {
            if($_SESSION['isAdmin'] == 0)
            {
                //echo "<br>&raquo;<a href='../user/profile.php'>Profile</a><br /><br />";
            }
            else
            {
                //echo "<br>&raquo;<a href='../admin/admin.php'>Profile</a><br /><br />";
            }

        }
        else
        {
            //echo "<br>&raquo;<a href='../index.html'>Main Screen</a><br /><br />";
        }
		?>
        <?php
		if ($db) {
			//$storyR = $_GET['story']."_rooms";
			$total_rooms = db_single(mysqli_query($db, "SELECT count(*) as total FROM `$storyR`"));
			// commented out by Spencer // echo "Total Rooms: ".$total_rooms['total'];
            }
		?>

	</p>
</body>
</html>
