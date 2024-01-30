<?php
function getPfpLink($userID)
{
    require("./php/include/_connect.php");

    $SQL = "SELECT `ImgSrc` FROM `Users` WHERE `UserID` = ?;";

    $stmt = mysqli_prepare($connect, $SQL);
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    $DATA = mysqli_fetch_assoc($result);

    return $DATA['ImgSrc'];
}