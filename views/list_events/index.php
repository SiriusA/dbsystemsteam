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
    <a href = "/db/logout.php" class = "topcorner">Log Out</a>

  </head>
  
        <div>
          <nav>
            <ul class="menu_bar">
              <li><a href = "/db/logout.php">Log Out</a></li>
              <?php
                  if($_SESSION["usertype"]== 2)
                  {
                    echo '<li class=""><a href="/create_event/">Create Event</a></li>';
                  }
              ?>
              <li class="left"><a href="/">Home</a></li>
              <li><a href="">Search</a></li>
              <li><a href="">My Account</a></li>
              <li><a href="/list_events">Events</a></li>
              <li><a href="/university_description">Universities</a></li>
              <li><a href="/rso">RSOs</a></li>
            </ul>
          </nav>
        </div>


      </nav>
    </div>

    <div id="wrapper">
        <div class="hero">
          <div class="row">
            <div class="large-12 columns">
              <h1 class="title_bar">Event Name</h1>
                <!--
                <h1><img src="/images/xampp-logo.svg" />University Name <span>Apache + MariaDB + PHP + Perl</span></h1>
                -->
            </div>
          </div>
        </div>

<!---------------------------------------->
        <?php require_once "../db/events_feed.php";
          fillEventTable("http://events.ucf.edu/feed.rss");
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
