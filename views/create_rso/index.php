<!-- Prevent user from skipping login page -->
<?php
	session_start();

	if($_SESSION["userLoggedIn"] == false)
		header('Location: /');
 ?>

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">

    	<!-- Always force latest IE rendering engine or request Chrome Frame -->
   		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    	<!-- Use title if it's in the page YAML frontmatter -->

    	<title>Create RSO - Eventi</title>
    	<meta name="description" content="UCF Database Systems Spring 2017 Project" />
    	<link href="/stylesheets/normalize.css" rel="stylesheet" type="text/css" />
    	<link href="/stylesheets/all.css" rel="stylesheet" type="text/css" />

    	<script src="/javascripts/modernizr.js" type="text/javascript"></script>

    	<link href="/images/favicon.png" rel="icon" type="image/png" />

	</head>
	<body class="index">
		<form action = "http://localhost/create_rso/rso_added.php" method= "post">
    		<div class="contain-to-grid">
      			<nav class="top-bar" data-topbar>
        			<ul class="title-area">
          				<li class="name">
            				<h1><a href="/home">Home</a></h1>
          				</li>
        			</ul>
              <section class="top-bar-section">
                <ul class="right">
                  <?php
                    if($_SESSION["usertype"] != 1 && $_SESSION["usertype"] != 2 && $_SESSION["usertype"] != 3)
                    {
                     header("location: ../");
                    }
                    if($_SESSION["usertype"]== 2)
                    {
                      echo '<li class=""><a href="/create_event/">Create Event</a></li>';
                    }
                  ?>
                   <li class=""><a href="/create_rso/">Create RSO</a></li>
                   <li class=""><a href="/rso">RSOs</a></li>
                   <li class=""><a href="/university_description">Universities</a></li>
                   <li class=""><a href="/event_list">Events</a></li>
                   <li class=""><a target="_blank" href="/phpinfo.php">My Account</a></li>
                  <li class=""><a href="/phpmyadmin/">Search</a></li>
                </ul>
              </section>
            </nav>
   		 	</div>
   			<div id="wrapper">
        		<div class="hero">
          			<div class="row">
            			<div class="large-12 columns">
              				<h1>Create RSO</h1>
  						</div>
        			</div>
    			</div>
    		</div>

        <p>University Name:
        </p>
    		<input type= "text" name="university_name" size "30" maxlength = "45" value = ""/>


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
        <div id="wrapper">
            <div class="hero">
                <div class="row">
                  <div class="large-12 columns">
                      <h3>RSO Member Information:</h3>
                      <p>
                          Please list your RSO members (minimum of 5 total including yourself).
                      </p>
                      <p>
                          Once these members have created an account, they will recieve an invite to join your RSO.
                      </p>
              </div>
              </div>
          </div>
        </div>

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
    		<input type = "submit" name ="submit1" value="Send" />
   			</p>
   		</form>
   	</body>
</html>
