<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/12/2017
 * Time: 10:47 AM
 */


include_once "connection.php";


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


    $result = db_query("SELECT E.ename, E.description, E.start_time, E.end_time, E.approved, location.url, location.longitude, location.latitude
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
