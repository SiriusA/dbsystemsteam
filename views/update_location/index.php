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


    <input id="lat" type="hidden" name="lat" value="123">
    <input id="lng" type="hidden" name="lng" value="123">
    <?php



          if($_SESSION["usertype"] == 2)
          {
            $loc_query = "SELECT *
                          FROM location L
                          WHERE L.uid = " . $_SESSION["uid"] . ";";
          }
          else {
            $loc_query = "SELECT *
                          FROM location L
                          INNER JOIN university_created ON L.uid = university_created.uid
                          WHERE university_created.sid = " . $_SESSION["sid"] . ";";
          }


          $location_list = db_query($loc_query);



    			$loc_ent = $location_list->fetch_array();
    			$loc_str = "<option value='-1'>New Location</option>";
    			while($loc_ent !== NULL)
    			{
    				$loc_str = $loc_str . "<option value = " . $loc_ent["lid"] . ">" . $loc_ent["lname"] . "</option>";
    				$loc_ent = $location_list->fetch_array();
    			}


    			echo '<div class = "form-group">
    				<label for="loc">Location:</label>
    				<select class="form-control" id="lid" name="lid" onchange="mapZoom(this.value)">
    					' . $loc_str . '
    				</select>
    			</div>';
     ?>
    Location Name: <input type="text" name="lname"><br>
		<input type="submit" name="Submit"><br>

		<div class="col-sm-7">
            <div id="googleMap" style="width:100%;height:400px;"></div>
        </div>
</form>

<script>
  function mapZoom(lid) {
    if(lid == -1)
    {
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {
              console.log(this.responseText);
              eval(this.responseText);
          }
      };
      xmlhttp.open("GET", "../db/zoom_map.php?lid=" + lid, true);
      xmlhttp.send();
    }
  }
</script>

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
