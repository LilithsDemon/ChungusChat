<?php
if(!isset($_POST['txtInput'])) die("No message recieved!");

require_once("./php/include/_connect.php");

session_start();

if(isset($_SESSION['userID']) and isset($_SESSION['chat_userID']))
{

$value = $_POST['txtInput'];

$SQL = "INSERT INTO `Messages`(`MessageID`, `Message`, `TIMESTAMP`,`SenderID`, `LocationID`) VALUES (Null,?,Null,?, ?);";

$userID = 0;

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "sii", $value, $_SESSION['userID'], $_SESSION['chat_userID']);
mysqli_stmt_execute($stmt);
}

die();