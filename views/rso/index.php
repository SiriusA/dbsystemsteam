<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
		 header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Use title if it's in the page YAML frontmatter -->

    <title>Events - Eventi</title>

    <meta name="description" content="UCF Database Systems Spring 2017 Project" />

    <link href="/stylesheets/nav_bar.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />
    <link href="/stylesheets/footer.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />


    <script src="/javascripts/modernizr.js" type="text/javascript"></script>

    <link href="/images/favicon.png" rel="icon" type="image/png" />

      <!-- 3 links needed for bootstrap-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<!--      <a href = "/db/logout.php" class = "topcorner">Log Out</a>-->

  </head>


  <?php
  if($_SESSION["usertype"] == 1){
      include_once "../nav_bar/nav_bar_super.php";
  }
  if($_SESSION["usertype"] == 2){
      include_once "../nav_bar/nav_bar_admin.php";
  }
  else if ($_SESSION["usertype"] == 3){
      include_once "../nav_bar/nav_bar_student.php";
  }
  ?>

    <div id="wrapper">
        <div class="hero">
          <div class="row">
            <div class="large-12 columns">
              <h1 class="title_bar">RSO Name</h1>

                <?php
                include "../db/query_rso.php";
                $myRSOs = getRSOJoined();
                //if page is not set, then default to page 0
                if(empty($_GET["page"])){
                    $page = 0;
                    $remaining = sizeof($myRSOs);
                }
                else{
                    $page = $_GET["page"];
                    $remaining = $_GET["remaining"];
                }

                $nextPage = -1;
                //        only display 10
                echo '<ul class="list-group">';
                if($remaining > 10){
                    $index = sizeof($myRSOs) - $remaining;
                    for($i = 0; $i < 10; $i++){
                        echo     '<div class="row">
                        <div class="col-sm-8">
                            <a href="../rso_description/index.php?index='.($i + $index).'" class="list-group-item">'.$myRSOs[$i + $index]["rname"].' - '.$myRSOs[$i + $index]["description"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">Event List</a>
                        </div>
                      </div>';
                    }
                    $nextPage = $page + 1;
                }
                //display what is left
                else{
                    $index = sizeof($myRSOs) - $remaining;
                    for($i = $index; $i < sizeof($myRSOs); $i++){
                        echo     '<div class="row">
                        <div class="col-sm-8">
                            <a href="../rso_description/index.php?index='.$i.'" class="list-group-item">'.$myRSOs[$i]["rname"].' - '.$myRSOs[$i]["description"].'</a>
                        </div>
                        <div class="col-sm-1">
                            <a href="#" class="list-group-item">Event List</a>
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
          </div>

        </div>
      </div>

    <!-- FOOTER OF PAGE -->
    <footer>
      <div>
        <ul class="footer">
          <li><a href="https://twitter.com">Twitter<img src="/images/social_twitter.png" /></a></li>
          <li><a href="https://www.facebook.com">Facebook<img src="/images/social_fb.png" /></a></li>
        </ul>
      </div>
    </footer>

    <!-- JS Libraries -->
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/javascripts/all.js" type="text/javascript"></script>
  </body>
</html>
