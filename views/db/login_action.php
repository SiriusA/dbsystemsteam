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

$_SESSION["userLoggedIn"] = false;

$email = $_POST["email"];
$password = $_POST["password"];

//select U.sid from user U where email = "$email" AND password='$pass'
$result = db_query("SELECT U.sid, U.utype, U.email FROM `user` U WHERE `email` = '$email' AND `password` = '$password' ");
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
    $_SESSION["userLoggedIn"] = true;
    //used to save images to unique names( ex. alex@gmail.comIMG123.jpg)
    $_SESSION["email"] = $row[2];

    $result->close();

    if($utype == 1){
        echo "User is SuperAdmin";
        $_SESSION["usertype"] = 1;
        header('Location: /create_university');
    }
    else if($utype == 2){
        $_SESSION["usertype"] = 2;
        header('Location: /events_attending');
    }
    else if($utype == 3){
        $_SESSION["usertype"] = 3;
        header('Location: /events_attending');
    }

    //    while ($row = $result->fetch_object()){
//        $user_arr[] = $row;
//    }
//    // Free result set
//    $result->close();
//    $db->next_result();

}
