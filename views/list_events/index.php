<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
		 header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>
    <title>Events - Eventi</title>

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
          <?php

            require_once "../db/events_feed.php";
            include_once "../db/query_events.php";

//            fillEventTable("http://events.ucf.edu/feed.rss");

            $event_result = getEventsList();

            if(empty($_GET["page"])){
                $page = 0;
                $remaining = sizeof($event_result);
            }
            else{
                $page = $_GET["page"];
                $remaining = $_GET["remaining"];
            }


            $nextPage = -1;

            $i = 0;

            if(sizeof($event_result) <= 0){
              echo '<div class="list-group-item">';
              echo '<h3> Looks like your university is lacking events! </h3>';
              echo '</div>';
            }

            else {
              if($remaining > 10){
                  $index = sizeof($event_result) - $remaining;
                  for($i = $index; $i < 10 + $index; $i++){
                    echo '<div class="list-group-item">';
                    $startTimeHold = date_create_from_format("Y-m-d H:i:s", $event_result[$i]["start_time"]);
                    $startTimeHold = $startTimeHold->format("YmdHis");
                    echo '<h3><a href="../page_event/index.php?time='.$startTimeHold.'&place='.$event_result[$i]["lid"].'" class="list-group-item">' .$event_result[$i]["ename"]. '</a></h3>';
                    echo '<p>' .$event_result[$i]["description"]. '</p>';
                    echo '<p><strong><font size="1%"> Start Time: ' .$event_result[$i]["start_time"]. '</font></strong></p>';
                    echo '<p><strong><font size="1%"> End Time: ' .$event_result[$i]["end_time"]. '</font></strong></p>';
                    echo '</div>';
                  }
                  $nextPage = $page + 1;
              }
              //        display what is left
              else{
                $index = sizeof($event_result) - $remaining;
                for($i = $index; $i < sizeof($event_result); $i++){
                  echo '<div class="list-group-item">';
                  $startTimeHold = date_create_from_format("Y-m-d H:i:s", $event_result[$i]["start_time"]);
                  $startTimeHold = $startTimeHold->format("YmdHis");
                  echo '<h3><a href="../page_event/index.php?time='.$startTimeHold.'&place='.$event_result[$i]["lid"].'" class="list-group-item">' .$event_result[$i]["ename"]. '</a></h3>';
                  echo '<p>' .$event_result[$i]["description"]. '</p>';
                  echo '<p><strong><font size="1%"> Start Time: ' .$event_result[$i]["start_time"]. '</font></strong></p>';
                  echo '<p><strong><font size="1%"> End Time: ' .$event_result[$i]["end_time"]. '</font></strong></p>';
                  echo '</div>';
                }

              }
            }
            //start pager
            echo '<div class="row">';
            echo '<div class="col-lg-12">';
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
            echo '</div>';
            //end pager
            echo '<div class="row"><div class="col-lg-12">---</div></div>';
          ?>


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
