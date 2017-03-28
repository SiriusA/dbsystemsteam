<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/25/2017
 * Time: 8:25 AM
 */
include "connection.php";

//call this function in main php code
//will return an array of names

function getUniversities(){
    $sid = $_SESSION["sid"];

//query all universites created by me
    $result = db_query("SELECT U.uid, U.uname, U.description, U.studentcount, U.upicture 
                        FROM university_created U 
                        WHERE U.sid = '$sid' ");
    if($result == false){
        echo "something went wrong";
    }

//print each universites out
    $uNames = array();
    while($row = mysqli_fetch_array($result)){
//        echo "uid: " . $row["uid"] . ", name: " . $row["uname"] . ", desc: " . $row["description"] . "<br>";
        $uNames[] = $row;
    }

    return $uNames;
}

function getUniversityLocation($uid){
    $result = db_query("SELECT L.longitude, L.latitude
                        FROM location L
                        WHERE L.uid='.$uid.'");
    if($result == false){
        echo "could not query university location";
    }

    if($row = mysqli_fetch_array($result)){
        echo "success";
        return $row;
    }
    echo "fail";
    return ;
}