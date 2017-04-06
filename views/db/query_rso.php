<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/30/2017
 * Time: 3:49 PM
 */

include "connection.php";
//returns all RSO that are part of a University that SuperAdmin manages
//used in list_rso and rso_description
function getRSOsFromManagedUniversities(){
    $sid = $_SESSION["sid"];

    //use quotes on user because it is a reverved word
    $result = db_query("SELECT R.rname, R.approved, R.description, R.rpicture, U.uname, Us.email
                        FROM rso_owned R, university_created U, student_affiliated S, `user` Us
                        WHERE U.sid = '$sid' AND U.uid=S.uid AND S.sid=R.sid AND R.sid=Us.sid");
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
