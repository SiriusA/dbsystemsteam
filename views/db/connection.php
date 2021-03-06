<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/20/2017
 * Time: 11:54 AM
 */

function db_connect(){

    static $connection;

    if(!isset($connection)){

        $config = parse_ini_file("../config.ini");

        // Create connection
        $connection = mysqli_connect("localhost", $config["username"], $config["password"], $config["dbname"]);

    }

    // Check connection
    if ($connection === false) {
        echo "Connection error";
        return mysqli_connect_error();
    }

    return $connection;

}

function db_query($query) {
    // Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection,$query);

    if($result == false)
        echo mysqli_error($connection);
    return $result;
}

function db_error(){
    $connection = db_connect();
    return mysqli_error($connection);
}

function getConnObj(){
    $config = parse_ini_file("../config.ini");
    $conn = new mysqli("localhost", $config["username"], $config["password"], $config["dbname"]);
    return $conn;
}
