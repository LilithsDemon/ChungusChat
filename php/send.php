<?php
if(!isset($_POST['txtInput'])) die("No message recieved!");

require_once("./php/include/_connect.php");
include_once("./php/include/_execute.php");

session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['RoomID']))
{

$value = $_POST['txtInput'];

$SQL = "INSERT INTO `Messages`(`MessageID`, `Message`, `TIMESTAMP`,`SenderID`, `RoomID`, `Seen`) VALUES (Null,?,Null,?, ?, 0);";

$result = executeCommand($SQL, 'sii', [$value, $_SESSION['userID'], $_SESSION['RoomID']]);

echo("Message sent!");
}

echo("message not sent!");

die();