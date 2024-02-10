<?php

require_once("./php/include/_connect.php");

function getChatMessage($RoomID)
{
    global $connect;
    $SQL = "SELECT `Message` FROM `Messages` WHERE `RoomID` = ? ORDER BY `TIMESTAMP` DESC LIMIT 1";

    $stmt = mysqli_prepare($connect, $SQL);
    mysqli_stmt_bind_param($stmt, "s", $RoomID);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        $DATA = mysqli_fetch_assoc($result);
        return $DATA['Message'];
    } else {
        return "No messages";
    }
}