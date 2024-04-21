<?php
if(!isset($_POST['txtInput'])) die("No message recieved!");

require_once("./include/_connect.php");
include_once("./include/_execute.php");

session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['RoomID']))
{

$value = $_POST['txtInput'];

$SQL = "INSERT INTO `Messages`(`MessageID`, `Message`, `TIMESTAMP`,`SenderID`, `RoomID`) VALUES (Null,?,Null,?, ?);";

$result = executeCommand($SQL, 'sii', [$value, $_SESSION['userID'], $_SESSION['RoomID']]);

echo("Message sent!");
}

echo("message not sent!");

die();