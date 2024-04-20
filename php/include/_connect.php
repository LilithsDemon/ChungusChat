<?php

// Log in details for the server

$username = "root";
$password = "db_password";
$db_name = "ws328700_wad";
$server = "172.17.0.1";

// Connection to the database is saved as $connect
$connect = mysqli_connect($server, $username, $password, $db_name, 3306);

// If the connection fails, an error message will be displayed
if (mysqli_connect_errno()) echo("Connect failed: %s\n" . mysqli_connect_error());