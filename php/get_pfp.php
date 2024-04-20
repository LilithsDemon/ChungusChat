<?php
require_once("../php/include/_connect.php");
require_once("../php/include/_execute.php");

// Simple functions to get the profile picture of a user by either their userID or name
// This is used so that it doesn't have to be repeated in multiple files
function getPfpLink($userID)
{
    $SQL = "SELECT `ImgSrc` FROM `Users` WHERE `UserID` = ?;";
    $result = executeCommand($SQL, 'i', [$userID]);
    $DATA = mysqli_fetch_assoc($result);
    return $DATA['ImgSrc'];
}

function getPfpLinkByName($name)
{
    $SQL = "SELECT `ImgSrc` FROM `Users` WHERE `Username` = ?;";
    $result = executeCommand($SQL, 's', [$name]);
    $DATA = mysqli_fetch_assoc($result);
    return $DATA['ImgSrc'];
}