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
$result = db_query("SELECT U.sid, U.utype FROM `user` U WHERE `email` = '$email' AND `password` = '$password' ");
if($result == false){
    echo "somethings wrong";
}
else{

    if(!($row = mysqli_fetch_row($result))){
        echo "no user found or incorrect credentials";
       header('Location: /index.php?error=1');
    }
  
    $sid = $row[0];
    $_SESSION["sid"] = $row[0];
    $utype = $row[1];
    $_SESSION["utype"] = $row[1];

    $result->close();

    if(isSuperAdmin($utype)){
        echo "User is SuperAdmin";
        $_SESSION["usertype"] = 1;
        header('Location: /create_university');
    }
    else if(isAdmin($utype)){
        $_SESSION["usertype"] = 2;
        header('Location: /university_description');
    }
    else if(isStudent($utype)){
        $_SESSION["usertype"] = 3;
        header('Location: /university_description');
    }

    //    while ($row = $result->fetch_object()){
//        $user_arr[] = $row;
//    }
//    // Free result set
//    $result->close();
//    $db->next_result();

}

function isSuperAdmin($utype){
    $result = db_query("SELECT S.utype FROM superadmin S WHERE S.utype = '$utype' ");
    if($result == false){
        echo "Error w/ query";
    }
    //check if there is a row
    else if ($row = mysqli_fetch_row($result)){
        return true;
    }

    $result ->close();
}

function isAdmin($utype){
    $result = db_query("SELECT A.utype FROM admin A WHERE A.utype = '$utype' ");
    if($result == false){
        echo "Error w/ query";
    }
    //check if there is a row
    else if ($row = mysqli_fetch_row($result)){
        return true;
    }

    $result->close();
}


function isStudent($utype){
    $result = db_query("SELECT S.utype FROM student S WHERE S.utype = '$utype' ");
    if($result == false){
        echo "Error w/ query";
    }
    //check if there is a row
    else if ($row = mysqli_fetch_row($result)){
        return true;
    }

    $result->close();
}
