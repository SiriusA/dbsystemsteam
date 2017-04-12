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

    if($_SESSION["usertype"] == 2){
        include "../nav_bar/admin_navbar.php";
    }
    else if ($_SESSION["usertype"] == 3){
        include "../nav_bar/student_navbar.php";
    }
  ?>


    <div id="wrapper">
        <div class="hero">
          <?php
            include_once "../db/query_events.php";
            $event_result = getEventsList();
            $event_entry = $event_result->fetch_row();
      			$event_list = "";
      			while($event_entry !== NULL)
      			{
      				$event_list = $event_list .
              '<div class="row">
                <div class="large-12 columns">
                  <h1 class="title_bar">' . $event_entry[0] . '</h1>
                </div>
              </div>';
      				$event_entry = $event_result->fetch_row();
      			}
            echo $event_list;
          ?>
          <!-->
          <div class="row">
            <div class="large-12 columns">
              <h1 class="title_bar">Event Name</h1>
                
            </div>
          </div>
        </div>
        -->

<!---------------------------------------->
        <?php require_once "../db/events_feed.php";
          //fillEventTable("http://events.ucf.edu/feed.rss");
        ?>
<!---------------------------------------->

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
