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

            fillEventTable("http://events.ucf.edu/feed.rss");

            $event_result = getEventsList();

            $i = 0;

            if(sizeof($event_result) <= 0){
              echo '<div class="list-group-item">';
              echo '<h3> Looks like you\'re university is lacking events! </h3>';
              echo '</div>';
            }

            else
              while($i < 20 && $i < sizeof($event_result)){
                echo '<div class="list-group-item">';
                $startTimeHold = date_create_from_format("Y-m-d H:i:s", $event_result[$i]["start_time"]);
                $startTimeHold = $startTimeHold->format("YmdHis");
                echo '<h3><a href="../page_event/index.php?time='.$startTimeHold.'&place='.$event_result[$i]["lid"].'" class="list-group-item">' .$event_result[$i]["ename"]. '</a></h3>';
                echo '<p>' .$event_result[$i]["description"]. '</p>';
                echo '<p><strong><font size="1%"> Start Time: ' .$event_result[$i]["start_time"]. '</font></strong></p>';
                echo '<p><strong><font size="1%"> End Time: ' .$event_result[$i]["end_time"]. '</font></strong></p>';
                echo '</div>';
                $i++;
              }
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
