<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/30/2017
 * Time: 3:49 PM
 */

include "connection.php";

//used in list_rso and rso description
//Queries all RSO that Superadmin may manage
function getRSOsFromManagedUniversities(){
    $sid = $_SESSION["sid"];
    $result = db_query("SELECT DISTINCT R.rname, R.approved, R.description, R.rpicture, U.uname, Us.email
                        FROM rso_owned R, university_created U, student_affiliated S, `user` Us 
                        WHERE U.sid = '$sid' AND U.uid=Us.uid AND Us.sid=R.sid");
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

//Function to query RSO student or admin may view