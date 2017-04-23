<?php
if ($db) {

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    //Get story title and attributes

    if(isset($_GET['story']))
    {
        $storyT = $_GET['story'];
        $storyR = $storyT."_rooms";
        $storyS = $storyT."_settings";
    }
    else
    {
        $storyT = "choose";
        $storyR = "choose_rooms";
        $storyS = "choose_settings";

    }
    $settings = db_single(mysqli_query($db, "SELECT * FROM `$storyS` ORDER BY 'id' DESC;"));
    //print_r($settings); //DEBUGGING
}
?>

<?php
if ($db) {
    if ($settings['enable_analytics'] == 1) {
        echo $settings['analytics_blurb'];
    }
}
?>

<?php
$status = '';
// Determines whether admin or user logged in and updates navbar accordingly
if(isset($_SESSION['isAdmin']))
{
    if($_SESSION['isAdmin'] == 0)
    {
        $status = 'user';
    }
    else
    {
        $status = 'admin';
    }
}
else
{
    $status = 'guest';
}
// Determines total number of rooms
if ($db) {
    $total_rooms = db_single(mysqli_query($db, "SELECT count(*) as total FROM `$storyR`"));
    //echo "Total Rooms: ".$total_rooms['total'];
}
?>


<!DOCTYPE>
<html>
    <head>
        <title><?php echo $db ? $settings['title'] : "An epic adventure!"; ?></title>


        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
              integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css"
              integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
        <style>
            /*
            p {
            text-indent: 25px;
            }
            */
            /* Can change these to give more color to page */
            .body {
                background-color: white;
            }
            .container {
                background-color: white;
            }
        </style>
         <div class="navbar">
                     <nav class="container navbar-inverse">
                         <div class="container-fluid">
                             <!-- Brand and toggle get grouped for better mobile display -->
                             <div class="navbar-header">
                                 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                                     data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                     <span class="sr-only">Toggle navigation</span>
                                     <span class="icon-bar"></span>
                                     <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                 </button>
                                 <?php
                                 if($status == 'admin')
                                 {
                                     echo "<a class='navbar-brand' href='../admin/admin.php'>
                                     <img alt='Brand' src='../img/s_logo_3.png' height='45px' width='40px' style='padding-bottom: 20px'></a>";
                                 }
                                 else
                                 {
                                   echo "<span class='navbar-brand'>
                                   <img alt='Brand' src='../img/s_logo_3.png' height='45px' width='40px' style='padding-bottom: 20px'></span>" ;
                                 }
                                 ?>
                             </div>

                             <!-- Collect the nav links, forms, and other content for toggling -->
                             <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

                                     <li><a href="../consent/consentform.php">View Consent Form</a></li>
                                 </ul>-->
                                 <ul class="nav navbar-nav navbar-right">
                                        <?php
                                        if($status == 'guest' || $status == 'user')
                                        {
                                          echo "<li><a>Total Rooms: ".$total_rooms['total']."</a></li>";
                                        }
                                        else
                                        {
                                          echo "<li><a>Total Rooms: ".$total_rooms['total']."</a></li>
                                          <li><a href='../login/logout.php'><span class='glyphicon glyphicon-log-out'></span>Logout</a></li>";
                                        }
                                        ?>
                                </ul>
                             </div><!-- /.navbar-collapse -->
                         </div><!-- /.container-fluid -->
                     </nav>
                 </div>

         <!-- Latest compiled and minified JavaScript -->
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    </head>
    <body>
    <div class="container">







