<?php


session_start();
include_once "../db/connection.php";

if(empty($_POST["first_name"]) || empty($_POST["last_name"]) || empty($_POST["pwd"]) || empty($_POST["email_address"]) || empty($_POST["university_id"])){
    echo "Something is not set";
    header('Location: index.php?error=1');
    exit();
}

$first_name= $_POST["first_name"];
$last_name = $_POST["last_name"];
$email = $_POST["email_address"];
$password = $_POST["pwd"];
$uid = $_POST["university_id"];
$utype;
$sid;

//insert a new user into the database
//insertUser($sid, $utype, $email, $password, $first_name, $last_name);

//insert the affiliation for university
//insertAffiliation($sid, $uid);



    $result = db_query("INSERT INTO user(sid, utype, email, password, first_name, last_name)
                        VALUES (NULL, DEFAULT, '$email', '$password', '$first_name', '$last_name')");
    if($result == false){
        echo "Insertion went wrong";
        exit();
    }
    else{
        session_destroy();
        header('Location: ../');
        exit;
    }


   /* $result = db_query("INSERT INTO student_affiliated (sid, uid)
                        VALUES ('$sid', '$uid')");
    if($result == false){
        echo "Insertion went wrong";
        exit();
    }
    else{
        echo "University Added";

    }
    */


?>

