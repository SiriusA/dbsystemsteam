<!--
  Created by PhpStorm.
  User: alex
  Date: 3/25/2017
  Time: 8:15 AM
 -->

 <!-- Prevent user from skipping login page -->
 <?php
	 session_start();

	 if($_SESSION["userLoggedIn"] == false)
		 header('Location: /');
	?>

<!-- Kyle Picinich -->

<?php
  //debug
//  $_SESSION["sid"] = 2;
//  $_SESSION["usertype"] = 3;
?>

<?php
  $rso_ids;

  include ("../db/connection.php");

  if(!empty($_SESSION["sid"]))
  {
  	//db_query("USE event;");
  	$rso_query = "SELECT r.rid, r.rname
  	FROM rso_owned r
  	WHERE r.sid = " . $_SESSION["sid"] . ";";

  	$rso_ids_result = db_query($rso_query);
  //	if($result->num_rows != 0){
  //		$rso_ids = $result->fetch_all();
  //	}
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Create an Event - Eventi</title>

<!--    <link rel="stylesheet" href="/stylesheets/list_university.css">-->

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

<body>

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



<form class="form-vertical" role="form" action="add_event.php" method="post">

<?php


			//retrieve rsos
			$rso_id = $rso_ids_result->fetch_row();
			$rso_olist = "";
			while($rso_id !== NULL)
			{
				$rso_olist = $rso_olist . "<option value = " . $rso_id[0] . ">" . $rso_id[1] . "</option>";
				$rso_id = $rso_ids_result->fetch_row();
			}
			if($_SESSION["usertype"] == 3){
				//hardcode, fix later
				$uni_id = 0;
				//make negative to differentiate from rso ids
				$uni_id = 0 - $uni_id - 1;
				$rso_olist = $rso_olist . "<option value = " . $uni_id . ">" . "ucf" . "</option>";
			}

			echo '<div class = "form-group">
				<label for="rso">RSO:</label>
				<select class="form-control" id="rso" name="rso">
					' . $rso_olist . '
				</select>
			</div>';
		?>

		Event Name: <input type="text" name="eventname"><br>
		Format:YYYY-MM-DD HH:MM:SS<br>
		Start Time: <input type="datetime-local" name="starttime"> End Time: <input type="datetime-local" name="endtime"><br>
		Description: <textarea name="description" rows="10" cols="40"></textarea><br>
		Phone: <input type="text" name="phone"> Email: <input type="text" name="email"><br>
		<input type="submit" name="Submit"><br>

		<div class="col-sm-7">
            <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>
</form>
 <script>

        var map;
        var marker;
        function myMap() {

            var haightAshbury = {lat: 37.769, lng: -122.446};

            var mapProp= {
                center:new google.maps.LatLng(37.769,-122.446),
                zoom:5,
            };
            map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
            placeMarker(haightAshbury);

            //get marker position after dragging
            marker.addListener('dragend', function(event) {
                var latlng = marker.getPosition();
                console.log("latlng: " + latlng);
                console.log("lat(): " + latlng.lat() + ", lng(): " + latlng.lng());
                document.getElementById("lat").value = latlng.lat();
                document.getElementById("lng").value = latlng.lng();
            });

        }

        function placeMarker(location) {

            marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable:true
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCttR_s1Fawjgb7lQGP9Yk8T4VAU6vsAbQ&callback=myMap"></script>
</body>
