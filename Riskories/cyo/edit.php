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
			'blurb'		=> AddSlashes($_POST['blurb']),
			'text_1'	=> AddSlashes($_POST['text_1']),
			'text_2'	=> AddSlashes($_POST['text_2']),
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
		include('header.php');
		print "error: room $room_id not found";
		include('footer.php');
		exit;
	}



?>


<h1>Edit <a href="room_adm.php?story=<?= $storyT ?>&room=<?= $room['id'] ?>">Room <?= $room['id'] ?></a></h1>

<?php if ($parent['id']){ ?>
	<p>Parent room: <a href="edit.php?story=<?= $storyT ?>&id=<?= $parent['id'] ?>">room <?= $parent['id'] ?></a>.</p>
<?php } ?>

<?php if (isset($_GET['done']) && $_GET['done']){ ?>
	<div style="border: 1px solid #000000; padding: 10px; background-color: #eeeeee;">Your changes have been saved.</div>
<?php } ?>

<form method="post">
<input type="hidden" name="id" value="<?= $room['id'] ?>" />
<input type="hidden" name="done" value="1" />

	<br /><p>Description:<br /><textarea name="blurb" cols="50" rows="10"><?= HtmlSpecialChars($room['blurb']) ?></textarea></p>

<?php if ($room['end_here']){ ?>

	<p>(story ends here)</p>

	<input type="hidden" name="text_1" value="" />
	<input type="hidden" name="text_2" value="" />

<?php }else{ ?>

	<p>	Choice 1:
<?php if ($room['room_1']){ ?>
		(to <a href="edit.php?story=<?= $storyT ?>&id=<?= $room['room_1'] ?>">room <?= $room['room_1'] ?></a>)
<?php }else{ ?>
		(no story written)
<?php } ?>
		<br /><input type="text" name="text_1" size="50" value="<?= HtmlSpecialChars($room['text_1']) ?>" />
	</p>

	<p>	Choice 2:
<?php if ($room['room_2']){ ?>
		(to <a href="edit.php?story=<?= $storyT ?>&id=<?= $room['room_2'] ?>">room <?= $room['room_2'] ?></a>)
<?php }else{ ?>
		(no story written)
<?php } ?>
		<br /><input type="text" name="text_2" size="50" value="<?= HtmlSpecialChars($room['text_2']) ?>" />
	</p>

<?php } ?>

	<p>
		<input type="submit" value="Save Changes" />
	</p>
</form>

<?php
	if ($room['room_1'] || $room['room_2']){
?>

<p>This room can't be deleted - it has children.</p>

<?php
	}else{
?>

<form method="post">
<input type="hidden" name="id" value="<?= $room['id'] ?>" />
<input type="hidden" name="delete" value="1" />

	<p>
		<br />
		<br />
		<br />
		<br />
		<input type="submit" value="Delete This Room" style="background-color: red; color: white; font-weight: bold;" />
	</p>
</form>

<?php
	}
?>


<?php
	include('footer.php');
?>
