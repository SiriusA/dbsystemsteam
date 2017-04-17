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

<body>
  <!-- FACEBOOK PLUGIN -->
    <div id="fb-root"></div>
      <script>
        (function(d, s, id) {

          var js, fjs = d.getElementsByTagName(s)[0];

          if (d.getElementById(id))
            return;

          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";
          fjs.parentNode.insertBefore(js, fjs);
        }
        (document, 'script', 'facebook-jssdk'));
      </script>
  <!-- END FACEBOOK PLUGIN-->

  <?php
    include_once "../nav_bar/only_nav_bar.php";
  ?>

  <?php function test_input($data) {
  	$data = trim($data);
  	$data = stripslashes($data);
  	$data = htmlspecialchars($data);
  	return $data;
  } ?>

  <?php
    include_once "../db/query_events.php";


    //set index if not set
    if(!empty($_GET["time"]) && !empty($_GET["place"])){
      $time = test_input($_GET["time"]);
      $place = test_input($_GET["place"]);
    }
    else{
      $time = 0;
      $place = 0;
    }

    $eventData = getEventbyTimePlace($time, $place);

  ?>

    <div id="wrapper">
        <div class="hero">
          <div class="row">
            <div class="col-md-12">
              <?php
                echo '<h3 class="title_bar">' . $eventData["ename"] . "</h3>";
              ?>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <h3>This is where an image would go, if you had one.</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <?php
              echo '<h1 class="title_bar"><font size = "4%"' . $eventData["start_time"] . "</font></h1>";
              ?>
            </div>
            <div class="col-md-6">
              <?php
              echo '<h1 class="title_bar"><font size = "4%"' . $eventData["end_time"] . "</font></h1>";
              ?>
            </div>
          </div>
          <div class="col-md-12">
            <?php
              echo '<h1 class="title_bar"><font size = "5%">' . $eventData["description"] . "</font></h1>";
            ?>
          </div>
        </div>
      </div>

      <!-- Facebook share button-->
    <div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-2"></div>

      <div class="col-md-2">
        <div class="fb-share-button" data-href="<?= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" ?>" data-layout="button" data-mobile-iframe="true">
          <a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2FshareURL.com%2F&amp;src=sdkpreparse">Share</a>
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
