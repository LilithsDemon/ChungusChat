<?php

// Makes sure the roomID is sent in post
if(!isset($_POST['RoomID'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");
require_once("./include/_execute.php");

// Check to make sure the user is in the group stops any misuse of code
$SQL = "SELECT `LinkID` FROM `UserToRoom` WHERE `RoomID` = ? AND `UserID` = ?";
$result = executeCommand($SQL, 'ss', [$_POST['RoomID'], $_SESSION['userID']]);
if(mysqli_num_rows($result) == 0) die("You are not a memebr of that group");

$SQL = "SELECT `RoomID` FROM `ChatRooms` WHERE `RoomID` = ?";
$result = executeCommand($SQL, 's', [$_POST['RoomID']]);

if (mysqli_num_rows($result) === 0)
{
    die("No room found");
}
else
{
    $DATA = mysqli_fetch_assoc($result);
    $_SESSION['RoomID'] = $DATA['RoomID'];
    die();
}