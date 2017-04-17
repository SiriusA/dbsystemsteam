<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 4/17/2017
 * Time: 2:52 AM
 */

session_start();
include_once "../db/connection.php";

if(empty($_POST["rso"])){
    echo "Something is not set";
    header('Location: index.php?error=1');
    exit();
}

$sid = $_SESSION["sid"];
$rid = $_POST["rso"];

insertLocation($sid, $rid);

function insertLocation($sid, $rid){
    $result = db_query("INSERT INTO joins (sid, rid)
                        VALUES ('$sid', '$rid')");
    if($result == false){
        echo "Insertion went wrong";
        header('Location: index.php?insert_error=1');
        exit();
    }
    else{
        header('Location: ../rso');
        echo "insertion went through";
    }
}
