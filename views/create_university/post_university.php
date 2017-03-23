<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 3/21/2017
 * Time: 11:41 AM
 */

if(isset($_POST["university"]) && isset($_POST["description"]) && isset($_POST["picture"]) && isset($_POST["studentCount"])){
    echo $_POST["university"];
    echo $_POST["description"];
    echo $_POST["picture"];
    echo $_POST["studentCount"];
}