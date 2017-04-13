<?php

?>


<?php //CYO DATABASE ADDITIONS (VP)

$db = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_data']);

if (!$db)
{
die('Could not connect: ' . mysqli_error($db). "\n\nHave you run the install.php script yet?");
}

//DEBUGGIN
//error_reporting(E_ALL);

function db_single($ret){
  //return $ret['ok'] && count($ret['rows']) ? $ret['rows'][0] : FALSE;
  $row = mysqli_fetch_array($ret);
  return $row;
}

function db_query($sql){


    $db = $GLOBALS['db'];
    $result = mysqli_query($db, $sql);

	if (!$result){
		echo "<hr /><pre>";
		echo "ERROR: ".HtmlSpecialChars(mysqli_error($db))."\n";
		echo "SQL  : ".HtmlSpecialChars($sql)."\n";
		echo "STACK: ".HtmlSpecialChars(db_trace())."\n";
		echo "</pre><hr />\n";
	}

	return $result;
}

function db_update($table, $hash, $where){

	$bits = array();
	foreach(array_keys($hash) as $k){
		$bits[] = "`$k`='$hash[$k]'";
	}

	$result = db_query("UPDATE `$table` SET ".implode(', ',$bits)." WHERE $where");

	return $result;
	}

function db_write($sql){

    $db = $GLOBALS['db'];
    $result = mysqli_query($db, $sql);

    if (!$result){
            echo "<hr /><pre>";
            echo "ERROR: ".HtmlSpecialChars(mysqli_error($db))."\n";
            echo "SQL  : ".HtmlSpecialChars($sql)."\n";
            echo "STACK: ".HtmlSpecialChars(db_trace())."\n";
            echo "</pre><hr />\n";
    }

    return $result;
}

function db_insert($table, $hash){

    $db = $GLOBALS['db'];
    $fields = array_keys($hash);

    $sql = "INSERT INTO `$table` (`".implode('`,`',$fields)."`) VALUES ('".implode("','",$hash)."')";

    $result = db_query($sql);

    return mysqli_insert_id($db);
}

?>



