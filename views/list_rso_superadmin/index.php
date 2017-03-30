<!DOCTYPE html>
<html>
<head>
    <title>List RSO</title>

    <link rel="stylesheet" href="/stylesheets/create_university.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

<!--    navbar start-->
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Events</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="../create_university">Create University</a></li>
                <li><a href="../list_university">List University</a></li>
                <li class="active"><a href="#">List RSO</a></li>
                <li><a href="#">List Events</a></li>
            </ul>
        </div>
    </nav>
<!--    navbar end-->

    <?php

    include "../db/query_rso.php";
    $rsoAndUniverstiyInfo = getRSOsFromManagedUniversities();

echo '<div id="content" class="container-fluid">
        <h2>Create University</h2>
        '.$rsoAndUniverstiyInfo[0]["rname"].'<br>
        '.$rsoAndUniverstiyInfo[0]["uname"].'<br>
        '.$rsoAndUniverstiyInfo[0]["approved"].'<br>
      </div>';

    ?>
</body>
</html>