<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/12/2017
 * Time: 10:47 AM
 */


include_once "connection.php";

function getEventsManagedBySuper(){

//    SELECT E.ename, E.description, E.approved
//FROM events_hosted_located E, university_created U, location L
//WHERE U.sid=1 AND U.uid=L.uid AND L.lid=E.lid
    $sid = $_SESSION["sid"];
    $result = db_query("SELECT E.ename, E.description, E.approved, E.start_time, E.end_time, E.lid
                        FROM events_hosted_located E, university_created U, location L
                        WHERE U.sid='$sid' AND U.uid=L.uid AND L.lid=E.lid");
    if($result == false){
        echo "something went wrong";
    }

    //save each row in array
    $eventsAttending = array();
    while($row = mysqli_fetch_array($result)){
        $eventsAttending[] = $row;
    }

    return $eventsAttending;
}
function getEventsAttending(){
    $sid = $_SESSION["sid"];
    $result = db_query("SELECT E.ename, E.description, E.start_time, E.end_time, E.approved
                        FROM events_hosted_located E, attends A
                        WHERE A.sid=" . $sid . " AND A.start_time=E.start_time AND A.lid=E.lid");
    if($result == false){
        echo "something went wrong";
    }

        //save each row in array
    $eventsAttending = array();
    while($row = mysqli_fetch_array($result)){
        $eventsAttending[] = $row;
    }

    return $eventsAttending;
}

function getEventsList(){
    $sid = $_SESSION["sid"];


    $result = db_query("SELECT E.ename, E.description, E.start_time, E.end_time, E.approved, E.lid, location.url, location.longitude, location.latitude
                        FROM events_hosted_located E
                        INNER JOIN location ON E.lid = location.lid
                        INNER JOIN joins ON joins.rid = E.rid
                        INNER JOIN user ON location.uid = user.uid
                        WHERE " . $sid . " = user.sid
                     	  OR ( " . $sid . " = user.sid AND E.rid = NULL)");



//    $result = db_query("SELECT E.e_name, E.e_description, E.e_start, E.e_end
//                        FROM events E");

    if($result === false){
        echo "something went wrong";
    }

    $eNames = array();
    while($row = mysqli_fetch_array($result)){
        $eNames[] = $row;
    }

    return $eNames;
}

function getRSOeventLoc($rid)
{
  $result = db_query("SELECT *
                      FROM events_hosted_located E
                      INNER JOIN location ON E.lid = location.lid
                      WHERE E.rid = " . $rid . "");

  if($result === false)
  {
    echo "something went wrong";
  }

  $eNames = array();
  while($row = mysqli_fetch_array($result)){
      $eNames[] = $row;
  }

  return $eNames;
}

function getEventbyTimePlace($time, $place)
{
  $result = db_query("SELECT DISTINCT *
                      FROM events_hosted_located E
                      WHERE E.start_time = " . $time . " AND E.lid = " . $place . "");

  if($result === FALSE)
  {
    echo "something went wrong";
  }

  return $result->fetch_array();
}
