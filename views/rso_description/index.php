<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
?>

<!DOCTYPE html>
<html>
<head>
    <title>List RSO</title>

    <link rel="stylesheet" href="/stylesheets/rso_description.css">

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
    <div id="content" class="container-fluid">

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

            //TODO create view
        echo '<!--        1/2 row-->
                <div class="row">

                    <!--                    1/1 column-->
                    <!--            place buttons here-->
                    <div class="col-sm-12">
                        <h2>'.$rsoDescription[$index]["rname"].'</h2>
                    </div>
                </div>

                <!--        2/2 row-->
                <div class="row">

                    <div class="col-sm-6">
                        <h3>Description</h3>
                            '.$rsoDescription[$index]["description"].'
                        <h3>University</h3>
                            '.$rsoDescription[$index]["uname"].'
                        <h3>Approved</h3>
                            '.$rsoDescription[$index]["approved"].'

                    </div>

                    <div class="col-sm-6">
                        <h3>Picture</h3>
                              <img src="../images/'.$rsoDescription[$index]["rpicture"].'" class="img-rounded" width="304" height="236">
                        <h3>Admin Contact</h3>
                            '.$rsoDescription[$index]["email"].'
                    </div>
                </div>';
        ?>

    </div>
    <!--    Content End-->

</body>
