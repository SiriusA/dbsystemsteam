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
        
        echo '<h3>Welcome '.$first_name.' '.$last_name.'!</h3>';
        
        echo '<p> Your University: '.$uname.' </p>';

    ?>

    
</body>

