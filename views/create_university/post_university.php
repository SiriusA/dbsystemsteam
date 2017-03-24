<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/21/2017
 * Time: 11:41 AM
 */

session_start();
include "../db/connection.php";

if(empty($_POST["university"]) || empty($_POST["description"]) || empty($_POST["picture"]) || empty($_POST["studentCount"]) || empty($_POST["lat"]) || empty($_POST["lng"])){
    echo "Something is not set";
    header('Location: index.php?error=1');
}

$sid = $_SESSION["sid"];
$description = $_POST["description"];
$uname = $_POST["university"];
$studentCount = $_POST["studentCount"];

$picture = $_POST["picture"];
$lat = $_POST["lat"];
$lng = $_POST["lng"];

$universityid;

//insert university credentials
insertUniversity($sid, $description, $uname, $studentCount, $picture);

//insert university location
insertLocation($universityid, $uname, $lat, $lng);

header('Location: index.php?success=1');


function insertUniversity($sid, $description, $uname, $studentCount, $picture){

    $result = db_query("INSERT INTO university_created (uid, sid, description, uname,studentcount, upicture)
                        VALUES (NULL, '$sid', '$description', '$uname', '$studentCount', '$picture')");
    if($result == false){
        echo "Insertion went wrong";
        header('Location: create_university.php?insert_error=1');

    }
    else{
        echo "insertion went through";

        //im only calling because i need the connection for mysqli insert id
        //db is already connected
        $connection = db_connect();
        $GLOBALS["universityid"] = mysqli_insert_id($connection);
    }

}

//get uid from previous query maybe
function insertLocation($uid, $lname, $lat, $lng){
    $result = db_query("INSERT INTO location (lid, uid, lname, longitude,latitude)
                        VALUES (NULL, '$uid', '$lname', '$lng', '$lat')");
    if($result == false){
        echo "Insertion went wrong";
        header('Location: index.php?insert_error=1');
    }
    else{
        echo "insertion went through";
    }

}
