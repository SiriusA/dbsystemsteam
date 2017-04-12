<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/12/2017
 * Time: 10:47 AM
 */


include "connection.php";


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