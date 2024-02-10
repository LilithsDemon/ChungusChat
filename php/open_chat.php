<?php

if(!isset($_POST['RoomName'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");
include("./include/_execute.php");

$SQL = "SELECT `RoomID` FROM `ChatRooms` WHERE `RoomName` = ?";

$result = executeCommand($SQL, 's', [$_POST['RoomName']]);

if (mysqli_num_rows($result) === 0)
{
    echo("die");
    die();
}
else
{
    $DATA = mysqli_fetch_assoc($result);
    $_SESSION['RoomID'] = $DATA['RoomID'];
    die();
}