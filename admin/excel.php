<?php
//KR Excel Export
//Include config and db files for easy sql connection
include('../db/config.php');
include('../db/db.php');

 session_start();

 $sqli = 'SELECT * FROM users';
 $result = mysqli_query($db, $sqli);

$filename = 'UsersData.csv';

$fp = fopen("php://output", 'w');
$header_flag = false;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {  //MYSQLI_ASSOC is same as mysqli_fetch_assoc()
    //add headers
    if(!$header_flag) {
        fputcsv($fp, array_keys($row));
        $header_flag = true;
    }
    fputcsv($fp, array_values($row));
}
fclose($fp);
//header("Location: ../admin/admin.php");
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="'.$filename.'";');
