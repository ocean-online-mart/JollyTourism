<?php
    function dbconnect(){

    // $hostname = "localhost";
    // $username = "jt_db_usr";
    // $password = "FdqiNnbqaOo8s6D7";
    // $database = "jt_db";

    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "jollytourism";
    $conn = mysqli_connect($hostname, $username, $password,$database) or die(mysqli_error($conn));
    return $conn;
    }
    date_default_timezone_set('Asia/Kolkata'); 

?>