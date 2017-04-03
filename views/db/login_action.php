<?php

session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/20/2017
 * Time: 9:37 AM
 */

//connects to database
include "connection.php";

$email = $_POST["email"];
$password = $_POST["password"];

//select U.sid from user U where email = "$email" AND password='$pass'
$result = db_query("SELECT U.sid FROM `user` U WHERE `email` = '$email' AND `password` = '$password' ");
if($result == false){
    echo "somethings wrong";
}
else{

    if(!($row = mysqli_fetch_row($result))){
        echo "no user found or incorrect credentials";
       header('Location: /index.php?error=1');
    }

    //save sid in session and variable
    $sid = $row[0];
    $_SESSION["sid"] = $row[0];

    $result->close();

    if(isSuperAdmin($sid)){
        echo "User is SuperAdmin";
        $_SESSION["usertype"] = 1;
        header('Location: /create_university');
    }
    else if(isAdmin($sid)){
        $_SESSION["usertype"] = 2;
        header('Location: /university_description');
    }
    else{
        $_SESSION["usertype"] = 3;
        echo "User is Student only";
        header('Location: /university_description');
    }

    //    while ($row = $result->fetch_object()){
//        $user_arr[] = $row;
//    }
//    // Free result set
//    $result->close();
//    $db->next_result();

}

function isSuperAdmin($sid){
    $result = db_query("SELECT S.sid FROM superadmin S WHERE S.sid = '$sid' ");
    if($result == false){
        echo "Error w/ query";
    }
    //check if there is a row
    else if ($row = mysqli_fetch_row($result)){
        return true;
    }

    $result ->close();
}

function isAdmin($sid){
    $result = db_query("SELECT A.sid FROM admin A WHERE A.sid = '$sid' ");
    if($result == false){
        echo "Error w/ query";
    }
    //check if there is a row
    else if ($row = mysqli_fetch_row($result)){
        return true;
    }

    $result->close();
}
