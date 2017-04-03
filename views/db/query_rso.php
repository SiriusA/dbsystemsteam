<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/30/2017
 * Time: 3:49 PM
 */

include "connection.php";
session_start();

function getRSOsFromManagedUniversities(){
    $sid = $_SESSION["sid"];
    $result = db_query("SELECT R.rname, U.uname, R.approved, R.description
                        FROM rso_owned R, university_created U, student_affiliated S 
                        WHERE U.sid = '$sid' AND U.uid=S.uid AND S.sid=R.sid");
    if($result == false){
        echo "something went wrong";
    }

    //save each row in array
    $rsoUniversityNames = array();
    while($row = mysqli_fetch_array($result)){
        $rsoUniversityNames[] = $row;
    }

    return $rsoUniversityNames;
}