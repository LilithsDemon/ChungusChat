<?php

// Makes sure image link is sent in post
if(!isset($_POST['link'])) die("No messa
ge recieved!");

session_start();

require_once("../php/include/_connect.php");
require_once("../php/include/_execute.php");

$SQL = "UPDATE `Users` SET `ImgSrc`=? WHERE `UserID` = ?;";

executeCommand($SQL, 'si', [$_POST['link'], $_SESSION['userID']]);