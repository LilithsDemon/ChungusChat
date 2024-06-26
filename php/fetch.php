<?php

session_start();

// Uses short polling to get messages as a backup

if(isset($_SESSION['RoomID']))
{

require_once("./include/_connect.php");
require_once('./include/_execute.php');
require_once('../components/message.php');

$SQL = "SELECT `Users`.`Username`, `SenderID`, `MessageID`, `Message`, `TIMESTAMP`, `RoomID` FROM `Messages` LEFT JOIN `Users` ON `Users`.`UserID` = `Messages`.`SenderID` WHERE `RoomID` = ? ORDER BY `TIMESTAMP` ASC;";

$result = executeCommand($SQL, 'i', [$_SESSION['RoomID']]);

if (mysqli_num_rows($result) > 0)
{
    while($DATA = mysqli_fetch_assoc($result))
    if($DATA['SenderID'] != $_SESSION['userID'])
    {
        $message = new SelfMessage($DATA['Message'], $DATA['TIMESTAMP'], $DATA['Username'], $DATA['MessageID']);
        $message->getMessage();
    }
    else
    {
        $message = new Message($DATA['Message'], $DATA['TIMESTAMP'], $DATA['Username']);
        $message->getMessage();
    }
    ?>
<?php
die();
} else 
{
    echo "There are no messages";
    die();
}
}