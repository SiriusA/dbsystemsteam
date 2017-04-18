<!DOCTYPE html>
<html>
<head>
	<title>Login</title>

    <link rel="stylesheet" href="/stylesheets/index.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

		<link href="/images/favicon.ico" rel="icon" type="image/ico" />

</head>

<body>

<form action="/db/login_action.php" method="post">
		
    <div class="container">
        <label><b>Username</b></label>
        <input type="text" placeholder="Enter Username" name="email" required>

        <label><b>Password</b></label>
        <input type="password" placeholder="Enter Password" name="password" required>

        <button type="submit">Login</button>
        <input type="checkbox" checked="checked"> Remember me
    </div>

    <div class="container" style="background-color:#f1f1f1">
        <button type="button" class="cancelbtn">Cancel</button>
        <span class="psw">Forgot <a href="#">password?</a></span>
        <span><a href = "/registration/">Register</a></span>
    </div>
</form>

</body>
</html>

<?php

    //check if there was an error with the last login
    if(isset($_GET["error"]) && $_GET["error"] == "1"){
        echo "<script>alert('Error message: Credentials are incorrect');</script>";
    }
