<!DOCTYPE html>
<html>
<head>
    <title>List RSO</title>

    <link rel="stylesheet" href="/stylesheets/list_rso.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

    <!--    TODO place correct navbar depending on user-->
    <!--    navbar SuperAdmin start-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Events</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="../create_university">Create University</a></li>
                <li><a href="../list_university">List University</a></li>
                <li class="active"><a href="../list_rso">List RSO</a></li>
                <li><a href="#">List Events</a></li>
            </ul>
        </div>
    </nav>
    <!--    navbar end-->

    <!--    Content Start-->
    <div class="container-fluid">
        <h2>RSO Description</h2>

        <?php
            include "../db/query_rso.php";

            //set index if not set
            if(!empty($_GET["index"])){
                $index = $_GET["index"];
            }

            else{
                $index = 0;
            }

            $rsoDescription = getRSOsFromManagedUniversities();
            //TODO display RSO received from list_rso
            echo ''.$rsoDescription[$index]["rname"].' <br>';
            echo ''.$rsoDescription[$index]["description"].' <br>';
            echo ''.$rsoDescription[$index]["uname"].' <br>';
            echo ''.$rsoDescription[$index]["approved"].' <br>';
            echo ''.$rsoDescription[$index]["rpicture"].' <br>';
            echo ''.$rsoDescription[$index]["email"].' <br>';

            //TODO create view
        ?>

    </div>
    <!--    Content End-->

</body>