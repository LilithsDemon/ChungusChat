<?php

if(!isset($_POST['RoomName'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");

$SQL = "SELECT `RoomID` FROM `ChatRooms` WHERE `RoomName` = ?";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "s", $_POST['RoomName']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

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