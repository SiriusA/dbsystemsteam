<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/25/2017
 * Time: 8:15 AM
 */

?>

<!-- Kyle Picinich -->

<!DOCTYPE html>
<html>
<head>
    <title>Create Event</title>

<!--    <link rel="stylesheet" href="/stylesheets/list_university.css">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>



<body>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Events</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home</a></li>
                <li><a href="../create_university">Create University</a></li>
                <li class="active"><a href="#">List University</a></li>
                <li><a href="../list_rso_superadmin">List RSO</a></li>
                <li><a href="#">List Events</a></li>
            </ul>
        </div>
    </nav>

    <form class="form-vertical" role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
	
	
		<?php
		
			echo '<div class = "form-group">
				<label for="rso">RSO:</label>
				<select class="form-control" id="rso" name="rso">
					<option value = ' . $rso_ids[0][0] . '>' . $rso_ids[0][1] . '</option>
				</select>
			</div>';
		?>
		Event Name: <input type="text" name="eventname"><br>
		Format:YYYY-MM-DD HH:MM:SS<br>
		Start Time: <input type="datetime-local" name="starttime"> End Time: <input type="datetime-local" name="endtime"><br>
		Description: <textarea name="description" rows="10" cols="40"></textarea><br>
		Phone: <input type="text" name="phone"> Email: <input type="text" name="email"><br>
		<input type="submit" name="Submit"><br>
</form>
</body>