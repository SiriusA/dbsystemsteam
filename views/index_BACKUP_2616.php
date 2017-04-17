<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>

    <!-- Use title if it's in the page YAML frontmatter -->
    <title>404 Not Found</title>

<<<<<<< HEAD
    <link href="/stylesheets/footer.css" rel="stylesheet" type="text/css" />
=======
		<link href="/images/favicon.ico" rel="icon" type="image/ico" />
>>>>>>> 97769a71e4a4e947074ebb23feb4b7dbe0ebe329


  </head>

  <body>

      <?php
        if($_SESSION["usertype"] == 1){
            include_once "../nav_bar/test.php";
        }
        if($_SESSION["usertype"] == 2){
            include_once "../nav_bar/test.php";
        }
        else if ($_SESSION["usertype"] == 3){
            include_once "../nav_bar/test.php";
        }
      ?>


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

  </body>
</html>
