<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">

    <!-- Always force latest IE rendering engine or request Chrome Frame -->
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>404 Not Found</title>

    <link href="/stylesheets/nav_bar.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />
    <link href="/stylesheets/footer.css" rel="stylesheet" type="text/css" /><link href="/dashboard/stylesheets/all.css" rel="stylesheet" type="text/css" />


  </head>

  <body class="x404">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=277385395761685";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

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


    <h1 class="title_bar">404 <span>Not Found</span></h1>
    <h2>The page you were looking for doesn't exist.</h2>

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
    <script src="/dashboard/javascripts/all.js" type="text/javascript"></script>
  </body>
</html>
