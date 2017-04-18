<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/17/2017
 * Time: 10:56 PM
 */
include_once "../db/connection.php";
if(empty($_POST["approved"])){
    exit();
}

$date = $_POST["startTime"];
$lid = $_POST["lid"];
updateApproval($approved, $date, $lid);

function updateApproval($approved, $date, $lid){
    $result = db_query("UPDATE events_hosted_located E
                        SET E.approved=1
                        WHERE E.start_time='$date' AND E.lid='$lid'");
    if($result == false){
        echo "Insertion went wrong";
        header('Location: index.php?insert_error=1');
        exit();
    }
    else{
        header('Location: index.php');
        echo "insertion went through";
    }
}