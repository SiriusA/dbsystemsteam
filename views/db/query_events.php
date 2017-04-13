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
                        WHERE A.sid='.$sid.' AND A.start_time=E.start_time AND A.lid=E.lid");
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
    $result = db_query("SELECT E.e_name, E.e_description, E.e_start, E.e_end, E.e_approved, L.url, L.longitude, L.latitude
                        FROM events E, location L, joins J, user U
                        WHERE ('.$sid.' = J.sid
                        AND J.rid = E.rid)
                        OR ('.$sid.' = U.sid
                        AND U.uid = L.uid
                        AND E.rid = NULL)
                        AND E.lid = L.lid");
    if($result === false){
        echo "something went wrong";
    }
    return $result;
}
