<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/25/2017
 * Time: 8:15 AM
 */
session_start();
include ("../db/query_universities.php");

//$uCredentials["uid"] $uCredentials["uname"] $uCredentials["description"]
$uCredentials = getUniversities();
?>

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

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Events</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="../create_university">Create University</a></li>
                <li class="active"><a href="#">List University</a></li>
                <li><a href="#">List RSO</a></li>
                <li><a href="#">List Events</a></li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        <?php
        if(empty($_GET["page"]))
            $page = 0;
        else{
            $page = $_GET["page"];
        }
        echo '<ul class="list-group">';
        for($i = 0; $i < sizeof($uCredentials); $i++){
            echo     '<a href="#" class="list-group-item">'.$uCredentials[$i]["uname"].' - '.$uCredentials[$i]["description"].'</a>';
        }
        echo '</ul>';

        ?>

        <div class="row">

<!--            <div class="col-sm-4" style="background-color:lavender;">-->
            <div class="col-sm-3"about="">

            </div>

            <ul class="pager">
                <li><a href="#">Previous</a></li>
                <li>Page</li>
                <li><a href="#">Next</a></li>
            </ul>

        </div>


    </div>
</body>