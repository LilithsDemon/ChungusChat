<?php

if(!isset($_POST['Username'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");

$SQL = "SELECT `UserID` FROM `Users` WHERE `Username` = ?";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "s", $_POST['Username']);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 0)
{
    echo("die");
    die();
}
else
{
    $USER = mysqli_fetch_assoc($result);
    $_SESSION['chat_userID'] = $USER['UserID'];
    echo($_SESSION['chat_userID']);
    echo("done");
    die();
}