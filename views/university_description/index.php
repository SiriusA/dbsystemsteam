<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
?>

<!doctype html>
<html lang="en">
  <head>

    <title>University - Eventi</title>

    <meta name="description" content="UCF Database Systems Spring 2017 Project" />

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../stylesheets/university_description.css">
    <link rel="stylesheet" href="../stylesheets/footer.css">

  </head>

  <body>
    <!-- NAVIGATION BAR -->
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

      include ("../db/query_universities.php");

      if(!empty($_GET["index"])){
          $index = $_GET["index"];
      }

      else{
          $index = 0;
      }

      $universityDetails = getUniversities();
      $universityLocation = getUniversityLocation($universityDetails[$index]["uid"]);
    ?>

    <!-- MAIN CONTENT OF PAGE -->
    <div class="list-group-item">
      <h1 id="university_name"><?= $universityDetails[$index]["uname"];?></h1>
    </div>

<div class="container">
    <div class="row">
      <div class="col-md-4">
        <h3>University Description</h3>
        <p>
          <?= $universityDetails[$index]["description"]; ?>
        </p>
      </div>

      <div class="col-md-4"></div>


      <div class="col-md-4">
        <h3>University Location</h3>
        <p>
          Lat: <?= $universityLocation["longitude"]; ?>
          Lon: <?= $universityLocation["latitude"]; ?>
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-md-4">
        <h3>Student Count</h3>
        <p>
          <?= $universityDetails[$index]["studentcount"]; ?>
        </p>
      </div>

      <div class="col-md-4"></div>

      <div class="col-md-4">
        <h3>University Picture</h3>
        <p><?= $universityDetails[$index]["upicture"]; ?></p>
        <img src="../images/<?= $universityDetails[$index]["upicture"]; ?>"/>
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

    <!-- JS Libraries
    <script src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="/javascripts/all.js" type="text/javascript"></script>
    -->
  </body>
</html>
