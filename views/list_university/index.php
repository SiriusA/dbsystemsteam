<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
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

    <!--Display correct navbar-->
    <?php

        if($_SESSION["usertype"] == 1)
            include "../nav_bar/super_admin_navbar.php";
        else{

        }
    ?>
    <!--End navbar-->

    <!--Content-->
    <div class="container-fluid">
        <?php

        include ("../db/query_universities.php");

        //$uCredentials["uid"] $uCredentials["uname"] $uCredentials["description"]
        $uCredentials = getUniversities();

        if(empty($_GET["page"])){
            $page = 0;
            $remaining = sizeof($uCredentials);
        }
        else{
            $page = $_GET["page"];
            $remaining = $_GET["remaining"];
        }

        $nextPage = -1;
//        only display 10
      //  echo '<ul class="list-group">';
        if($remaining > 10){
            $index = sizeof($uCredentials) - $remaining;
            for($i = 0; $i < 10; $i++){
                echo     '<a href="../university_description/index.php?index='.($i + $index).'" class="list-group-item">'.$uCredentials[$i + $index]["uname"].' - '.$uCredentials[$i + $index]["description"].'</a>';
            }
            $nextPage = $page + 1;
        }
//        display what is left
        else{
            $index = sizeof($uCredentials) - $remaining;
            for($i = $index; $i < sizeof($uCredentials); $i++){
                echo     '<a href="../university_description/index.php?index='.$i.'" class="list-group-item">'.$uCredentials[$i]["uname"].' - '.$uCredentials[$i]["description"].'</a>';
            }
        }
        echo '</ul>';

        echo '<div class="row">';
        echo    '<ul class="pager">';

//        display previous button?
        if($page != 0){
            $prevPage = $page - 1;
            $prevRemaining = $remaining + 10;
//            DISPLAY PREV BUTTON
        echo    '<li><a href="index.php?page='.$prevPage.'&remaining='.$prevRemaining.'">Previous</a></li>';

        }
        echo    '<li>Page '.$page.'</li>';

//        display next button?
        if($nextPage != -1){
            $nextRemaining = $remaining - 10;
//            display next button here
            echo '<li><a href="index.php?page='.$nextPage.'&remaining='.$nextRemaining.'">Next</a></li>';

        }
        echo    '</ul>';
        echo '</div>';
        ?>


    </div>
</body>
