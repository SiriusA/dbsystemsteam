<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Create University</title>

    <link rel="stylesheet" href="/stylesheets/create_university.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

	</head>
	 <body>
    <form action = "http://localhost/registration/register.php" method= "post">
    <!-- NAVIGATION BAR -->
    <div>
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

        </ul>
      </nav>
    <div class="list-group-item">
      <h1 id= "university_name">Register</h1>
    </div>
  <div class="list-group-item">

  <p>First Name:
  </p>
	<input type= "text" name="first_name" size "30" maxlength = "45" value = ""/>


	<p>Last Name:
  </p>
	<input type= "text" name="last_name" size "30" maxlength = "45" value = ""/>

  <p>Password:
  </p>
  <input type= "text" name="pwd" size "30" maxlength = "45" value = ""/>

  <p>University:
  </p>
  <select name="university_id">
  <option value="">Select...</option>
  <option value="124" >Florida State University</option>
  <option value="1">University of Central Florida</option>
  <option value="125">University of Florida</option>
  </select>

  <p>

  <p>Email Address:
  </p>
  <input type= "text" name="email_address" size "30" maxlength = "45" value = ""/>

  <p>
  </p>

  <p>
	<input type = "submit" name ="submit1" value="Sign Up" />
	</p>


	</div>
</body>
</html>
