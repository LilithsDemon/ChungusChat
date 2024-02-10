<?php

if(!isset($_POST['link'])) die("No message recieved!");

session_start();

require_once("../php/include/_connect.php");
require_once("../php/include/_execute.php");

$SQL = "UPDATE `Users` SET `ImgSrc`=? WHERE `UserID` = ?;";

executeCommand($SQL, 'si', [$_POST['link'], $_SESSION['userID']]);