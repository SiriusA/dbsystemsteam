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

    <link href="/stylesheets/normalize.css" rel="stylesheet" type="text/css" />
    <link href="/stylesheets/all.css" rel="stylesheet" type="text/css" />

    <script src="/javascripts/modernizr.js" type="text/javascript"></script>

    <link href="/images/favicon.png" rel="icon" type="image/png" />
    <a href = "/db/logout.php" class = "topcorner">Log Out</a>

  </head>

  <body class="index">


    <?php require_once "../db/events_feed.php";

      fillEventTable("http://events.ucf.edu/feed.rss");
      ?>

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
              <h1>Event Name</h1>
                <!--
                <h1><img src="/images/xampp-logo.svg" />University Name <span>Apache + MariaDB + PHP + Perl</span></h1>
                -->
            </div>
          </div>
        </div>
      <div class="row">
        <div class="large-12 columns">
          <h2>University Description</h2>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <p>
            Detail description of the university here!
          </p>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <h3>Student Count</h3>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <p>
          # of Students
          </p>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <h3>University Picture</h3>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <p>
            Picture here.
          </p>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <h3>University Location</h3>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
          <p>
          Location here via google maps.
          </p>
        </div>
      </div>

      <div class="row">
        <div class="large-12 columns">
        </div>
      </div>
    </div>

    <footer>
          <div class="row">
            <div class="large-12 columns">
              <ul class="inline-list">
                <li class=""><a href="https://twitter.com"><img src="/images/social_twitter.png" /></a></li>
                <li class =""><a href="https://twitter.com">Twitter</a></li>
                <li class=""><a href="https://www.facebook.com"><img src="/images/social_fb.png" /></a></li>
                <li class=""><a href="https://www.facebook.com">Facebook</a></li>
                <li class="">Privacy Policy</li>
              </ul>
            </div>
          </div>
    </footer>

    <!-- JS Libraries -->
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/javascripts/all.js" type="text/javascript"></script>
  </body>
</html>