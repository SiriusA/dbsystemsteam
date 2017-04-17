<!-- Prevent user from skipping login page -->
<?php
  session_start();

  if($_SESSION["userLoggedIn"] == false)
    header('Location: /');
?>

<!DOCTYPE html>
<html>
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

<body>

    <!--Display correct navbar-->
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

    <div id="content" class="container-fluid">
        <h2>Create University</h2>

        <form action="/create_university/post_university.php" method="post" enctype="multipart/form-data">

            <!--        1/2 row-->
            <div class="row">

                <!--                    1/2 column-->
                <!--            place buttons here-->
                <div class="col-sm-4">

<!--                Form to post University Credentials-->
                    <div class="form-group">
                        <label for="email">University Name:</label>
                        <input type="text" name="university" class="form-control" id="email">
                    </div>

                    <div class="form-group">
                        <label for="pwd">Description:</label>
                        <input type="text" name="description" class="form-control" id="pwd">
                    </div>

                    <div class="form-group">
                        <label for="pic">Picture:</label>
                        <input type="file" name="picture" id="pic">
                    </div>

                    <div class="form-group">
                        <label for="cnt">Student Count:</label>
                        <input type="text" name="studentCount" class="form-control" id="cnt">
                    </div>

<!--                    hidden input for latitude-->
<!--                    javarscript will set input after Marker is dragged-->
                    <input id="lat" type="hidden" name="lat" value="123">
                    <input id="lng" type="hidden" name="lng" value="123">

                </div>


<!--                2/2 column-->
    <!--            Map here-->
                <div class="col-sm-7">
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
            </div>

            <!--            2/2 row-->
<!--            Submit form button-->
            <div id="submitdiv">
                <div class="col-sm-12 text-center">
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>

    </div>

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
<?php

if($_SESSION["usertype"] != 1 && $_SESSION["usertype"] != 2 && $_SESSION["usertype"] != 3)
{
    header("location: ../");
}
//check if there was an error with the last login
if(isset($_GET["error"]) && $_GET["error"] == "1"){
    echo "<script>alert('Error message: Input is missing');</script>";
}
else if(isset($_GET["insert_error"]) && $_GET["insert_error"] == "1"){
    echo "<script>alert('Error message: Insertion did not complete');</script>";
}
else if(isset($_GET["success"]) && $_GET["success"] == "1"){
    echo "<script>alert('Success message: Insertion complete');</script>";
}
