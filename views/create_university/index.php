<?php
    session_start();
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
    <div class="container-fluid">
        <h2>Create University</h2>

        <form action="/create_university/post_university.php" method="post">

            <!--        1/2 row-->
            <div class="row">

                <!--                    1/3 column-->
                <!--            place buttons here-->
                <div class="col-sm-3" style="background-color:lavender;">

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

                </div>

<!--                2/3 column-->
                <!--            location button-->
                <div class="col-sm-3" style="background-color:lavenderblush;">
                    <button type="button" class="btn btn-primary">Set Location</button> <br>
                </div>

<!--                3/3 column-->
    <!--            Map here-->
                <div class="col-sm-6" style="background-color:beige;">
                    <div id="googleMap" style="width:100%;height:400px;"></div>
                </div>
            </div>

            <!--            2/2 row-->
<!--            Submit form button-->
            <div class="row" style="background-color: #00fa00">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>

        </form>

    </div>

    <script>


        var map;

        function myMap() {

            var haightAshbury = {lat: 37.769, lng: -122.446};

            var mapProp= {
                center:new google.maps.LatLng(37.769,-122.446),
                zoom:5,
            };
            map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
//            map.addListener('click', function(event) {
//                placeMarker(event.latLng);
//            });

            placeMarker(haightAshbury);
        }

        function placeMarker(location) {

            var marker = new google.maps.Marker({
                position: location,
                map: map,
                draggable:true
            });
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCttR_s1Fawjgb7lQGP9Yk8T4VAU6vsAbQ&callback=myMap"></script>

</body>
