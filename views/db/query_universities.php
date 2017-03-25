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
    $result = db_query("SELECT U.uid, U.uname, U.description FROM university_created U WHERE U.sid = '$sid' ");
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
