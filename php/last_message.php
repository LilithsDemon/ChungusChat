<?php

require_once("./php/include/_connect.php");
include_once("./php/include/_execute.php");

// Simple function to get the last message in a chat room
// This allows it to be shown on groups

function getChatMessage($RoomID)
{
    global $connect;
    $SQL = "SELECT `Message` FROM `Messages` WHERE `RoomID` = ? ORDER BY `TIMESTAMP` DESC LIMIT 1";

    $result = executeCommand($SQL, 'i', [$RoomID]);

    if (mysqli_num_rows($result) > 0) {
        $DATA = mysqli_fetch_assoc($result);
        return $DATA['Message'];
    } else {
        return "No messages";
    }
}