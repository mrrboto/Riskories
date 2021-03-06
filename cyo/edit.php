<?php
    include('../admin/admin_auth.php');
	include('../db/config.php');
	include('../db/db.php');
    include('header.php');

	#
	# save changes?
	#

	if (isset($_POST['done']) && $_POST['done']){

		$id = intval($_POST['id']);

		db_update($storyR, array(
			'blurb'		    => AddSlashes($_POST['blurb']),
			'text_1'	    => AddSlashes($_POST['text_1']),
            'choice1_risk'  => $_POST['risk1'],
			'text_2'	    => AddSlashes($_POST['text_2']),
            'choice2_risk'  => $_POST['risk2'],
		), "id=$id");

		header("location: edit.php?story=$storyT&id=$id&done=1");
		exit;
	}


	#
	# delete room?
	#

	if (isset($_POST['delete']) && $_POST['delete']){

		$id = intval($_POST['id']);

		$room = db_single(mysqli_query($db, "SELECT * FROM `$storyR` WHERE id=$id"));
		$parent	= db_single(mysqli_query($db, "SELECT * FROM `$storyR` WHERE room_1=$id OR room_2=$id"));

		db_write("DELETE FROM `$storyR` WHERE id=$id");
		db_write("UPDATE `$storyR` SET room_1=0 WHERE room_1=$id");
		db_write("UPDATE `$storyR` SET room_2=0 WHERE room_2=$id");

		header("location: edit.php?story=$storyT&id=$parent[id]");
		exit;
	}



	#
	# get info for display
	#

	$room_id = intval($_GET['id']);

	$room = db_single(mysqli_query($db, "SELECT * FROM `$storyR` WHERE id=$room_id"));
	$parent	= db_single(mysqli_query($db, "SELECT * FROM `$storyR` WHERE room_1=$room_id OR room_2=$room_id"));

	if (!$room['id']){
		print "error: room $room_id not found";
		include('footer.php');
		exit;
	}



?>


<h1>Edit <a href="room_adm.php?story=<?= $storyT ?>&room=<?= $room['id'] ?>">Room <?= $room['id'] ?></a></h1>

<div class="well">

    <!-- Sample for Styling Forms
    <div class="form-group">
        <label>Story Title: </label>
            <input class="form-control" name="title" type="text" size="50" value="<?= HtmlSpecialChars($settings['title']) ?>"/>
    </div>
    -->

    <?php if ($parent['id']){ ?>
        <p>Parent room: <a href="edit.php?story=<?= $storyT ?>&id=<?= $parent['id'] ?>">room <?= $parent['id'] ?></a>.</p>
    <?php } ?>

    <?php if (isset($_GET['done']) && $_GET['done']){ ?>
        <div style="border: 1px solid #000000; padding: 10px; background-color: #eeeeee;">Your changes have been saved.</div>
    <?php } ?>

    <form method="post">
    <input type="hidden" name="id" value="<?= $room['id'] ?>" />
    <input type="hidden" name="done" value="1" />

    <div class="form-group">
        <label>Description: </label>
        <textarea class="form-control" name="blurb" cols="50" rows="10"><?= HtmlSpecialChars($room['blurb']) ?></textarea>
    </div>

    <?php if ($room['end_here']){ ?>

        <p>(story ends here)</p>

        <input type="hidden" name="text_1" value="" />
        <input type="hidden" name="text_2" value="" />

    <?php }else{ ?>

    <div class="form-group form-inline">
        <label>Choice 1: </label>
        <!--<p>	Choice 1:-->
    <?php if ($room['room_1']){ ?>
            (to <a href="edit.php?story=<?= $storyT ?>&id=<?= $room['room_1'] ?>">room <?= $room['room_1'] ?></a>)
    <?php }else{ ?>
            (no story written)
    <?php } ?>
            <br /><input class="form-control" type="text" name="text_1" size="50" value="<?= HtmlSpecialChars($room['text_1']) ?>" />
            <!--ADDED RISK LEVEL FOR EDIT #VP -->
            Risk Level
            <select class="form-control" name='risk1'>
                <option name ='c1r1' value='1'>1</option>
                <option name ='c1r2' value='2'>2</option>
                <option name ='c1r3' value='3'>3</option>
                <option name ='c1r4' value='4'>4</option>
                <option name ='c1r5' value='5'>5</option>
            </select>
        <!--</p>-->
    </div>

    <div class="form-group form-inline">
        <label>Choice 2: </label>
        <!--<p>	Choice 2: -->
    <?php if ($room['room_2']){ ?>
            (to <a href="edit.php?story=<?= $storyT ?>&id=<?= $room['room_2'] ?>">room <?= $room['room_2'] ?></a>)
    <?php }else{ ?>
            (no story written)
    <?php } ?>
            <br /><input class="form-control" type="text" name="text_2" size="50" value="<?= HtmlSpecialChars($room['text_2']) ?>" />
            <!--ADDED RISK LEVEL FOR EDIT #VP -->
            Risk Level
            <select class="form-control" name='risk2'>
                <option name ='c2r1' value='1'>1</option>
                <option name ='c2r2' value='2'>2</option>
                <option name ='c2r3' value='3'>3</option>
                <option name ='c2r4' value='4'>4</option>
                <option name ='c2r5' value='5'>5</option>
            </select>
        <!--</p> -->

    <?php } ?>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Save Changes" />
    </div>

    </form>

    <?php
        if ($room['room_1'] || $room['room_2']){
    ?>

    <div class="alert alert-info">
        <p>This room can't be deleted - it has children.</p>
    </div>


    <?php  //ADDED CASE TO CHECK IF IT IS FIRST ROOM (DO NOT DELETE) #VP
        }
        else if ($room['id'] == 1)
        {
            echo "<div class=\"alert alert-info\"><p>This room can't be deleted - it is the first room.</p><div>";
        }
        else
        {
    ?>

    <form method="post">
    <input type="hidden" name="id" value="<?= $room['id'] ?>" />
    <input type="hidden" name="delete" value="1" />

        <div class="form-group">
            <input class="btn btn-primary" type="submit" value="Delete This Room" />
        </div>
    </form>

</div>

<?php
	}
?>


<?php
	include('footer.php');
?>
