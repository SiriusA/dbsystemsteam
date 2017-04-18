<?php

 include_once "connection.php";

 function getEventComments(){

    $result = db_query("SELECT C.comment, C.timestamp, U.first_name, U.last_name
                        FROM comment C, Events_Hosted_Located E, user U
                        WHERE C.start_time = E.start_time AND C.lid = E.lid");

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
