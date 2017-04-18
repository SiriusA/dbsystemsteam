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

//query all universites created by me
    if($_SESSION['utype'] == 1)
    {
        $result = db_query("SELECT U.uid, U.uname, U.description, U.studentcount, U.upicture
                            FROM university_created U");
        if($result == false){
            echo "something went wrong";
        }
        $uNames = array();
        while($row = mysqli_fetch_array($result)){
//        echo "uid: " . $row["uid"] . ", name: " . $row["uname"] . ", desc: " . $row["description"] . "<br>";
            $uNames[] = $row;
         }

        return $uNames;
    }
    else
    {
        $sid = $_SESSION['sid'];
        $result1 = db_query("SELECT U.uid, U.uname, U.description, U.studentcount, U.upicture FROM university_created U, user Us WHERE Us.sid = '$sid' AND Us.uid = U.uid");
        if($result1 == false){
            echo "something went wrong";
        }

        $uNames = array();
        while($row = mysqli_fetch_array($result1)){
//        echo "uid: " . $row["uid"] . ", name: " . $row["uname"] . ", desc: " . $row["description"] . "<br>";
            $uNames[] = $row;
         }

         return $uNames;
    }


//print each universites out
    
}

function getUniversityLocation($uid){
    $result = db_query("SELECT L.longitude, L.latitude
                        FROM location L
                        WHERE L.uid='.$uid.'");
    if($result == false){
        echo "could not query university location";
    }

    if($row = mysqli_fetch_array($result)){
        return $row;
    }
    return ;
}
