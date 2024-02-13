<?php

if(!isset($_POST['RoomID'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");
require_once("./include/_execute.php");

$SQL = "SELECT `RoomID` FROM `ChatRooms` WHERE `RoomID` = ?";

$result = executeCommand($SQL, 's', [$_POST['RoomID']]);

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