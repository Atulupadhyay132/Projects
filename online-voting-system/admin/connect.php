<?php
$connect = mysqli_connect("localhost","root","","voting");

if(!$connect){
    die("Database Connection Failed");
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>