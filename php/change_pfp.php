<?php

if(!isset($_POST['link'])) die("No message recieved!");

session_start();

require_once("./include/_connect.php");

$SQL = "UPDATE `Users` SET `ImgSrc`=? WHERE `UserID` = ?;";

$stmt = mysqli_prepare($connect, $SQL);
mysqli_stmt_bind_param($stmt, "ss", $_POST['link'], $_SESSION['userID']);
mysqli_stmt_execute($stmt);
