<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/21/2017
 * Time: 11:41 AM
 */

session_start();
include "../db/connection.php";

if(empty($_POST["university"]) || empty($_POST["description"]) || empty($_FILES["picture"]["name"]) || empty($_POST["studentCount"]) || empty($_POST["lat"]) || empty($_POST["lng"])){
    echo "Something is not set";
    header('Location: index.php?error=1');
    exit();
}

$sid = $_SESSION["sid"];
$description = $_POST["description"];
$uname = $_POST["university"];
$studentCount = $_POST["studentCount"];

$lat = $_POST["lat"];
$lng = $_POST["lng"];

$universityid;

//insert file to server
insertFile();

$picture = $_SESSION["email"] . basename($_FILES["picture"]["name"]);

//insert university credentials
insertUniversity($sid, $description, $uname, $studentCount, $picture);

//insert university location
insertLocation($universityid, $uname, $lat, $lng);

header('Location: index.php?success=1');

function insertFile(){
    $target_dir = "../images/";
    $target_file = $target_dir . $_SESSION["email"] . basename($_FILES["picture"]["name"]);
    $uploadOk = 1;

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"]) && isset($_FILES["picture"])) {
        $check = getimagesize($_FILES["picture"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        exit();
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {
            echo "The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    }
}

function insertUniversity($sid, $description, $uname, $studentCount, $picture){

    $picture =
    $result = db_query("INSERT INTO university_created (uid, sid, description, uname,studentcount, upicture)
                        VALUES (NULL, '$sid', '$description', '$uname', '$studentCount', '$picture')");
    if($result == false){
        echo "Insertion went wrong";
        header('Location: create_university.php?insert_error=1');
        exit();
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
        exit();
    }
    else{
        echo "insertion went through";
    }

}
