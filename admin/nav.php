<?php
include('admin_auth.php');
include('../cyo/config.php');
include('../cyo/db.php');
?>


<html>
<head>
<style>
.test {
    padding-bottom: 10px;
    }
.test ul {
    list-style-type: none;
    margin: 0;
    padding: 0px;
    width: 200px;
    background-color: #f1f1f1;
}

.test li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
.test li a:hover {
    background-color: #555;
    color: white;
}
</style>
</head>
<body>


<h2>Admin Portal</h2>
<div class="test">
    <ul>
        <li><a href="insert.php">INSERT</a></li>
        <li><a href="select.php">SELECT</a></li>
        <li><a href="update.php">UPDATE</a></li>
        <li><a href="delete.php">DELETE</a></li>
        <li><a href="../login/logout.php">LOGOUT</a></li>

    </ul>
</div>

<div class="test" style="float: middle">
    <h2>Riskories</h2>
    <ul>
        <li><a href="../cyo/create.php">CREATE</a></li>
        <li><a href="../cyo/index.php">EDIT</a></li>
        <li><a href="add.php">NEW STORY</a></li>
    </ul>
</div>



</body>
</html>
