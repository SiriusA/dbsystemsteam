<!DOCTYPE html>
<html>
    <head>
        <title>University Profile</title>

        <link rel="stylesheet" href="/stylesheets/create_university.css">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </head>

    <body>
    <?php
        session_start();
        include ("../db/query_universities.php");

        if(!empty($_GET["index"])){
            $index = $_GET["index"];
        }
        else{
            $index = 0;
        }

        $listUniversity = getUniversities();
        $lnglat = getUniversityLocation($listUniversity[$index]["uid"]);
        echo "uid: " . $listUniversity[$index]["uid"] . "<br>";
        echo "name: " . $listUniversity[$index]["uname"] . "<br>";
        echo "desc: " . $listUniversity[$index]["description"] . "<br>";
        echo "count: " . $listUniversity[$index]["studentcount"] . "<br>";
        echo "pic: " . $listUniversity[$index]["upicture"] . "<br>";
        echo "long: " . $lnglat["longitude"] . "<br>";
        echo "latitude: " . $lnglat["latitude"] . "<br>";

    echo '<div id="content" class="container-fluid">
                <ul class="pager">';

                //display previous button?
                if($index - 1 >= 0 ){
                    echo '<li><a href="index.php?index='.($index - 1).'">Previous</a></li>';
                }

                //diplay next button
                if($index + 1 < sizeof($listUniversity)){
                    echo '<li><a href="index.php?index='.($index + 1).'">Next</a></li>';
                }
        echo    '</ul>
              </div>';
    ?>

    </body>
</html>