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
    	<link rel="stylesheet" href="../stylesheets/university_description.css">

    	<script src="/javascripts/modernizr.js" type="text/javascript"></script>

    	<link href="/images/favicon.png" rel="icon" type="image/png" />

	</head>
	 <body>
    <!-- NAVIGATION BAR -->
    <div>
      <nav>
        <ul class="menu_bar">
           <li class=""><a href="../">Login</a></li>
            <li class=""><a href="../">Home</a></li>
        </ul>
      </nav>
    <div>
      <h1 id= "university_name">Register</h1>
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


