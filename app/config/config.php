<?php

session_start();

// <-- Connect to database -->
$db_server = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "hotel";

$conn = mysqli_connect($db_server, $db_username, $db_password, $db_name);

if(!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}