<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/30/2017
 * Time: 3:49 PM
 */

include_once "connection.php";

//used in list_rso and rso description
//Queries all RSO that Superadmin may manage
function getRSOsFromManagedUniversities(){
    $sid = $_SESSION["sid"];
    $result = db_query("SELECT DISTINCT R.rname, R.approved, R.description, R.rpicture, U.uname, Us.email
                        FROM rso_owned R, university_created U, `user` Us
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
function getRSOsForStudent()
{
    $sid = $_SESSION["sid"];

    $result = db_query("SELECT DISTINCT R.rname, R.approved, R.description, R.rpicture, R.rid, U.uname, Us.email
                        FROM rso_owned R, university_created U, `user` Us
                        WHERE Us.sid = '$sid' AND R.sid = Us.sid AND U.uid = Us.uid");

    if($result == false){
        echo "something went wrong";
    }

    //save each row in array
    $myRso = array();
    while($row = mysqli_fetch_array($result)){
        $myRso[] = $row;
    }

    return $myRso;
}

function getRSObyID($rid)
{
  $result = db_query("SELECT DISTINCT *
                      FROM rso_owned R
                      WHERE R.rid = " . $rid . "");

  if($result === FALSE)
  {
    echo "something went wrong";
  }

  return $result->fetch_array();
}

//get RSOs from university the student is attending
//TODO fix this query
function getUniversitiesRSO()
{
    $uid = $_SESSION["uid"];
    $result = db_query("SELECT DISTINCT R.rname, R.description, R.approved
                        FROM rso_owned R, `user` U
                        WHERE U.uid='.$uid.' AND U.sid=R.sid");

    if($result == false){
        echo "something went wrong";
    }

    //save each row in array
    $myRso = array();
    while($row = mysqli_fetch_array($result)){
        $myRso[] = $row;
    }

    return $myRso;
}
