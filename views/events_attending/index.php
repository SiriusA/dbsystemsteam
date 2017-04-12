<!DOCTYPE html>
<html>
<head>
    <title>Create University</title>

    <!--    <link rel="stylesheet" href="/stylesheets/list_university.css">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>


<?php

    session_start();
    if($_SESSION["usertype"] == 2)
        include "../nav_bar/admin_navbar.php";
    else if ($_SESSION["usertype"] == 3){
        include "../nav_bar/student_navbar.php";
    }

    include "../db/query_events.php";

    //get list of events that this student is going to attend
    $eventAttendingList = getEventsAttending();

    echo $eventAttendingList[0]["ename"] . "<br>";
    echo $eventAttendingList[0]["description"] . "<br>";
    echo $eventAttendingList[0]["start_time"] . "<br>";
    echo $eventAttendingList[0]["end_time"] . "<br>";
    echo $eventAttendingList[0]["approved"] . "<br>";
?>

</body>