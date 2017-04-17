<!-- Prevent user from skipping login page -->
<?php
  session_start();

  include "../db/connection.php";

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');

    $first_name;
    $last_name;
    $uid;
    $email = $_SESSION["email"];


    $result = db_query("SELECT U.email, U.uid, U.first_name, U.last_name FROM `user` U
                WHERE `email` = '$email' ");

    if($result == false)
        echo "something went wrong";

    while($row = mysqli_fetch_array($result))
    {
        $uid = $row[1];
        $first_name = $row[2];
        $last_name = $row[3];
    }
    $result = db_query("SELECT U.uname FROM `university_created` U WHERE `uid` = '$uid' ");
    while($row = mysqli_fetch_array($result))
    {
        $uname = $row[0];
    }

    

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create University</title>

    <link rel="stylesheet" href="/stylesheets/create_university.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <!--Display correct navbar-->
    <?php

        if($_SESSION["usertype"] == 3)
            include "../nav_bar/student_navbar.php";
        echo '<div class="list-group-item">';
        echo '<h3>Welcome '.$first_name.' '.$last_name.'!</h3>';
        echo '<h5> Your University: '.$uname.' </h5>';
        echo '</div>';
        echo '<div class="list-group-item">';
        echo '<h4> Pending RSOs:</h4>';
        $sid = $_SESSION["sid"];
        $rid = array();
        $rname = array();

        $result = db_query("SELECT J.rid FROM `joins` J  WHERE `sid` = '$sid' AND `approval` = '0' ");
        while($row = mysqli_fetch_array($result))
        {
            $rid = $row[0];
            $result1 = db_query("SELECT R.rname FROM `rso_owned` R  WHERE `rid` = '$rid'");
            while($row1 = mysqli_fetch_array($result1))
            {
                $rname= $row1[0];
                echo '<h5>'; print_r($rname); echo '</h5>';
                echo '<div class="container">
                    <span><a href = "../home">Approve</a></span>
                    <span><a href = "../home">Deny</a></span>
                </div>';
 
            }
        }

        echo '</div>';
        
    ?>

    
</body>

