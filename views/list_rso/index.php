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
<!--    navbar start-->
    <?php

        if($_SESSION["usertype"] == 1)
            include "../nav_bar/super_admin_navbar.php";
        else{

        }
    ?>
<!--navbar end-->

    <div class="container-fluid">
        <h2>List RSO</h2>
    <?php

    include "../db/query_rso.php";
    //TODO query correct RSO to display for each user (Super, Admin, Student)
    //query RSO from Universities that ae managed by SuperAdmin
    $rsoAndUniverstiyInfo = getRSOsFromManagedUniversities();

    //if page is not set, then default to page 0
    if(empty($_GET["page"])){
        $page = 0;
        $remaining = sizeof($rsoAndUniverstiyInfo);
    }
    else{
        $page = $_GET["page"];
        $remaining = $_GET["remaining"];
    }

    $nextPage = -1;
    //        only display 10
    echo '<ul class="list-group">';
    if($remaining > 10){
        $index = sizeof($rsoAndUniverstiyInfo) - $remaining;
        for($i = 0; $i < 10; $i++){
            echo     '<div class="row">
                        <div class="col-sm-8">
                            <a href="../rso_description/index.php?index='.($i + $index).'" class="list-group-item">'.$rsoAndUniverstiyInfo[$i + $index]["rname"].' - '.$rsoAndUniverstiyInfo[$i]["description"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">'.$rsoAndUniverstiyInfo[$i + $index]["uname"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">'.$rsoAndUniverstiyInfo[$i + $index]["approved"].'</a>
                        </div>
                      </div>';
        }
        $nextPage = $page + 1;
    }
//        display what is left
    else{
        $index = sizeof($rsoAndUniverstiyInfo) - $remaining;
        for($i = $index; $i < sizeof($rsoAndUniverstiyInfo); $i++){
            echo     '<div class="row">
                        <div class="col-sm-8">
                            <a href="../rso_description/index.php?index='.$i.'" class="list-group-item">'.$rsoAndUniverstiyInfo[$i]["rname"].' - '.$rsoAndUniverstiyInfo[$i]["description"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">'.$rsoAndUniverstiyInfo[$i]["uname"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">'.$rsoAndUniverstiyInfo[$i]["approved"].'</a>
                        </div>
                      </div>';
        }
    }
    echo '</ul>';

    //start pager
    echo '<div class="row">';
    echo    '<ul class="pager">';

    //display previous button?
    if($page != 0){
        $prevPage = $page - 1;
        $prevRemaining = $remaining + 10;
        //DISPLAY PREV BUTTON
        echo    '<li><a href="index.php?page='.$prevPage.'&remaining='.$prevRemaining.'">Previous</a></li>';

    }
    echo    '<li>Page '.$page.'</li>';

    //display next button?
    if($nextPage != -1){
        $nextRemaining = $remaining - 10;
        //display next button here
        echo '<li><a href="index.php?page='.$nextPage.'&remaining='.$nextRemaining.'">Next</a></li>';

    }
    echo    '</ul>';
    echo '</div>';
    //end pager

    ?>
    </div>
</body>
</html>
