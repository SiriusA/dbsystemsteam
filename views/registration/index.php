<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Registration - Eventi</title>

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
            include_once "../nav_bar/nav_bar_register.php";

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
  <?php
    include_once "../db/connection.php";

    $result_uni = db_query("SELECT DISTINCT U.uid, U.uname
                        FROM university_created U");
    $uni_row = $result_uni->fetch_array();
    $uni_list = "";

    while($uni_row !== NULL) {
      $uni_id = $uni_row["uid"];
      $uni_list = $uni_list . "<option value = " . $uni_id . ">" . $uni_row["uname"] . "</option>";
      $uni_row = $result_uni->fetch_array();
    }

    echo $uni_list;
   ?>
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
