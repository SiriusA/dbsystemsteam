<!-- Prevent user from skipping login page -->
<?php
	session_start();

	if($_SESSION["userLoggedIn"] == false)
		header('Location: /');
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
    <title>Create an RSO - Eventi</title>

    <link rel="stylesheet" href="/stylesheets/create_university.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

	<body class="index">
		<form action = "http://localhost/create_rso/rso_added.php" method= "post">

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

        <h1 class="title_bar">Create RSO</h1>
        <div class="list-group-item">
      		<p>RSO Name:
          </p>
      		<input type= "text" name="rso_name" size "30" maxlength = "45" value = ""/>


          <p>RSO Picture:
          </p>
          <input type= "file" name="rso_picture" value = ""/>

          <p>RSO Description:
          </p>
          <p>
          <textarea name="rso_description" cols="40" rows="5"></textarea>
          </p>
            <h3>RSO Member Information:</h3>
            <p>
                Please list your RSO members (minimum of 5 total including yourself).
            </p>
            <p>
                Once these members have created an account, they will recieve an invite to join your RSO.
            </p>

          <p>Member 1 Email:
          </p>
          <input type= "text" name="rso_member_email_1" size "30" maxlength = "40" value = ""/>


          <p>Member 2 Email:
          </p>
          <input type= "text" name="rso_member_email_2" size "30" maxlength = "40" value = ""/>

          <p>Member 3 Email:
          </p>
          <input type= "text" name="rso_member_email_3" size "30" maxlength = "40" value = ""/>

          <p>Member 4 Email:
          </p>
          <input type= "text" name="rso_member_email_4" size "30" maxlength = "40" value = ""/>

          <p>
          </p>

    		  <p>
    		  <input type = "submit" name ="submit1" value="Send" />
   			  </p>
      </div>
      </form>

   	</body>

</html>
