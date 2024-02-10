<?php
function getPfpLink($userID)
{
    require("./php/include/_connect.php");
    include("./php/include/_execute.php");

    $SQL = "SELECT `ImgSrc` FROM `Users` WHERE `UserID` = ?;";

    $result = executeCommand($SQL, 'i', [$userID]);

    $DATA = mysqli_fetch_assoc($result);

    return $DATA['ImgSrc'];
}