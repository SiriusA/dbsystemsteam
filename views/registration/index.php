<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">

    	<!-- Always force latest IE rendering engine or request Chrome Frame -->
   		<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

    	<!-- Use title if it's in the page YAML frontmatter -->

    	<title>Registration - Eventi</title>
    	<meta name="description" content="UCF Database Systems Spring 2017 Project" />
    	<link href="/stylesheets/normalize.css" rel="stylesheet" type="text/css" />
    	<link href="/stylesheets/all.css" rel="stylesheet" type="text/css" />

    	<script src="/javascripts/modernizr.js" type="text/javascript"></script>

    	<link href="/images/favicon.png" rel="icon" type="image/png" />

	</head>
	<body class="index">
		 <form action="/registration/register.php" method="post" enctype="multipart/form-data">
    		<div class="contain-to-grid">
      			<nav class="top-bar" data-topbar>
        			<ul class="title-area">
          				<li class="name">
            				<h1><a href="/home">Home</a></h1>
          				</li>
        			</ul>
              <section class="top-bar-section">
                <ul class="right">

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
              				<h1>Register</h1>
  						</div>
        			</div>
    			</div>
    		</div>
    		
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
        <option value="2" >Florida State University</option>
        <option value="3">University of Central Florida</option>
        <option value="4">University of Florida</option>
        </select>
        

        <p>Email Address:
        </p>
        <input type= "text" name="email_address" size "30" maxlength = "45" value = ""/>
        
        <p>
    		<input type = "submit" name ="submit1" value="Sign Up" />
   			</p>
   		</form>
   	</body>
</html>


