<?php

$username = "root";
$password = "db_password";
$db_name = "ws328700_wad";
$server = "172.17.0.1";

$connect = mysqli_connect($server, $username, $password, $db_name, 3306);

if (mysqli_connect_errno()) {
    echo("Connect failed: %s\n" . mysqli_connect_error());
}