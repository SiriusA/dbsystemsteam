<?php

 include_once "connection.php";

 function getEventComments($time, $place){

    $result = db_query("SELECT C.comment, C.timestamp, user.first_name, user.last_name
                        FROM comment C
                        INNER JOIN user on C.sid = user.sid
                        WHERE C.start_time = ".$time." AND C.lid = ".$place."");

     if($result == false){
         echo "something went wrong";
    }

         //save each row in array
     $eventComments = array();
     while($row = mysqli_fetch_array($result)){
        $eventComments[] = $row;
     }

    return $eventComments;
 }
?>
